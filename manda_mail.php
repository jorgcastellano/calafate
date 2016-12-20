<?php
include_once("conexion.inc.php");

$sql = mysql_query("select * from ventas where idd_carga_vs='$_GET[id]'");
$c_sql = mysql_num_rows($sql);



$l_sql = mysql_fetch_assoc($sql);


//busca datos empresa

$sql_em = mysql_query("select * from empresa where id_empresa = '$l_sql[idd_empresa_vs]'");
$l_em = mysql_fetch_assoc($sql_em);

$nombre_empresa = $l_em["nombre_empresa"];
$direccion_empresa = $l_em["direccion_empresa"];
$tel1_empresa = $l_em["tel1_empresa"];
$tel2_empresa = $l_em["tel2_empresa"];
$mail_empresa = $l_em["mail_empresa"];
$logo_empresa = $l_em["logo_empresa"];

if($logo_empresa !=""){
$logo = "<img src='http://www.creativoscalafate.com.ar/plataforma/$logo_empresa' height='100'>";
}else{//if($logo_empresa !=""){
$logo = "";
}//if($logo_empresa !=""){

//fin busca datos empresa

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





for($c=1;$c<=$cta_p;$c++){
$lee_p = mysql_fetch_assoc($sql_p);
$nombre_comprador = $nombre_comprador.$lee_p["campo2_p"]." ";
} //for($c=1;$c<=$cta_p;$c++){
}else{ //if($cta_p > 0){

$nombre_comprador = "";

}//if($cta_p > 0){



//fin busca comprador

$codigo_carga = $l_sql["idd_carga_vs"];



	  
$sql_f = mysql_query("select * from articulo where idd_venta_ar='$l_sql[idd_carga_vs]' order by clave asc limit 0,1 ");	  
$lee_f = mysql_fetch_assoc($sql_f);


$sql_fq = mysql_query("select * from articulo where idd_venta_ar='$l_sql[idd_carga_vs]' order by clave desc limit 0,1 ");	  
$lee_fq = mysql_fetch_assoc($sql_fq);


$fecha_in = date("d/m/Y",$lee_f["idd_fecha"]);
$fecha_out = date("d/m/Y",$lee_fq["idd_fecha"]);
$fecha_compra = date("d/m/Y",$l_sql["idd_carga_vs"]);
$total_guita = $l_sql["total_guita_vs"];


//adicionales

$sql_ad = mysql_query("select * from ventas_adicionales where idd_carga_va = '$_GET[id]'");
$cta_ad = mysql_num_rows($sql_ad);

$texto_ad = "";

if($cta_ad > 0){



for($y=1;$y<$cta_ad;$y++){
$l_ad = mysql_fetch_assoc($sql_ad);

if($y==1){
$texto_ad = $texto_ad." <br><b>Servicios adicionales contratados: </b><br>";
}

$sql_ad1 = mysql_query("select * from adicionales where id_adicional='$l_ad[idd_ad_va]'");
$cta_ad1 = mysql_num_rows($sql_ad1);


for($bv=1;$bv<=$cta_ad1;$bv++){
$l_ad1 = mysql_fetch_assoc($sql_ad1);

$texto_ad = $texto_ad."$l_ad1[nombre_ad] <br>";

} //for($bv=1;$bv<=$cta_ad1;$bv++){


}//for($y=1;$y<$cta_ad;$y++){


}else{//if($cta_ad > 0){
$texo_ad = "Sin servicios adicionales";
}//if($cta_ad > 0){

//fin adicionales

//busca_cantidad

$sql_pas_tot = mysql_query("select num_pasaje_p from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p <> 'comprador' order by num_pasaje_p desc limit 0,1");
$c_sql_pas_tot = mysql_num_rows($sql_pas_tot);
$l_sql_pas_tot = mysql_fetch_assoc($sql_pas_tot);

if($c_sql_pas_tot > 0){
$cantida_pasajeros = $l_sql_pas_tot["num_pasaje_p"]; 
}//if($c_sql_pas_tot > 0){

//fin busca_cantidad


  

//datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
//datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//---comprador

$pasajeros_lista = "";

$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

$pasajeros_lista = $pasajeros_lista."<tr><td><b>Comprador:</b> <br><br></td></tr>";



for($y=1;$y<=$cta_pas;$y++){

$l_pas = mysql_fetch_assoc($sql_pas);

if($l_pas["campo1_p"]=="email"){
$mail_compradorr = $l_pas["campo2_p"];
}//if($l_pas["campo1_p"]=="email"){

$pasajeros_lista = $pasajeros_lista."<tr><td style='width:100px'>$l_pas[campo1_p] : </td>
	  <td style='width:300px'>$l_pas[campo2_p]</td>
	  </tr> 
      ";

} //for($y=1;$y<=$cta_pas;$y++){
     
$pasajeros_lista = $pasajeros_lista."<hr>";     


//---comprador

//-pasajeros  




$pasajeros_lista = $pasajeros_lista."<tr><td><br><br><br><b>Pasajeros:</b> <br><br></td></tr>";

for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){



$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p <> 'comprador' and num_pasaje_p ='$ec' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

if($cta_pas > 0){


for($y=1;$y<=$cta_pas;$y++){


$l_pas = mysql_fetch_assoc($sql_pas);

$num_pasa = $l_pas["num_pasaje_p"];

if($y==1){

$pasajeros_lista = $pasajeros_lista."<tr style='height:20px'></tr><tr><td style='width:100px'><b>Tipo : </b></td>
	  <td style='width:300px'><b> $l_pas[categoria_p] </b></td>
	  </tr>      
      ";


} //if($y==1){

$pasajeros_lista = $pasajeros_lista."<tr><td style='width:100px'>$l_pas[campo1_p] : </td>
	  <td style='width:300px'>$l_pas[campo2_p]</td>
	  </tr>

      
      ";

} //for($y=1;$y<=$cta_pas;$y++){
     

//$pasajeros_lista = $pasajeros_lista."<hr>";    


} //if($cta_pas > 0){

}//for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){
	  
	  
	  
	  
$pasajeros_lista = "<table style='width:500px'>".$pasajeros_lista."</table><hr>"; 



	  
	  


//-pasajeros  
  
//fin datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
//fin datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
  

  
  
####### //-----> BOTONES DE PAGO  
####### //-----> BOTONES DE PAGO  
####### //-----> BOTONES DE PAGO


//busca el tipo de cambio

$sql_mo = mysql_query("select * from monedas where idd_empresa_monedas='$l_sql[idd_empresa_vs]' and idd_monedas_base='2' and habilitar_monedas='on'");
$cta_mo = mysql_num_rows($sql_mo);

if($cta_mo > 0){
$l_mo = mysql_fetch_assoc($sql_mo);
$coti_dolar = $l_mo["valor_monedas"];
}else{ //if($cta_mo > 0){
$coti_dolar = 1;
} //if($cta_mo > 0){

$operacion_dolar = ceil($total_guita / $coti_dolar);
$operacion_pesos = $total_guita;

//fin busca el tipo de cambio


//---> mercado pago


$sql_mp = mysql_query("select * from medio_pago_mercadopago where idd_empresa_mp_mp = '$l_sql[idd_empresa_vs]' ");
$cta_mp = mysql_num_rows($sql_mp);

if($cta_mp > 0){

$lee_mp = mysql_fetch_assoc($sql_mp);

if($lee_mp["habilitar_mp_mp"]=="si"){

$texto_bt_mp =  "<br><br><div style='width:240px;float:left;height:300px;background-color:#ffffff;margin-left:5px'>"; //---2

$texto_bt_mp = $texto_bt_mp."<img src='http://www.creativoscalafate.com.ar/plataforma/utilidades/imagenes/mp.jpg'><br><br>";

if($lee_mp["porcentaje_mp_mp"] > 0){
$operacion_pesos0 = ($operacion_pesos * $lee_mp["porcentaje_mp_mp"]) / 100;
$operacion_pesos = $operacion_pesos + $operacion_pesos0;
} //if($lee_mp["porcentaje_mp_mp"] > 0){

$texto_bt_mp = $texto_bt_mp."<div style='font-size:12px'>
      Pago para personas residentes en el Argentina: ar$ $operacion_pesos <br>

     </div><br>
";







//boton mp




$texto_bt_mp = $texto_bt_mp."<form target='_top' action='https://www.mercadopago.com/mla/buybutton' method='post'>
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
</form>

<br><br>
<div style='font-size:12px'>
$lee_mp[texto_mp_mp]
</div>
</div>
";

//boton mp






}else{ //if($lee_mp["habilitar_mp_mp"]=="si"){



} //if($lee_mp["habilitar_mp_mp"]=="si"){

} //if($cta_mp > 0){

//--> fin mercado pago







//---> paypal


$sql_pay = mysql_query("select * from medio_pago_paypal where idd_empresa_mp_paypal = '$l_sql[idd_empresa_vs]'");
$c_pay = mysql_num_rows($sql_pay);

if($c_pay > 0){

$l_pay = mysql_fetch_assoc($sql_pay);

if($l_pay["habilitar_mp_paypal"]=="si"){

$texto_bt_pay = "<div style='width:250px;float:left;background-color:#ffffff;margin-left:50px;height:300px'><img src='http://www.creativoscalafate.com.ar/plataforma/utilidades/imagenes/paypal.jpg'><br><br>"; //---1





//boton paypal

if($l_pay["porcentaje_mp_paypal"] > 0){
$operacion_dolar0 = ($operacion_dolar * $l_pay["porcentaje_mp_paypal"]) / 100;
$operacion_dolar = $operacion_dolar + $operacion_dolar0;
} //if($lee_mp["porcentaje_mp_paypal"] > 0){

$texto_bt_pay = $texto_bt_pay."<div style='font-size:12px'>
      Pago para personas residentes en el exterior: <br>

	  <br>Tipo de cambio us$ 1= ar$ $coti_dolar <br>
      <br>Importe en us$ : $operacion_dolar <br>
     </div><br>
<form name='_xclick' action='https://www.paypal.com/ar/cgi-bin/webscr' method='post'>
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
</div>";

//boton paypal






}else{ //if($l_pay["habilitar_mp_paypal"]=="si"){

$texto_bt_pay = "";

} ////if($l_pay["habilitar_mp_paypal"]=="si"){

} //if($c_pay > 0){

//--> fin paypal


  
####### //-----> BOTONES DE PAGO  
####### //-----> BOTONES DE PAGO  
####### //-----> BOTONES DE PAGO  
  




$texto_mail = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
  <head lang="es">
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
    <title>RESERVA</title>
  </head>
  <body style='margin-top: 0;margin-bottom: 0;margin-left: 0;margin-right: 0;font-family: arial;background-color:#ffffff'>

                                                                    <div style='margin: 0 auto;width: 490px;background-color:#fff;padding:5px'>

	
																		
<div style='font-size:10px'>Si no visualiz�s correctamente este email hace  <a href='http://www.creativoscalafate.com.ar/plataforma/manda_mail1.php?id=$_GET[id]' style='font-size:10px' >click aqu�</a></div>																	
<div style='width:500px'><!-- fondo 1 -->

<div style='float:left;height:100px'>$logo</div>
<div style='float:left;height:100px;font-size:12px;margin-left:10px'><b>$nombre_empresa </b><br> $direccion_empresa | Tel: $tel1_empresa &nbsp; &nbsp; $tel2_empresa | Mail: $mail_empresa</div>
<div style='clear:both;height:10px'></div>

<div style='font-size:12px'>
Usted acaba de hacer la reserva de : <b> $nombre_sub2 </b> <br>
Fecha ingreso: $fecha_in <br>
Fecha egreso: $fecha_out <br>
Cantidad de pasajeros: $cantida_pasajeros <br>
Total en ar $ : $total_guita <br>
$texto_ad <br>
$pasajeros_lista

</div>

$texto_bt_mp

$texto_bt_pay

<div style='clear:both'></div>
</div><!-- fondo 1 -->

                                                                              </div>


</body>
</html>";

//echo $texto_mail;

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Cabeceras adicionales
//$cabeceras .= 'From: webmaster@creativoscalafate.com.ar' . "\r\n";
$cabeceras .= 'From: '.$mail_empresa.' \r\n'; 
 


mail("$mail_compradorr", "Reserva en Calafate", $texto_mail, $cabeceras);
mail("$mail_empresa", "Reserva en Calafate", $texto_mail, $cabeceras);

?>