function consultar(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);	
}
function destruyeDT(){
	//1 se destruye el datatablet
	if ($.fn.DataTable.isDataTable("#tablaalmacen")) {
            $("#tablaalmacen").DataTable().destroy();
    }
}
function crearDT(){
    if (!$.fn.DataTable.isDataTable("#tablaalmacen")) {
         var table = $("#tablaalmacen").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                lengthMenu: "Mostrar _MENU_",
                zeroRecords: "No se encontraron almacenes",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "No hay almacenes registrados",
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

	$("#codAlmacen").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#codAlmacen").on("keyup",function(){
		validarkeyup(/^[0-9]{4,10}$/,$(this),
		$("#scodAlmacen"),"Este formato permite de 4 a 10 carácteres");
	});

	$("#nombreAlmacen").on("keypress", function (e) {
	validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/, e);
	});

	$("#nombreAlmacen").on("keyup", function () {
	validarkeyup(
    /^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,30}$/,
    $(this),
    $("#snombreAlmacen"),
    "Este formato no debe estar vacío / permite un máximo 30 carácteres"
  );
	});

	$("#direccionAlmacen").on("keypress", function (e) {
	validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/, e);
	});

	$("#direccionAlmacen").on("keyup", function () {
	validarkeyup(
    /^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,30}$/,
    $(this),
    $("#sdireccionAlmacen"),
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
			datos.append('codAlmacen',$("#codAlmacen").val());
			datos.append('nombreAlmacen',$("#nombreAlmacen").val());
			datos.append('direccionAlmacen',$("#direccionAlmacen").val());

			enviaAjax(datos);
		}
	}
	else if($(this).text()=="MODIFICAR"){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','modificar');
			datos.append("codAlmacen", $("#codAlmacen").val());
			datos.append("nombreAlmacen", $("#nombreAlmacen").val());
			datos.append("direccionAlmacen", $("#direccionAlmacen").val());

			enviaAjax(datos);
		}
	}
	if($(this).text()=="ELIMINAR"){
		if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,11}$/,$("#codAlmacen"),
		$("#scodAlmacen"),"El formato debe tener de 11 carácteres")==0){
		muestraMensaje("error",4000,"ERROR!","Seleccionó un código incorrecto <br/> por favor verifique nuevamente");
		}else {
			// Mostrar confirmación usando SweetAlert
			Swal.fire({
				title: '¿Está seguro de eliminar este Almacén?',
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
					datos.append('accion', 'eliminar');
					datos.append('codAlmacen', $("#codAlmacen").val());
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
		if(validarkeyup(/^[0-9]{4,10}$/,$("#codAlmacen"),
			$("#scodAlmacen"),"El formato no debe pasar de los 10 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","El código del Almacén debe coincidir con el formato <br/>" + 
			"se permiten de 4 a 10 carácteres");
			return false;					
		}	
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
			$("#nombreAlmacen"),$("#nombreAlmacen"),"No debe contener más de 30 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","El nombre del Almacén debe coincidir con el formato <br/>" + 
			"No debe estar vacío, ni contener más de 30 carácteres");
			return false;
		}
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
			$("#direccionAlmacen"),$("#direccionAlmacen"),"No debe contener más de 30 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","La descripción del Almacén debe coincidir con el formato <br/>" + 
			"No debe estar vacío, ni contener más de 30 carácteres");
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
		$("#codAlmacen").val($(linea).find("td:eq(0)").text());
    	$("#nombreAlmacen").val($(linea).find("td:eq(1)").text());
    	$("#direccionAlmacen").val($(linea).find("td:eq(2)").text());	
    	$("#modal1").modal("show");
    }
    else{
    	$("#proceso").text("ELIMINAR");
		$("#codAlmacen").val($(linea).find("td:eq(0)").text());
    	$("#nombreAlmacen").val($(linea).find("td:eq(1)").text());
    	$("#direccionAlmacen").val($(linea).find("td:eq(2)").text());    
   		$("#modal1").modal("show");
    }
    
    
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
		   if(lee.mensaje=='Registro Incluido!<br/> Se incluyó el Almacén correctamente'){
			   $("#modal1").modal("hide");
			   consultar();
		   }
        }else if (lee.resultado == "modificar") {
    	    muestraMensaje('info', 4000,'MODIFICAR', lee.mensaje);
           if (
             lee.mensaje ==
             "Registro Modificado!<br/> Se modificó el Almacén correctamente"
           ) {
             $("#modal1").modal("hide");
             consultar();
           }
        }else if (lee.resultado == "eliminar") {
    	    muestraMensaje('info', 4000,'ELIMINAR', lee.mensaje);
		   if(lee.mensaje=='Registro Eliminado! <br/> Se eliminó el Almacén correctamente'){
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
	$("#codAlmacen").val('');
	$("#nombreAlmacen").val('');
	$("#direccionAlmacen").val('');
	
}
