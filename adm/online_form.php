<?
$sub_menu = "100100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($w == "") 
{
    $html_title = "등록";
}
else if ($w == "u") 
{
	$row = sql_fetch(" select * from $g4[online_table] where ol_id = '$ol_id' ");
    if (!$row[ol_id])
        alert("존재하지 않는 문의입니다..");
	sql_query("update $g4[online_table] set ol_read_date = '$g4[time_ymdhis]' where ol_id = '$ol_id'");

    $html_title = "수정";
} 
else 
    alert("제대로 된 값이 넘어오지 않았습니다.");

$g4[title] = "$row[ol_kind] " . $html_title;
include_once("./admin.head.php");
?>

<? $admin_HadeNum = "06"; ?>

<table width=100% align=center cellpadding=0 cellspacing=0 class="admin_basic_board_write">
<form name=online method=post action="javascript:online_submit(document.online);" enctype="multipart/form-data" autocomplete="off">
<input type=hidden name=w    value='<?=$w?>'>
<input type=hidden name=sfl  value='<?=$sfl?>'>
<input type=hidden name=stx  value='<?=$stx?>'>
<input type=hidden name=sst  value='<?=$sst?>'>
<input type=hidden name=sod  value='<?=$sod?>'>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name=ol_id value='<?=$row[ol_id]?>'>
<input type=hidden name="token" value="<?=$token?>">
<colgroup width=15%>
<colgroup width=35%>
<colgroup width=15%>
<colgroup width=35%>
<tr>
    <td colspan=4 align=left><div class="admin_title01"><?=$g4[title]?></div></td>
</tr>

<?if($row[ol_kind]){?>
<tr>
    <td class="admin_basic_board_writetd">분류</td>
    <td colspan="3">
		<select name="ol_kind">
	<?
	$result = sql_query(" select * from $g4[online_table] group by ol_kind");
	while($select = sql_fetch_array($result)){
	?>
			<option value="<?=$select[ol_kind];?>"><?=$select[ol_kind];?></option>
	<?}?>
		</select>
		<script>document.online.ol_kind.value = '<?=$row[ol_kind];?>'</script>
	</td>
</tr>
<?}?>
<tr>
    <td class="admin_basic_board_writetd">이름</td>
    <td><input type=text name='ol_name' maxlength=20 minlength=2 required itemname='이름(실명)' value='<? echo get_text($row[ol_name]); ?>'></td>
    <td class="admin_basic_board_writetd">E-mail</td>
    <td><input type=text name='ol_email' size=40 maxlength=100 required email itemname='e-mail' value='<? echo get_text($row[ol_email]); ?>'></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">전화번호</td>
    <td><input type=text name='ol_tel' maxlength=20 itemname='전화번호' value='<? echo $row[ol_tel] ?>'></td>
    <td class="admin_basic_board_writetd">핸드폰번호</td>
    <td><input type=text name='ol_hp' maxlength=20 itemname='핸드폰번호' value='<? echo $row[ol_hp] ?>'></td>
</tr>
<!--<tr>
    <td class="admin_basic_board_writetd">주소</td>
    <td colspan="2">
        <input type=text name='ol_zip1' size=4 maxlength=3 readonly itemname='우편번호 앞자리' value='<? echo $row[ol_zip1] ?>'> -
        <input type=text name='ol_zip2' size=4 maxlength=3 readonly itemname='우편번호 뒷자리' value='<? echo $row[ol_zip2] ?>'>
        <a href="javascript:;" onclick="win_zip('online', 'ol_zip1', 'ol_zip2', 'ol_addr1', 'ol_addr2');"><img src='<?=$g4[bbs_img_path]?>/btn_zip.gif' align=absmiddle border=0></a>
        <br><input type=text name='ol_addr1' size=40 readonly value='<? echo $row[ol_addr1] ?>'>
        <br><input type=text name='ol_addr2' size=25 itemname='상세주소' value='<? echo $row[ol_addr2] ?>'> 상세주소 입력</td>
</tr>-->
<tr>
    <td class="admin_basic_board_writetd">내용</td>
    <td colspan=3><textarea name=ol_memo rows=5 style='width:99%; word-break:break-all;'><? echo $row[ol_memo] ?></textarea></textarea></td>
</tr>
<!--<tr>
    <td class="admin_basic_board_writetd">첨부파일</td>
    <td colspan=3><a href="./online_download.php?filename=<? echo $row[ol_file_name]; ?>&orname=<? echo $row[ol_file_source]; ?>"><? echo $row[ol_file_source]; ?></a></td>
</tr>-->
<tr>
    <td class="admin_basic_board_writetd">문의날짜</td>
    <td><?=$row[ol_datetime]?></td>
    <td class="admin_basic_board_writetd">확인날짜</td>
    <td><?=$row[ol_read_date]?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">관리자메모</td>
    <td colspan=3><textarea name=ol_admmemo rows=5 style='width:99%; word-break:break-all;'><? echo $row[ol_admmemo] ?></textarea></td>
</tr>
<!--<tr>
    <td class="admin_basic_board_writetd">답변메일보내기</td>
    <td colspan=3><textarea name=ol_mailmemo rows=5 style='width:99%; word-break:break-all;'><? echo $row[ol_mailmemo] ?></textarea></td>
</tr>-->
<tr>
    <td class="admin_basic_board_writetd">IP</td>
    <td><?=$row[ol_ip]?></td>
</tr>
<!-- <tr><td colspan=4 class=line2></td></tr>
ol_1 ~ ol_10 까지 사용가능
<tr>
    <td>ol_1</td>
    <td><input type=text name='ol_1' value='<? echo $row[ol_1] ?>' ></td>
</tr>
<tr>
    <td>ol_2</td>
    <td><input type=text name='ol_2'  value='<? echo $row[ol_2] ?>' ></td>
</tr>
<tr>
    <td>ol_3</td>
    <td><input type=text name='ol_3'  value='<? echo $row[ol_3] ?>' ></td>
</tr>
<tr>
    <td>ol_4</td>
    <td><input type=text name='ol_4'  value='<? echo $row[ol_4] ?>' ></td>
</tr>
<tr>
    <td>ol_5</td>
    <td><input type=text name='ol_5'  value='<? echo $row[ol_5] ?>' ></td>
</tr>
<tr>
    <td>ol_6</td>
    <td><input type=text name='ol_6'  value='<? echo $row[ol_6] ?>' ></td>
</tr>
<tr>
    <td>ol_7</td>
    <td><input type=text name='ol_7'  value='<? echo $row[ol_7] ?>' ></td>
</tr>
<tr>
    <td>ol_8</td>
    <td><input type=text name='ol_8' value='<? echo $row[ol_8] ?>' ></td>
</tr>
<tr>
    <td>ol_9</td>
    <td><input type=text name='ol_9' value='<? echo $row[ol_9] ?>' ></td>
</tr>
<tr>
    <td>ol_10</td>
    <td><input type=text name='ol_10' value='<? echo $row[ol_10] ?>' ></td>
</tr>-->

</table>

<p align=center>
    <input type=submit class=admin_black_bt accesskey='s' value='확인'>&nbsp;
    <input type=button class=admin_black_bt value='목록' onclick="document.location.href='./online_list.php?<?=$qstr?>';">&nbsp;
    
    <? if ($w != '') { ?>
    <input type=button class=admin_black_bt value='삭제' onclick="del('./online_delete.php?<?=$qstr?>&w=d&ol_id=<?=$row[ol_id]?>&url=<?=$_SERVER[PHP_SELF]?>');">&nbsp;
    <? } ?>
</form>

<script language='Javascript'>
function online_submit(f)
{

    f.action = './online_form_update.php';
    f.submit();
}
</script>

<?
include_once("./admin.tail.php");
?>
