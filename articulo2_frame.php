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

								  
$ancho = $_GET["ancho"];
$anchoa = $ancho - 20 ."px";

echo "<div style='width:$anchoa px;float:left;padding:10px'> <!--   ttt -->";


$id_empresa = $lee1["idd_empresa_sub2"];
$clave_categoria = $lee1["clave_categoria_s2"];


if($lee1["publica_sub2"]=="si"){



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


echo "<div class='textos' style='width:$anchoa' >
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
echo "Descuento para bebes de $l_sql_de[edad_bebe1] a $l_sql_de[edad_bebe2] a�os: % $l_sql_de[bebe] <br>";
} //if($l_sql_de["bebe"]>0){



if($l_sql_de["nino"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino1] a $l_sql_de[edad_nino2] a�os: % $l_sql_de[nino] <br>";
} //if($l_sql_de["bebe"]>0){


if($l_sql_de["nino1"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino1_1] a $l_sql_de[edad_nino1_2] a�os: % $l_sql_de[nino1] <br>";
} //if($l_sql_de["bebe"]>0){

if($l_sql_de["nino2"]>0){
echo "Descuento para ni�os de $l_sql_de[edad_nino2_1] a $l_sql_de[edad_nino2_2] a�os: % $l_sql_de[nino2] <br>";
} //if($l_sql_de["bebe"]>0){

if($l_sql_de["senior"]>0){
echo "Descuento para mayores de edad de $l_sql_de[edad_senior1] a $l_sql_de[edad_senior2] a�os: % $l_sql_de[senior] <br>";
} //if($l_sql_de["bebe"]>0){



}//for($d=1;$d<=$cta_sql_de;$d++){


} ////if($cta_sql_de == 0){	  
	  
echo "</div>";

} //if($lee1["publica_sub"]=="si"){

?>




<?php

echo "<div class='titulo' style='width:$anchoa'>Comprar:</div>";

echo "<div class='textos' style='width:$anchoa'>"; //eeeeerew

if(isset($_GET["id_v"])){
$clave_vendedor = "&id_v=".$_GET["id_v"];
}else{//if(isset($_GET["id_v"])){
$clave_vendedor = "";
}//if(isset($_GET["id_v"])){


//$_GET["id_vvv"] es el codigo de un vendedor que viene de un iframe

$exis_id_v = isset($_GET["id_v"]);

if(isset($_GET["id_vvv"]) && $exis_id_v == FALSE){
$clave_vendedor = "&id_vvv=".$_GET["id_vvv"];
}//if(isset($_GET["id_vvv"])){

echo "<form method='post' action='http://www.creativoscalafate.com.ar/plataforma/paso1_2.php?id=$_GET[id]$clave_vendedor&ancho=$_GET[ancho]' target='_parent'>";


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



echo "<br>Cantidad de personas: 
     <select name='adulto'>
	 
	 ";

for($u=1;$u<=10;$u++){

if(isset($_POST["cantidad"])){

if($_POST["cantidad"]==$u){
echo "<option value='$u' selected >$u</option>";	 
}else{ //if($_POST["cantidad"]==$u){
echo "<option value='$u' >$u</option>";
}//if($_POST["cantidad"]==$u){

}else{ //if(isset($_POST["cantidad"])){
echo "<option value='$u' >$u</option>";
} //if(isset($_POST["cantidad"])){


}//for($u=1;$u<=10;$u+){
	 
echo "</select><br><br>";	 



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
      <div style='width:350px;float:left'><b>$lee_ad[nombre_ad] </b></div>
      <div style='width:100px;float:left'><b>$$lee_ad[precio_ad] </b></div>
	  <div style='width:100px;float:left'>Incluir: <input type='checkbox' name='ad$lee_ad[id_adicional]'></div>
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
