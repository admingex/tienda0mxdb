function checkFields(forma){
	if (forma.nombre.value=="") { alert('Ingrese el nombre'); return false; }
	if (forma.r1.value != 0 & forma.r2.value != 0){
		if(forma.r1.value==forma.r2.value){
			alert("Las publicaciones relacionadas no pueden ser las mismas")
			return false;
		}			
	}
	if (forma.r1.value != 0 & forma.r2.value != 0 & forma.r3.value != 0){
		if(forma.r1.value==forma.r2.value || forma.r1.value==forma.r3.value || forma.r3.value==forma.r2.value){
			alert("Las publicaciones relacionadas no pueden ser las mismas")
			return false;
		}			
	}
	if (forma.s1.value != 0 & forma.s2.value != 0){
		if(forma.s1.value==forma.s2.value){
			alert("Las publicaciones relacionadas no pueden ser las mismas")
			return false;
		}			
	}
	if (forma.s1.value != 0 & forma.s2.value != 0 & forma.s3.value != 0){
		if(forma.s1.value==forma.s2.value || forma.s1.value==forma.s3.value || forma.s3.value==forma.s2.value){
			alert("Las publicaciones relacionadas no pueden ser las mismas")
			return false;
		}			
	}
}
