<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once("$latest_skin_path/skin.lib.php");

$img_width = 100; // 이미지 가로 사이즈
$img_height = 70; // 이미지 세로 사이즈

$frame_width = 440; // 가로길이

$data_path = $g4[path]."/data/file/$bo_table"; 
$thumb_path = $data_path.'/thumb';

@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);
?>

<!--최신글, 이미지, 내용 시작-->

<script type="text/javascript" src="<?=$latest_skin_path?>/js/jquery.imageScroller.js"></script>

<style type="text/css">
body {}
img {border:0}
a {text-decoration:none}

/*스크롤러 스타일*/

div#scroller {position:relative; width:<?=$frame_width?>;  clear:both; overflow:hidden; }

/*좌우버튼*/
#btn1, #btn2 {cursor:pointer;}

ul#scrollerFrame {width:500px; padding:0;margin:0;list-style:none;  }
ul#scrollerFrame li {position:relative;float:left;  width:100px;   padding-left:5px; padding-right:5px;}

#scrollerFrame{margin:0 0 0 0px;}

</style>          

              
<script type="text/javascript">
	
	$(function(){	
	     
		$("#scroller").imageScroller({
			next:"btn1",                   //다음 버튼 ID값
			prev:"btn2",                   //이전 버튼 ID값
			frame:"scrollerFrame",         //스크롤러 프레임 ID값  
			width:100,                     //이미지 가로 크기
			child:"li",                    //스크롤 지정 태그
			auto:true                      //오토 롤링 (해제는 false)
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
						$get_img = getimagesize($src); // 파일정보를 가져옴
						// 관리자가 이미지 사이즈를 바꾸었을때를 대비하여 리사이징 크기를 이름에 포함과 이미지 재 첨부시 바뀜
						$img_step1 = explode("_",$list[$i][file][0][file]);
						$img_step2 = explode(".",$img_step1[1]);
						$new_imgname = $img_step2[0];
						$thumb_file_list = "{$thumb_path}/{$re_img_width}x{$re_img_height}_{$new_imgname}_{$list[$i][wr_id]}_list";
						if(!file_exists($thumb_file_list)){
							// gd lib 체크
							$gd = gd_info(); 
							$gdversion = substr(preg_replace("/[^0-9]/", "", $gd['GD Version']), 0, 2); // gd 버전이 2.0 이상인지 체크
							if(!$gdversion){ 
									$thumb_file_view = $src; // gd 2.0 이하면 강제적으로 줄임
							}else{
								if($img_width > $get_img[0] || $img_height > $get_img[1]){
									$thumb_file_list = $src;
								}else{
									createThumb_list($img_width,$img_height,$src, $thumb_file_list, $get_img); // list 페이지 썸네일
								}
							}
						}

						$img = "<a href='{$list[$i]['href']}'><img src=\"$thumb_file_list\" border=\"0\" width=\"$img_width\" height=\"$img_height\" style='display:block;'/></a>";
					}else{
						// no 이미지를 비율적으로 만들어났음
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



