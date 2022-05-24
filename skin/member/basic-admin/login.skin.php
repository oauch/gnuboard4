<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

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
로그인페이지 입니다.<br>
로그인 정보를 잊었을 경우 ID/PW 찾기를 통해 확인하실 수 있습니다. 
</div>

<div class="adm_login_skin02"><INPUT type=text maxLength=20 size=20 name=mb_id itemname="아이디" required minlength="2"></div>
<div class="adm_login_skin02"><INPUT type=password maxLength=20 size=20 name=mb_password id="login_mb_password" itemname="패스워드" required onkeypress="check_capslock(event, 'login_mb_password');"></div>

<div style="display:none;">
<INPUT onclick="if (this.checked) { if (confirm('자동로그인을 사용하시면 다음부터 회원아이디와 패스워드를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?')) { this.checked = true; } else { this.checked = false;} }" type=checkbox name=auto_login>
<b>사용</b>
</div>

<div style='padding:15px 0px 0px 0px;'>
<input type=submit class=adm_login_skinbt value='로그인'>
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
