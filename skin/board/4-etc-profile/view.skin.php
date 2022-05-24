<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<script type="text/javascript">
$(function(){
	$("#imgList td>img").click(function(){
		$("#mainImg img").attr('src', $(this).attr('src'));
	});

});
</script>

<link rel="stylesheet" type="text/css" media="screen" href="<?=$board_skin_path?>/css.css" />

<!-- 게시글 보기 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>


<div style="clear:both;">
    <!-- 링크 버튼 -->
    <div style="float:right;" id="board_button">
    <? 
    ob_start(); 
    ?>
    <? if ($copy_href) { echo "<a href=\"$copy_href\">복사</a> "; } ?>
    <? if ($move_href) { echo "<a href=\"$move_href\">이동</a> "; } ?>

    <? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_list_search.gif' border='0' align='absmiddle'></a> "; } ?>
    <? echo "<a href=\"$list_href\">목록</a> "; ?>
    <? if ($update_href) { echo "<a href=\"$update_href\">수정</a> "; } ?>
    <? if ($delete_href) { echo "<a href=\"$delete_href\">삭제</a> "; } ?>
    <? if ($reply_href) { echo "<a href=\"$reply_href\">답변</a> "; } ?>
    <? if ($write_href) { echo "<a href=\"$write_href\" id='board_button2'>글쓰기</a> "; } ?>
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
  <div class="bg-white"><div class="prf-title">학력사항 및 경력사항</div><?=nl2br($view[wr_3])?></div>
  <div class="bg-grey"><div class="prf-title">수료 및 자격 사항</div><?=nl2br($view[wr_4])?></div>
 <div class="bg-white"><div class="prf-title">기타</div><?=nl2br($view[wr_5])?></div> 
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
// 코멘트 입출력
//include_once("./view_comment.php");
?>


<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

<div style="clear:both; height:43px;">
    <div style="float:left; margin-top:10px;" id="board_button">
    <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\">이전글</a>&nbsp;"; } ?>
    <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\">다음글</a>&nbsp;"; } ?>
    </div>

    <!-- 링크 버튼 -->
    <div style="float:right; margin-top:10px;" id="board_button">
    <?=$link_buttons?>
    </div>
</div>

<div style="height:2px; line-height:1px; font-size:1px; background-color:#dedede; clear:both;">&nbsp;</div>


</td></tr></table><br>

<script type="text/javascript">
function file_download(link, file) {
    <? if ($board[bo_download_point] < 0) { ?>if (confirm("'"+file+"' 파일을 다운로드 하시면 포인트가 차감(<?=number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?}?>
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
<!-- 게시글 보기 끝 -->


