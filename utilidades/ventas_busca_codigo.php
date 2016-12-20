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
<title>VENTAS</title>
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

echo "<div>";


$sql_fecha = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and codigo_vs='$_GET[codigo]' order by orden_publica_vs asc limit 0,1");

$cta_fecha = mysql_num_rows($sql_fecha);

if($cta_fecha >0){
$l_sql_fecha = mysql_fetch_assoc($sql_fecha);


echo "<div style='font-size:18px;font-weight:bold;float:left'>Dia: ".date("d/m/y", $l_sql_fecha["fecha_excur_vs"])."</div>";
}else{
echo "No hay resultados para el codigo ingresado.";
}



echo "<div style='clear:both;height:10px'></div>";

echo "</div>";


echo "<div style='width:20px;height:20px;float:left;background-color:#05cd0a'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Se�ado</div>
	  
	  <div style='width:20px;height:20px;float:left;background-color:#a25306'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Pagado</div>
	
      <div style='width:20px;height:20px;float:left;background-color:#f8a505;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Reservado</div>
	  
	   <div style='width:20px;height:20px;float:left;background-color:#122dcd;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Confirmado</div>
	  
	   <div style='width:20px;height:20px;float:left;background-color:#fa03ac ;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Confirmado con deuda</div>
	
	  <div style='width:20px;height:20px;float:left;background-color:#ff0000;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Cancelado</div>
	  
	  <div style='clear:both'></div><br>
      
	 ";


 
  
  
$sql_orden = mysql_query("select * from subcategoria_2 where idd_empresa_sub2 = '$_SESSION[logeo]' order by nombre_sub2 asc");  
$cta_orden = mysql_num_rows($sql_orden);  
  
for($qa=1;$qa<=$cta_orden;$qa++){ //------------------------------AAAAAAAAAAAAAAAAAAAAAAAAAAAAA  -- AAA  
  
$lee_orden = mysql_fetch_assoc($sql_orden);  
  
 
  
/*  
  
  //busco la cantidad total
$busca_total = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and (fecha_excur_vs >= '$id_fecha' and fecha_excur_vs <='$id_fecha1') order by orden_publica_vs asc");
$cta_total = mysql_num_rows($busca_total);
  //fin busco la cantidad

  
*/  

if($_SESSION["tipo"]=="vendedor"){
$s_vendedor = "and vendedor_vs='$_SESSION[id_usuario]'";
}else{//if($_SESSION["tipo"]=="vendedor"){
$s_vendedor ="";
}////if($_SESSION["tipo"]=="vendedor"){


$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and idd_sub2_vs='$lee_orden[clave]' and codigo_vs='$_GET[codigo]' $s_vendedor order by orden_publica_vs asc");







$c_sql = mysql_num_rows($sql);

if($c_sql > 0){

 switch($qa){

case 1: $color_excur= "#bf9088";
break;

case 2: $color_excur= "#c5a2bf";
break;

case 3: $color_excur= "#b98bf1";
break;

case 4: $color_excur= "#9199c1";
break;

case 5: $color_excur= "#80e7cb";
break;

case 6: $color_excur= "#7ef1a1";
break;

case 7: $color_excur= "#e8f17e";
break;

case 8: $color_excur= "#f1b77e";
break;

case 9: $color_excur= "#78fb6a";
break;

case 10: $color_excur= "#b96afb";
break;


}



echo "<div style='text-align:center;width:100%;height:20px;border:1px solid #555;background-color:$color_excur;line-height:20px;margin-bottom:2px;font-size:18px'><b> $lee_orden[nombre_sub2] </b>

<span style='margin-left:10px;float:left;text-align:center;width:150px;margin-top:1px;height:18px;background-color:#0263c4;color:#ffffff;font-size:11px;cursor:pointer;line-height:18px' onclick=location.href='orden_servicio.php?id_fecha=$id_fecha&idd_sub2=$lee_orden[clave]' >Orden de servicio</span>

</div>";  

}//if($c_sql > 0){
  
	  
for($l=1;$l<=$c_sql;$l++){

$l_sql = mysql_fetch_assoc($sql);

//busca nombre articulo
$sql_sub2 = mysql_query("select * from subcategoria_2 where clave='$l_sql[idd_sub2_vs]'");
$l_sql_sub2 = mysql_fetch_assoc($sql_sub2);



$nombre_sub2 = $l_sql_sub2["nombre_sub2"]; 

//fin busca nombre articulo

//busca comprador


/*


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

*/

$sql_pas_nom = mysql_query("select campo2_p from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador' and campo1_p = 'nombre'  order by id_pasajero_p asc");

$l_pas_nom = mysql_fetch_assoc($sql_pas_nom);



$sql_pas_ape = mysql_query("select campo2_p from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador' and campo1_p = 'apellido'  order by id_pasajero_p asc");

$l_pas_ape = mysql_fetch_assoc($sql_pas_ape);


$nombre_comprador = "$l_pas_ape[campo2_p] $l_pas_nom[campo2_p]";

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


if($l_sql["estado_vs"] == "confirmado con deuda"){
$fondo_articulo = "#fa03ac";

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



echo "<div style='width:100%;height:20px;border:1px solid #555'>"; //eeeeeeeeeee|||||

echo "<div style='width:17px;float:left;margin-top:1px;margin-left:1px'><a href='venta_detalle1.php?id=$l_sql[id_ventas]&id_fecha=$id_fecha'><img src='imagenes/lupa1.png' title='ver detalles' ></div>";

//---------------------

if($_SESSION["tipo"]!="vendedor"){

echo "<a href='venta_detalle.php?id=$l_sql[id_ventas]&id_fecha=$id_fecha' style='color:$fondo_articulo;font-weight:bold'>";  

} //if($_SESSION["tipo"]!="vendedor"){

   echo "    
	  <div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo;margin-left:5px'>
	    <span style='font-size:10px;color:#555555'><b>Importe:</b></span> $$l_sql[total_guita_vs]
	  </div>";
	  

if($l_sql["estado_vs"] == "se�ado"){

   echo "      
	  <div style='width:100px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo;margin-left:5px'>
	    <span style='font-size:10px;color:#555555'><b>Se�a:</b></span> $$l_sql[sena_vs]
	  </div>";

} //if($l_con_fecha["estado"] == "se�ado"){
	  
	  
   echo "<div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' title='$det_pasajeros'>
	   <span style='font-size:10px;color:#555555'><b>Cantidad:</b></span> $tot_pasajeros | $l_sql[adulto_vs] + $tp_infoas + $tp_menores
	  </div>
	  
	    <div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' title='$l_sql[estado_vs]'>
	   <span style='font-size:10px;color:#555555'><b>Estado:</b></span> $l_sql[estado_vs]
	  </div>
	  
	  <div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' title='$texto_adic'>
	   <span style='font-size:10px;color:#555555'><b>Adic:</b></span> $tiene_adic
	  </div>
	  
	 
      <div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' title='$nombre_comprador'>
	  <span style='font-size:10px;color:#555555'><b>Comprador</b> </span> $nombre_comprador 
	  </div>	 
	  
     
      <div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' title='$vendedor' >
      <span style='font-size:10px;color:#555555'><b>Vendedor</b> </span> $vendedor 
	  </div>
      
      <div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' title='$l_sql[comision_vs]' >
	  <span style='font-size:10px;color:#555555'><b>Comisi�n</b> </span>
	  % $l_sql[comision_vs]
	  </div>
	  
	    <div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' title='$l_sql[ult_modificacion_vs]' >
	  <span style='font-size:10px;color:#555555'><b>Ult modif</b> </span> $l_sql[ult_modificacion_vs]
	  
	  </div>
	  
	  <div style='width:90px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' title='$l_sql[codigo_vs]' >
	  <span style='font-size:10px;color:#555555'><b>Cod</b> </span> $l_sql[codigo_vs]
	  
	  </div>";
	 

	 
if($_SESSION["tipo"]!="vendedor"){	 
      echo "</a>";
}//if($_SESSION["tipo"]!="vendedor"){
	  
echo   "<div style='width:120px;float:left;height:20px;line-height:20px;overflow:hidden;color:$fondo_articulo' >
	  <span style='font-size:10px;color:#555555'><b>Voucher</b> </span>"; 
	  
	  if($l_sql["estado_vs"]=="confirmado" || $l_sql["estado_vs"]=="pagado"){
	  
	        if($l_sql["voucher_vs"]=="si"){
	  
	  echo "
	  <a href='voucher.php?id=$l_sql[id_ventas]&voucher=si&id_sub2=$l_sql_sub2[clave]&id_carga=$l_sql[idd_carga_vs]'><img src='imagenes/bot_creado.png' title='ver / modificar' height='15' style='margin-top:2px'></a>
	  ";
	  
	        }else{ //if($l_sql["voucher_vs"]=="si"){

			echo "<a href='voucher.php?id=$l_sql[id_ventas]&voucher=no&id_sub2=$l_sql_sub2[clave]&id_carga=$l_sql[idd_carga_vs]'><img src='imagenes/bot_crear.png' height='15' style='margin-top:2px' ></a>";
			

            } //if($l_sql["voucher_vs"]=="si"){	
			
		} //if($l_sql["estado_vs"]=="confirmado" || $l_sql["estado_vs"]=="pagado"){	
	  
echo  "</div>";
	  
if($_SESSION["tipo"]!="vendedor"){

echo "<div style='float:left;text-align:center;width:20px;margin-top:1px;height:18px;background-color:#0263c4;color:#ffffff;font-size:11px;cursor:pointer' title='solicitud de servicio' onclick=location.href='solicitud_de_servicio.php?id=$l_sql[id_ventas]&id_fecha=$id_fecha' >S.S.</div>";  

} //if($_SESSION["tipo"]!="vendedor"){	 
	  
	  
echo "<div style='clear:both'></div>";


//---------------------



 

echo "</div>";//eeeeeeeeeee|||||	 

if($_SESSION["tipo"]=="administrador" || $_SESSION["tipo"]=="operativo"){	 
	 
//INFO ADICIONAL	 

echo "<div style='width:98%;background-color:#f3eef7;padding:5px;margin-bottom:2px'>";//�����������

$sql_it = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.publica_iva = 'si'
AND items_venta_articulo.idd_sub2_iva = '$l_sql[idd_sub2_vs]' AND items_base_cliente.idd_empresa_ibs='$_SESSION[logeo]' order by items_venta_articulo.orden_iva asc");

$cta_it = mysql_num_rows($sql_it);

echo "<div style='width:20px;float:left;height:40px;margin-right:5px'><a href='ventas_modifica.php?id=$l_sql[id_ventas]&idd_sub2_vs=$l_sql[idd_sub2_vs]&id_fecha=$id_fecha'><img src='imagenes/bot_modificar2.png'></a></div>";

for($w=1;$w<=$cta_it;$w++){

$lee_it = mysql_fetch_assoc($sql_it);

echo "<div style='width:80px;float:left'>
<div style='width:80px;color:#000000;overflow:hidden;height:20px'><b>$lee_it[nombre_ibc] </b> </div>";

$sql_inf = mysql_query("select * from items_valor where idd_ibc_iv= '$lee_it[idd_ibc_iva]' and idd_venta_iv='$l_sql[idd_carga_vs]' ");
$lee_inf = mysql_fetch_assoc($sql_inf);



if($lee_inf["valor_iv"]=="no"){

   if($lee_it["nombre_ibc"]=="conf prest" || $lee_it["nombre_ibc"]=="conf vehiculo" || $lee_it["nombre_ibc"]=="conf chofer" || $lee_it["nombre_ibc"]=="conf guia"){
   
echo "<div style='width:80px;height:30px;overflow:hidden' title='$lee_inf[valor_iv]' ><span style='color:#ff0000'><b> NO </b></span></div>";


}else{ //if($lee_it["nombre_ibc"]=="conf prest" || $lee_it


echo "<div style='width:80px;height:30px;overflow:hidden' title='$lee_inf[valor_iv]' ><span style='color:#000000'><b> $lee_inf[valor_iv] </b></span></div>";


} //if($lee_it["nombre_ibc"]=="conf prest" || $lee_it


}else{ //if($lee_inf["valor_iv"]=="no"){
echo "<div style='width:80px;height:30px;overflow:hidden' title='$lee_inf[valor_iv]' >$lee_inf[valor_iv] </div>";
} //if($lee_inf["valor_iv"]=="no"){





echo "</div>";

}//for($w=1;$w<=$cta_it;$w++){

 
echo "<div style='clear:both'></div>";	  
	  
	  
  

/*	  
echo  "
	  
	   <div style='width:115px;float:left'><a href='ventas_modifica.php?id=$l_sql[id_ventas]&idd_sub2_vs=$l_sql[idd_sub2_vs]'><img src='imagenes/bot_modificar1.png' style='margin-top:0px' height='20'></a></div>";
	  
*/	   
	  
	  
echo  "<div style='clear:both'></div>";

	  
echo "</div>";//�����������	  
	  
// FIN INFO ADICIONAL


}//if($_SESSION["tipo"]=="administrador" || $_SESSION["tipo"]=="operativo"){

} //for($l=1;$l<=$c_sql;$l++){








}//for($qa=1;$qa<=$cta_orden;$qa++){ //------------------------------AAAAAAAAAAAAAAAAAAAAAAAAAAAAA  -- AAA






?>



</div>  

<?php
echo "<div style='width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px'><a href='ventas.php?id_fecha=$_GET[id_fecha]'><img src='imagenes/bot_volver.png' title='Volver al panel'></a></div>";
?>
  
       </div> <!-- EEEEE -->


</body>
</html>
