<?php
$id = $_SESSION['id_usuario'];
?>
<input type="text" value="<?php echo $id ?>" id="idUsuario" hidden>

<div class="wrapper"><br>
<center>
<div class="container-fluid" id="contenedorDatosUsuario">  
    </div>
</center>
</div>

<?php require_once "modalFoto.php" ?>

