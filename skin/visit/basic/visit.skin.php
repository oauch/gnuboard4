<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

global $is_admin;
?>

<style>
.admin_visit{font-size:9pt; color:#999; line-height:15px;}
.admin_visit b{padding:0px 3px 0px 15px;}
.admin_visit .admin_visit_left{padding-left:0px !important;}
</style>

<div class="admin_visit">
<b class="admin_visit_left">����</b> <?=number_format($visit[1])?>
<b>����</b> <?=number_format($visit[2])?>
<b>�ִ�</b> <?=number_format($visit[3])?>
<b>��ü</b> <?=number_format($visit[4])?> 
</div>
