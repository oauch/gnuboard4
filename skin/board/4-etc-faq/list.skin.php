<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ���ÿɼ����� ���� ����ġ�Ⱑ ���������� ����
$colspan = 3;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
// ������ ���ٷ� ǥ�õǴ� ��� �� �ڵ带 ����� ������.
// <nobr style='display:block; overflow:hidden; width:000px;'>����</nobr>
?>


<link rel="stylesheet" type="text/css" media="screen" href="<?=$board_skin_path?>/style.css" />

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

<div style='height:27px;'>&nbsp;</div>

<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0>
    <tr>
	    <td>		
<!-- �з� ����Ʈ �ڽ�, �Խù� ���, ������ȭ�� ��ũ -->
<form name=fsearch method=get style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl value="wr_subject||wr_content">
<input type="hidden" name="sop" value="and">
<!-- �˻� -->



   <? if ($write_href) { ?><div id=basicclas01 style='float:right; padding-bottom:10px;'><a href='<?=$admin_href?>' id="board_button2">������</a></div><? } ?>
   

<table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td>
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_faq">
	      <tr>
	      	<td align="left" class="faq-title"><b>FAQ</b>���� �����ô� �������Դϴ�. �ñݻ����� ���� �˻��� ������! </td>
	        <td align="right" width="230" style=" padding:0 12px 0 0;">
			<!-- �˻� -->
			<table cellpadding="0" cellspacing="0">
			    <tr>
			        <td>
					<form name=fsearch method=get style="margin:0px;">
                    <input type=hidden name=bo_table value="<?=$bo_table?>">
                    <input type=hidden name=sca value="<?=$sca?>">
                    <input type=hidden name=sfl value="<?=$wr_subject?>">
                    <input name=stx maxlength=12   itemname='�˻���' required="required" value='<?=stripslashes($stx)?>' style="width:190px; background-color:#f4f4f4; border:0px ; line-height:30px; height:30px; vertical-align:middle; color:'929292';" />
					</td>
			        <td><input type="submit" value="�˻�" accesskey="s" class="btn_search">
				
					</td>
			    </tr>
			</table>	            
                </form>
	       </td>
	      </tr>
	    </table>
    </td>
  </tr>
</table>
  <br> 

<!--�з� 
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
    <div id="tap-faq-mu">

<?

        $arr = array();
        $ex = explode("|", $board[bo_category_list]);
        if($sca=="") {
           $arr[0] = "<div id='tap-faq-mu-sel'><a href='$g4[bbs_path]/board.php?bo_table=$bo_table' >��ü</a></div>";
        }else{
           $arr[0] = "<div id='tap-faq-mu'><a href='$g4[bbs_path]/board.php?bo_table=$bo_table'  $sca='��ü';'>��ü</a></div>";
        }
        for ($i=0; $i<count($ex); $i++) {
             $ii=$i+1;
             if($sca==$ex[$i]) {
                $arr[$ii] = "<div id='tap-faq-mu-sel'><a href='$g4[bbs_path]/board.php?bo_table=$bo_table&sca={$ex[$i]}'>{$ex[$i]}</a></div>";
             }else{
                $arr[$ii] = "<div id='tap-faq-mu'><a href='$g4[bbs_path]/board.php?bo_table=$bo_table&sca={$ex[$i]}' $sca={$ex[$i]};'>{$ex[$i]}</a></div>";
             }
        }
        $str = implode("", $arr);
        echo $str;
?>

</div>
           <td>
    </tr>
</table>

-->
<br>
<div style="border-top:1px solid #dcdcdc;"></div>
<!-- ���� �� ����-->
<form name="fboardlist" method="post" style="margin:0px;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">
<? for ($i=0; $i<count($list); $i++) { ?> 	  

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr>
        <td >
		    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="tb_faq02" >
                <tr height="40" >
				    <? if ($is_checkbox) { ?><td width="20"><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td><? } ?>
	                <td align="right" width="46" >
			<img src="<?=$board_skin_path?>/img/q.gif" align="absmiddle" border="0">
			</td>
	                <td align="left" valign="middle">
					<? if ($is_category) { ?><?=$list[$i][ca_name]?><? } ?>&nbsp;
					&nbsp;<a onclick=view(<?=$list[$i][num]?>) style='cursor:hand'><?=$list[$i][subject]?></a>
					</td>
	                <? if (($member[mb_id] && ($member[mb_id] == $write[mb_id])) || $is_admin) { ?>
	                <td width="60" align="right"><a href="<?=$write_href?>&w=u&wr_id=<?=$list[$i][wr_id]?>&page=<?=$page?>">
	 <div style="float:left; color:666666;cursor:pointer; font-weight:bold; letter-spacing:2px;"> ����</div></a>
			<!---<a href="javascript:del('./delete.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>&page=');"><img src="<?=$board_skin_path?>/img/btn_del.gif" alt="����" border="0" align="absmiddle" title="�����ϱ�"></a>---></td>
	                <? } ?>
                </tr>
            </table>

            <div id="view_<?=$list[$i][num]?>" style="display:none">                 
            <table cellspacing="0" cellpadding="0" width="100%" border="0" id="tb_faq03">
                <tr>
                    <td colspan="2" height="1" bgcolor="#e5e5e5"></td>
				</tr>
                <tr>
                    <td valign='top' align='right' width='56' style='padding:22px 10px 0px 0px;' bgcolor='#fafafa'><img src="<?=$board_skin_path?>/img/a.gif" align='absmiddle' border=0></td>
                    <td valign='top' style='padding:25px 10px 25px 0px;' bgcolor='#fafafa' ><?=nl2br($list[$i][wr_content])?></td>
                </tr>
            </table>
            </div>
    </td>
    <tr>
        <td height=1 bgcolor="#e5e5e5"></td>
    </tr>
</table>
<? } ?>

<? if (count($list) == 0) { 
echo "<table width=100% border=0 cellspacing=0 cellpadding=0>";
echo "<tr>";
echo "<td width=11></td>";
echo " <td></td>";
echo "<td width=11></td>";
echo "</tr>";
echo " <tr>";
echo "<td></td>";
echo "<td style='padding:100px 0 60px 0;'><div align=center><br>ã���ô� �Խù��� �����ϴ�.</div></td>";
echo "<td></td>";
echo "</tr>";
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";
echo "<tr>";
echo "<td height=10 colspan=3></td>";
echo "</tr>";
echo "<tr><Td height= bgcolor=CECECE></td></tr>";
echo "</table>";
; } 
?>
</form>

<!-- ��ư ��ũ -->

<br>
<!-- ������ -->
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
    <? if ($write_href) { ?><div id=basicclas01><a href='<?=$write_href?>' id="board_button2">�۾���</a></div><? } ?>
    </div>
</div>


    </td>
    </tr>
</table>




<script language="JavaScript">
//if ("<?=$sca?>") document.fcategory.sca.value = "<?=$sca?>";
//if ("<?=$stx?>") {
//    document.fsearch.sfl.value = "<?=$sfl?>";
//    document.fsearch.sop.value = "<?=$sop?>";
//}
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

<!-- �������� ��ũ��Ʈ-->
<script>
var old_i; // ���� Ŭ���ߴ� ���� ��ȣ�� ���� 
function view(i) { // �亯 ǥ�ÿ��� �����ϴ� js�Լ�
	if (old_i==i) {
		var mode=document.getElementById('view_'+i).style.display;
		if (mode=='inline') document.getElementById('view_'+i).style.display='none';
		else document.getElementById('view_'+i).style.display='inline';
	}
	else {
		if (old_i) document.getElementById('view_'+old_i).style.display='none';
		document.getElementById('view_'+i).style.display='inline';
	}
	old_i=i;
}
</script> 
