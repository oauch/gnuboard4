<?
$sub_menu = "800800";
include_once("./_common.php");

$colspan = 4;

auth_check($auth[$sub_menu], "r");

$g4[title] = "�ڵ�����ȣ ";

if ($w == 'u' && is_numeric($bk_no)) {
    $write = sql_fetch("select * from $g4[sms4_book_table] where bk_no='$bk_no'");
    if (!$write)
        alert('�����Ͱ� �����ϴ�.');

    if ($write[mb_id]) {
        $res = sql_fetch("select mb_id from $g4[member_table] where mb_id='$write[mb_id]'");
        $write[mb_id] = $res[mb_id];
    }
    $g4[title] .= '����';
}
else  {
    $write[bg_no] = $bg_no;
    $g4[title] .= '�߰�';
}

if (!is_numeric($write[bk_receipt]))
    $write[bk_receipt] = 1;

$no_group = sql_fetch("select * from $g4[sms4_book_group_table] where bg_no = 1");

include_once("$g4[admin_path]/admin.head.php");
?>

<?=subtitle($g4[title])?>

<form name=book_form method=post action=num_book_update.php target=hiddenframe style="padding:0; margin:0;">
<input type=hidden name=w value='<?=$w?>'>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name=ap value='<?=$ap?>'>
<input type=hidden name=bk_no value='<?=$write[bk_no]?>'>
<input type=hidden name=mb_id value='<?=$write[mb_id]?>'>
<input type=hidden name=get_bg_no value='<?=$bg_no?>'>
<table cellpadding=0 cellspacing=0 width=100% border=0>
<tbody align=center>
<tr><td colspan=<?=$colspan?> height=2 bgcolor=#0E87F9></td></tr>
<tr height=30>
    <td width=100> �׷� </td>
    <td align=left> 
        <select name=bg_no required itemname='�׷�' tabindex=1>
        <option value='1'><?=$no_group[bg_name]?> (<?=number_format($no_group[bg_count])?> ��)</option>
        <?
        $qry = sql_query("select * from $g4[sms4_book_group_table] where bg_no>1 order by bg_name");
        while($res = sql_fetch_array($qry)) {
        ?>
        <option value='<?=$res[bg_no]?>' <?=$res[bg_no]==$write[bg_no]?'selected':''?>> <?=$res[bg_name]?>  (<?=number_format($res[bg_count])?> ��) </option>
        <?}?>
        </select>
    </td>
</tr>
<tr height=30>
    <td width=100> �̸� </td>
    <td align=left> <input type=text size=20 name=bk_name required itemname='�̸�' maxlength=50 value='<?=$write[bk_name]?>' tabindex=2> </td>
</tr>
<tr height=30>
    <td> �ڵ�����ȣ </td>
    <td align=left> <input type=text size=20 name=bk_hp required telnumber itemname='�ڵ�����ȣ' value='<?=$write[bk_hp]?>' tabindex=3> </td>
</tr>
<tr height=30>
    <td> ���ſ��� </td>
    <td align=left> 
        <input type=radio name=bk_receipt value=1 <?=$write[bk_receipt]?'checked':''?> tabindex=4> �������
        <input type=radio name=bk_receipt value=0 <?=!$write[bk_receipt]?'checked':''?> tabindex=5> ���Űź�
    </td>
</tr>
<?if ($w == 'u') {?>
<tr height=30>
    <td> ��� </td>
    <td align=left> <?=$write[mb_id] ? "ȸ�� ID : <a href='$g4[admin_path]/member_form.php?&w=u&mb_id=$write[mb_id]'>$write[mb_id]</a> <font color='#999999'>(������ ȸ����������  �ݿ��˴ϴ�.)</font>" : '��ȸ��'?> </td>
</tr>
<tr height=30>
    <td> ������Ʈ </td>
    <td align=left> <?=$write[bk_datetime]?> </td>
</tr>
<?}?>
<tr height=180>
    <td> �޸� </td>
    <td align=left> 
        <textarea name=bk_memo cols=100 rows=10><?=$write[bk_memo]?></textarea>
    </td>
</tr>
<tr><td colspan=<?=$colspan?> height=1 bgcolor=#CCCCCC></td></tr>
</tbody>
</table>

<p align=center>
    <input type=submit class=btn1 accesskey='s' tabindex=6 value='  Ȯ  ��  '>&nbsp;
    <input type=button class=btn1 accesskey='l' tabindex=7 value='  ��  ��  ' onclick="document.location.href='./num_book.php?<?=$QUERY_STRING?>';">
</p>
</form>

<script language=javascript>
document.book_form.bg_no.focus();
</script>
<?
include_once("$g4[admin_path]/admin.tail.php");
?>