<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>CARGA ARTICULO</title>
<link href="hoja.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>


</head>

<body>

<div class="global" >

<div style="width:800px;height:100px;background-image:url(imagenes/encabezado.jpg);margin-bottom:20px"></div>

<div style="padding:10px">



<?php

if(isset($_GET["categoria"])=="" && isset($_GET["sub1"])=="" && isset($_GET["sub2"])==""){
echo "<div style='display:block'>";
}else{
echo "<div style='display:none'>";
}

$sql = mysql_query("select * from categoria where publica_categoria = 'si' order by nombre_categoria asc");
$cta_sql = mysql_num_rows($sql);

for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);

echo "<div style='float:left'>";
echo "Categoria:&nbsp;";
echo "</div>";

echo "<div style='width:300px;height:23px' class='recuadro'>";
echo " ".$lee_sql["nombre_categoria"];
echo "</div>";

echo "<div class='recuadro' style='height:23px'>";
echo "<input type='button' value='Cargar aqui' onclick=location.href='carga_articulo.php?categoria=$lee_sql[clave]&sub1=&sub2='>";
echo "</div>";

echo "<div class='recuadro' style='height:23px'>";
echo "<input type='button' value='Ir a incluir dentro de una subcategoria' onclick=location.href='carga_articulo1.php?categoria=$lee_sql[clave]'>";
echo "</div>";


echo "<div style='clear:both;height:0px'></div>";
}
echo "</div>";




if($_GET["categoria"]!="" && $_GET["sub1"]==""){
echo "<div style='display:block'>";
}else{
echo "<div style='display:none'>";
}

$sql = mysql_query("select * from subcategoria_1 where clave_categoria_s1='$_GET[categoria]' and publica_sub1 = 'si' ");
$cta_sql = mysql_num_rows($sql);

if($cta_sql > 0){
for($c=1;$c<=$cta_sql;$c++){


$lee_sql = mysql_fetch_assoc($sql);

echo "<div style='float:left'>";
echo "Subcategoria 1:&nbsp;";
echo "</div>";


echo "<div style='width:300px;height:23px' class='recuadro'>";
echo " ".$lee_sql["nombre_sub1"];
echo "</div>";

echo "<div class='recuadro' style='height:23px'>";
echo "<input type='button' value='Cargar aqui' onclick=location.href='carga_articulo.php?categoria=$_GET[categoria]&sub1=$lee_sql[clave]&sub2='>";
echo "</div>";
/*
echo "<div class='recuadro' style='height:23px'>";
echo "<input type='button' value='Ir a incluir dentro de otra subcategoria' onclick=location.href='carga_articulo1.php?categoria=$_GET[categoria]&sub1=$lee_sql[clave]'>";
echo "</div>";
*/

echo "<div style='clear:both;height:0px'></div>";
}//cierra el for

}else{//if($cta_sql > 0){

echo "NO EXISTE UNA SUBCATEGORIA 1 ASOCIADA A LA CATEGORIA ELEGIDA";
echo "<br><br><input type='button' value='Volver' onclick='history.go(-1)'>";

}// cierra if($cta_sql > 0){


echo "</div>";





if($_GET[categoria]!="" && $_GET[sub1]!=""){
echo "<div style='display:block'>";
}else{
echo "<div style='display:none'>";
}

$sql = mysql_query("select * from subcategoria_2 where clave_sub1_s2='$_GET[sub1]' and publica_sub2 = 'si'");
$cta_sql = mysql_num_rows($sql);

if($cta_sql > 0){
for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);

echo "<div style='float:left'>";
echo "Subcategoria 2:&nbsp;";
echo "</div>";

echo "<div style='width:300px;height:23px' class='recuadro'>";
echo " ".$lee_sql["nombre_sub2"];
echo "</div>";

echo "<div class='recuadro' style='height:23px'>";
echo "<input type='button' value='Cargar aqui' onclick=location.href='carga_articulo.php?categoria=$_GET[categoria]&sub1=$_GET[sub1]&sub2=$lee_sql[clave]'>";
echo "</div>";




echo "<div style='clear:both;height:0px'></div>";
}//cierra for($c=1;$c<=$cta_sql;$c++){

}else{//if($cta_sql > 0){

echo "NO EXISTE UNA SUBCATEGORIA 2 ASOCIADA A LA SUBCATEGORIA1 ELEGIDA";
echo "<br><br><input type='button' value='Volver' onclick='history.go(-1)'>";

}// cierra if($cta_sql > 0){

echo "</div>";


?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>


</body>
</html>
