
var tabla;
  
function initProveedor()
{
	$("#proveedores_form").on("submit",function(e){
		guardaryeditarProveedor(e);
	});
} 


$(document).ready(function(){ 
    tabla=$('#proveedores_data').dataTable({
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
            url: 'controladores/proveedores.php?op=listar',
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
            "sZeroRecords":    "No se encontraron proveedores",
            "sEmptyTable":     "Ningún dato disponible de los proveedores",
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


function guardaryeditarProveedor(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#proveedores_form")[0]);
	$.ajax({
		url: "controladores/proveedores.php?op=guardaryeditar",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#proveedores_form")[0].reset();
			$("#modalproveedores").modal('hide');
			$("#proveedores_data").DataTable().ajax.reload();
			toastr["success"]("El Proveedor se registró correctamente", "Exito")
			// swal.fire('Registro !!!','Se registró correctamente.','success')
		},
		error: function(error)
		{
			toastr["danger"]("El proveedor no se pudo registrar", "Error")
		}
	});
}

function editarProveedor(id)
{	
	$('#mdltitulo').html('Editar Proveedor');
	$.post("controladores/proveedores.php?op=mostrar",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);		
		$('#txtIdProv').val(data.id_prov);
		$('#txtNombreProv').val(data.nombre_prov);
		$('#txtEmpresaProv').val(data.empresa_prov);
		$('#txtCorreoProv').val(data.correo_prov);
		$('#txtTelefonoProv').val(data.telefono_prov);
		$('#txtDireccionProv').val(data.direccion_prov);
		$('#txtIvaProv').val(data.iva_prov);

	})
	$("#modalproveedores").modal("show");
}

function eliminarProveedor(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar este Proveedor ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("controladores/proveedores.php?op=eliminar",{id:id},function(data){
			$('#proveedores_data').DataTable().ajax.reload();
			toastr["warning"]("El Proveedor se eliminó correctamente", "Exito")	
			});
			// Manda actualizar el datatable
			//$('#categoria_data').DataTable().ajax.reload();
			// toastr["danger"]("El perfil se eliminó correctamente", "Exito")
			// swal.fire('Eliminado !!!','El registro se eliminó correctamente.','success')
		}
	});
}

$(document).on("click","#btnNuevoProveedor", function(){
	$("#mdltitulo").html("Nuevo Proveedor");
	$("#txtidProv").val("");
	$("#modalproveedores").modal("show");
	$("#proveedores_form")[0].reset();
});

initProveedor();