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

for(d=1;d<=8;d++){



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


<div style="width:180px;float:left;margin-left:10px;background-color:#f3f3f3;padding-top:20px;margin-top:10px;padding-left:20px;padding-bottom:20px;margin-right:30px"><!-- columna 1 -->

<input type="button" value="Cotizacion monedas" onclick="cambia('1')" class="boton1"><br>
<input type="button" value="Condiciones legales" onclick="cambia('2')" class="boton1"><br>
<input type="button" value="Contador de billetes" onclick="cambia('3')" class="boton1"><br>
<input type="button" value="Medios de pagos" onclick="cambia('4')" class="boton1"><br>
<input type="button" value="Guias de turismo" onclick="cambia('5')" class="boton1"><br>
<input type="button" value="Agencia" onclick="cambia('6')" class="boton1"><br>
<input type="button" value="Vehiculos" onclick="cambia('7')" class="boton1"><br>
<input type="button" value="Chofer" onclick="cambia('8')" class="boton1"><br>


</div> <!-- columna 1 -->

<div style="padding:10px;float:left"><!-- columna 2 -->


<?php

echo "<div style='display:none' id='1'>";
    
include_once("monedas_config.inc.php");



echo "</div>";




echo "<div style='display:none' id='2'>";


include_once("legales_config.inc.php");  


echo "</div>";




echo "<div style='display:none' id='3'>";


include_once("contador_config.inc.php");


echo "</div>";



echo "<div style='display:none' id='4'>";



include_once("medios_pagos_config.inc.php");

echo "</div>";


echo "<div style='display:none' id='5'>";



include_once("config_guias.inc.php");

echo "</div>";


echo "<div style='display:none' id='6'>";



include_once("config_agencia.inc.php");

echo "</div>";


echo "<div style='display:none' id='7'>";

include_once("config_vehiculo.inc.php");

echo "</div>";


echo "<div style='display:none' id='8'>";

include_once("config_chofer.inc.php");

echo "</div>";


?>








<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "desde", "%d/%m/%Y");
      cal.manageFields("f_btn2", "hasta", "%d/%m/%Y");
	  cal.manageFields("f_btn11", "desde_cupon", "%d/%m/%Y");
      cal.manageFields("f_btn22", "hasta_cupon", "%d/%m/%Y");
      

    //]]></script>

	
</div>  <!-- fin columna 2 -->


<div style="clear:both"></div>	
	
	
</div>  <!-- """""" -->

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
