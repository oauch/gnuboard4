<?
$sub_menu = "200800";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "월별 접속자현황";
include_once("./admin.head.php");
include_once("./visit.sub.php");

$colspan = 4;
?>

<? $admin_HadeNum = "03"; ?>

<table width=100% cellpadding=0 cellspacing=0 border=0 id="admin_basic_board">
<colgroup width=100>
<colgroup width=100>
<colgroup width=100>
<colgroup width=''>
<tr class="admin_basic_board_topln">
    <td>년-월</td>
    <td>방문자수</td>
    <td>비율(%)</td>
    <td>그래프</td>
</tr>
<?
$max = 0;
$sum_count = 0;
$sql = " select SUBSTRING(vs_date,1,7) as vs_month, SUM(vs_count) as cnt 
           from $g4[visit_sum_table]
          where vs_date between '$fr_date' and '$to_date'
          group by vs_month
          order by vs_month desc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row[vs_month]] = $row[cnt];

    if ($row[cnt] > $max) $max = $row[cnt];

    $sum_count += $row[cnt];
}

$i = 0;
$k = 0;
$save_count = -1;
$tot_count = 0;
if (count($arr)) {
    foreach ($arr as $key=>$value) {
        $count = $value;

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $bar = (int)($count / $max * 100);
        $graph = "<img src='{$g4[admin_path]}/img/graph.gif' width='$bar%' height='18'>";

        $list = ($k++%2);
        echo "
        <tr class='list$list ht center'>
            <td><a href='./visit_date.php?fr_date=$key-01&to_date=$key-31' class=tt>$key</a></td>
            <td>".number_format($value)."</td>
            <td>$s_rate</td>
            <td align=left>$graph</td>
        </tr>";
    }

    echo "
    <tr>
        <td>합계</td>
        <td>".number_format($sum_count)."</td>
        <td colspan=2>&nbsp;</td>
    </tr>";
} else {
    echo "<tr><td colspan='$colspan' height=100 align=center>자료가 없습니다.</td></tr>";
}
?>
</table>

<?
include_once("./admin.tail.php");
?>
