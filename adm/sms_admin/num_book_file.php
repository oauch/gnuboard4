<?
$sub_menu = "900900";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "�ڵ�����ȣ ����";

$no_group = sql_fetch("select * from $g4[sms4_book_group_table] where bg_no = 1");

$group = array();
$qry = sql_query("select * from $g4[sms4_book_group_table] where bg_no > 1 order by bg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

include_once("$g4[admin_path]/admin.head.php");
?>

<?=subtitle("�ڵ�����ȣ ��������(CSV) ��������")?>

<div style="background-color:#f8f8f8; padding:10px; margin-bottom:20px; line-height:25px;">

    <div style="height:30px;">
        ������ ����� �ڵ�����ȣ ����� �����ͺ��̽��� ������ �� �ֽ��ϴ�.
    </div>

    <div style="height:22px;">
        �������� �̸��� �ڵ�����ȣ �ΰ��� �������ּ���. ù��° ���κ��� ����˴ϴ�.
        <?=help("�� �ڵ�����ȣ�� ������(��)�� ���ԵǾ �ǰ� ���Ե��� �ʾƵ� �˴ϴ�.")?>
    </div>

    <div style="height:18px;">
        ���������� "���� > �ٸ� �̸����� ���� > �������� : CSV (��ǥ�� �и�) (*.CSV)" �� ������ �� ���ε� ���ּ���.
        <?=help("<img src='img/exfile02.gif'><img src='img/exfile03.gif'>", -370)?>
    </div>

    <div style="height:40px; color:#990000;">
        �� �۾��� �����ϱ� ���� ȸ������������Ʈ�� ���� �������ּ���.
    </div>

    <form name=upload_form method=post enctype=multipart/form-data target=hiddenframe style="margin:0; padding:0;">

    <div id="file_upload" style="margin-bottom:10px;">
        �׷켱�� : 
        <select name="upload_bg_no" id="upload_bg_no" style="width:135px; font-size:11px;" class=btn1>
        <option value=""> </option>
        <option value="1"> <?=$no_group[bg_name]?> (<?=number_format($no_group[bg_count])?>) </option>
        <? for ($i=0; $i<count($group); $i++) { ?>
        <option value="<?=$group[$i][bg_no]?>"> <?=$group[$i][bg_name]?> (<?=number_format($group[$i][bg_count])?>) </option>
        <?}?>
        </select>
    </div>

    <div style="margin-bottom:10px;">
        ���ϼ��� : <input type=file size=30 name=csv class=btn1 onchange="document.getElementById('upload_info').style.display='none';">
        <span id='upload_button'>
            <input type=button class=btn1 accesskey='s' tabindex=6 value=' ��������  ' onclick="upload();">
        </span>
        <span id='uploading' style="display:none;">
            ������ ���ε� ���Դϴ�. ��ø� ��ٷ��ּ���.
        </span>
    </div>

    <div id=upload_info style="display:none; margin-top:5px; border:1px solid #ccc; padding:10px; line-height:20px;"></div>
    <div id='register' style="display:none;">
        �ڵ�����ȣ�� DB�� ������ �Դϴ�. ��ø� ��ٷ��ּ���.
    </div>

    </form>

</div>


<?=subtitle("�ڵ�����ȣ ��������(xls) ��������")?>

<div style="background-color:#f8f8f8; padding:10px; line-height:25px;">

    <div style="margin-bottom:10px;">
        ����� �ڵ�����ȣ ����� ����(xls) ���Ϸ� �ٿ�ε� �� �� �ֽ��ϴ�.<br/>
        �ٿ�ε� �� �ڵ�����ȣ �׷��� �������ּ���.
    </div>

    <div style="margin-bottom:10px;">
        <input type=checkbox id=no_hp value=1> �ڵ��� ��ȣ ���� ȸ�� ���� <br>
        <input type=checkbox id=hyphen value=1> ������ '��' ����
    </div>

    <div style="margin-bottom:10px;">
        �׷켱�� : 
        <select name="download_bg_no" id="download_bg_no" style="width:135px; font-size:11px;" class=btn1>
        <option value=""> </option>
        <option value="all"> ��ü </option>
        <option value="1"> <?=$no_group[bg_name]?> (<?=number_format($no_group[bg_count])?>) </option>
        <? for ($i=0; $i<count($group); $i++) { ?>
        <option value="<?=$group[$i][bg_no]?>"> <?=$group[$i][bg_name]?> (<?=number_format($group[$i][bg_count])?>) </option>
        <?}?>
        </select>
        <input type=button class=btn1 accesskey='s' tabindex=6 value='  �ٿ�ε�  ' onclick=download()>
    </div>

</div>

<script language=javascript>

function upload(w)
{
    f = document.upload_form;

    if (typeof w == 'undefined') {
        document.getElementById('upload_button').style.display = 'none';
        document.getElementById('uploading').style.display = 'inline';
        document.getElementById('upload_info').style.display = 'none';
        f.action = 'num_book_file_upload.php?confirm=1';
    } else {
        document.getElementById('upload_button').style.display = 'none';
        document.getElementById('upload_info').style.display = 'none';
        document.getElementById('register').style.display = 'block';
        f.action = 'num_book_file_upload.php';
    }

    f.submit();
}

function download() 
{
    var bg_no = document.getElementById('download_bg_no');
    var no_hp = document.getElementById('no_hp');
    var hyphen = document.getElementById('hyphen');
    var par = '';

    if (!bg_no.value.length) {
        alert('�ٿ�ε� �� �ڵ�����ȣ �׷��� �������ּ���.');
        return;
    }

    if (no_hp.checked) no_hp = 1; else no_hp = 0;
    if (hyphen.checked) hyphen = 1; else hyphen = 0;

    par += '?bg_no=' + bg_no.value;
    par += '&no_hp=' + no_hp;
    par += '&hyphen=' + hyphen;

    hiddenframe.location.href = 'num_book_file_download.php' + par;
}
</script>

<div style="height:30px;"></div>

<?
include_once("$g4[admin_path]/admin.tail.php");
?>