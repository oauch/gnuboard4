<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

// DHTML ������ ��� �ʵ� �߰� : 061021
sql_query(" ALTER TABLE `$g4[board_table]` ADD `bo_use_dhtml_editor` TINYINT NOT NULL AFTER `bo_use_secret` ", false);
// RSS ���̱� ��� �ʵ� �߰� : 061106
sql_query(" ALTER TABLE `$g4[board_table]` ADD `bo_use_rss_view` TINYINT NOT NULL AFTER `bo_use_dhtml_editor` ", false);

$sql_common = " from $g4[board_table] a ";
$sql_search = " where (1) ";

if ($is_admin != "super") {
    $sql_common .= " , $g4[group_table] b ";
    $sql_search .= " and (a.gr_id = b.gr_id and b.gr_admin = '$member[mb_id]') ";
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bo_table" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "a.gr_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.gr_id, a.bo_table";
    $sod = "asc";
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

$g4[title] = "�Խ��ǰ���";
include_once("./admin.head.php");

$colspan = 6;
//$colspan = 13;
?>

<? $admin_HadeNum = "04"; ?>

<script type="text/javascript">
var list_update_php = 'board_list_update.php';
var list_delete_php = 'board_list_delete.php';
</script>

<table width=100% cellpadding=3 cellspacing=1>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left><?=$listall?> (�Խ��Ǽ� : <?=number_format($total_count)?>��)</td>
    <td width=50% align=right class='admin_baic_select'>
        <select name=sfl>
            <option value='bo_table'>TABLE</option>
            <option value='bo_subject'>����</option>
            <option value='a.gr_id'>�׷�ID</option>
        </select>
        <input type=text name=stx required itemname='�˻���' value='<?=$stx?>' class='admin_baic_input'>
	<input type=submit value='Ȯ��' class=admin_black_bt_sc>
	</td>
</tr>
</form>
</table>


<div class="admin_tip_normal">
<b class="admin_tip_c">[�Խ��ǰ���]</b> �������� �Խ��� ���� �� ����,�����ϴ� �������� �Խù������� ������ �������� �ƴ� �α��� ���·� <b class="admin_tip_c">[��Ȩ������]</b>�� �����Ͻ� �� ������ �������ּž��մϴ�.<br>
���� ���������� <b class="admin_tip_c">�Խ��� ��ü�� �����ϰų� ����</b>�� �Ͻ� ��� ������ ����� �� ������, �Խ��ǻ������� ���� �߰������ �߻��ǽ� �� �ֽ��ϴ�. 
</div>


<form name=fboardlist method=post>
<input type=hidden name=sst   value="<?=$sst?>">
<input type=hidden name=sod   value="<?=$sod?>">
<input type=hidden name=sfl   value="<?=$sfl?>">
<input type=hidden name=stx   value="<?=$stx?>">
<input type=hidden name=page  value="<?=$page?>">
<input type=hidden name=token value="<?=$token?>">
<table width=100% cellpadding=0 cellspacing=1 id="admin_basic_board">
<colgroup width=5%>
<colgroup width=>
<colgroup width=20%>
<colgroup width=20%>
<colgroup width=15%>
<colgroup width=15%>
<colgroup width=15%>
<tr class="admin_basic_board_topln">
    <td><input type=checkbox name=chkall value="1" onclick="check_all(this.form)"></td>
    <td><?=subject_sort_link("bo_table")?>TABLE</a></td>
    <td><?=subject_sort_link("bo_subject")?>����</a></td>
    <td>�׷�</td>
    <td>��Ų</td>
	<td><a href="./board_form.php"><b class="admin_org_plus">+����</b></td>
</tr>
<?
// ��Ų���丮
$skin_options = "";
$arr = get_skin_dir("board");
for ($k=0; $k<count($arr); $k++) 
{
    $option = $arr[$k];
    if (strlen($option) > 10)
        $option = substr($arr[$k], 0, 18) . "��";

    $skin_options .= "<option value='$arr[$k]'>$option</option>";
}

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $s_upd = "<a href='./board_form.php?w=u&bo_table=$row[bo_table]&$qstr'><b class='admin_org font8pt'>����</b></a>";
    $s_del = "";
    if ($is_admin == "super") {
        //$s_del = "<a href=\"javascript:del('./board_delete.php?bo_table=$row[bo_table]&$qstr');\"><img src='img/icon_delete.gif' border=0 title='����'></a>";
        $s_del = "<a href=\"javascript:post_delete('board_delete.php', '$row[bo_table]');\"><b class='font8pt'>����</b></a>";
    }
    $s_copy = "<a href=\"javascript:board_copy('$row[bo_table]');\"><b class='font8pt'>����</b></a>";

    /*
    // ��Ų���丮
    $skin_options = "";
    $arr = get_skin_dir("board");
    for ($k=0; $k<count($arr); $k++) 
    {
        $option = $arr[$k];
        if (strlen($option) > 10)
            $option = substr($arr[$k], 0, 18) . "��";

        $skin_options .= "<option value='$arr[$k]'";
        if ($arr[$k] == $row[bo_skin])
            $skin_options .= " selected";
        $skin_options .= ">$option</option>";
    }
    */

    $list = $i % 2;
    echo "<input type=hidden name=board_table[$i] value='$row[bo_table]'>";
    echo "<tr>";
    echo "<td height=25><input type=checkbox name=chk[] value='$i'></td>";
    echo "<td><a href='$g4[bbs_path]/board.php?bo_table=$row[bo_table]'><b>$row[bo_table]</b></a></td>";
    echo "<td align=left height=25><input type=text name=bo_subject[$i] value='".get_text($row[bo_subject])."' style='width:99%' class='admin_baic_input'></td>";
    if ($is_admin == "super")
        echo "<td align=left class='admin_baic_select'>".get_group_select("gr_id[$i]", $row[gr_id])."</td>";
    else
        echo "<td align=center class='admin_baic_select'><input type=hidden name='gr_id[$i]' value='$row[gr_id]'>$row[gr_subject]</td>";

    echo "<td align=left class='admin_baic_select'><select id=bo_skin_$i name=bo_skin[$i]>$skin_options</select></td>";
    echo "<td>$s_upd $s_del $s_copy</td>";
    echo "</tr>";
    echo "<tr>";
    echo "</tr>\n";
    echo "<script type='text/javascript'>document.getElementById('bo_skin_$i').value='$row[bo_skin]';</script>";
} 

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>�ڷᰡ �����ϴ�.</td></tr>"; 

echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=70%>";
echo "<input type=button class='admin_black_bt_mn' value='���ü���' onclick=\"btn_check(this.form, 'update')\"> ";

if ($is_admin == "super")
    echo "<input type=button class='admin_black_bt_mn' value='���û���' onclick=\"btn_check(this.form, 'delete')\">";

echo "</td>";
echo "<td width=30% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script>document.fsearch.sfl.value = '$sfl';</script>";
?>
</form>

<script type="text/javascript">
function board_copy(bo_table) {
    window.open("./board_copy.php?bo_table="+bo_table, "BoardCopy", "left=10,top=10,width=500,height=200");
}
</script>

<script>
// POST ������� ����
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n���� �����Ͻðڽ��ϱ�?")) {
        f.bo_table.value = val;
		f.action         = action_url;
		f.submit();
	}
}
</script>

<form name='fpost' method='post'>
<input type='hidden' name='sst'   value='<?=$sst?>'>
<input type='hidden' name='sod'   value='<?=$sod?>'>
<input type='hidden' name='sfl'   value='<?=$sfl?>'>
<input type='hidden' name='stx'   value='<?=$stx?>'>
<input type='hidden' name='page'  value='<?=$page?>'>
<input type='hidden' name='token' value='<?=$token?>'>
<input type='hidden' name='bo_table'>
</form>

<?
include_once("./admin.tail.php");
?>
