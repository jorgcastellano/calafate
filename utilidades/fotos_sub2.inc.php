<?php

if(isset($_GET["fotos"])){
echo "<script>document.getElementById('5').style.display='block'</script>";
} //if(isset($_GET["calendario"])){

echo "<div style='width:800px;text-align:center'>";

$sql = mysql_query("select * from fotos where clave_sub2_f = '$sub2' order by orden_foto asc ");



$cta_sql = mysql_num_rows($sql);



if($cta_sql > 0){

echo "<form action='carga_fotos_nuevo.php?categoria=$cclave_categoria&sub1=$cclave_sub1&sub2=$_GET[clave_sub2]&articulo=' method='post' >";
for($ff=1;$ff<=$cta_sql;$ff++){
$lee_sql = mysql_fetch_assoc($sql);

echo "<div style='background-color:#89bcf4;width:250px;height:117px;margin-left:4px;margin-bottom:4px;float:left'>";

echo "<div style='width:150px;float:left'>";
echo "<img src='$lee_sql[foto]' width=150  height=113 style='margin-right:5px;margin-bottom:5px;border: 2px solid #000000'>";
echo "</div>";

echo "<div style='width:100px;float:left;text-align:right'>";
if($lee_sql["publica_fotos"]=="si"){
echo "Publicar:&nbsp;<input type='checkbox' name='$lee_sql[clave]' checked='checked'><br>";
    }else{
	echo "Publicar:&nbsp;<input type='checkbox' name='$lee_sql[clave]'><br>";
	     }
echo "Borrar:&nbsp;<input type='checkbox' name='borra$lee_sql[clave]'><br>";
echo "Orden: <br>";
echo "<select name='orden_foto$ff'>";

for($cv=1;$cv<101;$cv++){

if($cv == $lee_sql["orden_foto"]){
echo "<option selected='selected' >$cv</option>";
     }else{
	 echo "<option >$cv</option>";
	 }//if($cv == $lee_sql["orden_foto"]){
	 
	 }//for($cv=1;$cv<101;$cv++){

	 echo "</select>";

echo "</div>";

echo "</div>";
}//cierra el for


echo "<div style='clear:both'>";
echo "<input type='hidden' name='escribano' value='ok'><br><br>";
echo "<input type='submit' value='Modificar' >";
echo "</div>";
echo "</form>";

}//if($cta_sql > 0){

echo "</div>";


//carga fotos

echo "<hr><br><b>Cargar foto nueva:</b><br><form action='carga_fotos_nuevo.php?categoria=$cclave_categoria&sub1=$cclave_sub1&sub2=$_GET[clave_sub2]&articulo=' method='post' enctype='multipart/form-data'>
<input type='hidden' name='MAX-FILE_SIZE' value='83886080'>

<br>Foto:<br>
<input type='file' name='nfoto1'><br>
Comentario:<br>
<input type='text' name='comentario'><br><br>


<input type='hidden' name='escribano_fotonoticia' value='ok'>
<input type='submit' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value=''>
</form>	";


//fin carga fotos

?>