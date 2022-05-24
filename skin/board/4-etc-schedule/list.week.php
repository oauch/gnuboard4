<?
if (!defined("_GNUBOARD_")) exit; // °³º° ÆäÀÌÁö Á¢±Ù ºÒ°¡

//°¡·Î ¼¼·Î Æø ÁöÁ¤
$col_height= 60 ;

$f_day = date("Ymd",mktime(0, 0, 0, $month, $day-7, $year));
$pervyear  = substr($f_day,0,4);
$prevmonth = sprintf("%d",substr($f_day,4,2));
$prevday   = sprintf("%d",substr($f_day,6,2));

$l_day = date("Ymd",mktime(0, 0, 0, $month, $day+7, $year));
$nextyear  = substr($l_day,0,4);
$nextmonth = sprintf("%d",substr($l_day,4,2));
$nextday   = sprintf("%d",substr($l_day,6,2));

$offset  = date("w", mktime(0, 0, 0, $month, 1, $year));

$cur_day = date("w",mktime(0, 0, 0, $month, $day, $year));
$minus_day = 6 - $cur_day;

$week_first = date("Ymd", mktime(0, 0, 0, $month, $day-$cur_day, $year));
$week_last  = date("Ymd", mktime(0, 0, 0, $month, $day+$minus_day, $year));
?>
<style type="text/css">
/* Ä«Å×°í¸® ½ºÅ¸ÀÏ*/
#box_day{width:3%; padding-left: 7px; padding-top: 4px; font-size:12px; font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-weight:bold; float:left;}
#box_list{width:100%;}
#box_list2{width:100%; padding:5px 0px 5px 7px;}

#box00{font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;width:40px;float:left;}
#box01{font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;width:100px;float:left;}
#box02{font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;width:150px;float:right;}
#box03{font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;width:300px;float:right;}
#box04{font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;width:150px;float:right;}

#box1{width:240px;float:left;}
#box2{width:240px;float:left;}

a.day1:link, a.day1:visited, a.day1:active { font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day1:hover { font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

a.day2:link, a.day2:visited, a.day2:active { font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day2:hover { font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

a.day3:link, a.day3:visited, a.day3:active { font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day3:hover { font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

.day4 {font-family:Trebuchet MS;font-size:20px;color:#222222;}
.day5 {font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-size:14px;color:#999999;}
.day6 {font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif; font-size:16px;color:#308dff;}
</style>
<table width="100%" height="39" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td valign="bottom">
	<a href='board.php?bo_table=<?=$bo_table?>&mode=m2'><img src="<?=$board_skin_path?>/img/tab01_off.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=m'><img src="<?=$board_skin_path?>/img/tab02_off.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=w'><img src="<?=$board_skin_path?>/img/tab03_on.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=l'><img src="<?=$board_skin_path?>/img/tab04_off.gif" border="0"></a></td>
	<td align="right">

<div align="right">

<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$prevyear?>&month=<?=$prevmonth?>&day=<?=$prevday?>"></a>
	    <span class="day4"><?=sprintf("%d",substr($week_first,0,4))?>.<?=sprintf("%d",substr($week_first,4,2))?>.<?=sprintf("%d",substr($week_first,6,2))?>. ~ <?=sprintf("%d",substr($week_last,0,4))?>.<?=sprintf("%d",substr($week_last,4,2))?>.<?=sprintf("%d",substr($week_last,6,2))?>.</span>


	<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$prevyear?>&month=<?=$prevmonth?>&day=<?=$prevday?>">
	<img src='<?=$board_skin_path?>/img/btn_dw.gif' border=0 align=absmiddle></a>
	<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$nextyear?>&month=<?=$nextmonth?>&day=<?=$nextday?>">
	<img src='<?=$board_skin_path?>/img/btn_up.gif' border=0 align=absmiddle></a>
	</div>
</td>
</tr>
<tr><td height="1" colspan="2" bgcolor="#B7BDCC"></td></tr>
<tr><td height="10" colspan="2"></td></tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbline1">

<?
$query = "SELECT * FROM $write_table WHERE (wr_link1 between '$week_first' and '$week_last' or  wr_link2 between '$week_first' and '$week_last') or (wr_link1 < '$week_first' and wr_link2 > '$week_last') ORDER BY wr_id ASC";
$result = sql_query($query);

$list = array();
for ($j=0; $row=mysql_fetch_array($result); $j++) {
	$list[$j][wr_id]      = $row[wr_id];
	$list[$j][wr_subject] = $row[wr_subject];
	$list[$j][wr_link1]   = $row[wr_link1];
	$list[$j][wr_link2]   = $row[wr_link2];
	$list[$j][wr_2]       = $row[wr_2];
	$list[$j][wr_6]       = $row[wr_6];
	$list[$j][wr_7]       = $row[wr_7];

    $from_date = str_replace("http://","",$row[wr_link1]);
    $to_date = str_replace("http://","",$row[wr_link2]);
    $from_date = substr($from_date,0,4)."³â ".sprintf("%2d",substr($from_date,4,2))."¿ù ".sprintf("%2d",substr($from_date,6,2))."ÀÏ";
    $to_date   = substr($to_date,0,4)."³â ".sprintf("%2d",substr($to_date,4,2))."¿ù ".sprintf("%2d",substr($to_date,6,2))."ÀÏ";
   //print_r2($row);
	switch ($row[wr_3]) {
	case 1 :
		$list[$j][wr_3] = "<img src='$board_skin_path/img/dia_review.png' border=0 align=absmiddle>";
		break;
	case 2 :
		$list[$j][wr_3] = "<img src='$board_skin_path/img/dia_review.png' border=0 align=absmiddle>";
		break;
	case 3 :
		$list[$j][wr_3] = "<img src='$board_skin_path/img/dia_review.png' border=0 align=absmiddle>";
	    break;
	default :
		$list[$j][wr_3] = "<img src='$board_skin_path/img/dia_review.png' border=0 align=absmiddle>";
	}
}
?>

<tr height="30">
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="30">¿äÀÏ</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="60">³¯Â¥</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center">ÀÏÁ¤</td>
</tr>
<?
for($i=0; $i<=6; $i++) {

	$year1 = date("Y",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
	$month1 = date("n",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
	$day1 = date("j",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));

    $tyear1 = date("Y",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
    $tmonth1 = date("m",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
    $tday1 = date("d",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
    $daydate = $tyear1.$tmonth1.$tday1;

	$bgcolor = "#ffffff"; //ÀÏ¹Ý³¯Â¥

	// ¿äÀÏ Ç¥½ÃÇÏ±â
	switch($i) {
		case("0"):
			$yoil = "<font color=#E75A53 style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>ÀÏ</font>";
			$bgcolor = "#FEFAFF";
			break;
		case("1"):
			$yoil = "<span style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>¿ù</span>";
			break;
		case("2"):
			$yoil = "<span style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>È­</span>";
			break;
		case("3"):
			$yoil = "<span style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>¼ö</span>";
			break;
		case("4"):
			$yoil = "<span style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>¸ñ</span>";
			break;
		case("5"):
			$yoil = "<span style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>±Ý</span>";
			break;
		default:
			$yoil = "<font color=#6c91c3 style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>Åä</font>";
			$bgcolor = "#F0F8FF";
    }

	$tmp = sprintf("%02d",$month1)."-".sprintf("%02d",$day1);
	if ($nal[$tmp])	{
		$title = trim($nal[$tmp][1]);

		if (trim($nal[$tmp][2]) == "*") {
			$day1 = "$day1 <br> <font color=#804180 style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>$title</font>";
			$bgcolor = "#FEFAFF";
		} //°øÈÞÀÏ
		else { $day1 = "$day1 <br> $title"; }
	}

	if ($thisyear==$year && $thismonth==$month && $thisday==$day1) $bgcolor = "#FFFFC0"; //¿À´Ã³¯Â¥
?>
<tr height="<?=$col_height?>">
	<td class="tbline2" align="center" bgcolor="<?=$bgcolor?>"><?echo $yoil?></td>
	<td class="tbline2" align="center" bgcolor="<?=$bgcolor?>">
		<?
		 //±Û¾²±â ±ÇÇÑ¿©ºÎwrite[wr_link1]
		if ($write_href) {
			$f_date = $year1.sprintf("%02d",$month1).sprintf("%02d",$day1);
			echo " <a href='$write_href&f_date=$f_date&t_date=$f_date' style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'>{$month1}. {$day1}</a>\n";
		}
		else {
			echo "$day1\n";
		}
		?>
	</td>
	<td class="tbline2" bgcolor="<?=$bgcolor?>">
	&nbsp;
  <? for ($k=0; $k<$j; $k++) {

	  if (($daydate >= $list[$k][wr_link1]) && ($daydate <= $list[$k][wr_link2])) {
  ?>

   <div id='box_list2'>
	<div id='box01'><?=$list[$k][wr_3]?><a href='./board.php?bo_table=<?=$bo_table?>&mode=w&wr_id=<?=$list[$k][wr_id]?>' style='font-family:Nanum Gothic, ³ª´®°íµñ, sans-serif;'><?=$list[$k][wr_subject]?></a></div>
	<div id='box02'><font color=#e04f00>Àå¼Ò : <?=$list[$k][wr_2]?></font></div>
	<div id='box03'>±â°£ : <?=$from_date?> <?=$list[$k][wr_6]?> <? if($from_date != $to_date) ?> ~ <?=$to_date?> <?=$list[$k][wr_7]?></div>
  </div>
<?
  }
 }
?>
	 &nbsp;
	</td>
</tr>
<? } ?>
</table>
