<?
$sub_menu = "900500";
include_once("./_common.php");



auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");



$g4['title'] = "�˾� ����";
include_once ("./admin.head.php");


//�ű�
$display1="block";
$display2="none";


///�����ϰ��
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

$content=stripslashes($view[content]);//����
$reg_date=str_replace("-","",$view[reg_date]);
$gigan=$view[gigan];
$check_use=$view[check_use];
}
//������


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
		alert("������ �Է��ϼ���!");
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
    <td colspan=2 align=left><div class="admin_title01">�˾�â ����</div> <!-- ?=subtitle("�˾�â ����")? --></td>
</tr>

<tr>
	<td><b>����</b></td>
	<td>&nbsp;<input type=text name="title" size=50 value='<?=$view[title]?>'><div class="admin_tip_small">* �˾��� ������ �Է����ּ���.</div></td>
</tr>
<tr>
	<td><b>�˾�Ÿ��</b></td>
	<td>&nbsp;<input class='admin_input_box' type=radio name="type" value="�˾�â" <?if(!$view[type] ||$view[type]=='�˾�â')echo"checked";?>>��â����
	&nbsp;
	<input type=radio class='admin_input_box' name="type" value="���̾�" <?if($view[type]=='���̾�')echo"checked";?>>���̾�����
	
	<div class="admin_tip_small">* [��â����] ���ο� ������ â���� �����ϴ�.<br>* [���̾�����] �������� �˾��� ���ܼ����� �Ǿ��־ �˾��� ���̰Ե˴ϴ�.</div>
	</td>
</tr>
<tr>
	<td><b>â��ġ</b></td>
	<td>&nbsp;����:<input type=text name="popup_left" size=5 value='<?=$view[popup_left]?>'>&nbsp;&nbsp;����:<input type=text name="popup_top" size=5 value='<?=$view[popup_top]?>'>
	&nbsp;&nbsp;
	
	<font color=#ff8000>[���Է½� 0:0���� �Էµ�]</font>
	
	<div class="admin_tip_small">* ����� ���� ��� �����̸� �ȼ������� ������ �������ϴ�.</div>
	</td>
</tr>
<tr>
	<td><b>������</b></td>
	<td>&nbsp;����:<input type=text name="width" size=5 value='<?=$view[width]?>'>&nbsp;&nbsp;����:<input type=text name="height" size=5 value='<?=$view[height]?>'>&nbsp;&nbsp;&nbsp;&nbsp;
	<font color=#ff8000>[�⺻:300*400]</font>
	
	<div class="admin_tip_small">* �˾��� <b>���� ������</b>�� �Է����ݴϴ�.</div>
	</td>
</tr>
<tr style="display:none;">
	<td ><b>�ɼ�</b></td>
	<td >&nbsp;
	    <input class='admin_input_box' type=checkbox name="menubar" value="Y" <?if($view[menubar]=='Y')echo"checked";?>>�޴���&nbsp;
		<input class='admin_input_box' type=checkbox name="toolbar" value="Y" <?if($view[toolbar]=='Y')echo"checked";?>>����&nbsp;
		<input class='admin_input_box' type=checkbox name="resizable" value="Y" <?if($view[resizable]=='Y')echo"checked";?>>���������&nbsp;
		<input class='admin_input_box' type=checkbox name="scrollbars" value="Y" <?if($view[scrollbars]=='Y')echo"checked";?>>��ũ�ѹ�&nbsp;
		<input class='admin_input_box' type=checkbox name="status" value="Y" <?if($view[status]=='Y')echo"checked";?>>���¹�&nbsp;
	</td>
</tr>
<tr>
	<td><b>�Է¹��</b></td>
	<td>&nbsp;
		<input class='admin_input_box' type=radio name="check_input" value="TEXT" onclick="selectMenu('0')" <?if($view[check_input]==''||$view[check_input]=="TEXT") echo"checked";?> >������Ʈ&nbsp;
		<input class='admin_input_box' type=radio name="check_input" value="IMG" onclick="selectMenu('1')" <?if($view[check_input]=="IMG") echo"checked";?>>�̹�������
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
	<td><b>�̹�������</b>&nbsp;</td>
	<td>&nbsp;<input type=file name="img_file" size=40 class=input>
<?if($mode=='modify'&&$view[img_file]){///�̹����� ���ε�Ǿ������?>
	&nbsp;���ε��̹���:<font color=#FF8000><B><?=$view[img_file]?></B></FONT>
	<input type=hidden name="r_img_file" value="<?=$view[img_file]?>">
<?}?>	
	&nbsp;�̹��� �̸��� <b>����</b> �Ǵ� <b>����</b>�� �����մϴ�.</td>
</tr>
<tr>
	<td><b>�̹�����ũ</b>&nbsp;</td>
	<td>&nbsp;<input type=text name="img_url" size=50 value='<?=$view[img_url]?>'></td>
</tr>
</table>
</span>

<!---------------------------------------------------------------------------------->	
	</td>
</tr>
<tr style="display:none;">
	<td><b>��������</b></td>
	<td>&nbsp;
	&nbsp;
	<select name="level" size=1>
		<option value="0" <?if(!$view[level]||$view[level]=='0')echo "selected";?> >��ü</option>
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
	</select>&nbsp;ȸ������ ����
	</td>
</tr>
<tr>
	<td><b>���۳�¥</b></td>
	<td>&nbsp;


		<input class=ed type=text id=reg_date name='reg_date' size=8 maxlength=8 minlength=8 required numeric itemname='���� ��¥' value='<?=$reg_date?>' readonly title='���� �޷� �������� Ŭ���Ͽ� ��¥�� �Է��ϼ���.'>	
		<a href="javascript:win_calendar('reg_date', document.getElementById('reg_date').value, '');"><img src='./img/calendar.gif' border=0 align=absmiddle title='�޷� - ��¥�� �����ϼ���'></a>
		&nbsp;
		<font color=#FF8000>[���Է½� ���糯¥�� ������]</FONT>
		
	</td>
</tr>
<tr style="display:none;">
	<td><b>����Ⱓ</b></td>
	<td>&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="1" <?if(!$gigan||$gigan=="1") echo "checked";?> >1��&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="2" <?if($gigan=="2") echo "checked";?>>2��&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="3" <?if($gigan=="3") echo "checked";?>>3��&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="7" <?if($gigan=="7") echo "checked";?>>7��&nbsp;
		<input class='admin_input_box' type=radio name="gigan" value="15" <?if($gigan=="15") echo "checked";?>>15��&nbsp;
		
	</td>
</tr>
<tr>
	<td ><b>�˾�����</b></td>
	<td >&nbsp;
		<input class='admin_input_box' type=radio name="check_use" value="Y" <?if(!$check_use||$check_use=="Y") echo "checked";?> >���&nbsp;
		<input class='admin_input_box' type=radio name="check_use" value="N" <?if($check_use=="N") echo"checked";?> >�̻��&nbsp;
	</td>
</tr>
<tr>
	<td colspan=2 align=center>
	<input type=button value="�Է�" onclick="javascript:check_submit()" class=admin_black_bt>&nbsp;&nbsp;
	<input type=reset value="���" class=admin_black_bt>
	</td>
</tr>
</form>
</table>


<?
include_once("./admin.tail.php");
?>
