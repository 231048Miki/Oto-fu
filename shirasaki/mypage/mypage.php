<?PHP if(isset($_SESSION_["keyword"])){unset($_SESSION_["keyword"]);}
require("../functions/xssBlock.php");
require("../../db_open.php");
require("../functions/userCtlFunc.php");
session_start();

$login = login($dbh);
// var_dump($login);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../baseLayout.css">

        <title>マイページ</title>
    </head>
    <style>
        .block button{
            box-shadow: 0 5px #8E9FEA;
            border-radius: 5px;
            width: 170px;
            height: 60px;
            padding: 15px;
            box-sizing: border-box;
            background: #C4D9FE;
            color: #181818;
            text-decoration: none;
            text-align: center;
            margin-left: 20px;
            color: #181818;
        }
        .block{
            height: 100px;
        }
        @media (max-width: 600px){

            .right{
            /* background-color: lightcoral; */
            width: 100%;
            padding-left: 100px;
            height: 200px;
            }

            .left{
            /* background-color: lightcoral; */
            margin-top: 100px;
            width: 100%;
            padding-left: 100px;
            height: 200px;
            }
        }
    </style>
    <body>
    <div class="main">
        <header>
            <div class="title"><h1>マイページ</h1></div>
            <div class="banner">
            <button class="btn-gradient-3d-simple" onclick="location.href=''">就活アプリ</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../top/top.php'">もどる</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../../fujii/login.php'">ログアウト</button>
            <button class="btn-gradient-3d-simple" onclick="location.href=''">閲覧履歴</button>
            <button class="btn-gradient-3d-simple" onclick="location.href='../quit/quit.php'">退会</button>
            </div>

            <div class="hamburger">
                <!-- ハンバーガーメニューの線 -->
                <span></span>
                <span></span>
                <span></span>
                <!-- /ハンバーガーメニューの線 -->
            </div>
            <ul class="slide-menu">
                <li><a href="">aaa</a></li>
                <li><a href="">iii</a></li>
                <li><a href="">uuu</a></li>
                <li><a href="">eee</a></li>
                <li><a href="">aaa</a></li>
                <li><a href="">iii</a></li>
                <li><a href="">uuu</a></li>
                <li><a href="">eee</a></li>
                <li><a href="">aaa</a></li>
                <li><a href="">iii</a></li>
                <li><a href="">uuu</a></li>
                <li><a href="">eee</a></li>
            </ul>
        </header>

        <div class="mid">

            <div class="right">

                <div class="block" id="b1">
                <button class="btn-gradient-3d-simple" onclick="location.href=''">オファーリスト</button>
                </div>
                <div class="block"> 
                <button class="btn-gradient-3d-simple" onclick="location.href=''">気になる企業リスト</button>
                </div>
            </div>

            <div class="left">
                <div class="block"> 
                <button class="btn-gradient-3d-simple" onclick="location.href='../resume/resumeForm.php'">履歴書</button>
                </div>
                <div class="block"> 
                <button class="btn-gradient-3d-simple" onclick="location.href=''">設定</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.hamburger').addEventListener('click', function(){
        this.classList.toggle('active');
        document.querySelector('.slide-menu').classList.toggle('active');
        });
    </script>
    </body>
</html>