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
<title>CONFIGURACION</title>
<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="validaciones.js"></script>


<script src="src/js/jscal2.js"></script>
    <script src="src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="src/css/steel/steel.css" />

	
<script>	
function cambia(valor){


for(d=1;d<=4;d++){



if(d==valor){
document.getElementById(d).style.display="block";

}else{ //if(d==valor){
document.getElementById(d).style.display="none";
} //if(d==valor){


}


}


</script>


	
	


	
</head>

<body>

         <div class="global" >

<?php

include_once("encabezado.inc.php");

?>

<div style="padding:10px"> <!-- """""" -->

<h3>OBTENCION DE CODIGOS DE MERCADOPAGO</h3><br><br>

<div style="color:#555555;font-size:14px"> <!-- QQQQ -->

1) Debe crear previamente su cuenta en <a href="http://www.mercadopago.com" target="_blank" style="text-decoration:none;color:#555555"><b>MERCADOPAGO</b></a> <br>
2) Hacer click <a href="https://www.mercadopago.com/mla/cartdata " target="_blank" style="text-decoration:none;color:#555555"><b>AQUI</b></a> para ver los codigos necesarios que deben ser copiados y pegados en el casillero correspondiente de nuestro panel de control (ver imagen inferior) <br><br>

<img src="imagenes/codigos_mp.jpg">



</div> <!-- QQQQ -->

	
</div>  <!-- """""" -->

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="javascript:history.go(-1)"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
