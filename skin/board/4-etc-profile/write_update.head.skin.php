<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

// jy��������Ų zmspamfree ����
if (!$is_member) {
	if ($w=='' || $w=='r') {
		include_once("$g4[path]/zmSpamFree/zmSpamFree.php");
		if(!zsfCheck($_POST['wr_key'], $_GET['bo_table'])) {
			alert ('���������ڵ尡 Ʋ�Ƚ��ϴ�.');
		}
	}
}

if($w=="u" && $_FILES[bf_file][tmp_name][0]){
	@unlink("{$g4[path]}/data/file/{$bo_table}/thumb/{$wr_id}");
}
?>
