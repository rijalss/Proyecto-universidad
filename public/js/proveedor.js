function consultar(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);	
}
function destruyeDT(){
	//1 se destruye el datatablet
	if ($.fn.DataTable.isDataTable("#tablaproveedor")) {
            $("#tablaproveedor").DataTable().destroy();
    }
}
function crearDT(){
    if (!$.fn.DataTable.isDataTable("#tablaproveedor")) {
         var table = $("#tablaproveedor").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                lengthMenu: "Mostrar _MENU_",
                zeroRecords: "No se encontraron proveedores",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "No hay proveedores registrados",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                search: "Buscar",
                paginate: {
                    first: "Primera",
                    last: "Última",
                    next: "Siguiente",
                    previous: "Anterior",
                },
            },
            autoWidth: false,
            order: [[1, "asc"]],
            dom: "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4'f>><'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        });

        $("div.dataTables_length select").css({
            "width": "auto",
            "display": "inline",
			"margin-top": "10px",

        });

        $("div.dataTables_filter").css({
            "margin-bottom": "50px",
			"margin-top": "10px",
        });

        $("div.dataTables_filter label").css({
            "float": "left",
        });

        $("div.dataTables_filter input").css({
            "width": "300px",
            "float": "right",
            "margin-left": "10px",
        });
    }         
}
					
$(document).ready(function(){

	consultar();
	
//////////////////////////////VALIDACIONES/////////////////////////////////////

	$("#rifProveedor").on("keypress",function(e){
    validarkeypress(/^[A-Za-z0-9-\b]*$/,e);
	});

	$("#rifProveedor").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9]{8,9}$/,$(this),
		$("#srifProveedor"),"El formato permite de 8 a 9 carácteres");
	});

	$("#nombreProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#nombreProveedor").on("keyup",function(){
        validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,30}$/, 
        $(this), $("#snombreProveedor"),"Este formato no debe estar vacío / permite un máximo 30 carácteres");
	});

    $("#correoProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9@_.\b\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#correoProveedor").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9_\u00f1\u00d1\u00E0-\u00FC-]{3,30}[@]{1}[A-Za-z0-9]{3,8}[.]{1}[A-Za-z]{2,3}$/,
		$(this),$("#scorreoProveedor"),"El formato sólo permite un correo válido!");
	});

    $("#telefonoProveedor").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#telefonoProveedor").on("keyup",function(){
		validarkeyup(/^[0-9]{10,11}$/,$(this),
		$("#stelefonoProveedor"),"El formato sólo permite un número válido");
	});
    $("#direccionProveedor").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC.!@#$%^&*()-_=+[\]{};:'",<>/?\\|~`]*$/,e);
	});
	
	$("#direccionProveedor").on("keyup",function(){
		validarkeyup(
      /^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC.!@#$%^&*()-_=+[\]{};:'",<>/?\\|~`]{4,30}$/,
      $(this),
      $("#sdireccionProveedor"),
      "Este formato no debe estar vacío / permite un máximo 30 carácteres"
    );
	});

//////////////////////////////BOTONES/////////////////////////////////////
if($.trim($("#mensajes").text()) != ""){
	//icono,tiempo,titulo,mensaje
	muestraMensaje("success",4000,"Resultado",$("#mensajes").html());
	}
	
$("#proceso").on("click",function(){
	if($(this).text()=="INCLUIR"){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','incluir');
			datos.append('prefijoRif',$("#prefijoRif").val());
			datos.append('rifProveedor',$("#rifProveedor").val());
			datos.append('telefonoProveedor',$("#telefonoProveedor").val());
			datos.append('nombreProveedor',$("#nombreProveedor").val());
			datos.append('correoProveedor',$("#correoProveedor").val());
			datos.append('direccionProveedor',$("#direccionProveedor").val());

			enviaAjax(datos);
		}
	}
	else if($(this).text()=="MODIFICAR"){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','modificar');
			datos.append('prefijoRif',$("#prefijoRif").val()); 
			datos.append('rifProveedor',$("#rifProveedor").val());
			datos.append('telefonoProveedor',$("#telefonoProveedor").val());
			datos.append('nombreProveedor',$("#nombreProveedor").val());
			datos.append('correoProveedor',$("#correoProveedor").val());
			datos.append('direccionProveedor',$("#direccionProveedor").val());

			enviaAjax(datos);
		}
	}
	if($(this).text()=="ELIMINAR"){
		if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC-]{8,11}$/,$("#rifProveedor"),
		$("#srifProveedor"),"El formato debe tener de 11 carácteres")==0){
		muestraMensaje("error",4000,"ERROR!","Seleccionó un rif incorrecto <br/> por favor verifique nuevamente");
		}else{
			// Mostrar confirmación usando SweetAlert
			Swal.fire({
				title: '¿Está seguro de eliminar este proveedor?',
				text: "Esta acción no se puede deshacer.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sí, eliminar',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.isConfirmed) {
					// Si se confirma, proceder con la eliminación
					var datos = new FormData();
						datos.append('accion','eliminar');
						datos.append('rifProveedor',$("#rifProveedor").val());
						enviaAjax(datos);
				} else {
					muestraMensaje("error", 2000, "INFORMACIÓN", "La eliminación ha sido cancelada.");
					$("#modal1").modal("hide");
				}
			});
		}
	}
});

	$("#incluir").on("click",function(){
		limpia();
		$("#proceso").text("INCLUIR");
		$("#modal1").modal("show");
	});
});

//////////////////////////////VALIDACIONES ANTES DEL ENVIO/////////////////////////////////////

function validarenvio(){
	if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC-]{8,11}$/,$("#rifProveedor"),
		$("#srifProveedor"),"El formato debe tener 9 carácteres")==0){
		muestraMensaje("error",4000,"ERROR!","El rif del proveedor debe coincidir con el formato <br/>" + "J-123456789");
		return false;					
	}
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#nombreProveedor"),$("#snombreProveedor"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("error",4000,"ERROR!","El nombre del proveedor <br/> No debe estar vacío, ni contener más de 30 carácteres");
		return false;
	}	
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{10,11}$/,
		$("#telefonoProveedor"),$("#stelefonoProveedor"),"El formato debe ser un número de teléfono válido")==0){
		muestraMensaje("error",4000,"ERROR!","El teléfono del proveedor <br/> Debe ser un número de teléfono válido");
		return false;
	}
    else if(validarkeyup(/^[A-Za-z0-9_\u00f1\u00d1\u00E0-\u00FC-]{3,30}[@]{1}[A-Za-z0-9]{3,8}[.]{1}[A-Za-z]{2,3}$/,
		$("#correoProveedor"),$("#scorreoProveedor"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("error",4000,"ERROR!","El correo del proveedor <br/> No debe estar vacío, ni contener más de 30 carácteres");
		return false;
	}
    else if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC.!@#$%^&*()-_=+[\]{};:'",<>/?\\|~`]{1,30}$/,
		$("#direccionProveedor"),$("#sdireccionProveedor"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("error",4000,"ERROR!","La dirección del proveedor <br/> No debe estar vacío, ni contener más de 30 carácteres");
		return false;
	}
	return true;
}

//Función para mostrar mensajes

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
function pone(pos,accion){
    
    linea=$(pos).closest('tr');

    if(accion==0){
        $("#proceso").text("MODIFICAR");
    }
    else{
        $("#proceso").text("ELIMINAR");
    }
    
    var rifProveedor = $(linea).find("td:eq(0)").text();
    $("#rifProveedor").val(rifProveedor.substring(2)); 
    $("#prefijoRif").val(rifProveedor.substring(0, 1));
    $("#nombreProveedor").val($(linea).find("td:eq(1)").text());
    $("#telefonoProveedor").val($(linea).find("td:eq(2)").text());
    $("#correoProveedor").val($(linea).find("td:eq(3)").text());
    $("#direccionProveedor").val($(linea).find("td:eq(4)").text());
    
    $("#modal1").modal("show");
}


//funcion que envia y recibe datos por AJAX
function enviaAjax(datos) {
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
    success: function (respuesta) {
    // console.log(respuesta);
      try {
        var lee = JSON.parse(respuesta);
        if (lee.resultado == "consultar") {
		   destruyeDT();	
           $("#resultadoconsulta").html(lee.mensaje);
		   crearDT();
        }else if (lee.resultado == "incluir") {
    	    muestraMensaje('info', 4000,'INCLUIR', lee.mensaje);
		   if(lee.mensaje=='Registro Incluido!<br/> Se incluyó el proveedor correctamente'){
			   $("#modal1").modal("hide");
			   consultar();
		   }
        }else if (lee.resultado == "modificar") {
    	    muestraMensaje('info', 4000,'MODIFICAR', lee.mensaje);
           if(lee.mensaje=='Registro Modificado!<br/> Se modificó el proveedor correctamente'){
               $("#modal1").modal("hide");
               consultar();
		   }
        }else if (lee.resultado == "eliminar") {
    	    muestraMensaje('info', 4000,'ELIMINAR', lee.mensaje);
		   if(lee.mensaje=='Registro Eliminado! <br/> Se eliminó el proveedor correctamente'){
			   $("#modal1").modal("hide");
			   consultar();
		   }
        }else if (lee.resultado == "error") {
		   muestraMensaje("error", 10000, "ERROR!!!!", lee.mensaje);
        }
     }catch (e) {
        console.error("Error en análisis JSON:", e); // Registrar el error para depuración
    	alert("Error en JSON " + e.name + ": " + e.message);
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
