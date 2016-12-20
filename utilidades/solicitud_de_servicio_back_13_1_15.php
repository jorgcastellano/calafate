<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


if(isset($_POST["escribano"])){



//busca datos empresa

$sql_em = mysql_query("select * from empresa where id_empresa = '$_POST[id_empresa]'");
$l_em = mysql_fetch_assoc($sql_em);

$nombre_empresa = $l_em["nombre_empresa"];
$mail_empresa = $l_em["mail_empresa"];

//fin busca datos empresa


//busca mail del logeado
//busca mail del logeado

$sql_lo = mysql_query("select mail_usuario from usuario where id_usuario= '$_SESSION[logeo]' ");
$lee_lo = mysql_fetch_assoc($sql_lo);

$mail_usuario = $lee_lo["mail_usuario"];

//fin busca mail del logeado
//fin busca mail del logeado



//echo "<hr><hr><hr><hr> $_POST[texto_mail] <br><br><br><br><br><br><br><br><br>";

for($d=1;$d<=3;$d++){

if($_POST["mail".$d]!=""){ //---------uuuuuuuuuuuu




// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Cabeceras adicionales
$cabeceras .= 'From: '.$mail_usuario;
 
$texto_mail = "Por favor confirmar la siguiente solicitud para: <br> ".$_POST["texto_mail"]."<br>".$_POST["texto"]."<br><br>Operador: ".$_POST["operador"]; 

$mail = $_POST["mail".$d];
$fecha = time();

mail($mail, "Solicitud de servicio nro $_GET[id] para $nombre_empresa", $texto_mail, $cabeceras);
//mail("webmaster@creativoscalafate.com.ar", "Solicitud de servicio nro $_GET[id] para $nombre_empresa", $texto_mail, $cabeceras);

mysql_query("INSERT INTO solicitud_de_servicio (idd_venta_ss,mail_ss,texto_ss,fecha_ss) VALUES ('$_GET[id]','$mail','$_POST[texto]','$fecha')");

}//if($_POST[""]){  ---------uuuuuuuuuuuu


}//for($d=1;$d<=3;$d++){


}//if(isset($_POST["escribano"])){


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>SOLICITUD DE SERVICIO</title>
<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="validaciones.js"></script>
<script type="text/javascript" src="java.js"></script>


<script src="src/js/jscal2.js"></script>
    <script src="src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="src/css/steel/steel.css" />

	



	
</head>

<body>

         <div style="background-color:#ffffff" > <!-- EEEEE -->

<?php

$texto_mail = "";

if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="administrador"){

include_once("encabezado.inc.php");


}//if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="administrador"){



if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="vendedor"){

include_once("encabezado_vendedor.inc.php");


}//if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="administrador"){


if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="operativo"){

include_once("encabezado_operativo.inc.php");


}//if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]=="operativo"){

?>

<div style="padding:10px">


<?php


//PAGINEO


//busca_fecha
//busca_fecha

if(isset($_GET["id_fecha"])){

$id_fecha = $_GET["id_fecha"];

}else{//if(isset($_GET["id_fecha"])){

$dia = date("d", time());
$mes = date("m", time());
$ano = date("Y", time());

$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;


$id_fecha = mktime(00,00,00,$mess,$diaa,$anoo);


}//if(isset($_GET["id_fecha"])){

$id_fecha1 = $id_fecha + 86400;

//fin busca_fecha
//fin busca_fecha

/*

echo "<div>";

echo "<div style='font-size:18px;font-weight:bold'>Dia: ".date("d/m/y", $id_fecha)."</div><br>";

echo "</div>";


*/
 
  

if($_SESSION["tipo"]=="vendedor"){
$s_vendedor = "and vendedor_vs='$_SESSION[id_usuario]'";
}else{//if($_SESSION["tipo"]=="vendedor"){
$s_vendedor ="";
}////if($_SESSION["tipo"]=="vendedor"){


$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and id_ventas='$_GET[id]' $s_vendedor order by orden_publica_vs asc limit 0,10");




							 

//PAGiNEO




$c_sql = mysql_num_rows($sql);


  
	  
for($l=1;$l<=$c_sql;$l++){

$l_sql = mysql_fetch_assoc($sql);



if($l == 1){

//busca nombre articulo
$sql_sub2 = mysql_query("select * from subcategoria_2 where clave='$l_sql[idd_sub2_vs]'");
$l_sql_sub2 = mysql_fetch_assoc($sql_sub2);



$nombre_sub2 = $l_sql_sub2["nombre_sub2"]; 

//fin busca nombre articulo


echo "<div style='text-align:center;width:100%;height:20px;border:1px solid #555;background-color:#999999;line-height:20px;margin-bottom:2px;font-size:18px'><b> $nombre_sub2 </b></div>";  




}//if($l == 1){


$sql_sol = mysql_query("select * from solicitud_de_servicio where idd_venta_ss = '$_GET[id]' order by id_ss asc");
$cta_sol = mysql_num_rows($sql_sol);

if($cta_sol > 0){

echo "<br>Esta solicitud se ha enviado ya a: <br><br>";

for($a=1;$a<=$cta_sol;$a++){
$l_sol = mysql_fetch_assoc($sql_sol);

echo "<div>a $l_sol[mail_ss] el dia ".date("d/m/Y",$l_sol["fecha_ss"])."</div>";

}//for($a=1;$a<=$cta_sol;$a++){


}//if($cta_sol > 0){

echo "<br>Para enviar solicitud nueva: <br><br>";

echo "<form method='post' action='$_SERVER[PHP_SELF]?id_fecha=$_GET[id_fecha]&id=$_GET[id]'>
   <br>
   Mail 1 : <input type='text' name='mail1'><br>
   Mail 2 : <input type='text' name='mail2'><br>
   Mail 3 : <input type='text' name='mail3'><br><br>
   
   Texto adicional: <textarea name='texto'> </textarea><br><br>";
    





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


$fondo_articulo = "#000000";

//busca vendedor

$sql_ven = mysql_query("select nombre_usuario from usuario where id_usuario='$l_sql[vendedor_vs]'");
$l_ven = mysql_fetch_assoc($sql_ven);
$vendedor = $l_ven["nombre_usuario"];
//fin busca vendedor


//busca nombre articulo
$sql_sub2 = mysql_query("select * from subcategoria_2 where clave='$l_sql[idd_sub2_vs]'");
$l_sql_sub2 = mysql_fetch_assoc($sql_sub2);



$nombre_sub2 = $l_sql_sub2["nombre_sub2"]; 

//fin busca nombre articulo


//busca VENTAS INFO


$sql_vi = mysql_query("select * from ventas_info where idd_ventas_vi = '$l_sql[id_ventas]' ");

$l_vi = mysql_fetch_assoc($sql_vi);


//fin busca VENTAS INFO


//cantidad de pasajeros |||||||||||||||����


////--- busca si es infoa, menor o adulto
////--- busca si es infoa, menor o adulto

$sql_tippas = mysql_query("select * from descuento_edad where idd_sub2= '$l_sql[idd_sub2_vs]'");

$cta_tippas = mysql_num_rows($sql_tippas);


$lee_tippas = mysql_fetch_assoc($sql_tippas);


$tp_adultos = 0; 
$tp_infoas = 0; 
$tp_menores = 0; 


if($lee_tippas["bebe"]=="100.00"){

$tp_infoas = $tp_infoas + $l_sql["bebe_vs"];
}//if($lee_tippas["bebe"]==100){ 

if($lee_tippas["nino"]==100){
$tp_infoas = $tp_infoas + $l_sql["nino_vs"];
}//if($lee_tippas["bebe"]==100){ 

if($lee_tippas["nino1"]==100){
$tp_infoas = $tp_infoas + $l_sql["nino1_vs"];
}//if($lee_tippas["nino1"]==100){ 

if($lee_tippas["nino2"]==100){
$tp_infoas = $tp_infoas + $l_sql["nino2_vs"];
}//if($lee_tippas["nino2"]==100){ 

if($lee_tippas["senior"]==100){
$tp_infoas = $tp_infoas + $l_sql["senior_vs"];
}//if($lee_tippas["senior"]==100){ 



if($lee_tippas["bebe"]> 0.00 && $lee_tippas["bebe"]<100.00){
$tp_infoas = $tp_menores + $l_sql["bebe_vs"];

}//if($lee_tippas["bebe"]==100){ 


if($lee_tippas["nino"]> 0.00 && $lee_tippas["nino"]<100.00){

$tp_menores = $tp_menores + $l_sql["nino_vs"];

}//if($lee_tippas["nino"]==100){ 

if($lee_tippas["nino1"]> 0.00 && $lee_tippas["nino1"]<100.00){
$tp_menores = $tp_menores + $l_sql["nino1_vs"];

}//if($lee_tippas["nino1"]==100){ 

if($lee_tippas["nino2"]> 0.00 && $lee_tippas["nino2"]<100.00){
$tp_menores = $tp_menores + $l_sql["nino2_vs"];

}//if($lee_tippas["nino2"]==100){ 


////--- fin busca si es infoa, menor o adulto
////--- fin busca si es infoa, menor o adulto

 

$tot_pasajeros = $l_sql["adulto_vs"] + $l_sql["bebe_vs"] + $l_sql["nino_vs"] + $l_sql["nino1_vs"] + $l_sql["nino2_vs"] + $l_sql["senior_vs"];

$det_pasajeros1 = "Adultos: $l_sql[adulto_vs] | Bebes: $l_sql[bebe_vs] | Menor cat 1: $l_sql[nino_vs] | Menor cat 2: $l_sql[nino1_vs] | Menor cat 3: $l_sql[nino2_vs] | Senior: $l_sql[senior_vs]";


$det_pasajeros = "Adultos: $l_sql[adulto_vs] | Infoas: $tp_infoas | Menores: $tp_menores";



//fin cantidad de pasajeros  |||||||||||||||����



//busca adicionales--- 
//busca adicionales--- 

$sql_va = mysql_query("select ventas_adicionales.*, adicionales.nombre_ad 
from ventas_adicionales left outer join adicionales on ventas_adicionales.idd_ad_va = adicionales.id_adicional 
where ventas_adicionales.idd_carga_va = '$l_sql[idd_carga_vs]'");

$cta_va = mysql_num_rows($sql_va);

if($cta_va >0){

$tiene_adic = "SI";
$texto_adic = "";

for($aw=1;$aw<=$cta_va;$aw++){
$lee_ad = mysql_fetch_assoc($sql_va);

$texto_adic = $texto_adic." | ".$lee_ad["nombre_ad"];


}//for($aw=1;$aw<=$cta_va;$aw++){


}else{ //if($cta_va >0){

$texto_adic = "";
$tiene_adic = "no";

}//if($cta_va >0){

//fin busca adicionales--- 
//fin busca adicionales--- 




//---------------------

$sql_f = mysql_query("select * from articulo where idd_venta_ar='$l_sql[idd_carga_vs]' order by clave asc limit 0,1 ");	  
$lee_f = mysql_fetch_assoc($sql_f);


	  
//echo "<br>Fecha de la compra: ".date("d/m/Y",$l_sql["idd_carga_vs"])." <br>";
echo "<b> Servicio: $nombre_sub2 </b><br><br>";
echo "Fecha de la realizacion: <b>".date("d/m/Y",$lee_f["idd_fecha"])." </b><br><br>";

$texto_mail = $texto_mail."Servicio: <b> $nombre_sub2 </b><br><br>Fecha de la realizacion: <b>".date("d/m/Y",$lee_f["idd_fecha"])." </b><br><br>";


	  
	  
   echo "<div style='height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' >
	   <span style='font-size:10px;color:#555555'><b>Cantidad de PAX:</b></span> <b> $tot_pasajeros </b>| $det_pasajeros
	  </div>";
	  

$texto_mail = $texto_mail."<b>Cantidad de PAX:</b> <b> $tot_pasajeros </b>| $det_pasajeros
	  <br>";	  
	  	  
	  
	  if($tiene_adic == "si" || $tiene_adic == "SI"){	
	  
	  echo "<div style='height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' >
	   <span style='font-size:10px;color:#555555'><b>Adicionales: </b></span> $tiene_adic - $texto_adic
	  </div>";

$texto_mail = $texto_mail."<b>Adicionales: </b></span> $tiene_adic - $texto_adic
	  <br>";	  
	  
	  
} //if($tiene_adic == "si"){	  
	  



//---------------------


//info pasajeros -----:::::;
//info pasajeros -----:::::;

//---comprador

$sql_pas_nom = mysql_query("select campo2_p from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador' and campo1_p = 'nombre'  order by id_pasajero_p asc");

$l_pas_nom = mysql_fetch_assoc($sql_pas_nom);



$sql_pas_ape = mysql_query("select campo2_p from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador' and campo1_p = 'apellido'  order by id_pasajero_p asc");

$l_pas_ape = mysql_fetch_assoc($sql_pas_ape);



$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

echo "<br><b>PAX:</b> <br><br>";

$texto_mail = $texto_mail."<br><b>PAX:</b> <br><br>";


echo "<div style='clear:both'><b>$l_pas_ape[campo2_p] $l_pas_nom[campo2_p]</b></div><br> ";

$texto_mail = $texto_mail."<b>$l_pas_ape[campo2_p] $l_pas_nom[campo2_p]</b><br><br>";	

/*

for($y=1;$y<=$cta_pas;$y++){

$l_pas = mysql_fetch_assoc($sql_pas);

if($l_pas["campo1_p"]!="nombre" && $l_pas["campo1_p"]!="apellido"){

echo "
      <div style='width:100px;float:left'>$l_pas[campo1_p] : </div>
	  <div style='width:300px;float:left'>$l_pas[campo2_p]</div>
	  <div style='clear:both'></div>

      
      ";
	  
$texto_mail = $texto_mail."$l_pas[campo1_p] :  $l_pas[campo2_p]<br>";	  

} //if($l_pas["campo1_p"]!="nombre" || $l_pas["campo1_p"]!="apellido"){

	  
	  

} //for($y=1;$y<=$cta_pas;$y++){
     
*/
 
	 
//---comprador

//-pasajeros  




//echo "<br><b>Pasajeros:</b> <br><br>";

//$texto_mail = $texto_mail."<br><b>Pasajeros:</b> <br><br>";


for($ec=1;$ec<=$tot_pasajeros;$ec++){



$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p <> 'comprador' and num_pasaje_p ='$ec' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

if($cta_pas > 0){


for($y=1;$y<=$cta_pas;$y++){


$l_pas = mysql_fetch_assoc($sql_pas);

$num_pasa = $l_pas["num_pasaje_p"];


/*
if($y==1){

echo "<BR>
      <div style='width:100px;float:left'>Tipo : </div>
	  <div style='width:300px;float:left'>$l_pas[categoria_p]</div>
	  <div style='clear:both'></div> 
      ";
	  
	  
//$texto_mail = $texto_mail."<BR>Tipo : $l_pas[categoria_p]<br> ";	  


} //if($y==1){

*/

echo "
      <div style='width:100px;float:left'>$l_pas[campo1_p] : </div>
	  <div style='width:300px;float:left'>$l_pas[campo2_p]</div>
	  <div style='clear:both'></div>

      
      ";
	  
	  
$texto_mail = $texto_mail."$l_pas[campo1_p] : $l_pas[campo2_p]<br>";	  

} //for($y=1;$y<=$cta_pas;$y++){
     




  

}//for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){
	  
	  
	  
	  




	  
	  
} //if($cta_pas > 0){

//-pasajeros  


//fin info pasajeros -----:::::;
//fin info pasajeros -----:::::;
 

	 

if($_SESSION["tipo"]=="administrador" || $_SESSION["tipo"]=="operativo"){	 
	 
//INFO ADICIONAL	 

echo "<div style='width:98%;background-color:#FFFFFF;padding:5px;margin-bottom:2px'>";//�����������





$sql_it = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.publica_iva = 'si'
AND items_venta_articulo.idd_sub2_iva = '$l_sql[idd_sub2_vs]' AND items_base_cliente.idd_empresa_ibs='$_SESSION[logeo]' order by items_venta_articulo.orden_iva asc");

$cta_it = mysql_num_rows($sql_it);



for($w=1;$w<=$cta_it;$w++){

$lee_it = mysql_fetch_assoc($sql_it);
if($lee_it["nombre_ibc"]== "observaciones"){

echo "
<div style='color:#000000;overflow:hidden;height:20px'><b>$lee_it[nombre_ibc] </b> : ";




$texto_mail = $texto_mail."<br><b>$lee_it[nombre_ibc]</b> : ";


$sql_inf = mysql_query("select * from items_valor where idd_ibc_iv= '$lee_it[idd_ibc_iva]' and idd_venta_iv='$l_sql[idd_carga_vs]' ");
$lee_inf = mysql_fetch_assoc($sql_inf);



if($lee_inf["valor_iv"]=="no"){

echo "<b> $lee_inf[valor_iv] </b>";
$texto_mail = $texto_mail."<b> $lee_inf[valor_iv] </b> <br>";

}else{ //if($lee_inf["valor_iv"]=="no"){

echo "$lee_inf[valor_iv] ";
$texto_mail = $texto_mail."$lee_inf[valor_iv] <br> ";

} //if($lee_inf["valor_iv"]=="no"){





echo "</div>";
} //if($lee_it["nombre_ibc"]== "observaciones"){

}//for($w=1;$w<=$cta_it;$w++){

 
echo "<div style='clear:both'></div>";	  
	  


	  
	  
echo  "<div style='clear:both'></div>";

	  
echo "</div>";//�����������	  
	  
  
	  
	  
// FIN INFO ADICIONAL

echo "<br>----------------------------------<br>";
echo "<br>----------------------------------<br>";


echo $texto_mail;


echo "<br>----------------------------------<br>";
echo "<br>----------------------------------<br>";



echo "<br><br>Firma del operador: <input type='text' name='operador'><br><br>";






echo "<input type='hidden' name='escribano' value='ok'>
    <input type='hidden' name='texto_mail' value='$texto_mail'>
    <input type='hidden' name='id_empresa' value='$l_sql[idd_empresa_vs]'>
    <input type='submit' value='' style='width:180px;height:40px;background-image:url(imagenes/bot_enviar.png);border:0px;cursor:pointer'>    
	</form>";


}//if($_SESSION["tipo"]=="administrador" || $_SESSION["tipo"]=="operativo"){

} //for($l=1;$l<=$c_sql;$l++){





?>



</div>  

<?php
echo "<div style='width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px'><a href='ventas.php?id_fecha=$_GET[id_fecha]'><img src='imagenes/bot_volver.png' title='Volver al panel'></a></div>";
?>  
       </div> <!-- EEEEE -->


</body>
</html>
