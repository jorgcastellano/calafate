<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}

if($_SESSION["tipo"]=="vendedor"){

echo "<script>alert('Solo autorizado para administradores')</script>";
echo "<script>location.href='index.php'</script>";
die();
}



if(isset($_POST["escribano"])=="ok"){

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
	$logo = "utilidades/fotos_categorias/".$nombre_foto.".".$extension;
	$logo = ",logo_empresa='".$logo."'";
   }else{
   $logo = "";
  }
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS

   }//cierra el for





mysql_query("UPDATE empresa SET
nombre_empresa='$_POST[nombre]',
rubro_empresa='$_POST[rubro]',
direccion_empresa='$_POST[direccion]',
tel1_empresa='$_POST[tel1]',
tel2_empresa='$_POST[tel2]',
mail_empresa='$_POST[mail]',
web_empresa='$_POST[web]'
$logo
where id_empresa='$_SESSION[logeo]'");


}//if(isset($_POST["escribano"])=="ok"){


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="es">
<meta charset="utf-8" />
<title>MODIFICA EMPRESA</title>

<link href="hoja_nueva.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="java.js" defer="defer"></script>

<script>

//-----------------envia carga empresa

function valida_empresa(){

if (document.empres.rubro.value.length==0){
alert("debe elegir un rubro");
document.empres.rubro.focus();
document.empres.rubro.className="borde1";
return 0;
}else{
    document.empres.rubro.className="borde2";
     }

if (document.empres.nombre.value.length==0){
alert("debe poner un nombre de la empresa");
document.empres.nombre.focus();
document.empres.nombre.className="borde1";
return 0;
}else{
    document.empres.nombre.className="borde2";
     }



if (document.empres.mail.value.length==0){
alert("debe colocar un mail");
document.empres.mail.focus();
document.empres.mail.className="borde1";
return 0;
}else{
//    alert(document.empres.mail.value);
	document.empres.mail.className="borde2";

	}

if(validacion(document.empres.mail.value)==false){
return 0;
}
//valida direccion de mail-------------------------------------

function validacion(dire)
{
var email = dire;
var verif = /^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (verif.exec(email) == null)
{
alert("Su email es incorrecto");
document.empres.mail.focus();
return false;
}
else
{
//alert("Su email es correcto");

return true;
}

}



//fin valida direccion de mail-------------------------------------




document.empres.submit();





}

//-------------------------fin envia carga empresa


</script>

</head>

<body>

<div class="global" >

<?php

include_once("encabezado.inc.php");

?>

<div style="padding:10px">


<?php

$sql = mysql_query("select * from empresa where id_empresa = '$_SESSION[logeo]'");
$l_sql = mysql_fetch_assoc($sql);

$rubro[1] = "alojamiento";
$rubro[2] = "excursiones";
$rubro[3] = "traslados";
$rubro[4] = "otras";


if($l_sql["rubro_empresa"] == $rubro[1]){

$rubro = "<option selected >alojamiento</option><option>excursiones</option><option>traslados</option><option>otras</option>";
}//if($l_sql["rubro_empresa"] == $rubro[1]){

if($l_sql["rubro_empresa"] == $rubro[2]){

$rubro = "<option selected >alojamiento</option><option selected >excursiones</option><option>traslados</option><option>otras</option>";
}//if($l_sql["rubro_empresa"] == $rubro[1]){

if($l_sql["rubro_empresa"] == $rubro[3]){

$rubro = "<option>alojamiento</option><option>excursiones</option><option selected >traslados</option><option>otras</option>";
}//if($l_sql["rubro_empresa"] == $rubro[1]){

if($l_sql["rubro_empresa"] == $rubro[4]){

$rubro = "<option>alojamiento</option><option>excursiones</option><option selected >traslados</option><option selected>otras</option>";
}//if($l_sql["rubro_empresa"] == $rubro[4]){


if($l_sql["logo_empresa"] != ""){
$ima_logo = "<img src='../".$l_sql["logo_empresa"]."' width='200'><br>";
}else{ //if($l_sql["logo_empresa"]){
$ima_logo = "";
} //if($l_sql["logo_empresa"]){

echo "
     <form method='post' action='modifica_empresa.php' style='font-size:12px' name='empres' enctype='multipart/form-data'>
<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>

<div style='width:200px;padding:5px;float:left'>Rubro:</div>
<div style='width:200px;padding:5px;float:left'>
<select name='rubro'>
$rubro
</select>
</div>
<div style='clear:both'></div>

<div style='width:200px;padding:5px;float:left'>Nombre de la empresa:</div>
<div style='width:200px;padding:5px;float:left'><input type='text' style='width:200px' name='nombre' value='$l_sql[nombre_empresa]'></div>
<div style='clear:both'></div>

<div style='width:200px;padding:5px;float:left'>Dirección fisica:</div>
<div style='width:200px;padding:5px;float:left'><input type='text' name='direccion' style='width:200px' value='$l_sql[direccion_empresa]'></div>
<div style='clear:both'></div>

<div style='width:200px;padding:5px;float:left'>Teléfono 1:</div>
<div style='width:200px;padding:5px;float:left'><input type='text' name='tel1' style='width:200px' value='$l_sql[tel1_empresa]'></div>
<div style='clear:both'></div>

<div style='width:200px;padding:5px;float:left'>Teléfono de asistencia en viaje:</div>
<div style='width:200px;padding:5px;float:left'><input type='text' name='tel2' style='width:200px' value='$l_sql[tel2_empresa]'></div>
<div style='clear:both'></div>

<div style='width:200px;padding:5px;float:left'>E-mail:</div>
<div style='width:200px;padding:5px;float:left'><input type='text' name='mail' style='width:200px' value='$l_sql[mail_empresa]'></div>
<div style='clear:both'></div>

<div style='width:200px;padding:5px;float:left'>Página web:</div>
<div style='width:200px;padding:5px;float:left'><input type='text' name='web' style='width:200px' value='$l_sql[web_empresa]'></div>
<div style='width:170px;padding:5px;float:left'>(ej. www.mipagina.com.ar)</div>
<div style='clear:both'></div>

$ima_logo

<div style='width:200px;padding:5px;float:left'>Cambiar o agregar logo (jpg o png) :</div>
<div style='width:300px;padding:5px;float:left'><input type='file' name='nfoto1' style='width:200px'></div>

<div style='clear:both'></div>

<input type='hidden' name='pass1' value='ok'>
<input type='hidden' name='pass2' value='ok'>
<input type='hidden' name='escribano' value='ok'>
<input type='button' onclick='valida_modifica_empresa()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value=''>
</form>

     ";




?>

</div>

<div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px"><a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a></div>

       </div>


</body>
</html>
