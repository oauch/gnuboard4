<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// jy베이직스킨 zmspamfree 연동
if (!$is_member) {
	if ($w=='' || $w=='r') {
		include_once("$g4[path]/zmSpamFree/zmSpamFree.php");
		if(!zsfCheck($_POST['wr_key'], $_GET['bo_table'])) {
			alert ('스팸차단코드가 틀렸습니다.');
		}
	}
}

if($w=="u" && $_FILES[bf_file][tmp_name][0]){
	@unlink("{$g4[path]}/data/file/{$bo_table}/thumb/{$wr_id}");
}
?>
