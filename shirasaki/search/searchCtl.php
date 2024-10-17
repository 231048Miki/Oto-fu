<?PHP
    function search($keyword,$dbh){
        $get = $dbh->prepare('SELECT * FROM company_table,cominfo_table WHERE com_name LIKE :com_name AND company_table.com_id = cominfo_table.com_id');
        $get->bindValue(':com_name',$keyword."%",PDO::PARAM_STR);
        $get->execute();
        echo"<ul>";
        while($com = $get->fetch(PDO::FETCH_ASSOC)){
            echo "<li><a href='#'>".$com['com_name']."</a>";//企業ページできたらここに遷移先を記入
            echo "<br><b>企業理念：".$com['com_rinen']."</b></li><br>";
        };
        echo"</ul>";
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
                echo "<p>・{$tags[$count][1]}<input type='checkbox' name='tags[]' value='{$tags[$count][0]}'></p>";

                $count = $count + 1;   
        }
    }

    function outputTagsName($tags,$dbh){//タグのIDを配列で入れる、その名前を表示関数
        foreach($tags as $tag){
        $get = $dbh->prepare('SELECT * FROM tag_table WHERE tag_id = :tag_id');
        $get->bindValue(':tag_id',$tag,PDO::PARAM_STR);
        $get->execute();
        while($tag = $get->fetch(PDO::FETCH_ASSOC)){
          echo $tag['tag_name'];
          echo "<br>";
        };
    }
    }

    function searchComOnTag($dbh,$tagIDs){//tagIDs[tagID,tagID,tagID]を受け取る
        $result = []; //結果（会社のID）格納用
        $searchSQLs = []; 
        foreach($tagIDs as $tagID){//受け取ったIDで加工したSQL文を作製し、配列に入れる
            $sql = "SELECT com_id  FROM selecttags WHERE tag_id = ".$tagID;
            array_push($searchSQLs,$sql);
        }
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

    function searchByComId($dbh,$comIDs){
        echo "<ul>";
        foreach($comIDs as $comID){
            $get = $dbh->prepare('SELECT * FROM company_table,cominfo_table WHERE company_table.com_id = :com_id AND company_table.com_id = cominfo_table.com_id');
            $get->bindValue(':com_id',$comID,PDO::PARAM_INT);
            $get->execute();
            $com = $get->fetch(PDO::FETCH_ASSOC);
                echo "<li><a href='#'>".$com['com_name']."</a>";
                echo "<br><b>企業理念：".$com['com_rinen']."</b></li><br>";
        }
        echo"</ul>";
    }
?>