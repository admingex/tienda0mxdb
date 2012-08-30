$(document).ready(function() {
	/*ENERGIA 360 ACEPTA INFORMACION*/
	$("#divtipo_e360_inicio3").click(function() {		
	if ($("#bulk").attr("checked")){
		//alert("activo");
		$("#divtipo_e360_inicio3").removeClass('checkbox_selected').addClass('checkbox_no_selected');
		document.getElementById('bulk').checked='';
		$("#bulk").removeAttr("checked");
	}
	else{
		//alert("descativado");
		$("#divtipo_e360_inicio3").removeClass('checkbox_no_selected').addClass('checkbox_selected');
		document.getElementById('bulk').checked='checked';
		$("#bulk").attr("checked");
	}
	});
	
	//para guia de compras paso dos 
	$("#radio1").click(function() {				
		$("#radio1").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio6").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('cargo1').checked='checked';
		document.getElementById('cargo2').checked='';
		document.getElementById('cargo3').checked='';
		document.getElementById('cargo4').checked='';
		document.getElementById('cargo5').checked='';
		document.getElementById('cargo6').checked='';
		document.getElementById('cargootro').disabled=true;
	});
	
		$("#radio2").click(function() {				
		$("#radio2").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio6").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('cargo2').checked='checked';
		document.getElementById('cargo1').checked='';
		document.getElementById('cargo3').checked='';
		document.getElementById('cargo4').checked='';
		document.getElementById('cargo5').checked='';
		document.getElementById('cargo6').checked='';
		document.getElementById('cargootro').disabled=true;
	});
	
		$("#radio3").click(function() {				
		$("#radio3").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio6").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('cargo3').checked='checked';
		document.getElementById('cargo2').checked='';
		document.getElementById('cargo1').checked='';
		document.getElementById('cargo4').checked='';
		document.getElementById('cargo5').checked='';
		document.getElementById('cargo6').checked='';
		document.getElementById('cargootro').disabled=true;
	});
	
	
		$("#radio4").click(function() {				
		$("#radio4").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio6").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('cargo4').checked='checked';
		document.getElementById('cargo2').checked='';
		document.getElementById('cargo3').checked='';
		document.getElementById('cargo1').checked='';
		document.getElementById('cargo5').checked='';
		document.getElementById('cargo6').checked='';
		document.getElementById('cargootro').disabled=true;
	});
	
		$("#radio5").click(function() {				
		$("#radio5").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio6").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('cargo5').checked='checked';
		document.getElementById('cargo2').checked='';
		document.getElementById('cargo3').checked='';
		document.getElementById('cargo4').checked='';
		document.getElementById('cargo1').checked='';
		document.getElementById('cargo6').checked='';
				document.getElementById('cargootro').disabled=true;
	});
	
		$("#radio6").click(function() {				
		$("#radio6").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio1").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('cargo6').checked='checked';
		document.getElementById('cargo2').checked='';
		document.getElementById('cargo3').checked='';
		document.getElementById('cargo4').checked='';
		document.getElementById('cargo5').checked='';
		document.getElementById('cargo1').checked='';
		document.getElementById('cargootro').disabled=false;
		
	});
	
		
		//pregunta dos
	
		$("#radio2_1").click(function() {
		document.getElementById('actividadotra').disabled=true;
		$("#radio2_1").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio2_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio2_4").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('actividad1').checked='checked';
		document.getElementById('actividad2').checked='';
		document.getElementById('actividad3').checked='';
		document.getElementById('actividad4').checked='';
		
		
	});
	
		$("#radio2_2").click(function() {
		document.getElementById('actividadotra').disabled=true;		
		$("#radio2_2").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio2_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio2_4").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('actividad2').checked='checked';
		document.getElementById('actividad1').checked='';
		document.getElementById('actividad3').checked='';
		document.getElementById('actividad4').checked='';
		
	});
	
		$("#radio2_3").click(function() {
		document.getElementById('actividadotra').disabled=true;
		$("#radio2_3").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio2_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio2_4").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('actividad3').checked='checked';
		document.getElementById('actividad2').checked='';
		document.getElementById('actividad1').checked='';
		document.getElementById('actividad4').checked='';
		
	});
	
		$("#radio2_4").click(function() {	
		document.getElementById('actividadotra').disabled=false;
		$("#radio2_4").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio2_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio2_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio2_1").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('actividad4').checked='checked';
		document.getElementById('actividad2').checked='';
		document.getElementById('actividad3').checked='';
		document.getElementById('actividad1').checked='';
		
	});
	 
	 //pregunta 3
	
				$("#radio3_1").click(function() {				
		$("#radio3_1").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio3_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_5").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('proyecto1').checked='checked';
		document.getElementById('proyecto2').checked='';
		document.getElementById('proyecto3').checked='';
		document.getElementById('proyecto4').checked='';
		document.getElementById('proyecto5').checked='';
	});
					$("#radio3_2").click(function() {				
		$("#radio3_2").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio3_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_5").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('proyecto2').checked='checked';
		document.getElementById('proyecto1').checked='';
		document.getElementById('proyecto3').checked='';
		document.getElementById('proyecto4').checked='';
		document.getElementById('proyecto5').checked='';
	});
					$("#radio3_3").click(function() {				
		$("#radio3_3").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio3_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_5").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('proyecto3').checked='checked';
		document.getElementById('proyecto2').checked='';
		document.getElementById('proyecto1').checked='';
		document.getElementById('proyecto4').checked='';
		document.getElementById('proyecto5').checked='';
	});
					$("#radio3_4").click(function() {				
		$("#radio3_4").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio3_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_5").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('proyecto4').checked='checked';
		document.getElementById('proyecto2').checked='';
		document.getElementById('proyecto3').checked='';
		document.getElementById('proyecto1').checked='';
		document.getElementById('proyecto5').checked='';
	});
						$("#radio3_5").click(function() {				
		$("#radio3_5").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio3_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio3_4").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('proyecto5').checked='checked';
		document.getElementById('proyecto2').checked='';
		document.getElementById('proyecto3').checked='';
		document.getElementById('proyecto1').checked='';
		document.getElementById('proyecto4').checked='';
	});
	//pregunta5
		
		
		$("#radio5_1").click(function() {		
	if ($("#med1").attr("checked")){
		//alert("activo");
		$("#radio5_1").removeClass('checkbox_selected').addClass('checkbox_no_selected');
		document.getElementById('med1').checked='';
		$("#med1").removeAttr("checked");
	}
	else{
		//alert("descativado");
		$("#radio5_1").removeClass('checkbox_no_selected').addClass('checkbox_selected');
		document.getElementById('med1').checked='checked';
		$("#med1").attr("checked");
	}
	});
	//*******************************************
		$("#radio5_2").click(function() {		
	if ($("#med2").attr("checked")){
		//alert("activo");
		$("#radio5_2").removeClass('checkbox_selected').addClass('checkbox_no_selected');
		document.getElementById('med2').checked='';
		$("#med2").removeAttr("checked");
	}
	else{
		//alert("descativado");
		$("#radio5_2").removeClass('checkbox_no_selected').addClass('checkbox_selected');
		document.getElementById('med2').checked='checked';
		$("#med2").attr("checked");
	}
	});
	
		//*******************************************
		$("#radio5_3").click(function() {		
	if ($("#med3").attr("checked")){
		//alert("activo");
		$("#radio5_3").removeClass('checkbox_selected').addClass('checkbox_no_selected');
		document.getElementById('med1').checked='';
		$("#med3").removeAttr("checked");
	}
	else{
		//alert("descativado");
		$("#radio5_3").removeClass('checkbox_no_selected').addClass('checkbox_selected');
		document.getElementById('med3').checked='checked';
		$("#med3").attr("checked");
	}
	});
		//*******************************************
		$("#radio5_4").click(function() {		
	if ($("#med4").attr("checked")){
		//alert("activo");
		$("#radio5_4").removeClass('checkbox_selected').addClass('checkbox_no_selected');
		document.getElementById('med4').checked='';
		$("#med4").removeAttr("checked");
	}
	else{
		//alert("descativado");
		$("#radio5_4").removeClass('checkbox_no_selected').addClass('checkbox_selected');
		document.getElementById('med4').checked='checked';
		$("#med4").attr("checked");
	}
	});
	//pregunta 8
	
	
	    $("#radio8_1").click(function() {				
		$("#radio8_1").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_6").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_7").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_8").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_9").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados1').checked='checked';
		document.getElementById('empleados2').checked='';
		document.getElementById('empleados3').checked='';
		document.getElementById('empleados4').checked='';
		document.getElementById('empleados5').checked='';
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados7').checked='';
		document.getElementById('empleados8').checked='';
		document.getElementById('empleados9').checked='';
			});
			    $("#radio8_2").click(function() {				
		$("#radio8_2").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_6").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_7").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_8").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_9").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados2').checked='checked';
		document.getElementById('empleados1').checked='';
		document.getElementById('empleados3').checked='';
		document.getElementById('empleados4').checked='';
		document.getElementById('empleados5').checked='';
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados7').checked='';
		document.getElementById('empleados8').checked='';
		document.getElementById('empleados9').checked='';
			});
		
	    $("#radio8_3").click(function() {				
		$("#radio8_3").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_6").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_7").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_8").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_9").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados3').checked='checked';
		document.getElementById('empleados2').checked='';
		document.getElementById('empleados1').checked='';
		document.getElementById('empleados4').checked='';
		document.getElementById('empleados5').checked='';
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados7').checked='';
		document.getElementById('empleados8').checked='';
		document.getElementById('empleados9').checked='';
		});
		    $("#radio8_4").click(function() {				
		$("#radio8_4").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_6").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_7").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_8").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_9").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados4').checked='checked';
		document.getElementById('empleados2').checked='';
		document.getElementById('empleados3').checked='';
		document.getElementById('empleados1').checked='';
		document.getElementById('empleados5').checked='';
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados7').checked='';
		document.getElementById('empleados8').checked='';
		document.getElementById('empleados9').checked='';
			});
		
			    $("#radio8_5").click(function() {				
		$("#radio8_5").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_6").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_7").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_8").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_9").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados5').checked='checked';
		document.getElementById('empleados2').checked='';
		document.getElementById('empleados3').checked='';
		document.getElementById('empleados4').checked='';
		document.getElementById('empleados1').checked='';
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados7').checked='';
		document.getElementById('empleados8').checked='';
		document.getElementById('empleados9').checked='';
			});
			    $("#radio8_6").click(function() {				
		$("#radio8_6").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_7").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_8").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_9").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados2').checked='';
		document.getElementById('empleados3').checked='';
		document.getElementById('empleados4').checked='';
		document.getElementById('empleados5').checked='';
		document.getElementById('empleados1').checked='checked';
		document.getElementById('empleados7').checked='';
		document.getElementById('empleados8').checked='';
		document.getElementById('empleados9').checked='';
			});
			    $("#radio8_7").click(function() {				
		$("#radio8_7").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_6").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_8").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_9").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados7').checked='checked';
		document.getElementById('empleados2').checked='';
		document.getElementById('empleados3').checked='';
		document.getElementById('empleados4').checked='';
		document.getElementById('empleados5').checked='';
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados1').checked='';
		document.getElementById('empleados8').checked='';
		document.getElementById('empleados9').checked='';
			});
			    $("#radio8_8").click(function() {				
		$("#radio8_8").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_6").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_7").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_1").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_9").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados8').checked='checked';
		document.getElementById('empleados2').checked='';
		document.getElementById('empleados3').checked='';
		document.getElementById('empleados4').checked='';
		document.getElementById('empleados5').checked='';
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados7').checked='';
		document.getElementById('empleados1').checked='';
		document.getElementById('empleados9').checked='';
			});
		
			    $("#radio8_9").click(function() {				
		$("#radio8_9").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio8_2").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_3").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_4").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_5").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_6").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_7").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_8").removeClass('radio_selected').addClass('radio_no_selected');
		$("#radio8_1").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('empleados9').checked='checked';
		document.getElementById('empleados2').checked='';
		document.getElementById('empleados3').checked='';
		document.getElementById('empleados4').checked='';
		document.getElementById('empleados5').checked='';
		document.getElementById('empleados6').checked='checked';
		document.getElementById('empleados7').checked='';
		document.getElementById('empleados8').checked='';
		document.getElementById('empleados1').checked='';
			});
			
			
			
			 $("#radio_nacional").click(function() {				
		$("#radio_nacional").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio_internacional").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('pais1').checked='checked';
		document.getElementById('pais2').checked='';
			});
				 $("#radio_internacional").click(function() {				
		$("#radio_internacional").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio_nacional").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('pais2').checked='checked';
		document.getElementById('pais1').checked='';
			});
			
			
			//para interiores sexo
			 $("#radio_femenino").click(function() {				
		$("#radio_femenino").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio_masculino").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('sexo1').checked='checked';
		document.getElementById('sexo2').checked='';
			});
				 $("#radio_masculino").click(function() {				
		$("#radio_masculino").removeClass('radio_no_selected').addClass('radio_selected');
		$("#radio_femenino").removeClass('radio_selected').addClass('radio_no_selected');
		document.getElementById('sexo2').checked='checked';
		document.getElementById('sexo1').checked='';
			});
});

