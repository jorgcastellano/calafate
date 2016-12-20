<?php
include_once("conexion.inc.php");
session_start();

if(isset($_POST["escribano_login"])=="ok"){




$nick_rita = $_POST["nick"];
$contrasena_rita = $_POST["contrasena"];

$sql_usu = mysql_query("select * from usuario where (nombre_usuario = '$nick_rita' or mail_usuario = '$nick_rita')  and contrasena_usuario='$contrasena_rita' and habilitar_usuario='si' ");
$cta_usu = mysql_num_rows($sql_usu);

if($cta_usu > 0){

				 $l_sql_usu = mysql_fetch_assoc($sql_usu);

				 //session_register("logeo");
				 $_SESSION["logeo"]= $l_sql_usu["idd_empresa_usuario"];
				 $_SESSION["tipo"]= $l_sql_usu["tipo_usuario"];
				 $_SESSION["nombre_usuario"]= $l_sql_usu["nombre_usuario"];
				 $_SESSION["id_usuario"]= $l_sql_usu["id_usuario"];

			       } else{ //if($cta_usu > 0){

			       echo "<script>alert('DATOS MAL INGRESADOS O USUARIO INEXISTENTE')</script>";
				   die();


				          } //if($cta_usu > 0){


}


?>


<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8" />
<title>PANEL DE CONTROL</title>

<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="java.js"></script>

<link rel="stylesheet" href="css/style.css">
<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->


</head>

<body>



<?php


//crea saludo y cierre de sesion

if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]!=""){

echo "<div style='width:95%;padding-right:5px;text-align:right;color:#ffffff;font-size:12px;position:absolute;line-height:16px;margin-top:84px'>
     Hola, <span style='text-transform:uppercase'><b> $_SESSION[nombre_usuario] </b></span>, bienvenido <br>
	 <a href='login.php?cerrar=si' style='color:#ffffff;text-decoration:none'><b>CERRAR SESION</b></a>
     </div>";



}//if($_SESSION["tipo"]!=""){



//fin crea saludo y cierre de sesion


echo "<div style='padding:0px'>";

if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="superadmin"){

echo "<div class='encabezado'>

<div style='height:150px;padding-top:47px;margin-left:5px'><!-- qazwsxedc -->


      <a href='empresas.php'><div style='background-image:url(imagenes/boton.png)' class='boton2'><!-- fv -->
<div style='height:30px;margin-top:30px;width:10px'> </div>

<div style='height:62px;margin-top:5px'><b>VER <BR> EMPRESAS</b></div>
</div></a><!-- fv -->

      <a href='carga_transacciones.php'><div style='background-image:url(imagenes/boton.png)' class='boton2'><!-- fv -->
<div style='height:30px;margin-top:30px;width:10px'> </div>

<div style='height:62px;margin-top:5px'><b>CARGAR <BR> TRANSACCIONES</b></div>
</div></a><!-- fv -->

      <a href='carga_subcategoria1.php'><div style='background-image:url(imagenes/boton.png)' class='boton2'><!-- fv -->
<div style='height:30px;margin-top:30px;width:10px'> </div>

<div style='height:62px;margin-top:5px'><b>CARGAR <BR> SUBCATEGORIAS</b></div>
</div></a><!-- fv -->

      <a href='modifica_subcategoria1.php'><div style='background-image:url(imagenes/boton.png)' class='boton2'><!-- fv -->
<div style='height:30px;margin-top:30px;width:10px'> </div>

<div style='height:62px;margin-top:5px'><b>MODIFICA <BR> SUBCATEGORIAS</b></div>
</div></a><!-- fv -->

      <a href='carga_empresa.php'><div style='background-image:url(imagenes/boton.png)' class='boton2'><!-- fv -->
<div style='height:30px;margin-top:30px;width:10px'> </div>

<div style='height:62px;margin-top:5px'><b>CARGA <BR> EMPRESA</b></div>
</div></a><!-- fv -->




</div><!-- qazwsxedc -->
<div style='clear:both'></div>
	 </div>";

} //if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="superadmin"){


if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="administrador"){

include_once("encabezado.inc.php");


}//if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="administrador"){



if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="vendedor"){

include_once("encabezado_vendedor.inc.php");


}//if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="administrador"){


if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="operativo"){

include_once("encabezado_operativo.inc.php");


}//if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="operativo"){



if(isset($_SESSION["logeo"])==""){

echo "
<div class='encabezado'>
<div style='color:#fff;font-size:25px;padding-top:150px;padding-left:50px'>BIENVENIDOS </div>
</div>";

}//if!(isset($_SESSION["logeo"]){




echo "</div>";

?>








         <div class="global" style="background-color:#0ca3d2;padding-top:50px;padding-bottom:50px"><!-- global -->





<?php

//inicio sesin de seguridad






if(isset($_SESSION["logeo"])==""){


echo " <div class='login' >
     <h1>INGRESAR</h1>
      <form method='post' action='$_SERVER[PHP_SELF]'>
        <p><input type='text' name='nick' value='' placeholder='Email'></p>
        <p><input type='password' name='contrasena' value='' placeholder='Password'></p>
        <input type='hidden' name='escribano_login' value='ok'>
        <p class='submit'><input type='submit' name='commit' value='Entrar' style='cursor:pointer'></p>

      </form>
    </div>";

echo "<br><div style='text-align:center'><a href='carga_empresa.php' style='font-size:14px;color:#fff'>Resgistrarse</a></div>";


die();
}



//fin sesion de seguridad

?>







       </div><!-- global -->


</body>
</html>
