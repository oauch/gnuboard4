<?
$sub_menu = "800100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

check_demo();

$g4[title] = "SMS �⺻����";

$res = get_sock("http://115.68.47.5/web_module/point_check.html?sms_id=$cf_id&sms_pw=$cf_pw");
$res = explode(';', $res);
$userinfo = array(
    'code'      => $res[0], // ����ڵ�
    'coin'      => $res[1], // �� �ܾ� (�������� �ش�)
    'gpay'      => $res[2], // ���� �Ǽ� �� ������ ǥ�� (�������� �ش�)
    'payment'   => 'A'  // ����� ǥ��, A:������, ������
);

if ($userinfo[code] == '103')
    alert('SMSHUB ���̵�� �н����尡 ���� �ʽ��ϴ�.');
else if ($userinfo[code] == '102')
    alert('��û���� �����ǰ� ���� �ʽ��ϴ�.');

if ($userinfo[payment] == 'A')
    $cf_port = 1; // ������
else
    $cf_port = 2; // ������

if ($cf_member == 'on')
    $cf_member = 1;
else
    $cf_member = 0;

$res = sql_fetch("select * from $g4[sms4_config_table] limit 1");

if (!$res)
    $sql = "insert into ";
else
    $sql = "update ";

$cf_ip = trim($cf_ip);
$sql .= "$g4[sms4_config_table] set cf_id='$cf_id', cf_pw='$cf_pw', cf_ip='$cf_ip', cf_port='$cf_port', cf_phone='$cf_phone', cf_register='$cf_register', cf_member='$cf_member', cf_level='$cf_level', cf_point='$cf_point', cf_day_count='$cf_day_count'";

sql_query($sql);

goto_url("./config.php");
?>
