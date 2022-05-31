
var tabla;

function initDepartamento()
{
	$("#departamentos_form").on("submit",function(e){
		guardaryeditarDepartamento(e);
	});
} 


$(document).ready(function(){ 
    tabla=$('#departamentos_data').dataTable({
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
            url: 'controladores/departamentos.php?op=listar',
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
            "sZeroRecords":    "No se encontraron departamentos",
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


function guardaryeditarDepartamento(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#departamentos_form")[0]);
	$.ajax({
		url: "controladores/departamentos.php?op=guardaryeditar",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#departamentos_form")[0].reset();
			$("#modaldepartamentos").modal('hide');
			$("#departamentos_data").DataTable().ajax.reload();
			toastr["success"]("El Departamento se registró correctamente", "Exito")
			// swal.fire('Registro !!!','Se registró correctamente.','success')
		},
		error: function(error)
		{
			toastr["danger"]("El Departamento no se pudo registrar", "Error")
		}
	});
}

function editarDepartamento(id)
{	
	$('#mdltitulo').html('Editar Departamento');
	$.post("controladores/departamentos.php?op=mostrar",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);		
		$('#txtIdDep').val(data.id_dep);
		$('#txtNombreDep').val(data.nombre_dep);
		$('#txtEncargadoDep').val(data.encargado_dep);

	})
	$("#modaldepartamentos").modal("show");
}

function eliminarDepartamento(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar el Departamento ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("controladores/departamentos.php?op=eliminar",{id:id},function(data){
			$('#departamentos_data').DataTable().ajax.reload();
			toastr["warning"]("El Departamento se eliminó correctamente", "Exito")	
			});
			// Manda actualizar el datatable
			//$('#categoria_data').DataTable().ajax.reload();
			// toastr["danger"]("El perfil se eliminó correctamente", "Exito")
			// swal.fire('Eliminado !!!','El registro se eliminó correctamente.','success')
		}
	});
}

$(document).on("click","#btnNuevoDepartamento", function(){
	$("#mdltitulo").html("Nuevo Departameno");
	$("#txtidDep").val("");
	$("#modaldepartamentos").modal("show");
	$("#departamentos_form")[0].reset();
});

initDepartamento();