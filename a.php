<?php
    if($_SERVER["REQUEST_METHOD"] != "POST"){
    echo<<<___EOF___
    <form method="post">
        <label for="name">名前</label>
        <input type="text" name="name">
        <br>
        <label for="pass">パスワード</label>
        <input type="text" name="pass">
        <input type="submit" value="送信">
    </form>
    ___EOF___;
        
    }else {
        if(isset($_POST['name'])  && isset($_POST['pass'])){
            echo "名前：".$_POST['name'];
            echo "<br>パスワード：".$_POST['pass'];
        }
    }
?>

