<?
/*-------------------------------------------
by ���̾����� 2009.06.12 / http://song2c.com
(���������� ����,��������)
--------------------------------------------*/

include_once('./_common.php');
if(!$is_admin) exit;

$table =  $g4['write_prefix'].$_GET['bo_table'];
$inqty1 = ($_GET['mode']=="up")? ">" : "<";
$inqty2 = ($_GET['mode']=="up")? "asc" : "desc";
$inqty3 = ($_GET['mode']=="up")? "�ֻ���" : "������";

$data_path = $g4[path]."/data/file/".$_GET['bo_table'];
$thumb_path = $data_path.'/thumb';

// MY ROW
$sel_my = sql_query("select * from $table where wr_id={$_GET[wr_id]}");
$my = sql_fetch_array($sel_my);

// TARGET ROW
$sel_target = sql_query("select * from $table where wr_id{$inqty1}{$_GET[wr_id]} order by wr_id {$inqty2} limit 1");
$target = sql_fetch_array($sel_target);

if($target['wr_id']){
	//my �ѹ��� �ӽ÷� �ٲ���, target �ѹ��� my��, my �ѹ��� target����..
	sql_query("update $table set wr_id=99999, wr_num=99999, wr_parent=99999 where wr_id={$my[wr_id]} ");
	sql_query("update $table set wr_id={$my[wr_id]}, wr_num={$my[wr_num]}, wr_parent={$my[wr_parent]} where wr_id={$target[wr_id]} ");
	sql_query("update $table set wr_id={$target[wr_id]}, wr_num={$target[wr_num]}, wr_parent={$target[wr_parent]} where wr_id=99999 ");

	//my �������̺� ���������� �ٲ�
	sql_query("update {$g4[board_file_table]} set wr_id=99999 where bo_table='{$_GET[bo_table]}' and wr_id={$my[wr_id]}");
	sql_query("update {$g4[board_file_table]} set wr_id={$my[wr_id]} where bo_table='{$_GET[bo_table]}' and wr_id={$target[wr_id]}");
	sql_query("update {$g4[board_file_table]} set wr_id={$target[wr_id]} where bo_table='{$_GET[bo_table]}' and wr_id=99999");

	@unlink($thumb_path."/".$my[wr_id]);
	@unlink($thumb_path."/".$target[wr_id]);

	//echo "<script type='text/javascript'>alert('����Ǿ����ϴ�');</script>";
	echo "<script type='text/javascript'>parent.document.location.reload();</script>";

}else{
  echo "<script type='text/javascript'>alert('���� {$inqty3}�Դϴ�.');</script>";
}
exit;
?>
