<?php
include_once("encabezado.inc.php");

if(isset($_POST["escribano_venta"])=="ok"){

$sql_tran = mysql_query("select * from transacciones where idd_empresa_tran ='$_POST[id_empresa]'");
$cta_tran = mysql_num_rows($sql_tran);

if($cta_tran > 0){
$l_tran = mysql_fetch_assoc($sql_tran);
$cant_tran = $l_tran["cantidad_tran"];
}else{ //if($cta_tran > 0){
$cant_tran = 0;
} //if($cta_tran > 0){

$sql_tran1 = mysql_query("select * from transacciones1 where idd_empresa_tran1='$_POST[id_empresa]'");
$cta_tran1 = mysql_num_rows($sql_tran1);

$dif_transacciones = $cant_tran - $cta_tran1;



if($dif_transacciones > 0){ //se fija si la empresa tiene transacciones para vender

$check_venta = mysql_query("select * from ventas where  idd_carga_vs= '$_POST[id_carga]'"); //chequea que no sea duplacada la venta
$c_check_venta = mysql_num_rows($check_venta);

if($c_check_venta == 0){ 


$suma_pasajeros = $_POST["adulto"] + $_POST["bebe"] + $_POST["nino"] + $_POST["nino1"] + $_POST["nino2"] + $_POST["senior"];

$sql_venta = mysql_query("select * from articulo where clave_sub2_ar='$_GET[id]' and estado='libre' and idd_fecha='$_POST[fecha_excursion]'");
$cta_venta = mysql_num_rows($sql_venta);

if($cta_venta >= $suma_pasajeros){

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




for($k=1;$k<=$suma_pasajeros;$k++){
$lee_venta = mysql_fetch_assoc($sql_venta);

if($cta_t > 0){
$num_tick =  $num_tick + 1;
$imprime_tick = ",numero_tick_ar='$num_tick'";
}else{//if($cta_t > 0){
$imprime_tick = "";
}//if($cta_t > 0){

mysql_query("UPDATE articulo SET estado='reservado',idd_venta_ar='$_POST[id_carga]' $imprime_tick where clave_sub2_ar='$_GET[id]' and estado='libre' and clave='$lee_venta[clave]'");

}//for($k=1;$k<=$){

} //if($cta_venta >= $suma_pasajeros){


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

mysql_query("INSERT INTO ventas (idd_carga_vs,idd_sub2_vs,adulto_vs,bebe_vs,nino_vs,nino1_vs,nino2_vs,senior_vs,total_guita_vs,idd_empresa_vs,estado_vs,vendedor_vs,comision_vs,fecha_excur_vs) VALUES ('$_POST[id_carga]','$_GET[id]','$_POST[adulto]','$_POST[bebe]','$_POST[nino]','$_POST[nino1]','$_POST[nino2]','$_POST[senior]','$_POST[total_guita]','$_POST[id_empresa]','reservado','$clave_vendedor','$comision','$_POST[fecha_excursion]')");

//fin carga la venta en tabla venta


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

for($z=1;$z<=$_POST["adulto"];$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_adulto_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_adulto_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','adulto','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){


} //for($z=1;$z<=$_POST["adulto"];$z++){ //uuu

//fin adulto


//bebe

for($z=1;$z<=$_POST["bebe"];$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_bebe_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_bebe_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','bebe','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){


} //for($z=1;$z<=$_POST["bebe"];$z++){ //uuu

//fin bebe

//nino

for($z=1;$z<=$_POST["nino"];$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_nino_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_nino_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','nino','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){


} //for($z=1;$z<=$_POST["nino"];$z++){ //uuu

//fin nino


//nino1

for($z=1;$z<=$_POST["nino1"];$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_nino1_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_nino1_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','nino1','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){


} //for($z=1;$z<=$_POST["nino1"];$z++){ //uuu

//fin nino1

//nino2

for($z=1;$z<=$_POST["nino2"];$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_nino2_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_nino2_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','nino2','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){


} //for($z=1;$z<=$_POST["nino2"];$z++){ //uuu

//fin nino2

//senior

for($z=1;$z<=$_POST["senior"];$z++){ //uuu

$num_pasajero = $num_pasajero + 1;

for($tt=1;$tt<=$cant_vueltasy;$tt++){



if(isset($_POST["inv_senior_".$z."_".$tt])){

$campo1 = $codigo_ir[$tt];
$campo2 = $_POST["inv_senior_".$z."_".$tt];

mysql_query("INSERT INTO pasajeros (idd_carga_p,campo1_p,campo2_p,tipo_p,categoria_p,num_pasaje_p) VALUES ('$_POST[id_carga]','$campo1','$campo2','pasajero','senior','$num_pasajero')");

}//if(isset($_POST["a".$tt])){


}//for($tt=1;$tt<=$cant_vueltasy;$tt++){


} //for($z=1;$z<=$_POST["senior"];$z++){ //uuu

//fin senior


//->fin pasajeros

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


} //if($c_check_venta == 0){ 

} // //if($dif_transacciones > 0){ //se fija si la empresa tiene transacciones para vender

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


<script>

function medio_pago(){

if(document.medio.num_cupon.value.length>0 || document.medio.num_operacion.value.length>0 || document.medio.importe_tarjeta.value.length>0){

if(document.medio.num_cupon.value.length== 0 || document.medio.num_operacion.value.length == 0 || document.medio.importe_tarjeta.value.length== 0){

alert("Si va poner tarjeta debe completar todos los datos");

}//if(document.medio.num_cupon.value.length== 0 || document.medio.num_operacion.value.length == 0 || document.medio.importe_tarjeta.value.length== 0){




}//if(document.medio.num_cupon.value.length>0 || document.medio.num_operacion.value.length>0 || document.medio.importe_tarjeta.value.length>0){


if(document.medio.moneda.value.length > 0 || document.medio.importe_efectivo.value.length >0){

if(document.medio.moneda.value.length==0 || document.medio.importe_efectivo.value.length==0){
alert("Si va poner efectivo debe completar todos los datos");
}//if(document.medio.moneda.value.length==0 || document.medio.importe_efectivo.value.length==0){

}//if(document.medio.num_cupon.value.length==0){

document.medio.submit();

} //function medio_pago(){

</script>

</head>

<body >




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



if(isset($_POST["escribano"])){

$total_guita = $_POST["total_guita"];



if ($_POST["importe_efectivo"] !=""){

$busca_mon = mysql_query("select * from monedas where idd_empresa_monedas='$_POST[id_empresa]' and idd_monedas_base= '$_POST[moneda]'");

$l_bm = mysql_fetch_assoc($busca_mon); 

$busca_nom_mon = mysql_query("select * from monedas_base where id_monedas_base='$_POST[moneda]' ");

$l_nom_mon = mysql_fetch_assoc($busca_nom_mon);



$nombre_moneda = $l_nom_mon["nombre_monedas_base"];
$efect = $l_bm["valor_monedas"] * $_POST["importe_efectivo"]; 
$valor_plata = $l_bm["valor_monedas"];

}else{//if ($_POST["importe_efectivo"] !=""){

$nombre_moneda = "";
$efect = 0; 
$valor_plata = 0;


}//if ($_POST["importe_efectivo"] !=""){

$total_guita1 = $_POST["importe_tarjeta"] + $efect;


if($total_guita1 >= $total_guita){

$busca_vp = mysql_query("select * from ventas_pago where idd_venta_vp = '$_POST[id_carga]'");
$cta_vp = mysql_fetch_assoc($busca_vp);

if($cta_vp ==0){

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_tarjeta_vp,importe_efectivo_vp) VALUES ('$_POST[id_carga]','$nombre_moneda','$valor_plata','$_POST[num_cupon]','$_POST[num_operacion]','$_POST[importe_tarjeta]','$efect')");

echo "hola<br>";
 
}//if($cta_vp ==0){
 
}else{//if($total_guita1 >= $total_guita){

echo "Los valores no coiciden. Vuelva a colocarlos por favor:<br>";


echo "<form method='post' action='carga_pago.php' name='medio'>

     <div style='width:280px;padding:10px;height:220px;float:left;background-color:#cccccc'>
     Tarjeta : <br><br>
	 Numero cup�n:<br>
	 <input type='text' name='num_cupon'><br><br>
	 
	 Numero operaci�n:<br>
	 <input type='text' name='num_operacion'><br><br>
	 
	 Importe:<br>
	 <input type='text' name='importe_tarjeta'><br><br>
	 
	 </div>
	 
     <div style='width:280px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'>
     Efectivo : <br><br>
	 Moneda<br>";

$sql_mon = mysql_query("select monedas_base.*, monedas.* from monedas_base left outer join monedas on monedas_base.id_monedas_base = monedas.id_monedas where monedas.habilitar_monedas = 'on' and monedas.idd_empresa_monedas='$_POST[id_empresa]'	");


$cta_mon = mysql_num_rows($sql_mon);

echo "<select name='moneda'>";

echo "<option selected></option>"; 

for($o=1;$o<=$cta_mon;$o++){

$l_mon = mysql_fetch_assoc($sql_mon);

echo "<option value='$l_mon[idd_monedas_base]'>$l_mon[nombre_monedas_base] - Valor: $l_mon[valor_monedas]</option>"; 
 
}//for($o=1;$o<=$cta_mon;$o++){ 
	 
echo "</select><br><br>";
	 
echo "Importe:<br>
	 <input type='text' name='importe_efectivo'><br><br>
	 
	 </div>	 

	 
	 <div style='clear:both'></div><br>
     <input type='hidden' name='escribano' value='ok'>
     <input type='hidden' name='id_empresa' value='$_POST[id_empresa]'>
     <input type='hidden' name='total_guita' value='$_POST[total_guita]'>
     <input type='hidden' name='id_carga' value='$_POST[id_carga]'>
	 <input type='button' onclick='medio_pago()' style='width:120px;height:40px;background-image:url(utilidades/imagenes/bot_cargar.png);border:0px' value=''>
	 </form><hr><hr><hr>";



}//if($total_guita1 >= $total_guita){


}//if(isset($_POST["escribano"])){

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
manda_mail("<?php echo $_POST['id_carga']?>");
</script>