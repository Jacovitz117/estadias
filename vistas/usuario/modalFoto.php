<div id="modalFotoPerfil" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-8">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="mdltitulo">Editar Perfil</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FotoPerfiles_form" action="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                <label for="field-1" class="control-label" >Id</label>
                                <input type="text" class="form-control" name="txtIdPerfil" id="txtIdPerfil" value="<?php echo $id ?>" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mt-0 header-title">Actualizar foto de perfil</h4>
                            <p class="text-muted font-14">Puedes arrastar y soltar la foto a subir</p>
                            <input type="file" id="input-file-now" name="txtImagen" class="dropify" />                                       
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i class="fas fa-arrow-square-left"></i> Regresar</button>
                        <button type="submit" class="btn btn-raised btn-success ml-2"><i class="fad fa-plus"></i> Actualizar</button>
                    </div>
                </form>
            </div>                                          
        </div>          
    </div>
</div>



