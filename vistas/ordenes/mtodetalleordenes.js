var tabla;

function initDetalleOrden()
{
	$("#detalleordenes_form").on("submit",function(e){
		guardaryeditarDetalleOrden(e);
		$("#detalleordenes_form")[0].reset();
		$("#txtIdCuenDet").val('0');
		$("#txtIdSubCuenDet").val('0');
		$("#txtProdDet").val('0');
		$("#txtUniDet").val('0');
	});
} 


$(document).ready(function(){ 
    tabla=$('#ordenes_data').dataTable({
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
        "ajax":{
            url: 'controladores/ordenes.php?op=listar',
            type : "get",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);	
            }
        },
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)
	    "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron ordenes de compra",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
		}
	}).DataTable();
});

function LlenarDetalleOrden1(id)
{
	$('#mdltitulo').html('Llenar productos en Orden de Compra');
	$('#txtIdOrDet').val(id);
	$("#modaldetalleordenes").modal("show");
	TraerCuenta();
	TraerSubCuenta();
	TraerProducto();
	TraerUnidad();

}

function guardaryeditarDetalleOrden(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#detalleordenes_form")[0]);
	$.ajax({
		url: "controladores/ordenes.php?op=insertar_detalle",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#detalleordenes_form")[0].reset();
			$("#modaldetalleordenes").modal('hide');
			// $('#ordenes_data').DataTable().ajax.reload();
			window.location.reload();
			toastr["success"]("La Orden de Compra se actualizo correctamente", "Exito")
		},
		error: function(error)
		{
			toastr["danger"]("La Orden de Compra no se pudo actualizar", "Error")
		}
	});
}


function TraerOdenCompra()
{
	$.ajax({
		url: 'controladores/ordenes.php?op=traer_orden',
		type: 'POST',
		beforeSend: function () { },
		success: function (response) {
			console.log(response)
			$("#listaorden").html(response);
		},
		error:function () {
			alert("error")
		}
	});
}

// function TraerCuenta(){

// 	$('#txtIdCuenDet').select2({
// 		ajax: {
// 		  url: 'controladores/ordenes.php?op=traer_cuenta',
// 		  processResults: function (data) {
// 			// Transforms the top-level key of the response object from 'items' to 'results'
// 			return {
// 			  results: data.items
// 			};
// 		  }
// 		}
// 	  });
	
	// $.ajax({
	// 	type: 'GET',
	// 	url: 'controladores/ordenes.php?op=traer_cuenta',
	// 	success: function(response){
	// 		$.each(response, function(indice,fila){
	// 			$('#txtIdCuenDet').append("<option value="+indice.id_cuen+">"+fila.numero_cuen+" "+fila.nombre_cuen+"</option>");
	// 		});
	// 		$('#txtIdCuenDet').select2();
	// 	}
	// });
// }

function TraerCuenta()
{
	$.ajax({
		url: 'controladores/ordenes.php?op=traer_cuenta',
		type: 'POST',
		beforeSend: function () { },
		success: function (response) {
			console.log(response)
			$("#listacuentas").html(response);
		},
		error:function () {
			alert("error")
		}
	});
}

function TraerSubCuenta()
{
	$.ajax({
		url: 'controladores/ordenes.php?op=traer_subcuenta',
		type: 'POST',
		beforeSend: function () { },
		success: function (response) {
			console.log(response)
			$("#listasubcuentas").html(response);
		},
		error:function () {
			alert("error")
		}
	});
}

function TraerProducto()
{
	$.ajax({
		url: 'controladores/ordenes.php?op=traer_producto',
		type: 'POST',
		beforeSend: function () { },
		success: function (response) {
			console.log(response)
			$("#listaproductos").html(response);
		},
		error:function () {
			alert("error")
		}
	});
}

function TraerUnidad()
{
	$.ajax({
		url: 'controladores/ordenes.php?op=traer_unidad',
		type: 'POST',
		beforeSend: function () { },
		success: function (response) {
			console.log(response)
			$("#listaunidades").html(response);
		},
		error:function () {
			alert("error")
		}
	});
}
 
function pdf(id){
	$.ajax({  
		type: 'POST', 
		url: 'pdforden.php',  
		data: { 'id':id,},
		success: function(data) {
			// redirect to the generated pdf file
			window.location = 'pdforden.php';
		}
	});
}

$(document).on("click","#btnLlenarDetalleOrden", function(){
	$("#mdltitulodetalle").html("Añadir Productos Orden de Compra");
	$("#txtIdOr").val("");
	$("#modaldetalleordenes").modal("show");
	$("#detalleordenes_form")[0].reset();
	// $("#txtIdCuenDet").val('0');
	// $("#txtIdSubCuenDet").val('0');
	// $("#txtProdDet").val('0');
	// $("#txtUniDet").val('0');
});






initDetalleOrden();


