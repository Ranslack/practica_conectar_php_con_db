<?php require './Ayuda.php';?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Update de un crud"><!-- description -->
        <meta name="author" content="Yaser Tabares"><!-- Autor-->
        
        <meta name="copyright" content="Copyright © Oregoom.com" />
        <link rel="stylesheet" href="EstiloUpdate.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" type="text/javascript"></script>

	<title>Update</title>
</head>
<body>
  <form id="updateform" method="POST">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Matrícula</th>
          <th>Nombre</th>
          <th>Licenciatura</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody id="body"></tbody>
    </table>
  </form>
  

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    const j = <?php print "$i"; ?>;
    var p = 0;

    $(function() {
      	$.getJSON('consulta.php', function(json) {
	        for (p = 0; p < j; p++) {
	          $("#body").append("<tr id='contenedor" + p + "'> </tr>");
	          $("#contenedor" + p).append('<th id="valuesid">' + json[p].id + '</th>');
	          $("#contenedor" + p).append('<td class="editable-td">' + json[p].Matricula + '</td>');
	          $("#contenedor" + p).append('<td class="editable-td">' + json[p].Estudiante + '</td>');
	          $("#contenedor" + p).append('<td id="editable-lic" >' + json[p].carrera + '</td>');
	          $("#contenedor" + p).append('<tl><button type="button" class="editar-btn">Editar</button></tl>');
	          $("#contenedor" + p).append('<tl><button onclick="actualizarFila(this.parentNode.parentNode)">Actualizar</button></tl>');
	        }
	        // Agregar eventlistener al botón Editar
	        // Obtener todos los botones de "Editar"
	        var editarBtns = document.querySelectorAll('.editar-btn');
	          
		    // Iterar sobre cada botón
		    editarBtns.forEach(function(btn) {
		        btn.addEventListener('click', function() {
		        // Obtener las celdas de la tabla  
			        var fila = this.parentNode.parentNode; // Obtener la fila (tr) padre del botón
			        var celda1 = fila.cells[3];
			        // Obtener todos los TDs dentro de la fila
			        var tds = fila.querySelectorAll('.editable-td');
			        // Iterar sobre cada TD
			        tds.forEach(function(td) {
				        var contenido = td.textContent; // Obtener el contenido actual del TD
				        // Crear un nuevo elemento input y asignarle el contenido del TD
				        var input = document.createElement('input');
				        input.type = 'text';
				        input.value = contenido;
				        // Reemplazar el TD con el nuevo input
				        td.textContent = '';
				        td.appendChild(input);

						crearSelect(celda1);
						// Cambiar a TD cuando se pierde el foco del input
						input.addEventListener('blur', function() {

							td.textContent = input.value;
						});
					});
				});
		    });
		});
    });
  </script>

  <script type="text/javascript">
    var lic =0;
          // Función para reemplazar una celda por un elemento select
            function crearSelect(celda) {
	            // Obtener el valor actual de la celda
	            var valorActual = celda.textContent;
	            // Crear un elemento select
	            var select = document.createElement('select');
	            // Crear opciones con valores distintos
	            var opciones = ['Seleccione una opcion','Licenciatura en ingeniería en software', 'Licenciatura en derecho'];
	            var values = ['0','1', '2'];
	            //agrego la opcion al select
	            for (var i = 0; i < opciones.length; i++) {
	            	var opcion = document.createElement('option');
	                select.id= "editable-lic";
	                opcion.value = values[i];
	                opcion.text = opciones[i];
	                select.appendChild(opcion);
	            }
	            // Establecer el valor actual como opción seleccionada por defecto
	            select.value = 0;

	            // Reemplazar el contenido de la celda por el select
	            celda.innerHTML = '';
	            celda.appendChild(select);
	            select.addEventListener('blur', function() {
	            	lic = select.value;
	            });
            }

function actualizarFila(fila) {
	var id = fila.cells[0].textContent.trim();
	var matricula = fila.cells[1].textContent.trim();
	var nombre = fila.cells[2].textContent.trim();
	var licenciatura = fila.querySelector('select[id="editable-lic"]').value;

	// Enviar los datos al servidor mediante AJAX
	var xhr = new XMLHttpRequest(); //es una forma de realizar solicitudes HTTP desde JavaScript sin tener que recargar la página.
	xhr.open('POST', 'Actualizar.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Aquí se indica que los datos se enviarán en formato application/x-www-form-urlencoded, 
	//es el formato estándar utilizado en formularios HTML.
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			// Procesar la respuesta del servidor si es necesario
			console.log(xhr.responseText);
		} 
	};
	//Los datos se pasan como una cadena en formato "clave=valor". 
	//Los valores se codifican utilizando encodeURIComponent 
	//para asegurarse de que no haya caracteres especiales que puedan interferir con la solicitud
	xhr.send('id=' + encodeURIComponent(id) + '&matricula=' + encodeURIComponent(matricula) + '&nombre=' + encodeURIComponent(nombre) + '&licenciatura=' + encodeURIComponent(licenciatura));
        }
  </script>
</body>
</html>

