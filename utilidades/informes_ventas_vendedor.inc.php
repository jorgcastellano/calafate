<?php

if(isset($_GET["fecha_caja"])){
echo "<script>document.getElementById('2').style.display='block'</script>";
}//if(isset($_GET["fecha_caja"])){

echo "<div style='width:800px' id='imprimime'>"; // %%%%%%%%%%%%%%%%%%%%%%%%%55555


if($_SESSION["tipo"]=="vendedor"){

$vendedor_sql0 = "and idd_vendedor_ar = '$_SESSION[id_usuario]'";

$vendedor_sql = "and vendedor_vs = '$_SESSION[id_usuario]'";

$vendedor_sql1 = "vendedor_vp = '$_SESSION[id_usuario]' and";

$vendedor_sql2 = "vendedor_cb = '$_SESSION[id_usuario]' and";

$vendedor_sql3 = "vendedor_cb_v = '$_SESSION[id_usuario]' and";

$vendedor_sql4 = "vendedor_vto = '$_SESSION[id_usuario]' and";

$vendedor_sql5 = "and idd_vendedor_d = '$_SESSION[id_usuario]'";

$vendedor_sql6 = "and idd_vendedor_h = '$_SESSION[id_usuario]'";


}else{//if($_SESSION["tipo"]=="vendedor"){

if(isset($_GET["clavee_vendedor"]) && $_GET["clavee_vendedor"] != ""){

$vendedor_sql0 = "and idd_vendedor_ar = '$_GET[clavee_vendedor]'";
$vendedor_sql = "and vendedor_vs = '$_GET[clavee_vendedor]'";
$vendedor_sql1 = "vendedor_vp = '$_GET[clavee_vendedor]' and";

$vendedor_sql2 = "vendedor_cb = '$_GET[clavee_vendedor]' and";

$vendedor_sql3 = "vendedor_cb_v = '$_GET[clavee_vendedor]' and";

$vendedor_sql4 = "vendedor_vto = '$_GET[clavee_vendedor]' and";

$vendedor_sql5 = "and idd_vendedor_d = '$_GET[clavee_vendedor]'";

$vendedor_sql6 = "and idd_vendedor_h = '$_GET[clavee_vendedor]'";

$vendedor_sql7 = "and idd_vendedor_eb = '$_GET[clavee_vendedor]'";

$vendedor_sql8 = "and idd_vendedor_sb = '$_GET[clavee_vendedor]'";

}else{//if(isset($_GET["clave_vendedor"])){

$vendedor_sql0 = "";
$vendedor_sql = "";
$vendedor_sql1 = "";
$vendedor_sql2 = "";
$vendedor_sql3 = "";
$vendedor_sql4 = "";
$vendedor_sql5 = "";
$vendedor_sql6 = "";
$vendedor_sql7 = "";
$vendedor_sql8 = "";

}//if(isset($_GET["clave_vendedor"])){

}//if($_SESSION["tipo"]=="vendedor"){


// busca las ventas q no esten canceladas
// busca las ventas q no esten canceladas

$sql_aptas = mysql_query("select idd_carga_vs from ventas where idd_empresa_vs='$_SESSION[logeo]' $vendedor_sql and estado_vs <> 'cancelado' and (idd_carga_vs >'$id_fecha' and idd_carga_vs <'$id_fecha1') ");


$cta_aptas = mysql_num_rows($sql_aptas);

$aptas_sql = "";
$aptas_sql1 = "";
$aptas_sql2 = "";
$aptas_sql3 = "";

for($u=1;$u<=$cta_aptas;$u++){
$lee_aptas = mysql_fetch_assoc($sql_aptas);

if($u != $cta_aptas){

$aptas_sql = $aptas_sql."idd_venta_vp ='$lee_aptas[idd_carga_vs]' or ";
$aptas_sql1 = $aptas_sql1."idd_carga_vto ='$lee_aptas[idd_carga_vs]' or ";
$aptas_sql2 = $aptas_sql2."idd_carga_cb ='$lee_aptas[idd_carga_vs]' or ";
$aptas_sql3 = $aptas_sql3."idd_carga_cb_v ='$lee_aptas[idd_carga_vs]' or ";

}else{//if($u != $cta_aptas){

$aptas_sql = $aptas_sql."idd_venta_vp ='$lee_aptas[idd_carga_vs]' ";
$aptas_sql1 = $aptas_sql1."idd_carga_vto ='$lee_aptas[idd_carga_vs]' ";
$aptas_sql2 = $aptas_sql2."idd_carga_cb ='$lee_aptas[idd_carga_vs]' ";
$aptas_sql3 = $aptas_sql3."idd_carga_cb_v ='$lee_aptas[idd_carga_vs]' ";
}//if($u != $cta_aptas){


}//for($u=1;$u<=$cta_aptas;$u++){

if ($cta_aptas > 0){

$aptas_sql = "and( $aptas_sql )";
$aptas_sql1 = "( $aptas_sql1 )";
$aptas_sql2 = "and( $aptas_sql2 )";
$aptas_sql3 = "and( $aptas_sql3 )";

}else{ //if ($cta_aptas > 0){

"and (idd_carga_vs >'$id_fecha' and idd_carga_vs <'$id_fecha1')";

$aptas_sql = "and (idd_venta_vp >'$id_fecha' and idd_venta_vp <'$id_fecha1')";
$aptas_sql1 = "(idd_carga_vto >'$id_fecha' and idd_carga_vto <'$id_fecha1')";
$aptas_sql2 = "and (idd_carga_cb >'$id_fecha' and idd_carga_cb <'$id_fecha1')";
$aptas_sql3 = "and (idd_carga_cb_v >'$id_fecha' and idd_carga_cb_v <'$id_fecha1')";


} //if ($cta_aptas > 0){


// busca las ventas q no esten canceladas
// busca las ventas q no esten canceladas



echo "<form method='get' action='$_SERVER[PHP_SELF]'>
Fecha: <input style='width:100px' id='desde' name='id_fecha' value=''  /><button id='f_btn1'>...</button> &nbsp; &nbsp; &nbsp;"; 

if($_SESSION["tipo"]!="vendedor"){

$sqll_ar = mysql_query("select * from usuario where idd_empresa_usuario = '$_SESSION[logeo]' and tipo_usuario <> 'superadmin' order by nombre_usuario asc");  
	  
$cta_arl = mysql_num_rows($sqll_ar);	

echo "&nbsp; Vendedor: <select name='clavee_vendedor'>
<option value='' selected></option>";

for($f=1;$f<=$cta_arl;$f++){

$lee_sqll_ar = mysql_fetch_assoc($sqll_ar);

if(isset($_GET["clavee_vendedor"]) && ($lee_sqll_ar["id_usuario"] == $_GET["clavee_vendedor"])){
echo "<option value='$lee_sqll_ar[id_usuario]' selected>$lee_sqll_ar[nombre_usuario]</option>";
}else{ //if(isset($_GET["clavee_vendedor"]) && ($lee_sqll_ar["id_usuario"] == $_GET["clavee_vendedor"])){
echo "<option value='$lee_sqll_ar[id_usuario]'>$lee_sqll_ar[nombre_usuario]</option>";
}//if(isset($_GET["clavee_vendedor"]) && ($lee_sqll_ar["id_usuario"] == $_GET["clavee_vendedor"])){

}//for($f=1;$f<=$cta_arl;$f++){

echo "</select>";


}//if($_SESSION["tipo"]!="vendedor"){


echo "<input type='hidden' name='fecha_caja' value='ok'>
<input type='submit' value='Ver' style='cursor:pointer'>

</form><br>";


echo "<div style='font-size:18px;font-weight:bold'>Dia: ".date("d/m/y", $id_fecha)."</div><br>";
//echo "<div style='font-size:18px;font-weight:bold'>fghfgh Dia: ".date("d/m/y", 1421351825)."</div><br>";

$sql_ar = mysql_query("select subcategoria_2.*,subcategoria_1.nombre_sub1,categoria.nombre_categoria from subcategoria_2 left outer join subcategoria_1 on subcategoria_2.clave_sub1_s2 = subcategoria_1.clave
left outer join categoria on subcategoria_2.clave_categoria_s2 = categoria.clave where subcategoria_2.idd_empresa_sub2 = '$_SESSION[logeo]' order by subcategoria_2.nombre_sub2 asc");  
	  
$cta_ar = mysql_num_rows($sql_ar);	  
	  
for($d=1;$d<=$cta_ar;$d++){ //UUUUUUUUUUUUuuuuuuUUUUUUU
$l_ar = mysql_fetch_assoc($sql_ar);

$sql_c = mysql_query("select * from articulo where clave_sub2_ar='$l_ar[clave]' and estado <> 'libre' $vendedor_sql0 and (fecha_venta_ar >'$id_fecha' and fecha_venta_ar <'$id_fecha1') ");


$cta_c = mysql_num_rows($sql_c);


if($cta_c > 0){

echo "<div style='width:300px;float:left;margin-left:10px;margin-bottom:10px;margin-bottom:10px'>";//ewqewqewq

echo "<div style='text-align:center;height:20px;line-height:20px;background-color:#0061cc;color:#ffffff'>$l_ar[nombre_sub2]</div>

<div style='width:295px;float:left;border:1px solid #999999;padding-left:3px;height:15px;line-height:15px;margin-bottom:2px'>$cta_c </div>";

echo "</div>";//ewqewqewq


echo "<div style='clear:both'></div>";



}//if($cta_c > 0){

}//for($d=1;$d<=$cta_ar;$d++){ //UUUUUUUUUUUUuuuuuuUUUUUUU


//calcula ventas y devoluciones de hoy
//calcula ventas y devoluciones de hoy

//ventas

$sql_br = mysql_query("select * from entra_bruto where (fecha_eb >'$id_fecha' and fecha_eb <'$id_fecha1') $vendedor_sql7");



$cta_br = mysql_num_rows($sql_br);

$suma_eb = 0;

echo "<div style='width:310px;float:left;border:1px solid #999999;padding-left:5px;line-height:15px;margin-bottom:0px'>Ventas:<br>";

echo "<div style='width:150px;float:left'>";

for($h=1;$h<=$cta_br;$h++){

$l_br = mysql_fetch_assoc($sql_br);

echo "$".$l_br["total_eb"]."<br>";
$suma_eb = $suma_eb + $l_br["total_eb"];

}//for($h=1;$h<=$cta_dh;h++){



echo "</div><div style='width:150px;float:left;color:#7cb4ed;font-size:20px;line-height:22px;text-align:center'>";

echo "<br><b>Total ventas: <br> $".$suma_eb."</b><br>";

echo "</div><div style='clear:both'></div>";


echo "</div>";


//ventas

//egresos

$sql_br = mysql_query("select * from sale_bruto where (fecha_sb >'$id_fecha' and fecha_sb <'$id_fecha1') $vendedor_sql8");

$cta_br = mysql_num_rows($sql_br);

$suma_sb = 0;

echo "<div style='width:310px;float:left;border:1px solid #999999;padding-left:5px;line-height:15px;margin-bottom:0px;margin-left:10px'>Devoluciones:<br>";

echo "<div style='width:150px;float:left'>";

for($h=1;$h<=$cta_br;$h++){

$l_br = mysql_fetch_assoc($sql_br);

echo "$".$l_br["total_sb"]."<br>";
$suma_sb = $suma_sb + $l_br["total_sb"];

}//for($h=1;$h<=$cta_dh;h++){



echo "</div><div style='width:150px;float:left;color:#f3525d;font-size:20px;line-height:22px;text-align:center'>";

echo "<br><b>Total ventas: <br> $".$suma_sb."</b><br>";

echo "</div><div style='clear:both'></div>";


echo "</div>";


//egresos

echo "<div style='clear:both'></div>";

$dige_br = $suma_eb - $suma_sb;


echo "<div style='width:634px;float:left;border:1px solid #999999;padding-left:5px;height:30px;line-height:30px;margin-bottom:0px;margin-top:20px;margin-bottom:20px;font-size:20px'><b> Total Vendido: $ $dige_br </b> <br>

</div>";

//calcula ventas y devoluciones de hoy
//calcula ventas y devoluciones de hoy


//calcula debe y haber
//calcula debe y haber

//haber

$sql_dh = mysql_query("select * from haber where (fecha_h >'$id_fecha' and fecha_h <'$id_fecha1') $vendedor_sql6");

$cta_dh = mysql_num_rows($sql_dh);

$suma_haber = 0;

echo "<div style='width:310px;float:left;border:1px solid #999999;padding-left:5px;line-height:15px;margin-bottom:0px'>Ingresos:<br>";

echo "<div style='width:150px;float:left'>";

for($h=1;$h<=$cta_dh;$h++){

$l_dh = mysql_fetch_assoc($sql_dh);

echo "$".$l_dh["monto_h"]."<br>";
$suma_haber = $suma_haber + $l_dh["monto_h"];

}//for($h=1;$h<=$cta_dh;h++){



echo "</div><div style='width:150px;float:left;color:#7cb4ed;font-size:20px;line-height:22px;text-align:center'>";

echo "<br><b>Total ingresos: <br> $".$suma_haber."</b><br>";

echo "</div><div style='clear:both'></div>";


echo "</div>";


//haber



//debe

$sql_dh = mysql_query("select * from debe where (fecha_d >'$id_fecha' and fecha_d <'$id_fecha1') $vendedor_sql5");

$cta_dh = mysql_num_rows($sql_dh);

$suma_debe = 0;

echo "<div style='width:310px;float:left;border:1px solid #999999;padding-left:5px;line-height:15px;margin-bottom:0px;margin-left:10px'>Egresos:<br>";

echo "<div style='width:150px;float:left'>";

for($h=1;$h<=$cta_dh;$h++){

$l_dh = mysql_fetch_assoc($sql_dh);

echo "$".$l_dh["monto_d"]."<br>";
$suma_debe = $suma_debe + $l_dh["monto_d"];

}//for($h=1;$h<=$cta_dh;h++){



echo "</div><div style='width:150px;float:left;color:#f3525d;font-size:20px;line-height:22px;text-align:center'>";

echo "<br><b>Total egresos: <br> $".$suma_debe."</b><br>";

echo "</div><div style='clear:both'></div>";


echo "</div>";


//debe



$dige_dh = $suma_haber - $suma_debe;


echo "<div style='clear:both'></div>";

echo "<div style='width:634px;float:left;border:1px solid #999999;padding-left:5px;height:30px;line-height:30px;margin-bottom:0px;margin-top:20px;margin-bottom:20px;font-size:20px'><b> Total Caja: $ $dige_dh </b> <br>

</div>";



//fin calcula debe y haber
//fin calcula debe y haber



////////////*********************** ESPECIFICA EL MANEJO DE LA PLATA
////////////*********************** ESPECIFICA EL MANEJO DE LA PLATA

//tipo de pago
//tipo de pago

//pesos
/*
$sql_tp = mysql_query("select SUM(importe_vp) as importe_vp from ventas_pago where $vendedor_sql1 moneda_vp='peso argentino' $aptas_sql ");
*/
$sql_tp = mysql_query("select SUM(importe_vp) as importe_vp from ventas_pago where $vendedor_sql1 moneda_vp='peso argentino' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1') ");




$lee_tp = mysql_fetch_assoc($sql_tp);

$pesos = $lee_tp["importe_vp"];



//pesos


//credito

$sql_tp = mysql_query("select SUM(importe_vp) as importe_vp from ventas_pago where $vendedor_sql1 medio_pago_vp='credito' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1')");

$lee_tp = mysql_fetch_assoc($sql_tp);

$creditos = $lee_tp["importe_vp"];




//credito

//credito

$sql_tp = mysql_query("select SUM(importe_vp) as importe_vp from ventas_pago where $vendedor_sql1 medio_pago_vp='debito' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1')");

$lee_tp = mysql_fetch_assoc($sql_tp);

$debitos = $lee_tp["importe_vp"];



//credito




//pesos chilenos

$sql_tp = mysql_query("select SUM(importe_vp) as importe_vp from ventas_pago where $vendedor_sql1 moneda_vp='peso chileno' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1')");
$lee_tp = mysql_fetch_assoc($sql_tp);

$sql_cot = mysql_query("select cotizacion_moneda_vp from ventas_pago where $vendedor_sql1 moneda_vp='peso chileno' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1') limit 0,1 ");



$lee_cot = mysql_fetch_assoc($sql_cot);

$cot_chileno = $lee_cot["cotizacion_moneda_vp"];
$chilenos = $lee_tp["importe_vp"] + 0;



//pesos chilenos



//reales

$sql_tp = mysql_query("select SUM(importe_vp) as importe_vp from ventas_pago where $vendedor_sql1 moneda_vp='real' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1')");
$lee_tp = mysql_fetch_assoc($sql_tp);

$sql_cot = mysql_query("select cotizacion_moneda_vp from ventas_pago where $vendedor_sql1 moneda_vp='real' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1') limit 0,1 ");
$lee_cot = mysql_fetch_assoc($sql_cot);

$cot_real = $lee_cot["cotizacion_moneda_vp"];
$reales = $lee_tp["importe_vp"] + 0;



//reales


//euros

$sql_tp = mysql_query("select SUM(importe_vp) as importe_vp from ventas_pago where $vendedor_sql1 moneda_vp='euro' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1')");
$lee_tp = mysql_fetch_assoc($sql_tp);

$sql_cot = mysql_query("select cotizacion_moneda_vp from ventas_pago where $vendedor_sql1 moneda_vp='euro' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1') limit 0,1 ");
$lee_cot = mysql_fetch_assoc($sql_cot);

$cot_euro = $lee_cot["cotizacion_moneda_vp"];
$euros = $lee_tp["importe_vp"] + 0;



//euros



//dolares

$sql_tp = mysql_query("select SUM(importe_vp) as importe_vp from ventas_pago where $vendedor_sql1 moneda_vp='dolar' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1')");
$lee_tp = mysql_fetch_assoc($sql_tp);

$sql_cot = mysql_query("select cotizacion_moneda_vp from ventas_pago where $vendedor_sql1 moneda_vp='dolar' and (fecha_vp >'$id_fecha' and fecha_vp <'$id_fecha1') limit 0,1 ");
$lee_cot = mysql_fetch_assoc($sql_cot);

$cot_dolar = $lee_cot["cotizacion_moneda_vp"];
$dolares = $lee_tp["importe_vp"] + 0;



//dolares








echo "

<div style='width:800px;padding:10px;background-color:#ffffff;margin-left:10px'> <!-- ffff0000 -->

<input type='text' style='width:200px' class='pagos' readonly value='Medio de pago'>
<input type='text' style='width:80px' class='pagos' readonly value='Cotizacion'>
<input type='text' style='width:80px' class='pagos' readonly value='Cantidad'>
<input type='text' style='width:80px' class='pagos' readonly value='Total Ar $'> <br>
";

echo "

<input type='text' style='width:200px' class='pagos' readonly value='Peso Arg'>
<input type='text' style='width:80px' class='pagos' readonly value='1' name='cot_peso'>
<input type='text' style='width:80px' class='pagos' value='$pesos' name='peso' >
<input type='text' style='width:80px' class='pagos' readonly value='$pesos' name='tot_peso'> <br>

";


$dcifra1 = 0;

if($chilenos > 0){

$dcifra = $chilenos / $cot_chileno ;

$dcifra1 = $dcifra1 + $dcifra;

echo "

<input type='text' style='width:200px' class='pagos' readonly value='Peso Chileno'>
<input type='text' style='width:80px' class='pagos' readonly value='$cot_chileno' name='cot_chileno'>
<input type='text' style='width:80px' class='pagos' value='$chilenos' name='chileno'  >
<input type='text' style='width:80px' class='pagos' readonly value='$dcifra' name='tot_chileno'> <br>

";


}//if($chilenos > 0){

if($reales > 0){

$dcifra = $reales * $cot_real ;
$dcifra1 = $dcifra1 + $dcifra;
echo "
<input type='text' style='width:200px' class='pagos' readonly value='Reales'>
<input type='text' style='width:80px' class='pagos' readonly value='$cot_real' name='cot_real'>
<input type='text' style='width:80px' class='pagos'  value='$reales' name='real'>
<input type='text' style='width:80px' class='pagos' readonly value='$dcifra' name='tot_real'> <br>
";

}

if($dolares > 0){

$dcifra = $dolares * $cot_dolar ;
$dcifra1 = $dcifra1 + $dcifra;
echo "<input type='text' style='width:200px' class='pagos' readonly value='Dolar'>
<input type='text' style='width:80px' class='pagos' readonly value='$cot_dolar' name='cot_dolar'>
<input type='text' style='width:80px' class='pagos'  value='$dolares' name='dolar' >
<input type='text' style='width:80px' class='pagos' readonly value='$dcifra' name='tot_dolar'> <br>
";


}



if($euros > 0){

$dcifra = $euros * $cot_euro ;
$dcifra1 = $dcifra1 + $dcifra;
echo "<input type='text' style='width:200px' class='pagos' readonly value='Euro'>
<input type='text' style='width:80px' class='pagos' readonly value='$cot_euro' name='cot_euro'>
<input type='text' style='width:80px' class='pagos'  value='$euros' name='euro' onChange='calcula_euro(document.medio.euro.value)'>
<input type='text' style='width:80px' class='pagos' readonly value='$dcifra' name='tot_euro'> <br>
";

}


if($creditos > 0){

echo "<input type='text' style='width:200px' class='pagos' readonly value='Tarjeta CREDITO 1'>
<input type='text' style='width:80px' class='pagos' readonly value='' >
<input type='text' style='width:80px' class='pagos'  value='$creditos' name='credito1' >
<input type='text' style='width:80px' class='pagos' readonly value='$creditos' name='tot_credito1' > 
<!--<input type='text' style='width:100px' class='pagos'  value='nro operacion' onfocus='this.select()' name='operacion_cred1'>
<input type='text' style='width:100px' class='pagos'  value='nro cupon' onfocus='this.select()' name='cupon_cred1'>--> <br>
";

}//if($credito > 0){


if($debitos > 0){

echo "<input type='text' style='width:200px' class='pagos' readonly value='Tarjeta DEBITO 1'>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos'  value='$debitos' name='debito1' >
<input type='text' style='width:80px' class='pagos' readonly value='$debitos' name='tot_debito1'> 
<!-- <input type='text' style='width:100px' class='pagos'  value='nro operacion' onfocus='this.select()' name='operacion_deb1'>
<input type='text' style='width:100px' class='pagos' value='nro cupon' onfocus='this.select()' name='cupon_deb1'> --> <br>
";

} //if($debito > 0){


$suma_todo_ingreso = $pesos + $dcifra1 + $debitos + $creditos;

echo "<input type='text' style='width:200px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px;font-weight:bold' class='pagos' readonly value='$suma_todo_ingreso' name='total_pesos'> <br>
";



//vuelto


$sql_vto = mysql_query("select SUM(cantidad_vto) as vuelto from vuelto where $vendedor_sql4 $aptas_sql1 ");

$lee_vto = mysql_fetch_assoc($sql_vto);

$vuelto = $lee_vto["vuelto"];

echo "<input type='text' style='width:200px' class='pagos' readonly value='Vuelto en Ar $'>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px;color:#ff0000' class='pagos' readonly value='$vuelto'> <br><br>";

//vuelto

//TOTAL

$total_final = $suma_todo_ingreso - $vuelto;

echo "<input type='text' style='width:200px' class='pagos' readonly value='TOTAL en Ar $'>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px' class='pagos' readonly value=''>
<input type='text' style='width:80px;font-size:13px;font-weight:bold' class='pagos' readonly value='$total_final'> <br>";

//TOTAL

echo "</div>";








//tipo de pago
//tipo de pago



 //pone cantidad de billetes	 
 //pone cantidad de billetes	


$d = array(); 
$d[1] = "0.10";
$d[2] = "0.25";
$d[3] = "0.50";
$d[4] = "1.00";
$d[5] = "10.00";
$d[6] = "20.00";
$d[7] = "50.00";
$d[8] = "100.00";

$e = array();
$e[1] = "2";
$e[2] = "5";
$e[3] = "10";
$e[4] = "20";
$e[5] = "50";
$e[6] = "100";
$e[7] = "200";
$e[8] = "500";

$r = array();
$r[1] = "0.5";
$r[2] = "1";
$r[3] = "2";
$r[4] = "5";
$r[5] = "10";
$r[6] = "20";
$r[7] = "50";
$r[8] = "100";

$c = array();
$c[1] = "10";
$c[2] = "50";
$c[3] = "100";
$c[4] = "1000";
$c[5] = "2000";
$c[6] = "5000";
$c[7] = "10000";
$c[8] = "20000";



$dd = array();
$dd[1]= 0;
$dd[2]= 0;
$dd[3]= 0;
$dd[4]= 0;
$dd[5]= 0;
$dd[6]= 0;
$dd[7]= 0;
$dd[8]= 0;

$ee = array();
$ee[1]= 0;
$ee[2]= 0;
$ee[3]= 0;
$ee[4]= 0;
$ee[5]= 0;
$ee[6]= 0;
$ee[7]= 0;
$ee[8]= 0;

$rr = array();
$rr[1]= 0;
$rr[2]= 0;
$rr[3]= 0;
$rr[4]= 0;
$rr[5]= 0;
$rr[6]= 0;
$rr[7]= 0;
$rr[8]= 0;

$cc = array();
$cc[1]= 0;
$cc[2]= 0;
$cc[3]= 0;
$cc[4]= 0;
$cc[5]= 0;
$cc[6]= 0;
$cc[7]= 0;
$cc[8]= 0;


//busca los entrantes

for($q=1;$q<9;$q++){

$bil = $d[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb) as cantidad_cb from cantidad_billetes where $vendedor_sql2 moneda_cb='dolar' and billete_cb ='$bil' $aptas_sql2 ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb"] > 0){
$dd[$q] = $lee_bil["cantidad_cb"];
} //if($lee_bil["cantidad_cb"] > 0){

} //for($q=1;$q<9;$q++){
 
// busca los entrantes

//busca los salientes

for($q=1;$q<9;$q++){

$bil = $d[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb_v) as cantidad_cb_v from cantidad_billetes_vuelto where $vendedor_sql3 moneda_cb_v='dolar' and billete_cb_v ='$bil' $aptas_sql3 ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb_v"] > 0){

$dd[$q] =  $dd[$q] - $lee_bil["cantidad_cb_v"];

} //if($lee_bil["cantidad_cb_v"] > 0){

} //for($q=1;$q<9;$q++){


//busca los salientes
 
echo "<br> Cantidad y tipo de billetes de moneda extranjera:<br><br>
<div style='width:170px;padding:10px;height:220px;float:left;background-color:#ffffff;margin-left:10px'> <!-- 0000 -->
     
	 Dolar:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 0.10 <br>
	 0.25 <br>
	 0.50 <br>
	 1.00 <br>
	 10.00 <br>
	 20.00 <br>
	 50.00 <br>
	 100 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='dd1' value='$dd[1]' ><br>
	 <input type='text' style='width:100px;height:11px' name='dd2' value='$dd[2]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd3' value='$dd[3]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd4' value='$dd[4]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd5' value='$dd[5]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd6' value='$dd[6]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd7' value='$dd[7]'><br>
	 <input type='text' style='width:100px;height:11px' name='dd8' value='$dd[8]'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->";
	 
	 
	
//busca los entrantes euro

for($q=1;$q<9;$q++){

$bil = $e[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb) as cantidad_cb from cantidad_billetes where $vendedor_sql2 moneda_cb='euro' and billete_cb ='$bil' $aptas_sql2 ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb"] > 0){
$ee[$q] = $lee_bil["cantidad_cb"];
} //if($lee_bil["cantidad_cb"] > 0){

} //for($q=1;$q<9;$q++){
 
// busca los entrantes

//busca los salientes

for($q=1;$q<9;$q++){

$bil = $e[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb_v) as cantidad_cb_v from cantidad_billetes_vuelto where $vendedor_sql3 moneda_cb_v='euro' and billete_cb_v ='$bil' $aptas_sql3 ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb_v"] > 0){

$ee[$q] =  $ee[$q] - $lee_bil["cantidad_cb_v"];

} //if($lee_bil["cantidad_cb_v"] > 0){

} //for($q=1;$q<9;$q++){


//busca los salientes




	
	 
	 
	 
echo "<div style='width:170px;padding:10px;height:220px;float:left;background-color:#ffffff;margin-left:10px'> <!-- 0000 -->
     
	 Euros:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 2 <br>
	 5 <br>
	 10 <br>
	 20 <br>
	 50 <br>
	 100 <br>
	 200 <br>
	 500 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='ee1' value='$ee[1]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee2' value='$ee[2]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee3' value='$ee[3]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee4' value='$ee[4]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee5' value='$ee[5]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee6' value='$ee[6]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee7' value='$ee[7]'><br>
	 <input type='text' style='width:100px;height:11px' name='ee8' value='$ee[8]'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->";
	

//busca los entrantes real

for($q=1;$q<9;$q++){

$bil = $r[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb) as cantidad_cb from cantidad_billetes where $vendedor_sql2 moneda_cb='real' and billete_cb ='$bil' $aptas_sql2 ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb"] > 0){
$rr[$q] = $lee_bil["cantidad_cb"];
} //if($lee_bil["cantidad_cb"] > 0){

} //for($q=1;$q<9;$q++){
 
// busca los entrantes

//busca los salientes

for($q=1;$q<9;$q++){

$bil = $r[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb_v) as cantidad_cb_v from cantidad_billetes_vuelto where $vendedor_sql3 moneda_cb_v='real' and billete_cb_v ='$bil' $aptas_sql3 ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb_v"] > 0){

$rr[$q] =  $rr[$q] - $lee_bil["cantidad_cb_v"];

} //if($lee_bil["cantidad_cb_v"] > 0){

} //for($q=1;$q<9;$q++){


//busca los salientes
	
	 
echo  "<div style='width:170px;padding:10px;height:220px;float:left;background-color:#ffffff;margin-left:10px'> <!-- 0000 -->
     
	 Reales:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 0.50 <br>
	 1 <br>
	 2 <br>
	 5 <br>
	 10 <br>
	 20 <br>
	 50 <br>
	 100 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='rr1' value='$rr[1]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr2' value='$rr[2]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr3' value='$rr[3]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr4' value='$rr[4]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr5' value='$rr[5]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr6' value='$rr[6]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr7' value='$rr[7]'><br>
	 <input type='text' style='width:100px;height:11px' name='rr8' value='$rr[8]'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 -->";



//busca los entrantes chilenos

for($q=1;$q<9;$q++){

$bil = $c[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb) as cantidad_cb from cantidad_billetes where $vendedor_sql2 moneda_cb='peso chileno' and billete_cb ='$bil' $aptas_sql2 ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb"] > 0){
$cc[$q] = $lee_bil["cantidad_cb"];
} //if($lee_bil["cantidad_cb"] > 0){

} //for($q=1;$q<9;$q++){
 
// busca los entrantes

//busca los salientes

for($q=1;$q<9;$q++){

$bil = $c[$q];

$sql_bil = mysql_query("select SUM(cantidad_cb_v) as cantidad_cb_v from cantidad_billetes_vuelto where $vendedor_sql3 moneda_cb_v='peso chileno' and billete_cb_v ='$bil' $aptas_sql3 ");

$lee_bil = mysql_fetch_assoc($sql_bil);

if($lee_bil["cantidad_cb_v"] > 0){

$cc[$q] =  $cc[$q] - $lee_bil["cantidad_cb_v"];

} //if($lee_bil["cantidad_cb_v"] > 0){

} //for($q=1;$q<9;$q++){


//busca los salientes
	 
	 
echo "<div style='width:170px;padding:10px;height:220px;float:left;background-color:#ffffff;margin-left:10px'> <!-- 0000 -->
     
	 Pesos chilenos:<br><br>
	 
	 <div style='float:left;width:50px;line-height:17px'>
	 
	 10 <br>
	 50 <br>
	 100 <br>
	 1000 <br>
	 2000 <br>
	 5000 <br>
	 10000 <br>
	 20000 <br>
	 
	 </div>
	 
	 <div style='float:left;width:105px;margin-left:10px'>
	 
	 <input type='text' style='width:100px;height:11px' name='cc1' value='$cc[1]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc2' value='$cc[2]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc3' value='$cc[3]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc4' value='$cc[4]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc5' value='$cc[5]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc6' value='$cc[6]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc7' value='$cc[7]'><br>
	 <input type='text' style='width:100px;height:11px' name='cc8' value='$cc[8]'><br>
	 
	 
	 
	 </div>
	 
	 
	 </div><!-- 0000 --> 
	 
	 
	 
	 
	 ";
	 
	 
 
 
 //fin pone cantidad de billetes	 
 //fin pone cantidad de billetes	










////////////*********************** FIN ESPECIFICA EL MANEJO DE LA PLATA
////////////*********************** FIN ESPECIFICA EL MANEJO DE LA PLATA





















echo "</div>"; // %%%%%%%%%%%%%%%%%%%%%%%%%55555


echo "<div style='text-align:center'><a href='javascript: imprimiri()'><img src='../imagenes/imprimir.jpg' ></a></div>";


?>