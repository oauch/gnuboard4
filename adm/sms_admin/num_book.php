<?
$sub_menu = "800800";
include_once("./_common.php");

$page_size = 20;
$colspan = 9;

auth_check($auth[$sub_menu], "r");

$g4[title] = "�ڵ�����ȣ ����";

if (!$page) $page = 1;

if (is_numeric($bg_no)) 
    $sql_group = " and bg_no='$bg_no' ";
else
    $sql_group = "";

if ($st == 'all') {
    $sql_search = "and (bk_name like '%{$sv}%' or bk_hp like '%{$sv}%')";
} else if ($st == 'name') {
    $sql_search = "and bk_name like '%{$sv}%'";
} else if ($st == 'hp') {
    $sql_search = "and bk_hp like '%{$sv}%'";
} else {
    $sql_search = '';
}

if ($ap > 0)
    $sql_korean = korean_index('bk_name', $ap-1);
else {
    $sql_korean = '';
    $ap = 0;
}

if ($no_hp == 'yes') {
    set_cookie('cookie_no_hp', 'yes', 60*60*24*365);
    $no_hp_checked = 'checked';
} else if ($no_hp == 'no') {
    set_cookie('cookie_no_hp', '', 0);
    $no_hp_checked = '';
} else {
    if (get_cookie('cookie_no_hp') == 'yes')
        $no_hp_checked = 'checked';
    else
        $no_hp_checked = '';
}

if ($no_hp_checked == 'checked')
    $sql_no_hp = "and bk_hp <> ''";

$total_res = sql_fetch("select count(*) as cnt from $g4[sms4_book_table] where 1 $sql_group $sql_search $sql_korean $sql_no_hp");
$total_count = $total_res[cnt];

$total_page = (int)($total_count/$page_size) + ($total_count%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$paging = get_paging(10, $page, $total_page, "num_book.php?bg_no=$bg_no&st=$st&sv=$sv&ap=$ap&page="); 

$vnum = $total_count - (($page-1) * $page_size);

$res = sql_fetch("select count(*) as cnt from $g4[sms4_book_table] where bk_receipt=1 $sql_group $sql_search $sql_korean $sql_no_hp");
$receipt_count = $res[cnt];
$reject_count = $total_count - $receipt_count;

$res = sql_fetch("select count(*) as cnt from $g4[sms4_book_table] where mb_id='' $sql_group $sql_search $sql_korean $sql_no_hp");
$no_member_count = $res[cnt];
$member_count = $total_count - $no_member_count;

$no_group = sql_fetch("select * from $g4[sms4_book_group_table] where bg_no = 1");

$group = array();
$qry = sql_query("select * from $g4[sms4_book_group_table] where bg_no>1 order by bg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

include_once("$g4[admin_path]/admin.head.php");
?>

<script language=javascript>

function book_all_checked(chk) 
{
    var bk_no = document.getElementsByName('bk_no');

    if (chk) {
        for (var i=0; i<bk_no.length; i++) {
            bk_no[i].checked = true;
        }
    } else {
        for (var i=0; i<bk_no.length; i++) {
            bk_no[i].checked = false;
        }
    }
}

function book_del(bk_no)
{
    if (confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n�׷��� �����Ͻðڽ��ϱ�?"))
        hiddenframe.location.href = "./num_book_update.php?w=d&bk_no=" + bk_no + "&page=<?=$page?>&bg_no=<?=$bg_no?>&st=<?=$st?>&sv=<?=$sv?>&ap=<?=$ap?>";
}

function multi_update(sel)
{
    var bk_no = document.getElementsByName('bk_no');
    var ck_no = '';
    var count = 0;

    if (!sel.value) {
        sel.selectedIndex = 0;
        return;
    }

    for (i=0; i<bk_no.length; i++) {
        if (bk_no[i].checked==true) {
            count++;
            ck_no += bk_no[i].value + ',';
        }
    }

    if (!count) {
        alert('�ϳ��̻� �������ּ���.');
        sel.selectedIndex = 0;
        return;
    }

    if (sel.value == 'del') {
        if (!confirm("������ �ڵ�����ȣ�� �����մϴ�.\n\n��ȸ���� �����˴ϴ�.\n\nȸ���� �����Ϸ��� ȸ������ �޴��� �̿����ּ���.\n\n�����Ͻðڽ��ϱ�?")) 
        {
            sel.selectedIndex = 0;
            return;
        }
    } else if (!confirm("������ �ڵ�����ȣ�� " + sel.options[sel.selectedIndex].innerHTML + "\n\n�����Ͻðڽ��ϱ�?")) {
        sel.selectedIndex = 0;
        return;
    }

    hiddenframe.location.href = "num_book_multi_update.php?w=" + sel.value + "&ck_no=" + ck_no;
}

function no_hp_click(val)
{
    var url = './num_book.php?bg_no=<?=$bg_no?>&st=<?=$st?>&sv=<?=$sv?>';

    if (val == true)
        location.href = url + '&no_hp=yes';
    else
        location.href = url + '&no_hp=no';
}
</script>

<?=subtitle($g4[title])?>

<table width=100% cellpadding=0 cellspacing=0 height=30 border=0>
<tr>
    <td height=30 colspan=2>
        <form style="margin:0; padding:0;">
        <select name="bg_no" onchange="location.href='<?=$PHP_SELF?>?bg_no='+this.value;">
        <option value="" <?=$bg_no?'':'selected'?>> ��ü </option>
        <option value="<?=$no_group[bg_no]?>" <?=$bg_no==$no_group[bg_no]?'selected':''?>> <?=$no_group[bg_name]?> (<?=number_format($no_group[bg_count])?> ��) </option>
        <? for($i=0; $i<count($group); $i++) {?>
        <option value="<?=$group[$i][bg_no]?>" <?=($bg_no==$group[$i][bg_no])?'selected':''?>> <?=$group[$i][bg_name]?> (<?=number_format($group[$i][bg_count])?> ��) </option>
        <? } ?>
        </select>
        <input type=checkbox name=no_hp onclick="no_hp_click(this.checked)" <?=$no_hp_checked?>> �ڵ��� �����ڸ� ����
        </form>
    </td>
</tr>
<tr>
    <td height=30 style="color:#999;">
        ȸ������ �ֱ� ������Ʈ : <?=$sms4[cf_datetime]?>
    </td>
    <td align=right style="color:#999;">
        �� �Ǽ� : <?=number_format($total_count)?> /
        ȸ�� : <?=number_format($member_count)?> /
        ��ȸ�� : <?=number_format($no_member_count)?> /
        ���� : <?=number_format($receipt_count)?> /
        �ź� : <?=number_format($reject_count)?>
    </td>
</tr>
</table>

<!--
<?
$hangul = array('��ü', '��', '��', '��', '��', '��', '��', '��', '��', '��', '��', 'ī', 'Ÿ', '��', '��');
?>
<table border=0 cellpadding=0 cellspacing=0 height=30>
<tr><td colspan=15 height=2 bgcolor=#0E87F9></td></tr>
<tr>
<?for ($i=0; $i<15; $i++) {?>
<?if ($i == $ap) $bgcolor = '#C1E0FD'; else $bgcolor = '#ffffff'; ?>
<?if ($i == 0) $width = 60; else $width = 60; ?>
    <td align=center bgcolor='<?=$bgcolor?>' width=<?=$width?> onclick="location.href='./num_book.php?bg_no=<?=$bg_no?>&st=<?=$st?>&sv=<?=$sv?>&ap=<?=$i?>'" style="cursor:pointer;">
        <?=$hangul[$i]?>
    </td>
<?}?>
</tr>
</table>
-->

<table cellpadding=0 cellspacing=0 width=100% border=0>
<tbody align=center>
<tr><td colspan=<?=$colspan?> height=2 bgcolor=#0E87F9></td></tr>
<tr class=ht>
    <td width=60 style="font-weight:bold;"> ��ȣ </td>
    <td width=50 style="font-weight:bold;"> <input type=checkbox onclick="book_all_checked(this.checked)"> </td>
    <td width=100 style="font-weight:bold;"> �׷� </td>
    <td width=100 style="font-weight:bold;"> �̸� </td>
    <td style="font-weight:bold;"> �ڵ��� </td>
    <td width=50 style="font-weight:bold;"> ���� </td>
    <td width=50 style="font-weight:bold;"> ��� </td>
    <td width=130 style="font-weight:bold;"> ������Ʈ </td>
    <td width=120> 
        <input type=image src="<?=$g4[admin_path]?>/img/icon_insert.gif" align=absmiddle alt='�߰�' onclick="location.href='./num_book_write.php?page=<?=$page?>&bg_no=<?=$bg_no?>';" accesskey='w'>
    </td>
</tr>
<tr><td colspan=<?=$colspan?> height=1 bgcolor=#CCCCCC></td></tr>
<? if (!$total_count) { ?>
<tr>
    <td align=center height=100 colspan=<?=$colspan?> style="color:#999;"> 
        �����Ͱ� �����ϴ�. 
    </td>
</tr>
<?
}
$line = 0;
$qry = sql_query("select * from $g4[sms4_book_table] where 1 $sql_group $sql_search $sql_korean $sql_no_hp order by bk_no desc limit $page_start, $page_size");
while($res = sql_fetch_array($qry)) 
{
    if ($line++%2) 
        $bgcolor = '#F8F8F8'; 
    else 
        $bgcolor = '#ffffff';

    $tmp = sql_fetch("select bg_name from $g4[sms4_book_group_table] where bg_no='$res[bg_no]'");
    $group_name = $tmp[bg_name];
?>
<tr bgcolor='<?=$bgcolor?>' height=30>
    <td> <?=number_format($vnum--)?> </td>
    <td> <input type=checkbox name=bk_no value='<?=$res[bk_no]?>'> </td>
    <td> <span style="overflow:hidden; width:95px;"><?=$group_name?></span> </td>
    <td> <span style="overflow:hidden; width:95px;"><?=$res[bk_name]?></span> </td>
    <td> <?=$res[bk_hp]?> </td>
    <td> <?=$res[bk_receipt] ? '<font color=blue>����</font>' : '<font color=red>�ź�</font>'?> </td>
    <!--<td> <?=$res[bk_receipt] ? '��' : ''?> </td>-->
    <td> <?=$res[mb_id] ? 'ȸ��' : '��ȸ��'?> </td>
    <td> <?=$res[bk_datetime]?> </td>
    <td> 
        <a href="./num_book_write.php?w=u&bk_no=<?=$res[bk_no]?>&page=<?=$page?>&bg_no=<?=$bg_no?>&st=<?=$st?>&sv=<?=$sv?>&ap=<?=$ap?>"><img src="<?=$g4[admin_path]?>/img/icon_modify.gif" align=absmiddle alt='����'></a>
        <a href="javascript:void(book_del(<?=$res[bk_no]?>));"><img src="<?=$g4[admin_path]?>/img/icon_delete.gif" align=absmiddle alt='����'></a>
        <a href="./sms_write.php?bk_no=<?=$res[bk_no]?>"><img src="<?=$g4[admin_path]?>/img/icon_view.gif" align=absmiddle alt='���ں�����'></a>
        <a href="./history_num.php?st=bk_no&sv=<?=$res[bk_no]?>"><img src="<?=$g4[admin_path]?>/img/icon_group.gif" align=absmiddle alt='���۳���'></a>
    </td>
</tr>
<?}?>

<tr><td colspan=<?=$colspan?> height=1 bgcolor=#CCCCCC></td></tr>
</tbody>
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
<option value="m:<?=$group[$i][bg_no]?>"> '<?=$group[$i][bg_name]?>' �׷����� [�̵�]�մϴ�. </option>
<? } ?>
<option value=''>-------------------------------------</option>
<? for($i=0; $i<count($group); $i++) {?>
<option value="c:<?=$group[$i][bg_no]?>"> '<?=$group[$i][bg_name]?>' �׷����� [����]�մϴ�. </option>
<? } ?>
<option value=''>-------------------------------------</option>
<option value='receipt' style="color:blue;">������� �մϴ�.</option>
<option value='reject' style="color:red;">���Űź� �մϴ�.</option>
<option value=''>-------------------------------------</option>
<option value='del' style="color:red;">�����մϴ�.</option>
</select>

</div>

<div style="float:right;">
<form name=search_form method=get action=<?=$PHP_SELF?> style="margin:0; padding:0;">
<input type=hidden name=bg_no value=<?=$bg_no?>>
<select name=st>
<option value=all <?=$st=='all'?'selected':''?>>�̸� + �ڵ�����ȣ</option>
<option value=name <?=$st=='name'?'selected':''?>>�̸�</option>
<option value=hp <?=$st=='hp'?'selected':''?>>�ڵ�����ȣ</option>
</select>
<input type=text size=20 name=sv value="<?=$sv?>">
<input type=submit value='��  ��' class=btn1>
</form>
</div>

</div>

<?
include_once("$g4[admin_path]/admin.tail.php");
?>