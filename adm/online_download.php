<?
include_once("./_common.php");

if(!$is_admin){
	alert("���������� �̿����ּ���");
}

$filename = str_replace(" ","+",$filename);

$filepath = "$g4[path]/data/online/{$filename}";
$original = $orname;

if (file_exists($filepath)) {
    if(eregi("msie", $_SERVER[HTTP_USER_AGENT]) && eregi("5\.5", $_SERVER[HTTP_USER_AGENT])) {
        header("content-type: doesn/matter");
        header("content-length: ".filesize("$filepath"));
        header("content-disposition: attachment; filename=\"$original\"");
        header("content-transfer-encoding: binary");
    } else {
        header("content-type: file/unknown");
        header("content-length: ".filesize("$filepath"));
        header("content-disposition: attachment; filename=\"$original\"");
        header("content-description: php generated data");
    }
    header("pragma: no-cache");
    header("expires: 0");
    flush();

    if (is_file("$filepath")) {
        $fp = fopen("$filepath", "rb");

        // 4.00 ��ü
        // �������ϸ� ���̷��� print �� echo �Ǵ� while ���� �̿��� ������ٴ� �̹����...
        //if (!fpassthru($fp)) {
        //    fclose($fp);
        //}

        while(!feof($fp)) { 
            echo fread($fp, 100*1024); 
            flush(); 
        } 
        fclose ($fp); 
        flush();
    } else {
        alert("�ش� �����̳� ��ΰ� �������� �ʽ��ϴ�.");
    }

} else {
    alert("������ ã�� �� �����ϴ�.");
}
?>
