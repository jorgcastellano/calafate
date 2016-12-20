<?php
include_once("conexion.inc.php");



echo "<form method='get' action='carga_pago.php'>

     <div style='width:280px;padding:10px;height:220px;float:left;background-color:#cccccc'>
     Tarjeta : <br><br>
	 Numero cup�n:<br>
	 <input type='text' name='num_cupon'><br><br>
	 
	 Numero operaci�n:<br>
	 <input type='text' name='num_cupon'><br><br>
	 
	 Importe:<br>
	 <input type='text' name='importe_tarjeta'><br><br>
	 
	 </div>
	 
     <div style='width:280px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'>
     Moneda : <br><br>";
	 
//$sql_mon = mysql_query("select monedas_base.*, monedas.* from monedas_base left outer join monedas on monedas_base.id_monedas_base = monedas.id_monedas where monedas.habilitar_monedas = 'on' and monedas.idd_empresa_monedas='$_POST[id_empresa]'	");


$sql_mon = mysql_query("select monedas_base.*, monedas.* from monedas_base left outer join monedas on monedas_base.id_monedas_base = monedas.id_monedas where monedas.habilitar_monedas = 'on' and monedas.idd_empresa_monedas='1'	");

$cta_mon = mysql_num_rows($sql_mon);

echo "<select name='moneda'>";

echo "<option selected></option>"; 

for($o=1;$o<=$cta_mon;$o++){

$l_mon = mysql_fetch_assoc($sql_mon);

echo "<option value='$l_mon[idd_monedas_base]'>$l_mon[nombre_monedas_base]</option>"; 
 
}//for($o=1;$o<=$cta_mon;$o++){ 
	 
echo "</select><br><br>";
	 
echo "Importe:<br>
	 <input type='text' name='importe_efectivo'><br><br>
	 
	 </div>	 

	 
	 <div style='clear:both'></div><br>
     <iput type='hidden' name='escribano' value='ok'>
     <iput type='hidden' name='empresa' value='$_POST[id_empresa]'>
	 <input type='submit' style='width:120px;height:40px;background-image:url(utilidades/imagenes/bot_cargar.png);border:0px' value=''>
	 </form>";

?>