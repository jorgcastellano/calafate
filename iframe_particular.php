<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<meta name="revisit-after" content="15 days">
<meta name="robots" content="INDEX, FOLLOW">
<!-- <link href="hoja.css" type="text/css" rel="stylesheet"> -->
<script type="text/javascript" src="java.js"></script>
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<META NAME="Description" CONTENT="">

<META NAME="Keywords" CONTENT="">



<title>PLATAFORMA</title>



    <script src="utilidades/src/js/jscal2.js"></script>
    <script src="utilidades/src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/steel/steel.css" />


</head>

<body style="margin:0px">




                                                 

<?php

echo "<div style='background-color:#5448f1;width:$_GET[width]px;height:$_GET[height]px'  >";

if($_GET["clave_s1"]=="1"){
$linkq = "articulo.php?id=$_GET[id]";
}//if($_POST["clave_s1"]=="2"){

if($_GET["clave_s1"]=="2"){
$linkq = "articulo1.php?id=$_GET[id]";
}//if($_POST["clave_s1"]=="2"){

if($_GET["clave_s1"]=="3"){
$linkq = "articulo2.php?id=$_GET[id]";
}//if($_POST["clave_s1"]=="2"){

echo "<form method='post' action='http://localhost/creativos/plata/$linkq' target='_parent' >";


$clave_categoria = $_GET["clave_categoria"];

echo "<br>Cantidad de personas: 
     <select name='cantidad'>
	 
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";	


//fecha


if($clave_categoria == "3"){
echo "<div style='float:left'>Desde la fecha:";
}else{ //if($clave_categoria == "3"){
echo "<div style='float:left'>Fecha de la excursion";
}//if($clave_categoria == "3"){

echo "
<input style='width:100px' id='desde' name='desde' /><button id='f_btn1'>...</button> &nbsp; &nbsp; &nbsp; </div>";

if($clave_categoria == "3"){
echo "<div style='float:left;display:block'>";
}else{ //if($clave_categoria == "3"){
echo "<div style='float:left;display:none'>";
}//if($clave_categoria == "3"){

echo "Hasta la fecha: 
<input style='width:100px' id='hasta' name='hasta' /><button id='f_btn2'>...</button></div><br /><br /> 
<div style='clear:both'></div>
      ";

//fin fecha



echo "<br>
      <input type='hidden' name='id_empresa' value='$_GET[empresa]'>
      <input type='hidden' name='clave_categoria' value='$_GET[clave_categoria]'>
      <input type='hidden' name='clave_s1' value='$_GET[clave_s1]'>
      <input type='submit' value='Buscar' style='height:50px;cursor:pointer'>
      </form>";

?>												  


<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "desde", "%d/%m/%Y");
      cal.manageFields("f_btn2", "hasta", "%d/%m/%Y");
      

    //]]></script>



                                                         </div>




</body>
</html>
