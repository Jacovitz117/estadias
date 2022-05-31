<style>
    .modal-lg-1 {
        max-width: 90% !important;
    }
    @media (min-width: 768px) {
  .modal-lg-1 .modal-dialog {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .modal-lg-1 .modal-dialog {
    width: 970px;
  }
  }
</style>
<div id="modalPED" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdltituloPED">Productos en Orden de Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                            <button id="btnAggProd" class="btn btn-info"><i class="fas fa-plus-circle"></i> Agregar Producto a Orden de Compra</button>
                            <table id="PED_data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Número de Orden</th>
                                    <th>Cuenta</th>
                                    <th>Sub-Cuenta</th>
                                    <th>Producto</th>
                                    <th>Unidad</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Estado</th>
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
                    </div>


                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i class="fas fa-arrow-square-left"></i> Regresar</button>
                        <button type="submit" class="btn btn-raised btn-success ml-2"><i class="fad fa-plus"></i> Registar</button>
                    </div>
                </form>
            </div>                                          
        </div>          
    </div>
</div>
