<div class="wrapper">
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group m-0 pull-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="home">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="?a=ordenes">Ordenes de Compra</a></li>
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
                        <h4 class="mt-0 header-title">Gestion de Entradas de Material</h4>
                        <p class="text-muted font-14">DataTables has most features enabled by
                            default, so all you need to do to use it with your own tables is to call
                            the construction function: <code>$().DataTable();</code>.
                        </p>
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="exampleInputEmail1" class="bmd-label-floating">Orden de Compra</label>
                                <input type="text" class="form-control" id="busqueda" onChange="es_vacio()">
                                <span class="bmd-help">Escribe el numero de la orden de compra y despues da click en buscar.</span><br>
                            </div>

                            <div class="col-lg-6"><br>
                                <button id="btnBuscar" class="btn btn-info btn-block"><i class="fas fa-plus-circle"></i> Buscar Orden de Compra</button>
                            </div>
                            <!-- <div class="col-lg-3"><br>
                                <button id="btnNuevaEntrada" disabled="disabled" class="btn btn-warning btn-block"><i class="fas fa-plus-circle"></i> Generar nueva Entrada</button>
                                <input type="text" value="" id="idOrden">
                            </div> -->

                        </div>
                        <hr>


                    <div class="row-lg-12" id="resultado">
                        

                    </div>

                    <!-- <div class="row">
                        <form action="">
                            <div class="col">
                                <label for="exampleInputEmail1" class="bmd-label-floating">Agrega un comentario a la Orden de Compra</label>
                                <textarea class="form-control" name="txtComentarios" id="txtComentarios" cols="30" rows="2"></textarea>
                            </div>
                        </form>
                    </div> -->

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- end container -->
    </div>
    <!-- end wrapper -->

    <?php  require_once "vistas/ordenes/modalordenes.php"; ?>
    <?php  require_once "vistas/ordenes/modaldetalleordenes.php"; ?>
    <?php  require_once "vistas/ordenes/modalproductosendetalle.php"; ?>