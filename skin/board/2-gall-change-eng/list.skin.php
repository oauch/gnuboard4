<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ������ ���ٷ� ǥ�õǴ� ��� �� �ڵ带 ����� ������.
// <nobr style='display:block; overflow:hidden; width:000px;'>����</nobr>

$board[bo_1] = "600";
$board[bo_2] = "600";
$board[bo_3] = "80";

if (!$board[bo_1]) alert("�Խ��� ���� : ���� �ʵ� 1 �� ��Ͽ��� ������ �̹����� ���� �����Ͻʽÿ�. (�ȼ� ����)");
if (!$board[bo_2]) alert("�Խ��� ���� : ���� �ʵ� 2 �� ��Ͽ��� ������ �̹����� ������ �����Ͻʽÿ�. (�ȼ� ����)");
if (!$board[bo_3]) alert("�Խ��� ���� : ���� �ʵ� 3 �� ��Ͽ��� ������ �̹����� ��(quality)�� ������ �����Ͻʽÿ�. (100 ����)");
if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 �̻� ������ ��ġ�Ǿ� �־�� ����� �� �ִ� ������ �Խ��� �Դϴ�.");

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

<!-- ������ ����� �ʿ��� �ҽ� START -->
<?
function get_paging2($write_pages, $cur_page, $total_page, $url, $add="")
{
	global $board_skin_path;
    $str = "<ul id='pagenation'>";
    if ($cur_page > 1) {
        $str .= "<li><a href='".$url."' class='btn'><</a></li>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>����</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= "<li><a href='" . $url . ($start_page-1) . "{$add}' class='btn'><img src='{$board_skin_path}/img/btn_prev.gif' alt='����' /></a></li>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= "<li><a href='$url$k{$add}'><span>$k</span></a></li>";
            else
                $str .= "<li class='on'><a href='$url$k{$add}'>$k</a></li>";
        }
    }

    if ($total_page > $end_page) $str .= " <li><a href='" . $url . ($end_page+1) . "{$add}' class='btn'><img src='{$board_skin_path}/img/btn_next.gif' alt='��������' /></a></li>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>����</a>]";
        $str .= "<li><a href='$url$total_page{$add}' class='btn'>></a></li>";
    }
    $str .= "</ul>";

    return $str;
}
$write_pages = get_paging2($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");
?>
<!-- ������ ����� �ʿ��� �ҽ� END -->



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



<!-- ��ܹ�ư ���� -->
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
<!-- ��ܹ�ư �� -->



<table width="100%" cellspacing="0" cellpadding="0" border=0>
<form name="fboardlist" method="post">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">
<!-- <? if ($is_admin) { ?><tr><td height=30 colspan='<?=$board[bo_gallery_cols]?>' style='padding-left:20px;'><INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox> ��ü����</td></tr><? } ?> -->
<tr><td align="center">


<!-- /////////////////////////////////////// �Ѹ����� ���� /////////////////////////////////////// -->


<table width="855" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" align="left" width="250">
    
<!-- �̴� �̹��� -->
<div id="board_gall_img_nav">
<?
for ($i=0; $i<count($list); $i++) 
{ 
	$homepageurl="";
	if($list[$i][wr_1] >= 100)
		{
			$ing="[�۾��Ϸ�]";
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


<!-- ������ -->
<div class="board_gall_img_page">
        <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='�����˻�'></a>"; } ?>
        <?
        // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �̹����ε� ����� �� �ֽ��ϴ�.
        //echo $write_pages;
        /*
	$write_pages = str_replace("ó��", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='ó��'>", $write_pages);
        $write_pages = str_replace("����", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='����'>", $write_pages);
        $write_pages = str_replace("����", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='����'>", $write_pages);
        $write_pages = str_replace("�ǳ�", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='�ǳ�'>", $write_pages);
        */
        //$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
        $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<span style=\"color:#847f74; font-size:11px; text-decoration:underline;\">$1</span>", $write_pages);
        ?>
        <?=$write_pages?>
        <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='�����˻�'></a>"; } ?>
    </div>
<div style="clear:both;"></div>


    
    </td>
    <td valign="top" align="left">
    
<!-- �� �̹��� -->
<div id="board_gall_img">
<?
for ($i=0; $i<count($list); $i++) 
{ 
	$homepageurl="";
	//�߰�
	if($list[$i][wr_1] >= 100)
		{
			$ing="[�۾��Ϸ�]";
			//$homepageurl=$list[wr_link1];
			if($list[$i][wr_link1]) $homepageurl="<a href='".$list[$i][wr_link1]."' target=_blank>";
		}
	else $ing="";
	
	$thumb = $thumb_path.'/'.$list[$i][wr_id];
	// ����� �̹����� �������� �ʴ´ٸ�
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
			if($width <= $board[bo_1]) { //width�� ������ ������� ������� rate ������ ����� ����
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






<!-- /////////////////////////////////////// �Ѹ����� �� /////////////////////////////////////// -->




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
        alert(str + "�� �Խù��� �ϳ� �̻� �����ϼ���.");
        return false;
    }
    return true;
}

// ������ �Խù� ����
function select_delete()
{
    var f = document.fboardlist;

    str = "����";
    if (!check_confirm(str))
        return;

    if (!confirm("������ �Խù��� ���� "+str+" �Ͻðڽ��ϱ�?\n\n�ѹ� "+str+"�� �ڷ�� ������ �� �����ϴ�"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// ������ �Խù� ���� �� �̵�
function select_copy(sw)
{
    var f = document.fboardlist;

    if (sw == "copy")
        str = "����";
    else
        str = "�̵�";
                       
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
