<?PHP 
function getUser($id,$dbh){
    $sql = "SELECT * FROM student_table WHERE stu_id = :stu_id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':stu_id' => $id]);
    $user=[];
    foreach($stmt as $row){
        $user['name'] = $row['stu_name'];
        $user['address'] = $row['stu_address'];
        $user['school'] = $row['stu_school'];
        $user['tell'] = $row['stu_tell'];
        $user['mail'] = $row['stu_mail'];
        $user['pass'] = $row['stu_pass'];
        $user['birth'] = $row['birth'];
        
        // $_SESSION['name'] = $user['stu_name'];
        // $_SESSION['address'] = $user['stu_address'];
        // $_SESSION['school'] = $user['stu_school'];
        // $_SESSION['tell'] = $user['stu_tell'];
        // $_SESSION['mail'] = $user['stu_mail'];
        // $_SESSION['pass'] = $user['stu_pass'];
    }
    return $user;
}

function getCompany($id,$dbh){
    $sql = "SELECT * FROM company_table WHERE com_id = :com_id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':com_id' => $id]);
    $com=[];
    foreach($stmt as $row){
        $com['name'] = $row['com_name'];
        $com['address'] = $row['com_address'];
        $com['tell'] = $row['com_tell'];
        $com['mail'] = $row['com_mail'];
        $com['pass'] = $row['com_pass'];
        // $_SESSION['name'] = $user['com_name'];
        // $_SESSION['address'] = $user['com_address'];
        // $_SESSION['tell'] = $user['com_tell'];
        // $_SESSION['mail'] = $user['com_mail'];
        // $_SESSION['pass'] = $user['com_pass'];
    }
    return $com;
}


function login($dbh){
    if(isset($_SESSION['user_id'])){
         return getUser($_SESSION['user_id'],$dbh);
    }else if(isset($_SESSION['com_id'])){
        return getCompany($_SESSION['com_id'],$dbh);
    }else{
       echo "不正なログインだこれ！(発覚)";
    header('Location:\otofu\Oto-fu\fujii\login.php');
    exit;
    }
}

function destoroy(){
    if(isset($_SESSION['user_id'])){
        unset($_SESSION['user_id']);
   }else if(isset($_SESSION['com_id'])){
       unset($_SESSION['com_id']);
   }
}


?>