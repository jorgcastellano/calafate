<?php
include_once("encabezado.inc.php");
?>

<META NAME="Description" CONTENT="Turismo en Rio de Janeiro.">

<META NAME="Keywords" CONTENT="Maracana, Pao de A��car, Corcovado, Cristo Redentor,Buzios, Petr�polis, Arraial do Cabo, Cabo Frio, Angra Dos Reis, Islas Tropicales , Escolas de Samba, Sambodromoe Museo del Carnaval Carioca, Passeios rio de janeiro, Carnaval, Turismo en rio de janeiro, pan de azucar, cristo, city tour, Petropolis imperial, maracana, favela da rocinah,floresta de tijuta, ilhas tropicais, show de plataforma, feria tradicional nordestina, islas de los pecadores, boate discoteca, cristo redenton, reveillon">



<title>RIO COPA TOUR SUA MELHOR ALTERNATIVA EM PASSEIOS AGENCIA DE TURISMO CADASTRADA</title>


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


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34883143-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



</head>

<body >




                                                  <div  class="global" >


<div class="encabezado">
<img src="imagenes/encabezado.jpg">
</div>												  
												  
<div style="width:230px;float:left">

<?php
include_once("botonera.inc.php");
?>

</div>

<div style="width:600px;float:left;padding:10px">

<?php

$sql1 = mysql_query("select * from subcategoria_1 where clave='$_GET[id]'");
$lee1 = mysql_fetch_assoc($sql1);

if($lee1["foto_sub1"]!=""){

echo "<div style='text-align:center'><img src='utilidades/$lee1[foto_sub1]' width='600' ></div>";

}//if($lee1["foto_sub1"]!=""){

echo "<div class='titulo'>$lee1[nombre_sub1]</div>";

echo "<div class='textos'>$lee1[texto_sub1]</div>";


?>

<div id="gallery"><!-- """""""""""""""" -->
<ul>
<?php

$sql = mysql_query("select * from fotos where clave_sub1_f='$_GET[id]' and clave_articulo_f='' and publica_fotos='si' order by orden_foto asc ");
$cta = mysql_num_rows($sql);


for($s=1;$s<=$cta;$s++){
$lee = mysql_fetch_assoc($sql);

$partes = explode(".",$lee["foto"]);

//<img src='utilidades/$partes[0]-1.jpg' style='margin-right:7px;margin-bottom:7px;border:3px solid #777777' alt='' />
    echo "<li>
	
            <a href='utilidades/$partes[0].jpg' title='$lee[texto_foto]'>
                
				
				<div style='margin-right:7px;margin-bottom:7px;border:3px solid #e3e206;width:120px;height:120px;float:left'><img src='utilidades/$partes[0]-1.jpg' width=120 height=120 style='border:none'></div>
            </a>
         </li>";


}//for($s=1;$s<=$cta;$s++){
echo "<div style='clear:both'></div>";
?>

</ul>
</div><!-- """""""""""""""" -->


<?php

########################## Busca articulos

$sql2 = mysql_query("select * from articulo where clave_sub1_ar = '$_GET[id]'");
$cta2 = mysql_num_rows($sql2);

if($cta2>0){
echo "<div style='width:600px;height:15px;background-color:#e3e206;margin-top:10px;margin-bottom:10px'></div>";
} //if($cta2>0){


for($rf=1;$rf<=$cta2;$rf++){

$lee2 = mysql_fetch_assoc($sql2);

echo "<a href='articulo.php?id=$lee2[clave]'>
     <div style='width:280px;float:left;height:235px;background-color:#f3f259;text-align:center;border:2px solid #e3e206;margin-top:10px;margin-left:10px'>
	 <img src='utilidades/$lee2[foto_articulo]' width=275 height=206 style='margin-top:3px'><br>
	 <div style='text-decoration:none;font-size:11px;height:20px;line-height:20px;color:#5e031e;text-transform:uppercase'>$lee2[nombre_articulo]</div>
	 </div>
     </a>";



}//for($rf=1;$rf<=$cta2;$rf++){

echo "<div style='clear:both'></div>";

########################## Fin Busca articulos

?>



<div style="text-align:center;margin-top:20px">
<a href="javascript:history.go(-1)"><img src="imagenes/bot_volver.png"></a>
</div>

</div>


<div style="clear:both"></div>

<?php
include_once("pie.inc.php");
?>

                                                         </div>




</body>
</html>
