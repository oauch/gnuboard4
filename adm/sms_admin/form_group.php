<?
$sub_menu = "800500";
include_once("./_common.php");

$colspan = 4;

auth_check($auth[$sub_menu], "r");

$g4[title] = "�̸�Ƽ�� �׷�";

$res = sql_fetch("select count(*) as cnt from $g4[sms4_form_group_table]");
$total_count = $res[cnt];

$group = array();
$qry = sql_query("select * from $g4[sms4_form_group_table] order by fg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

include_once("$g4[admin_path]/admin.head.php");
?>

<script language=javascript>

function del(fg_no) {
    if (confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n�����Ǵ� �׷쿡 ���� �ڷ�� '�̺з�'�� �̵��˴ϴ�.\n\n�׷��� �����Ͻðڽ��ϱ�?"))
        hiddenframe.location.href = 'form_group_update.php?w=d&fg_no=' + fg_no;
}

function up(fg_no) {
    hiddenframe.location.href = 'form_group_update.php?w=up&fg_no=' + fg_no;
}

function down(fg_no) {
    hiddenframe.location.href = 'form_group_update.php?w=down&fg_no=' + fg_no;
}

function move(fg_no, fg_name, sel) {
    var msg = '';
    if (sel.value) 
    {
        msg  = "'" + fg_name + "' �׷쿡 ���� ��� �����͸�\n\n'";
        msg += sel.options[sel.selectedIndex].text + "' �׷����� �̵��Ͻðڽ��ϱ�?";

        if (confirm(msg))
            hiddenframe.location.href = 'form_group_move.php?fg_no=' + fg_no + '&move_no=' + sel.value; 
        else
            sel.selectedIndex = 0;
    }
}

function empty(fg_no) {
    if (confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n�׷쿡 ���� �����͸� ������ ���ðڽ��ϱ�?"))
        hiddenframe.location.href = 'form_group_update.php?w=empty&fg_no=' + fg_no;
}

</script>

<?=subtitle($g4[title])?>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
    <td width=50% height=30>
        <form name="group<?=$res[fg_no]?>" method="post" action="form_group_update.php" style="padding:0; margin:0;" target=hiddenframe>
        <input type=hidden name=fg_no value='<?=$res[fg_no]?>'>
        �׷� �߰� :
        <input type=text id=fg_name name=fg_name size=15 required itemname='�׷��̸�'>
        <input type=image src="<?=$g4[admin_path]?>/img/icon_insert.gif" align=absmiddle>
        <span style="color:#999;">�׷��̸������� ���ĵ˴ϴ�.</span>
        </form>
    </td>
    <td width=50% align=right>�Ǽ� : <? echo $total_count ?></td>
</tr>
</table>


<table cellpadding=0 cellspacing=0 width=100% border=0>
<tr><td colspan=<?=$colspan?> height=2 bgcolor=#0E87F9></td></tr>
<tr align=center class=ht>
    <td style="font-weight:bold;"> �׷��̸� </td>
    <td width=80 style="font-weight:bold;"> �̸�Ƽ�ܼ� </td>
    <td width=200 style="font-weight:bold;"> �̵� </td>
    <td width=100 style="font-weight:bold;"> ���� </td>
</tr>
<tr><td colspan=<?=$colspan?> height=1 bgcolor=#CCCCCC></td></tr>
<?
$qry = sql_query("select count(*) as cnt from $g4[sms4_form_table] where fg_no=0");
$res = sql_fetch_array($qry);
?>
<tr>
    <td height=30 style="padding-left:20px;"> 
        <img src="<?=$g4[sms_admin_path]?>/img/icon_close.gif" alt='�׷�' align=absmiddle>
        �̺з�
    </td>
    <td align=center>
        <?=number_format($res[cnt])?>
    </td>
    <td align=center>
        <select name="fg_no" onchange="move(0, '�̺з�', this);" style="width:150px">
        <option value=''></option>
        <? for ($i=0; $i<count($group); $i++) { ?>
        <option value="<?=$group[$i][fg_no]?>"> <?=$group[$i][fg_name]?> </option>
        <? } ?>
        </select>
    </td>
    <td align=center>
        <input type=button value='����' class=btn1 onclick=empty('no')>
    </td>
</tr>
<?
for ($i=0; $i<count($group); $i++) {
    if ($i%2) $bgcolor = '#ffffff'; else $bgcolor = '#F8F8F8';
?>
<tr bgcolor='<?=$bgcolor?>'>
    <td height=30 style="padding-left:20px;"> 
        <form name="group<?=$group[$i][fg_no]?>" method="post" action="form_group_update.php" style="padding:0; margin:0;" target=hiddenframe>
        <input type=hidden name=w value='u'>
        <input type=hidden name=fg_no value='<?=$group[$i][fg_no]?>'>
        <img src="<?=$g4[sms_admin_path]?>/img/icon_close.gif" alt='�׷�'>
        <input type=text size=30 name=fg_name value="<?=$group[$i][fg_name]?>">
        <input type=checkbox name=fg_member value=1 <?if ($group[$i][fg_member]) echo 'checked';?>> ȸ��
        <a href="javascript:document.group<?=$group[$i][fg_no]?>.submit()"><img src="<?=$g4[admin_path]?>/img/icon_modify.gif" alt='����' border=0 align=absmiddle></a>
        <a href="javascript:del(<?=$group[$i][fg_no]?>);"><img src="<?=$g4[admin_path]?>/img/icon_delete.gif" alt='����' border=0 align=absmiddle></a>
        <a href="./form_list.php?fg_no=<?=$group[$i][fg_no]?>"><img src="<?=$g4[admin_path]?>/img/icon_view.gif" alt='����' border=0 align=absmiddle></a>
        <!--
        <a href="javascript:up(<?=$group[$i][fg_no]?>);"><img src="<?=$g4[sms_admin_path]?>/img/icon_up.gif" alt='���� �̵�'></a>
        <a href="javascript:down(<?=$group[$i][fg_no]?>);"><img src="<?=$g4[sms_admin_path]?>/img/icon_down.gif" alt='�Ʒ��� �̵�'></a>
        -->
        </form>
    </td>
    <td align=center>
        <?=number_format($group[$i][fg_count])?>
    </td>
    <td align=center>
        <select name="fg_no" onchange="move(<?=$group[$i][fg_no]?>, '<?=$group[$i][fg_name]?>', this);" style="width:150px">
        <option value=''></option>
        <option value='0'>�̺з�</option>
        <? for ($j=0; $j<count($group); $j++) { ?>
        <? if ($group[$i][fg_no]==$group[$j][fg_no]) continue; ?>
        <option value="<?=$group[$j][fg_no]?>"> <?=$group[$j][fg_name]?> </option>
        <? } ?>
        </select>
    </td>
    <td align=center>
        <input type=button value='����' class=btn1 onclick=empty(<?=$group[$i][fg_no]?>)>
    </td>
</tr>
<?}?>
<tr><td colspan=<?=$colspan?> height=1 bgcolor=#CCCCCC></td></tr>
</table>
<div style="height:50px;"></div>

<script language=javascript>
document.getElementById('fg_name').focus();
</script>

<?
include_once("$g4[admin_path]/admin.tail.php");
?>
