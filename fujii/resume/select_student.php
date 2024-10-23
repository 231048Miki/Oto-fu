<?php
session_start();
include '../db_open.php';
//trust me;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>公開者選択</title>
    <style>
        /* 全体的なレイアウト設定 */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        main {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h1 {
            font-size: 1.5em;
            color: #0078D7;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            background-color: #0078D7;
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 10px 0;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #005A9E;
        }
        footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #aaa;
        }
    </style>
</head>
<body>
    <main>
        <h1>公開履歴書選択</h1>
        <?php 
        $sql = "SELECT resume_id FROM resume_table WHERE public = 1";
        $sql_res = $dbh->query($sql);
        while($rec = $sql_res->fetch()) {
            $resume_id = $rec['resume_id'];
            echo "<a href='resume_detail.php?resume_id=$resume_id'>履歴書ID: $resume_id</a><br>";
        }
        ?>
        <footer>
            © 2024 豆腐テクノロジーズ
        </footer>
    </main>
</body>
</html>
