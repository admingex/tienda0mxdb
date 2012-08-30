function vemail(correoTmp,Requerido,Control)
{
//	var correoTmp;  //correo a validar
//	var Requerido = 1;  //bandera de opcional el email
	var cIncorrecto = 0;
	var nCaract;
	var Caracteres = ".@-_1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	var CaracteresNoInicio = ".-_";
	var arrDComunes = new Array("hotmail.com");

	splitstring = correoTmp.split(";");
	for(i = 0; i < splitstring.length; i++)
	{
	  if(splitstring[i].length==0 && i>0 && splitstring.length==i+1) continue;
	 	
	 	//Valida que el correo contenga caracteres válidos
		for (j = 0; j < splitstring[i].length; j++)
		{
//		alert( splitstring[i].charAt(j) );
			if (Caracteres.indexOf(splitstring[i].charAt(j)) == -1)
				{
				cIncorrecto = 1
				}
		}
		
		if(cIncorrecto == 0)
			{
			//Cuenta el numero de @'s
			splitstringArro = splitstring[i].split("@");
			if(splitstringArro.length==2)
				{ 
				//Que contiene solo una arroba
				//Separa el correo en dos secciones
				for(j = 0; j < splitstringArro.length;j++)
				{
				  if (splitstringArro[j].length==0)
				   {
				  	  cIncorrecto = 1
					  continue;
				   }
				
				 // Valida el correo,despues de la @
				//Separa la informacionpor cada punto
					splitstringPto = splitstringArro[j].split(".");
					//Valida que haya texto despues de un punto
					for(k=0;k<splitstringPto.length;k++)
						{
						if(splitstringPto[k].length==0  || CaracteresNoInicio.indexOf(splitstringPto[k].charAt(0)) >=0 )
							cIncorrecto = 1
						else
						if(splitstringPto.length < 2 && j==1)
						cIncorrecto = 1
						}
					//Si es un correo de losdominios "comunes", valida q sea correcto
					if(cIncorrecto == 0 && j==1)
					{
						for(k=0;k<arrDComunes.length;k++)
						{
							splitstringPtoTmp = arrDComunes[k].split(".");
							if(splitstringPto[0]==splitstringPtoTmp[0])
								{
								if(splitstringArro[j] != arrDComunes[k])
								cIncorrecto = 1
								}
						}
					}
					
				}
			}else
				{
				cIncorrecto = 1
				}
		}
	}
	
	
	if( cIncorrecto == 0  ||  (correoTmp.length==0 && Requerido==0) )
	{
	return true;
	}
	else 
	{
	alert("\nError:  EMAIL  INCORRECTO\n\nVerifique que su email sea correcto.\nQue no contenga espacios, comas o acentos.\nEn m"+'\u00fa'+"ltiples emails separlos por ;")
	if(Control!="") eval(Control + ".focus();" );
	return false;
	}

}