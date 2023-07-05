<?php   

declare(strict_types=1);

namespace Lorenzo\OssOnepiece;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Api
{
    private HttpClientInterface $client;
    
    public function __construct(HttpClientInterface $client) 
    {
        $this->client = $client;
    }

    /**
     * @return string[]
     */
    public function getAllCharacters(): array
    {
        $response = $this->client->request(
            'GET',
            'https://onepiece.fandom.com/wiki/Marines'
        );
    
        $content = $response->getContent();
        $crawler = new Crawler($content);
        $groupElements = $crawler->filter('.MarinesColors tbody tr th div span');
        $characters = [];

        foreach ($groupElements as $groupElement) {
            $group = $groupElement->textContent;
            $marines = $this->extractMarinesFromElement(new Crawler($groupElement));

            if (strlen($group) > 2) {
                $characters[$group] = $marines;
            }
        }

        return $characters;
    }

    // private function extractMarinesFromElement(Crawler $crawler): array
    // {
    //     $marines = [];
    //     $marinesElements = $crawler->filter('.MarinesColors tr td a small');
    
    //     foreach ($marinesElements as $marineElement) {
    //         $marines[] = $marineElement->textContent;
    //     }
    
    //     return $marines;
    // }
}

?>
