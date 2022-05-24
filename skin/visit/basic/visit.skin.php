<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

global $is_admin;
?>

<style>
.admin_visit{font-size:9pt; color:#999; line-height:15px;}
.admin_visit b{padding:0px 3px 0px 15px;}
.admin_visit .admin_visit_left{padding-left:0px !important;}
</style>

<div class="admin_visit">
<b class="admin_visit_left">오늘</b> <?=number_format($visit[1])?>
<b>어제</b> <?=number_format($visit[2])?>
<b>최대</b> <?=number_format($visit[3])?>
<b>전체</b> <?=number_format($visit[4])?> 
</div>
