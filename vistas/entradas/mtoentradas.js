let x = 0;

function es_vacio(){
	var campo1 = document.getElementById("busqueda").value;
	if(campo1 != ""){
	  document.getElementById("btnNuevaEntrada").removeAttribute('disabled');
	}
	else{
	  document.getElementById("btnNuevaEntrada").setAttribute('disabled', 'disabled');
	}
}; 


$(document).on('keyup','#busqueda', function(){
	

	var id = $("#busqueda").val();
	var idOrden;

$.get("controladores/entradas.php?op=buscar_orden",{'id':id},function(dataOrden){
		var dataO = JSON.parse(dataOrden);
		$('#idOrden').val(dataO.id_orden);
	});
	


});

$(document).on('click','#btnNuevaEntrada', function(){
	
	var idOrden = $('#idOrden').val();

$.post("controladores/entradas.php?op=crear_entrada",{'id':idOrden},function(dataEntrada){
		var data = JSON.parse(dataEntrada);
		console.log(data);
		sessionStorage.setItem('UltimaEntrada', data[0]);
	});
	


});
	
$(document).on("click","#btnBuscar", function(){


	var id = $('#busqueda').val();



	$.post("controladores/entradas.php?op=datos_entrada",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);

		// Crear Nuevo formularios
		const contenedor = document.getElementById('resultado');
		const contProd = document.createElement('div');
		const contComentBtn = document.createElement('div');
		const formFinal = document.createElement('form');
		const Comentario = document.createElement('div');
		const Insertar = document.createElement('div');
		


		// Declaracion de clases para los elementos creados
		const claseDivRow = 'row';
		const claseLabel = 'bmd-label-floating';
		const claseInput = 'form-control';
		const claseDivId = 'col-lg-1 form-group';
		const claseDivNomProd = 'col-lg-3 form-group';
		const claseDivUnidad = 'col-lg-3 form-group';
		const tipo = 'text';
		
		/* INICIO CREACION ELEMENTOS DEL BOTON INSERTAR */
	
		const BtnInsertar = document.createElement('button');
		// Creacion de elemetos por etiqueta
		const icono = document.createElement('i')
	
	
		// Declarar clase de BOTON
		BtnInsertar.setAttribute('class', 'btn btn-info btn-block');
		BtnInsertar.setAttribute('type', 'submit');
		BtnInsertar.setAttribute('id', 'txtBtnInsertar');
	
		// Declarar clase para el ICONO
		icono.setAttribute('class', 'fas fa-plus-circle');
	
	
		// Asignar 	texto a boton
		BtnInsertar.appendChild(icono)
		BtnInsertar.textContent = 'Añadir al Stock';
	
		// Concatenacion de elementos dentro del div de boton
		Insertar.setAttribute('class', 'col-lg-12')
		Insertar.appendChild(BtnInsertar);
	
	
		/* FIN CREACION ELEMENTOS DEL BOTON INSERTAR */



		/* INICIO CREACION ELEMENTOS DE LA CAJA DE COMENTARIOS */
	
		// Creacion de elemetos por etiqueta
		const Label = document.createElement('label');
		const taComentario = document.createElement('textarea');
	
	
		// Declarar clase de BOTON
		Label.setAttribute('class', 'bmd-label-floating');
		Label.textContent = 'Agrega un comentario a la Orden de Compra'
		taComentario.setAttribute('class', 'form-control');
		taComentario.setAttribute('name', 'txtComentario');
		taComentario.setAttribute('id', 'txtComentario');
		taComentario.setAttribute('cols', '30');
		taComentario.setAttribute('rows', '2');
	
	
		// Concatenacion de elementos dentro del div de boton
		Comentario.appendChild(Label);
		Comentario.appendChild(taComentario);
		Comentario.setAttribute('class', 'col-lg-12');
		

		contComentBtn.setAttribute('class', 'row-lg-12');
		contComentBtn.appendChild(Comentario);
		contComentBtn.appendChild(Insertar);
	
	
		/* FIN CREACION ELEMENTOS DE LA CAJA DE COMENTARIOS */


		for (const producto of data) {
		x++;

	
		// DECLARAR creación de FORMULARIO Y DE DIVROW
		const formulario = document.createElement('form');
		const divRow = document.createElement('div');
		const tituloProd = document.createElement('p');
		const divisor = document.createElement('hr');
	
	
		// DECLARAR CLASES PARA FORMULARIO Y PARA DIVROW
		divRow.setAttribute('class', claseDivRow);
		formulario.setAttribute('id', 'form_prod'+ x);
		tituloProd.textContent = 'Producto No. '+ x;


	
	
		/* INICIO CREACION ELEMENTOS DEL DATO ID DE PRODUCTO */
	
		// Creacion de elemetos por input
		const divIdProd = document.createElement('div');
		const labelIdProd = document.createElement('label');
		const inputIdProd = document.createElement('input');
	
		// Declarar clase para el DIV
		divIdProd.setAttribute('class', claseDivId);
		// Declarar clase de LABEL
		labelIdProd.setAttribute('class', claseLabel);
	
		// Declarar clase de INPUT
		inputIdProd.setAttribute('class', claseInput);
		inputIdProd.setAttribute('type', 'number');
		inputIdProd.setAttribute('readonly', true);
		inputIdProd.setAttribute('id', 'txtIdProd' + x);
		inputIdProd.setAttribute('name', 'txtIdProd');
	
		// Asignar valor de base de datos a label
		labelIdProd.textContent = 'Id de Producto';
	
		// Asignar valor de base de datos a input
		inputIdProd.value = producto.id_Producto;
	
		// Concatenacion de elementos dentro del div de input
	
		divIdProd.appendChild(labelIdProd);
		divIdProd.appendChild(inputIdProd);
		divIdProd.setAttribute('hidden', true);
	
		/* FIN CREACION ELEMENTOS DEL DATO ID DE PRODUCTO */
	
	
	
		/* INICIO CREACION ELEMENTOS DEL DATO ID DE ORDEN */
	
		// Creacion de elemetos por input
		const divIdOrden = document.createElement('div');
		const labelIdOrden = document.createElement('label');
		const inputIdOrden = document.createElement('input');
	
		// Declarar clase para el DIV
		divIdOrden.setAttribute('class', claseDivId);
		// Declarar clase de LABEL
		labelIdOrden.setAttribute('class', claseLabel);
	
		// Declarar clase de INPUT
		inputIdOrden.setAttribute('class', claseInput);
		inputIdOrden.setAttribute('type', 'number');
		inputIdOrden.setAttribute('readonly', true);
		inputIdOrden.setAttribute('id', 'txtIdOrden' + x);
		inputIdOrden.setAttribute('name', 'txtIdOrden');
		
	
		// Asignar valor de base de datos a label
		labelIdOrden.textContent = 'Id de Orden';
	
		// Asignar valor de base de datos a input
		inputIdOrden.value = producto.Id_Orden;
	
		// Concatenacion de elementos dentro del div de input
	
		divIdOrden.appendChild(labelIdOrden);
		divIdOrden.appendChild(inputIdOrden);
		divIdOrden.setAttribute('hidden', true);
	
		/* FIN CREACION ELEMENTOS DEL DATO ID DE ORDEN */
	
	
	
		/* INICIO CREACION ELEMENTOS DEL DATO NOMBRE DE PRODUCTO */
	
		// Creacion de elemetos por input
		const divNomProd = document.createElement('div');
		const labelNomProd = document.createElement('label');
		const inputNomProd = document.createElement('input');
	
		// Declarar clase para el DIV
		divNomProd.setAttribute('class', claseDivNomProd);
	
		// Declarar clase de LABEL
		labelNomProd.setAttribute('class', claseLabel);
	
		// Declarar clase de INPUT
		inputNomProd.setAttribute('class', claseInput);
		inputNomProd.setAttribute('type', tipo);
		inputNomProd.setAttribute('readonly', true);
		inputNomProd.setAttribute('id', 'txtNomProd' + x);
		inputNomProd.setAttribute('name', 'txtNomProd');
	
		// Asignar valor de base de datos a label
		labelNomProd.textContent = 'Nombre de Producto';
	
		// Asignar valor de base de datos a input
		inputNomProd.value = producto.Producto;
	
		// Concatenacion de elementos dentro del div de input
	
		divNomProd.appendChild(labelNomProd);
		divNomProd.appendChild(inputNomProd);
	
		/* FIN CREACION ELEMENTOS DEL DATO NOMBRE DE PRODUCTO */
	
	
	
	
		/* INICIO CREACION ELEMENTOS DEL DATO UNIDAD DEL PRODUCTO */
	
		// Creacion de elemetos por input
		const divUnidad = document.createElement('div');
		const labelUnidad = document.createElement('label');
		const inputUnidad = document.createElement('input');
		const inputIdUnidad = document.createElement('input');
		// const idEntrada = document.createElement('input');
	
		// Declarar clase para el DIV
		divUnidad.setAttribute('class', 'col-lg-1 form-group');
	
		// Declarar clase de LABEL
		labelUnidad.setAttribute('class', claseLabel);
	
		// Declarar clase de INPUT
		inputUnidad.setAttribute('class', claseInput);
		inputUnidad.setAttribute('type', tipo);
		inputUnidad.setAttribute('readonly', true);
		inputUnidad.setAttribute('id', 'txtUnidad'+ x);
		inputIdUnidad.setAttribute('name', 'txtUnidad');
		// idEntrada.setAttribute('name', 'txtEntrada');
		// idEntrada.setAttribute('id', "txtEntrada");
	
		// Asignar valor de base de datos a label
		labelUnidad.textContent = 'Unidad';
	
		// Asignar valor de base de datos a input
		inputUnidad.value = producto.Unidad;
		inputIdUnidad.value = producto.id_unidad;
		// idEntrada.value = Number(sessionStorage.getItem('UltimaEntrada'));
	
		// Concatenacion de elementos dentro del div de input
	
		divUnidad.appendChild(labelUnidad);
		divUnidad.appendChild(inputUnidad);
		divUnidad.appendChild(inputIdUnidad);
		// divUnidad.appendChild(idEntrada);
		divUnidad.setAttribute('hidden', true);
	
		/* FIN CREACION ELEMENTOS DEL DATO UNIDAD DEL PRODUCTO */
	
	
	
		/* INICIO CREACION ELEMENTOS DEL DATO CANTIDAD PEDIDA DEL PRODUCTO */
	
		// Creacion de elemetos por input
		const divCantPedida = document.createElement('div');
		const labelCantPedida = document.createElement('label');
		const inputCantPedida = document.createElement('input');
	
		// Declarar clase para el DIV
		divCantPedida.setAttribute('class', claseDivUnidad);
	
		// Declarar clase de LABEL
		labelCantPedida.setAttribute('class', claseLabel);
	
		// Declarar clase de INPUT
		inputCantPedida.setAttribute('class', claseInput);
		inputCantPedida.setAttribute('type', 'number');
		inputCantPedida.setAttribute('readonly', true);
		inputCantPedida.setAttribute('id', 'txtCantPed'+ x);
		inputCantPedida.setAttribute('name', 'txtCantPed');
	
		// Asignar valor de base de datos a label
		labelCantPedida.textContent = 'Cant. Pedida';
	
		// Asignar valor de base de datos a input
		inputCantPedida.value = producto.Cantidad;
	
		// Concatenacion de elementos dentro del div de input
	
		divCantPedida.appendChild(labelCantPedida);
		divCantPedida.appendChild(inputCantPedida);
	
		/* FIN CREACION ELEMENTOS DEL DATO CANTIDAD PEDIDA DEL PRODUCTO */
	
	
	
		/* INICIO CREACION ELEMENTOS DEL DATO CANTIDAD DEL PRODUCTO */
	
		// Creacion de elemetos por input
		const divCant = document.createElement('div');
		const labelCant = document.createElement('label');
		const inputCant = document.createElement('input');
	
		// Declarar clase para el DIV
		divCant.setAttribute('class', 'col-lg-3 form-group');
	
		// Declarar clase de LABEL
		labelCant.setAttribute('class', claseLabel);
	
		// Declarar clase de INPUT
		inputCant.setAttribute('class', claseInput);
		inputCant.setAttribute('type', 'number');
		inputCant.setAttribute('readonly', true);
		inputCant.setAttribute('id', 'txtCant'+ x);
		inputCant.setAttribute('name', 'txtCant');
	
		// Asignar valor de base de datos a label
		labelCant.textContent = 'Cantidad';
	
		// Asignar valor de base de datos a input
		inputCant.value = producto.Cantidad;
	
		// Concatenacion de elementos dentro del div de input
	
		divCant.appendChild(labelCant);
		divCant.appendChild(inputCant);
	
		/* FIN CREACION ELEMENTOS DEL DATO CANTIDAD DEL PRODUCTO */
	
	
	
	
	
		/* INICIO CREACION ELEMENTOS DEL DATO CANTIDAD PEDIDA DEL PRODUCTO */
	
		// Creacion de elemetos por input
		const divEstado = document.createElement('div');
		const labelEstado = document.createElement('label');
		const selectEstado = document.createElement('select');
	
		// Declarar clase para el DIV
		divEstado.setAttribute('class', 'col-lg-3 form-group');
	
		// Declarar clase de LABEL
		labelEstado.setAttribute('class', claseLabel);
	
		// Declarar clase de INPUT
		selectEstado.setAttribute('class', 'form-control');
		selectEstado.setAttribute('id', 'txtEstado'+ x);
		selectEstado.setAttribute('name', 'txtEstado');
	
	
		let option1 = document.createElement("option");
		let option1Texto = document.createTextNode("Seleccione una opción");
		option1.appendChild(option1Texto);
		option1.setAttribute('default', 'default');
	 
		let option2 = document.createElement("option");
		option2.setAttribute("value", "Completo");
		let option2Texto = document.createTextNode("Completo");
		option2.appendChild(option2Texto);
	 
		let option3 = document.createElement("option");
		option3.setAttribute("value", "Incompleto");
		let option3Texto = document.createTextNode("Incompleto");
		option3.appendChild(option3Texto);
	 
		selectEstado.appendChild(option1);
		selectEstado.appendChild(option2);
		selectEstado.appendChild(option3);
	
	
	
		// Asignar valor de base de datos a label
		labelEstado.textContent = 'Estado';
	
		// Asignar valor de base de datos a input
		// selectEstado.value = producto.CanPed;
	
		// Concatenacion de elementos dentro del div de input
	
		divEstado.appendChild(labelEstado);
		divEstado.appendChild(selectEstado);
	
		/* FIN CREACION ELEMENTOS DEL DATO CANTIDAD PEDIDA DEL PRODUCTO */
	
	
	
	
		
	
		
	
	
		// Concatenacion de DIV de Datos dentro del divRow
		divRow.appendChild(divIdProd);
		divRow.appendChild(divIdOrden);
		divRow.appendChild(divNomProd);
		divRow.appendChild(divUnidad);
		divRow.appendChild(divCantPedida);
		divRow.appendChild(divCant);
		divRow.appendChild(divEstado);
	
	
		// Concatenacion de divRow dentro de cormulario
		formulario.appendChild(tituloProd);
		formulario.appendChild(divRow);
		formulario.appendChild(divisor);
		contProd.appendChild(formulario);
		// contProd.appendChild(BtnInsertar);

	
	
		$(document).on("change",selectEstado, function(){
	
			if (selectEstado.value == 'Incompleto') {
				inputCant.removeAttribute('readonly');
			}
			if (selectEstado.value == 'Completo'){
				inputCant.setAttribute('readonly', true);
			}
		});	
	
	
	
		} contenedor.appendChild(contProd);
		  contenedor.appendChild(contComentBtn);
		  



		
	})
});


$(document).on("submit", '#form_prod2', function(e){
	e.preventDefault();
	insertarStock(e);
});


function insertarStock(e) 
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#form_prod2")[0]);
	$.ajax({
		url: "controladores/entradas.php?op=insertar_stock",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			// $("#form_prod1")[0].reset();
			// $('#txtBtnInsertar1').setAttribute('disabled', true);
			$('#txtBtnInsertar1').textContent = 'Agregado al Stock';
			toastr["success"]("El Producto se agrego correctamente al stock", "Exito")
		},
		error: function(error)
		{
			toastr["danger"]("El Producto se pudo agregar al stock", "Error")
		}
	});
}

