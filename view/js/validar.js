// JavaScript Document
function salir()
{
	location.href='../controlador/seguridad/salir.php';
}

function sali()
{
	location.href='../../controlador/seguridad/salir.php';
}

function vent(url,nomv)
{
	miPopup = window.open(url,nomv," location=no, menubar=no,toolbar=no,directories=no, top=200, left=400, width=500,height=300, scrollbars=yes");
	miPopup.focus();
}

function filtro(str, archivo, imp){	
	//alert(archivo);
	var xmlhttp;
	
  	if (window.XMLHttpRequest)
	{
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
   xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		 {
		   document.getElementById(imp).innerHTML=xmlhttp.responseText;
		 }
	  }
	  if (str=="")
	  { 
	    xmlhttp.open("GET",archivo+".php?q="+str,true);
	    xmlhttp.send();
	  }
   xmlhttp.open("GET",archivo+".php?q="+str,true);
   xmlhttp.send();
}

function inactivar(v){
	indice = document.getElementById("Frecuencia").selectedIndex;
	if( indice == null || indice == 0 ) {
		document.spg.archi_rnd.disabled=true;
		document.spg.archi_ip.disabled=true;
	}  
	else{
	  	document.spg.archi_rnd.disabled=false;
		document.spg.archi_ip.disabled=false;
	}
}

function procesar(nom){
	var activar = document.getElementById("descarga").selectedIndex;
	if(activar == null || activar == 0){
		document.forms[nom].descargar.disabled=true;
	}else{
		document.forms[nom].descargar.disabled=false;
	}
}

function cargar(){
	document.getElementById('oculto').style.display = 'block';
	var barra = document.getElementById('barra');
	barra.value +=5;
}

function pasar(valor){
	document.getElementById('name').value=valor;
}

function validar_form(nom, campo)
{  
	if(campo == "procesar"){
		if (document.forms[nom]['correo'].value=="")
		{
		    alert("El campo de correo no debe estar en blanco");
		}
		if (document.forms[nom]['cla'].value=="")
		{	
		    alert("Debe colocar una clave");
		}
		else{
		  document.forms[nom].submit();
		}
	}

	if(campo == "cambio"){
		var clave1 = document.getElementById("clave").value;
		var clave2 = document.getElementById("repetir").value;
		if(clave1 == clave2){
			if(confirm("Esta seguro que quiere cambiar la clave"))
				document.forms[nom].submit();
			else
				alert("Fue cancelada la solicitud");
		}else{
			alert("las dos claves son distintas");
		}
	}

	if(campo == "nuevo"){
		var clave1 = document.getElementById("clave").value;
		var clave2 = document.getElementById("repetir").value;
		if(document.forms[nom]["correo"].value == ""){
			alert("El campo correo no debe estar en blanco");
		} else if(document.forms[nom]["rut"].value == ""){
			alert("El campo rut no debe estar en blanco");
		} else if(document.forms[nom]["nombre"].value == ""){
			alert("El campo nombre no debe estar en blanco");
		} else if(document.forms[nom]["apellido"].value==""){
			alert("El campo apellido no debe estar en blanco");
		} else if(document.forms[nom]["clave"].value==""){
			alert("El campo clave no debe estar en blanco");
		} else if(document.forms[nom]["repetir"].value==""){
			alert("El campo Repite clave no debe estar en blanco");
		} else if(clave1 != clave2){
			alert("las dos claves son distintas");
		} else{
			document.forms[nom].submit();
		}
	}
}