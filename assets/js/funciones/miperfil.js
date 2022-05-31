$(document).ready(function(){


    var id = $('#idUsuario').val()
      $.ajax({
        type: 'GET',
        url: 'controladores/traer_datos_usuario.php',
        data: {'id': id},
        beforeSend: function(){
          $('#contenedorDatosUsuario').html('')
        }
      })
      .done(function(resultado){
        $('#contenedorDatosUsuario').html(resultado)
      })

  })


  


function initFoto()
{
	$("#FotoPerfiles_form").on("submit",function(e){
		guardaryeditar_FotoPerfil(e);
	});
} 


function guardaryeditar_FotoPerfil(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#FotoPerfiles_form")[0]);
	$.ajax({
		url: "controladores/perfiles.php?op=actualizarfoto",
		type: "POST", 
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			console.log(datos);
			$("#FotoPerfiles_form")[0].reset();
			$("#modalFotoPerfil").modal('hide');
			toastr["success"]("La Foto de perfil se actualizo correctamente", "Exito")
			// swal.fire('Registro !!!','Se registró correctamente.','success')
		}
	});
}


function eliminarFotoPerfil(id)
{
	swal.fire({
		title: "Alerta",
		text: "¿ Estas seguro de eliminar la foto de perfil ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
      var id = $("#idUsuario").val()
			// Envia un post a la pagina de productos
			$.post("controladores/perfiles.php?op=eliminarfoto",{id:id},function(data){
			toastr["warning"]("La foto de perfil se eliminó correctamente", "Exito")	
			});
		}
	});
}

$(document).on("click","#btnCambiarFoto", function(){
  $("#mdltitulo").html("Cambiar Foto de Perfil")
	$("#modalFotoPerfil").modal("show");
	$("#FotoPerfiles_form")[0].reset();

});




initFoto();

