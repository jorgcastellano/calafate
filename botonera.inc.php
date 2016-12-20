<div style="width:230px;background-color:#eef496">												  



<?php
$sql = mysql_query("select * from subcategoria_1 where clave_categoria_s1 = '1' order by clave asc");
$cta = mysql_num_rows($sql);

echo "<a href='index1.php' style='color:#5b5a45'><div class='boton' >Home</div></a>";

for($d=1;$d<=$cta;$d++){
$lee = mysql_fetch_assoc($sql);

echo "<a href='categoria.php?id=$lee[clave]' style='color:#5b5a45'><div class='boton'>".ucfirst($lee["nombre_sub1"])."</div></a>";

} //for($d=1;$d<=$cta;$d++){



echo "<a href='contacto.php' style='color:#5b5a45'><div class='boton' >Contacto</div></a>";

?>

</div>