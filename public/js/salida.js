function destruyeDT(){
	// se destruye el datatable
	if ($.fn.DataTable.isDataTable("#tabSalida")) {
            $("#tabSalida").DataTable().destroy();
    }
}

function crearDT(){
    //  se construye la datatable
    if (!$.fn.DataTable.isDataTable("#tabSalida")) {
         var table = $("#tabSalida").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                lengthMenu: "Mostrar _MENU_",
                zeroRecords: "No se encontraron notas de salida",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "No hay notas de salida registradas",
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



$(document).ready(function () {
  // Si estoy aca es porque l
  carga_productos();

  //boton para levantar modal de productos
  $("#listadodeproductos").on("click", function () {
    $("#modalproductos").modal("show");
  });

  //evento keyup de input codigoproducto
  $("#codigoproducto").on("keyup", function () {
    var codigo = $(this).val();
    $("#listadoproductos tr").each(function () {
      if (codigo == $(this).find("td:eq(1)").text()) {
        colocaproducto($(this));
      }
    });
  });

  $(".h").on("keyup",function(){
		if ($(".h").val().length <= 9) {
			var datos = new FormData();
			datos.append('accion', 'buscar');
			datos.append('h', $(this).val());
			enviaAjax(datos, 'buscar');
		}
	});

  //evento click de boton facturar
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

  datos.append("accion", "listadoproductos"); //le digo que me muestre un listado de aulas

  enviaAjax(datos);
}

//function para saber si selecciono algun productos
function verificaproductos() {
  var existe = false;
  if ($("#detalledeventa tr").length > 0) {
    existe = true;
  }
  return existe;
}

//funcion para colocar los productos
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
		      <input type="text" value="1" name="cant[]" onkeyup="modificasubtotal(this)"/>
		   </td>
		   <td>
		       
		      <input type="text" value="1" name="precio[]" onkeyup="modificasubtotal(this)"/></td>
		   
		   </tr>`;
    $("#detalledeventa").append(l);
  }
}


//funcion para eliminar linea de detalle de ventas
function eliminalineadetalle(boton) {
  $(boton).closest("tr").remove();
}

//Funcion que muestra el modal con un mensaje
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

function enviaAjax(datos) {
  $.ajax({
    async: true,
    url: "", //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
    type: "POST", //tipo de envio
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    beforeSend: function () {
      //pasa antes de enviar pueden colocar un loader
    },
    timeout: 10000, //tiempo maximo de espera por la respuesta del servidor
    success: function (respuesta) {
      //si resulto exitosa la transmision

      try {
        var lee = JSON.parse(respuesta);
        console.log(lee.resultado);

        if (lee.resultado == "listadoproductos") {
          $("#listadoproductos").html(lee.mensaje);
        } else if (lee.resultado == "registrar") {

         muestraMensaje('info', 4000,'REGISTRAR', lee.mensaje);
        
        } else if (lee.resultado == "encontro") {		
          if (lee.mensaje == 'El rif ya existe!') {
            alert(lee.mensaje);
          }
        } else  if (lee.resultado == "error") {
          muestraMensaje('error', 4000,'ERROR',lee.mensaje);
          
        }
      } catch (e) {
        alert("Error en JSON " + e.name + " !!!");
      }
      //cuanto termina el proceso ocultan el loader
    },
    error: function (request, status, err) {
      if (status == "timeout") {
        //pasa cuando superan los 10000 10 segundos de timeout
        muestraMensaje("Servidor ocupado, intente de nuevo");
      } else {
        //cuando ocurreo otro error con ajax
        muestraMensaje("ERROR: <br/>" + request + status + err);
      }
    },
    complete: function () {},
  });
}
function limpia() {
  $("#empleado").val("disabled");
}
