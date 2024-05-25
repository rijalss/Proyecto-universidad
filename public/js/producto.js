$(document).ready(function(){

if($.trim($("#mensajes").text()) != ""){
	muestraMensaje($("#mensajes").html());
}
	
	$("#codProducto").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#codProducto").on("keyup",function(){
		validarkeyup(/^[0-9]{4,10}$/,$(this),
		$("#scodProducto"),"El formato no puede estar vacío y no puede conter más de 10 carácteres");
	});

	$("#nombreProducto").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#nombreProducto").on("keyup",function(){
        validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#snombreProducto"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

    $("#detalleProducto").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#detalleProducto").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
		$(this),$("#sdetalleProducto"),"Se debe llenar este campo y debe tener un máximo de 200 carácteres");
	});

    $("#promedioPrecio").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#promedioPrecio").on("keyup",function(){
		validarkeyup(/^[1-9]{0,10}$/,$(this),
		$("#spromedioPrecio"),"No debe haber cantidades negativas / menores a cero");
	});
    
	
$("#incluir").on("click",function(){
	if(validarenvio()){
		 var datos = new FormData();
		 datos.append('accion','incluir');
		 datos.append('codProducto',$("#codProducto").val());
		 datos.append('promedioPrecio',$("#promedioPrecio").val());
		 datos.append('nombreProducto',$("#nombreProducto").val());
		 datos.append('detalleProducto',$("#detalleProducto").val());

		 enviaAjax(datos);
		 limpia();
	}
});


$("#modificar").on("click",function(){
	if(validarenvio()){
		var datos = new FormData();
		datos.append('accion','modificar');
		datos.append('codProducto',$("#codProducto").val());
	    datos.append('promedioPrecio',$("#promedioPrecio").val());
		datos.append('nombreProducto',$("#nombreProducto").val());
	    datos.append('detalleProducto',$("#detalleProducto").val());
 
		enviaAjax(datos);
		limpia();
	}
});
$("#eliminar").on("click",function(){
	if(validarkeyup(/^[0-9]{7,8}$/,$("#codProducto"),
		$("#scodProducto"),"El formato no debe pasar de los 10 carácteres")==0){
	    muestraMensaje("La codigo del Producto debe coincidir con el formato <br/>"+ 
						"máximo 10 carácteres, ni tener cantidades negativas");	
		
	}
	else{	
		var datos = new FormData();
		datos.append('accion','eliminar');
		datos.append('codProducto',$("#codProducto").val());
	    datos.append('promedioPrecio',$("#promedioPrecio").val());
		datos.append('nombreProducto',$("#nombreProducto").val());
	    datos.append('detalleProducto',$("#detalleProducto").val());

		enviaAjax(datos);
		limpia();
	}
	
});

});

function validarenvio(){
	if(validarkeyup(/^[0-9]{7,8}$/,$("#codProducto"),
		$("#scodProducto"),"El formato no debe pasar de los 10 carácteres")==0){
	    muestraMensaje("El codigo del Producto debe coincidir con el formato <br/>"+ 
						"máximo 10 carácteres, ni tener cantidades negativas");	
		return false;					
	}	
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{0,10}$/,
		$("#promedioPrecio"),$("#spromedioPrecio"),"Solo numeros y/o # - sin cantidades negativas / menores a cero")==0){
		muestraMensaje("El promedio del Producto <br/>Solo numeros y # - sin cantidades negativas / menores a cero");
		return false;
	}
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#nombreProducto"),$("#snombreProducto"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del Producto <br/> No debe contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
		$("#detalleProducto"),$("#sdetalleProducto"),"No debe contener más de 200 carácteres")==0){
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