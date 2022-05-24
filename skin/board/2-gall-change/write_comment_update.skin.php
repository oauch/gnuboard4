<? 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$data_path = $g4[path]."/data/file/$bo_table"; 
$thumb_path = $data_path; 
$img_width = 800;  //새로 만드는 이미지 사이즈 

    $sql2=" select * from $g4[board_file_table] where  bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no asc"; 
    $results2 = sql_query($sql2); 
    for ($d=0; $row2=sql_fetch_array($results2); $d++)  {  

if ($_FILES[bf_file][name][$d]) 
{ 
$file = $data_path .'/'. $row2[bf_file]; 

$IMG_info = getimagesize ($file); 
$thum_W = $IMG_info[0] ; 

if ($thum_W > $img_width) { 

if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) 
{ 
$size = getimagesize($file); 
if ($size[2] == 1) 
$src = imagecreatefromgif($file); 
else if ($size[2] == 2) 
$src = imagecreatefromjpeg($file); 
else if ($size[2] == 3) 
$src = imagecreatefrompng($file); 
else 
break; 

$rate = $img_width / $size[0]; 
$height = (int)($size[1] * $rate); 

@unlink($data_path.'/'.$row2[bf_file]); 
$dst = imagecreatetruecolor($img_width, $height); 
imagecopyresampled($dst, $src, 0, 0, 0, 0, $img_width, $height, $size[0], $size[1]); 
imagejpeg($dst, $data_path.'/'.$row2[bf_file], $board[bo_2]); 
chmod($data_path.'/'.$row2[bf_file], 0606); 

}  // 네번째 그림형식확인 
}	//세번째 그림크기확인 
}  // 두번째 if 
}  //첫번째 for 

?>

