<?php
include_once("encabezado.inc.php");
?>



<META NAME="Description" CONTENT="Turismo en Rio de Janeiro.">

<META NAME="Keywords" CONTENT="Maracana, Pao de A��car, Corcovado, Cristo Redentor,Buzios, Petr�polis, Arraial do Cabo, Cabo Frio, Angra Dos Reis, Islas Tropicales , Escolas de Samba, Sambodromoe Museo del Carnaval Carioca, Passeios rio de janeiro, Carnaval, Turismo en rio de janeiro, pan de azucar, cristo, city tour, Petropolis imperial, maracana, favela da rocinah,floresta de tijuta, ilhas tropicais, show de plataforma, feria tradicional nordestina, islas de los pecadores, boate discoteca, cristo redenton, reveillon">




<title>RIO COPA TOUR SUA MELHOR ALTERNATIVA EM PASSEIOS AGENCIA DE TURISMO CADASTRADA</title>

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

########################## Busca articulos

$sql2 = mysql_query("select * from articulo where destacar = 'si' and clave_categoria_ar= '1' ");
$cta2 = mysql_num_rows($sql2);




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
</div>


<div style="clear:both"></div>

<?php
include_once("pie.inc.php");
?>

                                                         </div>




</body>
</html>
