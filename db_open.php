<?php
    $dbserver = "localhost";
    $dbname = "otofu_mydb";
    $dbuser = "";
    $dbpasswd = "";

    global $dbh;
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ];
    $dns = "mysql:host=$dbserver;dbname=$dbname;charset=utf8";
            $pdo = new PDO($dns, $dbuser, $dbpasswd, [
                PDO::ATTR_ERRMODE =>
                PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
    $dbh = new PDO('mysql:host=' . $dbserver . ';dbname='.$dbname,
    $dbuser, $dbpasswd, $opt );
    # var_dump($dbh);