<?php
include_once("conexion.inc.php");

$voucher1 = "no";

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if(isset($_GET["escribano"])){

$texto = $_GET["elm1"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);
$texto = nl2br($texto);

$texto1 = stripslashes( $texto );


if($_GET["voucher"]=="si"){

mysql_query("UPDATE voucher SET texto_1_vo='$texto1' where idd_ventas_vo='$_GET[id]' ");
mysql_query("UPDATE ventas SET voucher_vs='si' where id_ventas='$_GET[id]'");

}else{ //if($_GET["voucher"]=="si"){

//verifica q no haya ya un vouche cargado por si acaso

$con_vou = mysql_query("select * from voucher where idd_ventas_vo='$_GET[id]'");
$cta_con_vou = mysql_num_rows($con_vou);

//verifica q no haya ya un vouche cargado por si acaso

if($cta_con_vou < 1){

$emision = time();

mysql_query("INSERT INTO voucher (idd_ventas_vo,texto_1_vo,emision_vo) VALUES ('$_GET[id]','$texto1','$emision') ");
mysql_query("UPDATE ventas SET voucher_vs='si' where id_ventas='$_GET[id]'");

$voucher1 = "si";

}else{ //if($cta_con_vou < 1){

mysql_query("UPDATE voucher SET texto_1_vo='$texto1' where idd_ventas_vo='$_GET[id]' ");
mysql_query("UPDATE ventas SET voucher_vs='si' where id_ventas='$_GET[id]'");


} //if($cta_con_vou < 1){


} //if($_GET["voucher"]=="si"){

}//if(isset($GET["escribano"])){



?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>VOUCHER</title>

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
if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado_vendedor.inc.php");

}else{ //if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado.inc.php");

} //if($_SESSION["tipo"]=="vendedor"){
?>

<div style="padding:10px">




<?php

if($voucher1 =="no"){

if(isset($_GET["voucher"])){
$voucher= $_GET["voucher"];
}else{ //if(isset($_GET["voucher"])){
$voucher = "si";
} //if(isset($_GET["voucher"])){

}else{ //if($voucher1 =="no"){

$voucher = "si";

}//if($voucher1 =="no"){


if($voucher=="no"){

$sql_tex = mysql_query("select * from reglas where idd_sub2_reglas='$_GET[id_sub2]'");
$cta_tex = mysql_num_rows($sql_tex);

if($cta_tex > 0){

$l_text = mysql_fetch_assoc($sql_tex);

$texto = $l_text["texto_reglas"];

}else{//if($cta_text > 0){


$texto = "";

}////if($cta_text > 0){

$num_voucher = "";

}else{ //if($voucher=="no"){

$sql_vo = mysql_query("select * from voucher where idd_ventas_vo='$_GET[id]'");
$lee_vo = mysql_fetch_assoc($sql_vo);

$texto = $lee_vo["texto_1_vo"];

$num_voucher = $lee_vo["id_voucher_vo"];

} //if($voucher=="no"){


if(isset($_GET["mando_mail"])){

echo "<div style='text-align:center;height:50px;line-height:50px;background-color:#70ea6a;color:#097904;font-size:12px'><b> MAIL ENVIADO  </b></div><br />";

}//if(isset()){

echo"
<h1>VOUCHER";

if($num_voucher != ""){

echo " Nro: ".$num_voucher;

} //if($num_voucher != ""){

echo "</h1><br>

<div>El resto de los datos ser�n obtenidos de los que fueron cargados en la venta</div><br><br>";

echo "<form method='get' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data' name='valida0'>";


echo "<div style='float:left;width:800px'>"; // eeeeddddeeeeeee

echo "<div style='width:70px;float:left'>Texto:<br></div>";
echo "<div style='width:500px;float:left'><textarea id='elm1' name='elm1' style='width:300px;height:80px' class='borde_nuevo'>$texto </textarea></div><div style='clear:both'></div><br>";


echo "<input type='hidden' name='id' value='$_GET[id]'>
      <input type='hidden' name='id_carga' value='$_GET[id_carga]'>
      <input type='hidden' name='id_sub2' value='$_GET[id_sub2]'>
      <input type='hidden' name='voucher' value='$voucher'>
	  <input type='hidden' name='escribano' value='ok'>
     ";
echo "<input type='submit' value=''   style='margin-left:200px;height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:40px;margin-bottom:40px;cursor:pointer' >";


echo "</form>";



echo "</div>"; // eeeeddddeeeeeee

if($voucher == "si"){

echo "<div style='float:left;width:200px;text-align:center'>"; // eeeeddddeeeeeee

echo "<form method='post' action='manda_mail_voucher.php' enctype='multipart/form-data' name='valida0'>";

$sql_id = mysql_query("select idd_carga_vs from ventas where id_ventas='$_GET[id]'");
$l_id = mysql_fetch_assoc($sql_id);

$sql_com = mysql_query("select * from pasajeros where idd_carga_p='$l_id[idd_carga_vs]' and tipo_p = 'comprador' ");

for($s=1;$s<=3;$s++){
$l_com = mysql_fetch_assoc($sql_com);
$dato[$s] = $l_com["campo2_p"];

}//for($s=1;$s<=3;$++){

echo "El voucher fu� generado para: <br> Nombre: $dato[1] $dato[2] <br>
      Mail: $dato[3] <br>
      ";


echo "<input type='hidden' name='id' value='$_GET[id]'>
      <input type='hidden' name='id_sub2' value='$_GET[id_sub2]'>
      <input type='hidden' name='id_carga' value='$_GET[id_carga]'>
      <input type='hidden' name='mail' value='$dato[3]'>
      <input type='hidden' name='voucher' value='$voucher'>
	  <input type='hidden' name='escribano_mail' value='ok'>
     ";
echo "<input type='submit' value=''   style='margin-left:0px;height:40px;width:180px;background-image:url(imagenes/bot_enviar.png);border:0px;margin-top:40px;margin-bottom:40px;cursor:pointer' >";


echo "</form><br>";

echo "<a href='../voucher_imprimir.php?id=$l_id[idd_carga_vs]&imprime=si' ><img src='../imagenes/imprimir.jpg' ></a>";


echo "</div>"; // eeeeddddeeeeeee


} //if($voucher == "si"){

echo "<div style='clear:both'></div>";

?>

</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
