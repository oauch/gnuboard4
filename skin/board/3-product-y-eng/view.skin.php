<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<script type="text/javascript">
$(function(){
	$("#imgList td>img").click(function(){
		$("#mainImg img").attr('src', $(this).attr('src'));
	});

});
</script>

<link rel="stylesheet" type="text/css" media="screen" href="<?=$board_skin_path?>/css.css" />

<!-- �Խñ� ���� ���� -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>

<div style="clear:both;">
    <!-- ��ũ ��ư -->
    <div style="float:right;" id="board_button">
    <? 
    ob_start(); 
    ?>
    <? if ($copy_href) { echo "<a href=\"$copy_href\">Copy</a> "; } ?>
    <? if ($move_href) { echo "<a href=\"$move_href\">Move</a> "; } ?>

    <? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_list_search.gif' border='0' align='absmiddle'></a> "; } ?>
    <? echo "<a href=\"$list_href\">List</a> "; ?>
    <? if ($update_href) { echo "<a href=\"$update_href\">Modify</a> "; } ?>
    <? if ($delete_href) { echo "<a href=\"$delete_href\">Delete</a> "; } ?>
    <? if ($reply_href) { echo "<a href=\"$reply_href\">Reply</a> "; } ?>
    <? if ($write_href) { echo "<a href=\"$write_href\" id='board_button2'>Write</a> "; } ?>
    <?
    $link_buttons = ob_get_contents();
    ob_end_flush();
    ?>
    </div>
</div>
<br><br>

<div>
    <table border=0 cellpadding=0 cellspacing=0 width=100% class="board_view">
    <tr>
        <td class="viewtit">Subject</td>
	<td>
            <? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?>
            <?=cut_hangul_last(get_text($view[wr_subject]))?>
        </td>
        <td class="viewtit">Date</td>
        <td width="110">
	    <?=date("y-m-d H:i", strtotime($view[wr_datetime]))?>             
	    <!--��ũ�� / Ʈ���� 
	    <? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\"><img src='$board_skin_path/img/btn_scrap.gif' border='0' align='absmiddle'></a> "; } ?>
            <? if ($trackback_url) { ?><a href="javascript:trackback_send_server('<?=$trackback_url?>');" style="letter-spacing:0;" title='�ּ� ����'><img src="<?=$board_skin_path?>/img/btn_trackback.gif" border='0' align="absmiddle"></a><?}?>
            -->
	</td>
    </tr>
    <tr>
        <td class="viewtit">Writer</td>
	<td><?=$view[wr_name]?><? if ($admin_href) { ?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?><? } ?></td>
        <td class="viewtit">Hit</td>
	<td>
	   <?=number_format($view[wr_hit])?>
           <? if ($is_good) { ?>&nbsp;<img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align=absmiddle> ��õ : <?=number_format($view[wr_good])?><? } ?>
           <? if ($is_nogood) { ?>&nbsp;<img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align=absmiddle> ����õ : <?=number_format($view[wr_nogood])?><? } ?>
        </td>
    </tr>
    </table>
</div>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr> 
    <td height="150" style="word-break:break-all; padding:0px;">
 <div style="height:20px;"></div>   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="50%">
    <div id="mainImg"><img src='<?=$view['file'][0][path].'/'.$view['file'][0]['file']?>' width='350' /></div>
    </td>
    <td valign="top" width="50%">
    <table width="100%" border="0" cellspacing="5" cellpadding="0" class="view_text">
      <tr>
        <td class="view_text2">Product</td>
        <td><?=cut_hangul_last(get_text($view[wr_subject]))?></td>
      </tr>
      <tr>
        <td class="view_text2">Model</td>
        <td><?=$view[wr_2]?></td>
      </tr>
      <tr>
        <td class="view_text2">Size</td>
        <td><?=$view[wr_3]?></td>
      </tr>
      <tr>
        <td class="view_text2">Weight</td>
        <td><?=$view[wr_4]?></td>
      </tr>
        <?
        // ���� ����
        $cnt = 0;
        for ($i=0; $i<count($view[file]); $i++) {
            if ($view[file][$i][source] && !$view[file][$i][view]) {
                $cnt++;
                echo "<tr><td class='view_text2'>÷������</td>";
                echo "<td>&nbsp;<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle border='0'>";
                echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'>";
                echo "&nbsp;<span style=\"color:#888;\">{$view[file][$i][source]}</span>&nbsp;</td></tr>";
            }
        }


        // ��ũ
        $cnt = 0;
        for ($i=1; $i<=$g4[link_count]; $i++) {
            if ($view[link][$i]) {
                $cnt++;
                $link = cut_str($view[link][$i], 70);
                echo "<tr><td class='view_text2'>��ũ</td>";
                echo "<td height='30' class='board_listfile'>";
                echo "&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_link.gif' align=absmiddle border='0'>";
                echo "<a href='{$view[link_href][$i]}' target=_blank>";
                echo "&nbsp;<span style=\"color:#888;\">{$link}</span>";
                echo "&nbsp;<span style=\"color:#ff6600; font-size:11px;\">[{$view[link_hit][$i]}]</span>";
                echo "</a></td></tr>";
            }
        }
        ?>  
    </table>
    <br><br>
    <table border="0" cellspacing="0" cellpadding="0">
       <div>
        <?php
            if($view['file'][count])
            {
            echo "<tr id='imgList'>";
            for($i=0; $i<$view['file']['count'];$i++)
                {
                if($view['file'][$i]['view'])
                echo "<td><img src='{$view['file'][$i][path]}/{$view['file'][$i][file]}' width='50' hspace='5' vspace='5' /></td>";
                }
                echo "</tr>";
            }
        ?>
       </div>
    </table>
    </td>
  </tr>
</table>

        <!-- ���� ��� -->
        <div style="height:20px;"></div>
        <span id="writeContents" class="viewcon"><?=$view[content];?></span>
        
        <!-- ��������� -->
        <div class="viewvideo"><?=$view[wr_1]?></div>        
        
        <?//echo $view[rich_content]; // {�̹���:0} �� ���� �ڵ带 ����� ���?>
        <!-- �׷� �±� ������ --></xml></xmp><a href=""></a><a href=''></a>

        <? if ($nogood_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div style="color:#888; margin:7px 0 5px 0;">����õ : <?=number_format($view[wr_nogood])?></div>
        <div><a href="<?=$nogood_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align="absmiddle"></a></div>
        </div>
        <? } ?>

        <? if ($good_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div style="color:#888; margin:7px 0 5px 0;"><span style='color:crimson;'>��õ : <?=number_format($view[wr_good])?></span></div>
        <div><a href="<?=$good_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align="absmiddle"></a></div>
        </div>
        <? } ?>

</td>
</tr>
<? if ($is_signature) { echo "<tr><td align='center' style='border-bottom:1px solid #E7E7E7; padding:5px 0;'>$signature</td></tr>"; } // ���� ��� ?>
</table>
<br>

<?
// �ڸ�Ʈ �����
//include_once("./view_comment.php");
?>

<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

<div style="clear:both; height:43px;">
    <div style="float:left; margin-top:10px;" id="board_button">
    <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\">Prev</a>&nbsp;"; } ?>
    <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\">Next</a>&nbsp;"; } ?>
    </div>

    <!-- ��ũ ��ư -->
    <div style="float:right; margin-top:10px;" id="board_button">
    <?=$link_buttons?>
    </div>
</div>

<div style="height:2px; line-height:1px; font-size:1px; background-color:#dedede; clear:both;">&nbsp;</div>

</td></tr></table><br>

<script type="text/javascript">
function file_download(link, file) {
    <? if ($board[bo_download_point] < 0) { ?>if (confirm("'"+file+"' ������ �ٿ�ε� �Ͻø� ����Ʈ�� ����(<?=number_format($board[bo_download_point])?>��)�˴ϴ�.\n\n����Ʈ�� �Խù��� �ѹ��� �����Ǹ� ������ �ٽ� �ٿ�ε� �ϼŵ� �ߺ��Ͽ� �������� �ʽ��ϴ�.\n\n�׷��� �ٿ�ε� �Ͻðڽ��ϱ�?"))<?}?>
    document.location.href=link;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    drawFont();
}
</script>
<!-- �Խñ� ���� �� -->
