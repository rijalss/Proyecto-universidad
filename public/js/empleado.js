$(document).ready(function(){

	if($.trim($("#mensajes").text()) != ""){
		muestraMensaje($("#mensajes").html());
	}
		
		$("#cedulaEmpleado").on("keypress",function(e){
			validarkeypress(/^[0-9-\b]*$/,e);
		});
		
		$("#cedulaEmpleado").on("keyup",function(){
			validarkeyup(/^[0-9]{8,10}$/,$(this),
			$("#scedulaEmpleado"),"El formato debe tener mínimo 8 y máximo 10 carácteres");
		});
	
		$("#nombreEmpleado").on("keypress",function(e){
			validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
		});
		
		$("#nombreEmpleado").on("keyup",function(){
			validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{0,30}$/, 
			$(this), $("#snombreEmpleado"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
		});
	
		$("#telefonoEmpleado").on("keypress",function(e){
			validarkeypress(/^[0-9-\b]*$/,e);
		});
		
		$("#telefonoEmpleado").on("keyup",function(){
			validarkeyup(/^[0-9]{11}$/,$(this),
			$("#stelefonoEmpleado"),"El formato debe tener 11 carácteres");
		});
		$("#apellidoEmpleado").on("keypress",function(e){
			validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
		});
		
		$("#apellidoEmpleado").on("keyup",function(){
			validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
			$(this),$("#sapellidoEmpleado"),"Se debe llenar este campo y debe tener un máximo de 30 carácteres");
		});
		
	$("#incluir").on("click",function(){
		if(validarenvio()){
			 var datos = new FormData();
			 datos.append('accion','incluir');
			 datos.append('cedula',$("#cedulaEmpleado").val());
			 datos.append('telefono',$("#teleEmpleado").val());
			 datos.append('nombre',$("#nombreEmpleado").val());
			 datos.append('apellido',$("#apellidoEmpleado").val());
			 datos.append('correo',$("#correoEmpleado").val());
			 datos.append('contraseña',$("#contraEmpleado").val());
			 enviaAjax(datos);
			 limpia();
		}
	});
	
	
	$("#modificar").on("click",function(){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','modificar');
		datos.append('cedula',$("#cedulaEmpleado").val());
		datos.append('telefono',$("#teleEmpleado").val());
		datos.append('nombre',$("#nombreEmpleado").val());
		datos.append('apellido',$("#apellidoEmpleado").val());
		datos.append('correo',$("#correoEmpleado").val());
		datos.append('contraseña',$("#contraEmpleado").val());
	 
			enviaAjax(datos);
			limpia();
		}
	});
	$("#eliminar").on("click",function(){
		
		if(validarkeyup(/^[0-9]{8,10}$/,$("#cedulaEmpleado"),
			$("#scedulaEmpleado"),"El formato debe ser 9999999")==0){
			muestraMensaje("La cedula debe coincidir con el formato <br/>"+ 
							"99999999");	
			
		}
		else{	
			
			var datos = new FormData();
			datos.append('accion','eliminar');
			datos.append('cedulaEmpleado',$("#cedulaEmpleado").val());
			enviaAjax(datos);
		}
		
	});
	$("#consultar").on("click",function(){
		var datos = new FormData();
		datos.append('accion','consultar');
		enviaAjax(datos);
	});
	
	});
	


	
$(document).ready(function(){



//CONTROL DE BOTONES

$("#incluir").on("click",function(){
	if(validarenvio()){
		var datos = new FormData();
		datos.append('accion','incluir');
		datos.append('cedula',$("#cedulaEmpleado").val());
		datos.append('telefono',$("#teleEmpleado").val());
		datos.append('nombre',$("#nombreEmpleado").val());
		datos.append('apellido',$("#apellidoEmpleado").val());
		datos.append('correo',$("#correoEmpleado").val());
		datos.append('contraseña',$("#contraEmpleado").val());

		enviaAjax(datos);
		limpia();
   }
});
$("#modificar").on("click",function(){
	if(validarenvio()){
		var datos = new FormData();
		datos.append('accion','modificar');
		datos.append('cedula',$("#cedulaEmpleado").val());
		datos.append('telefono',$("#teleEmpleado").val());
		datos.append('nombre',$("#nombreEmpleado").val());
		datos.append('apellido',$("#apellidoEmpleado").val());
		datos.append('correo',$("#correoEmpleado").val());
		datos.append('contraseña',$("#contraEmpleado").val());
 
		enviaAjax(datos);
		limpia();
	}
});

$("#eliminar").on("click",function(){
	
	if(validarkeyup(/^[0-9]{7,8}$/,$("#cedulaEmpleado"),
		$("#scedulaEmpleado"),"El formato debe ser 9999999")==0){
	    muestraMensaje("La cedula debe coincidir con el formato <br/>"+ 
						"99999999");	
		
	}
	else{	
	    
		var datos = new FormData();
		datos.append('accion','eliminar');
		datos.append('cedula',$("#cedulaEmpleado").val());
		enviaAjax(datos);
	}
	
});

$("#consultar").on("click",function(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);
});
//FIN DE CONTROL DE BOTONES	


	
	
});

//funcion para enlazar al DataTablet
function destruyeDT(){
	//1 se destruye el datatablet
	if ($.fn.DataTable.isDataTable("#tablaEmpleado")) {
            $("#tablaEmpleado").DataTable().destroy();
    }
}
function crearDT(){
	//se crea nuevamente
    if (!$.fn.DataTable.isDataTable("#tablaEmpleado")) {
            $("#tablaEmpleado").DataTable({
              language: {
                lengthMenu: "Mostrar _MENU_ por página",
                zeroRecords: "No se encontraron personas",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "No hay personas registradas",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                search: "Buscar:",
                paginate: {
                  first: "Primera",
                  last: "Última",
                  next: "Siguiente",
                  previous: "Anterior",
                },
              },
              autoWidth: false,
              order: [[1, "asc"]],
            });
    }         
}

function validarenvio(){
	if(validarkeyup(/^[0-9]{7,10}$/,$("#cedulaEmpleado"),
		$("#scedulaEmpleado"),"El formato debe ser 9999999")==0){
	    muestraMensaje("La cedula debe coincidir con el formato <br/>"+ 
						"99999999");	
		return false;					
	}	
	else if(validarkeyup(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]{3,30}$/,
		$("#apellidoEmpleado"),$("#sapellidoEmpleado"),"Solo letras  entre 3 y 30 caracteres")==0){
		muestraMensaje("Apellidos <br/>Solo letras  entre 3 y 30 caracteres");
		return false;
	}
	else if(validarkeyup(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]{3,30}$/,
		$("#nombreEmpleado"),$("#snombres"),"Solo letras  entre 3 y 30 caracteres")==0){
		muestraMensaje("Nombres <br/>Solo letras  entre 3 y 30 caracteres");
		return false;
	}
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{11}$/,
		$("#telefonoEmpleado"),$("#stelefonoEmpleado"),"Solo numeros y/o # - cantidades positivas o iguales a 0")==0){
		muestraMensaje("El teléfono del proveedor <br/>Solo numeros y # - debe contener 11 carácteres");
		return false;
	}
	
	
	return true;
}


//Funcion que muestra el modal con un mensaje
function muestraMensaje(mensaje){
	
	$("#contenidodemodal").html(mensaje);
			$("#mostrarmodal").modal("show");
			setTimeout(function() {
					$("#mostrarmodal").modal("hide");
			},3000);
}



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

//funcion para pasar de la lista a el formulario
//funcion para pasar de la lista a el formulario
function coloca(linea){
	$("#cedulaEmpleado").val($(linea).find("td:eq(0)").text());
	$("#telefonoEmpleado").val($(linea).find("td:eq(4)").text());
	$("#nombreEmpleado").val($(linea).find("td:eq(1)").text());
	$("#apellidoEmpleado").val($(linea).find("td:eq(2)").text());
	$("#correoEmpleado").val($(linea).find("td:eq(3)").text());
	$("#contraEmpleado	").val($(linea).find("td:eq(4)").text());
	
	
	
}
//funcion que envia y recibe datos por AJAX
function enviaAjax(datos) {
	$.ajax({
		async: true,
		url: "",  // Asegúrate de que la URL del servidor esté correcta
		type: "POST",
		contentType: false,
		data: datos,
		processData: false,
		cache: false,
		beforeSend: function() {},
		timeout: 10000, // tiempo máximo de espera por la respuesta del servidor
		success: function(respuesta) {
			try {
				 console.log("Respuesta recibida del servidor:", respuesta);
				var lee = JSON.parse(respuesta);
				console.log("JSON parseado:", lee);

				if (lee.resultado == "consultar") {
					destruyeDT();
					$("#resultadoconsulta").html(lee.mensaje);
					crearDT();
					$("#modal1").modal("show");
				} else if (lee.resultado == "encontro") {
					$("#apellidoEmpleado").val(lee.mensaje[0][1]);
					$("#nombreEmpleado").val(lee.mensaje[0][2]);
					$("#telefonoEmpleado").val(lee.mensaje[0][3]);
					$("#cedulaEmpleado").val(lee.mensaje[0][4]);
					$("#correoEmpleado").val(lee.mensaje[0][5]);
					$("#contraEmpleado").val(lee.mensaje[0][6]);
				} else if (lee.resultado == "incluir" || lee.resultado == "modificar" || lee.resultado == "eliminar") {
					muestraMensaje(lee.mensaje);
					limpia();
				} else if (lee.resultado == "error") {
					muestraMensaje(lee.mensaje);
				}
			} catch (e) {
				console.error("Error al parsear JSON:", e, "Respuesta recibida:", respuesta);
				muestraMensaje("Error al procesar la respuesta del servidor.");
			}
		},
		error: function(request, status, err) {
			if (status == "timeout") {
				muestraMensaje("Servidor ocupado, intente de nuevo");
			} else {
				muestraMensaje("ERROR: <br/>" + request + status + err);
			}
		},
		complete: function() {},
	});
}

function limpia(){
			
	$("#cedulaEmpleado").val("");
	$("#apellidoEmpleado").val("");
	$("#nombreEmpleado").val("");
	$("#telefonoEmpleado").val("");
	$("#correoEmpleado").val("");
	$("#contraEmpleado").val("");
}