<?php
declare(strict_types = 1);

namespace WIT\FullStackBootcamp\Blog\Controller;

use WIT\FullStackBootcamp\Blog\Repository;
use WIT\FullStackBootcamp\Common;
use Symfony\Component\HttpFoundation\Response;

class Posts implements Common\Controller
{
    /**
     * @var Common\View
     */
    private $view;

    /**
     * @var Repository\Posts
     */
    private $postsRepository;

    /**
     * @param Common\View $view
     * @param Repository\Posts $postsRepository
     */
    public function __construct(Common\View $view, Repository\Posts $postsRepository)
    {
        $this->view = $view;
        $this->postsRepository = $postsRepository;
    }

    public function run(): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/html; charset=UTF-8');
        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent($this->view->get(
            'Blog'
            . \DIRECTORY_SEPARATOR
            . 'View'
            . \DIRECTORY_SEPARATOR
            . 'posts.twig',
            [
                'posts' => $this->getPosts(1, 10)
            ]
        ));

        return $response;
    }

    private function getPosts(): array
    {
        $posts = [
            ["id" => "1", 
            "title" => "Jak efektywnie uczyć się programowania?", 
            "preamble" => "tekst 1. Norwegia, urzędowo Królestwo Norwegii – państwo w Europie Północnej będące monarchią konstytucyjną, którego terytorium obejmuje zachodnią i północną część Półwyspu Skandynawskiego, Jan Mayen, Svalbard, Wyspę Bouveta i Lofoty. Ma łączną powierzchnię 385 207 km² i liczy 5 165 802 mieszkańców. Graniczy ze Szwecją niemal na całej długości granicy; znacznie krótsze odcinki oddzielają Norwegię od Finlandii i Rosji. Kraj ma również granicę morską przez cieśninę Skagerrakz  Danią. Stolicą Norwegii jest Oslo. Długa, licząca ponad 20 tys. kilometrów linia brzegowa znana jest z charakterystycznych zatok, tzw. fiordów. Nazwa kraju pochodzi od staronordyckiego nord vegen", 
            "url" => "",
            "date" => "12-08-2020"], 

            ["id" => "2", 
            "title" => "Podstawy języka JavaScript", 
            "preamble" => "tekst 2", 
            "url" => "",
            "date" => "13-08-2020"], 

            ["id" => "3", 
            "title" => "Podstawy języka PHP", 
            "preamble" => "tekst 3", 
            "url" => "",
            "date" => "14-08-2020"]
        ];

        return $posts;
    }
}
