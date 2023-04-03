<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<?php
echo "ログアウトしました";
setcookie("session_id","",time()-3600);
setcookie("id","",time()-3600);
setcookie("password","",time()-3600);
session_destroy();

?>
    <form method="post" action="<?php echo esc_url(home_url('login')); ?>">
    <p>ID: <input type="text" name="id" required></p>
    <p>パスワード: <input type="password" name="password" required></p>
    <p><input type="submit" name="submit" value="ログイン"></p>
    <p><input type="checkbox" name="save" id="save" value="on" /><label for="save" >IDを保存する</label></p>
    </form>
</html>