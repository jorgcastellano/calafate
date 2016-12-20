<?php

if(isset($_GET["calendario"])){
echo "<script>document.getElementById('4').style.display='block'</script>";
} //if(isset($_GET["calendario"])){

echo "<div style='width:20px;height:20px;float:left;background-color:#05cd0a'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Libre</div>
	
      <div style='width:20px;height:20px;float:left;background-color:#f8a505;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Reservado</div>
	  
	   <div style='width:20px;height:20px;float:left;background-color:#32ebd7;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Confirmado</div>
	
	  <div style='width:20px;height:20px;float:left;background-color:#ff0000;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Cancelado</div>
	  
	  <div style='clear:both'></div><br>
      
	 ";



echo "<div>";

$dia = date("d");
$mes = date("n");
$ano = date("Y");


$mes_d[1] = "Enero";
$mes_d[2] = "Febrero";
$mes_d[3] = "Marzo";
$mes_d[4] = "Abril";
$mes_d[5] = "Mayo";
$mes_d[6] = "Junio";
$mes_d[7] = "Julio";
$mes_d[8] = "Agosto";
$mes_d[9] = "Septiembre";
$mes_d[10] = "Octubre";
$mes_d[11] = "Noviembre";
$mes_d[12] = "Diciembre";


$dias_mes = date("t", mktime(0, 0, 0, $mes, 1, $ano));

include_once("calendario1.php");

echo "</div>";

?>