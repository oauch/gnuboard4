<?
$sub_menu = "800800";
include_once("./_common.php");
include_once("$g4[path]/head.sub.php");

auth_check($auth[$sub_menu], "w");

$g4[title] = "��ȭ��ȣ��";

$ck_no = explode(',', $ck_no);

for ($i=0; $i<count($ck_no); $i++) 
{
    $bk_no = $ck_no[$i];
    if (!trim($bk_no)) continue;

    $res = sql_fetch("select * from $g4[sms4_book_table] where bk_no='$bk_no'");
    if (!$res) continue;

    if ($w == 'reject') // ���Űź�
    {
        sql_query("update $g4[sms4_book_table] set bk_receipt=0 where bk_no='$bk_no'");

        if ($res[mb_id])
           sql_query("update $g4[member_table] set mb_sms=0 where mb_id='$res[mb_id]'");

        if ($res[bk_receipt] == 1)
            sql_query("update $g4[sms4_book_group_table] set bg_receipt=bg_receipt-1, bg_reject=bg_reject+1 where bg_no='$res[bg_no]'");
    }
    else if ($w == 'receipt') // �������
    {
        sql_query("update $g4[sms4_book_table] set bk_receipt=1 where bk_no='$bk_no'");

        if ($res[mb_id])
           sql_query("update $g4[member_table] set mb_sms=1 where mb_id='$res[mb_id]'");

        if ($res[bk_receipt] == 0)
            sql_query("update $g4[sms4_book_group_table] set bg_receipt=bg_receipt+1, bg_reject=bg_reject-1 where bg_no='$res[bg_no]'");
    }
    else if ($w == 'del') // ����
    {
        sql_query("delete from $g4[sms4_book_table] where bk_no='$bk_no'");

        if ($res[bk_receipt] == 1) $bg_sms = 'bg_receipt'; else $bg_sms = 'bg_reject';
        if ($res[mb_id]) $bg_mb = 'bg_member'; else $bg_mb = 'bg_nomember';

        sql_query("update $g4[sms4_book_group_table] set $bg_sms = $bg_sms - 1, $bg_mb = $bg_mb - 1, bg_count = bg_count - 1 where bg_no='$res[bg_no]'");

        /*
        if (!$res[mb_id]) {
            sql_query("delete from $g4[sms4_book_table] where bk_no='$bk_no'");
            sql_query("update $g4[sms4_book_group_table] set bg_count = bg_count - 1 where bg_no='$res[bg_no]'");

            if ($res[bk_receipt] == 1)
                sql_query("update $g4[sms4_book_group_table] set bg_receipt = bg_receipt - 1, bg_count = bg_count - 1 where bg_no='$res[bg_no]'");
            else
                sql_query("update $g4[sms4_book_group_table] set bg_reject = bg_reject - 1, bg_count = bg_count - 1 where bg_no='$res[bg_no]'");
        }
        */
    }
    else // �׷� �̵� or ����
    {
        $what   = explode(":", $w);
        $action = $what[0];
        $bg_no  = $what[1];

        // �̵�
        if ($action == 'm') {
            sql_query("update $g4[sms4_book_table] set bg_no='$bg_no' where bk_no='$bk_no'");

            if ($res[mb_id]) 
                $sql_member = 'bg_member'; 
            else 
                $sql_member = 'bg_nomember';

            if ($res[bk_receipt]) 
                $sql_sms = 'bg_receipt'; 
            else 
                $sql_sms = 'bg_reject';

            sql_query("update $g4[sms4_book_group_table] set bg_count = bg_count - 1, $sql_sms = $sql_sms - 1, $sql_member = $sql_member - 1 where bg_no='$res[bg_no]'");
            sql_query("update $g4[sms4_book_group_table] set bg_count = bg_count + 1, $sql_sms = $sql_sms + 1, $sql_member = $sql_member + 1 where bg_no='$bg_no'");

        // ����
        } else {
            sql_query("insert into $g4[sms4_book_table] set bg_no='$bg_no', mb_id='$res[mb_id]', bk_name='$res[bk_name]', bk_hp='$res[bk_hp]', bk_receipt='$res[bk_receipt]', bk_datetime='$g4[time_ymdhis]'");

            $sql = "update $g4[sms4_book_group_table] set bg_count = bg_count + 1 ";

            if ($res[bk_receipt] == 1)
                $sql .= " , bg_receipt = bg_receipt + 1 ";
            else
                $sql .= " , bg_reject = bg_reject + 1 ";

            if ($res[mb_id])
                $sql .= " , bg_member = bg_member + 1 ";
            else
                $sql .= " , bg_nomember = bg_nomember + 1 ";

            $sql .= " where bg_no='$bg_no'";
            sql_query($sql);
        }
    }
}
?>

<script language="javascript">
parent.location.reload();
</script>
