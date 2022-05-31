<div class="wrapper">
    <div class="container-fluid"> 

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group m-0 pull-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="home">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="?a=proveedores">Proveedores</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div><br>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">

                    <div class="card-body">
                        <h4 class="mt-0 header-title">Gestion de Proveedores</h4>
                        <p class="text-muted font-14">DataTables has most features enabled by
                            default, so all you need to do to use it with your own tables is to call
                            the construction function: <code>$().DataTable();</code>.
                        </p>
                        <button id="btnNuevoProveedor" class="btn btn-info"><i class="fas fa-plus-circle"></i> Agregar Proveedor</button>      
                        <table id="proveedores_data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Empresa</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Dirección</th>
                                <th>IVA</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- end container -->
    </div>
    <!-- end wrapper -->

    <?php  require_once "vistas/proveedores/modalproveedores.php"; ?>
