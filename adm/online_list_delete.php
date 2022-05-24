<?
$sub_menu = "100100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

check_token();

$msg = "";
for ($i=0; $i<count($chk); $i++) 
{
    // 실제 번호를 넘김
    $k = $chk[$i];

	$row = sql_fetch(" select * from $g4[online_table] where ol_id = '$ol_id[$k]' ");
	if (!$row[ol_id]){ 
		$msg ="ol_id 값이 제대로 넘어오지 않았습니다.";
    } else {
		sql_query(" delete from $g4[online_table] where ol_id = '$ol_id[$k]' ");
    }
}

if ($msg)
    echo "<script language='JavaScript'> alert('$msg'); </script>";

goto_url("./online_list.php?$qstr");
?>
