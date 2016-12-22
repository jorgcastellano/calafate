<?php
  include_once("conexion.inc.php");
  include_once "funciones.inc.php";

  session_start();

  if($_SESSION["logeo"]=="") {
    echo "<script>alert('Debe estar registrado para ingresar aqui')</script>";
    die();
  }
?>
<!DOCTYPE html>
  <head lang="es">
    <meta charset="utf-8" />
    <title>MODIFICA </title>
    <link href="hoja_nueva.css" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />

    <script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript" src="validaciones.js"></script>

    <script src="src/js/jscal2.js"></script>
    <script src="src/js/lang/en.js"></script>
    <script src="js/utilidades_modificar_sub.js"></script>
    <link rel="stylesheet" type="text/css" href="src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="src/css/steel/steel.css" />
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />

    <script>
      function cambia(valor){
        for(d=1;d<=13;d++){
          if(d==valor)
          document.getElementById(d).style.display="block";
          else //if(d==valor)
          document.getElementById(d).style.display="none";
          //if(d==valor)
        }
      }
    </script>

    <script>
      function muestra_arti(val){
        if(document.getElementById(val).style.display=="none") {
          document.getElementById(val).style.display="block";
        else //if(document.getElementById(val).style.display=="none")
          document.getElementById(val).style.display="none";
          //if(document.getElementById(val).style.display=="none")
        } //function muestra_arti(val)
      }
    </script>

    <script>
      //----------------------cambia mes
      function cambia_mes(valor,valor1){
        try{
         //Firefox, Opera 8.0+, Safari
          xml_2=new XMLHttpRequest();
        }
        catch (e){
          // Internet Explorer
          try
            xml_2=new ActiveXObject("Msxml2.XMLHTTP");
            catch (e){
              try
                xml_2=new ActiveXObject("Microsoft.XMLHTTP");
              catch (e)
                alert("Tu navegador no soporta Ajax");
            }
        }
        xml_2.onreadystatechange=function(){
          if(xml_2.readyState==4){

            // document.write(xml_2.responseText);
            document.getElementById("calendario").innerHTML=xml_2.responseText
      	  }
        }

        /*
        if(i==4){
              i=1;
                }
        */
        //alert(lo);
        xml_2.onreadystatechange=function(){
          if(xml_2.readyState==4){
              // document.write(xml_2.responseText);
              document.getElementById("calendario").innerHTML=xml_2.responseText
          }
        }
        xml_2.open("GET","calendario2.php?clave="+ valor + "&clave_sub22=" + valor1);
        xml_2.send(null);
      }
      //----------------------fin cambia mes
    </script>
  </head>
  <body>

    <div class="global" >

      <?php include_once("encabezado.inc.php"); ?>

      <div style="width:180px;float:left;margin-left:10px;background-color:#f3f3f3;padding-top:20px;margin-top:10px;padding-left:20px;padding-bottom:20px;margin-right:30px"><!-- columna 1 -->

        <input type="button" value="Información y precios" onclick="cambia('1')" class="boton1"><br>
        <input type="button" value="Servicios adicionales" onclick="cambia('2')" class="boton1"><br>
        <input type="button" value="Calendario" onclick="cambia('3')" class="boton1"><br>
        <input type="button" value="Fotos" onclick="cambia('4')" class="boton1"><br>
        <input type="button" value="Descuentos promocionales" onclick="cambia('5')" class="boton1"><br>
        <input type="button" value="Info reserva" onclick="cambia('6')" class="boton1"><br>
        <input type="button" value="Explicaciones" onclick="cambia('7')" class="boton1"><br>
        <input type="button" value="Reglas" onclick="cambia('8')" class="boton1"><br>
        <input type="button" value="Items tabla ventas" onclick="cambia('9')" class="boton1"><br>
        <input type="button" value="Codigo para insertar" onclick="cambia('10')" class="boton1"><br>
        <input type="button" value="Descuento por vendedor" onclick="cambia('11')" class="boton1"><br>
        <input type="button" value="Borrar" onclick="cambia('12')" class="boton1"><br>

      </div> <!-- columna 1 -->

      <div style="padding:10px;width:780px;float:left"><!-- columna 2 -->

      <?php

      echo "<div style='display:none' id='1'>";

        include_once("info_sub2.inc.php");
        include_once("precio_edad.inc.php");

      echo "</div>";

      ##################################################ADICIONALES
      ##################################################ADICIONALES

      echo "<div style='display:none' id='2'>";

        include_once("adicionales_sub2.inc.php");

      echo "</div>";

      ##################################################FIN ADICIONALES
      ##################################################FIN ADICIONALES


      ################################################CALENDARIO
      ################################################CALENDARIO
      echo "<div style='display:none' id='3'>";

        include_once("calendario_sub2.inc.php");

      echo "</div>";
      ################################################FIN CALENDARIO
      ################################################FIN CALENDARIO



      ###############################################FOTOS
      ###############################################FOTOS

      $sub2 = $_GET["clave_sub2"];
      echo "<div style='display:none' id='4'>";

        include_once("fotos_sub2.inc.php");

      echo "</div>";

      ###############################################FIN FOTOS
      ###############################################FIN FOTOS


      ###############################################DESC PROMOCIONALES
      ###############################################DESC PROMOCIONALES

      echo "<div style='display:none' id='5'>";

        include_once("cupon_sub2.inc.php");

      echo "</div>";

      ###############################################FIN DESC PROMOCIONALES
      ###############################################FIN DESC PROMOCIONALES


      ############################################### INFO RESERVA
      ############################################### INFO RESERVA

      echo "<div style='display:none' id='6'>";

        include_once("info_reserva.inc.php");

      echo "</div>";

      ############################################### FIN INFO RESERVA
      ############################################### FIN INFO RESERVA


      ############################################### INFO EXPLICACIONES
      ############################################### INFO EXPLICACIONES

      echo "<div style='display:none' id='7'>";

        include_once("reglas_sub2.inc.php");

      echo "</div>";

      ############################################### FIN INFO EXPLICACIONES
      ############################################### FIN INFO EXPLICACIONES


      ############################################### INFO REGLAS
      ############################################### INFO REGLAS

      echo "<div style='display:none' id='8'>";

        include_once("reglas_venta_sub2.inc.php");

      echo "</div>";

      ############################################### FIN INFO REGLAS
      ############################################### FIN INFO REGLAS


      ############################################### INFO ITEMS TABLA VENTA
      ############################################### INFO ITEMS TABLA VENTA

      echo "<div style='display:none' id='9'>";

        include_once("items_venta_sub2.inc.php");

      echo "</div>";

      ############################################### FIN INFO ITEMS TABLA VENTA
      ############################################### FIN INFO ITEMS TABLA VENTA


      ############################################### CODIGO INSERTAR
      ############################################### CODIGO INSERTAR

      echo "<div style='display:none' id='10'>";

        if(isset($_GET["clave_div"]))
          echo "<script>document.getElementById('11').style.display='block'</script>";

        include_once("codigo_cargar_sub2.inc.php");

      echo "</div>";

      ############################################### FIN CODIGO INSERTAR
      ############################################### FIN CODIGO INSERTAR


      ############################################### DESCUENTO POR VENDEDOR
      ############################################### DESCUENTO POR VENDEDOR

      echo "<div style='display:none' id='11'>";

        include_once("descuento_vendedor_sub2.php");

      echo "</div>";

      ############################################### FIN DESCUENTO POR VENDEDOR
      ############################################### FIN DESCUENTO POR VENDEDOR


      ############################################### DESCUENTO POR VENDEDOR
      ############################################### DESCUENTO POR VENDEDOR

      echo "<div style='display:none' id='12'>";

        include_once("borrar_sub2.php");

      echo "</div>";

      ############################################### FIN DESCUENTO POR VENDEDOR
      ############################################### FIN DESCUENTO POR VENDEDOR

      ?>


        <script type="text/javascript">

            var cal = Calendar.setup({
                onSelect: function(cal) { cal.hide() },
                showTime: true
            });
            cal.manageFields("f_btn1", "desde", "%d/%m/%Y");
            cal.manageFields("f_btn2", "hasta", "%d/%m/%Y");
        	  cal.manageFields("f_btn11", "desde_cupon", "%d/%m/%Y");
            cal.manageFields("f_btn22", "hasta_cupon", "%d/%m/%Y");

        </script>

      </div>  <!-- fin columna 2 -->
      <div style="clear:both"></div>
      <div style="width:100%;text-align:center;height:40px;background-color:#666666;margin-top:40px">
        <a href="index.php"><img src="imagenes/bot_volver.png" title="Volver al panel"></a>
      </div>
    </div><!-- global-->
  </body>
</html>
