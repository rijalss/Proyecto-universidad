function consultar() {
  var datos = new FormData();
  datos.append('accion', 'consultar');
  enviaAjax(datos);
}


function destruyeDT() {
  
  if ($.fn.DataTable.isDataTable("#tabSalida")) {
      $("#tabSalida").DataTable().destroy();
  }
}

function crearDT() {
  if (!$.fn.DataTable.isDataTable("#tabSalida")) {
      var table = $("#tabSalida").DataTable({
          paging: true,
          lengthChange: true,
          searching: false,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
          language: {
              lengthMenu: "Mostrar _MENU_",
              zeroRecords: "No se encontraron registros",
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

function validarFechas() { 
  var finicio = $('#fecha_inicio').val(); 
  var ffin = $('#fecha_fin').val();
      if ((finicio === "" && ffin !== "")) { 
        muestraMensaje("warning",4000,"ATENCION","Por favor, complete la Fecha Inicio .");
     
        return false; 
    } else if ((finicio !== "" && ffin === "")) { 
      muestraMensaje("warning",4000,"ATENCION","Por favor, complete la Fecha Final.");
      
         return false; 

      }else if ((finicio === "" && ffin === "")) { 
        muestraMensaje("warning",4000,"ATENCION","Por favor, introduzca las Fechas de Inicio y Final");
        
           return false; 
  
        }

      
     return true;
     } 
    
     function limpia() {
      
      $("#numfactura").val("");
      $("#fecha_fin").val("");
      $("#fecha_inicio").val("");
      $("#ubi").val("disabled");
      $("#empleado").val("disabled");
     
        // Habilitar los campos por si estaban deshabilitados
  
    }
$(document).ready(function () {
  consultar();
 
  
 

  $("#fecha_inicio").on("input", function() {
    if($("#fecha_inicio").val() === "") {
        console.log("false");
        $("#fecha_fin").prop('required', false);
    } else {
        console.log("true");
        $("#fecha_fin").prop('required', true);
        setTimeout(function() { 
          $("#fecha_fin").prop('required', false); 
           }, 2000);
    }
});

$("#fecha_fin").on("input", function() {
    if($("#fecha_fin").val() === "") {
        console.log("false");
        $("#fecha_inicio").prop('required', false);
    } else {
        console.log("true");
        $("#fecha_inicio").prop('required', true);
        setTimeout(function() { 
          $("#fecha_inicio").prop('required', false);; 
           }, 2000);
    }
});

$("#generar").on("click",function(){
  
  setTimeout(function() {  
    limpia();
    consultar();
 
     1000}, );


});

  $("#filtrar").on("click",function(){ 
    if (validarFechas()) { 
    var datos = new FormData();
    datos.append('accion', 'filtrar');
    datos.append('fecha_inicio', $("#fecha_inicio").val());
    datos.append('fecha_fin', $("#fecha_fin").val());
   
    enviaAjax(datos);
  }

  });
});


function enviaAjax(datos) {
  $.ajax({
    async: true,
    url: "", 
    type: "POST",
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    beforeSend: function () { }, 
    timeout: 10000, // tiempo máximo de espera por la respuesta del servidor
    success: function (respuesta) {
      try {
        var lee = JSON.parse(respuesta);
        if (lee.resultado == "consultar") {
          destruyeDT();
          $("#Salida").html(lee.mensaje, null, 2); // Mostrar el JSON de manera legible
          crearDT();
         } else if (lee.resultado == "filtrar") {
          destruyeDT();
          $("#Salida").html(lee.mensaje);   // Mostrar el JSON de manera legible
          crearDT();
        
        } else {
          console.error("Error en la respuesta:", lee.mensaje);
        }
      } catch (e) {
        console.error("Error en análisis JSON:", e);
        console.error("Respuesta recibida:", respuesta);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
    }
  });
}