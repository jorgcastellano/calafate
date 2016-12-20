<?php
include_once("encabezado.inc.php");
?>

<META NAME="Description" CONTENT="">

<META NAME="Keywords" CONTENT="">



<title>PLATAFORMA</title>


<!-- GALERIA JQUERY -->

   <!-- Arquivos utilizados pelo jQuery lightBox plugin -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
    <!-- / fim dos arquivos utilizados pelo jQuery lightBox plugin -->
    
    <!-- Ativando o jQuery lightBox plugin -->
    <script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>
   	<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		width:580px;
		margin-left:10px;
		margin-top:0px
		
		
	}
	#gallery ul { list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 3px solid #1e2254;
		border-width: 3px 3px 3px;
	}
	#gallery ul a:hover img {
		border: 3px solid #333;
		border-width: 3px 3px 3px;
		color: #333;
	}
	#gallery ul a:hover { color: #333; }
	</style>


<!-- FIN GALERIA JQUERY -->


    <script src="utilidades/src/js/jscal2.js"></script>
    <script src="utilidades/src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="utilidades/src/css/steel/steel.css" />


</head>

<body >




                                                  <div  class="global" >

<!--
<div class="encabezado">

</div>												  
-->												  
<div style="width:230px;float:left">



</div>

<div style="width:600px;float:left;padding:10px"> <!--   ttt -->

<?php


$partes = explode("/",$_POST["desde"]);

$dia = $partes[0];
$mes = $partes[1];
$ano = $partes[2];

$mess = (int)$mes;
$diaa = (int)$dia;
$anoo = (int)$ano;



$fecha_excursion = mktime(00,00,00,$mess,$diaa,$anoo);


if($_POST["hasta"]!=""){

$partes2 = explode("/",$_POST["hasta"]);

$dia2 = $partes2[0];
$mes2 = $partes2[1];
$ano2 = $partes2[2];

$mess2 = (int)$mes2;
$diaa2 = (int)$dia2;
$anoo2 = (int)$ano2;

$fecha_excursion1 = mktime(00,00,00,$mess2,$diaa2,$anoo2);

$cantidad_dias = ($fecha_excursion1 - $fecha_excursion) / 86400;

}else{ //if($_POST["hasta"]!=""){
$cantidad_dias = 1;
} //if($_POST["hasta"]!=""){







############################  hoteles 
############################  hoteles 

if($_POST["clave_s1"] == 2){ //pregunta si es hotel

$cantidad = 1;

$sql0 = mysql_query("select * from subcategoria_2 where clave_sub1_s2 = '$_POST[clave_s1]' and idd_empresa_sub2='$_POST[id_empresa]' and capacidad='$_POST[cantidad]'");

$c_sql0 = mysql_num_rows($sql0);



for($x=1;$x<=$c_sql0;$x++){
$l_sql0 = mysql_fetch_assoc($sql0);


// busca si hay disponibilidad en esos dias

$hay_lugar = "si";
$pone_fecha = $fecha_excursion;



for($p=1;$p<=$cantidad_dias;$p++){ 

if($p!=1){
$pone_fecha = $pone_fecha + 86400;
} //if($p==1){




$sql_ar = mysql_query("select * from articulo where clave_sub2_ar='$l_sql0[clave]' and estado='libre' and idd_fecha = '$pone_fecha' ");
$cta_ar = mysql_num_rows($sql_ar);

if ($cta_ar < $cantidad ){
$hay_lugar ="no";
}//if ($cta_ar < 1 && $hay_lugar =="si"){

}//for($p=1;$p<=$cantidad_dias;$p++){ 



if($hay_lugar == "si"){

if($_POST["clave_s1"]=="1"){
$linkq = "articulo.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){

if($_POST["clave_s1"]=="2"){
$linkq = "articulo1.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){

if($_POST["clave_s1"]=="3"){
$linkq = "articulo2.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){


//busca foto

$sql_ft = mysql_query("select * from fotos where clave_sub2_f='$l_sql0[clave]' and publica_fotos='si' and (orden_foto='1' or orden_foto IS NULL) order by orden_foto asc limit 0,1");

$l_ft = mysql_fetch_assoc($sql_ft);

if($l_ft["foto"] != ""){
$ffoto = "<img src='utilidades/$l_ft[foto]' height='113'>";
}else{ //if($l_ft["foto"] != ""){
$ffoto = "";
} //if($l_ft["foto"] != ""){

//fin busca foto


echo "<div style='width:600px;border:1px solid #555;height:100px;overflow:hidden'>
      <div style='width:150px;height:113px;overflow:hidden;float:left'>$ffoto</div> 
      <div style='width:290px;height:103px;overflow:hidden;float:left;padding:5px'>
	  <span style='text-transform:uppercase'><b> $l_sql0[nombre_sub2] </b></span><br>
	  <span style=''>Precio: ar$ $l_sql0[precio_sub2] </span><br>
	  </div> 
	  <div style='width:150px;height:113px;overflow:hidden;float:left'>
	  <form action='$linkq' method='post'>
	  <input type='hidden' name='desde' value='$_POST[desde]'>
	  <input type='hidden' name='hasta' value='$_POST[hasta]'>
	  <input type='hidden' name='cantidad' value='$_POST[cantidad]'>
	  
	  <input type='submit' value='Ver M�s' style='width:100px;height:50px;cursor:pointer;margin-top:30px'>
	  </form>
	  </div>
	  
	  <div style='clear:both'></div>
	 
	
      </div>";



}//if($hay_lugar == "si"){

} //for($x=1;$x<=$c_sql0;$x++){

}//if($_POST["clave_s1"] == 2){


############################ fin hoteles 
############################ fin hoteles 


############################hosteles
############################hosteles

if($_POST["clave_s1"] == 3){

$cantidad = $_POST["cantidad"];



$sql0 = mysql_query("select * from subcategoria_2 where clave_sub1_s2 = '$_POST[clave_s1]' and idd_empresa_sub2='$_POST[id_empresa]'");

$c_sql0 = mysql_num_rows($sql0);



for($x=1;$x<=$c_sql0;$x++){
$l_sql0 = mysql_fetch_assoc($sql0);


// busca si hay disponibilidad en esos dias

$hay_lugar = "si";
$pone_fecha = $fecha_excursion;



for($p=1;$p<=$cantidad_dias;$p++){ 

if($p!=1){
$pone_fecha = $pone_fecha + 86400;
} //if($p==1){




$sql_ar = mysql_query("select * from articulo where clave_sub2_ar='$l_sql0[clave]' and estado='libre' and idd_fecha = '$pone_fecha' ");
$cta_ar = mysql_num_rows($sql_ar);

if ($cta_ar < $cantidad ){
$hay_lugar ="no";
}//if ($cta_ar < 1 && $hay_lugar =="si"){

}//for($p=1;$p<=$cantidad_dias;$p++){ 



if($hay_lugar == "si"){

if($_POST["clave_s1"]=="1"){
$linkq = "articulo.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){

if($_POST["clave_s1"]=="2"){
$linkq = "articulo1.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){

if($_POST["clave_s1"]=="3"){
$linkq = "articulo2.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){


//busca foto

$sql_ft = mysql_query("select * from fotos where clave_sub2_f='$l_sql0[clave]' and publica_fotos='si' and (orden_foto='1' or orden_foto IS NULL) order by orden_foto asc limit 0,1");

$l_ft = mysql_fetch_assoc($sql_ft);

if($l_ft["foto"] != ""){
$ffoto = "<img src='utilidades/$l_ft[foto]' height='113'>";
}else{ //if($l_ft["foto"] != ""){
$ffoto = "";
} //if($l_ft["foto"] != ""){


//fin busca foto


echo "<div style='width:600px;border:1px solid #555;height:100px;overflow:hidden'>
      <div style='width:150px;height:113px;overflow:hidden;float:left'>$ffoto</div> 
      <div style='width:290px;height:103px;overflow:hidden;float:left;padding:5px'>
	  <span style='text-transform:uppercase'><b> $l_sql0[nombre_sub2] </b></span><br>
	  <span style=''>Precio: ar$ $l_sql0[precio_sub2] </span><br>
	  </div> 
	  <div style='width:150px;height:113px;overflow:hidden;float:left'>
	  <form action='$linkq' method='post'>
	  <input type='hidden' name='desde' value='$_POST[desde]'>
	  <input type='hidden' name='hasta' value='$_POST[hasta]'>
	  <input type='hidden' name='cantidad' value='$_POST[cantidad]'>
	  
	  <input type='submit' value='Ver M�s' style='width:100px;height:50px;cursor:pointer;margin-top:30px'>
	  </form>
	  </div>
	  
	  <div style='clear:both'></div>
	 
	
      </div>";



}//if($hay_lugar == "si"){

} //for($x=1;$x<=$c_sql0;$x++){


}//if($_POST["clave_s1"] == 3){

############################fin hosteles
############################fin hosteles




############################excursiones
############################excursiones

if($_POST["clave_categoria"] == 1){

$cantidad = $_POST["cantidad"];



$sql0 = mysql_query("select * from subcategoria_2 where clave_sub1_s2 = '$_POST[clave_s1]' and idd_empresa_sub2='$_POST[id_empresa]'");

$c_sql0 = mysql_num_rows($sql0);



for($x=1;$x<=$c_sql0;$x++){
$l_sql0 = mysql_fetch_assoc($sql0);


// busca si hay disponibilidad en esos dias

$hay_lugar = "si";
$pone_fecha = $fecha_excursion;



for($p=1;$p<=$cantidad_dias;$p++){ 

if($p!=1){
$pone_fecha = $pone_fecha + 86400;
} //if($p==1){




$sql_ar = mysql_query("select * from articulo where clave_sub2_ar='$l_sql0[clave]' and estado='libre' and idd_fecha = '$pone_fecha' ");
$cta_ar = mysql_num_rows($sql_ar);

if ($cta_ar < $cantidad ){
$hay_lugar ="no";
}//if ($cta_ar < 1 && $hay_lugar =="si"){

}//for($p=1;$p<=$cantidad_dias;$p++){ 



if($hay_lugar == "si"){

if($_POST["clave_s1"]=="1"){
$linkq = "articulo.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){

if($_POST["clave_s1"]=="2"){
$linkq = "articulo1.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){

if($_POST["clave_s1"]=="3"){
$linkq = "articulo2.php?id=$l_sql0[clave]";
}//if($_POST["clave_s1"]=="2"){


//busca foto

$sql_ft = mysql_query("select * from fotos where clave_sub2_f='$l_sql0[clave]' and publica_fotos='si' and (orden_foto='1' or orden_foto IS NULL) order by orden_foto asc limit 0,1");

$l_ft = mysql_fetch_assoc($sql_ft);

if($l_ft["foto"] != ""){
$ffoto = "<img src='utilidades/$l_ft[foto]' height='113'>";
}else{ //if($l_ft["foto"] != ""){
$ffoto = "";
} //if($l_ft["foto"] != ""){


//fin busca foto


echo "<div style='width:600px;border:1px solid #555;height:100px;overflow:hidden'>
      <div style='width:150px;height:113px;overflow:hidden;float:left'>$ffoto</div> 
      <div style='width:290px;height:103px;overflow:hidden;float:left;padding:5px'>
	  <span style='text-transform:uppercase'><b> $l_sql0[nombre_sub2] </b></span><br>
	  <span style=''>Precio: ar$ $l_sql0[precio_sub2] </span><br>
	  </div> 
	  <div style='width:150px;height:113px;overflow:hidden;float:left'>
	  <form action='$linkq' method='post'>
	  <input type='hidden' name='desde' value='$_POST[desde]'>
	  <input type='hidden' name='hasta' value='$_POST[hasta]'>
	  <input type='hidden' name='cantidad' value='$_POST[cantidad]'>
	  
	  <input type='submit' value='Ver M�s' style='width:100px;height:50px;cursor:pointer;margin-top:30px'>
	  </form>
	  </div>
	  
	  <div style='clear:both'></div>
	 
	
      </div>";



}//if($hay_lugar == "si"){

} //for($x=1;$x<=$c_sql0;$x++){


}//if($_POST["clave_categoria"] == 1){

############################fin excursiones
############################fin excursiones






?>

</div><!--   ttt -->

<div style="clear:both"></div>

<?php
//include_once("pie.inc.php");
?>

<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "desde", "%d/%m/%Y");
      cal.manageFields("f_btn2", "hasta", "%d/%m/%Y");
      

    //]]></script>



                                                         </div>




</body>
</html>
