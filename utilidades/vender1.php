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
<title>ARTICULOS</title>

<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>

<script>

function paso11(){
if (document.paso1.categoria.value.length==0){
alert("debe elegir una opcion");
document.paso1.categoria.focus();

return 0;
}//if (document.goal.cuerpo.value.length==0){

document.paso1.submit();

} //function paso11(){


function paso22(){
if (document.paso2.subcategoria_1.value.length==0){
alert("debe elegir una opcion");
document.paso2.subcategoria_1.focus();

return 0;
}//if (document.goal.cuerpo.value.length==0){

document.paso2.submit();

} //function paso11(){


</script>

</head>

<body>

<div class="global" >

<?php

include_once("encabezado.inc.php");

?>

<div style="padding:10px">


<?php

$sql1 = mysql_query("select * from subcategoria_2 where clave = '$_GET[id]'");
$lee1 = mysql_fetch_assoc($sql1);

$id_empresa = $lee1["idd_empresa_sub2"];
$clave_categoria = $lee1["clave_categoria_s2"];


echo "<div class='titulo'>Comprar:</div>";

echo "<div class='textos'>"; //eeeeerew

echo "<form method='post' action='paso1.php?id=$_GET[id]'>";


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


echo "Adultos: 
     <select name='adulto'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";	 

$sql_de = mysql_query("select * from descuento_edad where idd_sub2='$_GET[id]' ");
$cta_sql_de = mysql_num_rows($sql_de);


for($d=1;$d<=$cta_sql_de;$d++){
$l_sql_de = mysql_fetch_assoc($sql_de);

if($l_sql_de["bebe"]>0){

echo "Bebe's de $l_sql_de[edad_bebe1] a $l_sql_de[edad_bebe2] a�os: 
     <select name='bebe'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_bebe' value='$l_sql_de[bebe]'>";
echo "<input type='hidden' name='adic_desc_bebe' value='$l_sql_de[adic_bebe]'>";
}else{ //if($l_sql_de["bebe"]>0){

echo "<input type='hidden' name='bebe' value='0'>";

}// //if($l_sql_de["bebe"]>0){



if($l_sql_de["nino"]>0){

echo "Ni�os de $l_sql_de[edad_nino1] a $l_sql_de[edad_nino2] a�os: 
     <select name='nino'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_nino' value='$l_sql_de[nino]'>";
echo "<input type='hidden' name='adic_desc_nino' value='$l_sql_de[adic_nino]'>";

}else{ //if($l_sql_de["nino"]>0){

echo "<input type='hidden' name='nino' value='0'>";

} //if($l_sql_de["nino"]>0){




if($l_sql_de["nino1"]>0){


echo "Ni�os de $l_sql_de[edad_nino1_1] a $l_sql_de[edad_nino1_2] a�os: 
     <select name='nino1'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";

echo "<input type='hidden' name='num_nino1' value='$l_sql_de[nino1]'>";
echo "<input type='hidden' name='adic_desc_nino1' value='$l_sql_de[adic_nino1]'>";

}else{ //if($l_sql_de["nino1"]>0){

echo "<input type='hidden' name='nino1' value='0'>";

} //if($l_sql_de["nino1"]>0){

if($l_sql_de["nino2"]>0){


echo "Ni�os de $l_sql_de[edad_nino2_1] a $l_sql_de[edad_nino2_2] a�os: 
     <select name='nino2'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_nino2' value='$l_sql_de[nino2]'>";
echo "<input type='hidden' name='adic_desc_nino2' value='$l_sql_de[adic_nino2]'>";
}else{ //if($l_sql_de["nino2"]>0){

echo "<input type='hidden' name='nino2' value='0'>";

} //if($l_sql_de["nino2"]>0){

if($l_sql_de["senior"]>0){


echo "Mayores de edad de $l_sql_de[edad_senior1] a $l_sql_de[edad_senior2] a�os: 
     <select name='senior'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";

echo "<input type='hidden' name='num_senior' value='$l_sql_de[senior]'>";
echo "<input type='hidden' name='adic_desc_senior' value='$l_sql_de[adic_senior]'>";

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
	  <div style='clear:both'></div>
	  $lee_ad[texto_ad] 
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
      <input type='hidden' name='id_empresa' value='$id_empresa'>
      <input type='hidden' name='clave_categoria' value='$clave_categoria'>
      <input type='submit' value='Comprar' style='height:50px;cursor:pointer'>
      </form>";

echo "</div>"; //eeeeerew


?>





</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
