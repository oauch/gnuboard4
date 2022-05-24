<?
include_once("./_common.php");

// 로그인중인 경우 회원가입 할 수 없습니다.
if ($member[mb_id]) 
    goto_url($g4[path]);

// 세션을 지웁니다.
set_session("ss_mb_reg", "");

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";

$g4[title] = "회원가입약관";

$subHadeNum = "01"; //헤드 
$subPageNum = "0000"; //페이지코드
$title = "회원가입"; //타이틀 

include_once("./_head.php");
include_once("$member_skin_path/register.skin.php");
include_once("./_tail.php");
?>
