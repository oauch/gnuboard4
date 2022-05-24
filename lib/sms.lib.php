<?
if (!defined('_GNUBOARD_')) exit;

function array_overlap($arr, $val) {
    for ($i=0, $m=count($arr); $i<$m; $i++) {
        if ($arr[$i] == $val)
            return true;
    }
    return false;
}

function get_sock($url)
{
    // host �� uri �� �и�
    if (preg_match("`http://([a-zA-Z0-9_\-\.]+)([^<]*)`", $url, $res))
    {
        $host = $res[1];
        $get  = $res[2];
    }

    // 80�� ��Ʈ�� ��Ĺ���� �õ�
    $fp = fsockopen ($host, 80, $errno, $errstr, 30);
    if (!$fp)
    {
        die("$errstr ($errno)\n");
    }
    else
    {
        fputs($fp, "GET $get HTTP/1.0\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "\r\n");

        // header �� content �� �и��Ѵ�.
        while (trim($buffer = fgets($fp,1024)) != "")
        {
            $header .= $buffer;
        }
        while (!feof($fp))
        {
            $buffer .= fgets($fp,1024);
        }
    }
    fclose($fp);

    // content �� return �Ѵ�.
    return $buffer;
}

function get_hp($hp, $hyphen=1)
{
    global $g4;

    if (!is_hp($hp)) return '';

    if ($hyphen) $preg = "$1-$2-$3"; else $preg = "$1$2$3";

    $hp = str_replace('-', '', trim($hp));
    $hp = preg_replace("/^(01[016789])([0-9]{3,4})([0-9]{4})$/", $preg, $hp);

    if ($g4[sms4_demo])
        $hp = '0100000000';

    return $hp;
}

function is_hp($hp)
{
    $hp = str_replace('-', '', trim($hp));
    if (preg_match("/^(01[016789])([0-9]{3,4})([0-9]{4})$/", $hp))
        return true;
    else
        return false;
}

// ���޼����� ���â����
function alert_just($msg='', $url='')
{
	global $g4;

    if (!$msg) $msg = '�ùٸ� ������� �̿��� �ֽʽÿ�.';

	//header("Content-Type: text/html; charset=$g4[charset]");
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g4[charset]\">";
	echo "<script language='javascript'>alert('$msg');";
    echo "</script>";
    exit;
}

/**
 * SMS �߼��� �����ϴ� ���� Ŭ�����̴�.
 *
 * ����, �߼�, URL�߼�, ������� ���������� ���̴� ��� �κ��� ���ԵǾ� �ִ�.
 */

class SMS4 {
	var $smshub_id;
	var $smshub_pw;
	var $socket_host;
	var $socket_port;
	var $Data = array();
	var $Result = array();
	var $Log = array();

	// ������ ���� ����ϴ� ������ �����Ѵ�.
	function SMS_con($host,$id,$pw,$portcode) {

        $port=7193; // �����ĸ� ����

		$this->socket_host	= $host;
		$this->socket_port	= $port;
		$this->smshub_id		= FillSpace($id, 12);
		$this->smshub_pw		= FillSpace($pw, 20);
	}

	function Init() {
		$this->Data		= "";	// �߼��ϱ� ���� ��Ŷ������ �迭�� ����.
		$this->Result	= "";	// �߼۰������ �迭�� ����.
	}

	function Add($strDest, $strCallBack, $strCaller, $strURL, $strMessage, $strDate="", $nCount) {
        global $g4;

        if (strtolower($g4['charset']) == 'utf-8') {
            $strMessage = iconv('utf-8', 'cp949', $strMessage);
        }

        $Error = CheckCommonTypeDest($strDest, $nCount);
		$Error = CheckCommonTypeCallBack($strCallBack);
		$Error = CheckCommonTypeDate($strDate);

		$strCallBack    = FillSpace($strCallBack,11);
		$strCaller      = FillSpace($strCaller,10);

        if ($strDate) $strDate .= '00';
		$strDate		= FillSpace($strDate,14);

		for ($i=0; $i<$nCount; $i++) {
			$hp_number	= FillSpace($strDest[$i][bk_hp],11);
            $strData    = str_replace("{�̸�}", $strDest[$i][bk_name], $strMessage);

			if (!$strURL) {
                $strURL = FillSpace($strURL, 50);


				$smsType = "";
				if(strlen($strData) > 90){
					$strData	= FillSpace(CutChar($strData,2000),2000);
					$smsType= "LMS";
				}else{
					$strData	= FillSpace(CutChar($strData,90),90);
					$smsType= "SMS";
				}

				$this->Data[$i]	= '02'.$this->smshub_id.$this->smshub_pw.$smsType.$hp_number.$strCallBack.$strURL.$strDate.$strData;
                $strURL = '';
			} else {
				$strURL		= FillSpace($strURL,50);

				$smsType = "";
				if(strlen($strData) > 90){
					$strData	= FillSpace(CheckCallCenter($strURL, $hp_number, $strData),2000);
					$smsType= "LMS";
				}else{
					$strData	= FillSpace(CheckCallCenter($strURL, $hp_number, $strData),90);
					$smsType= "SMS";
				}

				if(strlen($strData) > 90)
					$smsType= "LMS";
				else
					$smsType= "SMS";

				$this->Data[$i]	= '00'.$this->smshub_id.$this->smshub_pw.$smsType.$hp_number.$strCallBack.$strURL.$strDate.$strData;
			}
		}
		return true; // �������
	}

	function Send() {
        global $g4;

        $count = 1;

        if ($g4[sms4_demo_send]) {
            foreach($this->Data as $puts) {
                if (rand(0,10)) {
                    $phone = substr($puts,34,11);
                    $code = '0001012345678';
                } else {
                    $phone = substr($puts,34,11);
                    $code = 'Error(02)';
                }
                $this->Result[] = "$phone:$code";
                $this->Log[] = $puts;
            }
            $this->Data = "";
            return true;
            exit;
        }

		$fsocket=fsockopen($this->socket_host,$this->socket_port);
		if (!$fsocket) return false;
		set_time_limit(300);

		## php4.3.10�ϰ��
        ## zend �ֽŹ������� �����ּ���..
        ## �Ǵ� 69��° ���� $this->Data as $tmp => $puts �� ������ �ּ���.

		foreach($this->Data as $puts) {
			$dest = substr($puts,34,11);
			fputs($fsocket, $puts);
			while(!$gets) {
				$gets = fgets($fsocket,14);
			}
			if (substr($gets,0,2) == "00") {
				$this->Result[] = $dest.":".substr($gets,0,2);
				$this->Log[] = $puts;
            } else {
				$this->Result[$dest] = $dest.":Error(".substr($gets,0,2).")";
				$this->Log[] = $puts;
            }
			$gets = "";

            // 1õ�Ǿ� ���� �� 5�� ��
            if ($count++%1000 == 0) sleep(5);
		}
		fclose($fsocket);
		$this->Data = "";
		return true;
	}
}

/**
 * ���ϴ� ���ڿ��� ���̸� ���ϴ� ���̸�ŭ ������ �־� ���ߵ��� �մϴ�.
 *
 * @param	text	���ϴ� ���ڿ��Դϴ�.
 *			size	���ϴ� �����Դϴ�.
 * @return			����� ���ڿ��� �ѱ�ϴ�.
 */
function FillSpace($text,$size) {
	for ($i=0; $i<$size; $i++) $text.=" ";
	$text = substr($text,0,$size);
	return $text;
}


/**
 * ���ϴ� ���ڿ��� ���ϴ� �濡 �´��� Ȯ���ؼ� �����ϴ� ����� �մϴ�.
 *
 * @param	word	���ϴ� ���ڿ��Դϴ�.
 *			cut		���ϴ� �����Դϴ�.
 * @return			����� ���ڿ��Դϴ�.
 */
function CutChar($word, $cut) {
	$word=substr($word,0,$cut);						// �ʿ��� ���̸�ŭ ����.
	for ($k=$cut-1; $k>1; $k--) {
		if (ord(substr($word,$k,1))<128) break;		// �ѱ۰��� 160 �̻�.
	}
	$word=substr($word,0,$cut-($cut-$k+1)%2);
	return $word;
}


/**
 * �߼۹�ȣ�� ���� ��Ȯ�� ������ Ȯ���մϴ�.
 *
 * @param	strDest	�߼۹�ȣ �迭�Դϴ�.
 *			nCount	�迭�� ũ���Դϴ�.
 * @return			ó������Դϴ�.
 */
function CheckCommonTypeDest($strDest, $nCount) {
	for ($i=0; $i<$nCount; $i++) {
		$hp_number = preg_replace("`[^0-9]`","",$strDest[$i][bk_hp]);
		if (strlen($hp_number)<10 || strlen($hp_number)>11) return "�޴��� ��ȣ�� Ʋ�Ƚ��ϴ�";

		$CID=substr($hp_number,0,3);
		if ( preg_match("`[^0-9]`",$CID) || ($CID!='010' && $CID!='011' && $CID!='016' && $CID!='017' && $CID!='018' && $CID!='019') ) return "�޴��� ���ڸ� ��ȣ�� �߸��Ǿ����ϴ�";
	}
}


/**
 * ȸ�Ź�ȣ�� ���� ��Ȯ�� ������ Ȯ���մϴ�.
 *
 * @param	strDest	ȸ�Ź�ȣ�Դϴ�.
 * @return			ó������Դϴ�.
 */
function CheckCommonTypeCallBack($strCallBack) {
	if (preg_match("`[^0-9]`", $strCallBack)) return "ȸ�� ��ȭ��ȣ�� �߸��Ǿ����ϴ�";
}


/**
 * ���೯¥�� ���� ��Ȯ�� ������ Ȯ���մϴ�.
 *
 * @param	text	���ϴ� ���ڿ��Դϴ�.
 *			size	���ϴ� �����Դϴ�.
 * @return			ó������Դϴ�.
 */
function CheckCommonTypeDate($strDate) {
	$strDate=preg_replace("`[^0-9]`","",$strDate);
	if ($strDate) {
		if (!checkdate(substr($strDate,4,2),substr($strDate,6,2),substr($rsvTime,0,4))) return "���೯¥�� �߸��Ǿ����ϴ�";
		if (substr($strDate,8,2)>23 || substr($strDate,10,2)>59) return "����ð��� �߸��Ǿ����ϴ�";
	}
}


/**
 * URL�ݹ������ �޼��� ũ�⸦ �����մϴ�.
 *
 * @param	url		URL �����Դϴ�.
 *			msg		����޽����Դϴ�.
 *			desk	���ڳ����Դϴ�.
 */
function CheckCallCenter($url, $dest, $data) {
	switch (substr($dest,0,3)) {
		case '010': //20����Ʈ
			return CutChar($data,20);
			break;
		case '011': //80����Ʈ
			return CutChar($data,80);
			break;
		case '016': // 80����Ʈ
			return CutChar($data,80);
			break;
		case '017': // URL ���� 80����Ʈ
			return CutChar($data,80 - strlen($url));
			break;
		case '018': // 20����Ʈ
			return CutChar($data,20);
			break;
		case '019': // 20����Ʈ
			return CutChar($data,20);
			break;
		default:
			return CutChar($data,80);
			break;
	}
}
?>