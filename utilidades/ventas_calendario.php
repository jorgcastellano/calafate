<?php
include_once("encabezado.inc.php");

?>





<div style="height:100%;width:200px;float:left;margin-right:5px;background-color:#ffffff" onMouseover="muestra0('0')"  id="columna1"><!-- 1era columna -->
<?php
include_once("primera_columna.inc.php");
?>
</div><!-- fin 1era columna -->

<div style="width:600px;float:left;margin-right:5px;background-color:#ffffff" onMouseover="muestra0('0')"  id="columna2" ><!-- 2da columna -->

<?php



$sd = mysql_query("select * from articulo where publica_articulo = 'si' and dia='$_GET[dia]' and mes='$_GET[mes]' and ano='$_GET[ano]' order by nombre_articulo asc ");

$c_sd = mysql_num_rows($sd);

if($c_sd > 0){

for($x=1;$x<=$c_sd;$x++){

$lee_sd = mysql_fetch_assoc($sd);


echo "<div style='width:590px;padding:5px;margin-left:5px'>";

echo "<a href='evento.php?clave=$lee_sd[clave]' style='color:#202638;font-weight:bold;font-variant:small-caps;text-decoration:none'>".$lee_sd["nombre_articulo"]."</a><br><br>";
echo "<span style='font-size:11px;text-align:justify'>".$lee_sd["copete_articulo"]."</span><br>";

echo "</div><br>";


echo "<hr>";
}//for($x=1;$x<=$c_sd;$x++){

}else{//if($c_sd > 0){

echo "<div><img src='imagenes/no_evento.jpg'></div>";

}//if($c_sd > 0){



echo "<br><br><div style='width:600px;text-align:center;background-color:#202638'><img src='imagenes/boton_volver.jpg' onclick='history.go(-1)' style='cursor:pointer' ></div>";

?>



</div><!-- fin 2da columna -->

<div style="height:100%;width:200px;float:left;margin-right:0px;background-color:#ffffff" onMouseover="muestra0('0')"  id="columna3"><!-- 3era columna -->

<?php
include_once("tercera_columna.inc.php");
?>

</div><!-- fin 3era columna -->

<div style="clear:both"></div>

<?php
include_once("pie.inc.php");
?>



                                                                </div>
<script>


alto_columna(document.getElementById("columna1").offsetHeight,document.getElementById("columna2").offsetHeight,document.getElementById("columna3").offsetHeight);

</script>  
</body>
</html>