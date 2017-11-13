<?php
// Enable user error handling
libxml_use_internal_errors(true);

$xmlData = <<<'EOD'
<?xml version="1.0" encoding="UTF-8" ?>
<knygos>  
  <knyga>    
    <autorius>Jules Gabriel Verne</autorius>    
    <pavadinimas kalba="lt">Aplink pasaulį per 80 dienų</pavadinimas>    
    <metai>1873</metai>    
    <orginalas kalba="fr">Le Tour du Monde en quatre-vingts jours</orginalas>  
  </knyga>  
  <knyga>    
    <autorius>Jules Gabriel Verne</autorius>    
    <pavadinimas kalba="lt">20000 mylių po vandeniu</pavadinimas>    
    <metai>1869</metai>    
    <orginalas kalba="fr">Vingt mille lieues sous les mers</orginalas>  
  </knyga>
</knygos>
EOD;

$xml = simplexml_load_string($xmlData);
if ($xml === false) {
  echo "Failed loading XML: ";
  foreach(libxml_get_errors() as $error) {
    echo "<br>", $error->message;
  }
} else {
  var_dump($xml);
}
