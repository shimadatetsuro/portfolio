<?php 
if(isset($_COOKIE['session_id'])){//クッキーにセッションIDが格納されてるか
    session_id($_COOKIE['session_id']);//セッションID関数に格納
}
session_start();
//データベースに接続
//PDO('mysql(接頭辞):host=ホスト名;dbname=データベース名','ユーザー名','パスワード')



//削除のボタンが押されていた場合
if(isset($_POST['delete'])){
    foreach($_POST['schedule_id'] as $d){
        $del = $db->prepare("DELETE FROM schedule 
                                    WHERE `schedule_id` = $d
                            ");
        $del -> execute();
    }   
    echo count($_POST['schedule_id']) . "件のデータを削除しました！";
}
//済にするボタンが押されていた場合
if(isset($_POST['done'])){
    foreach($_POST['schedule_id'] as $d){
        $del = $db->prepare("   UPDATE `schedule` 
                                SET `done` = '1'
                                WHERE `schedule_id` = $d
                            ");
        $del -> execute();
    }   
    echo count($_POST['schedule_id']) . "件のデータを済にしました！";
}
//未完了ボタンが押されていた場合
if(isset($_POST['yet'])){
    foreach($_POST['schedule_id'] as $d){
        $del = $db->prepare("   UPDATE `schedule` 
                                SET `done` = '0'
                                WHERE `schedule_id` = $d
                            ");
        $del -> execute();
    }   
    echo count($_POST['schedule_id']) . "件のデータを未完了にしました！";
}
;?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sample calendar</title>
<link rel="stylesheet" href="<?php echo get_theme_file_uri('');?>">
</head>
<?php 


if(isset($_SESSION['id'])){//セッションにIDが格納されているかどうか
    echo "ようこそ{$_SESSION['id']}さん";
?>
    <!-- ログアウトボタン -->
    <form method="post" action="<?php echo esc_url(home_url('logout')); ?>">
        <p><input type="submit" name="logout" value="ログアウト"></p>
    </form>
<?php 
}else{
    echo "ようこそゲスト様";
?>
    <!-- ログインボタン -->
    <form method="post" action="<?php echo esc_url(home_url('login')); ?>">
        <p><input type="submit" name="logout" value="ログイン/新規登録"></p>
    </form>
<?php 
}
//セッションIDからユーザーIDを返す関数を作成
function user_id(){
    try {
//データベースに接続
//PDO('mysql(接頭辞):host=ホスト名;dbname=データベース名','ユーザー名','パスワード')
        $stmt = $db->prepare("   SELECT `user_id` 
                                FROM users 
                                WHERE `id` = :id
                            ");
        $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt -> execute();
        $result = $stmt -> fetch();
        return $result['user_id'];
    }catch(PDOException $e) {
        echo 'DB接続エラー' . $e->getMessage();
    }
}
//チェックを入れたセルのスケジュールID（プライマリーキー）を返す関数
function g_schedule_id($schedule_id){
//データベースに接続
//PDO('mysql(接頭辞):host=ホスト名;dbname=データベース名','ユーザー名','パスワード')
    
}
    


if(isset($_POST['submit'])){//フォームの「追加ボタンを押したかどうか」（IF）
    try {
        $stmt = $db->prepare('  INSERT INTO schedule 
                                SET `date` = :date, 
                                    `schedule` = :schedule , 
                                    `user_id` = :user_id
                            ');
        $stmt->bindValue(':user_id', user_id(), PDO::PARAM_INT);
        $stmt->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
        $stmt->bindValue(':schedule', $_POST['schedule'], PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        echo $count . "件のデータを登録しました！";
    } catch(PDOException $e) {
        echo 'DB接続エラー' . $e->getMessage();
    }
}

// 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
if (isset($_GET['yn'])) {
    $now = new DateTime($_GET['yn']);
} else {
    // リンクがなければ今月の年月を取得
    $now = new DateTime();//新しいインスタンスの作成（）に未入力なので今日
}
$first_day = $now->modify('first day of this month')->format('Y-m-d');
// 今月の最後の日を設定
$last_day = $now->modify('last day of this month')->format('Y-m-d');
$current_day = new DateTime($first_day);
$current_last_day = new DateTime($last_day);
$current_day_of_week = $current_day->format('w');

$prev_month = clone $current_day;
$prev_month -> modify('-1 month');
$next_month = clone $current_day;
$next_month -> modify('+1 month');

echo '<a href="?yn='.$prev_month->format('Y-m').'">前月</a>';
echo '<a href="?">今月</a>';
echo '<a href="?yn='.$next_month->format('Y-m').'">次月</a>';
echo "<br>";

//※プリペアードステートメントでユーザアカウントと紐づけ、日にちもバインドバリューする。（願望）
if(isset($_SESSION['id']))
{
        $current_schedule = $db->prepare("SELECT `schedule`,`schedule_id`,`done`
                                            FROM schedule 
                                            JOIN users 
                                            ON schedule.user_id = users.user_id  
                                            WHERE `date` = '{$current_day-> format('Y-m-d')}' 
                                            AND users.id = '{$_SESSION['id']}' 
                                        ");
        $current_schedule->execute();
}

//カレンダーの作成
echo '<form method="POST" action="">';
echo "<table>";

echo '<caption>'.$now ->format('y') .'年'.$now ->format('m').'月</caption>';//今何年何月かの出力
echo     "<thead>
                <tr>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>
        </thead>";

while ($current_day <= $current_last_day) {//月の１日目が月の最終日まで繰り返し
    //月の初めが日曜日でない場合、曜日の番号だけ空白を入れる
    if($current_day->format('w') != 0 && $current_day -> format('j') == 1){
        echo '<tr>';
        for($i = 0;$i <$current_day -> format('w');$i++){
            echo '<td></td>';
        }
    }
    if($current_day->format('w') == 0){//日曜日なら（IF）
        echo '<tr>';
        echo '<td>';
        echo $current_day->format('j');
        echo "<br>";
        if(isset($_SESSION['id'])){//ログイン中であれば予定の取得出力
            $current_schedule = $db->prepare("  SELECT `schedule`,`schedule_id`,`done`
                                                FROM schedule 
                                                JOIN users 
                                                ON schedule.user_id = users.user_id  
                                                WHERE `date` = '{$current_day-> format('Y-m-d')}' 
                                                AND users.id = '{$_SESSION['id']}' 
                                            ");
            $current_schedule->execute();
            while ($row = $current_schedule -> fetch()){
                if($row[done] != 0){
                    echo "<span class='done'>";
                }
                print "$row[schedule]";
                if($row[done] != 0){
                    echo "</span>";
                }
                echo "<input type='checkbox' name='schedule_id[]' value={$row['schedule_id']}><br>\n";
            }
        }
        echo '</td>';
    }elseif($current_day->format('w') == 6){//土曜日なら（IF）
        echo '<td>';
        echo $current_day->format('j');
        echo "<br>";
        if(isset($_SESSION['id'])){//ログイン中であれば予定の取得出力
            $current_schedule = $db->prepare("  SELECT `schedule`,`schedule_id`,`done`
                                                FROM schedule  
                                                JOIN users 
                                                ON schedule.user_id = users.user_id  
                                                WHERE `date` = '{$current_day-> format('Y-m-d')}' 
                                                AND users.id = '{$_SESSION['id']}' 
                                            ");
            $current_schedule->execute();
            while ($row = $current_schedule -> fetch()){
                if($row[done] != 0){
                    echo "<span class='done'>";
                }
                print "$row[schedule]";
                if($row[done] != 0){
                    echo "</span>";
                }
                echo "<input type='checkbox' name='schedule_id[]' value={$row['schedule_id']}><br>\n";
            }
        }
        echo '</td>';
        echo '</tr>';
    }else{//平日なら（土曜日曜以外なら）（IF）
                // カレンダーの日付を出力
        echo '<td>';
        echo $current_day->format('j');
        echo "<br>";
        if(isset($_SESSION['id'])){//ログイン中であれば予定の取得出力（IF）
            $current_schedule = $db->prepare("  SELECT `schedule`,`schedule_id`,`done`
                                                FROM schedule 
                                                JOIN users 
                                                ON schedule.user_id = users.user_id  
                                                WHERE `date` = '{$current_day-> format('Y-m-d')}' 
                                                AND users.id = '{$_SESSION['id']}' 
                                            ");
            $current_schedule->execute();
            while ($row = $current_schedule -> fetch()){
                if($row['done'] != 0){
                    echo "<span class='done'>";
                }
                print "$row[schedule]";
                if($row['done'] != 0){
                    echo "</span>";
                }
                echo "<input type='checkbox' name='schedule_id[]' value={$row['schedule_id']}><br>\n";
            }
        }                
    echo '</td>';
    }
    // 日付を1日進める
    $current_day->modify('+1 day');
}
//最終日が土曜日で終わらない場合に空白を入れたい
$last_day_after_date = $current_last_day -> format('w');
if($last_day_after_date != 6  ){//最終日の曜日番号が６（土曜）でない場合（IF）
    while($last_day_after_date < 6){//土曜日まで繰り返す
        echo "<td>";
        echo "</td>";
        $last_day_after_date++;
    }   echo "</tr>";//行の最後なのでtrタグで閉じる
}


echo "</table>";
?>
<!-- 削除、編集フォーム -->
    <ul class="delite-done">チェックした項目を
        <li><input type="submit" name="delete" value="削除"></li>
        <li><input type="submit" name="done" value="完了"></li>
        <li><input type="submit" name="yet" value="未完了"></li>
        <!-- <li><input type="text" name="edited"><input type="submit" name="edit" value="更新"></li> -->
    </ul>
</form>
<?php
if(isset($_SESSION['id'])){//ログインしてるなら予定入力フォームを出力
?>
<!-- フォームの作成 -->
<form method="post" action="">
    <!-- <p>ユーザーID: <input type="number" name="user_id" required></p> -->
    <p>日付: <input type="date" name="date" required></p>
    <p>スケジュール: <input type="text" name="schedule" required></p>
    <p><input type="submit" name="submit" value="追加"></p>
</form>

<p><?php
}
    echo "テスト(投稿内容表示)";

    if(isset($_POST["date"])){//ポスト（date）があるかどうか（IF）
        echo $_POST["date"];
    }
    if(isset($_POST["schedule"])){//ポスト（schedule）があるかどうか（IF）
        echo $_POST["schedule"];
    }
    if(isset($_POST["submit"])){//ポスト（submit）があるかどうか（IF）
        echo $_POST["submit"];
    }

?></p>

</html>