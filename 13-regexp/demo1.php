<?php

echo $a = "abrikosasss (698) 123-4567"."\n"."bananas ananasas: +42";

$i = preg_match('/as/', $a);  
var_dump("i = $i");

$rezultatas = [];
$i = preg_match_all('/as/', $a, $rezultatas, PREG_OFFSET_CAPTURE);  
var_dump("i = $i", $rezultatas);


echo <<<'EOT'
Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Donec suscipit ante eu suscipit dignissim. Nulla facilisi. 
Donec tincidunt non ligula vel mattis. Phasellus a aliquam diam. 
Ut est sem, vestibulum nec semper ut, pulvinar vel justo. 
In id ornare mi.
EOT;

// echo '<pre>';
// echo $a;
// echo '</pre>';
