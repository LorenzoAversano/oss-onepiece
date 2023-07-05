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
     * @return character[]
     */
    public function getAllMarines(): array
    {
        $response = $this->client->request(
            'GET',
            'https://onepiece.fandom.com/fr/wiki/Cat%C3%A9gorie:Personnages_de_Marineford'
        );

        $crawler = new Crawler($response->getContent());
        $groupDatas = $crawler->filter('.category-page__first-char');
        $characters = [];

        $groupDatas->each(function (Crawler $groupData) use (&$characters) {
            $group = $groupData->text();
            $characters[$group] = $this->extractCharactersFromGroup($groupData);
        });

        return $characters;
    }

    /**
     * @return character[]
     */
    private function extractCharactersFromGroup(Crawler $groupCrawler): array
    {
        $characterDatas= $groupCrawler->nextAll()->filter('.category-page__member-link');
        $characters = $characterDatas->each(function (Crawler $characterData) {
            return $characterData->text();
        });

        return $characters;
    }
}

