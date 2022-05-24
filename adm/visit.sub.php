<?
if (!defined("_GNUBOARD_")) exit;

include_once("$g4[path]/lib/visit.lib.php");

if (empty($fr_date)) $fr_date = $g4[time_ymd];
if (empty($to_date)) $to_date = $g4[time_ymd];

$qstr = "fr_date=$fr_date&to_date=$to_date";
?>


<table width=100% cellpadding=3 cellspacing=1>
<form name=fvisit method=get>
<tr>
    <td valign="middle">
        <b>기간</b> : 
        <input type='text' name='fr_date' size=15 maxlength=10 value='<?=$fr_date?>' class=admin_baic_input>
        -
        <input type='text' name='to_date' size=15 maxlength=10 value='<?=$to_date?>' class=admin_baic_input>
        &nbsp;
        <input type=button class=admin_black_bt_sc value='접속자'   onclick="fvisit_submit('visit_list.php');">
        <input type=button class=admin_black_bt_sc value='도메인'   onclick="fvisit_submit('visit_domain.php');">
        <input type=button class=admin_black_bt_sc value='브라우저' onclick="fvisit_submit('visit_browser.php');">
        <input type=button class=admin_black_bt_sc value='OS'       onclick="fvisit_submit('visit_os.php');">
        <input type=button class=admin_black_bt_sc value='시간'     onclick="fvisit_submit('visit_hour.php');">
        <input type=button class=admin_black_bt_sc value='요일'     onclick="fvisit_submit('visit_week.php');">
        <input type=button class=admin_black_bt_sc value='일'       onclick="fvisit_submit('visit_date.php');">
        <input type=button class=admin_black_bt_sc value='월'       onclick="fvisit_submit('visit_month.php');">
        <input type=button class=admin_black_bt_sc value='년'       onclick="fvisit_submit('visit_year.php');">
    </td>
</tr>
</form>
</table>

<div class="admin_tip_normal">
홈페이지 접속자 통계입니다. 접속경로 및 브라우저 등 100% 노출되지 않는 부분이므로<br>
정확한 통계를 원하시는 경우 <b class="admin_tip_c">[접속자 마케팅]</b>을 진행하셔야 하며 저희는 <b class="admin_tip_c">[접속자 마케팅]</b>을 지원하고 있지 않습니다.  
</div>


<script type='text/javascript'>
function fvisit_submit(act) 
{
    var f = document.fvisit;
    f.action = act;
    f.submit();
}
</script>
