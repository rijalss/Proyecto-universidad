function limpia() {
    // Limpiar los campos
    $("#codProducto").val("");
    $("#nombreProducto").val("");
  
    $("#categoria").val("disabled");
  
      // Habilitar los campos por si estaban deshabilitados

  }
  $("#generar").on("click",function(){

    setTimeout(function() {  limpia(); 1}, );

  
});