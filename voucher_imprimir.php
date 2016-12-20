<?php
include_once("conexion.inc.php");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>VOUCHER</title>



<script>

function retardo(){
setInterval("retardo1()",1000)

} //function retardo(){


function retardo1(){

history.go(-1);

} //function retardo(){


</script>



</head>

<body>



                                   <div style="width:800px;margin:0px auto;font-family:arial;font-size:17px" id="seleccion">

<?php



$sql = mysql_query("SELECT * from ventas where idd_carga_vs = '$_GET[id]'");

$lee = mysql_fetch_assoc($sql);


$fecha_excurr = $lee["fecha_excur_vs"];

$fecha_excur = date("d/m/y", $fecha_excurr);



$tot_pasajeros = $lee["adulto_vs"] + $lee["bebe_vs"] + $lee["nino_vs"] + $lee["nino1_vs"] + $lee["nino2_vs"] + $lee["senior_vs"];

$det_pasajeros = "Adultos: $lee[adulto_vs] | Bebes: $lee[bebe_vs] | Menor cat 1: $lee[nino_vs] | Menor cat 2: $lee[nino1_vs] | Menor cat 3: $lee[nino2_vs] | Senior: $lee[senior_vs]";


//------- empresa



$sql_em = mysql_query("select * from empresa where id_empresa = '$lee[idd_empresa_vs]'");
$l_sql_em = mysql_fetch_assoc($sql_em);


if($l_sql_em["logo_empresa"] != ""){
$ima_logo = "<img src='".$l_sql_em["logo_empresa"]."' height='70'><br>";
}else{ //if($l_sql_em["logo_empresa"]){
$ima_logo = "";
} //if($l_sql_em["logo_empresa"]){


//------- fin empresa


//--- voucher

$sql_vou = mysql_query("select * from voucher where idd_ventas_vo='$lee[id_ventas]'");
$lee_vou = mysql_fetch_assoc($sql_vou);

$fecha_emision = date("d/m/y", $lee_vou["emision_vo"]);

//--- voucher


//busca comprador

$sql_p = mysql_query("select * from pasajeros where idd_carga_p = '$_GET[id]' and tipo_p = 'comprador'");
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




$encabezado_vou = "<div style='width:800px;border:0px solid #000'>

          <div style='float:left;height:70px;overflow:hidden'>
          $ima_logo  
          </div>

          <div style='float:left;width:340px;margin-left:30px;margin-right:20px;margin-top:15px;font-size:12px'>
          
		  $l_sql_em[direccion_empresa] <br>
          Telefono de Ventas: $l_sql_em[tel1_empresa]  <br>
          Email: $l_sql_em[mail_empresa] 		  
          </div>
		  
          <div style='clear:both'><br></div>
	 
     </div>";


echo $encabezado_vou;

echo "<div style='width:800px;font-size:11px'>Fecha de emisi�n $fecha_emision </div>"; 
	 
echo "<div style='width:800px;border:1px solid #000;margin-bottom:5px;height:20px;font-size:12px'>
         
	
	<div style='width:200px;float:left;height:20px;line-height:20px;border:1px solid #000'>
	
     <div style='width:200px;text-align:center;height:20px;line-height:20px'>
     <b>  VOUCHER $lee_vou[id_voucher_vo] </b>	 
	 </div>
	 
	  
	 
	 </div>
	 
	 
	 
	 <div style='height:20px;width:596px;float:left;border:1px solid #000;line-height:20px'>
     
	 <div style='width:500px;text-align:center;margin-top:0px;height:20px;line-height:20px'>
	 <b>Tel�fonos de emergencia: <span style='font-size:14px'>$l_sql_em[tel2_empresa]</span>	 </b></div>

	 

	 </div>	 
		 
     </div>";
	 
	 
/*	 
echo "<div style='width:800px;border:1px solid #000;height:40px;line-height:40px;margin-bottom:5px'>
      &nbsp; Pasajeros: $nombre_comprador <b> x $tot_pasajeros </b> &nbsp;&nbsp;	 
     </div>";
*/	 
	 





echo "<div style='width:780px;padding:10px;border:1px solid #000;margin-bottom:5px'>"; //2222222


//datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
//datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//busca_cantidad

$sql_pas_tot = mysql_query("select num_pasaje_p from pasajeros where idd_carga_p = '$_GET[id]' and tipo_p <> 'comprador' order by num_pasaje_p desc limit 0,1");
$c_sql_pas_tot = mysql_num_rows($sql_pas_tot);
$l_sql_pas_tot = mysql_fetch_assoc($sql_pas_tot);

//Busca edad pasajeros 
//Busca edad pasajeros 

$busca_edpas = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$_GET[id]' and tipo_pasajero_ep = 'Adulto' ");
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



$busca_edpas = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$_GET[id]' and tipo_pasajero_ep = 'Bebe' ");
$cta_edpas = mysql_num_rows($busca_edpas);

$ed_pas = $ed_pas."$cta_edpas Infoa | ";
/*
for($r=1;$r<=$cta_edpas;$r++){
$l_ed_pas = mysql_fetch_assoc($busca_edpas);


} //for($r=1;$<=$cta_edpas;$r++){
*/


$busca_edpas = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$_GET[id]' and (tipo_pasajero_ep = 'Menor cat. 1' or tipo_pasajero_ep = 'Menor cat. 2' or tipo_pasajero_ep = 'Menor cat. 3') order by edad_ep asc");
$cta_edpas = mysql_num_rows($busca_edpas);



for($r=1;$r<=$cta_edpas;$r++){
$l_ed_pas = mysql_fetch_assoc($busca_edpas);

$edad_c = $l_ed_pas["edad_ep"];

if($edad_c != $edad_c1){

$busca_ed = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$_GET[id]' and edad_ep = '$edad_c'");
$cta_ed = mysql_num_rows($busca_ed);



$ed_pas = $ed_pas."$cta_ed Menor de  $edad_c | ";


$edad_c1= $l_ed_pas["edad_ep"];

} //if($edad_c != $edad_c1){


} //for($r=1;$<=$cta_edpas;$r++){




$busca_edpas = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$_GET[id]' and tipo_pasajero_ep = 'Senior' order by edad_ep asc");
$cta_edpas = mysql_num_rows($busca_edpas);



for($r=1;$r<=$cta_edpas;$r++){
$l_ed_pas = mysql_fetch_assoc($busca_edpas);

$edad_c = $l_ed_pas["edad_ep"];

if($edad_c != $edad_c1){

$busca_ed = mysql_query("select * from edad_pasajeros where idd_carga_ep = '$_GET[id]' and edad_ep = '$edad_c'");
$cta_ed = mysql_num_rows($busca_ed);



$ed_pas = $ed_pas."$cta_ed Senior de  $edad_c | ";


$edad_c= $l_ed_pas["edad_ep"];

} //if($edad_c != $edad_c1){


} //for($r=1;$<=$cta_edpas;$r++){



//Busca edad pasajeros 
//Busca edad pasajeros 

if($c_sql_pas_tot > 0){
echo "Cantidad de pasajeros: ".$l_sql_pas_tot["num_pasaje_p"]."<span style='font-size:11px'> ( $ed_pas )</span><br>"; 
}//if($c_sql_pas_tot > 0){

//fin busca_cantidad



//---comprador

$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$_GET[id]' and tipo_p = 'comprador' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

echo "<b><span style='font-size:12px'>Comprador:<br></span></b> ";


$text_comprador = "";

for($y=1;$y<=$cta_pas;$y++){

$l_pas = mysql_fetch_assoc($sql_pas);

if($l_pas["campo1_p"] != "hotel"){
$text_comprador = $text_comprador."<span style='text-transform:capitalize'>$l_pas[campo1_p] </span>: <b> <span style='text-transform:capitalize'> $l_pas[campo2_p]  </span></b> | ";	  
} //if($l_pas["campo1_p"]=! "hotel"){	  
	  
} //for($y=1;$y<=$cta_pas;$y++){
     
echo "<span style='font-size:13px'>".$text_comprador."</span>";
	 
//---comprador

//-pasajeros  

/*


echo "<br><b><span style='font-size:12px'>Pasajeros:</b> </span>";

for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){



$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$_GET[id]' and tipo_p <> 'comprador' and num_pasaje_p ='$ec' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

$texto_pas = "";

if($cta_pas > 0){



for($y=1;$y<=$cta_pas;$y++){


$l_pas = mysql_fetch_assoc($sql_pas);

$num_pasa = $l_pas["num_pasaje_p"];

if($y==1){


$texto_pas = $texto_pas."<br><b>Tipo :</b> $l_pas[categoria_p] ";	  

} //if($y==1){

	  
$texto_pas = $texto_pas."| <b> $l_pas[campo1_p] : </b> $l_pas[campo2_p]";	  

} //for($y=1;$y<=$cta_pas;$y++){
     


echo "<span style='font-size:12px'>".$texto_pas."</span>";

  

}//for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){
	  
	  
	  
	  




	  
	  
} //if($cta_pas > 0){
*/
//-pasajeros  
  
//fin datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
//fin datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


   
   
echo  "</div>";	 //2222222   
   

//busca nombre articulo
$sql_sub2 = mysql_query("select * from subcategoria_2 where clave='$lee[idd_sub2_vs]'");
$l_sql_sub2 = mysql_fetch_assoc($sql_sub2);



$nombre_sub2 = $l_sql_sub2["nombre_sub2"]; 

//fin busca nombre articulo   
   


//adicionales

$sql_ad = mysql_query("select * from ventas_adicionales where idd_carga_va = '$_GET[id]'");
$cta_ad = mysql_num_rows($sql_ad);

$texto_ad = "";

if($cta_ad > 0){



for($y=1;$y<=$cta_ad;$y++){
$l_ad = mysql_fetch_assoc($sql_ad);

if($y==1){
$texto_ad = $texto_ad." <b>Servicios adicionales contratados: </b><br>";
}

$sql_ad1 = mysql_query("select * from adicionales where id_adicional='$l_ad[idd_ad_va]'");
$cta_ad1 = mysql_num_rows($sql_ad1);


for($bv=1;$bv<=$cta_ad1;$bv++){
$l_ad1 = mysql_fetch_assoc($sql_ad1);

$texto_ad = $texto_ad."$l_ad1[nombre_ad] | ";


} //for($bv=1;$bv<=$cta_ad1;$bv++){


}//for($y=1;$y<$cta_ad;$y++){


}else{//if($cta_ad > 0){
$texo_ad = "Sin servicios adicionales";
}//if($cta_ad > 0){

//fin adicionales

  
	 
	 
	 
echo "<div style='width:790px;border:1px solid #000;line-height:20px;margin-bottom:5px;padding:5px;font-size:12px'>
      CONTRA ENTREGA DEL PRESENTE CUPON, FAVOR PROVEER LOS SIGUIENTES SERVICIOS: <br>
	  $nombre_sub2 <br>
	  $texto_ad <br>
      $lee_vou[texto_1_vo] <br> 
	  
     	  
     </div>";
	 
	 
//busca hotel

$sql_vi = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='2' ");
$c_vi = mysql_num_rows($sql_vi);


if($c_vi > 0){
$l_vi = mysql_fetch_assoc($sql_vi);
$ddato = $l_vi["valor_iv"];
}else{ //if($c_vi > 0){
$ddato = "";
}//if($c_vi > 0){
	 
//busca hotel


//busca fecha in

$sql_vi1 = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='5' ");
$c_vi1 = mysql_num_rows($sql_vi1);


if($c_vi1 > 0){
$l_vi1 = mysql_fetch_assoc($sql_vi1);
$ddato1 = $l_vi1["valor_iv"];
}else{ //if($c_vi > 0){
$ddato1 = "";
}//if($c_vi > 0){
	 
//busca fecha in	


//busca fecha out

$sql_vi2 = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='6' ");
$c_vi2 = mysql_num_rows($sql_vi2);


if($c_vi2 > 0){
$l_vi2 = mysql_fetch_assoc($sql_vi2);
$ddato2 = $l_vi2["valor_iv"];
}else{ //if($c_vi > 0){
$ddato2 = "";
}//if($c_vi > 0){
	 
//busca fecha out	


//busca vuelo

$sql_vi3 = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='4' ");
$c_vi3 = mysql_num_rows($sql_vi3);


if($c_vi3 > 0){
$l_vi3 = mysql_fetch_assoc($sql_vi3);
$ddato3 = $l_vi3["valor_iv"];
}else{ //if($c_vi > 0){
$ddato3 = "";
}//if($c_vi > 0){
	 
//busca vuelo	


//busca pick up

$sql_vi4 = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='16' ");
$c_vi4 = mysql_num_rows($sql_vi4);


if($c_vi4 > 0){
$l_vi4 = mysql_fetch_assoc($sql_vi4);
$ddato4 = $l_vi4["valor_iv"];
}else{ //if($c_vi > 0){
$ddato4 = "";
}//if($c_vi > 0){
	 
//busca pick up
 

	 
echo "<div style='width:800px;border:1px solid #000;height:20px;line-height:20px;margin-bottom:5px;font-size:12px'>


          <div style='float:left;width:240px;height:20px;overflow:hidden'>
          &nbsp; Fecha: $fecha_excur
          </div>  
          
		  <div style='float:left;width:240px;height:20px;overflow:hidden'>
          &nbsp; Horario: $ddato4
          </div>

          <div style='float:left;width:264px'>
          &nbsp; Hotel: $ddato		  
          </div>
		  
		   <div style='float:left;width:264px'>
          	  
          </div>
		  
		  
          <div style='clear:both'></div>
	 
     </div>";	 
	 
	 
echo "<div style='width:800px;border:1px solid #000;height:20px;line-height:20px;margin-bottom:5px;font-size:12px'>
          
		  <div style='float:left;width:198px;height:20px;overflow:hidden'>
          &nbsp; Fecha in: $ddato1
          </div>

          <div style='float:left;width:198px'>
          &nbsp;  vuelo: $ddato3		  
          </div>
		  
		   <div style='float:left;width:198px'>
          &nbsp;  Fecha OUT: $ddato2	  
          </div>
		  
		  <div style='float:left;width:198px'>
          &nbsp;  vuelo: 	  
          </div>
		  
		  
          <div style='clear:both'></div>
	 
     </div>";		 

echo "<div style='width:800px;font-size:10px;text-align:center'>
Sujeto a las condiciones de la Ley de Turismo N� 25.997.
</div>";
	 
	 
#################################################################################################	 
#################################################################################################	 
#################################################################################################
#################################################################################################


echo "<br><br>------------------------------------------------------------------------------------------------------------<br><br>"; 
	 
echo $encabezado_vou;

 
echo "<div style='width:800px;font-size:11px'>Fecha de emisi�n $fecha_emision </div>"; 	 
echo "<div style='width:800px;border:1px solid #000;margin-bottom:5px;height:20px;font-size:12px'>
         
	
	<div style='width:200px;float:left;height:20px;line-height:20px;border:1px solid #000'>
	
     <div style='width:200px;text-align:center;height:20px;line-height:20px'>
     <b>  VOUCHER $lee_vou[id_voucher_vo] </b>	 
	 </div>
	 
	  
	 
	 </div>
	 
	 
	 
	 <div style='height:20px;width:596px;float:left;border:1px solid #000;line-height:20px'>
     
	 <div style='width:500px;text-align:center;margin-top:0px;height:20px;line-height:20px'>
	 <b>Tel�fonos de emergencia: <span style='font-size:14px'>$l_sql_em[tel2_empresa]</span>	 </b></div>

	 

	 </div>	 
		 
     </div>";
	 
	 
/*	 
echo "<div style='width:800px;border:1px solid #000;height:40px;line-height:40px;margin-bottom:5px'>
      &nbsp; Pasajeros: $nombre_comprador <b> x $tot_pasajeros </b> &nbsp;&nbsp;	 
     </div>";
*/	 
	 





echo "<div style='width:780px;padding:10px;border:1px solid #000;margin-bottom:5px'>"; //2222222


//datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
//datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//busca_cantidad

$sql_pas_tot = mysql_query("select num_pasaje_p from pasajeros where idd_carga_p = '$_GET[id]' and tipo_p <> 'comprador' order by num_pasaje_p desc limit 0,1");
$c_sql_pas_tot = mysql_num_rows($sql_pas_tot);
$l_sql_pas_tot = mysql_fetch_assoc($sql_pas_tot);

if($c_sql_pas_tot > 0){
echo "Cantidad de pasajeros: ".$l_sql_pas_tot["num_pasaje_p"]."<span style='font-size:11px'> ( $ed_pas )</span><br>"; 
}//if($c_sql_pas_tot > 0){

//fin busca_cantidad



//---comprador

$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$_GET[id]' and tipo_p = 'comprador' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

echo "<b><span style='font-size:12px'>Comprador:<br></span></b> ";


$text_comprador = "";

for($y=1;$y<=$cta_pas;$y++){

$l_pas = mysql_fetch_assoc($sql_pas);

if($l_pas["campo1_p"] != "hotel"){
$text_comprador = $text_comprador."<span style='text-transform:capitalize'>$l_pas[campo1_p] </span>: <b> <span style='text-transform:capitalize'> $l_pas[campo2_p]  </span></b> | ";	  
} //if($l_pas["campo1_p"]=! "hotel"){	  
	  
} //for($y=1;$y<=$cta_pas;$y++){
     
echo "<span style='font-size:13px'>".$text_comprador."</span>";
	 
//---comprador

//-pasajeros  


/*

echo "<br><b><span style='font-size:12px'>Pasajeros:</b> </span>";

for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){



$sql_pas = mysql_query("select * from pasajeros where idd_carga_p = '$_GET[id]' and tipo_p <> 'comprador' and num_pasaje_p ='$ec' order by id_pasajero_p asc");
$cta_pas = mysql_num_rows($sql_pas);

$texto_pas = "";

if($cta_pas > 0){



for($y=1;$y<=$cta_pas;$y++){


$l_pas = mysql_fetch_assoc($sql_pas);

$num_pasa = $l_pas["num_pasaje_p"];

if($y==1){


$texto_pas = $texto_pas."<br><b>Tipo :</b> $l_pas[categoria_p] ";	  

} //if($y==1){

	  
$texto_pas = $texto_pas."| <b> $l_pas[campo1_p] : </b> $l_pas[campo2_p]";	  

} //for($y=1;$y<=$cta_pas;$y++){
     


echo "<span style='font-size:12px'>".$texto_pas."</span>";

  

}//for($ec=1;$ec<=$l_sql_pas_tot["num_pasaje_p"];$ec++){
	  
	  
	  
	  




	  
	  
} //if($cta_pas > 0){

//-pasajeros  


*/
  
//fin datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
//fin datos de los pasajeros %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


   
   
echo  "</div>";	 //2222222   
   

//busca nombre articulo
$sql_sub2 = mysql_query("select * from subcategoria_2 where clave='$lee[idd_sub2_vs]'");
$l_sql_sub2 = mysql_fetch_assoc($sql_sub2);



$nombre_sub2 = $l_sql_sub2["nombre_sub2"]; 

//fin busca nombre articulo   
   


//adicionales

$sql_ad = mysql_query("select * from ventas_adicionales where idd_carga_va = '$_GET[id]'");
$cta_ad = mysql_num_rows($sql_ad);

$texto_ad = "";

if($cta_ad > 0){



for($y=1;$y<=$cta_ad;$y++){
$l_ad = mysql_fetch_assoc($sql_ad);

if($y==1){
$texto_ad = $texto_ad." <b>Servicios adicionales contratados: </b><br>";
}

$sql_ad1 = mysql_query("select * from adicionales where id_adicional='$l_ad[idd_ad_va]'");
$cta_ad1 = mysql_num_rows($sql_ad1);


for($bv=1;$bv<=$cta_ad1;$bv++){
$l_ad1 = mysql_fetch_assoc($sql_ad1);

$texto_ad = $texto_ad."$l_ad1[nombre_ad] | ";


} //for($bv=1;$bv<=$cta_ad1;$bv++){


}//for($y=1;$y<$cta_ad;$y++){


}else{//if($cta_ad > 0){
$texo_ad = "Sin servicios adicionales";
}//if($cta_ad > 0){

//fin adicionales

  
	 
	 
	 
echo "<div style='width:790px;border:1px solid #000;line-height:20px;margin-bottom:5px;padding:5px;font-size:12px'>
      CONTRA ENTREGA DEL PRESENTE CUPON, FAVOR PROVEER LOS SIGUIENTES SERVICIOS: <br>
	  $nombre_sub2 <br>
	  $texto_ad <br>
      $lee_vou[texto_1_vo] <br> 
	  
     	  
     </div>";
	 
	 
//busca hotel

$sql_vi = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='2' ");
$c_vi = mysql_num_rows($sql_vi);


if($c_vi > 0){
$l_vi = mysql_fetch_assoc($sql_vi);
$ddato = $l_vi["valor_iv"];
}else{ //if($c_vi > 0){
$ddato = "";
}//if($c_vi > 0){
	 
//busca hotel


//busca fecha in

$sql_vi1 = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='5' ");
$c_vi1 = mysql_num_rows($sql_vi1);


if($c_vi1 > 0){
$l_vi1 = mysql_fetch_assoc($sql_vi1);
$ddato1 = $l_vi1["valor_iv"];
}else{ //if($c_vi > 0){
$ddato1 = "";
}//if($c_vi > 0){
	 
//busca fecha in	


//busca fecha out

$sql_vi2 = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='6' ");
$c_vi2 = mysql_num_rows($sql_vi2);


if($c_vi2 > 0){
$l_vi2 = mysql_fetch_assoc($sql_vi2);
$ddato2 = $l_vi2["valor_iv"];
}else{ //if($c_vi > 0){
$ddato2 = "";
}//if($c_vi > 0){
	 
//busca fecha out	


//busca vuelo

$sql_vi3 = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='4' ");
$c_vi3 = mysql_num_rows($sql_vi3);


if($c_vi3 > 0){
$l_vi3 = mysql_fetch_assoc($sql_vi3);
$ddato3 = $l_vi3["valor_iv"];
}else{ //if($c_vi > 0){
$ddato3 = "";
}//if($c_vi > 0){
	 
//busca vuelo	


//busca pick up

$sql_vi4 = mysql_query("select valor_iv from items_valor where idd_venta_iv = '$_GET[id]' and idd_ibc_iv='16' ");
$c_vi4 = mysql_num_rows($sql_vi4);


if($c_vi4 > 0){
$l_vi4 = mysql_fetch_assoc($sql_vi4);
$ddato4 = $l_vi4["valor_iv"];
}else{ //if($c_vi > 0){
$ddato4 = "";
}//if($c_vi > 0){
	 
//busca pick up
 

	 
echo "<div style='width:800px;border:1px solid #000;height:20px;line-height:20px;margin-bottom:5px;font-size:12px'>
          
		  <div style='float:left;width:240px;height:20px;overflow:hidden'>
          &nbsp; Fecha: $fecha_excur
          </div>  
          
		  <div style='float:left;width:240px;height:20px;overflow:hidden'>
          &nbsp; Horario: $ddato4
          </div>
          <div style='float:left;width:264px'>
          &nbsp; Hotel: $ddato		  
          </div>
		  
		   <div style='float:left;width:264px'>
          	  
          </div>
		  
		  
          <div style='clear:both'></div>
	 
     </div>";	 
	 
	 
echo "<div style='width:800px;border:1px solid #000;height:20px;line-height:20px;margin-bottom:5px;font-size:12px'>
          
		  <div style='float:left;width:198px;height:20px;overflow:hidden'>
          &nbsp; Fecha in: $ddato1
          </div>

          <div style='float:left;width:198px'>
          &nbsp;  vuelo: $ddato3		  
          </div>
		  
		   <div style='float:left;width:198px'>
          &nbsp;  Fecha OUT: $ddato2	  
          </div>
		  
		  <div style='float:left;width:198px'>
          &nbsp;  vuelo: 	  
          </div>
		  
		  
          <div style='clear:both'></div>
	 
     </div>";		 

echo "<div style='width:800px;font-size:10px;text-align:center'>
Sujeto a las condiciones de la Ley de Turismo N� 25.997.
</div>";

	 
	 

?>
                        
						
													 
													 </div>



													 
</body>
</html>

<?php


echo "
<script>print()</script>
<script>retardo()</script>
";



?>
