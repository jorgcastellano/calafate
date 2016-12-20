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





$categoria = $_POST["categoria"];
$categoria1 = stripslashes( $categoria );

$texto = $_POST["elm1"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );

if($_FILES["foto"]["size"]>1){

mysql_query("INSERT INTO categoria (nombre_categoria,foto_categoria,texto_categoria,publica_categoria,ubicacion_categoria) VALUES ('$categoria1','fotos_categorias/$nombre_foto','$texto1','si','$_POST[ubicacion_categoria]')");

}else{//if($_FILES["foto"]["size"]>1){

mysql_query("INSERT INTO categoria (nombre_categoria,texto_categoria,publica_categoria,ubicacion_categoria) VALUES ('$categoria1','$texto1','si','$_POST[ubicacion_categoria]')");


     }//if($_FILES["foto"]["size"]>1){

//---------busca la la clave de lo insertado y va a agregar mas fotos

$bsql = mysql_query("select * from categoria order by clave desc limit 0,1");
$blee = mysql_fetch_assoc($bsql);

$categoria = $blee["clave"];


//header("location: carga_fotos.php?categoria=$categoria&sub1=$sub1&sub2=$sub2&sub1=$sub1&articulo=$articulo&carga_categoria=si");

//---------fin busca la la clave de lo insertado y va a agregar mas fotos




}//cierra if escribano



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>CARGA CATEGORIA</title>
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
//---------------------------------muestra las categorias cargadas y su posicion

echo "<div style='margin-bottom:20px'>";
echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>";
echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

$sql = mysql_query("select * from categoria  order by ubicacion_categoria asc");
$cta_sql = mysql_num_rows($sql);
echo "Estas son las categorias cargadas y su ubicacion<br><br>";


for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);

if($lee_sql["publica_categoria"]=="si"){

$clave = $lee_sql["clave"];
$nombre_categoria = $lee_sql["nombre_categoria"];

echo "<div  style='width:50px' class='recuadro'>";
echo "-";
echo "</div>";


echo "<div class='recuadro' style='width:670px;text-align:left'>";
echo  "&nbsp;".$nombre_categoria;
echo "</div>";

echo "<div  style='width:50px' class='recuadro'>";
echo "$lee_sql[ubicacion_categoria]";
echo "</div>";



echo "<div style='clear:both'></div>";

}else{//if($lee_sql["publica_categoria"]=="si"){

$clave = $lee_sql["clave"];
$nombre_categoria = $lee_sql["nombre_categoria"];

echo "<div  style='width:50px' class='recuadro1'>";
echo "-";
echo "</div>";

echo "<div class='recuadro1' style='width:670px;text-align:left'>";
echo  "&nbsp;".$nombre_categoria;
echo "</div>";

echo "<div  style='width:50px' class='recuadro1'>";
echo "$lee_sql[ubicacion_categoria]";
echo "</div>";

echo "<div style='clear:both'></div>";


}//if($lee_sql["publica_categoria"]=="si"){


}// cierra for



;

echo "</form>";
echo "<hr>";
echo "</div>";


//----------------------------------------------fin muestra las categorias cargadas

echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>";

echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";
echo "Nombre de la categoria:<br>";
echo "<input type='text' name='categoria'><br><br>";

echo "Ubicacion: <br>";
echo "<select name='ubicacion_categoria' >";

echo "<option>1</option>";
echo "<option>2</option>";
echo "<option>3</option>";
echo "<option>4</option>";
echo "<option>5</option>";
echo "<option>6</option>";
echo "<option>7</option>";
echo "<option>8</option>";
echo "<option>9</option>";
echo "<option>10</option>";
echo "<option>11</option>";
echo "<option>12</option>";
echo "<option>13</option>";
echo "<option>14</option>";
echo "<option>15</option>";
echo "<option>16</option>";
echo "<option>17</option>";
echo "<option>18</option>";
echo "<option>19</option>";
echo "<option>20</option>";

echo "</select><br><br>";

echo "Texto:<br>";
echo "<textarea id='elm1' name='elm1' rows='2' cols='2' ></textarea><br><br>";


echo "Foto:<br>";
echo "<input type='file' name='foto'><br><br>";


echo "<input type='hidden' name='escribano' value='ok'>";
echo "<input type='submit' value='cargar'>";



echo "</form>";


?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>

</body>
</html>
