<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if($_SESSION["tipo"]=="vendedor"){

echo "<script>alert('Solo autorizado para administradores')</script>";
echo "<script>location.href='index.php'</script>";
die();
}



?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>CARGAR</title>

<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>

<script>

function paso11(){
if (document.paso1.categoria.value.length==0){
alert("debe elegir una opcion");
document.paso1.categoria.focus();

return 0;
}//if (document.goal.cuerpo.value.length==0){

document.paso1.submit();

} //function paso11(){


function paso22(){
if (document.paso2.subcategoria_1.value.length==0){
alert("debe elegir una opcion");
document.paso2.subcategoria_1.focus();

return 0;
}//if (document.goal.cuerpo.value.length==0){

document.paso2.submit();

} //function paso11(){


</script>

</head>

<body>

<div class="global" >

<?php

include_once("encabezado.inc.php");

?>

<div style="padding:10px">


<h1>CARGAR ARTICULO:</h1>

<?php	

if(isset($_POST["escribano1"])){

echo "<form method='post' action='carga_subcategoria2.php' name='paso2'>";

$sql = mysql_query("select * from subcategoria_1 where publica_sub1 = 'si' and clave_categoria_s1='$_POST[categoria]' order by nombre_sub1 asc ");
$cta_sql = mysql_num_rows($sql);
echo "Elegir sub categoria:<br><br>";

echo "<select name='subcategoria_1'>";

echo "<option value=''></option>";

for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);
$clave = $lee_sql["clave"];
$nombre_sub1 = $lee_sql["nombre_sub1"];

echo "<option value='$clave'>$nombre_sub1</option>";


}// cierra for

echo "</select>";

echo "<input type='hidden' name='escribano2' value='ok'>
      <input type='hidden' name='categoria' value='$_POST[categoria]'>
      <input type='button' value='Siguiente paso' onclick='paso22()'>

      </form>";


}else{ //if(isset($_POST["escribano1"])){

echo "<form method='post' action='$_SERVER[PHP_SELF]' name='paso1'>";

$sql = mysql_query("select * from categoria where publica_categoria = 'si' order by nombre_categoria asc ");
$cta_sql = mysql_num_rows($sql);
echo "Elegir categoria:<br><br>";

echo "<select name='categoria'>";

echo "<option value=''></option>";

for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);
$clave = $lee_sql["clave"];
$nombre_categoria = $lee_sql["nombre_categoria"];

echo "<option value='$clave'>$nombre_categoria</option>";


}// cierra for

echo "</select>";

echo "<input type='hidden' name='escribano1' value='ok'>
      <input type='button' value='Siguiente paso' onclick='paso11()'>

      </form>";


} //if(isset($_POST["escribano1"])){	  
	  
	  
?>

</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
