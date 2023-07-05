<?php   

declare(strict_types=1);

namespace Lorenzo\OssOnepiece;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Api
{
    private HttpClientInterface $client;
    public function __construct( HttpClientInterface $client) 
    {
        $this->client = $client;
    }

    public function getAllCharacters(): array
    {
        $response = $this->client->request(
            'GET',
            'https://onepiece.fandom.com/fr/wiki/Cat%C3%A9gorie:Personnages_de_Marineford'
        );

        $content = $response->getContent();

        $crawler = new Crawler($content);

        $crawler = $crawler->filter('.category-page__member-link');

        $names = [];

        foreach ($crawler as $domElement) {
            $names[] = $domElement->textContent;
        }
        return $names;
    }
}

?>