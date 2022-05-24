<?
/***************************/
$thum_width = $board[bo_3]; // 썸네일 가로 길이
$thum_height = $board[bo_4]; // 썸네일 세로길이
/***************************/
?>

<style>
.list_body td {border-top:1px solid #ECECEC;}
</style>

<table class="list_body" summary="<?=$board[bo_subject]?>리스트">
	<caption><?=$board[bo_subject]?>리스트</caption>
	<colgroup>
	<col width="50px" />
	<? if ($is_checkbox) { ?><col width="15px" /><? } ?>
	<col width="<?=$thum_width + 10?>" />
	<col width="" />
	<col width="90px" />
	<col width="50px" />
	<col width="50px" />
	<? if ($is_good) { ?><col width="35px" /><? } ?>
	<? if ($is_nogood) { ?><col width="35px" /><? } ?>
	</colgroup>
	<thead>
		<tr>
			<th>번호</th>
			<? if ($is_checkbox) { ?><th class="th_check"><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type="checkbox"></th><? } ?>
			<th>이미지</th>
			<th>제목</th>
			<th>글쓴이</th>
			<th><?=subject_sort_link('wr_datetime', $qstr2, 1)?>날짜</a></th>
			<th><?=subject_sort_link('wr_hit', $qstr2, 1)?>조회</a></th>
			<? if ($is_good) { ?><th><?=subject_sort_link('wr_good', $qstr2, 1)?>추천</a></th><? } ?>
			<? if ($is_nogood) { ?><th><?=subject_sort_link('wr_nogood', $qstr2, 1)?>비추</a></th><? } ?>
		</tr>
	</thead>
	<tbody>
	<?
		for($i=0; $i<$list_count; $i++) {
        // 파일 출력
        for ($j=0; $j<=count($list[$i][file]); $j++) {
            if ($list[$i][file][$j][view]) 
                $temp_thum_img = "<img src='$g4[path]/data/file/$board[bo_table]/".urlencode($list[$i][file][$j][file])."' width='$thum_width' height='$thum_height' name='target_resize_image[]' onclick='image_window(this);' style='cursor:pointer;' title='$content'>";
        }

			$list[$i][jy_subj] = "<div class=\"subject_area\">";
			$list[$i][icon_pack] = "";
			// 공지사항
			if ($list[$i][is_notice]) {

				$list[$i][jy_subj] .= "<a href='{$list[$i][href]}'><strong>{$list[$i][subject]}</strong></a>";
				$list[$i][name] = "<strong>{$list[$i][name]}</strong>";

				if($jy['article_type'])
					$list[$i][article_type] = "<span class='ico_pack2 ico_notice2'>공지</span>";

				$list[$i][num] = "&nbsp;<span class='ico_notice'>공지</span>&nbsp;";
				$list[$i][good] = "-";
				$list[$i][nogood] = "-";
				$list[$i][hit] = "-";

			} else { 

				$list[$i][num] = $list[$i][num];

				// 코멘트
				if($list[$i][wr_comment]) $list[$i][comment] = "<a class='txt_comment' href=\"".$list[$i][comment_href]."\">+".$list[$i][wr_comment]."</a>";

				//if($is_category && $list[$i][ca_name]) $list[$i][jy_subj] .= "<a class='txt_category' href='".$list[$i][ca_name_href]."'>[{$list[$i][ca_name]}]</a>";

				// 선택된글
				if($wr_id == $list[$i][wr_id]) $list[$i][jy_subj] .= "<span class='current'>{$list[$i][subject]}</span>";
				else $list[$i][jy_subj] .= "<a href='{$list[$i][href]}'>{$list[$i][subject]}</a>";

				// 조회수
				if($list[$i][icon_hot]) $list[$i][hit] .= "<em>{$list[$i][wr_hit]}</em>";
				else $list[$i][hit] .= "<span>{$list[$i][wr_hit]}</span>";

				// 추천
				if($list[$i]['wr_good'] >= $jy['bo_good']) $list[$i][good] .= "<em>{$list[$i][wr_good]}</em>";
				else $list[$i][good] .= "<span>{$list[$i][wr_good]}</span>";

				// 비추천
				if($list[$i]['wr_nogood'] >= $jy['bo_nogood']) $list[$i][nogood] .= "<em>{$list[$i][wr_nogood]}</em>";
				else $list[$i][nogood] .= "<span>{$list[$i][wr_nogood]}</span>";
			}

			$list[$i][jy_subj] .= "</div>";

			if($jy['article_type']) {
				if($list[$i][icon_secret]) $list[$i][article_type] = "<span class='ico_pack2 ico_secret2'>비밀글</span>";
				else if($list[$i][icon_file]) $list[$i][article_type] = "<span class='ico_pack2 ico_file2'>파일첨부</span>";
				else $list[$i][article_type] = "<span class='ico_pack2 ico_txt2'>텍스트</span>";
			} else {
				if($list[$i][icon_secret]) $list[$i][icon_pack] .= "<span class='ico_pack ico_secret'>비밀글</span>";
				if($list[$i][icon_file]) $list[$i][icon_pack] .= "<span class='ico_pack ico_file'>파일첨부</span>";
			}
			if($list[$i][icon_link]) $list[$i][icon_pack] .= "<span class='ico_pack ico_link'>링크</span>";
			if($list[$i][icon_new]) $list[$i][icon_pack] .= "<span class='ico_pack ico_new'>새글</span>";
			if($list[$i][wr_reply]) $list[$i][icon_reply] = "<span class='ico_pack2 ico_reply re".strlen($list[$i][wr_reply])."'>답변</span>";
		?>
		<tr class="<?=$list[$i][is_notice]?"item_notice":""?>">
			<td class="item_no"><?=$list[$i][num]?></td>
			<? if($is_checkbox) { ?><td class="item_check"><input type="checkbox" name="chk_wr_id[]" value="<?=$list[$i][wr_id]?>"></td><? } ?>
			<td align="center" style="padding:15px"><?=$temp_thum_img?></td>
			<td class="item_subject" style="padding-left:20px">
				<? if($is_category && $list[$i][ca_name]) { echo "<b>[".$list[$i][ca_name]."]</b>"; } ?><br>
				<?=$list[$i][icon_reply]?>
				<!--<span class="article_type"><?=$list[$i][article_type]?></span>-->
				<span style="color:#6d6d6d"><?=$list[$i][jy_subj]?></span>
				<br>
				<?=$list[$i][comment]?>
				<?=$list[$i][icon_pack]?>
			</td>
			<td class="item_writer" align=center><?=$list[$i][name]?></td>
			<td class="item_date"><?=$list[$i][datetime2]?></td>
			<td class="item_hit"><?=$list[$i][hit]?></td>
			<? if ($is_good) { ?><td class="item_good"><?=$list[$i][good]?></td><? } ?>
			<? if ($is_nogood) { ?><td class="item_nogood"><?=$list[$i][nogood]?></td><? } ?>
		</tr>
		<? } if($list_count==0) { ?>
		<tr><td class="nocontents" colspan="10">게시물이 없습니다.</td></tr>
		<? } ?>
	</tbody>
	</table> 
