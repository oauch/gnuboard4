<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>
<link rel="stylesheet" type="text/css" media="screen" href="../adm/admin.style.css" />



<div class="adm_member">

<div id="adm_register_topbt">
<a href="#;">�������</a>
<a href="#;">ȸ�����Ծ���ۼ�</a>
<a href="#;" class="on">���ԿϷ�</a>
</div>
<div style="clear:both;"></div>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
        <td width="100%" align="center" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center"><b><?=$mb[mb_name]?></b>���� ȸ�������� �������� �����մϴ�.
                        <p>ȸ������ ���̵�� <b><?=$mb[mb_id]?></b> �Դϴ�.
					    <p>ȸ������ �н������ �ƹ��� �� �� ���� ��ȣȭ �ڵ�� ����ǹǷ� �Ƚ��ϼŵ� �����ϴ�.
                        <p>���̵�, �н����� �нǽÿ��� ȸ�����Խ� �Է��Ͻ� �н����� �нǽ� ����, �亯�� �̿��Ͽ� ã�� �� �ֽ��ϴ�.
                        
                        <? if ($config[cf_use_email_certify]) { ?>
                        <p>E-mail(<?=$mb[mb_email]?>)�� �߼۵� ������ Ȯ���� �� �����ϼž� ȸ�������� �Ϸ�˴ϴ�.
                        <? } ?>

                        <p>ȸ���� Ż��� �������� �����ϸ� Ż�� �� �����Ⱓ�� ���� ��, ȸ������ ��� ������ ������ �����ϰ� �ֽ��ϴ�.<p>�����մϴ�.</td>
                </tr>
            </table>
	    </td>
    </tr>

    <tr align="center" valign="bottom"> 
        <td height="60" align="center"><a href="<?=$g4[url]?>/"><div class=admin_black_bt style="width:100px; text-decoration:none;">Ȯ��</div></a></td>
    </tr>
</table>
</div>
