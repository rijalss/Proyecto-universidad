function limpia() {
    // Limpiar los campos
    $("#cedulaEmpleado").val("");
    $("#nombreEmpleado").val("");
    $("#apellidoEmpleado").val("");
    $("#cargo").val("disabled");

      // Habilitar los campos por si estaban deshabilitados

  }

  $("#generar").on("click",function(){

    setTimeout(function() {  limpia(); 1}, );

  
});