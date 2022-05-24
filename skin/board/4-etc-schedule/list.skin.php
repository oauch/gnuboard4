<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

	//---- ���� ��¥
	$thisyear  = date('Y');  // 2000
	$thismonth = date('n');  // 1, 2, 3, ..., 12
	$thisday   = date('j');  // 1, 2, 3, ..., 31

	//------ $year, $month ���� ������ ���� ��¥
	if (!$year)  { $year = $thisyear; }
	if (!$month) { $month = $thismonth; }
	if (!$day)   { $day = $thisday; }


	$f = @file("$g4[path]/bbs/calendar/$year.txt");
	if ($f) {
		while ($line = each($f)) {
			$tmp = explode("|", $line[value]);
	        $nal[$tmp[0]] = $tmp;
	    }
	}


	//------ ��¥�� ���� üũ
	if (($year > 9999) or ($year < 0)){
		alert("������ 0~9999�⸸ �����մϴ�.");
	}

	if (($month > 12) or ($month < 0)){
		alert("���� 1~12�� �����մϴ�.");
	}
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/style.css" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr>
<td>
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td>

<?
	switch ($mode) { 
	case "d" :
		include "$board_skin_path/list.day.php";		
		break; 
	case "w" :
		include "$board_skin_path/list.week.php";		
		break; 
	case "m2" :
		include "$board_skin_path/list.month2.php";
	    break; 
	case "m" :
		include "$board_skin_path/list.month.php";
	    break; 
	case "l" :
		include "$board_skin_path/list.day.php";
	    break; 
	default :
		include "$board_skin_path/list.month2.php";
	}
?>
</td>
</tr>
</table>
	</td>
</tr>
</table>