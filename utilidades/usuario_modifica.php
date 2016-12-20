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


$se_cargo = "no";

if(isset($_POST["escribano_usuario"])=="ok"){

if($_POST["contrasena"]!=""){

$contrasena = "contrasena_usuario= '$_POST[contrasena]',";

}else{ //if($_POST["contrasena"]!=""){

$contrasena = "";

}//if($_POST["contrasena"]!=""){

mysql_query("UPDATE usuario SET
nombre_persona_usuario= '$_POST[nombre]',
nombre_usuario= '$_POST[nombre]',
$contrasena
tipo_usuario= '$_POST[usuario]',
mail_usuario= '$_POST[mail_usuarios]',
comision_usuario= '$_POST[comision]',
habilitar_usuario=	'$_POST[habilitar]'
where id_usuario='$_GET[id]'");

$se_cargo = "si";



}//if(isset($_POST["escribano_usuario"])=="ok"){


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>USUARIOS</title>

<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>
<script type="text/javascript" src="validaciones.js"></script>

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

if($se_cargo == "si"){

echo "<div style='text-align:center;height:50px;line-height:50px;background-color:#70ea6a;color:#097904;font-size:12px'><b>Modificaci�n OK </b></div><br />";

} //if($se_cargo == "si"){



///// cargar modificar


$sql_u = mysql_query("select * from usuario where id_usuario='$_GET[id]' ");
$lee_u = mysql_fetch_assoc($sql_u);

echo "<div style='height:40px;padding:5px;margin-left:2px;margin-bottom:2px;line-height:40px'>
      
      <span style='font-size:18px;color:#555555'><b>MODIFICAR USUARIO</b><span><br>
      </div>
	  
	<form method='post' action='$_SERVER[PHP_SELF]?id=$_GET[id]' name='usuarios'>";  
	
echo "<br><div style='width:100px;float:left'>Nombre:</div>
      <div style='width:250px;float:left'><input type='text' name='nombre' value='$lee_u[nombre_usuario]'></div>
      <div style='clear:both'></div>
      ";
	  
echo "<br><div style='width:100px;float:left'>Mail:</div>
      <div style='width:250px;float:left'><input type='text' name='mail_usuarios' value='$lee_u[mail_usuario]'></div>
      <div style='clear:both'></div>
      ";	  

echo "<br><div style='width:100px;float:left'>Contrase�a <br>(si la deja vacia no se cambiar�):</div>
      <div style='width:250px;float:left'><input type='text' name='contrasena' value=''></div>
      <div style='clear:both'></div>
      ";	  
	  
	  
echo "<br><div style='width:100px;float:left'>Tipo usuario:</div>
      <div style='width:250px;float:left'>
	  <select name='usuario'>";
	 
if($lee_u["tipo_usuario"]=="administrador"){
	 
echo "<option selected>administrador</option>
	  <option>vendedor</option>
	  <option>operativo</option>";

}//if($lee_u["tipo_usuario"]=="administrador"){


if($lee_u["tipo_usuario"]=="vendedor"){

echo "<option >administrador</option>
	  <option selected>vendedor</option>
	  <option>operativo</option>
	  ";


}//if($lee_u["tipo_usuario"]=="vendedor"){	 


if($lee_u["tipo_usuario"]=="operativo"){

echo "<option >administrador</option>
	  <option >vendedor</option>
	  <option selected>operativo</option>
	  ";


}//if($lee_u["tipo_usuario"]=="operativo"){	  
	  
	  
	  echo "</select></div>
      <div style='clear:both'></div>
      ";	  

echo "<br><div style='width:100px;float:left'>Comisi�n:</div>
      <div style='width:250px;float:left'>
	  <select name='comision'>";
	  
	  for($i=0;$i<=100;$i++){
	  
	  if($lee_u["comision_usuario"]==$i){
	  echo "<option selected>$i</option>";
	  }else{ //if($lee_u["comision_usuario"]==$i){
	  echo "<option>$i</option>";
	  } //if($lee_u["comision_usuario"]==$i){
	  
	  }//for($i=0;$i<=100;$i++){

	  
	  echo  "</select></div>
      <div style='clear:both'></div>
      ";	
	  
	  
echo "<br><div style='width:100px;float:left'>Habilitar:</div>
      <div style='width:250px;float:left'>
	  <select name='habilitar'>";
	  
	  	  
	  if($lee_u["habilitar_usuario"]=="si"){
	  echo "<option selected>si</option>";
	  echo "<option >no</option>";
	  }else{ //if($lee_u["habilitar_usuario"]=="si"){
	  echo "<option >si</option>";
	  echo "<option selected>no</option>";
	  } //if($lee_u["habilitar_usuario"]=="si"){
	  
	  
	  
	  echo  "</select></div>
      <div style='clear:both'></div>
      ";		  
	  
	  

echo "<input type='hidden' name='escribano_usuario' value='ok'>";
echo "<input type='button' onclick='usuarioss_mod()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >
</form>
";

///// fin modificar


	  
?>

</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="usuarios.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
