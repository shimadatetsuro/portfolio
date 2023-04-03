<?php 
get_header();
$name = $_POST['user_name'];
$email = $_POST['email'];
$content = $_POST['content'];
?>
<main>

<section id="works" class="main-works">
            <div class="container">
                        <h1>
                        お問い合わせ有難うございました。
                        </h1>

<p><a href="<?=home_url();?>" class="button">トップに戻る</a></p>
</main>
<?php 
$name = $_POST['user_name'];
$email = $_POST['email'];
$content = $_POST['content'];

mb_send_mail(
//"送信先メールアドレス",
"ポートフォリオサイトからのお問い合わせ",
'氏名:'.$name."\r\n".
'メールアドレス:'.$email."\r\n".
'お問い合わせ内容:'.$content); 




?>
