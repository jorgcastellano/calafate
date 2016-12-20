<?php

if(isset($_POST["escribano_monedas"])=="ok"){

$sql_moneda = mysql_query("select * from monedas_base order by id_monedas_base asc");
$cta_moneda = mysql_num_rows($sql_moneda);




for($y=1;$y<=$cta_moneda;$y++){

$lee_moneda = mysql_fetch_assoc($sql_moneda);

$sql_mon = mysql_query("select * from monedas where idd_monedas_base='$lee_moneda[id_monedas_base]' and idd_empresa_monedas='$_SESSION[logeo]' ");
$cta_mon = mysql_num_rows($sql_mon);

if($cta_mon > 0){

$l_mon = mysql_fetch_assoc($sql_mon);

if($l_mon["habilitar_monedas"]=="on"){
$chec = "checked";
}else{ //if($l_mon["habilitar_monedas"]=="on"){
$chec = "";
}//if($l_mon["habilitar_monedas"]=="on"){

$valor_mone = $_POST["valor".$y];



if(isset($_POST["pub_mon".$y])){
$pub_mon ="on";
}else{ //if(isset($_POST["pub_mon".$y])){
$pub_mon ="";
}//if(isset($_POST["pub_mon".$y])){

mysql_query("UPDATE monedas SET valor_monedas='$valor_mone',habilitar_monedas='$pub_mon' where id_monedas='$l_mon[id_monedas]'");


}else{ //if($cta_mon){

$valor_mone = $_POST["valor".$y];

if(isset($_POST["pub_mon".$y])){
$pub_mon ="on";
}else{ //if(isset($_POST["pub_mon".$y])){
$pub_mon ="";
}//if(isset($_POST["pub_mon".$y])){


echo "<script>alert('$valor_mone')</script>";
echo "<script>alert('$pub_mon')</script>";

mysql_query("INSERT INTO monedas (idd_monedas_base,idd_empresa_monedas,valor_monedas,habilitar_monedas) VALUES ('$lee_moneda[id_monedas_base]','$_SESSION[logeo]','$valor_mone','$pub_mon')");

} //if($cta_mon){




} //for($y=1;$y<=$cta_moneda;$y++){

echo "<script>document.getElementById('1').style.display='block'</script>";

}//if(isset($_POST["escribano_moneda"])=="ok"){



############################IMPRIME INFO
############################IMPRIME INFO
############################IMPRIME INFO

echo "<br><b>Cotizaci�n monedas:</b><br><br>";

$sql_moneda = mysql_query("select * from monedas_base order by id_monedas_base asc");
$cta_moneda = mysql_num_rows($sql_moneda);


echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;margin-left:1px;margin-bottom:1px;background-color:#0061cc;color:#ffffff'>&nbsp; Nombre moneda:</div>";
echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;margin-left:1px;margin-bottom:1px;background-color:#0061cc;color:#ffffff'>&nbsp; Valor:</div>";
echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;margin-left:1px;margin-bottom:1px;background-color:#0061cc;color:#ffffff'>&nbsp; Habilitar:</div>

<div style='clear:both'></div>";


echo "<form method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data' name='cvalida2'>";

for($y=1;$y<=$cta_moneda;$y++){

$lee_moneda = mysql_fetch_assoc($sql_moneda);

$sql_mon = mysql_query("select * from monedas where idd_monedas_base='$lee_moneda[id_monedas_base]' and idd_empresa_monedas='$_SESSION[logeo]' ");
$cta_mon = mysql_num_rows($sql_mon);


if($cta_mon > 0){

$l_mon = mysql_fetch_assoc($sql_mon);

if($l_mon["habilitar_monedas"]=="on"){
$chec = "checked";
}else{ //if($l_mon["habilitar_monedas"]=="on"){
$chec = "";
}//if($l_mon["habilitar_monedas"]=="on"){


echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;margin-left:1px;margin-bottom:1px'>&nbsp; $lee_moneda[nombre_monedas_base]</div>";
echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;margin-left:1px;margin-bottom:1px'><input type='text' name='valor$y' value='$l_mon[valor_monedas]' style='width:150px;margin-left:15px;margin-top:3px'></div>";
echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;text-align:center;margin-left:1px;margin-bottom:1px'><input type='checkbox' style='margin-top:10px' name='pub_mon$y' $chec  ></div>";

}else{ //if($cta_mon){

echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;margin-left:1px;margin-bottom:1px'>&nbsp;  $lee_moneda[nombre_monedas_base]</div>";
echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;margin-left:1px;margin-bottom:1px'><input type='text' name='valor$y' value='0.00' style='width:150px;margin-left:15px;margin-top:3px' ></div>";
echo "<div style='float:left;width:180px;border: 1px solid #ccc;height:30px;line-height:30px;text-align:center;margin-left:1px;margin-bottom:1px'><input type='checkbox' style='margin-top:10px' name='pub_mon$y'></div>";


} //if($cta_mon){


echo "<div style='clear:both'></div>";

} //for($y=1;$y<=$cta_moneda;$y++){



echo "<input type='hidden' name='escribano_monedas' value='ok'>";
echo "<input type='button' onclick='cvalidab()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' >";



echo "</form>";


?>
