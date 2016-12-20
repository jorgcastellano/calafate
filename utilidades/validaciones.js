// JavaScript Document


//modifica info

//carga info



function valida(){

if (document.valida0.subcategoria_2.value.length==0){
alert("debe poner un valor");
document.valida0.subcategoria_2.focus();
return 0;

} //if (document.valida0.subcategoria_2.value.length==0){


if (document.valida0.desde.value.length==0){
alert("debe poner un valor");
document.valida0.desde.focus();
return 0;

} //if (document.valida0.desde.value.length==0){


if (document.valida0.hasta.value.length==0){
alert("debe poner un valor");
document.valida0.hasta.focus();
return 0;

} //if (document.valida0.hasta.value.length==0){


if (document.valida0.hasta.value.length!=10){
alert("debe poner una fecha valida");
document.valida0.hasta.focus();
return 0;

} //if (document.valida0.hasta.value.length==0){


if (document.valida0.desde.value.length!=10){
alert("debe poner una fecha valida");
document.valida0.desde.focus();
return 0;

} //if (document.valida0.hasta.value.length==0){


if (document.valida0.precio.value.length>0){

if (isNaN(document.valida0.precio.value)){
alert("no es un numero");
document.valida0.precio.focus();
return 0;

}//if (isNaN(document.valida0.cantidad.value)){

}else{ //if (document.valida0.precio.value.length>0){
alert("debe poner un valor");
document.valida0.precio.focus();
return 0;

} //if (document.valida0.precio.value.length>0){



document.valida0.submit();
 

} //function valida(){

//carga info



function validaa(){

if (document.valida1.subcategoria_2.value.length==0){
alert("debe poner un valor");
document.valida1.subcategoria_2.focus();
return 0;

} //if (document.valida1.subcategoria_2.value.length==0){


if (document.valida1.desde.value.length==0){
alert("debe poner un valor");
document.valida1.desde.focus();
return 0;

} //if (document.valida1.desde.value.length==0){


if (document.valida1.hasta.value.length==0){
alert("debe poner un valor");
document.valida1.hasta.focus();
return 0;

} //if (document.valida1.hasta.value.length==0){


if (document.valida1.hasta.value.length!=10){
alert("debe poner una fecha valida");
document.valida1.hasta.focus();
return 0;

} //if (document.valida1.hasta.value.length==0){


if (document.valida1.desde.value.length!=10){
alert("debe poner una fecha valida");
document.valida1.desde.focus();
return 0;

} //if (document.valida1.hasta.value.length==0){


if (document.valida1.preciot.value.length>0){

if (isNaN(document.valida1.preciot.value)){
alert("no es un numero");
document.valida1.preciot.focus();
return 0;

}//if (isNaN(document.valida1.cantidad.value)){

}else{ //if (document.valida1.preciot.value.length>0){
alert("debe poner un valor");
document.valida1.preciot.focus();
return 0;

} //if (document.valida1.preciot.value.length>0){



document.valida1.submit();
 

} //function validaa(){

//modifica info

//adicionales

function validab(){

if (document.valida2.nombre_ad.value.length==0){
alert("debe poner un valor");
document.valida2.nombre_ad.focus();
return 0;

} //if (document.valida2.nombre_ad.value.length==0){


if (document.valida2.precio_ad.value.length>0){

if (isNaN(document.valida2.precio_ad.value)){
alert("no es un numero");
document.valida2.precio_ad.focus();
return 0;

}//if (isNaN(document.valida2.cantidad.value)){

}else{ //if (document.valida2.precio_ad.value.length>0){
alert("debe poner un valor");
document.valida2.precio_ad.focus();
return 0;

} //if (document.valida2.precio_ad.value.length>0){

document.valida2.submit();

} //function validab(){



//adicionales

//descuento edad

function validac(){

if (document.valida3.edad_bebe1.value.length>0){

if (isNaN(document.valida3.edad_bebe1.value)){
alert("no es un numero");
document.valida3.edad_bebe1.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_bebe1.value.length>0){

if (document.valida3.edad_bebe2.value.length>0){

if (isNaN(document.valida3.edad_bebe2.value)){
alert("no es un numero");
document.valida3.edad_bebe2.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_bebe2.value.length>0){

if (document.valida3.bebe.value.length>0){

if (isNaN(document.valida3.bebe.value)){
alert("no es un numero");
document.valida3.bebe.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.bebe.value.length>0){


if (document.valida3.edad_nino1.value.length>0){

if (isNaN(document.valida3.edad_nino1.value)){
alert("no es un numero");
document.valida3.edad_nino1.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_nino1.value.length>0){

if (document.valida3.edad_nino2.value.length>0){

if (isNaN(document.valida3.edad_nino2.value)){
alert("no es un numero");
document.valida3.edad_nino2.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_nino2.value.length>0){

if (document.valida3.nino.value.length>0){

if (isNaN(document.valida3.nino.value)){
alert("no es un numero");
document.valida3.nino.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.nino.value.length>0){


if (document.valida3.edad_nino1_1.value.length>0){

if (isNaN(document.valida3.edad_nino1_1.value)){
alert("no es un numero");
document.valida3.edad_nino1_1.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_nino1_1.value.length>0){

if (document.valida3.edad_nino2_1.value.length>0){

if (isNaN(document.valida3.edad_nino2_1.value)){
alert("no es un numero");
document.valida3.edad_nino2_1.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_nino2_1.value.length>0){

if (document.valida3.nino.value.length>0){

if (isNaN(document.valida3.nino1.value)){
alert("no es un numero");
document.valida3.nino1.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.nino.value.length>0){



if (document.valida3.edad_nino1_2.value.length>0){

if (isNaN(document.valida3.edad_nino1_2.value)){
alert("no es un numero");
document.valida3.edad_nino1_2.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_nino1_2.value.length>0){

if (document.valida3.edad_nino2_2.value.length>0){

if (isNaN(document.valida3.edad_nino2_2.value)){
alert("no es un numero");
document.valida3.edad_nino2_2.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_nino2_2.value.length>0){

if (document.valida3.nino.value.length>0){

if (isNaN(document.valida3.nino2.value)){
alert("no es un numero");
document.valida3.nino2.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.nino.value.length>0){



if (document.valida3.edad_senior1.value.length>0){

if (isNaN(document.valida3.edad_senior1.value)){
alert("no es un numero");
document.valida3.edad_senior1.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_senior1.value.length>0){

if (document.valida3.edad_senior2.value.length>0){

if (isNaN(document.valida3.edad_senior2.value)){
alert("no es un numero");
document.valida3.edad_senior2.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.edad_senior2.value.length>0){

if (document.valida3.senior.value.length>0){

if (isNaN(document.valida3.senior.value)){
alert("no es un numero");
document.valida3.senior.focus();
return 0;

}//if (isNaN(document.valida3.cantidad.value)){

} //if (document.valida3.senior.value.length>0){

if (document.valida3.tipo.value==""){

alert("debe elegir el tipo de descuento");
document.valida3.tipo.focus();
return 0;


}//if (document.valida3.tipo.value.length>0){


document.valida3.submit();

} //function validac(){

//descuento edad



// descuento

function validad(){

if (document.valida4.codigo.value.length==0){
alert("debe poner un valor");
document.valida4.codigo.focus();
return 0;

} //if (document.valida2.nombre_ad.value.length==0){


if (document.valida4.desde_cupon.value.length==0){
alert("debe poner un valor");
document.valida4.desde_cupon.focus();
return 0;

} //if (document.valida4.desde_cupon.value.length==0){


if (document.valida4.hasta_cupon.value.length==0){
alert("debe poner un valor");
document.valida4.hasta_cupon.focus();
return 0;

} //if (document.valida4.hasta_cupon.value.length==0){


if (document.valida4.hasta_cupon.value.length!=10){
alert("debe poner una fecha valida");
document.valida4.hasta_cupon.focus();
return 0;

} //if (document.valida4.hasta_cupon.value.length==0){


if (document.valida4.desde_cupon.value.length!=10){
alert("debe poner una fecha valida");
document.valida4.desde_cupon.focus();
return 0;

} //if (document.valida4.hasta_cupon.value.length==0){

if (document.valida4.desc_cupon.value.length>0){

if (isNaN(document.valida4.desc_cupon.value)){
alert("no es un numero");
document.valida4.desc_cupon.focus();
return 0;

}//if (isNaN(document.valida4.cantidad.value)){

}else{ //if (document.valida4.desc_cupon.value.length>0){
alert("debe poner un valor");
document.valida4.desc_cupon.focus();
return 0;

} //if (document.valida4.desc_cupon.value.length>0){

if (document.valida4.cant_usos.value.length>0){

if (isNaN(document.valida4.cant_usos.value)){
alert("no es un numero");
document.valida4.cant_usos.focus();
return 0;

}//if (isNaN(document.valida4.cantidad.value)){

}else{ //if (document.valida4.cant_usos.value.length>0){
alert("debe poner un valor");
document.valida4.cant_usos.focus();
return 0;

} //if (document.valida4.cant_usos.value.length>0){

document.valida4.submit();

} //function validac(){


// descuento


//regla

function validae(){

if (isNaN(document.valida5.hora.value)){
alert("no es un numero");
document.valida5.hora.focus();
return 0;

}//if (isNaN(document.valida4.cantidad.value)){

if (isNaN(document.valida5.descuento.value)){
alert("no es un numero");
document.valida5.descuento.focus();
return 0;

}//if (isNaN(document.valida4.cantidad.value)){

if (isNaN(document.valida5.dias.value)){
alert("no es un numero");
document.valida5.dias.focus();
return 0;

}//if (isNaN(document.valida4.cantidad.value)){

if(document.valida5.dias.value.length>0 && document.valida5.descuento.value.length==0 ){ 
alert("debe completar la cantidad de descuento y la cantidad de dias o no poner nada en ninguna de las dos casillas");
document.valida5.dias.focus();
return 0;

}//if(document.valida5.dias.value.length>0 == document.valida5.descuento.value.length==0 ){ 

if(document.valida5.dias.value.length==0 && document.valida5.descuento.value.length>0 ){ 
alert("debe completar la cantidad de descuento y la cantidad de dias o no poner nada en ninguna de las dos casillas");
document.valida5.dias.focus();
return 0;

}//if(document.valida5.dias.value.length>0 == document.valida5.descuento.value.length==0 ){ 

document.valida5.submit();

} //function validac(){

//regla


//cambio moneda

function cvalidab(){


if (document.cvalida2.valor1.value.length>0){

if (isNaN(document.cvalida2.valor1.value)){
alert("no es un numero");
document.cvalida2.valor1.focus();
return 0;

}//if (isNaN(document.cvalida1.cantidad.value)){


if (document.cvalida2.valor2.value.length>0){

if (isNaN(document.cvalida2.valor2.value)){
alert("no es un numero");
document.cvalida2.valor2.focus();
return 0;

}//if (isNaN(document.cvalida2.cantidad.value)){

} //if (document.cvalida2.valor2.value.length>0){

if (document.cvalida2.valor3.value.length>0){

if (isNaN(document.cvalida2.valor3.value)){
alert("no es un numero");
document.cvalida2.valor3.focus();
return 0;

}//if (isNaN(document.cvalida1.cantidad.value)){

}//if (document.cvalida2.valor3.value.length>0){



if (document.cvalida2.valor4.value.length>0){

if (isNaN(document.cvalida2.valor4.value)){
alert("no es un numero");
document.cvalida2.valor4.focus();
return 0;

}//if (isNaN(document.cvalida1.cantidad.value)){


}//if (document.cvalida2.valor4.value.length>0){


if (document.cvalida2.valor5.value.length>0){
if (isNaN(document.cvalida2.valor5.value)){
alert("no es un numero");
document.cvalida2.valor5.focus();
return 0;

}//if (isNaN(document.cvalida1.cantidad.value)){

}//if (document.cvalida2.valor5.value.length>0){


if (document.cvalida2.valor6.value.length>0){
if (isNaN(document.cvalida2.valor6.value)){
alert("no es un numero");
document.cvalida2.valor6.focus();
return 0;

}//if (isNaN(document.cvalida1.cantidad.value)){

}//if (document.cvalida2.valor6.value.length>0){

if (document.cvalida2.valor7.value.length>0){

if (isNaN(document.cvalida2.valor7.value)){
alert("no es un numero");
document.cvalida2.valor7.focus();
return 0;

}//if (isNaN(document.cvalida1.cantidad.value)){

}//if (document.cvalida2.valor7.value.length>0){


if (document.cvalida2.valor8.value.length>0){

if (isNaN(document.cvalida2.valor8.value)){
alert("no es un numero");
document.cvalida2.valor8.focus();
return 0;

}//if (isNaN(document.cvalida1.cantidad.value)){

}//if (document.cvalida2.valor8.value.length>0){

} //if (document.cvalida1.billete.value.length>0){

document.cvalida2.submit();

} //function validac(){

//cambio moneda




//contador de billetes

function cvalidaa(){


if (document.cvalida1.billete.value.length>0){

if (isNaN(document.cvalida1.billete.value)){
alert("no es un numero");
document.cvalida1.billete.focus();
return 0;

}//if (isNaN(document.cvalida1.cantidad.value)){

}else{ //if (document.cvalida1.billete.value.length>0){
alert("debe poner un valor");
document.cvalida1.billete.focus();
return 0;

} //if (document.cvalida1.billete.value.length>0){

document.cvalida1.submit();

} //function validac(){

//contador de billetes



//medios de pagos !!!!!!!!!!!!! ---- !!!!!!!!!!

//#### paypal

function paypalh(){

if (document.paypal.mail_paypal.value.length==0){
alert("debe colocar un mail");
document.paypal.mail_paypal.focus();
document.paypal.mail_paypal.className="borde1";
return 0;
}else{
//    alert(document.paypal.mail_paypal.value);
	document.paypal.mail_paypal.className="borde2";
    
	}

if(validacion(document.paypal.mail_paypal.value)==false){
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
document.paypal.mail_paypal.focus();
return false;
}
else
{
//alert("Su email es correcto");

return true;
}

}



//fin valida direccion de mail-------------------------------------

document.paypal.submit();


}

//#### fin paypal

//#### mercado pago

function mercadopagoh(){

if (document.mercadopago.dato1.value.length>10){

alert("El dato no es correcto: Este valor no debe superar los 10 caracteres de longitud");

document.mercadopago.dato1.focus();
return 0;
} //if (document.mercadpago.dato1.value.length>0){



if (document.mercadopago.dato1.value.length==0 || document.mercadopago.dato2.value.length==0){
alert("Debe completar ambos datos");
return 0;

} //if (document.mercadopago.dato1.value.length==0 && document.mercadopago.dato2.value.length==0){

document.mercadopago.submit();

}//function mercadopagoh(){


//#### fin mercado pago


//fin medios de pagos !!!!!!!!!!!!! ---- !!!!!!!!!!










//#### usuario

function usuarioss(){

if (document.usuarios.nombre.value.length==0){
alert("debe poner un nombre");
document.usuarios.nombre.focus();
return 0;

} //if (document.usuarios.nombre.value.length==0){


if (document.usuarios.contrasena.value.length==0){
alert("debe poner una contraseña");
document.usuarios.contrasena.focus();
return 0;

} //if (document.usuarios.nombre.value.length==0){


if (document.usuarios.mail_usuarios.value.length==0){
alert("debe colocar un mail");
document.usuarios.mail_usuarios.focus();
document.usuarios.mail_usuarios.className="borde1";
return 0;
}else{
//    alert(document.usuarios.mail_usuarios.value);
	document.usuarios.mail_usuarios.className="borde2";
    
	}

if(validacion(document.usuarios.mail_usuarios.value)==false){
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
document.usuarios.mail_usuarios.focus();
return false;
}
else
{
//alert("Su email es correcto");

return true;
}

}



//fin valida direccion de mail-------------------------------------

document.usuarios.submit();


}

//#### fin usuarios



//#### usuario modifica

function usuarioss_mod(){

if (document.usuarios.nombre.value.length==0){
alert("debe poner un nombre");
document.usuarios.nombre.focus();
return 0;

} //if (document.usuarios.nombre.value.length==0){


if (document.usuarios.mail_usuarios.value.length==0){
alert("debe colocar un mail");
document.usuarios.mail_usuarios.focus();
document.usuarios.mail_usuarios.className="borde1";
return 0;
}else{
//    alert(document.usuarios.mail_usuarios.value);
	document.usuarios.mail_usuarios.className="borde2";
    
	}

if(validacion(document.usuarios.mail_usuarios.value)==false){
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
document.usuarios.mail_usuarios.focus();
return false;
}
else
{
//alert("Su email es correcto");

return true;
}

}



//fin valida direccion de mail-------------------------------------

document.usuarios.submit();


}

//#### fin usuarios modifica

