<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


if(isset($_POST["escribano"])=="ok"){

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





$subcategoria = $_POST["subcategoria"];
$subcategoria1 = stripslashes( $subcategoria );

$texto = $_POST["elm1"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );


if($_FILES["foto"]["size"]>1){

mysql_query("INSERT INTO subcategoria_1 (clave_categoria_s1,nombre_sub1,foto_sub1,texto_sub1,publica_sub1) VALUES ('$_POST[categoria]','$subcategoria1','fotos_categorias/$nombre_foto','$texto1','si')");

}else{//if($_FILES["foto"]["size"]>1){

mysql_query("INSERT INTO subcategoria_1 (clave_categoria_s1,nombre_sub1,texto_sub1,publica_sub1) VALUES ('$_POST[categoria]','$subcategoria1','$texto1','si')");


}//cierra if($_FILES["foto"]["size"]>1){


//---------busca la la clave de lo insertado y va a agregar mas fotos
/*
$bsql = mysql_query("select * from subcategoria_1 order by clave desc limit 0,1");
$blee = mysql_fetch_assoc($bsql);

$categoria = $blee["clave_categoria_s1"];
$sub1 = $blee["clave"];



header("location: carga_fotos.php?categoria=$categoria&sub1=$sub1&sub2=$sub2&sub1=$sub1&articulo=$articulo&carga_sub1=si");
*/
//---------fin busca la la clave de lo insertado y va a agregar mas fotos






if($_POST["borra_foto"]=="on" && $_FILES["foto"]["size"]<1){
mysql_query("UPDATE subcategoria_1 SET foto_sub1='' where clave = '$_POST[clave_sub1]' ");
}




}//cierra if escribano



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>CARGA SUBCATEGORIA</title>
<link href="hoja.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>


<script>

function envia_p(){

var elige = "si";

if(document.formuu.subcategoria.value.length==0){
alert("Debe poner un nombre");
document.formuu.subcategoria.focus();
return 0;
}//if(document.formuu.subcategoria.length==0){


	for ( var i = 0; i < document.formuu.categoria.length; i++ ){
    if ( document.formuu.categoria[i].checked ){
    document.formuu.submit();
    elige = "no";
    break;
    }
    }//for ( var i = 0; i < document.formuu.categoria.length; i++ ){

if(elige == "si"){	
alert("Antes debe elegir una subcategoria");
}//if(elige == "si"){	

 
 
}//function envia(){


</script>



</head>

<body>

         <div class="global1" >

<div class="encabezado"></div>

<div style="padding:10px">

<?php


echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data' name='formuu' >";

echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";

$sql = mysql_query("select * from categoria where publica_categoria = 'si'");
$cta_sql = mysql_num_rows($sql);
echo "Asociar a la categoria:<br><br>";
for($c=1;$c<=$cta_sql;$c++){
$lee_sql = mysql_fetch_assoc($sql);
$clave = $lee_sql["clave"];
$nombre_categoria = $lee_sql["nombre_categoria"];

echo "<div class='recuadro' style='width:50px'>";
echo "<input type='radio' name='categoria' value='$clave'>";
echo "</div>";

echo "<div class='recuadro' style='width:720px;text-align:left'>";
echo "&nbsp;".$nombre_categoria;
echo "</div>";

echo "<div style='clear:both'></div>";
}// cierra for

echo "<br>Nombre de la subcategoria:<br>";
echo "<input type='text' name='subcategoria'><br><br>";


echo "Texto:<br>";
echo "<textarea id='elm1' name='elm1' rows='2' cols='2' ></textarea><br><br>";


echo "Foto:<br>";
echo "<input type='file' name='foto'><br><br>";


echo "<input type='hidden' name='escribano' value='ok'>";
//echo "<input type='submit' value='cargar'>";


echo "<input type='button' value='Cargar' onclick='envia_p()'  >";


echo "</form>";


?>


</div>  

<div style="width:1010px;text-align:center"><hr><a href="panel.php"><img src="imagenes/volver1.jpg" title="Volver al panel"></a></div>
  
       </div>


</body>
</html>
