#!/usr/bin/env php

<?php

require 'vendor/autoload.php';


use GuzzleHttp\Client;
use Alura\BuscadorDeCursos\Buscador;
use Symfony\Component\DomCrawler\Crawler;


$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$courses = $buscador->buscar('/cursos-online-programacao/php');


foreach ($courses as $course) {
    exibeMensagem($course);
}


