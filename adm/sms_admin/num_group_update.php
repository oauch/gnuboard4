<?
$sub_menu = "800700";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if ($w == 'u') // ������Ʈ
{
    if (!is_numeric($bg_no))
        alert_just('�׷� ������ȣ�� �����ϴ�.');

    $res = sql_fetch("select * from $g4[sms4_book_group_table] where bg_no='$bg_no'");
    if (!$res)
        alert_just('�������� �ʴ� �׷��Դϴ�.');

    if (!strlen(trim($bg_name)))
        alert_just('�׷��̸��� �Է����ּ���');

    $res = sql_fetch("select bg_name from $g4[sms4_book_group_table] where bg_no<>'$bg_no' and bg_name='$bg_name'");
    if ($res)
        alert_just('���� �׷��̸��� �����մϴ�.');

    sql_query("update $g4[sms4_book_group_table] set bg_name='$bg_name' where bg_no='$bg_no'");
}
else if ($w == 'd') // �׷����
{
    if (!is_numeric($bg_no))
        alert_just('�׷� ������ȣ�� �����ϴ�.');

    $res = sql_fetch("select * from $g4[sms4_book_group_table] where bg_no='$bg_no'");
    if (!$res)
        alert_just('�������� �ʴ� �׷��Դϴ�.');

    sql_query("delete from $g4[sms4_book_group_table] where bg_no='$bg_no'");
    sql_query("update $g4[sms4_book_table] set bg_no=0 where bg_no='$bg_no'");
}
else if ($w == 'empty') // ����
{
    sql_query("update $g4[sms4_book_group_table] set bg_count = 0, bg_member = 0, bg_nomember = 0, bg_receipt = 0, bg_reject = 0 where bg_no='$bg_no'");
    sql_query("delete from $g4[sms4_book_table] where bg_no='$bg_no'");
}
else // ���
{
    if (!strlen(trim($bg_name)))
        alert_just('�׷��̸��� �Է����ּ���');

    $res = sql_fetch("select bg_name from $g4[sms4_book_group_table] where bg_name='$bg_name'");
    if ($res)
        alert_just('���� �׷��̸��� �����մϴ�.');

    sql_query("insert into $g4[sms4_book_group_table] set bg_name='$bg_name'");
}

?>
<script language=javascript>
parent.document.location.reload();
</script>