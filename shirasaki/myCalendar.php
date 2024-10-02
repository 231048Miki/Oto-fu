<?PHP 
require("../db_open.php");
require("xssBlock.php");
$eventList=[];

if(!isset($_SESSION['user_id'])){
    $_SESSION['user_id']=1;//テスト用後で消せ
}

//完了ボタン押した時用処理
if(isset($_POST['deleteDate'])){
    $delEvent = $dbh->prepare('DELETE FROM calendar_table WHERE eventDate = :eventDate AND stu_id = :stu_id');
    $delEvent->bindValue(':eventDate',$_POST['deleteDate'],PDO::PARAM_STR);
    $delEvent->bindValue(':stu_id',$_SESSION['user_id'],PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
    $delEvent->execute();
}

//$eventList[]にdbから取得したデータを格納、['data']と['Text']がキーになって一つの予定を構成している。
$getEventRec = $dbh->prepare('SELECT * FROM calendar_table WHERE stu_id = :stu_id');
$getEventRec->bindValue(':stu_id',$_SESSION['user_id'],PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
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



$timestamp = strtotime($ym . '-01'); //今月の一日をタイムスタンプで取得

if($timestamp === false){//エラー対策
    //falseが返ってきた時は、現在の年月・タイムスタンプを取得
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}


//今月の日付　フォーマット　例）2020-10-2
$today = date('Y-m-j');//YYYY-mm-j 


//カレンダーのタイトルを作成　例）2020年10月
$html_title = date('Y年n月', $timestamp);//date(表示する内容,基準)


//前月・次月の年月を取得、strotimeでUNIXタイムスタンプ型式にしてからdateでフォーマット
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));


//該当月の日数を取得
$day_count = date('t', $timestamp);//その月の日数


//１日が何曜日か
$youbi = date('w', $timestamp);//曜日番号0[日曜]-6[土曜]

//カレンダー作成の準備
$weeks = [];
$week = '';

//第１週目：空のセルを追加
//str_repeat(文字列, 反復回数),木曜なら４回的な、カレンダーの最初の空欄何個いるかってこと
$week .= str_repeat('<td></td>', $youbi);

//予定追加フォームに入力時、空なら追加埋まってたら変更する処理
if(isset($_POST['eventDate'])&&isset($_POST['eventText'])){
    $_POST['eventDate']=str2html($_POST['eventDate']);
    $_POST['eventText']=str2html($_POST['eventText']);
    $dbAdd=true;//追加と変更の判定flag的なもの
    $_POST['eventDate'] = date("Y-m-d",strtotime($_POST['eventDate']));//単なる型式変更

    foreach($eventList as $event){//入ってるeventの配列回し用、
        if($event['date']==$_POST['eventDate']){
            $dbAdd = false;
        }
    }
    //ここからdbへのsqlの処理
    if($dbAdd){
    $addEvent = $dbh->prepare('INSERT INTO calendar_table(stu_id,eventDate,eventText) VALUES(:stu_id,:eventDate,:eventText)');
    $addEvent->bindValue(':stu_id',$_SESSION['user_id'],PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
    $addEvent->bindValue(':eventDate',$_POST['eventDate'],PDO::PARAM_STR);
    $addEvent->bindValue(':eventText',$_POST['eventText'],PDO::PARAM_STR);
    $addEvent->execute();
    header("Location: " . $_SERVER['PHP_SELF']);
    }else{
    $updateEvent = $dbh->prepare('UPDATE calendar_table SET eventText = :eventText WHERE stu_id = :stu_id AND eventDate = :eventDate');
    $updateEvent->bindValue(':stu_id',$_SESSION['user_id'],PDO::PARAM_STR);//ユーザーIDを入れる、今はテストで１を入れている
    $updateEvent->bindValue(':eventDate',$_POST['eventDate'],PDO::PARAM_STR);
    $updateEvent->bindValue(':eventText',$_POST['eventText'],PDO::PARAM_STR);
    $updateEvent->execute();
         echo "更新";
         header("Location: " . $_SERVER['PHP_SELF']);
         exit();
         
    }
}

for($day = 1; $day <= $day_count; $day++, $youbi++){//1から、その月の日数まで
    $day=str_pad($day, 2, 0, STR_PAD_LEFT);
    $haveEvent = false;
    $date = $ym . '-' . $day; //年年年年-月月-日日

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
    <style>
      .container {
        font-family: 'Noto Sans', sans-serif;

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
            margin-top: 16px;
            margin-left: 5px;
            display: flex;
            /* background-color: lightcoral; */
            width: 400px;
            height: 250px;
            aspect-ratio: 5 / 3.8;

        }

        .eventForm {
            width: 200px;
            margin-left: 4px;
            display:none;
        }
        .show{
            display: block;
        }

        .eventForm > form {
            display: flex;
            flex-direction: column;
        }

        textarea{
            resize: none;
        }

        
        .eventBoard{
            /* display:none; */
            
            margin-left: 8px;
            margin-top: 10px;
        }
        .addTab{
            margin-top: 205px;
            text-align: center;
            width: 25px;
            height: 25px;
        }
        .calendarHeader{
            
        }
        #frame{
            display: flex;
        }
     
 




    </style>
</head>
<body>
<div id='frame'>
    <div class="border">
        <div class="container">
            <h4 class="calendarHeader"><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h4>
            <table class="table-bordered">

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
        <button class="addTab">+</button>
        <div class="eventBoard">
                    <?PHP 
                     $i = 1;
                     echo "-「直近の予定」-<br>";
                    foreach($eventList as $event){//入ってるeventの配列回し用
                    if($i>3){
                        echo "etc..";
                        break;
                    }
                    $formatDate=date("m月j日", strtotime($event['date']));
                    echo "・",$formatDate.":".$event['Text'].
                    "<form method=post>
                    <input type='hidden' name='deleteDate' value={$event['date']}>
                    <input type='submit' value='完了'>
                    </form>"
                    ;
                    $i++;
                    }?>
        </div>
    </div>
    <div class="eventForm">
        <form method="post" action="">
            <input type="date" name="eventDate">
            <textarea name="eventText" cols="40" rows="10"></textarea>
            <input type="submit" value="追加">
        </form>
    </div>
</div>

    <script>
        const addTab = document.getElementsByClassName('addTab');
        const eventForm = document.getElementsByClassName('eventForm');
        addTab[0].addEventListener('click',()=>{
            eventForm[0].classList.toggle('show');
        })
    </script>
</body>

</html>