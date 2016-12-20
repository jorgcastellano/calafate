<?php
session_start();
include_once("encabezado.inc.php");

if(isset($_POST["escribano_venta"])=="ok"){

########## resuelve la diferencia de pasajeros
########## resuelve la diferencia de pasajeros


if($_POST["adulto_antes"] > $_POST["adulto"]){
$vueltas_adulto = $_POST["adulto_antes"];
}//if($_POST["adulto_antes"] > $_POST["adulto"]){

if($_POST["adulto_antes"] <= $_POST["adulto"]){
$vueltas_adulto = $_POST["adulto"];
}//if($_POST["adulto_antes"] < $_POST["adulto"]){


if($_POST["bebe_antes"] > $_POST["bebe"]){
$vueltas_bebe = $_POST["bebe_antes"];
}//if($_POST["adulto_antes"] > $_POST[""bebe"]){

if($_POST["adulto_antes"] <= $_POST["bebe"]){
$vueltas_bebe = $_POST["bebe"];
}//if($_POST["adulto_antes"] < $_POST["adulto"]){

if($_POST["menor1_antes"] > $_POST["nino"]){
$vueltas_menor1 = $_POST["menor1_antes"];
}//if($_POST["menor1_antes"] > $_POST[""menor1"]){

if($_POST["menor1_antes"] <= $_POST["nino"]){
$vueltas_menor1 = $_POST["nino"];
}//if($_POST["menor1_antes"] < $_POST["menor1"]){


if($_POST["menor2_antes"] > $_POST["nino1"]){
$vueltas_menor2 = $_POST["menor2_antes"];
}//if($_POST["menor2_antes"] > $_POST[""menor2"]){

if($_POST["menor2_antes"] <= $_POST["nino1"]){
$vueltas_menor2 = $_POST["nino1"];
}//if($_POST["menor2_antes"] < $_POST["menor2"]){


if($_POST["menor3_antes"] > $_POST["nino2"]){
$vueltas_menor3 = $_POST["menor3_antes"];
}//if($_POST["menor3_antes"] > $_POST[""menor3"]){

if($_POST["menor3_antes"] <= $_POST["nino2"]){
$vueltas_menor3 = $_POST["nino2"];
}//if($_POST["menor3_antes"] < $_POST["menor3"]){


if($_POST["senior_antes"] > $_POST["senior"]){
$vueltas_senior = $_POST["senior_antes"];
}//if($_POST["senior_antes"] > $_POST[""senior"]){

if($_POST["senior_antes"] <= $_POST["senior"]){
$vueltas_senior = $_POST["senior"];
}//if($_POST["senior_antes"] < $_POST["senior"]){


########## resuelve la diferencia de pasajeros
########## resuelve la diferencia de pasajeros

//borra pasajeros viejos
//borra pasajeros viejos

mysql_query("DELETE from pasajeros where idd_carga_p='$_POST[id_carga]'");

//borra pasajeros viejos
//borra pasajeros viejos



$suma_pasajeros_antes = $_POST["adulto_antes"] + $_POST["bebe_antes"] + $_POST["menor1_antes"] + $_POST["menor2_antes"] + $_POST["menor3_antes"] + $_POST["senior_antes"];


$suma_pasajeros = $_POST["adulto"] + $_POST["bebe"] + $_POST["nino"] + $_POST["nino1"] + $_POST["nino2"] + $_POST["senior"];

$dif_pasajeros = $suma_pasajeros - $suma_pasajeros_antes;



if($dif_pasajeros > 0){
$nuevos_pas = $dif_pasajeros;
}else{//if($dif_pasajeros > 0){
$nuevos_pas = $suma_pasajeros;
}//if($dif_pasajeros > 0){


$sql_venta = mysql_query("select * from articulo where clave_sub2_ar='$_GET[id]' and estado='libre' and idd_fecha='$_POST[fecha_excursion]'");
$cta_venta = mysql_num_rows($sql_venta);

//if($cta_venta >= $nuevos_pas){

######################agrega 

if($suma_pasajeros > $suma_pasajeros_antes){ //agrega pasajeros si hace falta

$dife_pas = $suma_pasajeros - $suma_pasajeros_antes;


//actualiza tickets

$sql_t = mysql_query("select * from contador_billetes where idd_empresa_contador='$_POST[id_empresa]'");
$cta_t = mysql_num_rows($sql_t);

if($cta_t > 0){

$lee_t = mysql_fetch_assoc($sql_t);
$base_t = $lee_t["numero_contador"];

$nuevo_t = $base_t + $suma_pasajeros;

mysql_query("UPDATE contador_billetes SET numero_contador='$nuevo_t' where idd_empresa_contador='$lee_t[idd_empresa_contador]' ");
$num_tick = $base_t - 1;
}//if($cta_t > 0){


//fin actualiza tickets


$momento = time();


for($k=1;$k<=$dife_pas;$k++){
$lee_venta = mysql_fetch_assoc($sql_venta);

if($cta_t > 0){
$num_tick =  $num_tick + 1;
$imprime_tick = ",numero_tick_ar='$num_tick'";
}else{//if($cta_t > 0){
$imprime_tick = "";
}//if($cta_t > 0){

mysql_query("UPDATE articulo SET estado='reservado',idd_venta_ar='$_POST[id_carga]',fecha_venta_ar='$momento',idd_vendedor_ar='$_GET[id_v]' $imprime_tick where clave_sub2_ar='$_GET[id]' and estado='libre' and clave='$lee_venta[clave]'");

}//for($k=1;$k<=$){

}//if($suma_pasajeros > $suma_pasajeros_antes){  //agrega pasajeros si hace falta


######################agrega 









######################saca

 

 

if($suma_pasajeros_antes > $suma_pasajeros ){ //saca pasajeros si hace falta

$dife_pas = $suma_pasajeros_antes - $suma_pasajeros;

//echo $dife_pas." xxxxxxxxxxxxxxxxxxxxx<br>";

//actualiza tickets

$sql_t = mysql_query("select * from contador_billetes where idd_empresa_contador='$_POST[id_empresa]'");
$cta_t = mysql_num_rows($sql_t);

if($cta_t > 0){

$lee_t = mysql_fetch_assoc($sql_t);
$base_t = $lee_t["numero_contador"];

$nuevo_t = $base_t - $dife_pas;

mysql_query("UPDATE contador_billetes SET numero_contador='$nuevo_t' where idd_empresa_contador='$lee_t[idd_empresa_contador]' ");
$num_tick = $base_t - 1;
}//if($cta_t > 0){


//fin actualiza tickets


$sql_venta_sac = mysql_query("select * from articulo where clave_sub2_ar='$_GET[id]' and estado='reservado' and idd_fecha='$_POST[fecha_excursion]'");
$cta_venta_sac = mysql_num_rows($sql_venta_sac);

$momento = time();


for($k=1;$k<=$dife_pas;$k++){
$lee_venta_sac = mysql_fetch_assoc($sql_venta_sac);

//echo $k." aaaaaaaaaaaaaaa <br>";

mysql_query("UPDATE articulo SET estado='libre',idd_venta_ar='',numero_tick_ar='',fecha_venta_ar='$momento',idd_vendedor_ar='$_GET[id_v]' where clave_sub2_ar='$_GET[id]' and estado='reservado' and clave='$lee_venta_sac[clave]'");



}//for($k=1;$k<=$){

}//if($suma_pasajeros > $suma_pasajeros_antes){  //agrega pasajeros si hace falta


######################saca







//} //if($cta_venta >= $suma_pasajeros){


//chequea que se haya grabado la info en articulos y carga la venta !!!!!!!!!!!!!!!!!!!!!!!!!!!!!1

$sty = mysql_query("select * from articulo where clave_sub2_ar='$_GET[id]' and idd_venta_ar='$_POST[id_carga]'");
$c_sty = mysql_num_rows($sty);

if($c_sty > 0){ //RRRRRrrrrrRRRRRRRRRRRRRRRRRRRRRRRRr

//carga la venta en tabla venta

if(isset($_GET["id_v"])){
$clave_vendedor = $_GET["id_v"];

$busca_comi = mysql_query("select * from usuario where id_usuario='$_GET[id_v]' ");
$l_comi = mysql_fetch_assoc($busca_comi);
$comision = $l_comi["comision_usuario"];

}else{//if(isset($_GET["id_v"])){
$clave_vendedor = "";
$comision = "";
}//if(isset($_GET["id_v"])){


$exis_id_v = isset($_GET["id_v"]);

if(isset($_GET["id_vvv"]) && $exis_id_v == FALSE){
$clave_vendedor = $_GET["id_vvv"];

$busca_comi = mysql_query("select * from usuario where id_usuario='$_GET[id_vvv]' ");
$l_comi = mysql_fetch_assoc($busca_comi);
$comision = $l_comi["comision_usuario"];

}//if(isset($_GET["id_vvv"])){

$fecha_excur = $_POST["fecha_excursion"] + 10;

$hoy_es = time();

$id_carga = $_POST["id_carga"];

$total_guita = $_POST["total_guita"];

$dif_dias_hoy = $hoy_es - $id_carga;

//if($dif_dias_hoy > 86400){ //pregunta si son distintos el dia d carga del de modificacion

$sql_guita = mysql_query("select total_guita_vs,sena_vs from ventas where idd_carga_vs='$id_carga'");
$l_sql_guita = mysql_fetch_assoc($sql_guita);

$guita_anterior_fac = $l_sql_guita["total_guita_vs"];
$guita_anterior = $l_sql_guita["sena_vs"];

$diferencia_guita = $_POST["total_guita"] - $guita_anterior;

$operacion ="";

if($diferencia_guita > 0){

$total_nueva_guita = $diferencia_guita;
$operacion = "suma";

mysql_query("INSERT INTO haber (monto_h, idd_vendedor_h,idd_operacion_h,fecha_h) VALUES ('$diferencia_guita','$_GET[id_v]','$_POST[id_carga]','$hoy_es')");




}//if($diferencia_guita > 0){


if($diferencia_guita < 0){

$diferencia_guita1 = $guita_anterior - $_POST["total_guita"];

$total_nueva_guita = $diferencia_guita1;
$operacion = "resta";


mysql_query("INSERT INTO debe (monto_d, idd_vendedor_d,idd_operacion_d,fecha_d) VALUES ('$diferencia_guita1','$_GET[id_v]','$_POST[id_carga]','$hoy_es')");





}//if($diferencia_guita > 0){


/*

if($operacion != ""){

mysql_query("INSERT into ventas_diferencia (idd_carga_vd,suma_vd,fecha_vd,operacion_vd,vendedor_vd) VALUES ('$id_carga','$total_nueva_guita','$hoy_es','$operacion','$_GET[id_v]')");

}//if($operacion != ""){
*/

//}//if($dif_dias_hoy > 86400){ //pregunta si son distintos el dia d carga del de modificacion




mysql_query("UPDATE ventas SET 
idd_sub2_vs= '$_GET[id]',	
adulto_vs= '$_POST[adulto]',	
bebe_vs= '$_POST[bebe]',	
nino_vs= '$_POST[nino]',	
nino1_vs= '$_POST[nino1]',	
nino2_vs= '$_POST[nino2]',	
senior_vs= '$_POST[senior]',	
total_guita_vs= '$_POST[total_guita]',	
idd_empresa_vs= '$_POST[id_empresa]',	
estado_vs= 'reservado',	
vendedor_vs= '$clave_vendedor',	
comision_vs= '$comision',	
fecha_excur_vs= '$fecha_excur',	
precio_base_vs= '$_POST[precio_excur]'
where idd_carga_vs= '$_POST[id_carga]'
");



//fin carga la venta en tabla venta

$id_fecha = $fecha_excur;
$id_fecha1 = $id_fecha + 86400;

######datos de la reserva

include_once("utilidades/info_reserva_base.inc.php");
$cant_vueltasy = count($codigo_ir);


//-> comprador

for($t=1;$t<=$cant_vueltasy;$t++){

if(isset($_POST["a".$t])){

$campo1 = $codigo_ir[$t];
$campo2 = $_POST["a".$t];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','comprador')");

}//if(isset($_POST["a".$t])){

}//for($t=1;$t<=$cant_vueltasy;$t++){

//-> fin comprador


//->pasajeros

$num_pasajero = 0;

//adulto

for($z=1;$z<=25;$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

if(isset($_POST["inv_adulto_".$z."_1"]) && $_POST["inv_adulto_".$z."_1"] !=""){



for($tt=1;$tt<=$cant_vueltasy;$tt++){

if(isset($_POST["inv_adulto_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_adulto_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','adulto','$num_pasajero')");

}//if(isset($_POST["a".$tt])){



}//for($tt=1;$tt<=$cant_vueltasy;$tt++){


} //if(isset($_POST["inv_adulto_".$z."_1"]) && $_POST["inv_adulto_".$z."_1"] !=""){

} //for($z=1;$z<=$_POST["adulto"];$z++){ //uuu

//fin adulto


//bebe

for($z=1;$z<=25;$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

if(isset($_POST["inv_bebe_".$z."_1"]) && $_POST["inv_bebe_".$z."_1"] !=""){

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_bebe_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_bebe_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','bebe','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){

}//if(isset($_POST["inv_bebe_".$z."_1"]) && $_POST["inv_bebe_".$z."_1"] !=""){

} //for($z=1;$z<=$_POST["bebe"];$z++){ //uuu

//fin bebe

//nino

for($z=1;$z<=25;$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

if(isset($_POST["inv_nino_".$z."_1"]) && $_POST["inv_nino_".$z."_1"] !=""){

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_nino_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_nino_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','nino','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){

}//if(isset($_POST["inv_nino_".$z."_1"]) && $_POST["inv_nino_".$z."_1"] !=""){

} //for($z=1;$z<=$_POST["nino"];$z++){ //uuu

//fin nino


//nino1

for($z=1;$z<=25;$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

if(isset($_POST["inv_nino1_".$z."_1"]) && $_POST["inv_nino1_".$z."_1"] !=""){

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_nino1_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_nino1_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','nino1','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){

}//if(isset($_POST["inv_nino1_".$z."_1"]) && $_POST["inv_nino1_".$z."_1"] !=""){

} //for($z=1;$z<=$_POST["nino1"];$z++){ //uuu

//fin nino1

//nino2

for($z=1;$z<=25;$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

if(isset($_POST["inv_nino2_".$z."_1"]) && $_POST["inv_nino2_".$z."_1"] !=""){

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_nino2_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_nino2_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','nino2','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){

}//if(isset($_POST["inv_nino2_".$z."_1"]) && $_POST["inv_nino2_".$z."_1"] !=""){

} //for($z=1;$z<=$_POST["nino2"];$z++){ //uuu

//fin nino2

//senior

for($z=1;$z<=25;$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

if(isset($_POST["inv_senior_".$z."_1"]) && $_POST["inv_senior_".$z."_1"] !=""){

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_senior_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_senior_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','senior','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){


} //if(isset($_POST["inv_senior_".$z."_1"]) && $_POST["inv_senior_".$z."_1"] !=""){

} //for($z=1;$z<=$_POST["senior"];$z++){ //uuu

//fin senior




###--> graba el hotel en ITEMS VALOR
###--> graba el hotel en ITEMS VALOR


//borra los item cargados
//borra los item cargados

mysql_query("DELETE FROM items_valor where idd_venta_iv='$_POST[id_carga]'");

//borra los item cargados
//borra los item cargados



$busca_hl = mysql_query("select * from pasajeros where idd_carga_p= '$_POST[id_carga]' and campo1_p = 'hotel' and campo2_p <> '' ");
$cta_hl = mysql_num_rows($busca_hl);

if($cta_hl > 0){
$lee_hl = mysql_fetch_assoc($busca_hl);
mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('$lee_hl[campo2_p]','2','$_POST[id_carga]')");

}//if($cta_hl > 0){


###--> fin graba el hotel en ITEMS VALOR
###--> fin graba el hotel en ITEMS VALOR



##------> vuelo in/out
##------> vuelo in/out

if(isset($_POST["a20"])){
mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('$_POST[a20]','22','$_POST[id_carga]')");
}//if(isset($_POST["a20"])){

if(isset($_POST["a21"])){
mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('$_POST[a21]','23','$_POST[id_carga]')");
}//if(isset($_POST["a21"])){


##------> fin vuelo in/out
##------> fin vuelo in/out


//->fin pasajeros

####....llll----> graba en los datos adicionales en NO 
####....llll----> graba en los datos adicionales en NO 

mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('no','11','$_POST[id_carga]')");
mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('no','12','$_POST[id_carga]')");
mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('no','18','$_POST[id_carga]')");
mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('no','19','$_POST[id_carga]')");
mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('no','20','$_POST[id_carga]')");
mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('no','21','$_POST[id_carga]')");


####....llll----> fin graba en los datos adicionales en NO 
####....llll----> fin graba en los datos adicionales en NO 


#### graba pick up
#### graba pick up

if(isset($_POST["pickup"])){

mysql_query("INSERT INTO items_valor (valor_iv,idd_ibc_iv,idd_venta_iv) VALUES ('$_POST[pickup]','16','$_POST[id_carga]')");

}//if(isset($_POST["pickup"])){


#### graba pick up
#### graba pick up


######fin datos de la reserva


//graba adicionales

for($b=1;$b<=20;$b++){



if(isset($_POST["ad".$b])){
$adi = $_POST["ad".$b];



mysql_query("INSERT INTO ventas_adicionales (idd_carga_va,idd_ad_va) VALUES ('$_POST[id_carga]','$adi')");
} //if(isset($_POST["ad"$b])){

}//for($b=1;$b<=20;$b++){

//fin graba adicionales

//// actualiza las transacciones

mysql_query("INSERT INTO transacciones1 (idd_venta_tran1,idd_empresa_tran1) VALUES ('$_POST[id_carga]','$_POST[id_empresa]')");


//// fin actualiza las transacciones


//>>>>>>>>>>>>>>> GENERA BOUCHER <<<<<
//>>>>>>>>>>>>>>> GENERA BOUCHER <<<<<




//>>>>>>>>>>>>>>> FIN GENERA BOUCHER <<<<<
//>>>>>>>>>>>>>>> FIN GENERA BOUCHER <<<<<




}//if($c_sty > 0){ //RRRRRrrrrrRRRRRRRRRRRRRRRRRRRRRRRRr

// fin chequea que se haya grabado la info en articulos y carga la venta !!!!!!!!!!!!!!!!!!!!!!!!1




} //if(isset($_POST["escribano_venta"])=="ok"){


?>

<META NAME="Description" CONTENT="">

<META NAME="Keywords" CONTENT="">



<title>PLATAFORMA</title>

<script type="text/javascript" src="java.js"></script>


<!-- GALERIA JQUERY -->

   <!-- Arquivos utilizados pelo jQuery lightBox plugin -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
    <!-- / fim dos arquivos utilizados pelo jQuery lightBox plugin -->
    
    <!-- Ativando o jQuery lightBox plugin -->
    <script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>
   	<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		width:580px;
		margin-left:10px;
		margin-top:0px
		
		
	}
	#gallery ul { list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 3px solid #1e2254;
		border-width: 3px 3px 3px;
	}
	#gallery ul a:hover img {
		border: 3px solid #333;
		border-width: 3px 3px 3px;
		color: #333;
	}
	#gallery ul a:hover { color: #333; }
	</style>


<!-- FIN GALERIA JQUERY -->


    <script src="utilidades/src/js/jscal2.js"></script>
    <script src="utilidades/src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/steel/steel.css" />

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


  xml_2.open("GET","manda_mail.php?id="+ valor );
  xml_2.send(null);
  

  

  
  }



//----------------------fin ajax manda mail



</script>	



<style>

.pagos{
border:0px;
height:20px;
margin-bottom:3px;
}

</style>




<script>

total_suma_pesos = 0;


function suma_re_total(){

suma_el_total = 0;

suma_el_total = parseFloat(document.medio.tot_debito1.value) + parseFloat(document.medio.tot_debito2.value) + parseFloat(document.medio.tot_credito1.value) + parseFloat(document.medio.tot_credito2.value) + parseFloat(document.medio.tot_peso.value) + parseFloat(document.medio.tot_chileno.value) + parseFloat(document.medio.tot_real.value) + parseFloat(document.medio.tot_euro.value)  + parseFloat(document.medio.tot_dolar.value);

document.medio.total_pesos.value= suma_el_total;


}//function suma_re_total(){




function calcula_credito1(valor){



calcula_creditos1 = valor ;
document.medio.tot_credito1.value= calcula_creditos1;

total_suma_pesos = total_suma_pesos + parseFloat(calcula_creditos1);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_credito1(){


function calcula_credito2(valor){



calcula_creditos2 = valor ;
document.medio.tot_credito2.value= calcula_creditos2;

total_suma_pesos = total_suma_pesos + parseFloat(calcula_creditos2);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_credito2(){


function calcula_debito1(valor){



calcula_debitos1 = valor ;
document.medio.tot_debito1.value= calcula_debitos1;

total_suma_pesos = total_suma_pesos + parseFloat(calcula_debitos1);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_debito1(){


function calcula_debito2(valor){



calcula_debitos2 = valor ;
document.medio.tot_debito2.value= calcula_debitos2;

total_suma_pesos = total_suma_pesos + parseFloat(calcula_debitos2);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_debito2(){



function calcula_peso(valor){



calcula_pesos = valor ;
document.medio.tot_peso.value= calcula_pesos;

total_suma_pesos = total_suma_pesos + parseFloat(calcula_pesos);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_peso(){


function calcula_chileno(valor){
calcula_chilenos = valor / document.medio.cot_chileno.value;


calcula_chilenos = calcula_chilenos.toFixed(2);
document.medio.tot_chileno.value= calcula_chilenos;



total_suma_pesos = total_suma_pesos + parseFloat(calcula_chilenos);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_chileno(){

function calcula_real(valor){

calcula_reales = valor * document.medio.cot_real.value;


calcula_reales = calcula_reales.toFixed(2);

document.medio.tot_real.value= calcula_reales;




total_suma_pesos = total_suma_pesos + parseFloat(calcula_reales);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_real(){


function calcula_dolar(valor){

calcula_dolares = valor * document.medio.cot_dolar.value;


calcula_dolares = calcula_dolares.toFixed(2);

document.medio.tot_dolar.value= calcula_dolares;




total_suma_pesos = total_suma_pesos + parseFloat(calcula_dolares);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_dolar(){


function calcula_euro(valor){

calcula_euros = valor * document.medio.cot_euro.value;


calcula_euros = calcula_euros.toFixed(2);



document.medio.tot_euro.value= calcula_euros;




total_suma_pesos = total_suma_pesos + parseFloat(calcula_euros);

//document.medio.total_pesos.value= total_suma_pesos;

suma_re_total();

}//function calcula_real(){




</script>


</head>

<body >

<?php 

##################### AVERIGUA SI LA MODIFICACION ES EN EL MISMO DIA
##################### AVERIGUA SI LA MODIFICACION ES EN EL MISMO DIA


$hoy_dia = time();

$ddd_carga = date("d/m/y", $_POST["id_carga"]);

$partes = explode("/",$ddd_carga);

$dia = $partes[0];
$mes = $partes[1];
$ano = $partes[2];


$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;

$id_fecha_carga = mktime(00,00,00,$mess,$diaa,$anoo);

$id_fecha_carga1 = $id_fecha_carga + 86400;

$dif_ddd_dia = $hoy_dia - $id_fecha_carga;

if($dif_ddd_dia <= 86400){
$es_distinto_dia = "no";
}else{//if($dif_ddd_dia <= 86400){
$es_distinto_dia = "si";
}//if($dif_ddd_dia <= 86400){


##################### AVERIGUA SI LA MODIFICACION ES EN EL MISMO DIA
##################### AVERIGUA SI LA MODIFICACION ES EN EL MISMO DIA



?>




                                                  <div  class="global" >

<?php												  
echo "
<div class='encabezado'>
<div style='color:#fff;font-size:25px;padding-top:150px;padding-left:50px;text-transform:uppercase'>  reserva exitosa ";

if(isset($_GET["id_v"])){

$sql_ven = mysql_query("select * from usuario where id_usuario='$_GET[id_v]' ");
$l_ven = mysql_fetch_assoc($sql_ven);

echo " <span style='color:#555555' >&nbsp; &nbsp; &nbsp; Vendedor: $l_ven[nombre_usuario] </span>";

}//if(isset($_GET["id_v"])){


echo "</div></div>";				

?>	

											  
<div style="width:50px;float:left">



</div>

<div style="width:1000px;float:left;padding:5px"> <!--   ttt -->
<?php

//if($dif_transacciones > 0){ //se fija si la empresa tiene transacciones para vender





if($operacion == "suma"){

echo "Modificacion exitosa: (para terminar el proceso haga click en cargar) <br>
      Codigo: $_POST[id_carga] <br>
	  Un total de $suma_pasajeros personas<br>
	  La operacion actual es de: Ar$ $_POST[total_guita] <br>
	  Saldo a favor: Ar$ $guita_anterior <br>
	  La diferencia dinero a COBRAR es: ar$ $diferencia_guita <br>
	  ";

$total_guita = 	$total_guita;  
$tipo_opereta = "cobrar";	  

$guita_cobra = $_POST["total_guita"] - $guita_anterior_fac;

mysql_query("INSERT INTO entra_bruto (total_eb,idd_vendedor_eb,fecha_eb,idd_carga_eb) VALUES ('$guita_cobra','$_GET[id_v]','$hoy_es','$_POST[id_carga]')");//carga el total de lo facturado nuevo


}//if($operacion == "suma"){


if($operacion == "resta"){

$diferencia_guita = abs($diferencia_guita);

$guita_devuelve = $guita_anterior_fac - $_POST["total_guita"];


mysql_query("INSERT INTO sale_bruto (total_sb,idd_vendedor_sb,fecha_sb,idd_carga_sb) VALUES ('$guita_devuelve','$_GET[id_v]','$hoy_es','$_POST[id_carga]')");//carga el total de lo devuelto nuevo



echo "Modificacion exitosa: <br>
      Codigo: $_POST[id_carga] <br>
	  Un total de $suma_pasajeros personas<br>
	  La operacion actual es de: Ar$ $_POST[total_guita] <br>
	  Saldo a favor: Ar$ $guita_anterior <br>
	  La diferencia dinero a DEVOLVER es: ar$ $diferencia_guita1 <br>
      ";

$tipo_opereta = "devolver";	  
$total_guita = 	$total_guita;  

}//if($operacion == "suma"){




if($operacion != "resta" && $operacion != "suma"){



echo "Modificacion exitosa: <br>
      Codigo: $_POST[id_carga] <br>
	  Un total de $suma_pasajeros personas<br>
	  La operacion actual es de: Ar$ $_POST[total_guita] <br>
	  Saldo a favor: Ar$ $guita_anterior <br>
	  La diferencia dinero a DEVOLVER es: ar$ 0 <br>
      ";

$tipo_opereta = "mantener";	  
$total_guita = 	$total_guita;  

}//if($operacion == "suma"){




	  
	  
//PAGAR


#######################IMPRIME OPCION DE PAGO EFECTIVO O TARJETA SI ES QUE SE VENDE CON VENDEDOR
#######################IMPRIME OPCION DE PAGO EFECTIVO O TARJETA SI ES QUE SE VENDE CON VENDEDOR

if(isset($_GET["id_v"])){

if($operacion == "resta"){ //esconde la forma de pago si hay q devolver
echo "<div style='display:none'>";//*******/*/*/*/*/*/*/*/
}else{//if($operacion == "resta"){
echo "<div>";//*******/*/*/*/*/*/*/*/
}//if($operacion == "resta"){


echo "<br><br>Carga medio de pago: <br><br>";

echo "<form method='post' action='carga_pago_modifica.php?id_v=$_GET[id_v]' name='medio'>

<div style='line-height:30px;color:#0061cc'>Si desea cargar un descuento especial ingrese el monto <br> total del mismo en pesos: 

$<input type='text' name='descuento' style='width:100px;border:2px solid #cccccc'  onchange='calcula()'></div>
<br>
<div style='line-height:30px;color:#ff0000'>Si desea cargar un recargo especial ingrese el monto <br> total del mismo en pesos: 

$<input type='text' name='recargo' style='width:100px;border:2px solid #cccccc'  onchange='calcula1()'></div>


<div id='nueva_guita'><input type='hidden' name='total_guita' value='$total_guita' ></div>

 ";	 

	 
	 
	 
	 
################################## NUEVA TABLA DE PAGO	 ----------------------||||||||||||||||||
################################## NUEVA TABLA DE PAGO	 ----------------------||||||||||||||||||


//cotizaciones


$sql_cot = mysql_query("select valor_monedas from monedas where idd_monedas_base='2' and idd_empresa_monedas='$_POST[id_empresa]'");
$lee_cot = mysql_fetch_assoc($sql_cot);

$cot_dolar = $lee_cot["valor_monedas"];


$sql_cot = mysql_query("select valor_monedas from monedas where idd_monedas_base='3' and idd_empresa_monedas='$_POST[id_empresa]'");
$lee_cot = mysql_fetch_assoc($sql_cot);

$cot_euro = $lee_cot["valor_monedas"];

$sql_cot = mysql_query("select valor_monedas from monedas where idd_monedas_base='4' and idd_empresa_monedas='$_POST[id_empresa]'");
$lee_cot = mysql_fetch_assoc($sql_cot);

$cot_chileno = $lee_cot["valor_monedas"];

$sql_cot = mysql_query("select valor_monedas from monedas where idd_monedas_base='5' and idd_empresa_monedas='$_POST[id_empresa]'");
$lee_cot = mysql_fetch_assoc($sql_cot);

$cot_real = $lee_cot["valor_monedas"];


//cotizaciones



echo "<br><br><br>";



echo "

<div style='width:800px;padding:10px;background-color:#cccccc;margin-left:10px'> <!-- ffff0000 -->

<input type='text' style='width:200px' class='pagos' readonly value='Medio de pago'>
<input type='text' style='width:80px' class='pagos' readonly value='Cotizacion'>
<input type='text' style='width:80px' class='pagos' readonly value='Importe'>
<input type='text' style='width:80px' class='pagos' readonly value='total pesos'> <br>";


$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='peso argentino' ");
$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);



if($c_rql > 0 && $tipo_opereta == "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];
}else{//if($c_rql > 0){
$c_moneda = 0;
}//if($c_rql > 0){





echo "
<input type='text' style='width:200px' class='pagos' readonly value='Peso Arg'>
<input type='text' style='width:80px' class='pagos' readonly value='1' name='cot_peso'>
<input type='text' style='width:80px' class='pagos' value='$c_moneda' name='peso' onChange='calcula_peso(document.medio.peso.value)'>
<input type='text' style='width:80px' class='pagos' readonly value='$c_moneda' name='tot_peso'> <br>";




$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='peso chileno' ");
$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);



if($c_rql > 0 && $tipo_opereta == "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];

$t_moneda = $c_moneda / $cot_chileno;

}else{//if($c_rql > 0){
$c_moneda = 0;
$t_moneda = 0;
}//if($c_rql > 0){



echo "
<input type='text' style='width:200px' class='pagos' readonly value='Peso Chileno'>
<input type='text' style='width:80px' class='pagos' readonly value='$cot_chileno' name='cot_chileno'>
<input type='text' style='width:80px' class='pagos' value='$c_moneda' name='chileno' onChange='calcula_chileno(document.medio.chileno.value)' >
<input type='text' style='width:80px' class='pagos' readonly value='$t_moneda' name='tot_chileno'> <br>";



$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='real' ");
$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);

if($c_rql > 0 && $tipo_opereta == "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];

$t_moneda = $c_moneda * $cot_real;

}else{//if($c_rql > 0){
$c_moneda = 0;
$t_moneda = 0;
}//if($c_rql > 0){


echo "
<input type='text' style='width:200px' class='pagos' readonly value='Reales'>
<input type='text' style='width:80px' class='pagos' readonly value='$cot_real' name='cot_real'>
<input type='text' style='width:80px' class='pagos'  value='$c_moneda' name='real' onChange='calcula_real(document.medio.real.value)'>
<input type='text' style='width:80px' class='pagos' readonly value='$t_moneda' name='tot_real'> <br>";


$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='dolar' ");
$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);

if($c_rql > 0 && $tipo_opereta != "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];

$t_moneda = $c_moneda * $cot_dolar;

}else{//if($c_rql > 0){
$c_moneda = 0;
$t_moneda = 0;
}//if($c_rql > 0){


echo "
<input type='text' style='width:200px' class='pagos' readonly value='Dolar'>
<input type='text' style='width:80px' class='pagos' readonly value='$cot_dolar' name='cot_dolar'>
<input type='text' style='width:80px' class='pagos'  value='$c_moneda' name='dolar' onChange='calcula_dolar(document.medio.dolar.value)'>
<input type='text' style='width:80px' class='pagos' readonly value='$t_moneda' name='tot_dolar'> <br>";


$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='euro' ");
$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);

if($c_rql > 0 && $tipo_opereta != "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];

$t_moneda = $c_moneda * $cot_euro;

}else{//if($c_rql > 0){
$c_moneda = 0;
$t_moneda = 0;
}//if($c_rql > 0){


echo "
<input type='text' style='width:200px' class='pagos' readonly value='Euro'>
<input type='text' style='width:80px' class='pagos' readonly value='$cot_euro' name='cot_euro'>
<input type='text' style='width:80px' class='pagos'  value='$c_moneda' name='euro' onChange='calcula_euro(document.medio.euro.value)'>
<input type='text' style='width:80px' class='pagos' readonly value='$t_moneda' name='tot_euro'> <br>
";


$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='tarjeta de credito' order by id_vp asc limit 0,1 ");


$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);

if($c_rql > 0 && $tipo_opereta == "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];
$c_dato1 = $l_rql["num_cupon_vp"];
$c_dato2 = $l_rql["num_operacion_vp"];
 	
}else{//if($c_rql > 0){
$c_moneda = 0;
$c_dato1 = 0;
$c_dato2 = 0;
}//if($c_rql > 0){



echo "
<input type='text' style='width:200px' class='pagos' readonly value='Tarjeta CREDITO 1'>
<input type='text' style='width:80px' class='pagos' readonly value='' >
<input type='text' style='width:80px' class='pagos'  value='$c_moneda' name='credito1' onChange='calcula_credito1(document.medio.credito1.value)'>
<input type='text' style='width:80px' class='pagos' readonly value='$c_moneda' name='tot_credito1' > 
<input type='text' style='width:100px' class='pagos'  value='$c_dato2' onfocus='this.select()' name='operacion_cred1'>
<input type='text' style='width:100px' class='pagos'  value='$c_dato1' onfocus='this.select()' name='cupon_cred1'> <br>";


$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='tarjeta de credito' order by id_vp asc limit 1,1 ");
$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);

if($c_rql > 0 && $tipo_opereta == "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];
$c_dato1 = $l_rql["num_cupon_vp"];
$c_dato2 = $l_rql["num_operacion_vp"];
 	
}else{//if($c_rql > 0){
$c_moneda = 0;
$c_dato1 = 0;
$c_dato2 = 0;
}//if($c_rql > 0){


echo "
<input type='text' style='width:200px' class='pagos' readonly value='Tarjeta CREDITO 2'>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos'  value='$c_moneda' name='credito2' onChange='calcula_credito2(document.medio.credito2.value)'>
<input type='text' style='width:80px' class='pagos' readonly value='$c_moneda' name='tot_credito2'> 
<input type='text' style='width:100px' class='pagos'  value='$c_dato2' onfocus='this.select()' name='operacion_cred2'>
<input type='text' style='width:100px' class='pagos'  value='$c_dato1' onfocus='this.select()' name='cupon_cred2'> <br>
";



$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='tarjeta de debito' order by id_vp asc limit 0,1 ");


$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);

if($c_rql > 0 && $tipo_opereta == "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];
$c_dato1 = $l_rql["num_cupon_vp"];
$c_dato2 = $l_rql["num_operacion_vp"];
 	
}else{//if($c_rql > 0){
$c_moneda = 0;
$c_dato1 = 0;
$c_dato2 = 0;
}//if($c_rql > 0){


echo "
<input type='text' style='width:200px' class='pagos' readonly value='Tarjeta DEBITO 1'>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos'  value='$c_moneda' name='debito1' onChange='calcula_debito1(document.medio.debito1.value)'>
<input type='text' style='width:80px' class='pagos' readonly value='$c_moneda' name='tot_debito1'> 
<input type='text' style='width:100px' class='pagos'  value='$c_dato2' onfocus='this.select()' name='operacion_deb1'>
<input type='text' style='width:100px' class='pagos' value='$c_dato1' onfocus='this.select()' name='cupon_deb1'> <br>
";


$rql = mysql_query("select * from ventas_pago where idd_venta_vp= '$_POST[id_carga]' and moneda_vp='tarjeta de debito' order by id_vp asc limit 1,1 ");


$c_rql = mysql_num_rows($rql);


$l_rql = mysql_fetch_assoc($rql);

if($c_rql > 0 && $tipo_opereta == "mantener" && $es_distinto_dia=="no"){
$c_moneda = $l_rql["importe_vp"];
$c_dato1 = $l_rql["num_cupon_vp"];
$c_dato2 = $l_rql["num_operacion_vp"];
 	
}else{//if($c_rql > 0){
$c_moneda = 0;
$c_dato1 = 0;
$c_dato2 = 0;
}//if($c_rql > 0){

echo "
<input type='text' style='width:200px' class='pagos' readonly value='Tarjeta DEBITO 2'>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos'  value='$c_moneda' name='debito2' onChange='calcula_debito2(document.medio.debito2.value)' >
<input type='text' style='width:80px' class='pagos' readonly value='$c_moneda' name='tot_debito2'> 
<input type='text' style='width:100px' class='pagos'  value='$c_dato2' onfocus='this.select()' name='operacion_deb2'>
<input type='text' style='width:100px' class='pagos'  value='$c_dato1' onfocus='this.select()' name='cupon_deb2'> <br>";


echo "
<input type='text' style='width:200px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos' readonly value='0' name='total_pesos'> <br>




</div><!-- ffff0000 -->

";

echo "<br><br><br>";

echo "<script>suma_re_total()</script>";
################################## FIN NUEVA TABLA DE PAGO	 ----------------------||||||||||||||||||
################################## FIN NUEVA TABLA DE PAGO	 ----------------------||||||||||||||||||
	 
	 
	 
	 
	 
	 
echo "</div>";//*******/*/*/*/*/*/*/*/	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
if($operacion == "resta"){ //esconde la forma de pago si hay q devolver
echo "<div style='display:none'>";//*******/*/*/*/*/*/*/*/------------------
}else{//if($operacion == "resta"){
echo "<div>";//*******/*/*/*/*/*/*/*/------------------
}//if($operacion == "resta"){	 
	 
	 
	 
	 
 //pone cantidad de billetes	 
 //pone cantidad de billetes	 
 
 //pone cantidad de billetes	 
 //pone cantidad de billetes	


$d = array(); 
$d[1] = "0.10";
$d[2] = "0.25";
$d[3] = "0.50";
$d[4] = "1.00";
$d[5] = "10.00";
$d[6] = "20.00";
$d[7] = "50.00";
$d[8] = "100.00";

$e = array();
$e[1] = "2";
$e[2] = "5";
$e[3] = "10";
$e[4] = "20";
$e[5] = "50";
$e[6] = "100";
$e[7] = "200";
$e[8] = "500";

$r = array();
$r[1] = "0.5";
$r[2] = "1";
$r[3] = "2";
$r[4] = "5";
$r[5] = "10";
$r[6] = "20";
$r[7] = "50";
$r[8] = "100";

$c = array();
$c[1] = "10";
$c[2] = "50";
$c[3] = "100";
$c[4] = "1000";
$c[5] = "2000";
$c[6] = "5000";
$c[7] = "10000";
$c[8] = "20000";



$dd = array();
$dd[1]= 0;
$dd[2]= 0;
$dd[3]= 0;
$dd[4]= 0;
$dd[5]= 0;
$dd[6]= 0;
$dd[7]= 0;
$dd[8]= 0;

$ee = array();
$ee[1]= 0;
$ee[2]= 0;
$ee[3]= 0;
$ee[4]= 0;
$ee[5]= 0;
$ee[6]= 0;
$ee[7]= 0;
$ee[8]= 0;

$rr = array();
$rr[1]= 0;
$rr[2]= 0;
$rr[3]= 0;
$rr[4]= 0;
$rr[5]= 0;
$rr[6]= 0;
$rr[7]= 0;
$rr[8]= 0;

$cc = array();
$cc[1]= 0;
$cc[2]= 0;
$cc[3]= 0;
$cc[4]= 0;
$cc[5]= 0;
$cc[6]= 0;
$cc[7]= 0;
$cc[8]= 0;

if($tipo_opereta == "mantener"){
//busca los entrantes



for($q=1;$q<9;$q++){

$bil = $d[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb) as cantidad_cb from cantidad_billetes where idd_carga_cb= '$_POST[id_carga]' and moneda_cb='dolar' and billete_cb ='$bil'  ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb"] > 0){
$dd[$q] = $lee_bil["cantidad_cb"];
} //if($lee_bil["cantidad_cb"] > 0){

} //for($q=1;$q<9;$q++){
 
// busca los entrantes

//busca los salientes

for($q=1;$q<9;$q++){

$bil = $d[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb_v) as cantidad_cb_v from cantidad_billetes_vuelto where moneda_cb_v='dolar' and billete_cb_v ='$bil' and idd_carga_cb_v= '$_POST[id_carga]' ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb_v"] > 0){

$dd[$q] =  $dd[$q] - $lee_bil["cantidad_cb_v"];

} //if($lee_bil["cantidad_cb_v"] > 0){

} //for($q=1;$q<9;$q++){


//busca los salientes
 
 
}//if($tipo_opereta == "mantener"){ 
 
echo "<br> Cantidad y tipo de billetes de moneda extranjera:<br><br>
<div style='width:170px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'> <!-- 0000 -->
     
	 Dolar:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 0.10 <br>
	 0.25 <br>
	 0.50 <br>
	 1.00 <br>
	 10.00 <br>
	 20.00 <br>
	 50.00 <br>
	 100 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='dd1' value='$dd[1]' ><br>
	 <input type='text' style='width:100px;height:11px' name='dd2' value='$dd[2]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd3' value='$dd[3]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd4' value='$dd[4]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd5' value='$dd[5]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd6' value='$dd[6]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd7' value='$dd[7]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd8' value='$dd[8]'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->";
	 

if($tipo_opereta == "mantener"){	 
	
//busca los entrantes euro

for($q=1;$q<9;$q++){

$bil = $e[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb) as cantidad_cb from cantidad_billetes where idd_carga_cb= '$_POST[id_carga]' and moneda_cb='euro' and billete_cb ='$bil'  ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb"] > 0){
$ee[$q] = $lee_bil["cantidad_cb"];
} //if($lee_bil["cantidad_cb"] > 0){

} //for($q=1;$q<9;$q++){
 
// busca los entrantes
 
}//if($tipo_opereta == "mantener"){	 
	 
echo "<div style='width:170px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'> <!-- 0000 -->
     
	 Euros:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 2 <br>
	 5 <br>
	 10 <br>
	 20 <br>
	 50 <br>
	 100 <br>
	 200 <br>
	 500 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='ee1' value='$ee[1]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee2' value='$ee[2]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee3' value='$ee[3]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee4' value='$ee[4]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee5' value='$ee[5]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee6' value='$ee[6]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee7' value='$ee[7]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee8' value='$ee[8]'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->";
	
if($tipo_opereta == "mantener"){
	
//busca los entrantes real

for($q=1;$q<9;$q++){

$bil = $r[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb) as cantidad_cb from cantidad_billetes where idd_carga_cb= '$_POST[id_carga]' and moneda_cb='real' and billete_cb ='$bil'  ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb"] > 0){
$rr[$q] = $lee_bil["cantidad_cb"];
} //if($lee_bil["cantidad_cb"] > 0){

} //for($q=1;$q<9;$q++){
 
// busca los entrantes

}//if($tipo_opereta == "mantener"){	
	 
echo  "<div style='width:170px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'> <!-- 0000 -->
     
	 Reales:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 0.50 <br>
	 1 <br>
	 2 <br>
	 5 <br>
	 10 <br>
	 20 <br>
	 50 <br>
	 100 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='rr1' value='$rr[1]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr2' value='$rr[2]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr3' value='$rr[3]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr4' value='$rr[4]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr5' value='$rr[5]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr6' value='$rr[6]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr7' value='$rr[7]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr8' value='$rr[8]'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->";

if($tipo_opereta == "mantener"){

//busca los entrantes chilenos

for($q=1;$q<9;$q++){

$bil = $c[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb) as cantidad_cb from cantidad_billetes where idd_carga_cb= '$_POST[id_carga]' and moneda_cb='peso chileno' and billete_cb ='$bil'  ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb"] > 0){
$cc[$q] = $lee_bil["cantidad_cb"];
} //if($lee_bil["cantidad_cb"] > 0){

} //for($q=1;$q<9;$q++){
 
// busca los entrantes

}//if($tipo_opereta == "mantener"){
	 
	 
echo "<div style='width:170px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'> <!-- 0000 -->
     
	 Pesos chilenos:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 10 <br>
	 50 <br>
	 100 <br>
	 1000 <br>
	 2000 <br>
	 5000 <br>
	 10000 <br>
	 20000 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='cc1' value='$cc[1]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc2' value='$cc[2]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc3' value='$cc[3]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc4' value='$cc[4]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc5' value='$cc[5]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc6' value='$cc[6]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc7' value='$cc[7]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc8' value='$cc[8]'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 --> 
	 
	 
	 
	 
	 ";
	 
	 
 
 
 //fin pone cantidad de billetes	 
 //fin pone cantidad de billetes	
	
echo "</div>";//*******/*/*/*/*/*/*/*/------------------	
	 
echo "<div style='clear:both'></div><br>
     <input type='hidden' name='tipo_opereta' value='$tipo_opereta'>
     <input type='hidden' name='escribano' value='ok'>
     <input type='hidden' name='id_empresa' value='$_POST[id_empresa]'>
     <input type='hidden' name='id_carga' value='$_POST[id_carga]'>";

if($operacion == "resta"){

echo "<input type='submit' style='width:120px;height:40px;background-image:url(utilidades/imagenes/bot_cargar.png);border:0px;cursor:pointer' value=''>";

}else{//$operacion == "resta"
	 
echo "<input type='button' onclick='medio_pago()' style='width:120px;height:40px;background-image:url(utilidades/imagenes/bot_cargar.png);border:0px;cursor:pointer' value=''>";

}//$operacion == "resta"	 
	 
echo "</form><hr><hr><hr>";


}//if(isset($clave_vendedor)){


#######################FIN IMPRIME OPCION DE PAGO EFECTIVO O TARJETA SI ES QUE SE VENDE CON VENDEDOR
#######################FIN IMPRIME OPCION DE PAGO EFECTIVO O TARJETA SI ES QUE SE VENDE CON VENDEDOR





//busca mail de la empresa

$sql_em = mysql_query("select * from empresa where id_empresa='$_POST[id_empresa]'");
$l_em = mysql_fetch_assoc($sql_em);

$mail_empresa = $l_em["mail_empresa"];


//fin busca mail de la empresa


//busca el tipo de cambio

$sql_mo = mysql_query("select * from monedas where idd_empresa_monedas='$_POST[id_empresa]' and idd_monedas_base='2' and habilitar_monedas='on'");
$cta_mo = mysql_num_rows($sql_mo);

if($cta_mo > 0){
$l_mo = mysql_fetch_assoc($sql_mo);
$coti_dolar = $l_mo["valor_monedas"];
}else{ //if($cta_mo > 0){
$coti_dolar = 1;
} //if($cta_mo > 0){

$operacion_dolar = ceil($_POST["total_guita"] / $coti_dolar);
$operacion_pesos = $_POST["total_guita"];

//fin busca el tipo de cambio



//---> mercado pago


$sql_mp = mysql_query("select * from medio_pago_mercadopago where idd_empresa_mp_mp = '$_POST[id_empresa]' ");
$cta_mp = mysql_num_rows($sql_mp);

if($cta_mp > 0){

$lee_mp = mysql_fetch_assoc($sql_mp);

if($lee_mp["habilitar_mp_mp"]=="si"){

echo "<br><br><div style='width:250px;float:left;height:300px;background-color:#ffffff;margin-left:50px'>"; //---2

echo "<img src='utilidades/imagenes/mp.jpg'><br><br>";

if($lee_mp["porcentaje_mp_mp"] > 0){
$operacion_pesos0 = ($operacion_pesos * $lee_mp["porcentaje_mp_mp"]) / 100;
$operacion_pesos = $operacion_pesos + $operacion_pesos0;
} //if($lee_mp["porcentaje_mp_mp"] > 0){

echo "<div style='font-size:12px'>
      Pago para personas residentes en el Argentina: ar$ $operacion_pesos <br>

     </div><br>
";







//boton mp




echo "<form target='_top' action='https://www.mercadopago.com/mla/buybutton' method='post'>
<input type='image' src='https://www.mercadopago.com/org-img/MP3/buy_now_02.gif' border='0' alt='Comprar Ahora'>
 		<input type='hidden' name='acc_id' value='$lee_mp[dato1_mp_mp]'>
 		<input type='hidden' name='enc' value='$lee_mp[dato2_mp_mp]'>
 		<input type='hidden' name='url_succesfull' value='http://www.calafate.com/index.php'>
 		<input type='hidden' name='url_process' value='http://www.calafate.com/'>
 		<input type='hidden' name='url_cancel' value='http://www.calafate.com'>
 		<input type='hidden' name='item_id' value='codigo'>
 		<input type='hidden' name='name' value='excursion'>
 		<input type='hidden' name='currency' value='ARG'>
 		<input type='hidden' name='price' value='$operacion_pesos'>
 		<input type='hidden' name='shipping_cost' value=''>
 		<input type='hidden' name='ship_cost_mode' value=''>
 		<input type='hidden' name='op_retira' value=''>
 		<input type='hidden' name='extra_part' value='informacion-a-concatenar-en-urls-de-redireccion'>
 		<input type='hidden' name='seller_op_id' value='codigo'>
 		<input type='hidden' name='cart_name' value='nombre1'>
 		<input type='hidden' name='cart_surname' value='apellido1'>
 		<input type='hidden' name='cart_email' value='mail'>
 		<input type='hidden' name='es_distinto_dia' value='$es_distinto_dia'>
</form>

<br><br>
<div style='font-size:12px'>
$lee_mp[texto_mp_mp]
</div>
";

//boton mp




echo "</div>"; //---2

} //if($lee_mp["habilitar_mp_mp"]=="si"){

} //if($cta_mp > 0){

//--> fin mercado pago

//---> paypal


$sql_pay = mysql_query("select * from medio_pago_paypal where idd_empresa_mp_paypal = '$_POST[id_empresa]'");
$c_pay = mysql_num_rows($sql_pay);

if($c_pay > 0){

$l_pay = mysql_fetch_assoc($sql_pay);

if($l_pay["habilitar_mp_paypal"]=="si"){

echo "<div style='width:250px;float:left;background-color:#ffffff;margin-left:50px;height:300px'>"; //---1

echo "<img src='utilidades/imagenes/paypal.jpg'><br><br>";



//boton paypal

if($l_pay["porcentaje_mp_paypal"] > 0){
$operacion_dolar0 = ($operacion_dolar * $l_pay["porcentaje_mp_paypal"]) / 100;
$operacion_dolar = $operacion_dolar + $operacion_dolar0;
} //if($lee_mp["porcentaje_mp_paypal"] > 0){

echo "<div style='font-size:12px'>
      Pago para personas residentes en el exterior: <br>";

	  echo "<br>Tipo de cambio us$ 1= ar$".$coti_dolar."<br>";
echo "<br>Importe en us$ :".$operacion_dolar."<br>
     </div><br>
";
	  

      

echo "<form name='_xclick' action='https://www.paypal.com/ar/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_xclick'>
<input type='hidden' name='business' value='$l_pay[mail_paypal]'>
<input type='hidden' name='currency_code' value='USD'>
<input type='hidden' name='item_name' value='Calafate'>
<input type='hidden' name='amount' value='$operacion_dolar'>
<input type='image' src='http://www.paypal.com/es_XC/i/btn/x-click-but01.gif' border='0' name='submit' alt='Haga pagos con PayPal: es r�pido, sin costo y seguro'>
</form>

<br><br>

<div style='font-size:12px'>
$l_pay[texto_mp_paypal]
</div>
";

//boton paypal




echo "</div>"; //---1

} //if($l_pay["habilitar_mp_paypal"]=="si"){

} //if($c_pay > 0){

//--> fin paypal



//---> cash


$sql_cash = mysql_query("select * from medio_pago_cash where idd_empresa_mp_cash = '$_POST[id_empresa]'");
$c_cash = mysql_num_rows($sql_cash);

if($c_cash > 0){

$l_cash = mysql_fetch_assoc($sql_cash);

if($l_cash["habilitar_mp_cash"]=="si"){

echo "<div style='width:250px;float:left;background-color:#ffffff;margin-left:50px;height:300px'>"; //---3

echo "<img src='utilidades/imagenes/banco.jpg'><br><br>";

$operacion_pesos5 = $_POST["total_guita"];

if($l_cash["porcentaje_mp_cash"] > 0){

$operacion_pesos4 = ($_POST["total_guita"] * $lee_mp["porcentaje_mp_cash"]) / 100;
$operacion_pesos5 = $operacion_pesos5 + $operacion_pesos4;
} //if($lee_mp["porcentaje_mp_cash"] > 0){



echo "<div style='font-size:12px'>
      Pago para personas residentes en el Argentina: ar$ $operacion_pesos5 <br>

     </div><br>
";
	  

      

echo "<br><br>

<div style='font-size:12px'>
$l_cash[texto_mp_cash]
</div>
";






echo "</div>"; //---3

} //if($l_pay["habilitar_mp_cash"]=="si"){

} //if($c_pay > 0){

//--> fin cash




echo "<div style='clear:both'></div>";

// FIN PAGAR	  
/*
}else{  //if($dif_transacciones > 0){ //se fija si la empresa tiene transacciones para vender	  
	
echo "Lo sentimos, no puede hacerse la venta en estos momentos";

} // //if($dif_transacciones > 0){ //se fija si la empresa tiene transacciones para vender	  
*/	
?>
</div><!--   ttt -->

<div style="clear:both"></div>

<?php
//include_once("pie.inc.php");
?>





                                                         </div>




</body>
</html>

<script>
//manda_mail("<?php echo $_POST['id_carga']?>");
</script>