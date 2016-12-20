<?php

if(isset($_POST["escribano_borrar"])=="ok"){


mysql_query("DELETE FROM subcategoria_2 where clave='$_GET[clave_sub2]'");
mysql_query("DELETE FROM articulo where clave_sub2_ar='$_GET[clave_sub2]'");
mysql_query("DELETE FROM fotos where clave_sub2_f='$_GET[clave_sub2]'");
mysql_query("DELETE FROM adicionales where idd_sub2='$_GET[clave_sub2]'");
mysql_query("DELETE FROM descuento_edad where idd_sub2='$_GET[clave_sub2]'");



echo "<script>alert('ok')</script>";
echo "<script>location.href='index.php'</script>";

}//cierra if escribano


#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO
#################################################################### IMPRIME INFO


echo "<form method='post' action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' >";

echo "<br><br>�Esta seguro que desea borrar este articulo del sistema?<br><br>";




echo "<input type='hidden' name='clave_sub2' value='$_GET[clave_sub2]'>";
echo "<input type='hidden' name='escribano_borrar' value='ok'>";
echo "<input type='submit'  style='height:40px;width:120px;background-color:#ff0000;border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer;color:#fff' value='Borrar' >";


echo "</form>";


?>