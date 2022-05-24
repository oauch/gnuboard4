<?
if (!defined('_GNUBOARD_')) exit;

/*************************************************************************
**
**  ÀÏ¹Ý ÇÔ¼ö ¸ðÀ½
**
*************************************************************************/

// ¸¶ÀÌÅ©·Î Å¸ÀÓÀ» ¾ò¾î °è»ê Çü½ÄÀ¸·Î ¸¸µê
function get_microtime()
{
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}


// ÇöÀçÆäÀÌÁö, ÃÑÆäÀÌÁö¼ö, ÇÑÆäÀÌÁö¿¡ º¸¿©ÁÙ Çà, URL
function get_paging($write_pages, $cur_page, $total_page, $url, $add="")
{
    $str = "";
    if ($cur_page > 1) {
        $str .= "<a href='" . $url . "1{$add}'>Ã³À½</a>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>ÀÌÀü</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= " &nbsp;<a href='" . $url . ($start_page-1) . "{$add}'>ÀÌÀü</a>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= " &nbsp;<a href='$url$k{$add}'><span>$k</span></a>";
            else
                $str .= " &nbsp;<b>$k</b> ";
        }
    }

    if ($total_page > $end_page) $str .= " &nbsp;<a href='" . $url . ($end_page+1) . "{$add}'>´ÙÀ½</a>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>´ÙÀ½</a>]";
        $str .= " &nbsp;<a href='$url$total_page{$add}'>¸Ç³¡</a>";
    }
    $str .= "";

    return $str;
}


// º¯¼ö ¶Ç´Â ¹è¿­ÀÇ ÀÌ¸§°ú °ªÀ» ¾ò¾î³¿. print_r() ÇÔ¼öÀÇ º¯Çü
function print_r2($var)
{
    ob_start();
    print_r($var);
    $str = ob_get_contents();
    ob_end_clean();
    $str = preg_replace("/ /", "&nbsp;", $str);
    echo nl2br("<span style='font-family:Tahoma, ±¼¸²; font-size:9pt;'>$str</span>");
}


// ¸ÞÅ¸ÅÂ±×¸¦ ÀÌ¿ëÇÑ URL ÀÌµ¿
// header("location:URL") À» ´ëÃ¼
function goto_url($url)
{
    echo "<script type='text/javascript'> location.replace('$url'); </script>";
    exit;
}


// ¼¼¼Çº¯¼ö »ý¼º
function set_session($session_name, $value)
{
    if (PHP_VERSION < '5.3.0')
        session_register($session_name);
    // PHP ¹öÀüº° Â÷ÀÌ¸¦ ¾ø¾Ö±â À§ÇÑ ¹æ¹ý
    $$session_name = $_SESSION["$session_name"] = $value;
}


// ¼¼¼Çº¯¼ö°ª ¾òÀ½
function get_session($session_name)
{
    return $_SESSION[$session_name];
}


// ÄíÅ°º¯¼ö »ý¼º
function set_cookie($cookie_name, $value, $expire)
{
    global $g4;

    setcookie(md5($cookie_name), base64_encode($value), $g4[server_time] + $expire, '/', $g4[cookie_domain]);
}


// ÄíÅ°º¯¼ö°ª ¾òÀ½
function get_cookie($cookie_name)
{
    return base64_decode($_COOKIE[md5($cookie_name)]);
}


// °æ°í¸Þ¼¼Áö¸¦ °æ°íÃ¢À¸·Î
function alert($msg='', $url='')
{
	global $g4;

    if (!$msg) $msg = '¿Ã¹Ù¸¥ ¹æ¹ýÀ¸·Î ÀÌ¿ëÇØ ÁÖ½Ê½Ã¿À.';

	//header("Content-Type: text/html; charset=$g4[charset]");
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g4[charset]\">";
	echo "<script type='text/javascript'>alert('$msg');";
    if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        // 4.06.00 : ºÒ¿©¿ìÀÇ °æ¿ì ¾Æ·¡ÀÇ ÄÚµå¸¦ Á¦´ë·Î ÀÎ½ÄÇÏÁö ¸øÇÔ
        //echo "<meta http-equiv='refresh' content='0;url=$url'>";
        goto_url($url);
    exit;
}


// °æ°í¸Þ¼¼Áö Ãâ·ÂÈÄ Ã¢À» ´ÝÀ½
function alert_close($msg)
{
	global $g4;

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g4[charset]\">";
    echo "<script type='text/javascript'> alert('$msg'); window.close(); </script>";
    exit;
}


// way.co.kr ÀÇ wayboard Âü°í
function url_auto_link($str)
{
    global $g4;
    global $config;

    // ¼Óµµ Çâ»ó 031011
    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='$config[cf_link_target]'>\\2</A>", $str);
    //$str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='$config[cf_link_target]'>\\2</A>", $str);
    // 100825 : () Ãß°¡
    // 120315 : CHARSET ¿¡ µû¶ó ¸µÅ©½Ã ±ÛÀÚ Àß¸² Çö»óÀÌ ÀÖ¾î ¼öÁ¤
    if (strtoupper($g4['charset']) == 'UTF-8') {
        $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[°¡-ÆR\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='$config[cf_link_target]'>\\2</A>", $str);
    } else {
        $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='$config[cf_link_target]'>\\2</A>", $str);
    }
    // ÀÌ¸ÞÀÏ Á¤±ÔÇ¥Çö½Ä ¼öÁ¤ 061004
    //$str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;
}


// url¿¡ http:// ¸¦ ºÙÀÎ´Ù
function set_http($url)
{
    if (!trim($url)) return;

    if (!preg_match("/^(http|https|ftp|telnet|news|mms)\:\/\//i", $url))
        $url = "http://" . $url;

    return $url;
}


// ÆÄÀÏÀÇ ¿ë·®À» ±¸ÇÑ´Ù.
//function get_filesize($file)
function get_filesize($size)
{
    //$size = @filesize(addslashes($file));
    if ($size >= 1048576) {
        $size = number_format($size/1048576, 1) . "M";
    } else if ($size >= 1024) {
        $size = number_format($size/1024, 1) . "K";
    } else {
        $size = number_format($size, 0) . "byte";
    }
    return $size;
}


// °Ô½Ã±Û¿¡ Ã·ºÎµÈ ÆÄÀÏÀ» ¾ò´Â´Ù. (¹è¿­·Î ¹ÝÈ¯)
function get_file($bo_table, $wr_id)
{
    global $g4, $qstr;

    $file["count"] = 0;
    $sql = " select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $no = $row[bf_no];
        $file[$no][href] = "./download.php?bo_table=$bo_table&wr_id=$wr_id&no=$no" . $qstr;
        $file[$no][download] = $row[bf_download];
        // 4.00.11 - ÆÄÀÏ path Ãß°¡
        $file[$no][path] = "$g4[path]/data/file/$bo_table";
        //$file[$no][size] = get_filesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][size] = get_filesize($row[bf_filesize]);
        //$file[$no][datetime] = date("Y-m-d H:i:s", @filemtime("$g4[path]/data/file/$bo_table/$row[bf_file]"));
        $file[$no][datetime] = $row[bf_datetime];
        $file[$no][source] = addslashes($row[bf_source]);
        $file[$no][bf_content] = $row[bf_content];
        $file[$no][content] = get_text($row[bf_content]);
        //$file[$no][view] = view_file_link($row[bf_file], $file[$no][content]);
        $file[$no][view] = view_file_link($row[bf_file], $row[bf_width], $row[bf_height], $file[$no][content]);
        $file[$no][file] = $row[bf_file];
        // prosper ´Ô Á¦¾È
        //$file[$no][imgsize] = @getimagesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][image_width] = $row[bf_width] ? $row[bf_width] : 640;
        $file[$no][image_height] = $row[bf_height] ? $row[bf_height] : 480;
        $file[$no][image_type] = $row[bf_type];
        $file["count"]++;
    }

    return $file;
}


// Æú´õÀÇ ¿ë·® ($dir´Â / ¾øÀÌ ³Ñ±â¼¼¿ä)
function get_dirsize($dir)
{
    $size = 0;
    $d = dir($dir);
    while ($entry = $d->read()) {
        if ($entry != "." && $entry != "..") {
            $size += filesize("$dir/$entry");
        }
    }
    $d->close();
    return $size;
}


/*************************************************************************
**
**  ±×´©º¸µå °ü·Ã ÇÔ¼ö ¸ðÀ½
**
*************************************************************************/


// °Ô½Ã¹° Á¤º¸($write_row)¸¦ Ãâ·ÂÇÏ±â À§ÇÏ¿© $list·Î °¡°øµÈ Á¤º¸¸¦ º¹»ç ¹× °¡°ø
function get_list($write_row, $board, $skin_path, $subject_len=40)
{
    global $g4, $config;
    global $qstr, $page;

    //$t = get_microtime();

    // ¹è¿­ÀüÃ¼¸¦ º¹»ç
    $list = $write_row;
    unset($write_row);

    $list['is_notice'] = preg_match("/[^0-9]{0,1}{$list['wr_id']}[\r]{0,1}/",$board['bo_notice']);

    if ($subject_len)
        $list['subject'] = conv_subject($list['wr_subject'], $subject_len, "¡¦");
    else
        $list['subject'] = conv_subject($list['wr_subject'], $board['bo_subject_len'], "¡¦");

    // ¸ñ·Ï¿¡¼­ ³»¿ë ¹Ì¸®º¸±â »ç¿ëÇÑ °Ô½ÃÆÇ¸¸ ³»¿ëÀ» º¯È¯ÇÔ (¼Óµµ Çâ»ó) : kkal3(Ä¿ÇÇ)´Ô²²¼­ ¾Ë·ÁÁÖ¼Ì½À´Ï´Ù.
    if ($board['bo_use_list_content'])
	{
		$html = 0;
		if (strstr($list['wr_option'], "html1"))
			$html = 1;
		else if (strstr($list['wr_option'], "html2"))
			$html = 2;

        $list['content'] = conv_content($list['wr_content'], $html);
	}

    $list['comment_cnt'] = "";
    if ($list['wr_comment'])
        $list['comment_cnt'] = "($list[wr_comment])";

    // ´çÀÏÀÎ °æ¿ì ½Ã°£À¸·Î Ç¥½ÃÇÔ
    $list['datetime'] = substr($list['wr_datetime'],0,10);
    $list['datetime2'] = $list['wr_datetime'];
    if ($list['datetime'] == $g4['time_ymd'])
        $list['datetime2'] = substr($list['datetime2'],11,5);
    else
        $list['datetime2'] = substr($list['datetime2'],5,5);
    // 4.1
    $list['last'] = substr($list['wr_last'],0,10);
    $list['last2'] = $list['wr_last'];
    if ($list['last'] == $g4['time_ymd'])
        $list['last2'] = substr($list['last2'],11,5);
    else
        $list['last2'] = substr($list['last2'],5,5);

    $list['wr_homepage'] = get_text(addslashes($list['wr_homepage']));

    $tmp_name = get_text(cut_str($list['wr_name'], $config['cf_cut_name'])); // ¼³Á¤µÈ ÀÚ¸®¼ö ¸¸Å­¸¸ ÀÌ¸§ Ãâ·Â
    if ($board['bo_use_sideview'])
        $list['name'] = get_sideview($list['mb_id'], $tmp_name, $list['wr_email'], $list['wr_homepage']);
    else
        $list['name'] = "<span class='".($list['mb_id']?'member':'guest')."'>$tmp_name</span>";

    $reply = $list['wr_reply'];

    $list['reply'] = "";
    if (strlen($reply) > 0)
    {
        for ($k=0; $k<strlen($reply); $k++)
            $list['reply'] .= ' &nbsp;&nbsp; ';
    }

    $list['icon_reply'] = "";
    if ($list['reply'])
        $list['icon_reply'] = "<img src='$skin_path/img/icon_reply.gif' align='absmiddle'>";

    $list['icon_link'] = "";
    if ($list['wr_link1'] || $list['wr_link2'])
        $list['icon_link'] = "<img src='$skin_path/img/icon_link.gif' align='absmiddle'>";

    // ºÐ·ù¸í ¸µÅ©
    $list['ca_name_href'] = "$g4[bbs_path]/board.php?bo_table=$board[bo_table]&sca=".urlencode($list['ca_name']);

    $list['href'] = "$g4[bbs_path]/board.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]" . $qstr;
    //$list['href'] = "$g4[bbs_path]/board.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]";
    if ($board['bo_use_comment'])
        $list['comment_href'] = "javascript:win_comment('$g4[bbs_path]/board.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]&cwin=1');";
    else
        $list['comment_href'] = $list['href'];

    $list['icon_new'] = "";
    if ($list['wr_datetime'] >= date("Y-m-d H:i:s", $g4['server_time'] - ($board['bo_new'] * 3600)))
        $list['icon_new'] = "<img src='$skin_path/img/icon_new.gif' align='absmiddle'>";

    $list['icon_hot'] = "";
    if ($list['wr_hit'] >= $board['bo_hot'])
        $list['icon_hot'] = "<img src='$skin_path/img/icon_hot.gif' align='absmiddle'>";

    $list['icon_secret'] = "";
    if (strstr($list['wr_option'], "secret"))
        $list['icon_secret'] = "<img src='$skin_path/img/icon_secret.gif' align='absmiddle'>";

    // ¸µÅ©
    for ($i=1; $i<=$g4['link_count']; $i++)
    {
        $list['link'][$i] = set_http(get_text($list["wr_link{$i}"]));
        $list['link_href'][$i] = "$g4[bbs_path]/link.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]&no=$i" . $qstr;
        $list['link_hit'][$i] = (int)$list["wr_link{$i}_hit"];
    }

    // °¡º¯ ÆÄÀÏ
    $list['file'] = get_file($board['bo_table'], $list['wr_id']);

    if ($list['file']['count'])
        $list['icon_file'] = "<img src='$skin_path/img/icon_file.gif' align='absmiddle'>";

    return $list;
}

// get_list ÀÇ alias
function get_view($write_row, $board, $skin_path, $subject_len=125)
{
    return get_list($write_row, $board, $skin_path, $subject_len);
}


// set_search_font(), get_search_font() ÇÔ¼ö¸¦ search_font() ÇÔ¼ö·Î ´ëÃ¼
function search_font($stx, $str)
{
    global $config;

    // ¹®ÀÚ¾Õ¿¡ \ ¸¦ ºÙÀÔ´Ï´Ù.
    $src = array("/", "|");
    $dst = array("\/", "\|");

    if (!trim($stx)) return $str;

    // °Ë»ö¾î ÀüÃ¼¸¦ °ø¶õÀ¸·Î ³ª´«´Ù
    $s = explode(" ", $stx);

    // "/(°Ë»ö1|°Ë»ö2)/i" ¿Í °°Àº ÆÐÅÏÀ» ¸¸µë
    $pattern = "";
    $bar = "";
    for ($m=0; $m<count($s); $m++) {
        if (trim($s[$m]) == "") continue;
        // ÅÂ±×´Â Æ÷ÇÔÇÏÁö ¾Ê¾Æ¾ß ÇÏ´Âµ¥ Àß ¾ÈµÇ´Â±º. ¤Ñ¤Ña
        //$pattern .= $bar . '([^<])(' . quotemeta($s[$m]) . ')';
        //$pattern .= $bar . quotemeta($s[$m]);
        //$pattern .= $bar . str_replace("/", "\/", quotemeta($s[$m]));
        $tmp_str = quotemeta($s[$m]);
        $tmp_str = str_replace($src, $dst, $tmp_str);
        $pattern .= $bar . $tmp_str . "(?![^<]*>)";
        $bar = "|";
    }

    // ÁöÁ¤µÈ °Ë»ö ÆùÆ®ÀÇ »ö»ó, ¹è°æ»ö»óÀ¸·Î ´ëÃ¼
    $replace = "<span style='background-color:$config[cf_search_bgcolor]; color:$config[cf_search_color];'>\\1</span>";

    return preg_replace("/($pattern)/i", $replace, $str);
}


// Á¦¸ñÀ» º¯È¯
function conv_subject($subject, $len, $suffix="")
{
    return cut_str(get_text($subject), $len, $suffix);
}

// OBJECT ÅÂ±×ÀÇ XSS ¸·±â
function bad120422($matches)
{
    $tag  = $matches[1];
    $code = $matches[2];
    if (preg_match("#\bscript\b#i", $code)) {
        return "$tag ÅÂ±×¿¡ ½ºÅ©¸³Æ®´Â »ç¿ë ºÒ°¡ÇÕ´Ï´Ù.";
    } else if (preg_match("#\bbase64\b#i", $code)) {
        return "$tag ÅÂ±×¿¡ BASE64´Â »ç¿ë ºÒ°¡ÇÕ´Ï´Ù.";
    }
    return $matches[0];
}

// tag ³»ÀÇ ÁÖ¼®¹® ¹«È¿È­ ÇÏ±â
function bad130128($matches)
{
    $str = $matches[2];
    return '<'.$matches[1].preg_replace('#(\/\*|\*\/)#', '', $str).'>';
}

// ³»¿ëÀ» º¯È¯
function conv_content($content, $html)
{
    global $config, $board;

    if ($html)
    {
        $source = array();
        $target = array();

        $source[] = "//";
        $target[] = "";

        if ($html == 2) { // ÀÚµ¿ ÁÙ¹Ù²Þ
            $source[] = "/\n/";
            $target[] = "<br/>";
        }

        // Å×ÀÌºí ÅÂ±×ÀÇ °¹¼ö¸¦ ¼¼¾î Å×ÀÌºíÀÌ ±úÁöÁö ¾Êµµ·Ï ÇÑ´Ù.
        $table_begin_count = substr_count(strtolower($content), "<table");
        $table_end_count = substr_count(strtolower($content), "</table");
        for ($i=$table_end_count; $i<$table_begin_count; $i++)
        {
            $content .= "</table>";
        }

        $content = preg_replace_callback("/<([^>]+)>/s", 'bad130128', $content); 

        $content = preg_replace($source, $target, $content);
        $content = bad_tag_convert($content);

        // XSS (Cross Site Script) ¸·±â
        // ¿Ïº®ÇÑ XSS ¹æÁö´Â ¾ø´Ù.
        
        // ÀÌ·± °æ¿ì¸¦ ¹æÁöÇÔ <IMG STYLE="xss:expr/*XSS*/ession(alert('XSS'))">
        //$content = preg_replace("#\/\*.*\*\/#iU", "", $content);
        // À§ÀÇ Á¤±Ô½ÄÀÌ ¾Æ·¡¿Í °°Àº ³»¿ëÀ» Åë°ú½ÃÅ°¹Ç·Î not greedy(ºñÅ½¿å¼ö·®ÀÚ?) ¿É¼ÇÀ» Á¦°ÅÇÔ. ignore case ¿É¼Çµµ ÇÊ¿ä ¾øÀ¸¹Ç·Î Á¦°Å
        // <IMG STYLE="xss:ex//*XSS*/**/pression(alert('XSS'))"></IMG>
        $content = preg_replace("#\/\*.*\*\/#", "", $content);

        // object, embed ÅÂ±×¿¡¼­ javascript ÄÚµå ¸·±â
        $content = preg_replace_callback("#<(object|embed)([^>]+)>#i", "bad120422", $content);

        $content = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $content);
        $content = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $content);
        $content = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $content);
        $content = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $content);
        $content = preg_replace_callback("#<([^>]+)#", create_function('$m', 'return "<".str_replace("<", "&lt;", $m[1]);'), $content);
        //$content = preg_replace("/\<(\w|\s|\?)*(xml)/i", "", $content);
        $content = preg_replace("/\<(\w|\s|\?)*(xml)/i", "_$1$2_", $content);

        // ÇÃ·¡½ÃÀÇ ¾×¼Ç½ºÅ©¸³Æ®¿Í ÀÚ¹Ù½ºÅ©¸³Æ®ÀÇ ¿¬µ¿À» Â÷´ÜÇÏ¿© ¾ÇÀÇÀûÀÎ »çÀÌÆ®·ÎÀÇ ÀÌµ¿À» ¸·´Â´Ù.
        // value="always" ¸¦ value="never" ·Î, allowScriptaccess="always" ¸¦ allowScriptaccess="never" ·Î º¯È¯ÇÏ´Âµ¥ ¸ñÀûÀÌ ÀÖ´Ù.
        $content = preg_replace("/((?<=\<param|\<embed)[^>]+)(\s*=\s*[\'\"]?)always([\'\"]?)([^>]+(?=\>))/i", "$1$2never$3$4", $content);

        // ÀÌ¹ÌÁö ÅÂ±×ÀÇ src ¼Ó¼º¿¡ »èÁ¦µîÀÇ ¸µÅ©°¡ ÀÖ´Â °æ¿ì °Ô½Ã¹°À» È®ÀÎÇÏ´Â °Í¸¸À¸·Îµµ µ¥ÀÌÅÍÀÇ À§º¯Á¶°¡ °¡´ÉÇÏ¹Ç·Î ÀÌ°ÍÀ» ¸·À½
        $content = preg_replace("/<(img[^>]+delete\.php[^>]+bo_table[^>]+)/i", "*** CSRF °¨Áö : &lt;$1", $content);
        $content = preg_replace("/<(img[^>]+delete_comment\.php[^>]+bo_table[^>]+)/i", "*** CSRF °¨Áö : &lt;$1", $content);
        $content = preg_replace("/<(img[^>]+logout\.php[^>]+)/i", "*** CSRF °¨Áö : &lt;$1", $content);
        $content = preg_replace("/<(img[^>]+download\.php[^>]+bo_table[^>]+)/i", "*** CSRF °¨Áö : &lt;$1", $content);

        $content = preg_replace_callback("#style\s*=\s*[\"\']?[^\"\']+[\"\']?#i",
                    create_function('$matches', 'return str_replace("\\\\", "", stripslashes($matches[0]));'), $content);

        $pattern = "";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(x|&#(x78|120);?)";
        $pattern .= "(p|&#(x70|112);?)";
        $pattern .= "(r|&#(x72|114);?)";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(s|&#(x73|115);?)";
        $pattern .= "(s|&#(x73|115);?)";
        //$pattern .= "(i|&#(x6a|105);?)";
        $pattern .= "(i|&#(x69|105);?)";
        $pattern .= "(o|&#(x6f|111);?)";
        $pattern .= "(n|&#(x6e|110);?)";
        //$content = preg_replace("/".$pattern."/i", "__EXPRESSION__", $content);
        $content = preg_replace("/<[^>]*".$pattern."/i", "__EXPRESSION__", $content); 
        // <IMG STYLE="xss:e\xpression(alert('XSS'))"></IMG> ¿Í °°Àº ÄÚµå¿¡ Ãë¾àÁ¡ÀÌ ÀÖ¾î ¼öÁ¤ÇÔ. 121213
        $content = preg_replace("/(?<=style)(\s*=\s*[\"\']?xss\:)/i", '="__XSS__', $content); 
    }
    else // text ÀÌ¸é
    {
        // & Ã³¸® : &amp; &nbsp; µîÀÇ ÄÚµå¸¦ Á¤»ó Ãâ·ÂÇÔ
        $content = html_symbol($content);

        // °ø¹é Ã³¸®
		//$content = preg_replace("/  /", "&nbsp; ", $content);
		$content = str_replace("  ", "&nbsp; ", $content);
		$content = str_replace("\n ", "\n&nbsp;", $content);

        $content = get_text($content, 1);

        $content = url_auto_link($content);
    }

    return $content;
}


// °Ë»ö ±¸¹®À» ¾ò´Â´Ù.
function get_sql_search($search_ca_name, $search_field, $search_text, $search_operator='and')
{
    global $g4;

    $str = "";
    if ($search_ca_name)
        $str = " ca_name = '$search_ca_name' ";

    $search_text = strip_tags(($search_text));
    $search_text = trim(stripslashes($search_text));

    if (!$search_text) {
        if ($search_ca_name) {
            return $str;
        } else {
            return '0';
        }
    }

    if ($str)
        $str .= " and ";

    // Äõ¸®ÀÇ ¼Óµµ¸¦ ³ôÀÌ±â À§ÇÏ¿© ( ) ´Â ÃÖ¼ÒÈ­ ÇÑ´Ù.
    $op1 = "";

    // °Ë»ö¾î¸¦ ±¸ºÐÀÚ·Î ³ª´«´Ù. ¿©±â¼­´Â °ø¹é
    $s = array();
    $s = explode(" ", $search_text);

    // °Ë»öÇÊµå¸¦ ±¸ºÐÀÚ·Î ³ª´«´Ù. ¿©±â¼­´Â +
    $tmp = array();
    $tmp = explode(",", trim($search_field));
    $field = explode("||", $tmp[0]);
    $not_comment = $tmp[1];

    $str .= "(";
    for ($i=0; $i<count($s); $i++) {
        // °Ë»ö¾î
        $search_str = trim($s[$i]);
        if ($search_str == "") continue;

        // ÀÎ±â°Ë»ö¾î
        $sql = " insert into $g4[popular_table] set pp_word = '$search_str', pp_date = '$g4[time_ymd]', pp_ip = '$_SERVER[REMOTE_ADDR]' ";
        sql_query($sql, FALSE);

        $str .= $op1;
        $str .= "(";

        $op2 = "";
        for ($k=0; $k<count($field); $k++) { // ÇÊµåÀÇ ¼ö¸¸Å­ ´ÙÁß ÇÊµå °Ë»ö °¡´É (ÇÊµå1+ÇÊµå2...)

            // SQL Injection ¹æÁö
            // ÇÊµå°ª¿¡ a-z A-Z 0-9 _ , | ÀÌ¿ÜÀÇ °ªÀÌ ÀÖ´Ù¸é °Ë»öÇÊµå¸¦ wr_subject ·Î ¼³Á¤ÇÑ´Ù.
            $field[$k] = preg_match("/^[\w\,\|]+$/", $field[$k]) ? $field[$k] : "wr_subject";

            $str .= $op2;
            switch ($field[$k]) {
                case "mb_id" :
                case "wr_name" :
                    $str .= " $field[$k] = '$s[$i]' ";
                    break;
                case "wr_hit" :
                case "wr_good" :
                case "wr_nogood" :
                    $str .= " $field[$k] >= '$s[$i]' ";
                    break;
                // ¹øÈ£´Â ÇØ´ç °Ë»ö¾î¿¡ -1 À» °öÇÔ
                case "wr_num" :
                    $str .= "$field[$k] = ".((-1)*$s[$i]);
                    break;
                case "wr_ip" :
                case "wr_password" :
                    $str .= "1=0"; // Ç×»ó °ÅÁþ
                    break;
                // LIKE º¸´Ù INSTR ¼Óµµ°¡ ºü¸§
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER($field[$k]), LOWER('$search_str'))";
                    else
                        $str .= "INSTR($field[$k], '$search_str')";
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " $search_operator ";
    }
    $str .= " ) ";
    if ($not_comment)
        $str .= " and wr_is_comment = '0' ";

    return $str;
}


// °Ô½ÃÆÇ Å×ÀÌºí¿¡¼­ ÇÏ³ªÀÇ ÇàÀ» ÀÐÀ½
function get_write($write_table, $wr_id)
{
    return sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");
}


// °Ô½ÃÆÇÀÇ ´ÙÀ½±Û ¹øÈ£¸¦ ¾ò´Â´Ù.
function get_next_num($table)
{
    // °¡Àå ÀÛÀº ¹øÈ£¸¦ ¾ò¾î
    $sql = " select min(wr_num) as min_wr_num from $table ";
    $row = sql_fetch($sql);
    // °¡Àå ÀÛÀº ¹øÈ£¿¡ 1À» »©¼­ ³Ñ°ÜÁÜ
    return (int)($row[min_wr_num] - 1);
}


// ±×·ì ¼³Á¤ Å×ÀÌºí¿¡¼­ ÇÏ³ªÀÇ ÇàÀ» ÀÐÀ½
function get_group($gr_id)
{
    global $g4;

    return sql_fetch(" select * from $g4[group_table] where gr_id = '$gr_id' ");
}


// È¸¿ø Á¤º¸¸¦ ¾ò´Â´Ù.
function get_member($mb_id, $fields='*')
{
    global $g4;

    return sql_fetch(" select $fields from $g4[member_table] where mb_id = TRIM('$mb_id') ");
}


// ³¯Â¥, Á¶È¸¼öÀÇ °æ¿ì ³ôÀº ¼ø¼­´ë·Î º¸¿©Á®¾ß ÇÏ¹Ç·Î $flag ¸¦ Ãß°¡
// $flag : asc ³·Àº ¼ø¼­ , desc ³ôÀº ¼ø¼­
// Á¦¸ñº°·Î ÄÃ·³ Á¤·ÄÇÏ´Â QUERY STRING
function subject_sort_link($col, $query_string='', $flag='asc')
{
    global $sst, $sod, $sfl, $stx, $page;

    $q1 = "sst=$col";
    if ($flag == 'asc')
    {
        $q2 = 'sod=asc';
        if ($sst == $col)
        {
            if ($sod == 'asc')
            {
                $q2 = 'sod=desc';
            }
        }
    }
    else
    {
        $q2 = 'sod=desc';
        if ($sst == $col)
        {
            if ($sod == 'desc')
            {
                $q2 = 'sod=asc';
            }
        }
    }

    return "<a href='$_SERVER[PHP_SELF]?$query_string&$q1&$q2&sfl=$sfl&stx=$stx&page=$page'>";
}


// °ü¸®ÀÚ Á¤º¸¸¦ ¾òÀ½
function get_admin($admin='super')
{
    global $config, $group, $board;
    global $g4;

    $is = false;
    if ($admin == 'board') {
        $mb = sql_fetch("select * from $g4[member_table] where mb_id in ('$board[bo_admin]') limit 1 ");
        $is = true;
    }

    if (($is && !$mb[mb_id]) || $admin == 'group') {
        $mb = sql_fetch("select * from $g4[member_table] where mb_id in ('$group[gr_admin]') limit 1 ");
        $is = true;
    }

    if (($is && !$mb[mb_id]) || $admin == 'super') {
        $mb = sql_fetch("select * from $g4[member_table] where mb_id in ('$config[cf_admin]') limit 1 ");
    }

    return $mb;
}


// °ü¸®ÀÚÀÎ°¡?
function is_admin($mb_id)
{
    global $config, $group, $board;

    if (!$mb_id) return;

    if ($config['cf_admin'] == $mb_id) return 'super';
    if ($group['gr_admin'] == $mb_id) return 'group';
    if ($board['bo_admin'] == $mb_id) return 'board';
    return '';
}


// ºÐ·ù ¿É¼ÇÀ» ¾òÀ½
// 4.00 ¿¡¼­´Â Ä«Å×°í¸® Å×ÀÌºíÀ» ¾ø¾Ö°í º¸µåÅ×ÀÌºí¿¡ ÀÖ´Â ³»¿ëÀ¸·Î ´ëÃ¼
function get_category_option($bo_table='')
{
    global $g4, $board;

    /*
    $sql = " select bo_category_list from $g4[board_table] where bo_table = '$bo_table' ";
    $row = sql_fetch($sql);
    $arr = explode("|", $row[bo_category_list]); // ±¸ºÐÀÚ°¡ , ·Î µÇ¾î ÀÖÀ½
    */
    $arr = explode("|", $board[bo_category_list]); // ±¸ºÐÀÚ°¡ , ·Î µÇ¾î ÀÖÀ½
    $str = "";
    for ($i=0; $i<count($arr); $i++)
        if (trim($arr[$i]))
            $str .= "<option value='$arr[$i]'>$arr[$i]</option>\n";

    return $str;
}


// °Ô½ÃÆÇ ±×·ìÀ» SELECT Çü½ÄÀ¸·Î ¾òÀ½
function get_group_select($name, $selected='', $event='')
{
    global $g4, $is_admin, $member;

    $sql = " select gr_id, gr_subject from $g4[group_table] a ";
    if ($is_admin == "group") {
        $sql .= " left join $g4[member_table] b on (b.mb_id = a.gr_admin)
                  where b.mb_id = '$member[mb_id]' ";
    }
    $sql .= " order by a.gr_id ";

    $result = sql_query($sql);
    $str = "<select name='$name' $event>";
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $str .= "<option value='$row[gr_id]'";
        if ($row[gr_id] == $selected) $str .= " selected";
        $str .= ">$row[gr_subject]</option>";
    }
    $str .= "</select>";
    return $str;
}


// '¿¹', '¾Æ´Ï¿À'¸¦ SELECT Çü½ÄÀ¸·Î ¾òÀ½
function get_yn_select($name, $selected='1', $event='')
{
    $str = "<select name='$name' $event>";
    if ($selected) {
        $str .= "<option value='1' selected>¿¹</option>";
        $str .= "<option value='0'>¾Æ´Ï¿À</option>";
    } else {
        $str .= "<option value='1'>¿¹</option>";
        $str .= "<option value='0' selected>¾Æ´Ï¿À</option>";
    }
    $str .= "</select>";
    return $str;
}


// Æ÷ÀÎÆ® ºÎ¿©
function insert_point($mb_id, $point, $content='', $rel_table='', $rel_id='', $rel_action='')
{
    global $config;
    global $g4;
    global $is_admin;

    // Æ÷ÀÎÆ® »ç¿ëÀ» ÇÏÁö ¾Ê´Â´Ù¸é return
    if (!$config[cf_use_point]) { return 0; }

    // Æ÷ÀÎÆ®°¡ ¾ø´Ù¸é ¾÷µ¥ÀÌÆ® ÇÒ ÇÊ¿ä ¾øÀ½
    if ($point == 0) { return 0; }

    // È¸¿ø¾ÆÀÌµð°¡ ¾ø´Ù¸é ¾÷µ¥ÀÌÆ® ÇÒ ÇÊ¿ä ¾øÀ½
    if ($mb_id == "") { return 0; }
    $mb = sql_fetch(" select mb_id from $g4[member_table] where mb_id = '$mb_id' ");
    if (!$mb[mb_id]) { return 0; }

    // ÀÌ¹Ì µî·ÏµÈ ³»¿ªÀÌ¶ó¸é °Ç³Ê¶Ü
    if ($rel_table || $rel_id || $rel_action)
    {
        $sql = " select count(*) as cnt from $g4[point_table]
                  where mb_id = '$mb_id'
                    and po_rel_table = '$rel_table'
                    and po_rel_id = '$rel_id'
                    and po_rel_action = '$rel_action' ";
        $row = sql_fetch($sql);
        if ($row[cnt])
            return -1;
    }

    // Æ÷ÀÎÆ® °Çº° »ý¼º
    $sql = " insert into $g4[point_table]
                set mb_id = '$mb_id',
                    po_datetime = '$g4[time_ymdhis]',
                    po_content = '".addslashes($content)."',
                    po_point = '$point',
                    po_rel_table = '$rel_table',
                    po_rel_id = '$rel_id',
                    po_rel_action = '$rel_action' ";
    sql_query($sql);

    // Æ÷ÀÎÆ® ³»¿ªÀÇ ÇÕÀ» ±¸ÇÏ°í
    $sql = " select sum(po_point) as sum_po_point from $g4[point_table] where mb_id = '$mb_id' ";
    $row = sql_fetch($sql);
    $sum_point = $row[sum_po_point];

    // Æ÷ÀÎÆ® UPDATE
    $sql = " update $g4[member_table] set mb_point = '$sum_point' where mb_id = '$mb_id' ";
    sql_query($sql);

    return 1;
}

// Æ÷ÀÎÆ® »èÁ¦
function delete_point($mb_id, $rel_table, $rel_id, $rel_action)
{
    global $g4;

    $result = false;
    if ($rel_table || $rel_id || $rel_action)
    {
        $result = sql_query(" delete from $g4[point_table]
                     where mb_id = '$mb_id'
                       and po_rel_table = '$rel_table'
                       and po_rel_id = '$rel_id'
                       and po_rel_action = '$rel_action' ", false);

        // Æ÷ÀÎÆ® ³»¿ªÀÇ ÇÕÀ» ±¸ÇÏ°í
        $sql = " select sum(po_point) as sum_po_point from $g4[point_table] where mb_id = '$mb_id' ";
        $row = sql_fetch($sql);
        $sum_point = $row[sum_po_point];

        // Æ÷ÀÎÆ® UPDATE
        $sql = " update $g4[member_table] set mb_point = '$sum_point' where mb_id = '$mb_id' ";
        $result = sql_query($sql);
    }

    return $result;
}

// È¸¿ø ·¹ÀÌ¾î
function get_sideview($mb_id, $name="", $email="", $homepage="")
{
    global $config;
    global $g4;

    $email = base64_encode($email);
    $homepage = set_http($homepage);

    $name = preg_replace("/\&#039;/", "", $name);
    $name = preg_replace("/\'/", "", $name);
    $name = preg_replace("/\"/", "&#034;", $name);
    $title_name = $name;

    if ($mb_id) {
        $tmp_name = "<span class='member'>$name</span>";

        if ($config['cf_use_member_icon']) {
            $mb_dir = substr($mb_id,0,2);
            $icon_file = "$g4[path]/data/member/$mb_dir/$mb_id.gif";

            //if (file_exists($icon_file) && is_file($icon_file)) {
            if (file_exists($icon_file)) {
                //$size = getimagesize($icon_file);
                //$width = $size[0];
                //$height = $size[1];
                $width = $config['cf_member_icon_width'];
                $height = $config['cf_member_icon_height'];
                $tmp_name = "<img src='$icon_file' width='$width' height='$height' align='absmiddle' border='0'>";

                if ($config['cf_use_member_icon'] == 2) // È¸¿ø¾ÆÀÌÄÜ+ÀÌ¸§
                    $tmp_name = $tmp_name . " <span class='member'>$name</span>";
            }
        }
        $title_mb_id = "[$mb_id]";
    } else {
        $tmp_name = "<span class='guest'>$name</span>";
        $title_mb_id = "[ºñÈ¸¿ø]";
    }

    $name     = get_text($name);
    $email    = get_text($email);
    $homepage = get_text($homepage);

    return "<a href=\"javascript:;\" onClick=\"showSideView(this, '$mb_id', '$name', '$email', '$homepage');\" title=\"{$title_mb_id}{$title_name}\">$tmp_name</a>";
}


// ÆÄÀÏÀ» º¸ÀÌ°Ô ÇÏ´Â ¸µÅ© (ÀÌ¹ÌÁö, ÇÃ·¡½¬, µ¿¿µ»ó)
function view_file_link($file, $width, $height, $content="")
{
    global $config, $board;
    global $g4;
    static $ids;

    if (!$file) return;

    $ids++;

    // ÆÄÀÏÀÇ ÆøÀÌ °Ô½ÃÆÇ¼³Á¤ÀÇ ÀÌ¹ÌÁöÆø º¸´Ù Å©´Ù¸é °Ô½ÃÆÇ¼³Á¤ ÆøÀ¸·Î ¸ÂÃß°í ºñÀ²¿¡ µû¶ó ³ôÀÌ¸¦ °è»ê
    if ($width > $board[bo_image_width] && $board[bo_image_width])
    {
        $rate = $board[bo_image_width] / $width;
        $width = $board[bo_image_width];
        $height = (int)($height * $rate);
    }

    // ÆøÀÌ ÀÖ´Â °æ¿ì Æø°ú ³ôÀÌÀÇ ¼Ó¼ºÀ» ÁÖ°í, ¾øÀ¸¸é ÀÚµ¿ °è»êµÇµµ·Ï ÄÚµå¸¦ ¸¸µéÁö ¾Ê´Â´Ù.
    if ($width)
        $attr = " width='$width' height='$height' ";
    else
        $attr = "";

    if (preg_match("/\.($config[cf_image_extension])$/i", $file))
        // ÀÌ¹ÌÁö¿¡ ¼Ó¼ºÀ» ÁÖÁö ¾Ê´Â ÀÌÀ¯´Â ÀÌ¹ÌÁö Å¬¸¯½Ã ¿øº» ÀÌ¹ÌÁö¸¦ º¸¿©ÁÖ±â À§ÇÑ°ÍÀÓ
        // °Ô½ÃÆÇ¼³Á¤ ÀÌ¹ÌÁöº¸´Ù Å©´Ù¸é ½ºÅ²ÀÇ ÀÚ¹Ù½ºÅ©¸³Æ®¿¡¼­ ÀÌ¹ÌÁö¸¦ ÁÙ¿©ÁØ´Ù
        return "<img src='$g4[path]/data/file/$board[bo_table]/".urlencode($file)."' name='target_resize_image[]' onclick='image_window(this);' style='cursor:pointer;' title='$content'>";
    /*
    // 110106 : FLASH XSS °ø°ÝÀ¸·Î ÀÎÇÏ¿© ÄÚµå ÀÚÃ¼¸¦ ¸·À½
    else if (preg_match("/\.($config[cf_flash_extension])$/i", $file))
        //return "<embed src='$g4[path]/data/file/$board[bo_table]/$file' $attr></embed>";
        return "<script>doc_write(flash_movie('$g4[path]/data/file/$board[bo_table]/$file', '_g4_{$ids}', '$width', '$height', 'transparent'));</script>";
    */
    //=============================================================================================
    // µ¿¿µ»ó ÆÄÀÏ¿¡ ¾Ç¼ºÄÚµå¸¦ ½É´Â °æ¿ì¸¦ ¹æÁöÇÏ±â À§ÇØ °æ·Î¸¦ ³ëÃâÇÏÁö ¾ÊÀ½
    //---------------------------------------------------------------------------------------------
    /*
    else if (preg_match("/\.($config[cf_movie_extension])$/i", $file))
        //return "<embed src='$g4[path]/data/file/$board[bo_table]/$file' $attr></embed>";
        return "<script>doc_write(obj_movie('$g4[path]/data/file/$board[bo_table]/$file', '_g4_{$ids}', '$width', '$height'));</script>";
    */
    //=============================================================================================
}


// view_file_link() ÇÔ¼ö¿¡¼­ ³Ñ°ÜÁø ÀÌ¹ÌÁö¸¦ º¸ÀÌ°Ô ÇÕ´Ï´Ù.
// {img:0} ... {img:n} °ú °°Àº Çü½Ä
function view_image($view, $number, $attribute)
{
    if ($view['file'][$number]['view'])
        return preg_replace("/>$/", " $attribute>", $view['file'][$number]['view']);
    else
        //return "{".$number."¹ø ÀÌ¹ÌÁö ¾øÀ½}";
        return "";
}


/*
// {link:0} ... {link:n} °ú °°Àº Çü½Ä
function view_link($view, $number, $attribute)
{
    global $config;

    if ($view[link][$number][link])
    {
        if (!preg_match("/target/i", $attribute))
            $attribute .= " target='$config[cf_link_target]'";
        return "<a href='{$view[link][$number][href]}' $attribute>{$view[link][$number][link]}</a>";
    }
    else
        return "{".$number."¹ø ¸µÅ© ¾øÀ½}";
}
*/


// ÇÑ±Û ÇÑ±ÛÀÚ(2byte, À¯´ÏÄÚµå 3byte)´Â ±æÀÌ 2, °ø¶õ.¿µ¼ýÀÚ.Æ¯¼ö¹®ÀÚ´Â ±æÀÌ 1
// À¯´ÏÄÚµå´Â http://g4uni.winnwe.net/bbs/board.php?bo_table=g4uni_faq&wr_id=7 ÀÇ Mr.Learn´ÔÀÇ ±ÛÀ» Âü°íÇÏ¿´½À´Ï´Ù.
function cut_str($str, $len, $suffix="¡¦")
{
    global $g4;

    if (strtoupper($g4['charset']) == 'UTF-8') {
        $c = substr(str_pad(decbin(ord($str{$len})),8,'0',STR_PAD_LEFT),0,2); 
        if ($c == '10') 
            for (;$c != '11' && $c{0} == 1;$c = substr(str_pad(decbin(ord($str{--$len})),8,'0',STR_PAD_LEFT),0,2)); 
        return substr($str,0,$len) . (strlen($str)-strlen($suffix) >= $len ? $suffix : ''); 
    } else {
        $s = substr($str, 0, $len);
        $cnt = 0;
        for ($i=0; $i<strlen($s); $i++)
            if (ord($s[$i]) > 127)
                $cnt++;
        $s = substr($s, 0, $len - ($cnt % 2));
        if (strlen($s) >= strlen($str))
            $suffix = "";
        return $s . $suffix;
    }
}


// TEXT Çü½ÄÀ¸·Î º¯È¯
function get_text($str, $html=0)
{
    /* 3.22 ¸·À½ (HTML Ã¼Å© ÁÙ¹Ù²Þ½Ã Ãâ·Â ¿À·ù¶§¹®)
    $source[] = "/  /";
    $target[] = " &nbsp;";
    */

    // 3.31
    // TEXT Ãâ·ÂÀÏ °æ¿ì &amp; &nbsp; µîÀÇ ÄÚµå¸¦ Á¤»óÀ¸·Î Ãâ·ÂÇØ ÁÖ±â À§ÇÔ
    if ($html == 0) {
        $str = html_symbol($str);
    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    //$source[] = "/\"/";
    //$target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    //$source[] = "/}/"; $target[] = "&#125;";
    if ($html) {
        $source[] = "/\n/";
        $target[] = "<br/>";
    }

    return preg_replace($source, $target, $str);
}


/*
// HTML Æ¯¼ö¹®ÀÚ º¯È¯ htmlspecialchars
function hsc($str)
{
    $trans = array("\"" => "&#034;", "'" => "&#039;", "<"=>"&#060;", ">"=>"&#062;");
    $str = strtr($str, $trans);
    return $str;
}
*/

// 3.31
// HTML SYMBOL º¯È¯
// &nbsp; &amp; &middot; µîÀ» Á¤»óÀ¸·Î Ãâ·Â
function html_symbol($str)
{
    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
}


/*************************************************************************
**
**  SQL °ü·Ã ÇÔ¼ö ¸ðÀ½
**
*************************************************************************/

// DB ¿¬°á
function sql_connect($host, $user, $pass)
{
    global $g4;

    return @mysql_connect($host, $user, $pass);
}


// DB ¼±ÅÃ
function sql_select_db($db, $connect)
{
    global $g4;

    if (strtolower($g4['charset']) == 'utf-8') @mysql_query(" set names utf8 ");
    else if (strtolower($g4['charset']) == 'euc-kr') @mysql_query(" set names euckr ");
    return @mysql_select_db($db, $connect);
}


// mysql_query ¿Í mysql_error ¸¦ ÇÑ²¨¹ø¿¡ Ã³¸®
function sql_query($sql, $error=TRUE)
{
    if ($error)
        $result = @mysql_query($sql) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = @mysql_query($sql);
    return $result;
}


// Äõ¸®¸¦ ½ÇÇàÇÑ ÈÄ °á°ú°ª¿¡¼­ ÇÑÇàÀ» ¾ò´Â´Ù.
function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql, $error);
    //$row = @sql_fetch_array($result) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    $row = sql_fetch_array($result);
    return $row;
}


// °á°ú°ª¿¡¼­ ÇÑÇà ¿¬°ü¹è¿­(ÀÌ¸§À¸·Î)·Î ¾ò´Â´Ù.
function sql_fetch_array($result)
{
    $row = @mysql_fetch_assoc($result);
    return $row;
}


// $result¿¡ ´ëÇÑ ¸Þ¸ð¸®(memory)¿¡ ÀÖ´Â ³»¿ëÀ» ¸ðµÎ Á¦°ÅÇÑ´Ù.
// sql_free_result()´Â °á°ú·ÎºÎÅÍ ¾òÀº ÁúÀÇ °ªÀÌ Ä¿¼­ ¸¹Àº ¸Þ¸ð¸®¸¦ »ç¿ëÇÒ ¿°·Á°¡ ÀÖÀ» ¶§ »ç¿ëµÈ´Ù.
// ´Ü, °á°ú °ªÀº ½ºÅ©¸³Æ®(script) ½ÇÇàºÎ°¡ Á¾·áµÇ¸é¼­ ¸Þ¸ð¸®¿¡¼­ ÀÚµ¿ÀûÀ¸·Î Áö¿öÁø´Ù.
function sql_free_result($result)
{
    return mysql_free_result($result);
}


function sql_password($value)
{
    // mysql 4.0x ÀÌÇÏ ¹öÀü¿¡¼­´Â password() ÇÔ¼öÀÇ °á°ú°¡ 16bytes
    // mysql 4.1x ÀÌ»ó ¹öÀü¿¡¼­´Â password() ÇÔ¼öÀÇ °á°ú°¡ 41bytes
    $row = sql_fetch(" select password('$value') as pass ");
    return $row[pass];
}


// PHPMyAdmin Âü°í
function get_table_define($table, $crlf="\n")
{
    global $g4;

    // For MySQL < 3.23.20
    $schema_create .= 'CREATE TABLE ' . $table . ' (' . $crlf;

    $sql = 'SHOW FIELDS FROM ' . $table;
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $schema_create .= '    ' . $row['Field'] . ' ' . $row['Type'];
        if (isset($row['Default']) && $row['Default'] != '')
        {
            $schema_create .= ' DEFAULT \'' . $row['Default'] . '\'';
        }
        if ($row['Null'] != 'YES')
        {
            $schema_create .= ' NOT NULL';
        }
        if ($row['Extra'] != '')
        {
            $schema_create .= ' ' . $row['Extra'];
        }
        $schema_create     .= ',' . $crlf;
    } // end while
    sql_free_result($result);

    $schema_create = preg_replace('/,' . $crlf . '$/', '', $schema_create);

    $sql = 'SHOW KEYS FROM ' . $table;
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $kname    = $row['Key_name'];
        $comment  = (isset($row['Comment'])) ? $row['Comment'] : '';
        $sub_part = (isset($row['Sub_part'])) ? $row['Sub_part'] : '';

        if ($kname != 'PRIMARY' && $row['Non_unique'] == 0) {
            $kname = "UNIQUE|$kname";
        }
        if ($comment == 'FULLTEXT') {
            $kname = 'FULLTEXT|$kname';
        }
        if (!isset($index[$kname])) {
            $index[$kname] = array();
        }
        if ($sub_part > 1) {
            $index[$kname][] = $row['Column_name'] . '(' . $sub_part . ')';
        } else {
            $index[$kname][] = $row['Column_name'];
        }
    } // end while
    sql_free_result($result);

    while (list($x, $columns) = @each($index)) {
        $schema_create     .= ',' . $crlf;
        if ($x == 'PRIMARY') {
            $schema_create .= '    PRIMARY KEY (';
        } else if (substr($x, 0, 6) == 'UNIQUE') {
            $schema_create .= '    UNIQUE ' . substr($x, 7) . ' (';
        } else if (substr($x, 0, 8) == 'FULLTEXT') {
            $schema_create .= '    FULLTEXT ' . substr($x, 9) . ' (';
        } else {
            $schema_create .= '    KEY ' . $x . ' (';
        }
        $schema_create     .= implode($columns, ', ') . ')';
    } // end while

    if (strtolower($g4['charset']) == "utf-8")
        $schema_create .= $crlf . ') DEFAULT CHARSET=utf8';
    else
        $schema_create .= $crlf . ')';

    return $schema_create;
} // end of the 'PMA_getTableDef()' function


// ¸®ÆÛ·¯ Ã¼Å©
function referer_check($url="")
{
    /*
    // Á¦´ë·Î Ã¼Å©¸¦ ÇÏÁö ¸øÇÏ¿© ÁÖ¼® Ã³¸®ÇÔ
    global $g4;

    if (!$url)
        $url = $g4[url];

    if (!preg_match("/^http[s]?:\/\/".$_SERVER[HTTP_HOST]."/", $_SERVER[HTTP_REFERER]))
        alert("Á¦´ë·Î µÈ Á¢±ÙÀÌ ¾Æ´Ñ°Í °°½À´Ï´Ù.", $url);
    */
}


// ÇÑ±Û ¿äÀÏ
function get_yoil($date, $full=0)
{
    $arr_yoil = array ("ÀÏ", "¿ù", "È­", "¼ö", "¸ñ", "±Ý", "Åä");

    $yoil = date("w", strtotime($date));
    $str = $arr_yoil[$yoil];
    if ($full) {
        $str .= "¿äÀÏ";
    }
    return $str;
}


// ³¯Â¥¸¦ select ¹Ú½º Çü½ÄÀ¸·Î ¾ò´Â´Ù
function date_select($date, $name="")
{
    global $g4;

    $s = "";
    if (substr($date, 0, 4) == "0000") {
        $date = $g4[time_ymdhis];
    }
    preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2})/", $date, $m);

    // ³â
    $s .= "<select name='{$name}_y'>";
    for ($i=$m[0]-3; $i<=$m[0]+3; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[0]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>³â \n";

    // ¿ù
    $s .= "<select name='{$name}_m'>";
    for ($i=1; $i<=12; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[2]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>¿ù \n";

    // ÀÏ
    $s .= "<select name='{$name}_d'>";
    for ($i=1; $i<=31; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[3]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>ÀÏ \n";

    return $s;
}


// ½Ã°£À» select ¹Ú½º Çü½ÄÀ¸·Î ¾ò´Â´Ù
// 1.04.00
// °æ¸Å¿¡ ½Ã°£ ¼³Á¤ÀÌ °¡´ÉÇÏ°Ô µÇ¸é¼­ Ãß°¡ÇÔ
function time_select($time, $name="")
{
    preg_match("/([0-9]{2}):([0-9]{2}):([0-9]{2})/", $time, $m);

    // ½Ã
    $s .= "<select name='{$name}_h'>";
    for ($i=0; $i<=23; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[0]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>½Ã \n";

    // ºÐ
    $s .= "<select name='{$name}_i'>";
    for ($i=0; $i<=59; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[2]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>ºÐ \n";

    // ÃÊ
    $s .= "<select name='{$name}_s'>";
    for ($i=0; $i<=59; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[3]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>ÃÊ \n";

    return $s;
}


// DEMO ¶ó´Â ÆÄÀÏÀÌ ÀÖÀ¸¸é µ¥¸ð È­¸éÀ¸·Î ÀÎ½ÄÇÔ
function check_demo()
{
    global $g4;
    if (file_exists("$g4[path]/DEMO"))
        alert("µ¥¸ð È­¸é¿¡¼­´Â ÇÏ½Ç(º¸½Ç) ¼ö ¾ø´Â ÀÛ¾÷ÀÔ´Ï´Ù.");
}


// ¹®ÀÚ¿­ÀÌ ÇÑ±Û, ¿µ¹®, ¼ýÀÚ, Æ¯¼ö¹®ÀÚ·Î ±¸¼ºµÇ¾î ÀÖ´ÂÁö °Ë»ç
function check_string($str, $options)
{
    global $g4;

    $s = '';
    for($i=0;$i<strlen($str);$i++) {
        $c = $str[$i];
        $oc = ord($c);

        // ÇÑ±Û
        if ($oc >= 0xA0 && $oc <= 0xFF) {
            if (strtoupper($g4['charset']) == 'UTF-8') {
                if ($options & _G4_HANGUL_) {
                    $s .= $c . $str[$i+1] . $str[$i+2];
                }
                $i+=2;
            } else {
                // ÇÑ±ÛÀº 2¹ÙÀÌÆ® ÀÌ¹Ç·Î ¹®ÀÚÇÏ³ª¸¦ °Ç³Ê¶Ü
                $i++;
                if ($options & _G4_HANGUL_) {
                    $s .= $c . $str[$i];
                }
            }
        }
        // ¼ýÀÚ
        else if ($oc >= 0x30 && $oc <= 0x39) {
            if ($options & _G4_NUMERIC_) {
                $s .= $c;
            }
        }
        // ¿µ´ë¹®ÀÚ
        else if ($oc >= 0x41 && $oc <= 0x5A) {
            if (($options & _G4_ALPHABETIC_) || ($options & _G4_ALPHAUPPER_)) {
                $s .= $c;
            }
        }
        // ¿µ¼Ò¹®ÀÚ
        else if ($oc >= 0x61 && $oc <= 0x7A) {
            if (($options & _G4_ALPHABETIC_) || ($options & _G4_ALPHALOWER_)) {
                $s .= $c;
            }
        }
        // °ø¹é
        else if ($oc == 0x20) {
            if ($options & _G4_SPACE_) {
                $s .= $c;
            }
        }
        else {
            if ($options & _G4_SPECIAL_) {
                $s .= $c;
            }
        }
    }

    // ³Ñ¾î¿Â °ª°ú ºñ±³ÇÏ¿© °°À¸¸é Âü, Æ²¸®¸é °ÅÁþ
    return ($str == $s);
}


// ÇÑ±Û(2bytes)¿¡¼­ ¸¶Áö¸· ±ÛÀÚ°¡ 1byte·Î ³¡³ª´Â °æ¿ì
// Ãâ·Â½Ã ±úÁö´Â Çö»óÀÌ ¹ß»ýÇÏ¹Ç·Î ¸¶Áö¸· ¿ÏÀüÇÏÁö ¾ÊÀº ±ÛÀÚ(1byte)¸¦ ÇÏ³ª ¾ø¾Ú
function cut_hangul_last($hangul)
{
    global $g4;

    // ÇÑ±ÛÀÌ ¹ÝÂÊ³ª¸é ?·Î Ç¥½ÃµÇ´Â Çö»óÀ» ¸·À½
    $cnt = 0;
    for($i=0;$i<strlen($hangul);$i++) {
        // ÇÑ±Û¸¸ ¼¾´Ù
        if (ord($hangul[$i]) >= 0xA0) {
            $cnt++;
        }
    }

    // È¦¼ö¶ó¸é ÇÑ±ÛÀÌ ¹ÝÂÊ³­ »óÅÂÀÌ¹Ç·Î
    if (strtoupper($g4['charset']) != 'UTF-8') {
        if ($cnt%2) {
            $hangul = substr($hangul, 0, $cnt-1);
        }
    }

    return $hangul;
}


// Å×ÀÌºí¿¡¼­ INDEX(Å°) »ç¿ë¿©ºÎ °Ë»ç
function explain($sql)
{
    if (preg_match("/^(select)/i", trim($sql))) {
        $q = "explain $sql";
        echo $q;
        $row = sql_fetch($q);
        if (!$row[key]) $row[key] = "NULL";
        echo " <font color=blue>(type=$row[type] , key=$row[key])</font>";
    }
}

// ¾Ç¼ºÅÂ±× º¯È¯
function bad_tag_convert($code)
{
    global $view;
    global $member, $is_admin;

    if ($is_admin && $member[mb_id] != $view[mb_id]) {
        //$code = preg_replace_callback("#(\<(embed|object)[^\>]*)\>(\<\/(embed|object)\>)?#i",
        // embed ¶Ç´Â object ÅÂ±×¸¦ ¸·Áö ¾Ê´Â °æ¿ì ÇÊÅÍ¸µÀÌ µÇµµ·Ï ¼öÁ¤
        $code = preg_replace_callback("#(\<(embed|object)[^\>]*)\>?(\<\/(embed|object)\>)?#i",
                    create_function('$matches', 'return "<div class=\"embedx\">º¸¾È¹®Á¦·Î ÀÎÇÏ¿© °ü¸®ÀÚ ¾ÆÀÌµð·Î´Â embed ¶Ç´Â object ÅÂ±×¸¦ º¼ ¼ö ¾ø½À´Ï´Ù. È®ÀÎÇÏ½Ã·Á¸é °ü¸®±ÇÇÑÀÌ ¾ø´Â ´Ù¸¥ ¾ÆÀÌµð·Î Á¢¼ÓÇÏ¼¼¿ä.</div>";'),
                    $code);
    }

    //return preg_replace("/\<([\/]?)(script|iframe)([^\>]*)\>/i", "&lt;$1$2$3&gt;", $code);
    // script ³ª iframe ÅÂ±×¸¦ ¸·Áö ¾Ê´Â °æ¿ì ÇÊÅÍ¸µÀÌ µÇµµ·Ï ¼öÁ¤
    return preg_replace("/\<([\/]?)(script)([^\>]*)\>?/i", "&lt;$1$2$3&gt;", $code);
}


// ºÒ¹ýÁ¢±ÙÀ» ¸·µµ·Ï ÅäÅ«À» »ý¼ºÇÏ¸é¼­ ÅäÅ«°ªÀ» ¸®ÅÏ
function get_token()
{
    $token = md5(uniqid(rand(), true));
    set_session("ss_token", $token);

    return $token;
}


// POST·Î ³Ñ¾î¿Â ÅäÅ«°ú ¼¼¼Ç¿¡ ÀúÀåµÈ ÅäÅ« ºñ±³
function check_token()
{
    set_session('ss_token', '');
    return true;
}


// ¹®ÀÚ¿­¿¡ utf8 ¹®ÀÚ°¡ µé¾î ÀÖ´ÂÁö °Ë»çÇÏ´Â ÇÔ¼ö
// ÄÚµå : http://in2.php.net/manual/en/function.mb-check-encoding.php#95289
function is_utf8($str) 
{ 
    $len = strlen($str); 
    for($i = 0; $i < $len; $i++) {
        $c = ord($str[$i]); 
        if ($c > 128) { 
            if (($c > 247)) return false; 
            elseif ($c > 239) $bytes = 4; 
            elseif ($c > 223) $bytes = 3; 
            elseif ($c > 191) $bytes = 2; 
            else return false; 
            if (($i + $bytes) > $len) return false; 
            while ($bytes > 1) { 
                $i++; 
                $b = ord($str[$i]); 
                if ($b < 128 || $b > 191) return false; 
                $bytes--; 
            } 
        } 
    } 
    return true; 
}
?>
