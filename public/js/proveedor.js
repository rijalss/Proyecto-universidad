$(document).ready(function(){

if($.trim($("#mensajes").text()) != ""){
	muestraMensaje($("#mensajes").html());
}
	
	$("#rifProveedor").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#rifProveedor").on("keyup",function(){
		validarkeyup(/^[0-9]{10}$/,$(this),
		$("#srifProveedor"),"El formato debe tener 10 carácteres");
	});

	$("#nombreProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#nombreProveedor").on("keyup",function(){
        validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#snombreProveedor"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

    $("#correoProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#correoProveedor").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$(this),$("#scorreoProveedor"),"Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

    $("#telefonoProveedor").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#telefonoProveedor").on("keyup",function(){
		validarkeyup(/^[1-9]{11}$/,$(this),
		$("#stelefonoProveedor"),"El formato debe tener 11 carácteres");
	});
    $("#direccionProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#direccionProveedor").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$(this),$("#sdireccionProveedor"),"Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});
	
$("#incluir").on("click",function(){
	if(validarenvio()){
		 var datos = new FormData();
		 datos.append('accion','incluir');
		 datos.append('rifProveedor',$("#rifProveedor").val());
		 datos.append('telefonoProveedor',$("#telefonoProveedor").val());
		 datos.append('nombreProveedor',$("#nombreProveedor").val());
		 datos.append('correoProveedor',$("#correoProveedor").val());
		 datos.append('direccionProveedor',$("#direccionProveedor").val());

		 enviaAjax(datos);
		 limpia();
	}
});


$("#modificar").on("click",function(){
	if(validarenvio()){
		var datos = new FormData();
		datos.append('accion','modificar');
		datos.append('rifProveedor',$("#rifProveedor").val());
	    datos.append('telefonoProveedor',$("#telefonoProveedor").val());
		datos.append('nombreProveedor',$("#nombreProveedor").val());
	    datos.append('correoProveedor',$("#correoProveedor").val());
		datos.append('direccionProveedor',$("#direccionProveedor").val());
 
		enviaAjax(datos);
		limpia();
	}
});
$("#eliminar").on("click",function(){
	if(validarkeyup(/^[0-9]{7,8}$/,$("#rifProveedor"),
		$("#srifProveedor"),"El formato debe ser 9999999")==0){
	    muestraMensaje("La rifProveedor debe coincidir con el formato <br/>"+ 
						"99999999");	
		
	}
	else{	
		var datos = new FormData();
		datos.append('accion','eliminar');
		datos.append('rifProveedor',$("#rifProveedor").val());
	    datos.append('telefonoProveedor',$("#telefonoProveedor").val());
		datos.append('nombreProveedor',$("#nombreProveedor").val());
	    datos.append('correoProveedor',$("#correoProveedor").val());
        datos.append('direccionProveedor',$("#direccionProveedor").val());

		enviaAjax(datos);
		limpia();
	}
	
});

});

function validarenvio(){
	if(validarkeyup(/^[0-9]{7,8}$/,$("#rifProveedor"),
		$("#srifProveedor"),"El formato debe tener 10 carácteres")==0){
	    muestraMensaje("El rif del proveedor debe coincidir con el formato <br/>"+ 
						"9999999999");	
		return false;					
	}	
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{11}$/,
		$("#telefonoProveedor"),$("#stelefonoProveedor"),"Solo numeros y/o # - cantidades positivas o iguales a 0")==0){
		muestraMensaje("El teléfono del proveedor <br/>Solo numeros y # - debe contener 11 carácteres");
		return false;
	}
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#nombreProveedor"),$("#snombreProveedor"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del proveedor <br/> No debe contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#correoProveedor"),$("#scorreoProveedor"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El correo del proveedor <br/> No debe contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#direccionProveedor"),$("#sdireccionProveedor"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("La direccion del proveedor <br/> No debe contener más de 30 carácteres");
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