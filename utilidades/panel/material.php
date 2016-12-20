<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<?php
include_once("../conexion.inc.php");

if($_GET["accion"]=="agregar"){
echo "<title>AGREGAR CATEGORIA</title>";
}

if($_GET["accion"]=="modificar"){
echo "<title>MODIFICAR CATEGORIA</title>";
}

if($_GET["accion"]=="eliminar"){
echo "<title>ELIMINAR CATEGORIA</title>";
}

?>
<link href="panel.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="panel.js"></script>

</head>

<body>

<div>


</div>

</body>
</html>
