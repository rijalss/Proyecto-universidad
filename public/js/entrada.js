function destruyeDT() {
  
    if ($.fn.DataTable.isDataTable("#tablaentrada")) {
        $("#tablaentrada").DataTable().destroy();
    }
}

function crearDT() {
    if (!$.fn.DataTable.isDataTable("#tablaentrada")) {
        var table = $("#tablaentrada").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
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
$(document).ready(function(){
    // Si estoy aca es porque l
    carga_productos();
    
    //boton para levantar modal de productos
    $("#listadodeproductos").on("click",function(){
        $("#modalproductos").modal("show");
    });
    
    $("#nombreProveedor").on("keyup",function(){
        validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{4,30}$/, 
        $(this), $("#snombreProveedor"),"Este formato no debe estar vacío / permite un máximo 30 carácteres");

	});

   
    
    $("#numfactura").on("keyup",function(){
        validarkeyup(/^[1-9]{4,10}$/,$(this),
        $("#snumfactura"),"Este formato permite de 4 a 10 carácteres");
        if ($("#numfactura").val().length <= 9) {
			var datos = new FormData();
			datos.append('accion', 'buscar');
			datos.append('numfactura', $(this).val());
			enviaAjax(datos);
		}
    });
    
    //evento keyup de input codigoproducto
    $("#codigoproducto").on("keyup",function(){
        var codigo = $(this).val();
        $("#listadoproductos tr").each(function(){
            if(codigo == $(this).find("td:eq(1)").text()){
                colocaproducto($(this));
            }
        });
    });	
    
    //evento click de boton registrar
    $("#registrar").on("click",function(){
         if (validarenvio()){
            if(verificaproductos()){
            $('#accion').val('registrar');
    
                var datos = new FormData($('#f')[0]);
                
                $('#proveedor').change(function() {
                    var valor = $(this).val();
                    datos.append('proveedor', valor);
                });
    
                $('#empleado').change(function() {
                    var valor = $(this).val();
                    datos.append('empleado', valor);
                });
    
                enviaAjax(datos);
                } else{
                muestraMensaje("error",4000,"ERROR!","Debe colocar algun producto");
            }
          } 
           
            
        
    });
        
        
    });

    function validarenvio(){
        var empleadoseleccionado = $("#empleado").val();
        var proveedorseleccionado = $("#proveedor").val();
       
    
         if (empleadoseleccionado === null || empleadoseleccionado === "0") {
            muestraMensaje("error",4000,"ERROR!","Por favor, seleccione un empleado! <br/> Recuerde que debe tener alguno registrado!"); 
            return false;
        }
        else if (proveedorseleccionado === null || proveedorseleccionado === "0") {
            muestraMensaje("error",4000,"ERROR!","Por favor, seleccione un proveedor! <br/> Recuerde que debe tener alguno registrado!"); 
            return false;
        }
        else if(validarkeyup(/^[1-9]{4,10}$/,$("#numfactura"),
            $("#snumfactura"),"Este formato permite de 4 a 10 carácteres")==0){
            muestraMensaje("error",4000,"ERROR!","La factura debe coincidir con el formato <br/>");
                           
            return false;					
        }
        return true;
    }
    
    function carga_productos(){
        
        
        var datos = new FormData();
        
        datos.append('accion','listadoproductos'); //le digo que me muestre un listado de aulas
        
        enviaAjax(datos);
    }
    
    //function para saber si selecciono algun productos
    function verificaproductos(){
        var existe = false;
       
        if($("#productosentrada tr").length > 0){
            existe = true;
            
        }
      
        return existe;
    }


    
//funcion para colocar los productos
    
    
    function colocaproducto(linea){
      //  destruyeDT();
        var id = $(linea).find("td:eq(0)").text();
        var encontro = false;
        
   
        $("#productosentrada tr").each(function () {
            if (id * 1 == $(this).find("td:eq(1)").text() * 1) {
              encontro = true;
              var t = $(this).find("td:eq(5)").children();
              t.val(t.val() * 1 + 1);
            }
          });
        if(!encontro){
            var l = `
              <tr>
               <td>
               <button type="button" class="btn btn-danger" onclick="eliminarproducto(this)">X</button>
               </td>
               <td style="display:none">
                   <input type="text" name="idp[]" style="display:none"
                   value="`+
                        $(linea).find("td:eq(0)").text()+
                   `"/>`+	
                        $(linea).find("td:eq(0)").text()+
               `</td>
               <td>`+
                        $(linea).find("td:eq(1)").text()+
               `</td>
               <td>`+
                        $(linea).find("td:eq(2)").text()+
               `</td>
               <td>
                  <input type="number" value="1" name="cant[]" id="cantidad" "/>
               </td>
               <td>
                   
                  <input type="number" value="1" name="precio[]" id="precio" "/></td>
               
               </tr>`;
            $("#productosentrada").append(l);
        }
       
    }
    

    //funcion para eliminar linea de detalle de ventas
    function eliminarproducto(boton){
        $(boton).closest('tr').remove();
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
    
    
    //Función para validar por Keypress
    function validarkeypress(er,e){
        
        key = e.keyCode;
        
        
        tecla = String.fromCharCode(key);
        
        
        a = er.test(tecla);
        
        if(!a){
        
            e.preventDefault();
        }
        
        
    }
    //Función para validar por keyup
    function validarkeyup(er,etiqueta,etiquetamensaje,
    mensaje){
        a = er.test(etiqueta.val());
       
        if(a){
            etiquetamensaje.text("");
            return 1;
        }
        else{
            etiquetamensaje.text(mensaje);
            return 0;
        }
    }
    
    
    
    
    function enviaAjax(datos){
        
        $.ajax({
            async: true,
                url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
                type: 'POST',//tipo de envio 
                contentType: false,
                data: datos,
                processData: false,
                cache: false,
                beforeSend: function(){
                    //pasa antes de enviar pueden colocar un loader
                    

                },
                timeout:10000, //tiempo maximo de espera por la respuesta del servidor
                success: function(respuesta) {//si resulto exitosa la transmision
                    
                    try{
                
                    var lee = JSON.parse(respuesta);	
                    console.log(lee.resultado);
                    
                    if(lee.resultado=='listadoproductos'){
                        
                        $('#listadoproductos').html(lee.mensaje);
                    }
                    else if(lee.resultado=='registrar'){
                       
                        muestraMensaje('info', 4000,'REGISTRAR', lee.mensaje);
                  
                        limpia();
                    }else if (lee.resultado == "encontro") {		
                        if (lee.mensaje == 'El numero de factura ya existe!') {
                            muestraMensaje('info', 4000,'Atencion', lee.mensaje);
                        }		
                    }else if(lee.resultado=='error'){
                        muestraMensaje('info', 4000,'Error',lee.mensaje);
                    }
                    
                }
                catch(e){
                    alert("Error en JSON "+e.name+" !!!");
                }
                  //cuanto termina el proceso ocultan el loader
                  
                },
                error: function(request, status, err){
                    
                    
                    if (status == "timeout") {
                        //pasa cuando superan los 10000 10 segundos de timeout
                        muestraMensaje("Servidor ocupado, intente de nuevo");
                    } else {
                        //cuando ocurreo otro error con ajax
                        muestraMensaje("ERROR: <br/>" + request + status + err);
                    }
                },
                complete: function(){
                
                }
                
            });
    
    
        
    }
    function limpia(){
        $("#numfactura").val('');
        $("#empleado").val("disabled");
        $("#proveedor").val("disabled");
        $("#codigoproducto").val('');
        $("#productosentrada tr").remove();
        
        }