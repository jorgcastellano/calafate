<?php
include_once("conexion.inc.php");

$sql = mysql_query("select * from ventas where id_ventas='$_POST[id]'");
$c_sql = mysql_num_rows($sql);



$l_sql = mysql_fetch_assoc($sql);


//busca datos empresa

$sql_em = mysql_query("select * from empresa where id_empresa = '$l_sql[idd_empresa_vs]'");
$l_em = mysql_fetch_assoc($sql_em);

$nombre_empresa = $l_em["nombre_empresa"];
$direccion_empresa = $l_em["direccion_empresa"];
$tel1_empresa = $l_em["tel1_empresa"];
$tel2_empresa = $l_em["tel2_empresa"];
$mail_empresa = $l_em["mail_empresa"];
$logo_empresa = $l_em["logo_empresa"];

if($logo_empresa !=""){
$logo = "<img src='http://www.creativoscalafate.com.ar/plataforma/$logo_empresa' height='100'>";
}else{//if($logo_empresa !=""){
$logo = "";
}//if($logo_empresa !=""){

//fin busca datos empresa


  




$texto_mail = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
  <head lang="es">
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
    <title>VOUCHER</title>
  </head>
  <body style='margin-top: 0;margin-bottom: 0;margin-left: 0;margin-right: 0;font-family: arial;background-color:#ffffff'>

                                                                    <div style='margin: 0 auto;width: 490px;background-color:#fff;padding:5px'>

	
																		
																
<div style='width:500px'><!-- fondo 1 -->

<div style='float:left;height:100px'>$logo</div>
<div style='float:left;height:100px;font-size:12px;margin-left:10px'><b>$nombre_empresa </b><br> $direccion_empresa | Tel: $tel1_empresa &nbsp; &nbsp; $tel2_empresa | Mail: $mail_empresa</div>
<div style='clear:both;height:10px'></div>

<div style='font-size:12px'>

Para ver e imprimir el voucher del servicio contratado haga click en el siguiente link: <br><br> 

<a href='http://www.creativoscalafate.com.ar/plataforma/voucher.php?id=$_POST[id_carga]' target='_blank'>http://www.creativoscalafate.com.ar/plataforma/voucher.php?id=$_POST[id_carga]</a>

<br><br><br><br>

</div>

</div><!-- fondo 1 -->

                                                                              </div>


</body>
</html>";

//echo $texto_mail;

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Cabeceras adicionales
$cabeceras .= 'From: '.$mail_empresa.' \r\n';
 
$mail_compradorr = $_POST["mail"]; 


mail("$mail_compradorr", "Voucher", $texto_mail, $cabeceras);
//mail("$mail_empresa", "Reserva aprobada y confirmada en Calafate", $texto_mail, $cabeceras);

echo "<script>location.href='voucher.php?id=$_POST[id]&voucher=si&id_sub2=$_POST[id_sub2]&id_carga=$_POST[id_carga]&mando_mail=si'</script>";

?>