<?
$sub_menu = "800600";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$g4[title] = "�̸�Ƽ�� ������Ʈ";

if ($w == 'u') // ������Ʈ
{
    if (!$fg_no) $fg_no = 0;

    if (!$fo_receipt) $fo_receipt = 0; else $fo_receipt = 1;

    if (!strlen(trim($fo_name)))
        alert_just('�̸��� �Է����ּ���');

    if (!strlen(trim($fo_content)))
        alert_just('�̸�Ƽ���� �Է����ּ���');

    $res = sql_fetch("select * from $g4[sms4_form_table] where fo_no<>'$fo_no' and fo_content='$fo_content'");
    if ($res)
        alert_just('���� �̸�Ƽ���� �����մϴ�.');

    $res = sql_fetch("select * from $g4[sms4_form_table] where fo_no='$fo_no'");
    if (!$res)
        alert_just('�������� �ʴ� ������ �Դϴ�.');

    if ($fg_no != $res[fg_no]) {
        if ($res[fg_no])
            sql_query("update $g4[sms4_form_group_table] set fg_count = fg_count - 1 where fg_no='$res[fg_no]'");

        sql_query("update $g4[sms4_form_group_table] set fg_count = fg_count + 1 where fg_no='$fg_no'");
    }

    $group = sql_fetch("select * from $g4[sms4_form_group_table] where fg_no = '$fg_no'");

    sql_query("update $g4[sms4_form_table] set fg_no='$fg_no', fg_member='$group[fg_member]', fo_name='$fo_name', fo_content='$fo_content', fo_datetime='$g4[time_ymdhis]' where fo_no='$fo_no'");
}
else if ($w == 'd') // ����
{
    if (!is_numeric($fo_no))
        alert_just('������ȣ�� �����ϴ�.');

    $res = sql_fetch("select * from $g4[sms4_form_table] where fo_no='$fo_no'");
    if (!$res)
        alert_just('�������� �ʴ� ������ �Դϴ�.');

    sql_query("delete from $g4[sms4_form_table] where fo_no='$fo_no'");
    sql_query("update $g4[sms4_form_group_table] set fg_count = fg_count - 1 where fg_no = '$res[fg_no]'");

    $get_fg_no = $fg_no;
}
else // ���
{
    if (!$fg_no) $fg_no = 0;

    if (!strlen(trim($fo_name)))
        alert_just('�̸��� �Է����ּ���');

    if (!strlen(trim($fo_content)))
        alert_just('�̸�Ƽ���� �Է����ּ���');

    $res = sql_fetch("select * from $g4[sms4_form_table] where fo_content='$fo_content'");
    if ($res)
        alert_just('���� �̸�Ƽ���� �����մϴ�.');

    $group = sql_fetch("select * from $g4[sms4_form_group_table] where fg_no = '$fg_no'");

    sql_query("insert into $g4[sms4_form_table] set fg_no='$fg_no', fg_member='$group[fg_member]', fo_name='$fo_name', fo_content='$fo_content', fo_datetime='$g4[time_ymdhis]'");
    sql_query("update $g4[sms4_form_group_table] set fg_count = fg_count + 1 where fg_no = '$fg_no'");

    $get_fg_no = $fg_no;

    echo "<script language=javascript>
    if (confirm('�Է��۾��� ��� �Ͻðڽ��ϱ�?')) 
        parent.document.location.reload(); 
    else
        parent.document.location.href = './form_list.php?page=$page&fg_no=$get_fg_no';
    </script>";
    exit;
}

?>
<script language=javascript>
parent.document.location.href = "./form_list.php?page=<?=$page?>&fg_no=<?=$get_fg_no?>";
</script>