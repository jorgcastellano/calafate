<?php
include_once("../conexion.inc.php");

?> 

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>PANEL DE CONTROL</title>
<link href="panel.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="panel.js"></script>

</head>

<body>
<div class="global">

<div style="text-align:center">
<img src="botones/categoria.jpg"><br>
<img src="botones/agregar_categoria.jpg" onclick="location.href='categoria.php?accion=agregar'" style="cursor:pointer">
<img src="botones/modificar_categoria.jpg" style="margin-left:5px;cursor:pointer" onclick="location.href='categoria.php?accion=modificar'">
<img src="botones/eliminar_categoria.jpg" style="margin-left:5px;cursor:pointer" onclick="location.href='categoria.php?accion=eliminar'">

</div>

<div style="text-align:center">
<img src="botones/subcategoria.jpg"><br>
<img src="botones/agregar_subcategoria.jpg" onclick="location.href='subcategoria.php?accion=agregar'" style="cursor:pointer">
<img src="botones/modificar_subcategoria.jpg" onclick="location.href='subcategoria.php?accion=modificar'" style="margin-left:5px;cursor:pointer">
<img src="botones/eliminar_subcategoria.jpg" onclick="location.href='subcategoria.php?accion=eliminar'" style="margin-left:5px;cursor:pointer">

</div>

<div style="text-align:center">
<img src="botones/contenido.jpg"><br>
<img src="botones/agregar_contenido.jpg" onclick="location.href='contenido.php?accion=agregar'" style="cursor:pointer">
<img src="botones/modificar_contenido.jpg" onclick="location.href='contenido.php?accion=modificar'"style="margin-left:5px;cursor:pointer">
<img src="botones/eliminar_contenido.jpg" onclick="location.href='contenido.php?accion=eliminar'"style="margin-left:5px;cursor:pointer">

</div>

<div style="text-align:center">
<img src="botones/material.jpg"><br>
<img src="botones/agregar_material.jpg">
<img src="botones/modificar_material.jpg" style="margin-left:5px">
<img src="botones/eliminar_material.jpg" style="margin-left:5px">

</div>

<div style="text-align:center;margin-top:30px">
<img src="botones/volver.jpg" onclick="history.go(-1)" style="cursor:pointer">
</div>









</div>
</body>
</html>
