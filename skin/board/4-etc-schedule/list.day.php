<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

$f_day = date("Ymd",mktime(0, 0, 0, $month, $day-1, $year));
$pervyear  = substr($f_day,0,4);
$prevmonth = sprintf("%d",substr($f_day,4,2));
$prevday   = sprintf("%d",substr($f_day,6,2));

$l_day = date("Ymd",mktime(0, 0, 0, $month, $day+1, $year));
$nextyear  = substr($l_day,0,4);
$nextmonth = sprintf("%d",substr($l_day,4,2));
$nextday   = sprintf("%d",substr($l_day,6,2));

$cel_mon = sprintf("%02d",$month);
$cel_day = sprintf("%02d",$day);
$query = "SELECT * FROM $write_table WHERE wr_link1 <= '$year$cel_mon$cel_day' and wr_link2 >= '$year$cel_mon$cel_day' ORDER BY wr_id ASC";
$result = sql_query($query);

$list = array();
?>
<style type="text/css">
/* ī�װ� ��Ÿ��*/
#box_day{width:3%; padding-left: 7px; padding-top: 4px; font-size:12px; font-family:����; font-weight:bold; float:left;}
#box_list{width:97%;}
#box_list2{width:97%; padding:5px 7px 5px 7px;}

a.day1:link, a.day1:visited, a.day1:active { font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day1:hover { font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

a.day2:link, a.day2:visited, a.day2:active { font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day2:hover { font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

a.day3:link, a.day3:visited, a.day3:active { font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day3:hover { font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

.day4 {font-family:Trebuchet MS;font-size:20px;color:#222222;}
.day5 {font-family:Nanum Gothic, �������, sans-serif;font-size:14px;color:#999999;}
</style>
<table width="100%" height="39" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td valign="bottom">
	<a href='board.php?bo_table=<?=$bo_table?>&mode=m2'><img src="<?=$board_skin_path?>/img/tab01_off.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=m'><img src="<?=$board_skin_path?>/img/tab02_off.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=w'><img src="<?=$board_skin_path?>/img/tab03_off.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=l'><img src="<?=$board_skin_path?>/img/tab04_on.gif" border="0"></a></td>
	<td align="right">

<div align="right">
</span><span class="day4"><?=$year?></span><span class="day5">��</span>
<a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&"?><?if ($month == 1) { $year_pre=$year-1; $month_pre=$month; } else {$year_pre=$year-1; $month_pre=$month;} echo ("year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img/btn_dw.gif" border="0" title="<?=$year_pre?>��" align="absmiddle" /></a> <a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?><?if ($month == 12) { $year_pre=$year+1; $month_pre=$month; } else {$year_pre=$year+1; $month_pre=$month;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img/btn_up.gif" border="0" title="<?=$year_pre?>��" align="absmiddle" /></a> <span class="day4">
<?=$month?>
</span><span class="day5">��</span> <a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?><?if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img/btn_dw.gif" border="0" title="<?=$month_pre?>��" align="absmiddle" /></a> <a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table"?><? if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img/btn_up.gif" border="0" title="<?=$month_pre?>��" align="absmiddle" /></a>
<?
		 //�۾��� ���ѿ���
if ($write_href) {
	$f_date = $year.$cel_mon.$cel_day;
	echo " <a href='$write_href&write[wr_link1]=$f_date'><span class='day4'>$day</span><span class='day5'>��</span></a>\n";
	} else {
	echo "<span class='day4'>$day</span><span class='day5'>��</span>\n";
	}
?>
<a href="./board.php?bo_table=<?=$bo_table?>&mode=d&year=<?=$prevyear?>&month=<?=$prevmonth?>&day=<?=$prevday?>"><img src='<?=$board_skin_path?>/img/btn_dw.gif' border=0 align="absmiddle"></a> <a href="./board.php?bo_table=<?=$bo_table?>&mode=d&year=<?=$nextyear?>&month=<?=$nextmonth?>&day=<?=$nextday?>"><img src='<?=$board_skin_path?>/img/btn_up.gif' border=0 align="absmiddle"></a>
</div>
</td>
</tr>
<tr><td height="1" colspan="2" bgcolor="#B7BDCC"></td></tr>
<tr><td height="10" colspan="2"></td></tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td align="center" height="35">

	</td>
	<td align="right" style='font-family:Nanum Gothic, �������, sans-serif;'>
		<img src='<?=$board_skin_path?>/img/dia_diary.png' border=0 align=absmiddle> �ϱ�
		<img src='<?=$board_skin_path?>/img/dia_memorial.png' border=0 align=absmiddle> ���
		<img src='<?=$board_skin_path?>/img/dia_schedual.png' border=0 align=absmiddle> ����
		<img src='<?=$board_skin_path?>/img/dia_review.png' border=0 align=absmiddle> �޸�
	</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbline1">
<?
for ($j=0; $row=mysql_fetch_array($result); $j++) {
	$list[$j][wr_id]       = $row[wr_id];
	$list[$j][wr_subject]  = $row[wr_subject];
	$list[$j][wr_2]        = $row[wr_2];
	$list[$j][wr_6]        = $row[wr_6];
	$list[$j][wr_7]        = $row[wr_7];
	$list[$j][wr_id]       = $row[wr_id];
	$list[$j][wr_link1]    = $row[wr_link1];
	$list[$j][wr_link2]    = $row[wr_link2];
	$list[$j][wr_datetime]  = substr($row[wr_datetime],0,10);

    $from_date = str_replace("http://","",$row[wr_link1]);
    $to_date = str_replace("http://","",$row[wr_link2]);
    $from_date = substr($from_date,0,4)."�� ".sprintf("%2d",substr($from_date,4,2))."�� ".sprintf("%2d",substr($from_date,6,2))."��";
    $to_date   = substr($to_date,0,4)."�� ".sprintf("%2d",substr($to_date,4,2))."�� ".sprintf("%2d",substr($to_date,6,2))."��";

	switch ($row[wr_3]) {
	case 1 :
		$list[$j][wr_3] = "<img src='$board_skin_path/img/dia_diary.png' border=0 align=absmiddle> �ϱ�";
		break;
	case 2 :
		$list[$j][wr_3] = "<img src='$board_skin_path/img/dia_memorial.png' border=0 align=absmiddle> ���";
		break;
	case 3 :
		$list[$j][wr_3] = "<img src='$board_skin_path/img/dia_schedual.png' border=0 align=absmiddle> ����";
	    break;
	default :
		$list[$j][wr_3] = "<img src='$board_skin_path/img/dia_review.png' border=0 align=absmiddle> �޸�";
	}
}
?>
<tr>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="80">�з�</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center">������ ����</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="80">�����</td>
</tr>
<? for($k=0; $k<count($list); $k++) {?>
<tr>
	<td class="tbline2" height="25" align="center"><?=$list[$k][wr_3]?></td>
	<td class="tbline2">
		<a href='./board.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$k][wr_id]?>' style='font-family:Nanum Gothic, �������, sans-serif;'><?=$list[$k][wr_subject]?></a> &nbsp;|&nbsp;�Ⱓ : <?=$from_date?> <?=$list[$k][wr_6]?> <? if($from_date != $to_date) { ?> ~ <?=$to_date?> <?=$list[$k][wr_7]?> <? } ?> &nbsp;|&nbsp;��� :  <?=$list[$k][wr_2]?>
	</td>
	<td class="tbline2" align="center"><?=$list[$k][wr_datetime]?></td>
</tr>
<? } ?>

<? if (count($list) == 0) { ?>
<tr><td class="tbline2" height="200" colspan="3" align="center">���� ��ϵ� ������ �����ϴ�.</td></tr>
<? } ?>
</table>
