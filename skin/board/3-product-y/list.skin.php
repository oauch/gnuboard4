<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ������ ���ٷ� ǥ�õǴ� ��� �� �ڵ带 ����� ������.
// <nobr style='display:block; overflow:hidden; width:000px;'>����</nobr>

$board[bo_1] = "500";
$board[bo_2] = "500";
$board[bo_3] = "100";

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

<table width="<?=$width?>" align="center" cellpadding="0" cellspcing="0"><tr><td>

<? if ($admin_href) { ?>
<table width="100%" cellspacing="0" cellpadding="0">
<tr height="25">
    <? if ($is_category) { ?><form name="fcategory" method="get"><td width="50%"><select name=sca onchange="location='<?=$category_location?>'+this.value;"><option value=''>��ü</option><?=$category_option?></select></td></form><? } ?>
    <td align="right" style="font:normal 11px tahoma; color:#BABABA;">
        <!-- Total <?=number_format($total_count)?> -->
        <a href="<?=$admin_href?>" id="board_button2">������</a>
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
<!-- <? if ($is_admin) { ?><tr><td height=30 colspan='<?=$board[bo_gallery_cols]?>' style='padding-left:20px;'><INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox> ��ü����</td></tr><? } ?> -->
<tr>
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

			
						
						/* rate ���,, ������� ���� ���������� ���ΰ� �����ؾ� �� */
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
		$img = "<img src='$thumb' border=0 width='180' height='145'>";
	}



    $title = "Ŭ���Ͻø� �ش� ����Ʈ�� �̵��մϴ�.";
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
		echo "$checkbox <a href=\"javascript:rank('up','".$list[$i][wr_id]."')\"><img src=\"{$board_skin_path}/img/btn_up.gif\" alt='��ĭ����' border='0'></a> <a href=\"javascript:rank('down','".$list[$i][wr_id]."')\"><img src=\"{$board_skin_path}/img/btn_down.gif\" alt='��ĭ�Ʒ���' border='0'></a>";
	}
	echo "</td>";

	echo "<td style='padding-left:20px;'>";
		
	echo "<table width='100%' border='0' cellspacing='5' cellpadding='0' id='board_list'>";
	echo "  <tr>";
	echo "    <td colspan='2'><a href='{$list[$i][href]}'>{$list[$i][subject]}</a></td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td class='board_list'>�𵨸�</td>";
	echo "    <td>{$list[$i][wr_2]}</td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td class='board_list'>������</td>";
	echo "    <td>{$list[$i][wr_3]}</td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td class='board_list'>Ư¡</td>";
	echo "    <td>{$list[$i][wr_4]}</td>";
	echo "  </tr>";
	echo "</table>";

	echo "</td>";
	echo "</tr>";
	echo "</table>";

	echo "</td>";
}

// ������ td �� ä���.
$cnt = $i%$mod;
if ($cnt)
    for ($i=$cnt; $i<$mod; $i++)
        echo "<td>&nbsp;</td>\n";

if ($i == 0)
    echo "<td colspan='$board[bo_gallery_cols]' height=50 align=center>�Խù��� �����ϴ�.</td>";
?>
</form>
</tr>
</table>



<div style="clear:both; margin-top:7px; height:31px;">
    <div style="float:left;" id="board_button">
    <? if ($list_href) { ?>
    <a href="<?=$list_href?>">���</a>
    <? } ?>
    <? if ($is_checkbox) { ?> 
    <a href="javascript:select_delete();">���û���</a>
    <a href="javascript:select_copy('copy');">���ú���</a>
    <a href="javascript:select_copy('move');">�����̵�</a>
    <? } ?>
    </div>

    <div style="float:right;">
    <? if ($write_href) { ?><a href="<?=$write_href?>" id="board_button2">�۾���</a><? } ?>
    </div>
</div>

<!-- ������ -->
<div style="text-align:center; line-height:30px; clear:both; margin:5px 0 10px 0; padding:5px 0; font-family:gulim;">

    <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border=0 align=absmiddle title='�����˻�'></a>"; } ?>
    <?
    // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �̹����ε� ����� �� �ֽ��ϴ�.
    //echo $write_pages;
    $write_pages = str_replace("ó��", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='ó��'>", $write_pages);
    $write_pages = str_replace("����", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='����'>", $write_pages);
    $write_pages = str_replace("����", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='����'>", $write_pages);
    $write_pages = str_replace("�ǳ�", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='�ǳ�'>", $write_pages);
    $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><span style=\"color:#B3B3B3; font-size:12px;\">$1</span></b>", $write_pages);
    $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
    ?>
    <?=$write_pages?>
    <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border=0 align=absmiddle title='�����˻�'></a>"; } ?>

</div>

    <!-- �˻� -->
    <div class="board_search" style="padding-top:10px;">
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?=$bo_table?>">
        <input type="hidden" name="sca"      value="<?=$sca?>">
        <select name="sfl">
            <option value="wr_subject">��ǰ��</option>
            <option value="wr_content">����</option>
            <option value="wr_subject||wr_content">��ǰ��+����</option>
            <!--option value="mb_id,1">ȸ�����̵�</option>
            <option value="mb_id,0">ȸ�����̵�(��)</option-->
            <option value="wr_name,1">�ۼ���</option>
            <!--option value="wr_name,0">�ۼ���(��)</option-->
        </select>
        <input name="stx" class="stx" maxlength="15" itemname="�˻���" value='<?=stripslashes($stx)?>' required="required">
        <input type="submit" value="�˻�" accesskey="s" class="btn_search">
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
