<?
$sub_menu = "300300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

// üũ�� �ڷ� ����
if (is_array($_POST['chk'])) {
    for ($i=0; $i<count($chk); $i++) {
        // ���� ��ȣ�� �ѱ�
        $k = $chk[$i];

        sql_query(" delete from $g4[popular_table] where pp_id = '{$_POST['pp_id'][$k]}' ", true);
    }
}

$sql_common = " from $g4[popular_table] a ";
$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "pp_word" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "pp_date" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "pp_id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if ($page == "") { $page = 1; } // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select * 
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>ó��</a>";

$g4[title] = "�α�˻������";
include_once("./admin.head.php");

$colspan = 4;
?>

<script type="text/javascript">
var list_update_php = '';
var list_delete_php = 'popular_list.php';
</script>

<table width=100% cellpadding=3 cellspacing=1>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left><?=$listall?> (�Ǽ� : <?=number_format($total_count)?>��)</td>
    <td width=50% align=right>
        <select name=sfl>
            <option value='pp_word'>�˻���</option>
            <option value='pp_date'>�����</option>
        </select>
        <input type=text name=stx class=ed required itemname='�˻���' value='<?=$stx?>'>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle></td>
</tr>
</form>
</table>

<form name=fpopularlist method=post>
<input type=hidden name=sst   value="<?=$sst?>">
<input type=hidden name=sod   value="<?=$sod?>">
<input type=hidden name=sfl   value="<?=$sfl?>">
<input type=hidden name=stx   value="<?=$stx?>">
<input type=hidden name=page  value="<?=$page?>">
<input type=hidden name=token value="<?=$token?>">
<table width=100% cellpadding=0 cellspacing=1>
<colgroup width=30>
<colgroup width=>
<colgroup width=150>
<colgroup width=150>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td><input type=checkbox name=chkall value="1" onclick="check_all(this.form)"></td>
    <td><?=subject_sort_link("pp_word")?>�˻���</a></td>
    <td>�����</td>
    <td>���IP</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $word = get_text($row[pp_word]);

    $list = $i % 2;
    echo "<input type=hidden name=pp_id[$i] value='$row[pp_id]'>";
    echo "<tr class='list$list col1 ht center'>";
    echo "<td height=25><input type=checkbox name=chk[] value='$i'></td>";
    echo "<td align='left'>&nbsp; <a href='$_SERVER[PHP_SELF]?sfl=pp_word&stx=$word'>$word</a></td>";
    echo "<td>$row[pp_date]</td>";
    echo "<td>$row[pp_ip]</td>";
    echo "</tr>";
    echo "<tr class='list$list col1 ht center'>";
    echo "</tr>\n";
} 

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>�ڷᰡ �����ϴ�.</td></tr>"; 

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=50%>";

if ($is_admin == "super")
    echo "<input type=button class='btn1' value='���û���' onclick=\"btn_check(this.form, 'delete')\">";

echo "</td>";
echo "<td width=50% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script>document.fsearch.sfl.value = '$sfl';</script>";
?>
</form>

<?
include_once("./admin.tail.php");
?>
