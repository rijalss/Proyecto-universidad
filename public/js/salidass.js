$(document).ready(function () {
  validarselect();
  carga_productos();
  
  $("#listadodeproductos").on("click", function () {
    $("#modalproductos").modal("show");
  });

  $("#codigoproducto").on("keyup", function () {
    var codigo = $(this).val();
    $("#listadoproductos tr").each(function () {
      if (codigo == $(this).find("td:eq(1)").text()) {
        colocaproducto($(this));
      }
    });
  });

  $("#registrar").on("click", function () {
    if (validarenvio() == true) {
      if (verificaproductos() == true) {
        if ($("#ubi").val() == "1") {
          $("#accion").val("registrar");
        } else if ($("#ubi").val() == "2") {
          $("#accion").val("registrarMostrador");
        }

        var datos = new FormData($("#form")[0]);
        enviaAjax(datos);
      } else {
        muestraMensaje("error", 4000, "ERROR!", "Debe colocar algun producto");
      }
    }
  });

  $("#ubi").on("change", function () {
    carga_productos();
  });
});

function carga_productos() {
  var datos = new FormData();
  var accion = $("#ubi").val() == "1" ? "listadoproductos" : "listadoMostrador";
  datos.append("accion", accion);
  enviaAjax(datos);
}

function verificaproductos() {
  var existe = false;
  if ($("#salidadetalle tr").length > 0) {
    existe = true;
  }
  return existe;
}

function colocaproducto(linea) {
  var id = $(linea).find("td:eq(0)").text();
  var encontro = false;

  $("#salidadetalle tr").each(function () {
    if (id * 1 == $(this).find("td:eq(1)").text() * 1) {
      encontro = true;
      var t = $(this).find("td:eq(5)").children();
      t.val(t.val() * 1 + 1);
    }
  });

  if (!encontro) {
    var l =
      `
      <tr>
       <td>
      `;
  }
}

function eliminarsalidadetalle(boton) {
  $(boton).closest("tr").remove();
}


async function muestraMensaje(icono,tiempo,titulo,mensaje){

  await Swal.fire({
        icon:icono,
        timer:tiempo,
        title:titulo,
        html:mensaje,
        showConfirmButton:true,
        confirmButtonText:'Aceptar',
        });
    }

function validarenvio() {
  var empleadoseleccionado = $("#empleado").val();

  if (empleadoseleccionado === null || empleadoseleccionado === "0") {
    muestraMensaje(
      "error",
      4000,
      "ERROR!",
      "Por favor, seleccione un empleado! <br/> Recuerde que debe tener alguno registrado!"
    );
    return false;
  }

  return true;
}

function validarkeypress(er, e) {
  key = e.keyCode;

  tecla = String.fromCharCode(key);

  a = er.test(tecla);

  if (!a) {
    e.preventDefault();
  }
}

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

function validarselect() {
  const selectElement = document.getElementById('ubi');
  const handleSelectChange = () => console.log('Valor seleccionado:', selectElement.value);

  handleSelectChange(); 
  selectElement.addEventListener('change', handleSelectChange); 
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
    beforeSend: function () {
      //pasa antes de enviar pueden colocar un loader
    },
    timeout: 10000, 
    success: function (respuesta) {
     
      try {
        var lee = JSON.parse(respuesta);
        console.log(lee.resultado);

        if (lee.resultado == "listadoproductos") {

          $("#listadoproductos").html(lee.mensaje);

        } else if (lee.resultado == "registrar") {
          
        muestraMensaje('info', 4000,'REGISTRAR', lee.mensaje);
        limpia();
        carga_productos();

        } else if (lee.resultado == "registrarMostrador"){

        muestraMensaje('info', 4000,'REGISTRAR', lee.mensaje);
        limpia();
        carga_productos();

        } else if (lee.resultado == "error") {
          muestraMensaje('error', 4000,'ERROR',lee.mensaje);
        }

      } catch (e) {
        alert("Error en JSON " + e.name + " !!!");
      }
      //cuanto termina el proceso ocultan el loader
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

function limpia() {
  $("#empleado").val("disabled");
  $("#codigoproducto").val('');
  $("#salidadetalle tr").remove();
}