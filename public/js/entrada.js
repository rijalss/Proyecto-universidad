$(document).ready(function(){

if($.trim($("#mensajes").text()) != ""){
	muestraMensaje($("#mensajes").html());
}
	
	$("#numfacturaProveedor").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#numfacturaProveedor").on("keyup",function(){
		validarkeyup(/^[1-9]{8,10}$/,$(this),
		$("#snumfacturaProveedor"),"El formato tiene un máximo de 10 carácteres");
	});
	
	$("#cantidadEntrega").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#cantidadEntrega").on("keyup",function(){
		validarkeyup(/^[1-9]{1,10}$/,$(this),
		$("#scantidadEntrega"),"El formato no debe contener numeros negativos y ser debe ser mayor a cero");
	});
	
	$("#precioEntrega").on("keypress",function(e){
		validarkeypress(/^[0-9-,\b]*$/,e);
	});
	
	$("#precioEntrega").on("keyup",function(){
		validarkeyup(/^[1-9][0-9,]*(\.[0-9]{1,10})?$/,$(this), // cammbie la expresion regular para que permitiera solo dos caracteres despues de la coma
		$("#sprecioEntrega"),"El formato no debe contener numeros negativos y ser debe ser mayor a cero");
	});

	$("#observacion").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#observacion").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
		$(this),$("#sobservacion"),"Se debe colocar alguna observación y tener un máximo de 200 carácteres");
	});
	
	

$("#incluir").on("click",function(){
	if(validarenvio()){
		 var datos = new FormData();
		 datos.append('accion','incluir');
		 datos.append('numfacturaProveedor',$("#numfacturaProveedor").val());
		 datos.append('cantidadEntrega',$("#cantidadEntrega").val());
		 datos.append('observacion',$("#observacion").val());
		 datos.append('precioEntrega',$("#precioEntrega").val());
		 
		 enviaAjax(datos);
		 limpia();
	}
});


$("#modificar").on("click",function(){
	if(validarenvio()){
		var datos = new FormData();
		datos.append('accion','modificar');
		datos.append('numfacturaProveedor',$("#numfacturaProveedor").val());
	    datos.append('cantidadEntrega',$("#cantidadEntrega").val());
		datos.append('observacion',$("#observacion").val());
	    datos.append('precioEntrega',$("#precioEntrega").val());
		 
		enviaAjax(datos);
		limpia();
	}
});
$("#eliminar").on("click",function(){
	if(validarkeyup(/^[0-9]{7,8}$/,$("#numfacturaProveedor"),
		$("#snumfacturaProveedor"),"El formato debe ser 9999999")==0){
	    muestraMensaje("La numfacturaProveedor debe coincidir con el formato <br/>"+ 
						"99999999");	
		
	}
	else{	
		var datos = new FormData();
		datos.append('accion','eliminar');
		datos.append('numfacturaProveedor',$("#numfacturaProveedor").val());
	    datos.append('cantidadEntrega',$("#cantidadEntrega").val());
		datos.append('observacion',$("#observacion").val());
	    datos.append('precioEntrega',$("#precioEntrega").val());
		enviaAjax(datos);
		limpia();
	}
	
});

});

function validarenvio(){
	if(validarkeyup(/^[0-9]{8,10}$/,$("#numfacturaProveedor"),
		$("#snumfacturaProveedor"),"El formato debe ser 9999999")==0){
	    muestraMensaje("La numfacturaProveedor debe coincidir con el formato <br/>"+ 
						"99999999");	
		return false;					
	}	
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,10}$/,
		$("#cantidadEntrega"),$("#scantidadEntrega"),"Solo numeros y/o # - cantidades positivas o iguales a cero")==0){
		muestraMensaje("cantidadEntrega <br/>Solo numeros y/o # - cantidades positivas o iguales a cero");
		return false;
	}
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,20}$/,
		$("#precioEntrega"),$("#sprecioEntrega"),"Solo numeros y/o # - cantidades positivaso iguales a cero")==0){
		muestraMensaje("El precio de entrega <br/>Solo numeros y/o # - cantidades positivaso iguales a cero");
		return false;
	}
	 else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
		$("#observacion"),$("#sobservacion"),"No debe contener más de 200 carácteres")==0){
		muestraMensaje("El correo del Producto <br/> No debe contener más de 200 carácteres");
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