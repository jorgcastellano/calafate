<?php
session_start();
include_once("encabezado.inc.php");

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

<script>	

//----------------------ajax manda mail

function manda_mail(valor){



try{
 //Firefox, Opera 8.0+, Safari
  xml_2=new XMLHttpRequest();
  }
catch (e){
 // Internet Explorer
  try{
    xml_2=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e){
    try{
      xml_2=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Tu navegador no soporta Ajax");
       }
    }
  }



 xml_2.onreadystatechange=function(){
    if(xml_2.readyState==4){
      
	 // document.write(xml_2.responseText);
       //document.getElementById("calendario").innerHTML=xml_2.responseText
	  }
    }


  xml_2.open("GET","manda_mail.php?id="+ valor );
  xml_2.send(null);
  

  

  
  }



//----------------------fin ajax manda mail



</script>	



</head>

<body >




                                                  <div  class="global" >

<?php												  
echo "
<div class='encabezado'>
<div style='color:#fff;font-size:25px;padding-top:150px;padding-left:50px;text-transform:uppercase'>  reserva exitosa ";

if(isset($_GET["id_v"])){

$sql_ven = mysql_query("select * from usuario where id_usuario='$_GET[id_v]' ");
$l_ven = mysql_fetch_assoc($sql_ven);

echo " <span style='color:#555555' >&nbsp; &nbsp; &nbsp; Vendedor: $l_ven[nombre_usuario] </span>";



///graba los billetes
///graba los billetes

$d[1] = "0.10";
$d[2] = "0.25";
$d[3] = "0.50";
$d[4] = "1";
$d[5] = "10";
$d[6] = "20";
$d[7] = "50";
$d[8] = "100";


$e[1] = "2";
$e[2] = "5";
$e[3] = "10";
$e[4] = "20";
$e[5] = "50";
$e[6] = "100";
$e[7] = "200";
$e[8] = "500";


$r[1] = "0.5";
$r[2] = "1";
$r[3] = "2";
$r[4] = "5";
$r[5] = "10";
$r[6] = "20";
$r[7] = "50";
$r[8] = "100";


$c[1] = "10";
$c[2] = "50";
$c[3] = "100";
$c[4] = "1000";
$c[5] = "2000";
$c[6] = "5000";
$c[7] = "10000";
$c[8] = "20000";


for($i=1;$i<9;$i++){

if($_POST["dd".$i] > 0){

$billete = $d[$i];
$cantidad = $_POST["dd".$i];

mysql_query("INSERT INTO cantidad_billetes (moneda_cb,billete_cb,cantidad_cb,vendedor_cb,idd_carga_cb,fecha_cb) VALUES ('dolar','$billete','$cantidad','$_GET[id_v]','$_POST[id_carga]','$_POST[id_carga]')");


}//if($_POST["dd".$i]){



}//for($i=1;$i<9;$i++){





for($i=1;$i<9;$i++){

if($_POST["ee".$i] > 0){

$billete = $e[$i];
$cantidad = $_POST["ee".$i];

mysql_query("INSERT INTO cantidad_billetes (moneda_cb,billete_cb,cantidad_cb,vendedor_cb,idd_carga_cb,fecha_cb) VALUES ('euro','$billete','$cantidad','$_GET[id_v]','$_POST[id_carga]','$_POST[id_carga]')");


}//if($_POST["ee".$i]){



}//for($i=1;$i<9;$i++){



for($i=1;$i<9;$i++){

if($_POST["rr".$i] > 0){

$billete = $r[$i];
$cantidad = $_POST["rr".$i];

mysql_query("INSERT INTO cantidad_billetes (moneda_cb,billete_cb,cantidad_cb,vendedor_cb,idd_carga_cb,fecha_cb) VALUES ('real','$billete','$cantidad','$_GET[id_v]','$_POST[id_carga]','$_POST[id_carga]')");


}//if($_POST["ee".$i]){



}//for($i=1;$i<9;$i++){




for($i=1;$i<9;$i++){

if($_POST["cc".$i] > 0){

$billete = $c[$i];
$cantidad = $_POST["cc".$i];


mysql_query("INSERT INTO cantidad_billetes (moneda_cb,billete_cb,cantidad_cb,vendedor_cb,idd_carga_cb,fecha_cb) VALUES ('peso chileno','$billete','$cantidad','$_GET[id_v]','$_POST[id_carga]','$_POST[id_carga]')");


}//if($_POST["ee".$i]){



}//for($i=1;$i<9;$i++){


///fin graba los billetes
///fin graba los billetes




}//if(isset($_GET["id_v"])){


echo "</div></div>";				

?>	

											  
<div style="width:50px;float:left">



</div>

<div style="width:1000px;float:left;padding:5px"> <!--   ttt -->

<?php



if(isset($_POST["escribano_vto"])){ // graba vuelto


///graba los billetes vuelto
///graba los billetes vuelto

$d[1] = "0.10";
$d[2] = "0.25";
$d[3] = "0.50";
$d[4] = "1";
$d[5] = "10";
$d[6] = "20";
$d[7] = "50";
$d[8] = "100";


$e[1] = "2";
$e[2] = "5";
$e[3] = "10";
$e[4] = "20";
$e[5] = "50";
$e[6] = "100";
$e[7] = "200";
$e[8] = "500";


$r[1] = "0.5";
$r[2] = "1";
$r[3] = "2";
$r[4] = "5";
$r[5] = "10";
$r[6] = "20";
$r[7] = "50";
$r[8] = "100";


$c[1] = "10";
$c[2] = "50";
$c[3] = "100";
$c[4] = "1000";
$c[5] = "2000";
$c[6] = "5000";
$c[7] = "10000";
$c[8] = "20000";


for($i=1;$i<9;$i++){

if($_POST["dd".$i] > 0){

$billete = $d[$i];
$cantidad = $_POST["dd".$i];

mysql_query("INSERT INTO cantidad_billetes_vuelto (moneda_cb_v,billete_cb_v,cantidad_cb_v,vendedor_cb_v,idd_carga_cb_v) VALUES ('dolar','$billete','$cantidad','$_GET[id_v]','$_POST[id_carga]')");


}//if($_POST["dd".$i]){



}//for($i=1;$i<9;$i++){





for($i=1;$i<9;$i++){

if($_POST["ee".$i] > 0){

$billete = $e[$i];
$cantidad = $_POST["ee".$i];

mysql_query("INSERT INTO cantidad_billetes_vuelto (moneda_cb_v,billete_cb_v,cantidad_cb_v,vendedor_cb_v,idd_carga_cb_v) VALUES ('euro','$billete','$cantidad','$_GET[id_v]','$_POST[id_carga]')");


}//if($_POST["ee".$i]){



}//for($i=1;$i<9;$i++){



for($i=1;$i<9;$i++){

if($_POST["rr".$i] > 0){

$billete = $r[$i];
$cantidad = $_POST["rr".$i];

mysql_query("INSERT INTO cantidad_billetes_vuelto (moneda_cb_v,billete_cb_v,cantidad_cb_v,vendedor_cb_v,idd_carga_cb_v) VALUES ('real','$billete','$cantidad','$_GET[id_v]','$_POST[id_carga]')");


}//if($_POST["ee".$i]){



}//for($i=1;$i<9;$i++){




for($i=1;$i<9;$i++){

if($_POST["cc".$i] > 0){

$billete = $c[$i];
$cantidad = $_POST["cc".$i];


mysql_query("INSERT INTO cantidad_billetes_vuelto (moneda_cb_v,billete_cb_v,cantidad_cb_v,vendedor_cb_v,idd_carga_cb_v) VALUES ('peso chileno','$billete','$cantidad','$_GET[id_v]','$_POST[id_carga]')");


}//if($_POST["ee".$i]){



}//for($i=1;$i<9;$i++){


///fin graba los billetes vuelto
///fin graba los billetes vuelto


echo "<br> &nbsp; Carga OK <br><hr>  Si desea generar el voucher haga click aqui: <br><br>
      
     <input type='button' value='Hacer voucher' style='cursor:pointer;height:50px'   onclick=location.href='utilidades/voucher.php?id=$_POST[id_ventas]&voucher=no&id_sub2=$_POST[idd_sub2_vs]&id_carga=$_POST[id_carga]'  > <br><br>

	 
	 <br>  Si desea volver al panel haga click aqui: <br><br>
      
     <input type='button' value='Ir al panel' style='cursor:pointer;height:50px' onclick=location.href='utilidades/ventas.php?id_fecha=$_POST[id_fecha]'> <br><br>
      "; 




}//if(isset($_POST["escribano_vto"])){ // graba vuelto




















if(isset($_POST["escribano"])){

if($_POST["descuento"]!=""){

$descuento = $_POST["descuento"];

}else{ //if($_POST["descuento"]!=""){

$descuento = 0;

} ////if($_POST["descuento"]!=""){


//$total_guita = $_POST["total_guita"] - $descuento;
$total_guita = $_POST["total_guita"];




$total_guita1 = $_POST["total_pesos"];





if($_POST["tot_peso"] > 0){

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','efectivo','peso argentino','$_POST[cot_peso]','','','$_POST[tot_peso]','$_GET[id_v]','$_POST[id_carga]')");

} //if($_POST["tot_pesos"] > 0){


if($_POST["tot_credito1"] > 0){

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','credito','tarjeta de credito','1','$_POST[cupon_cred1]','$_POST[operacion_cred1]','$_POST[tot_credito1]','$_GET[id_v]','$_POST[id_carga]')");

} //if($_POST["tot_credito1s"] > 0){

if($_POST["tot_credito2"] > 0){

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','credito','tarjeta de credito','1','$_POST[cupon_cred2]','$_POST[operacion_cred2]','$_POST[tot_credito2]','$_GET[id_v]','$_POST[id_carga]')");

} //if($_POST["tot_credito2s"] > 0){


if($_POST["tot_debito1"] > 0){

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','debito','tarjeta de debito','1','$_POST[cupon_deb1]','$_POST[operacion_deb1]','$_POST[tot_debito1]','$_GET[id_v]','$_POST[id_carga]')");

} //if($_POST["tot_debito1s"] > 0){

if($_POST["tot_debito2"] > 0){

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','debito','tarjeta de debito','1','$_POST[cupon_deb2]','$_POST[operacion_deb2]','$_POST[tot_debito2]','$_GET[id_v]','$_POST[id_carga]')");

}//if($_POST["tot_debito2"] > 0){





if($_POST["tot_chileno"] > 0){

$coti_mon = $_POST["tot_chileno"] * $_POST["cot_chileno"];

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','efectivo','peso chileno','$_POST[cot_chileno]','','','$coti_mon','$_GET[id_v]','$_POST[id_carga]')");

} //if($_POST["tot_pesos"] > 0){


if($_POST["tot_real"] > 0){

$coti_mon = $_POST["tot_real"] / $_POST["cot_real"];

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','efectivo','real','$_POST[cot_real]','','','$coti_mon','$_GET[id_v]','$_POST[id_carga]')");

} //if($_POST["tot_pesos"] > 0){

if($_POST["tot_euro"] > 0){

$coti_mon = $_POST["tot_euro"] / $_POST["cot_euro"];

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','efectivo','euro','$_POST[cot_euro]','','','$coti_mon','$_GET[id_v]','$_POST[id_carga]')");

} //if($_POST["tot_pesos"] > 0){



if($_POST["tot_dolar"] > 0){

$coti_mon = $_POST["tot_dolar"] / $_POST["cot_dolar"];

mysql_query("INSERT INTO ventas_pago (idd_venta_vp,medio_pago_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_vp,vendedor_vp,fecha_vp) VALUES ('$_POST[id_carga]','efectivo','dolar','$_POST[cot_dolar]','','','$coti_mon','$_GET[id_v]','$_POST[id_carga]')");

} //if($_POST["tot_pesos"] > 0){


mysql_query("INSERT INTO entra_bruto (total_eb,idd_vendedor_eb,fecha_eb,idd_carga_eb) VALUES ('$total_guita','$_GET[id_v]','$_POST[id_carga]','$_POST[id_carga]')");//carga el total de lo facturado


if($total_guita1 == $total_guita){

//carga el haber

mysql_query("INSERT INTO haber (monto_h, idd_vendedor_h,idd_operacion_h,fecha_h) VALUES ('$total_guita','$_GET[id_v]','$_POST[id_carga]','$_POST[id_carga]')");


//fin carga el haber



$busca_cl = mysql_query("select * from ventas where idd_carga_vs='$_POST[id_carga]' limit 0,1");

$lee_cl = mysql_fetch_assoc($busca_cl);

mysql_query("UPDATE ventas SET estado_vs='pagado',sena_vs='$total_guita1',total_guita_vs='$total_guita',desc_especial_vs='$descuento' where idd_carga_vs='$_POST[id_carga]' ");



$dia = date("d", $lee_cl["fecha_excur_vs"]);
$mes = date("m", $lee_cl["fecha_excur_vs"]);
$ano = date("Y", $lee_cl["fecha_excur_vs"]);

$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;


$id_fecha = mktime(00,00,00,$mess,$diaa,$anoo); 
 
 
echo "<br>  Si desea generar el voucher haga click aqui: <br><br>
      
     <input type='button' value='Hacer voucher' style='cursor:pointer;height:50px'   onclick=location.href='utilidades/voucher.php?id=$lee_cl[id_ventas]&voucher=no&id_sub2=$lee_cl[idd_sub2_vs]&id_carga=$_POST[id_carga]'  > <br><br>

	 
	 <br>  Si desea volver al panel haga click aqui: <br><br>
      
     <input type='button' value='Ir al panel' style='cursor:pointer;height:50px' onclick=location.href='utilidades/ventas.php?id_fecha=$id_fecha'> <br><br>
      "; 
 
  
 
 
}//if($total_guita1 == $total_guita){


if($total_guita1 > $total_guita){

//carga el haber

mysql_query("INSERT INTO haber (monto_h, idd_vendedor_h,idd_operacion_h,fecha_h) VALUES ('$total_guita','$_GET[id_v]','$_POST[id_carga]','$_POST[id_carga]')");


//fin carga el haber



$busca_cl = mysql_query("select * from ventas where idd_carga_vs='$_POST[id_carga]' limit 0,1");

$lee_cl = mysql_fetch_assoc($busca_cl);

mysql_query("UPDATE ventas SET estado_vs='pagado',sena_vs='$total_guita',total_guita_vs='$total_guita',desc_especial_vs='$descuento' where idd_carga_vs='$_POST[id_carga]' ");

$dia = date("d", $lee_cl["fecha_excur_vs"]);
$mes = date("m", $lee_cl["fecha_excur_vs"]);
$ano = date("Y", $lee_cl["fecha_excur_vs"]);

$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;


$id_fecha = mktime(00,00,00,$mess,$diaa,$anoo); 

$vuelto = $total_guita1 - $total_guita;

echo "<div style='background-color:#ffffff'><br>Los valores ingresados son mayores al costo de la operacion. Especifique el vuelto por favor:<br><br>


Monto del vuelto: ar$ <b> $vuelto </b>";

$fecha_vto = time();

mysql_query("INSERT INTO vuelto (cantidad_vto,idd_carga_vto,fecha_vto,vendedor_vto) VALUES ('$vuelto','$_POST[id_carga]','$fecha_vto','$_SESSION[id_usuario]')");	

//pone cantidad de billetes	 
 //pone cantidad de billetes	 
 
echo "<form method='post' action='carga_pago.php?id_v=$_GET[id_v]' name='medio' style='margin-left:10px'>

<br> Especifique la cantidad y tipo de billetes del vuelto en caso que sean monedas extranjeras:<br><br>
<div style='width:200px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'> <!-- 0000 -->
     
	 Dolar:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 0.10 <br>
	 0.25 <br>
	 0.50 <br>
	 1.00 <br>
	 10.00 <br>
	 20.00 <br>
	 50.00 <br>
	 100 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='dd1'><br>
	 <input type='text' style='width:100px;height:11px' name='dd2'><br>
	 <input type='text' style='width:100px;height:11px' name='dd3'><br>
	 <input type='text' style='width:100px;height:11px' name='dd4'><br>
	 <input type='text' style='width:100px;height:11px' name='dd5'><br>
	 <input type='text' style='width:100px;height:11px' name='dd6'><br>
	 <input type='text' style='width:100px;height:11px' name='dd7'><br>
	 <input type='text' style='width:100px;height:11px' name='dd8'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->
	 
	 
	<div style='width:200px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'> <!-- 0000 -->
     
	 Euros:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 2 <br>
	 5 <br>
	 10 <br>
	 20 <br>
	 50 <br>
	 100 <br>
	 200 <br>
	 500 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='ee1'><br>
	 <input type='text' style='width:100px;height:11px' name='ee2'><br>
	 <input type='text' style='width:100px;height:11px' name='ee3'><br>
	 <input type='text' style='width:100px;height:11px' name='ee4'><br>
	 <input type='text' style='width:100px;height:11px' name='ee5'><br>
	 <input type='text' style='width:100px;height:11px' name='ee6'><br>
	 <input type='text' style='width:100px;height:11px' name='ee7'><br>
	 <input type='text' style='width:100px;height:11px' name='ee8'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->
	 
	 
	 <div style='width:200px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'> <!-- 0000 -->
     
	 Reales:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 0.50 <br>
	 1 <br>
	 2 <br>
	 5 <br>
	 10 <br>
	 20 <br>
	 50 <br>
	 100 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='rr1'><br>
	 <input type='text' style='width:100px;height:11px' name='rr2'><br>
	 <input type='text' style='width:100px;height:11px' name='rr3'><br>
	 <input type='text' style='width:100px;height:11px' name='rr4'><br>
	 <input type='text' style='width:100px;height:11px' name='rr5'><br>
	 <input type='text' style='width:100px;height:11px' name='rr6'><br>
	 <input type='text' style='width:100px;height:11px' name='rr7'><br>
	 <input type='text' style='width:100px;height:11px' name='rr8'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->
	 
	 
	<div style='width:200px;padding:10px;height:220px;float:left;background-color:#cccccc;margin-left:10px'> <!-- 0000 -->
     
	 Pesos chilenos:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 10 <br>
	 50 <br>
	 100 <br>
	 1000 <br>
	 2000 <br>
	 5000 <br>
	 10000 <br>
	 20000 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='cc1'><br>
	 <input type='text' style='width:100px;height:11px' name='cc2'><br>
	 <input type='text' style='width:100px;height:11px' name='cc3'><br>
	 <input type='text' style='width:100px;height:11px' name='cc4'><br>
	 <input type='text' style='width:100px;height:11px' name='cc5'><br>
	 <input type='text' style='width:100px;height:11px' name='cc6'><br>
	 <input type='text' style='width:100px;height:11px' name='cc7'><br>
	 <input type='text' style='width:100px;height:11px' name='cc8'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 --> 
	 
	 
	 
	 
	 ";
	 
	 
 
 
 //fin pone cantidad de billetes	 
 //fin pone cantidad de billetes		
	 

	 
echo "<div style='clear:both'></div><br>
     <input type='hidden' name='escribano_vto' value='ok'>
     <input type='hidden' name='id_empresa' value='$_POST[id_empresa]'>
     <input type='hidden' name='id_carga' value='$_POST[id_carga]'>
	 
     <input type='hidden' name='id_ventas' value='$lee_cl[id_ventas]'>
     <input type='hidden' name='idd_sub2_vs' value='$lee_cl[idd_sub2_vs]'>
     <input type='hidden' name='id_fecha' value='$id_fecha'>
	 
	 <input type='submit' style='width:120px;height:40px;background-image:url(utilidades/imagenes/bot_cargar.png);border:0px;cursor:pointer' value=''>
	 </form></div><hr><hr><hr>";



echo "<br>  Si desea generar el voucher haga click aqui: <br><br>
      
     <input type='button' value='Hacer voucher' style='cursor:pointer;height:50px'   onclick=location.href='utilidades/voucher.php?id=$lee_cl[id_ventas]&voucher=no&id_sub2=$lee_cl[idd_sub2_vs]&id_carga=$_POST[id_carga]'  > <br><br>

	 
	 <br>  Si desea volver al panel haga click aqui: <br><br>
      
     <input type='button' value='Ir al panel' style='cursor:pointer;height:50px' onclick=location.href='utilidades/ventas.php?id_fecha=$id_fecha'> <br><br>
      "; 



}//if($total_guita1 > $total_guita){


if($total_guita1 < $total_guita){

//carga el haber

mysql_query("INSERT INTO haber (monto_h, idd_vendedor_h,idd_operacion_h,fecha_h) VALUES ('$total_guita1','$_GET[id_v]','$_POST[id_carga]','$_POST[id_carga]')");


//fin carga el haber

$busca_cl = mysql_query("select * from ventas where idd_carga_vs='$_POST[id_carga]' limit 0,1");

$lee_cl = mysql_fetch_assoc($busca_cl);


$dia = date("d", $lee_cl["fecha_excur_vs"]);
$mes = date("m", $lee_cl["fecha_excur_vs"]);
$ano = date("Y", $lee_cl["fecha_excur_vs"]);

$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;


$id_fecha = mktime(00,00,00,$mess,$diaa,$anoo); 

mysql_query("UPDATE ventas SET estado_vs='se�ado',sena_vs='$total_guita1',total_guita_vs='$total_guita',desc_especial_vs='$descuento' where idd_carga_vs='$_POST[id_carga]' ");

echo "<br>  Si desea volver al panel haga click aqui: <br><br>
      
     <input type='button' value='Ir al panel' style='cursor:pointer;height:50px' onclick=location.href='utilidades/ventas.php?id_fecha=$id_fecha'> <br><br>
      ";




}//if($total_guita1 < $total_guita){


$busca_vp = mysql_query("select * from ventas_pago where idd_venta_vp = '$_POST[id_carga]'");
$cta_vp = mysql_fetch_assoc($busca_vp);


/*

if($cta_vp ==0){




mysql_query("INSERT INTO ventas_pago (idd_venta_vp,moneda_vp,cotizacion_moneda_vp,num_cupon_vp,num_operacion_vp,importe_tarjeta_vp,importe_efectivo_vp) VALUES ('$_POST[id_carga]','$nombre_moneda','$valor_plata','$_POST[num_cupon]','$_POST[num_operacion]','$_POST[importe_tarjeta]','$efect')");




echo "<script>
      alert('ok');
	  location.href='utilidades/index.php';
      </script>";



	  
	  
}//if($cta_vp ==0){

*/

}//if(isset($_POST["escribano"])){

?>



</div><!--   ttt -->

<div style="clear:both"></div>

<?php
//include_once("pie.inc.php");
?>





                                                         </div>




</body>
</html>

