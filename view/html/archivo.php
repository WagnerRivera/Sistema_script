<?php

$xml = new DomDocument('1.0', 'ISO-8859-1');
 
$biblioteca = $xml->createElement('biblioteca');
$biblioteca = $xml->appendChild($biblioteca);
//$salto	= $xml->createTextNode("\n");
//$salto	= $xml->appendChild($salto);


$libro = $xml->createElement('libro');
$libro = $biblioteca->appendChild($libro);
 
// Agregar un atributo al libro
$libro->setAttribute('seccion', 'favoritos');

$autor = $xml->createElement('autor','Paulo Coelho');
$autor = $libro->appendChild($autor);

$titulo = $xml->createElement('titulo','El Alquimista');
$titulo = $libro->appendChild($titulo);

$anio = $xml->createElement('anio','1988');
$anio = $libro->appendChild($anio);

$editorial = $xml->createElement('editorial','Maxico D.F. - Editorial Grijalbo');
$editorial = $libro->appendChild($editorial);

$xml->formatOutput = true;
$el_xml = $xml->saveXML();
$xml->save('RND.xml');

//Mostramos el XML puro
//echo "<p><b>El XML ha sido creado.... Mostrando en texto plano:</b></p>".
    // htmlentities($el_xml)."<br/><hr>";

?>