<?PHP 
require("../db_open.php");
$eventList=[];//dbから取り出したデータ格納用 

if(isset($_POST['deleteDate'])){ //完了ボタン押した時用処理
    $addEvent = $dbh->prepare('DELETE FROM testevent_table WHERE eventDate = :eventDate');
    $addEvent->bindValue(':eventDate',$_POST['deleteDate'],PDO::PARAM_STR);
    $addEvent->execute();
    echo"よていけした";
}

//$eventList[]にdbから取得したデータを格納、['data']と['Text']がキーになって一つの予定を構成している。
$getEventRec = $dbh->prepare('SELECT * FROM testevent_table');
$getEventRec->execute();
while($event = $getEventRec->fetch(PDO::FETCH_ASSOC)){
    $eventList[]= 
        [
            'date' => $event['eventDate'],
            'Text' => $event['eventText'],
        ];
};

//タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');
$day=0;

//前月・次月リンクが選択された場合は、GETパラメーターから年月を取得
if(isset($_GET['ym'])){ 
    $ym = $_GET['ym'];
}else{
    //今月の年月を表示
    $ym = date('Y-m'); //"YYYY-mm" で現在時間を取得
}


echo $ym."(\$ym 指定時間)<br>";

$timestamp = strtotime($ym . '-01'); //今月の一日をタイムスタンプで取得

if($timestamp === false){//エラー対策
    //falseが返ってきた時は、現在の年月・タイムスタンプを取得
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
echo $timestamp."(\$timestamp 今月の初日を、UNIXタイムスタンプ型式にしたやつ)<br>";

//今月の日付　フォーマット　例）2020-10-2
$today = date('Y-m-j');//YYYY-mm-j 
echo $today."(\$today今日の日付)<br>";

//カレンダーのタイトルを作成　例）2020年10月
$html_title = date('Y年n月', $timestamp);//date(表示する内容,基準)
echo $html_title."(\$html_title カレンダーのタイトル)<br>";

//前月・次月の年月を取得、strotimeでUNIXタイムスタンプ型式にしてからdateでフォーマット
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));
echo $prev."(\$prev 先月)<br>";
echo $next."(\$next 来月)<br>";

//該当月の日数を取得
$day_count = date('t', $timestamp);//その月の日数
echo $day_count."(\$day_count 該当月の日数)<br>";

//１日が何曜日か
$youbi = date('w', $timestamp);//曜日番号0[日曜]-6[土曜]
echo $youbi."(\$youbi 1日の曜日,0[日曜]-6[土曜])<br>";

//カレンダー作成の準備
$weeks = [];
$week = '';

//第１週目：空のセルを追加
//str_repeat(文字列, 反復回数),木曜なら４回的な、カレンダーの最初の空欄何個いるかってこと
$week .= str_repeat('<td></td>', $youbi);
echo $week."<br>";

if(isset($_POST['eventDate'])&&isset($_POST['eventText'])){
    $dbAdd=true;
    $_POST['eventDate'] = date("Y-m-d",strtotime($_POST['eventDate']));
    echo $_POST['eventText']."(\$_POST['eventText'] <br>";
    echo $_POST['eventDate']."(\$_POST['eventDate'] <br>";

    foreach($eventList as $event){//入ってるeventの配列回し用
        if($event['date']==$_POST['eventDate']){
            $dbAdd = false;
        }
    }
    if($dbAdd){
    $addEvent = $dbh->prepare('INSERT INTO testevent_table(eventDate,eventText) VALUES(:eventDate,:eventText)');
    $addEvent->bindValue(':eventDate',$_POST['eventDate'],PDO::PARAM_STR);
    $addEvent->bindValue(':eventText',$_POST['eventText'],PDO::PARAM_STR);
    $addEvent->execute();
    echo "イベント登録 した。";
    header("Location: " . $_SERVER['PHP_SELF']);
    }else{
    $addEvent = $dbh->prepare('UPDATE testevent_table SET eventText = :eventText WHERE eventDate = :eventDate');
    $addEvent->bindValue(':eventDate',$_POST['eventDate'],PDO::PARAM_STR);
    $addEvent->bindValue(':eventText',$_POST['eventText'],PDO::PARAM_STR);
    $addEvent->execute();
         echo "更新";
         header("Location: " . $_SERVER['PHP_SELF']);
         exit();
         
    }
}

    echo "\$date(for文で繰り返して取得されている)<br>";
for($day = 1; $day <= $day_count; $day++, $youbi++){//1から、その月の日数まで
    $day=str_pad($day, 2, 0, STR_PAD_LEFT);
    echo $day."dayです<br>";
    $haveEvent = false;
    $date = $ym . '-' . $day; //年年年年-月月-日日
    echo $date."<br>";

    foreach($eventList as $event){//入ってるeventの配列回し用
        if ($event['date'] == $date){
            $haveEvent = true;//その日のイベントがあれば真に
        }
    }

    if($today == $date && $haveEvent){
        $week .= '<td class="todayEvent">' . $day;
    }else if($today == $date){
        
        $week .= '<td class="today">' . $day;//今日の場合はclassにtodayをつける

    }else if ($haveEvent){
        $week .= '<td class="haveEvent">' . $day;
    }
     else {
        $week .= '<td>'.$day;
    }
    $week .= '</td>';
    
    if($youbi % 7 == 6 || $day == $day_count){//週終わり、月終わりの場合
        //土曜日が６になるから土曜になったらひっかかる
        
        if($day == $day_count){//月の最終日、空セルを追加
            //月曜ならyoubiは１だから 5個空のセルができる 日月空空空空空 的な
            $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
        }
        
        $weeks[] = '<tr>' . $week . '</tr>'; //weeks配列にtrと$weekを追加
        //一か月分の配列を<tr>にまとめてる

        $week = '';//weekをリセット,もう今月はweeksに入れてるから消しても内容は保持されてる
    }
}
    
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>PHPカレンダー</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> -->
    <style>
      .container {
        font-family: 'Noto Sans', sans-serif;
        /*--GoogleFontsを使用--*/
          /* margin-top: 80px; */
          /* height: 600px;
          width: 300px; */
      }

        tr {
            height: 3px;
            text-align: center;
        }
        td {
            height: 10px;
            width: 10px;
        }
        .today {
            background: orange;/*--日付が今日の場合は背景オレンジ--*/
        }
        .todayEvent {
            background: purple;/*--日付が今日の場合は背景オレンジ--*/
        }
        .haveEvent {
            background: greenyellow;/*--日付が今日の場合は背景オレンジ--*/
        }
        th:nth-of-type(1), td:nth-of-type(1) {/*--日曜日は赤--*/
            color: red;
        }
        th:nth-of-type(7), td:nth-of-type(7) {/*--土曜日は青--*/
            color: blue;
        }

        .border {
            border: solid 3px #555555;
            display: flex;
            width: 900px;
            height: 500px;
        }

        .eventForm {
            margin-top: 50px;
            margin-left: 20px;
        }

        .eventForm > form {
            display: flex;
            flex-direction: column;
        }

        textarea{
            resize: none;
        }
        .eventBoard{
            margin-left: 8px;
            margin-top: 10px;
        }


    </style>
</head>
<body>
    <h2>カレンダー作製所</h2>
    <div class="border">
        <div class="container">
            <h4><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h4>
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
            <div class="eventForm">
                <form method="post" action="">
                    <input type="date" name="eventDate">
                    <textarea name="eventText" cols="40" rows="10"></textarea>
                    <input type="submit" value="追加">
                </form>
            </div>

            <div class="eventBoard">
                    <h3>予定だよ</h3>
                    <?PHP foreach($eventList as $event){//入ってるeventの配列回し用
                    $formatDate=date("m月j日", strtotime($event['date']));
                    echo "・",$formatDate.":".$event['Text'].
                    "<form method=post>
                    <input type='hidden' name='deleteDate' value={$event['date']}>
                    <input type='submit' value='終わった。'>
                    </form>"
                    ;

    }?>
            </div>
    </div>
        
</body>
</html>