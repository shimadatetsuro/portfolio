<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample calendar</title>
<link rel="stylesheet" href="<?php echo get_theme_file_uri('stylesheets/normalize.css');?>">
<link rel="stylesheet" href="<?php echo get_theme_file_uri('testsite/css/calendar_style.css');?>">
</head>
<?php 
// 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
if (isset($_GET['yn'])) {
    $ym = $_GET['yn'];
} else {
    // リンクがなければ今月の年月を取得
    $ym = date('Y-n');
}
$timestamp = strtotime($ym . '-01');
$prev_month = date('Y-n', strtotime('-1 month',$timestamp));
$next_month = date('Y-n', strtotime('+1 month',$timestamp));
$current_month = explode("-",$ym);//ハイフンで区切って配列を出力

echo '<a href="?yn='.$prev_month.'">前月</a>';
echo '<a href="?">今月</a>';
echo '<a href="?yn='.$next_month.'">次月</a>';
echo "<br>";



$day_count_of_month = date('t',strtotime($ym));//その月の日数
$first_day_of_month = date('w', strtotime($ym));//月の最初の曜日の番号を出力（この場合４）
echo "<table>";
echo '<caption>'.$current_month[0].'年'.$current_month[1].'月';//今何月かの出力
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
$day_num = 0;
echo "<tr>";
// 最初の週の出力(1行7日を1セットとして考える)
for($i = 0;$i < 7;$i++){
                        if($i < $first_day_of_month){
                            echo "<td></td>";
                        }elseif($day_num < $day_count_of_month){
                            echo '<td>'.($day_num + 1).'</td>';
                            $day_num ++;
                        }
                        }
echo "</tr>";
// 2週目以降の出力（その月の数までの繰り返し）
while($day_num < $day_count_of_month){
                        echo "<tr>";
                        // 1行7日の1セット繰り返し
                        for($i = 0;$i < 7;$i++){
                                                // その月の数より小さいかの判断（超えたら空白データを出力
                                                if($day_num < $day_count_of_month){
                                                echo '<td>'.($day_num + 1).'</td>';
                                                $day_num ++;
                                                }else{
                                                echo '<td></td>';
                                                }
                                                }
                        echo "</tr>";
                        }
echo "</table>";

?>
</html>