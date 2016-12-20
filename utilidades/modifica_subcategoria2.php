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





$subcategoria = $_POST["subcategoria_2"];
$subcategoria1 = stripslashes( $subcategoria );

$texto = $_POST["elm1"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );

if($_POST["publicar"]=="on"){
$publicar = "si";
}else{//if($_POST["publicar"]=="on"){
$publicar = "";
}//if($_POST["publicar"]=="on"){



//busca clave categoria

$sql = mysql_query("select clave_categoria_s1 from subcategoria_1 where clave='$_POST[subcategoria_1]'");
$lee_sql = mysql_fetch_assoc($sql);
$clave_categoria = $lee_sql["clave_categoria_s1"];

//fin busca clave categoria


if($_FILES["foto"]["size"]>1){

mysql_query("UPDATE subcategoria_2 SET clave_categoria_s2='$clave_categoria',clave_sub1_s2='$_POST[subcategoria_1]',nombre_sub2='$subcategoria1',foto_sub2='fotos_categorias/$nombre_foto',texto_sub2='$texto1',publica_sub2='$publicar' where clave='$_POST[clave_sub2]'");

}else{//if($_FILES["foto"]["size"]>1){

mysql_query("UPDATE subcategoria_2 SET clave_categoria_s2='$clave_categoria',clave_sub1_s2='$_POST[subcategoria_1]',nombre_sub2='$subcategoria1',texto_sub2='$texto1',publica_sub2='$publicar' where clave='$_POST[clave_sub2]'");


}//cierra if($_FILES["foto"]["size"]>1){


if($_POST["borra_foto"]=="on" && $_FILES["foto"]["size"]<1){
mysql_query("UPDATE subcategoria_1 SET foto_sub1='' where clave = '$_POST[clave_sub1]' ");
}//cierra if($_POST["borra_foto"]=="on" && $_FILES["foto"]["size"]<1){






if($_POST["clave_sub1_actual"] != $_POST["subcategoria_1"]){


//Actualiza clave categoria en las articulos afectados

$sql2 = mysql_query("select * from articulo where clave_sub1_ar = '$_POST[clave_sub1_actual]' ");
$cta_sql2 = mysql_num_rows($sql2);

for($aa=1;$aa<=$cta_sql2;$aa++){
$lee_sql2 = mysql_fetch_assoc($sql2);


mysql_query("UPDATE articulo SET clave_sub1_ar='$_POST[subcategoria_1]' where clave='$lee_sql2[clave]' ");

}//cirra for($aa=1;$aa<=$cta_sql2;$aa++){

//fin Actualiza clave categoria en  los articulos afectados



//Actualiza clave categoria en las fotos afectadas

$sql2 = mysql_query("select * from fotos where clave_sub1_f = '$_POST[clave_sub1_actual]' ");
$cta_sql2 = mysql_num_rows($sql2);

for($aa=1;$aa<=$cta_sql2;$aa++){
$lee_sql2 = mysql_fetch_assoc($sql2);


mysql_query("UPDATE fotos SET clave_sub1_f='$_POST[subcategoria_1]' where clave='$lee_sql2[clave]' ");

}//cirra for($aa=1;$aa<=$cta_sql2;$aa++){

//fin Actualiza clave categoria en  las fotos afectadas







}//cierra if($_POST["clave_cat_actual"] != $_POST["clave_categoria"]){





















}//cierra if escribano



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>MODIFICA SUBCATEGORIA 2</title>
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


//----------------------FILTRA POR CATEGORIA Y SUBCATEGORIA 1

if($_POST["clave_subcategoria_1"]=="" && $_POST["clave_sub2"]==""){

echo "<form method='post' action='$_SERVER[php_self]' enctype='multipart/form-data'>";

echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

$sql = mysql_query("select categoria.nombre_categoria, subcategoria_1.* from categoria left outer join subcategoria_1 on categoria.clave = subcategoria_1.clave_categoria_s1 where subcategoria_1.nombre_sub1 <> '' and subcategoria_1.publica_sub1 = 'si' order by subcategoria_1.nombre_sub1 asc");
$cta_sql = mysql_num_rows($sql);
echo "Asociar a la subcategoria:<br>";
for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);
$clave = $lee_sql["clave"];
$clave_categoria = $lee_sql["clave_categoria"];
$nombre_sub1 = $lee_sql["nombre_sub1"];
$nombre_categoria = $lee_sql["nombre_categoria"];

echo "<div class='recuadro' style='width:50px'>";
echo "<input type='radio' name='clave_subcategoria_1' value='$clave'>";
echo "</div>";

echo "<div class='recuadro' style='width:720px;text-align:left'>";
echo "&nbsp;"."$nombre_sub1 de la categoria <span style='color:#ff0000'>$nombre_categoria</span><br>";
echo "</div>";



echo "<div style='clear:both'></div>";
}// cierra for




echo "<input type='submit' value='Ir'>";



echo "</form>";

}//if($_POST["clave_subcategoria_1"]==""){


//----------------------FIN FILTRA POR CATEGORIA Y SUBCATEGORIA 1




if($_POST["clave_sub2"]==""){

    if($_POST["clave_subcategoria_1"]!=""){

echo "<div>";
echo "<form method='post' action='$_SERVER[php_self]' enctype='multipart/form-data'>";

echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

$sql = mysql_query("select * from subcategoria_2 where clave_sub1_s2 = '$_POST[clave_subcategoria_1]' order by nombre_sub2 asc");
$cta_sql = mysql_num_rows($sql);
echo "Elegir subcategoria 2:<br><br>";
for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);
$clave = $lee_sql["clave"];
$nombre_sub2 = $lee_sql["nombre_sub2"];

if($lee_sql["publica_sub2"]=="si"){

echo "<div class='recuadro' style='width:50px'>";
echo "<input type='radio' name='clave_sub2' value='$clave'>";
echo "</div>";

echo "<div class='recuadro' style='width:720px;text-align:left'>";
echo "&nbsp;".$nombre_sub2;
echo "</div>";

echo "<div style='clear:both'></div>";

}else{//if($lee_sql["publica_sub2"]=="si"){

echo "<div class='recuadro1' style='width:50px'>";
echo "<input type='radio' name='clave_sub2' value='$clave'>";
echo "</div>";

echo "<div class='recuadro1' style='width:720px;text-align:left'>";
echo "&nbsp;".$nombre_sub2;
echo "</div>";

echo "<div style='clear:both'></div>";




}//if($lee_sql["publica_sub2"]=="si"){


}// cierra for

echo "<br><input type='submit' value='Ir a modificar'>";

echo "</form>";

echo "</div>";


   }//if($_POST["clave_subcategoria_1"]!=""){

}else{ //if($_POST["clave_sub2"]==""){


     

$sql1 = mysql_query("select * from subcategoria_2 where clave = '$_POST[clave_sub2]'");
$lee_sql1 = mysql_fetch_assoc($sql1);

echo "<form method='post' action='$_SERVER[php_self]' enctype='multipart/form-data'>";

echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

$sql = mysql_query("select categoria.nombre_categoria, subcategoria_1.* from categoria left outer join subcategoria_1 on categoria.clave = subcategoria_1.clave_categoria_s1 where nombre_sub1 <> '' and subcategoria_1.publica_sub1 = 'si' order by subcategoria_1.nombre_sub1 asc");
$cta_sql = mysql_num_rows($sql);
echo "Asociar a la subcategoria:<br><br>";
for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);
$clave = $lee_sql["clave"];
$clave_categoria = $lee_sql["clave_categoria_s1"];
$nombre_sub1 = $lee_sql["nombre_sub1"];
$nombre_categoria = $lee_sql["nombre_categoria"];




if($lee_sql1["clave_sub1_s2"] == $clave){

echo "<div class='recuadro' style='width:50px'>";
echo "<input type='radio' name='subcategoria_1' value='$clave' checked='checked'>";
echo "</div>";

echo "<div class='recuadro' style='width:720px;text-align:left'>";
echo "&nbsp;$nombre_sub1 de la categoria <span style='color:#ff0000'>$nombre_categoria</span><br>";
echo "</div>";

}else{ //if($lee_sql1["clave_sub1_s2"] == $nombre_sub1){

echo "<div class='recuadro' style='width:50px'>";
echo "<input type='radio' name='subcategoria_1' value='$clave' >";
echo "</div>";

echo "<div class='recuadro' style='width:720px;text-align:left'>";
echo "&nbsp;$nombre_sub1 de la categoria <span style='color:#ff0000'>$nombre_categoria</span><br>";
echo "</div>";



}//if($lee_sql1["clave_sub1_s2"] == $nombre_sub1){

echo "<div style='clear:both'></div>";
}// cierra for

if($lee_sql1["publica_sub2"]=="si"){
echo "<div class='recuadro' style='width:780px;margin-top:20px'>";
echo "Publicar:&nbsp;<input type='checkbox' name='publicar' checked='checked'><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";

}else{//if($lee_sql1["destacar"]=="si"){
echo "<div class='recuadro' style='width:780px;margin-top:20px'>";
echo "Publicar:&nbsp;<input type='checkbox' name='publicar' ><br><br>";
echo "</div>";
echo "<div style='clear:both'></div>";

}//if($lee_sql1["destacar"]=="si")



echo "<br>Nombre de la subcategoria:<br>";
echo "<input type='text' name='subcategoria_2' value='$lee_sql1[nombre_sub2]'><br><br>";


echo "Texto:<br>";
echo "<textarea id='elm1' name='elm1' rows='2' cols='2' >$lee_sql1[texto_sub2]</textarea><br><br>";

if($lee_sql1["foto_sub2"]==""){
echo "No hay foto cargada<br><br>";

}else{ //if($lee_sql1["foto_sub1"]==""){
echo "<br><img src='$lee_sql1[foto_sub2]' width=200><br>";
echo "Borrar esta foto:&nbsp;<input type='checkbox' name='borra_foto'><br>";
}



echo "Foto:<br>";
echo "<input type='file' name='foto'><br><br>";

echo "<input type='hidden' name='clave_sub1_actual' value='$lee_sql1[clave_sub1_s2]'>";
echo "<input type='hidden' name='clave_sub2' value='$_POST[clave_sub2]'>";
echo "<input type='hidden' name='escribano' value='ok'>";
echo "<input type='submit' value='cargar'>";



echo "</form>";


      

}//cierra //if($_POST["clave_sub2"]==""){
?>

</div>  

<div style="width:800px;height:50px;background-image:url(imagenes/volver.jpg);margin-bottom:0px;cursor:pointer" onclick="location.href='panel.php'"></div>
  
       </div>


</body>
</html>
