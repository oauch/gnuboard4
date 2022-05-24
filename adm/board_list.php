<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

// DHTML 에디터 사용 필드 추가 : 061021
sql_query(" ALTER TABLE `$g4[board_table]` ADD `bo_use_dhtml_editor` TINYINT NOT NULL AFTER `bo_use_secret` ", false);
// RSS 보이기 사용 필드 추가 : 061106
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
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * 
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>처음</a>";

$g4[title] = "게시판관리";
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
    <td width=50% align=left><?=$listall?> (게시판수 : <?=number_format($total_count)?>개)</td>
    <td width=50% align=right class='admin_baic_select'>
        <select name=sfl>
            <option value='bo_table'>TABLE</option>
            <option value='bo_subject'>제목</option>
            <option value='a.gr_id'>그룹ID</option>
        </select>
        <input type=text name=stx required itemname='검색어' value='<?=$stx?>' class='admin_baic_input'>
	<input type=submit value='확인' class=admin_black_bt_sc>
	</td>
</tr>
</form>
</table>


<div class="admin_tip_normal">
<b class="admin_tip_c">[게시판관리]</b> 페이지는 게시판 생성 및 삭제,수정하는 페이지로 게시물관리는 관리자 페이지가 아닌 로그인 상태로 <b class="admin_tip_c">[내홈페이지]</b>에 접속하신 후 관리를 진행해주셔야합니다.<br>
현재 페이지에서 <b class="admin_tip_c">게시판 자체를 삭제하거나 수정</b>을 하실 경우 복구가 어려울 수 있으며, 게시판생성으로 인한 추가비용이 발샐되실 수 있습니다. 
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
    <td><?=subject_sort_link("bo_subject")?>제목</a></td>
    <td>그룹</td>
    <td>스킨</td>
	<td><a href="./board_form.php"><b class="admin_org_plus">+생성</b></td>
</tr>
<?
// 스킨디렉토리
$skin_options = "";
$arr = get_skin_dir("board");
for ($k=0; $k<count($arr); $k++) 
{
    $option = $arr[$k];
    if (strlen($option) > 10)
        $option = substr($arr[$k], 0, 18) . "…";

    $skin_options .= "<option value='$arr[$k]'>$option</option>";
}

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $s_upd = "<a href='./board_form.php?w=u&bo_table=$row[bo_table]&$qstr'><b class='admin_org font8pt'>수정</b></a>";
    $s_del = "";
    if ($is_admin == "super") {
        //$s_del = "<a href=\"javascript:del('./board_delete.php?bo_table=$row[bo_table]&$qstr');\"><img src='img/icon_delete.gif' border=0 title='삭제'></a>";
        $s_del = "<a href=\"javascript:post_delete('board_delete.php', '$row[bo_table]');\"><b class='font8pt'>삭제</b></a>";
    }
    $s_copy = "<a href=\"javascript:board_copy('$row[bo_table]');\"><b class='font8pt'>복사</b></a>";

    /*
    // 스킨디렉토리
    $skin_options = "";
    $arr = get_skin_dir("board");
    for ($k=0; $k<count($arr); $k++) 
    {
        $option = $arr[$k];
        if (strlen($option) > 10)
            $option = substr($arr[$k], 0, 18) . "…";

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
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>"; 

echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=70%>";
echo "<input type=button class='admin_black_bt_mn' value='선택수정' onclick=\"btn_check(this.form, 'update')\"> ";

if ($is_admin == "super")
    echo "<input type=button class='admin_black_bt_mn' value='선택삭제' onclick=\"btn_check(this.form, 'delete')\">";

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
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
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
