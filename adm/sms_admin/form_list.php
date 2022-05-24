<?
$sub_menu = "800600";
include_once("./_common.php");

$page_size = 9;
$colspan = 2;

auth_check($auth[$sub_menu], "r");

$g4[title] = "�̸�Ƽ�� ����";

if (!$page) $page = 1;

if (is_numeric($fg_no)) 
    $sql_group = " and fg_no='$fg_no' ";
else
    $sql_group = "";

if ($st == 'all') {
    $sql_search = "and (fo_name like '%{$sv}%' or fo_content like '%{$sv}%')";
} else if ($st == 'name') {
    $sql_search = "and fo_name like '%{$sv}%'";
} else if ($st == 'content') {
    $sql_search = "and fo_content like '%{$sv}%'";
} else {
    $sql_search = '';
}

$total_res = sql_fetch("select count(*) as cnt from $g4[sms4_form_table] where 1 $sql_group $sql_search");
$total_count = $total_res[cnt];

$total_page = (int)($total_count/$page_size) + ($total_count%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$paging = get_paging(10, $page, $total_page, "form_list.php?fg_no=$fg_no&st=$st&sv=$sv&page="); 

$vnum = $total_count - (($page-1) * $page_size);

$group = array();
$qry = sql_query("select * from $g4[sms4_form_group_table] order by fg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

$res = sql_fetch("select count(*) as cnt from $g4[sms4_form_table] where fg_no=0");
$no_count = $res[cnt];

include_once("$g4[admin_path]/admin.head.php");
?>

<script language=javascript>

function book_all_checked(chk) 
{
    var fo_no = document.getElementsByName('fo_no');

    if (chk) {
        for (var i=0; i<fo_no.length; i++) {
            fo_no[i].checked = true;
        }
    } else {
        for (var i=0; i<fo_no.length; i++) {
            fo_no[i].checked = false;
        }
    }
}

function book_del(fo_no)
{
    if (confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n�׷��� �����Ͻðڽ��ϱ�?"))
        hiddenframe.location.href = "./form_update.php?w=d&fo_no=" + fo_no + "&page=<?=$page?>&fg_no=<?=$fg_no?>&st=<?=$st?>&sv=<?=$sv?>";
}

function multi_update(sel)
{
    var fo_no = document.getElementsByName('fo_no');
    var ck_no = '';
    var count = 0;

    if (!sel.value) {
        sel.selectedIndex = 0;
        return;
    }

    for (i=0; i<fo_no.length; i++) {
        if (fo_no[i].checked==true) {
            count++;
            ck_no += fo_no[i].value + ',';
        }
    }

    if (!count) {
        alert('�ϳ��̻� �������ּ���.');
        sel.selectedIndex = 0;
        return;
    }

    if (sel.value == 'del') {
        if (!confirm("������ �̸�Ƽ�ܸ� �����մϴ�.\n\n��ȸ���� �����˴ϴ�.\n\nȸ���� �����Ϸ��� ȸ������ �޴��� �̿����ּ���.\n\n�����Ͻðڽ��ϱ�?")) 
        {
            sel.selectedIndex = 0;
            return;
        }
    } else if (!confirm("������ �̸�Ƽ�ܸ� " + sel.options[sel.selectedIndex].innerHTML + "\n\n�����Ͻðڽ��ϱ�?")) {
        sel.selectedIndex = 0;
        return;
    }

    hiddenframe.location.href = "form_multi_update.php?w=" + sel.value + "&ck_no=" + ck_no;
}
</script>

<?=subtitle($g4[title])?>

<table width=100% cellpadding=0 cellspacing=0 height=30>
<tr>
    <td width=50%>
        <form style="margin:0; padding:0;">
        <select name="fg_no" onchange="location.href='<?=$PHP_SELF?>?fg_no='+this.value;">
        <option value="" <?=$fg_no?'':'selected'?>> ��ü </option>
        <option value="0" <?=$fg_no=='0'?'selected':''?>> �̺з� (<?=number_format($no_count)?>) </option>
        <? for($i=0; $i<count($group); $i++) {?>
        <option value="<?=$group[$i][fg_no]?>" <?=($fg_no==$group[$i][fg_no])?'selected':''?>> <?=$group[$i][fg_name]?> (<?=number_format($group[$i][fg_count])?>) </option>
        <? } ?>
        </select>
        </form>
    </td>
    <td width=50% align=right>
        �Ǽ� : <?=number_format($total_count)?>
    </td>
</tr>
</table>

<table cellpadding=0 cellspacing=0 width=100% border=0>
<tr><td height=2 colspan=<?=$colspan?> bgcolor=#0E87F9></td></tr>
<tr class=ht>
    <td>
        &nbsp;
        <b>�̸�Ƽ�� ���</b>
        <input type=checkbox onclick="book_all_checked(this.checked)">
    </td>
    <td align=right>
        <input type=image src="<?=$g4[admin_path]?>/img/icon_insert.gif" align=absmiddle alt='�߰�' onclick="location.href='./form_write.php?page=<?=$page?>&fg_no=<?=$fg_no?>';" accesskey='w'>
        &nbsp;
    </td>
</tr>
<tr><td colspan=<?=$colspan?> height=1 bgcolor=#CCCCCC></td></tr>
<tr>
    <td colspan=<?=$colspan?> style="padding:10px 0 10px 10px;">


<table border=0 cellpadding=0 cellspacing=0>
<tr>
<? if (!$total_count) { ?>
    <td align=center width height=100 style="color:#999;"> 

        <div style="width:780px;">
        �����Ͱ� �����ϴ�. 
        </div>

    </td>
<?
}
$count = 1;
$qry = sql_query("select * from $g4[sms4_form_table] where 1 $sql_group $sql_search order by fo_no desc limit $page_start, $page_size");
while($res = sql_fetch_array($qry)) 
{
    $tmp = sql_fetch("select fg_name from $g4[sms4_form_group_table] where fg_no='$res[fg_no]'");
    if (!$tmp)
        $group_name = '�̺з�';
    else
        $group_name = $tmp[fg_name];
?>
    <td width=270 height=145>

        <table border=0 cellpadding=0 cellspacing=5 width=255 bgcolor="#F8F8F8" style="border:1px solid #ccc;">
        <tr>
            <td background="img/smsbg.gif" width=120 height=120 align=center>
                <textarea style="font-family:����ü; color:#000; line-height:15px; margin-top:10px; overflow:hidden; width:100px; height:88px; font-size: 9pt; background-color:#88C8F8; text-align:left; word-break:break-all; border:0; padding:0;" readonly><?=$res[fo_content]?></textarea>
            </td>
            <td style="padding-left:5px;" valign=top>
                <div style="height:25px; text-align:right;"> <input type=checkbox name=fo_no value='<?=$res[fo_no]?>'> </div>
                <div style="height:20px; color:#555;"> ���� : <?=cut_str($res[fo_name],10)?> </div>
                <div style="height:20px; color:#555;"> �׷� : <?=$group_name?>  </div>
                <div style="height:20px; color:#555;"> ��� : <?=date('Y-m-d', strtotime($res[fo_datetime]))?> </div>
                <div style="height:30px;"> 
                    <a href="./form_write.php?w=u&fo_no=<?=$res[fo_no]?>&page=<?=$page?>&fg_no=<?=$fg_no?>&st=<?=$st?>&sv=<?=$sv?>"><img src="<?=$g4[admin_path]?>/img/icon_modify.gif" align=absmiddle alt='����'></a>
                    <a href="javascript:void(book_del(<?=$res[fo_no]?>));"><img src="<?=$g4[admin_path]?>/img/icon_delete.gif" align=absmiddle alt='����'></a>
                    <a href="./sms_write.php?fo_no=<?=$res[fo_no]?>"><img src="<?=$g4[admin_path]?>/img/icon_view.gif" align=absmiddle alt='���ں�����'></a>
                </div>
            </td>
        </tr>
        </table>

    </td>

<?
    if ($count++ % 3 == 0) echo "</tr><tr>";
}
?>

</tr>
</table>

    </td>
</tr>
<tr><td height=1 colspan=<?=$colspan?> bgcolor=#CCCCCC></td></tr>
</table>

<p align=center style="margin:20px;">
<?=$paging?>
</p>

<div>

<div style="float:left;">
<select onchange="multi_update(this);" style="width:250px;">
<option value=''>������ ��ȣ�� ��� �ұ��?</option>
<option value=''>-------------------------------------</option>
<? for($i=0; $i<count($group); $i++) {?>
<option value="<?=$group[$i][fg_no]?>"> '<?=$group[$i][fg_name]?>' �׷����� �̵��մϴ�. </option>
<? } ?>
<option value=''>-------------------------------------</option>
<option value='del' style="color:red;">�����մϴ�.</option>
</select>

</div>

<div style="float:right;">
<form name=search_form method=get action=<?=$PHP_SELF?> style="margin:0; padding:0;">
<input type=hidden name=fg_no value=<?=$fg_no?>>
<select name=st>
<option value=all <?=$st=='all'?'selected':''?>>���� + �̸�Ƽ��</option>
<option value=name <?=$st=='name'?'selected':''?>>����</option>
<option value=content <?=$st=='content'?'selected':''?>>�̸�Ƽ��</option>
</select>
<input type=text size=20 name=sv value="<?=$sv?>">
<input type=submit value='��  ��' class=btn1>
</form>
</div>

</div>

<?
include_once("$g4[admin_path]/admin.tail.php");
?>