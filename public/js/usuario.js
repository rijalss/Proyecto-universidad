$(document).ready(function(){

if($.trim($("#mensajes").text()) != ""){
	muestraMensaje($("#mensajes").html());
}
    $("#cedulaEmpleado").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#cedulaEmpleado").on("keyup",function(){
		validarkeyup(/^[1-9]{8,10}$/,$(this),
		$("#scedulaEmpleado"),"El formato debe tener mínimo 8 y máximo 10 carácteres");
	});
	
	$("#nombreEmpleado").on("keypress",function(e){
		validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#nombreEmpleado").on("keyup",function(){
        validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#snombreEmpleado"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

	$("#apellidoEmpleado").on("keypress",function(e){
		validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#apellidoEmpleado").on("keyup",function(){
        validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#sapellidoEmpleado"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

    $("#correoEmpleado").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#correoEmpleado").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$(this),$("#scorreoEmpleado"),"Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

   $("#telefonoEmpleado").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#telefonoEmpleado").on("keyup",function(){
		validarkeyup(/^[1-9]{11}$/,$(this),
		$("#stelefonoEmpleado"),"El formato debe tener 11 carácteres");
	});
	
$("#incluir").on("click",function(){
	if(validarenvio()){
		 var datos = new FormData();
		 datos.append('accion','incluir');
		 datos.append('cedulaEmpleado',$("#cedulaEmpleado").val());
		 datos.append('nombreEmpleado',$("#nombreEmpleado").val());
		 datos.append('apellidoEmpleado',$("#apellidoEmpleado").val());
		 datos.append('correoEmpleado',$("#correoEmpleado").val());
		 datos.append('telefoEmpleado',$("#telefoEmpleado").val());

		 enviaAjax(datos);
		 limpia();
	}
});


$("#modificar").on("click",function(){
	if(validarenvio()){
		var datos = new FormData();
		datos.append('accion','modificar');
		datos.append('cedulaEmpleado',$("#cedulaEmpleado").val());
	    datos.append('nombreEmpleado',$("#nombreEmpleado").val());
		datos.append('apellidoEmpleado',$("#apellidoEmpleado").val());
	    datos.append('correoEmpleado',$("#correoEmpleado").val());
		datos.append('telefoEmpleado',$("#telefoEmpleado").val());
 
		enviaAjax(datos);
		limpia();
	}
});
$("#eliminar").on("click",function(){
	if(validarkeyup(/^[0-9]{7,8}$/,$("#cedulaEmpleado"),
		$("#scedulaEmpleado"),"El formato debe tener mínimo 8 y máximo 10 carácteres")==0){
	    muestraMensaje("La cedula del Empleado debe coincidir con el formato <br/>"+ 
						"mínimo 8 y máximo 10 carácteres / 99999999999");	
		
	}
	else{	
		var datos = new FormData();
		datos.append('accion','eliminar');
		datos.append('cedulaEmpleado',$("#cedulaEmpleado").val());
	    datos.append('nombreEmpleado',$("#nombreEmpleado").val());
		datos.append('apellidoEmpleado',$("#apellidoEmpleado").val());
	    datos.append('correoEmpleado',$("#correoEmpleado").val());
        datos.append('telefoEmpleado',$("#telefoEmpleado").val());

		enviaAjax(datos);
		limpia();
	}
	
});

});

function validarenvio(){
	if(validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#nombreEmpleado"),$("#snombreEmpleado"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del empleado <br/>Solo letras y # - No debe contener más de 30 carácteres");
		return false;
	}

	if(validarkeyup(/^[0-9]{8,10}$/,$("#cedulaEmpleado"),
		$("#cedulaEmpleado"),$("#scedulaEmpleado"),"Solo numeros y/o # - El formato debe tener mínimo 8 y máximo 10 carácteres")==0){
		muestraMensaje("La cédula del empleado <br/>Solo numeros y # - El formato debe tener mínimo 8 y máximo 10 carácteres");
		return false;
    }

	else if(validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#apellidoEmpleado"),$("#sapellidoEmpleado"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del empleado <br/>Solo letras y # - No debe contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#correoEmpleado"),$("#scorreoEmpleado"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El correo del empleado <br/> No debe contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{11}$/,
		$("#telefonoEmpleado"),$("#stelefonoEmpleado"),"Solo numeros y/o # - cantidades positivas o iguales a 0")==0){
		muestraMensaje("El teléfono del Empleado <br/>Solo numeros y # - debe contener 11 carácteres");
		return false;
	}
	return true;
}

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

function enviaAjax(datos){
	
	$.ajax({
		    async: true,
            url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
            type: 'POST',//tipo de envio 
			contentType: false,
            data: datos,
			processData: false,
	        cache: false,
            success: function(respuesta) {//si resulto exitosa la transmision
			   console.log(respuesta);
			   muestraMensaje(respuesta);

            },
            error: function(){
			   muestraMensaje("Error con ajax");	
            }
			
    }); 
	
}
function limpia(){ 
	/*
	$("#cedula").val('');
	$("#usuario").val('');
	$("#clave").val('');
	$("#cargo").val('GERENTE');
	*/
}