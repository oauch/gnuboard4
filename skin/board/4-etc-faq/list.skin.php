<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 3;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>


<link rel="stylesheet" type="text/css" media="screen" href="<?=$board_skin_path?>/style.css" />

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

<div style='height:27px;'>&nbsp;</div>

<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0>
    <tr>
	    <td>		
<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
<form name=fsearch method=get style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl value="wr_subject||wr_content">
<input type="hidden" name="sop" value="and">
<!-- 검색 -->



   <? if ($write_href) { ?><div id=basicclas01 style='float:right; padding-bottom:10px;'><a href='<?=$admin_href?>' id="board_button2">관리자</a></div><? } ?>
   

<table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td>
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_faq">
	      <tr>
	      	<td align="left" class="faq-title"><b>FAQ</b>자주 물으시는 질문들입니다. 궁금사항은 먼저 검색해 보세요! </td>
	        <td align="right" width="230" style=" padding:0 12px 0 0;">
			<!-- 검색 -->
			<table cellpadding="0" cellspacing="0">
			    <tr>
			        <td>
					<form name=fsearch method=get style="margin:0px;">
                    <input type=hidden name=bo_table value="<?=$bo_table?>">
                    <input type=hidden name=sca value="<?=$sca?>">
                    <input type=hidden name=sfl value="<?=$wr_subject?>">
                    <input name=stx maxlength=12   itemname='검색어' required="required" value='<?=stripslashes($stx)?>' style="width:190px; background-color:#f4f4f4; border:0px ; line-height:30px; height:30px; vertical-align:middle; color:'929292';" />
					</td>
			        <td><input type="submit" value="검색" accesskey="s" class="btn_search">
				
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

<!--분류 
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
    <div id="tap-faq-mu">

<?

        $arr = array();
        $ex = explode("|", $board[bo_category_list]);
        if($sca=="") {
           $arr[0] = "<div id='tap-faq-mu-sel'><a href='$g4[bbs_path]/board.php?bo_table=$bo_table' >전체</a></div>";
        }else{
           $arr[0] = "<div id='tap-faq-mu'><a href='$g4[bbs_path]/board.php?bo_table=$bo_table'  $sca='전체';'>전체</a></div>";
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
<!-- 제목 과 내용-->
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
	 <div style="float:left; color:666666;cursor:pointer; font-weight:bold; letter-spacing:2px;"> 수정</div></a>
			<!---<a href="javascript:del('./delete.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>&page=');"><img src="<?=$board_skin_path?>/img/btn_del.gif" alt="삭제" border="0" align="absmiddle" title="삭제하기"></a>---></td>
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
echo "<td style='padding:100px 0 60px 0;'><div align=center><br>찾으시는 게시물이 없습니다.</div></td>";
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

<!-- 버튼 링크 -->

<br>
<!-- 페이지 -->
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
    <? if ($write_href) { ?><div id=basicclas01><a href='<?=$write_href?>' id="board_button2">글쓰기</a></div><? } ?>
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

<!-- 펼쳐지는 스크립트-->
<script>
var old_i; // 전에 클릭했던 글의 번호값 저장 
function view(i) { // 답변 표시여부 조정하는 js함수
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
