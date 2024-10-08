<?PHP
    function search($keyword,$dbh){
        $get = $dbh->prepare('SELECT * FROM company_table,cominfo_table WHERE com_name LIKE :com_name AND company_table.com_id = cominfo_table.com_id');
        $get->bindValue(':com_name',$keyword."%",PDO::PARAM_STR);
        $get->execute();
        echo"<ul>";
        while($com = $get->fetch(PDO::FETCH_ASSOC)){
            echo "<li><a href='dami-.php'>".$com['com_name']."</a>";
            echo "<br><b>企業理念：".$com['com_rinen']."</b></li><br>";
        };
        echo"</ul>";
    }

    function getTag($dbh){
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

    function tagSearch($tags,$dbh){
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
?>