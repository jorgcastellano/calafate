<?php

if(isset($_POST["escribano_cupon"])=="ok"){

$partes = explode("/",$_POST["desde_cupon"]);

$dia = $partes[0];
$mes = $partes[1];
$ano = $partes[2];


$partes1 = explode("/",$_POST["hasta_cupon"]);

$dia1 = $partes1[0];
$mes1 = $partes1[1];
$ano1 = $partes1[2];

$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;

$mess1 = (int)$mes1;
$diaa1 = (int)$dia1;
$anoo1 = (int)$ano1;


$fecha_desde_cupon = mktime(00,00,00,$mess,$diaa,$anoo);
$fecha_hasta_cupon = mktime(00,00,00,$mess1,$diaa1,$anoo1);

$texto = $_POST["elm2_cupon"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );

mysql_query("INSERT INTO cupon_promocional (codigo_cupon,texto_cupon,desde_cupon,hasta_cupon,desc_cupon,cant_usos) VALUES ('$_POST[codigo]','$texto1','$fecha_desde_cupon','$fecha_hasta_cupon','$_POST[desc_cupon]','$_POST[cant_usos]')");


$swe = mysql_query("select * from cupon_promocional where codigo_cupon='$_POST[codigo]' order by id_cupon desc limit 0,1 ");
$l_swe = mysql_fetch_assoc($swe);

for($f=1;$f<=$_POST["cant_usos"];$f++){

mysql_query("INSERT INTO cupones (idd_cupon1,estado_cupon1) VALUES ('$l_swe[id_cupon]','libre')");

} //for($f=1;$f<=$_POST["cant_usos"];$f++){

echo "<script>alert('ok');
     document.getElementById('6').style.display='block'
	 </script>";
} //if(isset($_POST["escribano_cupon"])=="ok"){


#####################################IMPRIME CUPON
#####################################IMPRIME CUPON
#####################################IMPRIME CUPON



echo "<form action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' method='post' name='valida4'>
     
	 
	 <br>Codigo cupon: <input type='text' name='codigo' value=''><br><br>
	 
	 Validez:
	 
	 Desde :
     <input style='width:100px' id='desde_cupon' name='desde_cupon' value='' /><button id='f_btn11'>...</button> &nbsp;
     Hasta: 
     <input style='width:100px' id='hasta_cupon' name='hasta_cupon' value='' /><button id='f_btn22'>...</button><br /><br /> 

     
	 
	 <textarea id='elm2_cupon' name='elm2_cupon' style='width:300px;height:80px' ></textarea><br><br>
	 
	 % de descuento: <input type='text' name='desc_cupon' value=''><br><br>
	 
	 Cantidad de usos: <input type='text' name='cant_usos' value=''><br><br>
	 
     <input type='hidden' name='escribano_cupon' value='ok'>
     <input type='button' onclick='validad()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >
     </form>";




?>