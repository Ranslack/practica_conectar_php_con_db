<?php 

require './conexion.php';

//hace el query
$query= "SELECT alumnos.IdAlumno, alumnos.matricula,alumnos.nombre,alumnos.licenciatura, 
licenciatura.nombrelic
FROM licenciatura 
inner join alumnos
on alumnos.licenciatura=licenciatura.idLicenciatura;";
//guarda el resultado de el query

$result= mysqli_query($conn, $query);

//guarda el resultado en un array
//$resp= mysqli_fetch_array($result);

$json=array();
$i=0;
while($row = mysqli_fetch_array($result))
{
	$json[$i]=array(
		'id'=>$row['IdAlumno'],
		'Matricula'=>$row['matricula'],
		'Estudiante'=>$row['nombre'],
		'carrera'=>$row['nombrelic']
	);
	$i++;
} 
		echo json_encode($json)
 ?>