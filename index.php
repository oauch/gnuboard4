<?
include_once("./inc/dahan-common.php"); //그누보드세팅
include $g4[path]."/popup_open.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mainbg">
  <tr>
    <td align="center">
    <table width="1100" border="0" cellspacing="0" cellpadding="0">
  <tr><td height="120" align="center" valign="middle"><a href="<?=$skinName?>"><img src="<?=$skinName?>images/logo.png"></a></td></tr>
  <tr><td class="topmenu" height="50"><?include_once("inc/topmenu.php");?></td>
    </tr>
  <tr><td height="449" valign="top" class="main">
<div class="m_flash"><script type="text/javascript">swf("<?=$skinName?>flash/right.swf",1100,449,"transparent","");</script></div>
<div class="quick"><div><?include_once("inc/quick.php");?></div></div>
<div class="m_text"><div><?include_once("inc/maintext.php");?></div></div>
  </td></tr>
  <tr><td>
  <table width="1100" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="/gnuboard4/sub0201.php"><img src="<?=$skinName?>images/mb01.jpg"></a></td>
    <td><a href="/gnuboard4/sub0301.php"><img src="<?=$skinName?>images/mb02.jpg"></a></td>
    <td><img src="<?=$skinName?>images/mb03.jpg"></td>
    <td><img src="<?=$skinName?>images/mb04.jpg"></td>
  </tr>
  <tr>
    <td><a href="/gnuboard4/sub0201.php"><img src="<?=$skinName?>images/mb05.jpg"></a></td>
    <td><a href="/gnuboard4/sub0301.php"><img src="<?=$skinName?>images/mb06.jpg"></a></td>
    <td><img src="<?=$skinName?>images/mb07.jpg"></td>
    <td><img src="<?=$skinName?>images/mb08.jpg"></td>
  </tr>
</table>
</td></tr>
    </table>
    </td>
  </tr>
    <tr><td align="center" valign="middle" height="100"><?include_once("inc/copy.php");?></td></tr>
</table>



<?
include_once("./tail.sub.php");
?>
