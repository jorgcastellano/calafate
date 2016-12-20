<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if($_SESSION["tipo"]=="vendedor"){

echo "<script>alert('Solo autorizado para administradores')</script>";
echo "<script>location.href='index.php'</script>";
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

<script>

function imprimiri(){
  var objeto=document.getElementById('imprimime');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vac�a nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}
	
</script>

	
</head>

<body>

         <div class="global" >

<?php

include_once("encabezado.inc.php");

?>

<div style="padding:10px"> <!-- """""" -->


<div style="width:180px;float:left;margin-left:10px;background-color:#f3f3f3;padding-top:20px;margin-top:10px;padding-left:20px;padding-bottom:20px;margin-right:30px"><!-- columna 1 -->

<input type="button" value="Ventas diarias" onclick="cambia('1')" class="boton1"><br>
<input type="button" value="Caja diaria" onclick="cambia('2')" class="boton1"><br>
<input type="button" value="" onclick="cambia('3')" class="boton1"><br>
<input type="button" value="" onclick="cambia('4')" class="boton1"><br>


</div> <!-- columna 1 -->

<div style="padding:10px;float:left"><!-- columna 2 -->


<?php

//busca_fecha
//busca_fecha

if(isset($_GET["id_fecha"]) && $_GET["id_fecha"] !=""){


//$id_fecha = $_GET["id_fecha"];

$partes = explode("/",$_GET["id_fecha"]);

$dia = $partes[0];
$mes = $partes[1];
$ano = $partes[2];


$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;

$id_fecha = mktime(00,00,00,$mess,$diaa,$anoo);

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



echo "<div style='display:none' id='1'>";
    
include_once("informes_ventas.inc.php");



echo "</div>";


echo "<div style='display:none' id='2'>";
    
include_once("informes_ventas_vendedor.inc.php");



echo "</div>";



?>








<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "desde", "%d/%m/%Y");
      cal.manageFields("f_btn2", "hasta", "%d/%m/%Y");
	  cal.manageFields("f_btn11", "desde_cupon", "%d/%m/%Y");
      cal.manageFields("f_btn22", "hasta_cupon", "%d/%m/%Y");
      

    //]]></script>

	
</div>  <!-- fin columna 2 -->


<div style="clear:both"></div>	
	
	
</div>  <!-- """""" -->

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
