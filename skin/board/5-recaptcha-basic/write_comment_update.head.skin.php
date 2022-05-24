<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// GUEST 이면, 구글 reCAPTCHA 값이 있는지 체크
if ($is_guest && $_POST['g-recaptcha-response'] == "") {
	// 여기에 alert 나 back 같은 액션을 넣으시면 됩니다.
	exit;
}
?>