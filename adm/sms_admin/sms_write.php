<?
$sub_menu = "800300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "���� ������";

include_once("$g4[admin_path]/admin.head.php");
?>

<? $admin_HadeNum = "07"; ?>


<div id="admin_sms_topbt">
<a href="config.php">SMS �⺻����</a>
<a href="sms_write.php" class="on">���� ������</a>
<a href="history_list.php">���۳���-�Ǻ�</a>
<a href="history_num.php">���۳���-��ȣ��</a>
<a href="history_member.php">���۳���-ȸ��</a>


<!--
<a href="num_group.php">�ڵ�����ȣ �׷�</a>
<a href="num_book.php">�ڵ�����ȣ ����</a>
<a href="num_book_file.php">�ڵ�����ȣ ����</a>
<a href="form_group.php">�̸�Ƽ�� �׷�</a>
<a href="form_list.php">�̸�Ƽ�� ����</a>
<a href="member_update.php">ȸ������������Ʈ</a>
<a href="upgrade.php">���׷��̵�</a>
-->
</div>


<div class="admin_title01">���� ������</div> <!--?=subtitle($g4[title])?-->

<div style="color:#999;">ȸ������ �ֱ� ������Ʈ : <?=$sms4[cf_datetime]?></div>

<form name=form_sms method=post action='sms_write_send.php' style="padding:0; margin:0;">
<input type=hidden name=send_list value=''>

<table border=0 cellpadding=0 cellspacing=10 width=100%>
<tr>
    <td width=25% valign=top align=center>
        <div style="width:160px; height:400px; background-color:#efefef; text-align:center; padding-top:10px;">

        <div style="margin:auto; width:145px; background-color:#F8F8F8; border:1px solid #ccc; text-align:center; margin-bottom:5px;">
        <div style="margin:auto; background-image:url('img/smsbg.gif'); width:120px; height:120px; margin-top:8px;">
            <textarea name='wr_message' id='wr_message' class=ed style="font-family:����ü; color:#000; line-height:15px;margin:auto; margin-top:20px; overflow: hidden; width:100px; height:88px; font-size: 9pt; border:0; background-color:#88C8F8;" cols="16" onkeyup="byte_check('wr_message', 'sms_bytes');" accesskey="m" itemname='�޼���'></textarea>
        </div>
        <div style="text-align:center; margin:5px 0 5px 0;">
            <span id=sms_bytes>0</span> / 2000 byte
        </div>
        </div>
        <div style="margin:10px 0 10px 0;">
            {�̸�} : �޴»�� �̸�
        </div>
        <table width="82" border="0" cellspacing="0" cellpadding="0" align=center>
        <tr> 
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c.gif" width="19" height="19" border=0></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c1.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c2.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c3.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c4.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c5.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c6.gif" width="18" height="19" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c7.gif" width="19" height="19" border="0"></a></td>
        </tr>
        <tr> 
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c8.gif" width="19" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c9.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c10.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c11.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c12.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c13.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c14.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c15.gif" width="19" height="17" border="0"></a></td>
        </tr>
        <tr> 
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c16.gif" width="19" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c17.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c18.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c19.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c20.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c21.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c22.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c23.gif" width="19" height="17" border="0"></a></td>
        </tr>
        <tr> 
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c24.gif" width="19" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c25.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c26.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c27.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c28.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c29.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c30.gif" width="18" height="17" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c31.gif" width="19" height="17" border="0"></a></td>
        </tr>
        <tr> 
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c32.gif" width="19" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c33.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c34.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c35.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c36.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c37.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c38.gif" width="18" height="18" border="0"></a></td>
            <td width="18"><a href="Javascript:add('��')"><img src="sms_img/c39.gif" width="19" height="18" border="0"></a></td>
        </tr>
        <tr>
            <td colspan=8 height=10></td>
        </tr>
        <tr> 
            <td width="36" colspan=2><a href="Javascript:add('*^^*')"><img src="sms_img/i1.gif" width="36" height="18" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('��.��')"><img src="sms_img/i2.gif" width="36" height="18" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('@_@')"><img src="sms_img/i3.gif" width="36" height="18" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('��_��')"><img src="sms_img/i4.gif" width="36" height="18" border="0"></a></td>
        </tr>
        <tr>
            <td width="36" colspan=2><a href="Javascript:add('�� ��')"><img src="sms_img/i5.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('��.��')"><img src="sms_img/i6.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('^_~��')"><img src="sms_img/i8.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('~o~')"><img src="sms_img/i7.gif" width="36" height="17" border="0"></a></td>
        </tr>
        <tr>
            <td width="36" colspan=2><a href="Javascript:add('��.��')"><img src="sms_img/i9.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('(!.!)')"><img src="sms_img/i10.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('��.��')"><img src="sms_img/i12.gif" width="36" height="17" border="0"></a></td>
            <td width="36" colspan=2><a href="Javascript:add('q.p')"><img src="sms_img/i11.gif" width="36" height="17" border="0"></a></td>
        </tr>
        <tr>
            <td width="73" colspan=4><a href="Javascript:add('��( \'\')��')"><img src="sms_img/i13.gif" width="73" height="17" border="0"></a></td>
            <td width="73" colspan=4><a href="Javascript:add('@)-)--')"><img src="sms_img/i14.gif" width="73" height="17" border="0"></a></td>
        </tr>
        <tr>
            <td width="73" colspan=4><a href="Javascript:add('��(^-^)��')"><img src="sms_img/i15.gif" width="73" height="18" border="0"></a></td>
            <td width="73" colspan=4><a href="Javascript:add('(*^-^*)')"><img src="sms_img/i16.gif" width="73" height="18" border="0"></a></td>
        </tr>
        </table>

        </div>

    </td>
    <td width=25% valign=top style="line-height:25px;">
        <div>
            <span style="float:left; font-weight:bold; ">�޴� ���</span>
            <span style="float:right;"> <input type=button value='���û���' class=btn1 onfocus=this.blur() onclick="hp_list_del()"> </span>
        </div>

        <select id=hp_list name=hp_list size=7 style="width:100%;"></select>

        <div style="background-color:#efefef; margin-top:2px; padding:5px;">
            <b>�̸�</b> : 
            <input type=text id=hp_name name=hp_name style="width:100px;" maxlength=20 onkeypress="if(event.keyCode==13) document.getElementById('hp_number').focus();">
            <br>
            <b>��ȣ</b> : 
            <input type=text id=hp_number name=hp_number style="width:100px;" maxlength=20 onkeypress="if(event.keyCode==13) hp_add()">
            <input type=button class=btn1 value='�߰�' onclick="hp_add()">
        </div>

        <div>
            <b>ȸ�Ź�ȣ</b> <br/>
            <input type=text name=wr_reply id=wr_reply required itemname='ȸ�Ź�ȣ' style="width:100%;" maxlength=20 value="<?=$sms4[cf_phone]?>">
        </div>

        <div style="margin-top:10px;">
            <b>��������</b> <input type=checkbox name=wr_booking onclick="booking(this.checked)"> 
            <div style="text-align:right; font-size:11px; padding:5px; background-color:#EFEFEF;">
            <select name="wr_by" id="wr_by" style="width:50px; font-size:11px;" disabled> 
            <option value="<?=date('Y')?>"> <?=date('Y')?> </option>
            <option value="<?=date('Y')+1?>"> <?=date('Y')+1?> </option>
            </select> ��
            <select name="wr_bm" id="wr_bm" style="width:40px; font-size:11px;" disabled>
            <? for ($i=1; $i<=12; $i++) { ?>
            <option value="<?=sprintf("%02d",$i)?>" <?=date('m')==$i?'selected':''?>> <?=sprintf("%02d",$i)?> </option>
            <? } ?>
            </select> ��
            <select name="wr_bd" id="wr_bd" style="width:40px; font-size:11px;" disabled>
            <? for ($i=1; $i<=31; $i++) { ?>
            <option value="<?=sprintf("%02d",$i)?>" <?=date('d')==$i?'selected':''?>> <?=sprintf("%02d",$i)?> </option>
            <? } ?>
            </select> ��
            <br/>

            <select name="wr_bh" id="wr_bh" style="width:40px; font-size:11px; margin-top:5px;" disabled>
            <? for ($i=0; $i<24; $i++) { ?>
            <option value="<?=sprintf("%02d",$i)?>" <?=date('H')+1==$i?'selected':''?>> <?=sprintf("%02d",$i)?> </option>
            <? } ?>
            </select> ��
            <select name="wr_bi" id="wr_bi" style="width:40px; font-size:11px;" disabled>
            <? for ($i=0; $i<=59; $i+=5) { ?>
            <option value="<?=sprintf("%02d",$i)?>"> <?=sprintf("%02d",$i)?> </option>
            <? } ?>
        </select> �� <br/>
        </div>

        <div style="margin-top:10px;">
            <b> �ߺ� ��ȣ �ϳ��� �߼� </b>
            <input type=checkbox name="wr_overlap">
            <img src='../../adm/img/icon_help.gif' border=0 width=15 height=15 align=absmiddle onclick="help('help01', 0, 0);" style='cursor:hand;'><div id='help01' style='position:absolute; display:none;'><div id='csshelp1'><div id='csshelp2'><div id='csshelp3' style="line-height:20px;">
            �޴� ��� ��� �� �ߺ��Ǵ� ��ȣ�� ������ ���� �ϳ��� �߼��ϰ� ������ �ߺ��Ǵ� ��ȣ�� �߼۸�Ͽ��� �����մϴ�.
            �ߺ��Ǵ� ��ȣ�� �ִ��� Ȯ���Ͻðڽ��ϱ�?<br>
            <input type=button value='�ߺ���ȣ Ȯ��' class=btn1 onclick="overlap_check()" style="margin-top:10px;">
            </div></div></div></div>		
        </div>
        
        <div style="text-align:center; margin-top:10px;">
            <input type=button class=btn1 accesskey='s' tabindex=6 value='  �� �� �� ��  ' style="width:200px; height:30px;" onfocus="this.blur()" onclick="send()">
            <!--&nbsp;<input type=button class=btn1 accesskey='l' tabindex=7 value='  �̸�����  '>-->
        </div>
    </td>
    <td width=50% valign=top style="line-height:25px;">
        
        <div style="clear:both; height:26px;">

        <div style="font-weight:bold; float:left;">�ڵ��� ��ȣ ���</div>

        <a href="javascript:void(book_change('book_level'));">
        <div id=book_level style="margin:0 2px 0 5px; float:right; width:50px; text-align:center; background-color:#fff; color:#000; cursor:pointer; border-top:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc; text-decoration:none;">����</div>
        </a>

        <a href="javascript:void(book_change('book_person'));">
        <div id=book_person style="margin-left:5px; float:right; width:50px; text-align:center; background-color:#fff; color:#000; cursor:pointer; border-top:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc; text-decoration:none;">����</div>
        </a>

        <a href="javascript:void(book_change('book_group'));">
        <div id=book_group style="float:right; width:50px; text-align:center; background-color:#ccc; color:#000; cursor:pointer; border-top:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc; text-decoration:none;">�׷�</div>
        </a>

        </div>

        <div style="padding:0; margin:0; width:400px; border-left:1px solid #ccc; border-bottom:1px solid #ccc; border-right:1px solid #ccc;">

            <div id=group_menu>
            <table cellpadding=0 cellspacing=0 width=400 border=0>
            <tr><td colspan=4 height=2 bgcolor=#cccccc></td></tr>
            <tr align=center bgcolor=#efefef>
                <td height=30 style="font-weight:bold; border-right:1px solid #fff;"> �׷��̸� </td>
                <td width=100 style="font-weight:bold; border-right:1px solid #fff;"> ���Ű��� </td>
                <td width=60 style="font-weight:bold; padding-right:15px;"> �߰� </td>
            </tr>
            <tr><td colspan=4 height=1 bgcolor=#CCCCCC></td></tr>
            </table>
            </div>

            <div id=person_menu style="display:none;">
            <table cellpadding=0 cellspacing=0 width=400 border=0>
            <tr><td colspan=6 height=2 bgcolor=#cccccc></td></tr>
            <tr align=center bgcolor=#efefef>
                <td width=30 height=30 style="font-weight:bold; border-right:1px solid #fff;"> <input type=checkbox id=all_checked onclick="num_book.book_all_checked(this.checked)"> </td>
                <td width=100 style="font-weight:bold; border-right:1px solid #fff;"> �̸� </td>
                <td style="font-weight:bold; border-right:1px solid #fff;"> �ڵ�����ȣ </td>
                <td width=70 style="font-weight:bold; border-right:1px solid #fff;"> ��� </td>
                <td width=60 style="font-weight:bold; padding-right:15px;"> �߰� </td>
            </tr>
            <tr><td colspan=6 height=1 bgcolor=#CCCCCC></td></tr>
            </table>
            </div>

            <div id=level_menu style="display:none;">
            <table cellpadding=0 cellspacing=0 width=400 border=0>
            <tr><td colspan=4 height=2 bgcolor=#cccccc></td></tr>
            <tr align=center bgcolor=#efefef>
                <td height=30 style="font-weight:bold; border-right:1px solid #fff;"> ���� </td>
                <td width=100 style="font-weight:bold; border-right:1px solid #fff;"> ���Ű��� </td>
                <td width=60 style="font-weight:bold; padding-right:15px;"> �߰� </td>
            </tr>
            <tr><td colspan=4 height=1 bgcolor=#CCCCCC></td></tr>
            </table>
            </div>

            <iframe id=num_book name=num_book src='./sms_write_group.php' border=0 frameborder=0 width=400 height=320 scrolling=yes align=center></iframe>
        </div>
        <div style="color:gray">
        �� ��������� ����� ��µ˴ϴ�.
        </div>

    </td>
</tr>
<tr>
    <td colspan=3>

        <div style="font-weight:bold; height:25px;">�̸�Ƽ�� ���</div>

        <div style="height:470px;">
        <iframe id=form_list name=form_list src="sms_write_form.php" border=0 frameborder=0 width=100%></iframe>
        </div>

    </td>
</tr>
</table>

</form>

<script language="JavaScript">

function overlap_check() 
{
    var hp_list = document.getElementById('hp_list');
    var hp_number = document.getElementById('hp_number');
    var list = '';

    if (hp_list.length < 1) {
        alert('�޴� ����� �Է����ּ���.');
        hp_number.focus();
        return;
    }

    for (i=0; i<hp_list.length; i++)
        list += hp_list.options[i].value + '/';
    
    document.form_sms.target = 'hiddenframe';
    document.form_sms.action = 'sms_write_overlap_check.php';
    document.form_sms.send_list.value = list;
    document.form_sms.submit();
}


function send() 
{
    var hp_list = document.getElementById('hp_list');
    var wr_message = document.getElementById('wr_message');
    var hp_number = document.getElementById('hp_number');
    var list = '';

    if (!wr_message.value) {
        alert('�޼����� �Է����ּ���.');
        wr_message.focus();
        return;
    }

    if (hp_list.length < 1) {
        alert('�޴� ����� �Է����ּ���.');
        hp_number.focus();
        return;
    }

    for (i=0; i<hp_list.length; i++)
        list += hp_list.options[i].value + '/';
    
    w = document.body.clientWidth/2 - 200;
    h = document.body.clientHeight/2 - 100;
    act = window.open('sms_ing.php', 'act', 'width=300, height=200, left=' + w + ', top=' + h);
    act.focus();

    document.form_sms.target = '';
    document.form_sms.action = 'sms_write_send.php';
    document.form_sms.send_list.value = list;
    document.form_sms.submit();
}

function hp_add()
{
    var hp_number = document.getElementById('hp_number');
    var hp_name = document.getElementById('hp_name');
    var hp_list = document.getElementById('hp_list');

    var pattern = /^01[016789][0-9]{3,4}[0-9]{4}$/;
    var pattern2 = /^01[016789]-[0-9]{3,4}-[0-9]{4}$/;

    if(!pattern.test(hp_number.value) && !pattern2.test(hp_number.value)) { 
        alert("�ڵ�����ȣ ������ �ùٸ��� �ʽ��ϴ�.");
        hp_number.select();
        return;
    }
    
    if (!pattern2.test(hp_number.value)) {
        hp_number.value = hp_number.value.replace(new RegExp("(01[016789])([0-9]{3,4})([0-9]{4})"), "$1-$2-$3");
    }

    var item = '';
    if (trim(hp_name.value))
        item = hp_name.value + ' (' + hp_number.value + ')';
    else
        item = hp_number.value;
    
    var value = 'h,' + hp_name.value + ':' + hp_number.value;

    for (i=0; i<hp_list.length; i++) {
        if (hp_list[i].value == value) {
            alert('�̹� ���� ����� �ֽ��ϴ�.');
            return;
        }
    }

    hp_list.options[hp_list.length] = new Option(item, value);

    hp_number.value = '';
    hp_name.value = '';
    hp_name.select();
}

function hp_list_del()
{
    var hp_list = document.getElementById('hp_list');

    if (hp_list.selectedIndex < 0) {
        alert('������ ����� �������ּ���.');
        return;
    }

    hp_list.options[hp_list.selectedIndex] = null;
}

function book_change(id)
{
    var book_group  = document.getElementById('book_group');
    var book_person = document.getElementById('book_person');
    var num_book    = document.getElementById('num_book');
    var group_menu  = document.getElementById('group_menu');
    var person_menu = document.getElementById('person_menu');

    if (id == 'book_group') 
    {
        book_group.style.backgroundColor    = '#ccc';
        book_person.style.backgroundColor   = '#fff';
        book_level.style.backgroundColor    = '#fff';

        group_menu.style.display            = 'block';
        person_menu.style.display           = 'none';
        level_menu.style.display            = 'none';

        num_book.src = './sms_write_group.php';
    } 
    else if (id == 'book_person')
    {
        book_group.style.backgroundColor    = '#fff';
        book_person.style.backgroundColor   = '#ccc';
        book_level.style.backgroundColor    = '#fff';
        
        group_menu.style.display            = 'none';
        person_menu.style.display           = 'block';
        level_menu.style.display            = 'none';

        num_book.src = './sms_write_person.php';
    }
    else if (id == 'book_level')
    {
        book_group.style.backgroundColor    = '#fff';
        book_person.style.backgroundColor   = '#fff';
        book_level.style.backgroundColor    = '#ccc';

        group_menu.style.display            = 'none';
        person_menu.style.display           = 'none';
        level_menu.style.display            = 'block';

        num_book.src = './sms_write_level.php';
    }
}

function booking(val) 
{
    if (val)
    {
        document.getElementById('wr_by').disabled = false;
        document.getElementById('wr_bm').disabled = false;
        document.getElementById('wr_bd').disabled = false;
        document.getElementById('wr_bh').disabled = false;
        document.getElementById('wr_bi').disabled = false;
    }
    else
    {
        document.getElementById('wr_by').disabled = true;
        document.getElementById('wr_bm').disabled = true;
        document.getElementById('wr_bd').disabled = true;
        document.getElementById('wr_bh').disabled = true;
        document.getElementById('wr_bi').disabled = true;
    }
}

function add(str) {
    var conts = document.getElementById('wr_message');
    var bytes = document.getElementById('sms_bytes');
	conts.focus();
	conts.value+=str; 
    byte_check('wr_message', 'sms_bytes');
	return;
}

function byte_check(wr_message, sms_bytes)
{
    var conts = document.getElementById(wr_message);
    var bytes = document.getElementById(sms_bytes);

    var i = 0;
    var cnt = 0;
    var exceed = 0;
    var ch = '';

    for (i=0; i<conts.value.length; i++) 
    {
        ch = conts.value.charAt(i);
        if (escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }

    bytes.innerHTML = cnt;

    if (cnt > 2000) 
    {
        exceed = cnt - 2000;
        alert('�޽��� ������ 2000����Ʈ�� ������ �����ϴ�.\n\n�ۼ��Ͻ� �޼��� ������ '+ exceed +'byte�� �ʰ��Ǿ����ϴ�.\n\n�ʰ��� �κ��� �ڵ����� �����˴ϴ�.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = conts.value;
        for (i=0; i<tmp.length; i++) 
        {
            ch = tmp.charAt(i);
            if (escape(ch).length > 4) {
                tcnt += 2;
            } else {
                tcnt += 1;
            }

            if (tcnt > 80) {
                tmp = tmp.substring(0,i);
                break;
            } else {
                xcnt = tcnt;
            }
        }
        conts.value = tmp;
        bytes.innerHTML = xcnt;
        return;
    }
}

<?
if ($bk_no) {
$row = sql_fetch("select * from $g4[sms4_book_table] where bk_no='$bk_no'");
?>

var hp_list = parent.document.getElementById('hp_list');
var item    = "<?=$row[bk_name]?> (<?=$row[bk_hp]?>)";
var value   = 'p,<?=$row[bk_no]?>';

hp_list.options[hp_list.length] = new Option(item, value);

<? } ?>

<?
if ($fo_no) {
    $row = sql_fetch("select * from $g4[sms4_form_table] where fo_no='$fo_no'");
    $fo_content = str_replace("\r\n", "\\n", $row[fo_content]);
    echo "add(\"$fo_content\");";
}
?>

byte_check('wr_message', 'sms_bytes');
document.getElementById('wr_message').focus();
</script>


<?

if ($wr_no) 
{
    // �޼����� ȸ�Ź�ȣ
    $row = sql_fetch(" select * from $g4[sms4_write_table] where wr_no = '$wr_no' ");

    echo "<script language=javascript>\n";
    echo "var hp_list = document.getElementById('hp_list');\n";
    //echo "add(\"$row[wr_message]\");\n";
    $wr_message = str_replace('"', '\"', $row[wr_message]);
    $wr_message = str_replace("\r\n", "\\n", $wr_message);
    echo "add(\"$wr_message\");\n";
    echo "document.getElementById('wr_reply').value = '$row[wr_reply]';\n";

    // ȸ�����
    $sql = " select * from $g4[sms4_history_table] where wr_no = '$wr_no' and bk_no > 0 ";
    $qry = sql_query($sql);
    $tot = mysql_num_rows($qry);

    if ($tot > 0) {

        $str = '�����۱׷� ('.number_format($tot).'��)';
        $val = 'p,';

        while ($row = sql_fetch_array($qry)) 
        {
            $val .= $row[bk_no].',';
        }

        echo "hp_list.options[hp_list.length] = new Option('$str', '$val');\n";
    }

    // ��ȸ�� ���
    $sql = " select * from $g4[sms4_history_table] where wr_no = '$wr_no' and bk_no = 0 ";
    $qry = sql_query($sql);
    $tot = mysql_num_rows($qry);

    if ($tot > 0) 
    {
        while ($row = sql_fetch_array($qry)) 
        {
            $str = "$row[hs_name] ($row[hs_hp])";
            $val = "h,$row[hs_name]:$row[hs_hp]";
            echo "hp_list.options[hp_list.length] = new Option('$str', '$val');\n";
        }
    }
    echo "</script>\n";
}


include_once("$g4[admin_path]/admin.tail.php");
?>
