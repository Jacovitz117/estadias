
var tabla;

function initProducto()
{
	$("#productos_form").on("submit",function(e){
		guardaryeditarProducto(e);
	});
} 


$(document).ready(function(){ 
    tabla=$('#productos_data').dataTable({
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
            url: 'controladores/productos.php?op=listar',
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
            "sZeroRecords":    "No se encontraron productos",
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


function guardaryeditarProducto(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#productos_form")[0]);
	$.ajax({
		url: "controladores/productos.php?op=guardaryeditar",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#productos_form")[0].reset();
			$("#modalproductos").modal('hide');
			$("#productos_data").DataTable().ajax.reload();
			toastr["success"]("El Producto se registró correctamente", "Exito")
			// swal.fire('Registro !!!','Se registró correctamente.','success')
		},
		error: function(error)
		{
			toastr["danger"]("El Producto no se pudo registrar", "Error")
		}
	});
}

function editarProducto(id)
{	 
	$('#mdltitulo').html('Editar Producto');
	$.post("controladores/productos.php?op=mostrar",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);		
		$('#txtIdProd').val(data.id_prod);
		$('#txtNombreProd').val(data.nombre_prod);
		$('#txtStockMinimoProd').val(data.stock_minimo_prod);

	})
	$("#modalproductos").modal("show");
}

function eliminarProducto(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar el Producto ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No", 
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("controladores/productos.php?op=eliminar",{id:id},function(data){
			$('#productos_data').DataTable().ajax.reload();
			toastr["warning"]("El Producto se eliminó correctamente", "Exito")	
			});
			// Manda actualizar el datatable
			//$('#categoria_data').DataTable().ajax.reload();
			// toastr["danger"]("El perfil se eliminó correctamente", "Exito")
			// swal.fire('Eliminado !!!','El registro se eliminó correctamente.','success')
		}
	});
}

$(document).on("click","#btnNuevoProducto", function(){
	$("#mdltitulo").html("Nuevo Departameno");
	$("#txtidProd").val("");
	$("#modalproductos").modal("show");
	$("#productos_form")[0].reset();
});

initProducto();