<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $httpClient;
    /**
     * @var Crawler
     */
    private Crawler $crawler;
    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        // Lógica de busca de cursos
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url)
    {
        $response = $this->httpClient->request('GET', $url);
        $html = $response->getBody();
        $this->crawler->addHtmlContent($html);

        $elementsCourses = $this->crawler->filter('span.card-curso__nome');
        $courses = [];
        foreach ($elementsCourses as $element) {
            $courses[] = $element->textContent;
        }
        return $courses;
    }
}
