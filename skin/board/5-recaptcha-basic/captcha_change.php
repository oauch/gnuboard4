<script>
	function captcha_change() {
		$("#captcha").hide();
		$("#kcaptcha_image").load(function() {
			$.ajax({
				type: 'POST',
				url: '<?php echo $board_skin_path; ?>/ajax_captcha.php',
				cache: false,
				async: false,
				success: function(text) {
					$("#wr_key").val(text);
				}
			});
		});
		if (!document.getElementById('google-recaptcha')) {
			$.ajax({
				type: 'POST',
				url: '<?php echo $board_skin_path; ?>/google_recaptcha.php',
				cache: false,
				async: false,
				success: function(html) {
					$("#captcha").after(html);
				}
			});
		}
	}
	captcha_change();

	// 리캡챠 체크
	function check_recaptcha() {
		if ($('#g-recaptcha-response').val() == "") {
			alert("자동등록방지를 확인해 주십시오.");
			return false;
		}
		return true;
	}
</script>
