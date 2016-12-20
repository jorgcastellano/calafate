<?php

include_once("conexion.inc.php");






if($_POST["escribano_fotonoticia"]=="ok"){

//-if($_POST["npublicidad"]==""){

$fecha_noticia = date("d-m-y");
$hora_nota =  date("H:i:s");
$id_noticia = time();
//GRABA NOTICIA EN LA TABLA NOTICIAS
//$datos_destino = htmlentities($datos_originales);  
$texto_titulo = htmlentities($_POST["ntitulo"]);


$texto = $_POST["elm1"];

$texto = str_replace("<p>","<br>",$texto);
$texto = str_replace("</p>","",$texto);

$texto1 = stripslashes( $texto );


//se fija si hay pdf
 if($_FILES["npdf"]["size"]>0){

$temporal = $_FILES["npdf"]["tmp_name"];
$pdf = $_FILES["npdf"]["name"];
$texto = strtolower($pdf);
$nombre_pdf = str_replace(" ","-",$texto);
$nombre_pdf = str_replace("�","n",$nombre_pdf);

move_uploaded_file($temporal,"../pdf/".$nombre_pdf); 


}else{
$nombre_pdf = "";
}

//fin busca pdf

//mysql_query("INSERT INTO noticias (titulo,texto,fecha,id,seccion, pdf) VALUES 
//('$texto_titulo','$texto1','$fecha_noticia','$id_noticia','$_POST[nseccion]','$nombre_pdf')");

/*
$crea_carpeta = mysql_query("select clave from noticias where id ='$id_noticia'");
$crea_carpeta1 = mysql_fetch_assoc($crea_carpeta);
$cta = mysql_num_rows($crea_carpeta);
$nombre_carpeta = $crea_carpeta1["clave"];



mkdir("../fotos_noticias/".$nombre_carpeta, 0777);
*/



$arra_foto["1"] = "nfoto1";
$arra_foto["2"] = "nfoto2";

//array que da nombre al campo donde se graban las fotos
$arra_foto1["1"] = "foto1";
$arra_foto1["2"] = "foto2";

//funcion reduce fotos

function redimensionar_imagen($imagen, $nombre_imagen_asociada)
   
	 
	 {
       /*
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
 */
       // Archivo y nuevo tama�o
$nombre_archivo = '$imagen';
$porcentaje = 0.5;

// Tipo de contenido
header('Content-type: image/jpeg');

// Obtener nuevos tama�os
list($ancho, $alto) = getimagesize($nombre_archivo);
$nuevo_ancho = $ancho * $porcentaje;
$nuevo_alto = $alto * $porcentaje;

// Carcgar
$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
$origen = imagecreatefromjpeg($nombre_archivo);

// Cambiar el tama�o
imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
           if (!imagejpeg($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
         break;
 
         
       }
       return true; //si todo ha ido bien devuelve true
 
     }

//fin funcion reduce fotos









for($x=1;$x<3;$x++){
$temporal = $_FILES["$arra_foto[$x]"]["tmp_name"];
$foto = $_FILES["$arra_foto[$x]"]["name"];
$partes = explode(".",$foto);
$cuenta = count($partes)-1;
$extension = "jpg";//$partes[$cuenta];
$texto0 = $partes[0];
$texto = strtolower($texto0);
$nombre_foto = str_replace(" ","-",$texto);
$nombre_foto = str_replace("�","n",$nombre_foto);

$nombre_foto = $nombre_foto.time();

if($_FILES["$arra_foto[$x]"]["size"]>0){
//mysql_query("UPDATE noticias SET $arra_foto1[$x] ='fotos_noticias/$nombre_carpeta/$nombre_foto.jpg' where clave= '$nombre_carpeta'");
                                      
									   
									   
									   } //if($_FILES["$arra_foto[$x]"]["size"]>0
move_uploaded_file($temporal,"fotos_categorias/".$nombre_foto.".".$extension); 

//LLAMA A LA FUNCION ADELGAZA FOTOS
   if($_FILES["$arra_foto[$x]"]["size"]>0){
	//echo "<script>alert('$nombre_foto')<script>"; 
	$ima = "fotos_categorias/".$nombre_foto.'.jpg';
    $ima2 = "fotos_categorias/".$nombre_foto.'.jpg';
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   redimensionar_imagen($imagen, $nombre_imagen_asociada);

   }  
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS   
  
   }//cierra el for
 //- }//cierro el  if($_POST["npublicidad"]==""){...


//SUBE VIDEO Y GRABA SU RUTA
if($_FILES["nvideo"]["size"]>0){
 $temporal_video = $_FILES["nvideo"]["tmp_name"];
 $original_video = $_FILES["nvideo"]["name"];
 
$partes = explode(".",$original_video);
$cuenta = count($partes)-1;
$extension = $partes[$cuenta];
$texto0 = $partes[0];
$texto = strtolower($texto0);

 $original_video = str_replace(" ","-",$texto);
$original_video = str_replace("�","n",$original_video);
 
 $original_video = $original_video.time().".flv";
 
 move_uploaded_file($temporal_video,"../videos_noticias/".$original_video);
 mysql_query("UPDATE noticias SET video ='videos_noticias/$original_video' where clave= '$nombre_carpeta'");
                        } 

//SUBE AUDIO Y GRABA SU RUTA
if($_FILES["naudio"]["size"]>0){
 $temporal_audio = $_FILES["naudio"]["tmp_name"];
 $original_audio = $_FILES["naudio"]["name"];
 
$original_audio = str_replace(" ","-",$original_audio);
$original_audio = str_replace("�","n",$original_audio);
 
 
 move_uploaded_file($temporal_audio,"../audios_noticias/".$original_audio);
 mysql_query("UPDATE noticias SET audio ='audios_noticias/$original_audio' where clave= '$nombre_carpeta'");
                        } 



}




?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />

<title>UROBA</title>
<meta name="description" content="TODA LA ACTUALIDAD DE GENERAL LAS HERAS Y PUEBLOS VECINOS AL INSTANTE. NOTAS ON-LINE CON AUDIO Y VIDEO. PROGRAMACI�N. TV3 NOTICIAS, HERENSE SPORTS, BANDERA A CUADROS, ESPECIALES LOCALES, CAMPO HOY...">
<meta name="keywords" content="noticias,tv3, las heras, buenos, aires,gral las heras, videos, marcos paz, navarro, lobos, video, noticieros, herense sports">
<meta name="category" content="medios de comunicacion">
<meta name="revisit-after" content="2 days">
<meta name="robots" content="INDEX, FOLLOW">




<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>

<link href="../hoja.css" type="text/css" rel="stylesheet">
<!--<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />-->

<script type="text/javascript" src="../java.js"></script>

</head>


<body>

                                                                <div class="global">



<!-- INICIO DE COLUMNAS -->
  
  <!-- PRIMERA COLUMNA -->
<div style="width:200px;float:left">
<span style="color:#FFFFFF">-</span>
<?php
//include_once("botonera.inc.php");
?>

</div>


              <!-- SEGUNDA COLUMNA -->
<div style="width:600px;float:left;background-image:url(../imagenes/fondo2.jpg);margin-left:0px;margin-right:0px" class="borde_capa2">






<div style="font-family:arial;padding:10px;text-align:justify;font-size:12px;width:580px">


<!-- DIV QUE SE CAMBIA CON AJAX -->
                                   <div id="pagina">

<div style="width:500px;background-color:#006600;color:#FFFFFF;text-align:center;margin-left:40px">
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX-FILE_SIZE" value="83886080">

Secci�n:<br>
<select name="nseccion">

<option>rugby_infantil</option>
<option>rugby_femenino</option>
<option>coaching_cursos</option>
<option>coaching_material_didactico</option>
<option>coaching_videos</option>
<option>veteranos</option>
<option>seleccion</option>
<option>noticias</option>
<option>disciplina</option>
<option>dpto_medico</option>
<option>reglamentos</option>
<option>coaching_silbato</option>
<option>leyes_silbato</option>
<option>prep_fisica</option>
</select><br>
Titulo de la noticia:<br>
<input type="text" name="ntitulo"><br>
cuerpo de la noticia:<br>
<textarea id='elm1' name='elm1' rows='2' cols='2' ></textarea><br>
Foto1:<br>
<input type="file" name="nfoto1"><br>
Foto2:<br>
<input type="file" name="nfoto2"><br>
Audio Mp3:<br>
<input type="file" name="naudio"><br>
Video Flv:<br>
<input type="file" name="nvideo"><br><br>
Archivo pdf o word:<br>
<input type="file" name="npdf"><br><br>



<input type="hidden" name="ntipo" value="noticia">
<input type="hidden" name="escribano_fotonoticia" value="ok">
<input type="submit" value="Cargar noticia">
</form>

</div>


               </div><!--cierra div q se cambia con ajax-->

</div>



<div style="width:600px;text-align:center;padding-top:50px;clear:both">
      <input type="button" value="volver al panel" onclick="location.href='../panel.php'">
   </div>                                       




</div>
              <!-- FIN SEGUNDA COLUMNA -->

              <!-- TERCERA COLUMNA -->


<div style="width:200px;float:left">

<div>
<span style="color:#FFFFFF">-</span>

</div>


</div>

             <!-- FIN TERCERA COLUMNA -->

<!-- FIN DE COLUMNAS -->

<div style="clear:both"></div>


                                             </div>














</body>
</html>
