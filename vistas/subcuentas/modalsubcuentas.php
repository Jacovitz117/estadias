<div id="modalsubcuentas" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="mdltitulo">Editar Sub-Cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="subcuentas_form" action="">
                    <div class="row"> 
                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                <label for="field-1" class="control-label" >Id</label>
                                <input type="text" class="form-control" name="txtIdSubCuen" id="txtIdSubCuen" value="" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Numero</label>
                                <input type="text" required onkeypress="return solonumeros(event)" class="form-control" name="txtNumeroSubCuen" id="txtNumeroSubCuen" maxlength="40" name="alloptions"  value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Nombre</label>
                                <input type="text" required onkeypress="return sololetras(event)" class="form-control" name="txtNombreSubCuen" id="txtNombreSubCuen" maxlength="100" name="alloptions"  value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Descripción</label>
                                <input type="textarea" required onkeypress="return sololetras(event)" class="form-control" name="txtDescripcionSubCuen" id="txtDescripcionSubCuen" maxlength="99999" name="alloptions"  value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                            <h6 class="text-muted">Cuenta Padre</h6>
                                <select onchange="return select(event)" required class="select2 form-control mb-3 custom-select" name="txtIdCuenta" id="txtIdCuenta" style="width: 100%; height:36px;">
                                        <option>Selecciona una Cuenta Padre</option>
                                        <optgroup label="Cuenta Padre" id="listacuentas">
                                        </optgroup>
                                    </select>
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