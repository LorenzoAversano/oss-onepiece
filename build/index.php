<?php 

use Lorenzo\OssOnepiece\Api;
use Symfony\Component\HttpClient\HttpClient;


require_once __DIR__ . '/../vendor/autoload.php';

$client = Symfony\Component\HttpClient\HttpClient::create();
$api = new Api($client);
var_dump($api->getAllCharacters());