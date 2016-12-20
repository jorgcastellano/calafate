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
<title>ORDEN DE SERVICIO</title>
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

	
<script language="Javascript">
function imprSelec(nombre)
{
nombre1 = "imprime" + nombre;

  var ficha = document.getElementById(nombre1);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();

  
  }
</script> 


	
</head>

<body>

         <div style="background-color:#ffffff" > <!-- EEEEE -->

<?php


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



//------- empresa



$sql_em = mysql_query("select * from empresa where id_empresa = '$_SESSION[logeo]'");
$l_sql_em = mysql_fetch_assoc($sql_em);

/*
if($l_sql_em["logo_empresa"] != ""){
$ima_logo = "<img src='".$l_sql_em["logo_empresa"]."' height='120'><br>";
}else{ //if($l_sql_em["logo_empresa"]){
$ima_logo = "";
} //if($l_sql_em["logo_empresa"]){
*/


$ima_logo = "<img src='imagenes/crio.jpg' height='120'><br>";

//------- fin empresa



echo "<div>";

echo "<div style='font-size:18px;font-weight:bold'>Dia: ".date("d/m/y", $id_fecha)."</div><br>";

echo "</div>";

 
  
  
$sql_orden = mysql_query("select * from subcategoria_2 where idd_empresa_sub2 = '$_SESSION[logeo]' and clave='$_GET[idd_sub2]' order by nombre_sub2 asc");  
$cta_orden = mysql_num_rows($sql_orden);  


  
for($qa=1;$qa<=$cta_orden;$qa++){ //------------------------------AAAAAAAAAAAAAAAAAAAAAAAAAAAAA  -- AAA  
  
$lee_orden = mysql_fetch_assoc($sql_orden);  
  
 
//busca guia 
//busca guia  

$sql_ad = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='guias' order by nombre_da asc");
	  
	  $c_ad = mysql_num_rows($sql_ad);
	  
	  
	  for($u=1;$u<=$c_ad;$u++){ //azxcderfgt5reewdfdcffff |||||||||
	  
	  $l_ad = mysql_fetch_assoc($sql_ad);
	  



if($_SESSION["tipo"]=="vendedor"){
$s_vendedor = "and vendedor_vs='$_SESSION[id_usuario]'";
}else{//if($_SESSION["tipo"]=="vendedor"){
$s_vendedor ="";
}////if($_SESSION["tipo"]=="vendedor"){


$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and idd_sub2_vs='$lee_orden[clave]' and (fecha_excur_vs >= '$id_fecha' and fecha_excur_vs <='$id_fecha1') $s_vendedor and chofer_guia_vs='$l_ad[nombre_da]' and (estado_vs='confirmado' or estado_vs='confirmado con deuda') order by orden_publica_vs asc ");


//PAGiNEO




$c_sql = mysql_num_rows($sql);



if($c_sql > 0){
echo "<div id='imprime$u'>"; //div para imprimir	!!!!!!!!!!!!!!!   
}//if($c_sql > 0){
	  
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

if($l_sql["estado_vs"] == "se�ado"){
$fondo_articulo = "#05cd0a";

} //if($l_con_fecha["estado"] == "se�ado"){

if($l_sql["estado_vs"] == "reservado"){
$fondo_articulo = "#f8a505";

} //if($l_con_fecha["estado"] == "reservado"){

if($l_sql["estado_vs"] == "cancelado"){
$fondo_articulo = "#ff0000";

} //if($l_con_fecha["estado"] == "cancelado"){

if($l_sql["estado_vs"] == "confirmado"){
$fondo_articulo = "#122dcd";

} //if($l_con_fecha["estado"] == "confirmado"){


if($l_sql["estado_vs"] == "pagado"){
$fondo_articulo = "#a25306";

} //if($l_con_fecha["estado"] == "confirmado"){


//busca vendedor

$sql_ven = mysql_query("select nombre_usuario from usuario where id_usuario='$l_sql[vendedor_vs]'");
$l_ven = mysql_fetch_assoc($sql_ven);
$vendedor = $l_ven["nombre_usuario"];
//fin busca vendedor





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

//$det_pasajeros = "Adultos: $l_sql[adulto_vs] | Bebes: $l_sql[bebe_vs] | Menor cat 1: $l_sql[nino_vs] | Menor cat 2: $l_sql[nino1_vs] | Menor cat 3: $l_sql[nino2_vs] | Senior: $l_sql[senior_vs]";


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


if($l_sql["fecha_ult_modificacion_vs"]!=""){	  

$fech_ult = date("d/m/y | G.i<br>", $l_sql["fecha_ult_modificacion_vs"]);	  

}else{ //if($l_sql["fecha_ult_modificacion_vs"]!=""){

$fech_ult = "";

}//if($l_sql["fecha_ult_modificacion_vs"]!=""){

//INFO ADICIONAL	 

$sql_it = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.publica_iva = 'si'
AND items_venta_articulo.idd_sub2_iva = '$l_sql[idd_sub2_vs]' AND items_base_cliente.idd_empresa_ibs='$_SESSION[logeo]' order by items_venta_articulo.orden_iva asc");

$cta_it = mysql_num_rows($sql_it);


for($w=1;$w<=$cta_it;$w++){

$lee_it = mysql_fetch_assoc($sql_it);



$sql_inf = mysql_query("select * from items_valor where idd_ibc_iv= '$lee_it[idd_ibc_iva]' and idd_venta_iv='$l_sql[idd_carga_vs]' ");
$lee_inf = mysql_fetch_assoc($sql_inf);

$num_valo = $lee_inf["idd_ibc_iv"]; 
$vvvalo[$num_valo] = $lee_inf["valor_iv"]; 



}//for($w=1;$w<=$cta_it;$w++){

  
// FIN INFO ADICIONAL



if($l == 1){



echo "<div style='width:950px;border:1px solid #000;margin-bottom:10px'>

          <div style='float:left;width:300px;height:120px;overflow:hidden'>
          $ima_logo  
          </div>

          <div style='float:left;width:340px;margin-left:30px;margin-right:20px;margin-top:5px'>
          <br><br>
		  $l_sql_em[direccion_empresa] <br>
          Telefono de Ventas: $l_sql_em[tel1_empresa]  <br>
          Email: $l_sql_em[mail_empresa] 		  
          </div>
		  
          <div style='clear:both'><br></div>
	 
     </div>";



echo "Fecha: ".date("d/m/y", $id_fecha)."<br>";
echo "Servicio: ".$nombre_sub2."<br>";
echo "Guia: ".$vvvalo[9]."<br>";
echo "Conductor: ".$vvvalo[8]."<br><br>";


echo "<div style='width:120px;float:left;border:1px solid #555555;height:20px;margin-left:1px;text-align:center;line-height:20px'>Pick Up</div>
      <div style='width:120px;float:left;border:1px solid #555555;height:20px;margin-left:1px;text-align:center;line-height:20px'>Hotel</div>
	  <div style='width:140px;float:left;border:1px solid #555555;height:20px;margin-left:1px;text-align:center;line-height:20px'>Nombre</div>
	  <div style='width:120px;float:left;border:1px solid #555555;height:20px;margin-left:1px;text-align:center;line-height:20px'>Cantidad</div>
	  <div style='width:50px;float:left;border:1px solid #555555;height:20px;margin-left:1px;text-align:center;line-height:20px'>IPN</div>
	  <div style='width:200px;float:left;border:1px solid #555555;height:20px;margin-left:1px;text-align:center;line-height:20px'>Adicionales</div>
	  <div style='width:200px;float:left;border:1px solid #555555;height:20px;margin-left:1px;text-align:center;line-height:20px'>Obs</div>
     ";
	 
echo "<div style='clear:both;height:1px'></div>";	 


$tot_pasajeros_suma = 0;

} //if($l == 1){


echo "<div style='width:120px;float:left;border:1px solid #555555;height:20px;margin-left:1px;line-height:20px;overflow:hidden'>
      &nbsp; $vvvalo[16]
	  
      </div>";

echo "<div style='width:120px;float:left;border:1px solid #555555;height:20px;margin-left:1px;line-height:20px;overflow:hidden;font-size:11px'>
      &nbsp; $vvvalo[2]
	  
      </div>";
	  
echo "<div style='width:140px;float:left;border:1px solid #555555;height:20px;margin-left:1px;line-height:20px;overflow:hidden;font-size:11px'>
      &nbsp; $nombre_comprador
	  
      </div>";
	  
echo "<div style='width:120px;float:left;border:1px solid #555555;height:20px;margin-left:1px;line-height:20px;overflow:hidden;font-size:11px'>
      &nbsp; <span style='border:1px solid #555'><b> $tot_pasajeros </b> </span> &nbsp;&nbsp;&nbsp; | $l_sql[adulto_vs] + $tp_infoas + $tp_menores
	  
      </div>";	  

$tot_pasajeros_suma = $tot_pasajeros_suma + $tot_pasajeros;
	  
echo "<div style='width:50px;float:left;border:1px solid #555555;height:20px;margin-left:1px;line-height:20px;overflow:hidden;font-size:11px'>
      &nbsp; $vvvalo[11]
	  
      </div>";	  
	  
	  
echo "<div style='width:200px;float:left;border:1px solid #555555;height:20px;margin-left:1px;line-height:20px;overflow:hidden;font-size:11px'>
      &nbsp; $texto_adic
	  
      </div>";	  
	  
echo "<div style='width:200px;float:left;border:1px solid #555555;height:20px;margin-left:1px;line-height:20px;overflow:hidden;font-size:11px'>
      &nbsp; $vvvalo[10]
	  
      </div>";	  	  
	  
	   
echo "<div style='clear:both;height:1px'></div>";








} //for($l=1;$l<=$c_sql;$l++){

if(isset($tot_pasajeros_suma)){

if($l > 0 && $tot_pasajeros_suma > 0){

echo "<div style='width:120px;float:left;border:1px solid #555555;height:20px;margin-left:390px;line-height:20px;overflow:hidden;font-size:11px'>
      &nbsp; <b> Tot.: &nbsp; $tot_pasajeros_suma </b>
	  
      </div>";	 


$tot_pasajeros_suma = 0; 
}

}//if(isset($tot_pasajeros_suma)){

if($c_sql > 0){

echo "</div>"; //div para imprimir	!!!!!!!!!!!!!!!


echo "<div style='text-align:center;margin-top:50px'>
<a href=javascript:imprSelec('$u') ><img src='../imagenes/imprimir.jpg' ></a><hr>
</div>";

} //if($c_sql > 0){


	  } //for($u=1;$u<=$c_ad;$u++){ //azxcderfgt5reewdfdcffff |||||||||


//fin busca guia 
//fin busca guia 


if($c_sql== 0){
echo "<b>No se encontraron servicios confirmados para este dia </b>";
}//if($c_sql ==> 0){

}//for($qa=1;$qa<=$cta_orden;$qa++){ //------------------------------AAAAAAAAAAAAAAAAAAAAAAAAAAAAA  -- AAA






?>





</div>  

<?php
echo "<div style='width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px'><a href='ventas.php?id_fecha=$_GET[id_fecha]'><img src='imagenes/bot_volver.png' title='Volver al panel'></a></div>";
 ?>
  
       </div> <!-- EEEEE -->


</body>
</html>
