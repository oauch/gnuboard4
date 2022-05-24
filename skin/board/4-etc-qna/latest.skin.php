<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>


<table width=100% cellpadding=0 cellspacing=0>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
    <td colspan=4 align=center>
        <table width=100%>
        <tr>
            <td height=30 align=left style="position:relative;"><!-- <img src='<?=$latest_skin_path?>/img/latest_icon.gif' align=absmiddle>&nbsp;&nbsp;  -->
            <?
						if(!$is_guest){
							$list[$i]['href'] = $g4[path]."/request.php";
						}
						
						if($i == 0){
							$state_str = "<span style='color:#cf2424;'>견적진행</span>";
						}else{
							$state_str = "<span style='color:#2489cf;'>견적완료</span>";
						}
            echo $list[$i]['icon_reply'] . " ";
            echo "<a href='{$list[$i]['href']}' style='text-decoration:none;'>";
            if ($list[$i]['is_notice'])
                echo "<font style='font-family:malgun gothic, 돋움; font-size:11pt; color:#2C88B9;'><strong>{$list[$i]['subject']}</strong></font> <span style='position:absolute; right:40px; color:#6A6A6A;'>2013-07-10</span>";
            else
                echo "<font style='font-family:malgun gothic, 돋움; font-size:11pt; color:#6A6A6A;'><span style='font-size:9pt;'>[{$state_str}]&nbsp;</span>".substr($list[$i][wr_2],0,3)."*".substr($list[$i][wr_2],6,3)." 님의 상담문의 </font> <span style='position:absolute; right:40px; color:#6A6A6A;'>".date("Y-m-d")."</span>";
            echo "</a>";

            if ($list[$i]['comment_cnt']) 
                echo " <a href=\"{$list[$i]['comment_href']}\"><span style='font-family:malgun gothic,  돋움; font-size:8pt; color:#9A9A9A;'>{$list[$i]['comment_cnt']}</span></a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
					
            echo " <img src='".$latest_skin_path."/img/icon_new.gif'>"  ;
						/*
            echo " " . $list[$i]['icon_file'];
            echo " " . $list[$i]['icon_link'];
            echo " " . $list[$i]['icon_hot'];
            echo " " . $list[$i]['icon_secret'];
						*/
            ?></td></tr>
        
        </table></td>
</tr>
<? } ?>

<? if (count($list) == 0) { ?><tr><td colspan=4 align=center height=50><font color=#6A6A6A>게시물이 없습니다.</a></td></tr><? } ?>

</table>
