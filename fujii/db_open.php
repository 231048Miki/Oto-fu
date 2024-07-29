<?php
    // データベース接続情報
    $dbserver = "localhost";
    $dbname = "otofu_mydb";
    $dbuser = "fujii231109_user";
    $dbpasswd = "f21053879i";

    // PDOオプション
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // エラーモードを例外に設定
        PDO::ATTR_EMULATE_PREPARES => false, // プリペアドステートメントのエミュレーションを無効化
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false, // 複数のステートメントを無効化
    ];

    // データソースネーム (DSN)
    $dsn = "mysql:host=$dbserver;dbname=$dbname;charset=utf8";

    // 接続の確立
    try {
        $pdo = new PDO($dsn, $dbuser, $dbpasswd, $opt);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // デフォルトのフェッチモードを連想配列に設定
        echo "データベース接続が正常に確立されました。";
    } catch (PDOException $e) {
        echo "接続に失敗しました: " . $e->getMessage();
    }

    // グローバル変数 $dbh の設定
    global $dbh;
    $dbh = $pdo;
?>
