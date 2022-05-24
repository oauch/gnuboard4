<?
if (!defined("_GNUBOARD_")) exit; // °³º° ÆäÀÌÁö Á¢±Ù ºÒ°¡ 
?>

<?
//==============================================================================
// jquery date picker
//------------------------------------------------------------------------------
// Âü°í) ie ¿¡¼­´Â ³â, ¿ù select box ¸¦ µÎ¹ø¾¿ Å¬¸¯ÇØ¾ß ÇÏ´Â ¿À·ù°¡ ÀÖ½À´Ï´Ù.
//------------------------------------------------------------------------------
// jquery-ui.css ÀÇ Å×¸¶¸¦ º¯°æÇØ¼­ »ç¿ëÇÒ ¼ö ÀÖ½À´Ï´Ù.
// base, black-tie, blitzer, cupertino, dark-hive, dot-luv, eggplant, excite-bike, flick, hot-sneaks, humanity, le-frog, mint-choc, overcast, pepper-grinder, redmond, smoothness, south-street, start, sunny, swanky-purse, trontastic, ui-darkness, ui-lightness, vader
// ¾Æ·¡ css ´Â date picker ÀÇ È­¸éÀ» ¸ÂÃß´Â ÄÚµåÀÔ´Ï´Ù.
?>

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" media="screen" href="../adm/admin.style.css" />


<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
-->
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
<script type="text/javascript">
/* Korean initialisation for the jQuery calendar extension. */
/* Written by DaeKwon Kang (ncrash.dk@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ko'] = {
		closeText: '´İ±â',
		prevText: 'ÀÌÀü´Ş',
		nextText: '´ÙÀ½´Ş',
		currentText: '¿À´Ã',
		monthNames: ['1¿ù(JAN)','2¿ù(FEB)','3¿ù(MAR)','4¿ù(APR)','5¿ù(MAY)','6¿ù(JUN)',
		'7¿ù(JUL)','8¿ù(AUG)','9¿ù(SEP)','10¿ù(OCT)','11¿ù(NOV)','12¿ù(DEC)'],
		monthNamesShort: ['1¿ù','2¿ù','3¿ù','4¿ù','5¿ù','6¿ù',
		'7¿ù','8¿ù','9¿ù','10¿ù','11¿ù','12¿ù'],
		dayNames: ['ÀÏ','¿ù','È­','¼ö','¸ñ','±İ','Åä'],
		dayNamesShort: ['ÀÏ','¿ù','È­','¼ö','¸ñ','±İ','Åä'],
		dayNamesMin: ['ÀÏ','¿ù','È­','¼ö','¸ñ','±İ','Åä'],
		weekHeader: 'Wk',
		dateFormat: 'yymmdd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

    $('#mb_birth').datepicker({
        showOn: 'button',
		buttonImage: '<?=$g4[path]?>/img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "´Ş·Â",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
        yearRange: 'c-99:c+99',
        maxDate: '+0d'
    }); 
});
</script>
<?
//==============================================================================
?>

<style type="text/css">
<!--
.adm_register_board_writetd    { BACKGROUND-COLOR: #ffffff; PADDING-LEFT: 15px; PADDING-top: 5px; PADDING-BOTTOM: 5px; }
.m_padding  { PADDING-LEFT: 15px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; }
.m_padding2 { PADDING-LEFT: 0px; PADDING-top: 5px; PADDING-BOTTOM: 0px; }
.m_padding3 { PADDING-LEFT: 0px; PADDING-top: 5px; PADDING-BOTTOM: 5px; }
-->
</style>

<script>
var member_skin_path = "<?=$member_skin_path?>";
</script>
<script type="text/javascript" src="<?=$member_skin_path?>/ajax_register_form.jquery.js"></script>
<script type="text/javascript" src="<?=$g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?=$g4[path]?>/js/sideview.js"></script>

<form id="fregisterform" name=fregisterform method=post onsubmit="return fregisterform_submit(this);" enctype="multipart/form-data" autocomplete="off">
<input type=hidden name=w                value="<?=$w?>">
<input type=hidden name=url              value="<?=$urlencode?>">
<input type=hidden name=mb_jumin         value="<?=$jumin?>">
<input type=hidden name=mb_id_enabled    value="" id="mb_id_enabled">
<input type=hidden name=mb_nick_enabled  value="" id="mb_nick_enabled">
<input type=hidden name=mb_email_enabled value="" id="mb_email_enabled">
<!-- <input type=hidden name=token value="<?=$token?>"> -->



<div class="adm_member">


<div id="adm_register_topbt">
<a href="#;">¾à°üµ¿ÀÇ</a>
<a href="#;" class="on">È¸¿ø°¡ÀÔ¾ç½ÄÀÛ¼º</a>
<a href="#;">°¡ÀÔ¿Ï·á</a>
</div>
<div style="clear:both;"></div>


<table cellspacing=1 cellpadding=0 width=100% class="adm_register_board_write">
  <? if ($config[cf_use_signature]) { ?>
  <tr bgcolor="#FFFFFF">
    <td width="160" class=adm_register_board_writetd>¼­¸í</td>
    <td class=m_padding><textarea name=mb_signature class=tx rows=3 style='width:95%;' <?=$config[cf_req_signature]?'required':'';?> itemname='¼­¸í'><?=$member[mb_signature]?>
    </textarea></td>
  </tr>
  <? } ?>
  <? if ($config[cf_use_profile]) { ?>
  <tr bgcolor="#FFFFFF">
    <td width="160" class=adm_register_board_writetd>ÀÚ±â¼Ò°³</td>
    <td class=m_padding><textarea name=mb_profile class=tx rows=3 style='width:95%;' <?=$config[cf_req_profile]?'required':'';?> itemname='ÀÚ±â ¼Ò°³'><?=$member[mb_profile]?>
    </textarea></td>
  </tr>
  <? } ?>
  <? if ($member[mb_level] >= $config[cf_icon_level]) { ?>
  <tr bgcolor="#FFFFFF" style='display:none;'>
    <td width="160" class=adm_register_board_writetd>È¸¿ø¾ÆÀÌÄÜ</td>
    <td class=m_padding><input class=ed type=file name='mb_icon' size=30>
      <table width="350" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class=m_padding3>* ÀÌ¹ÌÁö Å©±â´Â °¡·Î(
            <?=$config[cf_member_icon_width]?>
            ÇÈ¼¿)x¼¼·Î(
            <?=$config[cf_member_icon_height]?>
            ÇÈ¼¿) ÀÌÇÏ·Î ÇØÁÖ¼¼¿ä.<br>
            &nbsp;&nbsp;(gif¸¸ °¡´É / ¿ë·®:
            <?=number_format($config[cf_member_icon_size])?>
            ¹ÙÀÌÆ® ÀÌÇÏ¸¸ µî·ÏµË´Ï´Ù.)
            <? if ($w == "u" && file_exists($mb_icon)) { ?>
            <br>
            <img src='<?=$mb_icon?>' align=absmiddle>
            <input type=checkbox name='del_mb_icon' value='1'>
            »èÁ¦
            <? } ?></td>
        </tr>
      </table></td>
  </tr>
  <? } ?>
  <tr bgcolor="#FFFFFF" style='display:none;'>
    <td width="160" class=adm_register_board_writetd>¸ŞÀÏ¸µ¼­ºñ½º</td>
    <td class=m_padding><input type=checkbox name=mb_mailling value='1' <?=($w=='' || $member[mb_mailling])?'checked':'';?>>
      Á¤º¸ ¸ŞÀÏÀ» ¹Ş°Ú½À´Ï´Ù.</td>
  </tr>
  <tr bgcolor="#FFFFFF" style='display:none;'>
    <td width="160" class=adm_register_board_writetd>SMS ¼ö½Å¿©ºÎ</td>
    <td class=m_padding><input type=checkbox name=mb_sms value='1' <?=($w=='' || $member[mb_sms])?'checked':'';?>>
      ÇÚµåÆù ¹®ÀÚ¸Ş¼¼Áö¸¦ ¹Ş°Ú½À´Ï´Ù.</td>
  </tr>
  <? if ($member[mb_open_date] <= date("Y-m-d", $g4[server_time] - ($config[cf_open_modify] * 86400))) { // Á¤º¸°ø°³ ¼öÁ¤ÀÏÀÌ Áö³µ´Ù¸é ¼öÁ¤°¡´É ?>
  <input type=hidden name=mb_open_default value='<?=$member[mb_open]?>'>
  <tr bgcolor="#FFFFFF" style='display:none;'>
    <td width="160" class=adm_register_board_writetd>Á¤º¸°ø°³</td>
    <td class=m_padding><input type=checkbox name=mb_open value='1' <?=($w=='' || $member[mb_open])?'checked':'';?>>
      ´Ù¸¥ºĞµéÀÌ ³ªÀÇ Á¤º¸¸¦ º¼ ¼ö ÀÖµµ·Ï ÇÕ´Ï´Ù. <br>
      &nbsp;&nbsp;&nbsp;&nbsp; Á¤º¸°ø°³¸¦ ¹Ù²Ù½Ã¸é ¾ÕÀ¸·Î
      <?=(int)$config[cf_open_modify]?>
      ÀÏ ÀÌ³»¿¡´Â º¯°æÀÌ ¾ÈµË´Ï´Ù.</td>
  </tr>
  <? } else { ?>
  <input type=hidden name="mb_open" value="<?=$member[mb_open]?>">
  <tr bgcolor="#FFFFFF" style='display:none;'>
    <td width="160" class=adm_register_board_writetd>Á¤º¸°ø°³</td>
    <td class=m_padding> Á¤º¸°ø°³´Â ¼öÁ¤ÈÄ
      <?=(int)$config[cf_open_modify]?>
      ÀÏ ÀÌ³»,
      <?=date("Y³â m¿ù jÀÏ", strtotime("$member[mb_open_date] 00:00:00") + ($config[cf_open_modify] * 86400))?>
      ±îÁö´Â º¯°æÀÌ ¾ÈµË´Ï´Ù.<br>
      ÀÌ·¸°Ô ÇÏ´Â ÀÌÀ¯´Â ÀæÀº Á¤º¸°ø°³ ¼öÁ¤À¸·Î ÀÎÇÏ¿© ÂÊÁö¸¦ º¸³½ ÈÄ ¹ŞÁö ¾Ê´Â °æ¿ì¸¦ ¸·±â À§ÇØ¼­ ÀÔ´Ï´Ù. </td>
  </tr>
  <? } ?>
  <? if ($w == "" && $config[cf_use_recommend]) { ?>
  <tr bgcolor="#FFFFFF">
    <td width="160" class=adm_register_board_writetd>ÃßÃµÀÎ¾ÆÀÌµğ</td>
    <td class=m_padding><input type=text name=mb_recommend class=ed></td>
  </tr>
  <? } ?>
</table>
<table width=100% cellspacing=0 align=center>
<tr>
    <td>

<table width="100%" cellspacing="0" cellpadding="0" class="adm_register_board_write">
<tr>
    <td>
        <TABLE cellSpacing=1 cellPadding=0 width=100%>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=adm_register_board_writetd>¾ÆÀÌµğ</TD>
            <TD class=m_padding>
                <input class=ed maxlength=20 size=20 id='reg_mb_id' name="mb_id" value="<?=$member[mb_id]?>" <? if ($w=='u') { echo "readonly style='background-color:#dddddd;'"; } ?>
                    <? if ($w=='') { echo "onblur='reg_mb_id_check();'"; } ?>>
                <span id='msg_mb_id'></span>
                <div><font color="#66a2c8">¡Ø ¿µ¹®ÀÚ, ¼ıÀÚ, _ ¸¸ ÀÔ·Â °¡´É. ÃÖ¼Ò 3ÀÚÀÌ»ó ÀÔ·ÂÇÏ¼¼¿ä.</font></div>
            </TD>
        </TR>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>ÆĞ½º¿öµå</TD>
            <TD class=m_padding><INPUT class=ed type=password name="mb_password" size=20 maxlength=20 <?=($w=="")?"required":"";?> itemname="ÆĞ½º¿öµå"></TD>
        </TR>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>ÆĞ½º¿öµå È®ÀÎ</TD>
            <TD class=m_padding><INPUT class=ed type=password name="mb_password_re" size=20 maxlength=20 <?=($w=="")?"required":"";?> itemname="ÆĞ½º¿öµå È®ÀÎ"></TD>
        </TR>
        <!-- <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>ÆĞ½º¿öµå ºĞ½Ç½Ã Áú¹®</TD>
            <TD class=m_padding>
                <select name=mb_password_q_select onchange="this.form.mb_password_q.value=this.value;">
                    <option value="">¼±ÅÃÇÏ½Ê½Ã¿À.</option>
                    <option value="³»°¡ ÁÁ¾ÆÇÏ´Â Ä³¸¯ÅÍ´Â?">³»°¡ ÁÁ¾ÆÇÏ´Â Ä³¸¯ÅÍ´Â?</option>
                    <option value="Å¸ÀÎÀÌ ¸ğ¸£´Â ÀÚ½Å¸¸ÀÇ ½ÅÃ¼ºñ¹ĞÀÌ ÀÖ´Ù¸é?">Å¸ÀÎÀÌ ¸ğ¸£´Â ÀÚ½Å¸¸ÀÇ ½ÅÃ¼ºñ¹ĞÀÌ ÀÖ´Ù¸é?</option>
                    <option value="ÀÚ½ÅÀÇ ÀÎ»ı ÁÂ¿ì¸íÀº?">ÀÚ½ÅÀÇ ÀÎ»ı ÁÂ¿ì¸íÀº?</option>
                    <option value="ÃÊµîÇĞ±³ ¶§ ±â¾ï¿¡ ³²´Â Â¦²á ÀÌ¸§Àº?">ÃÊµîÇĞ±³ ¶§ ±â¾ï¿¡ ³²´Â Â¦²á ÀÌ¸§Àº?</option>
                    <option value="À¯³â½ÃÀı °¡Àå »ı°¢³ª´Â Ä£±¸ ÀÌ¸§Àº?">À¯³â½ÃÀı °¡Àå »ı°¢³ª´Â Ä£±¸ ÀÌ¸§Àº?</option>
                    <option value="°¡Àå ±â¾ï¿¡ ³²´Â ¼±»ı´Ô ¼ºÇÔÀº?">°¡Àå ±â¾ï¿¡ ³²´Â ¼±»ı´Ô ¼ºÇÔÀº?</option>
                    <option value="Ä£±¸µé¿¡°Ô °ø°³ÇÏÁö ¾ÊÀº ¾î¸± Àû º°¸íÀÌ ÀÖ´Ù¸é?">Ä£±¸µé¿¡°Ô °ø°³ÇÏÁö ¾ÊÀº ¾î¸± Àû º°¸íÀÌ ÀÖ´Ù¸é?</option>
                    <option value="´Ù½Ã ÅÂ¾î³ª¸é µÇ°í ½ÍÀº °ÍÀº?">´Ù½Ã ÅÂ¾î³ª¸é µÇ°í ½ÍÀº °ÍÀº?</option>
                    <option value="°¡Àå °¨¸í±í°Ô º» ¿µÈ­´Â?">°¡Àå °¨¸í±í°Ô º» ¿µÈ­´Â?</option>
                    <option value="ÀĞÀº Ã¥ Áß¿¡¼­ ÁÁ¾ÆÇÏ´Â ±¸ÀıÀÌ ÀÖ´Ù¸é?">ÀĞÀº Ã¥ Áß¿¡¼­ ÁÁ¾ÆÇÏ´Â ±¸ÀıÀÌ ÀÖ´Ù¸é?</option>
                    <option value="±â¾ï¿¡ ³²´Â Ãß¾ïÀÇ Àå¼Ò´Â?">±â¾ï¿¡ ³²´Â Ãß¾ïÀÇ Àå¼Ò´Â?</option>
                    <option value="ÀÎ»ó ±í°Ô ÀĞÀº Ã¥ ÀÌ¸§Àº?">ÀÎ»ó ±í°Ô ÀĞÀº Ã¥ ÀÌ¸§Àº?</option>
                    <option value="ÀÚ½ÅÀÇ º¸¹° Á¦1È£´Â?">ÀÚ½ÅÀÇ º¸¹° Á¦1È£´Â?</option>
                    <option value="¹Ş¾Ò´ø ¼±¹° Áß ±â¾ï¿¡ ³²´Â µ¶Æ¯ÇÑ ¼±¹°Àº?">¹Ş¾Ò´ø ¼±¹° Áß ±â¾ï¿¡ ³²´Â µ¶Æ¯ÇÑ ¼±¹°Àº?</option>
                    <option value="ÀÚ½ÅÀÌ µÎ¹øÂ°·Î Á¸°æÇÏ´Â ÀÎ¹°Àº?">ÀÚ½ÅÀÌ µÎ¹øÂ°·Î Á¸°æÇÏ´Â ÀÎ¹°Àº?</option>
                    <option value="¾Æ¹öÁöÀÇ ¼ºÇÔÀº?">¾Æ¹öÁöÀÇ ¼ºÇÔÀº?</option>
                    <option value="¾î¸Ó´ÏÀÇ ¼ºÇÔÀº?">¾î¸Ó´ÏÀÇ ¼ºÇÔÀº?</option>
                </select>

                <table width="350" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class=m_padding2><input class=ed type=text name="mb_password_q" size=55 required itemname="ÆĞ½º¿öµå ºĞ½Ç½Ã Áú¹®" value="<?=$member[mb_password_q]?>"></td>
                </tr>
                </table>
            </TD>
        </TR>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>ÆĞ½º¿öµå ºĞ½Ç½Ã ´äº¯</TD>
            <TD class=m_padding><input class=ed type=text name='mb_password_a' size=38 required itemname='ÆĞ½º¿öµå ºĞ½Ç½Ã ´äº¯' value='<?=$member[mb_password_a]?>'></TD>
        </TR> -->
        </TABLE>
    </td>
</tr>
</table>



<table width="100%" cellspacing="0" cellpadding="0" class="adm_register_board_write">
<tr>
    <td>
        <TABLE cellSpacing=1 cellPadding=0 width=100%>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=adm_register_board_writetd>ÀÌ¸§</TD>
            <TD class=m_padding>
                <input name=mb_name itemname="ÀÌ¸§" value="<?=$member[mb_name]?>" <?=$member[mb_name]?"readonly class=ed2":"class=ed";?>> 
                <? if ($w=='') { echo "(°ø¹é¾øÀÌ ÇÑ±Û¸¸ ÀÔ·Â °¡´É)"; } ?>
            </TD>
        </TR>

        <? if ($member[mb_nick_date] <= date("Y-m-d", $g4[server_time] - ($config[cf_nick_modify] * 86400))) { // º°¸í¼öÁ¤ÀÏÀÌ Áö³µ´Ù¸é ¼öÁ¤°¡´É ?>
        <input type=hidden name=mb_nick_default value='<?=$member[mb_nick]?>'>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>º°¸í</TD>
            <TD class='m_padding lh'>
                <input class=ed type=text id='reg_mb_nick' name='mb_nick' maxlength=20 value='<?=$member[mb_nick]?>'
                    onblur="reg_mb_nick_check();">
                <span id='msg_mb_nick'></span>
                <br>°ø¹é¾øÀÌ ÇÑ±Û,¿µ¹®,¼ıÀÚ¸¸ ÀÔ·Â °¡´É (ÇÑ±Û2ÀÚ, ¿µ¹®4ÀÚ ÀÌ»ó)
                <br>º°¸íÀ» ¹Ù²Ù½Ã¸é ¾ÕÀ¸·Î <?=(int)$config[cf_nick_modify]?>ÀÏ ÀÌ³»¿¡´Â º¯°æ ÇÒ ¼ö ¾ø½À´Ï´Ù.
            </TD>
        </TR>
        <? } else { ?>
        <input type=hidden name="mb_nick_default" value='<?=$member[mb_nick]?>'>
        <input type=hidden name="mb_nick" value="<?=$member[mb_nick]?>">
        <? } ?>

        <input type=hidden name='old_email' value='<?=$member[mb_email]?>'>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>E-mail</TD>
            <TD class='m_padding lh'>
                <input class=ed type=text id='reg_mb_email' name='mb_email' size=38 maxlength=100 value='<?=$member[mb_email]?>'
                    onblur="reg_mb_email_check()">
                <span id='msg_mb_email'></span>
                <? if ($config[cf_use_email_certify]) { ?>
                    <? if ($w=='') { echo "<br>e-mail ·Î ¹ß¼ÛµÈ ³»¿ëÀ» È®ÀÎÇÑ ÈÄ ÀÎÁõÇÏ¼Å¾ß È¸¿ø°¡ÀÔÀÌ ¿Ï·áµË´Ï´Ù."; } ?>
                    <? if ($w=='u') { echo "<br>e-mail ÁÖ¼Ò¸¦ º¯°æÇÏ½Ã¸é ´Ù½Ã ÀÎÁõÇÏ¼Å¾ß ÇÕ´Ï´Ù."; } ?>
                <? } ?>
            </TD>
        </TR>

        <? if ($w=="") { ?>
            <TR bgcolor="#FFFFFF">
                <TD class=adm_register_board_writetd>»ı³â¿ùÀÏ</TD>
                <TD class=m_padding><input class=ed type=text id=mb_birth name='mb_birth' size=8 maxlength=8 minlength=8 required numeric itemname='»ı³â¿ùÀÏ' value='<?=$member[mb_birth]?>' readonly title='¿·ÀÇ ´Ş·Â ¾ÆÀÌÄÜÀ» Å¬¸¯ÇÏ¿© ³¯Â¥¸¦ ÀÔ·ÂÇÏ¼¼¿ä.'></TD>
            </TR>
        <? } ?>

        <? if ($member[mb_sex]) { ?>
            <input type=hidden name=mb_sex value='<?=$member[mb_sex]?>'>
        <? } else { ?>
            <TR bgcolor="#FFFFFF">
                <TD class=adm_register_board_writetd>¼ºº°</TD>
                <TD class=m_padding>
                    <select id=mb_sex name=mb_sex required itemname='¼ºº°'>
                    <option value=''>¼±ÅÃÇÏ¼¼¿ä
                    <option value='F'>¿©ÀÚ
                    <option value='M'>³²ÀÚ
                    </select>
                    <script type="text/javascript">//document.getElementById('mb_sex').value='<?=$member[mb_sex]?>';</script>
                  </td>
            </TR>
        <? } ?>

        <? if ($config[cf_use_homepage]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>È¨ÆäÀÌÁö</TD>
            <TD class=m_padding><input class=ed type=text name='mb_homepage' size=38 maxlength=255 <?=$config[cf_req_homepage]?'required':'';?> itemname='È¨ÆäÀÌÁö' value='<?=$member[mb_homepage]?>'></TD>
        </TR>
        <? } ?>

        <? if ($config[cf_use_tel]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>ÀüÈ­¹øÈ£</TD>
            <TD class=m_padding><input class=ed type=text name='mb_tel' size=21 maxlength=20 <?=$config[cf_req_tel]?'required':'';?> itemname='ÀüÈ­¹øÈ£' value='<?=$member[mb_tel]?>'></TD>
        </TR>
        <? } ?>

        <? if ($config[cf_use_hp]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>ÇÚµåÆù¹øÈ£</TD>
            <TD class=m_padding><input class=ed type=text name='mb_hp' size=21 maxlength=20 <?=$config[cf_req_hp]?'required':'';?> itemname='ÇÚµåÆù¹øÈ£' value='<?=$member[mb_hp]?>'></TD>
        </TR>
        <? } ?>

        <? if ($config[cf_use_addr]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD class=adm_register_board_writetd>ÁÖ¼Ò</TD>
            <TD valign="middle" class=m_padding>
                <table width="330" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="25"><input class=ed type=text name='mb_zip1' size=4 maxlength=3 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='¿ìÆí¹øÈ£ ¾ÕÀÚ¸®' value='<?=$member[mb_zip1]?>'>
                         - 
                        <input class=ed type=text name='mb_zip2' size=4 maxlength=3 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='¿ìÆí¹øÈ£ µŞÀÚ¸®' value='<?=$member[mb_zip2]?>'>
                        &nbsp;<a href="javascript:;" onclick="win_zip('fregisterform', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2');"><img width="91" height="20" src="<?=$member_skin_path?>/img/post_search_btn.gif" border=0 align=absmiddle></a></td>
                </tr>
                <tr>
                    <td height="25" colspan="2"><input class=ed type=text name='mb_addr1' size=60 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='ÁÖ¼Ò' value='<?=$member[mb_addr1]?>'></td>
                </tr>
                <tr>
                    <td height="25" colspan="2"><input class=ed type=text name='mb_addr2' size=60 <?=$config[cf_req_addr]?'required':'';?> itemname='»ó¼¼ÁÖ¼Ò' value='<?=$member[mb_addr2]?>'></td>
                </tr>
                </table>
            </TD>
        </TR>
        <? } ?>

        </TABLE>
    </td>
</tr>
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0" class="adm_register_board_write">
<tr>
    <td>
        <TABLE cellSpacing=1 cellPadding=0 width=100%>
        <TR bgcolor="#FFFFFF">
            <td width="160" height="28" class=adm_register_board_writetd>
                <img id='kcaptcha_image' />
            </td>
            <td class=m_padding>
                <input type=input class=ed size=10 name=wr_key itemname="ÀÚµ¿µî·Ï¹æÁö" required>&nbsp;&nbsp;¿ŞÂÊÀÇ ±ÛÀÚ¸¦ ÀÔ·ÂÇÏ¼¼¿ä.
            </td>
        </tr>
        </table>
    </td>
</tr>
</table>

<p align=center>
    <input type=submit class=admin_black_bt value='È®ÀÎ' accesskey='s'>

</td></tr>
</table>


</div>
</form>


<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
$(function() {
    // ÆûÀÇ Ã¹¹øÂ° ÀÔ·Â¹Ú½º¿¡ Æ÷Ä¿½º ÁÖ±â 
    $("#fregisterform :input[type=text]:visible:enabled:first").focus(); 
});

// submit ÃÖÁ¾ ÆûÃ¼Å©
function fregisterform_submit(f) 
{
    // È¸¿ø¾ÆÀÌµğ °Ë»ç
    if (f.w.value == "") {

        reg_mb_id_check();

        if (document.getElementById('mb_id_enabled').value!='000') {
            alert('È¸¿ø¾ÆÀÌµğ¸¦ ÀÔ·ÂÇÏÁö ¾Ê¾Ò°Å³ª ÀÔ·Â¿¡ ¿À·ù°¡ ÀÖ½À´Ï´Ù.');
            document.getElementById('reg_mb_id').select();
            return false;
        }
    }

    if (f.w.value == '') {
        if (f.mb_password.value.length < 3) {
            alert('ÆĞ½º¿öµå¸¦ 3±ÛÀÚ ÀÌ»ó ÀÔ·ÂÇÏ½Ê½Ã¿À.');
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert('ÆĞ½º¿öµå°¡ °°Áö ¾Ê½À´Ï´Ù.');
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 3) {
            alert('ÆĞ½º¿öµå¸¦ 3±ÛÀÚ ÀÌ»ó ÀÔ·ÂÇÏ½Ê½Ã¿À.');
            f.mb_password_re.focus();
            return false;
        }
    }

    /*
    if (f.mb_password_q.value.length < 1) {
        alert('ÆĞ½º¿öµå ºĞ½Ç½Ã Áú¹®À» ¼±ÅÃÇÏ°Å³ª ÀÔ·ÂÇÏ½Ê½Ã¿À.');
        f.mb_password_q.focus();
        return false;
    }

    if (f.mb_password_a.value.length < 1) {
        alert('ÆĞ½º¿öµå ºĞ½Ç½Ã ´äº¯À» ÀÔ·ÂÇÏ½Ê½Ã¿À.');
        f.mb_password_a.focus();
        return false;
    }
    */

    // ÀÌ¸§ °Ë»ç
    if (f.w.value=='') {
        if (f.mb_name.value.length < 1) {
            alert('ÀÌ¸§À» ÀÔ·ÂÇÏ½Ê½Ã¿À.');
            f.mb_name.focus();
            return false;
        }

        var pattern = /([^°¡-ÆR\x20])/i; 
        if (pattern.test(f.mb_name.value)) {
            alert('ÀÌ¸§Àº ÇÑ±Û·Î ÀÔ·ÂÇÏ½Ê½Ã¿À.');
            f.mb_name.focus();
            return false;
        }
    }

    // º°¸í °Ë»ç
    if ((f.w.value == "") ||
        (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {

        reg_mb_nick_check();

        if (document.getElementById('mb_nick_enabled').value!='000') {
            alert('º°¸íÀ» ÀÔ·ÂÇÏÁö ¾Ê¾Ò°Å³ª ÀÔ·Â¿¡ ¿À·ù°¡ ÀÖ½À´Ï´Ù.');
            document.getElementById('reg_mb_nick').select();
            return false;
        }
    }

    // E-mail °Ë»ç
    if ((f.w.value == "") ||
        (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {

        reg_mb_email_check();

        if (document.getElementById('mb_email_enabled').value!='000') {
            alert('E-mailÀ» ÀÔ·ÂÇÏÁö ¾Ê¾Ò°Å³ª ÀÔ·Â¿¡ ¿À·ù°¡ ÀÖ½À´Ï´Ù.');
            document.getElementById('reg_mb_email').select();
            return false;
        }

        // »ç¿ëÇÒ ¼ö ¾ø´Â E-mail µµ¸ŞÀÎ
        var domain = prohibit_email_check(f.mb_email.value);
        if (domain) {
            alert("'"+domain+"'Àº(´Â) »ç¿ëÇÏ½Ç ¼ö ¾ø´Â ¸ŞÀÏÀÔ´Ï´Ù.");
            document.getElementById('reg_mb_email').focus();
            return false;
        }
    }

    if (typeof(f.mb_birth) != 'undefined') {
        if (f.mb_birth.value.length < 1) {
            alert('´Ş·Â ¹öÆ°À» Å¬¸¯ÇÏ¿© »ıÀÏÀ» ÀÔ·ÂÇÏ¿© ÁÖ½Ê½Ã¿À.');
            //f.mb_birth.focus();
            return false;
        }

        var todays = <?=date("Ymd", $g4['server_time']);?>;
        // ¿À´Ã³¯Â¥¿¡¼­ »ıÀÏÀ» »©°í °Å±â¼­ 140000 À» »«´Ù.
        // °á°ú°¡ 0 ÀÌ»óÀÇ ¾ç¼öÀÌ¸é ¸¸ 14¼¼°¡ Áö³­°ÍÀÓ
        var n = todays - parseInt(f.mb_birth.value) - 140000;
        if (n < 0) {
            alert("¸¸ 14¼¼°¡ Áö³ªÁö ¾ÊÀº ¾î¸°ÀÌ´Â Á¤º¸Åë½Å¸Á ÀÌ¿ëÃËÁø ¹× Á¤º¸º¸È£ µî¿¡ °üÇÑ ¹ı·ü\n\nÁ¦ 31Á¶ 1Ç×ÀÇ ±ÔÁ¤¿¡ ÀÇÇÏ¿© ¹ıÁ¤´ë¸®ÀÎÀÇ µ¿ÀÇ¸¦ ¾ò¾î¾ß ÇÏ¹Ç·Î\n\n¹ıÁ¤´ë¸®ÀÎÀÇ ÀÌ¸§°ú ¿¬¶ôÃ³¸¦ 'ÀÚ±â¼Ò°³'¶õ¿¡ º°µµ·Î ÀÔ·ÂÇÏ½Ã±â ¹Ù¶ø´Ï´Ù.");
            return false;
        }
    }

    if (typeof(f.mb_sex) != 'undefined') {
        if (f.mb_sex.value == '') {
            alert('¼ºº°À» ¼±ÅÃÇÏ¿© ÁÖ½Ê½Ã¿À.');
            f.mb_sex.focus();
            return false;
        }
    }

    if (typeof f.mb_icon != 'undefined') {
        if (f.mb_icon.value) {
            if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
                alert('È¸¿ø¾ÆÀÌÄÜÀÌ gif ÆÄÀÏÀÌ ¾Æ´Õ´Ï´Ù.');
                f.mb_icon.focus();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != 'undefined') {
        if (f.mb_id.value == f.mb_recommend.value) {
            alert('º»ÀÎÀ» ÃßÃµÇÒ ¼ö ¾ø½À´Ï´Ù.');
            f.mb_recommend.focus();
            return false;
        }
    }

    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/register_form_update.php';";
    else
        echo "f.action = './register_form_update.php';";
    ?>

    // º¸¾ÈÀÎÁõ°ü·Ã ÄÚµå·Î ¹İµå½Ã Æ÷ÇÔµÇ¾î¾ß ÇÕ´Ï´Ù.
    set_cookie("<?=md5($token)?>", "<?=base64_encode($token)?>", 1, "<?=$g4['cookie_domain']?>");

    return true;
}

// ±İÁö ¸ŞÀÏ µµ¸ŞÀÎ °Ë»ç
function prohibit_email_check(email)
{
    email = email.toLowerCase();

    var prohibit_email = "<?=trim(strtolower(preg_replace("/(\r\n|\r|\n)/", ",", $config[cf_prohibit_email])));?>";
    var s = prohibit_email.split(",");
    var tmp = email.split("@");
    var domain = tmp[tmp.length - 1]; // ¸ŞÀÏ µµ¸ŞÀÎ¸¸ ¾ò´Â´Ù

    for (i=0; i<s.length; i++) {
        if (s[i] == domain)
            return domain;
    }
    return "";
}
</script>
