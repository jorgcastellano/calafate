<?php
include_once("conexion.inc.php");

session_start();

$se_modifico = "no";

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if($_SESSION["tipo"]=="vendedor"){

echo "<script>alert('Solo autorizado para administradores u operadores')</script>";
echo "<script>location.href='index.php'</script>";
die();
}


if(isset($_POST["escribano_modifica"])){


if($_POST["desde"]=="" ){

    	echo "<script>
	      alert('Debe elegir una fecha');	
	      history.go(-1);
		  </script>";
	      die();

}// if($_POST["desde"]=="" ){




//valida fecha
//valida fecha

$partes = explode("/",$_POST["desde"]);

$dia = $partes[0];
$mes = $partes[1];
$ano = $partes[2];

$fecha_carga = date("d/m/Y");

$partes1 = explode("/",$fecha_carga);

$dia1 = $partes1[0];
$mes1 = $partes1[1];
$ano1 = $partes1[2];


//---------------- VALIDA QUE SEA HOY O MA�ANA LA FECHA


$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;

$mess1 = (int)$mes1;
$diaa1 = (int)$dia1;
$anoo1 = (int)$ano1;



$fecha_carga = mktime(00,00,00,$mess1,$diaa1,$anoo1);

$fecha_excursion = mktime(00,00,00,$mess,$diaa,$anoo);


$dif_fechas = $fecha_excursion - $fecha_carga;


if($fecha_carga > $fecha_excursion ){

    	echo "<script>
	      alert('La fecha puesta es anterior al dia de la fecha ');	
	      history.go(-1);
		  </script>";
	      die();

}// if($fecha_dia > $fecha_barco ){




//fin valida fecha
//fin valida fecha


//actualiza---------------------------------------
//actualiza---------------------------------------

$suma_pasajeros = $_GET["suma_pasajeros"];

$sql_ar = mysql_query("select * from articulo where clave_sub2_ar='$_GET[clave_sub2]' and estado='libre' and idd_fecha = '$fecha_excursion' ");
$cta_ar = mysql_num_rows($sql_ar);



if($cta_ar >= $suma_pasajeros){ //ACA VA LA VENTA!!!!!!!!!!!!


mysql_query("UPDATE ventas SET fecha_excur_vs='$fecha_excursion' where id_ventas='$_GET[id]'");


//vuelve a poner en libre los vendidos
//vuelve a poner en libre los vendidos

mysql_query("UPDATE articulo SET estado='libre' where idd_venta_ar='$_GET[id_carga_vs]' ");

//vuelve a poner en libre los vendidos
//vuelve a poner en libre los vendidos



//cambia el estado de lo articulos para la nueva fecha
//cambia el estado de lo articulos para la nueva fecha

for($k=1;$k<=$suma_pasajeros;$k++){
$lee_venta = mysql_fetch_assoc($sql_ar);


mysql_query("UPDATE articulo SET estado='reservado',idd_venta_ar='$_GET[id_carga_vs]' where clave_sub2_ar='$_GET[clave_sub2]' and estado='libre' and clave='$lee_venta[clave]'");

}//for($k=1;$k<=$){


//cambia el estado de lo articulos para la nueva fecha
//cambia el estado de lo articulos para la nueva fecha






//actualiza datos de la ultima modificacion
//actualiza datos de la ultima modificacion

$ffecha= time();

mysql_query("UPDATE ventas SET ult_modificacion_vs='$_SESSION[nombre_usuario]', fecha_ult_modificacion_vs='$ffecha' where id_ventas='$_GET[id]'");

//actualiza datos de la ultima modificacion	 
//actualiza datos de la ultima modificacion	 


//graba historial

mysql_query("INSERT INTO historial_mv (idd_venta_mv,fecha_inicial_mv,fecha_final_mv,operativo_mv) VALUES ('$_GET[id]','$_GET[fecha]','$fecha_excursion','$_SESSION[nombre_usuario]')");


//graba historial

$se_modifico = "si";

}else{ //if($cta_ar >= $suma_pasajeros){ //ACA VA LA VENTA!!!!!!!!!!

echo "<script>alert('No tenemos disponibilidad para los dias solicitados')</script>";

} //if($cta_ar >= $suma_pasajeros){


//fin actualiza---------------------------------------
//fin actualiza---------------------------------------



	 
//header("Location: ventas.php?id_fecha=".$_GET["id_fecha"]);	 
	 
}//if(isset($_POST["escribano_modifica"])){


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>MODIFICA FECHA</title>
<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="validaciones.js"></script>


<script src="src/js/jscal2.js"></script>
    <script src="src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="src/css/steel/steel.css" />

	



	
</head>

<body>

         <div style="background-color:#ffffff;width:100%" > <!-- EEEEE -->

<?php

if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado_vendedor.inc.php");

}else{ //if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado.inc.php");

} //if($_SESSION["tipo"]=="vendedor"){

?>

<div style="padding:10px;width:1000px">


<?php


if($se_modifico == "si"){
echo "<h2>Modificaci�n realizada con exito</h2>";
}//if($se_modifico == "si"){

echo "Elija la fecha nueva para la realizaci�n de la excursi�n: <br><br>";

echo "<form method='post' action='cambia_fecha.php?id_fecha=$_GET[id_fecha]&suma_pasajeros=$_GET[suma_pasajeros]&id=$_GET[id]&fecha=$_GET[fecha]&clave_sub2=$_GET[clave_sub2]&id_carga_vs=$_GET[id_carga_vs]'>
<input style='width:100px' id='desde' name='desde' value='' /><button id='f_btn1'>...</button> <br><br>


<input type='hidden' name='escribano_modifica' value='ok'>

<input type='submit' value='Cambiar' style='height:50px;cursor:pointer'>

</form>
";

?>


<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "desde", "%d/%m/%Y");
      
      

    //]]></script>


</div>  

<?php
echo "<div style='width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px'><a href='ventas.php?id_fecha=$_GET[id_fecha]'><img src='imagenes/bot_volver.png' title='Volver al panel'></a></div>";
 ?> 
       </div> <!-- EEEEE -->


</body>
</html>
