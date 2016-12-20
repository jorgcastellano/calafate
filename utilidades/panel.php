<?php
include_once("conexion.inc.php");
session_start();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>PANEL DE CONTROL</title>

<link href="hoja.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="java.js"></script>


</head>

<body>

         <div class="global"><!-- global -->

<div class="encabezado"></div>



<?php

//inicio sesin de seguridad


if(isset($_POST["escribano_login"])=="ok"){




$nick_rita = $_POST["nick"]; 
$contrasena_rita = $_POST["contrasena"]; 

$sql_usu = mysql_query("select * from usuario where (nombre_usuario = '$nick_rita' or mail_usuario = '$nick_rita')  and contrasena_usuario='$contrasena_rita' ");
$cta_usu = mysql_num_rows($sql_usu);

if($cta_usu > 0){
                 
				 $l_sql_usu = mysql_fetch_assoc($sql_usu);
				 
				 //session_register("logeo");
				 $_SESSION["logeo"]= $l_sql_usu["idd_empresa_usuario"];
				 $_SESSION["tipo"]= $l_sql_usu["tipo_usuario"];
			
			       } else{ //if($cta_usu > 0){
			
			       echo "<script>alert('DATOS MAL INGRESADOS O USUARIO INEXISTENTE')</script>";				   
				   die();		   
				         						 
						 					 
				          } //if($cta_usu > 0){
                          

}



if(isset($_SESSION["logeo"])==""){

echo "<div style='margin-left:50px;color:#000000;font-family:arial'>";

echo "<form method='post' action='$_SERVER[PHP_SELF]'>";
echo "Usuario:<br>";
echo "<input type='text' name='nick'><br><br>";

echo "Contrase�a:<br>";
echo "<input type='password' name='contrasena'><br><br>";

echo "<input type='hidden' name='escribano_login' value='ok'>";
echo "<input type='submit' value='Iniciar sesion'>";

echo "</form>";

echo "</div>";
die();
}



//fin sesion de seguridad

echo "<div style='padding:10px'>";

if($_SESSION["tipo"]=="superadmin"){

echo "<input type='button' value='Ver empresas' onclick=location.href='empresas.php' class='boton' ><br>
      
      <input type='button' value='Cargar transacciones' onclick=location.href='carga_transacciones.php' class='boton' ><br><br>
	  
	  <input type='button' value='Cargar subcategorias' onclick=location.href='carga_subcategoria1.php' class='boton' ><br>
	  
	  <input type='button' value='Modifica subcategorias' onclick=location.href='modifica_subcategoria1.php' class='boton' ><br><br>

      <input type='button' value='Cerrar sesion' onclick=location.href='login.php?cerrar=si' class='boton' ><br>
     ";

}else{ //if($_SESSION["tipo"]=="superadmin"){

echo "<input type='button' value='Cargar nuevo articulo' onclick=location.href='paso1.php' class='boton' ><br>
<input type='button' value='Ver articulos' onclick=location.href='ver_subcategoria2.php' class='boton' ><br>
<input type='button' value='Ver ventas' onclick=location.href='ventas.php' class='boton' ><br>
<!--<input type='button' value='Configuraciones generales' onclick=location.href='configuracion.php' class='boton' ><br>-->
<input type='button' value='Modificar datos de la empresa' onclick=location.href='modifica_empresa.php' class='boton' ><br><br>
<input type='button' value='Cerrar sesion' onclick=location.href='login.php?cerrar=si' class='boton' ><br>


     ";


}//if($_SESSION["tipo"]=="superadmin"){


echo "</div>";

?>





<!--
<input type="button" value="Cargar categoria" onclick="location.href='carga_categoria.php'" style="cursor:pointer" ><br>
<input type="button" value="Cargar subcategoria 1" onclick="location.href='carga_subcategoria1.php'" style="cursor:pointer" ><br>
<input type="button" value="Cargar subcategoria 2" onclick="location.href='carga_subcategoria2.php'" style="cursor:pointer" ><br>
<input type="button" value="Cargar articulo" onclick="location.href='carga_articulo1.php'" style="cursor:pointer" ><br><br>

<input type="button" value="Cargar o modificar fotos" onclick="location.href='carga_foto1.php'" style="cursor:pointer" ><br><br>


<input type="button" value="Modificar categoria" onclick="location.href='modifica_categoria.php'" style="cursor:pointer" ><br>
<input type="button" value="Modificar subcategoria 1" onclick="location.href='modifica_subcategoria1.php'" style="cursor:pointer" ><br>
<input type="button" value="Modificar subcategoria 2" onclick="location.href='modifica_subcategoria2.php'" style="cursor:pointer" ><br>
<input type="button" value="Modificar articulo" onclick="location.href='modifica_articulo.php'" style="cursor:pointer" ><br><br>
-->





       </div><!-- global -->
	   
	   
</body>
</html>
