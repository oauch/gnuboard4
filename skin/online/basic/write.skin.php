<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<style>
#online {width:100%;}
img {border:none;}

/* 기본스타일 */
#online_table{border-top:2px solid #333;}
#online_table td, #online_table th{font-size:10pt; color:#666; line-height:140%; padding:10px 0px 10px 0px; border-bottom:1px solid #dedede;}
#online_table th{width:120px; text-align:center;}
#online_table input, #online_table textarea, #online_table select{border:1px solid #dedede; padding:5px; font-size:9pt; color:#666; line-height:140%;}
#online_table input, #online_table select{height:30px; line-height:30px;}

/* 버튼스타일 */
#online_btn{text-align:center; padding:35px 0px 0px 0px;}
.online_ok_bt{font-size:9pt; color:#f5f5f5; background-color:#333; border:1px solid #333; padding:7px 30px 7px 30px; cursor:hand;}
.online_cs_bt{font-size:9pt; color:#f5f5f5; background-color:#666; border:1px solid #666; padding:7px 30px 7px 30px; cursor:hand;}

.online_input_box{height:auto !important; border:1px solid #fff !important;}
</style>

<div>

	
	<div>
	<!-- 본문 시작 -->
	<form name="online" method="post" action="javascript:online_submit(document.online);" enctype="multipart/form-data" autocomplete="off">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="online_table">
		<tr style="display:none;"><!--분류를 사용하실 경우 tr의 style 삭제 처리--> 
			<th>분류</th>
			<td colspan="3">
				<select name="ol_kind">
					<option value="상담">상담</option>
					<option value="제휴">제휴</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>이름</th>
			<td><input type="text" name="ol_name" required itemname="이름" maxlength=10></td>
			<th>이메일</th>
			<td><input type="text" name="ol_email" size="30" email itemname="이메일"></td>
		</tr>
		<tr>
			<th>전화번호</th>
			<td><input type="text" name="ol_tel" itemname="전화번호" maxlength=20></td>
			<th>핸드폰</th>
			<td><input type="text" name="ol_hp" itemname="핸드폰" maxlength=20></td>
		</tr>
		<tr> 
			<th>내용</th>
			<td colspan="3"><textarea style="width:100%;height:100px;" name="ol_memo" itemname="내용"></textarea></td>
		</tr>
		<tr style="display:none;"> 
			<th>주소</th>
			<td colspan="3">
			<input name="zip1" type="text" class="box"  size="5" readonly >
			- 
			<input name="zip2" type="text" class="box"  size="5" readonly > 
			&nbsp; <a href="javascript:win_zip('online','zip1','zip2','addr1','addr2');"><img name="findaddr" src="<?=$online_skin_path;?>/img/btn_addr.gif" align="absmiddle"></a><br> 
			<input name="addr1" type="text" class="box"  size="60" readonly itemname="주소"> 
			<br> <input name="addr2" type="text" class="box"  size="60" itemname="세부주소"></td>
		</tr>
		<tr style="display:none;">
			<th>
				파일첨부
			</th>
			<td colspan="3">
				<input type="file" name="ol_file" size="30" itemname="파일첨부">
			</td>
		</tr>
			<!-- ol_1 ~ ol_10 까지 추가가능 
			<? for ($i=1; $i<=10; $i++) { ?>
		<tr>
			<th>
				예비 <?=$i;?>
			</th>
			<td colspan="3">
				<input type="text" name="ol_<?=$i;?>" size="30"  itemname="예비<?=$i;?>">
			</td>
		</tr>
			<? } ?>
			-->
		<tr> 
			<th>취급방침동의</th>
			<td colspan="3">
			<div>
			<textarea rows="5" readonly style="width:100%;">내용을 입력해주세요. </textarea></div>
			<div style="padding:5px 0px 0px 0px;">
			<input type=radio value=1 name=agree id=agree11 class="online_input_box">&nbsp;<label for=agree11><span style="font-size:8pt;">동의합니다.</span></label>
			</div>
			</td>
		</tr>
	</table>
	
	
	<div id="online_btn">
	<input type=submit class=online_ok_bt value='확인'>&nbsp;
	<input type=submit class=online_cs_bt value='취소' onclick="history.go(-1)">
	</div>
	
	
	</form>
	</div>
	
</div>

<script type="text/javascript">
<!-- 본문 끝 -->
function online_submit(f)
{
 var agree1 = document.getElementsByName("agree");
    if (!agree1[0].checked) {
        alert("개인정보취급방침을 동의해주세요.");
        agree1[0].focus();
        return;
    }


    f.action = './online_update.php';
    f.submit();

}


</script>
