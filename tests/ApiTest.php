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
        $this->assertNotEmpty($characters);        
        $this->assertContains('Vista', $characters);
    }
}
