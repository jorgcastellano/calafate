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
<title>CARGAR FOTOS</title>

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

if($_GET["tipo"]==""){

echo "<div>";
echo "Elegir el destino final de la foto:<br><br>";
echo "<input type='button' onclick=location.href='$_SERVER[PHP_SELF]?tipo=categoria' value='Categoria'>";

echo "<input type='button' onclick=location.href='$_SERVER[PHP_SELF]?tipo=sub1' value='Subcategoria 1'>";
/*
echo "<input type='button' onclick=location.href='$_SERVER[PHP_SELF]?tipo=sub2' value='Subcategoria 2 '>";
*/
echo "<input type='button' onclick=location.href='$_SERVER[PHP_SELF]?tipo=articulo' value='Articulo'>";

echo "</div>";


}else{//if($_GET["tipo"]==""){


if($_GET["tipo"]=="categoria"){

$sql = mysql_query("select * from categoria order by nombre_categoria asc");
$cta_sql = mysql_num_rows($sql);
echo "Hacer click en la categoria deseada:<br><br>";
for($e=1;$e<=$cta_sql;$e++){
$lee_sql = mysql_fetch_assoc($sql);

echo "<div class='recuadro' style='width:780px' >";
echo "<a href='carga_fotos.php?categoria=$lee_sql[clave]&sub1=&sub2=&articulo=' style='text-decoration:none;color:#000000'>$lee_sql[nombre_categoria]</a><br>";

echo "</div>";

echo "<div style='clear:both'></div>";


}//cierra for


}//if($_GET["tipo"]=="categoria"){





if($_GET["tipo"]=="sub1"){

$sql = mysql_query("select subcategoria_1.*, categoria.nombre_categoria from subcategoria_1 left outer join categoria on subcategoria_1.clave_categoria_s1 =categoria.clave order by subcategoria_1.nombre_sub1 asc ");
$cta_sql = mysql_num_rows($sql);
echo "Hacer click en la Subcategoria 1 deseada:<br><br>";
for($e=1;$e<=$cta_sql;$e++){
$lee_sql = mysql_fetch_assoc($sql);

echo "<div class='recuadro' style='width:780px' >";
echo "<a href='carga_fotos.php?categoria=$lee_sql[clave_categoria_s1]&sub1=$lee_sql[clave]&sub2=&articulo=' style='text-decoration:none;color:#000000'>$lee_sql[nombre_sub1] de la categoria $lee_sql[nombre_categoria]</a><br>";

echo "</div>";

echo "<div style='clear:both'></div>";



}//cierra for


}//if($_GET["tipo"]=="sub1"){



if($_GET["tipo"]=="sub2"){

$sql = mysql_query("select subcategoria_2.*, subcategoria_1.nombre_sub1 from subcategoria_2 left outer join subcategoria_1 on subcategoria_2.clave_sub1_s2 = subcategoria_1.clave order by subcategoria_2.nombre_sub2 asc ");
$cta_sql = mysql_num_rows($sql);
echo "Hacer click en la Subcategoria 2 deseada:<br><br>";
for($e=1;$e<=$cta_sql;$e++){
$lee_sql = mysql_fetch_assoc($sql);

echo "<div class='recuadro' style='width:780px' >";
echo "<a href='carga_fotos.php?categoria=$lee_sql[clave_categoria_s2]&sub1=$lee_sql[clave_sub1_s2]&sub2=$lee_sql[clave]&articulo=' style='text-decoration:none;color:#000000'>$lee_sql[nombre_sub2] de la subcategoria 1 $lee_sql[nombre_sub1]</a><br>";

echo "</div>";

echo "<div style='clear:both'></div>";



}//cierra for


}//if($_GET["tipo"]=="sub2"){




if($_GET["tipo"]=="articulo"){

$sql = mysql_query("select articulo.*, categoria.nombre_categoria from articulo left outer join categoria on articulo.clave_categoria_ar = categoria.clave order by articulo.nombre_articulo asc ");
$cta_sql = mysql_num_rows($sql);
echo "Hacer click en el articulo deseado:<br><br>";
for($e=1;$e<=$cta_sql;$e++){
$lee_sql = mysql_fetch_assoc($sql);

echo "<div class='recuadro' style='width:780px' >";
echo "<a href='carga_fotos.php?categoria=$lee_sql[clave_categoria_ar]&sub1=$lee_sql[clave_sub1_ar]&sub2=$lee_sql[clave_sub2_ar]&articulo=$lee_sql[clave]' style='text-decoration:none;color:#000000'>$lee_sql[nombre_articulo] de la categoria $lee_sql[nombre_categoria]</a>";
echo "</div>";

echo "<div style='clear:both'></div>";

}//cierra for


}//if($_GET["tipo"]=="sub2"){







}//if($_GET["tipo"]==""){



?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>


</body>
</html>
