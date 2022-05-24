<?
$sub_menu = "900500";
include_once("./_common.php");



auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");



$g4['title'] = "팝업 생성";
include_once ("./admin.head.php");


//신규
$display1="block";
$display2="none";


///수정일경우
if($mode=='modify'){
$sql="select * from $g4[site_popup_table] where no=$no ";
$result=mysql_query($sql);
$view=mysql_fetch_array($result);

	if(!$view[check_input]||$view[check_input]=='TEXT'){
		$display1="block";
		$display2="none";
	}else{
		$display1="none";
		$display2="block";
	}

$content=stripslashes($view[content]);//내용
$reg_date=str_replace("-","",$view[reg_date]);
$gigan=$view[gigan];
$check_use=$view[check_use];
}
//수정끝


include_once("$g4[path]/lib/cheditor4.lib.php");
echo "<script src='$g4[cheditor4_path]/cheditor.js'></script>";
echo cheditor1('content', '100%', '350');

?>

<? $admin_HadeNum = "05"; ?>


<script language="javascript">
<!--
 function selectMenu(name)
 {
     if(name==0) {
				submenu_0.style.display = '';
   				submenu_1.style.display = 'none';
				  }
	 else if(name==1)
				{
  				submenu_0.style.display = 'none';
   				submenu_1.style.display = '';
				}

 } 


function check_submit()
 {
  var form=document.form1;

   if(!form.title.value)
	{
		alert("제목을 입력하세요!");
		form.title.focus();
		return;	
	}

  	
<? echo cheditor3('content');?>



  form.target="_self";
  form.action="./site_popup_form_update.php";
  form.submit();

 }


//-->
</script>


<form name=form1 method=post action="./site_popup_update.php" enctype="multipart/form-data">
<input type=hidden name=token value='<?=$token?>'>
<input type=hidden name='mode' value='<?=$mode?>'>
<input type=hidden name='no' value='<?=$no?>'>
<table width=100% cellpadding=0 cellspacing=0 border=0 class="admin_basic_board_write">
<colgroup width=100>
<colgroup width=''>
<tr>
    <td colspan=2 align=left><div class="admin_title01">팝업창 설정</div> <!-- ?=subtitle("팝업창 설정")? --></td>
</tr>

<tr>
	<td><b>제목</b></td>
	<td>&nbsp;<input type=text name="title" size=50 value='<?=$view[title]?>'><div class="admin_tip_small">* 팝업의 제목을 입력해주세요.</div></td>
</tr>
<tr>
	<td><b>팝업타입</b></td>
	<td>&nbsp;<input class='admin_input_box' type=radio name="type" value="팝업창" <?if(!$view[type] ||$view[type]=='팝업창')echo"checked";?>>새창형식
	&nbsp;
	<input type=radio class='admin_input_box' name="type" value="레이어" <?if($view[type]=='레이어')echo"checked";?>>레이어형식
	
	<div class="admin_tip_small">* [새창형식] 새로운 브라우저 창으로 열립니다.<br>* [레이어형식] 브라우저에 팝업이 차단설정이 되어있어도 팝업이 보이게됩니다.</div>
	</td>
</tr>
<tr>
	<td><b>창위치</b></td>
	<td>&nbsp;왼쪽:<input type=text name="popup_left" size=5 value='<?=$view[popup_left]?>'>&nbsp;&nbsp;위쪽:<input type=text name="popup_top" size=5 value='<?=$view[popup_top]?>'>
	&nbsp;&nbsp;
	
	<font color=#ff8000>[미입력시 0:0으로 입력됨]</font>
	
	<div class="admin_tip_small">* 모니터 좌측 상단 기준이며 픽셀단위로 공간을 만들어냅니다.</div>
	</td>
</tr>
<tr>
	<td><b>사이즈</b></td>
	<td>&nbsp;가로:<input type=text name="width" size=5 value='<?=$view[width]?>'>&nbsp;&nbsp;높이:<input type=text name="height" size=5 value='<?=$view[height]?>'>&nbsp;&nbsp;&nbsp;&nbsp;
	<font color=#ff8000>[기본:300*400]</font>
	
	<div class="admin_tip_small">* 팝업의 <b>실제 사이즈</b>를 입력해줍니다.</div>
	</td>
</tr>
<tr style="display:none;">
	<td ><b>옵션</b></td>
	<td >&nbsp;
	    <input class='admin_input_box' type=checkbox name="menubar" value="Y" <?if($view[menubar]=='Y')echo"checked";?>>메뉴바&nbsp;
		<input class='admin_input_box' type=checkbox name="toolbar" value="Y" <?if($view[toolbar]=='Y')echo"checked";?>>툴바&nbsp;
		<input class='admin_input_box' type=checkbox name="resizable" value="Y" <?if($view[resizable]=='Y')echo"checked";?>>리사이즈가능&nbsp;
		<input class='admin_input_box' type=checkbox name="scrollbars" value="Y" <?if($view[scrollbars]=='Y')echo"checked";?>>스크롤바&nbsp;
		<input class='admin_input_box' type=checkbox name="status" value="Y" <?if($view[status]=='Y')echo"checked";?>>상태바&nbsp;
	</td>
</tr>
<tr>
	<td><b>입력방식</b></td>
	<td>&nbsp;
		<input class='admin_input_box' type=radio name="check_input" value="TEXT" onclick="selectMenu('0')" <?if($view[check_input]==''||$view[check_input]=="TEXT") echo"checked";?> >웹에디트&nbsp;
		<input class='admin_input_box' type=radio name="check_input" value="IMG" onclick="selectMenu('1')" <?if($view[check_input]=="IMG") echo"checked";?>>이미지전용
	</td>
</tr>
<tr>
	<td colspan=2 valign=top bgcolor=#ffffff>
<!---------------------------------------------------------------------------------->
<span id=submenu_0 style='position:relative;left:0px;top:0px;display:<?=$display1?>;'>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
	<td align=center><?=cheditor2('content', $content);?></td>
</tr>
</table>
</span>
<!--------------------------------------------------------------------------------->
<span id=submenu_1 style='position:relative;left:0px;top:0px;display:<?=$display2?>;'>
<table border=0 cellpadding=0 cellspacing=0 width=100% >
<col width=100 align=right></col>
<col width=''></col>
<tr>
	<td><b>이미지선택</b>&nbsp;</td>
	<td>&nbsp;<input type=file name="img_file" size=40 class=input>
<?if($mode=='modify'&&$view[img_file]){///이미지가 업로드되었을경우?>
	&nbsp;업로드이미지:<font color=#FF8000><B><?=$view[img_file]?></B></FONT>
	<input type=hidden name="r_img_file" value="<?=$view[img_file]?>">
<?}?>	
	&nbsp;이미지 이름은 <b>영문</b> 또는 <b>숫자</b>만 가능합니다.</td>
</tr>
<tr>
	<td><b>이미지링크</b>&nbsp;</td>
	<td>&nbsp;<input type=text name="img_url" size=50 value='<?=$view[img_url]?>'></td>
</tr>
</table>
</span>

<!---------------------------------------------------------------------------------->	
	</td>
</tr>
<tr style="display:none;">
	<td><b>적용조건</b></td>
	<td>&nbsp;
	&nbsp;
	<select name="level" size=1>
		<option value="0" <?if(!$view[level]||$view[level]=='0')echo "selected";?> >전체</option>
		<option value="1" <?if($view[level]=='1')echo "selected";?> >1 Level</option>
		<option value="2" <?if($view[level]=='2')echo "selected";?> >2 Level</option>
		<option value="3" <?if($view[level]=='3')echo "selected";?> >3 Level</option>
		<option value="4" <?if($view[level]=='4')echo "selected";?> >4 Level</option>
		<option value="5" <?if($view[level]=='5')echo "selected";?> >5 Level</option>
		<option value="6" <?if($view[level]=='6')echo "selected";?> >6 Level</option>
		<option value="7" <?if($view[level]=='7')echo "selected";?> >7 Level</option>
		<option value="8" <?if($view[level]=='8')echo "selected";?> >8 Level</option>
		<option value="9" <?if($view[level]=='9')echo "selected";?> >9 Level</option>
		<option value="10" <?if($view[level]=='10')echo "selected";?> >10 Level</option>
	</select>&nbsp;회원에게 적용
	</td>
</tr>
<tr>
	<td><b>시작날짜</b></td>
	<td>&nbsp;


		<input class=ed type=text id=reg_date name='reg_date' size=8 maxlength=8 minlength=8 required numeric itemname='시작 날짜' value='<?=$reg_date?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'>	
		<a href="javascript:win_calendar('reg_date', document.getElementById('reg_date').value, '');"><img src='./img/calendar.gif' border=0 align=absmiddle title='달력 - 날짜를 선택하세요'></a>
		&nbsp;
		<font color=#FF8000>[미입력시 현재날짜로 설정됨]</FONT>
		
	</td>
</tr>
<tr style="display:none;">
	<td><b>숨김기간</b></td>
	<td>&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="1" <?if(!$gigan||$gigan=="1") echo "checked";?> >1일&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="2" <?if($gigan=="2") echo "checked";?>>2일&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="3" <?if($gigan=="3") echo "checked";?>>3일&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="7" <?if($gigan=="7") echo "checked";?>>7일&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="15" <?if($gigan=="15") echo "checked";?>>15일&nbsp;
		
	</td>
</tr>
<tr>
	<td ><b>팝업유무</b></td>
	<td >&nbsp;
		<input class='admin_input_box' type=radio name="check_use" value="Y" <?if(!$check_use||$check_use=="Y") echo "checked";?> >사용&nbsp;
		<input class='admin_input_box' type=radio name="check_use" value="N" <?if($check_use=="N") echo"checked";?> >미사용&nbsp;
	</td>
</tr>
<tr>
	<td colspan=2 align=center>
	<input type=button value="입력" onclick="javascript:check_submit()" class=admin_black_bt>&nbsp;&nbsp;
	<input type=reset value="취소" class=admin_black_bt>
	</td>
</tr>
</form>
</table>


<?
include_once("./admin.tail.php");
?>
