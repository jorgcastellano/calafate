<?php


//crea saludo y cierre de sesion

if(isset($_SESSION["logeo"]) && $_SESSION["tipo"]!=""){

echo "<div style='width:95%;padding-right:5px;text-align:right;color:#ffffff;font-size:12px;position:absolute;line-height:16px;margin-top:84px'>
     Hola, <span style='text-transform:uppercase'><b> $_SESSION[nombre_usuario] </b></span>, bienvenido <br>
	 <a href='login.php?cerrar=si' style='color:#ffffff;text-decoration:none'><b>CERRAR SESION</b></a>
     </div>";



}//if($_SESSION["tipo"]!=""){



//fin crea saludo y cierre de sesion


echo "
<div class='encabezado'>

<div style='height:150px;padding-top:47px;margin-left:5px'><!-- qazwsxedc -->

<a href='paso1.php'><div style='background-image:url(imagenes/boton.png)' class='boton2'><!-- fv -->
<div style='height:62px;margin-top:30px'> <img src='imagenes/mas.png' width=60 ></div>   

<div style='height:62px;margin-top:5px'><b>CARGAR <BR> ARTICULO</b></div>
</div></a><!-- fv -->


<a href='ver_subcategoria2.php'><div style='background-image:url(imagenes/boton.png)' class='boton2' ><!-- fv -->
<div style='height:62px;margin-top:30px'> <img src='imagenes/lupa.png' width=60 ></div>   

<div style='height:62px;margin-top:5px'><b>VER ARTICULOS <br> CARGADOS</b></div>
</div></a><!-- fv -->


<a href='vender.php'><div style='background-image:url(imagenes/boton.png)' class='boton2' ><!-- fv -->
<div style='height:62px;margin-top:30px'> <img src='imagenes/ventas1.png' width=60 ></div>   

<div style='height:62px;margin-top:5px'><b>VENDER</b></div>
</div></a><!-- fv -->


<a href='ventas.php'><div style='background-image:url(imagenes/boton.png)' class='boton2' ><!-- fv -->
<div style='height:62px;margin-top:30px'> <img src='imagenes/ventas.png' width=60 ></div>   

<div style='height:62px;margin-top:5px'><b>VER  <br> VENTAS</b></div>
</div></a><!-- fv -->


<a href='modifica_empresa.php'><div style='background-image:url(imagenes/boton.png)' class='boton2' ><!-- fv -->
<div style='height:62px;margin-top:30px'> <img src='imagenes/fabrica.png' width=60 ></div>   

<div style='height:62px;margin-top:5px'><b>MODIFICAR  DATOS<br> DE LA EMPRESA</b></div>
</div></a><!-- fv -->


<a href='usuarios.php'><div style='background-image:url(imagenes/boton.png)' class='boton2' ><!-- fv -->
<div style='height:62px;margin-top:30px'> <img src='imagenes/usuario.png' width=60 ></div>   

<div style='height:62px;margin-top:5px'><b>USUARIOS</b></div>
</div></a><!-- fv -->


<a href='informes.php'><div style='background-image:url(imagenes/boton.png)' class='boton2' ><!-- fv -->
<div style='height:62px;margin-top:30px'> <img src='imagenes/informes.png' width=60 ></div>   

<div style='height:62px;margin-top:5px'><b>INFORMES</b></div>
</div></a><!-- fv -->


<a href='configuracion.php'><div style='background-image:url(imagenes/boton.png)' class='boton2' ><!-- fv -->
<div style='height:62px;margin-top:30px'> <img src='imagenes/engranaje.png' width=60 ></div>   

<div style='height:62px;margin-top:5px'><b>CONFIGURACION</b></div>
</div></a><!-- fv -->


<div style='clear:both'></div>


</div><!-- qazwsxedc -->

</div>";

?>