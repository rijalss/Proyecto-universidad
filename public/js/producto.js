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

	
$("#nombreProducto").on("keypress",function(e){
	validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
});

$("#nombreProducto").on("keyup",function(){
	validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
	$(this), $("#snombreProducto"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
});

$("#precio").on("keypress",function(e){
	validarkeypress(/^[0-9-\b]*$/,e);
});

$("#precio").on("keyup",function(){
	validarkeyup(/^[0-9]{0,10}$/,$(this),
	$("#sprecio"),"No debe haber cantidades negativas / menores a cero");
});

$("#descProducto").on("keypress",function(e){
	validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
});

$("#descProducto").on("keyup",function(){
	validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
	$(this),$("#sdescProducto"),"Se debe llenar este campo y debe tener un máximo de 200 carácteres");
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
			datos.append('codProducto',$("#codProducto").val());
			datos.append('nombreProducto',$("#nombreProducto").val());
			datos.append('precio',$("#precio").val());
			datos.append('descProducto',$("#descProducto").val());
			enviaAjax(datos);
		}
	}
	else if($(this).text()=="MODIFICAR"){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','modificar');
			datos.append('codProducto',$("#codProducto").val());
			datos.append('precio',$("#precio").val());
			datos.append('nombreProducto',$("#nombreProducto").val());
			datos.append('descProducto',$("#descProducto").val());
			enviaAjax(datos);
		}
	}
	if($(this).text()=="ELIMINAR"){
		if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,11}$/,$("#codProducto"),
		$("#scodProducto"),"El formato debe tener de 11 carácteres")==0){
		muestraMensaje("error",4000,"ERROR!","Seleccionó un código incorrecto <br/> por favor verifique nuevamente");
		}else{
			var datos = new FormData();
			datos.append('accion','eliminar');
			datos.append('codProducto',$("#codProducto").val());
			enviaAjax(datos);
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
		if(validarkeyup(/^[0-9]{4,10}$/,$("#codProducto"),
			$("#scodProducto"),"El formato no debe pasar de los 10 carácteres")==0){
			muestraMensaje("El codigo del Producto debe coincidir con el formato <br/>"+ 
							"máximo 10 carácteres, ni tener cantidades negativas");	
			return false;					
		}
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{0,10}$/,
			$("#precio"),$("#sprecio"),"Solo numeros y/o # - sin cantidades negativas / menores a cero")==0){
			muestraMensaje("El último precio del Producto <br/>Solo numeros y # - sin cantidades negativas / menores a cero");
			return false;
		}
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
			$("#nombreProducto"),$("#snombreProducto"),"No debe contener más de 30 carácteres")==0){
			muestraMensaje("El nombre del Producto <br/> No debe contener más de 30 carácteres");
			return false;
		}
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
			$("#descProducto"),$("#sdescProducto"),"No debe contener más de 200 carácteres")==0){
			muestraMensaje("La descripción del Producto <br/> No debe contener más de 200 carácteres");
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
		$("#codProducto").prop("readonly", true); //WOW CON READONLY 
    	$("#nombreProducto").val($(linea).find("td:eq(1)").text());
    	$("#precio").val($(linea).find("td:eq(2)").text());
    	$("#descProducto").val($(linea).find("td:eq(3)").text());   

		var nombreCategoria = $(linea).find("td:eq(4)").text();
		$('#categoria option').filter(function() {
            return $(this).text() == nombreCategoria;
        }).prop('selected', true).change();

    	$("#modal1").modal("show");
		
    }
    else{
    	$("#proceso").text("ELIMINAR");
		$("#codProducto").val($(linea).find("td:eq(0)").text());
		$("#codProducto").prop("readonly", true); //WOW CON READONLY 


    	$("#nombreProducto").val($(linea).find("td:eq(1)").text());
		$("#nombreProducto").prop("readonly", true); //WOW CON READONLY 


    	$("#precio").val($(linea).find("td:eq(2)").text());
		$("#precio").prop("readonly", true); //WOW CON READONLY 


    	$("#descProducto").val($(linea).find("td:eq(3)").text());    
		$("#descProducto").prop("readonly", true); //WOW CON READONLY 

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
    	    muestraMensaje('info', 4000,'INCLUIR', lee.mensaje);
		   if(lee.mensaje=='Registro Incluido!<br/> Se incluyó el producto correctamente'){
			   $("#modal1").modal("hide");
			   consultar();
		   }
        }else if (lee.resultado == "modificar") {
    	    muestraMensaje('info', 4000,'MODIFICAR', lee.mensaje);
           if(lee.mensaje=='Registro Modificado!<br/> Se modificó el producto correctamente'){
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
           muestraMensaje(lee.mensaje);
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
	$("#precio").val('');
}
