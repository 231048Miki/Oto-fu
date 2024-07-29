<?php
    include  "db_open.php";
    $sql = 'SELECT * From ngword_table'; //クエリに書く処理

    $sql_res = $dbh->query($sql); //「さっき書いた処理をdbのクエリに入れる」をひとまとめに

    while($record = $sql_res->fetch()){ //->fetchで1行ずつ取り出してなくなるまで繰り返し
        // var_dump($record);
        echo "NGワード".$record["ngword_id"].":". $record["ngword"]."<br>";
            //取り出したdbのデータは多次元配列に入ってて[列名]でも[数字]でも呼べる
    }