<?php

echo "<div style='width:900px;background-color:#677AB4'  >";//---------------------------------------------g



echo "<div style='text-align:center;text-transform:uppercase;color:#ffffff;font-weight:bold'>".$mes_d[$mes]."</div>";


$dia1 = date("N", mktime(0, 0, 0, $mes, 1, $ano));


for($x=1;$x<=$dias_mes;$x++){

$fecha_ventz = mktime(00,00,00,$mes,$x,$ano);

if($fecha_ventz == $id_fecha){



echo "<div style='width:28px;float:left;text-align:center;font-weight:bold;color:#031A61'>";
echo "<a href='caja.php?id_fecha=$fecha_ventz' style='color:#031A61;text-decoration:none' >".$x."</a>";
echo "</div>";

}else{//if($x == $dia){

echo "<div style='width:28px;float:left;text-align:center'>";
echo "<a href='caja.php?id_fecha=$fecha_ventz' style='color:#cccccc;text-decoration:none' >".$x."</a>";
echo "</div>";

}//if($x == $dia){


}//for($x=1;$x<=$dias_mes;$x++){

echo "<div style='clear:both;height:8px'></div>";




$mes1 = $mes - 1;
if($mes1 == 0){
$mes1 = 12;
}//if($mes1 == 0){

echo "<div class='fondo_boton' onclick=cambia_mes_caja('$mes1','$id_fecha') >";
echo $mes_d[$mes1];
echo "</div>";

$mes2 = $mes + 1;
if($mes1 == 13){
$mes2 = 1;
}//if($mes2 == 0){

echo "<div class='fondo_boton' onclick=cambia_mes_caja('$mes2','$id_fecha') >";
echo $mes_d[$mes2];
echo "</div>";

echo "<div style='clear:both'></div>";

echo "</div>";



?>