<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>
<style>
#online {width:100%;}
img {border:none;}

/* �⺻��Ÿ�� */
#online_table{border-top:2px solid #333;}
#online_table td, #online_table th{font-size:10pt; color:#666; line-height:140%; padding:10px 0px 10px 0px; border-bottom:1px solid #dedede;}
#online_table th{width:120px; text-align:center;}
#online_table input, #online_table textarea, #online_table select{border:1px solid #dedede; padding:5px; font-size:9pt; color:#666; line-height:140%;}
#online_table input, #online_table select{height:30px; line-height:30px;}

/* ��ư��Ÿ�� */
#online_btn{text-align:center; padding:35px 0px 0px 0px;}
.online_ok_bt{font-size:9pt; color:#f5f5f5; background-color:#333; border:1px solid #333; padding:7px 30px 7px 30px; cursor:hand;}
.online_cs_bt{font-size:9pt; color:#f5f5f5; background-color:#666; border:1px solid #666; padding:7px 30px 7px 30px; cursor:hand;}

.online_input_box{height:auto !important; border:1px solid #fff !important;}
</style>

<div>

	
	<div>
	<!-- ���� ���� -->
	<form name="online" method="post" action="javascript:online_submit(document.online);" enctype="multipart/form-data" autocomplete="off">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="online_table">
		<tr style="display:none;"><!--�з��� ����Ͻ� ��� tr�� style ���� ó��--> 
			<th>�з�</th>
			<td colspan="3">
				<select name="ol_kind">
					<option value="���">���</option>
					<option value="����">����</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>�̸�</th>
			<td><input type="text" name="ol_name" required itemname="�̸�" maxlength=10></td>
			<th>�̸���</th>
			<td><input type="text" name="ol_email" size="30" email itemname="�̸���"></td>
		</tr>
		<tr>
			<th>��ȭ��ȣ</th>
			<td><input type="text" name="ol_tel" itemname="��ȭ��ȣ" maxlength=20></td>
			<th>�ڵ���</th>
			<td><input type="text" name="ol_hp" itemname="�ڵ���" maxlength=20></td>
		</tr>
		<tr> 
			<th>����</th>
			<td colspan="3"><textarea style="width:100%;height:100px;" name="ol_memo" itemname="����"></textarea></td>
		</tr>
		<tr style="display:none;"> 
			<th>�ּ�</th>
			<td colspan="3">
			<input name="zip1" type="text" class="box"  size="5" readonly >
			- 
			<input name="zip2" type="text" class="box"  size="5" readonly > 
			&nbsp; <a href="javascript:win_zip('online','zip1','zip2','addr1','addr2');"><img name="findaddr" src="<?=$online_skin_path;?>/img/btn_addr.gif" align="absmiddle"></a><br> 
			<input name="addr1" type="text" class="box"  size="60" readonly itemname="�ּ�"> 
			<br> <input name="addr2" type="text" class="box"  size="60" itemname="�����ּ�"></td>
		</tr>
		<tr style="display:none;">
			<th>
				����÷��
			</th>
			<td colspan="3">
				<input type="file" name="ol_file" size="30" itemname="����÷��">
			</td>
		</tr>
			<!-- ol_1 ~ ol_10 ���� �߰����� 
			<? for ($i=1; $i<=10; $i++) { ?>
		<tr>
			<th>
				���� <?=$i;?>
			</th>
			<td colspan="3">
				<input type="text" name="ol_<?=$i;?>" size="30"  itemname="����<?=$i;?>">
			</td>
		</tr>
			<? } ?>
			-->
		<tr> 
			<th>��޹�ħ����</th>
			<td colspan="3">
			<div>
			<textarea rows="5" readonly style="width:100%;">������ �Է����ּ���. </textarea></div>
			<div style="padding:5px 0px 0px 0px;">
			<input type=radio value=1 name=agree id=agree11 class="online_input_box">&nbsp;<label for=agree11><span style="font-size:8pt;">�����մϴ�.</span></label>
			</div>
			</td>
		</tr>
	</table>
	
	
	<div id="online_btn">
	<input type=submit class=online_ok_bt value='Ȯ��'>&nbsp;
	<input type=submit class=online_cs_bt value='���' onclick="history.go(-1)">
	</div>
	
	
	</form>
	</div>
	
</div>

<script type="text/javascript">
<!-- ���� �� -->
function online_submit(f)
{
 var agree1 = document.getElementsByName("agree");
    if (!agree1[0].checked) {
        alert("����������޹�ħ�� �������ּ���.");
        agree1[0].focus();
        return;
    }


    f.action = './online_update.php';
    f.submit();

}


</script>
