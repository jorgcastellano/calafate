<?php

if(isset($_POST["escribano_de"])=="ok"){

$sql_de = mysql_query("select * from descuento_edad where idd_sub2='$_GET[clave_sub2]'");
$cta_de = mysql_num_rows($sql_de);

$bebe = "$_POST[bebe]";
$nino = "$_POST[nino]";
$nino1 = "$_POST[nino1]";
$nino2 = "$_POST[nino2]";
$senior = "$_POST[senior]";
$edad_bebe1 = "$_POST[edad_bebe1]";
$edad_bebe2 = "$_POST[edad_bebe2]";
$edad_nino1 = "$_POST[edad_nino1]";
$edad_nino2 = "$_POST[edad_nino2]";
$edad_nino1_1 = "$_POST[edad_nino1_1]";
$edad_nino2_1 = "$_POST[edad_nino2_1]";
$edad_nino1_2 = "$_POST[edad_nino1_2]";
$edad_nino2_2 = "$_POST[edad_nino2_2]";
$edad_senior1 = "$_POST[edad_senior1]";
$edad_senior2 = "$_POST[edad_senior2]";


if(isset($_POST["adic_bebe"])){
$adi_bebe = "si";
}else{
$adi_bebe = "";
}

if(isset($_POST["adic_nino"])){
$adi_nino = "si";
}else{
$adi_nino = "";
}

if(isset($_POST["adic_nino1"])){
$adi_nino1 = "si";
}else{
$adi_nino1 = "";
}


if(isset($_POST["adic_nino2"])){
$adi_nino2 = "si";
}else{
$adi_nino2 = "";
}

if(isset($_POST["adic_senior"])){
$adi_senior = "si";
}else{
$adi_senior = "";
}



if($cta_de >0){

$lee_de = mysql_fetch_assoc($sql_de);

mysql_query("UPDATE descuento_edad SET tipo='$_POST[tipo]',bebe='$bebe',nino='$nino',nino1='$nino1',nino2='$nino2',senior='$senior',edad_bebe1='$edad_bebe1',edad_bebe2='$edad_bebe2',edad_nino1='$edad_nino1',edad_nino2='$edad_nino2',edad_nino1_1='$edad_nino1_1',edad_nino2_1='$edad_nino2_1',edad_nino1_2='$edad_nino1_2',edad_nino2_2='$edad_nino2_2',edad_senior1='$edad_senior1',edad_senior2='$edad_senior2',adic_bebe='$adi_bebe',adic_nino='$adi_nino',adic_nino1='$adi_nino1',adic_nino2='$adi_nino2',adic_senior='$adi_senior' where idd_sub2 = '$_GET[clave_sub2]'  ");

}else{ //if($cta_de >0){

mysql_query("INSERT INTO descuento_edad (idd_sub2,tipo,bebe,nino,nino1,nino2,senior,edad_bebe1,edad_bebe2,edad_nino1,edad_nino2,edad_nino1_1,edad_nino2_1,edad_nino1_2,edad_nino2_2,edad_senior1,edad_senior2,adic_bebe,adic_nino,adic_nino1,adic_nino2,adic_senior) VALUES ('$_GET[clave_sub2]','$_POST[tipo]','$bebe','$nino','$nino1','$nino2','$senior','$edad_bebe1','$edad_bebe2','$edad_nino1','$edad_nino2','$edad_nino1_1','$edad_nino2_1','$edad_nino1_2','$edad_nino2_2','$edad_senior1','$edad_senior2','$adi_bebe','$adi_nino','$adi_nino1','$adi_nino2','$adi_senior') ");


} //if($cta_de >0){

echo "<script>document.getElementById('3').style.display='block'</script>";

} //if(isset($_POST["escribano_de"])=="ok"){

########################################IMPRIME INFO
########################################IMPRIME INFO
########################################IMPRIME INFO


echo "Descuento por edad:<br><br>";


$sql_de = mysql_query("select * from descuento_edad where idd_sub2='$_GET[clave_sub2]'");
$cta_de = mysql_num_rows($sql_de);

if($cta_de >0){

$lee_de = mysql_fetch_assoc($sql_de);

$bebe = "$lee_de[bebe]";
$nino = "$lee_de[nino]";
$nino1 = "$lee_de[nino1]";
$nino2 = "$lee_de[nino2]";
$senior = "$lee_de[senior]";
$edad_bebe1 = "$lee_de[edad_bebe1]";
$edad_bebe2 = "$lee_de[edad_bebe2]";
$edad_nino1 = "$lee_de[edad_nino1]";
$edad_nino2 = "$lee_de[edad_nino2]";
$edad_nino1_1 = "$lee_de[edad_nino1_1]";
$edad_nino2_1 = "$lee_de[edad_nino2_1]";
$edad_nino1_2 = "$lee_de[edad_nino1_2]";
$edad_nino2_2 = "$lee_de[edad_nino2_2]";
$edad_senior1 = "$lee_de[edad_senior1]";
$edad_senior2 = "$lee_de[edad_senior2]";
$tipo = $lee_de["tipo"];


if($lee_de["adic_bebe"]=="si"){
$adi_bebe = "checked";
}else{
$adi_bebe = "";
}

if($lee_de["adic_nino"]=="si"){
$adi_nino = "checked";
}else{
$adi_nino = "";
}

if($lee_de["adic_nino1"]=="si"){
$adi_nino1 = "checked";
}else{
$adi_nino1 = "";
}


if($lee_de["adic_nino2"]=="si"){
$adi_nino2 = "checked";
}else{
$adi_nino2 = "";
}

if($lee_de["adic_senior"]=="si"){
$adi_senior = "checked";
}else{
$adi_senior = "";
}



}else{ //if($cta_de >0){

$bebe = "";
$nino = "";
$nino1 = "";
$nino2 = "";
$senior = "";
$edad_bebe1 = "";
$edad_bebe2 = "";
$edad_nino1 = "";
$edad_nino2 = "";
$edad_nino1_1 = "";
$edad_nino2_1 = "";
$edad_nino1_2 = "";
$edad_nino2_2 = "";
$edad_senior1 = "";
$edad_senior2 = "";

$adi_bebe = "";
$adi_nino = "";
$adi_nino1 = "";
$adi_nino2 = "";
$adi_senior = "";

$tipo = "";;

} //if($cta_de >0){


echo "<div style='font-size:12px'>
     
	 <form action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' method='post' name='valida3'>
      
	 <div ><b>Tipo:</b>Tenga en cuenta que la cifra que ponga es lo que se descontar�: Si p�r ej pone suma fija $100, se descontaran $100 del precio fijado. <br><br> <select name='tipo'>";
	 
	 if($tipo ==""){
	 echo "<option value='' selected></option>
	 <option value='porcentaje' >porcentaje</option>
	 <option value='fijo'>suma fija</option>
	 ";
	 
	 }//if($tipo ==""){
	 
	 
     	 if($tipo =="porcentaje"){
	 echo "<option value='porcentaje' selected>porcentaje</option>
	 <option value='fijo'>suma fija</option>
	 ";
	 
	 }//if($tipo ==""){	 
	 
	 
	 	 if($tipo =="fijo"){
	 echo "<option value='porcentaje' >porcentaje</option>
	 <option value='fijo' selected>suma fija</option>
	 ";
	 
	 }//if($tipo ==""){
	 
	 
echo "</select></div><br>
	  
     <div style='float:left;width:80px'><b>Beb�</b></div>
     <div style='float:left;width:130px'>Desde <input type='text' name='edad_bebe1' style='width:70px' value='$edad_bebe1'></div>
     <div style='float:left;width:190px'>Hasta <input type='text' name='edad_bebe2' style='width:70px' value='$edad_bebe2'> a�os</div>
     <div style='float:left;width:130px'>Desc. &nbsp; <input type='text' name='bebe' style='width:70px' value='$bebe'></div>
	 <div style='float:left;width:200px'>Aplica a serv. adicionales: <input type='checkbox' name='adic_bebe' $adi_bebe ></div>
     <div style='clear:both'></div><br>
	 
     <div style='float:left;width:80px'><b>Ni�o 1</b></div>
     <div style='float:left;width:130px'>Desde <input type='text' name='edad_nino1' style='width:70px' value='$edad_nino1'></div>
     <div style='float:left;width:190px'>Hasta <input type='text' name='edad_nino2' style='width:70px' value='$edad_nino2'> a�os</div>
     <div style='float:left;width:130px'>Desc. &nbsp; <input type='text' name='nino' style='width:70px' value='$nino'></div>
     <div style='float:left;width:200px'>Aplica a serv. adicionales: <input type='checkbox' name='adic_nino' $adi_nino ></div>
	 <div style='clear:both'></div><br>
	 
     <div style='float:left;width:80px'><b>Ni�o 2</b></div>
     <div style='float:left;width:130px'>Desde <input type='text' name='edad_nino1_1' style='width:70px' value='$edad_nino1_1'></div>
     <div style='float:left;width:190px'>Hasta <input type='text' name='edad_nino2_1' style='width:70px' value='$edad_nino2_1'> a�os</div>
     <div style='float:left;width:130px'>Desc. &nbsp; <input type='text' name='nino1' style='width:70px' value='$nino1'></div>
     <div style='float:left;width:200px'>Aplica a serv. adicionales: <input type='checkbox' name='adic_nino1' $adi_nino1 ></div>
	 <div style='clear:both'></div><br>
	 
     <div style='float:left;width:80px'><b>Ni�o 3</b></div>
     <div style='float:left;width:130px'>Desde <input type='text' name='edad_nino1_2' style='width:70px' value='$edad_nino1_2'></div>
     <div style='float:left;width:190px'>Hasta <input type='text' name='edad_nino2_2' style='width:70px' value='$edad_nino2_2'> a�os</div>
     <div style='float:left;width:130px'>Desc. &nbsp;  <input type='text' name='nino2' style='width:70px' value='$nino2'></div>
     <div style='float:left;width:200px'>Aplica a serv. adicionales: <input type='checkbox' name='adic_nino2' $adi_nino2 ></div>
	 <div style='clear:both'></div><br>

     <div style='float:left;width:80px'><b>Senior</b></div>
     <div style='float:left;width:130px'>Desde <input type='text' name='edad_senior1' style='width:70px' value='$edad_senior1'></div>
     <div style='float:left;width:190px'>Hasta <input type='text' name='edad_senior2' style='width:70px' value='$edad_senior2'> a�os</div>
     <div style='float:left;width:130px'>Desc. &nbsp;  <input type='text' name='senior' style='width:70px' value='$senior'></div>
	 <div style='float:left;width:200px'>Aplica a serv. adicionales: <input type='checkbox' name='adic_senior' $adi_senior ></div>
     <div style='clear:both'></div>	 
     
	 <br>
	 <br>
	 <input type='hidden' name='escribano_de' value='ok'>
     <input type='button' onclick='validac()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >
     </form>

     </div>";

?>