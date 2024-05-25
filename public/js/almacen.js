$(document).ready(function(){

if($.trim($("#mensajes").text()) != ""){
	muestraMensaje($("#mensajes").html());
}
	
	
	$("#nombreAlmacen").on("keypress",function(e){
		validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#nombreAlmacen").on("keyup",function(){
        validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#snombreAlmacen"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

    $("#direccionAlmacen").on("keypress",function(e){
		validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#direccionAlmacen").on("keyup",function(){
		validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,50}$/,
		$(this),$("#sdireccionAlmacen"),"Se debe llenar este campo y debe tener un máximo de 50 carácteres");
	});
    $("#nombreArea").on("keypress",function(e){
		validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#nombreArea").on("keyup",function(){
        validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#snombreArea"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});
	
$("#incluir").on("click",function(){
	if(validarenvio()){
		 var datos = new FormData();
		 datos.append('accion','incluir');
		 datos.append('nombreAlmacen',$("#nombreAlmacen").val());
		 datos.append('direccionAlmacen',$("#direccionAlmacen").val());
		 datos.append('nombreArea',$("#nombreArea").val());

		 enviaAjax(datos);
		 limpia();
	}
});


$("#modificar").on("click",function(){
	if(validarenvio()){
		var datos = new FormData();
		datos.append('accion','modificar');
		datos.append('nombreAlmacen',$("#nombreAlmacen").val());
		datos.append('direccionAlmacen',$("#direccionAlmacen").val());
	    datos.append('nombreArea',$("#nombreArea").val());

		enviaAjax(datos);
		limpia();
	}
});
$("#eliminar").on("click",function(){
	if(validarkeyup(/^[0-9]{7,8}$/,$("#nombreArea"),
		$("#snombreArea"),"El formato debe tener mínimo 8 y máximo 10 carácteres")==0){
	    muestraMensaje("La cedula del Cliente debe coincidir con el formato <br/>"+ 
						"mínimo 8 y máximo 10 carácteres / 99999999999");	
		
	}
	else{	
		var datos = new FormData();
		datos.append('accion','eliminar');
		datos.append('nombreAlmacen',$("#nombreAlmacen").val());
        datos.append('direccionAlmacen',$("#direccionAlmacen").val());
	    datos.append('nombreArea',$("#nombreArea").val());

		enviaAjax(datos);
		limpia();
	}
	
});

});

function validarenvio(){
		
	if(validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#nombreAlmacen"),$("#snombreAlmacen"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del Cliente <br/>Solo letras y # - No debe contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,50}$/,
		$("#direccionAlmacen"),$("#sdireccionAlmacen"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del Cliente <br/>Solo letras y # - No debe contener más de 30 carácteres");
		return false;
	}
    if(validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#nombreArea"),$("#snombreArea"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del Cliente <br/>Solo letras y # - No debe contener más de 30 carácteres");
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