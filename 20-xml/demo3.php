<?php
// Enable user error handling
libxml_use_internal_errors(true);

$doc = new DOMDocument();

// $root = $doc->createElement('knygos');
// $doc->appendChild($root);

// $knyga1 = $doc->createElement('knyga');
// $root->appendChild($knyga1);

// $knyga2 = $doc->createElement('knyga');
// $root->appendChild($knyga2);

// $autorius = $doc->createElement('autorius');
// $autorius_text = $doc->createTextNode('Jules Gabriel Verne');
// $autorius->appendChild($autorius_text);
// $autorius->setAttribute( "language", "fr" );
// $knyga2->appendChild($autorius);
// $knyga1->appendChild($autorius);

$servername = 'localhost';
$dbname = 'Auto';
$username = 'Auto';
$password = 'LabaiSlaptas123';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Nepavyko prisjungti: ' . $conn->connect_error);
}

$sql = 'SELECT *, `distance`/`time`*3.6 as `speed` FROM radars ORDER BY number, date DESC LIMIT 1000';

$result = $conn->query($sql);

$root = $doc->createElement('radars');
$doc->appendChild($root);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $radar = $doc->createElement('radar');
        $root->appendChild($radar);

        $radar->appendChild(addXMLNode($doc, 'id', $row['id']));
        $radar->appendChild(addXMLNode($doc, 'number', $row['number']));
        $radar->appendChild(addXMLNode($doc, 'distance', $row['distance']));
        $radar->appendChild(addXMLNode($doc, 'time', $row['time']));
        $radar->appendChild(addXMLNode($doc, 'speed', $row['speed']));
        $radar->appendChild(addXMLNode($doc, 'driverId', $row['driverId']));
    }
}

$xml = $doc->saveXML();

header('Content-Type: text/xml');
echo $xml;

function addXMLNode($doc, $name, $value)
{
    $element = $doc->createElement($name);
    $element_text = $doc->createTextNode($value);
    $element->appendChild($element_text);
    return $element;
}