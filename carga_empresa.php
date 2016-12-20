<?php
include_once("encabezado.inc.php");

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

									   
									   
							
move_uploaded_file($temporal,"utilidades/fotos_categorias/".$nombre_foto.".".$extension); 

//LLAMA A LA FUNCION ADELGAZA FOTOS
   if($_FILES["$arra_foto[$x]"]["size"]>0){
	//echo "<script>alert('$nombre_foto')<script>"; 
	$ima = "utilidades/fotos_categorias/".$nombre_foto.'.jpg';
    $ima2 = "utilidades/fotos_categorias/".$nombre_foto.'.jpg';
	
   $imagen = $ima;
   $nombre_imagen_asociada = $ima2;
   redimensionar_imagen($imagen, $nombre_imagen_asociada);
$logo = "utilidades/fotos_categorias/".$nombre_foto.".".$extension; 
   }else{
   $logo = "";
  }    
//FIN LLAMA A LA FUNCION ADELGAZA FOTOS   
  
   }//cierra el for


$logo = "utilidades/fotos_categorias/".$nombre_foto.".".$extension;   
mysql_query("INSERT INTO empresa (nombre_empresa,rubro_empresa,direccion_empresa,tel1_empresa,tel2_empresa,mail_empresa,web_empresa,logo_empresa) VALUES ('$_POST[nombre]','$_POST[rubro]','$_POST[direccion]','$_POST[tel1]','$_POST[tel2]','$_POST[mail]','$_POST[web]','$logo')");

$sql = mysql_query("select * from empresa order by id_empresa desc limit 0,1");
$l_sql = mysql_fetch_assoc($sql);

$id_empresa = $l_sql["id_empresa"];

mysql_query("INSERT INTO usuario (idd_empresa_usuario,nombre_persona_usuario,nombre_usuario,contrasena_usuario,tipo_usuario,mail_usuario) VALUES ('$id_empresa','$_POST[nombre]','$_POST[nombre]','$_POST[pass1]','empresa','$_POST[mail]')");

}//if(isset($_POST["escribano"])=="ok"){

?>

<META NAME="Description" CONTENT="">

<META NAME="Keywords" CONTENT="">



<title>PLATAFORMA</title>




    <script src="utilidades/src/js/jscal2.js"></script>
    <script src="utilidades/src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/steel/steel.css" />


</head>

<body >




                                                  <div  class="global" >

<?php
if(isset($_POST["escribano"])=="ok"){

echo "<div style='width:600px;height:50px;line-height:50px;text-align:center;background-color:#81f29e;color:#0f802c'>CARGA EXITOSA</div>";


}//if(isset($_POST["escribano"])=="ok"){

?>

										  
<div style="width:230px;float:left">



</div>

<div style="width:600px;float:left;padding:10px"> <!--   ttt -->



<form method="post" action="carga_empresa.php" style="font-size:12px" name="empres" enctype="multipart/form-data">
<input type="hidden" name="MAX-FILE_SIZE" value="83886080">

<div style="width:200px;padding:5px;float:left">Rubro:</div>
<div style="width:200px;padding:5px;float:left">
<select name="rubro">
<option selected></option>
<option>alojamiento</option>
<option>excursiones</option>
<option>traslados</option>
<option>otras</option>
</select>
</div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">Nombre de la empresa:</div>
<div style="width:200px;padding:5px;float:left"><input type="text" style="width:200px" name="nombre"></div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">Direcci�n fisica:</div>
<div style="width:200px;padding:5px;float:left"><input type="text" name="direccion" style="width:200px"></div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">Tel�fono 1:</div>
<div style="width:200px;padding:5px;float:left"><input type="text" name="tel1" style="width:200px"></div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">Tel�fono 2:</div>
<div style="width:200px;padding:5px;float:left"><input type="text" name="tel2" style="width:200px"></div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">E-mail:</div>
<div style="width:200px;padding:5px;float:left"><input type="text" name="mail" style="width:200px"></div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">Contrase�a:</div>
<div style="width:200px;padding:5px;float:left"><input type="password" name="pass1" style="width:200px"></div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">Confirma contrase�a:</div>
<div style="width:200px;padding:5px;float:left"><input type="password" name="pass2" style="width:200px"></div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">P�gina web:</div>
<div style="width:200px;padding:5px;float:left"><input type="text" name="web" style="width:200px"></div>
<div style="width:170px;padding:5px;float:left">(ej. www.mipagina.com.ar)</div>
<div style="clear:both"></div>

<div style="width:200px;padding:5px;float:left">Logo (jpg o png):</div>
<div style="width:300px;padding:5px;float:left"><input type="file" name="nfoto1" style="width:200px"></div>

<div style="clear:both"></div>

<input type="hidden" name="escribano" value="ok">
<input type="button" value="Cargar" onclick="valida_empresa()" style="height:50px;cursor:pointer">
</form>

</div><!--   ttt -->

<div style="clear:both"></div>

<?php
//include_once("pie.inc.php");
?>





                                                         </div>




</body>
</html>
