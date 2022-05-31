<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Sistema de Inventario - UTNC</title>
    <meta content="Sistema de Control de Consumibles de la Universidad Tecnologíca del Norte de Coahuila" name="description" />
    <meta content="Jacob Gaytán Ramirez" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!--Morris Chart CSS -->
    <link href="assets/plugins/fullcalendar/vanillaCalendar.css" rel="stylesheet" type="text/css"  />
    <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/chartist/css/chartist.min.css">
    <!-- <link rel="stylesheet" href="assets/plugins/morris/morris.css"> -->
    <link rel="stylesheet" href="assets/plugins/metro/MetroJs.min.css">

    <link  href="assets/plugins/carousel/owl.carousel.min.css" rel="stylesheet">
    <link  href="assets/plugins/carousel/owl.theme.default.min.css" rel="stylesheet">

    <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- Dropzone css -->
    <link href="assets/plugins/dropify/css/dropify.min.css" rel="stylesheet">
    <!-- toastr (notificaciones) -->
    <link rel="stylesheet" href="assets/notificaciones-toastr/toastr.css">  

    <!-- toastr (notificaciones) -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> -->

    <!-- DataTables -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Plugins css -->
    <link href="assets/plugins/timepicker/tempusdominus-bootstrap-4.css" rel="stylesheet" />
    <link href="assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="assets/plugins/clockpicker/jquery-clockpicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/colorpicker/asColorPicker.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/all.css">

</head>

<body>
    

    <!-- Loader -->
    <!-- <div id="preloader"><div id="status"><div class="spinner"></div></div></div> -->

    <!-- Loader -->
    <!-- <div id="preloader"><div id="status"><div class="myspinner"></div></div></div> -->

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">
                    <!-- Text Logo -->
                    <!--<a href="index.html" class="logo">-->
                    <!--Urora-->
                    <!--</a>-->
                    <!-- Image Logo -->
                    <a href="home.php" class="logo">
                        <img src="assets/images/logo-grande.png" alt="" height="50" class="">
                    </a>

                </div>
                <!-- End Logo container-->


                <div class="menu-extras topbar-custom">
                    
                    <ul class="list-inline float-right mb-0 ">
                        <!-- language-->

                        <li class="list-inline-item dropdown notification-list">
                            <div class="list-inline-item hide-phone app-search">
                            <button class="btn btn-success" id="click">notificacion test</button>
                            </div>   
                        </li>


                        <li class="list-inline-item dropdown notification-list">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false" id="imagenPerfil">
                                    <img src="<?php echo $fotoPerfil[0]['foto']?>" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5>Bienvenido</h5>
                                    </div>
                                    <a class="dropdown-item" href="?a=miperfil"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Perfil</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Bloquear</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" id="cerrar_sesion" onclick="cerrar_sesion(event)" href=""><i class="mdi mdi-logout m-r-5 text-muted"></i> Cerrar Sesión</a>
                                </div>                                                                    
                            </div>
                        </li>
                        <li class="menu-item list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link" id="mobileToggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>    
                    </ul> 
                    
                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <!-- MENU Start -->
        <div class="navbar-custom"> 
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu text-center">

                        <li class="has-submenu ">
                            <a href="home"><i class="mdi mdi-view-dashboard"></i>Dashboard</a>
                        </li>
                        
                        <?php if($_SESSION['privilegio_us'] == 'Administrador') { ?>

                        <li class="has-submenu ">
                            <a href="?a=departamentos"><i class="mdi mdi-city"></i>Gestión Modúlos</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="?a=departamentos">Departamentos</a></li>
                                        <li><a href="?a=proveedores">Proveedores</a></li>
                                        <li><a href="?a=productos">Productos</a></li>
                                        <li><a href="?a=unidades">Unidades</a></li>
                                        <li><a href="?a=cuentas">Cuentas</a></li>
                                        <li><a href="?a=subcuentas">Sub Cuentas</a></li>
                                        <a href="?a=perfiles">Perfiles</a>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        
                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-file-document-box"></i>Ordenes de Compra</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="?a=ordenes">Ordenes de Compra</a></li>
                                        <li><a href="?a=subcuentas">Sub Cuentas</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-cart-plus"></i>Inventario</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="?a=entradas">Entradas</a></li>
                                        <li><a href="?a=salidas">Salidas</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <?php  } ?>


                        <?php if($_SESSION['privilegio_us'] == 'Finanzas') { ?>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-file-document-box"></i>Ordenes de Compra</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="?a=ordenes">Ordenes de Compra</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <?php  } ?>

                        <?php if($_SESSION['privilegio_us'] == 'Almacen') { ?>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-cart-plus"></i>Inventario</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="?a=entradas">Entradas</a></li>
                                        <li><a href="?a=salidas">Salidas</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <?php  } ?>

                    </ul><!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->


    <?php  require_once "ruteador.php"; ?>


    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    © 2022 UTNC by Jacob Gaytán.
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


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

    <script src="assets/plugins/carousel/owl.carousel.min.js"></script>
    <script src="assets/plugins/fullcalendar/vanillaCalendar.js"></script>
    <script src="assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/plugins/chartist/js/chartist.min.js"></script>
    <script src="assets/plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/plugins/metro/MetroJs.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <!-- <script src="assets/plugins/morris/morris.min.js"></script>   -->
    <script src="assets/pages/dashborad.js"></script>
    <script src="assets/plugins/alertify/js/alertify.js"></script>

    <!-- Required datatable js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <!-- <script src="assets/plugins/datatables/pdfmake.min.js"></script> -->
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <!-- Visualizacion de Columnas -->
    <!-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script> -->
    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
    <!-- Plugins js -->
    <script src="assets/plugins/timepicker/moment.js"></script>
    <script src="assets/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>
    <script src="assets/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/plugins/clockpicker/jquery-clockpicker.min.js"></script>
    <script src="assets/plugins/colorpicker/jquery-asColor.js"></script>
    <script src="assets/plugins/colorpicker/jquery-asGradient.js"></script>
    <script src="assets/plugins/colorpicker/jquery-asColorPicker.min.js"></script>
    <!-- <script src="assets/plugins/select2/select2.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2@11.js"></script>
    <!-- Dropzone js -->
    <script src="assets/plugins/dropify/js/dropify.min.js"></script>
    <script src="assets/pages/upload-init.js"></script>
    <!-- Plugins Init js -->
    <script src="assets/pages/form-advanced.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <!-- Toastr (notificaciones) -->
    <script src="assets/notificaciones-toastr/toastr.min.js"></script>
    <!-- Toastr Init js -->
    <script src="assets/pages/toastr-init.js"></script>
    <!-- Funciones js -->
    <script src="assets/js/funciones/usuarios.js"></script>
    <script src="assets/js/funciones/validaciones.js"></script>
    <script src="assets/js/funciones/miperfil.js"></script>
    
    <!-- Funciones por modulo -->
    <script src="vistas/perfiles/mtoperfiles.js"></script>
    <script src="vistas/productos/mtoproductos.js"></script>
    <script src="vistas/departamentos/mtodepartamentos.js"></script>
    <script src="vistas/unidades/mtounidades.js"></script>
    <script src="vistas/proveedores/mtoproveedores.js"></script>
    <script src="vistas/cuentas/mtocuentas.js"></script>
    <script src="vistas/subcuentas/mtosubcuentas.js"></script>
    <script src="vistas/ordenes/mtoordenes.js"></script>
    <script src="vistas/ordenes/mtodetalleordenes.js"></script>
    <script src="vistas/ordenes/mtoproductosendetalle.js"></script>
    <script src="vistas/entradas/mtoentradas.js"></script>
    
    
</body>
</html>
