<?php

echo "<div style='width:800px'>"; // %%%%%%%%%%%%%%%%%%%%%%%%%55555

echo "<div style='font-size:18px;font-weight:bold'>Dia: ".date("d/m/y", $id_fecha)."</div><br>";

$sql_ar = mysql_query("select subcategoria_2.*,subcategoria_1.nombre_sub1,categoria.nombre_categoria from subcategoria_2 left outer join subcategoria_1 on subcategoria_2.clave_sub1_s2 = subcategoria_1.clave
left outer join categoria on subcategoria_2.clave_categoria_s2 = categoria.clave where subcategoria_2.idd_empresa_sub2 = '$_SESSION[logeo]' order by subcategoria_2.nombre_sub2 asc");  
	  
$cta_ar = mysql_num_rows($sql_ar);	  
	  
for($d=1;$d<=$cta_ar;$d++){ //UUUUUUUUUUUUuuuuuuUUUUUUU
$l_ar = mysql_fetch_assoc($sql_ar);

$reservado[$d] = 0;
$confirmado[$d] = 0;

$adulto_vs[$d] = 0;
$bebe_vs[$d] = 0;
$nino_vs[$d] = 0;  	
$nino1_vs[$d] = 0;
$nino2_vs[$d] = 0; 	
$senior_vs[$d] = 0;

echo "<div style='width:350px;float:left;margin-left:10px;margin-bottom:10px;margin-bottom:10px'>";//ewqewqewq

echo "<div style='text-align:center;height:20px;line-height:20px;background-color:#0061cc;color:#ffffff'>$l_ar[nombre_sub2]</div>";


$sql = mysql_query("select SUM(adulto_vs) as adulto_vs, SUM(bebe_vs) as bebe_vs, SUM(nino_vs) as nino_vs, SUM(nino1_vs) as nino1_vs, SUM(nino2_vs) as nino2_vs, SUM(senior_vs) as senior_vs,SUM(total_guita_vs) as total_guita_vs from ventas where idd_empresa_vs='$_SESSION[logeo]' and idd_sub2_vs='$l_ar[clave]' and (idd_carga_vs >'$id_fecha' and idd_carga_vs <'$id_fecha1') ");

$l_sql = mysql_fetch_assoc($sql);

//adultos

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:15px;line-height:15px;margin-bottom:2px'>Adultos</div>";
echo "<div style='width:100px;float:left;border:1px solid #999999;margin-left:2px;text-align:center;height:15px;line-height:15px;margin-bottom:2px'>";

if($l_sql["adulto_vs"] !=""){
echo $l_sql["adulto_vs"];
}else{ //if($l_sql["adulto_vs"] ==""{
echo "0";
} //if($l_sql["adulto_vs"] ==""{

echo "</div>
<div style='clear:both'></div>";


//adultos


//bebe

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:15px;line-height:15px;margin-bottom:2px'>Bebe</div>";
echo "<div style='width:100px;float:left;border:1px solid #999999;margin-left:2px;text-align:center;height:15px;line-height:15px;margin-bottom:2px'>";

if($l_sql["bebe_vs"] !=""){
echo $l_sql["bebe_vs"];
}else{ //if($l_sql["bebe_vs"] ==""{
echo "0";
} //if($l_sql["bebe_vs"] ==""{

echo "</div>
<div style='clear:both'></div>";


//bebe


//nino

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:15px;line-height:15px;margin-bottom:2px'>Ni�o cat. 1</div>";
echo "<div style='width:100px;float:left;border:1px solid #999999;margin-left:2px;text-align:center;height:15px;line-height:15px;margin-bottom:2px'>";

if($l_sql["nino_vs"] !=""){
echo $l_sql["nino_vs"];
}else{ //if($l_sql["nino_vs"] ==""{
echo "0";
} //if($l_sql["nino_vs"] ==""{

echo "</div>
<div style='clear:both'></div>";


//nino


//nino1

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:15px;line-height:15px;margin-bottom:2px'>Ni�o cat. 2</div>";
echo "<div style='width:100px;float:left;border:1px solid #999999;margin-left:2px;text-align:center;height:15px;line-height:15px;margin-bottom:2px'>";

if($l_sql["nino1_vs"] !=""){
echo $l_sql["nino1_vs"];
}else{ //if($l_sql["nino1_vs"] ==""{
echo "0";
} //if($l_sql["nino1_vs"] ==""{

echo "</div>
<div style='clear:both'></div>";


//nino1


//nino3

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:15px;line-height:15px;margin-bottom:2px'>Ni�o cat. 3</div>";
echo "<div style='width:100px;float:left;border:1px solid #999999;margin-left:2px;text-align:center;height:15px;line-height:15px;margin-bottom:2px'>";

if($l_sql["nino2_vs"] !=""){
echo $l_sql["nino2_vs"];
}else{ //if($l_sql["nino2_vs"] ==""{
echo "0";
} //if($l_sql["nino2_vs"] ==""{

echo "</div>
<div style='clear:both'></div>";


//nino3


//senior

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:15px;line-height:15px;margin-bottom:2px'>Senior</div>";
echo "<div style='width:100px;float:left;border:1px solid #999999;margin-left:2px;text-align:center;height:15px;line-height:15px;margin-bottom:2px'>";

if($l_sql["senior_vs"] !=""){
echo $l_sql["senior_vs"];
}else{ //if($l_sql["senior_vs"] ==""{
echo "0";
} //if($l_sql["senior_vs"] ==""{

echo "</div>
<div style='clear:both'></div>";


//senior


$suma_pasajeros =  $l_sql["adulto_vs"] + $l_sql["bebe_vs"] + $l_sql["nino_vs"] + $l_sql["nino1_vs"] + $l_sql["nino2_vs"] + $l_sql["senior_vs"];

if($l_sql["total_guita_vs"] =="" ){
$total_guita = 0;
}else{ //if($l_sql["total_guita_vs"] =="" ){
$total_guita = $l_sql["total_guita_vs"];
}//if($l_sql["total_guita_vs"] =="" ){

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:25px;line-height:25px;margin-bottom:0px;background-color:#cccccc'>Total $ $total_guita </div>";

echo "<div style='width:100px;float:left;border:1px solid #999999;margin-left:2px;text-align:center;height:25px;line-height:25px;margin-bottom:0px;background-color:#cccccc'>$suma_pasajeros</div>

<div style='clear:both'></div>";

echo "</div>";//ewqewqewq



} //for($d=1;$d<=$cta_ar;$d++){  //UUUUUUUUUUUUuuuuuuUUUUUUU

echo "<div style='clear:both'></div>";

echo "</div>"; // %%%%%%%%%%%%%%%%%%%%%%%%%55555

?>