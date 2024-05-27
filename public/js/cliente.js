$(document).ready(function(){

if($.trim($("#mensajes").text()) != ""){
	muestraMensaje($("#mensajes").html());
}
	
	$("#cedulaCliente").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#cedulaCliente").on("keyup",function(){
		validarkeyup(/^[0-9]{8,10}$/,$(this),
		$("#scedulaCliente"),"El formato debe tener mínimo 8 y máximo 10 carácteres");
	});

	$("#nombreCliente").on("keypress",function(e){
		validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#nombreCliente").on("keyup",function(){
        validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#snombreCliente"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

    $("#telefonoCliente").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#telefonoCliente").on("keyup",function(){
		validarkeyup(/^[1-9]{11}$/,$(this),
		$("#stelefonoCliente"),"El formato debe tener 11 carácteres");
	});
    $("#apellidoCliente").on("keypress",function(e){
		validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#apellidoCliente").on("keyup",function(){
		validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$(this),$("#sapellidoCliente"),"Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});
	
$("#incluir").on("click",function(){
	if(validarenvio()){
		 var datos = new FormData();
		 datos.append('accion','incluir');
		 datos.append('cedulaCliente',$("#cedulaCliente").val());
		 datos.append('telefonoCliente',$("#telefonoCliente").val());
		 datos.append('nombreCliente',$("#nombreCliente").val());
		 datos.append('apellidoCliente',$("#apellidoCliente").val());

		 enviaAjax(datos);
		 limpia();
	}
});


$("#modificar").on("click",function(){
	if(validarenvio()){
		var datos = new FormData();
		datos.append('accion','modificar');
		datos.append('cedulaCliente',$("#cedulaCliente").val());
	    datos.append('telefonoCliente',$("#telefonoCliente").val());
		datos.append('nombreCliente',$("#nombreCliente").val());
		datos.append('apellidoCliente',$("#apellidoCliente").val());
 
		enviaAjax(datos);
		limpia();
	}
});
$("#eliminar").on("click",function(){
	if(validarkeyup(/^[0-9]{7,8}$/,$("#cedulaCliente"),
		$("#scedulaCliente"),"El formato debe tener mínimo 8 y máximo 10 carácteres")==0){
	    muestraMensaje("La cedula del Cliente debe coincidir con el formato <br/>"+ 
						"mínimo 8 y máximo 10 carácteres / 99999999999");	
		
	}
	else{	
		var datos = new FormData();
		datos.append('accion','eliminar');
		datos.append('cedulaCliente',$("#cedulaCliente").val());
	    datos.append('telefonoCliente',$("#telefonoCliente").val());
		datos.append('nombreCliente',$("#nombreCliente").val());
        datos.append('apellidoCliente',$("#apellidoCliente").val());

		enviaAjax(datos);
		limpia();
	}
	
});
$("#consultar").on("click",function(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);
});

});


//funcion para enlazar al DataTablet
function destruyeDT(){
	//1 se destruye el datatablet
	if ($.fn.DataTable.isDataTable("#tablapersona")) {
            $("#tablapersona").DataTable().destroy();
    }
}
function crearDT(){
	//se crea nuevamente
    if (!$.fn.DataTable.isDataTable("#tablapersona")) {
            $("#tablapersona").DataTable({
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
	if(validarkeyup(/^[0-9]{8,10}$/,$("#cedulaCliente"),
		$("#cedulaCliente"),$("#scedulaCliente"),"Solo numeros y/o # - El formato debe tener mínimo 8 y máximo 10 carácteres")==0){
		muestraMensaje("La cédula del Cliente <br/>Solo numeros y # - El formato debe tener mínimo 8 y máximo 10 carácteres");
		return false;					
	}	
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{6,12}$/,
		$("#telefonoCliente"),$("#stelefonoCliente"),"Solo numeros y/o # - cantidades positivas o iguales a 0")==0){
		muestraMensaje("El teléfono del Cliente <br/>Solo numeros y # - debe contener 10 carácteres");
		return false;
	}
	else if(validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{6,12}$/,
		$("#nombreCliente"),$("#snombreCliente"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del Cliente <br/>Solo letras y # - No debe contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{6,12}$/,
		$("#apellidoCliente"),$("#sapellidoCliente"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del Cliente <br/>Solo letras y # - No debe contener más de 30 carácteres");
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
			},5000);
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

//funcion para pasar de la lista a el formulario
function coloca(linea){
	$("#cedulaCliente").val($(linea).find("td:eq(0)").text());
	$("#telefonoCliente").val($(linea).find("td:eq(1)").text());
	$("#nombreCliente").val($(linea).find("td:eq(2)").text());
	$("#apellidoCliente").val($(linea).find("td:eq(3)").text());
	
}

//funcion que envia y recibe datos por AJAX
function enviaAjax(datos){
	 
	$.ajax({
		    async: true,
			url: "",
			type: "POST",
			contentType: false,
			data: datos,
			processData: false,
			cache: false,
			beforeSend: function () {},
			timeout: 10000, //tiempo maximo de espera por la respuesta del servidor
            success: function(respuesta) {//si resulto exitosa la transmision
			console.log(respuesta);
				try {
					var lee = JSON.parse(respuesta);
					if (lee.resultado == "obtienefecha") {
					  $("#cedulaCliente").val(lee.mensaje);
					}
					else if (lee.resultado == "consultar") {
					   destruyeDT();
					   $("#resultadoconsulta").html(lee.mensaje);
					   crearDT();
					   $("#modal1").modal("show");
					}
					else if (lee.resultado == "encontro") {
					   $("#apellidos").val(lee.mensaje[0][2]);
					   $("#nombres").val(lee.mensaje[0][3]);
					   $("#fechadenacimiento").val(lee.mensaje[0][4]);	
					}
					else if (lee.resultado == "incluir" || 
					lee.resultado == "modificar" || 
					lee.resultado == "eliminar") {
					   muestraMensaje(lee.mensaje);
					   limpia();
					}
					else if (lee.resultado == "error") {
					   muestraMensaje(lee.mensaje);
					}
			  } catch (e) {
				alert("Error en JSON " + e.name);
			  }
			   
            },
            error: function (request, status, err) {
			  // si ocurrio un error en la trasmicion
			  // o recepcion via ajax entra aca
			  // y se muestran los mensaje del error
			  if (status == "timeout") {
				//pasa cuando superan los 10000 10 segundos de timeout
				muestraMensaje("Servidor ocupado, intente de nuevo");
			  } else {
				//cuando ocurre otro error con ajax
				muestraMensaje("ERROR: <br/>" + request + status + err);
			  }
			},
			complete: function () {},
			
    }); 
	
}

function limpia(){
	if($("#masculino").is(":checked")){
		$("#masculino").prop("checked",false);
	}
	else{
	    $("#femenino").prop("checked",false);
	}
	
	$("#cedula").val("");
	$("#apellidos").val("");
	$("#nombres").val("");
	var datos = new FormData();
		datos.append('accion','obtienefecha');
		enviaAjax(datos,'obtienefecha');	
	$("#gradodeinstruccion").prop("selectedIndex",0);
}
