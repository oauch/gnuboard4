<?
$sub_menu = "100100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");

// ���������� ���� ����Ʈ �ʵ� �߰� : 061218
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_memo_send_point` INT NOT NULL AFTER `cf_login_point` ", FALSE);

// ����������ȣ��å �ʵ� �߰� : 061121
$sql = " ALTER TABLE `$g4[config_table]` ADD `cf_privacy` TEXT NOT NULL AFTER `cf_stipulation` ";
sql_query($sql, FALSE);
if (!trim($config[cf_privacy])) {
    $config[cf_privacy] = "�ش� Ȩ�������� �´� ����������޹�ħ�� �Է��մϴ�.";
}

$g4['title'] = "�⺻ȯ�漳��";
include_once ("./admin.head.php");
?>

<? $admin_HadeNum = "01"; ?>

<!-- 
// 2016.12.13 ���� ����� config_form-original.php �� �ֽ��ϴ�. 
// �⺻�������� ȸ�����Լ�������  config_form-original.php�� ������Ź�帮�� 
// ����ϴ� �κи� ������ҽ��ϴ�. 
 -->

<form name='fconfigform' method='post' onsubmit="return fconfigform_submit(this);">
<input type=hidden name=token value='<?=$token?>'>

<table width=100% cellpadding=0 cellspacing=0 border=0 class="admin_basic_board_write">
<colgroup width=20%>
<colgroup width=30%>
<colgroup width=20%>
<colgroup width=30%>
<tr>
    <td colspan=4 align=left><div class="admin_title01">�⺻ ����</div> <!-- ?=subtitle("�⺻ ����")? --></td>
</tr>

<tr>
    <td class="admin_basic_board_writetd">��ȣ��</td>
    <td>
        <input type=text name='cf_title' size='30' required itemname='Ȩ������ ����' value='<?=$config[cf_title]?>'>
    </td>
    <td class="admin_basic_board_writetd">�ְ������</td>
    <td><?=get_member_id_select("cf_admin", 10, $config[cf_admin], "required itemname='�ְ� ������'")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">�̸�(����) ǥ��</td>
    <td colspan=3><input type=text name='cf_cut_name' value='<?=$config[cf_cut_name]?>' size=4> �ڸ��� ǥ��
        <?=help("������ 2���� = �ѱ� 1����")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">���� ����</td>
    <td>������ �� <input type=text name='cf_nick_modify' value='<?=$config[cf_nick_modify]?>' size=4> �� ���� �ٲ� �� ����</td>
    <td class="admin_basic_board_writetd">�������� ����</td>
    <td>������ �� <input type=text name='cf_open_modify' value='<?=$config[cf_open_modify]?>' size=4> �� ���� �ٲ� �� ����</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">�ֱٰԽù� ����</td>
    <td><input type=text name='cf_new_del' value='<?=$config[cf_new_del]?>' size=7> ��
        <?=help("�������� ���� �ֱٰԽù� �ڵ� ����")?></td>
    <td class="admin_basic_board_writetd">���� ����</td>
    <td><input type=text name='cf_memo_del' value='<?=$config[cf_memo_del]?>' size=7> ��
        <?=help("�������� ���� ���� �ڵ� ����")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">�����ڷα� ����</td>
    <td><input type=text name='cf_visit_del' value='<?=$config[cf_visit_del]?>' size=7> ��
        <?=help("�������� ���� ������ �α� �ڵ� ����")?></td>
    <td class="admin_basic_board_writetd">�α�˻��� ����</td>
    <td><input type=text name='cf_popular_del' value='<?=$config[cf_popular_del]?>' size=7> ��
        <?=help("�������� ���� �α�˻��� �ڵ� ����")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">���� ������</td>
    <td><input type=text name='cf_login_minutes' value='<?=$config[cf_login_minutes]?>' size=7> ��
        <?=help("������ �̳��� �����ڸ� ���� �����ڷ� ����")?></td>
    <td class="admin_basic_board_writetd">���������� ���μ�</td>
    <td><input type=text name='cf_page_rows' value='<?=$config[cf_page_rows]?>' size=7> ����
        <?=help("���(����Ʈ) ���������� ���μ�")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">����, �̵��� �α�</td>
    <td colspan=3><input class='admin_input_box' type='checkbox' name='cf_use_copy_log' value='1' <?=$config[cf_use_copy_log]?'checked':'';?>> ����
        <?=help("�Խù� �Ʒ��� ������ ���� ����, �̵��� ǥ��")?></td>
    <!-- <td>�ڵ���Ϲ��� ���</td>
    <td><input type='checkbox' name='cf_use_norobot' value='1' <?=$config[cf_use_norobot]?'checked':'';?>> ���
        <?=help("�ڵ� ȸ�����԰� �۾��⸦ ����")?></td> -->
</tr>
<tr>
    <td class="admin_basic_board_writetd">���ٰ��� IP</td>
    <td valign=top><textarea name='cf_possible_ip' rows='5' style='width:99%;'><?=$config[cf_possible_ip]?> </textarea><br>�Էµ� IP�� ��ǻ�͸� ������ �� ����.<br>123.123.+ �� �Է� ����. (���ͷ� ����)</td>
    <td>�������� IP</td>
    <td valign=top><textarea name='cf_intercept_ip' rows='5' style='width:99%;'><?=$config[cf_intercept_ip]?> </textarea><br>�Էµ� IP�� ��ǻ�ʹ� ������ �� ����.<br>123.123.+ �� �Է� ����. (���ͷ� ����)</td>
</tr>




<tr>
    <td colspan=4 align=left><div class="admin_title01">�Խ��� ����</div> <!-- ?=subtitle("�Խ��� ����")? --></td>
</tr>

<tr>
    <td class="admin_basic_board_writetd">LINK TARGET</td>
    <td><input type=text name='cf_link_target' size='10' value='<?=$config[cf_link_target]?>'> 
        <?=help("�Խ��� ������ �ڵ����� ��ũ�Ǵ� â�� Ÿ���� �����մϴ�.\n\n_self, _top, _blank, _new �� �ַ� �����մϴ�.")?></td>
    <td class="admin_basic_board_writetd">�˻� ����</td>
    <td><input type=text name='cf_search_part' size='10' itemname='�˻� ����' value='<?=$config[cf_search_part]?>'> �� ������ �˻�</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">�˻� ��� ����</td>
    <td><input type=text name='cf_search_bgcolor' size='10' required itemname='�˻� ��� ����' value='<?=$config[cf_search_bgcolor]?>'></td>
    <td class="admin_basic_board_writetd">�˻� ���� ����</td>
    <td><input type=text name='cf_search_color' size='10' required itemname='�˻� ���� ����' value='<?=$config[cf_search_color]?>'></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">���ο� �۾���</td>
    <td><input type=text name='cf_delay_sec' size='10' required itemname='���ο� �۾���' value='<?=$config[cf_delay_sec]?>'> �� ������ ����</td>
    <td class="admin_basic_board_writetd">������ ǥ�� ��</td>
    <td><input type=text name='cf_write_pages' size='10' required itemname='������ ǥ�� ��' value='<?=$config[cf_write_pages]?>'> �������� ǥ��</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">�̹��� ���ε� Ȯ����</td>
    <td colspan=3><input type=text name='cf_image_extension' size='80' itemname='�̹��� ���ε� Ȯ����' value='<?=$config[cf_image_extension]?>'>
        <?=help("�Խ��� ���ۼ��� �̹��� ���� ���ε� ���� Ȯ����. | �� ����")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">�ܾ� ���͸�
        <?=help("�Էµ� �ܾ ���Ե� ������ �Խ��� �� �����ϴ�.\n\n�ܾ�� �ܾ� ���̴� ,�� �����մϴ�.")?></td>
    <td colspan=3><textarea name='cf_filter' rows='7' style='width:99%;'><?=$config[cf_filter]?> </textarea></td>
</tr>




<tr>
    <td colspan=4 align=left><div class="admin_title01">ȸ�����Լ���</div> <!-- ?=subtitle("ȸ������ ����")? --></td>
</tr>

<tr>
    <td class="admin_basic_board_writetd">ȸ�� ��Ų</td>
    <td colspan=3><select id=cf_member_skin name=cf_member_skin required itemname="ȸ������ ��Ų">
        <?
        $arr = get_skin_dir("member");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script type="text/javascript"> document.getElementById('cf_member_skin').value="<?=$config[cf_member_skin]?>";</script>
    </td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">ȸ�����Խ� ����</td>
    <td><? echo get_member_level_select('cf_register_level', 1, 9, $config[cf_register_level]) ?></td>
    <td class="admin_basic_board_writetd">ȸ�����Խ� ����Ʈ</td>
    <td><input type=text name='cf_register_point' size='5' value='<?=$config[cf_register_point]?>'> ��</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">ȸ��Ż���� ������</td>
    <td colspan="3"><input type=text name='cf_leave_day' size='5' value='<?=$config[cf_leave_day]?>'> �� �� �ڵ� ����</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">���̵�,���� �����ܾ�
        <?=help("�Էµ� �ܾ ���Ե� ������ ȸ�����̵�, �������� ����� �� �����ϴ�.\n\n�ܾ�� �ܾ� ���̴� , �� �����մϴ�.")?></td>
    <td valign=top><textarea name='cf_prohibit_id' rows='3' style='width:99%;'><?=$config[cf_prohibit_id]?> </textarea></td>
    <td class="admin_basic_board_writetd">�Է� ���� ����
        <?=help("hanmail.net�� ���� ���� �ּҴ� �Է��� ���մϴ�.\n\n���ͷ� �����մϴ�.")?></td>
    <td valign=top><textarea name='cf_prohibit_email' rows='3' style='width:99%;'><?=$config[cf_prohibit_email]?> </textarea><br></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">ȸ�����Ծ��</td>
    <td valign=top colspan=3><textarea name='cf_stipulation' rows='5' style='width:99%;'><?=$config[cf_stipulation]?> </textarea></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">����������޹�ħ</td>
    <td valign=top colspan=3><textarea name='cf_privacy' rows='5' style='width:99%;'><?=$config[cf_privacy]?> </textarea></td>
</tr>




<tr>
    <td colspan=4 align=left><div class="admin_title01">���ϼ���</div> <!-- ?=subtitle("���� ����")? --></td>
</tr>


<tr>
    <td class="admin_basic_board_writetd">���Ϲ߼� ���</td>
    <td colspan=3><input class='admin_input_box' type=checkbox name=cf_email_use value='1' <?=$config[cf_email_use]?'checked':'';?>> ��� (üũ���� ������ ���Ϲ߼��� �ƿ� ������� �ʽ��ϴ�. ���� �׽�Ʈ�� �Ұ��մϴ�.)</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">�������� ���</td>
    <td><input class='admin_input_box' type='checkbox' name='cf_use_email_certify' value='1' <?=$config[cf_use_email_certify]?'checked':'';?>> ���
        <?=help("���Ͽ� ��޵� ���� �ּҸ� Ŭ���Ͽ��� ȸ������ �����մϴ�.");?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">������ ��� ����</td>
    <td><input class='admin_input_box' type='checkbox' name='cf_formmail_is_member' value='1' <?=$config[cf_formmail_is_member]?'checked':'';?>> ȸ���� ���
        <?=help("üũ���� ������ ��ȸ���� ��� �� �� �ֽ��ϴ�.")?></td>
</tr>








<tr>
    <td colspan=4 align=left>
        <div class="admin_title01">XSS / CSRF ����</div>  <!-- ?=subtitle("XSS / CSRF ����")? -->
    </td>
</tr>

<tr>
    <td class="admin_basic_board_writetd">
        ������ �н�����
    </td>
    <td colspan=3>
        <input type='password' name='admin_password' itemname="������ �н�����" required>
        <?=help("������ ������ ���ѱ� �Ϳ� ����Ͽ� �α����� �������� �н����带 �ѹ� �� ���°� �Դϴ�.");?>
    </td>
</tr>


</table>

<p align=center>
    <input type=submit class=admin_black_bt accesskey='s' value='Ȯ��'>
</form>

<script type="text/javascript">
function fconfigform_submit(f)
{
    f.action = "./config_form_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>
