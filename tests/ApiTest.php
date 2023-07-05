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
        // Affichage des personnages par lettre
        foreach ($characters as $letter => $characters) {
            echo "Lettre : $letter\n";
            echo "Personnages : " . implode(', ', $characters) . "\n\n";
        }
    }
}
