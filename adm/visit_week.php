<?
$sub_menu = "200800";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "���Ϻ� ��������Ȳ";
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
    <td>����</td>
    <td>�湮�ڼ�</td>
    <td>����(%)</td>
    <td>�׷���</td>
</tr>
<?
$weekday = array ('��', 'ȭ', '��', '��', '��', '��', '��');

$sum_count = 0;
$sql = " select WEEKDAY(vs_date) as weekday_date, SUM(vs_count) as cnt 
           from $g4[visit_sum_table]
          where vs_date between '$fr_date' and '$to_date'
          group by weekday_date
          order by weekday_date ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row[weekday_date]] = $row[cnt];

    $sum_count += $row[cnt];
}

$k = 0;
if ($i) {
    for ($i=0; $i<7; $i++) {
        $count = (int)$arr[$i];

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);
        $graph = "<img src='{$g4[admin_path]}/img/graph.gif' width='$rate%' height='18'>";

        $list = ($k++%2);
        echo "
        <tr class='list$list ht center'>
            <td>$weekday[$i]</td>
            <td>$count</td>
            <td>$s_rate</td>
            <td align=left>$graph</td>
        </tr>";
    }

    echo "
    <tr>
        <td>�հ�</td>
        <td>$sum_count</td>
        <td colspan=2>&nbsp;</td>
    </tr>";
} else {
    echo "<tr><td colspan='$colspan' height=100 align=center>�ڷᰡ �����ϴ�.</td></tr>";
}
?>
</table>

<?
include_once("./admin.tail.php");
?>
