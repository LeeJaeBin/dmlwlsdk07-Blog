<?php
    if($_GET['key']!='leejaebin'){
        header('Location: index.php');
    }
    require("config.php");
    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    mysqli_set_charset($conn, "utf8");
    if(isset($_GET['text'])){ 
        $text = mysqli_real_escape_string($conn, $_GET['text']);
        $title = mysqli_real_escape_string($conn, $_GET['title']);
        $category = mysqli_real_escape_string($conn, $_GET['category']);
        $n = mysqli_real_escape_string($conn, $_GET['n']);
        $sql = "UPDATE `$category` set `desc`='$text', `title`='$title' WHERE n=$n";
        mysqli_query($conn, $sql);
        header('Location: index.php');
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="main.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
        <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
        <script>
            function write_click(){
                
                var desc = document.getElementById("editor").innerText.replace(/\n/g, "<br>");
                location.href="edit.php?n=<?=$_GET['n']?>&text="+desc+"&title="+document.getElementById("write_title").value+"&category="+document.getElementById("category").value;
            }
        </script>
    </head>
    <body>
        <ul class="index_ul">
            <li class="index_li"><a class="active" href="./">Home</a></li>
            <li class="index_li"><a href="./security.php">보안</a></li>
            <li class="index_li"><a href="./develop.php">개발</a></li>
            <li class="index_li"><a href="./about.php">About</a></li>
            <li class="index_li"><a href="./auth.php">글쓰기</a></li>
        </ul>
        <div class="con">
            <?php
                $ds = mysqli_real_escape_string($conn, $_GET['ds']);
                $n = mysqli_real_escape_string($conn, $_GET['n']);
                $sql = "SELECT * from `$ds` WHERE n=$n";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            ?>
            <input type="text" id="write_title" placeholder="제목" value="<?=$row['title']?>">
            <div id="toolbar">
                <select class="ql-size" style="">
                    <option value="small"></option>
                    <option selected=""></option>
                    <option value="large"></option>
                    <option value="huge"></option>
                </select>
                <button class="ql-list ql-active" value="ordered" type="button"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="7" x2="15" y1="4" y2="4"></line> <line class="ql-stroke" x1="7" x2="15" y1="9" y2="9"></line> <line class="ql-stroke" x1="7" x2="15" y1="14" y2="14"></line> <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5" y2="5.5"></line> <path class="ql-fill" d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z"></path> <path class="ql-stroke ql-thin" d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156"></path> <path class="ql-stroke ql-thin" d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109"></path> </svg></button>
                <button class="ql-list" value="bullet" type="button"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="6" x2="15" y1="4" y2="4"></line> <line class="ql-stroke" x1="6" x2="15" y1="9" y2="9"></line> <line class="ql-stroke" x1="6" x2="15" y1="14" y2="14"></line> <line class="ql-stroke" x1="3" x2="3" y1="4" y2="4"></line> <line class="ql-stroke" x1="3" x2="3" y1="9" y2="9"></line> <line class="ql-stroke" x1="3" x2="3" y1="14" y2="14"></line> </svg></button>
                <button class="ql-bold">Bold</button>
                <button class="ql-italic">Italic</button>
            </div>
            <div id="editor"><?=$row['desc']?></div>
            <script>
                var editor = new Quill('#editor', {
                    modules: { toolbar: '#toolbar' },
                    theme: 'snow'
                });
            </script>
            <select name="category" id="category">
                <option value="security">보안</option>
                <option value="develop">개발</option>
            </select>
            <button class="write_submit" onclick="write_click()">작성</button>
        </div>
    </body>
</html>