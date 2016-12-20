<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


if($_POST["escribano"]=="ok"){

$cta_fot = mysql_query("select * from fotos");
$cta_cta = mysql_num_rows($cta_fot);

for($w=1;$w<=$cta_cta;$w++){
$lee_cta_fot = mysql_fetch_assoc($cta_fot);

$clave = $lee_cta_fot["clave"];
$clave_f = $_POST[$clave];

if($clave_f != "on" ){
$publicar = "no";
             }else{
			 $publicar = "on";
			 }

mysql_query ("UPDATE fotos SET publicar='$publicar' where clave='$lee_cta_fot[clave]'");

$clave_c = $lee_cta_fot["clave"];
$clave_c1 = $_POST["borra$clave_c"];

if($clave_c1=="on"){
mysql_query("DELETE from fotos where clave = $clave_c");
unlink("fotos/$lee_cta_fot[nombre_foto].jpg");
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
       $direc = 'fotos/' ;
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
$nombre_foto = str_replace(" ","-",$texto);
$nombre_foto = str_replace("�","n",$nombre_foto);

$nombre_foto = $nombre_foto.time();

									   
									   
							
move_uploaded_file($temporal,"fotos/".$nombre_foto.".".$extension); 

//LLAMA A LA FUNCION ADELGAZA FOTOS
   if($_FILES["$arra_foto[$x]"]["size"]>0){
	//echo "<script>alert('$nombre_foto')<script>"; 
	$ima = "fotos/".$nombre_foto.'.jpg';
    $ima2 = "fotos/".$nombre_foto.'.jpg';
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   redimensionar_imagen($imagen, $nombre_imagen_asociada);

   }  
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS   
  
   }//cierra el for




mysql_query("INSERT INTO fotos (nombre_foto,comentario) VALUES 
('$nombre_foto','$texto_destino')");


}









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
<?php
//---------------------------------CAPA FLOTANTE QUE GRISEA LA PANTALLA

if($_GET["clave_foto1"]!=""){

echo "<div style='width:100%;height:100%;position:fixed;z-index:1;background-color:#cccccc;filter:alpha(opacity=60);opacity:0.6'>";
echo "</div>";


$sql1= mysql_query("select * from fotos");
$cta_sql1 = mysql_num_rows($sql1);
for($af=1;$af<=$cta_sql1;$af++){
$lee_sql1 = mysql_fetch_assoc($sql1);

$arr_foto[$af] = $lee_sql1["clave"];

if($lee_sql1["clave"] == $_GET["clave_foto1"]){
$foto_imprime = $lee_sql1["nombre_foto"];
$posicion = $af;
$siguiente = $af + 1;
$anterior = $af - 1; 

}//if($lee_sql1["clave"] == $_GET["clave_foto1"]){



}//cierra for($af=1;$af<=$cta_sql1;$af++){


if($siguiente > $cta_sql1){
$clave_siguiente = $arr_foto[1];
}else{
$clave_siguiente = $arr_foto[$siguiente];
}

if($anterior < 1){
$clave_anterior = $arr_foto[$cta_sql1];
}else{
$clave_anterior = $arr_foto[$anterior];
}

$comen = mysql_query("select comentario from fotos where clave='$_GET[clave_foto1]'");
$lee_comen = mysql_fetch_assoc($comen);



$imagen = "fotos/".$foto_imprime.".jpg";

$info_imagen = getimagesize($imagen);
       $alto = $info_imagen[1];
       $ancho = $info_imagen[0];


if($alto > $ancho){

echo "<div style='width:338px;height:478px;position:fixed;top:50%;margin-top:-239px;left:50%;margin-left:-169px;z-index:2'>";
echo "<img src=$imagen width=338>";
echo "<p style='background-color:#000000;font-size:12px;font-family:arial;color:#ffffff;padding:3px;margin-top:0px;margin-bottom:0px'>$lee_comen[comentario]</p>";
echo "<a href='panel_fotos.php?clave_foto1=$clave_anterior'><img src=imagenes/anterior.jpg style='margin-left:94px' title='ANTERIOR'></a>";
echo "<a href='panel_fotos.php'><img src=imagenes/cerrar.jpg title='CERRAR'></a>";
echo "<a href='panel_fotos.php?clave_foto1=$clave_siguiente'><img src=imagenes/siguiente.jpg title='SIGUIENTE'></a>";
echo "</div>";

}else{

echo "<div style='width:600px;height:500px;position:fixed;top:50%;margin-top:-250px;left:50%;margin-left:-300px;z-index:2'>";
echo "<img src=$imagen>";
echo "<p style='background-color:#000000;font-size:12px;font-family:arial;color:#ffffff;margin-top:0px;margin-bottom:0px;padding:2px'>$lee_comen[comentario]</p>";
echo "<a href='panel_fotos.php?clave_foto1=$clave_anterior'><img src=imagenes/anterior.jpg style='margin-left:225px' title='ANTERIOR'></a>";
echo "<a href='panel_fotos.php'><img src=imagenes/cerrar.jpg title='CERRAR'></a>";
echo "<a href='panel_fotos.php?clave_foto1=$clave_siguiente'><img src=imagenes/siguiente.jpg title='SIGUIENTE'></a>";
echo "</div>";


}

} //fin if($_GET["clave_foto1"]!=""){
//---------------------------------CAPA FLOTANTE QUE GRISEA LA PANTALLA  
  
  
?>


<div>





<div style="width:600px;height:40px;background-image:url(imagenes/titulos/fotos.jpg)"></div>

<div style="font-family:arial;padding:10px;text-align:justify;font-size:12px;width:580px">
<!-- DIV QUE SE CAMBIA CON AJAX -->
                                   <div id="pagina" style="background-color:#FFFFFF">

<div>

<?php




echo "<div style='width:580px;text-align:center'>";

$sql = mysql_query("select * from fotos");
$cta_sql = mysql_num_rows($sql);


echo "<form action='panel_fotos.php' method='post' >";
for($ff=1;$ff<=$cta_sql;$ff++){
$lee_sql = mysql_fetch_assoc($sql);



echo "<a href='panel_fotos.php?clave_foto1=$lee_sql[clave]'><img src='fotos/$lee_sql[nombre_foto].jpg' width=100 height=100 style='margin-right:5px;margin-bottom:5px;border: 2px solid #005500'></a>";

if($lee_sql["publicar"]=="on"){
echo "<input type='checkbox' name='$lee_sql[clave]' checked='checked'>";
    }else{
	echo "<input type='checkbox' name='$lee_sql[clave]'>";
	     }
echo "Borrar>:<input type='checkbox' name='borra$lee_sql[clave]'>";
}


echo "<input type='hidden' name='escribano' value='ok'><br><br>";
echo "<input type='submit' value='Modificar' >";
echo "</form>";

echo "</div>";


?>
</div>

		 
		 
<div>		 
<div style="width:580px;height:19px;background-image:url(imagenes/titulos/manda_tu_foto.jpg)"></div>


<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX-FILE_SIZE" value="83886080">

<br>Foto:<br>
<input type="file" name="nfoto1"><br>
Comentario:<br>
<input type="text" name="comentario"><br><br>
<span style="font-family:arial;font-size:10px">UROBA ACLARA QUE NO TODAS LAS FOTOS SER�N PUBLICADAS: PASARAN ANTES POR UN FILTRO DE APROBACION</span><br><br>

<input type="hidden" name="escribano_fotonoticia" value="ok">
<input type="submit" value="Cargar foto">
</form>		 
</div>		 
		 
		 
		 
		          </div><!-- FIN CAMBIA AJAX -->




</body>
</html>
