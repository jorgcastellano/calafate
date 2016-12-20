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
<title>VENTAS</title>
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

	



	
</head>

<body>

         <div style="background-color:#ffffff" > <!-- EEEEE -->

<?php

if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado_vendedor.inc.php");

}else{ //if($_SESSION["tipo"]=="vendedor"){

include_once("encabezado.inc.php");

} //if($_SESSION["tipo"]=="vendedor"){

?>

<div style="padding:10px">


<?php


//PAGINEO


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

//busca_fecha
//busca_fecha
  
  
  //busco la cantidad total
$busca_total = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and (fecha_excur_vs >= '$id_fecha' and fecha_excur_vs <='$id_fecha1') order by id_ventas desc");
$cta_total = mysql_num_rows($busca_total);
  //fin busco la cantidad


$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and (fecha_excur_vs >= '$id_fecha' and fecha_excur_vs <='$id_fecha1') order by id_ventas desc limit 0,10");


if(isset($_GET["pagineo0"])!=""){
                   $conteo = -10;
				   for($e=1;$e<550;$e++){
					        $conteo = $conteo + 10;
							$arra_conteo[$e] = $conteo;
							           }
				
				
				
				 	$num_page = $_GET["pagineo0"];
					$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' and (fecha_excur_vs >= '$id_fecha' and fecha_excur_vs <='$id_fecha1') order by id_ventas desc limit $arra_conteo[$num_page],10");
                       
                                     }


//PAGiNEO



//$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' order by id_ventas desc");
$c_sql = mysql_num_rows($sql);


echo "<div>";

echo "<div style='font-size:18px;font-weight:bold'>Dia: ".date("d/m/y", $id_fecha)."</div><br>";

echo "</div>";


echo "<div style='width:20px;height:20px;float:left;background-color:#05cd0a'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Se�ado</div>
	
      <div style='width:20px;height:20px;float:left;background-color:#f8a505;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Reservado</div>
	  
	   <div style='width:20px;height:20px;float:left;background-color:#122dcd;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Confirmado</div>
	
	  <div style='width:20px;height:20px;float:left;background-color:#ff0000;margin-left:10px'></div>
      <div style='width:150px;line-height:20px;padding-left:5px;height:20px;float:left'>Cancelado</div>
	  
	  <div style='clear:both'></div><br>
      
	 ";





	  
	  
for($l=1;$l<=$c_sql;$l++){

$l_sql = mysql_fetch_assoc($sql);

//busca nombre articulo
$sql_sub2 = mysql_query("select * from subcategoria_2 where clave='$l_sql[idd_sub2_vs]'");
$l_sql_sub2 = mysql_fetch_assoc($sql_sub2);



$nombre_sub2 = $l_sql_sub2["nombre_sub2"]; 

//fin busca nombre articulo

//busca comprador

$sql_p = mysql_query("select * from pasajeros where idd_carga_p = '$l_sql[idd_carga_vs]' and tipo_p = 'comprador'");
$cta_p = mysql_num_rows($sql_p);

if($cta_p > 0){

$nombre_comprador = "";





for($c=1;$c<=2;$c++){
$lee_p = mysql_fetch_assoc($sql_p);
$nombre_comprador = $nombre_comprador.$lee_p["campo2_p"]." ";

} //for($c=1;$c<=$cta_p;$c++){
}else{ //if($cta_p > 0){

$nombre_comprador = "";

}//if($cta_p > 0){



//fin busca comprador

if($l_sql["estado_vs"] == "se�ado"){
$fondo_articulo = "#05cd0a";

} //if($l_con_fecha["estado"] == "se�ado"){

if($l_sql["estado_vs"] == "reservado"){
$fondo_articulo = "#f8a505";

} //if($l_con_fecha["estado"] == "reservado"){

if($l_sql["estado_vs"] == "cancelado"){
$fondo_articulo = "#ff0000";

} //if($l_con_fecha["estado"] == "cancelado"){

if($l_sql["estado_vs"] == "confirmado"){
$fondo_articulo = "#122dcd";

} //if($l_con_fecha["estado"] == "confirmado"){


//busca vendedor

$sql_ven = mysql_query("select nombre_usuario from usuario where id_usuario='$l_sql[vendedor_vs]'");
$l_ven = mysql_fetch_assoc($sql_ven);
$vendedor = $l_ven["nombre_usuario"];
//fin busca vendedor





//busca VENTAS INFO


$sql_vi = mysql_query("select * from ventas_info where idd_ventas_vi = '$l_sql[id_ventas]' ");

$l_vi = mysql_fetch_assoc($sql_vi);


//fin busca VENTAS INFO


//cantidad de pasajeros

$tot_pasajeros = $l_sql["adulto_vs"] + $l_sql["bebe_vs"] + $l_sql["nino_vs"] + $l_sql["nino1_vs"] + $l_sql["nino2_vs"] + $l_sql["senior_vs"];

$det_pasajeros = "Adultos: $l_sql[adulto_vs] | Bebes: $l_sql[bebe_vs] | Menor cat 1: $l_sql[nino_vs] | Menor cat 2: $l_sql[nino1_vs] | Menor cat 3: $l_sql[nino2_vs] | Senior: $l_sql[senior_vs]";

//fin cantidad de pasajeros


echo "<div style='width:1010px;height:30px;border:1px solid #555'>"; //eeeeeeeeeee|||||

//---------------------

   echo "<div style='width:130px;float:left;margin-left:5px;font-size:14px;height:30px;line-height:30px;color:$fondo_articulo'><b>$nombre_sub2</b></div>
      
	  <div style='width:100px;float:left;height:30px'>
	    <div style='width:100px;font-size:10px;height:15px'><b>Importe</b></div>
		<div style='width:100px;float:left;overflow:hidden;height:15px;color:$fondo_articulo'>$$l_sql[total_guita_vs]</div>
	  </div>
	  
	  <div style='width:100px;float:left;height:30px'>
	   <div style='width:100px;font-size:10px;height:15px'><b>Estado</b></div>
	   <div style='width:100px;overflow:hidden;height:15px;color:$fondo_articulo'>$l_sql[estado_vs]</div>
	  </div>
	  
	 
      <div style='width:200px;float:left;height:30px'>
	  <div style='width:200px;font-size:10px;height:15px'><b>Comprador</b> </div>
	  <div style='width:200px;overflow:hidden;height:15px;color:$fondo_articulo'>$nombre_comprador </div>
	  </div>	 
	  
     
      <div style='width:100px;float:left;height:30px'>
      <div style='width:100px;font-size:10px;height:15px'><b>Vendedor</b> </div>	  
	  <div style='width:100px;overflow:hidden;height:15px;color:$fondo_articulo'>$vendedor </div>
	  </div>
      
      <div style='width:60px;float:left;height:30px'> 
	  <div style='width:60px;font-size:10px;height:15px'><b>Comisi�n</b> </div>
	  <div style='width:60px;overflow:hidden;text-align:center;height:30px;color:$fondo_articulo'>% $l_sql[comision_vs]</div>
	  </div>
	  
	  <div style='width:110px;float:left;margin-left:20px;height:30px'>
	  <div style='width:110px;margin-left:20px;font-size:10px;height:15px;color:$fondo_articulo'><b>Ult. modif</b> </div>"; 
	  
if($l_sql["fecha_ult_modificacion_vs"]!=""){	  

$fech_ult = date("d/m/y | G.i<br>", $l_sql["fecha_ult_modificacion_vs"]);	  

}else{ //if($l_sql["fecha_ult_modificacion_vs"]!=""){

$fech_ult = "";

}//if($l_sql["fecha_ult_modificacion_vs"]!=""){	 	  
	  
echo  "<div style='width:110px;overflow:hidden;height:15px;margin-left:20px;color:$fondo_articulo'>  $l_sql[ult_modificacion_vs]</div>	  
	  
</div>
	  
 
      
      <div style='width:110px;float:left;height:30px'>
	  <div style='width:110px;font-size:10px;height:15px'><b>Fecha modif </b> </div>
	  <div style='width:110px;overflow:hidden;height:15px;color:$fondo_articulo'>  $fech_ult </div>
	  
	  </div>

      </a>

      <div style='width:60px;float:left;height:30px'> 
	  <div style='width:60px;font-size:10px;height:15px'><b>voucher </b> </div>";
	  
	  if($l_sql["estado_vs"]=="confirmado"){
	  
	        if($l_sql["voucher_vs"]=="si"){
	  
	  echo "<div style='width:50px;height:27px;margin-top:0px'>
	  <a href='voucher.php?id=$l_sql[id_ventas]&voucher=si&id_sub2=$l_sql_sub2[clave]'><img src='imagenes/bot_creado.png' title='ver / modificar' height='15'></a>
	  </div>";
	  
	        }else{ //if($l_sql["voucher_vs"]=="si"){

			echo "<div style='width:50px;height:27px;margin-top:0px'>
	  <a href='voucher.php?id=$l_sql[id_ventas]&voucher=no&id_sub2=$l_sql_sub2[clave]'><img src='imagenes/bot_crear.png' height='15'></a>
	  </div>";
			

            } //if($l_sql["voucher_vs"]=="si"){			
	  
	  
	  
	  }else{//if($l_sql["estado_vs"]=="confirmado"){
	
	   echo "<div style='width:50px;height:30px'></div>";
	
	  }////if($l_sql["estado_vs"]=="confirmado"){
	  
	  
echo   "</div>
	  
	 
	  
	  
	  <div style='clear:both'></div>";


//---------------------



 

echo "</div>";//eeeeeeeeeee|||||	 
	 
	 
//INFO ADICIONAL	 

echo "<div style='width:2000px;background-color:#f3eef7;padding:10px;margin-bottom:5px'>";//�����������

echo "<div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Pick up </b> </div>
      <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Llega </b> </div>
      <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Hotel </b> </div>
      <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Cant </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Agencia </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Vuelo </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>IPN </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>SN </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Alzo </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Contacto htl </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Vehiculo </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Chofer </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Guia </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Obs </b> </div>
	  
	  
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Sale </b> </div>
	  
	  
	  
	  
	  
	  
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Nav </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Treckk </b> </div>
	  <div style='width:90px;float:left;color:#000000;overflow:hidden'><b>Cod </b> </div>
	  <div style='clear:both;margin-bottom:5px'></div>	 
	  
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[pick_up_vi]' >$l_vi[pick_up_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[hotel_vi]' >$l_vi[hotel_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[vehiculo_vi]' >$l_vi[vehiculo_vi] </div>
	  
	  
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[agencia_vi]' >$l_vi[agencia_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[vuelo_vi]' >$l_vi[vuelo_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[llega_vi]' >$l_vi[llega_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='' >$l_vi[sale_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[sale_vi]'>$l_vi[cont_htl_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[chofer_vi]'>$l_vi[chofer_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[guia_vi]' >$l_vi[guia_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[observaciones_vi]'>$l_vi[observaciones_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[ipn_vi]'>$l_vi[ipn_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[alzo_vi]'>$l_vi[alzo_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[nav_vi]'>$l_vi[nav_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[trekk_vi]'>$l_vi[trekk_vi] </div>
	  <div style='width:90px;float:left;height:30px;overflow:hidden' title='$l_vi[cod_vi]'>$l_vi[cod_vi] </div>
	  <div style='clear:both'></div>";	  
	  
	  
  

	  
echo  "
	  
	   <div style='width:115px;float:left'><a href='ventas_modifica.php?id=$l_sql[id_ventas]'><img src='imagenes/bot_modificar1.png' style='margin-top:0px' height='20'></a></div>";
	  
	   
	  
	  
echo  "<div style='clear:both'></div>";

	  
echo "</div>";//�����������	  
	  
// FIN INFO ADICIONAL

} //for($l=1;$l<=$c_sql;$l++){




//numero el pagineo

$nume = $cta_total / 10;
$cant_paginas = ceil($nume);



if($cta_total > 10){


echo "<div style='fwidth:535px;line-height:20px;margin-top:18px'>

<div  style='margin-top:0px;text-align:center;font-size:12px;font-family:arial;margin-bottom:0px' >";



for($p=1;$p<=$cant_paginas;$p++){

if(isset($_GET["pagineo0"]) && $_GET["pagineo0"]==$p){
echo "<a href=$_SERVER[PHP_SELF]?pagineo0=$p style='color:#000000;background-color:#999999;font-size:12px;padding:3px'>$p</a>";

}else{

echo "<a href=$_SERVER[PHP_SELF]?pagineo0=$p style='color:#ffffff;background-color:#000000;font-size:12px;padding:3px'>$p</a>";

}//if($_GET["pagineo0"]==$p){


if($p!=$cant_paginas){
echo "-";
                     }			 
			 
			 }
echo "<b>&nbsp;&nbsp;Pagina/s</b>";
echo "</div></div>";



}// cierra if($cta_total > 5){

//fin numero el pagineo







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

include_once("ventas_calendario1.php");

echo "</div>";



?>



</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div> <!-- EEEEE -->


</body>
</html>
