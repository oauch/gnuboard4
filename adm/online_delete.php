<?
$sub_menu = "900100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

check_token();

$qstr="kind=$kind";

$row = sql_fetch(" select * from $g4[online_table] where ol_id = '$ol_id' ");
if (!$row[ol_id]){ 
	$msg ="ol_id 값이 제대로 넘어오지 않았습니다.";
} else {
	sql_query(" delete from $g4[online_table] where ol_id = '$ol_id' ");
}

if ($url)
    goto_url("{$url}?$qstr&w=u&ol_id=$ol_id");
else
    goto_url("./online_list.php?$qstr");
?>
