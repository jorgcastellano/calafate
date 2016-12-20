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

//-------------------------------





//-------------------------------



?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<?php
include_once("../conexion.inc.php");

if($_GET["accion"]=="agregar"){
echo "<title>AGREGAR CONTENIDO</title>";
}

if($_GET["accion"]=="modificar"){
echo "<title>MODIFICAR CONTENIDO</title>";
}

if($_GET["accion"]=="eliminar"){
echo "<title>ELIMINAR CONTENIDO</title>";
}

?>
<link href="panel.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="panel.js"></script>

</head>

<body>

                                        <div class="global">
<div style="text-align:center">

<?php
//FORM PARA AGREGAR CONTENIDO----------------------------------------

if($_GET["accion"]=="agregar"){

echo "<form method='post' action='contenido_agrega.php' enctype='multipart/form-data'>";
echo "<br><img src='botones/agregar_contenido.jpg' width=100><br><br>";


echo "<br><input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

echo "<span class='linea_panel'>Elija dentro de que subcategoria estara el coontenido nuevo:</span><br><br>";

echo "<select name='subcategoria_elige'>";

$busca_subcategoria = mysql_query("select subcategoria.clave, nombre, clave_categoria, categoria.texto from subcategoria left outer join categoria on subcategoria.clave_categoria = categoria.clave order by nombre asc");
$cta_subcategoria = mysql_num_rows($busca_subcategoria);
for($c =1;$c<=$cta_subcategoria;$c++){
$lee_subcategoria = mysql_fetch_assoc($busca_subcategoria);
echo "<option value='$lee_subcategoria[clave],$lee_subcategoria[clave_categoria]'>$lee_subcategoria[nombre]&nbsp;de&nbsp;la&nbsp;categoria&nbsp;&nbsp;$lee_subcategoria[texto]</option><br>";

     }
echo "</select><br><br><br>";

echo "<span class='linea_panel'>Nombre:</span><br>";
echo "<input type='text' name='nombre_contenido'><br><br>";

echo "<span class='linea_panel'>Texto:</span><br>";
echo "<textarea name='texto' rows=5 cols=35></textarea><br><br>";

echo "<span class='linea_panel'>Lugar:</span><br>";
echo "<input type='text' name='lugar'><br><br>";

//--FECHA---
echo "<span class='linea_panel'>Fecha:</span><br>";

echo "<select name='dia'>";
echo "<option value=0>DIA</option>";
for($dia=1;$dia<32;$dia++){
if($dia <=9){
echo "<option>0$dia</option>";
    }else{
	   echo "<option>$dia</option>";
	     }
}
echo "</select>";

echo "<select name='mes'>";
echo "<option value=0>MES</option>";
echo "<option value=01>ENERO</option>";
echo "<option value=02>FEBRERO</option>";
echo "<option value=03>MARZO</option>";
echo "<option value=04>ABRIL</option>";
echo "<option value=05>MAYO</option>";
echo "<option value=06>JUNIO</option>";
echo "<option value=07>JULIO</option>";
echo "<option value=08>AGOSTO</option>";
echo "<option value=09>SEPTIEMBRE</option>";
echo "<option value=10>OCTUBRE</option>";
echo "<option value=11>NOVIEMBRE</option>";
echo "<option value=12>DICIEMBRE</option>";


echo "</select>";


echo "<select name='ano'>";
echo "<option value=0>A�O</option>";

for($ano=2009;$ano<2021;$ano++){
echo "<option>$ano</option>";

}
echo "</select>";




echo "<br><br>";
//-- FIN FECHA---


echo "<span class='linea_panel'>Stock:</span><br>";
echo "<input type='text' name='stock'><br><br>";

echo "<span class='linea_panel'>Precio:</span><br>";
echo "<input type='text' name='precio'><br><br>";

echo "<span class='linea_panel'>Destacar este contenido en la portada:&nbsp;&nbsp;</span><input type='checkbox' name='destaca_portada'><br><br>";
echo "<span class='linea_panel'>Destacar este contenido en la subcategoria:&nbsp;&nbsp;</span><input type='checkbox' name='destaca_subcategoria'><br><br>";

echo "<span class='linea_panel'>Elija una foto para este contenido:</span><br><br>";
echo "<input type='file' name='foto' ><br><br>";

echo "<span class='linea_panel'>Elija un video para este contenido:</span><br><br>";
echo "<input type='file' name='video' ><br><br>";


echo "<input type='hidden' name='accion' value='$_GET[accion]'";
echo "<input type='hidden' name='escribano_agregar' value='ok'>"; 


echo "<input type='submit' value='Cargar'>";









echo "</form>";

}

//FIN FORM PARA AGREGAR CONTENIDO----------------------------------------


//FORM PARA MODIFICAR CONTENIDO

 //primera parte que consulta la subcategoria

if($_GET["accion"]=="modificar"){
echo "<form method='get' action='contenido_modifica.php' >";
echo "<br><img src='botones/modificar_contenido.jpg' width=100><br><br>";

echo "<span class='linea_panel'>Elija el contenido que desea modificar:</span><br><br>";

echo "<select name='contenido_elige'>";

$busca_contenido = mysql_query("select contenido.clave,nombre_contenido, subcategoria.nombre from contenido left outer join subcategoria on contenido.clave_subcategoria = subcategoria.clave order by nombre_contenido asc");
$cta_contenido = mysql_num_rows($busca_contenido);
for($c =1;$c<=$cta_contenido;$c++){
$lee_contenido = mysql_fetch_assoc($busca_contenido);
echo "<option value=$lee_contenido[clave]>$lee_contenido[nombre_contenido]&nbsp;de&nbsp;la&nbsp;subcategoria&nbsp;&nbsp;$lee_contenido[nombre]</option><br>";

     }
echo "</select><br><br><br>";
echo "<input type='hidden' name='accion' value='$_GET[accion]'";
echo "<input type='submit' value='Cargar' style='width:200px'>";

echo "</form>";


}

          //fin primera parte que consulta la subcategoria

  //segunda parte que permite modificar

if($_GET["contenido_elige"]!=""){

$busca_contenido = mysql_query("select * from contenido where clave='$_GET[contenido_elige]' ");

$lee_contenido = mysql_fetch_assoc($busca_contenido);
   


echo "<form method='post' action='contenido_modifica.php' enctype='multipart/form-data'>";
echo "<br><img src='botones/modificar_contenido.jpg' width=100><br><br>";


echo "<br><input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

echo "<span class='linea_panel'>Nombre:</span><br>";
echo "<input type='text' name='nombre_contenido' value='$lee_contenido[nombre_contenido]'><br><br>";

echo "<span class='linea_panel'>Texto:</span><br>";
echo "<textarea name='texto' rows=5 cols=35>$lee_contenido[texto]</textarea><br><br>";

echo "<span class='linea_panel'>Lugar:</span><br>";
echo "<input type='text' name='lugar' value='$lee_contenido[lugar]'><br><br>";

//--FECHA---
echo "<span class='linea_panel'>Fecha:</span><br>";


$texto_fecha = $lee_contenido["fecha"];
$texto_dia = substr($texto_fecha,0,2);
$texto_mes = substr($texto_fecha,3,2);
$texto_ano = substr($texto_fecha,6,4);


echo "<select name='dia'>";

echo "<option value=0>DIA</option>";



for($dia=1;$dia<32;$dia++){
if($dia <=9){
if($dia == $texto_dia){ 
echo "<option selected='selected'>0$dia</option>";
                     }else{
					 echo "<option>0$dia</option>";
					      }//cierra if($dia == $texto_dia){ 
    }else{
     
	 if($dia == $texto_dia){ 
	 
	   echo "<option selected='selected'>$dia</option>";
	                        }else{
							   echo "<option>$dia</option>";
							     }//fin if($dia == $texto_dia){ 
	     } //cierra if($dia <=9){
}
echo "</select>";

echo "<select name='mes'>";

echo "<option value=0>MES</option>";

if($texto_mes == "01"){
echo "<option value=01 selected='selected'>ENERO</option>";
}else{
     echo "<option value=01>ENERO</option>";
     }
if($texto_mes == "02"){
echo "<option value=02 selected='selected'>FEBRERO</option>";
}else{
     echo "<option value=01>FEBRERO</option>";
     }

if($texto_mes == "03"){
echo "<option value=03 selected='selected'>MARZO</option>";
}else{
     echo "<option value=03>MARZO</option>";
     }

if($texto_mes == "04"){
echo "<option value=04 selected='selected'>ABRIL</option>";
}else{
     echo "<option value=04>ABRIL</option>";
     }

if($texto_mes == "05"){
echo "<option value=05 selected='selected'>MAYO</option>";
}else{
     echo "<option value=05>MAYO</option>";
     }

if($texto_mes == "06"){
echo "<option value=06 selected='selected'>JUNIO</option>";
}else{
     echo "<option value=06>JUNIO</option>";
     }
	 
if($texto_mes == "07"){
echo "<option value=07 selected='selected'>JULIO</option>";
}else{
     echo "<option value=07>JULIO</option>";
     }
	 
if($texto_mes == "08"){
echo "<option value=08 selected='selected'>AGOSTO</option>";
}else{
     echo "<option value=08>AGOSTO</option>";
     }

if($texto_mes == "09"){
echo "<option value=09 selected='selected'>SEPTIEMBRE</option>";
}else{
     echo "<option value=09>SEPTIEMBRE</option>";
     }
	 
if($texto_mes == "10"){
echo "<option value=10 selected='selected'>OCTUBRE</option>";
}else{
     echo "<option value=10>OCTUBRE</option>";
     }
	 
if($texto_mes == "11"){
echo "<option value=11 selected='selected'>NOVIEMBRE</option>";
}else{
     echo "<option value=11>NOVIEMBRE</option>";
     }
	 
if($texto_mes == "12"){
echo "<option value=12 selected='selected'>DICIEMBRE</option>";
}else{
     echo "<option value=12>DICIEMBRE</option>";
     }


echo "</select>";


echo "<select name='ano'>";
echo "<option value=0>A�O</option>";

for($ano=2009;$ano<2021;$ano++){
if($ano == $texto_ano){ 
echo "<option selected='selected'>$ano</option>";
                     }else{
					 echo "<option>$ano</option>";
					      }//cierra if($dia == $texto_ano){

//echo "<option>$ano</option>";

}
echo "</select>";




echo "<br><br>";
//-- FIN FECHA---


echo "<span class='linea_panel'>Stock:</span><br>";
echo "<input type='text' name='stock' value='$lee_contenido[stock]'><br><br>";

echo "<span class='linea_panel'>Precio:</span><br>";
echo "<input type='text' name='precio' value='$lee_contenido[precio]'><br><br>";

echo "<span class='linea_panel'>Destacar este contenido en la portada:&nbsp;&nbsp;</span>";

if($lee_contenido["destacar_portada"]=="si"){
echo "<input type='checkbox' checked='checked' name='destaca_portada'><br><br>";
}else{
    echo "<input type='checkbox' name='destaca_portada'><br><br>";
     }




echo "<span class='linea_panel'>Destacar este contenido en la subcategoria:&nbsp;&nbsp;</span>";

if($lee_contenido["destacar_subcategoria"]=="si"){
echo "<input type='checkbox' checked='checked' name='destaca_subcategoria'><br><br>";
}else{
    echo "<input type='checkbox' name='destaca_subcategoria'><br><br>";
     }

//echo "<input type='checkbox' name='destaca_subcategoria'><br><br>";


if($lee_contenido["foto"]!=""){
echo "<span class='linea_panel'>Esta es la foto actual del contenido</span><br>";
echo "<img src=$lee_contenido[foto] width=400><br>";
echo "<span class='linea_panel'>Para eliminarla haga click aqui:&nbsp;&nbsp;</span><input type='checkbox' name='elimina_foto'><br><br>";
}else{
  echo "<span class='linea_panel' style='color:#ff0000'>No hay foto cargada para esta subcategoria.</span><br><br>";
     }







echo "<span class='linea_panel'>Elija una foto para este contenido:</span><br><br>";
echo "<input type='file' name='foto' ><br><br>";

echo "<span class='linea_panel'>Elija un video para este contenido:</span><br><br>";
echo "<input type='file' name='video' ><br><br>";

echo "<input type='hidden' name='foto_cambia' value='$lee_contenido[foto]'><br><br>";
echo "<input type='hidden' name='clave_contenido' value='$lee_contenido[clave]' >";
echo "<input type='hidden' name='clave_subcategoria' value='$lee_contenido[clave_subcategoria]' >";
echo "<input type='hidden' name='accion' value='$_GET[accion]'";
echo "<input type='hidden' name='escribano_modifica' value='ok'>"; 


echo "<input type='submit' value='Cargar'>";





echo "</form>";

}
 //fin segunda parte que permite modificar



//FIN FORM PARA MODIFICAR CONTENIDO

?>
</div>


<div style="text-align:center;margin-top:30px">
<img src="botones/volver.jpg" onclick="location.href='index.php'" style="cursor:pointer">
</div>

                                              </div>

</body>
</html>
