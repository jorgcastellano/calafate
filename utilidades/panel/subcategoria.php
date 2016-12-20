
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

//verifica si estan completo los campos
if($_POST["nombre"]==""){
echo "<script>alert('DEBE PONERLE UN NOMBRE A LA CATEGORIA')</script>";
echo "<script>parent.location='subcategoria.php?accion=$_POST[accion]'</script>";
}
//fin verifica si estan completo los campos


$nombre = htmlentities($_POST["nombre"]);
$nombre_final = strtolower($nombre);

if($_POST["texto"]!=""){
$texto = htmlentities($_POST["texto"]);
$texto_final = strtolower($texto);
}else{
$texto_final = "";
     }


$busca_categoria = mysql_query("SELECT * from subcategoria where texto = '$nombre_final' and clave_categoria = '$_POST[categoria]'");
$cta_categoria = mysql_num_rows($busca_categoria);

if($cta_categoria >0){
echo "<script>alert('YA EXISTE UNA SUBCATEGORIA CON ESE NOMBRE')</script>";
echo "<script>parent.location='subcategoria.php?accion=$_POST[accion]'</script>";
}else{


mysql_query("INSERT INTO subcategoria (nombre,clave_categoria,texto) VALUES ('$nombre_final','$_POST[categoria]','$texto_final')");

$sql = mysql_query("select * from subcategoria where nombre = '$nombre_final'");
$lee_sql = mysql_fetch_assoc($sql);
$nombre_carpeta = $lee_sql["clave"];

mkdir("../categorias/$_POST[categoria]/".$nombre_carpeta, 0777);

}    

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







if($_FILES["foto"]["size"]>0){
mysql_query("UPDATE subcategoria SET foto ='../categorias/$_POST[categoria]/$nombre_carpeta/$nombre_foto.$extension' where clave= '$nombre_carpeta'");

                                      
									   
									   
									   } //if($_FILES["foto]["size"]>0
move_uploaded_file($temporal,"../categorias/$_POST[categoria]/$nombre_carpeta/".$nombre_foto.".".$extension); 

//LLAMA A LA FUNCION ADELGAZA FOTOS
   if($_FILES["foto"]["size"]>0){
	//echo "<script>alert('$nombre_foto')<script>"; 
	$ima = "../categorias/$_POST[categoria]/".$nombre_carpeta.'/'.$nombre_foto.'.jpg';
    $ima2 = "../categorias/$_POST[categoria]/".$nombre_carpeta.'/'.$nombre_foto.'.jpg';
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   $ruta = "../categorias/$_POST[categoria]/".$nombre_carpeta.'/';
   redimensionar_imagen($imagen, $nombre_imagen_asociada,$ruta);

   } 

 
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS



echo "<script>alert('OPERACION EXITOSA')</script>";
echo "<script>parent.location='index.php'</script>";

}

//-------------------------------------

//-------------------------------------

if($_POST["escribano_modifica"]=="ok"){

   if($_POST["elimina_foto"]=="on"){
   unlink($_POST["foto_cambia"]);
   mysql_query("UPDATE subcategoria SET foto = '' where clave = '$_POST[subcategoria]'");
       }


$nombre = htmlentities($_POST["nombre"]);
$nombre_final = strtolower($nombre);

if($_POST["texto"]!=""){
$texto = htmlentities($_POST["texto"]);
$texto_final = strtolower($texto);
}else{
$texto_final = "";
     }



mysql_query("UPDATE subcategoria SET nombre='$nombre_final', texto='$texto_final' where clave = '$_POST[subcategoria]'");

$sql = mysql_query("select * from subcategoria where clave = '$_POST[subcategoria]'");
$lee_sql = mysql_fetch_assoc($sql);
$nombre_carpeta = $lee_sql["clave_categoria"];


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







if($_FILES["foto"]["size"]>0){


$busca_existe_foto = file_exists($_POST["foto_cambia"]);
if ($busca_existe_foto > 0){

unlink($_POST["foto_cambia"]);

}



mysql_query("UPDATE subcategoria SET foto ='../categorias/$nombre_carpeta/$_POST[subcategoria]/$nombre_foto.$extension' where clave= '$_POST[subcategoria]'");

                                      
									   
									   
									   } //if($_FILES["foto]["size"]>0
move_uploaded_file($temporal,"../categorias/$nombre_carpeta/$_POST[subcategoria]/".$nombre_foto.".".$extension); 




//LLAMA A LA FUNCION ADELGAZA FOTOS
   if($_FILES["foto"]["size"]>0){
	
	
	//echo "<script>alert('$nombre_foto')<script>"; 
	$ima = "../categorias/$nombre_carpeta/".$_POST["subcategoria"].'/'.$nombre_foto.'.jpg';
    $ima2 = "../categorias/$nombre_carpeta/".$_POST["subcategoria"].'/'.$nombre_foto.'.jpg';
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   $carpeta = $_POST["subcategoria"];
   $ruta = "../categorias/$nombre_carpeta/".$carpeta.'/';
   redimensionar_imagen($imagen, $nombre_imagen_asociada, $ruta);

   } 

 
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS



echo "<script>alert('OPERACION EXITOSA')</script>";
echo "<script>parent.location='index.php'</script>";

}






//-------------------------------------
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<?php


if($_GET["accion"]=="agregar"){
echo "<title>AGREGAR SUBCATEGORIA</title>";
}

if($_GET["accion"]=="modificar"){
echo "<title>MODIFICAR SUBCATEGORIA</title>";
}

if($_GET["accion"]=="eliminar"){
echo "<title>ELIMINAR SUBCATEGORIA</title>";
}

?>
<link href="panel.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="panel.js"></script>

</head>

<body>

                                       <div class="global">
									   
<div style="text-align:center">
<?php
//FORM PARA AGREGAR SUBCATEGORIAS----------------------------------------

if($_GET["accion"]=="agregar"){

echo "<form method='post' action=$_SERVER[PHP_SELF] enctype='multipart/form-data'>";
echo "<br><img src='botones/agregar_subcategoria.jpg' width=100><br><br>";


echo "<br><input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";
echo "<span class='linea_panel'>Elija dentro de que categoria se creara la subcategoria:&nbsp;&nbsp;</span><br><br>";

echo "<select name=categoria>";
$busca_categoria = mysql_query("select * from categoria");
$cta_categoria = mysql_num_rows($busca_categoria);
for($c =1;$c<=$cta_categoria;$c++){
$lee_categoria = mysql_fetch_assoc($busca_categoria);
echo "<option value=$lee_categoria[clave]>$lee_categoria[texto]</option><br>";

     }
echo "</select><br><br><br>";



echo "<span class='linea_panel'>Ingrese nombre de la subcategoria:&nbsp;&nbsp;</span>";
echo "<input type='text' name='nombre'><br><br>";
echo "<span class='linea_panel'>Ingrese un texto descriptivo de la subcategoria:&nbsp;&nbsp;</span><br><br>";
echo "<textarea name='texto' rows=5 cols=35 ></textarea><br><br>";
echo "<span class='linea_panel'>Elija una foto para ver en la subcategoria:</span><br><br>";
echo "<input type='file' name='foto' >";
echo "<input type='hidden' name='accion' value='$_GET[accion]'>";
echo "<input type='hidden' name='escribano_agregar' value='ok'><br><br>";
echo "<input type='submit' value='Cargar' style='width:200px'>";

echo "</form>";
}
//FIN FORM PARA AGREGAR SUBCATEGORIAS----------------------------------------

//FORM PARA MODIFICAR SUBCATEGORIAS----------------------------------------
  
         //primera parte que consulta la subcategoria

if($_GET["accion"]=="modificar"){
echo "<form method='post' action=$_SERVER[PHP_SELF] >";
echo "<br><img src='botones/modificar_subcategoria.jpg' width=100><br><br>";

echo "<span class='linea_panel'>Elija la subcategoria que desea modificar:</span><br><br>";

echo "<select name='subcategoria_elige'>";

$busca_subcategoria = mysql_query("select subcategoria.clave, nombre, categoria.texto from subcategoria left outer join categoria on subcategoria.clave_categoria = categoria.clave");
$cta_subcategoria = mysql_num_rows($busca_subcategoria);
for($c =1;$c<=$cta_subcategoria;$c++){
$lee_subcategoria = mysql_fetch_assoc($busca_subcategoria);
echo "<option value=$lee_subcategoria[clave]>$lee_subcategoria[nombre]&nbsp;de&nbsp;la&nbsp;categoria&nbsp;&nbsp;$lee_subcategoria[texto]</option><br>";

     }
echo "</select><br><br><br>";
echo "<input type='hidden' name='accion' value='$_GET[accion]'";
echo "<input type='submit' value='Cargar' style='width:200px'>";

echo "</form>";


}

          //fin primera parte que consulta la subcategoria

    //segunda parte que permite modificar

if($_POST["subcategoria_elige"]!=""){

$busca_subcategoria = mysql_query("select * from subcategoria where clave='$_POST[subcategoria_elige]'");

$lee_subcategoria = mysql_fetch_assoc($busca_subcategoria);
   


echo "<form method='post' action=$_SERVER[PHP_SELF] enctype='multipart/form-data'>";
echo "<br><img src='botones/modificar_subcategoria.jpg' width=100><br><br>";


echo "<br><input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";
echo "<span class='linea_panel'><b>Estos son los datos que tiene cargado la categoria:</b></span><br><br>";

echo "<span class='linea_panel'>Nombre:</span><br>";
echo "<input type='text' name='nombre' value='$lee_subcategoria[nombre]'><br><br>";

echo "<span class='linea_panel'>Texto:</span><br>";
echo "<textarea name='texto' rows=5 cols=35>$lee_subcategoria[texto]</textarea><br><br>";

if($lee_subcategoria["foto"]!=""){
echo "<span class='linea_panel'>Esta es la foto actual de la categoria:</span><br>";
echo "<img src=$lee_subcategoria[foto] width=400><br>";
echo "<span class='linea_panel'>Para eliminarla haga click aqui:&nbsp;&nbsp;</span><input type='checkbox' name='elimina_foto'><br><br>";
}else{
  echo "<span class='linea_panel' style='color:#ff0000'>No hay foto cargada para esta subcategoria.</span><br><br>";
     }
echo "<span class='linea_panel'>Para reemplazarla o agregar elija una:</span><br><br>";
echo "<input type='file' name='foto' >";
echo "<input type='hidden' name='subcategoria' value='$_POST[subcategoria_elige]'><br><br>";
echo "<input type='hidden' name='escribano_modifica' value='ok'><br><br>";
echo "<input type='hidden' name='foto_cambia' value='$lee_subcategoria[foto]'><br><br>";
echo "<input type='submit' value='Modificar' style='width:200px'>";

echo "</form>";

}//fin if($_POST["subcategoria"]!=""){

	
	
    //segunda parte que permite modificar


//FIN FORM PARA MODIFICAR SUBCATEGORIAS----------------------------------------
?>





</div>
<div style="text-align:center;margin-top:30px">
<img src="botones/volver.jpg" onclick="location.href='index.php'" style="cursor:pointer">
</div>
                                                      </div>

</body>
</html>
