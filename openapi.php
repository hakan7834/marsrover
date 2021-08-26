<?php
if(empty($argv[1])) {

    echo "Please enter version number \"php openapi.php 1\"";

    exit;

}

$version = $argv[1];

if(!file_exists('app/Controllers/v'.$version)) {

    echo "Version 1 can not be found";

    exit;

}

require("vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(['app/Controllers/v'.$version]);

header('Content-Type: application/json');

$json =  $openapi->toJson();

mkdir('public/swagger/v'.$version, 0777, true);

$f = fopen('public/swagger/v'.$version.'/swagger.json', 'w');

fwrite($f, $json);

fclose($f);

echo $json;