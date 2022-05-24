<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style type="text/css">
#lastest {line-height:18px; font-size:9pt; }
#lastest a {color: #767676; text-decoration: none;}
#lastest a:hover { color: #555555; text-decoration: none;}
</style>

<? for ($i=0; $i<count($list); $i++) { ?>
<div id="lastest">
            <?
            //echo $list[$i]['icon_reply'] . " ";
            echo "<a href='{$list[$i]['href']}'>";
            if ($list[$i]['is_notice'])
                echo "{$list[$i]['subject']}";
            else
                echo "[{$list[$i]['datetime2']}] {$list[$i]['subject']}";
            echo "</a>";

            if ($list[$i]['comment_cnt']) 
                echo "<a href=\"{$list[$i]['comment_href']}\">{$list[$i]['comment_cnt']}</a>";

           //echo " " . $list[$i]['icon_new'];
            ?>
</div>
<? } ?>
<? if (count($list) == 0) { ?><left><font color="#767676">게시물이 없습니다.</font></left><? } ?>
