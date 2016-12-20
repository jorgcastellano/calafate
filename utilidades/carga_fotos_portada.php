<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


if($_POST["escribano_fotonoticia"]=="ok"){

$nombre_carpeta = "../slice/images";


$arra_foto["1"] = "nfoto1";

//array que da nombre al campo donde se graban las fotos
$arra_foto1["1"] = "foto1";

//funcion reduce fotos

function redimensionar_imagen($imagen, $nombre_imagen_asociada)
   
	 
	 {
       //indicamos el directorio donde se van a colgar las im�genes
       $direc = '_categorias/' ;
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

//funcion reduce fotos

for($x=1;$x<2;$x++){
$temporal = $_FILES["$arra_foto[$x]"]["tmp_name"];
$foto = $_FILES["$arra_foto[$x]"]["name"];
$partes = explode(".",$foto);
$cuenta = count($partes)-1;
$extension = "jpg";
$texto0 = $partes[0];
$texto = strtolower($texto0);
$nombre_foto = $_POST["nombre"];									   
									   
							
move_uploaded_file($temporal,"../slice/images/".$nombre_foto.".".$extension); 

//LLAMA A LA FUNCION ADELGAZA FOTOS
   if($_FILES["$arra_foto[$x]"]["size"]>0){
	
	$ima = "../slice/images/".$nombre_foto.'.jpg';
    $ima2 = "../slice/images/".$nombre_foto.'.jpg';
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   redimensionar_imagen($imagen, $nombre_imagen_asociada);

   }  
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS   
  
   }//cierra el for







}









?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>CARGA FOTOS PORTADA</title>
<link href="hoja.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>


</head>

<body>

<!-- DIV QUE SE CAMBIA CON AJAX -->
                                   <div class="global" style="background-color:#FFFFFF">

<div style="width:800px;height:100px;background-image:url(imagenes/encabezado.jpg);margin-bottom:20px"></div>
		 

<div style="width:800px">
&nbsp;&nbsp;Estas son las fotos cargadas actualmente: Para reemplazar una eliga el numero y cargue una foto nueva.<br><br>
<div style="widh:250;float:left;margin-left:5px"><!-- 321-->

Foto 1:<br>
<img src="../slice/images/1.jpg" width=250><br><br>
Foto 3:<br>
<img src="../slice/images/3.jpg" width=250><br><br>
Foto 5:<br>
<img src="../slice/images/5.jpg" width=250><br><br>
Foto 7:<br>
<img src="../slice/images/7.jpg" width=250><br><br>



</div><!-- 321-->

<div style="widh:250;float:left;margin-left:100px"><!-- 111-->

Foto 2:<br>
<img src="../slice/images/2.jpg" width=250><br><br>
Foto 4:<br>
<img src="../slice/images/4.jpg" width=250><br><br>
Foto 6:<br>
<img src="../slice/images/6.jpg" width=250><br><br>
Foto 8:<br>
<img src="../slice/images/8.jpg" width=250><br><br>



</div><!-- 111-->




		 
</div>


<div style='clear:both;padding:10px'>
<?php
echo "<form action=$_SERVER[PHP_SELF] method='post' enctype='multipart/form-data'>";
?>

<input type="hidden" name="MAX-FILE_SIZE" value="83886080">

Numero de foto a modificar:

<select name="nombre">

<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>


</select><br>

<br>Foto:<br>
<input type="file" name="nfoto1"><br>



<input type="hidden" name="escribano_fotonoticia" value="ok">
<input type="submit" value="Cargar foto">
</form>		 
</div>
		 
<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>		 
		               
               		          </div><!-- FIN CAMBIA AJAX -->




</body>
</html>
