<?php





//echo "<script>document.getElementById('10').style.display='block'</script>";



#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO




echo "<form method='get' action='../articulo_frame.php' >";

echo "<br><br>Para generar el c�digo, debe seleccionar un vendedor. <br><br>  Elija vendedor:";

$sql_vend = mysql_query("select * from usuario where idd_empresa_usuario='$_SESSION[logeo]' && tipo_usuario = 'vendedor' order by nombre_usuario asc");

$cta_vend = mysql_num_rows($sql_vend);

echo "<select name='vendedor'>";

for($fd=1;$fd<=$cta_vend;$fd++){
$l_vend = mysql_fetch_assoc($sql_vend);

echo "<option value='$l_vend[id_usuario]'>$l_vend[nombre_usuario]</option>";

} //for($fd=1;$fd<=$cta_vend;$fd++){

echo "</select>";

echo "<br><br>Escriba el ancho en px del codigo (solo el n�mero): ";
echo "<input type='text' name='ancho' value=''><br><br>";

echo "<input type='hidden' name='id' value='$_GET[clave_sub2]'>";
echo "<input type='hidden' name='carga_alto' value='si'>";
echo "<input type='submit'  style='height:40px;width:180px;background-image:url(imagenes/bot_codigo.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >";



echo "</form>";

if(isset($_GET["alto"])){

if($_GET["alto"]>0 && $_GET["ancho"]>0){

$alto_frame = $_GET["alto"] + 100;
$alto_frame = $alto_frame."px";

$ancho_frame = $_GET["ancho"]."px";

 $ifram = "<iframe style='height:$alto_frame;border:0px;width:$ancho_frame' scrolling='no' marginwidth='0' marginheight='0' border='0'  src='http://www.creativoscalafate.com.ar/plataforma/articulo_frame.php?id=$_GET[clave_sub2]&ancho=$_GET[ancho]&id_vvv=$_GET[vendedor]'></iframe>";

$iframw = htmlspecialchars($ifram);

echo "Por favor seleccione el siguiente codigo:<br>";

echo "<div style='width:500px;background-color:#cccccc;border:1px solid #999999;margin-top:20px;padding:15px'>";

echo $iframw;

echo "</div>";


}else{ //if($_GET["alto"]>0){

echo "<br> Algo ha salido mal. Por favor vuelva a intentar y no olvide colocar el ancho <br>";


}//if($_GET["alto"]>0){


}//if(isset($_GET["alto"])){


/*
echo "<input type='text' style='width:500px;background-color:#cccccc;border:1px solid #999999;margin-top:20px' onFocus='select()' value='$iframw'> 

      ";
*/

?>