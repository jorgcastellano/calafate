<?php

include_once("../conexion.inc.php");

//-------------------------------
if($_POST["escribano_agregar"]=="ok"){
//verifica si estan completo los campos
if($_POST["texto_agregar"]==""){
echo "<script>alert('DEBE PONERLE UN NOMBRE A LA CATEGORIA')</script>";
echo "<script>parent.location='categoria.php?accion=$_POST[accion]'</script>";
}
//fin verifica si estan completo los campos

$texto = htmlentities($_POST["texto_agregar"]);
$texto_final = strtolower($texto);

$busca_categoria = mysql_query("SELECT * from categoria where texto = '$texto_final'");
$cta_categoria = mysql_num_rows($busca_categoria);

if($cta_categoria >0){
echo "<script>alert('YA EXISTE UNA CATEGORIA CON ESE NOMBRE')</script>";
echo "<script>parent.location='categoria.php?accion=$_POST[accion]'</script>";
}else{
mysql_query("INSERT INTO categoria (texto) VALUES ('$texto_final')");

$sql = mysql_query("select * from categoria where texto = '$texto_final'");
$lee_sql = mysql_fetch_assoc($sql);
$nombre_carpeta = $lee_sql["clave"];

mkdir("../categorias/".$nombre_carpeta, 0777);
echo "<script>alert('OPERACION EXITOSA')</script>";
echo "<script>parent.location='index.php'</script>";
     }



}
//-------------------------------

//-------------------------------

if($_POST["escribano_modificar"]=="ok"){

//verifica si estan completo los campos
if($_POST["texto_modificar"]==""){
echo "<script>alert('DEBE PONERLE UN NOMBRE A LA CATEGORIA')</script>";
echo "<script>parent.location='categoria.php?accion=$_POST[accion]'</script>";
}
//fin verifica si estan completo los campos


$texto = htmlentities($_POST["texto_modificar"]);
$texto_final = strtolower($texto);

mysql_query("UPDATE categoria SET texto = '$texto_final' where texto = '$_POST[categoria]' ");
echo "<script>alert('OPERACION EXITOSA')</script>";
echo "<script>parent.location='index.php'</script>";

}

//-------------------------------

if($_POST["escribano_eliminar"]=="ok"){

$busca_archivos = mysql_query("select * from subcategoria where clave_categoria = '$_POST[categoria]'");
$cta_archivos = mysql_num_rows($busca_archivos);
for($a=1;$a<=$cta_archivos;$a++){
$lee_archivos = mysql_fetch_assoc($busca_archivos);
if($lee_archivos["foto"]!=""){
unlink($lee_archivos["foto"]);
                             }

}//cierra for

$busca_archivos1 = mysql_query("select * from contenido where clave_categoria = '$_POST[categoria]'");
$cta_archivos1 = mysql_num_rows($busca_archivos1);
for($b=1;$b<=$cta_archivos1;$b++){
$lee_archivos1 = mysql_fetch_assoc($busca_archivos1);
if($lee_archivos1["foto"]!=""){
unlink($lee_archivos1["foto"]);
                             }

if($lee_archivos1["video"]!=""){
unlink($lee_archivos1["video"]);
                             }


}//cierra for

$busca_archivos2 = mysql_query("select * from material where clave_categoria = '$_POST[categoria]'");
$cta_archivos2 = mysql_num_rows($busca_archivos2);
for($c=1;$c<=$cta_archivos1;$c++){
$lee_archivos2 = mysql_fetch_assoc($busca_archivos2);
if($lee_archivos2["foto"]!=""){
unlink($lee_archivos2["foto"]);
                             }

if($lee_archivos2["video"]!=""){
unlink($lee_archivos2["video"]);
                             }


}//cierra for

mysql_query("DELETE from categoria where clave = '$_POST[categoria]'");
mysql_query("DELETE from subcategoria where clave_categoria = '$_POST[categoria]'");
mysql_query("DELETE from contenido where clave_categoria = '$_POST[categoria]'");
mysql_query("DELETE from material where clave_categoria = '$_POST[categoria]'");

echo "<script>alert('OPERACION EXITOSA')</script>";
echo "<script>parent.location='index.php'</script>";

}


//-------------------------------



?>





<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<?php


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

                                                                 <div class="global">
<div style="text-align:center">
<?php
//FORM PARA AGREGAR CATEGORIAS----------------------------------------

if($_GET["accion"]=="agregar"){
echo "<form method='post' action=$_SERVER[PHP_SELF]>";

echo "<br><img src='botones/agregar_categoria.jpg' width=100><br><br>";

echo "<span class='linea_panel'>Nombre de la categoria a crear:&nbsp;&nbsp;</span>";
echo "<input type='text' name='texto_agregar'>";
echo "<input type='hidden' name='accion' value='$_GET[accion]'";
echo "<input type='hidden' name='escribano_agregar' value='ok'><br><br>";
echo "<input type='submit' value='Cargar' style='width:200px'>";

echo "</form>";
}
//FIN FORM PARA AGREGAR CATEGORIAS----------------------------------------

//FORM PARA MODIFICAR CATEGORIAS----------------------------------------

if($_GET["accion"]=="modificar"){



echo "<form method='post' action=$_SERVER[PHP_SELF]>";
echo "<br><span class='linea_panel'>Elija la categoria que desea modificar:&nbsp;&nbsp;</span>";
echo "<select name=categoria>";
$busca_categoria = mysql_query("select * from categoria");
$cta_categoria = mysql_num_rows($busca_categoria);
for($c =1;$c<=$cta_categoria;$c++){
$lee_categoria = mysql_fetch_assoc($busca_categoria);
echo "<option>$lee_categoria[texto]</option><br>";

     }
echo "</select><br><br><br>";

echo "<span class='linea_panel'>Coloque el nuevo nombre a la categoria:&nbsp;&nbsp;</span>";
echo "<input type='text' name='texto_modificar'>";
echo "<input type='hidden' name='accion' value='$_GET[accion]'";
echo "<input type='hidden' name='escribano_modificar' value='ok'><br><br>";
echo "<input type='submit' value='Modificar' style='width:200px'>";

echo "</form>";



}
//FIN PARA MODIFICAR CATEGORIAS----------------------------------------

//FORM PARA ELIMINAR CATEGORIAS----------------------------------------

if($_GET["accion"]=="eliminar"){

echo "<div style='width:650px;font-size:14px;font-family:arial;text-align:justify'>";
echo "<br><br><b>ATENCION:</b>&nbsp;Al eliminar una categoria tambi�n se borrar�n todas las subcategorias y todo el material que esta contenga.";
echo "</div>";


echo "<form method='post' action=$_SERVER[PHP_SELF]>";
echo "<br><span class='linea_panel'>Elija la categoria que desea eliminar:&nbsp;&nbsp;</span>";
echo "<select name=categoria>";
$busca_categoria = mysql_query("select * from categoria");
$cta_categoria = mysql_num_rows($busca_categoria);
for($c =1;$c<=$cta_categoria;$c++){
$lee_categoria = mysql_fetch_assoc($busca_categoria);
echo "<option value=$lee_categoria[clave]>$lee_categoria[texto]</option><br>";

     }
echo "</select><br><br><br>";

echo "<input type='hidden' name='accion' value='$_GET[accion]'";
echo "<input type='hidden' name='escribano_eliminar' value='ok'><br><br>";
echo "<input type='submit' value='Eliminar' style='width:200px'>";

echo "</form>";



}
//FIN FORM ELIMINAR CATEGORIAS----------------------------------------




?>

</div>
<div style="text-align:center;margin-top:30px">
<img src="botones/volver.jpg" onclick="location.href='index.php'" style="cursor:pointer">
</div>

                                                                       </div>

</body>
</html>
