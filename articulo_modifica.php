<?php
session_start();
include_once("encabezado.inc.php");


//si ya paso la fecha de la excursion no deja modificar
//si ya paso la fecha de la excursion no deja modificar

$hoy_es = time();

if($hoy_es > $_GET["id_fecha_ex"]){
echo "<script>alert('No se pueden modificar excursiones anteriores al dia de la fecha.');
history.go(-1);
</script>";

die();

}//if($hoy_es > $_GET["id_fecha_ex"]){


//si ya paso la fecha de la excursion no deja modificar
//si ya paso la fecha de la excursion no deja modificar


//controla si esta logueado el vendedor
//controla si esta logueado el vendedor



if(isset($_SESSION["logeo"])){

if(isset($_GET["id_v"])){

}else{//if(isset($_GET["id_v"]){

echo "<script>location.href='articulo.php?id=$_GET[id]&id_v=$_SESSION[id_usuario]'</script>";

}//if(isset($_GET["id_v"]){


}//if(isset($_SESSION["logeo"]){


//controla si esta logueado el vendedor
//controla si esta logueado el vendedor

?>

<META NAME="Description" CONTENT="">

<META NAME="Keywords" CONTENT="">



<title>PLATAFORMA</title>


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

function muestra_adulto(valor){
 
numero=parseInt(valor);
diferencia = numero + 1;

valor = parseInt(valor);

for(u=1;u<=valor;u++){
document.getElementById("edad_adulto_" + u).style.display="block";

}//for(u=1;u<=valor;u++){

for(ut=diferencia;ut<=10;ut++){

document.getElementById("edad_adulto_" + ut).style.display="none";
}//for(uu=1;uu<=valor;uu++){

} //function muestra_adulto(valor){



function muestra_bebe(valor){
 
numero=parseInt(valor);
diferencia = numero + 1;


for(u=1;u<=valor;u++){
document.getElementById("edad_bebe_" + u).style.display="block";
}//for(u=1;u<=valor;u++){

for(ut=diferencia;ut<=10;ut++){

document.getElementById("edad_bebe_" + ut).style.display="none";
}//for(uu=1;uu<=valor;uu++){

} //function muestra_bebe(valor){


function muestra_nino(valor){
 
numero=parseInt(valor);
diferencia = numero + 1;


for(u=1;u<=valor;u++){
document.getElementById("edad_nino_" + u).style.display="block";
}//for(u=1;u<=valor;u++){

for(ut=diferencia;ut<=10;ut++){

document.getElementById("edad_nino_" + ut).style.display="none";
}//for(uu=1;uu<=valor;uu++){

} //function muestra_nino(valor){



function muestra_nino1(valor){
 
numero=parseInt(valor);
diferencia = numero + 1;


for(u=1;u<=valor;u++){
document.getElementById("edad_nino1_" + u).style.display="block";
}//for(u=1;u<=valor;u++){

for(ut=diferencia;ut<=10;ut++){

document.getElementById("edad_nino1_" + ut).style.display="none";
}//for(uu=1;uu<=valor;uu++){

} //function muestra_nino1(valor){


function muestra_nino2(valor){
 
numero=parseInt(valor);
diferencia = numero + 1;


for(u=1;u<=valor;u++){
document.getElementById("edad_nino2_" + u).style.display="block";
}//for(u=1;u<=valor;u++){

for(ut=diferencia;ut<=10;ut++){

document.getElementById("edad_nino2_" + ut).style.display="none";
}//for(uu=1;uu<=valor;uu++){

} //function muestra_nino2(valor){


function muestra_senior(valor){
 
numero=parseInt(valor);
diferencia = numero + 1;


for(u=1;u<=valor;u++){
document.getElementById("edad_senior_" + u).style.display="block";
}//for(u=1;u<=valor;u++){

for(ut=diferencia;ut<=10;ut++){

document.getElementById("edad_senior_" + ut).style.display="none";
}//for(uu=1;uu<=valor;uu++){

} //function muestra_nino(valor){



</script>	
	
	
	
	
	
	
</head>

<body >




                                                  <div  class="global" >
<?php

$sql1 = mysql_query("select * from subcategoria_2 where clave = '$_GET[id]'");
$lee1 = mysql_fetch_assoc($sql1);


echo "
<div class='encabezado'>
<div style='color:#fff;font-size:25px;padding-top:150px;padding-left:50px;text-transform:uppercase'>  $lee1[nombre_sub2]";


$descuento_vendedor = 0;

if(isset($_GET["id_v"])){

$sql_ven = mysql_query("select * from usuario where id_usuario='$_GET[id_v]' ");
$l_ven = mysql_fetch_assoc($sql_ven);

echo " <span style='color:#555555' >&nbsp; &nbsp; &nbsp; Vendedor: $l_ven[nombre_usuario] </span>";

//busca si tiene descuento el vendedor
//busca si tiene descuento el vendedor

$b_de = mysql_query("select * from descuento_vendedor where idd_vendedor_dv='$_GET[id_v]' and idd_sub2_dv='$_GET[id]'");

$c_de = mysql_num_rows($b_de);

if($c_de > 0){

$l_de = mysql_fetch_assoc($b_de);

$descuento_vendedor = $l_de["descuento_dv"];

}//if($c_de > 0){

//fin busca si tiene descuento el vendedor
//fin busca si tiene descuento el vendedor






}//if(isset($_GET["id_v"])){


echo "</div>
</div>";											  

?>											  

<div style="width:230px;float:left">



</div>

<div style="width:600px;float:left;padding:10px"> <!--   ttt -->

<?php



$id_empresa = $lee1["idd_empresa_sub2"];
$clave_categoria = $lee1["clave_categoria_s2"];


if($lee1["publica_sub2"]=="si"){


//CALCULA PRECIO CON DESCUENTO
//CALCULA PRECIO CON DESCUENTO

if($descuento_vendedor > 0){

$calc_desc = ($lee1["precio_sub2"] * $descuento_vendedor) / 100;

$pprecio_finall = $lee1["precio_sub2"] - $calc_desc;

}else{//if($descuento_vendedor > 0){

$pprecio_finall = $lee1["precio_sub2"];

}//if($descuento_vendedor > 0){

//FIN CALCULA PRECIO CON DESCUENTO
//FIN CALCULA PRECIO CON DESCUENTO


echo "<div class='textos'>

      <b>PRECIO: $$pprecio_finall </b><br><br>";

$sql_de = mysql_query("select * from descuento_edad where idd_sub2='$_GET[id]' ");
$cta_sql_de = mysql_num_rows($sql_de);

if($cta_sql_de == 0){
echo "No hay descuento por edad";  
}else{//if($cta_sql_de == 0){

for($d=1;$d<=$cta_sql_de;$d++){
$l_sql_de = mysql_fetch_assoc($sql_de);

if($l_sql_de["tipo"]=="porcentaje"){


if($l_sql_de["edad_bebe1"]!=""){

if($l_sql_de["bebe"]>0){
echo "Descuento para bebes de $l_sql_de[edad_bebe1] a $l_sql_de[edad_bebe2] a�os: % $l_sql_de[bebe] ";


if($l_sql_de["adic_bebe"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["bebe"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["bebe"]=="si"){
}

} //if($l_sql_de["bebe"]>0){

if($l_sql_de["edad_nino1"]!=""){

if($l_sql_de["nino"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino1] a $l_sql_de[edad_nino2] a�os: % $l_sql_de[nino] ";

if($l_sql_de["adic_nino"]=="si"){
echo " ( Incluye a los servicios adicionales ) <br>";
}else{ //if($l_sql_de["nino"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["nino"]=="si"){

} //if($l_sql_de["bebe"]>0){

} //if($l_sql_de["edad_nino1"]!=""){


if($l_sql_de["edad_nino1_1"]!=""){

if($l_sql_de["nino1"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino1_1] a $l_sql_de[edad_nino2_1] a�os: % $l_sql_de[nino1] ";

if($l_sql_de["adic_nino1"]=="si"){
echo " ( Incluye a los servicios adicionales ) <br>";
}else{ //if($l_sql_de["nino1"]=="si"){
echo " ( NO incluye a los servicios adicionales ) <br>";
} //if($l_sql_de["nino1"]=="si"){

} //if($l_sql_de["bebe"]>0){


} //if($l_sql_de["edad_nino1_1"]!=""){


if($l_sql_de["edad_nino1_2"]!=""){


if($l_sql_de["nino2"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino2_1] a $l_sql_de[edad_nino2_2] a�os: % $l_sql_de[nino2] ";

if($l_sql_de["adic_nino2"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["nino2"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["nino2"]=="si"){

}//edad_nino1_2

} //if($l_sql_de["bebe"]>0){




 

if($l_sql_de["edad_senior1"]>0){

if($l_sql_de["senior"]>0){
echo "Descuento para mayores de edad de $l_sql_de[edad_senior1] a $l_sql_de[edad_senior2] a�os: % $l_sql_de[senior] <br>";

if($l_sql_de["adic_senior"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["senior"]=="si"){
echo " ( NO incluye a los servicios adicionales ) <br>";
} //if($l_sql_de["senior"]=="si"){


}//if($l_sql_de["edad_senior1"]>0){

} //if($l_sql_de["bebe"]>0){


}else{ //if($l_sql_de["tipo"]=="porcentaje"){



if($l_sql_de["bebe"]>0){
echo "Descuento para bebes de $l_sql_de[edad_bebe1] a $l_sql_de[edad_bebe2] a�os: $ $l_sql_de[bebe] ";

if($l_sql_de["adic_bebe"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["bebe"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["bebe"]=="si"){


} //if($l_sql_de["bebe"]>0){



if($l_sql_de["nino"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino1] a $l_sql_de[edad_nino2] a�os: $ $l_sql_de[nino] ";

if($l_sql_de["adic_nino"]=="si"){
echo " ( Incluye a los servicios adicionales ) <br>";
}else{ //if($l_sql_de["nino"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["nino"]=="si"){

} //if($l_sql_de["bebe"]>0){


if($l_sql_de["nino1"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino1_1] a $l_sql_de[edad_nino2_1] a�os: $ $l_sql_de[nino1] ";

if($l_sql_de["adic_nino1"]=="si"){
echo " ( Incluye a los servicios adicionales ) <br>";
}else{ //if($l_sql_de["nino1"]=="si"){
echo " ( NO incluye a los servicios adicionales ) <br>";
} //if($l_sql_de["nino1"]=="si"){

} //if($l_sql_de["bebe"]>0){

if($l_sql_de["nino2"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino2_1] a $l_sql_de[edad_nino2_2] a�os: $ $l_sql_de[nino2] ";

if($l_sql_de["adic_nino2"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["nino2"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["nino2"]=="si"){


} //if($l_sql_de["bebe"]>0){

if($l_sql_de["senior"]>0){
echo "Descuento para mayores de edad de $l_sql_de[edad_senior1] a $l_sql_de[edad_senior2] a�os: $ $l_sql_de[senior]<br>";

if($l_sql_de["adic_senior"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["senior"]=="si"){
echo " ( NO incluye a los servicios adicionales ) <br>";
} //if($l_sql_de["senior"]=="si"){


} //if($l_sql_de["bebe"]>0){





}// if($l_sql_de["tipo"]=="porcentaje"){


}//for($d=1;$d<=$cta_sql_de;$d++){


} ////if($cta_sql_de == 0){	  
	  
echo "</div>";

} //if($lee1["publica_sub"]=="si"){

?>










<?php

echo "<div class='titulo'>Modificar:</div>";

echo "<div class='textos'>"; //eeeeerew


if(isset($_GET["id_v"])){
$clave_vendedor = "&id_v=".$_GET["id_v"];
}else{//if(isset($_GET["id_v"])){
$clave_vendedor = "";
}//if(isset($_GET["id_v"])){


//$_GET["id_vvv"] es el codigo de un vendedor que viene de un iframe

$exis_id_v = isset($_GET["id_v"]);


if(isset($_GET["id_vvv"]) && $exis_id_v == FALSE){
$clave_vendedor = "&id_vvv=".$_GET["id_vvv"];
}//if(isset($_GET["id_vvv"])){




echo "<form method='post' action='paso1_modifica.php?id=$_GET[id]&id_venta=$_GET[id_venta]&id_fecha_ex=$_GET[id_fecha_ex]$clave_vendedor' name='cave'>";


//fecha


if($clave_categoria == "3"){
echo "<div style='float:left'>Desde la fecha:";
}else{ //if($clave_categoria == "3"){
echo "<div style='float:left'>Fecha de la excursion";
}//if($clave_categoria == "3"){


if(isset($_POST["hasta"])){
$f_hasta = $_POST["hasta"];
}else{ //if(isset($_POST["hasta"])){
$f_hasta = "";
}//if(isset($_POST["hasta"])){

if(isset($_POST["desde"])){
$f_desde = $_POST["desde"];
}else{ //if(isset($_POST["desde"])){
$f_desde = "";
}//if(isset($_POST["desde"])){


//fecha exc

$fecha_ex = date("d/m/Y", $_GET["id_fecha_ex"]);


//fecha exc


//pick up 

$b_pk = mysql_query("select * from items_valor where idd_ibc_iv='16' and idd_venta_iv='$_GET[id_venta]' ");
$l_pk = mysql_fetch_assoc($b_pk);

$pick_up = "$l_pk[valor_iv]";



//pick up 


echo "
<input style='width:100px' id='desde' name='desde' value='$fecha_ex' /> <!--<button id='f_btn1'>...</button> --> &nbsp; &nbsp; &nbsp; </div>";

if($clave_categoria == "3"){
echo "<div style='float:left;display:block'>";
}else{ //if($clave_categoria == "3"){
echo "<div style='float:left;display:none'>";
}//if($clave_categoria == "3"){

echo "Hasta la fecha: 
<input style='width:100px' id='hasta' name='hasta' value='$f_hasta' /><button id='f_btn2'>...</button></div><br /><br /> 
<div style='clear:both'></div>
      ";

//fin fecha


// PREGUNTA SI ES VENTA DE VENDEDOR Y PONE LA OPCION DEL PICK UP
// PREGUNTA SI ES VENTA DE VENDEDOR Y PONE LA OPCION DEL PICK UP

if(isset($_GET["id_v"])){


      

echo "<br> Hora de pick up: 

      <select name='pickup'><option value='' selected='selected'></option>";

      $sql_pu = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='hora' order by nombre_da asc");
	  
	  $c_pu = mysql_num_rows($sql_pu);
	  
	  for($u=1;$u<=$c_pu;$u++){
	  
	  $l_pu = mysql_fetch_assoc($sql_pu);
	  
	  if($l_pu["nombre_da"] == $pick_up){
	  echo "<option selected='selected'>$l_pu[nombre_da]</option>";
	  }else{//$l_h["valor_iva"] == $l_pu["nombre_da"]){
	  echo "<option >$l_pu[nombre_da]</option>";
	  } //if($l_h["valor_iva"] == $l_pu["nombre_da"]){
	  
	  
	  
	  } //for($u=1;$u<=$c_pu;$u++){

	  
	  echo "</select><br/><br/>";

	  
	  
	  
}//if(isset($_GET["id_v"])){

// FIN PREGUNTA SI ES VENTA DE VENDEDOR Y PONE LA OPCION DEL PICK UP
// FIN PREGUNTA SI ES VENTA DE VENDEDOR Y PONE LA OPCION DEL PICK UP





//busca las edades de descuento para q no se repitan con la de los adultos
//busca las edades de descuento para q no se repitan con la de los adultos

$sql_de1 = mysql_query("select * from descuento_edad where idd_sub2='$_GET[id]' ");
$cta_sql_de1 = mysql_num_rows($sql_de1);


for($xs=1;$xs<=100;$xs++){

$ed_adq[$xs] = $xs;

} //for($xs=1;$xs<=100;$xs++){

for($d=1;$d<=$cta_sql_de1;$d++){
$l_sql_de = mysql_fetch_assoc($sql_de1);

if($l_sql_de["edad_bebe2"] > 0){

for($q=$l_sql_de["edad_bebe1"];$q<=$l_sql_de["edad_bebe2"];$q++){
$ed_adq[$q] = "";
}//for($q=$l_sql_de["edad_bebe1"];$q<=$l_sql_de["edad_bebe2"];$q++){

}//if($l_sql_de["edad_bebe2"]){

if($l_sql_de["edad_nino2"] > 0){

for($q=$l_sql_de["edad_nino1"];$q<=$l_sql_de["edad_nino2"];$q++){
$ed_adq[$q] = "";
}//for($q=$l_sql_de["nino1"];$q<=$l_sql_de["nino2"];$q++){

}//if($l_sql_de["nino2"]){




if($l_sql_de["edad_nino2_1"] > 0){

for($q=$l_sql_de["edad_nino1_1"];$q<=$l_sql_de["edad_nino2_1"];$q++){
$ed_adq[$q] = "";
}//for($q=$l_sql_de["nino1_1"];$q<=$l_sql_de["nino1_2"];$q++){

}//if($l_sql_de["nino2"]){




if($l_sql_de["edad_nino2_2"] > 0){

for($q=$l_sql_de["edad_nino1_2"];$q<=$l_sql_de["edad_nino2_2"];$q++){
$ed_adq[$q] = "";
}//for($q=$l_sql_de["nino1_1"];$q<=$l_sql_de["nino1_2"];$q++){

}//if($l_sql_de["nino2"]){



if($l_sql_de["edad_senior2"] > 0){

for($q=$l_sql_de["edad_senior1"];$q<=$l_sql_de["edad_senior2"];$q++){
$ed_adq[$q] = "";
}//for($q=$l_sql_de["nino1_1"];$q<=$l_sql_de["edad_senior1"];$q++){

}//if($l_sql_de["nino2"]){





}//for($d=1;$d<=$cta_sql_de;$d++){





//fin busca las edades de descuento para q no se repitan con la de los adultos
//fin busca las edades de descuento para q no se repitan con la de los adultos

$sql_cps = mysql_query("select * from edad_pasajeros where idd_carga_ep='$_GET[id_venta]' and tipo_pasajero_ep='Adulto'");
$cta_cps = mysql_num_rows($sql_cps);

echo "<input type='hidden' name='adulto_antes' value='$cta_cps'>";

for($v=1;$v<=$cta_cps;$v++){
$lee_cps = mysql_fetch_assoc($sql_cps);

$ed_cps[$v] = $lee_cps["edad_ep"];



}//for($v=1;$v<=$cta_cps;$v++){


echo "Adultos: 
     <select name='adulto' onChange='muestra_adulto(document.cave.adulto.value)'>
	 <option value='0' >0</option>
	 ";

for($u=1;$u<=20;$u++){

if($u == $cta_cps){
echo "<option value='$u' selected >$u</option>";	 
}else{
echo "<option value='$u' >$u</option>";	 
}


}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";	 

//echo "<script>muestra_adulto($cta_cps)</script>";
//echo "<script>document.getElementsByName('ppcx').style.display='block'</script>";

// pregunta las edades adulto

for($az=1;$az<=20;$az++){

if($az <= $cta_cps){
echo "<div style='display:block;margin-left:10px;margin-bottom:10px' id='edad_adulto_$az' >Edad del adulto $az: 
<select name='ed_ad_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";
}else{ //if($az <= $cta_cps){
echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_adulto_$az' >Edad del adulto $az: 
<select name='ed_ad_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";
} //if($az <= $cta_cps){

for($o=1;$o<101;$o++){



if($ed_adq[$o]!=""){

if($o != $ed_cps[$az]){
echo "<option >$o</option>";
}else{
echo "<option selected>$o</option>";
}



}//if($ed_adq[$o]!=""){


} //for($o=1;$o<101;$o++){


echo "</select>
<br></div>";


}//for($az=1;$az<=10;$az++){


unset($ed_cps);



// fin pregunta las edades adulto



$sql_cps = mysql_query("select * from edad_pasajeros where idd_carga_ep='$_GET[id_venta]' and tipo_pasajero_ep='Bebe'");
$cta_cps = mysql_num_rows($sql_cps);

echo "<input type='hidden' name='bebe_antes' value='$cta_cps'>";

for($v=1;$v<=$cta_cps;$v++){
$lee_cps = mysql_fetch_assoc($sql_cps);

$ed_cps[$v] = $lee_cps["edad_ep"];



}//for($v=1;$v<=$cta_cps;$v++){



$sql_de = mysql_query("select * from descuento_edad where idd_sub2='$_GET[id]' ");
$cta_sql_de = mysql_num_rows($sql_de);


for($d=1;$d<=$cta_sql_de;$d++){
$l_sql_de = mysql_fetch_assoc($sql_de);

if($l_sql_de["edad_bebe1"]!=""){

echo "Bebe's de $l_sql_de[edad_bebe1] a $l_sql_de[edad_bebe2] a�os: 
     <select name='bebe' onChange='muestra_bebe(document.cave.bebe.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
if($u == $cta_cps){
echo "<option value='$u' selected >$u</option>";	 
}else{
echo "<option value='$u' >$u</option>";	 
}	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_bebe' value='$l_sql_de[bebe]'>";
echo "<input type='hidden' name='adic_desc_bebe' value='$l_sql_de[adic_bebe]'>";


// pregunta las edades bebe


for($az=1;$az<=10;$az++){

if($az <= $cta_cps){
echo "<div style='display:block;margin-left:10px;margin-bottom:10px' id='edad_bebe_$az'>Edad del bebe $az: 
<select name='ed_bb_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";
}else{ //if($az <= $cta_cps){
echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_$az'>Edad del bebe $az: 
<select name='ed_bb_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";
}//if($az <= $cta_cps){

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

//echo "<option value='$j'>$j</option>";

if($j != $ed_cps[$az]){
echo "<option >$j</option>";
}else{
echo "<option selected>$j</option>";
}

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";


}//for($az=1;$az<=10;$az++){


unset($ed_cps);


// fin pregunta las edades bebe


}else{ //if($l_sql_de["bebe"]>0){

echo "<input type='hidden' name='bebe' value='0'>";

}// //if($l_sql_de["bebe"]>0){



if($l_sql_de["edad_nino1"]!=""){


$sql_cps = mysql_query("select * from edad_pasajeros where idd_carga_ep='$_GET[id_venta]' and tipo_pasajero_ep='Menor cat. 1'");
$cta_cps = mysql_num_rows($sql_cps);

echo "<input type='hidden' name='menor1_antes' value='$cta_cps'>";

for($v=1;$v<=$cta_cps;$v++){
$lee_cps = mysql_fetch_assoc($sql_cps);

$ed_cps[$v] = $lee_cps["edad_ep"];



}//for($v=1;$v<=$cta_cps;$v++){


echo "Ni�os de $l_sql_de[edad_nino1] a $l_sql_de[edad_nino2] a�os: 
     <select name='nino' onChange='muestra_nino(document.cave.nino.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
if($u == $cta_cps){
echo "<option value='$u' selected >$u</option>";	 
}else{
echo "<option value='$u' >$u</option>";	 
}	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_nino' value='$l_sql_de[nino]'>";
echo "<input type='hidden' name='adic_desc_nino' value='$l_sql_de[adic_nino]'>";




// pregunta las edades ni�o regla 1


for($az=1;$az<=10;$az++){

if($az <= $cta_cps){
echo "<div style='display:block;margin-left:10px;margin-bottom:10px' id='edad_nino_$az'>Edad del ni�o $az: 
<select name='ed_nn_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";
}else{ //if($az <= $cta_cps){
echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_$az'>Edad del ni�o $az: 
<select name='ed_nn_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

}//if($az <= $cta_cps){


for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

if($j != $ed_cps[$az]){
echo "<option >$j</option>";
}else{
echo "<option selected>$j</option>";
}

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";



} //for($az=1;$az<=10;$az++){


unset($ed_cps);


// fin pregunta las edades ni�o regla 1








}else{ //if($l_sql_de["nino"]>0){

echo "<input type='hidden' name='nino' value='0'>";

} //if($l_sql_de["nino"]>0){




if($l_sql_de["edad_nino1_1"]!=""){


$sql_cps = mysql_query("select * from edad_pasajeros where idd_carga_ep='$_GET[id_venta]' and tipo_pasajero_ep='Menor cat. 2'");
$cta_cps = mysql_num_rows($sql_cps);

echo "<input type='hidden' name='menor2_antes' value='$cta_cps'>";

for($v=1;$v<=$cta_cps;$v++){
$lee_cps = mysql_fetch_assoc($sql_cps);

$ed_cps[$v] = $lee_cps["edad_ep"];



}//for($v=1;$v<=$cta_cps;$v++){

echo "Ni�os de $l_sql_de[edad_nino1_1] a $l_sql_de[edad_nino2_1] a�os: 
     <select name='nino1' onChange='muestra_nino1(document.cave.nino1.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
if($u == $cta_cps){
echo "<option value='$u' selected >$u</option>";	 
}else{
echo "<option value='$u' >$u</option>";	 
}	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";

echo "<input type='hidden' name='num_nino1' value='$l_sql_de[nino1]'>";
echo "<input type='hidden' name='adic_desc_nino1' value='$l_sql_de[adic_nino1]'>";


// pregunta las edades ni�o regla 2


for($az=1;$az<=10;$az++){

if($az <= $cta_cps){
echo "<div style='display:block;margin-left:10px;margin-bottom:10px' id='edad_nino1_$az'>Edad del ni�o $az: 
<select name='ed_nn1_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

}else{ //if($az <= $cta_cps){
echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_$az'>Edad del ni�o $az: 
<select name='ed_nn1_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

}//if($az <= $cta_cps){



for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

if($j != $ed_cps[$az]){
echo "<option >$j</option>";
}else{
echo "<option selected>$j</option>";
}

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";



}//for($az=1;$az<=10;$az++){


unset($ed_cps);


// fin pregunta las edades ni�o regla 2





}else{ //if($l_sql_de["nino1"]>0){

echo "<input type='hidden' name='nino1' value='0'>";

} //if($l_sql_de["nino1"]>0){

if($l_sql_de["edad_nino1_2"]!=""){


$sql_cps = mysql_query("select * from edad_pasajeros where idd_carga_ep='$_GET[id_venta]' and tipo_pasajero_ep='Menor cat. 3'");
$cta_cps = mysql_num_rows($sql_cps);

echo "<input type='hidden' name='menor3_antes' value='$cta_cps'>";

for($v=1;$v<=$cta_cps;$v++){
$lee_cps = mysql_fetch_assoc($sql_cps);

$ed_cps[$v] = $lee_cps["edad_ep"];



}//for($v=1;$v<=$cta_cps;$v++){


echo "Ni�os de $l_sql_de[edad_nino2_1] a $l_sql_de[edad_nino2_2] a�os: 
     <select name='nino2' onChange='muestra_nino2(document.cave.nino2.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
if($u == $cta_cps){
echo "<option value='$u' selected >$u</option>";	 
}else{
echo "<option value='$u' >$u</option>";	 
}	 	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_nino2' value='$l_sql_de[nino2]'>";
echo "<input type='hidden' name='adic_desc_nino2' value='$l_sql_de[adic_nino2]'>";



// pregunta las edades ni�o regla 3





for($az=1;$az<=10;$az++){

if($az <= $cta_cps){
echo "<div style='display:block;margin-left:10px;margin-bottom:10px' id='edad_nino2_$az'>Edad del ni�o $az: 
<select name='ed_nn2_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

}else{ //if($az <= $cta_cps){
echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino2_$az'>Edad del ni�o $az: 
<select name='ed_nn2_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

}//if($az <= $cta_cps){



for($j=$l_sql_de["edad_nino1_2"];$j<=$l_sql_de["edad_nino2_2"];$j++){

if($j != $ed_cps[$az]){
echo "<option >$j</option>";
}else{
echo "<option selected>$j</option>";
}

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";


}//for($az=1;$az<=10;$az++){




unset($ed_cps);


// fin pregunta las edades ni�o regla 3










}else{ //if($l_sql_de["nino2"]>0){

echo "<input type='hidden' name='nino2' value='0'>";

} //if($l_sql_de["nino2"]>0){

if($l_sql_de["edad_senior1"]!=""){


$sql_cps = mysql_query("select * from edad_pasajeros where idd_carga_ep='$_GET[id_venta]' and tipo_pasajero_ep='Senior'");
$cta_cps = mysql_num_rows($sql_cps);

echo "<input type='hidden' name='senior_antes' value='$cta_cps'>";

for($v=1;$v<=$cta_cps;$v++){
$lee_cps = mysql_fetch_assoc($sql_cps);

$ed_cps[$v] = $lee_cps["edad_ep"];



}//for($v=1;$v<=$cta_cps;$v++){


echo "Mayores de edad de $l_sql_de[edad_senior1] a $l_sql_de[edad_senior2] a�os: 
     <select name='senior' onChange='muestra_senior(document.cave.senior.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
if($u == $cta_cps){
echo "<option value='$u' selected >$u</option>";	 
}else{
echo "<option value='$u' >$u</option>";	 
} 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";

echo "<input type='hidden' name='num_senior' value='$l_sql_de[senior]'>";
echo "<input type='hidden' name='adic_desc_senior' value='$l_sql_de[adic_senior]'>";


// pregunta las edades senior

for($az=1;$az<=10;$az++){

if($az <= $cta_cps){
echo "<div style='display:block;margin-left:10px;margin-bottom:10px' id='edad_senior_$az'>Edad del senior $az: 
<select name='ed_se_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";
}else{ //if($az <= $cta_cps){
echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_$az'>Edad del senior $az: 
<select name='ed_se_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

}//if($az <= $cta_cps){




for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

if($j != $ed_cps[$az]){
echo "<option >$j</option>";
}else{
echo "<option selected>$j</option>";
}

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";


} //for($az=1;$az<=10;$az++){

unset($ed_cps);


// fin pregunta las edades senior



} else { //if($l_sql_de["senior"]>0){

echo "<input type='hidden' name='senior' value='0'>";

} //if($l_sql_de["senior"]>0){



}//for($d=1;$d<=$cta_sql_de;$d++){


###############adicionales
###############adicionales

$sql_ad = mysql_query("select * from adicionales where idd_sub2 = '$_GET[id]' ");
$cta_ad = mysql_num_rows($sql_ad);

if($cta_ad > 0){



echo "<div class='titulo'>Servicios adicionales:</div>";

echo "<div class='textos'>"; //wsxwsx

for($i=1;$i<=$cta_ad;$i++){

$lee_ad = mysql_fetch_assoc($sql_ad);


//busca los de la reserva
//busca los de la reserva

$bad = mysql_query("select * from ventas_adicionales where idd_carga_va = '$_GET[id_venta]' and idd_ad_va='$lee_ad[id_adicional]'");


$c_bad = mysql_num_rows($bad);

if($c_bad > 0){
$check_ad = "checked";
}else{//if($c_bad > 0){
$check_ad = "";
}//if($c_bad > 0){

//fin busca los de la reserva
//fin busca los de la reserva



echo "<div style='border: 1px solid #ccc;padding:5px;margin-top:2px'>
      <div style='width:350px;float:left'><b>$lee_ad[nombre_ad] </b></div>
      <div style='width:100px;float:left'><b>$$lee_ad[precio_ad] </b></div>
	  <div style='width:100px;float:left'>Incluir: <input type='checkbox' name='ad$lee_ad[id_adicional]' $check_ad ></div>
	  <div style='clear:both'></div>";


	  
if($lee_ad["r1"] != "" && $lee_ad["rr1"] != ""){	  

echo "<div style='width:335px;float:left;margin-left:15px'>Personas de $lee_ad[r1] a $lee_ad[rr1] a�os</div>
      <div style='width:100px;float:left'><b>$$lee_ad[ad1] </b></div>
	  <div style='clear:both'></div>";	 

}//if($lee_ad["r1"] != "" && $lee_ad["rr1"] != ""){


if($lee_ad["r2"] != "" && $lee_ad["rr2"] != ""){	  

echo "<div style='width:335px;float:left;margin-left:15px'>Personas de $lee_ad[r2] a $lee_ad[rr2] a�os</div>
      <div style='width:100px;float:left'><b>$$lee_ad[ad2] </b></div>
	  <div style='clear:both'></div>";	 

}//if($lee_ad["r2"] != "" && $lee_ad["rr2"] != ""){	

if($lee_ad["r3"] != "" && $lee_ad["rr3"] != ""){	  

echo "<div style='width:335px;float:left;margin-left:15px'>Personas de $lee_ad[r3] a $lee_ad[rr3] a�os</div>
      <div style='width:100px;float:left'><b>$$lee_ad[ad3] </b></div>
	  <div style='clear:both'></div>";	 

}//if($lee_ad["r3"] != "" && $lee_ad["rr3"] != ""){


if($lee_ad["r4"] != "" && $lee_ad["rr4"] != ""){	  

echo "<div style='width:335px;float:left;margin-left:15px'>Personas de $lee_ad[r4] a $lee_ad[rr4] a�os</div>
      <div style='width:100px;float:left'><b>$$lee_ad[ad4] </b></div>
	  <div style='clear:both'></div>";	 

}//if($lee_ad["r4"] != "" && $lee_ad["rr4"] != ""){  	  


if($lee_ad["r5"] != "" && $lee_ad["rr5"] != ""){	  

echo "<div style='width:335px;float:left;margin-left:15px'>Personas de $lee_ad[r5] a $lee_ad[rr5] a�os</div>
      <div style='width:100px;float:left'><b>$$lee_ad[ad5] </b></div>
	  <div style='clear:both'></div>";	 

}//if($lee_ad["r5"] != "" && $lee_ad["rr5"] != ""){

	 
echo "$lee_ad[texto_ad] 
	  </div>
     ";

}//for($i=1;$i<=$cta_ad;$i++){



echo "</div>"; //wsxwsx




} //if($cta_ad > 0){

###############fin adicionales
###############fin adicionales


####//// REGLAS

$sql_re = mysql_query("select * from reglas where idd_sub2_reglas='$_GET[id]'");
$l_re = mysql_fetch_assoc($sql_re);

echo "<div class='titulo'>Reglas y observaciones:</div>

<div class='textos'>
$l_re[texto_reglas]
</div>
";



####//// FIN REGLAS


echo "<br>
      <input type='hidden' name='tipo_descuento' value='$l_sql_de[tipo]'>
      <input type='hidden' name='id_empresa' value='$id_empresa'>
      <input type='hidden' name='clave_categoria' value='$clave_categoria'>
      <input type='submit' value='Comprar' style='height:50px;cursor:pointer'>
      </form>";

echo "</div>"; //eeeeerew


?>

</div><!--   ttt -->







<div style="width:370px;float:left;padding:10px"> <!--   ttt111111111 -->




</div> <!--   ttt111111111 -->


<div style="clear:both"></div>

<?php
//include_once("pie.inc.php");
?>

<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "desde", "%d/%m/%Y");
      cal.manageFields("f_btn2", "hasta", "%d/%m/%Y");
      

    //]]></script>


<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="javascript:history.go(-1)"><img src="utilidades/imagenes/bot_volver.png" title="Volver al panel"></a></div>	
	

                                                         </div>




</body>
</html>
