$(document).ready(function () {

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
    if (validarenvio()== true) {
      if(verificaproductos()== true) {
    $("#accion").val("registrar");

    var datos = new FormData($("#form")[0]);
    
    enviaAjax(datos);
}else{
  muestraMensaje("error",4000,"ERROR!","Debe colocar algun producto");
}
}});
});

function carga_productos() {
  var datos = new FormData();

  datos.append("accion", "listadoproductos"); 

  enviaAjax(datos);
}

function verificaproductos() {
  var existe = false;
  if ($("#detalledeventa tr").length > 0) {
    existe = true;
  }
  return existe;
}

function colocaproducto(linea) {
  var id = $(linea).find("td:eq(0)").text();
  var encontro = false;

  $("#detalledeventa tr").each(function () {
    if (id * 1 == $(this).find("td:eq(1)").text() * 1) {
      encontro = true;
      var t = $(this).find("td:eq(5)").children();
      t.val(t.val() * 1 + 1);
      modificasubtotal(t);
    }
  });

  if (!encontro) {
    var l =
      `
		  <tr>
		   <td>
		   <button type="button" class="btn btn-danger" onclick="eliminalineadetalle(this)">X</button>
		   </td>
		   <td style="display:none">
			   <input type="text" name="idp[]" class="h" style="display:none"
			   value="` +
      $(linea).find("td:eq(0)").text() +
      `"/>` +
      $(linea).find("td:eq(0)").text() +
      `</td>
		   <td>` +
      $(linea).find("td:eq(1)").text() +
      `</td>
		   <td>` +
      $(linea).find("td:eq(2)").text() +
      `</td>
      <td>` +
      $(linea).find("td:eq(3)").text() +
      `</td>
		   <td>
		      <input type="text" value="1" name="cant[]" class="c" onkeyup="modificasubtotal(this)"/>
		   </td>
		   <td>
		       
		      <input type="text" value="1" name="precio[]" onkeyup="modificasubtotal(this)"/></td>
		   
		   </tr>`;
    $("#detalledeventa").append(l);
  }
}


function eliminalineadetalle(boton) {
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
        
        } 
         else if (lee.resultado == "error") {
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
}
