<?php
require_once("_config.php");
// ---------------------------------------------------------------------------

$delete = trim($_GET['img']);

// ������ ��ο��� ���ϸ� ����. \ �� / �� ���ŵȴ�.
preg_match('/[0-9a-z_]+\.(gif|png|jpe?g)$/i', $delete, $m);
$delete = $m[0];

// ������ ������ �κи� �߶󳻼� �ڽ��� ���������� ���Ѵ�.
list($ip2long, $filename) = explode('_', $delete);
if ($ip2long == md5($_SERVER['REMOTE_ADDR'])) {
    $filepath = sprintf("%s/%s", SAVE_DIR, $delete);
    $r = unlink($filepath);
    echo $r ? true : false;
}
else {
    echo false;
}
?>