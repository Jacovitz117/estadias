<div id="modalcuentas" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="mdltitulo">Editar Unidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cuentas_form" action="">
                    <div class="row"> 
                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                <label for="field-1" class="control-label" >Id</label>
                                <input type="text" class="form-control" name="txtIdCuen" id="txtIdCuen" value="" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Numero</label>
                                <input type="text" required onkeypress="return solonumeros(event)" class="form-control" name="txtNumeroCuen" id="txtNumeroCuen" maxlength="40" name="alloptions"  value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Nombre</label>
                                <input type="text" required onkeypress="return sololetras(event)" class="form-control" name="txtNombreCuen" id="txtNombreCuen" maxlength="100" name="alloptions"  value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Descripción</label>
                                <input type="textarea" required onkeypress="return sololetras(event)" class="form-control" name="txtDescripcionCuen" id="txtDescripcionCuen" maxlength="99999" name="alloptions"  value="">
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