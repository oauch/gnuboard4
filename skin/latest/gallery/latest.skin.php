<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

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
$image = $list[$i][file][0][file]; //���� ��������_�Ʒ� �ڹٿ� ����_�߰�
$img=$data_path. "/".$image;  //������� ������� �������
$thumb = $thumb_path. "/". $list[$i][wr_id];
if ( file_exists($thumb) )
$img = $thumb;
$style_a = "font-family:����; font-size:8pt; color:#999999;";
$style = "font-family:����; font-size:8pt; color:#636363;";
?>

<? echo "<a href='{$list[$i][href]}' onfocus='this.blur()'>
<div style=' padding-right:5px;'><img src='$img' width='100' height='70' border='0' style='display: block;'></div></a>"; ?>
<!--�̹��� ������ width, height �����ؼ� ������ּ��� --> 
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
<!--�����̹��� ���ڸ� �����ּ��� -->    
 <? if ($m%5==0){ ?>
<!--�����̹��� ���ڿ� �ֽŰԽù��� �θ��� �����ʹ� �ٸ��ϴ�. -->
</tr>
<tr>
<?}?>
<? } ?>
<? if (count($list) == 0) { echo "<td height=30 align=center>�̹����� �����ϴ�.</td>"; } ?>
</tr>
</table>
</div>
