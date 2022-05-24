<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>

$board[bo_1] = "500";
$board[bo_2] = "500";
$board[bo_3] = "100";

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

<table width="<?=$width?>" align="center" cellpadding="0" cellspcing="0"><tr><td>

<? if ($admin_href) { ?>
<table width="100%" cellspacing="0" cellpadding="0">
<tr height="25">
    <? if ($is_category) { ?><form name="fcategory" method="get"><td width="50%"><select name=sca onchange="location='<?=$category_location?>'+this.value;"><option value=''>전체</option><?=$category_option?></select></td></form><? } ?>
    <td align="right" style="font:normal 11px tahoma; color:#BABABA;">
        <!-- Total <?=number_format($total_count)?> -->
        <a href="<?=$admin_href?>" id="board_button2">관리자</a>
    </td>
</tr>
<tr><td height=5></td></tr>
</table>
<?}?>

<table width="100%" cellspacing="0" cellpadding="0" border=0>
<form name="fboardlist" method="post">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">
<!-- <? if ($is_admin) { ?><tr><td height=30 colspan='<?=$board[bo_gallery_cols]?>' style='padding-left:20px;'><INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox> 전체선택</td></tr><? } ?> -->
<tr>
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

			
						
						/* rate 계산,, 썸네일은 가로 정렬임으로 세로가 동일해야 함 */
						/*
				$rate = $board[bo_1] / $size[0];
			$height = (int)($size[1] * $rate);

			$dst = imagecreatetruecolor($board[bo_1], $height);
			imagecopyresampled($dst, $src, 0, 0, 0, 0, $board[bo_1], $height, $size[0], $size[1]);
			imagepng($dst, $thumb_path.'/'.$list[$i][wr_id], $board[bo_2]);
			chmod($thumb_path.'/'.$list[$i][wr_id], 0606);
						*/

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
		$img = "<img src='$thumb' border=0 width='180' height='145'>";
	}



    $title = "클릭하시면 해당 사이트로 이동합니다.";
    $content = cut_str(get_text($list[$i][wr_content]), 80);
    //$img = "$g4[path]/data/file/$bo_table/".urlencode($list[$i][file][0][file]);
    //if (!file_exists($img) || !$list[$i][file][0][file])
	if ( !$list[$i][file][0][file])
        $img = "<img src=$board_skin_path/img/no_image.gif>";
    $href = "$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id={$list[$i][wr_id]}&no=1";
    $view_href = "";
    //if ($is_admin) 
        $view_href = "<a href='$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id={$list[$i][wr_id]}'>";

    $checkbox = "";
    if ($is_checkbox)
        $checkbox = "<input type=checkbox name=chk_wr_id[] value='{$list[$i][wr_id]}'>";

	if($list[$i][wr_2]) $btimg_dc="<img src='$board_skin_path/img/dc.gif' border=0 align=absmiddle>";
	else $btimg_dc="";

	$btimg_order="$board_skin_path/img/bt_order.gif";
	$btimg_view="$board_skin_path/img/bt_view.gif";

	$order_href="<a href='$g4[bbs_path]/write.php?bo_table=order&bunru=w&subject1={$list[$i][subject]}&code1={$list[$i][wr_1]}'>";

    $tr = ""; 
    if ($i && $i%$board[bo_gallery_cols]==0) 
        $tr = "</tr><tr>"; 
    echo "$tr"; 
    $subject = "<span $style>".cut_str($list[$i][subject],20)."</span>";

	echo "<td width='{$td_width}%' valign='top' align='left' class='board_listbox'>";
	echo "<table cellpadding='5' cellspacing='0'>";
	echo "<tr valign='top'>";
	echo "<td align='center'>";
	echo "<table cellpadding='0' cellspacing='0' border='0'><td style='border:solid 1px #EFEFEF; padding:5px;' align='center'>{$view_href}{$img}</a></td></tr></table>";
	if ($is_checkbox) {
		echo "$checkbox <a href=\"javascript:rank('up','".$list[$i][wr_id]."')\"><img src=\"{$board_skin_path}/img/btn_up.gif\" alt='한칸위로' border='0'></a> <a href=\"javascript:rank('down','".$list[$i][wr_id]."')\"><img src=\"{$board_skin_path}/img/btn_down.gif\" alt='한칸아래로' border='0'></a>";
	}
	echo "</td>";

	echo "<td style='padding-left:20px;'>";
		
	echo "<table width='100%' border='0' cellspacing='5' cellpadding='0' id='board_list'>";
	echo "  <tr>";
	echo "    <td colspan='2'><a href='{$list[$i][href]}'>{$list[$i][subject]}</a></td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td class='board_list'>모델명</td>";
	echo "    <td>{$list[$i][wr_2]}</td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td class='board_list'>사이즈</td>";
	echo "    <td>{$list[$i][wr_3]}</td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td class='board_list'>특징</td>";
	echo "    <td>{$list[$i][wr_4]}</td>";
	echo "  </tr>";
	echo "</table>";

	echo "</td>";
	echo "</tr>";
	echo "</table>";

	echo "</td>";
}

// 나머지 td 를 채운다.
$cnt = $i%$mod;
if ($cnt)
    for ($i=$cnt; $i<$mod; $i++)
        echo "<td>&nbsp;</td>\n";

if ($i == 0)
    echo "<td colspan='$board[bo_gallery_cols]' height=50 align=center>게시물이 없습니다.</td>";
?>
</form>
</tr>
</table>



<div style="clear:both; margin-top:7px; height:31px;">
    <div style="float:left;" id="board_button">
    <? if ($list_href) { ?>
    <a href="<?=$list_href?>">목록</a>
    <? } ?>
    <? if ($is_checkbox) { ?> 
    <a href="javascript:select_delete();">선택삭제</a>
    <a href="javascript:select_copy('copy');">선택복사</a>
    <a href="javascript:select_copy('move');">선택이동</a>
    <? } ?>
    </div>

    <div style="float:right;">
    <? if ($write_href) { ?><a href="<?=$write_href?>" id="board_button2">글쓰기</a><? } ?>
    </div>
</div>

<!-- 페이지 -->
<div style="text-align:center; line-height:30px; clear:both; margin:5px 0 10px 0; padding:5px 0; font-family:gulim;">

    <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
    <?
    // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
    //echo $write_pages;
    $write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
    $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
    $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
    $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
    $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><span style=\"color:#B3B3B3; font-size:12px;\">$1</span></b>", $write_pages);
    $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
    ?>
    <?=$write_pages?>
    <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>

</div>

    <!-- 검색 -->
    <div class="board_search" style="padding-top:10px;">
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?=$bo_table?>">
        <input type="hidden" name="sca"      value="<?=$sca?>">
        <select name="sfl">
            <option value="wr_subject">제품명</option>
            <option value="wr_content">내용</option>
            <option value="wr_subject||wr_content">제품명+내용</option>
            <!--option value="mb_id,1">회원아이디</option>
            <option value="mb_id,0">회원아이디(코)</option-->
            <option value="wr_name,1">작성자</option>
            <!--option value="wr_name,0">작성자(코)</option-->
        </select>
        <input name="stx" class="stx" maxlength="15" itemname="검색어" value='<?=stripslashes($stx)?>' required="required">
        <input type="submit" value="검색" accesskey="s" class="btn_search">
        <input type="radio" name="sop" value="and" style="display:none;">
        <input type="radio" name="sop" value="or" style="display:none;">
        </form>
    </div>
    
</td></tr></table>

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
