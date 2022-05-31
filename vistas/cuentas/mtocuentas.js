
var tabla;

function initCuenta()
{
	$("#cuentas_form").on("submit",function(e){
		guardaryeditarCuenta(e);
	});
} 
 

$(document).ready(function(){ 
    tabla=$('#cuentas_data').dataTable({
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
            url: 'controladores/cuentas.php?op=listar',
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
            "sZeroRecords":    "No se encontraron cuentas",
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


function guardaryeditarCuenta(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#cuentas_form")[0]);
	$.ajax({
		url: "controladores/cuentas.php?op=guardaryeditar",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#cuentas_form")[0].reset();
			$("#modalcuentas").modal('hide');
			$("#cuentas_data").DataTable().ajax.reload();
			toastr["success"]("La Cuenta se registró correctamente", "Exito")
			// swal.fire('Registro !!!','Se registró correctamente.','success')
		},
		error: function(error)
		{
			toastr["danger"]("La Cuenta no se pudo registrar", "Error")
		}
	});
}

function editarCuenta(id)
{	
	$('#mdltitulo').html('Editar Cuenta');
	$.post("controladores/cuentas.php?op=mostrar",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);		
		$('#txtIdCuen').val(data.id_cuen);
		$('#txtNumeroCuen').val(data.numero_cuen)
		$('#txtNombreCuen').val(data.nombre_cuen);
		$('#txtDescripcionCuen').val(data.descripcion_cuen);

	})
	$("#modalcuentas").modal("show");
}

function eliminarCuenta(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar esta Cuenta ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("controladores/cuentas.php?op=eliminar",{id:id},function(data){
			$('#cuentas_data').DataTable().ajax.reload();
			toastr["warning"]("La Cuenta se eliminó correctamente", "Exito")	
			});
			// Manda actualizar el datatable
			//$('#categoria_data').DataTable().ajax.reload();
			// toastr["danger"]("El perfil se eliminó correctamente", "Exito")
			// swal.fire('Eliminado !!!','El registro se eliminó correctamente.','success')
		}
	});
}

$(document).on("click","#btnNuevaCuenta", function(){
	$("#mdltitulo").html("Nueva Cuenta");
	$("#txtidCuen").val("");
	$("#modalcuentas").modal("show");
	$("#cuentas_form")[0].reset();
});

initCuenta();