$(function() {

	//	Responsive layout, resizing the items
	$('#slider').carouFredSel({
		responsive: false,			
		prev: '#prev',
		next: '#next',
		scroll: 1,
		items: {						
			visible: {
				min: 1,
				max: 3
			}
		}	
			
	});
	

});

function cambia_img(id){	
	$("#temp").html($("#descripcion"+id).text());
	$("#titulo_pub").html($("#titulo"+id).text());
	
	/*					
	if($("#"+ id)){
		if( $("#"+ id).attr("class") == "imagen1"){		
			$("#"+ id).removeClass("imagen1").addClass("imagen2");
		}	
		else{
			$("#"+ id).removeClass("imagen2").addClass("imagen1");
		}
	}	
	*/																	
}

function cambia_img2(id){
	$("#o"+ id).css('display', 'none')
	$("#"+ id).css('display', 'block')
}
