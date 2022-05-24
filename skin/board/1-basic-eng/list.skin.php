<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ���ÿɼ����� ���� ����ġ�Ⱑ ���������� ����
$colspan = 5;

//if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// ������ ���ٷ� ǥ�õǴ� ��� �� �ڵ带 ����� ������.
// <nobr style='display:block; overflow:hidden; width:000px;'>����</nobr>
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



<!-- �Խ��� ��� ���� -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>

    <!-- �з� ����Ʈ �ڽ�, �Խù� ���, ������ȭ�� ��ũ -->
    <div>
        <div style="float:left;">
            <form name="fcategory" method="get" style="margin:0px;">
            <? if ($is_category) { ?>
            <select name=sca onchange="location='<?=$category_location?>'+<?=strtolower($g4[charset])=='utf-8' ? "encodeURIComponent(this.value)" : "this.value"?>;">
            <option value=''>��ü</option>
            <?=$category_option?>
            </select>
            <? } ?>
            </form>
        </div>
        <div style="float:right;">
            <!-- �ѰԽù� 
            <img src="<?=$board_skin_path?>/img/icon_total.gif" align="absmiddle" border='0'>
            <span style="color:#888888; font-weight:bold;">Total <?=number_format($total_count)?></span>
	    -->
            <? if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' border='0' align="absmiddle"></a><?}?>
            <? if ($admin_href) { ?><a href="<?=$admin_href?>" id="board_button2">Admin</a><?}?>
        </div>
    </div>
<br><br>
    <!-- ���� -->
    <form name="fboardlist" method="post">
    <input type='hidden' name='bo_table' value='<?=$bo_table?>'>
    <input type='hidden' name='sfl'  value='<?=$sfl?>'>
    <input type='hidden' name='stx'  value='<?=$stx?>'>
    <input type='hidden' name='spt'  value='<?=$spt?>'>
    <input type='hidden' name='page' value='<?=$page?>'>
    <input type='hidden' name='sw'   value=''>

    <table cellspacing="0" cellpadding="0" id="board_list">
    <col width="50" />
    <? if ($is_checkbox) { ?><col width="40" /><? } ?>
    <col />
    <col width="80" />
    <col width="80" />
    <col width="50" />
    <? if ($is_good) { ?><col width="40" /><? } ?>
    <? if ($is_nogood) { ?><col width="40" /><? } ?>
    <tr>
        <th>No.</th>
        <? if ($is_checkbox) { ?><th><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type="checkbox"></th><?}?>
        <th>Subject</th>
        <th>Writer</th>
        <th><?=subject_sort_link('wr_datetime', $qstr2, 1)?>Date</a></th>
        <th><?=subject_sort_link('wr_hit', $qstr2, 1)?>Hit</a></th>
        <? if ($is_good) { ?><th><?=subject_sort_link('wr_good', $qstr2, 1)?>��õ</a></th><?}?>
        <? if ($is_nogood) { ?><th><?=subject_sort_link('wr_nogood', $qstr2, 1)?>����õ</a></th><?}?>
    </tr>

    <? 
    for ($i=0; $i<count($list); $i++) { 
        $bg = $i%2 ? 0 : 1;
    ?>

    <tr class="bg<?=$bg?>"> 
        <td>
            <? 
            if ($list[$i][is_notice]) // �������� 
                echo "<b>Notice</b>";
            else if ($wr_id == $list[$i][wr_id]) // ������ġ
                echo "<span class='current'>{$list[$i][num]}</span>";
            else
                echo $list[$i][num];
            ?>
        </td>
        <? if ($is_checkbox) { ?><td class="checkbox"><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td><? } ?>
        <td class='subject'>
            <? 
            echo $nobr_begin;
            echo $list[$i][reply];
            echo $list[$i][icon_reply];
            if ($is_category && $list[$i][ca_name]) { 
                echo "<span><font color=gray>[<a href='{$list[$i][ca_name_href]}'>{$list[$i][ca_name]}</a>]</font></span> ";
            }

            if ($list[$i][is_notice])
                echo "<a href='{$list[$i][href]}'>{$list[$i][subject]}</a>";
            else
                echo "<a href='{$list[$i][href]}'>{$list[$i][subject]}</a>";

            if ($list[$i][comment_cnt]) 
                echo " <a href=\"{$list[$i][comment_href]}\"><span class='comment'>{$list[$i][comment_cnt]}</span></a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            echo " " . $list[$i][icon_new];
            echo " " . $list[$i][icon_file];
            echo " " . $list[$i][icon_link];
            echo " " . $list[$i][icon_hot];
            echo " " . $list[$i][icon_secret];
            echo $nobr_end;
            ?>
        </td>
        <td><?=$list[$i][name]?></td>
        <td><?=$list[$i][datetime2]?></td>
        <td><?=$list[$i][wr_hit]?></td>
        <? if ($is_good) { ?><td><?=$list[$i][wr_good]?></td><? } ?>
        <? if ($is_nogood) { ?><td><?=$list[$i][wr_nogood]?></td><? } ?>
    </tr>
    <? } // end for ?>

    <? if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 align=center>There are no posts.</td></tr>"; } ?>

    </table>
    </form>
<br>
    <div id="board_button">
        <div style="float:left;">
        <? if ($list_href) { ?>
        <a href="<?=$list_href?>">List</a>
        <? } ?>
        <? if ($is_checkbox) { ?>
        <a href="javascript:select_delete();">Select delete</a>
        <a href="javascript:select_copy('copy');">Select copy</a>
        <a href="javascript:select_copy('move');">Select move</a>
        <? } ?>
        </div>

        <div style="float:right;">
        <? if ($write_href) { ?><a href="<?=$write_href?>" id="board_button2">Write</a><? } ?>
        </div>
    </div>

    <!-- ������ -->
    <div class="board_page">
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

<br><br>
    <!-- �˻� -->
    <div class="board_search" style="padding-top:10px;">
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?=$bo_table?>">
        <input type="hidden" name="sca"      value="<?=$sca?>">
        <select name="sfl">
            <option value="wr_subject">Subject</option>
            <option value="wr_content">Content</option>
            <option value="wr_subject||wr_content">Subject+Content</option>
            <!--option value="mb_id,1">ȸ�����̵�</option>
            <option value="mb_id,0">ȸ�����̵�(��)</option-->
            <option value="wr_name,1">Name</option>
            <!--option value="wr_name,0">�ۼ���(��)</option-->
        </select>
        <input name="stx" class="stx" maxlength="15" itemname="�˻���" value='<?=stripslashes($stx)?>' required="required">
        <input type="submit" value="Search" accesskey="s" class="btn_search">
        <input type="radio" name="sop" value="and" style="display:none;">
        <input type="radio" name="sop" value="or" style="display:none;">
        </form>
    </div>

</td></tr></table>

<script type="text/javascript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';

    if ('<?=$sop?>' == 'and') 
        document.fsearch.sop[0].checked = true;

    if ('<?=$sop?>' == 'or')
        document.fsearch.sop[1].checked = true;
} else {
    document.fsearch.sop[0].checked = true;
}
</script>

<? if ($is_checkbox) { ?>
<script type="text/javascript">
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str) {
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
function select_delete() {
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
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "����";
    else
        str = "�̵�";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?>
<!-- �Խ��� ��� �� -->
