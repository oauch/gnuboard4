<?
include_once("./_common.php");

$msg = "<div id='popupLayer' class='popup_area'>";
$msg .= "<div class='bg_opacity'></div>";
$msg .= "<div class='popup_layer'>";

	$msg .= "<div class='claim_head'><h1>신고하기</h1><a href='#close' class='bu_close' onclick='close_layer(); return false;' title='닫기'>닫기</a></div>";
	$msg .= "<form>";
	$msg .= "<div class='claim_body'>";
		$msg .= "<table class='horiz' summary='신고양식'>";
		$msg .= "<caption>신고양식</caption>";
		$msg .= "<colgroup>";
		$msg .= "<col width='20%' />";
		$msg .= "<col width='' />";
		$msg .= "</colgroup>";
		$msg .= "<tbody>";
			$msg .= "<tr>";
			$msg .= "<th>제목</th>";
			$msg .= "<td colspan='3'>친절한 박찬호 선행모음! 일본가서 성공하길...</td>";
			$msg .= "</tr>";
			$msg .= "<tr>";
			$msg .= "<th>작성자</th>";
			$msg .= "<td>JYSOFT</td>";
			$msg .= "<th>신고자</th>";
			$msg .= "<td>후아유</td>";
			$msg .= "</tr>";
			$msg .= "<tr>";
			$msg .= "<th>신고사유</th>";
			$msg .= "<td colspan='3'>내용3</td>";
			$msg .= "</tr>";
		$msg .= "</tbody>";
		$msg .= "</table>";
		$msg .= "<textarea rows='8' cols='70' class='textbox' style='margin-top:10px; width:449px; height:100px;'></textarea>";
		$msg .= "<p class='txt_notice'>허위 신고일 경우 신고자의 활동에 제한을 받게 되오니 이점 유의해 주시기 바랍니다.</p>";
		$msg .= "<div class='btn_area'><input type='image' src='$g4[path]/img/jyboard/btn_submit_claim.gif' alt='신고하기' title='신고하기' /><a href='#close' class='btn_close' onclick='close_layer(); return false;' title='닫기'>닫기</a></div>";
	$msg .= "</div>";
	$msg .= "</form>";

$msg .= "</div>";
$msg .= "</div>";

die(rawurlencode(iconv('euc-kr', 'utf-8', $msg)));
?>
