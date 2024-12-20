function consultar(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);	
}

function consultar_mostrador(){
	var datos = new FormData();
	datos.append('accion','consultar_mostrador');
	enviaAjax(datos);	
}

function destruyeDT(tablaId) {
    // Destruir la DataTable si ya existe
    if ($.fn.DataTable.isDataTable(`#${tablaId}`)) {
        $(`#${tablaId}`).DataTable().destroy();
    }
}

function crearDT(tablaId) {
    // Construir la DataTable si no existe
    if (!$.fn.DataTable.isDataTable(`#${tablaId}`)) {
        var table = $(`#${tablaId}`).DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                lengthMenu: "Mostrar _MENU_",
                zeroRecords: "No se encontraron productos",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "No hay productos registrados",
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

    $('#tab1').addClass('show active');
    $('#tab2').removeClass('show active');

    $('#tab1-tab').on('click', function() {
        $('#tab1').addClass('show active');
        $('#tab2').removeClass('show active');
        consultar();
    });

    $('#tab2-tab').on('click', function() {
        $('#tab1').removeClass('show active');
        $('#tab2').addClass('show active');
        consultar_mostrador();
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
    beforeSend: function () {},
    timeout: 10000, //tiempo maximo de espera por la respuesta del servidor
    success: function (respuesta) {
    // console.log(respuesta);
      try {
        var lee = JSON.parse(respuesta);
        if (lee.resultado == "consultar") {
			
           destruyeDT('tablaalmacen');
           $("#resultadoconsulta").html(lee.mensaje);
            crearDT('tablaalmacen');

            destruyeDT('tablamostrador');
            $("#resultadoconsulta_mostrador").html(lee.mensaje);
            crearDT('tablamostrador');
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
