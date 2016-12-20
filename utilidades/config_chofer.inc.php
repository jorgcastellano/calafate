<?php

if(isset($_POST["escribano_carga_da3"])){

if($_POST["nombre"]!=""){

$b_check = mysql_query("select * from datos_adicionales where idd_empresa_da='$_SESSION[logeo]' and nombre_da='$_POST[nombre]' and tipo_da ='chofer' ");
$c_check = mysql_num_rows($b_check);



if($c_check < 1){

mysql_query("INSERT INTO datos_adicionales (idd_empresa_da,nombre_da,tipo_da) VALUES ('$_SESSION[logeo]','$_POST[nombre]','chofer')");

$nop = "0";

}else{ //if($c_check < 1){

$nop = "1";

} //if($c_check < 1){


} //if($_POST["nombre"]!=""){


echo "<script>document.getElementById('8').style.display='block'</script>";

}//cierra if escribano carga



if(isset($_POST["escribano_modifica_da3"])){

if($_POST["nombre"]!=""){

mysql_query("UPDATE datos_adicionales SET nombre_da='$_POST[nombre]' where id_da='$_POST[id_da]' ");



} //if($_POST["nombre"]!=""){


echo "<script>document.getElementById('8').style.display='block'</script>";

}//cierra if escribano modifica



if(isset($_POST["escribano_borra_da3"])){



mysql_query("DELETE from datos_adicionales where id_da='$_POST[id_da]' ");





echo "<script>document.getElementById('8').style.display='block'</script>";

}//cierra if escribano modifica



#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO

if(isset($_POST["escribano_modifica_da3"]) || isset($_POST["escribano_carga_da3"]) || isset($_POST["escribano_borra_da3"])){

echo "<div style='text-align:center;height:50px;line-height:50px;background-color:#70ea6a;color:#097904;font-size:12px'><b> OK </b></div><br />";

} //if(isset($_POST["escribano_modifica_da3"]) || isset($_POST["escribano_carga_da3"]) || isset($_POST["escribano_borra_da3"])){


if(isset ($nop) && $nop == "1"){
echo "<h3>No pudo cargarse por que ya existe alguien otro registro con ese nombre</h3>";
}//if(isset $nop && $nop == "1"){


echo "<br><b>Choferes:</b><br><br>";

///// cargar nuevo

echo "<br><div style='width:180px;float:left;height:40px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px;line-height:40px'>
      
      <span style='font-size:14px;color:#555555'><b>Agregar chofer nuevo:</b><span>
      </div>
	  
	  
      <div style='width:150px;float:left;height:40px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px;line-height:40px'>
      <form method='post' action='$_SERVER[PHP_SELF]'>
      <input type='text' name='nombre' style='margin-top:10px'>
      </div>	  
	  
	  
	  
	  
	  <div style='width:150px;float:left;height:40px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px'>
      <input type='hidden' name='escribano_carga_da3' value='ok'>
	  <input type='submit' value='' style='cursor:pointer;width:120px;height:40px;background-image:url(imagenes/bot_cargar.png);border:0px' >
      </form>
	  </div><div style='clear:both'></div><br><br><br>
	  ";



///// fin cargar nuevo




$sql_ar = mysql_query("select * from datos_adicionales where idd_empresa_da = '$_SESSION[logeo]' and tipo_da='chofer' order by nombre_da asc");  
	  
$cta_ar = mysql_num_rows($sql_ar);	 

if($cta_ar > 0){


echo "<div style='width:180px;float:left;height:20px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px;line-height:20px'>
      
      <span style='font-size:14px;color:#0061cc'><b>Nombre</b><span><br>
      </div>
	  
	  
	    
	  
      <div style='clear:both'></div>
	  ";



 
	  
for($d=1;$d<=$cta_ar;$d++){
$l_ar = mysql_fetch_assoc($sql_ar);

echo "<div style='width:180px;float:left;height:30px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px;line-height:30px'>
      <form method='post' action='$_SERVER[PHP_SELF]'>
      <span style='font-size:14px;color:#555555'><b><input type='text' name='nombre' value='$l_ar[nombre_da]' style='margin-top:5px'></b><span><br>
      </div>
	  
	  
	    
	  
	  <div style='width:120px;float:left;height:30px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px;line-height:30px'>
      <input type='hidden' name='escribano_modifica_da3' value='ok'>
	  <input type='hidden' name='id_da' value='$l_ar[id_da]'>	
	  <input type='submit' style='cursor:pointer;width:113px;height:25px;background-image:url(imagenes/bot_modificar1.png);border:0px;margin-top:5px' value='' >
      </form>
	  </div>
	    
	   <div style='width:30px;float:left;height:30px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px;line-height:30px'>
      <form method='post' action='$_SERVER[PHP_SELF]'>
	  <input type='hidden' name='escribano_borra_da3' value='ok'>
	  <input type='hidden' name='id_da' value='$l_ar[id_da]'>	
	  <input type='submit' style='cursor:pointer;width:26px;height:25px;background-image:url(imagenes/borrar.png);border:0px;margin-top:5px' value='' title='Borrar'>
      </form>
	  </div>  
	  
	  
	  
	  <div style='clear:both'></div>
	  ";

} //for($d=1;$d<=$cta_ar;$d++){	  


} //if($cta_ar > 0){


#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO


?>