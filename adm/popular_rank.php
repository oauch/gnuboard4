<?
$sub_menu = "300400";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

if (empty($fr_date)) $fr_date = $g4[time_ymd];
if (empty($to_date)) $to_date = $g4[time_ymd];

$qstr = "fr_date=$fr_date&to_date=$to_date";

$sql_common = " from $g4[popular_table] a ";
$sql_search = " where trim(pp_word) <> '' and pp_date between '$fr_date' and '$to_date' ";
$sql_group = " group by pp_word ";
$sql_order = " order by cnt desc ";

$sql = " select pp_word
         $sql_common
         $sql_search
         $sql_group ";
$result = sql_query($sql);
$total_count = mysql_num_rows($result);

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if ($page == "") { $page = 1; } // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select pp_word, count(*) as cnt 
          $sql_common
          $sql_search
          $sql_group
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>ó��</a>";

$g4[title] = "�α�˻������";
include_once("./admin.head.php");

$colspan = 3;
?>

<?
//==============================================================================
// jquery date picker
//------------------------------------------------------------------------------
// ����) ie ������ ��, �� select box �� �ι��� Ŭ���ؾ� �ϴ� ������ �ֽ��ϴ�.
//------------------------------------------------------------------------------
// jquery-ui.css �� �׸��� �����ؼ� ����� �� �ֽ��ϴ�.
// base, black-tie, blitzer, cupertino, dark-hive, dot-luv, eggplant, excite-bike, flick, hot-sneaks, humanity, le-frog, mint-choc, overcast, pepper-grinder, redmond, smoothness, south-street, start, sunny, swanky-purse, trontastic, ui-darkness, ui-lightness, vader
// �Ʒ� css �� date picker �� ȭ���� ���ߴ� �ڵ��Դϴ�.
?>

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />
<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
-->
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
<script type="text/javascript">
/* Korean initialisation for the jQuery calendar extension. */
/* Written by DaeKwon Kang (ncrash.dk@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ko'] = {
		closeText: '�ݱ�',
		prevText: '������',
		nextText: '������',
		currentText: '����',
		monthNames: ['1��(JAN)','2��(FEB)','3��(MAR)','4��(APR)','5��(MAY)','6��(JUN)',
		'7��(JUL)','8��(AUG)','9��(SEP)','10��(OCT)','11��(NOV)','12��(DEC)'],
		monthNamesShort: ['1��','2��','3��','4��','5��','6��',
		'7��','8��','9��','10��','11��','12��'],
		dayNames: ['��','��','ȭ','��','��','��','��'],
		dayNamesShort: ['��','��','ȭ','��','��','��','��'],
		dayNamesMin: ['��','��','ȭ','��','��','��','��'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

    $('#fr_date, #to_date').datepicker({
        showOn: 'button',
		buttonImage: '<?=$g4[path]?>/img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "�޷�",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
        yearRange: 'c-99:c+99',
        maxDate: '+0d'
    }); 
});
</script>
<?
//==============================================================================
?>

<table width=100% cellpadding=3 cellspacing=1>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left><?=$listall?> (�Ǽ� : <?=number_format($total_count)?>��)</td>
    <td width=50% align=right>
        �Ⱓ : 
        <input type='text' id='fr_date' name='fr_date' size=11 maxlength=10 value='<?=$fr_date?>' class=ed>
        -
        <input type='text' id='to_date' name='to_date' size=11 maxlength=10 value='<?=$to_date?>' class=ed>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle></td>
</tr>
</form>
</table>

<form name=fpopularrank method=post>
<input type=hidden name=sst   value="<?=$sst?>">
<input type=hidden name=sod   value="<?=$sod?>">
<input type=hidden name=sfl   value="<?=$sfl?>">
<input type=hidden name=stx   value="<?=$stx?>">
<input type=hidden name=page  value="<?=$page?>">
<input type=hidden name=token value="<?=$token?>">
<table width=100% cellpadding=0 cellspacing=1>
<colgroup width=>
<colgroup width=150>
<colgroup width=150>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>�˻���</td>
    <td>�˻�ȸ��</td>
    <td>����</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $word = get_text($row[pp_word]);
    $rank = ($i + 1 + ($rows * ($page - 1)));

    $list = $i % 2;
    echo "<tr class='list$list col1 ht center'>";
    echo "<td align='left'>&nbsp; $word</td>";
    echo "<td>$row[cnt]</td>";
    echo "<td>$rank</td>";
    echo "</tr>";
    echo "<tr class='list$list col1 ht center'>";
    echo "</tr>\n";
} 

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>�ڷᰡ �����ϴ�.</td></tr>"; 

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=50%>";

if ($is_admin == "super")
    echo "<input type=button class='btn1' value='���û���' onclick=\"btn_check(this.form, 'delete')\">";

echo "</td>";
echo "<td width=50% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script>document.fsearch.sfl.value = '$sfl';</script>";
?>
</form>

<?
include_once("./admin.tail.php");
?>
