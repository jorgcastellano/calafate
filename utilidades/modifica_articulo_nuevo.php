<?php
include_once("conexion.inc.php");

session_start();

if($_SESSION["logeo"]==""){
echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
die();
}


if($_POST["escribano_arti"]=="ok"){

if(is_numeric($_POST["precio_arti"])){

//busca todos los articulos de ese dia y actualiza

$sql_ar = mysql_query("select * from articulo where clave='$_POST[id_arti]'");
$lee_ar = mysql_fetch_assoc($sql_ar);

$mess= date("m");
$diaa = date("d");
$anoo = date("Y");



$dia_hoy = mktime(00,00,00,$mess,$diaa,$anoo);

if($dia_hoy <= $lee_ar["idd_fecha"]){

$s1 = mysql_query("select * from articulo where idd_fecha='$lee_ar[idd_fecha]' and clave_sub2_ar='$lee_ar[clave_sub2_ar]'  ");
$c_s1 = mysql_num_rows($s1);

for($g=1;$g<=$c_s1;$g++){
$l_s1 = mysql_fetch_assoc($s1);

if($l_s1["estado"]=="libre" || $l_s1["estado"]=="cancelado"){
mysql_query("UPDATE articulo SET precio='$_POST[precio_arti]',estado='$_POST[estado_arti]' where clave='$l_s1[clave]'");

}//if($l_s1["estado"]=="libre" || $l_s1["estado"]=="cancelado"){

} //for($g=1;$g<=$c_s1;$g++){

//busca todos los articulos de ese dia y actualiza


}else{//if($dia_hoy <= $lee_ar["idd_fecha"]){




echo "<script>
      alert('No se puede cambiar un articulo anterior al dia de la fecha  ');
      location.href='modifica_subcategoria2_nueva.php?clave_sub2=$_GET[clave_sub2]&calendario=si';
      </script>";
die();

}//if($dia_hoy <= $lee_ar["idd_fecha"]){


}else{ //if(is_numeric($_POST["precio_arti"])){

echo "<script>
      alert('No puso un numero. vuelva a intentarlo  ');
      location.href='modifica_subcategoria2_nueva.php?clave_sub2=$_GET[clave_sub2]&calendario=si';
      </script>";
die();

} //if(is_numeric($_POST["precio_arti"])){



} //if($_POST["escribano_arti"]=="ok"){


header ("Location: modifica_subcategoria2_nueva.php?clave_sub2=$_GET[clave_sub2]&calendario=si");

?>



