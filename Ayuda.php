<?php 

require './conexion.php';

$query= "SELECT alumnos.IdAlumno, alumnos.matricula,alumnos.nombre,alumnos.licenciatura, 
licenciatura.nombrelic
FROM licenciatura 
inner join alumnos
on alumnos.licenciatura=licenciatura.idLicenciatura;";
$result= mysqli_query($conn, $query);
$json=array();
$i=0;
while($row = mysqli_fetch_array($result))
{
	$i++;
} 
		