<?php
//#######NUEVO CALCULO DE PRECIOS
//#######NUEVO CALCULO DE PRECIOS


//borra los viejos
//borra los viejos

mysql_query("DELETE from edad_pasajeros where idd_carga_ep='$id_carga'");

//borra los viejos
//borra los viejos


echo "<div style='width:620px;float:left'>"; //-----------------111111111111111111111111111

$precio_excur = $lee_ar["precio"];

echo "<input type='hidden' name='precio_excur' value='$precio_excur'>";

$total_final_final = 0;

//calcula precios por edad


//adultos

if($_POST["adulto"] > 0){

$precioadul =  $precio_excur;
$total_bb_excur = $precioadul * $_POST["adulto"];

for($y=1;$y<=$_POST["adulto"];$y++){

echo "
<div class='pas_col1'>
Pasajero categoria adulto | Costo del servicio sin adicionales
</div>


<div class='pas_col2'>
$ $precioadul .
</div>

<div style='clear:both'></div>

";



$edad_adic = $_POST["ed_ad_".$y];

//graba la edad del pasajero para el voucher
mysql_query("INSERT INTO edad_pasajeros (idd_carga_ep,tipo_pasajero_ep,edad_ep) VALUES ('$id_carga','Adulto','$edad_adic')");
//graba la edad del pasajero para el voucher


//busca q no se graben mas de una vez
//busca q no se graben mas de una vez

$ver_ep = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Adulto'");
$cp_ep = mysql_num_rows($ver_ep);

if($cp_ep > $_POST["adulto"]){

$dif_ep = $cp_ep - $_POST["adulto"];

$ver_ep1 = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Adulto' limit $_POST[adulto],$dif_ep");
$cp_ep1 = mysql_num_rows($ver_ep1);

for($ks=1;$ks<=$cp_ep1;$ks++){
$l_ver_ep1 = mysql_fetch_assoc($ver_ep1);

mysql_query("DELETE from edad_pasajeros where id_ep='$l_ver_ep1[id_ep]'");

}//for($ks=1;$ks<=$cp_ep1;$ks++){

} //if($cp_ep > $_POST["adulto"]){


//fin busca q no se graben mas de una vez
//fin busca q no se graben mas de una vez



//adicionales
//adicionales
$sub_total_adic = 0;

if($hay_adic == "si"){



for($x=1;$x<=10;$x++){



if($ad_si[$x]!=""){


$costo_adic = 0;

$edad_adic = $_POST["ed_ad_".$y];


//busca el rango de edad para este adicional


$b_adic1 = mysql_query("select nombre_ad,precio_ad,ad1 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r1 <= '$edad_adic' and rr1 >= '$edad_adic') ");





$cta_adic1 = mysql_num_rows($b_adic1);

if($cta_adic1 > 0){
$l_adic1 = mysql_fetch_assoc($b_adic1);

$costo_adic = $l_adic1["ad1"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic1[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div>
<div style='clear:both'></div>
";



}//if($cta_adic1 > 0){

$b_adic2 = mysql_query("select nombre_ad,ad2 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r2 <= '$edad_adic' and rr2 >= '$edad_adic') ");

$cta_adic2 = mysql_num_rows($b_adic2);

if($cta_adic2 > 0){
$l_adic2 = mysql_fetch_assoc($b_adic2);

$costo_adic = $l_adic2["ad2"];

echo "
<div class='adic_col1'>            
Edad: $edad_adic a�os | Adicional: $l_adic2[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic2 > 0){

$b_adic3 = mysql_query("select nombre_ad,ad3 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r3 <= '$edad_adic' and rr3 >= '$edad_adic') ");

$cta_adic3 = mysql_num_rows($b_adic3);

if($cta_adic3 > 0){
$l_adic3 = mysql_fetch_assoc($b_adic3);

$costo_adic = $l_adic3["ad3"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic3[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";

}//if($cta_adic3 > 0){


$b_adic4 = mysql_query("select nombre_ad,ad4 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r4 <= '$edad_adic' and rr4 >= '$edad_adic') ");

$cta_adic4 = mysql_num_rows($b_adic4);

if($cta_adic4 > 0){
$l_adic4 = mysql_fetch_assoc($b_adic4);

$costo_adic = $l_adic4["ad4"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic4[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic4 > 0){


$b_adic5 = mysql_query("select nombre_ad,ad5 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r5 <= '$edad_adic' and rr5 >= '$edad_adic') ");

$cta_adic5 = mysql_num_rows($b_adic5);

if($cta_adic5 > 0){
$l_adic5 = mysql_fetch_assoc($b_adic5);

$costo_adic = $l_adic5["ad5"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic1[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic5 > 0){


//en caso q no haya descuento por edad pone el precio fijo
//en caso q no haya descuento por edad pone el precio fijo

if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

$b_adic_base = mysql_query("select nombre_ad,precio_ad from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]'");
$l_adic_base = mysql_fetch_assoc($b_adic_base);

$costo_adic = $l_adic_base["precio_ad"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic_base[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

//fin en caso q no haya descuento por edad pone el precio fijo
//fin en caso q no haya descuento por edad pone el precio fijo




$sub_total_adic = $sub_total_adic + $costo_adic;



//busca el rango de edad para este adicional

}//if($ad_si[$x]!=""){


}//for($x=1;$x<=10;$x++){



$tot_este_pasajero = $sub_total_adic + $precioadul;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;



}else{//if($hay_adic == "si"){


$tot_este_pasajero = $sub_total_adic + $precioadul;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero ihhhh: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;




}//if($hay_adic == "si"){

//fin adicionales
//fin adicionales





}//for($y=1;$y<=$_POST["adulto"];$y++){

}//if($_POST["adulto"] > 0){

//fin adultos



//bebe


$tipo_descuento = $_POST["tipo_descuento"];

if($_POST["bebe"] > 0){


if($tipo_descuento == "porcentaje"){

$desc_bb = 100 - $_POST["num_bebe"];
$preciobb =  ($precio_excur / 100) * $desc_bb;

}else{ //if($tipo_descuento == "porcentaje"){

$preciobb =  $precio_excur - $_POST["num_bebe"];

}//if($tipo_descuento == "porcentaje"){

$total_bb_excur = $preciobb * $_POST["bebe"];

for($y=1;$y<=$_POST["bebe"];$y++){

echo "
<div class='pas_col1'>
Pasajero categoria Bebe | Costo del servicio sin adicionales
</div>


<div class='pas_col2'>
$ $preciobb .
</div>

<div style='clear:both'></div>

";

$sub_total_adic = 0;

$edad_adic = $_POST["ed_bb_".$y];

//graba la edad del pasajero para el voucher
mysql_query("INSERT INTO edad_pasajeros (idd_carga_ep,tipo_pasajero_ep,edad_ep) VALUES ('$id_carga','Bebe','$edad_adic')");
//graba la edad del pasajero para el voucher



//busca q no se graben mas de una vez
//busca q no se graben mas de una vez

$ver_ep = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Bebe'");
$cp_ep = mysql_num_rows($ver_ep);

if($cp_ep > $_POST["bebe"]){

$dif_ep = $cp_ep - $_POST["bebe"];

$ver_ep1 = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Bebe' limit $_POST[bebe],$dif_ep");
$cp_ep1 = mysql_num_rows($ver_ep1);

for($ks=1;$ks<=$cp_ep1;$ks++){
$l_ver_ep1 = mysql_fetch_assoc($ver_ep1);

mysql_query("DELETE from edad_pasajeros where id_ep='$l_ver_ep1[id_ep]'");

}//for($ks=1;$ks<=$cp_ep1;$ks++){

} //if($cp_ep > $_POST["bebe"]){


//fin busca q no se graben mas de una vez
//fin busca q no se graben mas de una vez




//adicionales
//adicionales

if($hay_adic == "si"){



for($x=1;$x<=10;$x++){



if($ad_si[$x]!=""){
//select ad1 from adicionales where idd_sub2 = '34' and id_adicional='20' and (r1 <= '1' and rr1 >= '1')

$costo_adic = 0;

$edad_adic = $_POST["ed_bb_".$y];



//echo $edad_adic." <---- edada adic<br>"; 

//busca el rango de edad para este adicional


$b_adic1 = mysql_query("select nombre_ad,precio_ad,ad1 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r1 <= '$edad_adic' and rr1 >= '$edad_adic') ");





$cta_adic1 = mysql_num_rows($b_adic1);

if($cta_adic1 > 0){
$l_adic1 = mysql_fetch_assoc($b_adic1);

$costo_adic = $l_adic1["ad1"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic1[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div>
<div style='clear:both'></div>
";



}//if($cta_adic1 > 0){

$b_adic2 = mysql_query("select nombre_ad,ad2 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r2 <= '$edad_adic' and rr2 >= '$edad_adic') ");

$cta_adic2 = mysql_num_rows($b_adic2);

if($cta_adic2 > 0){
$l_adic2 = mysql_fetch_assoc($b_adic2);

$costo_adic = $l_adic2["ad2"];

echo "
<div class='adic_col1'>            
Edad: $edad_adic a�os | Adicional: $l_adic2[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic2 > 0){

$b_adic3 = mysql_query("select nombre_ad,ad3 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r3 <= '$edad_adic' and rr3 >= '$edad_adic') ");

$cta_adic3 = mysql_num_rows($b_adic3);

if($cta_adic3 > 0){
$l_adic3 = mysql_fetch_assoc($b_adic3);

$costo_adic = $l_adic3["ad3"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic3[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";

}//if($cta_adic3 > 0){


$b_adic4 = mysql_query("select nombre_ad,ad4 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r4 <= '$edad_adic' and rr4 >= '$edad_adic') ");

$cta_adic4 = mysql_num_rows($b_adic4);

if($cta_adic4 > 0){
$l_adic4 = mysql_fetch_assoc($b_adic4);

$costo_adic = $l_adic4["ad4"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic4[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic4 > 0){


$b_adic5 = mysql_query("select nombre_ad,ad5 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r5 <= '$edad_adic' and rr5 >= '$edad_adic') ");

$cta_adic5 = mysql_num_rows($b_adic5);

if($cta_adic5 > 0){
$l_adic5 = mysql_fetch_assoc($b_adic5);

$costo_adic = $l_adic5["ad5"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic1[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic5 > 0){


//en caso q no haya descuento por edad pone el precio fijo
//en caso q no haya descuento por edad pone el precio fijo

if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

$b_adic_base = mysql_query("select nombre_ad,precio_ad from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]'");
$l_adic_base = mysql_fetch_assoc($b_adic_base);

$costo_adic = $l_adic_base["precio_ad"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic_base[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

//fin en caso q no haya descuento por edad pone el precio fijo
//fin en caso q no haya descuento por edad pone el precio fijo




$sub_total_adic = $sub_total_adic + $costo_adic;

//busca el rango de edad para este adicional

}//if($ad_si[$x]!=""){


}//for($x=1;$x<=10;$x++){



$tot_este_pasajero = $sub_total_adic + $preciobb;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;


}else{//if($hay_adic == "si"){


$tot_este_pasajero = $sub_total_adic + $preciobb;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;




}//if($hay_adic == "si"){

//fin adicionales
//fin adicionales




}//for($y=1;$y<=$_POST["bebe"];$y++){


}//if($_POST["bebe"] > 0){

//fin bebe









//nino

if($_POST["nino"] > 0){

if($tipo_descuento == "porcentaje"){

$desc_nn = 100 - $_POST["num_nino"];
$precionn =  ($precio_excur / 100) * $desc_nn;

}else{ //if($tipo_descuento == "porcentaje"){

$precionn =  $precio_excur - $_POST["num_nino"];

} //if($tipo_descuento == "porcentaje"){

$total_nn_excur = $precionn * $_POST["nino"];

for($y=1;$y<=$_POST["nino"];$y++){

echo "
<div class='pas_col1'>
Pasajero categoria Ni�o 1| Costo del servicio sin adicionales
</div>


<div class='pas_col2'>
$ $precionn .
</div>

<div style='clear:both'></div>

";


$edad_adic = $_POST["ed_nn_".$y];

//graba la edad del pasajero para el voucher
mysql_query("INSERT INTO edad_pasajeros (idd_carga_ep,tipo_pasajero_ep,edad_ep) VALUES ('$id_carga','Menor cat. 1','$edad_adic')");
//graba la edad del pasajero para el voucher


//busca q no se graben mas de una vez
//busca q no se graben mas de una vez

$ver_ep = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Menor cat. 1'");
$cp_ep = mysql_num_rows($ver_ep);

if($cp_ep > $_POST["nino"]){

$dif_ep = $cp_ep - $_POST["nino"];

$ver_ep1 = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Menor cat. 1' limit $_POST[nino],$dif_ep");
$cp_ep1 = mysql_num_rows($ver_ep1);

for($ks=1;$ks<=$cp_ep1;$ks++){
$l_ver_ep1 = mysql_fetch_assoc($ver_ep1);

mysql_query("DELETE from edad_pasajeros where id_ep='$l_ver_ep1[id_ep]'");

}//for($ks=1;$ks<=$cp_ep1;$ks++){

} //if($cp_ep > $_POST["nino"]){


//fin busca q no se graben mas de una vez
//fin busca q no se graben mas de una vez



//adicionales
//adicionales
$sub_total_adic = 0;

if($hay_adic == "si"){



for($x=1;$x<=10;$x++){



if($ad_si[$x]!=""){
//select ad1 from adicionales where idd_sub2 = '34' and id_adicional='20' and (r1 <= '1' and rr1 >= '1')

$costo_adic = 0;

$edad_adic = $_POST["ed_nn_".$y];


//echo $edad_adic." <---- edada adic<br>"; 

//busca el rango de edad para este adicional

$b_adic1 = mysql_query("select nombre_ad,precio_ad,ad1 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r1 <= '$edad_adic' and rr1 >= '$edad_adic') ");

$cta_adic1 = mysql_num_rows($b_adic1);



if($cta_adic1 > 0){
$l_adic1 = mysql_fetch_assoc($b_adic1);

$costo_adic = $l_adic1["ad1"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic1[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div>
<div style='clear:both'></div>
";



}//if($cta_adic1 > 0){

$b_adic2 = mysql_query("select nombre_ad,ad2 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r2 <= '$edad_adic' and rr2 >= '$edad_adic') ");

$cta_adic2 = mysql_num_rows($b_adic2);

if($cta_adic2 > 0){
$l_adic2 = mysql_fetch_assoc($b_adic2);

$costo_adic = $l_adic2["ad2"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic2[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic2 > 0){

$b_adic3 = mysql_query("select nombre_ad,ad3 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r3 <= '$edad_adic' and rr3 >= '$edad_adic') ");

$cta_adic3 = mysql_num_rows($b_adic3);

if($cta_adic3 > 0){
$l_adic3 = mysql_fetch_assoc($b_adic3);

$costo_adic = $l_adic3["ad3"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic3[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";

}//if($cta_adic3 > 0){


$b_adic4 = mysql_query("select nombre_ad,ad4 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r4 <= '$edad_adic' and rr4 >= '$edad_adic') ");

$cta_adic4 = mysql_num_rows($b_adic4);

if($cta_adic4 > 0){
$l_adic4 = mysql_fetch_assoc($b_adic4);

$costo_adic = $l_adic4["ad4"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic4[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic4 > 0){


$b_adic5 = mysql_query("select nombre_ad,ad5 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r5 <= '$edad_adic' and rr5 >= '$edad_adic') ");

$cta_adic5 = mysql_num_rows($b_adic5);

if($cta_adic5 > 0){
$l_adic5 = mysql_fetch_assoc($b_adic5);

$costo_adic = $l_adic5["ad5"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic5[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic5 > 0){



//en caso q no haya descuento por edad pone el precio fijo
//en caso q no haya descuento por edad pone el precio fijo

if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

$b_adic_base = mysql_query("select nombre_ad,precio_ad from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]'");
$l_adic_base = mysql_fetch_assoc($b_adic_base);

$costo_adic = $l_adic_base["precio_ad"];



echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic_base[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

//fin en caso q no haya descuento por edad pone el precio fijo
//fin en caso q no haya descuento por edad pone el precio fijo


$sub_total_adic = $sub_total_adic + $costo_adic;

//busca el rango de edad para este adicional

}//if($ad_si[$x]!=""){


}//for($x=1;$x<=10;$x++){



$tot_este_pasajero = $sub_total_adic + $precionn;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;



}else{//if($hay_adic == "si"){


$tot_este_pasajero = $sub_total_adic + $precionn;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;




}//if($hay_adic == "si"){

//fin adicionales
//fin adicionales



}//for($y=1;$y<=$_POST["nino"];$y++){


}//if($_POST["nino"] > 0){

//fin nino





//nino1

if($_POST["nino1"] > 0){


if($tipo_descuento == "porcentaje"){

$desc_nn1 = 100 - $_POST["num_nino1"];
$precionn1 =  ($precio_excur / 100) * $desc_nn1;

}else{ //if($tipo_descuento == "porcentaje"){

$precionn1 =  $precio_excur - $_POST["num_nino1"];

} //if($tipo_descuento == "porcentaje"){



$total_nn1_excur = $precionn1 * $_POST["nino1"];

for($y=1;$y<=$_POST["nino1"];$y++){

echo "
<div class='pas_col1'>
Pasajero categoria Ni�o 2| Costo del servicio sin adicionales
</div>


<div class='pas_col2'>
$ $precionn1 .
</div>

<div style='clear:both'></div>

";


$edad_adic = $_POST["ed_nn1_".$y];


//graba la edad del pasajero para el voucher
mysql_query("INSERT INTO edad_pasajeros (idd_carga_ep,tipo_pasajero_ep,edad_ep) VALUES ('$id_carga','Menor cat. 2','$edad_adic')");
//graba la edad del pasajero para el voucher



//busca q no se graben mas de una vez
//busca q no se graben mas de una vez

$ver_ep = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Menor cat. 2'");
$cp_ep = mysql_num_rows($ver_ep);

if($cp_ep > $_POST["nino1"]){

$dif_ep = $cp_ep - $_POST["nino1"];

$ver_ep1 = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Menor cat. 2' limit $_POST[nino1],$dif_ep");
$cp_ep1 = mysql_num_rows($ver_ep1);

for($ks=1;$ks<=$cp_ep1;$ks++){
$l_ver_ep1 = mysql_fetch_assoc($ver_ep1);

mysql_query("DELETE from edad_pasajeros where id_ep='$l_ver_ep1[id_ep]'");

}//for($ks=1;$ks<=$cp_ep1;$ks++){

} //if($cp_ep > $_POST["nino1"]){


//fin busca q no se graben mas de una vez
//fin busca q no se graben mas de una vez




//adicionales
//adicionales
$sub_total_adic = 0;

if($hay_adic == "si"){



for($x=1;$x<=10;$x++){



if($ad_si[$x]!=""){
//select ad1 from adicionales where idd_sub2 = '34' and id_adicional='20' and (r1 <= '1' and rr1 >= '1')

$costo_adic = 0;

$edad_adic = $_POST["ed_nn1_".$y];



//echo $edad_adic." <---- edada adic<br>"; 

//busca el rango de edad para este adicional

$b_adic1 = mysql_query("select nombre_ad,precio_ad,ad1 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r1 <= '$edad_adic' and rr1 >= '$edad_adic') ");

$cta_adic1 = mysql_num_rows($b_adic1);

if($cta_adic1 > 0){
$l_adic1 = mysql_fetch_assoc($b_adic1);

$costo_adic = $l_adic1["ad1"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic1[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div>
<div style='clear:both'></div>
";



}//if($cta_adic1 > 0){

$b_adic2 = mysql_query("select nombre_ad,ad2 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r2 <= '$edad_adic' and rr2 >= '$edad_adic') ");

$cta_adic2 = mysql_num_rows($b_adic2);

if($cta_adic2 > 0){
$l_adic2 = mysql_fetch_assoc($b_adic2);

$costo_adic = $l_adic2["ad2"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic2[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic2 > 0){

$b_adic3 = mysql_query("select nombre_ad,ad3 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r3 <= '$edad_adic' and rr3 >= '$edad_adic') ");

$cta_adic3 = mysql_num_rows($b_adic3);

if($cta_adic3 > 0){
$l_adic3 = mysql_fetch_assoc($b_adic3);

$costo_adic = $l_adic3["ad3"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic3[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";

}//if($cta_adic3 > 0){


$b_adic4 = mysql_query("select nombre_ad,ad4 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r4 <= '$edad_adic' and rr4 >= '$edad_adic') ");

$cta_adic4 = mysql_num_rows($b_adic4);

if($cta_adic4 > 0){
$l_adic4 = mysql_fetch_assoc($b_adic4);

$costo_adic = $l_adic4["ad4"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic4[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic4 > 0){


$b_adic5 = mysql_query("select nombre_ad,ad5 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r5 <= '$edad_adic' and rr5 >= '$edad_adic') ");

$cta_adic5 = mysql_num_rows($b_adic5);

if($cta_adic5 > 0){
$l_adic5 = mysql_fetch_assoc($b_adic5);

$costo_adic = $l_adic5["ad5"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic5[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic5 > 0){


//en caso q no haya descuento por edad pone el precio fijo
//en caso q no haya descuento por edad pone el precio fijo

if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

$b_adic_base = mysql_query("select nombre_ad,precio_ad from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]'");
$l_adic_base = mysql_fetch_assoc($b_adic_base);

$costo_adic = $l_adic_base["precio_ad"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic_base[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

//fin en caso q no haya descuento por edad pone el precio fijo
//fin en caso q no haya descuento por edad pone el precio fijo


$sub_total_adic = $sub_total_adic + $costo_adic;

//busca el rango de edad para este adicional

}//if($ad_si[$x]!=""){


}//for($x=1;$x<=10;$x++){



$tot_este_pasajero = $sub_total_adic + $precionn1;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;



}else{//if($hay_adic == "si"){


$tot_este_pasajero = $sub_total_adic + $precionn1;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;




}//if($hay_adic == "si"){

//fin adicionales
//fin adicionales



}//for($y=1;$y<=$_POST["nino1"];$y++){


}//if($_POST["nino1"] > 0){

//fin nino1







//nino2

if($_POST["nino2"] > 0){


if($tipo_descuento == "porcentaje"){

$desc_nn2 = 100 - $_POST["num_nino2"];
$precionn2 =  ($precio_excur / 100) * $desc_nn2;

}else{ //if($tipo_descuento == "porcentaje"){

$precionn2 =  $precio_excur - $_POST["num_nino2"];

} //if($tipo_descuento == "porcentaje"){



$total_nn2_excur = $precionn2 * $_POST["nino2"];

for($y=1;$y<=$_POST["nino2"];$y++){

echo "
<div class='pas_col1'>
Pasajero categoria Ni�o 3| Costo del servicio sin adicionales
</div>


<div class='pas_col2'>
$ $precionn2 .
</div>

<div style='clear:both'></div>

";


$edad_adic = $_POST["ed_nn2_".$y];

//graba la edad del pasajero para el voucher
mysql_query("INSERT INTO edad_pasajeros (idd_carga_ep,tipo_pasajero_ep,edad_ep) VALUES ('$id_carga','Menor cat. 3','$edad_adic')");
//graba la edad del pasajero para el voucher


//busca q no se graben mas de una vez
//busca q no se graben mas de una vez

$ver_ep = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Menor cat. 3'");
$cp_ep = mysql_num_rows($ver_ep);

if($cp_ep > $_POST["nino2"]){

$dif_ep = $cp_ep - $_POST["nino2"];

$ver_ep1 = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Menor cat. 3' limit $_POST[nino2],$dif_ep");
$cp_ep1 = mysql_num_rows($ver_ep1);

for($ks=1;$ks<=$cp_ep1;$ks++){
$l_ver_ep1 = mysql_fetch_assoc($ver_ep1);

mysql_query("DELETE from edad_pasajeros where id_ep='$l_ver_ep1[id_ep]'");

}//for($ks=1;$ks<=$cp_ep1;$ks++){

} //if($cp_ep > $_POST["nino2"]){


//fin busca q no se graben mas de una vez
//fin busca q no se graben mas de una vez




//adicionales
//adicionales
$sub_total_adic = 0;

if($hay_adic == "si"){



for($x=1;$x<=10;$x++){



if($ad_si[$x]!=""){
//select ad1 from adicionales where idd_sub2 = '34' and id_adicional='20' and (r1 <= '1' and rr1 >= '1')

$costo_adic = 0;

$edad_adic = $_POST["ed_nn2_".$y];


//echo $edad_adic." <---- edada adic<br>"; 

//busca el rango de edad para este adicional

$b_adic1 = mysql_query("select nombre_ad,precio_ad,ad1 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r1 <= '$edad_adic' and rr1 >= '$edad_adic') ");

$cta_adic1 = mysql_num_rows($b_adic1);

if($cta_adic1 > 0){
$l_adic1 = mysql_fetch_assoc($b_adic1);

$costo_adic = $l_adic1["ad1"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic1[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div>
<div style='clear:both'></div>
";



}//if($cta_adic1 > 0){

$b_adic2 = mysql_query("select nombre_ad,ad2 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r2 <= '$edad_adic' and rr2 >= '$edad_adic') ");

$cta_adic2 = mysql_num_rows($b_adic2);

if($cta_adic2 > 0){
$l_adic2 = mysql_fetch_assoc($b_adic2);

$costo_adic = $l_adic2["ad2"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic2[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic2 > 0){

$b_adic3 = mysql_query("select nombre_ad,ad3 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r3 <= '$edad_adic' and rr3 >= '$edad_adic') ");

$cta_adic3 = mysql_num_rows($b_adic3);

if($cta_adic3 > 0){
$l_adic3 = mysql_fetch_assoc($b_adic3);

$costo_adic = $l_adic3["ad3"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic3[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";

}//if($cta_adic3 > 0){


$b_adic4 = mysql_query("select nombre_ad,ad4 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r4 <= '$edad_adic' and rr4 >= '$edad_adic') ");

$cta_adic4 = mysql_num_rows($b_adic4);

if($cta_adic4 > 0){
$l_adic4 = mysql_fetch_assoc($b_adic4);

$costo_adic = $l_adic4["ad4"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic4[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic4 > 0){


$b_adic5 = mysql_query("select nombre_ad,ad5 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r5 <= '$edad_adic' and rr5 >= '$edad_adic') ");

$cta_adic5 = mysql_num_rows($b_adic5);

if($cta_adic5 > 0){
$l_adic5 = mysql_fetch_assoc($b_adic5);

$costo_adic = $l_adic5["ad5"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic5[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic5 > 0){


//en caso q no haya descuento por edad pone el precio fijo
//en caso q no haya descuento por edad pone el precio fijo

if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

$b_adic_base = mysql_query("select nombre_ad,precio_ad from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]'");
$l_adic_base = mysql_fetch_assoc($b_adic_base);

$costo_adic = $l_adic_base["precio_ad"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic_base[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

//fin en caso q no haya descuento por edad pone el precio fijo
//fin en caso q no haya descuento por edad pone el precio fijo



$sub_total_adic = $sub_total_adic + $costo_adic;

//busca el rango de edad para este adicional

}//if($ad_si[$x]!=""){


}//for($x=1;$x<=10;$x++){


$tot_este_pasajero = $sub_total_adic + $precionn2;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;


}else{//if($hay_adic == "si"){


$tot_este_pasajero = $sub_total_adic + $precionn2;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;




}//if($hay_adic == "si"){

//fin adicionales
//fin adicionales



}//for($y=1;$y<=$_POST["nino2"];$y++){


}//if($_POST["nino2"] > 0){

//fin nino2






//senior

if($_POST["senior"] > 0){



if($tipo_descuento == "porcentaje"){

$desc_se = 100 - $_POST["num_senior"];
$preciose =  ($precio_excur / 100) * $desc_se;

}else{ //if($tipo_descuento == "porcentaje"){

$preciose =  $precio_excur - $_POST["num_senior"];

} //if($tipo_descuento == "porcentaje"){


$total_se_excur = $preciose * $_POST["senior"];

for($y=1;$y<=$_POST["senior"];$y++){

echo "
<div class='pas_col1'>
Pasajero categoria Senior| Costo del servicio sin adicionales
</div>


<div class='pas_col2'>
$ $preciose .
</div>

<div style='clear:both'></div>

";


$edad_adic = $_POST["ed_se_".$y];

//graba la edad del pasajero para el voucher
mysql_query("INSERT INTO edad_pasajeros (idd_carga_ep,tipo_pasajero_ep,edad_ep) VALUES ('$id_carga','Senior','$edad_adic')");
//graba la edad del pasajero para el voucher


//busca q no se graben mas de una vez
//busca q no se graben mas de una vez

$ver_ep = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Senior'");
$cp_ep = mysql_num_rows($ver_ep);

if($cp_ep > $_POST["senior"]){

$dif_ep = $cp_ep - $_POST["senior"];

$ver_ep1 = mysql_query("select * from edad_pasajeros where idd_carga_ep='$id_carga' and tipo_pasajero_ep ='Senior' limit $_POST[senior],$dif_ep");
$cp_ep1 = mysql_num_rows($ver_ep1);

for($ks=1;$ks<=$cp_ep1;$ks++){
$l_ver_ep1 = mysql_fetch_assoc($ver_ep1);

mysql_query("DELETE from edad_pasajeros where id_ep='$l_ver_ep1[id_ep]'");

}//for($ks=1;$ks<=$cp_ep1;$ks++){

} //if($cp_ep > $_POST["senior"]){


//fin busca q no se graben mas de una vez
//fin busca q no se graben mas de una vez


//adicionales
//adicionales
$sub_total_adic = 0;

if($hay_adic == "si"){



for($x=1;$x<=10;$x++){



if($ad_si[$x]!=""){
//select ad1 from adicionales where idd_sub2 = '34' and id_adicional='20' and (r1 <= '1' and rr1 >= '1')

$costo_adic = 0;

$edad_adic = $_POST["ed_se_".$y];


//echo $edad_adic." <---- edada adic<br>"; 

//busca el rango de edad para este adicional

$b_adic1 = mysql_query("select nombre_ad,precio_ad,ad1 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r1 <= '$edad_adic' and rr1 >= '$edad_adic') ");

$cta_adic1 = mysql_num_rows($b_adic1);

if($cta_adic1 > 0){
$l_adic1 = mysql_fetch_assoc($b_adic1);

$costo_adic = $l_adic1["ad1"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic1[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div>
<div style='clear:both'></div>
";



}//if($cta_adic1 > 0){

$b_adic2 = mysql_query("select nombre_ad,ad2 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r2 <= '$edad_adic' and rr2 >= '$edad_adic') ");

$cta_adic2 = mysql_num_rows($b_adic2);

if($cta_adic2 > 0){
$l_adic2 = mysql_fetch_assoc($b_adic2);

$costo_adic = $l_adic2["ad2"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic2[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic2 > 0){

$b_adic3 = mysql_query("select nombre_ad,ad3 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r3 <= '$edad_adic' and rr3 >= '$edad_adic') ");

$cta_adic3 = mysql_num_rows($b_adic3);

if($cta_adic3 > 0){
$l_adic3 = mysql_fetch_assoc($b_adic3);

$costo_adic = $l_adic3["ad3"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic3[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";

}//if($cta_adic3 > 0){


$b_adic4 = mysql_query("select nombre_ad,ad4 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r4 <= '$edad_adic' and rr4 >= '$edad_adic') ");

$cta_adic4 = mysql_num_rows($b_adic4);

if($cta_adic4 > 0){
$l_adic4 = mysql_fetch_assoc($b_adic4);

$costo_adic = $l_adic4["ad4"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic4[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic4 > 0){


$b_adic5 = mysql_query("select nombre_ad,ad5 from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]' and (r5 <= '$edad_adic' and rr5 >= '$edad_adic') ");

$cta_adic5 = mysql_num_rows($b_adic5);

if($cta_adic5 > 0){
$l_adic5 = mysql_fetch_assoc($b_adic5);

$costo_adic = $l_adic5["ad5"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic5[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic5 > 0){


//en caso q no haya descuento por edad pone el precio fijo
//en caso q no haya descuento por edad pone el precio fijo

if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

$b_adic_base = mysql_query("select nombre_ad,precio_ad from adicionales where idd_sub2 = '$_GET[id]' and id_adicional='$ad_si[$x]'");
$l_adic_base = mysql_fetch_assoc($b_adic_base);

$costo_adic = $l_adic_base["precio_ad"];

echo "
<div class='adic_col1'>
Edad: $edad_adic a�os | Adicional: $l_adic_base[nombre_ad]
</div>

<div class='adic_col2'>
$ $costo_adic .
</div><div syle='clear:both'></div>

";


}//if($cta_adic1 == 0 && $cta_adic2 == 0 && $cta_adic3 == 0 && $cta_adic4 == 0 && $cta_adic5 == 0){

//fin en caso q no haya descuento por edad pone el precio fijo
//fin en caso q no haya descuento por edad pone el precio fijo



$sub_total_adic = $sub_total_adic + $costo_adic;

//busca el rango de edad para este adicional

}//if($ad_si[$x]!=""){


}//for($x=1;$x<=10;$x++){



$tot_este_pasajero = $sub_total_adic + $preciose;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";


$total_final_final = $total_final_final + $tot_este_pasajero;


}else{//if($hay_adic == "si"){


$tot_este_pasajero = $sub_total_adic + $preciose;

echo "
<div class='pas_col1' style='background-color:#076793'>
Total este pasajero: 
</div>

<div class='pas_col2' style='background-color:#076793;margin-bottom:5px'>
$ $tot_este_pasajero
</div><div syle='clear:both'></div>

";

$total_final_final = $total_final_final + $tot_este_pasajero;




}//if($hay_adic == "si"){

//fin adicionales
//fin adicionales



}//for($y=1;$y<=$_POST["senior"];$y++){




}//if($_POST["senior"] > 0){

//fin senior













//calcula precios por edad


echo "</div>"; //-----------------111111111111111111111111111


echo "<div style='width:350px;float:left;height:150px;background-color:#cccccc;text-align:center'>"; //-----------------2222222222222222222222222222



if(isset($_GET["id_v"])){

//busca si tiene descuento el vendedor
//busca si tiene descuento el vendedor

$b_de = mysql_query("select * from descuento_vendedor where idd_vendedor_dv='$_GET[id_v]' and idd_sub2_dv='$_GET[id]'");

$c_de = mysql_num_rows($b_de);

if($c_de > 0){

$l_de = mysql_fetch_assoc($b_de);

$descuento_vendedor = $l_de["descuento_dv"];

}else{//if($c_de > 0){

$descuento_vendedor = 0;

}//if($c_de > 0){

//fin busca si tiene descuento el vendedor
//fin busca si tiene descuento el vendedor


//CALCULA PRECIO CON DESCUENTO
//CALCULA PRECIO CON DESCUENTO

if($descuento_vendedor > 0){

$calc_desc = ($total_final_final * $descuento_vendedor) / 100;

$total_final_final = $total_final_final - $calc_desc;

}else{//if($descuento_vendedor > 0){

$total_final_final = $total_final_final;

}//if($descuento_vendedor > 0){

//FIN CALCULA PRECIO CON DESCUENTO
//FIN CALCULA PRECIO CON DESCUENTO


}//if(isset($_GET["id_v"])){



if(isset($descuento_vendedor) && $descuento_vendedor > 0){

echo "<p style='font-size:20px;color:#279cd1'>Total a pagar con descuento vendedor % $descuento_vendedor :</p>";

}else{ //if(isset($descuento_vendedor) && $descuento_vendedor > 0){

echo "<p style='font-size:20px;color:#279cd1'>Total a pagar:</p>";

} //if(isset($descuento_vendedor) && $descuento_vendedor > 0){

echo "<p style='font-size:30px;color:#076793'><b> $ ar $total_final_final  </b></p>";


echo "</div>"; //-----------------2222222222222222222222222222

echo "<div style='clear:both'></div>";


//#######FIN NUEVO CALCULO DE PRECIOS
//#######FIN NUEVO CALCULO DE PRECIOS




?>

