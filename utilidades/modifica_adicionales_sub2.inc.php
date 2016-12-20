<?php
include_once("conexion.inc.php");

session_start();

if(isset($_POST["escribano_adicional"])=="ok"){

if(isset($_POST["habilitar_ad"])){
$check = "si";
}else{ //if(isset($_POST["habilitar_ad"])){
$check = "no";
} //if(isset($_POST["habilitar_ad"])){


if($_POST["r1"]==""){


$r1 = "NULL";
$rr1 = "NULL";
$ad1 = "NULL";


}else{

$r1 = "'".$_POST["r1"]."'";
$rr1 = "'".$_POST["rr1"]."'";
$ad1 = "'".$_POST["ad1"]."'";

}

if($_POST["r2"]==""){


$r2 = "NULL";
$rr2 = "NULL";
$ad2 = "NULL";


}else{

$r2 = "'".$_POST["r2"]."'";
$rr2 = "'".$_POST["rr2"]."'";
$ad2 = "'".$_POST["ad2"]."'";

}


if($_POST["r3"]==""){


$r3 = "NULL";
$rr3 = "NULL";
$ad3 = "NULL";


}else{

$r3 = "'".$_POST["r3"]."'";
$rr3 = "'".$_POST["rr3"]."'";
$ad3 = "'".$_POST["ad3"]."'";

}

if($_POST["r4"]==""){


$r4 = "NULL";
$rr4 = "NULL";
$ad4 = "NULL";


}else{

$r4 = "'".$_POST["r4"]."'";
$rr4 = "'".$_POST["rr4"]."'";
$ad4 = "'".$_POST["ad4"]."'";

}


if($_POST["r5"]==""){


$r5 = "NULL";
$rr5 = "NULL";
$ad5 = "NULL";


}else{

$r5 = "'".$_POST["r5"]."'";
$rr5 = "'".$_POST["rr5"]."'";
$ad5 = "'".$_POST["ad5"]."'";

}




mysql_query("UPDATE adicionales SET nombre_ad='$_POST[nombre_ad]',texto_ad='$_POST[elm2]',precio_ad='$_POST[precio_ad]',habilitar_ad='$check',
ad1=$ad1,
r1=$r1,
rr1=$rr1,
ad2=$ad2,
r2=$r2,
rr2=$rr2,
ad3=$ad3,
r3=$r3,
rr3=$rr3,
ad4=$ad4,
r4=$r4,
rr4=$rr4,
ad5=$ad5,
r5=$r5,
rr5=$rr5 where id_adicional='$_GET[id_adicional]' and idd_sub2='$_GET[clave_sub2]' ");


echo "<script>
      alert('ok');
	  location.href='modifica_subcategoria2_nueva.php?clave_sub2=$_GET[clave_sub2]';
      </script>";

}//if(isset($_POST["escribano_adicional"])=="ok"){

if(isset($_GET["borra"])){

mysql_query("DELETE from adicionales where id_adicional='$_GET[id_adicional]' and idd_sub2='$_GET[clave_sub2]'");


echo "<script>
      alert('Eliminacion ok');
	  location.href='modifica_subcategoria2_nueva.php?clave_sub2=$_GET[clave_sub2]';
      </script>";

die();
}//if(isset($_GET[""])){

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>MODIFICA </title>
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


        <div class="global" >

<?php

include_once("encabezado.inc.php");

?>

<div style="padding:10px">


<?php

//CARGA ADICIONAL

$rt= mysql_query("select * from adicionales where id_adicional='$_GET[id_adicional]' and idd_sub2='$_GET[clave_sub2]'");
$l_rt = mysql_fetch_assoc($rt);

if($l_rt["habilitar_ad"]=="si"){
$check = "checked";
}else{ //if($l_rt["habilitar_ad"]=="si"){
$check = "";
} //if($l_rt["habilitar_ad"]=="si"){

echo "ADICIONALES: <br><br>
      <B>MODIFICAR:</B> <br> 
      <form action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]&id_adicional=$_GET[id_adicional]' method='post' name='valida2'>
     
	 
	 <br>Habilitar: <input type='checkbox' name='habilitar_ad' $check ><br><br>
	 <br>Nombre: <input type='text' name='nombre_ad' value='$l_rt[nombre_ad]'><br><br>
	 
	 <textarea id='elm2' name='elm2' style='width:300px;height:80px' >$l_rt[texto_ad]</textarea><br><br>
	 
	 Precio: <input type='text' name='precio_ad' value='$l_rt[precio_ad]'><br><br>
	
	 Rangos de precio por edades:<br><br>
	 
	 (ej: personas entre 1 y 5 a�os $40 - El signo $ no hay que ponerlo)<br><br>
	 
	 Personas entre :  <input type='text' name='r1' value='$l_rt[r1]' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr1' value='$l_rt[rr1]' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad1' value='$l_rt[ad1]'><br>

    Personas entre :  <input type='text' name='r2' value='$l_rt[r2]' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr2' value='$l_rt[rr2]' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad2' value='$l_rt[ad2]'><br>

    Personas entre :  <input type='text' name='r3' value='$l_rt[r3]' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr3' value='$l_rt[rr3]' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad3' value='$l_rt[ad3]'><br>

    Personas entre :  <input type='text' name='r4' value='$l_rt[r4]' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr4' value='$l_rt[rr4]' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad4' value='$l_rt[ad4]'><br>

	Personas entre :  <input type='text' name='r5' value='$l_rt[r5]' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr5' value='$l_rt[rr5]' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad5' value='$l_rt[ad5]'><br>
	 
	 
	 <br>
	 
     <input type='hidden' name='escribano_adicional' value='ok'>
    <input type='button' value='MODIFICAR' onclick='validab()' style='height:40px' >
    <input type='button' value='ELIMINAR' onclick=location.href='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]&id_adicional=$_GET[id_adicional]&borra=si' style='height:40px;margin-left:100px;background-color:#ff0000;color:#ffffff;cursor:pointer' >
     </form>";


//FIN CARGA ADICIONAL



?>




</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div><!-- global-->


</body>
</html>
