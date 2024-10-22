<?php
include '../db_open.php';
//trust me
$resume_id = $_GET["resume_id"];
$sql = "SELECT reazon, pr, skill FROM resume_table WHERE resume_id = $resume_id";
$sql_res = $dbh->query($sql);
$rec = $sql_res->fetch();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>履歴書詳細</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fafafa;
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
            padding: 30px;
            max-width: 600px;
            width: 100%;
        }
        h1 {
            font-size: 1.8em;
            color: #0078D7;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 10px;
        }
        .section p {
            font-size: 1em;
            color: #555;
            line-height: 1.6;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
        }
        footer {
            margin-top: 20px;
            font-size: 0.8em;
            text-align: center;
            color: #aaa;
        }
    </style>
</head>
<body>
    <main>
        <h1>履歴書ID: <?php echo $resume_id; ?></h1>
        
        <div class="section">
            <h2>志望動機</h2>
            <p><?php echo htmlspecialchars($rec['reazon']); ?></p>
        </div>

        <div class="section">
            <h2>自己PR</h2>
            <p><?php echo htmlspecialchars($rec['pr']); ?></p>
        </div>

        <div class="section">
            <h2>趣味・特技</h2>
            <p><?php echo htmlspecialchars($rec['skill']); ?></p>
        </div>

        <footer>
            © 2024 豆腐テクノロジーズ
        </footer>
    </main>
</body>
</html>
