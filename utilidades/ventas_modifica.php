<?php
include_once("conexion.inc.php");

session_start();

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


$ec = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.publica_iva = 'si'
AND idd_sub2_iva = '$_GET[idd_sub2_vs]' AND items_base_cliente.idd_empresa_ibs='$_SESSION[logeo]' order by items_venta_articulo.orden_iva asc");

$c_ec = mysql_num_rows($ec);

for($d=1;$d<=$c_ec;$d++){

$l_ec = mysql_fetch_assoc($ec);


$ua = mysql_query("select * from items_valor where idd_venta_iv='$_POST[idd_venta_iv]' and idd_ibc_iv ='$l_ec[id_ibc]' ");
$c_ua = mysql_num_rows($ua);

$numi = $l_ec["id_ibc"];

if($c_ua > 0){

$l_ua = mysql_fetch_assoc($ua);



mysql_query("UPDATE items_valor SET valor_iv = '$_POST[$numi]' where idd_venta_iv = '$_POST[idd_venta_iv]' and idd_ibc_iv ='$l_ec[id_ibc]' ");

}else{ //if($c_ua > 0){


mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('$_POST[$numi]','$l_ec[id_ibc]','$_POST[idd_venta_iv]')");

}//if($c_ua > 0){



} //for($d=1;$d<=$c_ua;$d++){



//actualiza datos de la ultima modificacion
//actualiza datos de la ultima modificacion

$ffecha= time();

mysql_query("UPDATE ventas SET ult_modificacion_vs='$_SESSION[nombre_usuario]', fecha_ult_modificacion_vs='$ffecha' where id_ventas='$_GET[id]'");

//actualiza datos de la ultima modificacion	 
//actualiza datos de la ultima modificacion	 
	 
	 
//actualiza orden de la venta	 
//actualiza orden de la venta

if(isset($_POST[16])){

mysql_query("UPDATE ventas SET orden_publica_vs='$_POST[16]' where idd_carga_vs='$_POST[idd_venta_iv]'");
	 
}	 //if(isset($_POST[16])){
//actualiza orden de la venta	 
//actualiza orden de la venta	 
	 

//actualiza orden de la venta	 
//actualiza orden de la venta

if(isset($_POST[16])){



mysql_query("UPDATE ventas SET chofer_guia_vs='$_POST[9]' where idd_carga_vs='$_POST[idd_venta_iv]'");
	 
}	 //if(isset($_POST[16])){
//actualiza orden de la venta	 
//actualiza orden de la venta	



	 
header("Location: ventas.php?id_fecha=".$_GET["id_fecha"]);	 
	 
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

<div style="padding:10px;width:1000px">


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


$sql_vi = mysql_query("select * from items_valor where idd_venta_iv= '$l_sql[idd_carga_vs]'");
$cta_vi = mysql_num_rows($sql_vi);

if($cta_vi>0){
$tiene_data = "si";
}else{ //if($cta_vi>0){
$tiene_data = "no";
}//if($cta_vi>0){


$l_vi = mysql_fetch_assoc($sql_vi);


//fin busca VENTAS INFO


####################################################################NUEVO (metodo)
####################################################################NUEVO

echo "<form method='post' action='ventas_modifica.php?id=$_GET[id]&idd_sub2_vs=$_GET[idd_sub2_vs]&id_fecha=$_GET[id_fecha]'>";


$sql_it = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.publica_iva = 'si'
AND idd_sub2_iva = '$_GET[idd_sub2_vs]' AND items_base_cliente.idd_empresa_ibs='$_SESSION[logeo]' order by items_venta_articulo.orden_iva asc");

$cta_it = mysql_num_rows($sql_it);

for($w=1;$w<=$cta_it;$w++){

$lee_it = mysql_fetch_assoc($sql_it);

if($lee_it["nombre_ibc"]!="vehiculo" && $lee_it["nombre_ibc"]!="chofer" && $lee_it["nombre_ibc"]!="guias" && $lee_it["nombre_ibc"]!="pick up"){

echo "<div style='width:120px;float:left;margin-left:5px'>
<div style='width:120px;color:#000000;overflow:hidden'><b>$lee_it[nombre_ibc] </b> </div>";


$sql_inf = mysql_query("select * from items_valor where idd_ibc_iv= '$lee_it[idd_ibc_iva]' and idd_venta_iv='$l_sql[idd_carga_vs]' ");
$lee_inf = mysql_fetch_assoc($sql_inf);

if($lee_it["sino_ibs"] != "si"){

echo "<div style='width:90px;height:30px;overflow:hidden' ><input type='text' name='$lee_it[id_ibc]' value='$lee_inf[valor_iv]' style='width:85px'> </div>";

}else{ //if($lee_if["sino_ibs"] != "si"){


echo "<div style='width:90px;height:30px;overflow:hidden' ><select name='$lee_it[id_ibc]' style='width:75px'>"; 

if($lee_inf["valor_iv"]=="si"){

echo "<option>no</option>
      <option selected>si</option>

     ";

}else{ //if($lee_inf["valor_iv"]=="si"){

echo "<option selected >no</option>
      <option>si</option>

     ";


}//if($lee_inf["valor_iv"]=="si"){



echo "</select></div>";

} //if($lee_if["sino_ibs"] != "si"){


echo "</div>";


}else{//if($lee_if["nombre_ibc"]!="vehiculo" && $lee_if["nombre_ibc"]!="chofer" && $lee_if["nombre_ibc"]!="guia" && $lee_it["nombre_ibc"]!="pick up"){


if($lee_it["nombre_ibc"]=="pick up"){


//busca en la base si hay una cargado
//busca en la base si hay una cargado

$sql_h = mysql_query("select * from items_valor where idd_ibc_iv='16' and idd_venta_iv= '$l_sql[idd_carga_vs]'");
$l_h = mysql_fetch_assoc($sql_h);

//fin busca en la base si hay una cargado
//fin busca en la base si hay una cargado


echo "<div style='width:120px;float:left;margin-left:5px'>
<div style='width:120px;color:#000000;overflow:hidden'><b>$lee_it[nombre_ibc] </b> </div>
<div style='width:120px;height:30px;overflow:hidden' >
<select name='$lee_it[id_ibc]' style='width:120px;margin-top:0px' >
      <option value=''></option>
       "; 
 
      $sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='hora' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  for($u=1;$u<=$c_ad;$u++){
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  
	  if($l_h["valor_iv"] == $l_ad["nombre_da"]){
	  echo "<option selected>$l_ad[nombre_da]</option>";
	  }else{//$l_h["valor_iva"] == $l_ad["nombre_da"]){
	  echo "<option >$l_ad[nombre_da]</option>";
	  } //if($l_h["valor_iva"] == $l_ad["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_ad;$u++){
	  

echo  "</select>
      </div>
	  </div>
      ";



}//if($lee_it["nombre_ibc"]=="pick up"){







if($lee_it["nombre_ibc"]=="vehiculo"){

//busca en la base si hay una cargado
//busca en la base si hay una cargado

$sql_h = mysql_query("select * from items_valor where idd_ibc_iv='1' and idd_venta_iv= '$l_sql[idd_carga_vs]'");
$l_h = mysql_fetch_assoc($sql_h);

//fin busca en la base si hay una cargado
//fin busca en la base si hay una cargado

echo "<div style='width:120px;float:left;margin-left:5px'>
<div style='width:120px;color:#000000;overflow:hidden'><b>$lee_it[nombre_ibc] </b> </div>
<div style='width:120px;height:30px;overflow:hidden' >
<select name='$lee_it[id_ibc]' style='width:120px;margin-top:0px' >
      <option value=''></option>
       "; 
 
      $sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='vehiculo' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  for($u=1;$u<=$c_ad;$u++){
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  
	  if($l_h["valor_iv"] == $l_ad["nombre_da"]){
	  echo "<option selected>$l_ad[nombre_da]</option>";
	  }else{//$l_h["valor_iva"] == $l_ad["nombre_da"]){
	  echo "<option >$l_ad[nombre_da]</option>";
	  } //if($l_h["valor_iva"] == $l_ad["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_ad;$u++){
	  

echo  "</select>
      </div>
	  </div>
      ";


} //if($lee_if["nombre_ibc"]=="vehiculo"){



if($lee_it["nombre_ibc"]=="chofer"){

//busca en la base si hay una cargado
//busca en la base si hay una cargado

$sql_h = mysql_query("select * from items_valor where idd_ibc_iv='8' and idd_venta_iv= '$l_sql[idd_carga_vs]' ");
$l_h = mysql_fetch_assoc($sql_h);

//fin busca en la base si hay una cargado
//fin busca en la base si hay una cargado

echo "<div style='width:120px;float:left;margin-left:5px'>
<div style='width:120px;color:#000000;overflow:hidden'><b>$lee_it[nombre_ibc] </b> </div>
<div style='width:120px;height:30px;overflow:hidden' ><select name='$lee_it[id_ibc]' style='width:120px;margin-top:0px' >
      <option value=''></option>
       "; 
 
      $sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='chofer' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  for($u=1;$u<=$c_ad;$u++){
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  
	  if($l_h["valor_iv"] == $l_ad["nombre_da"]){
	  echo "<option selected>$l_ad[nombre_da]</option>";
	  }else{//$l_h["valor_iva"] == $l_ad["nombre_da"]){
	  echo "<option >$l_ad[nombre_da]</option>";
	  } //$l_h["valor_iva"] == $l_ad["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_ad;$u++){


echo  "</select>
      </div>
	  </div>
      ";



} //if($lee_it["nombre_ibc"]=="chofer"){









if($lee_it["nombre_ibc"]=="guias"){

//busca en la base si hay una cargado
//busca en la base si hay una cargado

$sql_h = mysql_query("select * from items_valor where idd_ibc_iv='9' and idd_venta_iv= '$l_sql[idd_carga_vs]' ");
$l_h = mysql_fetch_assoc($sql_h);

//fin busca en la base si hay una cargado
//fin busca en la base si hay una cargado

echo "<div style='width:120px;float:left;margin-left:5px'>
<div style='width:120px;color:#000000;overflow:hidden'><b>$lee_it[nombre_ibc] </b> </div>
<div style='width:120px;height:30px;overflow:hidden' ><select name='$lee_it[id_ibc]' style='width:120px;margin-top:0px' >
      <option value=''></option>
       "; 
 
      $sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='guias' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  for($u=1;$u<=$c_ad;$u++){
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  
	  if($l_h["valor_iv"] == $l_ad["nombre_da"]){
	  echo "<option selected>$l_ad[nombre_da]</option>";
	  }else{//if($l_h["valor_iva"] == $l_ad["nombre_da"]){
	  echo "<option >$l_ad[nombre_da]</option>";
	  } //$l_h["valor_iva"] == $l_ad["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_ad;$u++){





echo  "</select>
      </div>
	  </div>
      ";



} //if($lee_it["nombre_ibc"]=="guia"){


} ////if($lee_if["nombre_ibc"]!="vehiculo" && $lee_if["nombre_ibc"]!="chofer" && $lee_if["nombre_ibc"]!="guia" && $lee_it["nombre_ibc"]!="pick up"){



}//for($w=1;$w<=$cta_it;$w++){

echo "<div style='clear:both'></div>


<input type='hidden' name='escribano_modifica' value='ok'>
	  <input type='hidden' name='tiene_data' value='$tiene_data'>
	  <input type='hidden' name='idd_venta_iv' value='$l_sql[idd_carga_vs]'>
	  <div style='position:fixed;margin-top:10px;width:1100px'>
	  
	 	  
	  <input type='submit' style='margin-left:300px;width:113px;height:25px;background-image:url(imagenes/bot_modificar1.png);border:0px;cursor:pointer' value=''>

	  </div>
	  
	  </form>";


####################################################################NUEVO
####################################################################NUEVO




} //for($l=1;$l<=$c_sql;$l++){







?>


</div>  

<?php
echo "<div style='width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px'><a href='ventas.php?id_fecha=$_GET[id_fecha]'><img src='imagenes/bot_volver.png' title='Volver al panel'></a></div>";
 ?> 
       </div> <!-- EEEEE -->


</body>
</html>
