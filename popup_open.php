<?
ob_start();


include $g4[path]."/popup_layer.php";///layer�Լ�

if(!$member[mb_level] || $member[mb_level]=="1"){///ȸ���� �ƴѰ��[�մ�]


$sql="select * from  $g4[site_popup_table] where DATE_FORMAT(now(),'%Y-%m-%d') >= reg_date and  check_use='Y' and (level=0 or level=1)";	
$result=mysql_query($sql);
$total_num=mysql_num_rows($result);
for($i=0;$row=mysql_fetch_array($result);$i++)
{
	
	
	
	
	$no=$row[no];
	$type=$row[type];
	$center=$row[center];

	//�˾��� ��Ű�� �߻������� PASS�Ѵ�
	if($_COOKIE['cookie_'.$no]=='Y')continue; 
	

	//----�̹���������   �ʺ�/���̷�.����....	
	if($row[check_input]=="IMG" && $row[img_file]){
	
	$size=GetImageSize($g4[path]."/popup_img/".$row[img_file]);
	$width=$size[0];
	$height=$size[1] + 30;
	}else{
	$width=$row[width];
	$height=$row[height]+30;
	
	}


	if($type=="�˾�â"){
		echo "<script language=\"javascript\">";
		if($row[menubar]=="Y"){ $menubar="yes";}else{ $menubar="no";}
		if($row[toolbar]=="Y"){ $toolbar="yes";}else{ $toolbar="no";}
		if($row[scrollbars]=="Y"){ $scrollbars="yes";}else{ $scrollbars="no";}
		if($row[resizable]=="Y"){ $resizable="yes";}else{ $resizable="no";}
		if($row[status]=="Y"){ $status="yes";}else{ $status="no";}
	
		
		if($center!="Y"){
		$popup_left=$row[popup_left];
		$popup_top=$row[popup_top];
		$option="menubar=$menubar,scrollbars=$scrollbars,status=$status,toolbar=$toolbar,resizable=$resizable,width=$width,height=$height,left=$popup_left,top=$popup_top";

		}else{?>	
	
		var left_pos_<?=$i?>,top_pos_<?=$i?>;
		left_pos_<?=$i?>=(screen.width-<?=$width?>)/2;
		top_pos_<?=$i?>=(screen.height-<?=$height?>)/2;
		<?
		$option="menubar=$menubar,scrollbars=$scrollbars,status=$status,toolbar=$toolbar,resizable=$resizable,width=$width,height=$height,left='+left_pos_{$i}+',top='+top_pos_{$i}+'";	
		}//�߾������ΰ���� ��
	
		echo "window.open('".$g4[path]."/popup_view.php?no=$no','new_win$i','$option');"; 
		echo "</script>";
	
	}else if($type=='���̾�'){//���̾�â�ϰ��
	
		view_layer($no);
	}//���̾��ǳ�

	

	
	

}




}else{//ȸ���ΰ��--------------


$sql="select * from {$g4[site_popup_table]} where DATE_FORMAT(now(),'%Y-%m-%d') >= reg_date and check_use='Y' and (level=0 or level={$member[mb_level]})";

$result=mysql_query($sql,$connect_db);




for($i=0;$row=mysql_fetch_array($result);$i++)
{

			
	$no=$row[no];
	$type=$row[type];
	$center=$row[center];

	//�˾��� ��Ű�� �߻������� PASS�Ѵ�
	if($_COOKIE['cookie_'.$no]=='Y')continue; 
	
	//----�̹���������   �ʺ�/���̷�.����....	
	if($row[check_input]=="IMG" && $row[img_file]){
	
	$size=GetImageSize($g4[path]."/popup_img/".$row[img_file]);
	$width=$size[0];
	$height=$size[1] + 30;
	}else{
	$width=$row[width];
	$height=$row[height]+30;
	
	}


	if($type=="�˾�â"){
		echo "<script language=\"javascript\">";
		if($row[menubar]=="Y"){ $menubar="yes";}else{ $menubar="no";}
		if($row[toolbar]=="Y"){ $toolbar="yes";}else{ $toolbar="no";}
		if($row[scrollbars]=="Y"){ $scrollbars="yes";}else{ $scrollbars="no";}
		if($row[resizable]=="Y"){ $resizable="yes";}else{ $resizable="no";}
		if($row[status]=="Y"){ $status="yes";}else{ $status="no";}


		if($center!="Y"){
		$popup_left=$row[popup_left];
		$popup_top=$row[popup_top];

		$option="menubar=$menubar,scrollbars=$scrollbars,status=$status,toolbar=$toolbar,resizable=$resizable,width=$width,height=$height,left=$popup_left,top=$popup_top";
		}else{?>	
		 var left_pos_<?=$i?>,top_pos_<?=$i?>;
		left_pos_<?=$i?>=(screen.width-<?=$width?>)/2;
		top_pos_<?=$i?>=(screen.height-<?=$height?>)/2;
		<?
		$option="menubar=$menubar,scrollbars=$scrollbars,status=$status,toolbar=$toolbar,resizable=$resizable,width=$width,height=$height,left='+left_pos_{$i}+',top='+top_pos_{$i}+'";	
		}//�߾������ΰ���� ��

		echo "window.open('".$g4[path]."/popup_view.php?no=$no','new_win$i','$option');"; echo "</script>";

	}else if($type=='���̾�'){//���̾�â�ϰ��
		view_layer($no);
	}//���̾��ǳ�
	
	
	
	
	

}//for���ǳ�


}//ȸ���ϰ�쳡
?>
<script language="javascript">
var x =0
var y=0
drag = 0
move = 0
window.document.onmousemove = mouseMove
window.document.onmousedown = mouseDown
window.document.onmouseup = mouseUp
window.document.ondragstart = mouseStop
function mouseUp() {
move = 0
}
function mouseDown() {
if (drag) {
clickleft = window.event.x - parseInt(dragObj.style.left)
clicktop = window.event.y - parseInt(dragObj.style.top)
dragObj.style.zIndex += 1
move = 1
}
}
function mouseMove() {
if (move) {
dragObj.style.left = window.event.x - clickleft
dragObj.style.top = window.event.y - clicktop
}
}
function mouseStop() {
window.event.returnValue = false
}
function Show(divid)
{
divid.filters.blendTrans.apply();
divid.style.visibility = "visible";
divid.filters.blendTrans.play();
}
function Hide(divid) {
divid.filters.blendTrans.apply();
divid.style.visibility = "hidden";
divid.filters.blendTrans.play();
}







</script>

<style>
.font_11{font-size:11px;font-family:����}
</style>