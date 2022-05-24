<?
if (!defined('_GNUBOARD_')) exit;

// 서브매뉴
function online($skin_dir="basic", $bo_table=false)
{
    global $config, $group, $g4;

    // 테이블 명이 넘어오지 않으면
    if (empty($bo_table)) 
    {
            return " 게시판을 찾을 수 없습니다. ";
    }

    ob_start();
    $online_skin_path = "$g4[path]/skin/online/$skin_dir";
    include_once ("$online_skin_path/write.skin.php");
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>