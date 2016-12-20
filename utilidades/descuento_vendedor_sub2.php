<?php

if(isset($_POST["escribano_desc_vendedor"])=="ok"){


$sql_vendg = mysql_query("select * from usuario where idd_empresa_usuario='$_SESSION[logeo]' order by nombre_usuario asc");

$cta_vendg = mysql_num_rows($sql_vendg);


for($fdh=1;$fdh<=$cta_vendg;$fdh++){
$l_vendg = mysql_fetch_assoc($sql_vendg);



//busca si tiene descuento
//busca si tiene descuento


$b_deq = mysql_query("select * from descuento_vendedor where idd_vendedor_dv='$l_vendg[id_usuario]' and idd_empresa_dv='$_SESSION[logeo]' and idd_sub2_dv='$_POST[clave_sub2]' ");

$c_deq = mysql_num_rows($b_deq);

$descuento_vendedor = $_POST["descuento_$fdh"];


if($c_deq > 0){

mysql_query("UPDATE descuento_vendedor SET descuento_dv='$descuento_vendedor' where idd_vendedor_dv='$l_vendg[id_usuario]' and idd_empresa_dv='$_SESSION[logeo]' ");

}else{ //if($c_de > 0){



mysql_query("INSERT INTO descuento_vendedor (idd_sub2_dv,descuento_dv,idd_empresa_dv,idd_vendedor_dv) VALUES ('$_POST[clave_sub2]','$descuento_vendedor','$_SESSION[logeo]','$l_vendg[id_usuario]')");

}//if($c_de > 0){



//fin busca si tiene descuento
//fin busca si tiene descuento




mysql_query("");


}//for($fdh=1;$fdh<=$cta_vendg;$fdh++){




echo "<script>document.getElementById('12').style.display='block'</script>";

}//cierra if escribano


#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO


echo "<form method='post' action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' >";

echo "<br><br>Descuento por vendedor para este articulo :<br><br>";

$sql_vendh = mysql_query("select * from usuario where idd_empresa_usuario='$_SESSION[logeo]' order by nombre_usuario asc");

$cta_vendh = mysql_num_rows($sql_vendh);



for($fdh=1;$fdh<=$cta_vendh;$fdh++){
$l_vendh = mysql_fetch_assoc($sql_vendh);

//busca si tiene descuento
//busca si tiene descuento


$b_de = mysql_query("select * from descuento_vendedor where idd_vendedor_dv='$l_vendh[id_usuario]' and idd_empresa_dv='$_SESSION[logeo]' and idd_sub2_dv='$_GET[clave_sub2]'");

$c_de = mysql_num_rows($b_de);

if($c_de > 0){

$l_de = mysql_fetch_assoc($b_de);

$descuento_vendedor = $l_de["descuento_dv"];


}else{ //if($c_de > 0){

$descuento_vendedor = 0;

}//if($c_de > 0){



//fin busca si tiene descuento
//fin busca si tiene descuento


echo "<div style='width:250px;float:left;height:20px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px'>
$l_vendh[nombre_usuario]
</div>";


echo "<div style='width:150px;float:left;height:20px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px'>
% &nbsp; <input type='text' name='descuento_$fdh' style='width:50px;height:20px;border:0px' value='$descuento_vendedor'>
</div>";

echo "<div style='clear:both'></div>";


} //for($fd=1;$fd<=$cta_vend;$fd++){


echo "<input type='hidden' name='clave_sub2' value='$_GET[clave_sub2]'>";
echo "<input type='hidden' name='escribano_desc_vendedor' value='ok'>";
echo "<input type='submit'  style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >";


echo "</form>";


?>