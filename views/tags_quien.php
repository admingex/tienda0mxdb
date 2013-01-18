<?php
/*
echo "<pre>";
print_r($detalles_promociones);
echo "</pre>";
*/

if(isset($detalles_promociones))
		foreach($detalles_promociones as $detalle){
			// oc 94 es para quien				
			if($detalle->oc_id == 94){
				
?>			
				<!-- Google Tag Manager -->
				<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-F8GW"
				height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
				<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-F8GW');</script>
				<!-- End Google Tag Manager -->
<?php
				break;
			}
		}		
	
?>