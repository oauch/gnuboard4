<?
$sub_menu = "800200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "ȸ������ ������Ʈ";

include_once("$g4[admin_path]/admin.head.php");
?>

<script language="javascript">
function run()
{
    document.getElementById('res').innerHTML = '������Ʈ ���Դϴ�. ��ø� ��ٷ� �ֽʽÿ�...';
    hiddenframe.document.location.href = 'member_update_run.php';
}
</script>

<?=subtitle($g4[title])?>

<div style="line-height:30px; margin-bottom:10px;">
���ο� ȸ�������� ������Ʈ �մϴ�.<br>
���� �� '�Ϸ�' �޼����� ������ ���� ���α׷��� ������ �������� ���ʽÿ�.<br>
������ ������Ʈ �Ͻ� : <span id='datetime'><?=$sms4[cf_datetime]?></span> <br>
</div>
<div id=res style="line-height:30px;">
<input type=button value='��     ��' onclick=run() class='btn1'>
</div>

<?
include_once("$g4[admin_path]/admin.tail.php");
?>