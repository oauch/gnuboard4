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
.board_numbering { line-height:30px;  margin-top:10px;  margin-bottom:5px; text-align:center; font-size: 14px; font-family:"���� ���","����",tahoma;}
.board_numbering a { text-decoration:none;  background-color:#f2f2f2; border:1px solid  #ccc; padding:3px 6px 3px 6px;  color:#666666;}
.board_numbering a:hover { color:#cccccc; text-decoration:none; background-color:#fefefe; }
.board_numbering_active {color:#cccccc;   border:1px solid #cccccc; padding:3px 6px 3px 6px; background-color:#cccccc;  text-decoration:none; background-color:#cccccc;}
</style>



<!-- �Խ��� ��� ���� -->
<table width="100%" align=center cellpadding=0 cellspacing=0>
<tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="<?=$board_skin_path?>/images/bo_02.jpg" width="739" height="35" alt=""></td>
        </tr>
        </table>
        <!--����Ʈ ����-->
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

    <? if (count($list) == 0) { echo "<table width='$width'><tr><td height=100 align=center>�Խù��� �����ϴ�.</td></tr></table>"; } ?>
    </form>
    <!--����Ʈ ��-->

    <!-- ������ --><!-- ��ũ ��ư, �˻� -->
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

                <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='�����˻�'></a>"; } ?>
                <?
                // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �̹����ε� ����� �� �ֽ��ϴ�.
                //echo $write_pages;
                $write_pages = str_replace("ó��", "��", $write_pages);
                $write_pages = str_replace("����", "&lt;", $write_pages);
                $write_pages = str_replace("����", "&gt;", $write_pages);
                $write_pages = str_replace("�ǳ�", "��", $write_pages);
                //$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
                $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<span class='board_numbering_active' >$1</span>", $write_pages);
                ?>
                <?=$write_pages?>
                <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='�����˻�'></a>"; } ?>
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
    <!-- �˻� -->
    <div class="board_search">
        <table width="600" border="0" align="center">

        <tr>
            <td align="center">
                <form name="fsearch" method="get">
                <input type="hidden" name="bo_table" value="<?=$bo_table?>">
                <input type="hidden" name="sca"      value="<?=$sca?>">
                <select name="sfl">
                <option value="wr_subject">����</option>
                <option value="wr_content">����</option>
                <option value="wr_subject||wr_content">����+����</option>
                <option value="mb_id,1">ȸ�����̵�</option>
                <option value="mb_id,0">ȸ�����̵�(��)</option>
                <option value="wr_name,1">�۾���</option>
                <option value="wr_name,0">�۾���(��)</option>
                </select>
                <input name="stx" class="stx" maxlength="15" itemname="�˻���" required value='<?=stripslashes($stx)?>'>
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
