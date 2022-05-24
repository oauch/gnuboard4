<?
$sub_menu = "800400";
include_once("./_common.php");

$spage_size = 20;
$colspan = 10;

auth_check($auth[$sub_menu], "r");

$g4[title] = "문자전송 상세내역";

if (!is_numeric($wr_no))
    alert('전송 고유 번호가 없습니다.');

if (!$spage) $spage = 1;

if ($sst && trim($ssv))
    $sql_search = " and $sst like '%$ssv%' ";
else
    $sql_search = "";

if ($wr_renum) {
    $sql_renum = " and wr_renum='$wr_renum' ";
    $re_text = " <span style='font-weight:normal; color:red;'>(재전송)</span>";
} else
    $sql_renum = " and wr_renum='0'";

$total_res = sql_fetch("select count(*) as cnt from $g4[sms4_history_table] where wr_no='$wr_no' $sql_search $sql_renum");
$total_count = $total_res[cnt];

$total_spage = (int)($total_count/$spage_size) + ($total_count%$spage_size==0 ? 0 : 1);
$spage_start = $spage_size * ( $spage - 1 );

$paging = get_paging(10, $spage, $total_spage, "history_view.php?wr_no=$wr_no&wr_renum=$wr_renum&page=$page&st=$st&sv=$sv&sst=$sst&ssv=$ssv&spage="); 

$vnum = $total_count - (($spage-1) * $spage_size);

$write = sql_fetch("select * from $g4[sms4_write_table] where wr_no='$wr_no' $sql_renum");
if ($write[wr_booking] == '0000-00-00 00:00:00')
    $write[wr_booking] = '즉시전송';

include_once("$g4[admin_path]/admin.head.php");
?>

<? $admin_HadeNum = "07"; ?>


<div id="admin_sms_topbt">
<a href="config.php">SMS 기본설정</a>
<a href="sms_write.php">문자 보내기</a>
<a href="history_list.php" class="on">전송내역-건별</a>
<a href="history_num.php">전송내역-번호별</a>
<a href="history_member.php">전송내역-회원</a>


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



<script language=javascript>
function re_send()
{
    <? if (!$write[wr_failure]) { ?>
    alert('실패한 전송이 없습니다.');
    <? } else { ?>
    if (!confirm('전송에 실패한 SMS 를 재전송 하시겠습니까?')) 
        return;

    act = window.open('sms_ing.php', 'act', 'width=300, height=200');
    act.focus();

    location.href = './history_send.php?w=f&page=<?=$page?>&st=<?=$st?>&sv=<?=$sv?>&wr_no=<?=$wr_no?>&wr_renum=<?=$wr_renum?>';
    <? } ?>
}
function all_send()
{
    if (!confirm('전체 SMS 를 재전송 하시겠습니까?\n\n예약전송일 경우 예약일시는 다시 설정하셔야 합니다.')) 
        return;
/*
    act = window.open('sms_ing.php', 'act', 'width=300, height=200');
    act.focus();

    location.href = './history_send.php?w=a&page=<?=$page?>&st=<?=$st?>&sv=<?=$sv?>&wr_no=<?=$wr_no?>&wr_renum=<?=$wr_renum?>';
*/
    location.href = './sms_write.php?wr_no=<?=$wr_no?>';
}
</script>

<div class="admin_title01">문자전송 정보</div>  <!-- ?=subtitle("문자전송 정보 $re_text")? -->

<table border=0 cellpadding=0 cellspacing=0 width=100% id="admin_basic_board">

<tr>
    <td width=150 height=160 align=center>
        <table border=0 cellpadding=0 cellspacing=5 bgcolor="#F8F8F8" style="border:1px solid #ccc;">
        <tr>
            <td background="img/smsbg.gif" width=120 height=120 align=center>
                <div style="font-family:batang; margin-top:10px; overflow:hidden; width:100px; height:88px; font-size: 9pt; background-color:#88C8F8; text-align:left; word-break:break-all;">
                <?=nl2br($write[wr_message])?>
                </div>
            </td>
        </tr>
        </table>
    </td>
    <td valign=top style="padding-top:10px; line-height:20px;">
        <table border=0 cellpadding=0 cellspacing=2 width=100%>
        <tbody align=center>
        <tr bgcolor=#efefef height=25>
            <td width=33%> <b>전송일시</b> </td>
            <td width=33%> <b>예약일시</b> </td>
            <td width=33%> <b>회신번호</b> </td>
        </tr>
        <tr height=25>
            <td> <?=$write[wr_datetime]?> </td>
            <td> <?=$write[wr_booking]?> </td>
            <td> <?=$write[wr_reply]?> </td>
        </tr>
        <tr bgcolor=#efefef height=25>
            <td> <b>전송건수</b> </td>
            <td> <b>성공건수</b> </td>
            <td> <b>실패건수</b> </td>
        </tr>
        <tr height=25>
            <td> <?=number_format($write[wr_total])?> 건 </td>
            <td> <?=number_format($write[wr_success])?> 건 </td>
            <td> <?=number_format($write[wr_failure])?> 건 </td>
        </tr>
        <tr><td colspan=3 height=1 bgcolor=#efefef></td></tr>
        </tbody>
        </table>
        <div align=right style="margin-top:5px;">
            <input type=button value='전체 다시전송' class=admin_black_bt_mn onclick="all_send()">
            &nbsp;
            <input type=button value='실패 다시전송' class=admin_black_bt_mn onclick="re_send()">
            &nbsp;
            <? if (!$wr_renum) {?>
            <input type=button value='전체목록' class=admin_black_bt_mn onclick="location.href='./history_list.php?page=<?=$page?>&st=<?=$st?>&sv=<?=$sv?>'">
            <? } else { ?>
            <input type=button value='뒤로가기' class=admin_black_bt_mn onclick="location.href='./history_view.php?page=<?=$page?>&st=<?=$st?>&sv=<?=$sv?>&wr_no=<?=$wr_no?>'">
            <? } ?>
        </div>
    </td>
</tr>

</table>

<? if ($write[wr_re_total] && !$wr_renum) { ?>

<div style="margin-top:20px"></div>

<?=subtitle("전송실패 문자 재전송 내역 ")?>

<table border=0 cellpadding=0 cellspacing=0 width=100%>
<colgroup width=70>
<!--<colgroup width=30>-->
<!--<colgroup>-->
<!--<colgroup width=100>-->
<colgroup>
<colgroup width=100>
<colgroup width=100>
<colgroup width=100>
<colgroup width=70>
<tbody align=center>

<tr>
    <td style="font-weight:bold;"> 번호 </td>
    <!--<td> <input type=checkbox> </td>-->
    <!--<td style="font-weight:bold;"> 메세지 </td>-->
    <!--<td style="font-weight:bold;"> 회신번호 </td>-->
    <td style="font-weight:bold;"> 전송일시 </td>
    <td style="font-weight:bold;"> 총건수 </td>
    <td style="font-weight:bold;"> 성공 </td>
    <td style="font-weight:bold;"> 실패 </td>
    <td> - </td>
</tr>

<?
$res = sql_fetch("select count(*) as cnt from $g4[sms4_write_table] where wr_no='$wr_no' and wr_renum>0");
$re_vnum = $res[cnt];

$qry = sql_query("select * from $g4[sms4_write_table] where wr_no='$wr_no' and wr_renum>0 order by wr_renum desc");
while($res = sql_fetch_array($qry)) {
?>
<tr height=30 bgcolor='<?=$bgcolor?>'>
    <td> <?=$re_vnum--?> </td>
    <!--<td> <input type=checkbox> </td>-->
    <!--<td> <span title="<?=$res[wr_message]?>"><?=cut_str($res[wr_message],40)?></span> </td>-->
    <!--<td> <?=$res[wr_reply]?> </td>-->
    <td> <?=$res[wr_datetime]?> </td>
    <td> <?=number_format($res[wr_total])?> </td>
    <td> <?=number_format($res[wr_success])?> </td>
    <td> <?=number_format($res[wr_failure])?> </td>
    <td>
        <a href="./history_view.php?page=<?=$page?>&st=<?=$st?>&sv=<?=$sv?>&wr_no=<?=$res[wr_no]?>&wr_renum=<?=$res[wr_renum]?>"><img src="<?=$g4[admin_path]?>/img/icon_modify.gif" align=absmiddle border=0></a>
        <!--
        <a href="./history_del.php?page=<?=$page?>&st=<?=$st?>&sv=<?=$sv?>&wr_no=<?=$res[wr_no]?>&wr_renum=<?=$res[wr_renum]?>"><img src="<?=$g4[admin_path]?>/img/icon_delete.gif" align=absmiddle border=0></a>
        -->
    </td>
</tr>
<?}?>

</tbody>
</table>
<? } ?>


<div style="margin-top:20px"></div>

<div class="admin_title01">문자전송 목록</div>   <!-- ?=subtitle("문자전송 목록 $re_text")? -->

<table border=0 cellpadding=0 cellspacing=0 width=100% id="admin_basic_board">
<colgroup width=60>
<colgroup width=100>
<colgroup width=100>
<!--<colgroup width=30>-->
<colgroup width=80>
<colgroup>
<colgroup width=150>
<colgroup width=60>
<colgroup width=50>
<colgroup width=50>
<tbody align=center>

<tr class="admin_basic_board_topln">
    <td style="font-weight:bold;"> 번호 </td>
    <td style="font-weight:bold;"> 그룹 </td>
    <!--<td> <input type=checkbox> </td>-->
    <td style="font-weight:bold;"> 이름 </td>
    <td style="font-weight:bold;"> 회원ID </td>
    <td style="font-weight:bold;"> 핸드폰번호 </td>
    <td style="font-weight:bold;"> 전송일시 </td>
    <td style="font-weight:bold;"> 결과 </td>
    <td style="font-weight:bold;"> 비고 </td>
    <td> - </td>
</tr>

<? if (!$total_count) { ?>
<tr height=50>
    <td align=center height=100 colspan=<?=$colspan?> style="color:#999;"> 
        데이터가 없습니다. 
    </td>
</tr>
<?
}
$qry = sql_query("select * from $g4[sms4_history_table] where wr_no='$wr_no' $sql_search $sql_renum order by hs_no desc limit $spage_start, $spage_size");
while($res = sql_fetch_array($qry)) {
    if ($line++%2) 
        $bgcolor = '#F8F8F8'; 
    else 
        $bgcolor = '#ffffff';

    $group = sql_fetch("select * from $g4[sms4_book_group_table] where bg_no='$res[bg_no]'");
    if ($group)
        $bg_name = $group[bg_name];
    else
        $bg_name = '없음';

    if ($res[mb_id]) 
        $mb_id = get_sideview($res[mb_id], $res[mb_id]);
    else
        $mb_id = '비회원';

    $res[hs_log] = str_replace($sms4[cf_pw], '**********', $res[hs_log]);

?>
<tr height=30 bgcolor='<?=$bgcolor?>'>
    <td> <?=number_format($vnum--)?> </td>
    <td> <?=$bg_name?> </td>
    <!--<td> <input type=checkbox> </td>-->
    <td> <?=$res[hs_name]?></a> </td>
    <td> <?=$mb_id?> </td>
    <td> <?=$res[hs_hp]?> </td>
    <td> <?=$res[hs_datetime]?> </td>
    <td> <?=$res[hs_flag]?'성공':'실패'?> </td>
    <td> 
        <img src='../../adm/img/icon_help.gif' border=0 width=15 height=15 align=absmiddle onclick="help('help<?=$vnum?>', -100, 0);" style='cursor:hand;'><div id='help<?=$vnum?>' style='position:absolute; display:none;'><div id='csshelp1'><div id='csshelp2'><div id='csshelp3'>
        <p> <b>결과코드</b> : <?=$res[hs_code]?> <br/> <?=$res[hs_memo]?> </p>
        <p> <b>로그</b> : <?=$res[hs_log]?>  </p>
        </div></div></div></div>
    </td>
    <td>
        <!--
        <a href="./history_view.php?wr_id=<?=$res[wr_no]?>"><img src="<?=$g4[admin_path]?>/img/icon_modify.gif" align=absmiddle border=0></a>
        <a href="./history_del.php?wr_id=<?=$res[wr_no]?>"><img src="<?=$g4[admin_path]?>/img/icon_delete.gif" align=absmiddle border=0></a>
        -->
        <? if ($res[bk_no]) { ?>
        <a href="./history_num.php?wr_id=<?=$res[wr_no]?>&st=bk_no&sv=<?=$res[bk_no]?>"><img src="<?=$g4[admin_path]?>/img/icon_group.gif" align=absmiddle border=0></a>
        <? } else { ?>
        <a href="./history_num.php?wr_id=<?=$res[wr_no]?>&st=hs_hp&sv=<?=$res[hs_hp]?>"><img src="<?=$g4[admin_path]?>/img/icon_group.gif" align=absmiddle border=0></a>
        <? } ?>
    </td>
</tr>
<?}?>

</tbody>
</table>

<p align=center>
<?=$paging?>
</p>

<div align=right class="admin_baic_select">
<form name=search_form method=get action=<?=$PHP_SELF?> style="margin:0; padding:0;">
<input type=hidden name=wr_no value=<?=$wr_no?>>
<input type=hidden name=wr_renum value=<?=$wr_renum?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=st value=<?=$st?>>
<input type=hidden name=sv value=<?=$sv?>>
<select name=sst>
<option value=hs_name <?=$sst=='hs_name'?'selected':''?>>이름</option>
<option value=hs_hp <?=$sst=='hs_hp'?'selected':''?>>핸드폰번호</option>
</select>
<input type=text size=20 name=ssv value="<?=$ssv?>" claass="admin_baic_input">
<input type=submit value='검  색' class=admin_black_bt_mn>
</form>
</div>



<?
include_once("$g4[admin_path]/admin.tail.php");
?>
