<?
$img = "../../".$img;
$tmp = getImagesize($img);
if($tmp[0]<$width){
	$width = $tmp[0];
	$height = $tmp[1];
}else{
	$w_rate = $tmp[0]/$width;
	$height = $tmp[1]/$w_rate;
}
?>
<html>
<head>
<title>ÀÌ¹ÌÁö</title>
<style>
.drag { position: relative; cursor:move; }
</style>

<script language="JavaScript">
<!--
var bdown = false;
var x, y;
var sElem;

function mdown(evt) {
evt = (evt) ? evt : ((window.event) ? window.event : "");
sElem = evt.target ? evt.target : evt.srcElement;

if (evt.stopPropagation) {	
	evt.stopPropagation();
	evt.preventDefault();
}
evt.returnValue  = false;
evt.cancelBubble = true;

if(sElem.className == "drag") {
  bdown = true;
  x = evt.clientX;
  y = evt.clientY;
}
}
function mup() {
bdown = false;
}

document.onmousemove = function moveimg(event) {
event = (event) ? event : ((window.event) ? window.event : "");
if(bdown) {
  var distX = event.clientX - x;
  var distY = event.clientY - y;
  var targetImg = document.getElementById('imgTomove');
  targetImg.style.left = (parseInt(targetImg.style.left) + distX) + 'px';
  targetImg.style.top = (parseInt(targetImg.style.top) + distY) + 'px';
  x = event.clientX;
  y = event.clientY;
return false;
}
}

//-->
</script>
</head>
<body style="margin:0px" ondblclick="window.close();" oncontextmenu="return false;">
<img src="<?=$img?>" width="<?=$width?>" height="<?=$height?>" id="imgTomove" style="left:0px;top:0px" onmousedown="mdown(event);" onmouseup="mup();" name="cnjimg" ondblclick="window.close();" class="drag" oncontextmenu="return false;">
<script>resizeTo(<?=$width?>,<?=$height?>);</script>
</body>
</html>
