function consultar() {
  var datos = new FormData();
  datos.append('accion', 'consultar');
  enviaAjax(datos);
}

function destruyeDT() {
  
    if ($.fn.DataTable.isDataTable("#tablarentrada")) {
        $("#tablarentrada").DataTable().destroy();
    }
}

function crearDT() {
    if (!$.fn.DataTable.isDataTable("#tablarentrada")) {
        var table = $("#tablarentrada").DataTable({
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
  var finicio = $('#finicio').val(); 
  var ffin = $('#ffin').val();
  
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
      // Limpiar los campos
      $("#numfactura").val("");
      $("#ffin").val("");
      $("#finicio").val("");
      $("#proveedor").val("disabled");
      $("#empleado").val("disabled");
   
        // Habilitar los campos por si estaban deshabilitados
  
    }
    

$(document).ready(function () {
  consultar();
  

 
    $("#finicio").on("input", function() {
        if($("#finicio").val() === "") {
            console.log("false");
            $("#ffin").prop('required', false);
        } else {
            console.log("true");
            $("#ffin").prop('required', true);
            setTimeout(function() { 
              $("#ffin").prop('required', false); 
               }, 2000);
        }
    });

    $("#ffin").on("input", function() {
        if($("#ffin").val() === "") {
            console.log("false");
            $("#finicio").prop('required', false);
        } else {
            console.log("true");
            $("#finicio").prop('required', true);
            setTimeout(function() { 
              $("#finicio").prop('required', false);; 
               }, 2000);
        }
    });



  $("#Generar").on("click",function(){

    
    
   
    setTimeout(function() {  
      limpia();
      consultar();
       1000}, );

  
});
 
 
  $("#filtrar").on("click",function(){
 
   if (validarFechas()) { 
    console.log("hola");
   var datos = new FormData();
   datos.append('accion', 'filtrar');
    datos.append('finicio', $("#finicio").val());
    datos.append('ffin', $("#ffin").val());
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
          $("#entrada").html(lee.mensaje); // Mostrar el JSON de manera legible
          crearDT();
        } else if (lee.resultado == "filtrar") {
          console.log("entro al ajax de filtar ");
          destruyeDT()
          $("#entrada").html(lee.mensaje); 
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