<style> 
#mimg01{position:absolute; width:100%; left:600px;}
#mimg02{position:absolute; width:100%; left:600px;}
#mimg03{position:absolute; width:100%; left:600px;}
</style> 

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

<div id="mimg01"><img src="<?=$skinName?>images/maintxt1.png"></div>
<div id="mimg02"><img src="<?=$skinName?>images/maintxt2.png"></div>
<div id="mimg03"><img src="<?=$skinName?>images/maintxt3.png"></div>


<script> 
	$(document).ready(function() {
		$("#mimg01").animate({top:50},2000);  
		$("#mimg02").animate({top:90},2000); 
		$("#mimg03").animate({top:180},2000); 
});

</script> 

