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
<title>ARTICULOS</title>

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


<?php	

$sql_ar = mysql_query("select subcategoria_2.*,subcategoria_1.nombre_sub1,categoria.nombre_categoria from subcategoria_2 left outer join subcategoria_1 on subcategoria_2.clave_sub1_s2 = subcategoria_1.clave
left outer join categoria on subcategoria_2.clave_categoria_s2 = categoria.clave where subcategoria_2.idd_empresa_sub2 = '$_SESSION[logeo]' order by subcategoria_2.nombre_sub2 asc");  
	  
$cta_ar = mysql_num_rows($sql_ar);	  
	  
for($d=1;$d<=$cta_ar;$d++){
$l_ar = mysql_fetch_assoc($sql_ar);

echo "<div style='width:400px;float:left;height:40px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px'>
      <span style='font-size:11px;color:#4797ef'><b>$l_ar[nombre_categoria]  > $l_ar[nombre_sub1]</b><span><br>
      <span style='font-size:14px;color:#555555'><b>$l_ar[nombre_sub2]</b><span><br>
      </div>
	  <div style='width:200px;float:left;height:40px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px'>
      <input type='button' style='cursor:pointer;width:180px;height:40px;background-image:url(imagenes/bot_modificar.png);border:0px' onclick=location.href='modifica_subcategoria2_nueva.php?clave_sub2=$l_ar[clave]'>
      </div><div style='clear:both'></div>
	  ";

} //for($d=1;$d<=$cta_ar;$d++){	  
	  
?>

</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
