<?
$sub_menu = "900500";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");



$g4['title'] = "팝업관리";
include_once ("./admin.head.php");

//전체삭제일경우
if($mode=='delete_all'){
	
		for($i=0;$i<sizeof($num);$i++){
			$sql="delete from $g4[site_popup_table] where no={$no[$num[$i]]}  ";
			mysql_query($sql);
		}
}

//전체수정일경우
if($mode=='modify_all'){
	

		for($i=0;$i<sizeof($num);$i++){

			
			$sql="update  $g4[site_popup_table] set 
			check_use='{$use[$num[$i]]}'
			
			where no={$no[$num[$i]]}  ";
			
			mysql_query($sql);
		}
}



$colspan=9;

$sql="select * from $g4[site_popup_table] where 1 order by no desc ";
$result=mysql_query($sql);
$total_count = mysql_num_rows($result);

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql="select * from $g4[site_popup_table] where 1 order by no desc  limit $from_record, $rows ";
$result = sql_query($sql);
?>

<? $admin_HadeNum = "05"; ?>

<table width=100% cellpadding=3 cellspacing=1>
<tr>
    <td width=50% align=left> (팝업수 : <?=number_format($total_count)?>개)</td>
    
</tr>
</table>

<div class="admin_tip_normal">
팝업생성을 원하실 경우 오른쪽 <b class="admin_tip_c">[+팝업생성]</b> 버튼을 클릭해주시면됩니다. 
</div>


<form name=flist method=post action='<?=$PHP_SELF?>'>
<input type=hidden name=page  value="<?=$page?>">
<input type=hidden name=mode  value="">
<table width=100% cellpadding=0 cellspacing=1 id="admin_basic_board">
<colgroup width=30>
<colgroup width=>
<colgroup width=60>
<colgroup width=60>
<colgroup width=100>
<colgroup width=140>
<colgroup width=60>
<colgroup width=80>
<colgroup width=100>

<tr class="admin_basic_board_topln">
    <td >&nbsp;</td>
	<td>제목</td>
	<td>타입</td>
	<td>사이즈</td>
	<td>레벨적용</td>
	<td>시작날짜</td>
	<td>기간</td>
	<td>사용</td>
	<td><a href="./site_popup_form.php"><b class="admin_org_plus">+팝업생성</b></a></td>
</tr>
<?for($i=0;$row=mysql_fetch_array($result);$i++){
	
	$title=stripslashes($row[title]);
	$width=$row[width];
	$height=$row[height];

	$condition="$row[level]";
	if($condition=='0'){
		$con_text='전체레벨';
	}else{
		$con_text=$condition."레벨";
	}
	$check_use=$row[check_use];
	if(!$check_use)$check_use='N';

	$gigan=$row[gigan]."일";	
	
?>
<tr class='list$list'>
	<td><input type=checkbox name="num[]" value="<?=$i?>"></td>
	<input type=hidden name='no[]' value='<?=$row[no]?>'>
	<td align=left>&nbsp;<?=$title?></td>
	<td align=center><?=$row[type]?></td>
	<td align=center><?=$width?>/<?=$height?></td>
	<td align=center><?=$con_text?></td>
	<td align=center><?=$row[reg_date]?></td>
	<td align=center><?=$gigan?></td>
	<td align=center>
		<select name='use[]' >
			<option value="Y" <?if($check_use=='Y')echo "selected";?> >사용중</option>
			<option value="N" <?if($check_use=='N')echo "selected";?> >일시중지</option>
		</select>
	</td>
	<td align=center>
	<a href="./site_popup_form.php?mode=modify&no=<?=$row[no]?>"><b class="admin_org font8pt">수정</b></a>
	</td>

</tr>

<?}?>
<?if(!$total_count){?>
<tr><td colspan='<?=$colspan?>' align=center height=100 bgcolor=#ffffff>팝업이 생성되지 않았습니다.</td></tr>

<?}?>
</table>

<table width=100% cellpadding=3 cellspacing=1>
<tr><td>
	<input type=button value='전체선택'  onclick="multiCheck(1);" class=admin_black_bt_mn>
	<input type=button value='전체취소'  onclick="multiCheck(2);" class=admin_black_bt_mn>
	<input type=button value='선택반전'  onclick="multiCheck(3);" class=admin_black_bt_mn>
	&nbsp;&nbsp;
	<input  type=button value="선택 수정" onclick="actionQue('modify_all')" class=admin_black_bt_mn>
	<input  type=button value="선택 삭제" onclick="actionQue('delete_all')" class=admin_black_bt_mn>
</td>
<td align=right>
<? $pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?page=");
	echo $pagelist;
?>
</td>
</tr></table>


</form>
<script language=javascript>
function multiCheck(n)
{
	var i;
	var l = document.getElementsByName('num[]');

	for (i = 0; i < l.length; i++)
	{
		if (n == 1) l[i].checked = true;
		if (n == 2) l[i].checked = false;
		if (n == 3) l[i].checked = !l[i].checked;
	}
}
function actionQue(val)
{
	var f = document.flist;
	var i;
	var j = 0;
	var l = document.getElementsByName('num[]');

	for (i = 0; i < l.length; i++)
	{
		if (l[i].checked == true) j++;
	}
	if (j == 0)
	{
		alert('선택된 데이타가 없습니다.            ');
		return false;
	}
	
	if(val=='delete_all'){
		if(confirm('삭제후 복구가 불가능합니다 정말로 실행하시겠습니까?  '))
		{
			f.mode.value=val;		
			f.submit();
		}
	}else if(val='modify_all'){
		if(confirm('수정후 복구가 불가능합니다 정말로 실행하시겠습니까?  '))
		{
			f.mode.value=val;		
			f.submit();
		}
	}
	return false;
}
</script>

<?
include_once("./admin.tail.php");
?>
