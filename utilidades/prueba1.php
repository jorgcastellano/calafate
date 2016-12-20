<?php

if(isset($_POST["escribano_carga_da"])){
echo "<script>alert('ytyt')</script>";
if($_POST["nombre"]!=""){

mysql_query("INSERT INTO datos_adicionales (idd_empresa_da,nombre_da,tipo_da) VALUES ('d','$_POST[nombre]','guias')");
}


echo "<script>document.getElementById('5').style.display='block'</script>";

}//cierra if escribano carga



#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO

echo "<br><b>Guias de turismo:</b><br><br>";

///// cargar nuevo

echo "<br><div style='width:180px;float:left;height:40px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px;line-height:40px'>
      
      <span style='font-size:14px;color:#555555'><b>Agregar guia nuevo:</b><span>
      </div>
	  
	  
      <div style='width:150px;float:left;height:40px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px;line-height:40px'>
      <form method='post' action='$_SERVER[PHP_SELF]'>
      <input type='text' name='nombre' style='margin-top:10px'>
      </div>	  
	  
	  
	  
	  
	  <div style='width:150px;float:left;height:40px;border:1px solid #888888;padding:5px;margin-left:2px;margin-bottom:2px'>
      <input type='hidden' name='escribano_carga_da' value='ok'>
	  <input type='submit' style='cursor:pointer;width:120px;height:40px;background-image:url(imagenes/bot_cargar.png);border:0px' >
      </form>
	  </div><div style='clear:both'></div><br><br><br>
	  ";


?>