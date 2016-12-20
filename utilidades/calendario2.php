<?php
include_once("conexion.inc.php");

$dia = 0;
$mes = $_GET["clave"];
$ano = date("Y");

$mes = (int)$mes;
$dia = (int)$dia;
$ano = (int)$ano;

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




echo "<div style='width:780px' id='calendario' >";//---------------------------------------------g


echo "<div style='text-align:center;text-transform:uppercase;color:#000;font-weight:bold'>".$mes_d[$mes]."</div>";


$texto_articulo = "";

for($x=1;$x<=$dias_mes;$x++){

$fecha_consulta = mktime(00,00,00,$mes,$x,$ano);

$con_fecha = mysql_query("select subcategoria_2.nombre_sub2,articulo.* from subcategoria_2 left outer join articulo on subcategoria_2.clave = articulo.clave_sub2_ar where subcategoria_2.clave = '$_GET[clave_sub22]' and articulo.idd_fecha = '$fecha_consulta'");

$c_con_fecha = mysql_num_rows($con_fecha);



if($c_con_fecha > 0){

for($xz=1;$xz<=$c_con_fecha;$xz++){

$l_con_fecha = mysql_fetch_assoc($con_fecha);

if($l_con_fecha["estado"] == "libre"){
$fondo_articulo = "#05cd0a";
$select_estado = "<select name='estado_arti'><option selected='selected'>libre</option><option>reservado</option><option>cancelado</option></select>";
} //if($l_con_fecha["estado"] == "libre"){

if($l_con_fecha["estado"] == "reservado"){
$fondo_articulo = "#f8a505";
$select_estado = "<select name='estado_arti' ><option>libre</option><option selected='selected'>reservado</option><option>cancelado</option></select>";

} //if($l_con_fecha["estado"] == "reservado"){

if($l_con_fecha["estado"] == "cancelado"){
$fondo_articulo = "#ff0000";
$select_estado = "<select name='estado_arti' ><option>libre</option><option >reservado</option><option selected='selected'>cancelado</option></select>";
} //if($l_con_fecha["estado"] == "cancelado"){

if($l_con_fecha["estado"] == "confirmado"){
$fondo_articulo = "#32ebd7";
$select_estado = "";
} //if($l_con_fecha["estado"] == "confirmado"){

$texto_articulo[$xz] = "<a href='javascript:muestra_arti($l_con_fecha[clave])' style='text-decoration:none' title='al modificar un articulo se modifican todos los libre o cancelados de ese dia'><div style='width:180px;height:20px;background-color:$fondo_articulo;color:#fff;font-size:11px;line-height:20px'> &nbsp;    $l_con_fecha[nombre_sub2]  | $ $l_con_fecha[precio]</div></a>
<div style='display:none' id='$l_con_fecha[clave]'><br>
<form method='post' action='modifica_articulo_nuevo.php?clave_sub2=$_GET[clave_sub22]' style='font-size:11px;margin-left:5px' >
Precio: <input type='text' name='precio_arti' value='$l_con_fecha[precio]' style='width:50px'><br>
Estado: $select_estado <br>
<input type='hidden' name='id_arti' value='$l_con_fecha[clave]'>
<input type='hidden' name='escribano_arti' value='ok'>
<input type='submit' style='height:20px;width:120px' value='modificar'>
</form>
</div>
";
	 
} //for($xz=1;$xz<=$c_con_fecha;$xz++){	 	 

}else{ //if($c_con_fecha > 0){
$texto_articulo = "";
}//if($c_con_fecha > 0){


echo "<div style='width:180px;float:left;height:150px;border:solid 1px #555;overflow:auto'>";
echo "<div style='width:180px;height:20px;background-color:#677ab4;text-align:center'>".$x."</div>";

for($xz=1;$xz<=$c_con_fecha;$xz++){

if(isset($texto_articulo[$xz])){
echo $texto_articulo[$xz];
}else{ //if(isset($texto_articulo[$xz])){
echo $texto_articulo;
}//if(isset($texto_articulo[$xz])){


} //for($xz=1;$xz<=$c_con_fecha;$xz++){

echo "</div>";


}//for($x=1;$x<=$dias_mes;$x++){

echo "<div style='clear:both;height:8px'></div>";

echo "</div>";

echo "<div>";


$mes1 = $mes - 1;
if($mes1 == 0){
$mes1 = 12;
}//if($mes1 == 0){

echo "<div class='fondo_boton' onclick=cambia_mes('$mes1','$_GET[clave_sub22]') >";
echo $mes_d[$mes1];
echo "</div>";

$mes2 = $mes + 1;
if($mes2 == 13){
$mes2 = 1;
}//if($mes2 == 0){

echo "<div class='fondo_boton' onclick=cambia_mes('$mes2','$_GET[clave_sub22]') >";
echo $mes_d[$mes2];
echo "</div>";

echo "<div style='clear:both'></div>";

echo "</div>";





?>