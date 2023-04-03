<?php 
get_header();
$name = $_POST['user_name'];
$email = $_POST['email'];
$content = $_POST['content'];
?>
<main>

<section id="works" class="main-works">
            <div class="container">
                <div class="main-works-item">
                    <div class="main-works-item-text">
                        <h3>
                            お問い合わせ内容確認
                        </h3>

                        <p>以下の内容で送信しますがよろしいですか。</p>
<form action="<?=esc_url(home_url('result'));?>" method="post" class ="contact-check ">
    <table>
    <tr>
        <th>お名前：</th>
        <td>
            <?= $name;?>
            <input type="hidden" name="user_name" value="<?= $name;?>">
        </td>
    </tr>
    <tr>
        <th>メールアドレス：</th>
        <td>
            <?=$email;?>
            <input type="hidden" name="email" value="<?=$email;?>">
        </td>
    </tr>
    </tr>
        <th>お問い合わせ内容：</th>
        <td>
            <?=$content;?>
            <input type="hidden" name="content" value="<?=$content;?>">
        </td>
    </tr>
    </table>
    <input type ="hidden" name="content" value="<?=$content;?>">
    <input type="submit" value="送信する" class="button-secondary">
    
</form>

                    </div>
                </div>
            </div>
        </section>



</main>
