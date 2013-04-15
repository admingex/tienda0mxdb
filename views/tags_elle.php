<?php
/*
echo "<pre>";
print_r($detalles_promociones);
echo "</pre>";
*/

if(isset($detalles_promociones))
		foreach($detalles_promociones as $detalle){
			// oc 94 es para quien				
			
			if($detalle->id_promocion==1252){
				
?>			
<!-- Pixel Facebook -->
<script type="text/javascript">
	var fb_param = {};
	fb_param.pixel_id = '6009367094840';
	fb_param.value = '0.00';
	(function(){
  		var fpw = document.createElement('script');
  		fpw.async = true;
  		fpw.src = (location.protocol=='http:'?'http':'https')+'://connect.facebook.net/en_US/fp.js';
  		var ref = document.getElementsByTagName('script')[0];
  		ref.parentNode.insertBefore(fpw, ref); })(); 
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6009367094840&amp;value=0" /></noscript>

<!-- Pixel Facebook -->
<?php
				break;
			}
						
		}		
	
?>