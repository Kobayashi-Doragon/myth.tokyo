<?php 
    // フォームのボタンが押されたら
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを各変数に格納
        $name = $_POST["name"];
        $job = $_POST["job"];
        $email = $_POST["email"];
        $item = $_POST["item"];
        $content  = $_POST["content"];
  
  
        //xss対策
        $name = htmlspecialchars($name);
        $job = htmlspecialchars($job);
        $email = htmlspecialchars($email);
        $item = htmlspecialchars($item);
        $content  = htmlspecialchars($content);
    }

    // 送信ボタンが押されたら
    if (isset($_POST["submit"])) {
        // 送信ボタンが押された時に動作する処理をここに記述する
            
        // 日本語をメールで送る場合のおまじない
        mb_language("ja");
        mb_internal_encoding("UTF-8");
        
        // 件名を変数subjectに格納
        $subject = "［自動送信］お問い合わせ内容の確認";

        // メール本文を変数bodyに格納
        $body = <<< EOM
{$name}　様

お問い合わせありがとうございます。
以下のお問い合わせ内容を、メールにて確認させていただきました。

===================================================
【 お名前 】 
{$name}

【 職業 】 
{$job}

【 メール 】 
{$email}

【 項目 】 
{$item}

【 内容 】 
{$content}
===================================================

内容を確認のうえ、回答させて頂きます。
しばらくお待ちください。
EOM;
$body = mb_convert_encoding( $body, "ISO-2022-JP", "UTF-8" );
        // 送信元のメールアドレスを変数fromEmailに格納
        $fromEmail = "kobasyodora@gmail.com";

        // 送信元の名前を変数fromNameに格納
        $fromName = "お問い合わせ内容の確認";

        // ヘッダ情報を変数headerに格納する      
        $header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";
        // メール送信を行う
        mb_send_mail($email, $subject, $body, $header);


        //自分に確認メールを送る
        $header2 = "From: " .mb_encode_mimeheader($name) ."<{$email}>";
        $subject2 = "お問い合わせ内容";
        $body2 = <<< EOM
{$name}　様より

{$name}　様よりmyth.tokyoに対してお問い合わせがありました。
内容は下記のとおりです。ご確認のうえ，返信してください。

===================================================
【 お名前 】 
{$name}

【 職業 】 
{$job}

【 メール 】 
{$email}

【 項目 】 
{$item}

【 内容 】 
{$content}
===================================================

EOM;

        mb_send_mail("kobasyodora@gmail.com",$subject2,$body,$header2);

        // サンクスページに画面遷移させる
        header("Location: thanks.php");
        exit;
    }
?>
<html lang="ja">
<head>
<meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/header_style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <title>お問い合わせフォーム</title>
</head>
<body>
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
    <div class="title">
        <h1>お問い合わせ</h1>
    </div>
    <div class="content">
        <form action="confirm.php" method="post">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="job" value="<?php echo $job; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="item" value="<?php echo $item; ?>">
            <input type="hidden" name="content" value="<?php echo $content; ?>">
            <form action="confirm.php" method="post" name="form" onsubmit="return validate()">
            
            <h2>お問い合わせ 内容確認</h2>
            <p>お問い合わせ内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <table class="formtable" cellpadding="10px" cellspacing="0">
                <tr >
                    <th>お名前 </th>
                    <td>
                    <?php echo $name; ?>
                    </td>
                </tr>
                <tr>
                    <th>職業 </th>
                    <td>
                    <?php echo $job; ?>
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス </th>
                    <td>
                    <?php echo $email; ?>
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ項目 </th>
                    <td><?php echo $item; ?></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                    <?php echo nl2br($content); ?>
                    </td>
                </tr>
            </table>

            <input type="button" value="内容を修正する" onclick="history.back(-1)">
            <button type="submit" name="submit">送信する</button>
        </form>
    </div>
    <footer>
        <div class="centering">
            <b>myth.tokyo</b>とはとある学生が勉強用に作ったwebサイトです
        </div>
        <ul class="footer-list">
            <li><a href="../transfer/page1/page1.php">編入体験談1</a></li>
            <li><a href="../transfer/page2/page2.php">編入体験談2</a></li>
            <li><a href="../application/index.php">webアプリ</a></li>
            <li><a href="../contact/index.html">お問い合わせ</a></li>
        </ul>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>