<?
include_once("./_common.php");
include_once("$g4[path]/head.sub.php");

$g4[title] = "����������";

// SMS ������ �迭����
$sms4 = sql_fetch("select * from $g4[sms4_config_table]");

if (!($token && get_session("ss_token") == $token))
    die("�ùٸ� ������� ����� �ֽʽÿ�.");

if (!$sms4[cf_member])
    die("���������� ������ �ʾҽ��ϴ�. ����Ʈ �����ڿ��� �����Ͽ� �ֽʽÿ�.");

if (!$is_member)
    die("�α��� ���ּ���.");

if ($member[mb_level] < $sms4[cf_level])
    alert("ȸ�� $sms4[cf_level]���� �̻� ���������� �����մϴ�.");

if (!trim($mh_reply))
    alert('������ ��ȣ�� �Է����ּ���.');

if (!trim($mh_message))
    alert('�޼����� �Է����ּ���.');

if (!trim($mh_hp))
    alert('�޴� ��ȣ�� �Է����ּ���.');

if ($is_admin != 'super')
{
    $mh_reply = get_hp($mh_reply, 0);
    if (!$mh_reply)
        alert("������ ��ȣ�� �ùٸ��� �ʽ��ϴ�.");
}
else
{
    $mh_reply = str_replace("-", "", $mh_reply);;
    if (!check_string($mh_reply, _G4_NUMERIC_))
        alert("������ ��ȣ�� �ùٸ��� �ʽ��ϴ�.");
}

$mh_hp = explode(',', $mh_hp);

// �ڵ��� ��ȣ�� �ɷ�����.
$tmp = array();
for ($i=0; $i<count($mh_hp); $i++)
{
    $hp = trim($mh_hp[$i]);
    $hp = get_hp($hp);

    if ($hp)
        $tmp[][bk_hp] = get_hp($hp, 0);
}
$mh_hp = $tmp;

$total = count($mh_hp);

// �Ǽ� ����
if ($sms4[cf_day_count] > 0 and $is_admin != 'super') {
    $row = sql_fetch(" select count(*) as cnt from $g4[sms4_member_history_table] where mb_id='$member[mb_id]' and date_format(mh_datetime, '%Y-%m-%d') = '$g4[time_ymd]' ");
    if ($row[cnt] + $total >= $sms4[cf_day_count]) {
        alert("�Ϸ翡 ������ �ִ� ���ڰ���(".number_format($sms4[cf_day_count]).")�� �ʰ��Ͽ����ϴ�.");
    }
}

// ����Ʈ �˻�
if ($sms4[cf_point] > 0 and $is_admin != 'super') {
    $minus_point = $sms4[cf_point] * $total;
    if ($minus_point > $member[mb_point])
        alert("�����Ͻ� ����Ʈ(".number_format($member[mb_point]).")�� ���ų� ���ڶ� ��������(".number_format($minus_point).")�� �Ұ��մϴ�.\\n\\n����Ʈ�� �����Ͻ� �� �ٽ� �õ� �� �ֽʽÿ�.");
} else
    $minus_point = 0;

// ��������
if ($mh_by && $mh_bm && $mh_bd && $mh_bh && $mh_bi) {
    $mh_booking = "$mh_by-$mh_bm-$mh_bd $mh_bh:$mh_bi:00";
    $booking = $mh_by.$mh_bm.$mh_bd.$mh_bh.$mh_bi;
} else {
    $mh_booking = '';
    $booking = '';
}

$SMS = new SMS4;
$SMS->SMS_con($sms4[cf_ip], $sms4[cf_id], $sms4[cf_pw], $sms4[cf_port]);

$result = $SMS->Add($mh_hp, $mh_reply, '', '', $mh_message, $booking, $total);

$is_success = null;

if ($result)
{
    $result = $SMS->Send();

    if ($result) //SMS ������ �����߽��ϴ�.
    {
        foreach ($SMS->Result as $result)
        {
            list($hp, $code) = explode(":", $result);

            if (substr($code,0,5) == "Error")
            {
                $is_success = false;

                switch (substr($code,6,2)) {
                    case '02':	 // "02:���Ŀ���"
                        $mh_log = "������ �߸��Ǿ� ������ �����Ͽ����ϴ�.";
                        break;
                    case '16':	 // "16:�߼ۼ��� IP ����"
                        $mh_log = "�߼ۼ��� IP�� �߸��Ǿ� ������ �����Ͽ����ϴ�.";
                        break;
                    case '23':	 // "23:��������,�����Ϳ���,���۳�¥����"
                        $mh_log = "�����͸� �ٽ� Ȯ���� �ֽñ�ٶ��ϴ�.";
                        break;
                    case '97':	 // "97:�ܿ����κ���"
                        $mh_log = "�ܿ������� �����մϴ�.";
                        break;
                    case '98':	 // "98:���Ⱓ����"
                        $mh_log = "���Ⱓ�� ����Ǿ����ϴ�.";
                        break;
                    case '99':	 // "99:��������"
                        $mh_log = "���� ���� ���Ͽ����ϴ�. ������ �ٽ� Ȯ���� �ּ���.";
                        break;
                    default:	 // "�� Ȯ�� ����"
                        $mh_log = "�� �� ���� ������ ������ �����Ͼ����ϴ�.";
                        break;
                }
            }
            else
            {
                $is_success = true;
                $mh_log = "��������:".get_hp($hp, 1);
            }

            $hp = get_hp($hp, 1);
            $log = array_shift($SMS->Log);
            sql_query("insert into $g4[sms4_member_history_table] set mb_id='$member[mb_id]', mh_reply='$mh_reply', mh_hp='$hp', mh_datetime='$g4[time_ymdhis]', mh_booking='$mh_booking', mh_log='$mh_log', mh_ip='$REMOTE_ADDR'");

            if ($is_admin == 'super')
                $sms4[cf_point] = 0;

            if ($is_success)
                insert_point($member[mb_id], (-1) * $sms4[cf_point], "$mh_log");

            if (!$sms4[cf_point]) { // ����Ʈ ������ ��� ������ ����
                $sql  = " insert into $g4[point_table] set ";
                $sql .= " mb_id = '$member[mb_id]' ";
                $sql .= " ,po_datetime = '$g4[time_ymdhis]' ";
                $sql .= " ,po_content = '".addslashes($mh_log)."' ";
                $sql .= " ,po_point = '$sms4[cf_point]'";
                sql_query($sql);
            }
        }
        $SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
    }
    else alert("����: SMS ������ ����� �Ҿ����մϴ�.");
}
else alert("����: SMS ������ �Էµ��� ������ �߻��Ͽ����ϴ�.");

alert("$total ���� ���ڸ޼��� ������ �Ϸ��Ͽ����ϴ�.", "write.php");
?>