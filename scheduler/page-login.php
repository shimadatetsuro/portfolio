<?php

if(isset($_COOKIE['session_id'])){
    session_id($_COOKIE['session_id']);
}
session_start();
//データベースに接続
//PDO('mysql(接頭辞):host=ホスト名;dbname=データベース名','ユーザー名','パスワード')
//クッキー情報を格納する（すでにあるならその値を、ないなら空文字を格納）
$user_id = isset($_COOKIE['id']) ? $_COOKIE['id'] :'';
$user_password = isset($_COOKIE['password']) ? $_COOKIE['password'] :'';
if(isset($_SESSION['id']))
{//セッションIDがあるかどうか
    try {
        $stmt = $db->prepare('SELECT * from users WHERE `id` = :id AND `password` = :password');
        $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $_SESSION['password'], PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            //echo "一致アカウント数：".$count . " セッションでログイン成功しました！";
            //スケジューラに飛ばす
            header('Location: '.home_url("portfolio3"));
            exit;
        }else{
            echo "ID・又はパスワードが間違っています。";
        }
    } catch(PDOException $e) {
        echo 'DB接続エラー' . $e->getMessage();
    }
}else {//セッションにIDがない場合
    if($user_id){//クッキーに情報があるならログイン情報の精査
        try {
            $stmt = $db->prepare('SELECT * from users WHERE `id` = :id AND `password` = :password');
            $stmt->bindValue(':id', $_COOKIE['id'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $_COOKIE['password'], PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count == 1){
                // echo "一致アカウント数：".$count . " クッキーでログイン成功しました！";
                $_SESSION["id"] = $_COOKIE['id'];
                $_SESSION["password"] = $_COOKIE['password'];
                setcookie("session_id",session_id(),time()+(60 * 5));
                //スケジューラに飛ばす
                //header('Location: '.home_url("portfolio3"));
                wp_safe_redirect(home_url("portfolio3"));
                exit;   
            }else{
                echo "ID・又はパスワードが間違っています。";
            }
        } catch(PDOException $e) {
            echo 'DB接続エラー' . $e->getMessage();
        }
    }else{

    }


    
    if(isset($_POST['submit'])&&isset($_POST['id'])&&isset($_POST['password'])){
        try {
            $stmt = $db->prepare('SELECT * from users WHERE `id` = :id AND `password` = :password');
            $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count == 1){
                // echo "一致アカウント数：".$count . " ログイン成功しました！aaa";
                $_SESSION["id"] = $_POST['id'];
                $_SESSION["password"] = $_POST['password'];
                setcookie("session_id",session_id(),time()+(60 * 5));
                if(isset($_POST['save']) == "on"){
                    setcookie('id',$_POST['id'],time()+(60*60*24));
                    setcookie('password',$_POST['password'],time()+(60*60*24));
                }
                wp_safe_redirect(home_url("portfolio3"));
                exit;           
            }else{
                echo "ID・又はパスワードが間違っています。";
            }

        } catch(PDOException $e) {
            echo 'DB接続エラー' . $e->getMessage();
        }
    }elseif(isset($_POST['newid'])&&isset($_POST['id'])&&isset($_POST['password'])){
        // echo "新規会員登録開始";
        try {
            $stmt = $db->prepare('  INSERT INTO `users` 
            SET `id` = :id,
            `password` = :password
            ');
            $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            echo "{$count}件新規会員登録しました！";
        }catch(PDOException $e) {
            echo 'DB接続エラー' . $e->getMessage();
        }

    }
}



?>


<!DOCTYPE html>
<html lang="ja">
    <h1>ログインしてください</h1>
    <form method="post" action="">
    <p>ID: <input type="text" name="id" required></p>
    <p>パスワード: <input type="password" name="password" required></p>
    <p><input type="submit" name="submit" value="ログイン"></p>
    <p><input type="submit" name="newid" value="新規登録"></p>
    <p><input type="checkbox" name="save" id="save" value="on" /><label for="save" >IDを保存する</label></p>
</html>


