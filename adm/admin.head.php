<?
if (!defined("_GNUBOARD_")) exit;

$begin_time = get_microtime();

include_once("$g4[path]/head.sub.php");

function print_menu1($key, $no)
{
    global $menu;

    $str = "<table width=130 cellpadding=1 cellspacing=0 id='menu_{$key}' style='position:absolute; display:none; z-index:1;' onpropertychange=\"selectBoxHidden('menu_{$key}')\"><colgroup><colgroup><colgroup width=10><tr><td rowspan=2 colspan=2 bgcolor=#EFCA95><table width=127 cellpadding=0 cellspacing=0 bgcolor=#FEF8F0><colgroup style='padding-left:10px'>";
    $str .= print_menu2($key, $no);
    $str .= "</table></td><td></td></tr><tr><td bgcolor=#DDDAD5 height=40></td></tr><tr><td width=4></td><td height=3 width=127 bgcolor=#DDDAD5></td><td bgcolor=#DDDAD5></td></tr></table>\n";

    return $str;
}


function print_menu2($key, $no)
{
    global $menu, $auth_menu, $is_admin, $auth, $g4;

    $str = "";
    for($i=1; $i<count($menu[$key]); $i++)
    {
        if ($is_admin != "super" && (!array_key_exists($menu[$key][$i][0],$auth) || !strstr($auth[$menu[$key][$i][0]], "r")))
            continue;

        if ($menu[$key][$i][0] == "-")
            $str .= "<tr><td class=bg_line{$no}></td></tr>";
        else
        {
            $span1 = $span2 = "";
            if (isset($menu[$key][$i][3]))
            {
                $span1 = "<span style='{$menu[$key][$i][3]}'>";
                $span2 = "</span>";
            }
            $str .= "<tr><td class=bg_menu{$no}>";
            if ($no == 2)
                $str .= "&nbsp;&nbsp;<img src='{$g4[admin_path]}/img/icon.gif' align=absmiddle> ";
            $str .= "<a href='{$menu[$key][$i][2]}' style='color:#555500;'>{$span1}{$menu[$key][$i][1]}{$span2}</a></td></tr>";

            $auth_menu[$menu[$key][$i][0]] = $menu[$key][$i][1];
        }
    }

    return $str;
}
?>

<script type="text/javascript">
if (!g4_is_ie) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;
var prevdiv = null;
var timerID = null;

function getMouseXY(e) 
{
    if (g4_is_ie) { // grab the x-y pos.s if browser is IE
        tempX = event.clientX + document.body.scrollLeft;
        tempY = event.clientY + document.body.scrollTop;
    } else {  // grab the x-y pos.s if browser is NS
        tempX = e.pageX;
        tempY = e.pageY;
    }  

    if (tempX < 0) {tempX = 0;}
    if (tempY < 0) {tempY = 0;}  

    return true;
}

function imageview(id, w, h)
{

    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - ( w + 11 );
    submenu.top  = tempY - ( h / 2 );

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}

function help(id, left, top)
{
    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - 50 + left;
    submenu.top  = tempY + 15 + top;

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}

// TEXTAREA 사이즈 변경
function textarea_size(fld, size)
{
	var rows = parseInt(fld.rows);

	rows += parseInt(size);
	if (rows > 0) {
		fld.rows = rows;
	}
}
</script>

<script type="text/javascript" src="<?=$g4['path']?>/js/common.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/sideview.js"></script>
<script type="text/javascript">
var save_layer = null;
function layer_view(link_id, menu_id, opt, x, y)
{
    var link = document.getElementById(link_id);
    var menu = document.getElementById(menu_id);

    //for (i in link) { document.write(i + '<br/>'); } return;

    if (save_layer != null)
    {
        save_layer.style.display = "none";
        selectBoxVisible();
    }

    if (link_id == '')
        return;

    if (opt == 'hide')
    {
        menu.style.display = 'none';
        selectBoxVisible();
    }
    else
    {
        x = parseInt(x);
        y = parseInt(y);
        menu.style.left = get_left_pos(link) + x;
        menu.style.top  = get_top_pos(link) + link.offsetHeight + y;
        menu.style.display = 'block';
    }

    save_layer = menu;
}
</script>

<link rel="stylesheet" href="<?=$g4['admin_path']?>/admin.style.css" type="text/css">
<a name='gnuboard4_admin_head'></a>



<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admin_topbg">
  <tr>
    <td align="left" style="padding:0px 25px 0px 25px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td align="right" id="admin_topbt">
  <a href="http://dahanweb.co.kr/dahanweb/" target="_blank">다한웹 바로가기</a>
  <a href="http://dahanweb.co.kr/dahanweb/sub0301.php" target="_blank">유지비용안내</a>
  <a href="mailtop:dw@dahanweb.co.kr" class="admin_topbt_on">dw@dahanweb.co.kr</a>
  </td></tr>
  <tr><td>
<table width="1100" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="admin_logo"><a href='<?=$g4['admin_path']?>/'>ADMINISTRATOR</td>
    <td id="amdin_topmenu">
    <a href="/gnuboard4/adm/config_form.php" class="admin_tm01">기본환경설정</a>
    <a href="/gnuboard4/adm/member_list.php" class="admin_tm02">회원관리</a>
    <a href="/gnuboard4/adm/visit_list.php" class="admin_tm03">접속자통계</a>
    <a href="/gnuboard4/adm/board_list.php" class="admin_tm04">게시판관리</a>
    <a href="/gnuboard4/adm/site_popup_list.php" class="admin_tm05">팝업관리</a>
    <a href="/gnuboard4/adm/online_list.php" class="admin_tm06">문의관리</a>
    <!--a href="/gnuboard4/adm/sms_admin/config.php" class="admin_tm07">SMS관리</a-->
    </td>
  </tr>
</table>
  </td></tr>
  <tr><td align="right" id="admin_top_mov">
  <a href='<?=$g4['path']?>/'>내홈페이지</a>
  <a href='<?=$g4['bbs_path']?>/logout.php'>로그아웃</a>
  <a href='http://dahanweb.co.kr/dahanweb/sub0301.php' target='_blank' class='pri_ce'>유지비용안내</a>
  </td></tr>
  <tr><td style="padding:30px 0px 30px 0px;">
