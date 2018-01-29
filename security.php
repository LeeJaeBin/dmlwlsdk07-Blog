<?php
    require("config.php");
    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    mysqli_set_charset($conn, "utf8");
    error_reporting(0);
?>

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="main.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
    </head> 
    <body>
        <ul class="index_ul">
            <li class="index_li"><a class="active" href="./">Home</a></li>
            <li class="index_li"><a href="./security.php">보안</a></li>
            <li class="index_li"><a href="./develop.php">개발</a></li>
            <li class="index_li"><a href="./about.php">About</a></li>
            <li class="index_li"><a href="./auth.php">글쓰기</a></li>
            <?php
            if(isset($_GET['n'])){
                $n = $_GET['n'];
                $s_n = mysqli_real_escape_string($conn, $n);
                echo "<li class='index_li_ed'><a href='./auth2.php?ds=security&n=$s_n'>수정</a></li>";
            }
            ?>
        </ul>
        <ul class="security_ul">
        <?php
            $sql = "SELECT MAX(n) AS alias FROM `security`";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $cnt = (int)$row['alias'];
            for($i=1;$i<=$cnt;$i++){
                $s_i = mysqli_real_escape_string($conn, $i);
                $sql = "SELECT title FROM `security` WHERE n=$s_i";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $title = $row['title'];
                echo "<li class='security_li'><a href='?n=$i'>$title</a></li>";
            }
        ?>
        </ul>
        <div class="security_contents">
            <?php
                $n = $_GET['n'];
                $s_n = mysqli_real_escape_string($conn, $n);
                $sql = "SELECT * from `security` WHERE n='$n'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo $row['desc'];
            ?>
        </div>
    </body>
</html>