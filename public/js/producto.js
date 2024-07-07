function consultar(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);	
}
function destruyeDT(){
	//1 se destruye el datatablet
	if ($.fn.DataTable.isDataTable("#tablaproducto")) {
            $("#tablaproducto").DataTable().destroy();
    }
}
function crearDT(){
    if (!$.fn.DataTable.isDataTable("#tablaproducto")) {
         var table = $("#tablaproducto").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                lengthMenu: "Mostrar _MENU_",
                zeroRecords: "No se encontraron productos",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "No hay productos registrados",
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

	$("#codProducto").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#codProducto").on("keyup",function(){
		validarkeyup(/^[0-9]{4,10}$/,$(this),
		$("#scodProducto"),"Este formato permite de 4 a 10 carácteres");
	});

	$("#nombreProducto").on("keypress", function (e) {
	validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/, e);
	});

	$("#nombreProducto").on("keyup", function () {
	validarkeyup(
    /^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,30}$/,
    $(this),
    $("#snombreProducto"),
    "Este formato no debe estar vacío / permite un máximo 30 carácteres"
  );
	});

	$("#ultimoPrecio").on("keypress", function (e) {
		validarkeypress(/^[0-9.,\b]*$/, e);
	});
	
	$("#ultimoPrecio").on("keyup", function () {
		validarkeyup(
			/^[0-9]{0,10}([.,][0-9]{0,2})?$/,
			$(this),
			$("#sultimoPrecio"),
			"Este formato no permite cantidades negativas"
		);
	})

	$("#descProducto").on("keypress", function (e) {
	validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/, e);
	});

	$("#descProducto").on("keyup", function () {
	validarkeyup(
    /^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
    $(this),
    $("#sdescProducto"),
    "Este formato no debe estar vacío / permite un máximo 200 carácteres"
  );
	});

//////////////////////////////BOTONES/////////////////////////////////////


	
$("#proceso").on("click",function(){
	if($(this).text()=="REGISTRAR"){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','incluir');
			datos.append('codProducto',$("#codProducto").val());
			datos.append('nombreProducto',$("#nombreProducto").val());
			datos.append('ultimoPrecio',$("#ultimoPrecio").val());
			datos.append('descProducto',$("#descProducto").val());
			datos.append("categoria", $("#categoria").val());

			enviaAjax(datos);
		}
	}
	else if($(this).text()=="MODIFICAR"){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','modificar');
			datos.append("codProducto", $("#codProducto").val());
			datos.append("nombreProducto", $("#nombreProducto").val());
			datos.append("ultimoPrecio", $("#ultimoPrecio").val());
			datos.append("descProducto", $("#descProducto").val());
			datos.append("categoria", $("#categoria").val());

			enviaAjax(datos);
		}
	}
	if($(this).text()=="ELIMINAR"){
		if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,11}$/,$("#codProducto"),
		$("#scodProducto"),"El formato debe tener de 11 carácteres")==0){
		muestraMensaje("error",4000,"ERROR!","Seleccionó un código incorrecto <br/> por favor verifique nuevamente");
		}else {
			// Mostrar confirmación usando SweetAlert
			Swal.fire({
				title: '¿Está seguro de eliminar este producto?',
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
					datos.append('codProducto', $("#codProducto").val());
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
		$("#proceso").text("REGISTRAR");
		$("#modal1").modal("show");
	});
});

//////////////////////////////VALIDACIONES ANTES DEL ENVIO/////////////////////////////////////

function validarenvio(){
		var categoriaSeleccionada = $("#categoria").val();

        if (categoriaSeleccionada === null || categoriaSeleccionada === "0") {
			muestraMensaje("error",4000,"ERROR!","Por favor, seleccione una categoría! <br/> Recuerde que debe tener alguna registrada!"); 
            return false;
        }
		else if(validarkeyup(/^[0-9]{4,10}$/,$("#codProducto"),
			$("#scodProducto"),"El formato no debe pasar de los 10 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","El código del producto debe coincidir con el formato <br/>" + 
			"se permiten de 4 a 10 carácteres");
			return false;					
		}	
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
			$("#nombreProducto"),$("#snombreProducto"),"No debe contener más de 30 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","El nombre del producto debe coincidir con el formato <br/>" + 
			"No debe estar vacío, ni contener más de 30 carácteres");
			return false;
		}
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
			$("#descProducto"),$("#sdescProducto"),"No debe contener más de 200 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","La descripción del producto debe coincidir con el formato <br/>" + 
			"No debe estar vacío, ni contener más de 200 carácteres");
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
		$("#codProducto").val($(linea).find("td:eq(0)").text());
		// $("#codProducto").prop("readonly", true); //WOW CON READONLY 
    	$("#nombreProducto").val($(linea).find("td:eq(1)").text());
    	$("#ultimoPrecio").val($(linea).find("td:eq(2)").text());
		var nombreCategoria = $(linea).find("td:eq(3)").text();
		$('#categoria option').filter(function() {
            return $(this).text() == nombreCategoria;
        }).prop('selected', true).change();
    	$("#descProducto").val($(linea).find("td:eq(4)").text());   

		

    	$("#modal1").modal("show");
		
    }
    else{
    	$("#proceso").text("ELIMINAR");
		$("#codProducto").val($(linea).find("td:eq(0)").text());
		// $("#codProducto").prop("readonly", true); //WOW CON READONLY 


    	$("#nombreProducto").val($(linea).find("td:eq(1)").text());
		// $("#nombreProducto").prop("readonly", true); //WOW CON READONLY 


    	$("#ultimoPrecio").val($(linea).find("td:eq(2)").text());
		// $("#ultimoPrecio").prop("readonly", true); //WOW CON READONLY 


    	$("#descProducto").val($(linea).find("td:eq(3)").text());    
		// $("#descProducto").prop("readonly", true); //WOW CON READONLY 

		var nombreCategoria = $(linea).find("td:eq(4)").text();
		$('#categoria option').filter(function() {
            return $(this).text() == nombreCategoria;
        }).prop('selected', true).change();

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
    	    muestraMensaje('info', 4000,'REGISTRAR', lee.mensaje);
		   if(lee.mensaje=='Registro Incluido!<br/> Se registró el producto correctamente'){
			   $("#modal1").modal("hide");
			   consultar();
		   }
        }else if (lee.resultado == "modificar") {
    	    muestraMensaje('info', 4000,'MODIFICAR', lee.mensaje);
           if (
             lee.mensaje ==
             "Registro Modificado!<br/> Se modificó el producto correctamente"
           ) {
             $("#modal1").modal("hide");
             consultar();
           }
        }else if (lee.resultado == "eliminar") {
    	    muestraMensaje('info', 4000,'ELIMINAR', lee.mensaje);
		   if(lee.mensaje=='Registro Eliminado! <br/> Se eliminó el producto correctamente'){
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
	$("#codProducto").val('');
	$("#nombreProducto").val('');
	$("#descProducto").val('');
	$("#ultimoPrecio").val('');
	$("#categoria").val("disabled");
}
