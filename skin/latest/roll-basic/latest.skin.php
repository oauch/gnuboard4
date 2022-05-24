<?
if (!defined("_GNUBOARD_")) exit; 
?>

<style type="text/css" media="all">
#roll-lastest {line-height:18px; font-size:9pt;   overflow:hidden;}
#roll-lastest a {color: #767676; text-decoration: none; }
#roll-lastest a:hover { color: #555555; text-decoration: none;}
#news-container {width:280px; height:90px; }
</style>

<!--<script type="text/javascript" src="<?=$latest_skin_path?>/demo_files/jquery.js"></script>-->
<script type="text/javascript" src="<?=$latest_skin_path?>/demo_files/jquery.vticker-min.js"></script>
<script type="text/javascript">
$(function(){
	$('#news-container').vTicker({ 
		speed: 500,
		pause: 3000,
		animation: 'fade',
		mousePause: false,
		showItems: 5
	});

});
</script>


<div  id="news-container">
<ul>
<? for ($i=0; $i<count($list); $i++) {?>
<li style="display:list-item;">
<div id="roll-lastest"  >

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
	</li>
		
 <? } ?>
 </ul>
    
  
    
</div>
