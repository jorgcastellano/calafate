<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


if(isset($_POST["escribano_modifica"])){

if($_POST["tiene_data"]=="si"){

mysql_query("UPDATE ventas_info SET
vehiculo_vi='$_POST[vehiculo]',
hotel_vi='$_POST[hotel]',
agencia_vi='$_POST[agencia]',
vuelo_vi='$_POST[vuelo]',
llega_vi='$_POST[llega]',
sale_vi='$_POST[sale]',
cont_htl_vi='$_POST[cont_htl]',
chofer_vi='$_POST[chofer]',
guia_vi='$_POST[guia]',
observaciones_vi='$_POST[observaciones]',
ipn_vi='$_POST[ipn]',
alzo_vi='$_POST[alzo]',
nav_vi='$_POST[nav]',
trekk_vi='$_POST[trekk]', 
cod_vi='$_POST[cod]'
     where idd_ventas_vi='$_GET[id]'");
	 
	 

}else{ //if($_POST["tiene_data"]=="si"){

mysql_query("INSERT INTO ventas_info
(
idd_ventas_vi,
vehiculo_vi,
hotel_vi,
agencia_vi,
vuelo_vi,
llega_vi,
sale_vi,
cont_htl_vi,
chofer_vi,
guia_vi,
observaciones_vi,
ipn_vi,
alzo_vi,
nav_vi,
trekk_vi, 
cod_vi
)VALUES(
'$_GET[id]',
'$_POST[vehiculo]',
'$_POST[hotel]',
'$_POST[agencia]',
'$_POST[vuelo]',
'$_POST[llega]',
'$_POST[sale]',
'$_POST[cont_htl]',
'$_POST[chofer]',
'$_POST[guia]',
'$_POST[observaciones]',
'$_POST[ipn]',
'$_POST[alzo]',
'$_POST[nav]',
'$_POST[trekk]', 
'$_POST[cod]'
)
            ");



	

}//if($_POST["tiene_data"]=="si"){


//actualiza datos de la ultima modificacion
//actualiza datos de la ultima modificacion

$ffecha= time();

mysql_query("UPDATE ventas SET ult_modificacion_vs='$_SESSION[nombre_usuario]', fecha_ult_modificacion_vs='$ffecha' where id_ventas='$_GET[id]'");

//actualiza datos de la ultima modificacion	 
//actualiza datos de la ultima modificacion	 
	 
	 
header('Location: ventas.php');	 
	 
}//if(isset($_POST["escribano_modifica"])){


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>VENTAS</title>
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

<div style="padding:10px">


<?php

$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and id_ventas = '$_GET[id]' order by id_ventas desc");


$c_sql = mysql_num_rows($sql);


echo "<div style='width:20px;height:20px;float:left;background-color:#05cd0a'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Libre</div>
	
      <div style='width:20px;height:20px;float:left;background-color:#f8a505;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Reservado</div>
	  
	   <div style='width:20px;height:20px;float:left;background-color:#32ebd7;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Confirmado</div>
	
	  <div style='width:20px;height:20px;float:left;background-color:#ff0000;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Cancelado</div>
	  
	  <div style='clear:both'></div><br>
      
	 ";




	  
	  
for($l=1;$l<=$c_sql;$l++){

$l_sql = mysql_fetch_assoc($sql);

//busca nombre articulo
$sql_sub2 = mysql_query("select * from subcategoria_2 where clave='$l_sql[idd_sub2_vs]'");
$l_sql_sub2 = mysql_fetch_assoc($sql_sub2);



$nombre_sub2 = $l_sql_sub2["nombre_sub2"]; 

//fin busca nombre articulo

//busca comprador

$sql_p = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador'");
$cta_p = mysql_num_rows($sql_p);

if($cta_p > 0){

$nombre_comprador = "";





for($c=1;$c<=2;$c++){
$lee_p = mysql_fetch_assoc($sql_p);
$nombre_comprador = $nombre_comprador.$lee_p["campo2_p"]." ";

} //for($c=1;$c<=$cta_p;$c++){
}else{ //if($cta_p > 0){

$nombre_comprador = "";

}//if($cta_p > 0){



//fin busca comprador

if($l_sql["estado_vs"] == "libre"){
$fondo_articulo = "#05cd0a";

} //if($l_con_fecha["estado"] == "libre"){

if($l_sql["estado_vs"] == "reservado"){
$fondo_articulo = "#f8a505";

} //if($l_con_fecha["estado"] == "reservado"){

if($l_sql["estado_vs"] == "cancelado"){
$fondo_articulo = "#ff0000";

} //if($l_con_fecha["estado"] == "cancelado"){

if($l_sql["estado_vs"] == "confirmado"){
$fondo_articulo = "#32ebd7";

} //if($l_con_fecha["estado"] == "confirmado"){


//busca vendedor

$sql_ven = mysql_query("select nombre_usuario from usuario where id_usuario='$l_sql[vendedor_vs]'");
$l_ven = mysql_fetch_assoc($sql_ven);
$vendedor = $l_ven["nombre_usuario"];
//fin busca vendedor





//busca VENTAS INFO


$sql_vi = mysql_query("select * from ventas_info where idd_ventas_vi = '$l_sql[id_ventas]' ");
$cta_vi = mysql_num_rows($sql_vi);

if($cta_vi>0){
$tiene_data = "si";
}else{ //if($cta_vi>0){
$tiene_data = "no";
}//if($cta_vi>0){


$l_vi = mysql_fetch_assoc($sql_vi);


//fin busca VENTAS INFO



echo "<div style='font-size:10px;margin-bottom:2px;margin-left:10px'>
            
      <br><br><br>
	   
	   <form method='post' action='ventas_modifica.php?id=$_GET[id]'>
	
	    <div style='width:150px;float:left;color:#0061cc'><b>Vehiculo </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Hotel </b> </div>
	  <div style='width:150px;float:left;color:#0061cc'><b>Agencia </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Vuelo </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Llega </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Sale </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Contacto htl </b> </div>
	  <div style='width:150px;float:left;color:#0061cc'><b>Chofer </b> </div>
	  <div style='clear:both'></div>";
	

	
echo  "<div style='width:150px;float:left'><select name='vehiculo' style='width:140px;margin-top:3px' >
      <option value=''></option>
       "; 
 
      $sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='vehiculo' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  for($u=1;$u<=$c_ad;$u++){
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  
	  if($l_vi["vehiculo_vi"] == $l_ad["nombre_da"]){
	  echo "<option selected>$l_ad[nombre_da]</option>";
	  }else{//if($l_vi["vehiculo_vi"] == $l_ad["nombre_da"]){
	  echo "<option >$l_ad[nombre_da]</option>";
	  } //if($l_vi["vehiculo_vi"] == $l_ad["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_ad;$u++){
	  

echo  "</select></div>
	  
	  
	  <div style='width:100px;float:left'><input type='text' name='hotel' style='width:80px;margin-top:3px' value='$l_vi[hotel_vi]' > </div>";
	  
	  echo  "<div style='width:150px;float:left'><select name='agencia' style='width:140px;margin-top:3px' >
      <option value=''></option>
       "; 
 
      $sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='agencia' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  for($u=1;$u<=$c_ad;$u++){
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  
	  if($l_vi["agencia_vi"] == $l_ad["nombre_da"]){
	  echo "<option selected>$l_ad[nombre_da]</option>";
	  }else{//if($l_vi["agencia_vi"] == $l_ad["nombre_da"]){
	  echo "<option >$l_ad[nombre_da]</option>";
	  } //if($l_vi["agencia_vi"] == $l_ad["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_ad;$u++){
	  

echo  "</select></div>";

	  
	  
	  echo "<div style='width:100px;float:left'><input type='text' name='vuelo' style='width:80px;margin-top:3px' value='$l_vi[vuelo_vi]' > </div>
	  <div style='width:100px;float:left'><input type='text' name='llega' style='width:80px;margin-top:3px' value='$l_vi[llega_vi]' > </div>
	  <div style='width:100px;float:left'><input type='text' name='sale' style='width:80px;margin-top:3px' value='$l_vi[sale_vi]' > </div>
	  <div style='width:100px;float:left'><input type='text' name='cont_htl' style='width:80px;margin-top:3px' value='$l_vi[cont_htl_vi]' > </div>";
	  
	  	  echo  "<div style='width:150px;float:left'><select name='chofer' style='width:140px;margin-top:3px' >
      <option value=''></option>
       "; 
 
      $sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='chofer' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  for($u=1;$u<=$c_ad;$u++){
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  
	  if($l_vi["chofer_vi"] == $l_ad["nombre_da"]){
	  echo "<option selected>$l_ad[nombre_da]</option>";
	  }else{//if($l_vi["chofer_vi"] == $l_ad["nombre_da"]){
	  echo "<option >$l_ad[nombre_da]</option>";
	  } //if($l_vi["chofer_vi"] == $l_ad["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_ad;$u++){
	  

echo  "</select></div>";

	  
	  echo "<div style='clear:both'></div>
	  
	  <br><br>
	  
	  
	  	  <div style='width:150px;float:left;color:#0061cc'><b>Guia </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Obs </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>IPN </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Alzo </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Nav </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Treckk </b> </div>
	  <div style='width:100px;float:left;color:#0061cc'><b>Cod </b> </div>	  
	    <div style='clear:both'></div>";
		
		
	  echo  "<div style='width:150px;float:left'><select name='guia' style='width:140px;margin-top:3px' >
      <option value=''></option>
       "; 
 
      $sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='guias' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  for($u=1;$u<=$c_ad;$u++){
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  
	  if($l_vi["guia_vi"] == $l_ad["nombre_da"]){
	  echo "<option selected>$l_ad[nombre_da]</option>";
	  }else{//if($l_vi["guia_vi"] == $l_ad["nombre_da"]){
	  echo "<option >$l_ad[nombre_da]</option>";
	  } //if($l_vi["guia_vi"] == $l_ad["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_ad;$u++){
	  

echo  "</select></div>";
	
	
	
	
	echo  "<div style='width:100px;float:left'><input type='text' name='observaciones' style='width:80px;margin-top:3px' value='$l_vi[observaciones_vi]' > </div>
	  <div style='width:100px;float:left'><input type='text' name='ipn' style='width:80px;margin-top:3px' value='$l_vi[ipn_vi]' > </div>
	  <div style='width:100px;float:left'><input type='text' name='alzo' style='width:80px;margin-top:3px' value='$l_vi[alzo_vi]' > </div>
	  <div style='width:100px;float:left'><input type='text' name='nav' style='width:80px;margin-top:3px' value='$l_vi[nav_vi]' > </div>
	  <div style='width:100px;float:left'><input type='text' name='trekk' style='width:80px;margin-top:3px' value='$l_vi[trekk_vi]' > </div>
	  <div style='width:100px;float:left'><input type='text' name='cod' style='width:80px;margin-top:3px' value='$l_vi[cod_vi]' > </div>
	  
	  
	  <div style='clear:both'></div>
	  
	  <input type='hidden' name='escribano_modifica' value='ok'>
	  <input type='hidden' name='tiene_data' value='$tiene_data'>
	  
	  <div style='position:fixed;margin-top:10px;width:1500px'>
	  
	 	  
	  <input type='submit' style='margin-left:300px;width:113px;height:25px;background-image:url(imagenes/bot_modificar1.png);border:0px;cursor:pointer' value=''>
	  
	
	  
	  </div>
	  
	  </form>
	  
      </div>
	  
	  ";



} //for($l=1;$l<=$c_sql;$l++){







?>


</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div> <!-- EEEEE -->


</body>
</html>
