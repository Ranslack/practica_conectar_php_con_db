<?php
require './conexion.php';
// actualizar.php

$id = $_POST['id'];
$matricula = $_POST['matricula'];
$nombre = $_POST['nombre'];
$licenciatura = $_POST['licenciatura'];

// Realizar la actualización en la base de datos

$query = "UPDATE alumnos SET matricula = '$matricula', nombre = '$nombre', licenciatura = '$licenciatura' WHERE IdAlumno = $id";

// ...comprobacion si se inserto los datos o no ...

if (mysqli_query($conn, $query)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}


?>