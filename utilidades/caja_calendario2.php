<?php
include_once("conexion.inc.php");

$dia = 0;
$mes = $_GET["clave"];
$ano = date("Y");
$dias_mes = date("t", mktime(0, 0, 0, $mes, 1, $ano));

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




echo "<div style='width:900px;background-color:#677AB4'  >";


echo "<div style='text-align:center;text-transform:uppercase;color:#ffffff;font-weight:bold'>".$mes_d[$mes]."</div>";

$id_fechak = $_GET["id_fechak"];

for($x=1;$x<=$dias_mes;$x++){

$fecha_ventz = mktime(00,00,00,$mes,$x,$ano);
                   


if($fecha_ventz == $id_fechak){

echo "<div style='width:28px;float:left;text-align:center;font-weight:bold;color:#031A61'>";
echo "<a href='caja.php?id_fecha=$fecha_ventz' style='color:#031A61;text-decoration:none' >".$x."</a>";
echo "</div>";

}else{//if($fecha_ventz == $id_fecha){

echo "<div style='width:28px;float:left;text-align:center'>";
echo "<a href='caja.php?id_fecha=$fecha_ventz' style='color:#cccccc;text-decoration:none' >".$x."</a>";
echo "</div>";

}//if($fecha_ventz == $id_fecha){


}//for($x=1;$x<=$dias_mes;$x++){

echo "<div style='clear:both;height:8px'></div>";

echo "</div>";

echo "<div><br>";


$mes1 = $mes - 1;
if($mes1 == 0){
$mes1 = 12;
}//if($mes1 == 0){

echo "<div class='fondo_boton' onclick=cambia_mes_caja('$mes1') >";
echo $mes_d[$mes1];
echo "</div>";

$mes2 = $mes + 1;
if($mes1 == 13){
$mes2 = 1;
}//if($mes2 == 0){

echo "<div class='fondo_boton' onclick=cambia_mes_caja('$mes2') >";
echo $mes_d[$mes2];
echo "</div>";

echo "<div style='clear:both'></div>";

echo "</div>";





?>