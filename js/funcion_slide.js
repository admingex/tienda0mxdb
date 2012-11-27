$(function() {

	//	Responsive layout, resizing the items
	$('#slider').carouFredSel({
		responsive: false,					
		prev: '#prev',
		next: '#next',
		scroll: 1,
		items: {
			width: 192,			
			//height: '30%',	//	optionally resize item-height
			visible: {
				min: 1,
				max: 3
			}
		}																				
	});
	/*
	//	Responsive layout, resizing the items
	$('#slideridc').carouFredSel({
		responsive: false,					
		prev: '#prev',
		next: '#next',
		scroll: 1,
		items: {
			//width: 192,			
			//height: '30%',	//	optionally resize item-height
			visible: {
				min: 1,
				max: 3
			}
		}																				
	});
	
	*/
	
	
	

});

function cambia_img(id){	
	$("#temp").html($("#descripcion"+id).text());
	$("#titulo_pub").html($("#titulo"+id).text()); 																
}


