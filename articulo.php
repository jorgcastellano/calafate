<?php
session_start();
include_once("encabezado.inc.php");


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
      $lee1[texto_sub2] <br><br>
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
echo "Descuento para ni�os de $l_sql_de[edad_nino1_2] a $l_sql_de[edad_nino2_2] a�os: % $l_sql_de[nino2] ";

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
echo "Descuento para ni�os de $l_sql_de[edad_nino1_2] a $l_sql_de[edad_nino2_2] a�os: $ $l_sql_de[nino2] ";

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

echo "<div class='titulo'>Comprar:</div>";

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




echo "<form method='post' action='paso1.php?id=$_GET[id]$clave_vendedor' name='cave'>";


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


echo "
<input style='width:100px' id='desde' name='desde' value='$f_desde' /><button id='f_btn1'>...</button> &nbsp; &nbsp; &nbsp; </div>";

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

      <select name='pickup'><option value='' selected></option>";

      $sql_pu = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and tipo_da='hora' order by nombre_da asc");
	  
	  $c_pu = mysql_num_rows($sql_pu);
	  
	  for($u=1;$u<=$c_pu;$u++){
	  
	  $l_pu = mysql_fetch_assoc($sql_pu);
	  
	  if($l_h["valor_iv"] == $l_pu["nombre_da"]){
	  echo "<option selected>$l_pu[nombre_da]</option>";
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



echo "Adultos: 
     <select name='adulto' onChange='muestra_adulto(document.cave.adulto.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=20;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";	 


// pregunta las edades adulto

for($az=1;$az<=20;$az++){


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_adulto_$az' >Edad del adulto $az: 
<select name='ed_ad_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

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




// fin pregunta las edades adulto







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
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_bebe' value='$l_sql_de[bebe]'>";
echo "<input type='hidden' name='adic_desc_bebe' value='$l_sql_de[adic_bebe]'>";


// pregunta las edades bebe

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_1'>Edad del bebe 1: 
<select name='ed_bb_1' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";


for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_2'>Edad del bebe 2: 
<select name='ed_bb_2' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_3'>Edad del bebe 3: 
<select name='ed_bb_3' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_4'>Edad del bebe 4: 
<select name='ed_bb_4' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_5'>Edad del bebe 5: 
<select name='ed_bb_5' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_6'>Edad del bebe 6: 
<select name='ed_bb_6' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_7'>Edad del bebe 7: 
<select name='ed_bb_7' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_8'>Edad del bebe 8: 
<select name='ed_bb_8' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_9'>Edad del bebe 9: 
<select name='ed_bb_9' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_bebe_10'>Edad del bebe 10: 
<select name='ed_bb_10' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_bebe1"];$j<=$l_sql_de["edad_bebe2"];$j++){

echo "</select>
<br></div>";



// fin pregunta las edades bebe


}else{ //if($l_sql_de["bebe"]>0){

echo "<input type='hidden' name='bebe' value='0'>";

}// //if($l_sql_de["bebe"]>0){



if($l_sql_de["edad_nino1"]!=""){

echo "Ni�os de $l_sql_de[edad_nino1] a $l_sql_de[edad_nino2] a�os: 
     <select name='nino' onChange='muestra_nino(document.cave.nino.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_nino' value='$l_sql_de[nino]'>";
echo "<input type='hidden' name='adic_desc_nino' value='$l_sql_de[adic_nino]'>";




// pregunta las edades ni�o regla 1

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_1'>Edad del ni�o 1: 
<select name='ed_nn_1' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_2'>Edad del ni�o 2: 
<select name='ed_nn_2' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_3'>Edad del ni�o 3: 
<select name='ed_nn_3' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_4'>Edad del ni�o 4: 
<select name='ed_nn_4' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_5'>Edad del ni�o 5: 
<select name='ed_nn_5' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_6'>Edad del ni�o 6: 
<select name='ed_nn_6' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_7'>Edad del ni�o 7: 
<select name='ed_nn_7' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_8'>Edad del ni�o 8: 
<select name='ed_nn_8' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_9'>Edad del ni�o 9: 
<select name='ed_nn_9' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino_10'>Edad del ni�o 10: 
<select name='ed_nn_10' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino1"];$j<=$l_sql_de["edad_nino2"];$j++){

echo "</select>
<br></div>";



// fin pregunta las edades ni�o regla 1








}else{ //if($l_sql_de["nino"]>0){

echo "<input type='hidden' name='nino' value='0'>";

} //if($l_sql_de["nino"]>0){




if($l_sql_de["edad_nino1_1"]!=""){


echo "Ni�os de $l_sql_de[edad_nino1_1] a $l_sql_de[edad_nino2_1] a�os: 
     <select name='nino1' onChange='muestra_nino1(document.cave.nino1.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";

echo "<input type='hidden' name='num_nino1' value='$l_sql_de[nino1]'>";
echo "<input type='hidden' name='adic_desc_nino1' value='$l_sql_de[adic_nino1]'>";


// pregunta las edades ni�o regla 2

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_1'>Edad del ni�o 1: 
<select name='ed_nn1_1' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_2'>Edad del ni�o 2: 
<select name='ed_nn1_2' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_3'>Edad del ni�o 3: 
<select name='ed_nn1_3' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_4'>Edad del ni�o 4: 
<select name='ed_nn1_4' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_5'>Edad del ni�o 5: 
<select name='ed_nn1_5' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_6'>Edad del ni�o 6: 
<select name='ed_nn1_6' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_7'>Edad del ni�o 7: 
<select name='ed_nn1_7' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_8'>Edad del ni�o 8: 
<select name='ed_nn1_8' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_9'>Edad del ni�o 9: 
<select name='ed_nn1_9' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino1_10'>Edad del ni�o 10: 
<select name='ed_nn1_10' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_nino1_1"];$j<=$l_sql_de["edad_nino2_1"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";



// fin pregunta las edades ni�o regla 2





}else{ //if($l_sql_de["nino1"]>0){

echo "<input type='hidden' name='nino1' value='0'>";

} //if($l_sql_de["nino1"]>0){

if($l_sql_de["edad_nino1_2"]!=""){


echo "Ni�os de $l_sql_de[edad_nino1_2] a $l_sql_de[edad_nino2_2] a�os: 
     <select name='nino2' onChange='muestra_nino2(document.cave.nino2.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_nino2' value='$l_sql_de[nino2]'>";
echo "<input type='hidden' name='adic_desc_nino2' value='$l_sql_de[adic_nino2]'>";



// pregunta las edades ni�o regla 3

for($az=1;$az<=10;$az++){

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_nino2_$az'>Edad del ni�o $az: 
<select name='ed_nn2_$az' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de[edad_nino1_2];$j<=$l_sql_de[edad_nino2_2];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_nino11"];$j<=$l_sql_de["edad_nino12"];$j++){

echo "</select>
<br></div>";

}//for($az=1;$az<=10;$az++){



// fin pregunta las edades ni�o regla 3










}else{ //if($l_sql_de["nino2"]>0){

echo "<input type='hidden' name='nino2' value='0'>";

} //if($l_sql_de["nino2"]>0){

if($l_sql_de["edad_senior1"]!=""){


echo "Mayores de edad de $l_sql_de[edad_senior1] a $l_sql_de[edad_senior2] a�os: 
     <select name='senior' onChange='muestra_senior(document.cave.senior.value)'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";

echo "<input type='hidden' name='num_senior' value='$l_sql_de[senior]'>";
echo "<input type='hidden' name='adic_desc_senior' value='$l_sql_de[adic_senior]'>";


// pregunta las edades senior

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_1'>Edad del senior 1: 
<select name='ed_se_1' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_2'>Edad del senior 2: 
<select name='ed_se_2' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_3'>Edad del senior 3: 
<select name='ed_se_3' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_4'>Edad del senior 4: 
<select name='ed_se_4' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_5'>Edad del senior 5: 
<select name='ed_se_5' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_6'>Edad del senior 6: 
<select name='ed_se_6' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_7'>Edad del senior 7: 
<select name='ed_se_7' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";


echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_8'>Edad del senior 8: 
<select name='ed_se_8' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_9'>Edad del senior 9: 
<select name='ed_se_9' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";

echo "<div style='display:none;margin-left:10px;margin-bottom:10px' id='edad_senior_10'>Edad del senior 10: 
<select name='ed_se_10' style='background-color:#a9d0fc;border:0px'><option value='' selected></option>";

for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "<option value='$j'>$j</option>";

}//for($j=$l_sql_de["edad_senior1"];$j<=$l_sql_de["edad_senior2"];$j++){

echo "</select>
<br></div>";



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

echo "<div style='border: 1px solid #ccc;padding:5px;margin-top:2px'>
      <div style='width:350px;float:left'><b>$lee_ad[nombre_ad] </b></div>
      <div style='width:100px;float:left'><b>$$lee_ad[precio_ad] </b></div>
	  <div style='width:100px;float:left'>Incluir: <input type='checkbox' name='ad$lee_ad[id_adicional]'></div>
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

<div id="gallery" style="width:370px"><!-- """""""""""""""" -->
<ul>
<?php

$sql = mysql_query("select * from fotos where clave_sub2_f='$_GET[id]' and publica_fotos='si' order by orden_foto asc ");
$cta = mysql_num_rows($sql);


for($s=1;$s<=$cta;$s++){
$lee = mysql_fetch_assoc($sql);

$partes = explode(".",$lee["foto"]);

//<img src='utilidades/$partes[0]-1.jpg' style='margin-right:7px;margin-bottom:7px;border:3px solid #777777' alt='' />
    echo "<li>
	
            <a href='utilidades/$partes[0].jpg' title='$lee[texto_foto]'>
                
				
				<div style='margin-right:12px;margin-bottom:12px;border:3px solid #2683bc;width:130px;height:130px;float:left;overflow:hidden'><img src='utilidades/$partes[0]-1.jpg' height='130' style='border:none'></div>
            </a>
         </li>";


}//for($s=1;$s<=$cta;$s++){
echo "<div style='clear:both'></div>";
?>

</ul>
</div><!-- """""""""""""""" -->


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
