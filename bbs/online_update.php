<?
include_once("./_common.php");
include_once("$g4[path]/lib/mailer.lib.php");
include_once("$g4[path]/lib/sms.lib.php");

// ���۷� üũ
referer_check();

$sms_send_chk = true; // false true  �Է��ϸ� ���ڱ���� ��������ʽ��ϴ�.

if(!$config[cf_online_skin]){
	$config[cf_online_skin] = "basic";
}

if(!$ol_name)
	alert("������ �Է����ּ���");

$ol_name = trim(strip_tags($_POST[ol_name]));
$ol_email = trim(strip_tags($_POST[ol_email]));
$ol_tel = trim(strip_tags($_POST[ol_tel]));
$ol_hp = trim(strip_tags($_POST[ol_hp]));
$addr2 = strip_tags($_POST[addr2]);
$ol_memo = strip_tags($_POST[ol_memo]);
$ol_1 = strip_tags($_POST[ol_1]);
$ol_2 = strip_tags($_POST[ol_2]);
$ol_3 = strip_tags($_POST[ol_3]);
$ol_4 = strip_tags($_POST[ol_4]);
$ol_5 = strip_tags($_POST[ol_5]);
$ol_6 = strip_tags($_POST[ol_6]);
$ol_7 = strip_tags($_POST[ol_7]);
$ol_8 = strip_tags($_POST[ol_8]);
$ol_9 = strip_tags($_POST[ol_9]);
$ol_10 = strip_tags($_POST[ol_10]);

$tmp_ol_hp = str_replace("-", "", $ol_hp);;
if (!check_string($tmp_ol_hp, _G4_NUMERIC_))
	alert("������ ��ȣ�� �ùٸ��� �ʽ��ϴ�.");

/* ÷������ ���� */

$upload_dir = "$g4[path]/data/online/";

// ���丮�� ���ٸ� ����.
@mkdir("$upload_dir", 0707);
@chmod("$upload_dir", 0707);

function file_upload($files, $upload_dir, $allow_type="", $limit_size="")
{
    $total_size = 0;
    $upfile = array();

    // ���� �����̸� �迭��..
    if (!is_array($files[tmp_name])) {
        $files[tmp_name] = array($files[tmp_name]);
        $files[name] = array($files[name]);
        $files[type] = array($files[type]);
        $files[size] = array($files[size]);
    }

    for ($i=0; $i<count($files[tmp_name]); $i++)
    {
        if (is_uploaded_file($files[tmp_name][$i]))
        {
            $upfile[$i][file_name] = get_file_name($upload_dir, $files[name][$i]);
            $upfile[$i][real_name] = $files[name][$i];
            //$upfile[$i]mime_type] = $files[type][$i];
            $upfile[$i][file_size] = $files[size][$i];
            $upfile[$i][extension]=strtolower(array_pop(explode('.', $files[name][$i])));

            // ���Ÿ�� üũ
            if ($allow_type) {
                if (!allow_file_type($upfile[$i][extension], $allow_type))
                    alert("������� �ʴ� �������� �Դϴ�.");
            }

            // ���뷮 üũ byte ������ ��Ʈ...
            $total_size += $upfile[$i][file_size];

            if ($limit_size) {
                if ((int)$upfile[$i][file_size] > (int)($limit_size))
                    alert("���Ͽ뷮�� ���ġ�� �ʰ��Ͽ����ϴ�.");
            }

            // ���Ϻ���
            $tmp_upload_file = $upload_dir.$upfile[$i][file_name];

            if (!move_uploaded_file($files[tmp_name][$i], $tmp_upload_file))
                alert("���ϸ� : $upfile[real_name]\\n������ ���ε��� �� �����ϴ�.");

            @chmod($tmp_upload_file, 0606);

            $upfile[$i][image] = @getimagesize($tmp_upload_file);
        }
        else
        {
            $upfile[$i][file_name] = "";
        }
    }
    return $upfile;
}

// get unique filename
function get_file_name($upload_dir, $file_name)
{
    global $g4;

    // �Ʒ��� ���ڿ��� �� ������ -x �� �ٿ��� ����θ� �˴��� ������ ���� ���ϵ��� ��
    $file_name = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $file_name);

    // ���̻縦 ���� ���ϸ�
    //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($jb2[server_time])),0,8).'_'.urlencode($filename);
    // �޺��µ��� ���� : �ѱ������� urlencode($filename) ó���� �Ұ�� '%'�� �ٿ��ְ� �Ǵµ� '%'ǥ�ô� �̵���÷��̾ �ν��� ���ϱ� ������ ����� �ȵ˴ϴ�. �׷��� ������ ���ϸ��� '%'�κ��� ���ָ� �ذ�˴ϴ�. 
    $file_name = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($file_name)); 

    // duplicate check
    srand((double)microtime()*1000000);
    while (file_exists($upload_dir.$file_name)) {
        $seed = rand(100,999);
        $file_name=$seed."_".$file_name;
        if (!file_exists($upload_dir.$file_name)) break;
    }

    return $file_name;
}

function allow_file_type($file_type, $allow_type)
{
    $rtn = false;
    $allow_type_array = explode(",", $allow_type);
    if (in_array($file_type, $allow_type_array))
        $rtn = true;

    return $rtn;
}

$sql_file = "";

/* ���ε� ���� */
$upload = file_upload($_FILES['ol_file'],$upload_dir);


if($upload[0][file_name]){
	$sql_file .= "ol_file_name = '{$upload[0][file_name]}',";
	$sql_file .= "ol_file_source = '{$upload[0][real_name]}',";
	$sql_file .= "ol_file_type = '{$upload[0][type]}',";
}


/* ÷������ ����*/


$sql = " insert into $g4[online_table]
			set ol_kind         = '$ol_kind',
				ol_name         = '$ol_name',
				ol_email   = '$ol_email',
				ol_tel   = '$ol_tel',
				ol_hp     = '$ol_hp',
				ol_zip1          = '$zip1',
				ol_zip2         = '$zip2',
				ol_addr1        = '$addr1',
				ol_addr2     = '$addr2',
				ol_datetime    = '$g4[time_ymdhis]',
				ol_ip      = '$_SERVER[REMOTE_ADDR]',
				ol_memo      = '$ol_memo',
				$sql_file
				ol_1            = '$ol_1',
				ol_2            = '$ol_2',
				ol_3            = '$ol_3',
				ol_4            = '$ol_4',
				ol_5            = '$ol_5',
				ol_6            = '$ol_6',
				ol_7            = '$ol_7',
				ol_8            = '$ol_8',
				ol_9            = '$ol_9',
				ol_10           = '$ol_10' ";
$result = sql_query($sql);

if (!$result)
	alert("�����Ͽ����ϴ�. \\n �ùٸ� �������� �Է����ּ���");


/* ���Ϻ����� ���� */
// �����ڴ� ȸ������

$admin = get_admin('super');

$subject = "�����ڴ� �¶��� ���ǰ� ���� �Ǿ����ϴ�.";
ob_start();
include_once ("./online_update_mail.php");
$ol_memo = ob_get_contents();
ob_end_clean();

mailer($admin[mb_nick], $admin[mb_email], $admin[mb_email], $subject, $ol_memo, 1);

/* ���Ϻ����� �� */

/* ���ں����� ���� */
if($sms_send_chk){


	//���ڽ���
	$sms4 = sql_fetch("select * from sms4_config");


	$tmp_array = array($sms4[cf_phone]); // �߼۹�ȣ ����) array("010-1234-1234","010-4444-4444")

	$mb_hp = "";
	for ($i=0; $i<count($tmp_array); $i++) 
	{
		$mb_hp .= $tmp_array[$i];
		if($i > 0)
			$mb_hp .= ",";
	}

	$cf_phone = $mb_hp; // ȸ�Ź�ȣ

	$mh_message = "{$ol_name}{$ol_hp}���� �¶��� ���ǰ� �����Ǿ����ϴ�.";

	$mh_hp = explode(',', $mb_hp);


	// �ڵ��� ��ȣ�� �ɷ�����.
	$tmp = array();
	for ($i=0; $i<count($mh_hp); $i++) 
	{

		$hp = trim($mh_hp[$i]);
		$hp = get_hp($hp);

		if ($hp) 
			$tmp[][bk_hp] = get_hp($hp, 0);
	}
	$mh_hp = $tmp;

	$total = count($mh_hp);

	$mh_reply = str_replace("-", "", $cf_phone);;
	if (!check_string($mh_reply, _G4_NUMERIC_))
		alert("������ ��ȣ�� �ùٸ��� �ʽ��ϴ�.");




	$SMS = new SMS4;
	$SMS->SMS_con($sms4[cf_ip], $sms4[cf_id], $sms4[cf_pw], $sms4[cf_port]);

	$result = $SMS->Add($mh_hp, $mh_reply, '', '', $mh_message, $booking, $total);

	$is_success = null;

	if ($result) 
	{
		$result = $SMS->Send();

		if ($result) //SMS ������ �����߽��ϴ�.
		{
			foreach ($SMS->Result as $result) 
			{
				list($hp, $code) = explode(":", $result);

				if (substr($code,0,5) == "Error")
				{
					$is_success = false;

					$hs_code = substr($code,6,2);

					switch (substr($code,6,2)) {
						case '02':	 // "02:���Ŀ���"
							$mh_log = "������ �߸��Ǿ� ������ �����Ͽ����ϴ�.";
							break;
						case '23':	 // "23:��������,�����Ϳ���,���۳�¥����"
							$mh_log = "�����͸� �ٽ� Ȯ���� �ֽñ�ٶ��ϴ�.";
							break;
						case '97':	 // "97:�ܿ����κ���"
							$mh_log = "�ܿ������� �����մϴ�.";
							break;
						case '98':	 // "98:���Ⱓ����"
							$mh_log = "���Ⱓ�� ����Ǿ����ϴ�.";
							break;
						case '99':	 // "99:��������"
							$mh_log = "���� ���� ���Ͽ����ϴ�. ������ �ٽ� Ȯ���� �ּ���.";
							break;
						default:	 // "�� Ȯ�� ����"
							$mh_log = "�� �� ���� ������ ������ �����Ͼ����ϴ�.";
							break;
					}
				} 
				else
				{
					$is_success = true;
					$mh_log = "{$ol_name}�� �ڵ�������";
				}

				$hp = get_hp($hp, 1);
				$log = array_shift($SMS->Log);

				$row2 = sql_fetch("select max(wr_no) as wr_no from sms4_write");
				if ($row2)
					$wr_no = $row2[wr_no] + 1;

				sql_query("insert into sms4_history set wr_no='$wr_no', wr_renum=0, bg_no='0', mb_id='$mb_id', bk_no='0', hs_name='$ol_name', hs_hp='$ol_hp', hs_datetime='$g4[time_ymdhis]', hs_flag='1', hs_code='$hs_code', hs_memo='$mh_log', hs_log='$log'");

				if ($is_admin == 'super')
					$sms4[cf_point] = 0;

				if ($is_success)
					insert_point($member[mb_id], (-1) * $sms4[cf_point], "$mh_log");


			}
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
			sql_query("insert into sms4_write set wr_no='$wr_no', wr_renum=0, wr_reply='$cf_phone', wr_message='$mh_message', wr_total='1', wr_datetime='$g4[time_ymdhis]',wr_success='1'");
		}
		else alert("����: SMS ������ ����� �Ҿ����մϴ�.");
	}
	else alert("����: SMS ������ �Էµ��� ������ �߻��Ͽ����ϴ�.");

}
/* ���ں����� �� */

alert("���������� �����Ǿ����ϴ�.","");


/* ���ں����� �� */
?>
