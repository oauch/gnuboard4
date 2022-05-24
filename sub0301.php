<?
include_once("./inc/dahan-common.php"); //그누보드세팅
?>

<?
$subHadeNum = "03"; //헤드
$subPageNum = "0301"; //페이지코드
$title = "요금안내"; //타이틀
$bigmenu = "서비스 요금";
?>

<?include_once("inc/head.php");?>
<div class="sub0301 normal">
  <h3>에어컨 서비스 요금</h3>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>제품명</th>
      <th>용량/모델</th>
      <th>서비스요금</th>
      <th>비고</th>
    </tr>
    <tr>
      <td>벽걸이 에어컨</td>
      <td>10평이하</td>
      <td>6만원</td>
      <td rowspan="8">대량작업시 전화문의</td>
    </tr>
    <tr>
      <td>스탠드 에어컨</td>
      <td>30평이하</td>
      <td>10만원</td>
    </tr>
    <tr>
      <td rowspan="2">천정형 에어컨</td>
      <td>4way</td>
      <td>15만원</td>
    </tr>
    <tr>
      <td>1way</td>
      <td>8만원</td>
    </tr>
    <tr>
      <td rowspan="2">업소용 에어컨</td>
      <td>4way</td>
      <td>12~15만원</td>
    </tr>
    <tr>
      <td>2way</td>
      <td>10만원</td>
    </tr>
    <tr>
      <td rowspan="2">업소용 스탠드에어컨</td>
      <td>50평이하</td>
      <td>15만원</td>
    </tr>
    <tr>
      <td>50평이상</td>
      <td>상담협의</td>
    </tr>
  </table>

  <h3>세탁기 서비스 요금</h3>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>제품명</th>
      <th>용량/모델</th>
      <th>서비스요금</th>
      <th>비고</th>
    </tr>
    <tr>
      <td rowspan="2">통돌이 세탁기</td>
      <td>14kg미만</td>
      <td>6만원</td>
      <td rowspan="10">-</td>
    </tr>
    <tr>
      <td>14kg이상</td>
      <td>7만원</td>
    </tr>
    <tr>
      <td rowspan="2">드럼 세탁기</td>
      <td>15kg미만</td>
      <td>10만원</td>
    </tr>
    <tr>
      <td>15kg이상</td>
      <td>12만원</td>
    </tr>
    <tr>
      <td>빌트인 세탁기</td>
      <td>모든용량</td>
      <td>12만원</td>
    </tr>
    <tr>
      <td>아기사랑 세탁기</td>
      <td>모든용량</td>
      <td>5만원</td>
    </tr>
  </table>

  <h3>냉장고 서비스 요금</h3>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>제품명</th>
      <th>서비스요금</th>
      <th>비고</th>
    </tr>
    <tr>
      <td>단문형 냉장고</td>
      <td>7만원</td>
      <td rowspan="4">-</td>
    </tr>
    <tr>
      <td>양문형 냉장고</td>
      <td>12만원</td>
    </tr>
    <tr>
      <td>김치 냉장고(서랍/뚜껑형)</td>
      <td>8만원</td>
    </tr>
    <tr>
      <td>김치 냉장고(스탠드형)</td>
      <td>10만원</td>
    </tr>
  </table>

  <h3>비데 서비스 요금</h3>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>제품명</th>
      <th>서비스요금</th>
      <th>비고</th>
    </tr>
    <tr>
      <td>비데</td>
      <td>5만원</td>
      <td>-</td>
    </tr>
  </table>
</div>
<!--img src="<?=$skinName?>images/sub<?=$subPageNum?>.jpg" /-->

<?include_once("inc/tail.php");?>

<?
include_once("./tail.sub.php");
?>
