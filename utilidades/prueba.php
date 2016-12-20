<?php
/*
select * from ventas where idd_empresa_vs='1' and (idd_carga_vs >'1399345200' and idd_carga_vs <'1399431600') order by id_ventas desc limit 0,10




1399345200

1398798303 venta 1
1399397181 venta 2
1399431600
*/

$venta1 = date("d/m/Y",1398798303);
$venta2 = date("d/m/Y",1399397181);

echo $venta1."<br>";
echo $venta2."<br>";

?>