<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

if ($g4['https_url']) {
    $login_url = $_GET['url'];
    if ($login_url) {
        if (preg_match("/^\.\.\//", $url)) {
            $login_url = urlencode($g4[url]."/".preg_replace("/^\.\.\//", "", $login_url));
        }
        else {
            $purl = parse_url($g4[url]);
            if ($purl[path]) {
                $path = urlencode($purl[path]);
                $urlencode = preg_replace("/".$path."/", "", $urlencode);
            }
            $login_url = $g4[url].$urlencode;
        }
    }
    else {
        $login_url = $g4[url];
    }
}
else {
    $login_url = $urlencode;
}
?>

<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>


<style>
body{background-color:#f5f5f5;}

.adm_login_skin{margin-top:100px;}
.adm_login_skin01{font-size:60pt; font-weight:bold; text-align:center; letter-spacing:-2px; font-family:arial; color:#333;}
.adm_login_skin02{padding:5px 0px 5px 0px;}
.adm_login_skin02 input{height:35px; line-height:35px; padding:5px 0px 5px 0px; border:1px solid #dedede; width:270px; padding-left:7px;}
.adm_login_skin03{font-size:12pt; color:#888; line-height:150%; padding:20px 0px 40px 0px;}
.adm_login_skinbt{font-size:9pt; color:#f5f5f5; background-color:#333; border:1px solid #333; padding:15px 30px 15px 30px; width:270px;}
</style>


<form name="flogin" method="post" onsubmit="return flogin_submit(this);" autocomplete="off">
<input type="hidden" name="url" value='<?=$login_url?>'>
<div class="adm_login_skin">
<center>
<div class="adm_login_skin01">Login</div>
<div class="adm_login_skin03">
�α��������� �Դϴ�.<br>
�α��� ������ �ؾ��� ��� ID/PW ã�⸦ ���� Ȯ���Ͻ� �� �ֽ��ϴ�. 
</div>

<div class="adm_login_skin02"><INPUT type=text maxLength=20 size=20 name=mb_id itemname="���̵�" required minlength="2"></div>
<div class="adm_login_skin02"><INPUT type=password maxLength=20 size=20 name=mb_password id="login_mb_password" itemname="�н�����" required onkeypress="check_capslock(event, 'login_mb_password');"></div>

<div style="display:none;">
<INPUT onclick="if (this.checked) { if (confirm('�ڵ��α����� ����Ͻø� �������� ȸ�����̵�� �н����带 �Է��Ͻ� �ʿ䰡 �����ϴ�.\n\n\������ҿ����� ���������� ����� �� ������ ����� �����Ͽ� �ֽʽÿ�.\n\n�ڵ��α����� ����Ͻðڽ��ϱ�?')) { this.checked = true; } else { this.checked = false;} }" type=checkbox name=auto_login>
<b>���</b>
</div>

<div style='padding:15px 0px 0px 0px;'>
<input type=submit class=adm_login_skinbt value='�α���'>
</div>


</center>
</div>
</form>

<script type='text/javascript'>
document.flogin.mb_id.focus();

function flogin_submit(f)
{
    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/login_check.php';";
    else
        echo "f.action = '$g4[bbs_path]/login_check.php';";
    ?>

    return true;
}
</script>
