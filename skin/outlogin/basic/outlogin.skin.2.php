<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>


<style>
#top_login_bt a{font-size:8pt; text-decoration:none; color:#666; padding-left:5px;}
</style>

<!-- 로그인 후 외부로그인 시작 -->

<div id="top_login_bt">
<a href="/gnuboard4/index.php">처음으로</a>
<a href="<?=$g4['bbs_path']?>/logout.php">로그아웃</a>
<a href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php">정보수정</a>
<a href="/gnuboard4/adm/">관리자</a>
</div>


<script type="text/javascript">
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave() 
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?")) 
            location.href = "<?=$g4['bbs_path']?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- 로그인 후 외부로그인 끝 -->
