<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


if($_POST["escribano"]=="ok"){


// hace el tiempo



$partes = explode("/",$_POST["desde"]);

$dia = $partes[0];
$mes = $partes[1];
$ano = $partes[2];


$partes1 = explode("/",$_POST["hasta"]);

$dia1 = $partes1[0];
$mes1 = $partes1[1];
$ano1 = $partes1[2];




$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;

$mess1 = (int)$mes1;
$diaa1 = (int)$dia1;
$anoo1 = (int)$ano1;


$fecha_desde = mktime(00,00,00,$mess,$diaa,$anoo);
$fecha_hasta = mktime(00,00,00,$mess1,$diaa1,$anoo1);


$cantidad_dias = (($fecha_hasta - $fecha_desde) / 86400) + 1;

$idd_fechas = time();

// fin hace el tiempo


//controla que la carga sea un dia posterior al de hoy

if($fecha_desde < $idd_fechas){

echo "<script>
       alert('La fecha de carga debe ser posterior al dia de la fecha');
       history.go(-1);
	   </script>";
       die();
}//($fecha_desde < $idd_fechas)

//controla que la carga sea un dia posterior al de hoy


//funcion reduce fotos

function redimensionar_imagen($imagen, $nombre_imagen_asociada)
   
	 
	 {
       //indicamos el directorio donde se van a colgar las im�genes
       $direc = 'fotos_categorias/';
	   $directorio = "";
       //establecemos los l�mites de ancho y alto
       $nuevo_ancho = 600;
       $nuevo_alto = 600;
 
       //Recojo informaci�n de la im�gen
       $info_imagen = getimagesize($imagen);
       $alto = $info_imagen[1];
       $ancho = $info_imagen[0];
       $tipo_imagen = $info_imagen[2];
 
       //Determino las nuevas medidas en funci�n de los l�mites
       if($ancho > $nuevo_ancho OR $alto > $nuevo_alto)
       {
         if(($alto - $nuevo_alto) > ($ancho - $nuevo_ancho))
         {
           $nuevo_ancho = round($ancho * $nuevo_alto / $alto,0) ;    
         }
         else
         {
           $nuevo_alto = round($alto * $nuevo_ancho / $ancho,0);  
         }
       }
       else //si la imagen es m�s peque�a que los l�mites la dejo igual.
       {
         $nuevo_alto = $alto;
         $nuevo_ancho = $ancho;
       }
 
       // dependiendo del tipo de imagen tengo que usar diferentes funciones
       switch ($tipo_imagen) {
          case 2: //si es jpeg �
           $imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
           $imagen_vieja = imagecreatefromjpeg($imagen);
           //cambio de tama�o�
           imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
           if (!imagejpeg($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
         break;
 
         
       }
       return true; //si todo ha ido bien devuelve true
 
     }

//fin funcion reduce fotos

//funcion reduce fotos

if($_FILES["foto"]["size"]>0){

$temporal = $_FILES["foto"]["tmp_name"];
$foto = $_FILES["foto"]["name"];
$partes = explode(".",$foto);
$cuenta = count($partes)-1;
$extension = "jpg";//$partes[$cuenta];
$texto0 = $partes[0];
$texto = strtolower($texto0);
$nombre_foto = str_replace(" ","-",$texto);
$nombre_foto = str_replace("�","n",$nombre_foto);

$nombre_foto = $nombre_foto.time();                             
									   
									   
$nombre_foto = $nombre_foto.".jpg";									   
move_uploaded_file($temporal,"fotos_categorias/".$nombre_foto); 






//LLAMA A LA FUNCION ADELGAZA FOTOS
   
	
	$ima = "fotos_categorias/".$nombre_foto;
    $ima2 = "fotos_categorias/".$nombre_foto;
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   redimensionar_imagen($imagen, $nombre_imagen_asociada);

     
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS   
  

  
  }else{//cierra if($_FILES["foto"]["size"]>0
  
$nombre_foto = "";  
  
  }//cierra if($_FILES["foto"]["size"]>0





$subcategoria = $_POST["subcategoria_2"];
$subcategoria1 = stripslashes( $subcategoria );

$texto = $_POST["elm1"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);
$texto = nl2br($texto);

$texto1 = stripslashes( $texto );

//busca clave categoria

$sql = mysql_query("select clave_categoria_s1 from subcategoria_1 where clave='$_POST[subcategoria_1]'");
$lee_sql = mysql_fetch_assoc($sql);
$clave_categoria = $lee_sql["clave_categoria_s1"];

//fin busca clave categoria





if($_FILES["foto"]["size"]>1){

$fotof = "fotos_categorias/$nombre_foto";
}else{//if($_FILES["foto"]["size"]>1){
$fotof = "";
}//cierra if($_FILES["foto"]["size"]>1){



mysql_query("INSERT INTO subcategoria_2 (clave_categoria_s2,clave_sub1_s2,nombre_sub2,foto_sub2,texto_sub2,publica_sub2,tiene_stock,capacidad,idd_fechas,precio_sub2,idd_empresa_sub2) VALUES ('$clave_categoria','$_POST[subcategoria_1]','$subcategoria1','$fotof','$texto1','si','$_POST[stock]','$_POST[capacidad]','$idd_fechas','$_POST[precio]','$_SESSION[logeo]')");

$bsql = mysql_query("select * from subcategoria_2 where idd_fechas='$idd_fechas' order by clave desc limit 0,1");
$blee = mysql_fetch_assoc($bsql);

$categoria = $blee["clave_categoria_s2"];
$sub1 = $blee["clave_sub1_s2"];
$sub2 = $blee["clave"];


mysql_query("INSERT INTO fechas (id_fechas,idd_sub2,desde,hasta) VALUES ('$idd_fechas','$sub2','$fecha_desde','$fecha_hasta')");


if($_POST["subcategoria_1"] =="2"){
$capacidad = "1";
}else{ //if($_POST["subcategoria_1"] =="2"){
$capacidad = "$_POST[capacidad]";
} //if($_POST["subcategoria_1"] =="2"){



//forea y grabas los articulos
//forea y grabas los articulos

$dias = $fecha_desde - 86400;

for($x=1;$x<=$cantidad_dias;$x++){

$dias = $dias + 86400; 

for($u=1;$u<=$capacidad;$u++){ // for para hacer la cantidad de articulos por dias

mysql_query("INSERT INTO articulo (clave_categoria_ar,clave_sub1_ar,clave_sub2_ar,nombre_articulo,texto_articulo,precio,idd_fecha,estado) VALUES ('$categoria','$sub1','$sub2','','','$_POST[precio]','$dias','libre')");


} //for($u=1;$u<=$_POST["capacidad"];$u++){ // for para hacer la cantidad de articulos por dias



}//for($x=1;$x<=$cantidad_dias;$x++){


//fin forea y grabas los articulos
//fin forea y grabas los articulos

//graba los espacios para la informacion de la reserva
//graba los espacios para la informacion de la reserva

mysql_query("INSERT INTO info_reserva (idd_sub2_ir,tipo_ir) VALUES ('$sub2','a') ");
mysql_query("INSERT INTO info_reserva (idd_sub2_ir,tipo_ir) VALUES ('$sub2','b') ");
mysql_query("INSERT INTO info_reserva (idd_sub2_ir,tipo_ir) VALUES ('$sub2','c') ");
mysql_query("INSERT INTO info_reserva (idd_sub2_ir,tipo_ir) VALUES ('$sub2','d') ");


//graba los espacios para la informacion de la reserva
//graba los espacios para la informacion de la reserva


header("location: modifica_subcategoria2_nueva.php?clave_sub2=$sub2");

if(isset($_POST["borra_foto"])=="on" && $_FILES["foto"]["size"]<1){
mysql_query("UPDATE subcategoria_1 SET foto_sub1='' where clave = '$_POST[clave_sub1]' ");
}//cierra if($_POST["borra_foto"]=="on" && $_FILES["foto"]["size"]<1){




}//cierra if escribano



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>CARGA SUBCATEGORIA 2</title>
<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<!--<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>-->
<script type="text/javascript" src="validaciones.js" defer="defer"></script>


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

<div style="padding:20px">


<?php



echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data' name='valida0'>";

echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

echo "<input type='hidden' name='subcategoria_1' value='$_POST[subcategoria_1]'>";

echo "<div style='width:200px;float:left'><br>Nombre: </div>";
echo "<div style='width:300px;float:left'><input type='text' name='subcategoria_2' style='width:300px' class='borde_nuevo'></div>
      <div style='clear:both'></div>
      <br>";

echo "<div style='width:200px;float:left'><br>Precio: </div>";
echo "<div style='width:300px;float:left'><input type='text' name='precio' style='width:300px' class='borde_nuevo'></div>
     <div style='clear:both'></div>
     <br>";

echo "<div style='width:200px;float:left'>Texto:<br></div>";
echo "<div style='width:500px;float:left'><textarea id='elm1' name='elm1' style='width:300px;height:80px' class='borde_nuevo'></textarea></div><div style='clear:both'></div><br>";


echo "<div style='display:none'>Foto:<br>";
echo "<input type='file' name='foto'><br><br></div>";



echo "<br><div style='width:200px;float:left'>Vender sin stock: </div>";
echo "<div style='width:300px;float:left'><select name='stock' style='width:300px' class='borde_nuevo'>
      <option>no</option>
      <option>si</option>
      </select><br>
	  </div>
	  <div style='clear:both'></div>
	  ";

echo "<br><div style='width:200px;float:left'>Capacidad: </div>";
echo "<div style='width:300px;float:left'><select name='capacidad' style='width:300px' class='borde_nuevo' >";
      
	  for($c=1;$c<=200;$c++){
	  echo "<option>$c</option>";
	  }
	  
echo  "</select></div>
       <div style='clear:both'></div>
      <br><br>";


echo "<div style='width:200px;float:left'>Desde la fecha:</div>
<div style='width:300px;float:left'><input style='width:265px' id='desde' name='desde' class='borde_nuevo' /><button id='f_btn1'>...</button><br /></div>
<div style='clear:both'></div>

<div style='width:200px;float:left'>Hasta la fecha: </div>
<div style='width:300px;float:left'><input style='width:265px' id='hasta' name='hasta' class='borde_nuevo' /><button id='f_btn2'>...</button><br /></div> 
<div style='clear:both'></div>
      ";


echo "<input type='hidden' name='escribano' value='ok'>";
echo "<input type='button' onclick='valida()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:40px;margin-bottom:40px;cursor:pointer' >";



echo "</form>";



?>


<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "desde", "%d/%m/%Y");
      cal.manageFields("f_btn2", "hasta", "%d/%m/%Y");
      

    //]]></script>

</div>  

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
