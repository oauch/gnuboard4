<?
$sub_menu = "800500";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if ($w == 'u') // ������Ʈ
{
    if (!is_numeric($fg_no))
        alert_just('�׷� ������ȣ�� �����ϴ�.');

    $res = sql_fetch("select * from $g4[sms4_form_group_table] where fg_no='$fg_no'");
    if (!$res)
        alert_just('�������� �ʴ� �׷��Դϴ�.');

    if (!strlen(trim($fg_name)))
        alert_just('�׷��̸��� �Է����ּ���');

    $res = sql_fetch("select fg_name from $g4[sms4_form_group_table] where fg_no<>'$fg_no' and fg_name='$fg_name'");
    if ($res)
        alert_just('���� �׷��̸��� �����մϴ�.');

    sql_query("update $g4[sms4_form_group_table] set fg_name='$fg_name', fg_member='$fg_member' where fg_no='$fg_no'");
    sql_query("update $g4[sms4_form_table] set fg_member = '$fg_member' where fg_no = '$fg_no'");
}
else if ($w == 'd') // �׷����
{
    if (!is_numeric($fg_no))
        alert_just('�׷� ������ȣ�� �����ϴ�.');

    $res = sql_fetch("select * from $g4[sms4_form_group_table] where fg_no='$fg_no'");
    if (!$res)
        alert_just('�������� �ʴ� �׷��Դϴ�.');

    sql_query("delete from $g4[sms4_form_group_table] where fg_no='$fg_no'");
    sql_query("update $g4[sms4_form_table] set fg_no = 0, fg_member = 0 where fg_no='$fg_no'");
}
else if ($w == 'empty') 
{
    if ($fg_no == 'no') $fg_no = 0;

    if ($fg_no)
        sql_query("update $g4[sms4_form_group_table] set fg_count = 0 where fg_no = '$fg_no'");

    sql_query("delete from $g4[sms4_form_table] where fg_no = '$fg_no'");
}
else // ���
{
    if (!strlen(trim($fg_name)))
        alert_just('�׷��̸��� �Է����ּ���');

    $res = sql_fetch("select fg_name from $g4[sms4_form_group_table] where fg_name = '$fg_name'");
    if ($res)
        alert_just('���� �׷��̸��� �����մϴ�.');

    sql_query("insert into $g4[sms4_form_group_table] set fg_name = '$fg_name'");
}

?>
<script language=javascript>
parent.document.location.reload();
</script>