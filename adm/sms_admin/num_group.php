<?
$sub_menu = "800700";
include_once("./_common.php");

$colspan = 8;

auth_check($auth[$sub_menu], "r");

$g4[title] = "�ڵ�����ȣ �׷�";

$res = sql_fetch("select count(*) as cnt from $g4[sms4_book_group_table]");
$total_count = $res[cnt];

$no_group = sql_fetch("select * from $g4[sms4_book_group_table] where bg_no = 1");

$group = array();
$qry = sql_query("select * from $g4[sms4_book_group_table] where bg_no > 1 order by bg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

include_once("$g4[admin_path]/admin.head.php");
?>


<script language=javascript>

function del(bg_no) {
    if (confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n�����Ǵ� �׷쿡 ���� �ڷ�� '<?=$no_group[bg_name]?>'�� �̵��˴ϴ�.\n\n�׷��� �����Ͻðڽ��ϱ�?"))
        hiddenframe.location.href = 'num_group_update.php?w=d&bg_no=' + bg_no;
}

function move(bg_no, bg_name, sel) {
    var msg = '';
    if (sel.value) 
    {
        msg  = "'" + bg_name + "' �׷쿡 ���� ��� �����͸�\n\n'";
        msg += sel.options[sel.selectedIndex].text + "' �׷����� �̵��Ͻðڽ��ϱ�?";

        if (confirm(msg))
            hiddenframe.location.href = 'num_group_move.php?bg_no=' + bg_no + '&move_no=' + sel.value; 
        else
            sel.selectedIndex = 0;
    }
}

function empty(bg_no) {
    if (confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n�׷쿡 ���� �����͸� ������ ���ðڽ��ϱ�?"))
        hiddenframe.location.href = 'num_group_update.php?w=empty&bg_no=' + bg_no;
}

</script>

<?=subtitle($g4[title])?>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
    <td width=50% height=30>
        <form name="group<?=$res[bg_no]?>" method="post" action="num_group_update.php" style="padding:0; margin:0;" target=hiddenframe>
        <input type=hidden name=bg_no value='<?=$res[bg_no]?>'>
        �׷� �߰� :
        <input type=text id=bg_name name=bg_name size=15 required itemname='�׷��̸�'>
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
    <td width=50 style="font-weight:bold;"> �� </td>
    <td width=50 style="font-weight:bold;"> ȸ�� </td>
    <td width=50 style="font-weight:bold;"> ��ȸ�� </td>
    <td width=50 style="font-weight:bold;"> ���� </td>
    <td width=50 style="font-weight:bold;"> �ź� </td>
    <td width=150 style="font-weight:bold;"> �̵� </td>
    <td width=100 style="font-weight:bold;"> ���� </td>
</tr>
<tr><td colspan=<?=$colspan?> height=1 bgcolor=#CCCCCC></td></tr>

<!-- �̺з� -->
<tr>
    <td height=30 style="padding-left:20px;"> 
        <img src="<?=$g4[sms_admin_path]?>/img/icon_close.gif" alt='�׷�' border=0 align=absmiddle>
        <?=$no_group[bg_name]?>
    </td>
    <td align=center> <?=number_format($no_group[bg_count])?> </td>
    <td align=center> <?=number_format($no_group[bg_member])?> </td>
    <td align=center> <?=number_format($no_group[bg_nomember])?> </td>
    <td align=center> <?=number_format($no_group[bg_receipt])?> </td>
    <td align=center> <?=number_format($no_group[bg_reject])?> </td>
    <td align=center>
        <select name="bg_no" onchange="move(<?=$no_group[bg_no]?>, '<?=$no_group[bg_name]?>', this);" style="width:120px">
        <option value=''></option>
        <? for ($i=0; $i<count($group); $i++) { ?>
        <option value="<?=$group[$i][bg_no]?>"> <?=$group[$i][bg_name]?> </option>
        <? } ?>
        </select>
    </td>
    <td align=center>
        <input type=button value='����' class=btn1 onclick="empty(<?=$no_group[bg_no]?>)">
    </td>
</tr>
<!-- �̺з� �� -->

<?
for ($i=0; $i<count($group); $i++) {
    if ($i%2) $bgcolor = '#ffffff'; else $bgcolor = '#F8F8F8';
?>
<tr bgcolor='<?=$bgcolor?>'>
    <td height=30 style="padding-left:20px;"> 
        <form name="group<?=$group[$i][bg_no]?>" method="post" action="num_group_update.php" style="padding:0; margin:0;" target=hiddenframe>
        <input type=hidden name=w value='u'>
        <input type=hidden name=bg_no value='<?=$group[$i][bg_no]?>'>
        <img src="<?=$g4[sms_admin_path]?>/img/icon_close.gif" alt='�׷�'>
        <input type=text size=20 name=bg_name value="<?=$group[$i][bg_name]?>">
        <a href="javascript:document.group<?=$group[$i][bg_no]?>.submit()"><img src="<?=$g4[admin_path]?>/img/icon_modify.gif" alt='����' border=0 align=absmiddle></a>
        <a href="javascript:del(<?=$group[$i][bg_no]?>);"><img src="<?=$g4[admin_path]?>/img/icon_delete.gif" alt='����' border=0 align=absmiddle></a>
        <a href="./num_book.php?bg_no=<?=$group[$i][bg_no]?>"><img src="<?=$g4[admin_path]?>/img/icon_view.gif" alt='����' border=0 align=absmiddle></a>
        </form>
    </td>
    <td align=center> <?=number_format($group[$i][bg_count])?> </td>
    <td align=center> <?=number_format($group[$i][bg_member])?> </td>
    <td align=center> <?=number_format($group[$i][bg_nomember])?> </td>
    <td align=center> <?=number_format($group[$i][bg_receipt])?> </td>
    <td align=center> <?=number_format($group[$i][bg_reject])?> </td>

    <td align=center>
        <select name="bg_no" onchange="move(<?=$group[$i][bg_no]?>, '<?=$group[$i][bg_name]?>', this);" style="width:120px">
        <option value=''></option>
        <option value='<?=$no_group[bg_no]?>'><?=$no_group[bg_name]?></option>
        <? for ($j=0; $j<count($group); $j++) { ?>
        <? if ($group[$i][bg_no]==$group[$j][bg_no]) continue; ?>
        <option value="<?=$group[$j][bg_no]?>"> <?=$group[$j][bg_name]?> </option>
        <? } ?>
        </select>
    </td>
    <td align=center>
        <input type=button value='����' class=btn1 onclick="empty(<?=$group[$i][bg_no]?>)")>
    </td>
</tr>
<?}?>
<tr><td colspan=<?=$colspan?> height=1 bgcolor=#CCCCCC></td></tr>
</table>
<div style="height:50px;"></div>

<script language=javascript>
document.getElementById('bg_name').focus();
</script>

<?
include_once("$g4[admin_path]/admin.tail.php");
?>