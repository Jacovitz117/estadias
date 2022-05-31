<?php

function getConnexion()
{
  $mysqli = new Mysqli('localhost', 'root', '', 'estadias');
  if($mysqli->connect_errno) exit('Error en la conexión: ' . $mysqli->connect_errno);
  $mysqli->set_charset('utf8');
  return $mysqli;
}


if(!isset($_GET['id'])) exit('No se recibió el valor a buscar');


function searchFoto()
{
  $mysqli = getConnexion();
  $busqueda = $mysqli->real_escape_string($_GET['id']);
  $query = "SELECT * FROM usuarios WHERE id='$busqueda' ";
  $res = $mysqli->query($query);
  while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    echo "<img src='$row[foto]' alt='user' class='rounded-circle'>";
  }
}

searchFoto();



?>

