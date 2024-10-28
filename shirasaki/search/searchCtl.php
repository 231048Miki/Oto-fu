<?PHP
    function search($keyword,$dbh,$startNo){//キーワードとPDOと開始位置入れて、そのキーワードを含む企業を返す関数
        $result = [];//結果格納用
        //  24こで画面いっぱいになるからlimitで制限、その場合次ページの遷移先を配置
        $get = $dbh->prepare('SELECT * FROM company_table,cominfo_table WHERE com_name LIKE :com_name AND company_table.com_id = cominfo_table.com_id AND company_table.com_id > :startNo ORDER BY cominfo_table.com_id ASC limit 24');
        $get->bindValue(':com_name',$keyword."%",PDO::PARAM_STR);
        $get->bindValue(':startNo',$startNo,PDO::PARAM_INT);
        $get->execute();
        while($com = $get->fetch(PDO::FETCH_ASSOC)){
            // echo "<li><a href='#'>".$com['com_name']."</a>";//企業ページできたらここに遷移先を記入
            // echo "<br><b>企業理念：".$com['com_rinen']."</b></li><br>";
            array_push($result,[$com['com_id'],$com['com_name'],$com['com_rinen']]);
        };
        // var_dump($result);
        echo "<ul>";
        for($i=0;$i<count($result);$i++){
            if($i != 0 && $i % 8 == 0 ){
                echo "</ul><ul>";
            }
            echo "<li><div class='flex'><a href='../../iizuka/php/detail.php?id={$result[$i][0]}'>".$result[$i][1]."</a>";
            echo "<form method='get' action=''>";
            echo "<input type='hidden' name='likeId' value='{$result[$i][0]}'>";
            echo "<input type='submit' class='hoshi' id='{$result[$i][0]}' value='送信'>";
            starColorCtl($dbh,$_SESSION['user_id'],$result[$i][0]);
            echo "</form></div>";
            echo  "<b>企業理念：".$result[$i][2]."</b></li><br>";

            if($i == 23){
                echo "<a href='?startNo={$result[$i][0]}'> >> </a>";
            }
        }
        echo "<a href='?startNo=0' style='margin-left:30px'> 先頭へ </a>";
        echo "</ul>";
    }

    function makeTagForm($dbh){//タグ全部取得、それらのIDをvalueにしたinput要素を召喚関数
        $get = $dbh->prepare('SELECT * FROM tag_table');
        $get->execute();
        $tags=[];
        while($tag = $get->fetch(PDO::FETCH_ASSOC)){
            array_push($tags,[$tag['tag_id'],$tag['tag_name']]);
        };
        $total = count($tags);//タグ全部の数
        // var_dump($total);
        $count = 0;
        while($count < $total){
                echo "<p>・{$tags[$count][1]}<input type='checkbox' onchange='change()' id='tag' name='tags[]' value='{$tags[$count][0]}'></p>";

                $count = $count + 1;   
        }
    }

    function outputTagsName($tags,$dbh){//タグのIDを配列で入れる、その名前を表示関数
        foreach($tags as $tag){
        $get = $dbh->prepare('SELECT * FROM tag_table WHERE tag_id = :tag_id');
        $get->bindValue(':tag_id',$tag,PDO::PARAM_STR);
        $get->execute();
        echo "<ul>";
        while($tag = $get->fetch(PDO::FETCH_ASSOC)){
          echo "<li>";
          echo $tag['tag_name'];
          echo "</li>";
        };
        echo "</ul>";
    }
    }

    function searchComOnTag($dbh,$tagIDs){//tagIDs[tagID,tagID,tagID]を受け取る
        $result = []; //結果（会社のID）格納用
        $searchSQLs = []; 
        foreach($tagIDs as $tagID){//受け取ったIDで加工したSQL文を作製し、配列に入れる
            $sql = "SELECT com_id  FROM selecttags WHERE tag_id = ".$tagID;
            array_push($searchSQLs,$sql);
        }
        // var_dump($searchSQLs);
        $sql ="";
        for($i=0;$i<count($searchSQLs);$i++){//$sql変数に作ったSQL達をつなげて融合
                if($i == 0){
                    $sql = $sql . $searchSQLs[$i];
                }else{
                    $sql = $sql." INTERSECT ".$searchSQLs[$i];
                }
        }   
        $search = $dbh->prepare($sql);//最終的にできたsqlを呼び出して全てのタグに一致する会社のIDを取得
        $search->execute();
        while($getID = $search->fetch(PDO::FETCH_ASSOC)){
            array_push($result,$getID['com_id']);
        }
        return $result;
    }

    function searchByComId($dbh,$comIDs,$startNo){
        $result = [];//結果格納用
        foreach($comIDs as $comID){
            $get = $dbh->prepare('SELECT * FROM company_table,cominfo_table WHERE company_table.com_id = :com_id AND company_table.com_id = cominfo_table.com_id AND company_table.com_id > :startNo ORDER BY cominfo_table.com_id ASC limit 24');
            $get->bindValue(':com_id',$comID,PDO::PARAM_INT);
            $get->bindValue(':startNo',$startNo,PDO::PARAM_INT);
            $get->execute();
            $com = $get->fetch(PDO::FETCH_ASSOC);
            array_push($result,[$com['com_id'],$com['com_name'],$com['com_rinen']]);
        }

            echo "<ul>";
            for($i=0;$i<count($result);$i++){
                if($i != 0 && $i % 8 == 0 ){
                    echo "</ul><ul>";
                }
                echo "<li><div class='flex'><a href='../../iizuka/php/detail.php?id={$result[$i][0]}'>".$result[$i][1]."</a>";
                echo "<form method='get' action=''>";
                echo "<input type='hidden' name='likeId' value='{$result[$i][0]}'>";
                echo "<input type='submit' class='hoshi' id='{$result[$i][0]}' value='送信'>";
                starColorCtl($dbh,$_SESSION['user_id'],$result[$i][0]);
                echo "</form></div>";
                echo  "<br><b>企業理念：".$result[$i][2]."</b></li><br>";
                
                // echo "<li><div class='flex'><a href='../../iizuka/php/detail.php?com_id={$result[$i][0]}'>".$result[$i][1]."</a>";
                // echo "<form method='get' action=''>";
                // echo "<input type='hidden' name='likeId' value='{$result[$i][0]}'>";
                // echo "<input type='submit' class='hoshi' id='{$result[$i][0]}' value='送信'>";
                // starColorCtl($dbh,$_SESSION['user_id'],$result[$i][0]);
                // echo "</form></div>";
                // echo  "<b>企業理念：".$result[$i][2]."</b></li><br>";
                if($i == 23){
                    echo "<a href='?startNo={$result[$i][0]}'> >> </a>";
                }
            }
            echo "<a href='?startNo=0' style='margin-left:30px'> 先頭へ </a>";
            echo "</ul>";
        //     $com = $get->fetch(PDO::FETCH_ASSOC);
        //         echo "<li><a href='../../iizuka/php/detail.php?com_id={$com['com_id']}'>".$com['com_name']."</a>";
        //         echo "<br><b>企業理念：".$com['com_rinen']."</b></li><br>";
        // echo"</ul>";
    }

    function addLike($dbh,$stuID,$comID){
        $get = $dbh->prepare('INSERT INTO likes_table (stu_id,com_id,check_flag) VALUES (:stu_id,:com_id,1)');
        $get->bindValue(':stu_id',$stuID,PDO::PARAM_INT);
        $get->bindValue(':com_id',$comID,PDO::PARAM_INT);
        $get->execute();
    }

    function removeLike($dbh,$stuID,$comID){
        $get = $dbh->prepare('DELETE FROM likes_table  WHERE stu_id = :stu_id and com_id = :com_id');
        $get->bindValue(':stu_id',$stuID,PDO::PARAM_INT);
        $get->bindValue(':com_id',$comID,PDO::PARAM_INT);
        $get->execute();
    }

    function likeCtl($dbh,$stuID,$comID){
        $get = $dbh->prepare('SELECT * FROM likes_table WHERE stu_id = :stu_id and com_id = :com_id');
        $get->bindValue(':stu_id',$stuID,PDO::PARAM_INT);
        $get->bindValue(':com_id',$comID,PDO::PARAM_INT);
        $get->execute();
        $check = $get->fetch();
        if($check){
            removeLike($dbh,$stuID,$comID);
        }else{
            addLike($dbh,$stuID,$comID);
        }
    };

    function starColorCtl($dbh,$stuID,$comID){
        $get = $dbh->prepare('SELECT * FROM likes_table WHERE stu_id = :stu_id and com_id = :com_id');
        $get->bindValue(':stu_id',$stuID,PDO::PARAM_INT);
        $get->bindValue(':com_id',$comID,PDO::PARAM_INT);
        $get->execute();
        $check = $get->fetch();
        if($check){
            echo "<label for='$comID'>★</label>";
        }else{
            echo "<label for='$comID'>☆</label>";
        }
    }
?>