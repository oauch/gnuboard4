<?
if (!defined('_GNUBOARD_')) exit;

// ����Ŵ�
function online($skin_dir="basic", $bo_table=false)
{
    global $config, $group, $g4;

    // ���̺� ���� �Ѿ���� ������
    if (empty($bo_table)) 
    {
            return " �Խ����� ã�� �� �����ϴ�. ";
    }

    ob_start();
    $online_skin_path = "$g4[path]/skin/online/$skin_dir";
    include_once ("$online_skin_path/write.skin.php");
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>