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
    <? if ($copy_href) { echo "<a href=\"$copy_href\">����</a> "; } ?>
    <? if ($move_href) { echo "<a href=\"$move_href\">�̵�</a> "; } ?>

    <? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_list_search.gif' border='0' align='absmiddle'></a> "; } ?>
    <? echo "<a href=\"$list_href\">���</a> "; ?>
    <? if ($update_href) { echo "<a href=\"$update_href\">����</a> "; } ?>
    <? if ($delete_href) { echo "<a href=\"$delete_href\">����</a> "; } ?>
    <? if ($reply_href) { echo "<a href=\"$reply_href\">�亯</a> "; } ?>
    <? if ($write_href) { echo "<a href=\"$write_href\" id='board_button2'>�۾���</a> "; } ?>
    <?
    $link_buttons = ob_get_contents();
    ob_end_flush();
    ?>
    </div>
</div>
<br><br>


<table width=<?=$width?> border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td >
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
      <tr>
    <td width="30%" valign="top">
    <div id="mainImg" ><img src='<?=$view['file'][0][path].'/'.$view['file'][0]['file']?>' width='180' height='230' style="border:1px solid #dfdfdf;"/></div>
  </td>
    <td width="80%" valign="top">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="prf-table" >
  <tr><td valign="top"><div class="prf-name"><span>name.</span> <?=cut_hangul_last(get_text($view[wr_subject]))?><div><?=$view[wr_2]?></div></div></td></tr>
  <tr><td class="prf-border" >
  <div class="bg-white"><div class="prf-title">�з»��� �� ��»���</div><?=nl2br($view[wr_3])?></div>
  <div class="bg-grey"><div class="prf-title">���� �� �ڰ� ����</div><?=nl2br($view[wr_4])?></div>
 <div class="bg-white"><div class="prf-title">��Ÿ</div><?=nl2br($view[wr_5])?></div> 
 </td></tr>
  </table>
 </td>
  </tr>
   </table> 
    </td>

  </tr>
</table>
<br>
<!--<?=$view[content];?>-->




<?
// �ڸ�Ʈ �����
//include_once("./view_comment.php");
?>


<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

<div style="clear:both; height:43px;">
    <div style="float:left; margin-top:10px;" id="board_button">
    <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\">������</a>&nbsp;"; } ?>
    <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\">������</a>&nbsp;"; } ?>
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


