<?php

  if(isset($_POST["escribano"])=="ok"){

  $subcategoria = $_POST["subcategoria_2"];
  $subcategoria1 = stripslashes( $subcategoria );

  $texto = $_POST["elm1t"];
  $texto = str_replace("<p>","",$texto);
  $texto = str_replace("</p>","<br>",$texto);

  $texto1 = stripslashes( $texto );

  if($_POST["publicar"]=="on"){
  $publicar = "si";
  }else{
  $publicar = "";
  }

  //busca clave categoria

  $sql = mysql_query("select clave_categoria_s1 from subcategoria_1 where clave='$_POST[subcategoria_1]'");
  $lee_sql = mysql_fetch_assoc($sql);
  $clave_categoria = $lee_sql["clave_categoria_s1"];

  //fin busca clave categoria

  // hace el tiempo

  $partes = explode("/",$_POST["desde"]);

  $dia = $partes[0];
  $mes = $partes[1];
  $ano = $partes[2];

  $partes1 = explode("/",$_POST["hasta"]);

  $dia1 = $partes1[0];
  $mes1 = $partes1[1];
  $ano1 = $partes1[2];

  $mess = (int)$mes;
  $diaa = (int)$dia;
  $anoo = (int)$ano;

  $mess1 = (int)$mes1;
  $diaa1 = (int)$dia1;
  $anoo1 = (int)$ano1;

  $fecha_desde = mktime(00,00,00,$mess,$diaa,$anoo);
  $fecha_hasta = mktime(00,00,00,$mess1,$diaa1,$anoo1);

  $cantidad_dias = (($fecha_hasta - $fecha_desde) / 86400) + 1;

  $idd_fechas = time();

  // fin hace el tiempo

  mysql_query("UPDATE subcategoria_2 SET clave_categoria_s2='$clave_categoria', clave_sub1_s2='$_POST[subcategoria_1]',nombre_sub2='$subcategoria1',texto_sub2='$texto1',precio_sub2='$_POST[preciot]',
    edadInicio1='$_POST[edadInicio1]', edadInicio2='$_POST[edadInicio2]', edadInicio3='$_POST[edadInicio3]', edadInicio4='$_POST[edadInicio4]', edadInicio5='$_POST[edadInicio5]', edadFinal1='$_POST[edadFinal1]',
    edadFinal2='$_POST[edadFinal2]', edadFinal3='$_POST[edadFinal3]', edadFinal4='$_POST[edadFinal4]', edadFinal5='$_POST[edadFinal5]', precioEdad1='$_POST[precioEdad1]', precioEdad2='$_POST[precioEdad2]',
    precioEdad3='$_POST[precioEdad3]', precioEdad4='$_POST[precioEdad4]', precioEdad5='$_POST[precioEdad5]', capacidad='$_POST[capacidad]', tiene_stock='$_POST[stock]' WHERE clave='$_POST[clave_sub2]'");

  $bsql = mysql_query("select * from subcategoria_2 where clave='$_GET[clave_sub2]' order by clave desc limit 0,1");
  $blee = mysql_fetch_assoc($bsql);

  $categoria = $blee["clave_categoria_s2"];
  $sub1 = $blee["clave_sub1_s2"];
  $sub2 = $blee["clave"];

  mysql_query("INSERT INTO fechas (id_fechas,idd_sub2,desde,hasta) VALUES ('$idd_fechas','$_GET[clave_sub2]','$fecha_desde','$fecha_hasta')");

  if($_POST["subcategoria_1"] =="2")
    $capacidad = "1";
  else
    $capacidad = "$_POST[capacidad]";

  //forea y grabas los articulos
  //forea y grabas los articulos

  $dias = $fecha_desde - 86400;

  for($x=1;$x<=$cantidad_dias;$x++){

  $dias = $dias + 86400;

  $actualizo_precio = "no";

  for($u=1;$u<=$capacidad;$u++){ // for para hacer la cantidad de articulos por dias

  //con control  de que no existan ya cargados

  $sp_control = mysql_query("select * from articulo where clave_sub2_ar = '$sub2' and idd_fecha = '$dias' ");
  $c_sp = mysql_num_rows($sp_control);

  if($c_sp == 0){
  mysql_query("INSERT INTO articulo (clave_categoria_ar,clave_sub1_ar,clave_sub2_ar,nombre_articulo,texto_articulo,precio,idd_fecha,estado) VALUES ('$categoria','$sub1','$sub2','','','$_POST[preciot]','$dias','libre')");

  }else{ //if($c_sp == 0){

  if($capacidad > $c_sp){

  $dife_cant = $capacidad - $c_sp;

  for($cq=1;$cq<=$dife_cant;$cq++){
  mysql_query("INSERT INTO articulo (clave_categoria_ar,clave_sub1_ar,clave_sub2_ar,nombre_articulo,texto_articulo,precio,idd_fecha,estado) VALUES ('$categoria','$sub1','$sub2','','','$_POST[preciot]','$dias','libre')");
  } //for($cq=1;$cq<=$dife_cant;$cq++){

  }else{ //if($capacidad > $c_sp){

  if($actualizo_precio == "no"){

  mysql_query("UPDATE articulo SET precio='$_POST[preciot]' where clave_categoria_ar='$categoria' and clave_sub1_ar='$sub1' and clave_sub2_ar='$sub2' and idd_fecha='$dias' and estado='libre' "); //actualiza los precios de los articulos ya cargados que estan en estado libre

  $actualizo_precio = "si";
  }//if($actualizo_precio == "no){

  }//if($capacidad > $c_sp){


  } //if($c_sp == 0){

  //fin con control  de que no existan ya cargados


  } //for($u=1;$u<=$_POST["capacidad"];$u++){ // for para hacer la cantidad de articulos por dias

  }//for($x=1;$x<=$cantidad_dias;$x++){

  //fin forea y grabas los articulos
  //fin forea y grabas los articulos

  //borra en caso de reduccion de plazas

  $dias = $fecha_desde - 86400;

  for($x=1;$x<=$cantidad_dias;$x++){

  $dias = $dias + 86400;

  $sp_control = mysql_query("select * from articulo where clave_sub2_ar = '$sub2' and idd_fecha = '$dias' ");
  $c_sp = mysql_num_rows($sp_control);

  $dife_cantq = $c_sp - $capacidad;

  if($dife_cantq > 0){


  $sql_borra = mysql_query("select * from articulo where clave_sub2_ar = '$sub2' and idd_fecha = '$dias' and estado='libre' limit 0,$dife_cantq");

  $cta_borra = mysql_num_rows($sql_borra);

  for($hg=1;$hg<=$cta_borra;$hg++){
  $lee_borra = mysql_fetch_assoc($sql_borra);
  mysql_query("DELETE from articulo where clave = '$lee_borra[clave]'");
  } //for($hg=1;$hg<=$cta_borra;$hg++){


  } //if($dife_cantq > 0){


  } //for($x=1;$x<=$cantidad_dias;$x++){

  //fin borra en caso de reduccion de plazas


  echo "<script>document.getElementById('1').style.display='block'</script>";

  }//cierra if escribano

  #################################################################### IMPRIME INFO
  #################################################################### IMPRIME INFO
  #################################################################### IMPRIME INFO

  $sql1 = mysql_query("select * from subcategoria_2 where clave = '$_GET[clave_sub2]'");
  $lee_sql1 = mysql_fetch_assoc($sql1);

  //claves

  $cclave_categoria = $lee_sql1["clave_categoria_s2"];
  $cclave_sub1 = $lee_sql1["clave_sub1_s2"];

  //fin claves

  echo "<form method='post' action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' enctype='multipart/form-data' name='valida1'>";

  echo "<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>";


  echo "<div style='display:none'>"; //&&&&##################################3

  $sql = mysql_query("select categoria.nombre_categoria, subcategoria_1.* from categoria left outer join subcategoria_1 on categoria.clave = subcategoria_1.clave_categoria_s1 where nombre_sub1 <> '' and subcategoria_1.publica_sub1 = 'si' order by subcategoria_1.nombre_sub1 asc");
  $cta_sql = mysql_num_rows($sql);


  echo "Asociar a la subcategoria:<br><br>";
  for($c=1;$c<=$cta_sql;$c++){
  $lee_sql = mysql_fetch_assoc($sql);
  $clave = $lee_sql["clave"];
  $clave_categoria = $lee_sql["clave_categoria_s1"];
  $nombre_sub1 = $lee_sql["nombre_sub1"];
  $nombre_categoria = $lee_sql["nombre_categoria"];

  if($lee_sql1["clave_sub1_s2"] == $clave){

  echo "<div class='recuadro' style='width:50px'>";
  echo "<input type='radio' name='subcategoria_1' value='$clave' checked='checked'>";
  echo "</div>";

  echo "<div class='recuadro' style='width:720px;text-align:left'>";
  echo "&nbsp;$nombre_sub1 de la categoria <span style='color:#ff0000'>$nombre_categoria</span><br>";
  echo "</div>";

  }else{ //if($lee_sql1["clave_sub1_s2"] == $nombre_sub1){

  echo "<div class='recuadro' style='width:50px'>";
  echo "<input type='radio' name='subcategoria_1' value='$clave' >";
  echo "</div>";

  echo "<div class='recuadro' style='width:720px;text-align:left'>";
  echo "&nbsp;$nombre_sub1 de la categoria <span style='color:#ff0000'>$nombre_categoria</span><br>";
  echo "</div>";

  }//if($lee_sql1["clave_sub1_s2"] == $nombre_sub1){

  echo "<div style='clear:both'></div>";
  }// cierra for

  if($lee_sql1["publica_sub2"]=="si"){
  echo "<div class='recuadro' style='width:780px;margin-top:20px'>";
  echo "Publicar:&nbsp;<input type='checkbox' name='publicar' checked='checked'><br><br>";
  echo "</div>";
  echo "<div style='clear:both'></div>";

  }else{//if($lee_sql1["destacar"]=="si"){
  echo "<div class='recuadro' style='width:780px;margin-top:20px'>";
  echo "Publicar:&nbsp;<input type='checkbox' name='publicar' ><br><br>";
  echo "</div>";
  echo "<div style='clear:both'></div>";

  }//if($lee_sql1["destacar"]=="si")

  echo "</div>"; //&&&&##################################3

  echo "<br><div style='width:100px;float:left'>Nombre:</div>";
  echo "<div style='width:250px;float:left'><input type='text' name='subcategoria_2' value='$lee_sql1[nombre_sub2]'></div>
        <div style='clear:both'></div>
        ";

  $texxto1 = str_replace("<br />","",$lee_sql1["texto_sub2"]);
  $texxto1 = str_replace("<br>","",$texxto1);

  echo "Información del artículo:<br>";
  echo "<textarea id='elm1t' name='elm1t' style='width:300px;height:80px' >$texxto1</textarea><br><br>";

  echo "<div style='display:none'>";

  if($lee_sql1["foto_sub2"]==""){
  echo "No hay foto cargada<br><br>";

  }else{ //if($lee_sql1["foto_sub1"]==""){
  echo "<br><img src='$lee_sql1[foto_sub2]' width=200><br>";
  echo "Borrar esta foto:&nbsp;<input type='checkbox' name='borra_foto'><br>";
  }

  echo "Foto:<br>";
  echo "<input type='file' name='foto'><br><br>";

  echo "</div>";


  echo "<br>Vender sin stock: ";

  if($lee_sql1["tiene_stock"]=="no"){

  echo "<select name='stock'>
        <option selected='selected'>no</option>
        <option>si</option>
        </select><br>";

  }else{//if($lee_sql1["tiene_stock"]){

  echo "<select name='stock'>
        <option>no</option>
        <option selected='selected' >si</option>
        </select><br>";

  } //if($lee_sql1["tiene_stock"]){


  $capacidad= $lee_sql1["capacidad"];

  echo "<br>Capacidad: ";
  echo "<select name='capacidad'>";

  	  for($c=1;$c<=200;$c++){
  	  if($capacidad == $c){
  	  echo "<option selected='selected'>$c</option>";
  	  }else{
  	  echo "<option>$c</option>";
  	  }

  	  }

  echo  "</select><br><br>";

  $sql_f = mysql_query("select * from fechas where idd_sub2='$_GET[clave_sub2]' order by id_fechas desc limit 0,1 ");
  $lee_f = mysql_fetch_assoc($sql_f);


  $desde = date("d/m/Y",$lee_f["desde"]);
  $hasta = date("d/m/Y",$lee_f["hasta"]);

  echo "<div style='width:100px;float:left'>Desde la fecha:</div>
       <div style='width:200px;float:left'><input style='width:100px' id='desde' name='desde' value='$desde' /><button id='f_btn1'>...</button></div><br />
       <div style='clear:both'></div>
  	 <div style='width:100px;float:left'>Hasta la fecha:</div>
  <div style='width:200px;float:left'><input style='width:100px' id='hasta' name='hasta' value='$hasta' /><button id='f_btn2'>...</button></div>
  <div style='clear:both'></div>
  <br />
  ";

    echo "<br><div style='width:100px;float:left'>Precio base: $ </div>";
    echo "<div style='width:250px;float:left'><input type='text' name='preciot' value='$lee_sql1[precio_sub2]'></div>
          <div style='clear:both'></div>
          <br><br>";

  ?>
  <label for="">Precio por edades: </label>

    <div id="">
      Desde <input type="number" name="edadInicio1" value="<?php echo $lee_sql1[edadInicio1] ?>">
      hasta <input type="number" name="edadFinal1" value="<?php echo $lee_sql1[edadFinal1] ?>"> años,
      el precio por edad $<input type="number" name="precioEdad1" value="<?php echo $lee_sql1[precioEdad1] ?>">
    </div>
    <div id="">
      Desde <input type="number" name="edadInicio2" value="<?php echo $lee_sql1[edadInicio2] ?>">
      hasta <input type="number" name="edadFinal2" value="<?php echo $lee_sql1[edadFinal2] ?>"> años,
      el precio por edad $<input type="number" name="precioEdad2" value="<?php echo $lee_sql1[precioEdad2] ?>">
    </div>
    <div id="">
      Desde <input type="number" name="edadInicio3" value="<?php echo $lee_sql1[edadInicio3] ?>">
      hasta <input type="number" name="edadFinal3" value="<?php echo $lee_sql1[edadFinal3] ?>"> años,
      el precio por edad $<input type="number" name="precioEdad3" value="<?php echo $lee_sql1[precioEdad3] ?>">
    </div>
    <div id="">
      Desde <input type="number" name="edadInicio4"  value="<?php echo $lee_sql1[edadInicio4] ?>">
      hasta <input type="number" name="edadFinal4" value="<?php echo $lee_sql1[edadFinal4] ?>"> años,
      el precio por edad $<input type="number" name="precioEdad4" value="<?php echo $lee_sql1[precioEdad4] ?>">
    </div>
    <div id="">
      Desde <input type="number" name="edadInicio5"  value="<?php echo $lee_sql1[edadInicio5] ?>">
      hasta <input type="number" name="edadFinal5" value="<?php echo $lee_sql1[edadFinal5] ?>"> años,
      el precio por edad $<input type="number" name="precioEdad5" value="<?php echo $lee_sql1[precioEdad5] ?>">
    </div>

  <?php

  echo "<input type='hidden' name='clave_sub1_actual' value='$lee_sql1[clave_sub1_s2]'>";
  echo "<input type='hidden' name='clave_sub2' value='$_GET[clave_sub2]'>";
  echo "<input type='hidden' name='escribano' value='ok'>";
  echo "<input type='button' onclick='validaa()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >";

  echo "</form>";
?>
