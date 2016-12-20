<?php
include_once("encabezado.inc.php");

if(isset($_POST["escribano"])=="ok"){
               			 
               mail("info@riocopatour.com", "contacto desde la pagina", "nombre: ".$_POST['nombre']." \r\n escribi�:\r\n".$_POST['cuerpo'], "from:".$_POST['mail']);
echo "<script>alert('EL MAIL SE HA ENVIADO CORRECTAMENTE')</script>";
                                                                                                
																			  

}//if($_POST["escribano"]=="ok"){


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


<div style="width:100px;float:left;text-align:right;font-family:arial;font-size:12px;color:#000000;margin-left:70px">
<div style="height:40px;margin-top:10px" >Nome:&nbsp;</div>
<div style="height:40px" >Mail:&nbsp;</div>
<div style="height:40px" >Texto:&nbsp;</div>
</div>

<div style="width:400px;float:left">


<form name="goal" method="post" action="contacto.php" style="width:400px;text-align:left;color:#000000;font-weight:bold;margin-top:5px">

<input type="text" name="nombre" class="borde2" style="width:250px;margin-top:8px" ><br>


<input type="text" name="mail" class="borde2" style="width:250px;margin-top:8px"><br>




<textarea name="cuerpo"    ROWS="8" class="borde2" style="width:250px;margin-top:8px"></textarea><br>



<input type="hidden" name="escribano" value="ok">


<input type="button" value="Send" onclick="envia()"><br><br>

</form>

</div>
 
<div style="clear:both;height:30px"></div> 



<div style="float:left;width:250px;margin-left:70px">

<img src="imagenes/telefono.jpg" width=200>

</div>


<div style="float:left;width:250px;font-size:12px">

<b>Rio de janerio:</b><br>            
 
(21) 4107-9701 fixo<br>                    
 
(21) 99934-3430 vivo<br>
 
(21) 98000-8012 tim <br><br>

<b>Sao paulo:</b><br>
(11) 4114-2380 fixo<br>
(11) 96370-3224 vivo<br>
id: 54*663*3643<br>


 <b>Nextel: id: 54*663*1067 </b>
 
 </div>

<div style="clear:both"></div>  


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
