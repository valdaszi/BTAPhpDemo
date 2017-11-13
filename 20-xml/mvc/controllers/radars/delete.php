<?php

require_once $dir . '/models/radars.php';

$id = $_REQUEST['id'];
echo "AHA - nori kazkas istrinti  irasa: $id";

$a = Radar::get($id);

include $dir . '/views/radars/ask_delete.php';
