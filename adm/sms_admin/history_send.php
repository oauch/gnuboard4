<?
$sub_menu = "800400";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$g4[title] = "����������";

$list = array();

$write = sql_fetch("select * from $g4[sms4_write_table] where wr_no='$wr_no' and wr_renum=0");

$res = sql_fetch("select max(wr_renum) as wr_renum from $g4[sms4_write_table] where wr_no='$wr_no'");
$new_wr_renum = $res[wr_renum] + 1;

if ($w == 'f')
    $sql_flag = " and hs_flag=0 ";
else
    $sql_flag = "";

if ($wr_renum)
    $sql_renum = " and wr_renum='$wr_renum' ";
else
    $sql_renum = " and wr_renum=0 ";

$res = sql_fetch("select count(*) as cnt from $g4[sms4_history_table] where wr_no='$wr_no' $sql_renum $sql_flag");
if (!$res[cnt]) {
?>
    <script language=javascript>
    act = window.open('sms_ing.php', 'act', 'width=300, height=200');
    act.close();
    alert('�������� ������ �����ϴ�.');
    history.back();
    </script>
    <?
    exit;
}

$sql = sql_query("select * from $g4[sms4_history_table] where wr_no='$wr_no' $sql_renum $sql_flag");
while ($res = sql_fetch_array($sql))
{
    $res[bk_hp] = get_hp($res[bk_hp], 0);

    if ($g4[sms4_demo])
        $res[bk_hp] = '0100000000';

    array_push($list, $res);
}

$wr_total = count($list);

include_once("$g4[admin_path]/admin.head.php");

$SMS = new SMS4;
$SMS->SMS_con($sms4[cf_ip], $sms4[cf_id], $sms4[cf_pw], $sms4[cf_port]);

$reply = str_replace('-', '', trim($write[wr_reply]));

$result = $SMS->Add($list, $reply, '', '', $write[wr_message], '', $wr_total);

if ($result)
{
    $result = $SMS->Send();

    if ($result) //SMS ������ �����߽��ϴ�.
    {
        sql_query("insert into $g4[sms4_write_table] set wr_no='$wr_no', wr_renum='$new_wr_renum', wr_reply='$write[wr_reply]', wr_message='$write[wr_message]', wr_total='$wr_total', wr_datetime='$g4[time_ymdhis]'");

        $wr_success = 0;
        $wr_failure = 0;
        $count      = 0;

        foreach ($SMS->Result as $result)
        {
            list($phone, $code) = explode(":", $result);

            if (substr($code,0,5) == "Error")
            {
                $hs_code = substr($code,6,2);

                switch ($hs_code) {
                    case '02':	 // "02:���Ŀ���"
                        $hs_memo = "������ �߸��Ǿ� ������ �����Ͽ����ϴ�.";
                        break;
                    case '16':	 // "16:�߼ۼ��� IP ����"
                        $hs_memo = "�߼ۼ��� IP�� �߸��Ǿ� ������ �����Ͽ����ϴ�.";
                        break;
                    case '23':	 // "23:��������,�����Ϳ���,���۳�¥����"
                        $hs_memo = "�����͸� �ٽ� Ȯ���� �ֽñ�ٶ��ϴ�.";
                        break;
                    case '97':	 // "97:�ܿ����κ���"
                        $hs_memo = "�ܿ������� �����մϴ�.";
                        break;
                    case '98':	 // "98:���Ⱓ����"
                        $hs_memo = "���Ⱓ�� ����Ǿ����ϴ�.";
                        break;
                    case '99':	 // "99:��������"
                        $hs_memo = "���� ���� ���Ͽ����ϴ�. ������ �ٽ� Ȯ���� �ּ���.";
                        break;
                    default:	 // "�� Ȯ�� ����"
                        $hs_memo = "�� �� ���� ������ ������ �����Ͼ����ϴ�.";
                        break;
                }
                $wr_failure++;
                $hs_flag = 0;
            }
            else
            {
                $hs_code = $code;
                $hs_memo = get_hp($phone, 1)."�� �����߽��ϴ�.";
                $wr_success++;
                $hs_flag = 1;
            }

            $row = array_shift($list);
            $row[bk_hp] = get_hp($row[bk_hp], 1);

            $log = array_shift($SMS->Log);
            sql_query("insert into $g4[sms4_history_table] set wr_no='$wr_no', wr_renum='$new_wr_renum', bg_no='$row[bg_no]', mb_id='$row[mb_id]', bk_no='$row[bk_no]', hs_name='$row[hs_name]', hs_hp='$row[hs_hp]', hs_datetime='$g4[time_ymdhis]', hs_flag='$hs_flag', hs_code='$hs_code', hs_memo='$hs_memo', hs_log='$log'");
        }
        $SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.

        sql_query("update $g4[sms4_write_table] set wr_success='$wr_success', wr_failure='$wr_failure' where wr_no='$wr_no' and wr_renum='$new_wr_renum'");
        sql_query("update $g4[sms4_write_table] set wr_re_total=wr_re_total+1 where wr_no='$wr_no' and wr_renum=0");
    }
    else alert("����: SMS ������ ����� �Ҿ����մϴ�.");
}
else alert("����: SMS ������ �Էµ��� ������ �߻��Ͽ����ϴ�.");

?>
<script language=javascript>
act = window.open('sms_ing.php', 'act', 'width=300, height=200');
act.close();
location.href = 'history_view.php?wr_no=<?=$wr_no?>&wr_renum=<?=$new_wr_renum?>';
</script>
<?
include_once("$g4[admin_path]/admin.tail.php");
?>