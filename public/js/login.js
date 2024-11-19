$(document).ready(function(){

	//Seccion para mostrar lo enviado en el modal mensaje//
	
	//Función que verifica que exista algo dentro de un div
	//oculto y lo muestra por el modal
	if($.trim($("#mensajes").text()) != ""){
		muestraMensaje($("#mensajes").html());
	}
	//Fin de seccion de mostrar envio en modal mensaje//		
		
		
		$("#username").on("keypress",function(e){
			validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
		});
		
		$("#username").on("keyup",function(){
			validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,15}$/,
				$(this),$("#susername"),"Este formato permite de 4 a 15 carácteres");
		});
		
		/*$("#password").on("keypress",function(e){
			validarkeypress(/^[A-Za-z0-9\b]*$/,e);
		});
		
		$("#password").on("keyup",function(){
			
			validarkeyup(/^[A-Za-z0-9]{4,15}$/,
			$(this),$("#spassword"),"Solo letras y numeros entre 4 y 15 caracteres");
		});
		*/
		
		
	//FIN DE VALIDACION DE DATOS
	
	
	
	//CONTROL DE BOTONES
	
	
	$("#acceder").on("click",function(){
		event.preventDefault();
		if(validarenvio()){
			
			$("#accion").val("acceder");	
			$("#f").submit();
			
		}
	});
		
	});
	
	//Validación de todos los campos antes del envio
	function validarenvio(){
		
		if(validarkeyup(/^[A-Za-z0-9]{4,15}$/,$("#username"),
			$("#susername"),"Este formato permite de 4 a 15 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","El username debe tener mínimo 4 dígitos y máximo 15");
			return false;					
		}	
		else if(validarkeyup(/^[A-Za-z0-9]{4,15}$/,
			$("#password"),$("#spassword"),"Solo letras y numeros entre 4 y 15 caracteres")==0){
			 muestraMensaje("error",4000,"ERROR!","El password debe tener mínimo 4 dígitos y máximo 15");
			return false;
		}
		
		
		return true;
	}
	
	
	//Funcion que muestra el modal con un mensaje
	function muestraMensaje(icono,tiempo,titulo,mensaje){
		Swal.fire({
		icon:icono,
		timer:tiempo,	
		title:titulo,
		html:mensaje,
		showConfirmButton:true,
		confirmButtonText:'Aceptar',
		});
	}
	
	document.addEventListener("DOMContentLoaded", function() {
		const mensajesDiv = document.getElementById("mensajes");
		const mensaje = mensajesDiv.getAttribute("data-mensaje");
	
		if (mensaje) {
			muestraMensaje("error", 4000, "Error", mensaje);
		}
	});
	/* //Siempre manda el error de usuario o contraseña si no se manda ningún error diferente
	
	function muestraMensaje(icono = "error", tiempo = 4000, titulo = "Error", mensaje = "Error en el usuario o contraseña!!!") {
		const iconoInvalido = ["success", "error", "warning", "info", "question"];
		if (!iconoInvalido.includes(icono)) {
			icono = "error"; // Valor por defecto si el icono no es válido
		}
		Swal.fire({
			icon: icono,
			timer: tiempo,
			title: titulo,
			text: mensaje, 
			showConfirmButton: true,
			confirmButtonText: "Aceptar",
		});
	} */
	
	//Función para validar por Keypress
	function validarkeypress(er,e){
		
		key = e.keyCode;
		
		
		tecla = String.fromCharCode(key);
		
		
		a = er.test(tecla);
		
		if(!a){
		
			e.preventDefault();
		}
		
		
	}
	//Función para validar por keyup
	function validarkeyup(er,etiqueta,etiquetamensaje,
	mensaje){
		a = er.test(etiqueta.val());
		if(a){
			etiquetamensaje.text("");
			return 1;
		}
		else{
			etiquetamensaje.text(mensaje);
			return 0;
		}
	}