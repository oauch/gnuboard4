<?
$sub_menu = "800200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$count      = 0;
$hp_yes     = 0;
$hp_no      = 0;
$hp_empty   = 0;
$leave      = 0;
$receipt    = 0;

// ȸ�� ������ ���̱׷��̼�
$qry = sql_query("select mb_id, mb_name, mb_hp, mb_sms, mb_leave_date from $g4[member_table] order by mb_datetime");
while ($res = sql_fetch_array($qry)) 
{
    if ($res[mb_leave_date] != '') 
        $leave++;
    else if ($res[mb_hp] == '')
        $hp_empty++;
    else if (is_hp($res[mb_hp])) 
        $hp_yes++ ;
    else 
        $hp_no++;

    $hp = get_hp($res[mb_hp]);

    if ($hp == '') $bk_receipt = 0; else $bk_receipt = $res[mb_sms];

    $field = "mb_id='$res[mb_id]', bk_name='$res[mb_name]', bk_hp='$hp', bk_receipt='$bk_receipt', bk_datetime='$g4[time_ymdhis]'";

    $res2 = sql_fetch("select * from $g4[sms4_book_table] where mb_id='$res[mb_id]'");
    if ($res2) // ������ ��ϵǾ� ���� ��� ������Ʈ
    {
        $res3 = sql_fetch("select count(*) as cnt from $g4[sms4_book_table] where mb_id='$res2[mb_id]'");
        $mb_count = $res3[cnt];

        // ȸ���� �����Ǿ��ٸ� �ڵ�����ȣ DB ������ �����Ѵ�.
        if ($res[mb_leave_date]) 
        {
            sql_query("delete from $g4[sms4_book_table] where mb_id='$res2[mb_id]'");

            $sql = "update $g4[sms4_book_group_table] set bg_count = bg_count - $mb_count, bg_member = bg_member - $mb_count";
            if ($res2[bk_receipt] == 1)
                $sql .= ", bg_receipt = bg_receipt - $mb_count";
            else
                $sql .= ", bg_reject = bg_reject - $mb_count";
            $sql .= " where bg_no='$res2[bg_no]'";

            sql_query($sql);
        }
        else
        {
            if ($bk_receipt != $res2[bk_receipt]) {
                if ($bk_receipt == 1)
                    $sql_sms = "bg_receipt = bg_receipt + $mb_count, bg_reject = bg_reject - $mb_count";
                else 
                    $sql_sms = "bg_receipt = bg_receipt - $mb_count, bg_reject = bg_reject + $mb_count";

                sql_query("update $g4[sms4_book_group_table] set $sql_sms where bg_no='$res2[bg_no]'");
            }
            
            if ($bk_receipt) $receipt++;

            sql_query("update $g4[sms4_book_table] set $field where mb_id='$res[mb_id]'");
        }
    }
    else if ($res[mb_leave_date] == '') // ������ ��ϵǾ� ���� ���� ��� �߰� (������ ȸ���� �ƴ� ���)
    {
        if ($bk_receipt == 1) {
            $sql_sms = "bg_receipt = bg_receipt + 1";
            $receipt++;
        } else {
            $sql_sms = "bg_reject = bg_reject + 1";
        }

        sql_query("insert into $g4[sms4_book_table] set $field, bg_no=1");
        sql_query("update $g4[sms4_book_group_table] set bg_count = bg_count + 1, bg_member = bg_member + 1, $sql_sms where bg_no=1");
    }

    $count++;
}

sql_query("update $g4[sms4_config_table] set cf_datetime='$g4[time_ymdhis]'");

?>
<script language=javascript>
var msg = "";
msg += "ȸ�������� �ڵ�����ȣ DB�� ������Ʈ �Ͽ����ϴ�.";
msg += "<br>�� ȸ�� �� : <?=number_format($count)?> ��";
msg += "<br>������ ȸ�� : <?=number_format($leave)?> ��";
msg += "<br>�ڵ�����ȣ ���� : <?=number_format($hp_empty)?> ��";
msg += "<br><span style='color:blue;'>�ڵ�����ȣ ���� : <?=number_format($hp_yes)?> ��</span>";
msg += "<br><span style='color:red;'>�ڵ�����ȣ ���� : <?=number_format($hp_no)?> ��</span>";
msg += "<br><span style='color:blue;'>������� : <?=number_format($receipt)?> ��</span>";
msg += "<br><span style='color:red;'>���Űź� : <?=number_format($hp_yes-$receipt)?> ��</span>";
msg += "<br>���α׷��� ������ ����ġ�ŵ� �����ϴ�.";

parent.document.getElementById('datetime').innerHTML = "<?=$g4[time_ymdhis]?>";
parent.document.getElementById('res').innerHTML = msg;
</script>