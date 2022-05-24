<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

if ($is_dhtml_editor) {
    include_once("$g4[path]/lib/cheditor4.lib.php");
    echo "<script src='$g4[cheditor4_path]/cheditor.js'></script>";
    echo cheditor1('wr_content', '100%', '250');
}

if($w=='' && $f_date && $f_date) {
	$f_date = $f_date;
	$t_date = $t_date;
}else{
	$f_date = $link[1];
	$t_date = $link[2];
}
   if(strlen($f_date) > 0 && strlen($t_date) > 0) { // ���� ��¥ argument �� ������..
     $f_year = (int)substr($f_date,0,4);$f_mon = (int)substr($f_date,4,2);$f_day = (int)substr($f_date,6,2);
     $t_year = (int)substr($t_date,0,4);$t_mon = (int)substr($t_date,4,2);$t_day = (int)substr($t_date,6,2);
   }

   else { // ���� ��¥ argument �� ���ų�, �̻��� �� ���ó�¥�� ����...
     $today = getdate();
     $f_mon = $today['mon'];$f_day = $today['mday'];$f_year = $today['year'];
     $t_mon = $today['mon'];$t_day = $today['mday'];$t_year = $today['year'];

     $f_date = $t_year.sprintf("%02d",$t_mon).$t_day;
     $t_date = $t_year.sprintf("%02d",$t_mon).$t_day;
   }
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/style.css" type="text/css">
<div style="height:14px; line-height:1px; font-size:1px;">&nbsp;</div>

<style type="text/css">
.write_head { height:30px; text-align:center; color:#8492A0; }
.field { border:1px solid #ccc; }
</style>

<script type="text/javascript">
// ���ڼ� ����
var char_min = parseInt(<?=$write_min?>); // �ּ�
var char_max = parseInt(<?=$write_max?>); // �ִ�
</script>

<form name="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null>
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=mode      value="<?=$mode?>">
<input type=hidden name=page     value="<?=$page?>">

<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0><tr><td>


<div style="border:1px solid #ddd; height:34px; background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x;">
<div style="font-weight:bold; font-size:14px; margin:7px 0 0 10px;">:: <?=$title_msg?> ::</div>
</div>
<div style="height:3px; background:url(<?=$board_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;"></div>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup width=90>
<colgroup width=''>
<tr><td colspan="2" style="background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x; height:3px;"></td></tr>
<? if ($is_name) { ?>
<tr>
    <td class=write_head>�� ��</td>
    <td><input class='ed' maxlength=20 size=15 name=wr_name itemname="�̸�" required value="<?=$name?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_password) { ?>
<tr>
    <td class=write_head>�н�����</td>
    <td><input class='ed' type=password maxlength=20 size=15 name=wr_password itemname="�н�����" <?=$password_required?>></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_email) { ?>
<tr>
    <td class=write_head>�̸���</td>
    <td><input class='ed' maxlength=100 size=50 name=wr_email email itemname="�̸���" value="<?=$email?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_homepage) { ?>
<tr>
    <td class=write_head>Ȩ������</td>
    <td><input class='ed' size=50 name=wr_homepage itemname="Ȩ������" value="<?=$homepage?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<?
$option = "";
$option_hidden = "";
if ($is_notice || $is_html || $is_secret || $is_mail) {
    $option = "";
    if ($is_notice) {
        $option .= "<input type=checkbox name=notice value='1' $notice_checked>����&nbsp;";
    }

    if ($is_html) {
        if ($is_dhtml_editor) {
            $option_hidden .= "<input type=hidden value='html1' name='html'>";
        } else {
            $option .= "<input onclick='html_auto_br(this);' type=checkbox value='$html_value' name='html' $html_checked><span class=w_title>html</span>&nbsp;";
        }
    }

    if ($is_secret) {
        if ($is_admin || $is_secret==1) {
            $option .= "<input type=checkbox value='secret' name='secret' $secret_checked><span class=w_title>��б�</span>&nbsp;";
        } else {
            $option_hidden .= "<input type=hidden value='secret' name='secret'>";
        }
    }

    if ($is_mail) {
        $option .= "<input type=checkbox value='mail' name='mail' $recv_email_checked>�亯���Ϲޱ�&nbsp;";
    }
}

echo $option_hidden;
if ($option) {
?>
<tr>
    <td class=write_head>�� ��</td>
    <td><?=$option?></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_category) { ?>
<tr>
    <td class=write_head>�� ��</td>
    <td><select name=ca_name required itemname="�з�"><option value="">�����ϼ���<?=$category_option?></select></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<tr>
    <td class=write_head>�� ��</td>
    <td><input class='ed' style="width:100%;" name=wr_subject id="wr_subject" itemname="����" required value="<?=$subject?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>

<tr>
    <td class=write_head>�� ��</td>
    <td><input class='ed' style="width:100%;" name=wr_2 id="wr_2" itemname="���" required value="<?=$write[wr_2]?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>

  <tr>
    <td class=write_head>�� ��</td>
    <td><input name='wr_3' type="radio" value="1" <? if ($write[wr_3] == '1') echo'checked';?>> <img src='<?=$board_skin_path?>/img/dia_diary.png' border=0 align=absmiddle> �ϱ� <input name='wr_3' type="radio" value="2" <? if ($write[wr_3] == '2') echo'checked';?>> <img src='<?=$board_skin_path?>/img/dia_memorial.png' border=0 align=absmiddle> ��� <input name='wr_3' type="radio" value="3" <? if ($write[wr_3] == '3') echo'checked';?>> <img src='<?=$board_skin_path?>/img/dia_schedual.png' border=0 align=absmiddle> ���� <input name='wr_3' type="radio" value="4" <? if ($write[wr_3] == '4') echo'checked';?>> <img src='<?=$board_skin_path?>/img/dia_review.png' border=0 align=absmiddle> �޸�</td></tr>
  <tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<?
$start_date = $link[1];
$end_date   = $link[2];

echo "<!--<script language='javascript'>alert('$link[1]$link[2]');</script>-->";

$start_date_y = substr($start_date,0,4);
$start_date_m = substr($start_date,4,2);
$start_date_d = substr($start_date,6,2);

$end_date_y = substr($end_date,0,4);
$end_date_m = substr($end_date,4,2);
$end_date_d = substr($end_date,6,2);

echo "<!--<script language='javascript'>alert('$start_date$end_date');</script>-->";
?>

<?
if (strlen($start_date) == 8) { // ������ ����ִ� ���� ���� ��쿣 ������ ���� �̿��Ѵ�.
	//(int)
	$f_year =(int)$start_date_y;
	$f_mon  =(int)$start_date_m;
	$f_day  = (int)$start_date_d;

    echo "<!--<script language='javascript'>alert('$f_year$f_mon$f_day');</script>-->";

	$t_year = (int)$end_date_y;
	$t_mon  =(int)$end_date_m;
	$t_day  = (int)$end_date_d;

	echo "<!--<script language='javascript'>alert('$t_year$t_mon$t_day');</script>-->";
}

   // ��¥ ���� listbox html ���� ����
   $lastday=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
   if ($year%4 == 0) $lastday[2] = 29;
   for ($i=1;$i <= $lastday[$t_mon];$i++) {
     $temp_year = $t_year - 4 + $i;
     if($i <= 7) { // �⵵ ���� listbox html ����
       if ($temp_year==$f_year) { $htm_fyear .= "      <OPTION value=$temp_year selected>$temp_year</OPTION>\n"; }
       else { $htm_fyear .= "      <OPTION value=$temp_year>$temp_year</OPTION>\n"; }
       if ($temp_year==$t_year) { $htm_tyear .= "      <OPTION value=$temp_year selected>$temp_year</OPTION>\n"; }
       else { $htm_tyear .= "      <OPTION value=$temp_year>$temp_year</OPTION>\n"; }
     }
     if($i <=12) { // �� ���� listbox html ����
       $temp_mon = sprintf ("%02d",$i);
       if ($i==$f_mon) { $htm_fmon .= "      <OPTION value=$temp_mon selected>$i</OPTION>\n"; }
       else { $htm_fmon .= "      <OPTION value=$temp_mon>$i</OPTION>\n"; }
       if ($i==$t_mon) { $htm_tmon .= "      <OPTION value=$temp_mon selected>$i</OPTION>\n"; }
       else { $htm_tmon .= "      <OPTION value=$temp_mon>$i</OPTION>\n"; }
     }
     // �� ���� listbox html ����
     $temp_day = sprintf ("%02d",$i);
     if ($i==$f_day) { $htm_fday .= "      <OPTION value=$temp_day selected>$i</OPTION>\n"; }
     else { $htm_fday .= "      <OPTION value=$temp_day>$i</OPTION>\n"; }
     if ($i==$t_day) { $htm_tday .= "      <OPTION value=$temp_day selected>$i</OPTION>\n"; }
     else { $htm_tday .= "      <OPTION value=$temp_day>$i</OPTION>\n"; }
   }
   // ��¥ ���� listbox html ���� ��
?>

  <tr>
    <td class=write_head>���� ���۽ð�</td>
    <td>
	<SELECT onchange="javascript:resetday('from');" name=fyear><?=$htm_fyear?></SELECT> ��
	<?//echo "<script language='javascript'>alert('$htm_fyear');</script>";?>

	<SELECT onchange="javascript:resetday('from');" name=fmon><?=$htm_fmon?></SELECT> ��

	<SELECT onchange="javascript:resetday('from');" name=fday><?=$htm_fday?></SELECT> ��
	<input type=hidden name='wr_link1' itemname='��ũ #1' value='<?=$f_date?>' class='input' size=60>

	<select name='wr_6' itemname='���۽ð�'>
      <option value=''>���۽ð�����</option>
      <option value='07:00' <? if($write[wr_6] == "07:00") echo "selected"; ?>>07:00</option>
      <option value='07:30' <? if($write[wr_6] == "07:30") echo "selected"; ?>>07:30</option>
      <option value='08:00' <? if($write[wr_6] == "08:00") echo "selected"; ?>>08:00</option>
      <option value='08:30' <? if($write[wr_6] == "08:30") echo "selected"; ?>>08:30</option>
      <option value='09:00' <? if($write[wr_6] == "09:00") echo "selected"; ?>>09:00</option>
      <option value='09:30' <? if($write[wr_6] == "09:30") echo "selected"; ?>>09:30</option>
      <option value='10:00' <? if($write[wr_6] == "10:00") echo "selected"; ?>>10:00</option>
      <option value='10:30' <? if($write[wr_6] == "10:30") echo "selected"; ?>>10:30</option>
      <option value='11:00' <? if($write[wr_6] == "11:00") echo "selected"; ?>>11:00</option>
      <option value='11:30' <? if($write[wr_6] == "11:30") echo "selected"; ?>>11:30</option>
      <option value='12:00' <? if($write[wr_6] == "12:00") echo "selected"; ?>>12:00</option>
      <option value='12:30' <? if($write[wr_6] == "12:30") echo "selected"; ?>>12:30</option>
      <option value='13:00' <? if($write[wr_6] == "13:00") echo "selected"; ?>>13:00</option>
      <option value='13:30' <? if($write[wr_6] == "13:30") echo "selected"; ?>>13:30</option>
      <option value='14:00' <? if($write[wr_6] == "14:00") echo "selected"; ?>>14:00</option>
      <option value='14:30' <? if($write[wr_6] == "14:30") echo "selected"; ?>>14:30</option>
      <option value='15:00' <? if($write[wr_6] == "15:00") echo "selected"; ?>>15:00</option>
      <option value='15:30' <? if($write[wr_6] == "15:30") echo "selected"; ?>>15:30</option>
      <option value='16:00' <? if($write[wr_6] == "16:00") echo "selected"; ?>>16:00</option>
      <option value='16:30' <? if($write[wr_6] == "16:30") echo "selected"; ?>>16:30</option>
      <option value='17:00' <? if($write[wr_6] == "17:00") echo "selected"; ?>>17:00</option>
      <option value='17:30' <? if($write[wr_6] == "17:30") echo "selected"; ?>>17:30</option>
      <option value='18:00' <? if($write[wr_6] == "18:00") echo "selected"; ?>>18:00</option>
      <option value='18:30' <? if($write[wr_6] == "18:30") echo "selected"; ?>>18:30</option>
      <option value='19:00' <? if($write[wr_6] == "19:00") echo "selected"; ?>>19:00</option>
      <option value='19:30' <? if($write[wr_6] == "19:30") echo "selected"; ?>>19:30</option>
      <option value='20:00' <? if($write[wr_6] == "20:00") echo "selected"; ?>>20:00</option>
      <option value='20:30' <? if($write[wr_6] == "20:30") echo "selected"; ?>>20:30</option>
      <option value='21:00' <? if($write[wr_6] == "21:00") echo "selected"; ?>>21:00</option>
      <option value='21:30' <? if($write[wr_6] == "21:30") echo "selected"; ?>>21:30</option>
    </select>
	</td>
  </tr>
  <tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
  <tr>
    <td class=write_head>���� ����ð�</td>
    <td>
    <SELECT onchange="javascript:resetday('to');" name=tyear><?=$htm_tyear?></SELECT> ��

	<SELECT onchange="javascript:resetday('to');" name=tmon><?=$htm_tmon?></SELECT> ��

	<SELECT onchange="javascript:resetday('to');" name=tday><?=$htm_tday?></SELECT> ��
	<input type=hidden name='wr_link2' itemname='��ũ #2' value='<?=$t_date?>' class='input' size=60>

	<select name='wr_7' itemname='����ð�'>
      <option value=''>����ð�����</option>
      <option value='07:00' <? if($write[wr_7] == "07:00") echo "selected"; ?>>07:00</option>
      <option value='07:30' <? if($write[wr_7] == "07:30") echo "selected"; ?>>07:30</option>
      <option value='08:00' <? if($write[wr_7] == "08:00") echo "selected"; ?>>08:00</option>
      <option value='08:30' <? if($write[wr_7] == "08:30") echo "selected"; ?>>08:30</option>
      <option value='09:00' <? if($write[wr_7] == "09:00") echo "selected"; ?>>09:00</option>
      <option value='09:30' <? if($write[wr_7] == "09:30") echo "selected"; ?>>09:30</option>
      <option value='10:00' <? if($write[wr_7] == "10:00") echo "selected"; ?>>10:00</option>
      <option value='10:30' <? if($write[wr_7] == "10:30") echo "selected"; ?>>10:30</option>
      <option value='11:00' <? if($write[wr_7] == "11:00") echo "selected"; ?>>11:00</option>
      <option value='11:30' <? if($write[wr_7] == "11:30") echo "selected"; ?>>11:30</option>
      <option value='12:00' <? if($write[wr_7] == "12:00") echo "selected"; ?>>12:00</option>
      <option value='12:30' <? if($write[wr_7] == "12:30") echo "selected"; ?>>12:30</option>
      <option value='13:00' <? if($write[wr_7] == "13:00") echo "selected"; ?>>13:00</option>
      <option value='13:30' <? if($write[wr_7] == "13:30") echo "selected"; ?>>13:30</option>
      <option value='14:00' <? if($write[wr_7] == "14:00") echo "selected"; ?>>14:00</option>
      <option value='14:30' <? if($write[wr_7] == "14:30") echo "selected"; ?>>14:30</option>
      <option value='15:00' <? if($write[wr_7] == "15:00") echo "selected"; ?>>15:00</option>
      <option value='15:30' <? if($write[wr_7] == "15:30") echo "selected"; ?>>15:30</option>
      <option value='16:00' <? if($write[wr_7] == "16:00") echo "selected"; ?>>16:00</option>
      <option value='16:30' <? if($write[wr_7] == "16:30") echo "selected"; ?>>16:30</option>
      <option value='17:00' <? if($write[wr_7] == "17:00") echo "selected"; ?>>17:00</option>
      <option value='17:30' <? if($write[wr_7] == "17:30") echo "selected"; ?>>17:30</option>
      <option value='18:00' <? if($write[wr_7] == "18:00") echo "selected"; ?>>18:00</option>
      <option value='18:30' <? if($write[wr_7] == "18:30") echo "selected"; ?>>18:30</option>
      <option value='19:00' <? if($write[wr_7] == "19:00") echo "selected"; ?>>19:00</option>
      <option value='19:30' <? if($write[wr_7] == "19:30") echo "selected"; ?>>19:30</option>
      <option value='20:00' <? if($write[wr_7] == "20:00") echo "selected"; ?>>20:00</option>
      <option value='20:30' <? if($write[wr_7] == "20:30") echo "selected"; ?>>20:30</option>
      <option value='21:00' <? if($write[wr_7] == "21:00") echo "selected"; ?>>21:00</option>
      <option value='21:30' <? if($write[wr_7] == "21:30") echo "selected"; ?>>21:30</option>
    </select>
	</td>
  </tr>
  <tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>

<tr>
    <td class='write_head' style='padding:5 0 5 10;' colspan='2'>
        <? if ($is_dhtml_editor) { ?>
            <?=cheditor2('wr_content', $content);?>
        <? } else { ?>
        <table width=100% cellpadding=0 cellspacing=0>
        <tr>
            <td width=50% align=left valign=bottom>
                <span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 10);"><img src="<?=$board_skin_path?>/img/up.gif"></span>
                <span style="cursor: pointer;" onclick="textarea_original('wr_content', 10);"><img src="<?=$board_skin_path?>/img/start.gif"></span>
                <span style="cursor: pointer;" onclick="textarea_increase('wr_content', 10);"><img src="<?=$board_skin_path?>/img/down.gif"></span></td>
            <td width=50% align=right><? if ($write_min || $write_max) { ?><span id=char_count></span>����<?}?></td>
        </tr>
        </table>
        <textarea id="wr_content" name="wr_content" class=tx style='width:100%; word-break:break-all;' rows=10 itemname="����"
        <? if ($write_min || $write_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?>><?=$content?></textarea>
        <? if ($write_min || $write_max) { ?><script type="text/javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
        <? } ?>
    </td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#dddddd></td></tr>

<?/* if ($is_link) { ?>
<? for ($i=1; $i<=$g4[link_count]; $i++) { ?>
<tr>
    <td class=write_head>��ũ #<?=$i?></td>
    <td><input type='text' class='hp_skin_field' size=50 name='wr_link<?=$i?>' itemname='��ũ #<?=$i?>' value='<?=$write["wr_link{$i}"]?>' /></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>
<? } */?>

<? if ($is_file) { ?>
<tr>
    <td class=write_head>
        <table cellpadding=0 cellspacing=0>
        <tr>
            <td class=write_head style="padding-top:10px; line-height:20px;">
                ����÷��<br>
                <span onclick="add_file();" style="cursor:pointer;"><img src="<?=$board_skin_path?>/img/btn_file_add.gif"></span>
                <span onclick="del_file();" style="cursor:pointer;"><img src="<?=$board_skin_path?>/img/btn_file_minus.gif"></span>
            </td>
        </tr>
        </table>
    </td>
    <td style='padding:5 0 5 0;'><table id="variableFiles" cellpadding=0 cellspacing=0></table><?// print_r2($file); ?>
        <script type="text/javascript">
        var flen = 0;
        function add_file(delete_code)
        {
            var upload_count = <?=(int)$board[bo_upload_count]?>;
            if (upload_count && flen >= upload_count)
            {
                alert("�� �Խ����� "+upload_count+"�� ������ ���� ���ε尡 �����մϴ�.");
                return;
            }

            var objTbl;
            var objRow;
            var objCell;
            if (document.getElementById)
                objTbl = document.getElementById("variableFiles");
            else
                objTbl = document.all["variableFiles"];

            objRow = objTbl.insertRow(objTbl.rows.length);
            objCell = objRow.insertCell(0);

            objCell.innerHTML = "<input type='file' class='ed' name='bf_file[]' title='���� �뷮 <?=$upload_max_filesize?> ���ϸ� ���ε� ����'>";
            if (delete_code)
                objCell.innerHTML += delete_code;
            else
            {
                <? if ($is_file_content) { ?>
                objCell.innerHTML += "<br><input type='text' class='ed' size=50 name='bf_content[]' title='���ε� �̹��� ���Ͽ� �ش� �Ǵ� ������ �Է��ϼ���.'>";
                <? } ?>
                ;
            }

            flen++;
        }

        <?=$file_script; //�����ÿ� �ʿ��� ��ũ��Ʈ?>

        function del_file()
        {
            // file_length ���Ϸδ� �ʵ尡 �������� �ʾƾ� �մϴ�.
            var file_length = <?=(int)$file_length?>;
            var objTbl = document.getElementById("variableFiles");
            if (objTbl.rows.length - 1 > file_length)
            {
                objTbl.deleteRow(objTbl.rows.length - 1);
                flen--;
            }
        }
        </script></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_trackback) { ?>
<tr>
    <td class=write_head>Ʈ�����ּ�</td>
    <td><input class='ed' size=50 name=wr_trackback itemname="Ʈ����" value="<?=$trackback?>">
        <? if ($w=="u") { ?><input type=checkbox name="re_trackback" value="1">�� ����<? } ?></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_guest) { ?>
<tr>
    <td class=write_head><img id='kcaptcha_image' /></td>
    <td><input class='ed' type=input size=10 name=wr_key itemname="�ڵ���Ϲ���" required>&nbsp;&nbsp;������ ���ڸ� �Է��ϼ���.</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" align="center" valign="top" style="padding-top:30px;">
        <input type=image id="btn_submit" src="<?=$board_skin_path?>/img/btn_ok.gif" border=0 accesskey='s'>&nbsp;
        <a href="./board.php?bo_table=<?=$bo_table?>&mode=<?=$mode?>"><img id="btn_list" src="<?=$board_skin_path?>/img/btn_list.gif" border=0></a></td>
</tr>
</table>

</td></tr></table>
</form>

<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
<?
// �����ڶ�� �з� ���ÿ� '����' �ɼ��� �߰���
if ($is_admin)
{
    echo "
    if (typeof(document.fwrite.ca_name) != 'undefined')
    {
        document.fwrite.ca_name.options.length += 1;
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].value = '����';
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].text = '����';
    }";
}
?>

    function formcheck()
    {
    	if (fwrite.wr_link2.value-fwrite.wr_link1.value<0) {
            alert("���۳�¥���� ���ᳯ¥�� �����ϴ�.\n\nȮ�� �� �ٽ� �Է��Ͻñ� �ٶ��ϴ�.");
            fwrite.fyear.focus();
            return false;
        }
        fwrite.btnsubmit.disabled = true;

        return true;
    }

    function resetday(a_val)
    {
        if (a_val=="from") {
            fwrite.wr_link1.value = fwrite.fyear.value+fwrite.fmon.value+fwrite.fday.value;
        }
    	if (a_val=="to") {
            fwrite.wr_link2.value = fwrite.tyear.value+fwrite.tmon.value+fwrite.tday.value;
        }

		if (a_val=="all") {
			fwrite.wr_link1.value = fwrite.fyear.value+fwrite.fmon.value+fwrite.fday.value;
			fwrite.wr_link2.value = fwrite.tyear.value+fwrite.tmon.value+fwrite.tday.value;
		}
    }


function fwrite_submit(f)
{
    /*
    var s = "";
    if (s = word_filter_check(f.wr_subject.value)) {
        alert("���� �����ܾ�('"+s+"')�� ���ԵǾ��ֽ��ϴ�");
        return false;
    }

    if (s = word_filter_check(f.wr_content.value)) {
        alert("���뿡 �����ܾ�('"+s+"')�� ���ԵǾ��ֽ��ϴ�");
        return false;
    }
    */

    <?
    if ($is_dhtml_editor) echo cheditor3('wr_content');
    ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?=$board_skin_path?>/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("���� �����ܾ�('"+subject+"')�� ���ԵǾ��ֽ��ϴ�");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("���뿡 �����ܾ�('"+content+"')�� ���ԵǾ��ֽ��ϴ�");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    document.getElementById('btn_submit').disabled = true;
    document.getElementById('btn_list').disabled = true;

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/write_update.php';";
    else
        echo "f.action = './write_update.php';";
    ?>

    return true;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript"> window.onload=function() { drawFont(); } </script>
