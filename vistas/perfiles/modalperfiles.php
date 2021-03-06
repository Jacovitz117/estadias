<div id="modalperfiles" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="mdltitulo">Editar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="perfiles_form" action="">
                <div class="row">
                <div class="col-md-6" hidden>
                        <div class="form-group">
                            <label for="field-1" class="control-label" >Id</label>
                            <input type="text" class="form-control" name="txtIdPerfil" id="txtIdPerfil" value="" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Nombre</label>
                            <input type="text" required onkeypress="return sololetras(event)" class="form-control" name="txtNombre" id="txtNombre" maxlength="25" name="alloptions"  value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Apellido</label>
                            <input type="text" required onkeypress="return sololetras(event)" class="form-control" name="txtApellido" id="txtApellido" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usuario" class="control-label">Nombre de Usuario</label>
                            <input type="text" required class="form-control" name="txtUsuario" id="txtUsuario"  value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correo" class="control-label">Correo</label>
                            <input type="email" required class="form-control" name="txtCorreo" id="txtCorreo" value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Contrase??a</label>
                            <input type="password" required class="form-control" name="txtContrasena" id="txtContrasena" value="">
                        </div>
                    </div>

                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                        <h6 class="text-muted">Privilegio</h6>
                            <select onchange="return select(event)" required class="select2 form-control mb-3 custom-select" name="txtPrivilegio" id="txtPrivilegio" style="width: 100%; height:36px;">
                                <option>Selecciona un privilegio</option>
                                    <optgroup label="Privilegios">
                                        <option value="Administrador">Administrador</option>
                                        <option value="Almacen">Almacenista</option>
                                        <option value="Finanzas">Finanzas</option>
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