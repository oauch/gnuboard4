<?
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
if($mode=="check")
{

	$gigan_time=time() + $gigan*86400;	

	setcookie("cookie_$no","Y",$gigan_time,"/");

	echo "<script>
			self.close();
			</script>";
	exit;

}


include_once("./_common.php");
///�˾����̺��



$sql="select * from {$g4[site_popup_table]} where no=$no ";

$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$title=stripslashes($row[title]);
$check_input=$row[check_input];

$content=stripslashes($row[content]);




$img_file=$row[img_file];
$img_url=$row[img_url];
$gigan=$row[gigan];

switch($gigan)
{
	case '1':
		$gigan_text="�Ϸ絿�� ������ �ʽ��ϴ�";
		break;
	case '2':
		$gigan_text="��Ʋ���� ������ �ʽ��ϴ�";
		break;

	case '3':
		$gigan_text="���굿�� ������ �ʽ��ϴ�";
		break;
	
	case '7':
		$gigan_text="�����ϵ��� ������ �ʽ��ϴ�";
		break;
	
	case '15':
		$gigan_text="�������� ������ �ʽ��ϴ�";
		break;
	
	case '0':
		$gigan_text="������ ������ �ʽ��ϴ�.";
		break;
	
	default:
		$gigan_text="�Ϸ絿�� ������ �ʽ��ϴ�";
		break;
}


//----�̹���������   �ʺ�/���̷�.����....	
	if($row[check_input]=="IMG" && $row[img_file]){
	
	$size=GetImageSize($g4[path]."/popup_img/".$row[img_file]);
	$width=$size[0];
	$height=$size[1];
	}else{
	$width=$row[width];
	$height=$row[height];
	
	}

if($img_url){
	$a_img_start="<a href='{$img_url}' target=_blank>";
	$a_img_end="</a>";
}else{
	$a_img_start="";
	$a_img_end="";
}



?>
<html>
<head>
<title><?=$title?></title>
<style type='text/css'>
TABLE {font-size:12px;}
.font_11{font-size:11px;font-family:����}
</style>

</head>
<body topmargin=0 leftmargin=0>
<form name="form1" action="<?=$PHP_SELF?>"  method=post>
<input type=hidden name='mode' value='check'>
<input type=hidden name='no' value='<?=$no?>'>
<?if($check_input=="TEXT") {	
	?>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> height=100% >
<tr>
	<td valign=top height=100%><?=$content?></td>
</tr>
<? }//������ ��?>
<?if($check_input=="IMG") {	
	?>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> height=100% >
<tr>
	<td align=center valign=top height=100%><?=$a_img_start?><img src="<?=$g4[path]?>/popup_img/<?=$img_file?>" border=0><?=$a_img_end?></td>
</tr>
<? }//�̹��� ��?>

<tr>
	<td height=30 bgcolor=#000000  valign=middle>
	<font color=#FFFFFF class='font_11'>&nbsp;&nbsp;<?=$gigan_text?></font>&nbsp;
	<input type=checkbox name="gigan" value="<?=$gigan?>"
	onclick="javascript:form1.submit()">
	</td>
</tr>
</form>
</table>
</body>
</html>
