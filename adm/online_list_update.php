<?
$sub_menu = "100100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "w");

check_token();

for ($i=0; $i<count($chk); $i++) 
{

    // ���� ��ȣ�� �ѱ�
    $k = $chk[$i];

	$row = sql_fetch(" select * from $g4[online_table] where ol_id = '$ol_id[$k]' ");
	if (!$row[ol_id]){ 
		$msg ="ol_id ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
    } else {
        $sql = " update $g4[online_table]
                    set ol_admmemo = '$ol_admmemo[$k]'
                  where ol_id = '$ol_id[$k]' ";
        sql_query($sql);
    }
}

if ($msg)
    echo "<script language='JavaScript'> alert('$msg'); </script>";

goto_url("./online_list.php?$qstr");
?>
