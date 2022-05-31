<?php

function getConnexion()
{
  $mysqli = new Mysqli('localhost', 'root', '', 'estadias');
  if($mysqli->connect_errno) exit('Error en la conexión: ' . $mysqli->connect_errno);
  $mysqli->set_charset('utf8');
  return $mysqli;
}


if(!isset($_GET['id'])) exit('No se recibió el valor a buscar');


function search()
{
  $mysqli = getConnexion();
  $busqueda = $mysqli->real_escape_string($_GET['id']);
  $query = "SELECT * FROM usuarios WHERE id='$busqueda' ";
  $res = $mysqli->query($query);
  while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    echo "

<div class='col-md-12 col-xl-9'>
    <div class='card m-b-30 border-0'>
        <div class='card-body  text-center'>
            <img src='$row[foto]' class='rounded-circle mx-auto d-block w-25'>
            <br>
            <button type='button' class='btn btn-raised btn-info mb-2' id='btnCambiarFoto' data-toggle='tooltip' data-placement='top' title='Cambiar foto de perfil'><i class='mdi mdi-camera-party-mode'></i></button>
            <button type='button' class='btn btn-raised btn-danger mb-2' id='btnEliminarFoto' onClick='eliminarFotoPerfil($row[id])' data-toggle='tooltip' data-placement='top' title='Eliminar foto de perfil'><i class='mdi mdi-camera-off'></i></button>
            <div class='text-center pt-1'>
                <h4>$row[nombre] $row[apellidos]</h4>
                <h5 class='text-muted'>@$row[usuario]</h5>
                <a class='btn btn-block btn-raised btn-success mb-2'>Usuario con Privilegio: $row[privilegio]</a>
            </div>
            <div class='row text-center profile-block'>
                <div class='col-6 align-self-center py-2 border-right'>
                    <h3 class='profile-count'>
                        <b class='font-22'>15,521</b>
                    </h3>
                    <p class='mb-0'>Followers</p>
                </div>
                <div class='col-6 align-self-center py-2'>
                    <h3 class='profile-count'>
                        <b class='font-22'>772</b>
                    </h3>
                    <p class='mb-0'>Followings</p>
                </div>
            </div>
        </div>
    </div>
</div>
    
    ";
  }
}

search();

switch ($_GET['op']) 
{

    case 'fotoperfil':
    
        
        
    function BuscarFoto()
    {
    $mysqli = getConnexion();
    $busqueda = $mysqli->real_escape_string($_GET['id']);
    $query = "SELECT foto FROM usuarios WHERE id='$busqueda' ";
    $res = $mysqli->query($query);
    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        echo "<img src='$row[foto]' alt='user' class='rounded-circle'>";
    }
    }

    BuscarFoto();

    break;
    
}




?>

