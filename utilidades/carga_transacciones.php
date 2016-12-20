<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]=="" && $_SESSION["tipo"]!="superadmin" ){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if(isset($_POST["escribano_transa"])=="ok"){


if($_POST["empresa"]=="" || $_POST["importe"]=="" || $_POST["cantidad"]=="" ){
echo "<script>alert('Debe colocar todos los datos')</script>";
}else{//if($_POST["empresa"]=="" || $_POST["importe"]=="" || $_POST["cantidad"]=="" ){

if(is_numeric($_POST["importe"]) && is_numeric($_POST["cantidad"])){

$fecha = time();

mysql_query("INSERT into transacciones_historial (fecha_th,cantidad_th,idd_empresa_th,plata_th) VALUES ('$fecha','$_POST[cantidad]','$_POST[empresa]','$_POST[importe]') ");


$sdo = mysql_query("select * from transacciones where idd_empresa_tran ='$_POST[empresa]'");

$c_sdo = mysql_num_rows($sdo);

if($c_sdo == 0){
mysql_query("INSERT INTO transacciones (cantidad_tran,idd_empresa_tran) VALUES ('$_POST[cantidad]','$_POST[empresa]') ");
}else{ //if($c_sdo == 0){

$l_sdo = mysql_fetch_assoc($sdo);
$suma = $l_sdo["cantidad_tran"] + $_POST["cantidad"]; 

mysql_query("UPDATE transacciones SET cantidad_tran='$suma' where idd_empresa_tran='$_POST[empresa]'");

}//if($c_sdo == 0){

echo "<script>alert('ok')</script>";

}else{ //if(is_numeric($_POST["importe"]) && is_numeric($_POST["cantidad"])){

echo "<script>alert('Debe colocar valores numericos')
     history.go(-1);
     </script>";
     die();
} //if(is_numeric($_POST["importe"]) && is_numeric($_POST["cantidad"])){



}//if($_POST["empresa"]=="" || $_POST["importe"]=="" || $_POST["cantidad"]=="" ){




}//if(isset($_POST["escribano_transa"])=="ok"){


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>CARGAR EMPRESA</title>

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

echo "Cargar transacciones: <br><br>
      <form method='post' action='$_SERVER[PHP_SELF]'>
      Empresa: <select name='empresa'>
	  <option selected></option>
      ";



$sql = mysql_query("select * from empresa order by nombre_empresa asc");
$c_sql = mysql_num_rows($sql);

for($d=1;$d<=$c_sql;$d++){	  
$l_sql = mysql_fetch_assoc($sql);

echo "<option value='$l_sql[id_empresa]'>$l_sql[nombre_empresa]</option>";

}//for($d=1;$d<=$c_sql;$d++){	  
	  
echo "</select><br><br>
     Cantidad de transacciones: <input type='text' name='cantidad'><br><br>
     Importe: <input type='text' name='importe'><br><br>
	 <input type='hidden' name='escribano_transa' value='ok'>
	 <input type='submit' value='Cargar' style='height:50px;cursor:pointer'>
	 ";	  
	  
	  
?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>


</body>
</html>
