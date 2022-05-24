<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" type="text/css" media="screen" href="../adm/admin.style.css" />



<div class="adm_member">
<form name="fregister" method="POST" onsubmit="return fregister_submit(this);" autocomplete="off">

<div id="adm_register_topbt">
<a href="#;" class="on">약관동의</a>
<a href="#;">회원가입양식작성</a>
<a href="#;">가입완료</a>
</div>
<div style="clear:both;"></div>


    <table width="100%" cellpadding="0" cellspacing="0" class="adm_register">
        <tr> 
            <td class="adm_register01">[회원가입약관]</td>
        </tr>
        <tr> 
            <td align="center" valign="top"><textarea style="width:100%" rows=10 readonly><?=get_text($config[cf_stipulation])?></textarea></td>
        </tr>
        <tr> 
            <td height=40>
                <input type=radio value=1 name=agree id=agree11>&nbsp;<label for=agree11>동의합니다.</label>
                <input type=radio value=0 name=agree id=agree10>&nbsp;<label for=agree10>동의하지 않습니다.</label>
            </td>
        </tr>
    </table>



    <table width="100%" cellpadding="0" cellspacing="0" class="adm_register">
        <tr> 
            <td class="adm_register01">[개인정보취급방침]</td>
        </tr>
        <tr> 
            <td align="center" valign="top"><textarea style="width:100%" rows=10 readonly><?=get_text($config[cf_privacy])?></textarea></td>
        </tr>
        <tr> 
            <td height=40>
                <input type=radio value=1 name=agree2 id=agree21>&nbsp;<label for=agree21>동의합니다.</label>
                <input type=radio value=0 name=agree2 id=agree20>&nbsp;<label for=agree20>동의하지 않습니다.</label>
            </td>
        </tr>
    </table>



<div align=center>
<input type=submit class=admin_black_bt value='확인'>
</div>

</form>


</div>
<script type="text/javascript">
function fregister_submit(f) 
{
    var agree1 = document.getElementsByName("agree");
    if (!agree1[0].checked) {
        alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
        agree1[0].focus();
        return false;
    }

    var agree2 = document.getElementsByName("agree2");
    if (!agree2[0].checked) {
        alert("개인정보취급방침의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
        agree2[0].focus();
        return false;
    }

    f.action = "./register_form.php";
    return true;
}

if (typeof(document.fregister.mb_name) != "undefined")
    document.fregister.mb_name.focus();
</script>
