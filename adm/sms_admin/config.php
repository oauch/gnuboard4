<?
$sub_menu = "800100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "SMS �⺻����";

$sms4[cf_ip] = '115.68.47.4';

if ($sms4[cf_id] && $sms4[cf_pw])
{
    $res = get_sock("http://115.68.47.5/web_module/point_check.html?sms_id=$sms4[cf_id]&sms_pw=$sms4[cf_pw]");

    $res = explode(';', $res);
    $userinfo = array(
        'code'      => $res[0], // ����ڵ�
        'coin'      => $res[1], // �� �ܾ� (�������� �ش�)
        'gpay'      => $res[2], // SMS ���� �Ǽ� �� ������ ǥ�� (�������� �ش�)
        'gpay2'      => $res[3], // LMS ���� �Ǽ� �� ������ ǥ�� (�������� �ش�)
        'payment'   => 'A'  // ����� ǥ��, A:������, ������
    );
}

include_once("../admin.head.php");

?>

<? $admin_HadeNum = "07"; ?>

<!--
<div id="admin_sms_topbt">
<a href="config.php" class="on">SMS �⺻����</a>
<a href="sms_write.php">���� ������</a>
<a href="history_list.php">���۳���-�Ǻ�</a>
<a href="history_num.php">���۳���-��ȣ��</a>
<a href="history_member.php">���۳���-ȸ��</a>
-->

<!--
<a href="num_group.php">�ڵ�����ȣ �׷�</a>
<a href="num_book.php">�ڵ�����ȣ ����</a>
<a href="num_book_file.php">�ڵ�����ȣ ����</a>
<a href="form_group.php">�̸�Ƽ�� �׷�</a>
<a href="form_list.php">�̸�Ƽ�� ����</a>
<a href="member_update.php">ȸ������������Ʈ</a>
<a href="upgrade.php">���׷��̵�</a>
-->
</div>



<form name=fconfig method=post action='./config_update.php'  enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=cf_ip value='<?=$sms4[cf_ip]?>'>

<table cellpadding=0 cellspacing=0 width=100% border=0 class="admin_basic_board_write">
<colgroup width=20%></colgroup>
<colgroup width=80% bgcolor=#FFFFFF></colgroup>
<tr class='ht'>
    <td colspan=2 align=left><div class="admin_title01">SMS �⺻����</div> <!--?=subtitle($g4[title])? --></td>
</tr>

<tr>
	<td>SMSHUB ���� ��û</td>
	<td><a href='http://www.smshub.co.kr/rankup_module/rankup_member/member_article_r.html' target=_blank>http://www.smshub.co.kr/rankup_module/rankup_member/member_article_r.html</a></td>
</tr>
<tr>
	<td>SMSHUB ȸ�����̵�</td>
	<td>
		<input type=text name=cf_id value='<?=$sms4[cf_id]?>' size=20 required itemname='SMSHUB ȸ�����̵�'>
		<?=help("SMSHUB���� ����Ͻô� ȸ�����̵� �Է��մϴ�.");?>	</td>
</tr>
<tr>
	<td>SMSHUB �н�����</td>
	<td>
		<input type=password name=cf_pw value='<?=$sms4[cf_pw]?>' required itemname='SMSHUB �н�����'>
		<?=help("SMSHUB���� ����Ͻô� �н����带 �Է��մϴ�.")?>
        <? if (!$sms4[cf_pw]) { ?>  &nbsp; ���� �н����尡 �ԷµǾ� ���� �ʽ��ϴ�.	<?}?> </td>
</tr>
<!--
<tr>
	<td>SMSHUB ���� ȣ��Ʈ</td>
	<td>
		<input type=text name=cf_ip value='<?=$sms4[cf_ip]?>' size=20 required itemname='SMSHUB ���� ȣ��Ʈ'>
		<img src='../../adm/img/icon_help.gif' border=0 width=15 height=15 align=absmiddle onclick="help('help33', 0, 0);" style='cursor:hand;'><div id='help33' style='position:absolute; display:none;'><div id='csshelp1'><div id='csshelp2'><div id='csshelp3'>SMSHUB���� ���ڸ޼����� �߼��ϴ� ���� ȣ��Ʈ �� �Է��Ͻʽÿ�.<br><br>�⺻����  sms.smshub.co.kr �Դϴ�.</div></div></div></div>	</td>
</tr>
-->
<tr>
	<td>�����</td>
	<td>
        <?
        if ($userinfo[payment] == 'A')
            echo '������';
        else if ($userinfo[payment] == 'C')
            echo '������';
        else
            echo '�������ּ���.';
        ?>
	</td>
</tr>
<? if ($userinfo[payment] == 'A') { ?>
<tr>
	<td>ĳ�� �ܾ�</td>
	<td>
		<?=number_format($userinfo[coin])?> ĳ��.
        <input type=button class=btn1 value='ĳ������' onclick="window.open('http://www.smshub.co.kr/rankup_module/rankup_member/login_r.html','smshub_payment','')">
    </td>
</tr>
<tr>
	<td>SMS �����Ǽ�</td>
	<td>
		<?=number_format($userinfo[coin] / $userinfo[gpay])?> ��.
    </td>
</tr>
<tr>
	<td>LMS �����Ǽ�</td>
	<td>
		<?=number_format($userinfo[coin] / $userinfo[gpay2])?> ��.
    </td>
</tr>
<tr>
	<td>SMS �Ǽ��� �ݾ�</td>
	<td>
		<?=number_format($userinfo[gpay])?> ĳ��.
    </td>
</tr>
<tr>
	<td>LMS �Ǽ��� �ݾ�</td>
	<td>
		<?=number_format($userinfo[gpay2])?> ĳ��.
    </td>
</tr>
<? } ?>
<tr>
	<td>ȸ�Ź�ȣ</td>
	<td>
		<input type=text name=cf_phone value='<?=$sms4[cf_phone]?>' size=20 required telnumber itemname='ȸ�Ź�ȣ'>
		<?=help("������ �Ǵ� �����ôº��� �ڵ�����ȣ�� �Է��ϼ���.<br><br>��) 010-123-4567");?>	</td>
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
	<td>���� IP</td>
	<td><?=$_SERVER[SERVER_ADDR]?></td>
</tr>

<tr>
	<td>ȸ���� ��������</td>
	<td>
        <input class='admin_input_box' type="checkbox" name=cf_member <?if ($sms4[cf_member]) echo 'checked'?>> ���
		<?=help("��뿡 üũ�ϸ� ȸ������ ���������� �����մϴ�.");?>
	</td>
</tr>
<tr>
	<td>�������۰��� ����</td>
	<td>
        <select name=cf_level>
        <? for ($i=1; $i<=10; $i++) { ?>
        <option value='<?=$i?>' <?if ($sms4[cf_level] == $i) echo 'selected';?> > <?=$i?> </option>
        <? } ?>
        </select>
        ���� �̻�
		<?=help("���������� ������ ȸ�������� �������ּ���.");?>
	</td>
</tr>
<tr>
	<td>�������� ���� ����Ʈ</td>
	<td>
		<input type=text name=cf_point value='<?=$sms4[cf_point]?>' size=10 required itemname="ȸ�� �������� ����Ʈ"> ����Ʈ
		<?=help("ȸ���� ���ڸ� �����ҽÿ� ������ ����Ʈ�� �Է����ּ���. 0�̸� ����Ʈ�� �������� �ʽ��ϴ�.");?>
	</td>
</tr>

<tr>
	<td>�������� �Ϸ����� ���� </td>
	<td>
		<input type=text name=cf_day_count value='<?=$sms4[cf_day_count]?>' size=10 required itemname="ȸ�� ���� �Ϸ����� ����"> ��
		<?=help("ȸ���� �Ϸ翡 ������ �ִ� ���� ������ �Է����ּ���. 0�̸� �������� �ʽ��ϴ�.");?>
	</td>
</tr>

</table>

<p align=center>
	<input type=submit class=admin_black_bt accesskey='s' value='Ȯ��'>
</p>

</form>


<?
include_once("../admin.tail.php");
?>
