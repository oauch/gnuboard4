<?
// ĸí ���ǰ��� ���Ͽ� �´���? Ʋ����? ������� ����մϴ�.
include_once("_common.php");
header("Content-Type: text/html; charset=$g4[charset]");

$count = (int)get_session("captcha_count");
if ($count >= 5) { // ������ �̻��̸� �ڵ���Ϲ��� �Է� ���ڰ� �¾Ƶ� ���� ó��
    echo false;
} else {
    set_session("captcha_count", $count + 1);
    echo (get_session("captcha_keystring") == $_POST['captcha_key']) ? true : false;
}
?>