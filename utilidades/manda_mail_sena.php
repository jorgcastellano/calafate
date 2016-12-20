<?php
$sql = mysql_query("select * from ventas where idd_carga_vs='$_POST[idd_carga]'");
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
Su reserva de : <b> $nombre_sub2 </b> fue SE�ADA. En breve nos cont�cteremos para explicar los siguientes pasos  <br>
Fecha ingreso: $fecha_in <br>
Fecha egreso: $fecha_out <br>
Cantidad de pasajeros: $cantida_pasajeros <br>
Total en ar $ : $total_guita <br>
$texto_ad <br>
$pasajeros_lista

</div>

</div><!-- fondo 1 -->

                                                                              </div>


</body>
</html>";

//echo $texto_mail;

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Cabeceras adicionales
$cabeceras .= 'From: webmaster@creativoscalafate.com.ar' . "\r\n";
 
 


mail("$mail_compradorr", "Reserva se�ada en Calafate", $texto_mail, $cabeceras);
mail("$mail_empresa", "Reserva aprobada y confirmada en Calafate", $texto_mail, $cabeceras);

?>