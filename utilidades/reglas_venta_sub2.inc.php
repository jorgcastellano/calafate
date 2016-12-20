<?php

if(isset($_POST["escribano_rventa"])=="ok"){

if(isset($_POST["habilitar_anticipadas"])){
$habilitar_anticipadas = "on";
}else{ //if(isset($_POST["habilitar_anticipadas"])){
$habilitar_anticipadas = "";
} //if(isset($_POST["habilitar_anticipadas"])){

if(isset($_POST["habilitar_hora"])){
$habilitar_hora = "on";
}else{ //if(isset($_POST["habilitar_horas"])){
$habilitar_hora = "";
} //if(isset($_POST["habilitar_horas"])){



if($_POST["tiene_conte"]=="si"){
mysql_query("UPDATE reglas_venta SET hora_rventa='$_POST[hora]',anticipadas_rventa='$_POST[descuento]',dias_anticipadas_rventa='$_POST[dias]',idd_sub2_rventa='$_GET[clave_sub2]',habilitar_hora_rventa='$habilitar_hora',habilitar_anticipadas_rventa='$habilitar_anticipadas' where idd_sub2_rventa='$_GET[clave_sub2]' ");
}else{ //if($_POST["tiene_conte"]=="si"){
mysql_query("INSERT INTO reglas_venta (hora_rventa,anticipadas_rventa,dias_anticipadas_rventa,idd_sub2_rventa,habilitar_hora_rventa,habilitar_anticipadas_rventa) VALUES ('$_POST[hora]','$_POST[descuento]','$_POST[dias]','$_GET[clave_sub2]','$habilitar_hora','$habilitar_anticipadas')");
}//if($_POST["tiene_conte"]=="si"){


echo "<script>document.getElementById('9').style.display='block'</script>";

}//cierra if escribano


#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO


$sql1 = mysql_query("select * from reglas_venta where idd_sub2_rventa = '$_GET[clave_sub2]'");
$cta1 = mysql_num_rows($sql1);
$lee_sql1 = mysql_fetch_assoc($sql1);



echo "<form method='post' action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' enctype='multipart/form-data' name='valida5'>";


if($cta1 > 0){
$hora_venta = $lee_sql1["hora_rventa"];
$anticipadas = $lee_sql1["anticipadas_rventa"];
$tiene_conte = "si";
$dias_anticipadas = $lee_sql1["dias_anticipadas_rventa"];

if($lee_sql1["habilitar_hora_rventa"]=="on"){
$habilitar_hora = "checked";
}else{ //if($lee_sql1["habilitar_hora_rventa"]){
$habilitar_hora = "";
} //if($lee_sql1["habilitar_hora_rventa"]){

if($lee_sql1["habilitar_anticipadas_rventa"]=="on"){
$habilitar_anticipadas = "checked";
}else{ //if($lee_sql1["habilitar_anticipadas_rventa"]){
$habilitar_anticipadas = "";
} //if($lee_sql1["habilitar_anticipadas_rventa"]){

}else{ //if($cta1 > 0){

$hora_venta = "";
$anticipadas = "";
$tiene_conte = "no"; 
$habilitar_hora="";
$habilitar_anticipadas="";
$dias_anticipadas = $lee_sql1["dias_anticipadas_rventa"];
} //if($cta1 > 0){

echo "<div style='font-size:11px'>"; //-----------------gggggggggggg

echo "<div style='float:left;width:80px;height:30px;line-height:30px;text-align:center'><b>Activar</b></div>";

echo "<div style='float:left;width:250px;height:30px;line-height:30px'>&nbsp;  <b>Regla </b></div>";

echo "<div style='clear:both'></div>";


echo "<div style='float:left;width:80px;border: 1px solid #cccccc;height:30px;line-height:30px;text-align:center;margin-left:2px;margin-bottom:2px'><input type='checkbox' name='habilitar_hora' $habilitar_hora ></div>";

echo "<div style='float:left;width:250px;border: 1px solid #cccccc;height:30px;line-height:30px;margin-left:2px;margin-bottom:2px'>&nbsp;  Limitar horario de venta</div>";

echo "<div style='float:left;width:420px;border: 1px solid #cccccc;height:30px;line-height:30px;margin-left:2px;margin-bottom:2px'>&nbsp; Vender hasta <input type='text' name='hora' style='height:20px;width:20px' value='$hora_venta' > horas antes del inicio de la actividad</div>
<div style='clear:both'></div>
";

echo "<div style='float:left;width:80px;border: 1px solid #cccccc;height:30px;line-height:30px;text-align:center;margin-left:2px;margin-bottom:2px'><input type='checkbox' name='habilitar_anticipadas' $habilitar_anticipadas ></div>";

echo "<div style='float:left;width:250px;border: 1px solid #cccccc;height:30px;line-height:30px;margin-left:2px;margin-bottom:2px'>&nbsp;  Aplicar descuento en compras anticipadas</div>";

echo "<div style='float:left;width:420px;border: 1px solid #cccccc;height:30px;line-height:30px;margin-left:2px;margin-bottom:2px'>&nbsp; Aplicar <input type='text' name='descuento' style='height:20px;width:20px' value='$anticipadas'>  % de descuento al comprar <input type='text' name='dias' style='height:20px;width:20px' value='$dias_anticipadas' > dias antes del inicio de la actividad</div>
<div style='clear:both'></div>
";


echo "</div>"; //-----------------gggggggggggg

echo "<input type='hidden' name='clave_sub2' value='$_GET[clave_sub2]'>";
echo "<input type='hidden' name='tiene_conte' value='$tiene_conte'>";
echo "<input type='hidden' name='escribano_rventa' value='ok'>";
echo "<input type='button' onclick='validae()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >";



echo "</form>";


?>