<?
$sub_menu = "900100";
include_once("./_common.php");
include_once("$g4[path]/lib/mailer.lib.php");

auth_check($auth[$sub_menu], "w");

check_token();

if ($w == 'u'){

	$sql = " update $g4[online_table]
				set ol_admmemo = '$ol_admmemo',
				ol_name = '$ol_name',
				ol_email = '$ol_email',
				ol_tel = '$ol_tel',
				ol_hp = '$ol_hp',
				ol_zip1 = '$ol_zip1',
				ol_zip2 = '$ol_zip2',
				ol_addr1 = '$ol_addr1',
				ol_addr2 = '$ol_addr2',
				ol_mailmemo = '$ol_mailmemo',
				ol_1 = '$ol_1',
				ol_2 = '$ol_2',
				ol_3 = '$ol_3',
				ol_4 = '$ol_4',
				ol_5 = '$ol_5',
				ol_6 = '$ol_6',
				ol_7 = '$ol_7',
				ol_8 = '$ol_8',
				ol_9 = '$ol_9',
				ol_10 = '$ol_10',
				ol_memo = '$ol_memo'
			  where ol_id = '$ol_id' ";
	sql_query($sql);

	// 답변메일보내기
	if(trim($ol_mailmemo) != ""){
		/* 메일보내기 시작 */
		// 관리자님 회원정보
		$admin = get_admin('super');

		$subject = "[메일검사] $ol_name 님 온라인 문의에 대한 답변입니다.";
		ob_start();
		include_once ("./online_update_mail.php");
		$ol_mailmemo = ob_get_contents();
		ob_end_clean();

		mailer($admin[mb_nick], $admin[mb_email], $ol_email , $subject, $ol_mailmemo, 1);
	}

}


goto_url("./online_form.php?$qstr&w=u&ol_id=$ol_id");
?>