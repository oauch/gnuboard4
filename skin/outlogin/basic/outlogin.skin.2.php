<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>


<style>
#top_login_bt a{font-size:8pt; text-decoration:none; color:#666; padding-left:5px;}
</style>

<!-- �α��� �� �ܺηα��� ���� -->

<div id="top_login_bt">
<a href="/gnuboard4/index.php">ó������</a>
<a href="<?=$g4['bbs_path']?>/logout.php">�α׾ƿ�</a>
<a href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php">��������</a>
<a href="/gnuboard4/adm/">������</a>
</div>


<script type="text/javascript">
// Ż���� ��� �Ʒ� �ڵ带 �����Ͻø� �˴ϴ�.
function member_leave() 
{
    if (confirm("���� ȸ������ Ż�� �Ͻðڽ��ϱ�?")) 
            location.href = "<?=$g4['bbs_path']?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- �α��� �� �ܺηα��� �� -->
