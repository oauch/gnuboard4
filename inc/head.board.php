<?
include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");

$skinName = "/gnuboard4/"; //경로설정

$g4['title'] = "";

include_once("$g4[path]/head.sub.php");
include_once("$g4[path]/lib/outlogin.lib.php");
include_once("$g4[path]/lib/poll.lib.php");
include_once("$g4[path]/lib/visit.lib.php");
include_once("$g4[path]/lib/connect.lib.php");
include_once("$g4[path]/lib/popular.lib.php");
?>
<body style="overflow-x:hidden">
<link href="<?=$skinName?>inc/dahan-cs.css" rel="stylesheet" type="text/css"/>
<script src="<?=$skinName?>inc/dahan-js.js" type="text/javascript"></script>

<?
$subHadeNum = $board[bo_7]; //탑메뉴페이지인식
$subPageNum = $board[bo_8]; //헤드
$title = $board[bo_9]; //페이지코드
$bigmenu = $board[bo_10]; //타이틀
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="subbg">
  <tr>
    <td align="center">
    <table width="1100" border="0" cellspacing="0" cellpadding="0">
  <tr><td height="120" align="center" valign="middle"><a href="<?=$skinName?>"><img src="<?=$skinName?>images/logo.png"></a></td></tr>
  <tr><td height="50" id="head<?=$subHadeNum?>" class="topmenu"><?include_once("../inc/topmenu.php");?></td>
    </tr>
  <tr><td height="215" valign="top"><!--sub top--></td></tr>
  <tr><td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr><td height="46" valign="top" class="bigtitle"><?=$bigmenu?></td></tr>
  	<tr><td height="35" valign="top" id="page<?=$subPageNum?>"><?include_once("../inc/submenu$subHadeNum.php");?></td></tr>
  	<tr><td style="padding-top:33;" valign="top"><?include_once("../inc/banner.php");?></td></tr>
      </table></td>
    <td width="80"><!--space--></td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td height="46" class="title"><?=$title?></td></tr>
  <tr><td valign="top" style="padding:30 12 0 12;">
