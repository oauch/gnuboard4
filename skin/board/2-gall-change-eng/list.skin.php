<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>

$board[bo_1] = "600";
$board[bo_2] = "600";
$board[bo_3] = "80";

if (!$board[bo_1]) alert("게시판 설정 : 여분 필드 1 에 목록에서 보여질 이미지의 폭을 설정하십시오. (픽셀 단위)");
if (!$board[bo_2]) alert("게시판 설정 : 여분 필드 2 에 목록에서 보여질 이미지의 높이을 설정하십시오. (픽셀 단위)");
if (!$board[bo_3]) alert("게시판 설정 : 여분 필드 3 에 목록에서 보여질 이미지의 질(quality)을 비율로 설정하십시오. (100 이하)");
if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';


@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);

$mod = $board[bo_gallery_cols];
$td_width = (int)(100 / $mod);

?>
<link rel="stylesheet" type="text/css" media="screen" href="<?=$board_skin_path?>/css.css" />
<style>
#board_gall_img_width{width:600px !important;}
</style>

<!-- 페이지 변경시 필요한 소스 START -->
<?
function get_paging2($write_pages, $cur_page, $total_page, $url, $add="")
{
	global $board_skin_path;
    $str = "<ul id='pagenation'>";
    if ($cur_page > 1) {
        $str .= "<li><a href='".$url."' class='btn'><</a></li>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>이전</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= "<li><a href='" . $url . ($start_page-1) . "{$add}' class='btn'><img src='{$board_skin_path}/img/btn_prev.gif' alt='이전' /></a></li>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= "<li><a href='$url$k{$add}'><span>$k</span></a></li>";
            else
                $str .= "<li class='on'><a href='$url$k{$add}'>$k</a></li>";
        }
    }

    if ($total_page > $end_page) $str .= " <li><a href='" . $url . ($end_page+1) . "{$add}' class='btn'><img src='{$board_skin_path}/img/btn_next.gif' alt='다음으로' /></a></li>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>다음</a>]";
        $str .= "<li><a href='$url$total_page{$add}' class='btn'>></a></li>";
    }
    $str .= "</ul>";

    return $str;
}
$write_pages = get_paging2($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");
?>
<!-- 페이지 변경시 필요한 소스 END -->



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
<script type="text/javascript"> 
$(function() {
    $('#board_gall_img').cycle({
        fx:     'fade',
        //speed:  'fast',
        timeout: 3500,
        pager:  '#board_gall_img_nav',
        pagerAnchorBuilder: function(idx, slide) {
            return '#board_gall_img_nav li:eq(' + (idx) + ') a';
        }
    });
});
</script>



<!-- 상단버튼 시작 -->
<? if ($admin_href) { ?>
<div style="clear:both; height:50px;" id="board_button">
    <div style="float:right;">
    <!--
    <? if ($list_href) { ?>
    <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align=absmiddle></a>
    <? } ?>
    -->
    <!--
    <? if ($is_checkbox) { ?>
    <a href="javascript:select_delete();">Select delete</a>
    <a href="javascript:select_copy('copy');">Select copy</a>
    <a href="javascript:select_copy('move');">Select move</a>
    
    <? } ?>
    -->
    <a href="<?=$admin_href?>" id="board_button2">Admin</a>
    <? if ($write_href) { ?><a href="<?=$write_href?>" id="board_button2">Write</a><? } ?>
    </div>

</div>
<div style="clear:both;"></div>
<?}?>
<!-- 상단버튼 끝 -->



<table width="100%" cellspacing="0" cellpadding="0" border=0>
<form name="fboardlist" method="post">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">
<!-- <? if ($is_admin) { ?><tr><td height=30 colspan='<?=$board[bo_gallery_cols]?>' style='padding-left:20px;'><INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox> 전체선택</td></tr><? } ?> -->
<tr><td align="center">


<!-- /////////////////////////////////////// 롤링구역 시작 /////////////////////////////////////// -->


<table width="855" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" align="left" width="250">
    
<!-- 미니 이미지 -->
<div id="board_gall_img_nav">
<?
for ($i=0; $i<count($list); $i++) 
{ 
	$homepageurl="";
	if($list[$i][wr_1] >= 100)
		{
			$ing="[작업완료]";
			//$homepageurl=$list[wr_link1];
			if($list[$i][wr_link1]) $homepageurl="<a href='".$list[$i][wr_link1]."' target=_blank>";
		}
	else $ing="";
	
	$thumb = $thumb_path.'/'.$list[$i][wr_id];

	 $photo_view = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];

	echo "<li><a href='#'><img src='$thumb' border=0 width='100' height='60'></a></li>";
}
?>
</div>
<div style="clear:both;"></div>


<!-- 페이지 -->
<div class="board_gall_img_page">
        <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
        <?
        // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
        //echo $write_pages;
        /*
	$write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
        $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
        $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
        $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
        */
        //$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
        $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<span style=\"color:#847f74; font-size:11px; text-decoration:underline;\">$1</span>", $write_pages);
        ?>
        <?=$write_pages?>
        <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
    </div>
<div style="clear:both;"></div>


    
    </td>
    <td valign="top" align="left">
    
<!-- 빅 이미지 -->
<div id="board_gall_img">
<?
for ($i=0; $i<count($list); $i++) 
{ 
	$homepageurl="";
	//추가
	if($list[$i][wr_1] >= 100)
		{
			$ing="[작업완료]";
			//$homepageurl=$list[wr_link1];
			if($list[$i][wr_link1]) $homepageurl="<a href='".$list[$i][wr_link1]."' target=_blank>";
		}
	else $ing="";
	
	$thumb = $thumb_path.'/'.$list[$i][wr_id];
	// 썸네일 이미지가 존재하지 않는다면
	if (!file_exists($thumb))
	{
		$file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
		if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file))
		{
			$size = getimagesize($file);
			if ($size[2] == 1)
				$src = imagecreatefromgif($file);
			else if ($size[2] == 2)
				$src = imagecreatefromjpeg($file);
			else if ($size[2] == 3)
				$src = imagecreatefrompng($file);
			else
				break;


			$rate = $board[bo_2] / $size[1];
			$width = (int)($size[0] * $rate);
					
			//echo "rate : $rate ,width : $width, $height : $board[bo_2] <br>";
			if($width <= $board[bo_1]) { //width가 지정된 사이즈보다 작을경우 rate 비율로 썸네일 생성
				$dst = imagecreatetruecolor($width, $board[bo_2]);
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $board[bo_2], $size[0], $size[1]);
				imagejpeg($dst, $thumb_path.'/'.$list[$i][wr_id], $board[bo_2]);
			} else {
				$rate = $board[bo_1] / $size[0];
				$height = (int)($size[1] * $rate);

				$dst = imagecreatetruecolor($board[bo_1], $height);
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $board[bo_1], $height, $size[0], $size[1]);
				imagejpeg($dst, $thumb_path.'/'.$list[$i][wr_id], $board[bo_2]);
			}
					
			chmod($thumb_path.'/'.$list[$i][wr_id], 0606);

		}
	}

	 $photo_view = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
	if (file_exists($thumb)){
		$img = "<img src='$thumb' border=0 id='board_gall_img_width'>";
	}
	echo "<div id='board_gall_img_post'><a href='{$list[$i][href]}'><img src='$photo_view' border=0 id='board_gall_img_width'></a><span id='board_gall_img_txt'><a href='{$list[$i][href]}'><b>{$list[$i][subject]}</b></a></span></div>";
	
}

?>
</div> 
<div style="clear:both;"></div>
    
    </td>
  </tr>
</table>






<!-- /////////////////////////////////////// 롤링구역 끝 /////////////////////////////////////// -->




</form>
</td>
</tr>
</table>



<script language="JavaScript">
function rank(mode,wr_id,rank){
	hiddenframe.location.href="<?=$board_skin_path?>/rank_update.php?bo_table=<?=$bo_table?>&mode="+mode+"&wr_id="+wr_id;
}

if ("<?=$stx?>") {
    document.fsearch.sfl.value = "<?=$sfl?>";
    document.fsearch.sop.value = "<?=$sop?>";
}
</script>

<? if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw)
{
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str)
{
    var f = document.fboardlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete()
{
    var f = document.fboardlist;

    str = "삭제";
    if (!check_confirm(str))
        return;

    if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw)
{
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=396, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?>
