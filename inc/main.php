<!DOCTYPE html>
<style type="text/css">
/*mimg*/
ul, li {list-style: none; padding: 0; margin: 0;}
#blinds-cont {width: 1345px; height: 539px;}
#blinds {height: 539px; width: 1345px; margin: 0 auto;}
.floom_container {overflow: hidden;}
.floom_progressbar {height: 21px; background: #dedede; width: 0; position: relative; top: 2px; z-index: 10;}
.floom_vertical {float: left;}
</style>

<script type="text/javascript" charset="utf-8" src="/gnuboard4/inc/mootools-1.2.2-core.js"></script>
<script type="text/javascript" charset="utf-8" src="/gnuboard4/inc/mootools-1.2.2.2-more.js"></script>
<script type="text/javascript" charset="utf-8" src="/gnuboard4/inc/floom.js"></script>
<script type="text/javascript" charset="utf-8">
		window.addEvent('domready', function(e){	
			
			// option 1		
			var slides = [
				{
					image: 'mimg01.jpg',
					caption: ''
				},
				{
					image: 'mimg02.jpg',
					caption: ''
				}
			];
			
			// option 2
			// var slides = $$('#blinds img');

			$('blinds').floom(slides, {
				slidesBase: '/gnuboard4/images/',
				sliceFxIn: {
					top: 20
				}
			});
			
		});
</script>

<div id="blinds-cont">
<div id="blinds"></div>
</div>

