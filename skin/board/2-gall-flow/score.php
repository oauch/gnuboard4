<?
include_once("./_common.php");

$ss_name = "ss_score_{$bo_table}_{$wr_id}";
if (get_session($ss_name)) die('d');

$write_table = $g4['write_prefix'].$bo_table;

$field = "wr_".$field;
$sql = " update $write_table set $field = $field + 1 where wr_id = '$wr_id' ";
sql_query($sql);

$sql = " select wr_good, wr_nogood from $write_table where wr_id = '$wr_id' ";
$row = sql_fetch($sql);
set_session($ss_name, TRUE);

echo $row[wr_good].",".$row[wr_nogood];
?>
