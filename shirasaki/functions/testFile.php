<?php 
    require("userCtlFunc.php");
    require("../../db_open.php");
    session_start();
    $user = getUser(3,$dbh);
    echo "ユーザーっす<br>";
    foreach($user as $info){
        echo $info."<br>";
    };
    echo "<br>";
    $com = getCompany(6,$dbh);
    echo "企業っす<br>";
    foreach($com as $info){
        echo $info."<br>";
    };
//    echo $_SESSION['name'] ;
//    echo $_SESSION['address'] ;
//    echo $_SESSION['school'] ;
//    echo $_SESSION['tell'] ;
//    echo $_SESSION['mail'] ;
//    echo $_SESSION['pass'] ;
?>