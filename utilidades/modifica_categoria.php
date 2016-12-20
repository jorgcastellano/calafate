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





$categoria = $_POST["categoria"];



$categoria1 = stripslashes( $categoria );

$texto = $_POST["elm1"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );

if($_POST["publicar"]=="on"){
$publicar = "si";
}else{//if($_POST["publicar"]=="on"){
$publicar = "";
}//if($_POST["publicar"]=="on"){


if($_FILES["foto"]["size"]>0){
mysql_query("UPDATE categoria SET nombre_categoria='$categoria1',foto_categoria='fotos_categorias/$nombre_foto',texto_categoria='$texto1',publica_categoria='$publicar' where clave= '$_POST[clave_categoria]'");

}else{//if($_FILES["foto"]["size"]>0){

mysql_query("UPDATE categoria SET nombre_categoria='$categoria1',texto_categoria='$texto1',publica_categoria='$publicar' where clave= '$_POST[clave_categoria]'");


}//if($_FILES["foto"]["size"]>0){

if($_POST["borra_foto"]=="on" && $_FILES["foto"]["size"]<1){
mysql_query("UPDATE categoria SET foto_categoria='' where clave = '$_POST[clave_categoria]' ");
}


}//cierra if escribano


//cambia ubicacion

if($_POST["escribano_ubicacion"]=="ok"){

$sql = mysql_query("select * from categoria  order by nombre_categoria asc");
$cta_sql = mysql_num_rows($sql);

for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);

$ubicacion = $_POST["ubicacion_categoria$c"];

mysql_query("UPDATE categoria SET ubicacion_categoria = '$ubicacion'  where clave = '$lee_sql[clave]' ");

  }//for($c=1;$c<=$cta_sql;$c++){

}//if($_POST["escribano_posicion"]=="ok"){


//fin cambia ubicacion

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>MODIFICA CATEGORIA</title>
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


if($_POST["clave_categoria"]==""){

echo "<div>";
echo "<form method='post' action='$_SERVER[php_self]' enctype='multipart/form-data'>";
echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

$sql = mysql_query("select * from categoria  order by nombre_categoria asc");
$cta_sql = mysql_num_rows($sql);
echo "Elegir categoria:<br>";
echo "El numero de la derecha indica la ubicacion en la que se publica. Si desea modificarla debe hacerlo desde aqui.<br><br>";

for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);

if($lee_sql["publica_categoria"]=="si"){

$clave = $lee_sql["clave"];
$nombre_categoria = $lee_sql["nombre_categoria"];

echo "<div class='recuadro' style='width:50px'>";
echo "<input type='radio' name='clave_categoria' value='$clave'>";
echo "</div>";

echo "<div class='recuadro' style='width:670px;text-align:left'>";
echo  "&nbsp;".$nombre_categoria;
echo "</div>";

echo "<div  style='width:50px;float:left'>";
echo "<input type='text' name='ubicacion_categoria$c' value='$lee_sql[ubicacion_categoria]' class='recuadro' style='width:50px;height:18px'>";
echo "</div>";



echo "<div style='clear:both'></div>";

}else{//if($lee_sql["publica_categoria"]=="si"){

$clave = $lee_sql["clave"];
$nombre_categoria = $lee_sql["nombre_categoria"];

echo "<div class='recuadro' style='width:50px'>";
echo "<input type='radio' name='clave_categoria' value='$clave'>";
echo "</div>";

echo "<div class='recuadro1' style='width:670px;text-align:left'>";
echo  "&nbsp;".$nombre_categoria;
echo "</div>";

echo "<div  style='width:50px;float:left'>";
echo "<input type='text' name='ubicacion_categoria$c' value='$lee_sql[ubicacion_categoria]' class='recuadro1' style='width:50px;height:18px'>";
echo "</div>";

echo "<div style='clear:both'></div>";


}//if($lee_sql["publica_categoria"]=="si"){


}// cierra for



echo "<input type='hidden' name='escribano_ubicacion' value='ok' >";
echo "<input type='submit' value='Enviar'>";

echo "</form>";

echo "</div>";

}else{ //if($_POST["categoria"]==""){

$sql1 = mysql_query("select * from categoria where clave='$_POST[clave_categoria]'");
$lee_sql1 = mysql_fetch_assoc($sql1);

echo "<form method='post' action='$_SERVER[php_self]' enctype='multipart/form-data'>";

if($lee_sql1["publica_categoria"]=="si"){

echo "<div class='recuadro' style='width:780px'>";
echo "Publicar:&nbsp;<input type='checkbox' name='publicar' checked='checked'><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";



}else{//if($lee_sql1["destacar"]=="si"){

echo "<div class='recuadro' style='width:780px'>";
echo "Publicar:&nbsp;<input type='checkbox' name='publicar'><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";

}//if($lee_sql1["destacar"]=="si")



echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";


echo "<br>Nombre de la categoria:<br>";
echo "<input type='text' name='categoria' value='$lee_sql1[nombre_categoria]' ><br><br>";


echo "Texto:<br>";
echo "<textarea id='elm1' name='elm1' rows='2' cols='2' >$lee_sql1[texto_categoria]</textarea><br><br>";

if($lee_sql1["foto_categoria"]==""){
echo "No hay foto cargada<br><br>";

}else{ //if($lee_sql1["foto_categoria"]==""){
echo "<br><img src='$lee_sql1[foto_categoria]' width=200><br>";
echo "Borrar esta foto:&nbsp;<input type='checkbox' name='borra_foto'><br>";
}

echo "Foto:<br>";
echo "<input type='file' name='foto'><br><br>";

echo "<input type='hidden' name='clave_categoria' value='$_POST[clave_categoria]'>";
echo "<input type='hidden' name='escribano' value='ok'>";
echo "<input type='submit' value='cargar'>";



echo "</form>";


}//cierra

?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>

</body>
</html>
