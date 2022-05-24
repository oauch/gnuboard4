<?
$sub_menu = "800100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "SMS 기본설정";

$sms4[cf_ip] = '115.68.47.4';

if ($sms4[cf_id] && $sms4[cf_pw])
{
    $res = get_sock("http://115.68.47.5/web_module/point_check.html?sms_id=$sms4[cf_id]&sms_pw=$sms4[cf_pw]");

    $res = explode(';', $res);
    $userinfo = array(
        'code'      => $res[0], // 결과코드
        'coin'      => $res[1], // 고객 잔액 (충전제만 해당)
        'gpay'      => $res[2], // SMS 고객의 건수 별 차감액 표시 (충전제만 해당)
        'gpay2'      => $res[3], // LMS 고객의 건수 별 차감액 표시 (충전제만 해당)
        'payment'   => 'A'  // 요금제 표시, A:충전제, 고정값
    );
}

include_once("../admin.head.php");

?>

<? $admin_HadeNum = "07"; ?>

<!--
<div id="admin_sms_topbt">
<a href="config.php" class="on">SMS 기본설정</a>
<a href="sms_write.php">문자 보내기</a>
<a href="history_list.php">전송내역-건별</a>
<a href="history_num.php">전송내역-번호별</a>
<a href="history_member.php">전송내역-회원</a>
-->

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



<form name=fconfig method=post action='./config_update.php'  enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=cf_ip value='<?=$sms4[cf_ip]?>'>

<table cellpadding=0 cellspacing=0 width=100% border=0 class="admin_basic_board_write">
<colgroup width=20%></colgroup>
<colgroup width=80% bgcolor=#FFFFFF></colgroup>
<tr class='ht'>
    <td colspan=2 align=left><div class="admin_title01">SMS 기본설정</div> <!--?=subtitle($g4[title])? --></td>
</tr>

<tr>
	<td>SMSHUB 서비스 신청</td>
	<td><a href='http://www.smshub.co.kr/rankup_module/rankup_member/member_article_r.html' target=_blank>http://www.smshub.co.kr/rankup_module/rankup_member/member_article_r.html</a></td>
</tr>
<tr>
	<td>SMSHUB 회원아이디</td>
	<td>
		<input type=text name=cf_id value='<?=$sms4[cf_id]?>' size=20 required itemname='SMSHUB 회원아이디'>
		<?=help("SMSHUB에서 사용하시는 회원아이디를 입력합니다.");?>	</td>
</tr>
<tr>
	<td>SMSHUB 패스워드</td>
	<td>
		<input type=password name=cf_pw value='<?=$sms4[cf_pw]?>' required itemname='SMSHUB 패스워드'>
		<?=help("SMSHUB에서 사용하시는 패스워드를 입력합니다.")?>
        <? if (!$sms4[cf_pw]) { ?>  &nbsp; 현재 패스워드가 입력되어 있지 않습니다.	<?}?> </td>
</tr>
<!--
<tr>
	<td>SMSHUB 서버 호스트</td>
	<td>
		<input type=text name=cf_ip value='<?=$sms4[cf_ip]?>' size=20 required itemname='SMSHUB 서버 호스트'>
		<img src='../../adm/img/icon_help.gif' border=0 width=15 height=15 align=absmiddle onclick="help('help33', 0, 0);" style='cursor:hand;'><div id='help33' style='position:absolute; display:none;'><div id='csshelp1'><div id='csshelp2'><div id='csshelp3'>SMSHUB에서 문자메세지를 발송하는 서버 호스트 를 입력하십시오.<br><br>기본값은  sms.smshub.co.kr 입니다.</div></div></div></div>	</td>
</tr>
-->
<tr>
	<td>요금제</td>
	<td>
        <?
        if ($userinfo[payment] == 'A')
            echo '충전제';
        else if ($userinfo[payment] == 'C')
            echo '정액제';
        else
            echo '가입해주세요.';
        ?>
	</td>
</tr>
<? if ($userinfo[payment] == 'A') { ?>
<tr>
	<td>캐쉬 잔액</td>
	<td>
		<?=number_format($userinfo[coin])?> 캐쉬.
        <input type=button class=btn1 value='캐쉬충전' onclick="window.open('http://www.smshub.co.kr/rankup_module/rankup_member/login_r.html','smshub_payment','')">
    </td>
</tr>
<tr>
	<td>SMS 남은건수</td>
	<td>
		<?=number_format($userinfo[coin] / $userinfo[gpay])?> 건.
    </td>
</tr>
<tr>
	<td>LMS 남은건수</td>
	<td>
		<?=number_format($userinfo[coin] / $userinfo[gpay2])?> 건.
    </td>
</tr>
<tr>
	<td>SMS 건수별 금액</td>
	<td>
		<?=number_format($userinfo[gpay])?> 캐쉬.
    </td>
</tr>
<tr>
	<td>LMS 건수별 금액</td>
	<td>
		<?=number_format($userinfo[gpay2])?> 캐쉬.
    </td>
</tr>
<? } ?>
<tr>
	<td>회신번호</td>
	<td>
		<input type=text name=cf_phone value='<?=$sms4[cf_phone]?>' size=20 required telnumber itemname='회신번호'>
		<?=help("관리자 또는 보내시는분의 핸드폰번호를 입력하세요.<br><br>예) 010-123-4567");?>	</td>
	</td>
</tr>
<tr>
	<td>MYSQL USER</td>
	<td><?=$mysql_user?></td>
</tr>
<tr>
	<td>MYSQL DB</td>
	<td><?=$mysql_db?></td>
</tr>
<tr>
	<td>서버 IP</td>
	<td><?=$_SERVER[SERVER_ADDR]?></td>
</tr>

<tr>
	<td>회원간 문자전송</td>
	<td>
        <input class='admin_input_box' type="checkbox" name=cf_member <?if ($sms4[cf_member]) echo 'checked'?>> 허용
		<?=help("허용에 체크하면 회원간에 문자전송이 가능합니다.");?>
	</td>
</tr>
<tr>
	<td>문자전송가능 레벨</td>
	<td>
        <select name=cf_level>
        <? for ($i=1; $i<=10; $i++) { ?>
        <option value='<?=$i?>' <?if ($sms4[cf_level] == $i) echo 'selected';?> > <?=$i?> </option>
        <? } ?>
        </select>
        레벨 이상
		<?=help("문자전송이 가능한 회원레벨을 선택해주세요.");?>
	</td>
</tr>
<tr>
	<td>문자전송 차감 포인트</td>
	<td>
		<input type=text name=cf_point value='<?=$sms4[cf_point]?>' size=10 required itemname="회원 문자전송 포인트"> 포인트
		<?=help("회원이 문자를 전송할시에 차감할 포인트를 입력해주세요. 0이면 포인트를 차감하지 않습니다.");?>
	</td>
</tr>

<tr>
	<td>문자전송 하루제한 갯수 </td>
	<td>
		<input type=text name=cf_day_count value='<?=$sms4[cf_day_count]?>' size=10 required itemname="회원 전송 하루제한 갯수"> 건
		<?=help("회원이 하루에 보낼수 있는 문자 갯수를 입력해주세요. 0이면 제한하지 않습니다.");?>
	</td>
</tr>

</table>

<p align=center>
	<input type=submit class=admin_black_bt accesskey='s' value='확인'>
</p>

</form>


<?
include_once("../admin.tail.php");
?>
