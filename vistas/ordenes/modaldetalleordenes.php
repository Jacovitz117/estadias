<div id="modaldetalleordenes" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdltitulodetalle">Llenar Orden de Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="detalleordenes_form" action="">

                    <div class="row" hidden>
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <h6 class="text-muted">Orden de Compra</h6>
                                <input type="number" class="form-control" name="txtIdOrDet" id="txtIdOrDet" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group no-margin">
                            <h6 class="text-muted">Cuenta</h6>
                                <select onchange="return select(event)" required class="select2 form-control mb-3 custom-select" name="txtIdCuenDet" id="txtIdCuenDet" style="width: 100%; height:36px;">
                                        <option>Selecciona una Cuenta</option>
                                        <optgroup label="Cuentas" id="listacuentas">
                                        </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group no-margin">
                            <h6 class="text-muted">Sub-Cuenta</h6>
                                <select onchange="return select(event)" required class="select2 form-control mb-3 custom-select" name="txtIdSubCuenDet" id="txtIdSubCuenDet" style="width: 100%; height:36px;">
                                        <option>Selecciona una Sub-Cuenta</option>
                                        <optgroup label="Sub-Cuentas" id="listasubcuentas">
                                        </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group no-margin">
                            <h6 class="text-muted">Producto</h6>
                                <select onchange="return select(event)" required class="select2 form-control mb-3 custom-select" name="txtProdDet" id="txtProdDet" style="width: 100%; height:36px;">
                                        <option>Selecciona un Producto</option>
                                        <optgroup label="Productos" id="listaproductos">
                                        </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group no-margin">
                            <h6 class="text-muted">Unidad</h6>
                                <select onchange="return select(event)" required class="select2 form-control mb-3 custom-select" name="txtUniDet" id="txtUniDet" style="width: 100%; height:36px;">
                                        <option>Selecciona una Unidad</option>
                                        <optgroup label="Unidad" id="listaunidades">
                                        </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4"><br><br>
                            <div class="form-group">
                                <label for="field-1" class="control-label" >Cantidad a Pedir</label>
                                <input type="number" class="form-control" name="txtCantDet" id="txtCantDet" value="" >
                            </div>
                        </div>
                        <div class="col-md-4"><br><br>
                            <div class="form-group">
                                <label for="field-1" class="control-label" >Precio Unitario</label>
                                <input type="number" class="form-control" name="txtPrecDet" id="txtPrecDet" value="" >
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
