<?PHP 
   require("searchCtl.php"); 
   require("../../db_open.php"); 
   session_start();
   $comID = $_SESSION['com_id'];//会社のID
   function ShowHaveTags($dbh,$comID){
    $tags= []; //取り出したタグ格納用変数
    $sql =  $dbh->prepare('SELECT tag_name FROM tag_table inner join selecttags on tag_table.tag_id = selecttags.tag_id where com_id = :com_id');
    $sql->bindValue(':com_id',$comID,PDO::PARAM_INT);
    $sql->execute();
    while($tag = $sql->fetch(PDO::FETCH_ASSOC)){
        array_push($tags,$tag["tag_name"]);
    };
    return $tags;
   }
   function tagAdd($dbh,$tags,$comID){
    //$tagsはタグのIDが入った配列
        //更新するので一度その会社のタグを全消す
        $sql =  $dbh->prepare('DELETE FROM selecttags WHERE com_id = :com_id');
        $sql->bindValue(':com_id',$comID,PDO::PARAM_INT);
        $sql->execute();
    //その後選ばれたタグを全てselecttagsテーブルに追加
    foreach($tags as $tag_id){
        $sql = $dbh->prepare('INSERT INTO selecttags (com_id,tag_id) VALUES(:com_id,:tag_id)');
        $sql->bindValue(':com_id',$comID,PDO::PARAM_INT);
        $sql->bindValue(':tag_id',$tag_id,PDO::PARAM_INT);
        $sql->execute();
    }
   }

   if(isset($_POST['tags'])){
    tagAdd($dbh,$_POST['tags'],$comID);
   }

   $tags = ShowHaveTags($dbh,$comID);

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    </head>
    <body>
        <h2>タグ更新</h2>
        <button class="" onclick="location.href='../../iizuka/php/com_top.php'">戻る</button>
        <h3>今使ってるタグ一覧でごわす</h3>
        <ul>
        <?php 
        foreach($tags as $tag){
            echo "<li>".$tag."</li>";
        }
        ?>
        </ul>
        <form method="post" action="">
                <?php   //選ばれたタグのIDを送信するフォーム 
                makeTagForm($dbh); ?>
                <input type="submit" id="btn" value="タグ更新">
        </form>
    </body>
    <script>
        const btn = document.getElementById('btn');
        btn.addEventListener('click',()=>{
            alert('タグを更新したぜヒャッハー！');
        });
    </script>
</html>
