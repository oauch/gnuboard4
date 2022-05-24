<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';
?>

<style>
#gall-lastest {line-height:18px; font-size:9pt; }
#gall-lastest a {color: #767676; text-decoration: none;}
#gall-lastest a:hover { color: #555555; text-decoration: none;}
</style>

<div style="float:left;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? for($i=0; $i<count($list); $i++) {$m++;?>
<td valign="top">

<table cellspacing="0">
<tr>
<td>
<?
$image = $list[$i][file][0][file]; //원본 리사이즈_아래 자바와 연동_추가
$img=$data_path. "/".$image;  //썸네일이 없을경우 원본출력
$thumb = $thumb_path. "/". $list[$i][wr_id];
if ( file_exists($thumb) )
$img = $thumb;
$style_a = "font-family:돋움; font-size:8pt; color:#999999;";
$style = "font-family:돋움; font-size:8pt; color:#636363;";
?>

<? echo "<a href='{$list[$i][href]}' onfocus='this.blur()'>
<div style=' padding-right:5px;'><img src='$img' width='100' height='70' border='0' style='display: block;'></div></a>"; ?>
<!--이미지 사이즈 width, height 수정해서 사용해주세요 --> 
</td>
</tr>
<tr>
<td>
</td>
</tr>

<tr>
<td align='center' id="gall-lastest"><?
echo $list[$i]['icon_reply'] . " ";
echo "<a href='{$list[$i]['href']}'>";
if ($list[$i]['is_notice'])
echo "";
echo "{$list[$i]['subject']}";
echo "</a>";
echo "<div>{$list[$i]['wr_5']}</div>";
?>
</td></tr>

</table>

</td>
<!--가로이미지 숫자를 정해주세요 -->    
 <? if ($m%5==0){ ?>
<!--가로이미지 숫자와 최신게시물을 부를때 갯수와는 다릅니다. -->
</tr>
<tr>
<?}?>
<? } ?>
<? if (count($list) == 0) { echo "<td height=30 align=center>이미지가 없습니다.</td>"; } ?>
</tr>
</table>
</div>
