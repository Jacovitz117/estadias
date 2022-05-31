$(document).ready(function (e){
    $("#productos").change(function (){
        var parametros= "id="+$("#productos").val();
        $ajax({
            data: parametros,
            url: 'traer_entradas.php',
            type: 'post',
            beforeSend: function () { },
            success: function (response) {
                $("#entradas").html(response);
            },
            error:function () {
                alert("error")
            }
        });
    })
    
})

$("#iniciarsesion_form").on("submit",function(e){
    iniciar_sesion(e);
});


function iniciar_sesion(e)
{
// Evitar que se envia varias veces
e.preventDefault();
var formData = new FormData($("#iniciarsesion_form")[0]);
console.log(formData);
$.ajax({
    url: "controladores/controlador_usuarios.php?op=iniciosesion",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos)
    {
        // console.log(datos);
        $("#iniciarsesion_form")[0].reset();
        swal.fire('Inicio !!!','Se inició correctamente.','success',2000);
        setTimeout("location.href='home'",2000);
    },
    error:function (datos) {
        swal.fire('Error !!!','Esta cuenta no existe.','danger',2000);
    }

});
}

function cerrar_sesion(e)
{

    
// Evitar que se envia varias veces	
$.ajax({
    url: "controladores/controlador_usuarios.php?op=cerrar_sesion",
    type: "POST",
    data: null,
    contentType: false,
    processData: false,
    success: function(datos)
    {			
        swal.fire('Cerrando !!!','Se cerro correctamente.','success',2000);
        setTimeout("location.href='index'",2000);
    }
});



}



// $(document).ready(function (e){
//     $("#click").click(function(e){
//         console.log("click");
//         //alertify.success('Success message');
    
//        //toastr.info("Se inicio sesión correctamente", "Exito");
    
//         // toastr["success"]("Se inicio sesión correctamente", "Exito");
    
//         // toastr.options = {
//         // "closeButton": false,
//         // "debug": false,
//         // "newestOnTop": false,
//         // "progressBar": false,
//         // "positionClass": "toast-top-right",
//         // "preventDuplicates": false,
//         // "onclick": null,
//         // "showDuration": "300",
//         // "hideDuration": "1000",
//         // "timeOut": "8000",
//         // "extendedTimeOut": "1000",
//         // "showEasing": "swing",
//         // "hideEasing": "linear",
//         // "showMethod": "fadeIn",
//         // "hideMethod": "fadeOut"
//         // }
//     });
// });