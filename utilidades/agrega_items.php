<?php
include_once("conexion.inc.php");

###### este archivo es para agregar items de venta por afuera de la plataforma como por ej PICK UP

$sql = mysql_query("select * from subcategoria_2 where idd_empresa_sub2='1'");
$cta = mysql_num_rows($sql);


for($e=1;$e<=$cta;$e++){

$lee = mysql_fetch_assoc($sql);

mysql_query("INSERT INTO items_venta_articulo (idd_sub2_iva, idd_ibc_iva,publica_iva,orden_iva) VALUES
('$lee[clave]','24','no','0')");


echo $lee["clave"]."<br>";

}//for($e=1;$e<=$cta;$e++){


?>