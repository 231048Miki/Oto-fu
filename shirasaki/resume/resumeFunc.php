<?PHP 
function resumeSave($dbh,$getSuccess){  //dbhのインスタンス,getSuccessがtrueならもうその人のデータがあるってこと
    if($getSuccess==false){//まだその人のデータがないとき    
        $resumeSave = $dbh->prepare('INSERT INTO resume_table(stu_id,reazon,pr,skill) VALUES(:stu_id,:reazon,:pr,:skill)');
        $resumeSave->bindValue(':stu_id',1,PDO::PARAM_STR);//テストで１をいれてる、STUID
        $resumeSave->bindValue(':reazon',$_POST['reazon'],PDO::PARAM_STR);
        $resumeSave->bindValue(':pr',$_POST['pr'],PDO::PARAM_STR);
        $resumeSave->bindValue(':skill',$_POST['skill'],PDO::PARAM_STR);
        $resumeSave->execute();
        echo "<h4>保存しました</h4>";
        }else{
        $resumeSave = $dbh->prepare('UPDATE resume_table SET reazon = :reazon,pr = :pr,skill = :skill where stu_id = :stu_id');
        $resumeSave->bindValue(':stu_id',1,PDO::PARAM_STR);//テストで１をいれてる、STUID
        $resumeSave->bindValue(':reazon',$_POST['reazon'],PDO::PARAM_STR);
        $resumeSave->bindValue(':pr',$_POST['pr'],PDO::PARAM_STR);
        $resumeSave->bindValue(':skill',$_POST['skill'],PDO::PARAM_STR);
        $resumeSave->execute();
        echo "<h4>変更しました</h4>";
        }
}

function qualAdd($dbh,$qualName,$qualTime){//その人のID、資格名でデータを登録します
    $qualTime=date("Y年m月", strtotime($qualTime));
    $qualAdd = $dbh->prepare('INSERT INTO qual_table(stu_id,qual_name,qual_time) VALUES(:stu_id,:qual_name,:qual_time)');
    $qualAdd->bindValue(':stu_id',1,PDO::PARAM_STR);
    $qualAdd->bindValue(':qual_name',$qualName,PDO::PARAM_STR);
    $qualAdd->bindValue(':qual_time',$qualTime,PDO::PARAM_STR);
    $qualAdd->execute();
    echo "<h4>保存しました</h4>";
}

function historyAdd($dbh,$historyName,$historyTime){//その人のID、歴名でデータを登録します
    $historyTime=date("Y年m月", strtotime($historyTime));
    $historyAdd = $dbh->prepare('INSERT INTO history_table(stu_id,history_name,history_time) VALUES(:stu_id,:history_name,:history_time)');
    $historyAdd ->bindValue(':stu_id',1,PDO::PARAM_STR);
    $historyAdd ->bindValue(':history_name',$historyName,PDO::PARAM_STR);
    $historyAdd ->bindValue(':history_time',$historyTime,PDO::PARAM_STR);
    $historyAdd->execute();
    echo "<h4>保存しました</h4>";
}

function getQual($dbh,$id){//IDを入れるとそいつの資格を表示します
    $get = $dbh->prepare('SELECT * FROM qual_table WHERE stu_id = :stu_id');
    $get -> bindValue(':stu_id',$id,PDO::PARAM_STR);
    $get->execute();
    echo"<ul>";
    while($qual = $get->fetch(PDO::FETCH_ASSOC)){
        echo"<li><div class='flex'>".$qual['qual_name']."　".$qual['qual_time'].
        "<form method='post' action=''>
        <input type='hidden' value={$qual['qual_id']} name='qdl'>
        <input type='submit' value='削除'></form>
        </div></li>";
    };
    echo"</ul>";
}

function getHistory($dbh,$id){//IDを入れるとそいつの歴を表示します
    $get = $dbh->prepare('SELECT * FROM history_table WHERE stu_id = :stu_id');
    $get -> bindValue(':stu_id',$id,PDO::PARAM_STR);
    $get->execute();
    echo"<ul>";
    while($his = $get->fetch(PDO::FETCH_ASSOC)){
        echo "<li><div class='flex'>".$his['history_name']."　".$his['history_time'].
        "<form method='post' action=''>
        <input type='hidden' value={$his['history_id']} name='hdl'>
        <input type='submit' value='削除'></form>
        </div></li>";
    };
    echo"</ul>";
}

function deleteQual($dbh,$qId){ //そのIDの資格を消します
 $delete = $dbh->prepare('DELETE FROM qual_table WHERE qual_id = :qual_id');
 $delete -> bindValue(':qual_id',$qId,PDO::PARAM_STR);
 $delete->execute();
}

function deleteHitory($dbh,$hId){  //そのIDの歴を消します
 $delete = $dbh->prepare('DELETE FROM history_table WHERE history_id = :history_id');
 $delete -> bindValue(':history_id',$hId,PDO::PARAM_STR);
 $delete->execute();
}