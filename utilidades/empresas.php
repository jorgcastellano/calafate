<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]=="" && $_SESSION["tipo"]!="superadmin" ){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if(isset($_POST["escribano_transa"])=="ok"){




}//if(isset($_POST["escribano_transa"])=="ok"){


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>EMPRESA</title>

<link href="hoja.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>

<script>

function paso11(){
if (document.paso1.categoria.value.length==0){
alert("debe elegir una opcion");
document.paso1.categoria.focus();

return 0;
}//if (document.goal.cuerpo.value.length==0){

document.paso1.submit();

} //function paso11(){


function paso22(){
if (document.paso2.subcategoria_1.value.length==0){
alert("debe elegir una opcion");
document.paso2.subcategoria_1.focus();

return 0;
}//if (document.goal.cuerpo.value.length==0){

document.paso2.submit();

} //function paso11(){


</script>

</head>

<body>

<div class="global" >

<div style="width:800px;height:100px;background-image:url(imagenes/encabezado.jpg);margin-bottom:20px"></div>

<div style="padding:10px;font-size:12px">


<?php	



$sql = mysql_query("select * from empresa order by nombre_empresa asc");
$c_sql = mysql_num_rows($sql);

echo "
      <div style='width:200px;float:left'><b>Empresa</b></div>
      <div style='width:200px;float:left;text-align:center'><b>Transacciones <br> disponibles</b></div>
      <div style='width:200px;float:left;text-align:center'><b>Transacciones <br> usadas</b></div>
      <div style='clear:both'></div><br>
	  ";

for($d=1;$d<=$c_sql;$d++){	  
$l_sql = mysql_fetch_assoc($sql);

$de = mysql_query("select * from transacciones where idd_empresa_tran='$l_sql[id_empresa]'");
$l_de = mysql_fetch_assoc($de);

$de1 = mysql_query("select * from transacciones1 where idd_empresa_tran1='$l_sql[id_empresa]'");
$c_de1 = mysql_num_rows($de1);

$dife = $l_de["cantidad_tran"] - $c_de1;



echo "
      <div style='width:200px;float:left'>$l_sql[nombre_empresa]</div>
      <div style='width:200px;float:left;text-align:center'>$dife</div>
      <div style='width:200px;float:left;text-align:center'>$c_de1</div>
      <div style='clear:both'></div><hr>
	  ";




}//for($d=1;$d<=$c_sql;$d++){	  
	  

	  
	  
?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>


</body>
</html>
