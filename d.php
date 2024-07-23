<?PHP
    $dbserver = "localhost";
   # $dbserver = "mysql1.php.starfree.ne.jp";
    $dbname = "test";
    $dbuser = "pojobot_user";
    $dbpasswd = "Hirata317";

    $opt = [ //db操作の設定
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//エラー処理
        PDO::ATTR_EMULATE_PREPARES => false,//エミュレータ使用する？
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,//マルチクエリ使う？
    ];

    $dbh = new PDO('mysql:host=' .$dbserver . ';dbname='.$dbname,
    $dbuser,$dbpasswd,$opt);      //db取得してインスタンス作成的な
    # var_dump($dbh);

    $sql = 'SELECT * From test'; //クエリに書く処理

    $sql_res = $dbh->query($sql); //「さっき書いた処理をdbのクエリに入れる」をひとまとめに

    while($record = $sql_res->fetch()){ //->fetchで1行ずつ取り出してなくなるまで繰り返し
        // var_dump($record);
        // echo "<br>";
        echo "<p>{$record['name']}     
            {$record['pass']}</p>";
            //取り出したdbのデータは多次元配列に入ってて[列名]でも[数字]でも呼べる
    }