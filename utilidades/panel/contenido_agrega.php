<?php

include_once("../conexion.inc.php");
//funcion reduce fotos

function redimensionar_imagen($imagen, $nombre_imagen_asociada, $ruta)
   
	 
	 {
       //indicamos el directorio donde se van a colgar las im�genes
       //$direc = '../categorias/$_POST[categoria]/'.$nombre_carpeta.'/' ;
        $direc = $ruta;
	   $directorio = "";
       //establecemos los l�mites de ancho y alto
       $nuevo_ancho = 780;
       $nuevo_alto = 780;
 
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

//-------------------------------
if($_POST["escribano_agregar"]=="ok"){

$claves = $_POST["subcategoria_elige"];
$partes = explode(",",$claves);
$clave_subcategoria = $partes[0];
$clave_categoria = $partes[1];


//consulto que datos estan completos

if($_POST["lugar"]!=""){

$lugar = htmlentities($_POST["lugar"]);
$lugar_final = strtolower($lugar);

}else{
$lugar ="";
}

if($_POST["dia"]=="0"){
$fecha = "";

}else{

$fecha = $_POST["dia"]."/".$_POST["mes"]."/".$_POST["ano"];

}


if($_POST["stock"]!=""){
$stock = $_POST["stock"];
}else{
$stock ="";
}

if($_POST["precio"]!=""){
$precio = $_POST["precio"];
}else{
$precio ="";
}

if($_POST["destaca_portada"]!="on"){
$destaca_portada = "no";
}else{
$destaca_portada ="si";
}

if($_POST["destaca_subcategoria"]!="on"){
$destaca_subcategoria = "no";
}else{
$destaca_subcategoria ="si";
}




//fin consulto que datos estan completos



//verifica si estan completo los campos
if($_POST["nombre_contenido"]==""){
echo "<script>alert('DEBE PONERLE UN NOMBRE AL CONTENIDO')</script>";
echo "<script>parent.location='contenido.php?accion=$_POST[accion]'</script>";
}
//fin verifica si estan completo los campos

$nombre = htmlentities($_POST["nombre_contenido"]);
$nombre_final = strtolower($nombre);

if($_POST["texto"]!=""){
$texto = htmlentities($_POST["texto"]);
$texto_final = strtolower($texto);
}else{
$texto_final = "";
     }


$busca_categoria = mysql_query("SELECT * from contenido where nombre_contenido = '$nombre_final' and clave_subcategoria = '$clave_subcategoria'");
$cta_categoria = mysql_num_rows($busca_categoria);

if($cta_categoria >0){
echo "<script>alert('YA EXISTE UN CONTENIDO CON ESE NOMBRE DENTRO DE LA SUBCATEGORIA ELEGIDA')</script>";
echo "<script>parent.location='subcategoria.php?accion=$_POST[accion]'</script>";
}else{


mysql_query("INSERT INTO contenido (nombre_contenido,texto,clave_subcategoria,lugar,fecha,stock,precio,destacar_portada,destacar_subcategoria,clave_categoria) VALUES ('$nombre_final','$texto_final','$clave_subcategoria','$lugar','$fecha','$stock','$precio', '$destaca_portada','$destaca_subcategoria','$clave_categoria')");


$sql = mysql_query("select * from contenido where nombre_contenido = '$nombre_final' and clave_subcategoria = '$clave_subcategoria'");
$lee_sql = mysql_fetch_assoc($sql);
$nombre_carpeta = $lee_sql["clave"];

mkdir("../categorias/$clave_categoria/$clave_subcategoria/".$nombre_carpeta, 0777);

}    

if($_FILES["foto"]["size"]>0){
$temporal = $_FILES["foto"]["tmp_name"];
$foto = $_FILES["foto"]["name"];
$partes = explode(".",$foto);
$cuenta = count($partes)-1;
$extension = $partes[$cuenta];
$texto0 = $partes[0];
$texto = strtolower($texto0);
$nombre_foto = str_replace(" ","-",$texto);
$nombre_foto = str_replace("�","n",$nombre_foto);

$nombre_foto = $nombre_foto.time();




mysql_query("UPDATE contenido SET foto ='../categorias/$clave_categoria/$clave_subcategoria/$nombre_carpeta/$nombre_foto.$extension' where clave= '$nombre_carpeta'");

                                      
									   
									   
									   } //if($_FILES["foto]["size"]>0
move_uploaded_file($temporal,"../categorias/$clave_categoria/$clave_subcategoria/$nombre_carpeta/".$nombre_foto.".".$extension); 

//LLAMA A LA FUNCION ADELGAZA FOTOS
   if($_FILES["foto"]["size"]>0){
	//echo "<script>alert('$nombre_foto')<script>"; 
	$ima = "../categorias/$clave_categoria/$clave_subcategoria/".$nombre_carpeta.'/'.$nombre_foto.'.jpg';
    $ima2 = "../categorias/$clave_categoria/$clave_subcategoria/".$nombre_carpeta.'/'.$nombre_foto.'.jpg';
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   $ruta = "../categorias/$clave_categoria/$clave_subcategoria/".$nombre_carpeta.'/';
   redimensionar_imagen($imagen, $nombre_imagen_asociada,$ruta);

   } 

 
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS

//carga video
if($_FILES["video"]["size"]>0){
$temporal = $_FILES["video"]["tmp_name"];
$video = $_FILES["video"]["name"];
$partes = explode(".",$video);
$cuenta = count($partes)-1;
$extension = $partes[$cuenta];
$texto0 = $partes[0];
$texto = strtolower($texto0);
$nombre_video = str_replace(" ","-",$texto);
$nombre_video = str_replace("�","n",$nombre_video);

$nombre_video = $nombre_video.time();


mysql_query("UPDATE contenido SET video ='../categorias/$clave_categoria/$clave_subcategoria/$nombre_carpeta/$nombre_video.$extension' where clave= '$nombre_carpeta'");
move_uploaded_file($temporal,"../categorias/$clave_categoria/$clave_subcategoria/$nombre_carpeta/".$nombre_video.".".$extension); 
}

//fin carga video

echo "<script>alert('OPERACION EXITOSA')</script>";
echo "<script>parent.location='index.php'</script>";










}//if($_POST["escribano_agregar"]=="ok"){
//-------------------------------

echo "<script>parent.location='contenido.php'</script>";


?>