$(function() {

	//	Responsive layout, resizing the items
	$('#slider').carouFredSel({
		responsive: true,
		width: '100%',
		prev: '#prev',
		next: '#next',
		scroll: 1,
		items: {
			width: 200,
			height: 150,	//	optionally resize item-height
			visible: {
				min: 3,
				max: 3
			}
		}
	});


});

function cambia_img(id){				
	//var im = $('#'+id);
	var im = document.getElementById(id);
	if( im ){										
		im.src = 	im.src.match(/images/) ? 
					im.src.replace(/images/, 'p_') : 
					im.src.replace(/p_/, 'images');	
	}
	
	
}