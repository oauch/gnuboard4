<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
include_once("$latest_skin_path/skin.lib.php");

$img_width = 100; // �̹��� ���� ������
$img_height = 70; // �̹��� ���� ������

$frame_width = 440; // ���α���

$data_path = $g4[path]."/data/file/$bo_table"; 
$thumb_path = $data_path.'/thumb';

@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);
?>

<!--�ֽű�, �̹���, ���� ����-->

<script type="text/javascript" src="<?=$latest_skin_path?>/js/jquery.imageScroller.js"></script>

<style type="text/css">
body {}
img {border:0}
a {text-decoration:none}

/*��ũ�ѷ� ��Ÿ��*/

div#scroller {position:relative; width:<?=$frame_width?>;  clear:both; overflow:hidden; }

/*�¿��ư*/
#btn1, #btn2 {cursor:pointer;}

ul#scrollerFrame {width:500px; padding:0;margin:0;list-style:none;  }
ul#scrollerFrame li {position:relative;float:left;  width:100px;   padding-left:5px; padding-right:5px;}

#scrollerFrame{margin:0 0 0 0px;}

</style>          

              
<script type="text/javascript">
	
	$(function(){	
	     
		$("#scroller").imageScroller({
			next:"btn1",                   //���� ��ư ID��
			prev:"btn2",                   //���� ��ư ID��
			frame:"scrollerFrame",         //��ũ�ѷ� ������ ID��  
			width:100,                     //�̹��� ���� ũ��
			child:"li",                    //��ũ�� ���� �±�
			auto:true                      //���� �Ѹ� (������ false)
		});
	});
</script>

<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30"><span id="btn1" style="float:left;"><img src="<?=$g4[path]?>/skin/latest/roll-gallery/img/btn_arrow_left.png"></span></td>
    <td >
    <div id="scroller">
	<ul id="scrollerFrame">
        <? for ($i=0; $i<count($list); $i++) { ?>
		<li>
			<?
					if($list[$i][file][0][view]){
						$src = $list[$i][file][0][path]."/".$list[$i][file][0][file];
						$get_img = getimagesize($src); // ���������� ������
						// �����ڰ� �̹��� ����� �ٲپ������� ����Ͽ� ������¡ ũ�⸦ �̸��� ���԰� �̹��� �� ÷�ν� �ٲ�
						$img_step1 = explode("_",$list[$i][file][0][file]);
						$img_step2 = explode(".",$img_step1[1]);
						$new_imgname = $img_step2[0];
						$thumb_file_list = "{$thumb_path}/{$re_img_width}x{$re_img_height}_{$new_imgname}_{$list[$i][wr_id]}_list";
						if(!file_exists($thumb_file_list)){
							// gd lib üũ
							$gd = gd_info(); 
							$gdversion = substr(preg_replace("/[^0-9]/", "", $gd['GD Version']), 0, 2); // gd ������ 2.0 �̻����� üũ
							if(!$gdversion){ 
									$thumb_file_view = $src; // gd 2.0 ���ϸ� ���������� ����
							}else{
								if($img_width > $get_img[0] || $img_height > $get_img[1]){
									$thumb_file_list = $src;
								}else{
									createThumb_list($img_width,$img_height,$src, $thumb_file_list, $get_img); // list ������ �����
								}
							}
						}

						$img = "<a href='{$list[$i]['href']}'><img src=\"$thumb_file_list\" border=\"0\" width=\"$img_width\" height=\"$img_height\" style='display:block;'/></a>";
					}else{
						// no �̹����� ���������� ������
						$img = "<a href='{$list[$i]['href']}'><img src=\"$latest_skin_path/img/no_image.gif\" border=\"0\" height=\"{$img_height}\" width=\"{$img_width}\"/></a>";
					}
					echo $img;

			?>
		</li>
		
<? } ?>
</ul>
</div>
    </td>
    <td width="30"><span id="btn2" style="float:right;"><img src="<?=$g4[path]?>/skin/latest/roll-gallery/img/btn_arrow_right.png"></span></td>
  </tr>
</table>



