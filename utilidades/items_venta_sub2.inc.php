<?php


////// verifica si este articulo tiene los items grabados
////// verifica si este articulo tiene los items grabados

$sql1q = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.idd_sub2_iva = '$_GET[clave_sub2]' order by items_venta_articulo.orden_iva asc ");
$cta1q = mysql_num_rows($sql1q);


if($cta1q == 0){

$sre = mysql_query("select * from items_base_cliente where idd_empresa_ibs = '$_SESSION[logeo]'");
$cta_sre = mysql_num_rows($sre);


for($l=1;$l<=$cta_sre;$l++){
$l_sre = mysql_fetch_assoc($sre);

mysql_query("INSERT INTO items_venta_articulo (idd_sub2_iva,idd_ibc_iva,publica_iva,orden_iva) VALUES ('$_GET[clave_sub2]','$l_sre[id_ibc]','no','0')");


}//for($l=1;$l<=$cta_sre;$l++){


}//if($cta1q == 0){



////// verifica si este articulo tiene los items grabados
////// verifica si este articulo tiene los items grabados


if(isset($_POST["escribano_items"])=="ok"){


if($_POST["tiene_conte"]=="si"){



$sql11 = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.idd_sub2_iva = '$_GET[clave_sub2]' order by items_venta_articulo.orden_iva asc ");
$cta11 = mysql_num_rows($sql11);






for($h=1;$h<=$cta11;$h++){
$lee_sql11 = mysql_fetch_assoc($sql11);

$pp = "publica".$lee_sql11["id_iva"];
$oo = "orden".$lee_sql11["id_iva"];

mysql_query("UPDATE items_venta_articulo SET publica_iva='$_POST[$pp]', orden_iva='$_POST[$oo]' where idd_sub2_iva='$_GET[clave_sub2]' and id_iva = '$lee_sql11[id_iva]'  ");

}//for($h=1;$h<=$cta1;$h++){

}else{ //if($_POST["tiene_conte"]=="si"){


mysql_query("INSERT INTO ventas_info_items (idd_sub2_vii,vehiculo_vii,hotel_vii,agencia_vii,vuelo_vii,llega_vii,sale_vii,cont_htl_vii,chofer_vii,guia_vii,observaciones_vii,ipn_vii,alzo_vii,nav_vii,trekk_vii,cod_vii,pick_up_vii,sn_vii,orden_vehiculo_vii,orden_hotel_vii,orden_agencia_vii,orden_vuelo_vii,orden_llega_vii,orden_sale_vii,orden_cont_htl_vii,orden_chofer_vii,orden_guia_vii,orden_observaciones_vii,orden_ipn_vii,orden_alzo_vii,orden_nav_vii,orden_trekk_vii,orden_cod_vii,orden_pick_up_vii,orden_sn_vii) VALUES ('$_GET[clave_sub2]','$_POST[vehiculo]','$_POST[hotel]','$_POST[agencia]','$_POST[vuelo]','$_POST[llega]','$_POST[sale]','$_POST[cont_htl]','$_POST[chofer]','$_POST[guia]','$_POST[observaciones]','$_POST[ipn]','$_POST[alzo]','$_POST[nav]','$_POST[trekk]','$_POST[cod]','$_POST[pick_up]','$_POST[sn]','$_POST[orden_vehiculo]','$_POST[orden_hotel]','$_POST[orden_agencia]','$_POST[orden_vuelo]','$_POST[orden_llega]','$_POST[orden_sale]','$_POST[orden_cont_htl]','$_POST[orden_chofer]','$_POST[orden_guia]','$_POST[orden_observaciones]','$_POST[orden_ipn]','$_POST[orden_alzo]','$_POST[orden_nav]','$_POST[orden_trekk]','$_POST[orden_cod]','$_POST[orden_pick_up]','$_POST[orden_sn]')");



}//if($_POST["tiene_conte"]=="si"){


echo "<script>document.getElementById('10').style.display='block'</script>";

}//cierra if escribano


#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO


$sql1 = mysql_query("SELECT items_base_cliente.*, items_venta_articulo.*
FROM items_base_cliente
LEFT OUTER JOIN items_venta_articulo ON items_base_cliente.id_ibc = items_venta_articulo.idd_ibc_iva
WHERE items_venta_articulo.idd_sub2_iva = '$_GET[clave_sub2]' order by items_venta_articulo.orden_iva asc ");
$cta1 = mysql_num_rows($sql1);




echo "<form method='post' action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' enctype='multipart/form-data' name='valida10'>";


if($cta1 > 0){

$tiene_conte = "si";

for($h=1;$h<=$cta1;$h++){
$lee_sql1 = mysql_fetch_assoc($sql1);




echo "<div style='width:150px;float:left'>$lee_sql1[nombre_ibc]</div>";  //000000000000000000

echo "<div style='width:150px;float:left'><select name='publica$lee_sql1[id_iva]'>";

$publi = $lee_sql1["publica_iva"];

if($publi ==""){
$publi == "no";
}//if($publi ==""){

if($publi == "no"){
echo "<option >no</option><option>si</option>";
}else{ //if($publi == "no"){
echo "<option >no</option><option selected>si</option>";
}//if($publi == "no"){


echo "</select></div>
     <div style='width:100px;float:left'>Orden: <input type='text' name='orden$lee_sql1[id_iva]' value='$lee_sql1[orden_iva]' style='width:50px;height:15px;font-size:12px'></div>
     <div style='clear:both'></div>"; //000000000000000000





}//for($h=1;$h<=$cta1;$h++){



}else{ //if($cta1 > 0){

$tiene_conte = "no"; 



} //if($cta1 > 0){



echo "<input type='hidden' name='clave_sub2' value='$_GET[clave_sub2]'>";
echo "<input type='hidden' name='tiene_conte' value='$tiene_conte'>";
echo "<input type='hidden' name='escribano_items' value='ok'>";
echo "<input type='submit'  style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >";



echo "</form>";


?>