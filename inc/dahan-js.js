// JavaScript Document

// Flash
function swf(src,w,h,wmode,bgColor){
 html = '';
 html += '<object type="application/x-shockwave-flash" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" id="param" width="'+w+'" height="'+h+'">';
 html += '<param name="movie" value="'+src+'">';
 html += '<param name="quality" value="high">';
 if(bgColor != ""){
  html += '<param name="bgcolor" value="'+ bgColor +'">';
 }
 if(wmode != ""){
  html += '<PARAM NAME="wmode" VALUE="'+ wmode +'">';
 }
 html += '<param name="swliveconnect" value="true">';
 html += '<embed src="'+src+'" wmode="'+ wmode +'" quality=high width="'+w+'" height="'+h+'" swliveconnect="true" id="param" name="param" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>';
 html += '</object>';
 document.write(html);
}
function mov(src,w,h,vol,scon){
 html = '';
 
 //showcontrols
 if(scon == "") {
  scon = "true";
 } else {
  scon = "false";
 }
 
 //width
 if(w == "") {
  w = '';
 } else {
  w = '" width="'+w+'"';
 }
 
 //height
 if(h == "") {
  h = '';
 } else {
  h = '" height="'+h+'"';
 }
 
 //volume
 if(vol == "") {
  vol = '';
 } else {
  vol = '" volume="'+vol+'"';
 }
 
 html = '<embed src="'+src+'" showcontrols="'+scon+'" autostart="true" enablecontextmenu="false" '+w+' '+h+' '+vol+'></embed>';
 document.write(html);
}

function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;


