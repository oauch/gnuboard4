<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

//if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>

$mod = $board[bo_gallery_cols];
$td_width = (int)(100 / $mod);
?>


<style type="text/css">
.ddd {
	color: #333;
	font-size: 12px;

}
.dddd {
	color: #F00;
	font-size: 18px;
	font-weight: bold;


}
</style>
<style>
.board_numbering { line-height:30px;  margin-top:10px;  margin-bottom:5px; text-align:center; font-size: 14px; font-family:"맑은 고딕","돋움",tahoma;}
.board_numbering a { text-decoration:none;  background-color:#f2f2f2; border:1px solid  #ccc; padding:3px 6px 3px 6px;  color:#666666;}
.board_numbering a:hover { color:#cccccc; text-decoration:none; background-color:#fefefe; }
.board_numbering_active {color:#cccccc;   border:1px solid #cccccc; padding:3px 6px 3px 6px; background-color:#cccccc;  text-decoration:none; background-color:#cccccc;}
</style>



<!-- 게시판 목록 시작 -->
<table width="100%" align=center cellpadding=0 cellspacing=0>
<tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="<?=$board_skin_path?>/images/bo_02.jpg" width="739" height="35" alt=""></td>
        </tr>
        </table>
        <!--리스트 시작-->
		<? if ($is_checkbox) { ?><input onClick="if (this.checked) all_checked(true); else all_checked(false);" type="checkbox"><?}?>
        <table width="739" border="0" cellspacing="0" cellpadding="0">
		<form name="fboardlist" method="post" style="margin:0px; color: #333; font-size: 10px;">
        <input type='hidden' name='bo_table' value='<?=$bo_table?>'>
        <input type='hidden' name='sfl'  value='<?=$sfl?>'>
        <input type='hidden' name='stx'  value='<?=$stx?>'>
        <input type='hidden' name='spt'  value='<?=$spt?>'>
        <input type='hidden' name='page' value='<?=$page?>'>
        <input type='hidden' name='sw'   value=''>
        <?
        for ($i=0; $i<count($list); $i++) {
			if ($i && $i%$mod==0)
				echo "</tr><tr>";

			$pp = explode("|",$list[$i]['wr_1']);

			echo "<td width='{$td_width}%' valign=top>";
        ?>			
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
                <tr>
                    <td width="136" height="140" rowspan="3" align="left" valign="top" background="<?=$board_skin_path?>/images/bo_gallery_02.jpg" style="background-repeat: no-repeat; padding:5 0 0 3;">
                        <?
                        if ($list[$i]['link'][1] != "") {
                        ?>
                        <a href="<?=$list[$i]['link'][1]?>" target="_blank"><img src="<?=$list[$i]['file'][0]['path']?>/<?=$list[$i]['file'][0]['file']?>" width="136" height="136" border="0"></a>
                        <?
                        }
                        else {
                        ?>
                        <img src="<?=$list[$i]['file'][0]['path']?>/<?=$list[$i]['file'][0]['file']?>" width="136" height="136">
                        <?
                        }
                        ?>

                    </td>
                    <td width="11">&nbsp;</td>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" background="<?=$board_skin_path?>/images/bo_gallery_04.jpg" style="background-repeat: no-repeat;">
                        <tr>
                            <td height="19" width="10">&nbsp;</td>
                            <td height="19">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
								 <td height="15"><? if ($is_checkbox) { ?><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"><? } ?></td>
								</tr>
								</table>
							</td>
							<td width="150">&nbsp;</td>
						</tr>
						<tr>
							<td height="25">&nbsp;</td>
							<td height="25" colspan="2">
								<b><a href="<?=$list[$i]['href']?>">
								[<?=$list[$i][ca_name]?>]<b><?=cut_str($list[$i]['wr_subject'],60)?>
								</a></b>
							</td>
						</tr>
						<tr>
							<td height="30">&nbsp;</td>
							<td width="33">&nbsp;</td>
							<td align="left"><?=$list[$i][name]?></td>
						</tr>
						</table><br>
<br>

					</td>
				</tr>
				<tr>
					<td colspan="3"><a href="<?=$g4[path]?>/bbs/board.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>" onfocus="this.blur()"><img src="<?=$board_skin_path?>/images/bo_gallery_05.jpg" width="158" height="19" alt="" border=0></a></td>
				</tr>
				<tr>
					<td colspan="3">
					</td>
				</tr>
				</table>
			</td>
		<?
		}
		?>
		</table>

    <? if (count($list) == 0) { echo "<table width='$width'><tr><td height=100 align=center>게시물이 없습니다.</td></tr></table>"; } ?>
    </form>
    <!--리스트 끝-->

    <!-- 페이지 --><!-- 링크 버튼, 검색 -->
    <br><br><br><br>
    <table width=100% cellpadding=0 cellspacing=0>
    <tr><td colspan=8 height=1 bgcolor=#cfcfcf></td></tr>
    <tr>
        <? if ($admin_href) { ?>
        <td width="32%" height="40" >
            <? if ($list_href) { ?><a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" border="0"></a><? } ?>

            <? if ($is_checkbox) { ?>
            <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" border="0"></a>
            <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" border="0"></a>
            <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" border="0"></a>
            <? } ?>
        </td>
        <?}?>
        <td width="53%" align="center">
            <div class="board_numbering">

                <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
                <?
                // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
                //echo $write_pages;
                $write_pages = str_replace("처음", "◀", $write_pages);
                $write_pages = str_replace("이전", "&lt;", $write_pages);
                $write_pages = str_replace("다음", "&gt;", $write_pages);
                $write_pages = str_replace("맨끝", "▶", $write_pages);
                //$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
                $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<span class='board_numbering_active' >$1</span>", $write_pages);
                ?>
                <?=$write_pages?>
                <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
            </div>
        </td>
        <td width="15%" align="center">
            <? if ($write_href) { ?>
            <a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border="0" /></a>
            <? } ?>
        </td>
    </tr>
    <tr><td colspan=8 height=1 bgcolor=#cfcfcf></td></tr>
    </table>
    <!-- 검색 -->
    <div class="board_search">
        <table width="600" border="0" align="center">

        <tr>
            <td align="center">
                <form name="fsearch" method="get">
                <input type="hidden" name="bo_table" value="<?=$bo_table?>">
                <input type="hidden" name="sca"      value="<?=$sca?>">
                <select name="sfl">
                <option value="wr_subject">제목</option>
                <option value="wr_content">내용</option>
                <option value="wr_subject||wr_content">제목+내용</option>
                <option value="mb_id,1">회원아이디</option>
                <option value="mb_id,0">회원아이디(코)</option>
                <option value="wr_name,1">글쓴이</option>
                <option value="wr_name,0">글쓴이(코)</option>
                </select>
                <input name="stx" class="stx" maxlength="15" itemname="검색어" required value='<?=stripslashes($stx)?>'>
                <input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" border='0' align="absmiddle">
                <input name="sop" type="radio" value="and" checked="checked" style="display:none" >
                <input type="radio" name="sop" value="or"style="display:none" >

                </form>
            </td>
        </tr>
        </table>
    </div>

</td>
</tr>
</table>


<script language="JavaScript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
	document.fsearch.sfl.value = '<?=$sfl?>';
	document.fsearch.sop.value = '<?=$sop?>';
}
</script>

<? if ($is_checkbox) { ?>
<script language="JavaScript">
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
		alert(str + "할 게시물을 하나 이상 선택하세요.");
		return false;
	}
	return true;
}

// 선택한 게시물 삭제
function select_delete() {
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
function select_copy(sw) {
	var f = document.fboardlist;

	if (sw == "copy")
		str = "복사";
	else
		str = "이동";

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
<!-- 게시판 목록 끝 -->
