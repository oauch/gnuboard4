<?
$sub_menu = "900500";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");






	
if ($is_admin != 'group'&& $is_admin !="super")
 {
	echo "<script>
			window.alert('�����ڿܴ� �̿��Ҽ� �����ϴ�.');
			self.close();
			</script>";

	exit;
  }

if($mode=='modify'){/////�����ϰ��
/**********�����ϱ�******************/
$title=addslashes($title);

if($center!="Y"){
	$center="N";
}


if(!$popup_left)$popup_left="0";
if(!$popup_top)$popup_top="0";

if(!$width)$width="300";
if(!$height)$height="400";

$user_id=$member[md_id];




if($check_input=="IMG"&&$img_file_name)
{

	if(!$img_file_size||$img_file_size>2000000)
		{
			echo "<script>
					window.alert('������ ���ų� �ʹ� ū�������� �����Դϴ� ');
					history.go(-1);
					</script>";
            exit;


		} 
		
		
	$file_ext=substr(strrchr($img_file_name,"."),1);
	
	if($file_ext ==html || $file_ext == php || $file_ext == htm)
		{
			echo "<script>
					window.alert('��ũ��Ʈ������ ����Ҽ� �����ϴ�');
					history.go(-1);
					</script>";
            exit;


		} 
		
	if($r_img_file)
		{unlink($g4[path]."/popup_img/".$r_img_file); }

	if(file_exists($g4[path]."/popup_img/".$img_file_name))
		{
			$time=time();
			$filename_1=$time.$img_file_name;
		}
	else
		{
			$filename_1=$img_file_name;
		}

	
	copy($img_file,$g4[path]."/popup_img/".$filename_1);
	unlink($img_file);

}




$img_url=addslashes($img_url);

$content=addslashes($content);

if($check_html!="Y"){
$check_html="N";
}

if($check_line != "Y"){
$check_line="N";

}



/**************************/

 if($img_file)
{ $file_text1="img_file='$filename_1',";}
else
{ $file_text1="";}





$sql="update $g4[site_popup_table] set
		level=$level,
		title='$title',
		type='$type',
		popup_left=$popup_left,
		popup_top=$popup_top,
		center='$center',
		width=$width,
		height=$height,
		menubar='$menubar',
		toolbar='$toolbar',
		resizable='$resizable',
		scrollbars='$scrollbars',
		status='$status',
		check_input='$check_input',
		content='$content',
		$file_text1
		img_url='$img_url',
		gigan=$gigan,
		check_use='$check_use',
		check_html='$check_html',
		check_line='$check_line',
		reg_date=DATE_FORMAT('$reg_date','%Y-%m-%d')
	 where no=$no ";




$result=mysql_query($sql,$connect_db);
if(!$result)
	{
		echo"<script>
				window.alert('�������� �ʾҽ��ϴ�.');
				history.go(-1);
			 </script>";
      exit;
	}

echo"<script>
        window.alert('�����Ǿ����ϴ�.');
				
	 </script>";
	
echo "<meta http-equiv='refresh' content='0;url=./site_popup_list.php'>";	




}else{///�Ϲݾ����ϰ��
/********�Ϲݾ���*********************/
$title=addslashes($title);

if($center!="Y"){
	$center="N";
}


if(!$popup_left)$popup_left="0";
if(!$popup_top)$popup_top="0";

if(!$width)$width="300";
if(!$height)$height="400";

$user_id=$member[md_id];


if($check_input=="TEXT"&&$back_ground_name)  ///�ؽ�Ʈ���
{
	if(!$back_ground_size||$back_ground_size>2000000)
		{
			echo "<script>
					window.alert('������ ���ų� �ʹ� ū�������� �����Դϴ� ');
					history.go(-1);
					</script>";
            exit;


		} 
		
		
	$file_ext=substr(strrchr($back_ground_name,"."),1);
	
	if($file_ext ==html || $file_ext == php || $file_ext == htm)
		{
			echo "<script>
					window.alert('��ũ��Ʈ������ ����Ҽ� �����ϴ�');
					history.go(-1);
					</script>";
            exit;


		} 
		


	if(file_exists("{$g4[path]}/popup_img/".$back_ground_name))
		{
			$time=time();
			$filename_0=$time.$back_ground_name;
		}
	else
		{
			$filename_0=$back_ground_name;
		}

		
	copy($back_ground,"{$g4[path]}/popup_img/".$filename_0);
	unlink($back_ground);

}

if($check_input=="IMG"&&$img_file_name)
{
	if(!$img_file_size||$img_file_size>2000000)
		{
			echo "<script>
					window.alert('������ ���ų� �ʹ� ū�������� �����Դϴ� ');
					history.go(-1);
					</script>";
            exit;


		} 
		
		
	$file_ext=substr(strrchr($img_file_name,"."),1);
	
	if($file_ext ==html || $file_ext == php || $file_ext == htm)
		{
			echo "<script>
					window.alert('��ũ��Ʈ������ ����Ҽ� �����ϴ�');
					history.go(-1);
					</script>";
            exit;


		} 
		


	if(file_exists("{$g4[path]}/popup_img/".$img_file_name))
		{
			$time=time();
			$filename_1=$time.$img_file_name;
		}
	else
		{
			$filename_1=$img_file_name;
		}

	
	
	copy($img_file,"{$g4[path]}/popup_img/".$filename_1);
	unlink($img_file);

}




$img_url=addslashes($img_url);

$content=addslashes($content);

if($check_html!="Y"){
$check_html="N";
}

if($check_line != "Y"){
$check_line="N";

}


if(!$reg_date){
	$date_text="now()";
}else{
	$date_text="DATE_FORMAT('$reg_date','%Y-%m-%d')";
}


$sql="INSERT INTO $g4[site_popup_table](`no`, `user_id`,`type`, `level`, `title`, `popup_left`, `popup_top`, `center`, `width`, `height`, `menubar`, `toolbar`, `resizable`, `scrollbars`, `status`, `check_input`, `content`, `back_ground`, `img_file`, `img_url`, `gigan`, `check_use`,`check_html`,`check_line`,`reg_date`) 
VALUES ('', '$user_id','$type',$level,'$title',$popup_left,$popup_top,'$center',$width,$height,
'$menubar','$toolbar','$resizable','$scrollbars','$status','$check_input','$content','$filename_0','$filename_1','$img_url',$gigan,'$check_use','$check_html','$check_line',$date_text)";

$result=mysql_query($sql,$connect_db);

if(!$result)
	{
		echo"<script>
				window.alert('��ϵ��� �ʾҽ��ϴ�');
				history.go(-1);
			 </script>";
      exit;
	}

echo"<script>
        window.alert('��ϵǾ����ϴ�.');
				
	 </script>";
	
echo "<meta http-equiv='refresh' content='0;url=./site_popup_list.php'>";	
}///�Ϲݾ��ⳡ


?>