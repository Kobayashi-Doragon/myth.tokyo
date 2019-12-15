<?php 
    $num1=0;
    $num2=0;
    $method="+";
    $answer=0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを各変数に格納
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $method = $_POST['method'];
    }
    if($method){
        if($method=="+"){
            $answer=$num1+$num2;
        }
        elseif($method=="-"){
            $answer=$num1-$num2;
        }
        elseif($method=="*"){
            $answer=$num1*$num2;
        }
        elseif($method=="/"){
            $answer=$num1/$num2;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/header_style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

        <title>webアプリ-myth.tokyo</title>
    </head>
    <body>
        <!--ヘッダー-->
        <header>
        <a class="logo" href="../index.html"><img src="../image/logo.png" class="header-logo"></a>
        <ul class="header-list">
            <li><a href="../transfer/page1/page1.html">編入体験談1</a></li>
            <li><a href="../transfer/page2/page2.html">編入体験談2</a></li>
            <li><a href="../application/index.php">webアプリ</a></li>
            <li><a href="../contact/index.html">お問い合わせ</a></li>
        </ul>
        <div class="header-right">
            <label for="menu_bar01"><i class="fas fa-bars"></i>  </label>
            <input type="checkbox" id="menu_bar01" class="accordion" />
            <ul id="links01">
            <li><a href="../transfer/page1/page1.html">編入体験談1</a></li>
            <li><a href="../transfer/page2/page2.html">編入体験談2</a></li>
            <li><a href="../application/index.php">webアプリ</a></li>
            <li><a href="../contact/index.html">お問い合わせ</a></li>
            </ul>
        </div>
    </header>

        <!--本文-->
        <div class="main">
            <div class="title">
                <h1>作成したwebアプリ</h1>
            </div>
            <div class="content">
            <form action="index.php" method="post" name="form" onsubmit="return validate()">
                <h3>値1</h3>
                <input type="text" name="num1">
                <h3>値2</h3>
                <input type="text" name="num2">
                <br>
                <input type="radio" name="method" value="+"> 足し算
                <input type="radio" name="method" value="-"> 引き算
                <input type="radio" name="method" value="*"> 掛け算
                <input type="radio" name="method" value="/"> 割り算
                <br>
                <?php 
                echo "$num1 $method $num2 = $answer"; 
                ?>
                <button type="submit">計算</button>
            </div>
        </div>

        <!--フッター-->
        <footer>
            <div class="centering">
                <b>myth.tokyo</b>とはとある学生が勉強用に作ったwebサイトです
            </div>
            <ul class="footer-list">
                <li><a href="../transfer/page1.html">編入体験談1</a></li>
                <li><a href="../transfer/page2.html">編入体験談2</a></li>
                <li><a href="../application/index.php">webアプリ</a></li>
                <li><a href="../contact/index.html">お問い合わせ</a></li>
            </ul>
        </footer>
        
        <script src="../js/script.js"></script>
    </body>
</html>