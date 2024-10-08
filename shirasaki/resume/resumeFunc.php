<?PHP 
function resumeSave($dbh,$getSuccess,$id){  //dbhのインスタンス,getSuccessがtrueならもうその人のデータがあるってこと
    if($getSuccess==false){//まだその人のデータがないとき    
        $resumeSave = $dbh->prepare('INSERT INTO resume_table(stu_id,reazon,pr,skill) VALUES(:stu_id,:reazon,:pr,:skill)');
        $resumeSave->bindValue(':stu_id',$id,PDO::PARAM_STR);//テストで１をいれてる、STUID
        $resumeSave->bindValue(':reazon',$_POST['reazon'],PDO::PARAM_STR);
        $resumeSave->bindValue(':pr',$_POST['pr'],PDO::PARAM_STR);
        $resumeSave->bindValue(':skill',$_POST['skill'],PDO::PARAM_STR);
        $resumeSave->execute();
        echo "<h4>保存しました</h4>";
        }else{
        $resumeSave = $dbh->prepare('UPDATE resume_table SET reazon = :reazon,pr = :pr,skill = :skill where stu_id = :stu_id');
        $resumeSave->bindValue(':stu_id',$id,PDO::PARAM_STR);//テストで１をいれてる、STUID
        $resumeSave->bindValue(':reazon',$_POST['reazon'],PDO::PARAM_STR);
        $resumeSave->bindValue(':pr',$_POST['pr'],PDO::PARAM_STR);
        $resumeSave->bindValue(':skill',$_POST['skill'],PDO::PARAM_STR);
        $resumeSave->execute();
        echo "<h4>変更しました</h4>";
        }
}

function qualAdd($dbh,$qualName,$qualTime,$id){//その人のID、資格名でデータを登録します
    $qualTime=date("Y年m月", strtotime($qualTime));
    $qualAdd = $dbh->prepare('INSERT INTO qual_table(stu_id,qual_name,qual_time) VALUES(:stu_id,:qual_name,:qual_time)');
    $qualAdd->bindValue(':stu_id',$id,PDO::PARAM_STR);
    $qualAdd->bindValue(':qual_name',$qualName,PDO::PARAM_STR);
    $qualAdd->bindValue(':qual_time',$qualTime,PDO::PARAM_STR);
    $qualAdd->execute();
    echo "<h4>保存しました</h4>";
}

function historyAdd($dbh,$historyName,$historyTime,$id){//その人のID、歴名でデータを登録します
    $historyTime=date("Y年m月", strtotime($historyTime));
    $historyAdd = $dbh->prepare('INSERT INTO history_table(stu_id,history_name,history_time) VALUES(:stu_id,:history_name,:history_time)');
    $historyAdd ->bindValue(':stu_id',$id,PDO::PARAM_STR);
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
//ここから画像の処理系
//ファイル名を元に拡張子を返す関数
function getExtension(string $file):string
{
    return pathinfo($file,PATHINFO_EXTENSION);
}

//アップロードファイルの妥当性チェックの関数
function validate(): array
{   
    if($_FILES['img']['error'] !== UPLOAD_ERR_OK){
        return [false,'アップロードエラーっす。'];
    }

    if(!in_array(getExtension($_FILES['img']['name']),['jpg','jpeg','png','gif'])){
        return [false,'画像ファイルにしろください'];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo,$_FILES['img']['tmp_name']);
    finfo_close($finfo);
    if(!in_array($mimeType,['image/jpeg','image/png','image/gif'])){
        return [false,'不正な画像ファイル型式っす'];
    }
    
    if(filesize($_FILES['img']['tmp_name'])>1024*1024*2){
        return [false,'ファイルサイズは2MB以内にしよう。'];
    }

    return[true,null];
}

//アップロード後のファイル名を生成して返す関数
function generateDestinationPath():string
{
    return 'uploaded/'.date('Yms-His-').rand(10000,99999).'.'.
    getExtension($_FILES['img']['name']);
}

//HTMLエンティティに変換する変数
function escape(string $value):string
{
    return htmlspecialchars($value,ENT_QUOTES | ENT_HTML5,'UTF-8');
}

function imgUpload($dbh,$id){
    list($result,$message) = validate();
    if($result != true){
        echo '[Error]',$message;
        return;
    }
    $distoinationPath = generateDestinationPath();
    $moved = move_uploaded_file($_FILES['img']['tmp_name'],$distoinationPath);
    if($moved != true){
        echo 'アップロード中にエラーが発生しました。';
        return;
    }

    $imgSave = $dbh->prepare('UPDATE resume_table SET photoID = :photoID where stu_id = :stu_id');
    $imgSave->bindValue(':stu_id',$id,PDO::PARAM_STR);//テストで１をいれてる、STUID
    $imgSave->bindValue(':photoID',$distoinationPath,PDO::PARAM_STR);
    $imgSave->execute();
    echo "<h4>画像保存しました</h4>";
    // echo "<p>アップロードに成功しました,保存された画像は以下です。</p>";
    // echo "<img src={$distoinationPath} style='width:300px'><br>";
    // echo "(保存ファイル名:{$distoinationPath})";
    // echo "(元のファイル名:{$_FILES['img']['name']})";
    
}