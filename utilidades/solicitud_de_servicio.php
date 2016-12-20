<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


$enviado = "no";


if(isset($_POST["escribano_fotonoticia"])=="ok"){

$nombre_carpeta = "fotos";


$arra_foto["1"] = "nfoto1";

//array que da nombre al campo donde se graban las fotos
$arra_foto1["1"] = "foto1";





for($x=1;$x<2;$x++){
$temporal = $_FILES["$arra_foto[$x]"]["tmp_name"];
$foto = $_FILES["$arra_foto[$x]"]["name"];
$partes = explode(".",$foto);
$cuenta = count($partes)-1;
$extension = $partes[1];
$texto0 = $partes[0];
$texto = strtolower($texto0);
$nombre_foto = str_replace(" ","-",$texto);
$nombre_foto = str_replace("�","n",$nombre_foto);

$nombre_foto = $nombre_foto.time();

									   
									   
							
move_uploaded_file($temporal,"fotos_solicitud/".$nombre_foto.".".$extension); 


  
   }//cierra el for



$link_ad = "http://".$_SERVER["SERVER_NAME"]."/plataforma/utilidades/fotos_solicitud/".$nombre_foto.".".$extension ;



mysql_query("INSERT INTO solicitud_adjunto (link_sa,idd_carga_sa) VALUES ('$link_ad','$_GET[id]')");


}//if($_POST["escribano_fotonoticia"]=="ok"){




if(isset($_POST["escribano"])){



//busca datos empresa

$sql_em = mysql_query("select * from empresa where id_empresa = '$_POST[id_empresa]'");
$l_em = mysql_fetch_assoc($sql_em);

$nombre_empresa = $l_em["nombre_empresa"];
$mail_empresa = $l_em["mail_empresa"];

//fin busca datos empresa


//busca mail del logeado
//busca mail del logeado

$sql_lo = mysql_query("select mail_usuario from usuario where id_usuario= '$_SESSION[id_usuario]' ");
$lee_lo = mysql_fetch_assoc($sql_lo);

$mail_usuario = $lee_lo["mail_usuario"];

//fin busca mail del logeado
//fin busca mail del logeado



//echo "<hr><hr><hr><hr> $_POST[texto_mail] <br><br><br><br><br><br><br><br><br>";


for($d=1;$d<=5;$d++){

if($_POST["mail".$d]!=""){ //---------uuuuuuuuuuuu

//adjuntos
//adjuntos

$adjuntos = "Adjuntos: <br>";



if($_POST["cantidad_adjuntos"]> 0){


for($s=1;$s<=$_POST["cantidad_adjuntos"];$s++){

if($_POST["adjunto_".$s]){

$llink = $_POST["aadjunto_".$s];
$adjuntos = $adjuntos."<a href='$llink'><img src='$llink' width='200'></a><br>";

}//if($_POST["adjunto".$s]){

}//for($s=1;$s<=$_POST["cantidad_adjuntos"];$s++){

$adjuntos = $adjuntos."<br>";

}else{//if($_POST["cantidad_adjuntos"]> 0){

$adjuntos = "Adjuntos: No hay <br><br>";

}//if($_POST["cantidad_adjuntos"]> 0){

//fin adjuntos
//fin adjuntos


// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Cabeceras adicionales
$cabeceras .= 'From: '.$mail_usuario;
 
$texto_mail = "Por favor confirmar la siguiente solicitud para: <br> ".$_POST["texto_mail1"]."<br>".$_POST["texto"]."<br><br> $adjuntos <br><br>Operador: ".$_POST["operador"]; 

$mail = $_POST["mail".$d];
$fecha = time();

mail($mail, "Solicitud de servicio nro $_GET[id] para $nombre_empresa", $texto_mail, $cabeceras);
//mail("webmaster@creativoscalafate.com.ar", "Solicitud de servicio nro $_GET[id] para $nombre_empresa", $texto_mail, $cabeceras);

mysql_query("INSERT INTO solicitud_de_servicio (idd_venta_ss,mail_ss,texto_ss,fecha_ss) VALUES ('$_GET[id]','$mail','$_POST[texto]','$fecha')");



$enviado = "si";

//copia de seguridad de la ss

mail($mail, "Back Solicitud de servicio nro $_GET[id] para $nombre_empresa", "Una solicitud de servicio fue enviada: puede visualizarla aqui: \r\n \r\n http://www.creativoscalafate.com.ar/plataforma/utilidades/ver_solicitud.php?id=$_POST[id_ver]", "from: ".$mail_usuario);


////copia de seguridad de la ss


}//if($_POST[""]){  ---------uuuuuuuuuuuu


}//for($d=1;$d<=3;$d++){


mysql_query("INSERT INTO solicitud_de_servicio_1 (texto_sst,codigo_sst) VALUES ('$texto_mail','$_POST[id_ver]')");

 
 
 
 
  

if($mail_usuario == "ruben@criollosturismo.com.ar" || $mail_usuario == "ventas1@criollosturismo.com.ar" || $mail_usuario == "ventas2@criollosturismo.com.ar" || $mail_usuario == "ventas3@criollosturismo.com.ar" || $mail_usuario == "ventas4@criollosturismo.com.ar"){

mail("operaciones1@criollosturismo.com.ar", "Back Solicitud de servicio nro $_GET[id] para $nombre_empresa", "Una solicitud de servicio fue enviada: puede visualizarla aqui: \r\n \r\n http://www.creativoscalafate.com.ar/plataforma/utilidades/ver_solicitud.php?id=$_POST[id_ver]", "from: ".$mail_usuario);


}//if($mail_usuario == "ruben@criollosturismo.com.ar" || $mail_usuario == "ventas1@criollosturismo.com.ar" || $mail_usuario == "ventas2@criollosturismo.com.ar" || $mail_usuario == "ventas3@criollosturismo.com.ar" || $mail_usuario == "ventas4@criollosturismo.com.ar"){




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

if($enviado == "si"){

echo "La solicitud fue enviada con el siguiente texto:
<br><br>
$texto_mail


<br><hr><br>

";


}//if($enviado == "si"){

$texto_mail = "";

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

echo "<hr>
<form action='solicitud_de_servicio.php?id=$_GET[id]&id_fecha=$_GET[id_fecha]' method='post' enctype='multipart/form-data' id='myform'>
<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>
Cargar adjuntos (pueden cargarse varios pero de a uno por vez): <br><br> <input type='file' name='nfoto1' > <br>


<input type='hidden' name='escribano_fotonoticia' value='ok'>
<input type='submit' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value=''>

</form><br><hr>";

$id_ver = time();

echo "<form method='post' action='$_SERVER[PHP_SELF]?id_fecha=$_GET[id_fecha]&id=$_GET[id]' >
   <br>
   Mail 1 : <input type='text' name='mail1'><br>
   Mail 2 : <input type='text' name='mail2'><br>
   Mail 3 : <input type='text' name='mail3'><br>
   Mail 4 : <input type='text' name='mail4'><br>
   Mail 5 : <input type='text' name='mail5'><br><br>
   
  ";
    





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




$tot_pasajeros = $l_sql["adulto_vs"] + $l_sql["bebe_vs"] + $l_sql["nino_vs"] + $l_sql["nino1_vs"] + $l_sql["nino2_vs"] + $l_sql["senior_vs"];

$det_pasajeros1 = "Adultos: $l_sql[adulto_vs] | Bebes: $l_sql[bebe_vs] | Menor cat 1: $l_sql[nino_vs] | Menor cat 2: $l_sql[nino1_vs] | Menor cat 3: $l_sql[nino2_vs] | Senior: $l_sql[senior_vs]";


//Busca edad pasajeros 
//Busca edad pasajeros 

$busca_edpas = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$l_sql[idd_carga_vs]' and tipo_pasajero_ep = 'Adulto' ");
$cta_edpas = mysql_num_rows($busca_edpas);

$ed_pas = "";

if($cta_edpas > 0){
$ed_pas = $ed_pas."$cta_edpas ADL | ";
}//if($cta_edpas > 0){

/*
for($r=1;$r<=$cta_edpas;$r++){
$l_ed_pas = mysql_fetch_assoc($busca_edpas);


} //for($r=1;$<=$cta_edpas;$r++){
*/



$busca_edpas = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$l_sql[idd_carga_vs]' and tipo_pasajero_ep = 'Bebe' ");
$cta_edpas = mysql_num_rows($busca_edpas);

$ed_pas = $ed_pas."$cta_edpas Infoa | ";
/*
for($r=1;$r<=$cta_edpas;$r++){
$l_ed_pas = mysql_fetch_assoc($busca_edpas);


} //for($r=1;$<=$cta_edpas;$r++){
*/


$busca_edpas = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$l_sql[idd_carga_vs]' and (tipo_pasajero_ep = 'Menor cat. 1' or tipo_pasajero_ep = 'Menor cat. 2' or tipo_pasajero_ep = 'Menor cat. 3') order by edad_ep asc");
$cta_edpas = mysql_num_rows($busca_edpas);



for($r=1;$r<=$cta_edpas;$r++){
$l_ed_pas = mysql_fetch_assoc($busca_edpas);

$edad_c = $l_ed_pas["edad_ep"];

if($edad_c != $edad_c1){

$busca_ed = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$l_sql[idd_carga_vs]' and edad_ep = '$edad_c'");
$cta_ed = mysql_num_rows($busca_ed);



$ed_pas = $ed_pas."$cta_ed Menor de  $edad_c | ";


$edad_c1= $l_ed_pas["edad_ep"];

} //if($edad_c != $edad_c1){


} //for($r=1;$<=$cta_edpas;$r++){




$busca_edpas = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$l_sql[idd_carga_vs]' and tipo_pasajero_ep = 'Senior' order by edad_ep asc");
$cta_edpas = mysql_num_rows($busca_edpas);



for($r=1;$r<=$cta_edpas;$r++){
$l_ed_pas = mysql_fetch_assoc($busca_edpas);

$edad_c = $l_ed_pas["edad_ep"];

if($edad_c != $edad_c1){

$busca_ed = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$l_sql[idd_carga_vs]' and edad_ep = '$edad_c'");
$cta_ed = mysql_num_rows($busca_ed);



$ed_pas = $ed_pas."$cta_ed Senior de  $edad_c | ";


$edad_c= $l_ed_pas["edad_ep"];

} //if($edad_c != $edad_c1){


} //for($r=1;$<=$cta_edpas;$r++){



//Busca edad pasajeros 
//Busca edad pasajeros 



$det_pasajeros = "$ed_pas";



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

$texto_mail = $texto_mail."Servicio: <b> $nombre_sub2 </b><br><br>Fecha de la realizacion: <b>".date("d/m/Y",$lee_f["idd_fecha"])." </b><br><br>";

//busca hotel

$sql_vi = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$l_sql[idd_carga_vs]' and idd_ibc_iv='2' ");
$c_vi = mysql_num_rows($sql_vi);


if($c_vi > 0){
$l_vi = mysql_fetch_assoc($sql_vi);
$ddato = $l_vi["valor_iv"];
}else{ //if($c_vi > 0){
$ddato = "";
}//if($c_vi > 0){
	 
//busca hotel


//busca pickup

$sql_vir = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$l_sql[idd_carga_vs]' and idd_ibc_iv='16' ");
$c_vir = mysql_num_rows($sql_vir);


if($c_vir > 0){
$l_vir = mysql_fetch_assoc($sql_vir);
$dddato = $l_vir["valor_iv"];
}else{ //if($c_vi > 0){
$dddato = "";
}//if($c_vi > 0){
	 
//busca pickup


$texto_mail = $texto_mail."<b>Pick-up: </b> <b> $dddato </b>  <br><br>";	 	
	  
$texto_mail = $texto_mail."<b>Hotel: </b> <b> $ddato </b>  <br><br>";	 	  
	  

$texto_mail = $texto_mail."<b>Cantidad de PAX:</b> <b> $tot_pasajeros </b>| $det_pasajeros  <br>";	  
	  	  
	  
	  if($tiene_adic == "si" || $tiene_adic == "SI"){	
	  


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



$texto_mail = $texto_mail."<br><b>PAX:</b> <br><br>";




$texto_mail = $texto_mail."<b>$l_pas_ape[campo2_p] $l_pas_nom[campo2_p]</b><br><br>";	



for($ec=1;$ec<=$tot_pasajeros;$ec++){



$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p <> 'comprador' and num_pasaje_p ='$ec' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

if($cta_pas > 0){


for($y=1;$y<=$cta_pas;$y++){


$l_pas = mysql_fetch_assoc($sql_pas);

$num_pasa = $l_pas["num_pasaje_p"];


  
	  
$texto_mail = $texto_mail."$l_pas[campo1_p] : $l_pas[campo2_p]<br>";	  

} //for($y=1;$y<=$cta_pas;$y++){
     




  

}//for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){
	  
	  
	  
	  




	  
	  
} //if($cta_pas > 0){

//-pasajeros  


//fin info pasajeros -----:::::;
//fin info pasajeros -----:::::;
 

	 

//if($_SESSION["tipo"]=="administrador" || $_SESSION["tipo"]=="operativo"){	 
	 
//INFO ADICIONAL	 







$sql_it = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.publica_iva = 'si'
AND items_venta_articulo.idd_sub2_iva = '$l_sql[idd_sub2_vs]' AND items_base_cliente.idd_empresa_ibs='$_SESSION[logeo]' order by items_venta_articulo.orden_iva asc");

$cta_it = mysql_num_rows($sql_it);



for($w=1;$w<=$cta_it;$w++){

$lee_it = mysql_fetch_assoc($sql_it);
if($lee_it["nombre_ibc"]== "observaciones"){




$texto_mail = $texto_mail."<br><b>$lee_it[nombre_ibc]</b> : ";


$sql_inf = mysql_query("select * from items_valor where idd_ibc_iv= '$lee_it[idd_ibc_iva]' and idd_venta_iv='$l_sql[idd_carga_vs]' ");
$lee_inf = mysql_fetch_assoc($sql_inf);



if($lee_inf["valor_iv"]=="no"){


$texto_mail = $texto_mail."<b> $lee_inf[valor_iv] </b> <br>";

}else{ //if($lee_inf["valor_iv"]=="no"){


$texto_mail = $texto_mail."$lee_inf[valor_iv] <br> ";

} //if($lee_inf["valor_iv"]=="no"){






} //if($lee_it["nombre_ibc"]== "observaciones"){

}//for($w=1;$w<=$cta_it;$w++){

 

	  
  
	  
	  
// FIN INFO ADICIONAL




echo " Texto solicitud: <textarea name='texto_mail1'>$texto_mail </textarea><br><br>";


echo " Texto adicional: <textarea name='texto'> </textarea><br><br>";


echo "Archivos adjuntos:<br><br>";


$sql_sa = mysql_query("select * from solicitud_adjunto where idd_carga_sa = '$_GET[id]'");
$cta_sa = mysql_num_rows($sql_sa);

for($u=1;$u<=$cta_sa;$u++){
$lee_sa = mysql_fetch_assoc($sql_sa);

echo "<img src='$lee_sa[link_sa]' width=250> Adjuntar: <input type='checkbox' name='adjunto_$u' checked> <input type='hidden' name='aadjunto_$u' value='$lee_sa[link_sa]'><br>";


}//for($u=1;$u<=$cta_sa;$u++){


echo "<br><br>Firma del operador: <input type='text' name='operador'><br><br>";






echo "<input type='hidden' name='escribano' value='ok'>
    <input type='hidden' name='cantidad_adjuntos' value='$cta_sa'>
    <input type='hidden' name='id_ver' value='$id_ver'>
    <input type='hidden' name='id_empresa' value='$l_sql[idd_empresa_vs]'>
    <input type='submit' value='' style='width:180px;height:40px;background-image:url(imagenes/bot_enviar.png);border:0px;cursor:pointer'>    
	</form>";


//}//if($_SESSION["tipo"]=="administrador" || $_SESSION["tipo"]=="operativo"){

} //for($l=1;$l<=$c_sql;$l++){





?>



</div>  

<?php
echo "<div style='width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px'><a href='ventas.php?id_fecha=$_GET[id_fecha]'><img src='imagenes/bot_volver.png' title='Volver al panel'></a></div>";
?>  
       </div> <!-- EEEEE -->


</body>
</html>
