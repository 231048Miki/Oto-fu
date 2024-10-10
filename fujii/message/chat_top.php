<?php
include '../db_open.php';
session_start();

// SQLクエリを実行し、リンクを生成する関数
function generateLinks($table, $idColumn, $nameColumn, $additionalInfo = '') {
    global $dbh; // $dbhを関数内で使用するためにglobal宣言
    $sql = "SELECT * FROM $table";
    $sql_res = $dbh->query($sql);
    
    echo "<div class='chat-list'>";  // CSSでデザインするためのクラス
    while ($rec = $sql_res->fetch()) {
        $id = htmlspecialchars($rec[$idColumn], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($rec[$nameColumn], ENT_QUOTES, 'UTF-8');
        $info = htmlspecialchars($additionalInfo ? $rec[$additionalInfo] : '', ENT_QUOTES, 'UTF-8');
        
        echo "<div class='chat-item'>";  // 個々のチャットリンク用のコンテナ
        echo "<div class='chat-id'>ID: $id</div>";
        echo "<div class='chat-name'>Name: $name</div>";
        if ($info) {
            echo "<div class='chat-info'>School: $info</div>";  // 学校情報を表示する場合
        }
        echo "<a class='chat-link' href='message.php?user_id=$id'>Start Chat</a>";  // チャットリンク
        echo "</div>";
    }
    echo "</div>";
}

// 学生か企業かで表示内容を切り替え
if (isset($_SESSION['stu_id'])) {
    // 企業のリストを表示
    generateLinks('company_table', 'com_id', 'com_name');
} else {
    // 学生のリストを表示
    generateLinks('student_table', 'stu_id', 'stu_name', 'stu_school');
}
?>

<!-- CSSファイルを読み込む -->
<link rel="stylesheet" type="text/css" href="../css/chat_top.css"> <!-- モバイル対応のCSS -->
