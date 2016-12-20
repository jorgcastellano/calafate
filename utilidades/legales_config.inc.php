<?php

if(isset($_POST["escribano_legales"])=="ok"){



$texto = $_POST["elm1"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );

if($_POST["tiene_conte"]=="si"){
mysql_query("UPDATE legales SET texto_legales='$texto1' where idd_empresa_legales='$_SESSION[logeo]' ");
}else{ //if($_POST["tiene_conte"]=="si"){
mysql_query("INSERT INTO legales (texto_legales,idd_empresa_legales) VALUES ('$texto1','$_SESSION[logeo]')");
}//if($_POST["tiene_conte"]=="si"){


echo "<script>document.getElementById('2').style.display='block'</script>";

}//cierra if escribano


#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO


$sql1 = mysql_query("select * from legales where idd_empresa_legales = '$_SESSION[logeo]'");
$cta1 = mysql_num_rows($sql1);
$lee_sql1 = mysql_fetch_assoc($sql1);

echo "<br><b>Condiciones legales:</b><br><br>";

echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>";


if($cta1 > 0){
$texxto1 = str_replace("<br />","",$lee_sql1["texto_legales"]);
$texxto1 = str_replace("<br>","",$texxto1);
$tiene_conte = "si";
}else{ //if($cta1 > 0){

$texxto1 = "";
$tiene_conte = "no"; 

} //if($cta1 > 0){

echo "Texto:<br>";
echo "<textarea id='elm1' name='elm1' style='width:300px;height:80px' >$texxto1</textarea><br><br>";


//echo "<input type='hidden' name='clave_sub2' value='$_GET[clave_sub2]'>";
echo "<input type='hidden' name='tiene_conte' value='$tiene_conte'>";
echo "<input type='hidden' name='escribano_legales' value='ok'>";
echo "<input type='submit' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value=''>";



echo "</form>";


?>