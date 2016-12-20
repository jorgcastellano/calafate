<?php

include_once("conexion.inc.php");

if(isset($_POST["escribano"])){

$total_guita = $_POST["total_guita"];



if ($_POST["importe_efectivo"] !=""){

$busca_mon = mysql_query("select * from monedas where idd_empresa_monedas='$_POST[id_empresa]' and idd_monedas_base= '$_POST[moneda]'");

$l_bm = mysql_fetch_assoc($busca_mon); 

$busca_nom_mon = mysql_query("select * from monedas_base where id_monedas_base='$_POST[moneda]' ");

$l_nom_mon = mysql_fetch_assoc($busca_nom_mon);



$nombre_moneda = $l_nom_mon["nombre_monedas_base"];
$efect = $l_bm["valor_monedas"] * $_POST["importe_efectivo"]; 
$valor_plata = $l_bm["valor_monedas"];

}else{//if ($_POST["importe_efectivo"] !=""){

$nombre_moneda = "";
$efect = 0; 
$valor_plata = 0;


}//if ($_POST["importe_efectivo"] !=""){

$total_guita1 = $_POST["importe_tarjeta"] + $efect;


if($total_guita1 >= $total_guita){

$busca_vp = mysql_query("select * from ventas_pago where idd_venta_vp = '$_POST[id_carga]'");
$cta_vp = mysql_fetch_assoc($busca_vp);

if($cta_vp ==0){

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_tarjeta_vp,importe_efectivo_vp) VALUES ('$_POST[id_carga]','$nombre_moneda','$valor_plata','$_POST[num_cupon]','$_POST[num_operacion]','$_POST[importe_tarjeta]','$efect')");

echo "hola<br>";
 
}//if($cta_vp ==0){
 
}else{//if($total_guita1 >= $total_guita){

echo "Los valores no coiciden. Vuelva a colocarlos por favor:<br>";


echo "<form method='post' action='carga_pago.php' name='medio'>

     <div style='width:280px;padding:10px;height:220px;float:left;background-color:#cccccc'>
     Tarjeta : <br><br>
	 Numero cup�n:<br>
	 <input type='text' name='num_cupon'><br><br>
	 
	 Numero operaci�n:<br>
	 <input type='text' name='num_operacion'><br><br>
	 
	 Importe:<br>
	 <input type='text' name='importe_tarjeta'><br><br>
	 
	 </div>
	 
     <div style='width:280px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'>
     Efectivo : <br><br>
	 Moneda<br>";

$sql_mon = mysql_query("select monedas_base.*, monedas.* from monedas_base left outer join monedas on monedas_base.id_monedas_base = monedas.id_monedas where monedas.habilitar_monedas = 'on' and monedas.idd_empresa_monedas='$_POST[id_empresa]'	");


$cta_mon = mysql_num_rows($sql_mon);

echo "<select name='moneda'>";

echo "<option selected></option>"; 

for($o=1;$o<=$cta_mon;$o++){

$l_mon = mysql_fetch_assoc($sql_mon);

echo "<option value='$l_mon[idd_monedas_base]'>$l_mon[nombre_monedas_base] - Valor: $l_mon[valor_monedas]</option>"; 
 
}//for($o=1;$o<=$cta_mon;$o++){ 
	 
echo "</select><br><br>";
	 
echo "Importe:<br>
	 <input type='text' name='importe_efectivo'><br><br>
	 
	 </div>	 

	 
	 <div style='clear:both'></div><br>
     <input type='hidden' name='escribano' value='ok'>
     <input type='hidden' name='id_empresa' value='$_POST[id_empresa]'>
     <input type='hidden' name='total_guita' value='$_POST[total_guita]'>
     <input type='hidden' name='id_carga' value='$_POST[id_carga]'>
	 <input type='button' onclick='medio_pago()' style='width:120px;height:40px;background-image:url(utilidades/imagenes/bot_cargar.png);border:0px' value=''>
	 </form><hr><hr><hr>";



}//if($total_guita1 >= $total_guita){


}//if(isset($_POST["escribano"])){

?>