$(document).ready(function(){

	if($.trim($("#mensajes").text()) != ""){
		muestraMensaje($("#mensajes").html());
	}
		
	//////////////////////////////VALIDACIONES/////////////////////////////////////
	
		$("#codProducto").on("keypress",function(e){
			validarkeypress(/^[0-9-\b]*$/,e);
		});
		
		$("#codProducto").on("keyup",function(){
			validarkeyup(/^[0-9]{4,10}$/,$(this),
			$("#scodProducto"),"El formato no puede estar vacío y no puede conter más de 10 carácteres");
			if($("#codProducto").val().length <= 10){
			  var datos = new FormData();
				datos.append('accion','consultatr');
				datos.append('codProducto',$(this).val());
				enviaAjax(datos,'consultatr');	
			}
		});
	
		$("#nombreProducto").on("keypress",function(e){
			validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
		});
		
		$("#nombreProducto").on("keyup",function(){
			validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, 
			$(this), $("#snombreProducto"), "Se debe llenar este campo y debe tener un máximo de 30 carácteres");
		});
	
		$("#precio").on("keypress",function(e){
			validarkeypress(/^[0-9-\b]*$/,e);
		});
		
		$("#precio").on("keyup",function(){
			validarkeyup(/^[1-9]{0,10}$/,$(this),
			$("#sprecio"),"No debe haber cantidades negativas / menores a cero");
		});

		$("#descProducto").on("keypress",function(e){
			validarkeypress(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]*$/,e);
		});
		
		$("#descProducto").on("keyup",function(){
			validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
			$(this),$("#sdescProducto"),"Se debe llenar este campo y debe tener un máximo de 200 carácteres");
		});

		
	
	//////////////////////////////BOTONES/////////////////////////////////////
		
	$("#incluir").on("click",function(){
		if(validarenvio()){
				var datos = new FormData();
				datos.append('accion','incluir');
				datos.append('codProducto',$("#codProducto").val());
				datos.append('precio',$("#precio").val());
				datos.append('nombreProducto',$("#nombreProducto").val());
				datos.append('descProducto',$("#descProducto").val());
				datos.append('categoria',$("#categoria").val());

				enviaAjax(datos);
				limpia();
		}
	});

	$("#incluirCategoria").on("click",function(){
				var datos = new FormData();
				datos.append('accionCategoria','incluirCategoria');
				datos.append('nombreCategoria',$("#nombreCategoria").val());
				enviaAjax(datos);
				limpiaCategoria();
	});
	
	
	$("#modificar").on("click",function(){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','modificar');
			datos.append('codProducto',$("#codProducto").val());
			datos.append('precio',$("#precio").val());
			datos.append('nombreProducto',$("#nombreProducto").val());
			datos.append('descProducto',$("#descProducto").val());
			datos.append('categoria',$("#categoria").val());
	 
			enviaAjax(datos);
			limpia();
		}
	});

	$("#eliminar").on("click",function(){
		if(validarkeyup(/^[0-9]{8,10}$/,$("#codProducto"),
			$("#scodProducto"),"El formato no debe pasar de los 10 carácteres")==0){
			muestraMensaje("La codigo del Producto debe coincidir con el formato <br/>"+ 
						"máximo 10 carácteres, ni tener cantidades negativas");	
			
		}
		else{	
			var datos = new FormData();
			datos.append('accion','eliminar');
			datos.append('codProducto',$("#codProducto").val());
			datos.append('precio',$("#precio").val());
			datos.append('nombreProducto',$("#nombreProducto").val());
			datos.append('descProducto',$("#descProducto").val());
			datos.append('categoria',$("#categoria").val());
	
			enviaAjax(datos);
			limpia();
		}
		
	});

	$("#eliminarCategoria").on("click",function(){
	if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/, $("#nombreCategoria"),
	$("#nombreCategoria"),"El formato no puede estar vacío")==0){
	muestraMensaje("El formato no puede estar vacío");	
			
	}
	else{	
		var datos = new FormData();
		datos.append('accionCategoria','eliminarCategoria');
		datos.append('nombreCategoria',$("#nombreCategoria").val());
	
		enviaAjax(datos);
		limpiaCategoria();
	}
		
	});
	
	$("#consultar").on("click",function(){
		var datos = new FormData();
		datos.append('accion','consultar');
		enviaAjax(datos);
	});
	
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
	function muestraMensaje(mensaje){
		
		$("#contenidodemodal").html(mensaje);
				$("#mostrarmodal").modal("show");
				setTimeout(function() {
						$("#mostrarmodal").modal("hide");
				},5000);
	}
	

	function validarenvio(){
		if(validarkeyup(/^[0-9]{4,10}$/,$("#codProducto"),
			$("#scodProducto"),"El formato no debe pasar de los 10 carácteres")==0){
			muestraMensaje("El codigo del Producto debe coincidir con el formato <br/>"+ 
							"máximo 10 carácteres, ni tener cantidades negativas");	
			return false;					
		}	
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{0,10}$/,
			$("#precio"),$("#sprecio"),"Solo numeros y/o # - sin cantidades negativas / menores a cero")==0){
			muestraMensaje("El último precio del Producto <br/>Solo numeros y # - sin cantidades negativas / menores a cero");
			return false;
		}
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,30}$/,
			$("#nombreProducto"),$("#snombreProducto"),"No debe contener más de 30 carácteres")==0){
			muestraMensaje("El nombre del Producto <br/> No debe contener más de 30 carácteres");
			return false;
		}
		else if(validarkeyup(/^[A-Za-z0-9,#\b\s\u00f1\u00d1\u00E0-\u00FC-]{1,200}$/,
			$("#descProducto"),$("#sdescProducto"),"No debe contener más de 200 carácteres")==0){
			muestraMensaje("La descripción del Producto <br/> No debe contener más de 200 carácteres");
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
		$("#codProducto").val($(linea).find("td:eq(0)").text());
		$("#nombreProducto").val($(linea).find("td:eq(1)").text());
		$("#precio").val($(linea).find("td:eq(2)").text());
		$("#descProducto").val($(linea).find("td:eq(3)").text());

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
					} else if(lee.resultado == "incluirCategoria" ||
						lee.resultado == "eliminarCategoria"){
							console.log("Entrando en el bloque de incluir/eliminar categoría"); // Añade esta línea
						muestraMensaje(lee.mensaje);
						limpiaCategoria();
					} else if (lee.resultado == "encontro") {
						$("#codProducto").val(lee.mensaje[0][1]);
						$("#nombreProducto").val(lee.mensaje[0][2]);
						$("#precio").val(lee.mensaje[0][3]);
						$("#descProducto").val(lee.mensaje[0][4]);
						$("#categoria").val(lee.mensaje[0][5]);
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
		
		$("#codProducto").val('');
		$("#nombreProducto").val('');
		$("#precio").val('');
		$("#descProducto").val('');
		$("#categoria").val('1');
		
	}

	function limpiaCategoria(){
		$("#nombreCategoria").val('');
	}
	
	