<div id="modalproveedores" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="mdltitulo">Editar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="proveedores_form" action="POST">

                    <div class="row">
                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                <label for="field-1" class="control-label" >Id</label>
                                <input type="text" class="form-control" name="txtIdProv" id="txtIdProv" value="" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="bmd-label-floating">Nombre</label>
                                <input type="text" required onkeypress="return sololetras(event)" class="form-control" name="txtNombreProv" id="txtNombreProv" maxlength="255" name="alloptions"  value="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="bmd-label-floating">Empresa</label>
                                <input type="text" required onkeypress="return sololetras(event)" class="form-control" name="txtEmpresaProv" id="txtEmpresaProv" maxlength="255" name="alloptions"  value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="bmd-label-floating">Correo</label>
                                <input type="email" required onkeypress="" class="form-control" name="txtCorreoProv" id="txtCorreoProv" maxlength="255" name="alloptions"  value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="bmd-label-floating">Telefono</label>
                                <input type="tel" required onkeypress="return solonumeros(event)" class="form-control" name="txtTelefonoProv" id="txtTelefonoProv" maxlength="10" name="alloptions"  value="">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="bmd-label-floating">Dirección</label>
                                <input type="text" required onkeypress="return (event)" class="form-control" name="txtDireccionProv" id="txtDireccionProv" maxlength="255" name="alloptions"  value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="bmd-label-floating">IVA</label>
                                <input type="number" step="0.01" maxlength="2" minlength="2" value="." required onkeypress="return " class="form-control" name="txtIvaProv" id="txtIvaProv" maxlength="10" name="alloptions"  value="">
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