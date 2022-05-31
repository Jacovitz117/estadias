<div id="modalordenes" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="mdltitulo">Editar Orden de Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ordenes_form" action="">
                    <div class="row">

                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                <label for="field-1" class="control-label" >Id</label>
                                <input type="text" class="form-control" name="txtIdOr" id="txtIdOr" value="" >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Número de Orden de Compra</label>
                                <input type="text" required onkeypress="return solonumeros(event)" class="form-control" name="txtNumOrdenOr" id="txtNumOrdenOr" maxlength="40" name="alloptions"  value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Número de Orden de Requisición</label>
                                <input type="text" required onkeypress="return solonumeros(event)" class="form-control" name="txtNumReqOr" id="txtNumReqOr" maxlength="40" name="alloptions"  value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group no-margin">
                            <h6 class="text-muted">Proveedor</h6>
                                <select onchange="return select(event)" required class="select2 form-control mb-3 custom-select" name="txtProvOr" id="txtProvOr" style="width: 100%; height:36px;">
                                        <option>Selecciona un Proveedor</option>
                                        <optgroup label="Proveedor" id="listaproveedor">
                                        </optgroup>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group no-margin">
                            <h6 class="text-muted">Departamento</h6>
                                <select onchange="return select(event)" required class="select2 form-control mb-3 custom-select" name="txtDepOr" id="txtDepOr" style="width: 100%; height:36px;">
                                        <option>Selecciona un Departamento</option>
                                        <optgroup label="Departamento" id="listadepartamentos">
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