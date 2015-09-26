<html>
<head>
   <title>Mis notas</title>
</head>
<body>
<H1>Lista de notas</H2>
	<?php

	$nota=$_POST['notaNueva'];


	if(!$enlace = mysql_connect('localhost','root','0213'))
	{
	echo 'No pudo conectarse a mysql';
	    exit;
	}
	if (!mysql_select_db('notasDB', $enlace)) {
	    echo 'No pudo seleccionar la base de datos';
	    exit;
	}
	$sqlID='select MAX(id) from notas';
	$resultadoID=mysql_query($sqlID,$enlace);
	if (!$resultadoID) {
	    echo "Error de BD, no se pudo consultar la base de datos\n";
	    echo "Error MySQL:   mysql_error()";
	    exit;
	}
	$row=mysql_fetch_row($resultadoID);
	$nuevoID=$row[0]+1;
	$sqlInsert="insert into notas (id,valor) values ('$nuevoID','$nota')";
	$resultadoInsert = mysql_query($sqlInsert,$enlace);
	
	$sqlSelect="select * from notas order by id desc";
	$resultadoSelect=mysql_query($sqlSelect,$enlace);
	
	while($fila=mysql_fetch_array($resultadoSelect,MYSQL_NUM)){
		echo "$fila[0] , $fila[1]<br>";
	}

 	mysql_free_result($resultadoSelect);
	mysql_free_result($resultadoID);
	?>

</body>
</html> 
