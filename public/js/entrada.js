function consultar(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);	
}

function destruyeDT(){
	// se destruye el datatable
	if ($.fn.DataTable.isDataTable("#tablaentrada")) {
            $("#tablaentrada").DataTable().destroy();
    }
}

function crearDT(){
    //  se construye la datatable
    if (!$.fn.DataTable.isDataTable("#tablaentrada")) {
         var table = $("#tablaentrada").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                lengthMenu: "Mostrar _MENU_",
                zeroRecords: "No se encontraron notas de entrada",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "No hay notas de entrada registradas",
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
            "margin-bottom": "70px",
        });

        $("div.dataTables_filter label").css({
            "float": "left",
        });

        $("div.dataTables_filter input").css({
            "width": "300px",
            "float": "right",
            "margin-right": "10px",
        });
    }         
}

$(document).ready(function(){
    consultar();

    
	$("#numFactura").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#numFactura").on("keyup",function(){
		validarkeyup(/^[1-9]{8,10}$/,$(this),
		$("#snumFactura"),"El formato tiene un máximo de 10 carácteres");
	});
/*
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
	});*/

    $("#proceso").on("click",function(){
        if($(this).text()=="REGISTRAR"){
            if(validarenvio()){
                var datos = new FormData();
                datos.append('accion','incluir');
                datos.append('proveedor',$("#proveedor").val());
		        datos.append('numFactura',$("#numFactura").val());
		        datos.append('fechaEntrada',$("#fechaEntrada").val());
		        datos.append('empleado',$("#empleado").val());
                enviaAjax(datos);
            }
        }
        else if($(this).text()=="MODIFICAR"){
            if(validarenvio()){
                var datos = new FormData();
                datos.append('accion','modificar');
                datos.append('proveedor',$("#proveedor").val());
		        datos.append('numFactura',$("#numFactura").val());
		        datos.append('fechaEntrada',$("#fechaEntrada").val());
		        datos.append('empleado',$("#empleado").val());
    
                enviaAjax(datos);
            }
        }
        if ($(this).text() == "ELIMINAR") {
            if (validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, $("#numFactura"),
                $("#snumFactura"), "El formato debe ser 9999999") == 0) {
                muestraMensaje("error", 4000, "ERROR!", "Seleccionó una nota de entrada incorrecta <br/> por favor verifique nuevamente");
            } else {
                // Mostrar confirmación usando SweetAlert
                Swal.fire({
                    title: '¿Está seguro de eliminar esta nota de entreda?',
                    text: "Se eliminara de forma permanente!",
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
                        datos.append('numFactura', $("#numFactura").val());
                        enviaAjax(datos);
                    } else {
                        muestraMensaje("info", 2000, "Información", "La eliminación ha sido cancelada.");
                        $("#modal1").modal("hide");
                    }
                    $("#modal1").modal("hide");
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
 // se valida lo que se envia
function validarenvio(){
    var empleadoseleccionado = $("#empleado").val();
    var proveedorseleccionado = $("#proveedor").val();
   

     if (empleadoseleccionado === null || empleadoseleccionado === "0") {
        muestraMensaje("error",4000,"ERROR!","Por favor, seleccione un empleado! <br/> Recuerde que debe tener alguno registrado!"); 
        return false;
    }
    else if (proveedorseleccionado === null || proveedorseleccionado === "0") {
        muestraMensaje("error",4000,"ERROR!","Por favor, seleccione un proveedor! <br/> Recuerde que debe tener alguno registrado!"); 
        return false;
    }
	else if(validarkeyup(/^[0-9]{8,10}$/,$("#numFactura"),
		$("#snumFactura"),"El formato debe ser 9999999")==0){
	    muestraMensaje("error",4000,"ERROR!","La factura debe coincidir con el formato <br/>"+ 
						"99999999");
                       
		return false;					
	}
                  
    				

    /*
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,10}$/,
		$("#cantidadEntrega"),$("#scantidadEntrega"),"Solo numeros y/o # - cantidades positivas o iguales a cero")==0){
		muestraMensaje("error",4000,"ERROR!","cantidadEntrega <br/>Solo numeros y/o # - cantidades positivas o iguales a cero");
		return false;
	}
	else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,20}$/,
		$("#precioEntrega"),$("#sprecioEntrega"),"Solo numeros y/o # - cantidades positivaso iguales a cero")==0){
		muestraMensaje("error",4000,"ERROR!","El precio de entrega <br/>Solo numeros y/o # - cantidades positivaso iguales a cero");
		return false;
	}*/
	 
	return true;
}

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

function validarkeypress(er,e){

    key = e.keyCode;
    
    
    tecla = String.fromCharCode(key);
    
    
    a = er.test(tecla);
    
    if(!a){
    
        e.preventDefault();
    }
    
    
}

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
    

    
function pone(pos,accion){
    
    linea=$(pos).closest('tr');

    if(accion==0){
        $("#proceso").text("MODIFICAR");
    }
    else{
        $("#proceso").text("ELIMINAR");
    }
    var nombreProveedor = $(linea).find("td:eq(0)").text();
		$('#proveedor option').filter(function() {
            return $(this).text() == nombreProveedor;
        }).prop('selected', true).change();

        $("#numFactura").val($(linea).find("td:eq(1)").text());

        $("#fechaEntrada").val($(linea).find("td:eq(2)").text());
    

        var nombreEmpleado = $(linea).find("td:eq(3)").text();
		$('#empleado option').filter(function() {
            return $(this).text() == nombreEmpleado;
        }).prop('selected', true).change();

    

    $("#modal1").modal("show");
}


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
             if(lee.mensaje=='Registro Incluido!<br/> Se registró la nota de entrada correctamente'){
                 $("#modal1").modal("hide");
                 consultar();
             }
          }else if (lee.resultado == "modificar") {
              muestraMensaje('info', 4000,'MODIFICAR', lee.mensaje);
             if(lee.mensaje=='Registro Modificado!<br/> Se modificó la nota de entrada correctamente'){
                 $("#modal1").modal("hide");
                 consultar();
             }
          }else if (lee.resultado == "eliminar") {
              muestraMensaje('info', 4000,'ELIMINAR', lee.mensaje);
             if(lee.mensaje=='Registro Eliminado! <br/> Se eliminó la nota de entrada correctamente'){
                 $("#modal1").modal("hide");
                 consultar();
             }
          }else if (lee.resultado == "error") {
             muestraMensaje(lee.mensaje);
          }
       }catch (e) {
          console.error("Error en análisis JSON:", e); 
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
	$("#numFactura").val('');
	$("#fechaEntrada").val('');
	$("#empleado").val("disabled");
    $("#proveedor").val("disabled");
    }
