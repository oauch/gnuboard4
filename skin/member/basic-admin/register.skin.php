<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>
<link rel="stylesheet" type="text/css" media="screen" href="../adm/admin.style.css" />



<div class="adm_member">
<form name="fregister" method="POST" onsubmit="return fregister_submit(this);" autocomplete="off">

<div id="adm_register_topbt">
<a href="#;" class="on">�������</a>
<a href="#;">ȸ�����Ծ���ۼ�</a>
<a href="#;">���ԿϷ�</a>
</div>
<div style="clear:both;"></div>


    <table width="100%" cellpadding="0" cellspacing="0" class="adm_register">
        <tr> 
            <td class="adm_register01">[ȸ�����Ծ��]</td>
        </tr>
        <tr> 
            <td align="center" valign="top"><textarea style="width:100%" rows=10 readonly><?=get_text($config[cf_stipulation])?></textarea></td>
        </tr>
        <tr> 
            <td height=40>
                <input type=radio value=1 name=agree id=agree11>&nbsp;<label for=agree11>�����մϴ�.</label>
                <input type=radio value=0 name=agree id=agree10>&nbsp;<label for=agree10>�������� �ʽ��ϴ�.</label>
            </td>
        </tr>
    </table>



    <table width="100%" cellpadding="0" cellspacing="0" class="adm_register">
        <tr> 
            <td class="adm_register01">[����������޹�ħ]</td>
        </tr>
        <tr> 
            <td align="center" valign="top"><textarea style="width:100%" rows=10 readonly><?=get_text($config[cf_privacy])?></textarea></td>
        </tr>
        <tr> 
            <td height=40>
                <input type=radio value=1 name=agree2 id=agree21>&nbsp;<label for=agree21>�����մϴ�.</label>
                <input type=radio value=0 name=agree2 id=agree20>&nbsp;<label for=agree20>�������� �ʽ��ϴ�.</label>
            </td>
        </tr>
    </table>



<div align=center>
<input type=submit class=admin_black_bt value='Ȯ��'>
</div>

</form>


</div>
<script type="text/javascript">
function fregister_submit(f) 
{
    var agree1 = document.getElementsByName("agree");
    if (!agree1[0].checked) {
        alert("ȸ�����Ծ���� ���뿡 �����ϼž� ȸ������ �Ͻ� �� �ֽ��ϴ�.");
        agree1[0].focus();
        return false;
    }

    var agree2 = document.getElementsByName("agree2");
    if (!agree2[0].checked) {
        alert("����������޹�ħ�� ���뿡 �����ϼž� ȸ������ �Ͻ� �� �ֽ��ϴ�.");
        agree2[0].focus();
        return false;
    }

    f.action = "./register_form.php";
    return true;
}

if (typeof(document.fregister.mb_name) != "undefined")
    document.fregister.mb_name.focus();
</script>
