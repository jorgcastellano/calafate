<?php

if(isset($_POST["escribano_adicional"])=="ok"){


if($_POST["r1"]==""){


$r1 = "NULL";
$rr1 = "NULL";
$ad1 = "NULL";


}else{

$r1 = "'".$_POST["r1"]."'";
$rr1 = "'".$_POST["rr1"]."'";
$ad1 = "'".$_POST["ad1"]."'";

}

if($_POST["r2"]==""){


$r2 = "NULL";
$rr2 = "NULL";
$ad2 = "NULL";


}else{

$r2 = "'".$_POST["r2"]."'";
$rr2 = "'".$_POST["rr2"]."'";
$ad2 = "'".$_POST["ad2"]."'";

}


if($_POST["r3"]==""){


$r3 = "NULL";
$rr3 = "NULL";
$ad3 = "NULL";


}else{

$r3 = "'".$_POST["r3"]."'";
$rr3 = "'".$_POST["rr3"]."'";
$ad3 = "'".$_POST["ad3"]."'";

}

if($_POST["r4"]==""){


$r4 = "NULL";
$rr4 = "NULL";
$ad4 = "NULL";


}else{

$r4 = "'".$_POST["r4"]."'";
$rr4 = "'".$_POST["rr4"]."'";
$ad4 = "'".$_POST["ad4"]."'";

}


if($_POST["r5"]==""){


$r5 = "NULL";
$rr5 = "NULL";
$ad5 = "NULL";


}else{

$r5 = "'".$_POST["r5"]."'";
$rr5 = "'".$_POST["rr5"]."'";
$ad5 = "'".$_POST["ad5"]."'";

}



mysql_query("INSERT INTO adicionales (idd_sub2,nombre_ad,texto_ad,precio_ad,habilitar_ad,ad1,r1,rr1,ad2,r2,rr2,ad3,r3,rr3,ad4,r4,rr4,ad5,r5,rr5) VALUES ('$_GET[clave_sub2]','$_POST[nombre_ad]','$_POST[elm2]','$_POST[precio_ad]','si',$ad1,$r1,$rr1,$ad2,$r2,$rr2,$ad3,$r3,$rr3,$ad4,$r4,$rr4,$ad5,$r5,$rr5) ");


/*
ad1,r1,rr1,ad2,r2,rr2,ad3,r3,rr3,ad4,r4,rr4,ad5,r5,rr5


,$_POST[ad1],$_POST[r1],$_POST[rr1],$_POST[ad2],$_POST[r2],$_POST[rr2],$_POST[ad3],$_POST[r3],$_POST[rr3],$_POST[ad4],$_POST[r4],$_POST[rr4],$_POST[ad5],$_POST[r5],$_POST[rr5]
*/



echo "<script>document.getElementById('2').style.display='block'</script>";

}//if(isset($_POST["escribano_adicional"])=="ok"){


################################################IMPRIME INFO
################################################IMPRIME INFO
################################################IMPRIME INFO

//CARGA ADICIONAL



echo "ADICIONALES: <br><br>
      Cargar nuevo: <br> 
      <form action='$_SERVER[PHP_SELF]?clave_sub2=$_GET[clave_sub2]' method='post' name='valida2'>
     
	 
	 <br>Nombre: <input type='text' name='nombre_ad' value=''><br><br>
	 
	 <textarea id='elm2' name='elm2' style='width:300px;height:80px' ></textarea><br><br>
	 
	 Precio normal: <input type='text' name='precio_ad' value=''><br><br>
	 
	 Rangos de precio por edades:<br><br>
	 
	 (ej: personas entre 1 y 5 a�os $40 - El signo $ no hay que ponerlo)<br><br>
	 
	 Personas entre :  <input type='text' name='r1' value='' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr1' value='' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad1' value=''><br>

    Personas entre :  <input type='text' name='r2' value='' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr2' value='' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad2' value=''><br>

    Personas entre :  <input type='text' name='r3' value='' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr3' value='' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad3' value=''><br>

    Personas entre :  <input type='text' name='r4' value='' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr4' value='' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad4' value=''><br>

	Personas entre :  <input type='text' name='r5' value='' style='width:25px'> &nbsp; &nbsp; y &nbsp; &nbsp; <input type='text' name='rr5' value='' style='width:25px'> a�os &nbsp;&nbsp; <b>Precio:</b> &nbsp; <input type='text' name='ad5' value=''><br>

     	





	 
	 
	 
	 
	 <br>
	 
	 
	 
     <input type='hidden' name='escribano_adicional' value='ok'>
    <input type='button' onclick='validab()' style='height:40px;width:120px;background-image:url(imagenes/bot_cargar.png);border:0px;margin-top:20px;margin-bottom:40px;cursor:pointer' value='' >
     </form>";


//FIN CARGA ADICIONAL

echo "<br><br><br>";

$sql_ad = mysql_query("select * from adicionales where idd_sub2='$_GET[clave_sub2]'");
$cta_ad = mysql_num_rows($sql_ad);

if($cta_ad > 0){

echo "Adicionales cargados:";

for($b=1;$b<=$cta_ad;$b++){

$lee_ad = mysql_fetch_assoc($sql_ad);

echo "<hr><div style='color:#555555'>
     $lee_ad[nombre_ad] | $ $lee_ad[precio_ad] | <input type='button' value='Modificar' style='cursor:pointer' onclick=location.href='modifica_adicionales_sub2.inc.php?id_adicional=$lee_ad[id_adicional]&clave_sub2=$_GET[clave_sub2]'>
      </div><hr>";

} //for($b=1;$b<=$cta_ad;$b++){	  

}else{ //if($cta_ad > 0){
echo "No hay servicios adicionales cargados";
}//if($cta_ad > 0){

?>