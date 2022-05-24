<?
$sub_menu = "800300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$list = $hps = array();

$overlap = 0;

$send_list = explode('/', $send_list);

while ($row = array_shift($send_list)) 
{
    $item = explode(',', $row);

    for ($i=1, $max = count($item); $i<$max; $i++) 
    {
        if (!trim($item[$i])) continue;

        switch ($item[0]) 
        {
            case 'g': // �׷�����
                $qry = sql_query("select * from $g4[sms4_book_table] where bg_no='$item[1]' and bk_receipt=1");
                while ($res = sql_fetch_array($qry)) {
                    $res[bk_hp] = get_hp($res[bk_hp], 0);
                    if (array_overlap($hps, $res[bk_hp])) {
                        $overlap ++;
                        continue;
                    }
                    array_push($list, $res);
                    array_push($hps, $res[bk_hp]);
                }
                break;

            case 'h': // ���� �ڵ��� ��ȣ �Է�
                $item[$i] = explode(':', $item[$i]);
                $hp = get_hp($item[$i][0], 0);
                $name = $item[$i][0];
                if (array_overlap($hps, $hp)) {
                    $overlap ++;
                    continue;
                }
                array_push($list, array('bk_hp' => $hp, 'bk_name' => $name));
                array_push($hps, $hp);
                break;

            case 'p': // ���� ����
                $res = sql_fetch("select * from $g4[sms4_book_table] where bk_no='$item[$i]'");
                $res[bk_hp] = get_hp($res[bk_hp], 0);
                if (array_overlap($hps, $res[bk_hp])) {
                    $overlap ++;
                    continue;
                }
                array_push($list, $res);
                array_push($hps, $res[bk_hp]);
                break;
        }
    }
}

if ($overlap)
    alert_just("�ߺ��Ǵ� �ڵ�����ȣ�� $overlap �� �ֽ��ϴ�. ");
else
    alert_just("�ߺ��Ǵ� �ڵ�����ȣ�� �����ϴ�. ");
?>