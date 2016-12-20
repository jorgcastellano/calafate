<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>INFORMES</title>
<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="validaciones.js"></script>
<script type="text/javascript" src="java.js"></script>


<script src="src/js/jscal2.js"></script>
    <script src="src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="src/css/steel/steel.css" />

	
<script>	
function cambia(valor){


for(d=1;d<=4;d++){



if(d==valor){
document.getElementById(d).style.display="block";

}else{ //if(d==valor){
document.getElementById(d).style.display="none";
} //if(d==valor){


}


}


</script>


	
	


	
</head>

<body>

         <div class="global" >

<?php

if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado_vendedor.inc.php");

}else{ //if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado.inc.php");

} //if($_SESSION["tipo"]=="vendedor"){


?>

<div style="padding:10px"> <!-- """""" -->



<div style="padding:10px;float:left"><!-- columna 2 -->


<?php

//busca_fecha
//busca_fecha

if(isset($_GET["id_fecha"])){

$id_fecha = $_GET["id_fecha"];

}else{//if(isset($_GET["id_fecha"])){

$dia = date("d", time());
$mes = date("m", time());
$ano = date("Y", time());

$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;


$id_fecha = mktime(00,00,00,$mess,$diaa,$anoo);


}//if(isset($_GET["id_fecha"])){

$id_fecha1 = $id_fecha + 86400;

//fin busca_fecha
//fin busca_fecha




echo "<div style='width:800px'>"; // %%%%%%%%%%%%%%%%%%%%%%%%%55555

echo "<div style='font-size:18px;font-weight:bold'>Dia: ".date("d/m/y", $id_fecha)."</div><br>";

$sql_ar = mysql_query("select subcategoria_2.*,subcategoria_1.nombre_sub1,categoria.nombre_categoria from subcategoria_2 left outer join subcategoria_1 on subcategoria_2.clave_sub1_s2 = subcategoria_1.clave
left outer join categoria on subcategoria_2.clave_categoria_s2 = categoria.clave where subcategoria_2.idd_empresa_sub2 = '$_SESSION[logeo]' order by subcategoria_2.nombre_sub2 asc");  
	  
$cta_ar = mysql_num_rows($sql_ar);	  


$tot_guita_dia = 0;
$tot_comision_dia = 0;
$tot_descuento_dia = 0;
	  
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


$sql_ver = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and idd_sub2_vs='$l_ar[clave]' and (idd_carga_vs >= '$id_fecha' and idd_carga_vs <='$id_fecha1') and vendedor_vs='$_SESSION[id_usuario]' order by orden_publica_vs asc");




$cta_ver = mysql_num_rows($sql_ver);

if($cta_ver > 0){ //tgbrfvcdewsxx

echo "<div style='width:350px;float:left;margin-left:10px;margin-bottom:10px;margin-bottom:10px'>";//ewqewqewq

echo "<div style='text-align:center;height:20px;line-height:20px;background-color:#0061cc;color:#ffffff'>$l_ar[nombre_sub2]</div>";


$sql = mysql_query("select SUM(adulto_vs) as adulto_vs, SUM(bebe_vs) as bebe_vs, SUM(nino_vs) as nino_vs, SUM(nino1_vs) as nino1_vs, SUM(nino2_vs) as nino2_vs, SUM(senior_vs) as senior_vs,SUM(total_guita_vs) as total_guita_vs,SUM(desc_especial_vs) as desc_especial_vs from ventas where idd_empresa_vs='$_SESSION[logeo]' and idd_sub2_vs='$l_ar[clave]' and (idd_carga_vs >'$id_fecha' and idd_carga_vs <'$id_fecha1') and vendedor_vs='$_SESSION[id_usuario]' ");







$sql_com = mysql_query("select comision_vs from ventas where idd_empresa_vs='$_SESSION[logeo]' and idd_sub2_vs='$l_ar[clave]' and (idd_carga_vs >'$id_fecha' and idd_carga_vs <'$id_fecha1') and vendedor_vs='$_SESSION[id_usuario]' limit 0,1");


$l_com = mysql_fetch_assoc($sql_com);

$comision = $l_com["comision_vs"];




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

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:15px;line-height:15px;margin-bottom:2px'>Ni�o cat. 3</div>";
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


if($l_sql["desc_especial_vs"] =="" ){
$desc_especial = 0;
}else{ //if($l_sql["desc_especial_vs"] =="" ){
$desc_especial = $l_sql["desc_especial_vs"];
}//if($l_sql["desc_especial_vs"] =="" ){


$tot_comision = ($total_guita * $comision) / 100;

echo "<div style='width:241px;float:left;border:1px solid #999999;padding-left:3px;height:50px;line-height:25px;margin-bottom:0px;background-color:#cccccc'>Total $ $total_guita | Comision $ $tot_comision <br> 
Total desc. especiales: $ $desc_especial

</div>";

echo "<div style='width:100px;float:left;border:1px solid #999999;margin-left:2px;text-align:center;height:50px;line-height:50px;margin-bottom:0px;background-color:#cccccc'>$suma_pasajeros</div>

<div style='clear:both'></div>";

echo "</div>";//ewqewqewq



$tot_guita_dia = $tot_guita_dia + $total_guita;
$tot_comision_dia = $tot_comision_dia + $tot_comision;
$tot_descuento_dia = $tot_descuento_dia + $desc_especial;
}//if($cta_ver > 0){ //tgbrfvcdewsxx


} //for($d=1;$d<=$cta_ar;$d++){  //UUUUUUUUUUUUuuuuuuUUUUUUU

echo "<div style='clear:both'></div>";

echo "<div style='margin-bottom:10px;margin-top:10px;font-size:14px;font-weight:bold'>
      Total ventas del dia: $ $tot_guita_dia <br>
	  Total comision del dia: $ $tot_comision_dia <br>
	  Total descuento especiales del dia: $ $desc_especial <br>
      </div>";


echo "</div>"; // %%%%%%%%%%%%%%%%%%%%%%%%%55555


// FECHAS DIA POR DIA
// FECHAS DIA POR DIA


echo "<div style='height:80px;margin-top:30px;background-color:#677AB4' id='calendario'>";

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

include_once("caja_calendario1.php");

echo "</div>";

// FECHAS DIA POR DIA
// FECHAS DIA POR DIA



?>








<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "desde", "%d/%m/%Y");

      

    //]]></script>

	
</div>  <!-- fin columna 2 -->


<div style="clear:both"></div>	
	
	
</div>  <!-- """""" -->

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
