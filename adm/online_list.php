<?
$sub_menu = "100100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[online_table] ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "ol_tel" :
        case "ol_hp" :
            $sql_search .= " ($sfl like '%$stx') ";
            break;
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "ol_datetime";
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
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 폼확인수
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and ol_read_date <> ''
         $sql_order ";
$row = sql_fetch($sql);
$read_count = $row[cnt];

// 폼미확인수
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and ol_read_date = ''
         $sql_order ";
$row = sql_fetch($sql);
$notread_count = $row[cnt];

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$g4[title] = "온라인문의";
include_once("./admin.head.php");

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 15;
?>

<? $admin_HadeNum = "06"; ?>

<script language="javascript" src="<?=$g4[path]?>/js/sideview.js"></script>
<script language="JavaScript">
var list_update_php = "online_list_update.php";
var list_delete_php = "online_list_delete.php";
</script>

<table width=100%>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left><?=$listall?> 
        (총문의수 : <?=number_format($total_count)?>, 
        <font color=orange>미확인 : <?=number_format($notread_count)?></font></a>, 
        <font color=crimson>확인 : <?=number_format($read_count)?></font></a>)
    </td>
    <td width=50% align=right class='admin_baic_select'>
        <select name=sfl class=cssfl>
            <option value='ol_name'>이름</option>
            <option value='ol_kind'>분류</option>
            <option value='ol_email'>E-MAIL</option>
            <option value='ol_tel'>전화번호</option>
            <option value='ol_datetime'>입력일시</option>
            <option value='ol_ip'>IP</option>
        </select>
        <input type=text name=stx required itemname='검색어' value='<? echo $stx ?>' class="admin_baic_input">
        <input type=submit value='확인' class=admin_black_bt_sc>
	</td>
</tr>
</form>
</table>


<div class="admin_tip_normal">
접수된 문의글은 오른쪽 <b class="admin_tip_c">[수정]</b> 버튼을 클릭하시면 자세한 내용 확인 가능합니다. 
</div>


<table width=100% cellpadding=0 cellspacing=0 id="admin_basic_board">
<form name=onlinelist method=post>
<input type=hidden name=sst  value='<?=$sst?>'>
<input type=hidden name=sod  value='<?=$sod?>'>
<input type=hidden name=sfl  value='<?=$sfl?>'>
<input type=hidden name=stx  value='<?=$stx?>'>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name="token" value="<?=$token?>">
<colgroup width=30>
<colgroup width=90>
<colgroup width=90>
<colgroup width=''>
<colgroup width=130>
<colgroup width=130>
<colgroup width=100>
<colgroup width=80>
<colgroup width=100>

<tr class="admin_basic_board_topln">
    <td><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></td>
    <td><?=subject_sort_link('ol_kind')?>분류</a></td>
    <td><?=subject_sort_link('ol_name')?>이름</a></td>
    <td><?=subject_sort_link('ol_email')?>이메일</a></td>
    <td><?=subject_sort_link('ol_hp')?>핸드폰</a></td>
    <td><?=subject_sort_link('ol_tel')?>전화번호</a></td>
    <td><?=subject_sort_link('ol_tel')?>확인여부</a></td>
    <td><?=subject_sort_link('ol_datetime')?>문의날짜</a></td>
	<td>수정/삭제</td>
</tr>

<?
for ($i=0; $row=sql_fetch_array($result); $i++) {

	if($row[ol_kind]){

	}

	$s_mod = "<a href=\"./online_form.php?$qstr&w=u&ol_id=$row[ol_id]\"><b class='admin_org font8pt'>수정</b></a>";
//	$s_del = "<a href=\"javascript:del('./online_delete.php?$qstr&w=d&ol_id=$row[ol_id]');\"><img src='img/icon_delete.gif' border=0 title='삭제'></a>";
    $s_del = "<a href=\"javascript:post_delete('online_delete.php', '$row[ol_id]');\"><b class='font8pt'>삭제</b></a>";

    $list = $i%2;
    echo "
    <input type=hidden name=ol_id[$i] value='$row[ol_id]'>
    <tr class='list$list col1 ht center'>
        <td><input type=checkbox name=chk[] value='$i'></td>
        <td><nobr style='display:block; overflow:hidden; width:90px;'>$row[ol_kind]</nobr></td>
        <td><nobr style='display:block; overflow:hidden; width:90px;'>$row[ol_name]</nobr></td>
        <td><nobr style='display:block;'>$row[ol_email]</nobr></td>
        <td><nobr style='display:block; overflow:hidden; width:130px;'>$row[ol_hp]</nobr></td>
        <td><nobr style='display:block; overflow:hidden; width:130px;'>$row[ol_tel]</nobr></td>
        <td><nobr style='display:block; overflow:hidden; width:80px;'>".substr($row[ol_read_date],0,11)."</nobr></td>
        <td><nobr style='display:block; overflow:hidden; width:80px;'>".substr($row[ol_datetime],0,11)."</nobr></td>
        <td>$s_mod $s_del </td>
    </tr>";

	echo "
    <tr>
        <td colspan=2 align=center><strong>관리자 메모</strong></td><td colspan=7 align=left height=70><textarea  class=ed name=ol_admmemo[$i] style='width:100%;height:50px;'>$row[ol_admmemo]</textarea></td>
    </tr>";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 class=contentbg>자료가 없습니다.</td></tr>";

echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=50%>";
echo "<input type=button class='admin_black_bt_mn' value='선택수정' onclick=\"btn_check(this.form, 'update')\">&nbsp;";
echo "<input type=button class='admin_black_bt_mn' value='선택삭제' onclick=\"btn_check(this.form, 'delete')\">";
echo "</td>";
echo "<td width=50% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script language='javascript'>document.fsearch.sfl.value = '$sfl';</script>\n";
?>
</form>

* 주소 및 이름 클릭시 자동으로 확인 날짜가 입력 되며, 삭제시 영구 삭제 됩니다.

<script>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        f.ol_id.value = val;
		f.action      = action_url;
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
<input type='hidden' name='ol_id'>
</form>

<?
include_once ("./admin.tail.php");
?>
