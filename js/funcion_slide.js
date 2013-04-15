$(function() {

	//	Responsive layout, resizing the items
	$('#slider').carouFredSel({
		responsive: false,				
		prev: '#prev',
		next: '#next',
		scroll: {duration: 500, items: 1},
		items: {					
			visible: 3,			
		}					
	});
	

});

function cambia_img(id){	
	$("#temp").html($("#descripcion"+id).text());
	$("#titulo_pub").html($("#titulo"+id).text()); 																
}


