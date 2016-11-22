// JavaScript Document
//-------------------------------------------------------------------------------------------------------------------------------------
function agregarOpcionCombo(control, opcion) {
       if (document.all) {  control.add(opcion);  }
       else {  control.add(opcion,null); }
}
//-------------------------------------------------------------------------------------------------------------------------------------
function vaciarCombo(control) {
     for (var i = control.options.length; i >= 0; i--)
            control.options[i] = null;
}
//-------------------------------------------------------------------------------------------------------------------------------------
// Llena una lista de selección con los valores de un arreglo
/* Parámetros:
- control: referencia al objeto de la lista de selección
- arreglo: referencia al arreglo con los valores para la lista
- columnaValor: índice de la columna del arreglo que contiene los valores de la lista
- columnaTexto: índice de la columna del arreglo que contiene la descripción a mostrar de los elementos de la lista
- opcionDefecto: cadena que indica el valor de una opción de selección por defecto en la lista.
								 Pasar una cadena vacía si no hay opción por defecto
- valorDefecto: cadena que indica el texto a mostrar para una opción de selección por defecto en la lista.
								Pasar una cadena vacía si no hay opción por defecto
*/

function llenarCombo(control, arreglo, columnaValor, columnaTexto, Defecto, Valor) {
	
	  vaciarCombo(control);
	
	  var myEle;
      var longitud = arreglo.length;
	  var longitud_defecto = Defecto.length;
	 
	 for (var i = 0; i < longitud_defecto; i++) {
		 myEle = document.createElement('option');
		 myEle.value = Defecto[i][0];
		 myEle.text = Defecto[i][1];
		 agregarOpcionCombo(control, myEle);
    }

     for (var x = 0; x < longitud; x++) {
	  if (arreglo[x][0]==Valor) {
		 myEle = document.createElement('option');
		 myEle.value = arreglo[x][columnaValor];
		 myEle.text = arreglo[x][columnaTexto];
		 agregarOpcionCombo(control, myEle);
	   }
    }
}

//-------------------------------------------------------------------------------------------------------------------------------------
 function esEmail(theElement)
 {
  var s = theElement.value;
  var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
  if (s.length == 0 ) {return false;   alert("Ingrese una dirección de correo válida");}
 if (filter.test(s))
  {return true;}
 else
	 {
	  alert("Ingrese una dirección de correo válida");
	  theElement.focus();
	  return false;
	 }
 }
 
 function valida_correo(theElement)
 {
  var s = theElement.value;
  var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
  if (s.length == 0 ) {return false;}
 if (filter.test(s))
  return true;
 else
  return false;
 }
//-------------------------------------------------------------------------------------------------------------------------------------
function validar_numero(ElElemento)
{
var numstr = ElElemento.value;
var mensaje = "El valor No es un numero 'valido'\nEjemplo: '12345679'";
	if (numstr+"" == "undefined" || numstr+"" == "null" || numstr+"" == "")	
		return false;

	var isValid = true;
	var decCount = 0;		

	numstr += "";	
   
	for (i = 0; i < numstr.length; i++) {
		if (numstr.charAt(i) == "."){
			//decCount++;
                          isValid = false;
                          break;}

    	if (!((numstr.charAt(i) >= "0") && (numstr.charAt(i) <= "9") || 
				(numstr.charAt(i) == "-") || (numstr.charAt(i) == "."))) {
       	isValid = false;
       	break;
		} else if ((numstr.charAt(i) == "-" && i != 0) ||
				(numstr.charAt(i) == "." && numstr.length == 1) ||
			  (numstr.charAt(i) == "." && decCount > 1)) {
       	isValid = false;
       	break;
      }         	         	       
   } // END for   
   
	if (!(isValid))  {alert(mensaje); ElElemento.focus(); ElElemento.select(); ElElemento.value="";}
  //La Cédula no es Númerica,\nRecuerde Colocarla Sin '.'\nEjemplo: '19901785' 
return isValid;
}  // end IsNum

//-------------------------------------------------------------------------------------------------------------------------------------
// cambiar_numero cambiar a bolivares
function cambiar_numero(thisone)
 {
 thisone.value=thisone.value.replace(/ Bs/, "");
	if (isNaN(thisone.value)) {alert('No es un número valido');  thisone.value="0 Bs"; return false;}

	if (thisone.value=="") return ;

   	var prefix=" Bs";
    var wd;
      if (thisone.value.charAt(0)==" ")
        return
      wd="w"
      var tempnum=thisone.value
      for (i=0;i<tempnum.length;i++)
      {
        if (tempnum.charAt(i)==".")
        {
          wd="d"
          break
        }
      }
      if (wd=="w")
        thisone.value=tempnum+".00"+prefix;
      else
      {
        if (tempnum.charAt(tempnum.length-2)==".")
        {
          thisone.value=tempnum+"0"+prefix;
        }
        else
        {
          tempnum=Math.round(tempnum*100)/100
          thisone.value=tempnum+prefix;
        }
      }
//	}//fin de validar numero
 }
//-------------------------------------------------------------------------------------------------------------------------------------
function comprobar_numerosdecimal(tempnum)
{
	 var wd;
	 var indice, fin;
	 var resto;
	 var retorna = new Array();

      wd="w"
     // var tempnum=numero;
      for (i=0;i<tempnum.length;i++)
      {
        if (tempnum.charAt(i)==".")
        {
          wd="d";
		  indice=i;
          break;
        }
      }

      if (wd=="w") {retorna[0]=false; retorna["numero"]=tempnum; retorna["numeroc"]=tempnum; }

      else
      {
		//alert(indice);
		fin=((tempnum.length+2)-(indice));
		resto=tempnum.substring(indice, fin);	
		alert("el resto es"+resto);
		retorna["numero"]=tempnum;
		tempnum=tempnum.replace(resto, "");
		alert("nuemro cambiado"+tempnum);
		retorna[0]=true;  retorna["numeroc"]=tempnum;	
      }
	return retorna;
}
//-------------------------------------------------------------------------------------------------------------------------------------
function cambiar_horas(thisone)
 {
 thisone.value=thisone.value.replace(/ Horas/, "");
	if (isNaN(thisone.value)) {alert('No es un número valido');  thisone.value="0 Horas"; return false;}
   	var prefix=" Horas";
    var tempnum=thisone.value
	if (thisone.value=="") return ;
    thisone.value=tempnum+prefix;
/*
    var wd;
    
      wd="w"

      for (i=0;i<tempnum.length;i++)
      {
        if (tempnum.charAt(i)==".")
        {
          wd="d"
          break
        }
      }
      if (wd=="w")
*/
//	}//fin de validar numero
 }
//-------------------------------------------------------------------------------------------------------------------------------------
function mutltiplicar(valor1, valor2, control)
{
	var valor_1=valor1.value.replace(/ Bs/, "");
	var valor_2=valor2.value.replace(/ Bs/, "");

	control.value=valor_1 * valor_2;
	cambiar_numero(control);
}
//-------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------
 function reemplazar(texto,textoBuscado,nuevaCadena) {
  
  while (texto.indexOf(textoBuscado)>-1) {
   pos= texto.indexOf(textoBuscado);
   texto = "" + (texto.substring(0, pos) + nuevaCadena 
     + texto.substring((pos + textoBuscado.length), texto.length));
  }

  return texto;
 }

//------------------------------------------------------------------------------------------------
function dividir(valor1, valor2, control)
{
	var valor_1=valor1.value.replace(/ Bs/, "");
	var valor_2=valor2.value.replace(/ Bs/, "");

	control.value=valor_1 / valor_2;
	cambiar_numero(control);
}
//-------------------------------------------------------------------------------------------------------------------------------------

function cambiar_fechas(fecha)
{
	
	
}

function comparar_fecha(fecha_desde,fecha_hasta)
{
// fomato de entrada DD/MM/AAAA
	String1 = fecha_desde.value;
	String2 = fecha_hasta.value;
	// Si los dias y los meses llegan con un valor menor que 10
	// Se concatena un 0 a cada valor dentro del string
	if (String1.substring(1,2)=="/") {
	String1="0"+String1
	}
	if (String1.substring(4,5)=="/"){
	String1=String1.substring(0,3)+"0"+String1.substring(3,9)
	}
	
	if (String2.substring(1,2)=="/") {
	String2="0"+String2
	}
	if (String2.substring(4,5)=="/"){
	String2=String2.substring(0,3)+"0"+String2.substring(3,9)
	}
	
	dia1=String1.substring(0,2);
	mes1=String1.substring(3,5);
	anyo1=String1.substring(6,10);
	dia2=String2.substring(0,2);
	mes2=String2.substring(3,5);
	anyo2=String2.substring(6,10);
	
	
	if (dia1 == "08") // parseInt("08") == 10 base octogonal
	dia1 = "8";
	if (dia1 == '09') // parseInt("09") == 11 base octogonal
	dia1 = "9";
	if (mes1 == "08") // parseInt("08") == 10 base octogonal
	mes1 = "8";
	if (mes1 == "09") // parseInt("09") == 11 base octogonal
	mes1 = "9";
	if (dia2 == "08") // parseInt("08") == 10 base octogonal
	dia2 = "8";
	if (dia2 == '09') // parseInt("09") == 11 base octogonal
	dia2 = "9";
	if (mes2 == "08") // parseInt("08") == 10 base octogonal
	mes2 = "8";
	if (mes2 == "09") // parseInt("09") == 11 base octogonal
	mes2 = "9";
	
	dia1=parseInt(dia1);
	dia2=parseInt(dia2);
	mes1=parseInt(mes1);
	mes2=parseInt(mes2);
	anyo1=parseInt(anyo1);
	anyo2=parseInt(anyo2);
	
	if (anyo1>anyo2)
	{
	return false;
	}
	
	if ((anyo1==anyo2) && (mes1>mes2))
	{
	return false;
	}
	if ((anyo1==anyo2) && (mes1==mes2) && (dia1>dia2))
	{
	return false;
	}
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
 function cerosIzq(sVal, nPos){
    var sRes = sVal;
    for (var i = sVal.length; i < nPos; i++)
     sRes = "0" + sRes;
    return sRes;
   }

   function armaFecha(nDia, nMes, nAno){
    var sRes = cerosIzq(String(nDia), 2);
    sRes = sRes + "/" + cerosIzq(String(nMes), 2);
    sRes = sRes + "/" + cerosIzq(String(nAno), 4);
    return sRes;
   }

   function sumaMes(nDia, nMes, nAno, nSum){
    if (nSum >= 0){
     for (var i = 0; i < Math.abs(nSum); i++){
      if (nMes == 12){
       nMes = 1;
       nAno += 1;
      } else nMes += 1;
     }
    } else {
     for (var i = 0; i < Math.abs(nSum); i++){
      if (nMes == 1){
       nMes = 12;
       nAno -= 1;
      } else nMes -= 1;
     }
    }
    return armaFecha(nDia, nMes, nAno);
   }

   function esBisiesto(nAno){
    var bRes = true;
    res = bRes && (nAno % 4 == 0);
    res = bRes && (nAno % 100 != 0);
    res = bRes || (nAno % 400 == 0);
    return bRes;
   }

   function finMes(nMes, nAno){
    var nRes = 0;
    switch (nMes){
     case 1: nRes = 31; break;
     case 2: nRes = 28; break;
     case 3: nRes = 31; break;
     case 4: nRes = 30; break;
     case 5: nRes = 31; break;
     case 6: nRes = 30; break;
     case 7: nRes = 31; break;
     case 8: nRes = 31; break;
     case 9: nRes = 30; break;
     case 10: nRes = 31; break;
     case 11: nRes = 30; break;
     case 12: nRes = 31; break;
    }
    return nRes + (((nMes == 2) && esBisiesto(nAno))? 1: 0);
   }

   function diasDelAno(nAno){
    var nRes = 365;
    if (esBisiesto(nAno)) nRes++;
    return nRes;
   }

   function anosEntre(nDi0, nMe0, nAn0, nDi1, nMe1, nAn1){
    var nRes = Math.max(0, nAn1 - nAn0 - 1);
    if (nAn1 != nAn0)
     if ((nMe1 > nMe0) || ((nMe1 == nMe0) && (nDi1 >= nDi0)))
      nRes++;
    return nRes;
   }

   function mesesEntre(nDi0, nMe0, nAn0, nDi1, nMe1, nAn1){
    var nRes;
    if ((nMe1 < nMe0) || ((nMe1 == nMe0) && (nDi1 < nDi0))) nMe1 += 12;
    nRes = Math.max(0, nMe1 - nMe0 - 1);
    if ((nDi1 > nDi0) && (nMe1 != nMe0)) nRes++;
    return nRes;
   }

   function diasEntre(nDi0, nMe0, nAn0, nDi1, nMe1, nAn1){
    var nRes;
    if (nDi1 < nDi0) nDi1 += finMes(nMe0, nAn0);
    nRes = Math.max(0, nDi1 - nDi0);
    return nRes;
   }

   function mayorOIgual(nDi0, nMe0, nAn0, nDi1, nMe1, nAn1){
    var bRes = false;
    bRes = bRes || (nAn1 > nAn0);
    bRes = bRes || ((nAn1 == nAn0) && (nMe1 > nMe0));
    bRes = bRes || ((nAn1 == nAn0) && (nMe1 == nMe0) && (nDi1 >= nDi0));
    return bRes;
   }

   function calcula(FechaDesde, FechaHasta){
	var sFc0 = FechaDesde.value; // se asume válida
	var sFc1 = FechaHasta.value; // Se asume válida

	var retorna = new Array();

    var nDi0 = parseInt(sFc0.substr(0, 2), 10);
    var nMe0 = parseInt(sFc0.substr(3, 2), 10);
    var nAn0 = parseInt(sFc0.substr(6, 4), 10);

    var nDi1 = parseInt(sFc1.substr(0, 2), 10);
    var nMe1 = parseInt(sFc1.substr(3, 2), 10);
    var nAn1 = parseInt(sFc1.substr(6, 4), 10);

    if (mayorOIgual(nDi0, nMe0, nAn0, nDi1, nMe1, nAn1)) {

     var nAno = anosEntre(nDi0, nMe0, nAn0, nDi1, nMe1, nAn1); //años
     var nMes = mesesEntre(nDi0, nMe0, nAn0, nDi1, nMe1, nAn1); //meses
     var nDia = diasEntre(nDi0, nMe0, nAn0, nDi1, nMe1, nAn1); //dias

     var nTtM = nAno * 12 + nMes; // total de meses
     var nTtD = nDia; // ugualdad de dias
     for (var i = nAn0; i < nAn0 + nAno; i++) nTtD += diasDelAno(nAno);
     for (var j = nMe0; j < nMe0 + nMes; j++) nTtD += finMes(j, nAn1);
     var nTSS = Math.floor(nTtD / 7); // semanas
     var nTSD = nTtD % 7;
     //document.frm.difDMA.value = String(nAno) + " años, " + String(nMes) + " meses, " + String(nDia) + " días";
     //document.frm.difDM.value = String(nTtM) + " meses, " + String(nDia) + " días";
     //document.frm.difD.value = String(nTtD) + " días";
     //document.frm.difSD.value = String(nTSS) + " semanas, " + String(nTSD) + " días";
	 retorna["dias"]=nTtD+1;
	 return retorna;
    } else alert("Error en rango");
   }

//-------------------------------------------------------------------------------------------------------------------------------------
function frm_entrar(elemento){ elemento.value=""; }

function frm_envir(elemento) { elemento.submit(); }

function enviar_formulario(para,valor) { 
window.location=para+"?accion="+valor;
}

function mayus(elemento) {elemento.value = elemento.value.toUpperCase(); }
function minus(elemento) {elemento.value = elemento.value.toLowerCase(); }
//-------------------------------------------------------------------------------------------------------------------------------------
function ocultar_mostrar(nombreCapa,valor){
//var ubi=document.getElementById('imagen_12').name;
	if ((valor=="No") || (valor=="no"))
	{
	document.getElementById(nombreCapa).style.visibility="hidden";
	document.getElementById(nombreCapa).style.position="absolute";
/*	document.getElementById('imagen_12').src="triangle.gif";
	document.getElementById('imagen_12').name="triangle";*/
	}
	else if ((valor=="Si") || (valor=="si"))
	{	
	document.getElementById(nombreCapa).style.visibility="visible";
	document.getElementById(nombreCapa).style.position="static";
/*	document.getElementById('imagen_12').src="opentriangle.gif";
	document.getElementById('imagen_12').name="opentriangle";*/
	}
	else
	{
	document.getElementById(nombreCapa).style.visibility="hidden";
	document.getElementById(nombreCapa).style.position="absolute";
/*	document.getElementById('imagen_12').src="triangle.gif";
	document.getElementById('imagen_12').name="triangle";*/
	}
}
//-------------------------------------------------------------------------------------------------------------------------------------
// ===================================================================
// Author: Matt Kruse <matt@mattkruse.com>
// WWW: http://www.mattkruse.com/
//
// NOTICE: You may use this code for any purpose, commercial or
// private, without any further permission from the author. You may
// remove this notice from your final code if you wish, however it is
// appreciated by the author if at least my web site address is kept.
//
// You may *NOT* re-distribute this code in any way except through its
// use. That means, you can include it in your product, or your web
// site, or any other form where the code is actually being used. You
// may not put the plain javascript up on your site for download or
// include it in your javascript libraries for download. 
// If you wish to share this code with others, please just point them
// to the URL instead.
// Please DO NOT link directly to my .js files from your site. Copy
// the files to your server and use them there. Thank you.
// ===================================================================

function hasOptions(obj){if(obj!=null && obj.options!=null){return true;}return false;}
function selectUnselectMatchingOptions(obj,regex,which,only){if(window.RegExp){if(which == "select"){var selected1=true;var selected2=false;}else if(which == "unselect"){var selected1=false;var selected2=true;}else{return;}var re = new RegExp(regex);if(!hasOptions(obj)){return;}for(var i=0;i<obj.options.length;i++){if(re.test(obj.options[i].text)){obj.options[i].selected = selected1;}else{if(only == true){obj.options[i].selected = selected2;}}}}}
function selectMatchingOptions(obj,regex){selectUnselectMatchingOptions(obj,regex,"select",false);}
function selectOnlyMatchingOptions(obj,regex){selectUnselectMatchingOptions(obj,regex,"select",true);}
function unSelectMatchingOptions(obj,regex){selectUnselectMatchingOptions(obj,regex,"unselect",false);}
function sortSelect(obj){var o = new Array();if(!hasOptions(obj)){return;}for(var i=0;i<obj.options.length;i++){o[o.length] = new Option( obj.options[i].text, obj.options[i].value, obj.options[i].defaultSelected, obj.options[i].selected) ;}if(o.length==0){return;}o = o.sort(
function(a,b){if((a.text+"") <(b.text+"")){return -1;}if((a.text+"") >(b.text+"")){return 1;}return 0;});for(var i=0;i<o.length;i++){obj.options[i] = new Option(o[i].text, o[i].value, o[i].defaultSelected, o[i].selected);}}
function selectAllOptions(obj){if(!hasOptions(obj)){return;}for(var i=0;i<obj.options.length;i++){obj.options[i].selected = true;}}

function moveSelectedOptions(from,to)
{
	if(arguments.length>3)
	{
		var regex = arguments[3];
		if(regex != "")
		{unSelectMatchingOptions(from,regex);}
	}
	if(!hasOptions(from))
	{return;}
	for(var i=0;i<from.options.length;i++)
	{
		var o = from.options[i];
		if(o.selected)
		{
			if(!hasOptions(to))
			{var index = 0;}
			else{var index=to.options.length;}
			to.options[index] = new Option( o.text, o.value, false, false);}}
			for(var i=(from.options.length-1);i>=0;i--)
			{var o = from.options[i];if(o.selected)
			{from.options[i] = null;}}
			if((arguments.length<3) ||(arguments[2]==true))
			{sortSelect(from);sortSelect(to);}
			from.selectedIndex = -1;to.selectedIndex = -1;
	}

function copySelectedOptions(from,to){var options = new Object();if(hasOptions(to)){for(var i=0;i<to.options.length;i++){options[to.options[i].value] = to.options[i].text;}}if(!hasOptions(from)){return;}for(var i=0;i<from.options.length;i++){var o = from.options[i];if(o.selected){if(options[o.value] == null || options[o.value] == "undefined" || options[o.value]!=o.text){if(!hasOptions(to)){var index = 0;}else{var index=to.options.length;}to.options[index] = new Option( o.text, o.value, false, false);}}}if((arguments.length<3) ||(arguments[2]==true)){sortSelect(to);}from.selectedIndex = -1;to.selectedIndex = -1;}
function moveAllOptions(from,to){selectAllOptions(from);if(arguments.length==2){moveSelectedOptions(from,to);}else if(arguments.length==3){moveSelectedOptions(from,to,arguments[2]);}else if(arguments.length==4){moveSelectedOptions(from,to,arguments[2],arguments[3]);}}
function copyAllOptions(from,to){selectAllOptions(from);if(arguments.length==2){copySelectedOptions(from,to);}else if(arguments.length==3){copySelectedOptions(from,to,arguments[2]);}}
function swapOptions(obj,i,j){var o = obj.options;var i_selected = o[i].selected;var j_selected = o[j].selected;var temp = new Option(o[i].text, o[i].value, o[i].defaultSelected, o[i].selected);var temp2= new Option(o[j].text, o[j].value, o[j].defaultSelected, o[j].selected);o[i] = temp2;o[j] = temp;o[i].selected = j_selected;o[j].selected = i_selected;}
function moveOptionUp(obj){if(!hasOptions(obj)){return;}for(i=0;i<obj.options.length;i++){if(obj.options[i].selected){if(i != 0 && !obj.options[i-1].selected){swapOptions(obj,i,i-1);obj.options[i-1].selected = true;}}}}
function moveOptionDown(obj){if(!hasOptions(obj)){return;}for(i=obj.options.length-1;i>=0;i--){if(obj.options[i].selected){if(i !=(obj.options.length-1) && ! obj.options[i+1].selected){swapOptions(obj,i,i+1);obj.options[i+1].selected = true;}}}}
function removeSelectedOptions(from){if(!hasOptions(from)){return;}if(from.type=="select-one"){from.options[from.selectedIndex] = null;}else{for(var i=(from.options.length-1);i>=0;i--){var o=from.options[i];if(o.selected){from.options[i] = null;}}}from.selectedIndex = -1;}
function removeAllOptions(from){if(!hasOptions(from)){return;}for(var i=(from.options.length-1);i>=0;i--){from.options[i] = null;}from.selectedIndex = -1;}
function addOption(obj,text,value,selected){if(obj!=null && obj.options!=null){obj.options[obj.options.length] = new Option(text, value, false, selected);}}
//-------------------------------------------------------------------------------------------------------------------------------------