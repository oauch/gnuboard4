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

	// ��ĸí üũ
	function check_recaptcha() {
		if ($('#g-recaptcha-response').val() == "") {
			alert("�ڵ���Ϲ����� Ȯ���� �ֽʽÿ�.");
			return false;
		}
		return true;
	}
</script>
