$(document).ready(function(){

if($.trim($("#mensajes").text()) != ""){
	muestraMensaje($("#mensajes").html());
}
	
//////////////////////////////VALIDACIONES/////////////////////////////////////

	$("#rifProveedor").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#rifProveedor").on("keyup",function(){
		validarkeyup(/^[0-9]{10}$/,$(this),
		$("#srifProveedor"),"El formato debe tener 10 carácteres");
		if($("#rifProveedor").val().length == 10){
		  var datos = new FormData();
		    datos.append('accion','consultatr');
			datos.append('rifProveedor',$(this).val());
			enviaAjax(datos,'consultatr');	
		}
	});

	$("#nombreProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#nombreProveedor").on("keyup",function(){
        validarkeyup(/^[A-Za-z,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#snombreProveedor"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

    $("#correoProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]*$/,e);
	});
	
	$("#correoProveedor").on("keyup",function(){
		validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]{1,30}$/,
		$(this),$("#scorreoProveedor"),"Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

    $("#telefonoProveedor").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#telefonoProveedor").on("keyup",function(){
		validarkeyup(/^[0-9]{11}$/,$(this),
		$("#stelefonoProveedor"),"El formato debe tener 11 carácteres");
	});
    $("#direccionProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#direccionProveedor").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$(this),$("#sdireccionProveedor"),"Se debe llenar este campo y debe tener un máximo de 30 carácteres");
	});

//////////////////////////////BOTONES/////////////////////////////////////
	
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
	if(validarkeyup(/^[0-9]{10}$/,$("#rifProveedor"),
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

$("#consultar").on("click",function(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);
});

});

//funcion para enlazar al DataTablet
function destruyeDT(){
	//1 se destruye el datatablet
	if ($.fn.DataTable.isDataTable("#tablaproveedor")) {
            $("#tablaproveedor").DataTable().destroy();
    }
}
function crearDT(){
	//se crea nuevamente
    if (!$.fn.DataTable.isDataTable("#tablaproveedor")) {
            $("#tablaproveedor").DataTable({
              language: {
                lengthMenu: "Mostrar _MENU_ por página",
                zeroRecords: "No se encontraron proveedores",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "No hay proveedores registrados",
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

//////////////////////////////VALIDACIONES ANTES DEL ENVIO/////////////////////////////////////

function validarenvio(){
	if(validarkeyup(/^[0-9]{10}$/,$("#rifProveedor"),
		$("#srifProveedor"),"El formato debe tener 10 carácteres")==0){
	    muestraMensaje("El rif del proveedor debe coincidir con el formato <br/>" + 
		"9999999999");	
		return false;					
	}	
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{11}$/,
		$("#telefonoProveedor"),$("#stelefonoProveedor"),"Solo numeros y/o # - debe contender 11 carácteres")==0){
		muestraMensaje("El teléfono del proveedor <br/>Solo numeros y # - debe contener 11 carácteres");
		return false;
	}
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#nombreProveedor"),$("#snombreProveedor"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del proveedor <br/> No debe contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]{1,30}$/,
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

function coloca(linea){
	$("#rifProveedor").val($(linea).find("td:eq(0)").text());
	$("#nombreProveedor").val($(linea).find("td:eq(1)").text());
	$("#telefonoProveedor").val($(linea).find("td:eq(2)").text());
	$("#correoProveedor").val($(linea).find("td:eq(3)").text());
	$("#direccionProveedor").val($(linea).find("td:eq(4)").text());
}

//////////////////////////////FUNCIONES AJAX/////////////////////////////////////

function enviaAjax(datos) {
    $.ajax({
        async: true,
        url: "", // Aquí deberías poner la URL de tu servidor
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        beforeSend: function () {},
        timeout: 10000, // tiempo máximo de espera por la respuesta del servidor
        success: function (respuesta) {
            console.log("Respuesta del servidor:", respuesta);
			try {
    		var lee = JSON.parse(respuesta);
                console.log("JSON parseado:", lee);

                if (lee.resultado == "consultar") {
                    destruyeDT();
                    $("#resultadoconsulta").html(lee.mensaje);
                    crearDT();
                    $("#modal1").modal("show");
                } else if (lee.resultado == "encontro") {
                    $("#rifProveedor").val(lee.mensaje[0][1]);
                    $("#nombreProveedor").val(lee.mensaje[0][2]);
                    $("#telefonoProveedor").val(lee.mensaje[0][3]);
                    $("#correoProveedor").val(lee.mensaje[0][4]);
                    $("#direccionProveedor").val(lee.mensaje[0][5]);
                } else if (lee.resultado == "incluir" ||
                    lee.resultado == "modificar" ||
                    lee.resultado == "eliminar") {
                    muestraMensaje(lee.mensaje);
                    limpia();
                } else if (lee.resultado == "error") {
                    muestraMensaje(lee.mensaje);
                }
            } catch (e) {
                console.error("Error en JSON:", e);
				console.error("Respuesta del servidor:", respuesta);
                alert("Error en JSON: " + e.message);
            }
        },
        error: function (request, status, err) {
          
            if (status == "timeout") {

				muestraMensaje("Servidor ocupado, intente de nuevo");
            } else {

				muestraMensaje("ERROR: <br/>" + request + status + err);
            }
        },
        complete: function () {},
    });
}

function limpia(){ 
	
	$("#rifProveedor").val('');
	$("#nombreProveedor").val('');
	$("#correoProveedor").val('');
	$("#direccionProveedor").val('');
	$("#telefonoProveedor").val('');
	
}

