<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


if(isset($_POST["escribano_estado1"])=="ok"){

if($_POST["estado_actual"]!= $_POST["estado"] ){

//actualiza estado en los articulos

if($_POST["estado"]!= "cancelado" ){
mysql_query("UPDATE articulo SET estado='$_POST[estado]' where idd_venta_ar='$_POST[idd_carga]' ");
}else{ //if($_POST["estado"]!= "cancelado" ){
mysql_query("UPDATE articulo SET estado='libre' where idd_venta_ar='$_POST[idd_carga]' ");

$ffecha= time();

mysql_query("INSERT INTO debe (monto_d, idd_vendedor_d,idd_operacion_d,fecha_d) VALUES ('$_POST[sena_vs]','$_SESSION[id_usuario]','$_POST[idd_carga]','$ffecha')");


mysql_query("INSERT INTO vuelto (cantidad_vto,idd_carga_vto,fecha_vto,vendedor_vto) VALUES ('$_POST[sena_vs]','$_POST[idd_carga]','$ffecha','$_SESSION[id_usuario]')");


mysql_query("INSERT INTO sale_bruto (total_sb,idd_vendedor_sb,fecha_sb,idd_carga_sb) VALUES ('$_POST[total_guita_vs]','$_SESSION[id_usuario]','$ffecha','$_POST[idd_carga]')");//carga el total de lo devuelto nuevo

}//if($_POST["estado"]!= "cancelado" ){


//fin actualiza estado en los articulos

//actualiza estado en la venta
mysql_query("UPDATE ventas SET estado_vs='$_POST[estado]' where idd_carga_vs='$_POST[idd_carga]' ");

// // ---- si es corfimado manda mail avisando

if($_POST["estado"]=="confirmado" && $_POST["estado_actual"]!="confirmado con deuda"){
//include("manda_mail_confirma.php");
}//if($_POST["estado"]=="confirmado"){




if($_POST["estado"]=="se�ado"){
//include("manda_mail_sena.php");
}//if($_POST["estado"]=="se�ado"){

// // ---- fin si es corfimado manda mail avisando


//fin actualiza estado en la venta


//actualiza datos de la ultima modificacion
//actualiza datos de la ultima modificacion

$ffecha= time();

mysql_query("UPDATE ventas SET ult_modificacion_vs='$_SESSION[nombre_usuario]', fecha_ult_modificacion_vs='$ffecha' where id_ventas='$_GET[id]'");

//actualiza datos de la ultima modificacion	 
//actualiza datos de la ultima modificacion	 


//graba haber

if($_POST["estado"]=="confirmado" || $_POST["estado"]=="pagado"){

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp,estado_vp) VALUES ('$_POST[idd_carga]','efectivo','peso argentino','1','','','$_POST[dife_sena]','$_SESSION[id_usuario]','$ffecha','')");

if($_POST["dife_sena"] > 0){

mysql_query("INSERT INTO haber (monto_h, idd_vendedor_h,idd_operacion_h,fecha_h) VALUES ('$_POST[dife_sena]','$_SESSION[id_usuario]','$_POST[idd_carga]','$ffecha')");



mysql_query("UPDATE ventas SET sena_vs='$_POST[total_guita_vs]' where id_ventas='$_GET[id]'");


}//if($_POST["dife_sena"] > 0){


} //if($_POST["estado"]=="confirmado"){

//graba haber




echo "<script>
      alert('Ok');
	  location.href='venta_detalle.php?id=$_GET[id]&id_fecha=$_GET[id_fecha]';
      </script>";
die();

}//if($_POST["estado_actual"]!= $_POST["estado"] ){




}//if($_POST["escribano_estado1"]=="ok"){



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>MODIFICA</title>
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
	
//----------------------ajax manda mail

function manda_mail(valor){



try{
 //Firefox, Opera 8.0+, Safari
  xml_2=new XMLHttpRequest();
  }
catch (e){
 // Internet Explorer
  try{
    xml_2=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e){
    try{
      xml_2=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Tu navegador no soporta Ajax");
       }
    }
  }



 xml_2.onreadystatechange=function(){
    if(xml_2.readyState==4){
      
	 // document.write(xml_2.responseText);
       //document.getElementById("calendario").innerHTML=xml_2.responseText
	  }
    }


  xml_2.open("GET","manda_mail_confirma.php?id="+ valor );
  xml_2.send(null);
  

  

  
  }



//----------------------fin ajax manda mail



</script>


	
</head>

<body>

         <div class="global" > <!-- EEEEE -->

<?php

if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado_vendedor.inc.php");

}else{ //if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado.inc.php");

} //if($_SESSION["tipo"]=="vendedor"){

?>

<div style="padding:10px">


<?php


if($_POST["estado_actual"]=="cancelado"){
echo "<script>
     alert('No se puede actualizar el estado de una venta cancelada');
     history.go(-1);
	 </script>";
die();
} //if($_POST["estado_actual"]=="cancelado"){

echo "<div style='font-size:13px;margin-top:10px'>"; //DDDDDDDDDDDDDD

if($_POST["estado"]=="cancelado"){
echo "Est� a punto de cambiar el estado de la venta a <span style='text-transform:uppercase'><b>$_POST[estado] </b></span>: 
Al hacerlo todos los articulos dela misma ser�n puestos a la venta nuevamente. Una vez cancelada la venta no se puede revertir. <br><br> Est� seguro: ";
} //if($_POST["estado"]=="cancelado"){


if($_POST["estado"]=="confirmado"){
echo "Est� a punto de cambiar el estado de la venta a <span style='text-transform:uppercase'><b>$_POST[estado] </b></span>. <br><br> Est� seguro: <br><br><br>";
} //if($_POST["estado"]=="cancelado"){


if($_POST["estado"]=="pagado"){
echo "Est� a punto de cambiar el estado de la venta a <span style='text-transform:uppercase'><b>$_POST[estado] </b></span>. <br><br> Est� seguro: <br><br><br>";
} //if($_POST["estado"]=="cancelado"){


if($_POST["estado"]=="se�ado"){
echo "Est� a punto de cambiar el estado de la venta a <span style='text-transform:uppercase'><b>$_POST[estado] </b></span>. <br><br> Est� seguro: <br><br><br>";
} //if($_POST["estado"]=="cancelado"){



$dife_sena = $_POST["total_guita_vs"] - $_POST["sena_vs"];

echo "<form method='post' action='$_SERVER[PHP_SELF]?id=$_GET[id]&id_fecha=$_GET[id_fecha]'>
    <input type='hidden' name='estado_actual' value='$_POST[estado_actual]'>
    <input type='hidden' name='estado' value='$_POST[estado]'>
	<input type='hidden' name='idd_carga' value='$_POST[idd_carga]'>
	<input type='hidden' name='dife_sena' value='$dife_sena'>
	<input type='hidden' name='total_guita_vs' value='$_POST[total_guita_vs]'>
	<input type='hidden' name='sena_vs' value='$_POST[sena_vs]'>
      <input type='hidden' name='escribano_estado1' value='ok'>
       <input type='button' value='NO' style='cursor:pointer' onclick=location.href='venta_detalle.php?id=$_GET[id]&id_fecha=$_GET[id_fecha]'> &nbsp; &nbsp;<input type='submit' value='SI' style='cursor:pointer'>
	  </form>
   ";


echo "</div>"; //DDDDDDDDDDDDDD



?>


</div>  

<?php
echo "<div style='width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px'><a href='ventas.php?id_fecha=$_GET[id_fecha]'><img src='imagenes/bot_volver.png' title='Volver al panel'></a></div>";
?>
  
       </div> <!-- EEEEE -->

	   
	   

</body>
</html>



