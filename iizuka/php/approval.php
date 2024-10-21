<!DOCTYPE html>
<html>

<head>
    <meta charset="UUTF-8">
    <link rel="stylesheet" , href="../header.css">
    <link rel="stylesheet" , href="../css/approval.css">
    <meta name="viewport" content="width=device-width" />

    <title>企業承認ダミー</title>
</head>

<body>
    <header>
        <div class="header">
            <h2>
                <a href="../../komatsu/admintop.php" class="web-name">job hunting</a>
            </h2>
            <div class="menu">
                <a onclick="history.back(-1)" class="header-nav">戻る</a>
                <a href="logout.php" class="header-nav" id="logout">ログアウト</a>
            </div>
        </div>
    </header>

    <h2>企業承認画面</h2>

    <!-- データベース作ってwhileでできればよかった。ダミーデータです -->
    <div class="com">
        <p>株式会社梨</p>
        <p>登録日時:
            <a>2024/10/21</a>
            <input type="checkbox" class="check" id="check">
        </p>

    </div>

    <div class="com">
        <p>株式会社パイナップル</p>
        <p>登録日時:
            <a>2024/10/13</a>
            <input type="checkbox" class="check" id="check">
        </p>
    </div>

    <div class="com">
        <p>株式会社葡萄</p>
        <p>登録日時:
            <a>2024/10/11</a>
            <input type="checkbox" class="check" id="check">
        </p>
    </div>

</body>

</html>