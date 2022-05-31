
var tabla;

function ListarPED(id)
{ 
	$("#modalPED").modal("show");
	$(document).ready(function(){ 
		tabla=$('#PED_data').dataTable({
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
				url: 'controladores/ordenes.php?op=listar_PED',
				data : { 'id' : id },
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
				"sZeroRecords":    "No se encontraron Productos en esta Orden de Compra",
				"sEmptyTable":     "Ningún Producto ha sido agregado a esta Orden de Compra",
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
} 


function eliminarDetalleOrden(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar el producto de la Orden de Compra ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("controladores/ordenes.php?op=eliminar_prod_detalle",{id:id},function(data){
			$('#PED_data').DataTable().ajax.reload();
			toastr["warning"]("El Producto se borro Orden de Compra se eliminó correctamente", "Exito")	
			});
		}
	});
}



