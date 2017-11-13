<?php
// Enable user error handling
libxml_use_internal_errors(true);

$doc = new DOMDocument();
$doc->load('knygos.xml');

if (!$doc->schemaValidate('knygos.xsd')) {
    print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    echo "OK";
}
