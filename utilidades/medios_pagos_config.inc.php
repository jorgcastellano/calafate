<?php

if(isset($_POST["escribano_paypal"])=="ok"){

if(isset($_POST["publica_paypal"])){
$publica = "si";
}else{
$publica = "no";
}

$texto = $_POST["elm1t_paypal"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );



if($_POST["tiene_conte"]=="si"){
mysql_query("UPDATE medio_pago_paypal SET habilitar_mp_paypal ='$publica',mail_paypal='$_POST[mail_paypal]',texto_mp_paypal='$texto',porcentaje_mp_paypal='$_POST[porcentaje_paypal]' where idd_empresa_mp_paypal='$_SESSION[logeo]' ");
}else{ //if($_POST["tiene_conte"]=="si"){
mysql_query("INSERT INTO medio_pago_paypal (idd_empresa_mp_paypal,habilitar_mp_paypal,mail_paypal,texto_mp_paypal,porcentaje_mp_paypal) VALUES ('$_SESSION[logeo]','$publica','$_POST[mail_paypal]','$texto','$_POST[porcentaje_paypal]')");
}//if($_POST["tiene_conte"]=="si"){


echo "<script>document.getElementById('4').style.display='block'</script>";

}//cierra if escribano paypal


if(isset($_POST["escribano_mp"])=="ok"){

if(isset($_POST["publica_mp"])){
$publica = "si";
}else{
$publica = "no";
}

$texto = $_POST["elm1t_mp"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );

if($_POST["tiene_conte"]=="si"){
mysql_query("UPDATE medio_pago_mercadopago SET habilitar_mp_mp ='$publica',dato1_mp_mp='$_POST[dato1]',dato2_mp_mp='$_POST[dato2]',texto_mp_mp='$texto1',porcentaje_mp_mp='$_POST[porcentaje_mp]' where idd_empresa_mp_mp='$_SESSION[logeo]' ");
}else{ //if($_POST["tiene_conte"]=="si"){

mysql_query("INSERT INTO medio_pago_mercadopago (idd_empresa_mp_mp,dato1_mp_mp,dato2_mp_mp,habilitar_mp_mp,texto_mp_mp,porcentaje_mp_mp) VALUES ('$_SESSION[logeo]','$_POST[dato1]','$_POST[dato2]','$publica','$texto1','$_POST[porcentaje_mp]')");
}//if($_POST["tiene_conte"]=="si"){


echo "<script>document.getElementById('4').style.display='block'</script>";

}//cierra if escribano mercado pago


if(isset($_POST["escribano_cash"])=="ok"){

if(isset($_POST["publica_cash"])){
$publica = "si";
}else{
$publica = "no";
}

$texto = $_POST["elm1t_cash"];
$texto = str_replace("<p>","",$texto);
$texto = str_replace("</p>","<br>",$texto);

$texto1 = stripslashes( $texto );



if($_POST["tiene_conte"]=="si"){
mysql_query("UPDATE medio_pago_cash SET habilitar_mp_cash ='$publica',texto_mp_cash='$texto',porcentaje_mp_cash='$_POST[porcentaje_cash]' where idd_empresa_mp_cash='$_SESSION[logeo]' ");
}else{ //if($_POST["tiene_conte"]=="si"){
echo "<br>hola<br>";
mysql_query("INSERT INTO medio_pago_cash (idd_empresa_mp_cash,habilitar_mp_cash,texto_mp_cash,porcentaje_mp_cash) VALUES ('$_SESSION[logeo]','$publica','$texto','$_POST[porcentaje_cash]')");
}//if($_POST["tiene_conte"]=="si"){


echo "<script>document.getElementById('4').style.display='block'</script>";

}//cierra if escribano cash



#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO

echo "<br><b>Medios de Pago:</b><br><br>";

####> PAYPAL
####> PAYPAL

$sql1 = mysql_query("select * from medio_pago_paypal where idd_empresa_mp_paypal = '$_SESSION[logeo]'");
$cta1 = mysql_num_rows($sql1);
$lee_sql1 = mysql_fetch_assoc($sql1);


echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data' name='paypal'>";


if($cta1 > 0){
$tiene_conte = "si";

if($lee_sql1["habilitar_mp_paypal"]=="si"){ 
$publica_paypal = "checked";
}else{ //if($lee_sql1["habilitar_mp_paypal"]=="si"){ 
$publica_paypal = "";
} //if($lee_sql1["habilitar_mp_paypal"]=="si"){ 

$mail_paypal = $lee_sql1["mail_paypal"];

$texxto_paypal = str_replace("<br />","",$lee_sql1["texto_mp_paypal"]);
$texxto_paypal = str_replace("<br>","",$texxto_paypal);


}else{ //if($cta1 > 0){

$tiene_conte = "no"; 
$publica_paypal = "";
$mail_paypal = "";
$texxto_paypal = "";
} //if($cta1 > 0){

echo "<img src='imagenes/paypal.jpg'><br><br>
Habilitar : <input type='checkbox' name='publica_paypal' $publica_paypal ><br><br>
Mail cuenta Paypal: <input type='text' name='mail_paypal' value='$mail_paypal'><br><br>

Aplicar porcentaje de recargo %: <select name='porcentaje_paypal'>"; 

for($h=0;$h<101;$h++){

if($lee_sql1["porcentaje_mp_paypal"]==$h){
echo "<option selected >$h</option>";
}else{ //if($lee_sql1["porcentaje_mp_paypal"]){
echo "<option >$h</option>";
} //if($lee_sql1["porcentaje_mp_paypal"]){


} //for($h=0;$h<101;$h++){

echo "</select><br><br>  Terminos y condiciones: <br>
<textarea id='elm1t_paypal' name='elm1t_paypal' style='width:300px;height:80px' >$texxto_paypal</textarea><br><br>

";





echo "<input type='hidden' name='tiene_conte' value='$tiene_conte'>";
echo "<input type='hidden' name='escribano_paypal' value='ok'>";
echo "<br><input type='button' onclick='paypalh()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:0px;margin-bottom:40px;cursor:pointer' value=''>";



echo "</form>";


####> FIN PAYPAL
####> FIN PAYPAL

echo "<br><hr><br>";


####> MERCADO PAGO
####> MERCADO PAGO

$sql2 = mysql_query("select * from medio_pago_mercadopago where idd_empresa_mp_mp = '$_SESSION[logeo]'");
$cta2 = mysql_num_rows($sql2);
$lee_sql2 = mysql_fetch_assoc($sql2);


echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data' name='mercadopago'>";


if($cta2 > 0){
$tiene_conte1 = "si";

if($lee_sql2["habilitar_mp_mp"]=="si"){ 
$publica_mp = "checked";
}else{ //if($lee_sql1["habilitar_mp_paypal"]=="si"){ 
$publica_mp = "";
} //if($lee_sql1["habilitar_mp_mp"]=="si"){ 
$dato1 = $lee_sql2["dato1_mp_mp"];
$dato2 = $lee_sql2["dato2_mp_mp"];


$texxto_mp = str_replace("<br />","",$lee_sql2["texto_mp_mp"]);
$texxto_mp = str_replace("<br>","",$texxto_mp);


}else{ //if($cta1 > 0){

$publica_mp = "";
$tiene_conte1 = "no"; 
$dato1 = "";
$dato2 = "";
$texxto_mp = "";
} //if($cta1 > 0){

echo "<img src='imagenes/mp.jpg'><br><br>
Habilitar : <input type='checkbox' name='publica_mp' $publica_mp ><br>
Acc_id <span style='color:#ff0000;font-size:14px'>*</span>: <input type='text' name='dato1' value='$dato1'><br>
Enc <span style='color:#ff0000;font-size:14px'>*</span>: <input type='text' name='dato2' value='$dato2'><br><br>

<span style='color:#ff0000;font-size:18px'>* &nbsp;</span><span style='color:#555555;font-size:14px'>Para ver como obtener estos c�digos hacer <a href='codigos_mp.php' style='text-decoration:none' target='_blank'><b> Click aqu� </b> </a></span><br><br>

Aplicar porcentaje de recargo %: <select name='porcentaje_mp'>"; 

for($h=0;$h<101;$h++){

if($lee_sql2["porcentaje_mp_mp"]==$h){
echo "<option selected >$h</option>";
}else{ //if($lee_sql1["porcentaje_mp_mp"]){
echo "<option >$h</option>";
} //if($lee_sql1["porcentaje_mp_mp"]){


} //for($h=0;$h<101;$h++){

echo "</select><br><br>Terminos y condiciones: <br>
<textarea id='elm1t_mp' name='elm1t_mp' style='width:300px;height:80px' >$texxto_mp</textarea><br><br>

";





echo "<input type='hidden' name='tiene_conte' value='$tiene_conte1'>";
echo "<input type='hidden' name='escribano_mp' value='ok'>";
echo "<br><input type='button' onclick='mercadopagoh()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:0px;margin-bottom:40px;cursor:pointer' value=''>";



echo "</form>";


####> FIN MERCADO PAGO
####> FIN MERCADO PAGO


echo "<br><hr><br>";

####> CASH
####> CASH

$sql3 = mysql_query("select * from medio_pago_cash where idd_empresa_mp_cash = '$_SESSION[logeo]'");
$cta3 = mysql_num_rows($sql3);
$lee_sql3 = mysql_fetch_assoc($sql3);


echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data' name='cash'>";


if($cta3 > 0){
$tiene_conte = "si";

if($lee_sql3["habilitar_mp_cash"]=="si"){ 
$publica_cash = "checked";
}else{ //if($lee_sql3["habilitar_mp_cash"]=="si"){ 
$publica_cash = "";
} //if($lee_sql3["habilitar_mp_cash"]=="si"){ 

$texxto_cash = str_replace("<br />","",$lee_sql3["texto_mp_cash"]);
$texxto_cash = str_replace("<br>","",$texxto_cash);


}else{ //if($cta1 > 0){

$tiene_conte = "no"; 
$publica_cash = "";
$texxto_cash = "";
} //if($cta1 > 0){

echo "<img src='imagenes/banco.jpg'><br><br>
Habilitar : <input type='checkbox' name='publica_cash' $publica_cash ><br><br>

Aplicar porcentaje de recargo %: <select name='porcentaje_cash'>"; 

for($h=0;$h<101;$h++){

if($lee_sql3["porcentaje_mp_cash"]==$h){
echo "<option selected >$h</option>";
}else{ //if($lee_sql3["porcentaje_mp_cash"]){
echo "<option >$h</option>";
} //if($lee_sql3["porcentaje_mp_cash"]){


} //for($h=0;$h<101;$h++){

echo "</select><br><br>  Terminos y condiciones: <br>
<textarea id='elm1t_cash' name='elm1t_cash' style='width:300px;height:80px' >$texxto_cash</textarea><br><br>

";





echo "<input type='hidden' name='tiene_conte' value='$tiene_conte'>";
echo "<input type='hidden' name='escribano_cash' value='ok'>";
echo "<br><input type='submit' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:0px;margin-bottom:40px;cursor:pointer' value=''>";



echo "</form>";


####> FIN CASH
####> FIN CASH




?>