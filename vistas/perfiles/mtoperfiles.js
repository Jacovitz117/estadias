
var tabla;

function initPerfil()
{
	$("#perfiles_form").on("submit",function(e){
		guardaryeditar_perfil(e);
	});
} 


$(document).ready(function(){ 
    tabla=$('#perfiles_data').dataTable({
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
            url: 'controladores/perfiles.php?op=listar',
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
            "sZeroRecords":    "No se encontraron resultados",
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


function guardaryeditar_perfil(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#perfiles_form")[0]);
	$.ajax({
		url: "controladores/perfiles.php?op=guardaryeditar",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#perfiles_form")[0].reset();
			$("#modalperfiles").modal('hide');
			$("#perfiles_data").DataTable().ajax.reload();
			toastr["success"]("El perfil se registró correctamente", "Exito")
			// swal.fire('Registro !!!','Se registró correctamente.','success')
		},
		error: function(error)
		{
			toastr["danger"]("El perfil no se pudo registrar", "Error")
		}
	});
}

function editarPerfil(id)
{	
	$('#mdltitulo').html('Editar Perfil');
	$.post("controladores/perfiles.php?op=mostrar",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);		
		$('#txtIdPerfil').val(data.id);
		$('#txtNombre').val(data.nombre);
		$('#txtApellido').val(data.apellidos);
		$('#txtUsuario').val(data.usuario);
		$('#txtCorreo').val(data.correo);
		$('#txtContrasena').val(data.contrasena);
		$('#txtPrivilegio').val(data.privilegio);

	})
	$("#modalperfiles").modal("show");
}

function eliminarPerfil(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar el perfil ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("controladores/perfiles.php?op=eliminar",{id:id},function(data){
			$('#perfiles_data').DataTable().ajax.reload();
			toastr["warning"]("El perfil se eliminó correctamente", "Exito")	
			});
			// Manda actualizar el datatable
			//$('#categoria_data').DataTable().ajax.reload();
			// toastr["danger"]("El perfil se eliminó correctamente", "Exito")
			// swal.fire('Eliminado !!!','El registro se eliminó correctamente.','success')
		}
	});
}

$(document).on("click","#btnNuevoUsuario", function(){
	$("#mdltitulo").html("Nuevo Perfil");
	$("#txtid").val("");
	$("#modalperfiles").modal("show");
	$("#perfiles_form")[0].reset();
});

initPerfil();