<?
include_once("./_common.php");

$msg = "<div id='popupLayer' class='popup_area'>";
$msg .= "<div class='bg_opacity'></div>";
$msg .= "<div class='popup_layer'>";

	$msg .= "<div class='claim_head'><h1>�Ű��ϱ�</h1><a href='#close' class='bu_close' onclick='close_layer(); return false;' title='�ݱ�'>�ݱ�</a></div>";
	$msg .= "<form>";
	$msg .= "<div class='claim_body'>";
		$msg .= "<table class='horiz' summary='�Ű���'>";
		$msg .= "<caption>�Ű���</caption>";
		$msg .= "<colgroup>";
		$msg .= "<col width='20%' />";
		$msg .= "<col width='' />";
		$msg .= "</colgroup>";
		$msg .= "<tbody>";
			$msg .= "<tr>";
			$msg .= "<th>����</th>";
			$msg .= "<td colspan='3'>ģ���� ����ȣ �������! �Ϻ����� �����ϱ�...</td>";
			$msg .= "</tr>";
			$msg .= "<tr>";
			$msg .= "<th>�ۼ���</th>";
			$msg .= "<td>JYSOFT</td>";
			$msg .= "<th>�Ű���</th>";
			$msg .= "<td>�ľ���</td>";
			$msg .= "</tr>";
			$msg .= "<tr>";
			$msg .= "<th>�Ű����</th>";
			$msg .= "<td colspan='3'>����3</td>";
			$msg .= "</tr>";
		$msg .= "</tbody>";
		$msg .= "</table>";
		$msg .= "<textarea rows='8' cols='70' class='textbox' style='margin-top:10px; width:449px; height:100px;'></textarea>";
		$msg .= "<p class='txt_notice'>���� �Ű��� ��� �Ű����� Ȱ���� ������ �ް� �ǿ��� ���� ������ �ֽñ� �ٶ��ϴ�.</p>";
		$msg .= "<div class='btn_area'><input type='image' src='$g4[path]/img/jyboard/btn_submit_claim.gif' alt='�Ű��ϱ�' title='�Ű��ϱ�' /><a href='#close' class='btn_close' onclick='close_layer(); return false;' title='�ݱ�'>�ݱ�</a></div>";
	$msg .= "</div>";
	$msg .= "</form>";

$msg .= "</div>";
$msg .= "</div>";

die(rawurlencode(iconv('euc-kr', 'utf-8', $msg)));
?>
