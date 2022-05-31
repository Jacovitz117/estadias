
var tabla;

function initSubCuenta()
{
	$("#subcuentas_form").on("submit",function(e){
		guardaryeditarSubCuenta(e);
	});
} 
 

$(document).ready(function(){ 
    tabla=$('#subcuentas_data').dataTable({
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
            url: 'controladores/subcuentas.php?op=listar',
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
            "sZeroRecords":    "No se encontraron Sub-Cuentas",
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


function guardaryeditarSubCuenta(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#subcuentas_form")[0]);
	$.ajax({
		url: "controladores/subcuentas.php?op=guardaryeditar",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#subcuentas_form")[0].reset();
			$("#modalsubcuentas").modal('hide');
			$("#subcuentas_data").DataTable().ajax.reload();
			toastr["success"]("La Sub-Cuenta se registró correctamente", "Exito")
			// swal.fire('Registro !!!','Se registró correctamente.','success')
		},
		error: function(error)
		{
			toastr["danger"]("La Sub-Cuenta no se pudo registrar", "Error")
		}
	});
}

function editarSubCuenta(id)
{	
	$('#mdltitulo').html('Editar Cuenta');
	$.post("controladores/subcuentas.php?op=mostrar",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);		
		$('#txtIdSubCuen').val(data.id_sub);
		$('#txtNumeroSubCuen').val(data.numero_sub)
		$('#txtNombreSubCuen').val(data.nombre_sub);
		$('#txtDescripcionSubCuen').val(data.descripcion_sub);
		$('#txtIdCuenta').val(data.id_cuenta);

	})
	$("#modalsubcuentas").modal("show");
	TraerCuentas();
}

function eliminarSubCuenta(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar esta Sub-Cuenta ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("controladores/subcuentas.php?op=eliminar",{id:id},function(data){
			$('#subcuentas_data').DataTable().ajax.reload();
			toastr["warning"]("La Cuenta se eliminó correctamente", "Exito")	
			});
			// Manda actualizar el datatable
			//$('#categoria_data').DataTable().ajax.reload();
			// toastr["danger"]("El perfil se eliminó correctamente", "Exito")
			// swal.fire('Eliminado !!!','El registro se eliminó correctamente.','success')
		}
	});
}

function TraerCuentas()
{

	$.ajax({
		
		url: 'controladores/subcuentas.php?op=traer_cuenta',
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

$(document).on("click","#btnNuevaSubCuenta", function(){
	$("#mdltitulo").html("Nueva Sub-Cuenta");
	$("#txtidSubCuen").val("");
	$("#modalsubcuentas").modal("show");
	$("#subcuentas_form")[0].reset();
	TraerCuentas();
});

$(document).on("change","#txtIdCuenta", function(){
	var id = $("#txtIdCuenta").val();
	console.log(id)
});

initSubCuenta();