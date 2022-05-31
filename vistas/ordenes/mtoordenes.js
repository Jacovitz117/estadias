
var tabla;

function initOrden()
{
	$("#ordenes_form").on("submit",function(e){
		guardaryeditarOrden(e);
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


function guardaryeditarOrden(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#ordenes_form")[0]);
	$.ajax({
		url: "controladores/ordenes.php?op=guardaryeditar",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#ordenes_form")[0].reset();
			$("#modalordenes").modal('hide');
			$('#ordenes_data').DataTable().ajax.reload();
			toastr["success"]("La Orden de Compra se registró correctamente", "Exito")
			// swal.fire('Registro !!!','Se registró correctamente.','success')
		},
		error: function(error)
		{
			toastr["danger"]("La Orden de Compra no se pudo registrar", "Error")
		}
	});
}

function editarOrden(id)
{	
	$('#mdltitulo').html('Editar Orden de Compra');
	$.post("controladores/ordenes.php?op=mostrar",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);		
		$('#txtIdOr').val(data.id_orden);
		$('#txtNumOrdenOr').val(data.numero_orden);
		$('#txtNumReqOr').val(data.numero_req_orden);
		$('#txtProvOr').val(data.id_prov_orden);
		$('#txtDepOr').val(data.id_dep_orden);

	})
	$("#modalordenes").modal("show");
	TraerProveedor();
	TraerDepartamento();
}

function eliminarOrden(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar la Orden de Compra ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("controladores/ordenes.php?op=eliminar",{id:id},function(data){
			$('#ordenes_data').DataTable().ajax.reload();
			toastr["warning"]("La Orden de Compra se eliminó correctamente", "Exito")	
			});
		}
	});
}

function TraerProveedor()
{
	$.ajax({
		url: 'controladores/ordenes.php?op=traer_proveedor',
		type: 'POST',
		beforeSend: function () { },
		success: function (response) {
			console.log(response)
			$("#listaproveedor").html(response);
		},
		error:function () {
			alert("error")
		}
	});
}

function TraerDepartamento()
{
	$.ajax({
		url: 'controladores/ordenes.php?op=traer_departamento',
		type: 'POST',
		beforeSend: function () { },
		success: function (response) {
			console.log(response)
			$("#listadepartamentos").html(response);
		},
		error:function () {
			alert("error")
		}
	});
}

$(document).on("click","#btnNuevaOrden", function(){
	$("#mdltitulo").html("Nueva Orden de Compra");
	$("#txtIdOr").val("");
	$("#modalordenes").modal("show");
	$("#ordenes_form")[0].reset();
	TraerProveedor();
	TraerDepartamento();
});






initOrden();