<?php

require __DIR__.'/../vendor/autoload.php';

$reflector = new Mirror('DataConnection');
$reflector->initialClassIdentification();
$reflector->readComments();
$reflector->tell();