<html>
	<head>
	{literal}
	<style>
	
		.connected, .sortable, .exclude, .handles {
			margin: auto;
			padding: 0;
			width: 310px;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		
		.connected li, .sortable li, .exclude li, .handles li {
			list-style: none;
			border: 1px solid #CCC;
			background: #F6F6F6;
			font-family: "Tahoma";
			color: #1C94C4;
			margin: 5px;
			padding: 5px;
			height: 22px;
		}
		.handles span {
			cursor: move;
		}
		li.disabled {
			opacity: 0.5;
		}
		.sortable.grid li {
			line-height: 80px;
			float: left;
			width: 80px;
			height: 80px;
			text-align: center;
		}
	
		#connected {
			width: 440px;
			overflow: hidden;
			margin: auto;
		}
		.connected {
			float: left;
			width: 200px;
		}
		.connected.no2 {
			float: right;
		}

	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/jquery.sortable.js"></script>
	<script>
		$(function() {
			$('.sortable').sortable();
			$('.handles').sortable({
				handle: 'span'
			});
			$('.connected').sortable({
				connectWith: '.connected'
			});
			$('.exclude').sortable({
				items: ':not(.disabled)'
			});
			
			/*PARA ELIMINAR EL ELEMENTO DE LA TABLA*/
			//$("div#footer").remove();
			$('li.cpl').click(function () {
			var avalor = this.id;
			alert(avalor);
			$("li#"+avalor).remove();
			});
			
		});
		
		function eliminali(){
			
		}
	</script>
	{/literal}
	</head>
<body>
<section id="connected">
		
		<ul class="connected list">
			<p class="instrucciones_cursivas">Publicaciones</p>
			{section name=listPublicacionesCat loop=$lpublica}
			<li id="{$lpublica[listPublicacionesCat].id_publicacionSi}"><a href="" id="{$lpublica[listPublicacionesCat].id_publicacionSi}" class="cpl">{$lpublica[listPublicacionesCat].nombreVc}</a></li>
			{/section}	
		</ul>
		<ul class="connected list no2">
			<p class="instrucciones_cursivas">Publicaciones</p>
			{section name=allPubli loop=$allPubli}
			<li><a href="" id="{$allPubli[allPubli].id_publicacionSi}" class="cpl">{$allPubli[allPubli].nombreVc}</a></li>
			{/section}	
		</ul>
	</section>
</body>
</html>