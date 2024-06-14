$(document).ready(function(){

	if($.trim($("#mensajes").text()) != ""){
		muestraMensaje($("#mensajes").html());
	}

	
	//////////////////////////////VALIDACIONES/////////////////////////////////////

		$("#nombreAlmacen").on("keypress",function(e){
		  	validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]*$/,e);
		});
		
		$("#nombreAlmacen").on("keyup",function(){
		validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]{1,30}$/,
			$("#snombreAlmacen"),"El formato no debe estar vacío y no debe conter más de 30 carácteres");
			if($("#nombreAlmacen").val().length <= 30){
			var datos = new FormData();
				datos.append('accion','consultatr');
				datos.append('nombreAlmacen',$(this).val());
				enviaAjax(datos,'consultatr');	
			}
		});
	
        $("#direccionAlmacen").on("keypress",function(e){
		  	validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]*$/,e);
        });
        
        $("#direccionAlmacen").on("keyup",function(){
		validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]{1,50}$/,
            $(this),$("#sdireccionAlmacen"),"El formato no debe estar vacío y no debe conter más de 50 carácteres");
        });
             
	
	//////////////////////////////BOTONES/////////////////////////////////////
		
	$("#incluir").on("click",function(){
        if(validarenvio()){
            var datos = new FormData();
            datos.append('accion','incluir');
            datos.append('nombreAlmacen',$("#nombreAlmacen").val());
            datos.append('direccionAlmacen',$("#direccionAlmacen").val());
	                    
            enviaAjax(datos);
            limpia();
        }
    });

	
	$("#modificar").on("click",function(){
		if(validarenvio()){
			var datos = new FormData();
            datos.append('accion','modificar');
            datos.append('nombreAlmacen',$("#nombreAlmacen").val());
            datos.append('direccionAlmacen',$("#direccionAlmacen").val());

			enviaAjax(datos);
			limpia();
		}
	});

	$("#eliminar").on("click",function(){
		if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]{1,30}$/,$("#nombreArea"),
		$("#snombreAlmacen"),"El formato no debe estar vacío y no debe conter más de 30 carácteres")==0){
	    muestraMensaje("El nombre del almacen no debe estar vacío <br/>"+ 
						"máximo 30 carácteres");	
		
	}
	else{	
		var datos = new FormData();
		datos.append('accion','eliminar');
		datos.append('nombreAlmacen',$("#nombreAlmacen").val());
        datos.append('direccionAlmacen',$("#direccionAlmacen").val());
	    
		enviaAjax(datos);
		limpia();
	}
		
	});

	$("#consultar").on("click",function(){
		var datos = new FormData();
		datos.append('accion','consultar');
		enviaAjax(datos);
	});
	
	});
		// Acciones de Categoria
	$("#incluirArea").on("click",function(){
		var datos = new FormData();
	//	var almacenSeleccionada = $("#almacen").val();

		if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, $("#nombreArea"),
		$("#snombreArea"),"El formato no debe estar vacío")==0){
		muestraMensaje("El formato no debe estar vacío");	
	    
	// }else if(almacenSeleccionada === null || almacenSeleccionada === "0" ){
             
	// 		muestraMensaje("Por favor, seleccione un almacen");
			
	// 
	}else{
			datos.append('accionArea','incluirArea');
			datos.append('nombreArea',$("#nombreArea").val());
			datos.append('almacen',$("#almacen").val());

			enviaAjax(datos);
			limpiaArea();
	}		
	});

	$("#eliminarArea").on("click",function(){
	if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, $("#nombreArea"),
	$("#snombreArea"),"El formato no puede estar vacío")==0){
	muestraMensaje("El formato no puede estar vacío");	
			
	}
	else{	
		var datos = new FormData();
		datos.append('accionArea','eliminarArea');
		datos.append('nombreArea',$("#nombreArea").val());
	    datos.append('almacen',$("#almacen").val());

		enviaAjax(datos);
		limpiaArea();
	}
		
	});
	
	//funcion para enlazar al DataTablet
	function destruyeDT(){
		//1 se destruye el datatablet
		if ($.fn.DataTable.isDataTable("#tablaproducto")) {
				$("#tablaproducto").DataTable().destroy();
		}
	}
	function crearDT(){
		//se crea nuevamente
		if (!$.fn.DataTable.isDataTable("#tablaproducto")) {
				$("#tablaproducto").DataTable({
				language: {
					lengthMenu: "Mostrar _MENU_ por página",
					zeroRecords: "No se encontraron productos",
					info: "Mostrando página _PAGE_ de _PAGES_",
					infoEmpty: "No hay productos registrados",
					infoFiltered: "(filtrado de _MAX_ registros totales)",
					search: "Buscar:",
					paginate: {
					first: "Primera",
					last: "Última",
					next: "Siguiente",
					previous: "Anterior",
					},
				},
				autoWidth: false,
				order: [[1, "asc"]],
				});
		}         
	}
	
	//////////////////////////////VALIDACIONES ANTES DEL ENVIO/////////////////////////////////////
	//Funcion que muestra el modal con un mensaje
	function muestraMensaje(mensaje) {
		$("#contenidodemodal").html(mensaje);
		$("#mostrarmodal").modal("show");
		setTimeout(function() {
			$("#mostrarmodal").modal("hide");
		}, 5000);
		// Cierra el modal de agregar categoría
		$("#agregarcategoria").modal("hide");
	}

	function validarenvio(){

	if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]{1,30}$/,
		$("#nombreAlmacen"),$("#snombreAlmacen"),"No debe contener más de 30 carácteres")==0){
		muestraMensaje("El nombre del almacen <br/>No debe contener más de 30 carácteres");
		return false;
	}else if(validarkeyup(/^[[A-Za-z0-9,\#\b\s\u00f1\u00d1\u00E0-\u00FC!@#$%^&*()\-_=+[\]{};:'",.<>/?\\|~`]{1,50}$/,
		$("#direccionAlmacen"),$("#sdireccionAlmacen"),"No debe contener más de 50 carácteres")==0){
		muestraMensaje("La direccion del almacen <br/>No debe contener más de 50 carácteres");
		return false;
	}
   
		return true;
	}
		
		
	
	
	

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

	
	function coloca(linea){
		$("#nombreAlmacen").val($(linea).find("td:eq(0)").text());
		$("#direccionAlmacen").val($(linea).find("td:eq(1)").text());
		
	}
	
	//////////////////////////////FUNCIONES AJAX/////////////////////////////////////
	
	function enviaAjax(datos) {
		$.ajax({
			async: true,
			url: "", // Aquí deberías poner la URL de tu servidor
			type: "POST",
			contentType: false,
			data: datos,
			processData: false,
			cache: false,
			beforeSend: function () {},
			timeout: 10000, // tiempo máximo de espera por la respuesta del servidor
			success: function (respuesta) {
				console.log("Respuesta del servidor:", respuesta);
				try {
				var lee = JSON.parse(respuesta);
					console.log("JSON parseado:", lee);
					console.log("Resultado:", lee.resultado); // Añade esta línea
	
					if (lee.resultado == "consultar") {
						destruyeDT();
						$("#resultadoconsulta").html(lee.mensaje);
						crearDT();
						$("#modal1").modal("show");	
					} else if(lee.resultado == "incluirArea" ||
						lee.resultado == "eliminarArea"){
						muestraMensaje(lee.mensaje);
						limpiaArea();
					} else if (lee.resultado == "encontro") {
						$("#nombreAlmacen").val(lee.mensaje[0][0]);
						$("#direccionAlmacen").val(lee.mensaje[0][1]);
						
					} else if (lee.resultado == "incluir" ||
						lee.resultado == "modificar" ||
						lee.resultado == "eliminar") {
						muestraMensaje(lee.mensaje);
						limpia();
					}  else if (lee.resultado == "error") {
						muestraMensaje(lee.mensaje);
					}
				} catch (e) {
					console.error("Error en JSON:", e);
					console.error("Respuesta del servidor:", respuesta);
					alert("Error en JSON: " + e.message);
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
	
	function limpia(){ 
		$("#nombreAlmacen").val('');
		$("#direccionAlmacen").val('');
				
	}	

	function limpiaArea(){
		$("#nombreArea").val('');
		$("#almacen").val('disabled');
	}
	
	