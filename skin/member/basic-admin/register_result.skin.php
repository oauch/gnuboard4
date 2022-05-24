<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" type="text/css" media="screen" href="../adm/admin.style.css" />



<div class="adm_member">

<div id="adm_register_topbt">
<a href="#;">약관동의</a>
<a href="#;">회원가입양식작성</a>
<a href="#;" class="on">가입완료</a>
</div>
<div style="clear:both;"></div>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
        <td width="100%" align="center" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center"><b><?=$mb[mb_name]?></b>님의 회원가입을 진심으로 축하합니다.
                        <p>회원님의 아이디는 <b><?=$mb[mb_id]?></b> 입니다.
					    <p>회원님의 패스워드는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.
                        <p>아이디, 패스워드 분실시에는 회원가입시 입력하신 패스워드 분실시 질문, 답변을 이용하여 찾을 수 있습니다.
                        
                        <? if ($config[cf_use_email_certify]) { ?>
                        <p>E-mail(<?=$mb[mb_email]?>)로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다.
                        <? } ?>

                        <p>회원의 탈퇴는 언제든지 가능하며 탈퇴 후 일정기간이 지난 후, 회원님의 모든 소중한 정보는 삭제하고 있습니다.<p>감사합니다.</td>
                </tr>
            </table>
	    </td>
    </tr>

    <tr align="center" valign="bottom"> 
        <td height="60" align="center"><a href="<?=$g4[url]?>/"><div class=admin_black_bt style="width:100px; text-decoration:none;">확인</div></a></td>
    </tr>
</table>
</div>
