<?php

use Lorenzo\OssOnepiece\Api;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class ApiTest extends TestCase
{
    public function testGetAllCharacters()
    {
        $client = HttpClient::create();
        $api = new Api($client);
        $characters = $api->getAllCharacters();
        // foreach ($characters as $group => $marines) {
        //     echo "Groupes: $group\n";
        //     echo "Marine:\n";
        //     foreach ($marines as $marine) {
        //         echo "- $marine\n";
        //     }
        //     echo "\n";
        // }    
    }
}
