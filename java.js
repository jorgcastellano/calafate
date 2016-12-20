// JavaScript Document

function muestra_foto(valor){

if (browserName=="Microsoft Internet Explorer"){
document.getElementById("capa" + valor).filters.alpha.opacity=0;
}else{
document.getElementById("capa" + valor).style.opacity=0.0;
}





}


function muestra_foto1(valor){

if (browserName=="Microsoft Internet Explorer"){
document.getElementById("capa" + valor).filters.alpha.opacity=50;
}else{
document.getElementById("capa" + valor).style.opacity=0.5;
}



}




//-----------------envia mail

function envia(){

if (document.goal.nombre.value.length==0){
alert("debe colocar un nombre");
document.goal.nombre.focus();
document.goal.nombre.className="borde1";
return 0;
}else{
    document.goal.nombre.className="borde2";
     }



if (document.goal.mail.value.length==0){
alert("debe colocar un mail");
document.goal.mail.focus();
document.goal.mail.className="borde1";
return 0;
}else{
//    alert(document.goal.mail.value);
	document.goal.mail.className="borde2";
    
	}

if(validacion(document.goal.mail.value)==false){
return 0;
}
//valida direccion de mail-------------------------------------

function validacion(dire)
{
var email = dire;
var verif = /^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (verif.exec(email) == null)
{
alert("Su email es incorrecto");
document.goal.mail.focus();
return false;
}
else
{
//alert("Su email es correcto");

return true;
}

}



//fin valida direccion de mail-------------------------------------



if (document.goal.cuerpo.value.length==0){
alert("debe colocar un texto");
document.goal.cuerpo.focus();
document.goal.cuerpo.className="borde1";
return 0;
}else{
    document.goal.cuerpo.className="borde2";
     }



document.goal.submit();




 
}

//-------------------------fin envia mail



function envia_reservas(){

if (document.reservas.nombre.value.length==0){
alert("debe colocar nombre, apellido o razon social");
document.reservas.nombre.focus();
document.reservas.nombre.className="borde1";
return 0;
}else{
    document.reservas.nombre.className="borde2";
     }


if (document.reservas.mail.value.length==0){
alert("debe colocar un mail");
document.reservas.mail.focus();
document.reservas.mail.className="borde1";
return 0;
}else{
    document.reservas.mail.className="borde2";
     }

if(validacion(document.reservas.mail.value)==false){
return 0;
}
//valida direccion de mail-------------------------------------

function validacion(dire)
{
var email = dire;
var verif = /^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (verif.exec(email) == null)
{
alert("Su email es incorrecto");
document.reservas.mail.focus();
return false;
}
else
{
//alert("Su email es correcto");

return true;
}

}



//fin valida direccion de mail-------------------------------------
	 

document.reservas.submit();
 
}//function envia_reserva(){



//################################### VALIDA INFO COMPRA
//################################### VALIDA INFO COMPRA
//################################### VALIDA INFO COMPRA


function valida_compra(){


//valida comprador

for(v=1;v<=30;v++){

if ( document.getElementById("obli_a"+ v) && document.getElementById("a" + v) ) {



if (document.getElementById("a" + v).value.length==0){
alert("debe completar el campo obligatorio");
document.getElementById("a" + v).focus();
document.getElementById("a" + v).className="borde1";
return 0;
}else{
    document.getElementById("a" + v).className="borde2";
     }
                 	
				  }//if ( document.getElementById(c) ) {
				  
} //for(v=1;v<=20;v++){		



    //valida mail comprador !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!------
	
if (document.paso1.a3){	

	
	if(validacion111(document.paso1.a3.value)==false){
return 0;
}
//valida direccion de mail-------------------------------------





//fin valida direccion de mail-------------------------------------
	
} //if (document.getElementById("a3")){		

	
    //fin valida mail comprador !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!------
		  

//fin valida comprador

//valida adulto

for(v=1;v<=30;v++){


for(x=1;x<=30;x++){

if ( document.getElementById("obli_inv_adulto_"+ v + "_" + x) && document.getElementById("inv_adulto_"+ v + "_" + x) ) {




if (document.getElementById("inv_adulto_"+ v + "_" + x).value.length==0){
alert("debe completar el campo obligatorio");
document.getElementById("inv_adulto_"+ v + "_" + x).focus();
document.getElementById("inv_adulto_"+ v + "_" + x).className="borde1";
return 0;
}else{
    document.getElementById("inv_adulto_"+ v + "_" + x).className="borde2";
     }
	 
	 
                 	
				  }//if ( document.getElementById(c) ) {

} //for(x=1;x<=30;x++){
				  
} //for(v=1;v<=20;v++){				  

//fin valida adulto


//valida bebe

for(v=1;v<=30;v++){


for(x=1;x<=30;x++){

if ( document.getElementById("obli_inv_bebe_"+ v + "_" + x) && document.getElementById("inv_bebe_"+ v + "_" + x) ) {




if (document.getElementById("inv_bebe_"+ v + "_" + x).value.length==0){
alert("debe completar el campo obligatorio");
document.getElementById("inv_bebe_"+ v + "_" + x).focus();
document.getElementById("inv_bebe_"+ v + "_" + x).className="borde1";
return 0;
}else{
    document.getElementById("inv_bebe_"+ v + "_" + x).className="borde2";
     }
	 
	 
                 	
				  }//if ( document.getElementById(c) ) {

} //for(x=1;x<=30;x++){
				  
} //for(v=1;v<=20;v++){				  

//fin valida bebe


//valida nino

for(v=1;v<=30;v++){


for(x=1;x<=30;x++){

if ( document.getElementById("obli_inv_nino_"+ v + "_" + x) && document.getElementById("inv_nino_"+ v + "_" + x) ) {




if (document.getElementById("inv_nino_"+ v + "_" + x).value.length==0){
alert("debe completar el campo obligatorio");
document.getElementById("inv_nino_"+ v + "_" + x).focus();
document.getElementById("inv_nino_"+ v + "_" + x).className="borde1";
return 0;
}else{
    document.getElementById("inv_nino_"+ v + "_" + x).className="borde2";
     }
	 
	 
                 	
				  }//if ( document.getElementById(c) ) {

} //for(x=1;x<=30;x++){
				  
} //for(v=1;v<=20;v++){				  

//fin valida nino

//valida nino1



for(v=1;v<=30;v++){


for(x=1;x<=30;x++){

if ( document.getElementById("obli_inv_nino1_"+ v + "_" + x) && document.getElementById("inv_nino1_"+ v + "_" + x) ) {




if (document.getElementById("inv_nino1_"+ v + "_" + x).value.length==0){
alert("debe completar el campo obligatorio");
document.getElementById("inv_nino1_"+ v + "_" + x).focus();
document.getElementById("inv_nino1_"+ v + "_" + x).className="borde1";
return 0;
}else{
    document.getElementById("inv_nino1_"+ v + "_" + x).className="borde2";
     }
	 
	 
                 	
				  }//if ( document.getElementById(c) ) {

} //for(x=1;x<=30;x++){
				  
} //for(v=1;v<=20;v++){				  

//fin valida nino1


//valida nino2

for(v=1;v<=30;v++){


for(x=1;x<=30;x++){

if ( document.getElementById("obli_inv_nino2_"+ v + "_" + x) && document.getElementById("inv_nino2_"+ v + "_" + x) ) {




if (document.getElementById("inv_nino2_"+ v + "_" + x).value.length==0){
alert("debe completar el campo obligatorio");
document.getElementById("inv_nino2_"+ v + "_" + x).focus();
document.getElementById("inv_nino2_"+ v + "_" + x).className="borde1";
return 0;
}else{
    document.getElementById("inv_nino2_"+ v + "_" + x).className="borde2";
     }
	 
	 
                 	
				  }//if ( document.getElementById(c) ) {

} //for(x=1;x<=30;x++){
				  
} //for(v=1;v<=20;v++){				  

//fin valida 


//valida senior

for(v=1;v<=30;v++){


for(x=1;x<=30;x++){

if ( document.getElementById("obli_inv_senior_"+ v + "_" + x) && document.getElementById("inv_senior_"+ v + "_" + x) ) {




if (document.getElementById("inv_senior_"+ v + "_" + x).value.length==0){
alert("debe completar el campo obligatorio");
document.getElementById("inv_senior_"+ v + "_" + x).focus();
document.getElementById("inv_senior_"+ v + "_" + x).className="borde1";
return 0;
}else{
    document.getElementById("inv_senior_"+ v + "_" + x).className="borde2";
     }
	 
	 
                 	
				  }//if ( document.getElementById(c) ) {

} //for(x=1;x<=30;x++){
				  
} //for(v=1;v<=20;v++){				  

//fin valida senior

document.paso1.submit();
				  
}//function valida_compra(){





//################################### VALIDA INFO COMPRA
//################################### VALIDA INFO COMPRA
//################################### VALIDA INFO COMPRA


//no borrar: sirve para validar el mail del comprador

function validacion111(dire)
{
var email = dire;
var verif = /^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (verif.exec(email) == null)
{
alert("Su email es incorrecto");
document.paso1.a3.focus();
return false;
}
else
{
//alert("Su email es correcto");

return true;
}

}

//fin no borrar: sirve para validar el mail del comprador



//-----------------envia carga empresa

function valida_empresa(){

if (document.empres.rubro.value.length==0){
alert("debe elegir un rubro");
document.empres.rubro.focus();
document.empres.rubro.className="borde1";
return 0;
}else{
    document.empres.rubro.className="borde2";
     }
	 
if (document.empres.nombre.value.length==0){
alert("debe poner un nombre de la empresa");
document.empres.nombre.focus();
document.empres.nombre.className="borde1";
return 0;
}else{
    document.empres.nombre.className="borde2";
     }	 



if (document.empres.mail.value.length==0){
alert("debe colocar un mail");
document.empres.mail.focus();
document.empres.mail.className="borde1";
return 0;
}else{
//    alert(document.empres.mail.value);
	document.empres.mail.className="borde2";
    
	}

if(validacion(document.empres.mail.value)==false){
return 0;
}
//valida direccion de mail-------------------------------------

function validacion(dire)
{
var email = dire;
var verif = /^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (verif.exec(email) == null)
{
alert("Su email es incorrecto");
document.empres.mail.focus();
return false;
}
else
{
//alert("Su email es correcto");

return true;
}

}



//fin valida direccion de mail-------------------------------------


if (document.empres.pass1.value.length==0){
alert("debe poner una contraseña");
document.empres.pass1.focus();
document.empres.pass1.className="borde1";
return 0;
}else{
    document.empres.pass1.className="borde2";
     }


if (document.empres.pass1.value != document.empres.pass2.value){
alert("las contraseñas no coinciden");
document.empres.pass1.focus();
document.empres.pass1.className="borde1";
return 0;
}else{
    document.empres.pass1.className="borde2";
     }	 


document.empres.submit();




 
}

//-------------------------fin envia carga empresa



function medio_pago(){
/*
if(document.medio.num_cupon.value.length>0 || document.medio.num_operacion.value.length>0 || document.medio.importe_tarjeta.value.length>0){

if(document.medio.num_cupon.value.length== 0 || document.medio.num_operacion.value.length == 0 || document.medio.importe_tarjeta.value.length== 0){

alert("Si va poner tarjeta debe completar todos los datos");
return 0;
}//if(document.medio.num_cupon.value.length== 0 || document.medio.num_operacion.value.length == 0 || document.medio.importe_tarjeta.value.length== 0){




}//if(document.medio.num_cupon.value.length>0 || document.medio.num_operacion.value.length>0 || document.medio.importe_tarjeta.value.length>0){

*/

/*
if(document.medio.moneda.value.length > 0 || document.medio.importe_efectivo.value.length >0){

if(document.medio.moneda.value.length==0 || document.medio.importe_efectivo.value.length==0){
alert("Si va poner efectivo debe completar todos los datos");
return 0;
}//if(document.medio.moneda.value.length==0 || document.medio.importe_efectivo.value.length==0){

}//if(document.medio.num_cupon.value.length==0){


if(document.medio.moneda.value.length==0 && document.medio.importe_efectivo.value.length==0 && document.medio.num_cupon.value.length== 0 && document.medio.num_operacion.value.length == 0 && document.medio.importe_tarjeta.value.length== 0){
alert("Debe colocar un dato");
return 0;
}
*/

if(document.medio.total_pesos.value== 0){
alert("Debe colocar cifras");
return 0;
}//if(document.medio.total_pesos.value== 0){


document.medio.submit();

} //function medio_pago(){


function calcula(){

tot_guita = document.medio.total_guita.value;

desc = document.medio.descuento.value;

descuento = tot_guita - desc;

document.getElementById("nueva_guita").innerHTML="El nuevo importe final es arg$ " + descuento + "<input type='hidden' name='total_guita' value='" + descuento + "' >";


} //function calcula(){


function calcula1(){

tot_guita = document.medio.total_guita.value;

recar = document.medio.recargo.value;

recargo = parseFloat(tot_guita) + parseFloat(recar);

document.getElementById("nueva_guita").innerHTML="El nuevo importe final es arg$ " + recargo + "<input type='hidden' name='total_guita' value='" + recargo + "' >";


} //function calcula(){


