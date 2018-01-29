<?php
    if(isset($_POST['password'])){
        if($_POST['password']=='santajen05'){
            $ds=$_GET['ds'];
            $n=$_GET['n'];
            echo "<meta http-equiv='refresh' content='0; url=./edit.php?key=leejaebin&ds=$ds&n=$n'>";
        }
        else{
            echo "<meta http-equiv='refresh' content='0; url=./index.php'>";
        }
    }
?>

<html> 
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="main.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
    </head>
    <body> 
        <p class="auth_title">글을 작성하려면 비밀번호를 입력하세요</p>
        <div class="auth_div">
            <form action="" method="post">
                <input type="password" name="password" namespace="password" class="password">
                <input type="submit" class="password_sub">
            </form>
        </div>
    </body>
</html>