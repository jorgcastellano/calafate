<?php
include_once("conexion.inc.php");


session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if($_POST["escribano"]=="ok"){

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





$articulo = $_POST["articulo"];
$articulo1 = stripslashes( $articulo );

$texto = $_POST["elm1"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );

if($_POST["categoria"]!=""){
$categoria = $_POST["categoria"];
}else{
$categoria = "";
}

if($_POST["sub1"]!=""){
$sub1 = $_POST["sub1"];

}else{
$sub1 = "";
}

if($sub2 = $_POST["sub2"]!=""){
$sub2 = $_POST["sub2"];
}else{
$sub2="";
}


if($_POST["precio"]==""){
$precio = "";
}else{
$precio = $_POST["precio"];
}

if($_POST["stock"]==""){
$stock = "";
}else{
$stock = $_POST["stock"];
}



if($_POST["destacar"]=="on"){
$destacar = "si";
}else{//if($_POST["destacar"]=="on"){
$destacar = "";
}//if($_POST["destacar"]=="on"){


if($_POST["publicar"]=="on"){
$publicar = "si";
}else{//if($_POST["publicar"]=="on"){
$publicar = "";
}//if($_POST["publicar"]=="on"){



if($_FILES["foto"]["size"]>1){

mysql_query("UPDATE articulo  SET clave_categoria_ar='$categoria',clave_sub1_ar='$sub1',clave_sub2_ar='$sub2',nombre_articulo='$articulo1',foto_articulo='fotos_categorias/$nombre_foto',texto_articulo='$texto1',precio='$precio',stock='$stock',publica_articulo='$publicar',destacar='$destacar' where clave = '$_POST[clave_articulo]'");


}else{

mysql_query("UPDATE articulo  SET clave_categoria_ar='$categoria',clave_sub1_ar='$sub1',clave_sub2_ar='$sub2',nombre_articulo='$articulo1',texto_articulo='$texto1',precio='$precio',stock='$stock',publica_articulo='$publicar',destacar='$destacar' where clave = '$_POST[clave_articulo]'");



}

if($_POST["borra_foto"]=="on" && $_FILES["foto"]["size"]<1){
mysql_query("UPDATE articulo SET foto_articulo='' where clave = '$_POST[clave_articulo]' ");
}


}//cierra if escribano



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>MODIFICA ARTICULO</title>
<link href="hoja.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>


</head>

<body>

         <div class="global" >

<div style="width:800px;height:100px;background-image:url(imagenes/encabezado.jpg);margin-bottom:20px"></div>

<div style="padding:10px">


<?php

if($_GET["clave_articulo"]==""){


echo "<div>";


$sql = mysql_query("select * from articulo order by nombre_articulo asc ");
$cta_sql = mysql_num_rows($sql);
echo "Elegir articulo:<br><br>";
for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);
$clave = $lee_sql["clave"];
$nombre_articulo = $lee_sql["nombre_articulo"];

$clave_categoria = $lee_sql["clave_categoria_ar"];
$clave_sub1 = $lee_sql["clave_sub1_ar"];
$clave_sub2 = $lee_sql["clave_sub2_ar"];


if($lee_sql["publica_articulo"]=="si"){

echo "<div style='width:325px;height:23px;text-align:left' class='recuadro'>";
echo "&nbsp;".$nombre_articulo;
echo "</div>";

echo "<div style='height:23px' class='recuadro'>";
echo "<input type='button' value='Modificar el contenido' onclick=location.href='modifica_articulo.php?clave_articulo=$clave&categoria=$clave_categoria&sub1=$clave_sub1&sub2=$clave_sub2' >";
echo "</div>";

/*
echo "<div style='height:23px' class='recuadro'>";
echo "<input type='button' value='Modificar las categorias a las que pertenece' onclick=location.href='modifica_articulo1.php?clave_articulo=$clave' >";

echo "</div>";
*/

echo "<div style='clear:both;height:0px'></div>";


}else{//if($lee_sql["publica_articulo"]=="si"){

echo "<div style='width:325px;height:23px;text-align:left' class='recuadro1'>";
echo "&nbsp;".$nombre_articulo;
echo "</div>";

echo "<div style='height:23px' class='recuadro1'>";
echo "<input type='button' value='Modificar el contenido' onclick=location.href='modifica_articulo.php?clave_articulo=$clave&categoria=$clave_categoria&sub1=$clave_sub1&sub2=$clave_sub2' >";
echo "</div>";

/*
echo "<div style='height:23px' class='recuadro1'>";
echo "<input type='button' value='Modificar las categorias a las que pertenece' onclick=location.href='modifica_articulo1.php?clave_articulo=$clave' >";

echo "</div>";
*/

echo "<div style='clear:both;height:0px'></div>";


}//if($lee_sql["publica_articulo"]=="si"){


}// cierra for


echo "</div>";




}else{ //if($_GET["clave_articulo"]==""){

$sql1 = mysql_query("select * from articulo where clave = '$_GET[clave_articulo]'");
$lee_sql1 = mysql_fetch_assoc($sql1);

echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>";

echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

if($lee_sql1["publica_articulo"]=="si"){

echo "<div class='recuadro' style='width:780px'>";
echo "Publicar:&nbsp;<input type='checkbox' name='publicar' checked='checked' ><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";


}else{//if($lee_sql1[publica_articulo]=="si"){

echo "<div class='recuadro' style='width:780px'>";
echo "Publicar:&nbsp;<input type='checkbox' name='publicar' ><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";


}//if($lee_sql1[publica_articulo]=="si")


echo "<br>Nombre del articulo:<br>";
echo "<input type='text' name='articulo' value='$lee_sql1[nombre_articulo]'><br><br>";


echo "Texto:<br>";
echo "<textarea id='elm1' name='elm1' rows='2' cols='2' >$lee_sql1[texto_articulo]</textarea><br><br>";

if($lee_sql1["foto_articulo"]==""){
echo "No hay foto cargada<br><br>";

}else{ //if($lee_sql1["foto_sub1"]==""){
echo "<br><img src='$lee_sql1[foto_articulo]' width=200><br>";
echo "Borrar esta foto:&nbsp;<input type='checkbox' name='borra_foto'><br>";
}

echo "Foto:<br>";
echo "<input type='file' name='foto'><br><br>";

echo "<br>Precio (solo el numero, sin el signo $):<br>";
echo "<input type='text' name='precio' value='$lee_sql1[precio]'><br><br>";

echo "<br>Stock (solo el numero):<br>";
echo "<input type='text' name='stock' value='$lee_sql1[stock]' ><br><br>";

/*
if($lee_sql1["especial"]=="si"){

echo "<div class='recuadro' style='width:780px'>";
echo "Poner especial de la semana:&nbsp;<input type='checkbox' name='especial' checked='checked' ><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";


}else{//if($lee_sql1[publica_especial]=="si"){

echo "<div class='recuadro' style='width:780px'>";
echo "especial:&nbsp;<input type='checkbox' name='especial' ><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";


}//if($lee_sql1[publica_articulo]=="si")
*/


if($lee_sql1["destacar"]=="si"){

echo "<div class='recuadro' style='width:780px'>";
echo "Destacar:&nbsp;<input type='checkbox' name='destacar' checked='checked' ><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";


}else{//if($lee_sql1[publica_destacar]=="si"){

echo "<div class='recuadro' style='width:780px'>";
echo "Destacar:&nbsp;<input type='checkbox' name='destacar' ><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";


}//if($lee_sql1[publica_articulo]=="si")







echo "<input type='hidden' name='clave_articulo' value='$_GET[clave_articulo]'>";
echo "<input type='hidden' name='categoria' value='$_GET[categoria]'>";
echo "<input type='hidden' name='sub1' value='$_GET[sub1]'>";
echo "<input type='hidden' name='sub2' value='$_GET[sub2]'>";

echo "<input type='hidden' name='escribano' value='ok'>";

echo "<br><input type='submit' value='Modificar'>";



echo "</form>";




}//if($_GET["clave_articulo"]==""){
?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>

</body>
</html>
