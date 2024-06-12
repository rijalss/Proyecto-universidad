$(document).ready(function(){

    if($.trim($("#mensajes").text()) != ""){
        muestraMensaje($("#mensajes").html());
    }
        
    //////////////////////////////VALIDACIONES/////////////////////////////////////

    $("#cedulaEmpleado").on("keypress",function(e){
        validarkeypress(/^[0-9-\b]*$/,e);
    });
    
    $("#cedulaEmpleado").on("keyup",function(){
        validarkeyup(/^[0-9]{8,10}$/,$(this),
        $("#scedula"),"El formato debe ser un número de cédula válido");
        if($("#cedulaEmpleado").val().length <= 10){
            var datos = new FormData();
            datos.append('accion','consultatr');
            datos.append('cedulaEmpleado',$(this).val());
            enviaAjax(datos,'consultatr');    
        }
    });

    $("#nombreEmpleado").on("keypress",function(e){
        validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
    });
    
    $("#nombreEmpleado").on("keyup",function(){
        validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#snombre"), "Se debe llenar este campo y debe contener un máximo de 30 caracteres");
    });

    $("#telefonoEmpleado").on("keypress",function(e){
        validarkeypress(/^[0-9-\b]*$/,e);
    });
    
    $("#telefonoEmpleado").on("keyup",function(){
        validarkeyup(/^[0-9]{11}$/,$(this),
        $("#stelefonoEmpleado"),"El formato debe ser un número de teléfono válido");
    });

    $("#apellidoEmpleado").on("keypress",function(e){
        validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
    });
    
    $("#apellidoEmpleado").on("keyup",function(){
        validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
        $(this),$("#sapellido"),"Se debe llenar este campo y debe contener un máximo de 200 caracteres");
    });

     $("#correoEmpleado").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC@.]*$/,e);
	});
	
	$("#correoEmpleado").on("keyup",function(){
		validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC@.]{1,30}$/,
		$(this),$("#scorreoEmpleado"),"Se debe llenar este campo y debe contener un máximo de 30 carácteres");
	});

     $("#contrasena").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]*$/,e);
	});
	
	$("#contrasena").on("keyup",function(){
		validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]{5,30}$/,
		$(this),$("#scontrasena"),"Este formato no puede estar vacío y debe contener un mínimo de 5 carácteres");
	});

    //////////////////////////////BOTONES/////////////////////////////////////
        
    $("#incluir").on("click",function(){
        if(validarenvio()){
            var datos = new FormData();
            datos.append('accion','incluir');
            datos.append('cedulaEmpleado',$("#cedulaEmpleado").val());
            datos.append('nombreEmpleado',$("#nombreEmpleado").val());
            datos.append('apellidoEmpleado',$("#apellidoEmpleado").val());
            datos.append('correoEmpleado',$("#correoEmpleado").val());
            datos.append('telefonoEmpleado',$("#telefonoEmpleado").val());
            datos.append('contrasena',$("#contrasena").val());
            datos.append('clCargo',$("#clCargo").val());

            enviaAjax(datos);
            limpia();
        }
    });

    $("#incluirCargo").on("click",function(){
        if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, $("#descCargo"),
            $("#sdescCargo"), "El formato no puede estar vacío")==1){
            var datos = new FormData();
            datos.append('accionCargo','incluirCargo');
            datos.append('descCargo',$("#descCargo").val());
            enviaAjax(datos);
            limpiaCargo();
        } else {
            muestraMensaje("El cargo no puede estar vacío");
        }
    });
    
    
    $("#modificar").on("click",function(){
        if(validarenvio()){
            var datos = new FormData();
            datos.append('accion','modificar');
            datos.append('cedulaEmpleado',$("#cedulaEmpleado").val());
            datos.append('nombreEmpleado',$("#nombreEmpleado").val());
            datos.append('apellidoEmpleado',$("#apellidoEmpleado").val());
            datos.append('correoEmpleado',$("#correoEmpleado").val());
            datos.append('telefonoEmpleado',$("#telefonoEmpleado").val());
            datos.append('contrasena',$("#contrasena").val());
            datos.append('clCargo',$("#clCargo").val());
     
            enviaAjax(datos);
            limpia();
        }
    });

    $("#eliminar").on("click",function(){
        if(validarkeyup(/^[0-9]{8,10}$/,$("#cedula"),
            $("#scedula"),"El formato debe ser un número de cédula válido")==0){
	    muestraMensaje("La cedula del Empleado debe coincidir con el formato <br/>"+ 
						"mínimo 8 y máximo 10 carácteres / 99999999999");	
            
        }
        else{    
            var datos = new FormData();
            datos.append('accion','eliminar');
            datos.append('cedulaEmpleado',$("#cedulaEmpleado").val());
            datos.append('nombreEmpleado',$("#nombreEmpleado").val());
            datos.append('apellidoEmpleado',$("#apellidoEmpleado").val());
            datos.append('correoEmpleado',$("#correoEmpleado").val());
            datos.append('telefonoEmpleado',$("#telefonoEmpleado").val());
            datos.append('contrasena',$("#contrasena").val());
            datos.append('clCargo',$("#clCargo").val());
    
            enviaAjax(datos);
            limpia();
        }
        
    });

    $("#eliminarCargo").on("click",function(){
        if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, $("#descCargo"),
        $("#sdescCargo"),"El formato no puede estar vacío")==0){
            muestraMensaje("El cargo no puede estar vacío");    
        }
        else{    
            var datos = new FormData();
            datos.append('accionCargo','eliminarCargo');
            datos.append('descCargo',$("#descCargo").val());
            enviaAjax(datos);
            limpiaCargo();
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
        if ($.fn.DataTable.isDataTable("#tablaEmpleado")) {
                $("#tablaEmpleado").DataTable().destroy();
        }
    }
    function crearDT(){
        //se crea nuevamente
        if (!$.fn.DataTable.isDataTable("#tablaEmpleado")) {
                $("#tablaEmpleado").DataTable({
                  language: {
                    lengthMenu: "Mostrar _MENU_ por página",
                    zeroRecords: "No se encontraron empleados",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay empleados registrados",
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
    //Funcion que muestra el modal con un mensaje
    function muestraMensaje(mensaje){
        $("#contenidodemodal").html(mensaje);
        $("#mostrarmodal").modal("show");
        setTimeout(function() {
            $("#mostrarmodal").modal("hide");
        },5000);
        // Cierra el modal de agregar categoría
        $("#agregarCargo").modal("hide");
    }

    function validarenvio(){

        var cargoSeleccionado = $("#clCargo").val();
        if (cargoSeleccionado === null || cargoSeleccionado === "0" || cargoSeleccionado === "disabled") {
            muestraMensaje("Por favor, seleccione un cargo");
            return false;
        }
        if(validarkeyup(/^[0-9]{8,10}$/,$("#cedulaEmpleado"),
            $("#scedula"),"El formato debe ser un número de cédula válido")==0){
            muestraMensaje("La cédula del Empleado debe coincidir con el formato <br/>"+ 
                            "entre 8 y 10 caracteres, sin cantidades negativas");    
            return false;                    
        }    
        else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{11}$/,
            $("#telefonoEmpleado"),$("#stelefonoEmpleado"),"El formato debe ser un número de teléfono válido")==0){
            muestraMensaje("El número de teléfono del Empleado <br/>Solo números y # - sin cantidades negativas / menores a cero");
            return false;
        }
        else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
            $("#nombreEmpleado"),$("#snombre"),"No debe contener más de 30 caracteres")==0){
            muestraMensaje("El nombre del Empleado <br/> No debe contener más de 30 caracteres");
            return false;
        }
        else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
            $("#apellidoEmpleado"),$("#sapellido"),"No debe contener más de 200 caracteres")==0){
            muestraMensaje("El apellido del Empleado <br/> No debe contener más de 200 caracteres");
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

    function coloca(linea){
        $("#cedulaEmpleado").val($(linea).find("td:eq(0)").text());
        $("#nombreEmpleado").val($(linea).find("td:eq(1)").text());
        $("#apellidoEmpleado").val($(linea).find("td:eq(2)").text());
        $("#correoEmpleado").val($(linea).find("td:eq(3)").text());
        $("#telefonoEmpleado").val($(linea).find("td:eq(4)").text());
        $("#contrasena").val($(linea).find("td:eq(5)").text());
        var descCargo = $(linea).find("td:eq(6)").text();
        //var clCargo = $(linea).find("td:eq(6)").data('clcargo');

        $('#clCargo option').filter(function() {
            return $(this).text() == descCargo;
        }).prop('selected', true).change();
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
                    console.log("Resultado:", lee.resultado); // Añade esta línea
    
                    if (lee.resultado == "consultar") {
                        destruyeDT();
                        $("#resultadoconsulta").html(lee.mensaje);
                        crearDT();
                        $("#modal1").modal("show");    
                    } else if(lee.resultado == "incluirCargo" ||
                        lee.resultado == "eliminarCargo"){
                            console.log("Entrando en el bloque de incluir/eliminar cargo"); // Añade esta línea
                        muestraMensaje(lee.mensaje);
                        limpiaCargo();
                    } else if (lee.resultado == "encontro") {
                        $("#cedulaEmpleado").val(lee.mensaje[0][1]);
                        $("#nombreEmpleado").val(lee.mensaje[0][2]);
                        $("#apellidoEmpleado").val(lee.mensaje[0][3]);
                        $("#correoEmpleado").val(lee.mensaje[0][4]);
                        $("#telefonoEmpleado").val(lee.mensaje[0][5]);
                        $("#contrasena").val(lee.mensaje[0][6]);
                        $("#clCargo").val(lee.mensaje[0][7]);
                    } else if (lee.resultado == "incluir" ||
                        lee.resultado == "modificar" ||
                        lee.resultado == "eliminar") {
                        muestraMensaje(lee.mensaje);
                        limpia();
                    }  else if (lee.resultado == "error") {
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
        $("#cedulaEmpleado").val('');
        $("#nombreEmpleado").val('');
        $("#apellidoEmpleado").val('');
        $("#correoEmpleado").val('');
        $("#telefonoEmpleado").val('');
        $("#contrasena").val('');
        $("#clCargo").val('disabled');
    }    

    function limpiaCargo(){
        $("#descCargo").val('');
    }
