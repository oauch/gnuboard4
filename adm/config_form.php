<?
$sub_menu = "100100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

// 쪽지보낼시 차감 포인트 필드 추가 : 061218
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_memo_send_point` INT NOT NULL AFTER `cf_login_point` ", FALSE);

// 개인정보보호정책 필드 추가 : 061121
$sql = " ALTER TABLE `$g4[config_table]` ADD `cf_privacy` TEXT NOT NULL AFTER `cf_stipulation` ";
sql_query($sql, FALSE);
if (!trim($config[cf_privacy])) {
    $config[cf_privacy] = "해당 홈페이지에 맞는 개인정보취급방침을 입력합니다.";
}

$g4['title'] = "기본환경설정";
include_once ("./admin.head.php");
?>

<? $admin_HadeNum = "01"; ?>

<!-- 
// 2016.12.13 이전 목록은 config_form-original.php 에 있습니다. 
// 기본설정부터 회원가입설정등은  config_form-original.php를 참조부탁드리며 
// 사용하는 부분만 살려놓았습니다. 
 -->

<form name='fconfigform' method='post' onsubmit="return fconfigform_submit(this);">
<input type=hidden name=token value='<?=$token?>'>

<table width=100% cellpadding=0 cellspacing=0 border=0 class="admin_basic_board_write">
<colgroup width=20%>
<colgroup width=30%>
<colgroup width=20%>
<colgroup width=30%>
<tr>
    <td colspan=4 align=left><div class="admin_title01">기본 설정</div> <!-- ?=subtitle("기본 설정")? --></td>
</tr>

<tr>
    <td class="admin_basic_board_writetd">상호명</td>
    <td>
        <input type=text name='cf_title' size='30' required itemname='홈페이지 제목' value='<?=$config[cf_title]?>'>
    </td>
    <td class="admin_basic_board_writetd">최고관리자</td>
    <td><?=get_member_id_select("cf_admin", 10, $config[cf_admin], "required itemname='최고 관리자'")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">이름(별명) 표시</td>
    <td colspan=3><input type=text name='cf_cut_name' value='<?=$config[cf_cut_name]?>' size=4> 자리만 표시
        <?=help("영숫자 2글자 = 한글 1글자")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">별명 수정</td>
    <td>수정한 후 <input type=text name='cf_nick_modify' value='<?=$config[cf_nick_modify]?>' size=4> 일 동안 바꿀 수 없음</td>
    <td class="admin_basic_board_writetd">정보공개 수정</td>
    <td>수정한 후 <input type=text name='cf_open_modify' value='<?=$config[cf_open_modify]?>' size=4> 일 동안 바꿀 수 없음</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">최근게시물 삭제</td>
    <td><input type=text name='cf_new_del' value='<?=$config[cf_new_del]?>' size=7> 일
        <?=help("설정일이 지난 최근게시물 자동 삭제")?></td>
    <td class="admin_basic_board_writetd">쪽지 삭제</td>
    <td><input type=text name='cf_memo_del' value='<?=$config[cf_memo_del]?>' size=7> 일
        <?=help("설정일이 지난 쪽지 자동 삭제")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">접속자로그 삭제</td>
    <td><input type=text name='cf_visit_del' value='<?=$config[cf_visit_del]?>' size=7> 일
        <?=help("설정일이 지난 접속자 로그 자동 삭제")?></td>
    <td class="admin_basic_board_writetd">인기검색어 삭제</td>
    <td><input type=text name='cf_popular_del' value='<?=$config[cf_popular_del]?>' size=7> 일
        <?=help("설정일이 지난 인기검색어 자동 삭제")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">현재 접속자</td>
    <td><input type=text name='cf_login_minutes' value='<?=$config[cf_login_minutes]?>' size=7> 분
        <?=help("설정값 이내의 접속자를 현재 접속자로 인정")?></td>
    <td class="admin_basic_board_writetd">한페이지당 라인수</td>
    <td><input type=text name='cf_page_rows' value='<?=$config[cf_page_rows]?>' size=7> 라인
        <?=help("목록(리스트) 한페이지당 라인수")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">복사, 이동시 로그</td>
    <td colspan=3><input class='admin_input_box' type='checkbox' name='cf_use_copy_log' value='1' <?=$config[cf_use_copy_log]?'checked':'';?>> 남김
        <?=help("게시물 아래에 누구로 부터 복사, 이동됨 표시")?></td>
    <!-- <td>자동등록방지 사용</td>
    <td><input type='checkbox' name='cf_use_norobot' value='1' <?=$config[cf_use_norobot]?'checked':'';?>> 사용
        <?=help("자동 회원가입과 글쓰기를 방지")?></td> -->
</tr>
<tr>
    <td class="admin_basic_board_writetd">접근가능 IP</td>
    <td valign=top><textarea name='cf_possible_ip' rows='5' style='width:99%;'><?=$config[cf_possible_ip]?> </textarea><br>입력된 IP의 컴퓨터만 접근할 수 있음.<br>123.123.+ 도 입력 가능. (엔터로 구분)</td>
    <td>접근차단 IP</td>
    <td valign=top><textarea name='cf_intercept_ip' rows='5' style='width:99%;'><?=$config[cf_intercept_ip]?> </textarea><br>입력된 IP의 컴퓨터는 접근할 수 없음.<br>123.123.+ 도 입력 가능. (엔터로 구분)</td>
</tr>




<tr>
    <td colspan=4 align=left><div class="admin_title01">게시판 설정</div> <!-- ?=subtitle("게시판 설정")? --></td>
</tr>

<tr>
    <td class="admin_basic_board_writetd">LINK TARGET</td>
    <td><input type=text name='cf_link_target' size='10' value='<?=$config[cf_link_target]?>'> 
        <?=help("게시판 내용중 자동으로 링크되는 창의 타켓을 지정합니다.\n\n_self, _top, _blank, _new 를 주로 지정합니다.")?></td>
    <td class="admin_basic_board_writetd">검색 단위</td>
    <td><input type=text name='cf_search_part' size='10' itemname='검색 단위' value='<?=$config[cf_search_part]?>'> 건 단위로 검색</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">검색 배경 색상</td>
    <td><input type=text name='cf_search_bgcolor' size='10' required itemname='검색 배경 색상' value='<?=$config[cf_search_bgcolor]?>'></td>
    <td class="admin_basic_board_writetd">검색 글자 색상</td>
    <td><input type=text name='cf_search_color' size='10' required itemname='검색 글자 색상' value='<?=$config[cf_search_color]?>'></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">새로운 글쓰기</td>
    <td><input type=text name='cf_delay_sec' size='10' required itemname='새로운 글쓰기' value='<?=$config[cf_delay_sec]?>'> 초 지난후 가능</td>
    <td class="admin_basic_board_writetd">페이지 표시 수</td>
    <td><input type=text name='cf_write_pages' size='10' required itemname='페이지 표시 수' value='<?=$config[cf_write_pages]?>'> 페이지씩 표시</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">이미지 업로드 확장자</td>
    <td colspan=3><input type=text name='cf_image_extension' size='80' itemname='이미지 업로드 확장자' value='<?=$config[cf_image_extension]?>'>
        <?=help("게시판 글작성시 이미지 파일 업로드 가능 확장자. | 로 구분")?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">단어 필터링
        <?=help("입력된 단어가 포함된 내용은 게시할 수 없습니다.\n\n단어와 단어 사이는 ,로 구분합니다.")?></td>
    <td colspan=3><textarea name='cf_filter' rows='7' style='width:99%;'><?=$config[cf_filter]?> </textarea></td>
</tr>




<tr>
    <td colspan=4 align=left><div class="admin_title01">회원가입설정</div> <!-- ?=subtitle("회원가입 설정")? --></td>
</tr>

<tr>
    <td class="admin_basic_board_writetd">회원 스킨</td>
    <td colspan=3><select id=cf_member_skin name=cf_member_skin required itemname="회원가입 스킨">
        <?
        $arr = get_skin_dir("member");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script type="text/javascript"> document.getElementById('cf_member_skin').value="<?=$config[cf_member_skin]?>";</script>
    </td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">회원가입시 권한</td>
    <td><? echo get_member_level_select('cf_register_level', 1, 9, $config[cf_register_level]) ?></td>
    <td class="admin_basic_board_writetd">회원가입시 포인트</td>
    <td><input type=text name='cf_register_point' size='5' value='<?=$config[cf_register_point]?>'> 점</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">회원탈퇴후 삭제일</td>
    <td colspan="3"><input type=text name='cf_leave_day' size='5' value='<?=$config[cf_leave_day]?>'> 일 후 자동 삭제</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">아이디,별명 금지단어
        <?=help("입력된 단어가 포함된 내용은 회원아이디, 별명으로 사용할 수 없습니다.\n\n단어와 단어 사이는 , 로 구분합니다.")?></td>
    <td valign=top><textarea name='cf_prohibit_id' rows='3' style='width:99%;'><?=$config[cf_prohibit_id]?> </textarea></td>
    <td class="admin_basic_board_writetd">입력 금지 메일
        <?=help("hanmail.net과 같은 메일 주소는 입력을 못합니다.\n\n엔터로 구분합니다.")?></td>
    <td valign=top><textarea name='cf_prohibit_email' rows='3' style='width:99%;'><?=$config[cf_prohibit_email]?> </textarea><br></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">회원가입약관</td>
    <td valign=top colspan=3><textarea name='cf_stipulation' rows='5' style='width:99%;'><?=$config[cf_stipulation]?> </textarea></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">개인정보취급방침</td>
    <td valign=top colspan=3><textarea name='cf_privacy' rows='5' style='width:99%;'><?=$config[cf_privacy]?> </textarea></td>
</tr>




<tr>
    <td colspan=4 align=left><div class="admin_title01">메일설정</div> <!-- ?=subtitle("메일 설정")? --></td>
</tr>


<tr>
    <td class="admin_basic_board_writetd">메일발송 사용</td>
    <td colspan=3><input class='admin_input_box' type=checkbox name=cf_email_use value='1' <?=$config[cf_email_use]?'checked':'';?>> 사용 (체크하지 않으면 메일발송을 아예 사용하지 않습니다. 메일 테스트도 불가합니다.)</td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">메일인증 사용</td>
    <td><input class='admin_input_box' type='checkbox' name='cf_use_email_certify' value='1' <?=$config[cf_use_email_certify]?'checked':'';?>> 사용
        <?=help("메일에 배달된 인증 주소를 클릭하여야 회원으로 인정합니다.");?></td>
</tr>
<tr>
    <td class="admin_basic_board_writetd">폼메일 사용 여부</td>
    <td><input class='admin_input_box' type='checkbox' name='cf_formmail_is_member' value='1' <?=$config[cf_formmail_is_member]?'checked':'';?>> 회원만 사용
        <?=help("체크하지 않으면 비회원도 사용 할 수 있습니다.")?></td>
</tr>








<tr>
    <td colspan=4 align=left>
        <div class="admin_title01">XSS / CSRF 방지</div>  <!-- ?=subtitle("XSS / CSRF 방지")? -->
    </td>
</tr>

<tr>
    <td class="admin_basic_board_writetd">
        관리자 패스워드
    </td>
    <td colspan=3>
        <input type='password' name='admin_password' itemname="관리자 패스워드" required>
        <?=help("관리자 권한을 빼앗길 것에 대비하여 로그인한 관리자의 패스워드를 한번 더 묻는것 입니다.");?>
    </td>
</tr>


</table>

<p align=center>
    <input type=submit class=admin_black_bt accesskey='s' value='확인'>
</form>

<script type="text/javascript">
function fconfigform_submit(f)
{
    f.action = "./config_form_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>
