function consultar() {
  var datos = new FormData();
  datos.append('accion', 'consultar');
  enviaAjax(datos);
}


$(document).ready(function () {
  consultar();
  // Obtener la fecha actual en formato yyyy-MM-dd
  var hoy = new Date();
   hoy.setMinutes(hoy.getMinutes() - hoy.getTimezoneOffset());
   var fechaActual = hoy.toISOString().slice(0, 10);
  // Asignar la fecha actual al valor del input
  $("#ffin").val(fechaActual);
  $("#finicio").val(fechaActual);
 
  $("#filtrar").on("click",function(){ 
    var datos = new FormData();
    datos.append('finicio', $("#finicio").val());
    datos.append('ffin', $("#ffin").val());
    datos.append('accion', 'filtrar');
    enviaAjax(datos);

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
          $("#entrada").html(JSON.stringify(lee.mensaje, null, 2)); // Mostrar el JSON de manera legible
        } 
        if (lee.resultado == "filtrar") {
          $("#entrada").html(JSON.stringify(lee.mensaje, null, 2)); // Mostrar el JSON de manera legible
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