function consultar() {
  var datos = new FormData();
  datos.append("accion", "consultar");
  enviaAjax(datos);
}
function destruyeDT() {
  //1 se destruye el datatablet
  if ($.fn.DataTable.isDataTable("#tablaempleado")) {
    $("#tablaempleado").DataTable().destroy();
  }
}
function crearDT() {
  if (!$.fn.DataTable.isDataTable("#tablaempleado")) {
    var table = $("#tablaempleado").DataTable({
      paging: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      language: {
        lengthMenu: "Mostrar _MENU_",
        zeroRecords: "No se encontraron empleados",
        info: "Página _PAGE_ de _PAGES_",
        infoEmpty: "No hay empleados registrados",
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
      dom:
        "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4'f>><'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });

    $("div.dataTables_length select").css({
      width: "auto",
      display: "inline",
      "margin-top": "10px",
    });

    $("div.dataTables_filter").css({
      "margin-bottom": "50px",
      "margin-top": "10px",
    });

    $("div.dataTables_filter label").css({
      float: "left",
    });

    $("div.dataTables_filter input").css({
      width: "300px",
      float: "right",
      "margin-left": "10px",
    });
  }
}

$(document).ready(function () {
    //control de input para mostrar imagen 
    $("#archivo").on("change",function(){
      
      mostrarImagen(this);
    });
  //			
  
  $("#imagen").on("error",function(){
    $(this).prop("src","public/img/img-empleado/perfil.jpg");
  });
  consultar();

  
    
  //////////////////////////////VALIDACIONES/////////////////////////////////////

  $("#cedulaEmpleado").on("keypress", function (e) {
    validarkeypress(/^[0-9-\b]*$/, e);
  });

  $("#cedulaEmpleado").on("keyup", function () {
    validarkeyup(
      /^[0-9]{7,8}$/,
      $(this),
      $("#scedulaEmpleado"),
      "El formato debe ser un número de cedula válido"
    );
    if ($("#cedulaEmpleado").val().length <= 10) {
			var datos = new FormData();
			datos.append('accion', 'existe');
			datos.append('cedulaEmpleado', $(this).val());
			enviaAjax(datos);
		}
  });
  
  $("#telefonoEmpleado").on("keypress", function (e) {
    validarkeypress(/^[0-9-\b]*$/, e);
  });

  $("#telefonoEmpleado").on("keyup", function () {
    validarkeyup(
      /^[0-9]{10,11}$/,
      $(this),
      $("#stelefonoEmpleado"),
      "El formato sólo permite un número válido"
    );
  });

// Validación para el campo nombreEmpleado
$("#nombreEmpleado").on("keypress", function (e) {
  validarkeypress(/^[A-Za-z\u00f1\u00d1\b\s]*$/, e); // Solo letras, espacios y ñ
});

$("#nombreEmpleado").on("keyup", function () {
  validarkeyup(
    /^[A-Za-z\u00f1\u00d1\s]{1,30}$/, // Solo letras, espacios y ñ, máximo 30 caracteres
    $(this),
    $("#snombreEmpleado"),
    "Se debe llenar este campo y debe contener un máximo de 30 caracteres"
  );
});

// Validación para el campo apellidoEmpleado
$("#apellidoEmpleado").on("keypress", function (e) {
  validarkeypress(/^[A-Za-z\u00f1\u00d1\b\s]*$/, e); // Solo letras, espacios y ñ
});

$("#apellidoEmpleado").on("keyup", function () {
  validarkeyup(
    /^[A-Za-z\u00f1\u00d1\s]{1,30}$/, // Solo letras, espacios y ñ, máximo 30 caracteres
    $(this),
    $("#sapellidoEmpleado"),
    "Se debe llenar este campo y debe contener un máximo de 30 caracteres"
  );
});

  $("#correoEmpleado").on("keypress", function (e) {
    validarkeypress(/^[A-Za-z0-9@_.\b\u00f1\u00d1\u00E0-\u00FC.!@#$%^&*()-_=+[\]{};:'",<>/?\\|~`]*$/, e);
  });

  $("#correoEmpleado").on("keyup", function () {
    validarkeyup(
      /^[A-Za-z0-9_\u00f1\u00d1\u00E0-\u00FC.!@#$%^&*()-_=+[\]{};:'",<>/?\\|~`]{3,30}[@]{1}[A-Za-z0-9]{3,8}[.]{1}[A-Za-z]{2,3}$/,
      $(this),
      $("#scorreoEmpleado"),
      "El formato sólo permite un correo válido!"
    );
  });

  //////////////////////////////BOTONES/////////////////////////////////////

  if ($.trim($("#mensajes").text()) != "") {
    //icono,tiempo,titulo,mensaje
    muestraMensaje("success", 4000, "Resultado", $("#mensajes").html());
  }

  $("#proceso").on("click", function () {
    if ($(this).text() == "REGISTRAR") {
      if (validarenvio()) {
        var datos = new FormData($('#f')[0]);
        datos.append("accion", "incluir");
        datos.append("prefijoCedula", $("#prefijoCedula").val());
        datos.append("cedulaEmpleado", $("#cedulaEmpleado").val());
        datos.append("nombreEmpleado", $("#nombreEmpleado").val());
        datos.append("apellidoEmpleado", $("#apellidoEmpleado").val());
        datos.append("telefonoEmpleado", $("#telefonoEmpleado").val());
        datos.append("correoEmpleado", $("#correoEmpleado").val());

        datos.append("cargo", $("#cargo").val());

        enviaAjax(datos);
      }
    } else if ($(this).text() == "MODIFICAR") {
      if (validarenvio()) {
        var datos = new FormData($('#f')[0]);
        datos.append("accion", "modificar");
        datos.append("prefijoCedula", $("#prefijoCedula").val());
        datos.append("cedulaEmpleado", $("#cedulaEmpleado").val());
        datos.append("nombreEmpleado", $("#nombreEmpleado").val());
        datos.append("apellidoEmpleado", $("#apellidoEmpleado").val());
        datos.append("telefonoEmpleado", $("#telefonoEmpleado").val());
        datos.append("correoEmpleado", $("#correoEmpleado").val());

        datos.append("cargo", $("#cargo").val());

        enviaAjax(datos);
      }
    }
    if ($(this).text() == "ELIMINAR") {
      if (
        validarkeyup(
          /^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,11}$/,
          $("#cedulaEmpleado"),
          $("#scodProducto"),
          "El formato debe tener de 11 carácteres"
        ) == 0
      ) {
        muestraMensaje(
          "error",
          4000,
          "ERROR!",
          "Seleccionó un código incorrecto <br/> por favor verifique nuevamente"
        );
      } else {



        // Mostrar confirmación usando SweetAlert
        Swal.fire({
          title: "¿Está seguro de eliminar este producto?",
          text: "Esta acción no se puede deshacer.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí, eliminar",
          cancelButtonText: "Cancelar",
        }).then((result) => {
          if (result.isConfirmed) {
            // Si se confirma, proceder con la eliminación
            var datos = new FormData();
            datos.append("accion", "eliminar");
            datos.append("cedulaEmpleado", $("#cedulaEmpleado").val());
            enviaAjax(datos);
          } else {
            muestraMensaje(
              "error",
              2000,
              "INFORMACIÓN",
              "La eliminación ha sido cancelada."
            );
            $("#modal1").modal("hide");
          }
        });
      }
    }
  });

  $("#incluir").on("click", function () {
    limpia();
 
    $("#proceso").text("REGISTRAR");
    $("#modal1").modal("show");
  });
});
      //funcion para mostrar la imagen antes de subirla al servidor
      function mostrarImagen(f) {
	
        var tamano = f.files[0].size;
           var megas = parseInt(tamano / 1024);
           
           if(megas > 1024){
           muestraMensaje("La imagen debe ser igual o menor a 1024 K");
               $(f).val('');
           }
           else{	
           if (f.files && f.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
             $('#imagen').attr('src', e.target.result);
            }
            reader.readAsDataURL(f.files[0]);
           }
         }
      }
      //fin de funcion mostrar imagen
//////////////////////////////VALIDACIONES ANTES DEL ENVIO/////////////////////////////////////

function validarenvio() {
  var cargoSeleccionada = $("#cargo").val();

  if (cargoSeleccionada === null || cargoSeleccionada === "0") {
    muestraMensaje(
      "error",
      4000,
      "ERROR!",
      "Por favor, seleccione un cargo! <br/> Recuerde que debe tener alguna registrada!"
    );
    return false;
  } else if (
    validarkeyup(
      /^[0-9]{7,8}$/,
      $("#cedulaEmpleado"),
      $("#scedulaEmpleado"),
      "El formato debe ser un número de cédula válido"
    ) == 0
  ) {
    muestraMensaje(
      "error",
      4000,
      "ERROR!",
      "La cedula del empleado debe coincidir con el formato <br/>" +
        "V-12345678"
    );

    return false;
  } else if (
    validarkeyup(
      /^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{10,11}$/,
      $("#telefonoEmpleado"),
      $("#stelefonoEmpleado"),
      "El formato debe ser un número de teléfono válido"
    ) == 0
  ) {
    muestraMensaje(
      "error",
      4000,
      "ERROR!",
      "El teléfono del empleado <br/>Debe ser un número de teléfono válido"
    );
    return false;
  } else if (
    validarkeyup(
      /^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
      $("#nombreEmpleado"),
      $("#snombreEmpleado"),
      "No debe contener más de 30 caracteres"
    ) == 0
  ) {
    muestraMensaje(
      "error",
      4000,
      "ERROR!",
      "El nombre del empleado <br/> No debe estar vacío, ni contener más de 30 carácteres"
    );
    return false;
  } else if (
    validarkeyup(
      /^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
      $("#apellidoEmpleado"),
      $("#sapellidoEmpleado"),
      "No debe contener más de 200 caracteres"
    ) == 0
  ) {
    muestraMensaje(
      "error",
      4000,
      "ERROR!",
      "El apellido del empleado <br/> No debe estar vacío, ni contener más de 30 carácteres"
    );
    return false;
  } else if (
    validarkeyup(
      /^[A-Za-z0-9_\u00f1\u00d1\u00E0-\u00FC.!@#$%^&*()-_=+[\]{};:'",<>/?\\|~`]{3,30}[@]{1}[A-Za-z0-9]{3,8}[.]{1}[A-Za-z]{2,3}$/,
      $("#correoEmpleado"),
      $("#scorreoEmpleado"),
      "No debe contener más de 30 carácteres"
    ) == 0
  ) {
    muestraMensaje(
      "error",
      4000,
      "ERROR!",
      "El correo del empleado <br/> No debe estar vacío, ni contener más de 30 carácteres"
    );
    return false;
  }
  return true;
}

//Función para mostrar mensajes

function muestraMensajeReload(icono, tiempo, titulo, mensaje) {
  Swal.fire({
    icon: icono,
    timer: tiempo,
    title: titulo,
    html: mensaje,
    showConfirmButton: true,
    confirmButtonText: "Aceptar",
    allowOutsideClick: false,  // Desactivar clics fuera de la alerta
    allowEscapeKey: false,     // Desactivar el escape key para cerrar la alerta
    willClose: () => {
      reload();
    }
  }).then((result) => {
    if (result.isConfirmed) {
      reload();
    }
  });
}



function muestraMensaje(icono, tiempo, titulo, mensaje) {
  Swal.fire({
    icon: icono,
    timer: tiempo,
    title: titulo,
    html: mensaje,
    showConfirmButton: true,
    confirmButtonText: "Aceptar",
  });
  
}

//Función para validar por Keypress
function validarkeypress(er, e) {
  key = e.keyCode;

  tecla = String.fromCharCode(key);

  a = er.test(tecla);

  if (!a) {
    e.preventDefault();
  }
}

//Función para validar por keyup
function validarkeyup(er, etiqueta, etiquetamensaje, mensaje) {
  a = er.test(etiqueta.val());
  if (a) {
    etiquetamensaje.text("");
    return 1;
  } else {
    etiquetamensaje.text(mensaje);
    return 0;
  }
}

//funcion para pasar de la lista a el formulario
function pone(pos, accion) {
  linea = $(pos).closest("tr");

  if (accion == 0) {
      // Para modificar: Habilitar los campos y permitir edición
      $("#proceso").text("MODIFICAR");
      $("#prefijoCedula").prop('disabled', true);
      $("#cedulaEmpleado").prop('disabled', true);
          // Agregar timestamp a la URL de la imagen para evitar caché
     $(" #nombreEmpleado, #apellidoEmpleado, #telefonoEmpleado, #correoEmpleado, #cargo").prop('disabled', false);
  } else {
      // Para eliminar: Desactivar los campos para evitar edición
      $("#proceso").text("ELIMINAR");
      $("#cedulaEmpleado, #prefijoCedula, #nombreEmpleado, #apellidoEmpleado, #telefonoEmpleado, #correoEmpleado, #cargo").prop('disabled', true);
  }

  // Cargar los datos de la fila seleccionada
  $("#prefijoCedula").val($(linea).find("td:eq(1)").text());
  $("#cedulaEmpleado").val($(linea).find("td:eq(2)").text());
  $("#nombreEmpleado").val($(linea).find("td:eq(3)").text());
  $("#apellidoEmpleado").val($(linea).find("td:eq(4)").text());
  $("#telefonoEmpleado").val($(linea).find("td:eq(5)").text());
  $("#correoEmpleado").val($(linea).find("td:eq(6)").text());

  // Agregar timestamp a la URL de la imagen para evitar caché
  var imagenURL = "public/img/img-empleado/" + $(linea).find("td:eq(2)").text() + ".png";
  var timestamp = new Date().getTime(); // Obtener la marca de tiempo actual
  $("#imagen").prop("src", imagenURL + "?" + timestamp);

  var nombreCargo = $(linea).find("td:eq(7)").text();
  $('#cargo option').filter(function() {
      return $(this).text() == nombreCargo;
  }).prop('selected', true).change();

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
        } else if (lee.resultado == "incluir") {
          muestraMensajeReload("info", 4000, "REGISTRAR", lee.mensaje);
          if (lee.mensaje == "Registro Incluido!<br/> Se incluyó el empleado correctamente") {
              $("#modal1").modal("hide");
              consultar();
          }
       
      }
       else if (lee.resultado == "modificar") {
          destruyeDT();
          $("#resultadoconsulta").html(lee.mensaje);
          crearDT();
          muestraMensajeReload("info", 4000, "MODIFICAR", lee.mensaje);
          if (
            lee.mensaje ==
            "Registro Modificado!<br/> Se modificó el empleado correctamente"
          ) {
            $("#modal1").modal("hide");
            consultar();
          }
        } else if (lee.resultado == "eliminar") {
          muestraMensaje("info", 4000, "ELIMINAR", lee.mensaje);
          if (
            lee.mensaje ==
            "Registro Eliminado! <br/> Se eliminó el empleado correctamente"
          ) {
            $("#modal1").modal("hide");
            consultar();
          } 
        } else if (lee.resultado == "existe") {		
          if (lee.mensaje == 'La cédula del empleado ya existe!') 
              muestraMensaje('info', 4000,'Atención', lee.mensaje);
            
      } else if (lee.resultado == "error") {
          muestraMensaje("error", 10000, "ERROR!!!!", lee.mensaje);
        }
      } catch (e) {
        console.error("Error en análisis JSON:", e); // Registrar el error para depuración
        console.log("Error en JSON " + e.name + ": " + e.message);
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
function reload(){
  location.reload()
}
function limpia() {
  $("#cedulaEmpleado").val("");
  $("#nombreEmpleado").val("");
  $("#telefonoEmpleado").val("");
  $("#apellidoEmpleado").val("");
  $("#correoEmpleado").val("");
  var timestamp = new Date().getTime(); // Obtener la marca de tiempo actual
  $("#imagen").prop("src", "public/img/img-empleado/perfil.jpg" + "?" + timestamp);
  $("#cargo").val("disabled");
  $("#cedulaEmpleado, #prefijoCedula, #nombreEmpleado, #apellidoEmpleado, #telefonoEmpleado, #correoEmpleado, #cargo").prop('disabled', false);
}
