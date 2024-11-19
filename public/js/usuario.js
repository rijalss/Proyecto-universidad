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
            zeroRecords: "<div style='text-align: center;'>No se encontraron usuarios</div>",
            emptyTable: "<div style='text-align: center;'>No se encontraron usuarios</div>",
            info: "Página _PAGE_ de _PAGES_",
            infoEmpty: "No hay usuarios registrados",
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
		validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,15}$/,$(this),
		$("#susername"),"Este formato permite de 4 a 15 carácteres");
	});

    $("#password").on("keypress", function (e) {
        validarkeypress(/^[A-Za-z0-9\b]*$/, e);
    });

    $("#password").on("keyup", function () {

        validarkeyup(/^[A-Za-z0-9]{4,15}$/,
            $(this), $("#spassword"), "Solo letras y numeros entre 4 y 15 caracteres");
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
                datos.append('rol',$("#rol").val());
    
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
                datos.append('rol',$("#rol").val());
    
                enviaAjax(datos);
            }
        }
        if ($(this).text() == "ELIMINAR") {
            if (validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,15}$/, $("#username"),
                $("#susername"), "Este formato permite de 4 a 15 carácteres") == 0) {
                muestraMensaje("error", 4000, "ERROR!", "Seleccionó un usuario incorrecto <br/> por favor verifique nuevamente");
            } else {
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
                        var datos = new FormData();
                        datos.append('accion', 'eliminar');
                        datos.append('username', $("#username").val());
                        enviaAjax(datos);
                    } else {
                        muestraMensaje("info", 2000, "Información", "La eliminación ha sido cancelada.");
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
    
    function validarenvio() {
        if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,15}$/,$("#username"),
			$("#username"),"Este formato permite de 4 a 15 carácteres")==0){
			muestraMensaje("error",4000,"ERROR!","El usuario debe coincidir con el formato <br/>" + 
			"se permiten de 4 a 15 carácteres");
			return false;					
		}	
        else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,15}$/,
             $("#password"),$("#spassword"),"Solo letras y numeros entre 4 y 15 caracteres")==0){
		    muestraMensaje("error",4000,"ERROR!","El contraseña debe tener mínimo 4 dígitos y máximo 15");
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
        

        
    function pone(pos,accion){
        
        linea=$(pos).closest('tr');

        if(accion==0){
           
            $("#proceso").text("MODIFICAR");
          
        }
        else{
            $("#proceso").text("ELIMINAR");
            $("#id, #username, #password, #rol").prop('disabled', true);
        }
       
        $("#id").val($(linea).find("td:eq(0)").text());
        $("#username").val($(linea).find("td:eq(1)").text());
        $("#password").val($(linea).find("td:eq(2)").text());
        $("#rol").val($(linea).find("td:eq(3)").text());

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
      timeout: 10000, 
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
    $("#username").val('');
	$("#password").val('');
	$("#id").val('');
    $("#rol").val("disabled");
    $("#username, #password, #id, #rol").prop('disabled', false);
}
