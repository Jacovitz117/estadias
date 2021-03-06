<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es-MX">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Sistema de Inventario - UTNC</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
        <link href="assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

        <!-- toastr (notificaciones) -->
        <link rel="stylesheet" href="assets/plugins/alertify/css/alertify.css">  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    </head>
    <body>


    <!-- Begin page --> 
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="display-table">
            <div class="display-table-cell">
                
                <diV class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="assets/images/extra.png" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center pt-3">
                                        <a href="index.html">
                                            <img src="assets/images/logo-grande.png" alt="logo" height="60" />
                                        </a>
                                    </div>
                                    <div class="px-3 pb-3">
                                        <form class="form-horizontal m-t-20 mb-0" id="iniciarsesion_form">
                    
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" required="" name="txtusuario" placeholder="Usuario">
                                                </div>
                                            </div>
                    
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="password" required="" name="txtcontrase??a" placeholder="Contrase??a">
                                                </div>
                                            </div>
                    
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Recuerdame</label>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form-group text-right row m-t-20">
                                                <div class="col-12">
                                                    <button class="btn btn-success btn-raised btn-block waves-effect waves-light" type="submit">Iniciar Sesi??n</button>
                                                </div>
                                            </div>
                    
                                            <div class="form-group m-t-10 mb-0 row">
                                                <div class="col-sm-7 m-t-20">
                                                    <a href="recover-password" class="text-muted"><i class="mdi mdi-lock"></i> Olvidaste tu contrase??a ?</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </diV>

            </div>
        </div>
    </div>



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap-material-design.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/plugins/sweetalert2/sweetalert2@11.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <!-- toastr (notificaciones) -->
        <script src="assets/notificaciones-toastr/toastr.min.js"></script>
        
        <!-- Funciones js -->
        <script src="assets/js/funciones/usuarios.js"></script>
    </body>
</html>

<?php  
session_start();

if(isset($_SESSION['nombre_us']))
{ 

  echo'<script type="text/javascript">window.location.href="home";</script>';

}

 ?>