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
	<!-- ���� ���� -->
	<form name="online" method="post" action="javascript:online_submit(document.online);" enctype="multipart/form-data" autocomplete="off">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="online_table">
		<tr>
			<th>
				�̸�
			</th>
			<td colspan="3">
				<input type="text" name="ol_name" required itemname="�̸�" maxlength=10>
			</td>
		</tr>
		<tr>
			<th>
				�ڵ���
			</th>
			<td colspan="3">
				<input type="text" name="ol_hp" itemname="�ڵ���" maxlength=13 required >
			</td>
		</tr>
		<tr> 
			<th>
				�޸�
			</th>
			<td colspan="3">
				<textarea style="width:100%;height:100px;" name="ol_memo" required itemname="�޸�" ></textarea>
			</td>
		</tr>
	</table>
	<div id="online_btn">
		<input type="submit" value="���� �¶��ι���">
	</div>
	</form>
	</div>
	<script>
	<!-- ���� �� -->
	function online_submit(f)
	{
		f.action = './bbs/online_update.php';
		f.submit();
	}
	</script>
</div>
