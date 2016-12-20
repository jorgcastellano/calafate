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
   if($_FILES["foto"]["size"]>0){
	//echo "<script>alert('$nombre_foto')<script>"; 
	$ima = "fotos_categorias/".$nombre_foto;
    $ima2 = "fotos_categorias/".$nombre_foto;
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   redimensionar_imagen($imagen, $nombre_imagen_asociada);

   }  
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS   
  

  
  }else{//cierra if($_FILES["foto"]["size"]>0
  
$nombre_foto = "";  
  
  }//cierra if($_FILES["foto"]["size"]>0





$articulo = $_POST["articulo"];
$articulo1 = htmlentities( $articulo );

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


if($_FILES["foto"]["size"]>1){

mysql_query("INSERT INTO articulo (clave_categoria_ar,clave_sub1_ar,clave_sub2_ar,nombre_articulo,foto_articulo,texto_articulo,precio,stock,publica_articulo,destacar) VALUES ('$categoria','$sub1','$sub2','$articulo1','fotos_categorias/$nombre_foto','$texto1','$precio','$stock','si','$destacar')");


}else{//if($_FILES["foto"]["size"]>1){

mysql_query("INSERT INTO articulo (clave_categoria_ar,clave_sub1_ar,clave_sub2_ar,nombre_articulo,texto_articulo,precio,stock,publica_articulo,destacar) VALUES ('$categoria','$sub1','$sub2','$articulo1','$texto1','$precio','$stock','si','$destacar')");



}//if($_FILES["foto"]["size"]>1){


//---------busca la la clave de lo insertado y va a agregar mas fotos

$bsql = mysql_query("select * from articulo order by clave desc limit 0,1");
$blee = mysql_fetch_assoc($bsql);

$categoria = $blee["clave_categoria_ar"];
$sub1 = $blee["clave_sub1_ar"];
$sub2 = $blee["clave_sub2_ar"];
$articulo = $blee["clave"];

header("location: carga_fotos.php?categoria=$categoria&sub1=$sub1&sub2=$sub2&sub1=$sub1&articulo=$articulo&carga_articulo=si");

//---------fin busca la la clave de lo insertado y va a agregar mas fotos




if($_POST["borra_foto"]=="on" && $_FILES["foto"]["size"]<1){
mysql_query("UPDATE articulo SET foto_articulo='' where clave = '$_POST[clave_articulo]' ");
}




}//cierra if escribano



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>CARGA ARTICULO</title>
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


echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>";

echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

$sql = mysql_query("select categoria.nombre_categoria, subcategoria_1.* from categoria left outer join subcategoria_1 on categoria.clave = subcategoria_1.clave_categoria_s1 where nombre_sub1 <> '' order by subcategoria_1.nombre_sub1 asc");
$cta_sql = mysql_num_rows($sql);

echo "<div class='recuadro' style='width:780px'>";
echo "Destacar:&nbsp;<input type='checkbox' name='destacar' ><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";


echo "<br>Nombre del articulo:<br>";
echo "<input type='text' name='articulo'><br><br>";


echo "Texto:<br>";
echo "<textarea id='elm1' name='elm1' rows='2' cols='2' ></textarea><br><br>";


echo "Foto:<br>";
echo "<input type='file' name='foto'><br><br>";

echo "<br>Precio (solo el numero, sin el signo de la $):<br>";
echo "<input type='text' name='precio'><br><br>";
/*
echo "<br>Stock (solo el numero):<br>";
echo "<input type='text' name='stock'><br><br>";

echo "<div class='recuadro' style='width:780px'>";
echo "Destacar:&nbsp;<input type='checkbox' name='destacar'><br><br>";
echo "</div>";
*/

echo "<div style='clear:both'></div>";


echo "<input type='hidden' name='categoria' value='$_GET[categoria]'>";
echo "<input type='hidden' name='sub1' value='$_GET[sub1]'>";
echo "<input type='hidden' name='sub2' value='$_GET[sub2]'>";

echo "<input type='hidden' name='escribano' value='ok'>";

echo "<input type='submit' value='cargar'>";



echo "</form>";


?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>


</body>
</html>
