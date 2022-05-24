<?
$sub_menu = "800450";
include_once("./_common.php");

$page_size = 20;
$colspan = 7;

auth_check($auth[$sub_menu], "r");

$g4[title] = "문자전송 내역 (회원)";

if (!$page) $page = 1;

if ($st && trim($sv))
    $sql_search = " and $st like '%$sv%' ";
else
    $sql_search = "";

$total_res = sql_fetch("select count(*) as cnt from $g4[sms4_member_history_table] where 1 $sql_search");
$total_count = $total_res[cnt];

$total_page = (int)($total_count/$page_size) + ($total_count%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$paging = get_paging(10, $page, $total_page, "history_member.php?st=$st&sv=$sv&page="); 

$vnum = $total_count - (($page-1) * $page_size);

include_once("$g4[admin_path]/admin.head.php");
?>

<? $admin_HadeNum = "07"; ?>

<div id="admin_sms_topbt">
<a href="config.php">SMS 기본설정</a>
<a href="sms_write.php">문자 보내기</a>
<a href="history_list.php">전송내역-건별</a>
<a href="history_num.php">전송내역-번호별</a>
<a href="history_member.php" class="on">전송내역-회원</a>


<!--
<a href="num_group.php">핸드폰번호 그룹</a>
<a href="num_book.php">핸드폰번호 관리</a>
<a href="num_book_file.php">핸드폰번호 파일</a>
<a href="form_group.php">이모티콘 그룹</a>
<a href="form_list.php">이모티콘 관리</a>
<a href="member_update.php">회원정보업데이트</a>
<a href="upgrade.php">업그레이드</a>
-->
</div>




<div class="admin_title01">문자전송 내역 (회원)</div> <!-- ?=subtitle($g4[title])? -->

<table border=0 cellpadding=0 cellspacing=0 width=100% id="admin_basic_board">
<colgroup width=50>
<colgroup width=100>
<colgroup width=100>
<colgroup width=100>
<colgroup width=150>
<colgroup width=50>
<colgroup>
<tbody align=center>

<tr class="admin_basic_board_topln">
    <td style="font-weight:bold;"> 번호 </td>
    <td style="font-weight:bold;"> 회원 </td>
    <td style="font-weight:bold;"> 보내는번호 </td>
    <td style="font-weight:bold;"> 받는번호 </td>
    <td style="font-weight:bold;"> 전송일시 </td>
    <td style="font-weight:bold;"> 예약 </td>
    <td style="font-weight:bold;"> Log </td>
</tr>

<? if (!$total_count) { ?>
<tr height=50>
    <td align=center height=100 colspan=<?=$colspan?> style="color:#999;"> 
        데이터가 없습니다. 
    </td>
</tr>
<?
}
$qry = sql_query("select * from $g4[sms4_member_history_table] where 1 $sql_search order by mh_no desc limit $page_start, $page_size");
while($row = sql_fetch_array($qry)) {
    if ($line++%2) 
        $bgcolor = '#F8F8F8'; 
    else 
         $bgcolor = '#ffffff';

    $mb = get_member($row[mb_id]);
    $mb_id = get_sideview($row[mb_id], $mb[mb_nick]);
?>
<tr height=30 bgcolor='<?=$bgcolor?>'>
    <td> <?=$vnum--?> </td>
    <td> <?=$mb_id?> </td>
    <td> <?=$row[mh_reply]?> </td>
    <td> <?=$row[mh_hp]?> </td>
    <td> <?=$row[mh_datetime]?> </td>
    <td> <?=$row[mh_booking]!='0000-00-00 00:00:00'?"<span title='$row[mh_booking]'>√</span>":'';?> </td>
    <td align=left> &nbsp;<?=$row[mh_log]?> </td>
</tr>
<?}?>

</tbody>
</table>

<p align=center>
<?=$paging?>
</p>

<div align=right class="admin_baic_select">
<form name=search_form method=get action=<?=$PHP_SELF?> style="margin:0; padding:0;">
<select name=st>
<option value=mb_id <?=$st=='mh_name'?'selected':''?>>아이디</option>
<option value=mh_hp <?=$st=='mh_hp'?'selected':''?>>받는번호</option>
<option value=mh_reply <?=$st=='mh_reply'?'selected':''?>>보내는번호</option>
</select>
<input type=text size=20 name=sv value="<?=$sv?>" class="admin_baic_input">
<input type=submit value='검  색' class=admin_black_bt_sc>
</form>
</div>



<?
include_once("$g4[admin_path]/admin.tail.php");
?>
