<?php
//タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');
session_start();
$day=0;
if(isset($_GET['day'])&& isset($_GET['task'])){ 
    $getDays= explode("-",$_GET['day']);
    $getDays[2]=preg_replace('/^0/','',$getDays[2]);
    echo $getDays[2];
    $getDay = $getDays[0]."-".$getDays[1]."-".$getDays[2];
    echo $getDay;
    $_SESSION[$getDay]=$_GET['task'];
}

//前月・次月リンクが選択された場合は、GETパラメーターから年月を取得
if(isset($_GET['ym'])){ 
    $ym = $_GET['ym'];
}else{
    //今月の年月を表示
    $ym = date('Y-m');
}

//タイムスタンプ（どの時刻を基準にするか）を作成し、フォーマットをチェックする
//strtotime('Y-m-01')
$timestamp = strtotime($ym . '-01'); 
if($timestamp === false){//エラー対策として形式チェックを追加
    //falseが返ってきた時は、現在の年月・タイムスタンプを取得
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

//今月の日付　フォーマット　例）2020-10-2
$today = date('Y-m-j');

//カレンダーのタイトルを作成　例）2020年10月
$html_title = date('Y年n月', $timestamp);//date(表示する内容,基準)

//前月・次月の年月を取得
//strtotime(,基準)
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));

//該当月の日数を取得
$day_count = date('t', $timestamp);

//１日が何曜日か
$youbi = date('w', $timestamp);

//カレンダー作成の準備
$weeks = [];
$week = '';

//第１週目：空のセルを追加
//str_repeat(文字列, 反復回数)
$week .= str_repeat('<td></td>', $youbi);

for($day = 1; $day <= $day_count; $day++, $youbi++){
    
    $date = $ym . '-' . $day; //2020-00-00
    var_dump($date);
    if($today == $date){
        
        $week .= '<td class="today">' . $day;//今日の場合はclassにtodayをつける
    } else {
        $week .= '<td>' . $day;
        if(isset($_SESSION[$date])){
            $week .= "<br>「".$_SESSION[$date]."」";
        }
    }
    $week .= '</td>';
    
    if($youbi % 7 == 6 || $day == $day_count){//週終わり、月終わりの場合
        //%は余りを求める、||はまたは
        //土曜日を取得
        
        if($day == $day_count){//月の最終日、空セルを追加
            $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
        }
        
        $weeks[] = '<tr>' . $week . '</tr>'; //weeks配列にtrと$weekを追加
        
        $week = '';//weekをリセット
    }
}
    
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>PHPカレンダー</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      .container {
        font-family: 'Noto Sans', sans-serif;/*--GoogleFontsを使用--*/
          margin-top: 80px;
      }
        h3 {
            margin-bottom: 30px;
        }
        th {
            height: 30px;
            text-align: center;
        }
        td {
            height: 100px;
            width: 100px;
        }
        .today {
            background: orange;/*--日付が今日の場合は背景オレンジ--*/
        }
        th:nth-of-type(1), td:nth-of-type(1) {/*--日曜日は赤--*/
            color: red;
        }
        th:nth-of-type(7), td:nth-of-type(7) {/*--土曜日は青--*/
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="get">
            やること<input type="text" name="task">
            日付<input type="date" name="day">
            <input type=submit value="追加テスト">
        </form>
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="table table-bordered">

            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
             <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
    </div>
</body>
</html>