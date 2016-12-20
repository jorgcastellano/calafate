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


<script src="src/js/jscal2.js"></script>
    <script src="src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="src/css/steel/steel.css" />

	



	
</head>

<body>

         <div style="background-color:#ffffff" > <!-- EEEEE -->

<?php

//include_once("encabezado.inc.php");

?>

<div style="padding:10px">


<?php


//PAGINEO

  
  
  //busco la cantidad total
$busca_total = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' order by id_ventas desc");
$cta_total = mysql_num_rows($busca_total);
  //fin busco la cantidad


$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' order by id_ventas desc limit 0,10");


if(isset($_GET["pagineo0"])!=""){
                   $conteo = -10;
				   for($e=1;$e<550;$e++){
					        $conteo = $conteo + 10;
							$arra_conteo[$e] = $conteo;
							           }
				
				
				
				 	$num_page = $_GET["pagineo0"];
					$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' order by id_ventas desc limit $arra_conteo[$num_page],10");
                       
                                     }


//PAGiNEO



//$sql = mysql_query("select * from ventas where idd_empresa_vs='$_SESSION[logeo]' order by id_ventas desc");
$c_sql = mysql_num_rows($sql);




echo "<div style='border:1px solid #cccccc;width:2000px;height:30px;line-height:30px;font-size:10px;margin-bottom:2px'>

      </div>
	
	  ";


	 



?>


</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div> <!-- EEEEE -->


</body>
</html>
