<?php
session_start();
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

	
    <script language="javascript">
    function cargard(ancho,id,vendedor) {
    css = document.getElementById("glob");
    alto = css.scrollHeight;
	anchoq= ancho;
	id_q = id;
	clave_div = 10;
	clave_vendedor = vendedor;
	
	//alert("alto " + alto + " ancho " + anchoq + " id " + id_q + "clave div " + clave_div + " clave vendedor " + clave_vendedor);
	
	location.href="utilidades/modifica_subcategoria2_nueva.php?clave_sub2=" + id_q + "&ancho=" + anchoq + "&alto=" + alto + "&clave_div=11&vendedor=" +  clave_vendedor;
	
    }
    </script>	

	
	
</head>

<body >




                                                  <div  class="global_frame" id="glob">
<?php


$sql1 = mysql_query("select * from subcategoria_2 where clave = '$_GET[id]'");
$lee1 = mysql_fetch_assoc($sql1);



//busca si tiene descuento el vendedor
//busca si tiene descuento el vendedor


$descuento_vendedor = 0;

$b_de = mysql_query("select * from descuento_vendedor where idd_vendedor_dv='$_GET[id_vvv]' and idd_sub2_dv='$_GET[id]'");

$c_de = mysql_num_rows($b_de);

if($c_de > 0){

$l_de = mysql_fetch_assoc($b_de);

$descuento_vendedor = $l_de["descuento_dv"];

}//if($c_de > 0){

//fin busca si tiene descuento el vendedor
//fin busca si tiene descuento el vendedor



//CALCULA PRECIO CON DESCUENTO
//CALCULA PRECIO CON DESCUENTO

if($descuento_vendedor > 0){

$calc_desc = ($lee1["precio_sub2"] * $descuento_vendedor) / 100;

$pprecio_finall = $lee1["precio_sub2"] - $calc_desc;

}else{//if($descuento_vendedor > 0){

$pprecio_finall = $lee1["precio_sub2"];

}//if($descuento_vendedor > 0){

//FIN CALCULA PRECIO CON DESCUENTO
//FIN CALCULA PRECIO CON DESCUENTO




$ancho = $_GET["ancho"];
$anchoa = $ancho - 20 ."px";

echo "<div style='width:$anchoa px;padding:10px'> <!--   ttt -->";


$id_empresa = $lee1["idd_empresa_sub2"];
$clave_categoria = $lee1["clave_categoria_s2"];


if($lee1["publica_sub2"]=="si"){


echo "<div class='textos' style='width:$anchoa'>
      $lee1[texto_sub2] <br><br>
      <b>PRECIO: $$pprecio_finall </b><br><br>";

$sql_de = mysql_query("select * from descuento_edad where idd_sub2='$_GET[id]' ");
$cta_sql_de = mysql_num_rows($sql_de);

if($cta_sql_de == 0){
echo "No hay descuento por edad";  
}else{//if($cta_sql_de == 0){

for($d=1;$d<=$cta_sql_de;$d++){
$l_sql_de = mysql_fetch_assoc($sql_de);

if($l_sql_de["bebe"]>0){
echo "Descuento para bebes de $l_sql_de[edad_bebe1] a $l_sql_de[edad_bebe2] a�os: % $l_sql_de[bebe] ";

if($l_sql_de["adic_bebe"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["bebe"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["bebe"]=="si"){


} //if($l_sql_de["bebe"]>0){



if($l_sql_de["nino"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino1] a $l_sql_de[edad_nino2] a�os: % $l_sql_de[nino] ";

if($l_sql_de["adic_nino"]=="si"){
echo " ( Incluye a los servicios adicionales ) <br>";
}else{ //if($l_sql_de["nino"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["nino"]=="si"){

} //if($l_sql_de["bebe"]>0){


if($l_sql_de["nino1"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino1_1] a $l_sql_de[edad_nino1_2] a�os: % $l_sql_de[nino1] ";

if($l_sql_de["adic_nino1"]=="si"){
echo " ( Incluye a los servicios adicionales ) <br>";
}else{ //if($l_sql_de["nino1"]=="si"){
echo " ( NO incluye a los servicios adicionales ) <br>";
} //if($l_sql_de["nino1"]=="si"){

} //if($l_sql_de["bebe"]>0){

if($l_sql_de["nino2"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino2_1] a $l_sql_de[edad_nino2_2] a�os: % $l_sql_de[nino2] ";

if($l_sql_de["adic_nino2"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["nino2"]=="si"){
echo " ( NO incluye a los servicios adicionales )<br>";
} //if($l_sql_de["nino2"]=="si"){


} //if($l_sql_de["bebe"]>0){

if($l_sql_de["senior"]>0){
echo "Descuento para mayores de edad de $l_sql_de[edad_senior1] a $l_sql_de[edad_senior2] a�os: % $l_sql_de[senior] <br>";

if($l_sql_de["adic_senior"]=="si"){
echo " ( Incluye a los servicios adicionales )<br>";
}else{ //if($l_sql_de["senior"]=="si"){
echo " ( NO incluye a los servicios adicionales ) <br>";
} //if($l_sql_de["senior"]=="si"){


} //if($l_sql_de["bebe"]>0){



}//for($d=1;$d<=$cta_sql_de;$d++){


} ////if($cta_sql_de == 0){	  
	  
echo "</div>";

} //if($lee1["publica_sub"]=="si"){

?>


<div style="padding:10px"> <!--   ttt111111111 -->

<?php echo "<div id='gallery' style='width:$anchoa'><!-- -------------------- -->"; ?>
<ul>
<?php

$sql = mysql_query("select * from fotos where clave_sub2_f='$_GET[id]' and publica_fotos='si' order by orden_foto asc ");
$cta = mysql_num_rows($sql);


for($s=1;$s<=$cta;$s++){
$lee = mysql_fetch_assoc($sql);

$partes = explode(".",$lee["foto"]);

//<img src='utilidades/$partes[0]-1.jpg' style='margin-right:7px;margin-bottom:7px;border:3px solid #777777' alt='' />
    echo "<li>
	
            <a href='utilidades/$partes[0].jpg' title='$lee[texto_foto]'>
                
				
				<div style='margin-right:12px;margin-bottom:12px;border:3px solid #2683bc;width:130px;height:130px;float:left;overflow:hidden'><img src='utilidades/$partes[0]-1.jpg' height='130' style='border:none'></div>
            </a>
         </li>";


}//for($s=1;$s<=$cta;$s++){
echo "<div style='clear:both'></div>";
?>

</ul>
</div><!-- -------------------- -->


</div> <!--   ttt111111111 -->







<?php

echo "<div class='titulo' style='width:$anchoa'>Comprar:</div>";

echo "<div class='textos'>"; //eeeeerew


if(isset($_GET["id_v"])){
$clave_vendedor = "&id_v=".$_GET["id_v"];
}else{//if(isset($_GET["id_v"])){
$clave_vendedor = "";
}//if(isset($_GET["id_v"])){

//echo "<form method='post' action='paso1_frame.php?id=$_GET[id]$clave_vendedor&ancho=$_GET[ancho]'>";


$exis_id_v = isset($_GET["id_v"]);

if(isset($_GET["id_vvv"]) && $exis_id_v == FALSE){
$clave_vendedor = "&id_vvv=".$_GET["id_vvv"];
}else{//if(isset($_GET["id_vvv"])){
$clave_vendedor = "";
}//if(isset($_GET["id_vvv"])){





echo "<form method='post' action='http://www.creativoscalafate.com.ar/plataforma/paso1.php?id=$_GET[id]$clave_vendedor&ancho=$_GET[ancho]' target='_parent'>";

//fecha


if($clave_categoria == "3"){
echo "<div style='float:left'>Desde la fecha:";
}else{ //if($clave_categoria == "3"){
echo "<div style='float:left'>Fecha de la excursion";
}//if($clave_categoria == "3"){


if(isset($_POST["hasta"])){
$f_hasta = $_POST["hasta"];
}else{ //if(isset($_POST["hasta"])){
$f_hasta = "";
}//if(isset($_POST["hasta"])){

if(isset($_POST["desde"])){
$f_desde = $_POST["desde"];
}else{ //if(isset($_POST["desde"])){
$f_desde = "";
}//if(isset($_POST["desde"])){


echo "
<input style='width:100px' id='desde' name='desde' value='$f_desde' /><button id='f_btn1'>...</button> &nbsp; &nbsp; &nbsp; </div>";

if($clave_categoria == "3"){
echo "<div style='float:left;display:block'>";
}else{ //if($clave_categoria == "3"){
echo "<div style='float:left;display:none'>";
}//if($clave_categoria == "3"){

echo "Hasta la fecha: 
<input style='width:100px' id='hasta' name='hasta' value='$f_hasta' /><button id='f_btn2'>...</button></div><br /><br /> 
<div style='clear:both'></div>
      ";

//fin fecha


echo "Adultos: 
     <select name='adulto'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";	 

$sql_de = mysql_query("select * from descuento_edad where idd_sub2='$_GET[id]' ");
$cta_sql_de = mysql_num_rows($sql_de);


for($d=1;$d<=$cta_sql_de;$d++){
$l_sql_de = mysql_fetch_assoc($sql_de);

if($l_sql_de["bebe"]>0){

echo "Bebe's de $l_sql_de[edad_bebe1] a $l_sql_de[edad_bebe2] a�os: 
     <select name='bebe'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_bebe' value='$l_sql_de[bebe]'>";
echo "<input type='hidden' name='adic_desc_bebe' value='$l_sql_de[adic_bebe]'>";
}else{ //if($l_sql_de["bebe"]>0){

echo "<input type='hidden' name='bebe' value='0'>";

}// //if($l_sql_de["bebe"]>0){



if($l_sql_de["nino"]>0){

echo "Ni�os de $l_sql_de[edad_nino1] a $l_sql_de[edad_nino2] a�os: 
     <select name='nino'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_nino' value='$l_sql_de[nino]'>";
echo "<input type='hidden' name='adic_desc_nino' value='$l_sql_de[adic_nino]'>";

}else{ //if($l_sql_de["nino"]>0){

echo "<input type='hidden' name='nino' value='0'>";

} //if($l_sql_de["nino"]>0){




if($l_sql_de["nino1"]>0){


echo "Ni�os de $l_sql_de[edad_nino1_1] a $l_sql_de[edad_nino1_2] a�os: 
     <select name='nino1'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";

echo "<input type='hidden' name='num_nino1' value='$l_sql_de[nino1]'>";
echo "<input type='hidden' name='adic_desc_nino1' value='$l_sql_de[adic_nino1]'>";

}else{ //if($l_sql_de["nino1"]>0){

echo "<input type='hidden' name='nino1' value='0'>";

} //if($l_sql_de["nino1"]>0){

if($l_sql_de["nino2"]>0){


echo "Ni�os de $l_sql_de[edad_nino2_1] a $l_sql_de[edad_nino2_2] a�os: 
     <select name='nino2'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";
echo "<input type='hidden' name='num_nino2' value='$l_sql_de[nino2]'>";
echo "<input type='hidden' name='adic_desc_nino2' value='$l_sql_de[adic_nino2]'>";
}else{ //if($l_sql_de["nino2"]>0){

echo "<input type='hidden' name='nino2' value='0'>";

} //if($l_sql_de["nino2"]>0){

if($l_sql_de["senior"]>0){


echo "Mayores de edad de $l_sql_de[edad_senior1] a $l_sql_de[edad_senior2] a�os: 
     <select name='senior'>
	 <option value='0' checked >0</option>
	 ";

for($u=1;$u<=10;$u++){
echo "<option value='$u' >$u</option>";	 
}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";

echo "<input type='hidden' name='num_senior' value='$l_sql_de[senior]'>";
echo "<input type='hidden' name='adic_desc_senior' value='$l_sql_de[adic_senior]'>";

} else { //if($l_sql_de["senior"]>0){

echo "<input type='hidden' name='senior' value='0'>";

} //if($l_sql_de["senior"]>0){



}//for($d=1;$d<=$cta_sql_de;$d++){


###############adicionales
###############adicionales

$sql_ad = mysql_query("select * from adicionales where idd_sub2 = '$_GET[id]' ");
$cta_ad = mysql_num_rows($sql_ad);

if($cta_ad > 0){
echo "<div class='titulo' style='width:$anchoa'>Servicios adicionales:</div>";

echo "<div class='textos' style='width:$anchoa'>"; //wsxwsx

for($i=1;$i<=$cta_ad;$i++){

$lee_ad = mysql_fetch_assoc($sql_ad);

echo "<div style='border: 1px solid #ccc;padding:5px;margin-top:2px'>
      <div style='width:50%;float:left'><b>$lee_ad[nombre_ad] </b></div>
      <div style='width:25%;float:left'><b>$$lee_ad[precio_ad] </b></div>
	  <div style='width:25%;float:left'>Incluir: <input type='checkbox' name='ad$lee_ad[id_adicional]'></div>
	  <div style='clear:both'></div>
	  $lee_ad[texto_ad] 
	  </div>
     ";

}//for($i=1;$i<=$cta_ad;$i++){



echo "</div>"; //wsxwsx




} //if($cta_ad > 0){

###############fin adicionales
###############fin adicionales


####//// REGLAS

$sql_re = mysql_query("select * from reglas where idd_sub2_reglas='$_GET[id]'");
$l_re = mysql_fetch_assoc($sql_re);

echo "<div class='titulo' style='width:$anchoa'>Reglas y observaciones:</div>

<div class='textos' style='width:$anchoa'>
$l_re[texto_reglas]
</div>
";



####//// FIN REGLAS


echo "<br>
      <input type='hidden' name='id_empresa' value='$id_empresa'>
      <input type='hidden' name='clave_categoria' value='$clave_categoria'>
      <input type='submit' value='Comprar' style='height:50px;cursor:pointer'>
      </form>";

echo "</div>"; //eeeeerew


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

														 
<?php														 

if(isset($_GET["carga_alto"])){

//cargard('$_GET[ancho]','$_GET[id]','$_GET[vendedor]');													
													
echo "<script>

cargard('$_GET[ancho]','$_GET[id]','$_GET[vendedor]');													


</script>";

} //if(isset($_GET["carga_alto"])){

?>

</body>
</html>
