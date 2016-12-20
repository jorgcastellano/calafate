<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if(isset($_POST["escribano_importe"])=="ok"){

mysql_query("UPDATE ventas SET total_guita_vs = '$_POST[iimporte]', sena_vs='$_POST[ssena]' where idd_carga_vs='$_POST[idd_carga]' ");

}//if(isset($_POST["escribano_importe"])=="ok"){



if(isset($_POST["escribano_pasajero"])=="ok"){

if($_POST["tipo"]=="comprador"){


$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$_POST[idd_carga]' and tipo_p = 'comprador' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

for($y=1;$y<=$cta_pas;$y++){

$l_pas = mysql_fetch_assoc($sql_pas);
$campo = $l_pas["campo1_p"];

mysql_query("UPDATE pasajeros SET campo2_p='$_POST[$campo]' where id_pasajero_p='$l_pas[id_pasajero_p]'");


}//for($y=1;$y<=$cta_pas;$y++){

}else{ //if($_POST["tipo"]=="comprador"){



$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$_POST[idd_carga]' and tipo_p <> 'comprador' and num_pasaje_p ='$_POST[num_pasaje]' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

for($y=1;$y<=$cta_pas;$y++){

$l_pas = mysql_fetch_assoc($sql_pas);
//$campo = $l_pas["campo1_p"]."_$_POST[num_pasaje]";
$campo = $l_pas["id_pasajero_p"];

$campo1 = $_POST["p_".$campo];

mysql_query("UPDATE pasajeros SET campo2_p='$campo1' where id_pasajero_p='$l_pas[id_pasajero_p]'");

}//for($y=1;$y<=$cta_pas;$y++){



} //if($_POST["tipo"]=="comprador"){

} //if(isset($_POST["escribano_pasajero"])=="ok"){


if(isset($_POST["escribano_codigo"])){

mysql_query("UPDATE ventas SET codigo_vs='$_POST[codigo]' where id_ventas='$_GET[id]'");


}//if(isset($_POST["escribano_codigo"])){


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>VENTA DETALLE</title>
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

         <div class="global" > <!-- EEEEE -->

<?php

if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado_vendedor.inc.php");

}else{ //if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado.inc.php");

} //if($_SESSION["tipo"]=="vendedor"){

?>

<div style="padding:10px">


<?php

$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and id_ventas='$_GET[id]'");
$c_sql = mysql_num_rows($sql);


echo "<div style='border:1px solid #cccccc;widht:800px;height:30px;line-height:30px;font-size:10px;margin-bottom:2px'>

      <div style='width:130px;float:left'><b>Nombre articulo</b></div>
      <div style='width:100px;float:left'><b>Importe</b></div>
      <div style='width:250px;float:left'><b>Estado</b></div>
      <div style='width:300px;float:left'><b>Comprador</b> </div>
	    <div style='clear:both'></div>
      </div>
	
	  ";


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





for($c=1;$c<=$cta_p;$c++){
$lee_p = mysql_fetch_assoc($sql_p);
$nombre_comprador = $nombre_comprador.$lee_p["campo2_p"]." ";
} //for($c=1;$c<=$cta_p;$c++){
}else{ //if($cta_p > 0){

$nombre_comprador = "";

}//if($cta_p > 0){



//fin busca comprador





echo "<div style='border:1px solid #cccccc;widht:800px;height:30px;line-height:30px;font-size:10px;margin-bottom:2px'>
      
     
      <div style='width:130px;float:left;overflow:hidden'>$nombre_sub2</div>
      <div style='width:100px;float:left;overflow:hidden'>$$l_sql[total_guita_vs]</div>
      <div style='width:250px;float:left;overflow:hidden'>$l_sql[estado_vs]</div>
      <div style='width:300px;float:left;overflow:hidden'>$nombre_comprador </div>
	  
	  <div style='clear:both'></div>
      </div>
	  
	  ";
	  
$sql_f = mysql_query("select * from articulo where idd_venta_ar='$l_sql[idd_carga_vs]' order by clave asc limit 0,1 ");	  
$lee_f = mysql_fetch_assoc($sql_f);

echo "<div style='font-size:11px;margin-top:10px'>"; //DDDDDDDDDDDDDD
	  
echo "Fecha de la compra: ".date("d/m/Y",$l_sql["idd_carga_vs"])." <br>";
echo "Fecha de la realizacion: ".date("d/m/Y",$lee_f["idd_fecha"])." <br>";

//busca_cantidad

$sql_pas_tot = mysql_query("select num_pasaje_p from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p <> 'comprador' order by num_pasaje_p desc limit 0,1");
$c_sql_pas_tot = mysql_num_rows($sql_pas_tot);
$l_sql_pas_tot = mysql_fetch_assoc($sql_pas_tot);

if($c_sql_pas_tot > 0){
echo "Cantidad de pasajeros: ".$l_sql_pas_tot["num_pasaje_p"]."<br>"; 
}//if($c_sql_pas_tot > 0){

//fin busca_cantidad

//adicionales

$sql_ad = mysql_query("select * from ventas_adicionales where idd_carga_va = '$l_sql[idd_carga_vs]'");
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

echo $texto_ad;


//cambi la fecha de realizacion
//cambi la fecha de realizacion

echo "<br><hr><hr><input type='button' style='height:50px;cursor:pointer' value='Cambiar fecha de realizaci�n' onclick=location.href='cambia_fecha.php?suma_pasajeros=$l_sql_pas_tot[num_pasaje_p]&id=$_GET[id]&fecha=$lee_f[idd_fecha]&id_fecha=$_GET[id_fecha]&clave_sub2=$l_sql[idd_sub2_vs]&id_carga_vs=$l_sql[idd_carga_vs]'><hr><hr>";

echo "<br><hr><hr><input type='button' style='height:50px;cursor:pointer' value='Modificar reserva' onclick=location.href='../articulo_modifica.php?id=$l_sql[idd_sub2_vs]&id_venta=$l_sql[idd_carga_vs]&id_fecha_ex=$l_sql[fecha_excur_vs]&id_v=$_SESSION[id_usuario]'><hr><hr>";


//cambi la fecha de realizacion
//cambi la fecha de realizacion



//CAMBIA IMPORTE
//CAMBIA IMPORTE

if($l_sql["total_guita_vs"] != $l_sql["sena_vs"]){
$ssena = $l_sql["sena_vs"];

}else{//if($l_sql["total_guita_vs"] == $l_sql["sena_vs"]){
$ssena = "";
echo "<br>dddd<br>";
}//if($l_sql["total_guita_vs"] == $l_sql["sena_vs"]){

echo "<br><hr><hr>Importe: 
      <form method='post' action='venta_detalle.php?id=$_GET[id]&id_fecha=$_GET[id_fecha]'>
      <input type='text' name='iimporte' value='$l_sql[total_guita_vs]'> <br><br>
	  
	  Se�a:<br>
	  <input type='text' name='ssena' value='$ssena'> <br><br>
      
      <input type='hidden' name='idd_carga' value='$l_sql[idd_carga_vs]'>
      <input type='hidden' name='escribano_importe' value='ok'>
      <input type='submit' value='Cambiar'>
      </form><br><hr><hr><br>";	  



//FIN CODIGO
//FIN CODIGO




//CODIGO
//CODIGO

echo "<br><hr><hr>Codigo: 
      <form method='post' action='venta_detalle.php?id=$_GET[id]&id_fecha=$_GET[id_fecha]'>
      <input type='text' name='codigo' value='$l_sql[codigo_vs]'>
      
      <input type='hidden' name='idd_carga' value='$l_sql[idd_carga_vs]'>
      <input type='hidden' name='escribano_codigo' value='ok'>
      <input type='submit' value='Cambiar'>
      </form><br><hr><hr><br>";	  



//FIN CODIGO
//FIN CODIGO


//ESTADO
//ESTADO




echo "<br><hr><hr>Estado: 
      <form method='post' action='venta_cambio_estado.php?id=$_GET[id]&id_fecha=$_GET[id_fecha]'>
	  <select name='estado'>
	  ";

if($l_sql["estado_vs"]=="cancelado"){
echo "<option selected >cancelado</option>";
}else{ //if($l_sql["estado_vs"]=="cancelado"){
echo "<option >cancelado</option>";
} //if($l_sql["estado_vs"]=="cancelado"){

if($l_sql["estado_vs"]=="reservado"){
echo "<option selected >reservado</option>";
}else{ //if($l_sql["estado_vs"]=="reservado"){
echo "<option >reservado</option>";
} //if($l_sql["estado_vs"]=="reservado"){

if($l_sql["estado_vs"]=="confirmado"){
echo "<option selected >confirmado</option>";
}else{ //if($l_sql["estado_vs"]=="confirmado"){
echo "<option >confirmado</option>";
} //if($l_sql["estado_vs"]=="confirmado"){	


if($l_sql["estado_vs"]=="se�ado"){
echo "<option selected >se�ado</option>";
}else{ //if($l_sql["estado_vs"]=="se�ado"){
echo "<option >se�ado</option>";
} //if($l_sql["estado_vs"]=="se�ado"){	  

if($l_sql["estado_vs"]=="pagado"){
echo "<option selected >pagado</option>";
}else{ //if($l_sql["estado_vs"]=="pagado"){
echo "<option >pagado</option>";
} //if($l_sql["estado_vs"]=="pagado"){		  
	  
	  
if($l_sql["estado_vs"]=="confirmado con deuda"){
echo "<option selected >confirmado con deuda</option>";
}else{ //if($l_sql["estado_vs"]=="Confirmado con deuda"){
echo "<option >confirmado con deuda</option>";
} //if($l_sql["estado_vs"]=="Confirmado con deuda"){		  
	  
echo "</select>
      <input type='hidden' name='estado_actual' value='$l_sql[estado_vs]'>
      <input type='hidden' name='idd_carga' value='$l_sql[idd_carga_vs]'>
      <input type='hidden' name='total_guita_vs' value='$l_sql[total_guita_vs]'>
      <input type='hidden' name='sena_vs' value='$l_sql[sena_vs]'>
      <input type='hidden' name='escribano_estado' value='ok'>
      <input type='submit' value='Cambiar'>
      </form><br><hr><hr><br>";	  
  

//FIN ESTADO
//FIN ESTADO  
  
  
  
//datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
//datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//---comprador

$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

echo "<br><b>Comprador:</b> <br><br>";

echo "<form method='post' action='venta_detalle.php?id=$_GET[id]'>";

for($y=1;$y<=$cta_pas;$y++){

$l_pas = mysql_fetch_assoc($sql_pas);

echo "
      <div style='width:200px;float:left'>$l_pas[campo1_p] : </div>
	  <div style='width:300px;float:left'><input type='text' name='$l_pas[campo1_p]' value='$l_pas[campo2_p]'></div>
	  <div style='clear:both'></div><br>

      
      ";

} //for($y=1;$y<=$cta_pas;$y++){
     
echo "<input type='hidden' name='tipo' value='comprador'>
      <input type='hidden' name='idd_carga' value='$l_sql[idd_carga_vs]'>
	  <input type='hidden' name='escribano_pasajero' value='ok'>
      <input type='submit' value='Modificar'>
      </form><hr>";     


//---comprador

//-pasajeros  




echo "<br><b>Pasajeros:</b> <br><br>";

for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){

echo "<form method='post' action='venta_detalle.php?id=$_GET[id]&id_fecha=$_GET[id_fecha]'>";


$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p <> 'comprador' and num_pasaje_p ='$ec' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

if($cta_pas > 0){


for($y=1;$y<=$cta_pas;$y++){


$l_pas = mysql_fetch_assoc($sql_pas);

$num_pasa = $l_pas["num_pasaje_p"];

if($y==1){

echo "
      <div style='width:200px;float:left'>Tipo : </div>
	  <div style='width:300px;float:left'>$l_pas[categoria_p]</div>
	  <div style='clear:both'></div><br>

      
      ";


} //if($y==1){

echo "
      <div style='width:200px;float:left'>$l_pas[campo1_p] : </div>
	  <div style='width:300px;float:left'><input type='text' name='p_$l_pas[id_pasajero_p]' value='$l_pas[campo2_p]'></div>
	  <div style='clear:both'></div><br>

      
      ";

} //for($y=1;$y<=$cta_pas;$y++){
     




echo "<input type='hidden' name='tipo' value='pasajero'>
      <input type='hidden' name='idd_carga' value='$l_sql[idd_carga_vs]'>
      <input type='hidden' name='num_pasaje' value='$ec'>
      <input type='hidden' name='cant_pas' value='$l_sql_pas_tot[num_pasaje_p]'>
	  <input type='hidden' name='escribano_pasajero' value='ok'>
      <input type='submit' value='Modificar'>
      </form><hr>";    

}//for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){
	  
	  
	  
	  




	  
	  
} //if($cta_pas > 0){

//-pasajeros  
  
//fin datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
//fin datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
  

  

echo "</div>"; //DDDDDDDDDDDDDD



?>


</div>  

<?php
echo "<div style='width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px'><a href='ventas.php?id_fecha=$_GET[id_fecha]'><img src='imagenes/bot_volver.png' title='Volver al panel'></a></div>";
?>
  
       </div> <!-- EEEEE -->


</body>
</html>
