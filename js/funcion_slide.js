$(function() {

	//	Responsive layout, resizing the items
	$('#slider').carouFredSel({
		responsive: true,
		width: '100%',
		prev: '#prev',
		next: '#next',
		scroll: 1,
		items: {
			width: 100,
			height: 235,	//	optionally resize item-height
			visible: {
				min: 3,
				max: 3
			}
		}	
			
	});
	

});

function cambia_img(id){					
	if($("#"+ id)){
		if( $("#"+ id).attr("class") == "imagen1"){		
			$("#"+ id).removeClass("imagen1").addClass("imagen2");
		}	
		else{
			$("#"+ id).removeClass("imagen2").addClass("imagen1");
		}
	}																		
}