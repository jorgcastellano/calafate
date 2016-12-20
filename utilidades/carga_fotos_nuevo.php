<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


$categoria = $_GET["categoria"];

if($categoria ==""){
$categoria = "0";
}

$sub1 = $_GET["sub1"];

if($sub1 ==""){
$sub1 = "0";
}

$sub2 = $_GET["sub2"];

if($sub2 ==""){
$sub2 = "0";
}

$articulo = $_GET["articulo"];

if($articulo ==""){
$articulo = "0";
}


if($_POST["escribano"]=="ok"){

$cta_fot = mysql_query("select * from fotos where clave_categoria_f='$categoria' and clave_sub1_f = '$sub1' and clave_sub2_f = '$sub2' and clave_articulo_f = '$articulo' order by orden_foto asc");
$cta_cta = mysql_num_rows($cta_fot);

for($w=1;$w<=$cta_cta;$w++){
$lee_cta_fot = mysql_fetch_assoc($cta_fot);

$clave = $lee_cta_fot["clave"];
$clave_f = $_POST[$clave];
$orden_foto = $_POST["orden_foto".$w];

if($clave_f != "on" ){
$publicar = "no";
             }else{
			 $publicar = "si";
			 }

mysql_query ("UPDATE fotos SET publica_fotos='$publicar',orden_foto = '$orden_foto' where clave='$lee_cta_fot[clave]'");

$clave_c = $lee_cta_fot["clave"];
$clave_c1 = $_POST["borra$clave_c"];

if($clave_c1=="on"){
mysql_query("DELETE from fotos where clave = $clave_c");
unlink("$lee_cta_fot[foto]");
    }
    
	 }//cieera for

            }//if($_POST["escribano"]=="ok"){


if($_POST["escribano_fotonoticia"]=="ok"){

$nombre_carpeta = "fotos";

if($_POST["comentario"]!=""){
$texto_destino = nl2br(htmlspecialchars($_POST["comentario"]));

}else{
$texto_destino = "";
}


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



//funcion reduce fotos para thumbail

function redimensionar_imagen1($imagen, $nombre_imagen_asociada)
   
	 
	 {
       //indicamos el directorio donde se van a colgar las im�genes
       $direc = '_categorias/' ;
	   $directorio = "";
       //establecemos los l�mites de ancho y alto
       $nuevo_ancho = 300;
       $nuevo_alto = 300;
 
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

//funcion reduce fotos para thumbail







for($x=1;$x<2;$x++){
$temporal = $_FILES["$arra_foto[$x]"]["tmp_name"];
$foto = $_FILES["$arra_foto[$x]"]["name"];
$partes = explode(".",$foto);
$cuenta = count($partes)-1;
$extension = "jpg";
$texto0 = $partes[0];
$texto = strtolower($texto0);
$nombre_foto = str_replace(" ","-",$texto);
$nombre_foto = str_replace("�","n",$nombre_foto);

$nombre_foto = $nombre_foto.time();

									   
									   
							
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


   
   

//LLAMA A LA FUNCION ADELGAZA FOTOS 2
   if($_FILES["$arra_foto[1]"]["size"]>0){
	
	$ima = "fotos_categorias/".$nombre_foto.'.jpg';
    $ima2 = "fotos_categorias/".$nombre_foto.'-1.jpg';
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   redimensionar_imagen1($imagen, $nombre_imagen_asociada);

   }  
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS 2     
   


mysql_query("INSERT INTO fotos (clave_categoria_f,clave_sub1_f,clave_sub2_f,clave_articulo_f,foto,texto_foto,publica_fotos) VALUES 
('$categoria','$sub1','$sub2','$articulo','fotos_categorias/$nombre_foto.jpg','$texto_destino','si')");


}


header ("Location: modifica_subcategoria2_nueva.php?clave_sub2=$sub2&fotos=si")

?>



