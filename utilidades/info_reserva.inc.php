<?php

if(isset($_POST["escribano_info_reserva"])=="ok"){

########## codigo A

for($p=1;$p<=$_POST["cant_vueltasy"];$p++){

if(isset($_POST["a".$p])){
$cr = "on";
}else{
$cr="";
} //if($_POST["a".$p]=="on"){

$nm= "x".$p;

mysql_query("UPDATE info_reserva SET $nm = '$cr' where idd_sub2_ir='$_GET[clave_sub2]' and tipo_ir='a' ");

}//for($p=1;$p<=$_GET["cant_vueltasy"];$p++){


########## fin codigo A


########## codigo B

for($p=1;$p<=$_POST["cant_vueltasy"];$p++){

if(isset($_POST["b".$p])){
$cr = "on";
}else{
$cr="";
} //if($_POST["b".$p]=="on"){

$nm= "x".$p;

mysql_query("UPDATE info_reserva SET $nm = '$cr' where idd_sub2_ir='$_GET[clave_sub2]' and tipo_ir='b' ");

}//for($p=1;$p<=$_GET["cant_vueltasy"];$p++){


########## fin codigo B

########## codigo C

for($p=1;$p<=$_POST["cant_vueltasy"];$p++){

if(isset($_POST["c".$p])){
$cr = "on";
}else{
$cr="";
} //if($_POST["c".$p]=="on"){

$nm= "x".$p;

mysql_query("UPDATE info_reserva SET $nm = '$cr' where idd_sub2_ir='$_GET[clave_sub2]' and tipo_ir='c' ");

}//for($p=1;$p<=$_GET["cant_vueltasy"];$p++){


########## fin codigo C


########## codigo D

for($p=1;$p<=$_POST["cant_vueltasy"];$p++){

if(isset($_POST["d".$p])){
$cr = "on";
}else{
$cr="";
} //if($_POST["d".$p]=="on"){

$nm= "x".$p;

mysql_query("UPDATE info_reserva SET $nm = '$cr' where idd_sub2_ir='$_GET[clave_sub2]' and tipo_ir='d' ");

}//for($p=1;$p<=$_GET["cant_vueltasy"];$p++){


########## fin codigo D

echo "<script>document.getElementById('7').style.display='block'</script>;";

}//if(isset($_POST["escribano_info_reserva"])=="ok"){


include_once("info_reserva_base.inc.php");

$cant_vueltasy = count($codigo_ir);


echo "<div style='margin-left:199px;width:200px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;float:left;background-color:#0061cc;color:#ffffff'>Al comprador: </div>
      <div style='width:200px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;float:left;background-color:#0061cc;color:#ffffff'>A los participantes: </div>
      <div style='clear:both'></div>
	  <div style='margin-left:199px;width:99px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;float:left'>solicitar</div>
	  <div style='margin-left:0px;width:99px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;float:left'>requerir</div>
	    <div style='margin-left:0px;width:99px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;float:left'>solicitar</div>
	  <div style='margin-left:0px;width:99px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;float:left'>requerir</div>
	  <div style='clear:both;height:2px'></div>";

echo "<form action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' method='post'>";

echo "<div style='width:200px;float:left'>";

foreach ($codigo_ir as $valor_cod){
echo "<div style='width:196px;height:20px;border:1px solid #cccccc;line-height:20px;margin-bottom:2px;margin-left:2px'> &nbsp;".$valor_cod."</div>";
} //foreach ($codigo_ir as $valor_cod){

echo "</div>";


echo "<div style='width:100px;float:left'>"; //8

$sdf = mysql_query("select * from info_reserva where idd_sub2_ir = '$_GET[clave_sub2]' and tipo_ir = 'a' order by id_ir asc");
$c_sdf = mysql_num_rows($sdf);
$l_sdf = mysql_fetch_assoc($sdf);


for($o=1;$o<=$cant_vueltasy;$o++){




if($l_sdf["x".$o]=="on"){
$check = "checked";
}else{
$check = "";
} //if($l_sdf["x".$ri]=="on"){


echo "<div style='width:96px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;margin-bottom:2px;margin-left:2px'><input type='checkbox' name='a$o' $check > </div>";

}//for($o=1;$o<=$c_sdf;$o++){



echo "</div>"; //8


echo "<div style='width:100px;float:left'>"; //88

$sdf = mysql_query("select * from info_reserva where idd_sub2_ir = '$_GET[clave_sub2]' and tipo_ir = 'b' order by id_ir asc");
$c_sdf = mysql_num_rows($sdf);
$l_sdf = mysql_fetch_assoc($sdf);


for($o=1;$o<=$cant_vueltasy;$o++){




if($l_sdf["x".$o]=="on"){
$check = "checked";
}else{
$check = "";
} //if($l_sdf["x".$ri]=="on"){


echo "<div style='width:96px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;margin-bottom:2px;margin-left:2px'><input type='checkbox' name='b$o' $check > </div>";

}//for($o=1;$o<=$c_sdf;$o++){



echo "</div>"; //88

echo "<div style='width:100px;float:left'>"; //888

$sdf = mysql_query("select * from info_reserva where idd_sub2_ir = '$_GET[clave_sub2]' and tipo_ir = 'c' order by id_ir asc");
$c_sdf = mysql_num_rows($sdf);
$l_sdf = mysql_fetch_assoc($sdf);


for($o=1;$o<=$cant_vueltasy;$o++){




if($l_sdf["x".$o]=="on"){
$check = "checked";
}else{
$check = "";
} //if($l_sdf["x".$ri]=="on"){


echo "<div style='width:96px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;margin-bottom:2px;margin-left:2px'><input type='checkbox' name='c$o' $check > </div>";

}//for($o=1;$o<=$c_sdf;$o++){



echo "</div>"; //888


echo "<div style='width:100px;float:left'>"; //8888

$sdf = mysql_query("select * from info_reserva where idd_sub2_ir = '$_GET[clave_sub2]' and tipo_ir = 'd' order by id_ir asc");
$c_sdf = mysql_num_rows($sdf);
$l_sdf = mysql_fetch_assoc($sdf);


for($o=1;$o<=$cant_vueltasy;$o++){




if($l_sdf["x".$o]=="on"){
$check = "checked";
}else{
$check = "";
} //if($l_sdf["x".$ri]=="on"){


echo "<div style='width:96px;height:20px;border:1px solid #cccccc;line-height:20px;text-align:center;margin-bottom:2px;margin-left:2px'><input type='checkbox' name='d$o' $check > </div>";

}//for($o=1;$o<=$c_sdf;$o++){



echo "</div>"; //8888

echo "<div style='clear:both'></div>";


echo "<input type='hidden' name='escribano_info_reserva' value='ok' >
      <input type='hidden' name='cant_vueltasy' value='$cant_vueltasy' >
      <input type='submit' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value=''>
      </form>";

?>