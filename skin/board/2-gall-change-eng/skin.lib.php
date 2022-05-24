<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 


if (!function_exists("makeThumbs")) {

	function makeThumbs($oriPath, $oriFileName, $thmWidth="", $thmHeight="", $thmAlt="") {
		global $g4, $board_skin_path;

		$errorFilePrt = "<img src='$board_skin_path/img/noimage.gif' border=0 title='�̹��� ����'>";

		$oriFile = $oriPath . "/" . $oriFileName;
		if (is_file($oriFile) == false) return $errorFilePrt; // ���� ����

		$thmPath = $oriPath . "/thumbs";
		$thmFile = $thmPath . "/" . $oriFileName;

		$oriSize = getimagesize($oriFile);
		$oriWidth = $oriSize[0];
		$oriHeight = $oriSize[1];
		$oriType = $oriSize[2];

		if ($oriType > 3) return $errorFilePrt; // ���� �̹��� Ÿ�� ����

		$oriRate = $oriWidth / $oriHeight;

		if ($thmWidth == "" && $thmHeight == "") return $errorFilePrt; // ����� ������ ������

		if ($thmWidth == "") $thmWidth = $thmHeight * $oriRate;
		if ($thmHeight == "") $thmHeight = $thmWidth / $oriRate;

		$widthRate = $thmWidth / $oriWidth;
		$heightRate = $thmHeight / $oriHeight;

		$oriFilePrt = "<img src=\"{$oriFile}\" width=\"{$oriWidth}\" height=\"{$oriHeight}\" border=\"0\" alt=\"{$thmAlt}\" />";

		if ($widthRate >= 1 && $heightRate >= 1) { // ������¡ ���ʿ�
			return $oriFilePrt;
		}

		if (file_exists($thmFile)) { // ����� ����
			$fp = fopen($thmFile, "r");
			$fstat = fstat($fp);
			$thmFileTime = $fstat['ctime'];
			fclose($fp);

			$fp = fopen($oriFile, "r");
			$fstat = fstat($fp);
			$oriFileTime = $fstat['ctime'];
			fclose($fp);

			if ($thmFileTime > $oriFileTime) { // ����� ���� ���ʿ�
				$thmSize = getimagesize($thmFile);
				$thmFilePrt = "<img src=\"{$thmFile}\" width=\"{$thmSize[0]}\" height=\"{$thmSize[1]}\" border=\"0\" alt=\"{$thmAlt}\" />";
			} else {
				@unlink($thmFile);
			}
		}

		@mkdir($thmPath);
		@chmod($thmPath, 0707);

		if ($widthRate < $heightRate) {
			$tempWidth = (int)($oriWidth * $heightRate);
			$tempHeight = $thmHeight;
		} else {
			$tempWidth = $thmWidth;
			$tempHeight = (int)($oriHeight * $widthRate);
		}

		if ($tempWidth == "") $tempWidth = $thmWidth;
		if ($tempHeight == "") $tempHeight = $thmHeight;

		switch($oriType) {
			case(1) :
				if(function_exists('imagecreateFromGif')) $tempImage = imagecreateFromGif($oriFile);
				break;
			case(2) :
				if(function_exists('imagecreateFromJpeg')) $tempImage = imagecreateFromJpeg($oriFile);
				break;
			case(3) :
				if(function_exists('imagecreateFromPng')) $tempImage = imagecreateFromPng($oriFile);
				break;
		}

		if ($tempImage) {
			if (function_exists('imagecreatetruecolor')) {
				$tempCanvas = imagecreatetruecolor($thmWidth, $thmHeight);
			} else {
				$tempCanvas = imagecreate($thmWidth, $thmHeight);
			}

			if (function_exists('imagecopyresampled')) {
				imagecopyresampled($tempCanvas, $tempImage, 0, 0, 0, 0, $tempWidth, $tempHeight, ImageSX($tempImage), ImageSY($tempImage));
			} else {
				imagecopyresized($tempCanvas, $tempImage, 0, 0, 0, 0, $tempWidth, $tempHeight, ImageSX($tempImage), ImageSY($tempImage));
			}
			ImageDestroy($tempImage);
			ImageJpeg($tempCanvas, $thmFile, 100);
			ImageDestroy($tempCanvas);
			unset($tempImage, $tempCanvas);
		}

		$thmFilePrt = "<img src=\"{$thmFile}\" width=\"{$thmWidth}\" height=\"{$thmHeight}\" border=\"0\" alt=\"{$thmAlt}\" />";

		return $thmFilePrt;
	}
}
?>
