<?
///레이어보기
function view_layer($no){

global $g4;


$sql="select * from {$g4[site_popup_table]} where no=$no ";

$result=mysql_query($sql);
$layer=mysql_fetch_array($result);

$title=stripslashes($layer[title]);
$check_input=$layer[check_input];

$content=nl2br(stripslashes($layer[content]));



$img_file=$layer[img_file];
$img_url=$layer[img_url];
$gigan=$layer[gigan];


$gigan_hour=$gigan*24;	

switch($gigan)
{
	case '1':
		$gigan_text="하루동안 보이지 않습니다";
		break;
	case '2':
		$gigan_text="이틀동안 보이지 않습니다";
		break;

	case '3':
		$gigan_text="사흘동안 보이지 않습니다";
		break;
	
	case '7':
		$gigan_text="일주일동안 보이지 않습니다";
		break;
	
	case '15':
		$gigan_text="보름동안 보이지 않습니다";
		break;
	
	case '0':
		$gigan_text="다음에 보이지 않습니다.";
		break;
	
	default:
		$gigan_text="하루동안 보이지 않습니다";
		break;
}


//----이미지파일을   너비/높이로.변경....	
	if($layer[check_input]=="IMG" && $layer[img_file]){
	
	$size=GetImageSize($g4[path]."/popup_img/".$layer[img_file]);
	$width=$size[0];
	$height=$size[1];
	}else{
	$width=$layer[width];
	$height=$layer[height];
	
	}

if($img_url){
	$a_img_start="<a href='{$img_url}'>";
	$a_img_end="</a>";
}else{
	$a_img_start="";
	$a_img_end="";
}



?>
<div id="layer_<?=$no?>" style="position:absolute; left:<?=$layer[popup_left]?>px; top:<?=$layer[popup_top]?>px; width:<?=$width?>px; height:<?=$height?>px; z-index:<?=1000 +$no?>;filter:revealTrans(transition=23,duration=0.5) blendTrans(duration=0.5);cursor:hand;background-color:#FFFFFF"
onmouseover="dragObj=layer_<?=$no?>; drag=1;move=0" onmouseout="drag=0">
<table border=0 cellpadding=0 cellspacing=0>
<tr height=20 bgcolor=#000000>
<td colspan=2>&nbsp;<font color=#e1e1e1 class='font_11'>■</FONT>&nbsp;<font color=#ffffff class='font_11'><?=$title?></FONT></td>
</tr>
<tr valign=top >
	<td colspan=2>
<!--------------본문---------------->
<?if($check_input=="TEXT") {	
	?>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> height=<?=$height?> >
<tr>
	<td valign=top style="background-color:#fff;"><?=$content?></td>
</tr>
</table>
<? }//컨텐츠 끝?>
<?if($check_input=="IMG") {	
	?>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> height=<?=$height?> >
<tr>
	<td align=center valign=top><?=$a_img_start?><img src="<?=$g4[path]?>/popup_img/<?=$img_file?>" border=0><?=$a_img_end?></td>
</tr>
</table>
<? }//이미지 끝?>

<!---------------본문 끝------------->
	</td>
</tr>

<tr height=20 bgcolor=#000000>
	<td>&nbsp;&nbsp;
	<font color=#FFFFFF style='font-size:11px;font-family:돋움'><?=$gigan_text?></FONT>&nbsp;
	<input type=checkbox name="gigan" value="<?=$gigan?>"
	onclick="set_cookie('cookie_<?=$no?>','Y', <?=$gigan_hour?>,'/');layer_<?=$no?>.style.display='none';" align=absmiddle>
	&nbsp;&nbsp;
	</td>
	<td align=right><span OnClick="layer_<?=$no?>.style.display='none';" style='cursor:hand'><img src='<?=$g4[path]?>/img/img_close_x.gif' border=0 align='absmiddle'></span>
	&nbsp;
	</td>
</tr>
</table>
</div>
<?
}//view_layer의 끝		
?>
