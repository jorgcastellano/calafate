<?php
include_once("encabezado.inc.php");

//valida fecha
//valida fecha

$partes = explode("/",$_POST["desde"]);

$dia = $partes[0];
$mes = $partes[1];
$ano = $partes[2];

$fecha_carga = date("d/m/Y");

$partes1 = explode("/",$fecha_carga);

$dia1 = $partes1[0];
$mes1 = $partes1[1];
$ano1 = $partes1[2];


//---------------- VALIDA QUE SEA HOY O MA�ANA LA FECHA


$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;

$mess1 = (int)$mes1;
$diaa1 = (int)$dia1;
$anoo1 = (int)$ano1;



$fecha_carga = mktime(00,00,00,$mess1,$diaa1,$anoo1);

$fecha_excursion = mktime(00,00,00,$mess,$diaa,$anoo);


$dif_fechas = $fecha_excursion - $fecha_carga;


if($fecha_carga > $fecha_excursion ){

    	echo "<script>
	      alert('La fecha puesta es anterior al dia de la fecha ');	
	      history.go(-1);
		  </script>";
	      die();

}// if($fecha_dia > $fecha_barco ){



//---consulta en reglas la hora

$sql_rv = mysql_query("select * from reglas_venta where idd_sub2_rventa ='$_GET[id]'");
$cta_rv = mysql_num_rows($sql_rv);

if($cta_rv > 0){

$lee_rv = mysql_fetch_assoc($sql_rv);

if($lee_rv["habilitar_hora_rventa"]=="on"){
$cant_horas = ($lee_rv["hora_rventa"] * 60) * 60;

$dife_hs = $fecha_excursion - $fecha_carga;


if( $dife_hs <= $cant_horas ){

    	echo "<script>
	      alert('La compra no puede realizarse hasta $lee_rv[hora_rventa] hs de la misma ');	
	      history.go(-1);
		  </script>";
	      die();

}// if($fecha_dia > $fecha_barco ){


} //if($lee_rv["habilitar_hora_venta"]){


} //if($cta_rv > 0){

//---fin consulta en reglas la hora


//fin valida fecha
//fin valida fecha


?>

<META NAME="Description" CONTENT="">

<META NAME="Keywords" CONTENT="">



<title>PLATAFORMA</title>

<script type="text/javascript" src="java.js"></script>


<!-- GALERIA JQUERY -->

   <!-- Arquivos utilizados pelo jQuery lightBox plugin -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
    <!-- / fim dos arquivos utilizados pelo jQuery lightBox plugin -->
    
    <!-- Ativando o jQuery lightBox plugin -->
    <script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>
   	<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		width:580px;
		margin-left:10px;
		margin-top:0px
		
		
	}
	#gallery ul { list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 3px solid #1e2254;
		border-width: 3px 3px 3px;
	}
	#gallery ul a:hover img {
		border: 3px solid #333;
		border-width: 3px 3px 3px;
		color: #333;
	}
	#gallery ul a:hover { color: #333; }
	</style>


<!-- FIN GALERIA JQUERY -->


    <script src="utilidades/src/js/jscal2.js"></script>
    <script src="utilidades/src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/steel/steel.css" />
	
	
    <link rel="stylesheet" type="text/css" href="formularios.css" />



</head>

<body >


<?php

                                                



$ancho = $_GET["ancho"];
$anchoa = $ancho - 20 ."px";

                                   echo  "<div  class='global_frame' style='width:$anchoa'>";
								   

echo "<div style='width:$anchoa px;padding:10px'> <!--   ttt -->";




$suma_pasajeros = $_POST["adulto"] + $_POST["bebe"] + $_POST["nino"] + $_POST["nino1"] + $_POST["nino2"] + $_POST["senior"];

if($suma_pasajeros < 1){
echo "Debe seleccionar la cantidad de pasajeros<br>
      <input type='button' value='volver' onclick='history.go(-1)' style='cursor:pointer'><br><br>
	  ";

}else{ //if($suma_pasajeros < 1){

$sql_ar = mysql_query("select * from articulo where clave_sub2_ar='$_GET[id]' and estado='libre' and idd_fecha = '$fecha_excursion' ");
$cta_ar = mysql_num_rows($sql_ar);

if($cta_ar >= $suma_pasajeros){ //ACA VA LA VENTA!!!!!!!!!!!!


if(isset($_GET["id_v"])){
$clave_vendedor = "&id_v=".$_GET["id_v"];
}else{//if(isset($_GET["id_v"])){
$clave_vendedor = "";
}//if(isset($_GET["id_v"])){

echo "<form method='post' action='paso2_frame.php?id=$_GET[id]$clave_vendedor&ancho=$_GET[ancho]' name='paso1'>";


##--->>>> CALCULA GUITA CON DESCUENTOS
##--->>>> CALCULA GUITA CON DESCUENTOS


$desc1= 0;
$desc2= 0;
$desc3= 0;
$desc4= 0;
$desc5= 0;

$ad[1] = 0;
$ad[2] = 0;
$ad[3] = 0;
$ad[4] = 0;
$ad[5] = 0;
$ad[6] = 0;
$ad[7] = 0;
$ad[8] = 0;
$ad[9] = 0;
$ad[10] = 0;

$lee_ar = mysql_fetch_assoc($sql_ar);

$sql_ad = mysql_query("select * from adicionales where idd_sub2 = '$_GET[id]' ");
$cta_ad = mysql_num_rows($sql_ad);

if($cta_ad > 0){


for($i=1;$i<=$cta_ad;$i++){

$lee_ad = mysql_fetch_assoc($sql_ad);
$clave_ad = $lee_ad["id_adicional"];

if(isset($_POST["ad".$clave_ad])){
$ad[$i] = $lee_ad["precio_ad"];

echo "<input type='hidden' name='ad$i' value='$clave_ad'>";

}//if(isset($_POST["ad".$lee_ad["id_adicional"])){

}//for($i=1;$i<=$cta_ad;$i++){

} //if($cta_ad > 0){

$suma_adicionales = $ad[1] + $ad[2] + $ad[3] + $ad[4] + $ad[5] + $ad[6] + $ad[7] + $ad[8] + $ad[9] + $ad[10];
$precio_ar = $lee_ar["precio"] + $suma_adicionales;

$bruto_guita =  $precio_ar * $suma_pasajeros;

echo "<b>Total sin descuentos: $".$bruto_guita."</b><br>";

if($_POST["bebe"]>0){

if($_POST["adic_desc_bebe"]=="si"){
$usa_precio = $precio_ar;

}else{ //if($_POST["adic_desc_bebe"]=="si"){
$usa_precio =  $lee_ar["precio"];
echo "<br> rome";
} //if($_POST["adic_desc_bebe"]=="si"){

$desc = ($_POST["num_bebe"] * $usa_precio)/100;
$desc1 = $desc * $_POST["bebe"];

}//if($_POST["bebe"]>0){

if($_POST["nino"]>0){

if($_POST["adic_desc_nino"]=="si"){
$usa_precio = $precio_ar;
}else{ //if($_POST["adic_desc_nino"]=="si"){
$usa_precio =  $lee_ar["precio"];
} //if($_POST["adic_desc_nino"]=="si"){

$desc = ($_POST["num_nino"] * $usa_precio)/100;
$desc2 = $desc * $_POST["nino"];

}//if($_POST["bebe"]>0){


if($_POST["nino1"]>0){

if($_POST["adic_desc_nino1"]=="si"){
$usa_precio = $precio_ar;
}else{ //if($_POST["adic_desc_nino1"]=="si"){
$usa_precio =  $lee_ar["precio"];
} //if($_POST["adic_desc_nino1"]=="si"){

$desc = ($_POST["num_nino1"] * $usa_precio)/100;
$desc3 = $desc * $_POST["nino1"];

}//if($_POST["nino"]>0){

if($_POST["nino2"]>0){

if($_POST["adic_desc_nino2"]=="si"){
$usa_precio = $precio_ar;
}else{ //if($_POST["adic_desc_nino2"]=="si"){
$usa_precio =  $lee_ar["precio"];
} //if($_POST["adic_desc_nino2"]=="si"){


$desc = ($_POST["num_nino2"] * $usa_precio)/100;
$desc4 = $desc * $_POST["nino2"];

}//if($_POST["nino2"]>0){


if($_POST["senior"]>0){

if($_POST["adic_desc_senior"]=="si"){
$usa_precio = $precio_ar;
}else{ //if($_POST["adic_desc_senior"]=="si"){
$usa_precio =  $lee_ar["precio"];
} //if($_POST["adic_desc_senior"]=="si"){

$desc = ($_POST["num_senior"] * $usa_precio)/100;
$desc5 = $desc * $_POST["senior"];

}//if($_POST["senior"]>0){

$suma_desc = $desc1 + $desc2 + $desc3 + $desc4 + $desc5; 

$neto_guita = $bruto_guita - $suma_desc;

echo "<b>Total con descuentos: $".$neto_guita."</b><br><br>";


##--->>>> FIN CALCULA GUITA CON DESCUENTOS
##--->>>> FIN CALCULA GUITA CON DESCUENTOS





###---|||| PIDE DATOS AL COMPRADOR Y A LOS PASAJEROS
###---|||| PIDE DATOS AL COMPRADOR Y A LOS PASAJEROS

include_once("utilidades/info_reserva_base.inc.php");


$cant_vueltasy = count($codigo_ir);


$s_ir = mysql_query("select * from info_reserva where idd_sub2_ir= '$_GET[id]' order by tipo_ir asc");
$cta_ir = mysql_num_rows($s_ir);

if($cta_ir > 0){

for($cc=1;$cc<=$cta_ir;$cc++){
$l_ir = mysql_fetch_assoc($s_ir);

if($l_ir["tipo_ir"]=="a"){

for($o=1;$o<=$cant_vueltasy;$o++){
if($l_ir["x".$o] =="on"){
$a[$o]="si";    
}else{//if($l_ir["x".$o] =="on"){
$a[$o]="no";
}////if($l_ir["x".$o] =="on"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

} //if($l_ir["tipo_ir"]=="a"){


if($l_ir["tipo_ir"]=="b"){

for($o=1;$o<=$cant_vueltasy;$o++){
if($l_ir["x".$o] =="on"){
$b[$o]="si";    
}else{//if($l_ir["x".$o] =="on"){
$b[$o]="no";
}////if($l_ir["x".$o] =="on"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

} //if($l_ir["tipo_ir"]=="b"){


if($l_ir["tipo_ir"]=="c"){

for($o=1;$o<=$cant_vueltasy;$o++){
if($l_ir["x".$o] =="on"){
$c[$o]="si";    
}else{//if($l_ir["x".$o] =="on"){
$c[$o]="no";
}////if($l_ir["x".$o] =="on"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

} //if($l_ir["tipo_ir"]=="c"){


if($l_ir["tipo_ir"]=="d"){

for($o=1;$o<=$cant_vueltasy;$o++){
if($l_ir["x".$o] =="on"){
$d[$o]="si";    
}else{//if($l_ir["x".$o] =="on"){
$d[$o]="no";
}////if($l_ir["x".$o] =="on"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

} //if($l_ir["tipo_ir"]=="d"){



}//for($c=1;$c<=$cta_ir;$c++){




//comprador



echo "Datos del comprador: <br><br>";

for($o=1;$o<=$cant_vueltasy;$o++){
if($a[$o] =="si"){

if($b[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : <span style='color:#ff0000;font-size:10px;text-transform:lowercase'>* dato obligatorio</span></div>
     <input type='text' style='width:25%' name='a$o' id='a$o'>
	 <input type='hidden' name='obli_a$o' value='1' id='obli_a$o'>
	 <br>	 
	 ";

	 }else{ //if($b[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : </div>
     <input type='text' name='a$o'><br>
	 ";
	 


}//if($b[$o]=="si"){
	 
	 
}//if($a["x".$o] =="si"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

//comprador


//invitados  ------>
//invitados  ------>

//adultos


if($_POST["adulto"]>0){

for($dc=1;$dc<=$_POST["adulto"];$dc++){

echo "<div style='width:30%;float:left'>"; //&&&&&&&&&&

echo "<br> <span style='font-size:14px'>Datos del pasajero adulto $dc: </span><br><br>";




for($o=1;$o<=$cant_vueltasy;$o++){



if($c[$o] =="si"){

if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : <span style='color:#ff0000;font-size:10px;text-transform:lowercase'>* dato obligatorio</span></div>
     <input type='text' name='inv_adulto_$dc"."_".$o."' id='inv_adulto_$dc"."_".$o."' >
	 <input type='hidden' name='obli_inv_adulto_$dc"."_".$o."' id='obli_inv_adulto_$dc"."_".$o."' value='1' >
	 <br> ";

	 }else{ //if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : </div>
     <input type='text' name='inv_adulto_$dc"."_".$o."'><br> ";


}//if($d[$o]=="si"){
	 
	 
}//if($a["x".$o] =="si"){




}//for($o=1;$o<=$cant_vueltasy;$o++){



echo "</div>"; //&&&&&&&&&&

} //for($dc=1;$dc<=$_POST["adulto"];$dc++){

//echo "<div style='clear:both'></div>";

} //if($_POST["adulto"]>0){

//fin adultos


//bebe


if($_POST["bebe"]>0){

for($dc=1;$dc<=$_POST["bebe"];$dc++){

echo "<div style='width:30%;float:left'>"; //&&&&&&&&&&

echo "<br> Datos del pasajero beb� $dc: <br><br>";




for($o=1;$o<=$cant_vueltasy;$o++){
if($c[$o] =="si"){

if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : <span style='color:#ff0000;font-size:10px;text-transform:lowercase'>* dato obligatorio</span></div>
     <input type='text' name='inv_bebe_$dc"."_".$o."' id='inv_bebe_$dc"."_".$o."' >
	 <input type='hidden' name='obli_inv_bebe_$dc"."_".$o."' id='obli_inv_bebe_$dc"."_".$o."' value='1' >
	 <br> ";

	 }else{ //if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : </div>
     <input type='text' name='inv_bebe_$dc"."_".$o."'><br> ";


}//if($d[$o]=="si"){
	 
	 
}//if($a["x".$o] =="si"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

echo "</div>"; //&&&&&&&&&&

} //for($dc=1;$dc<=$_POST["adulto"];$dc++){

//echo "<div style='clear:both'></div>";

} //if($_POST["bebe"]>0){

//fin bebe

//nino


if($_POST["nino"]>0){

for($dc=1;$dc<=$_POST["nino"];$dc++){

echo "<div style='width:30%;float:left'>"; //&&&&&&&&&&

echo "<br> <span style='font-size:14px'>Datos del pasajero ni�o cat. 1 $dc: </span><br><br>";




for($o=1;$o<=$cant_vueltasy;$o++){
if($c[$o] =="si"){

if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : <span style='color:#ff0000;font-size:10px;text-transform:lowercase'>* dato obligatorio</span></div>
     <input type='text' name='inv_nino_$dc"."_".$o."' id='inv_nino_$dc"."_".$o."' >
	 <input type='hidden' name='obli_inv_nino_$dc"."_".$o."' id='obli_inv_nino_$dc"."_".$o."' value='1'>
	 <br> ";

	 }else{ //if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : </div>
     <input type='text' name='inv_nino_$dc"."_".$o."'><br> ";


}//if($d[$o]=="si"){
	 
	 
}//if($a["x".$o] =="si"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

echo "</div>"; //&&&&&&&&&&

} //for($dc=1;$dc<=$_POST["adulto"];$dc++){

echo "<div style='clear:both'></div>";

} //if($_POST["nino"]>0){

//fin nino


if($_POST["nino1"]>0){

for($dc=1;$dc<=$_POST["nino1"];$dc++){

echo "<div style='width:30%;float:left'>"; //&&&&&&&&&&

echo "<br> <span style='font-size:14px'>Datos del pasajero ni�o cat. 2 $dc: </span><br><br>";




for($o=1;$o<=$cant_vueltasy;$o++){
if($c[$o] =="si"){

if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : <span style='color:#ff0000;font-size:10px;text-transform:lowercase'>* dato obligatorio</span></div>
     <input type='text' name='inv_nino1_$dc"."_".$o."' id='inv_nino1_$dc"."_".$o."' >
	 <input type='hidden' name='obli_inv_nino1_$dc"."_".$o."' id='obli_inv_nino1_$dc"."_".$o."' value='1' >
	 <br> ";

	 }else{ //if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : </div>
     <input type='text' name='inv_nino1_$dc"."_".$o."'><br> ";


}//if($d[$o]=="si"){
	 
	 
}//if($a["x".$o] =="si"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

echo "</div>"; //&&&&&&&&&&

} //for($dc=1;$dc<=$_POST["adulto"];$dc++){

echo "<div style='clear:both'></div>";

} //if($_POST["nino1"]>0){

//fin nino1


if($_POST["nino2"]>0){

for($dc=1;$dc<=$_POST["nino2"];$dc++){

echo "<div style='width:30%;float:left'>"; //&&&&&&&&&&

echo "<br> <span style='font-size:14px'>Datos del pasajero nino categoria 3 $dc: </span><br><br>";




for($o=1;$o<=$cant_vueltasy;$o++){
if($c[$o] =="si"){

if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : <span style='color:#ff0000;font-size:10px;text-transform:lowercase'>* dato obligatorio</span></div>
     <input type='text' name='inv_nino2_$dc"."_".$o."' id='inv_nino2_$dc"."_".$o."' >
	 <input type='hidden' name='obli_inv_nino2_$dc"."_".$o."' id='obli_inv_nino2_$dc"."_".$o."' value='1' >
	 <br> ";

	 }else{ //if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : </div>
     <input type='text' name='inv_nino2_$dc"."_".$o."'><br> ";


}//if($d[$o]=="si"){
	 
	 
}//if($a["x".$o] =="si"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

echo "</div>"; //&&&&&&&&&&

} //for($dc=1;$dc<=$_POST["adulto"];$dc++){

echo "<div style='clear:both'></div>";

} //if($_POST["nino2"]>0){

//fin nino2


if($_POST["senior"]>0){

for($dc=1;$dc<=$_POST["senior"];$dc++){

echo "<div style='width:30%;float:left'>"; //&&&&&&&&&&

echo "<br> <span style='font-size:14px'>Datos del pasajero senior $dc: </span><br><br>";




for($o=1;$o<=$cant_vueltasy;$o++){
if($c[$o] =="si"){

if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : <span style='color:#ff0000;font-size:10px;text-transform:lowercase'>* dato obligatorio</span></div>
     <input type='text' name='inv_senior_$dc"."_".$o."' id='inv_senior_$dc"."_".$o."'>
	 <input type='hidden' name='obli_inv_senior_$dc"."_".$o."' id='obli_inv_senior_$dc"."_".$o."'>
	 <br> ";

	 }else{ //if($d[$o]=="si"){

echo "<div class='titulo_form'>$codigo_ir[$o] : </div>
     <input type='text' name='inv_senior_$dc"."_".$o."'><br> ";


}//if($d[$o]=="si"){
	 
	 
}//if($a["x".$o] =="si"){

}//for($o=1;$o<=$cant_vueltasy;$o++){

echo "</div >"; //&&&&&&&&&&

} //for($dc=1;$dc<=$_POST["adulto"];$dc++){

echo "<div style='clear:both'></div>";

} //if($_POST["senior"]>0){

//fin senior


//invitados  ------>
//invitados  ------>

} //if($cta_ir > 0){

###---|||| FIN PIDE DATOS AL COMPRADOR Y A LOS PASAJEROS
###---|||| FIN PIDE DATOS AL COMPRADOR Y A LOS PASAJEROS



echo "<div style='clear:both'></div>";

$id_carga = time();

echo "<input type='hidden' name='total_guita' value='$neto_guita'>
     <input type='hidden' name='id_empresa' value='$_POST[id_empresa]'>
     <input type='hidden' name='id_carga' value='$id_carga'>
     <input type='hidden' name='fecha_excursion' value='$fecha_excursion'>
     <input type='hidden' name='adulto' value='$_POST[adulto]'>
     <input type='hidden' name='bebe' value='$_POST[bebe]'>
     <input type='hidden' name='nino' value='$_POST[nino]'>
     <input type='hidden' name='nino1' value='$_POST[nino1]'>
     <input type='hidden' name='nino2' value='$_POST[nino2]'>
     <input type='hidden' name='senior' value='$_POST[senior]'>
     <input type='hidden' name='escribano_venta' value='ok'>
     <input type='button' onclick='valida_compra()' value='Confirmar compra' style='cursor:pointer;height:50px' >
     </form>";




}else{ //if($cta_ar >= $suma_pasajeros){ //ACA VA LA VENTA!!!!!!!!!!
echo "Lo sentimos, no tenemos disponibilidad para los dias solicitados";
} //if($cta_ar >= $suma_pasajeros){


} //if($suma_pasajeros < 1){




?>


</div><!--   ttt -->

<div style="clear:both"></div>


<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="javascript:history.go(-1)"><img src="utilidades/imagenes/bot_volver.png" title="Volver al panel"></a></div>	


<?php
//include_once("pie.inc.php");
?>





                                                         </div>




</body>
</html>
