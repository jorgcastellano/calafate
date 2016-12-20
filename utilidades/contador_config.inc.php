<?php

if(isset($_POST["escribano_contador"])=="ok"){

if(isset($_POST["tiene_conte"])=="si"){

mysql_query("UPDATE contador_billetes SET numero_contador='$_POST[billete]' where idd_empresa_contador='$_SESSION[logeo]'");
}else{ //if($_POST["tiene_conte"]=="si"){
mysql_query("INSERT INTO contador_billetes (numero_contador,idd_empresa_contador) VALUES ('$_POST[billete]','$_SESSION[logeo]') ");
} //if($_POST["tiene_conte"]=="si"){

echo "<script>document.getElementById('3').style.display='block'</script>";

} //if(isset($_POST["escribano_contador"])=="ok"){


########################################IMPRIME INFO
########################################IMPRIME INFO
########################################IMPRIME INFO


echo "<br><b>Contador de tickets/billetes:</b><br><br>";

$sql_contador = mysql_query("select * from contador_billetes where idd_empresa_contador='$_SESSION[logeo]'");
$cta_contador = mysql_num_rows($sql_contador);

if($cta_contador > 0){
$tiene_conte = "si";
$lee_contador = mysql_fetch_assoc($sql_contador);
$num_billete = $lee_contador["numero_contador"];  
}else{ //if($cta_contador > 0){
$tiene_conte = "no";
$num_billete = "0";
} ////if($cta_contador > 0){

echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data' name='cvalida1' >";

echo "Numero de tickets actual: <input type='text' name='billete' value='$num_billete'><br><br>";

echo "<input type='hidden' name='tiene_conte' value='$tiene_conte'>";
echo "<input type='hidden' name='escribano_contador' value='ok'>";
echo "<input type='button' onclick='cvalidaa()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >";



echo "</form>";


?>