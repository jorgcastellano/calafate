// JavaScript Document



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


//-----------------envia modifica empresa

function valida_modifica_empresa(){

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




document.empres.submit();




 
}

//-------------------------fin envia modifica empresa




//----------------------cambia mes venta

function cambia_mes_venta(valor,valor1){



try{
 //Firefox, Opera 8.0+, Safari
  xml_2=new XMLHttpRequest();
  }
catch (e){
 // Internet Explorer
  try{
    xml_2=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e){
    try{
      xml_2=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Tu navegador no soporta Ajax");
       }
    }
  }
xml_2.onreadystatechange=function(){
    if(xml_2.readyState==4){
      
	 // document.write(xml_2.responseText);
       document.getElementById("calendario").innerHTML=xml_2.responseText
	  }
    }


//alert(lo);
 xml_2.onreadystatechange=function(){
    if(xml_2.readyState==4){
      
	 // document.write(xml_2.responseText);
       document.getElementById("calendario").innerHTML=xml_2.responseText
	  }
    }


  xml_2.open("GET","ventas_calendario2.php?clave="+ valor + "&id_fechak=" + valor1);
  xml_2.send(null);
  

  
  }



//----------------------fin cambia mes venta




//----------------------cambia mes caja

function cambia_mes_caja(valor,valor1){



try{
 //Firefox, Opera 8.0+, Safari
  xml_2=new XMLHttpRequest();
  }
catch (e){
 // Internet Explorer
  try{
    xml_2=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e){
    try{
      xml_2=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Tu navegador no soporta Ajax");
       }
    }
  }
xml_2.onreadystatechange=function(){
    if(xml_2.readyState==4){
      
	 // document.write(xml_2.responseText);
       document.getElementById("calendario").innerHTML=xml_2.responseText
	  }
    }


//alert(lo);
 xml_2.onreadystatechange=function(){
    if(xml_2.readyState==4){
      
	 // document.write(xml_2.responseText);
       document.getElementById("calendario").innerHTML=xml_2.responseText
	  }
    }


  xml_2.open("GET","caja_calendario2.php?clave="+ valor + "&id_fechak=" + valor1);
  xml_2.send(null);
  

  
  }



//----------------------fin cambia mes caja 



