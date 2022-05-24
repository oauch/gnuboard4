<?
$g4_path = "../../..";
include_once("$g4_path/common.php");

/*
//var sca     = sel.options[sel.selectedIndex].value;
//var form    = sel.form.name;
//dynamic.src = "<?=$board_skin_path?>/category.data.php?bo_table=<?=$bo_table?>&form=" + form + "&sca=" + data + "&target=" + target;
*/

header("Content-Type: application/x-javascript");

$arr    = explode("|", $board[bo_category_list]);
$arr1   = explode("|", $board[bo_10]);
$key    = array_search($sca, $arr);
$cate   = explode("^", $arr1[$key]);



if ($sca == "공지") {
    echo "document.forms['$form'].elements['$target'].length = 1;\n";
    echo "document.forms['$form'].elements['$target'].options[0].text  = '선택하세요';\n";
    echo "document.forms['$form'].elements['$target'].options[0].value = '';\n";
    exit;
} else {
    echo "document.forms['$form'].elements['$target'].length = ". (count($cate) + 1). ";\n";
    echo "document.forms['$form'].elements['$target'].options[0].text  = '선택하세요';\n";
    echo "document.forms['$form'].elements['$target'].options[0].value = '';\n";
    
    for ($i=0; $i<count($cate); $i++) {
        $k = $i + 1;
        echo "document.forms['$form'].elements['$target'].options[$k].text  = '$cate[$i]';\n";
        echo "document.forms['$form'].elements['$target'].options[$k].value = '$cate[$i]';\n";
    }
}
?>