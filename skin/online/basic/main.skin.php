<style>
#online {
	width:100%;
}
img {
	border:none;
}
#online input{
	border: 1px #cccccc solid;
}

#online_table {
	width:99%;
	border-top:3px #929292 solid;
	margin-bottom:10px;
}
#online_table th {
	font-size:12px;
	width:110px;
	text-align: left;
	background: #f5f5f5;
	padding-left:10px;
	border-bottom:1px #cccccc solid;
	border-right:1px #cccccc solid;
}
#online_table td {
	padding:6px 7px;
	border-bottom:1px #cccccc solid;
}
#online_btn{
	width:100%;
	text-align:center;
}
</style>
<div id="online">
	<div id="online_body">
	<!-- 본문 시작 -->
	<form name="online" method="post" action="javascript:online_submit(document.online);" enctype="multipart/form-data" autocomplete="off">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="online_table">
		<tr>
			<th>
				이름
			</th>
			<td colspan="3">
				<input type="text" name="ol_name" required itemname="이름" maxlength=10>
			</td>
		</tr>
		<tr>
			<th>
				핸드폰
			</th>
			<td colspan="3">
				<input type="text" name="ol_hp" itemname="핸드폰" maxlength=13 required >
			</td>
		</tr>
		<tr> 
			<th>
				메모
			</th>
			<td colspan="3">
				<textarea style="width:100%;height:100px;" name="ol_memo" required itemname="메모" ></textarea>
			</td>
		</tr>
	</table>
	<div id="online_btn">
		<input type="submit" value="빠른 온라인문의">
	</div>
	</form>
	</div>
	<script>
	<!-- 본문 끝 -->
	function online_submit(f)
	{
		f.action = './bbs/online_update.php';
		f.submit();
	}
	</script>
</div>
