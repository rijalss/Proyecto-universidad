function consultar(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);	
}

function destruyeDT(){
	//1 se destruye el datatablet
	if ($.fn.DataTable.isDataTable("#tablausuario")) {
            $("#tablausuario").DataTable().destroy();
    }
}

function crearDT(){
    // 2 se construye la datatable
    if (!$.fn.DataTable.isDataTable("#tablausuario")) {
         var table = $("#tablausuario").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                lengthMenu: "Mostrar _MENU_",
                zeroRecords: "No se encontraron usuarios",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "No hay usuarios registradass",
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

    // VALIDACIONES

    $("#username").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#username").on("keyup",function(){
		validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
		$("#susername"),"Este formato permite de 4 a 10 carácteres");
	});

    $("#password").on("keypress",function(e){
		validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
	});
	
	$("#password").on("keyup",function(){
        validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
        $(this), $("#spassword"),"Este campo debe estar lleno / Máximo 30 carácteres");
	});

    // BOTONES
    $("#proceso").on("click",function(){
        if($(this).text()=="REGISTRAR"){
            if(validarenvio()){
                var datos = new FormData();
                datos.append('accion','incluir');
                datos.append('id',$("#id").val());
                datos.append('username',$("#username").val());
                datos.append('password',$("#password").val());
    
                enviaAjax(datos);
            }
        }
        else if($(this).text()=="MODIFICAR"){
            if(validarenvio()){
                var datos = new FormData();
                datos.append('accion','modificar');
                datos.append('id', $("#id").val());
                datos.append('username',$("#username").val());
                datos.append('password',$("#password").val());
    
                enviaAjax(datos);
            }
        }
        if ($(this).text() == "ELIMINAR") {
            if (validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, $("#username"),
                $("#susername"), "El formato debe tener máximo de 30 carácteres") == 0) {
                muestraMensaje("error", 4000, "ERROR!", "Seleccionó un usuario incorrecto <br/> por favor verifique nuevamente");
            } else {
                // Mostrar confirmación usando SweetAlert
                Swal.fire({
                    title: '¿Está seguro de eliminar esta usuario?',
                    text: "Ésta acción no se puede deshacer!",
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
                        datos.append('username', $("#username").val());
                        enviaAjax(datos);
                    } else {
                        muestraMensaje("info", 2000, "Información", "La eliminación ha sido cancelada.");
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
    
    function validarenvio() {
        if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,$("#username"),
			$("#username"),"El formato no debe pasar de los 10 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","El usuario debe coincidir con el formato <br/>" + 
			"se permiten de 4 a 10 carácteres");
			return false;					
		}	
        else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
            $("#password"), $("#spassword"), "No debe contener más de 30 carácteres") == 0) {
            muestraMensaje("error", 4000, "ERROR!", "La contraseña <br/> No debe estar vacía, ni contener más de 30 carácteres");
            return false;
        }
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
        

        //funcion para pasar de la lista a el formulario
    function pone(pos,accion){
        
        linea=$(pos).closest('tr');

        if(accion==0){
            $("#proceso").text("MODIFICAR");
            $("#id").val($(linea).find("td:eq(0)").text());
            $("#username").val($(linea).find("td:eq(1)").text());
            $("#password").val($(linea).find("td:eq(2)").text());
        }
        else{
            $("#proceso").text("ELIMINAR");
        }
        $("#id").val($(linea).find("td:eq(0)").text());
        $("#username").val($(linea).find("td:eq(1)").text());
        $("#password").val($(linea).find("td:eq(2)").text());
        
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
              muestraMensaje('info', 4000,'REGISTRAR', lee.mensaje);
             if(lee.mensaje=='Registro Incluido!<br/> Se registró el usuario correctamente'){
                 $("#modal1").modal("hide");
                 consultar();
             }
          }else if (lee.resultado == "modificar") {
              muestraMensaje('info', 4000,'MODIFICAR', lee.mensaje);
             if(lee.mensaje=='Registro Modificado!<br/> Se modificó el usuario correctamente'){
                 $("#modal1").modal("hide");
                 consultar();
             }
          }else if (lee.resultado == "eliminar") {
              muestraMensaje('info', 4000,'ELIMINAR', lee.mensaje);
             if(lee.mensaje=='Registro Eliminado! <br/> Se eliminó el usuario correctamente'){
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
    $("#username").val('');
	$("#password").val('');
	$("#id").val('');
}
