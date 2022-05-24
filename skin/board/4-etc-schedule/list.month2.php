<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once("$board_skin_path/moonday.php"); // 석봉운님의 음력날짜 함수

//가로 세로 폭 지정
if (eregi('%', $width)) { $col_width = "14%"; }
else { $col_width = round($width/7); }
$col_height= 100 ;

$prevmonth = $month - 1;
$nextmonth = $month + 1;
$prevyear = $year;
$nextyear = $year;
if ($month == 1) {
  $prevmonth = 12;
  $prevyear = $year - 1;
} elseif ($month == 12) {
  $nextmonth = 1;
  $nextyear = $year + 1;
}

//$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));   // the final date of $month
//$offset  = date(w, mktime(0, 0, 0, $month, 1, $year));

$today = getdate(); 
$b_mon = $today['mon']; 
$b_day = $today['mday']; 
$b_year = $today['year']; 
if ($year < 1) { // 오늘의 달력 일때
  $month = $b_mon;
  $mday = $b_day;
  $year = $b_year;
}

$lastday=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
if ($year%4 == 0) $lastday[2] = 29;
$dayoftheweek = date("w", mktime (0,0,0,$month,1,$year));
?>
<style type="text/css">
/* 카테고리 스타일*/
#box_day{width:3%; padding-left: 7px; padding-top: 4px; font-size:12px; font-family:Nanum Gothic, 나눔고딕, sans-serif; font-weight:bold; float:left;}
#box_list{width:97%;}
#box_list2{width:97%; padding:5px 7px 5px 7px;}

a.day1:link, a.day1:visited, a.day1:active { font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day1:hover { font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

a.day2:link, a.day2:visited, a.day2:active { font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day2:hover { font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

a.day3:link, a.day3:visited, a.day3:active { font-size:14px; text-decoration:none; color:#9e9e9e; }
a.day3:hover { font-size:16px;color:#9e9e9e; text-decoration:underline; font-weight:bold; }

.day4 {font-family:Trebuchet MS;font-size:20px;color:#222222;}
.day5 {font-family:Nanum Gothic, 나눔고딕, sans-serif;font-size:14px;color:#999999;}
</style>
<script language="JavaScript">
<!--
function namosw_goto_byselect(sel, targetstr)
{
  var index = sel.selectedIndex;
  if (sel.options[index].value != '') {
     if (targetstr == 'blank') {
       window.open(sel.options[index].value, 'win1');
     } else {
       var frameobj;
       if (targetstr == '') targetstr = 'self';
       if ((frameobj = eval(targetstr)) != null)
         frameobj.location = sel.options[index].value;
     }
  }
}

// 레이어 뷰 스크립트
var iDelay = 80 // Delay to hide in milliseconds
var iNSWidth=250 // Default width for netscape
var sDisplayTimer = null, oLastItem

function getRealPosition(i,which) {
	iPos = 0
	while (i!=null) {
	 	iPos += i["offset" + which]
		i = i.offsetParent
	}
	return iPos
}
function showLayers(sDest,itop,ileft,iWidth) {
	if (document.all!=null) {
		var i = window.event.srcElement
		stopTimer()
		dest = document.all[sDest]
		if ((oLastItem!=null) && (oLastItem!=dest))
			hideItem()
		if (dest) {
			// Netscape Hack
			if (i.offsetWidth==0)
				if (iWidth)
					i.offsetWidth=iWidth
				else
					i.offsetWidth=iNSWidth;
			if (ileft)
				dest.style.pixelLeft = ileft
			else
			dest.style.pixelLeft = getRealPosition(i,"Left") - 5 // 불러오는 메뉴 좌표
//			dest.style.pixelLeft = getRealPosition(i,"Left") + i.offsetWidth *0.1 // 불러오는 메뉴 좌표
			if (itop)
				dest.style.pixelTop = itop
			else
			   	dest.style.pixelTop = getRealPosition(i,"Top") + 15 // 불러오는 메뉴 좌표
			dest.style.visibility = "visible"
		}
		oLastItem = dest
	}
}

function stopTimer() {
	clearTimeout(sDisplayTimer)
}

function startTimer(el) {
	if (!el.contains(event.toElement)) {
		stopTimer()
		sDisplayTimer = setTimeout("hideItem()",iDelay)
	}
}

function hideItem() {
	if (oLastItem)
		oLastItem.style.visibility="hidden"
}

function checkOver() {
	if ((oLastItem) && (oLastItem.contains(event.srcElement))) {
		stopTimer()
	}
}

function checkOut() {
	if (oLastItem==event.srcElement)
		startTimer(event.srcElement)
}

document.onmouseover = checkOver
document.onmouseout = checkOut
//-->
</SCRIPT>
<table width="100%" height="39" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td valign="bottom">
	<a href='board.php?bo_table=<?=$bo_table?>&mode=m2'><img src="<?=$board_skin_path?>/img/tab01_on.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=m'><img src="<?=$board_skin_path?>/img/tab02_off.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=w'><img src="<?=$board_skin_path?>/img/tab03_off.gif" border="0"></a><a href='board.php?bo_table=<?=$bo_table?>&mode=l'><img src="<?=$board_skin_path?>/img/tab04_off.gif" border="0"></a></td>
	<td align="right">

<div align="right">
</span><span class="day4"><?=$year?></span><span class="day5">년</span>
<a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&mode=m2&"?><?if ($month == 1) { $year_pre=$year-1; $month_pre=$month; } else {$year_pre=$year-1; $month_pre=$month;} echo ("year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img/btn_dw.gif" border="0" title="<?=$year_pre?>년" align="absmiddle" /></a> <a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&mode=m2&"?><?if ($month == 12) { $year_pre=$year+1; $month_pre=$month; } else {$year_pre=$year+1; $month_pre=$month;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img/btn_up.gif" border="0" title="<?=$year_pre?>년" align="absmiddle" /></a> <span class="day4">
<?=$month?>
</span><span class="day5">월</span> <a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&mode=m2"?><?if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img/btn_dw.gif" border="0" title="<?=$month_pre?>월" align="absmiddle" /></a> <a href="<?="$_SERVER[PHP_SELF]?bo_table=$bo_table&mode=m2"?><? if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("&year=$year_pre&month=$month_pre");?>" target="_self" onfocus="this.blur()"><img src="<?=$board_skin_path?>/img/btn_up.gif" border="0" title="<?=$month_pre?>월" align="absmiddle" /></a></div>	</td>
</tr>
<tr><td height="1" colspan="2" bgcolor="#B7BDCC"></td></tr>
<tr><td height="10" colspan="2"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbline1">
<tr>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="<?=$col_width?>">일</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="<?=$col_width?>">월</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="<?=$col_width?>">화</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="<?=$col_width?>">수</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="<?=$col_width?>">목</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="<?=$col_width?>">금</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="<?=$col_width?>">토</td>
</tr>

<?
$cday = 1;
$cel_mon = sprintf("%02d",$month);

$query = "SELECT * FROM $write_table WHERE left(wr_link1,6) <= '$year$cel_mon' and left(wr_link2,6) >= '$year$cel_mon' ORDER BY wr_id ASC";
$result = sql_query($query);

$j=0; // layer id
// 내용을 보여주는 부분
while ($row = mysql_fetch_array($result)) {

  if( substr($row[wr_link1],0,6) <  $year.$cel_mon ) {
	 $start_day =1;
	 $start_day= (int)$start_day;
  } else {
	 $start_day = substr($row[wr_link1],6,2);
     $start_day= (int)$start_day;
  }

  if( substr($row[wr_link2],0,6) >  $year.$cel_mon ) {
	 $end_day = $lastday[$month];
	 $end_day= (int)$end_day;
  } else {
	 $end_day = substr($row[wr_link2],6,2);
	 $end_day= (int)$end_day;
  }

	for ($i = $start_day ; $i <= $end_day;  $i++) {

	 $j++; // layer ID

			switch ($row[wr_3]) {
			case 1 :
				$html_day[$i].= "<br><img src='$board_skin_path/img/dia_diary.png' border=0 align=absmiddle>";
				break;
			case 2 :
				$html_day[$i].= "<br><img src='$board_skin_path/img/dia_memorial.png' border=0 align=absmiddle>";
				break;
			case 3 :
				$html_day[$i].= "<br><img src='$board_skin_path/img/dia_schedual.png' border=0 align=absmiddle>";
			    break;
			default :
				$html_day[$i].= "<br><img src='$board_skin_path/img/dia_review.png' border=0 align=absmiddle>";
			}

			$html_day[$i].= "<a onmouseover=\"showLayers('popup_schd".$j."')\" onmouseout=\"startTimer(this)\" href='./board.php?bo_table=$bo_table&wr_id=$row[wr_id]&mode=$mode' style='font-family:Nanum Gothic, 나눔고딕, sans-serif;'>".$row[wr_subject]."</a>"."\n";
?>
<DIV ID="popup_schd<?=$j?>" onmouseout="startTimer(event.srcElement)" style="BORDER-RIGHT: #B0BD2C 1px solid; BORDER-TOP: #B0BD2C 1px solid; BORDER-LEFT: #B0BD2C 1px solid; BORDER-BOTTOM: #B0BD2C 1px solid;  BACKGROUND-COLOR: #C9D832; FILTER: alpha(opacity=90); padding: 5 5 5 5; POSITION:absolute; width:200px; top:-200px; visibility: hidden; Z-INDEX:1; font-family:Nanum Gothic, 나눔고딕, sans-serif;">
<?
$html = 0;
if (strstr($row[wr_option], "html1"))
    $html = 1;
else if (strstr($row[wr_option], "html2"))
    $html = 2;

    $from_date = str_replace("http://","",$row[wr_link1]);
    $to_date = str_replace("http://","",$row[wr_link2]);
    $from_date = substr($from_date,0,4)."년 ".sprintf("%2d",substr($from_date,4,2))."월 ".sprintf("%2d",substr($from_date,6,2))."일";
    $to_date   = substr($to_date,0,4)."년 ".sprintf("%2d",substr($to_date,4,2))."월 ".sprintf("%2d",substr($to_date,6,2))."일";

$viewlist = cut_str(conv_content($row[wr_content], $html),1000,"…");
echo "<b><font color=#8b8b8b>".$row[wr_subject]. "</font></b><br>";

if($from_date != $to_date) {
echo "<b><font color=#8b8b8b>일정 : $from_date $row[wr_6] ~ $to_date $row[wr_7]</font></b><br>";
} else {
echo "<b><font color=#8b8b8b>일정 : $from_date $row[wr_6]</font></b><br>";
}

echo "<b><font color=#8b8b8b>장소 : ".$row[wr_2]."</font></b><br>";
echo "<br>";
echo $viewlist;
?>
</DIV>
<?
	}
}
?>

<?
  // 달력의 틀을 보여주는 부분

  $temp = 7- (($lastday[$month]+$dayoftheweek)%7);

  if ($temp == 7) $temp = 0;
     $lastcount = $lastday[$month]+$dayoftheweek + $temp;

  for ($iz = 1; $iz <= $lastcount; $iz++) { // 42번을 칠하게 된다.
    $bgcolor = "#ffffff";  // 쭉 흰색으로 칠하고
    if ($b_year==$year && $b_mon==$month && $b_day==$cday) $bgcolor = "#EEF1D4";      //  "#DFFDDF"; // 오늘날짜 연두색으로 표기
    if (($iz%7) == 1) echo ("<tr>"); // 주당 7개씩 한쎌씩을 쌓는다.
    if ($dayoftheweek < $iz  &&  $iz <= $lastday[$month]+$dayoftheweek)	{
      // 전체 루프안에서 숫자가 들어가는 셀들만 해당됨
      // 즉 11월 달에서 1일부터 30 일까지만 해당
      $daytext = "$cday";   // $cday 는 숫자 예> 11월달은 1~ 30일 까지
      //$daytext 은 셀에 써질 날짜 숫자 넣을 공간
      $daycontcolor = "" ; 
      $daycolor = ""; 
      if ($iz%7 == 1) {$daycolor = "#E75A53"; $bgcolor = "#FEFAFF";} // 일요일
      if ($iz%7 == 0) {$daycolor = "#6c91c3"; $bgcolor = "#F0F8FF";} // 토요일
	  
      // 여기까지 숫자와 들어갈 내용에 대한 변수들의 세팅이 끝나고 
      // 이제 여기 부터 직접 셀이 그려지면서 그 안에 내용이 들어 간다.
      echo ("<td width=$col_width height=$col_height bgcolor=$bgcolor valign=top class='tbline2'>");

      $f_date = $year.sprintf("%02d",$month).sprintf("%02d",$cday);

      // 기념일 파일 내용 비교위한 변수 선언, 월과 일을 두자리 포맷으로 고정
      if (strlen($month) == 1) { 
        $monthp = "0".$month ;
      } else {
        $monthp = $month ; 
      }
      if (strlen($cday) == 1) {
        $cdayp = "0".$cday ;
      } else { 
        $cdayp = $cday ; 
      }
      $memday = $year.$monthp.$cdayp;
      // *.0000 파일인 해마다 동일한 양력기념일은 월일로만 구분한다.
      if( !file_exists($file_index.".".$year)) { $memday = $monthp.$cdayp; }
      $daycont = "" ;

      // 년월일 8자리 또는 4자리를 잘라 비교하여 뒷 문장을 출력
      for($i=0 ; $i < sizeof($dayfile) ; $i++) {  // 파일 첫 행부터 끝행까지 루프
        if($memday == substr($dayfile[$i],$cutpoint1,$cutpoint2)){$daycont = substr($dayfile[$i],9,strlen($dayfile[$i])-10); 
        // r,b,y,g 구분자로 글자색깔 구분
        $daycl = substr($dayfile[$i],0,1) ;
        if($daycl == "r"){
          $daycontcolor = "red" ; // 휴일
          $daycolor = "red"; 
        }
        else if($daycl == "y"){$daycontcolor = "brown" ;} // 생일
        else if($daycl == "g"){$daycontcolor = "gray" ;} // 음력
        else{$daycontcolor = "blue" ;}
      }	
    }

    // 석봉운님의 음력날짜 변수선언
    $myarray = soltolun($year,$month,$cday);
    if ($myarray[day]==1 || $myarray[day]==11 || $myarray[day]==21) {
      //$moonday ="<font color=gray>&nbsp;(음)$myarray[month].$myarray[day]$myarray[leap]</font>";
	  $moonday="";
    } else {
      $moonday="";
    }

    //include("$schedule_file.moon"); // 음력절기 & 음력기념일
    if ($annivmoonday&&$daycont) $blank="<br>"; // 음력절기와 양력기념일이 동시에 있으면 한칸 띔
    else $blank="";

    if ($write_href) { 
      // $write_href (글쓰기 권한)이 있으면
      // 날짜를 클릭하면 글씨쓰기가 가능한 링크를 넣어서 출력하기
      echo "<a href='$write_href&f_date=$f_date&t_date=$f_date'><font color='$daycolor' style='font-family:Nanum Gothic, 나눔고딕, sans-serif;'>$daytext</font></a>$moonday <font color='$daycontcolor' style='font-family:Nanum Gothic, 나눔고딕, sans-serif;'>$daycont</font>$blank $annivmoonday";
    } 
    else { // 글쓰기 권한이 없으면 글쓰기 링크는 넣지 않고 그냥 숫자와 기념일 내용만 출력하기  
      echo "<font color='$daycolor' style='font-family:Nanum Gothic, 나눔고딕, sans-serif;'>$daytext</font>$moonday <font color='$daycontcolor' style='font-family:Nanum Gothic, 나눔고딕, sans-serif;'>$daycont</font>$blank $annivmoonday";
    }
    echo $html_day[$cday];
    echo ("</td>");  // 한칸을 마무리
    $cday++; // 날짜를 카운팅
  } 
  // 11월에서 1일부터 30일에 해당되지 않으면 그냥 회색을 칠한다.
  else { echo ("     <td width=$col_width height=$col_height bgcolor=#F7F7F7 valign=top class='tbline2'>&nbsp;</td>"); }
  if (($iz%7) == 0) echo ("  </tr>");
   
} // 반복구문이 끝남
?>

</table>
