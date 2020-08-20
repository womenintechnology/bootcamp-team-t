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

      $dsn = "mysql:dbname=bootcamp;host=db";
      $user = "bootcamp";
      $password = "Bootcamp123!";
      try {
          $db = new \PDO($dsn, $user, $password);
      } catch (\PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
      }
        // $sql = "select * from Posts where author_id=:author_id";
        // $params = ["author_id => 1"];
        // $stmt = $db->prepare($sql);
        // $stmt->execute($params);
        // $data = $stmt->fetchAll();

        // $sql = "select * from Posts where id=:id";
        // $params = ["id" => 1];
        // $stmt = $db->prepare($sql);
        // $stmt->execute($params);
        // $data = $stmt->fetchAll();
        // echo $data[0]["id"];

        // $sql = "update Posts title=:title where id=:id";
        // $params = ["id" => 1, "title" =>"blablabla"];
        // $stmt = $db->prepare($sql);
        // $stmt->execute($params);
        // // $data = $stmt->execute();
        // // echo $data;

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
// poniżej wstawiłam swój kod
    private function getPosts(): array
    {
        // return [
        //     ["id" => "1", 
        //     "title" => "Jak efektywnie uczyć się programowania?", 
        //     "preamble" => "tekst 1",
        //     "url" => "https://i.picsum.photos/id/1/5616/3744.jpg?hmac=kKHwwU8s46oNettHKwJ24qOlIAsWN9d2TtsXDoCWWsQ",
        //     "date" => "12-08-2020"],
        //     ["id" => "2", 
        //     "title" => "Podstawy języka JavaScript", 
        //     "preamble" => "tekst 2", 
        //     "url" => "https://i.picsum.photos/id/180/2400/1600.jpg?hmac=Ig-CXcpNdmh51k3kXpNqNqcDYTwXCIaonYiBOnLXBb8",
        //     "date" => "13-08-2020"],
        //     ["id" => "3", 
        //     "title" => "Podstawy języka PHP", 
        //     "preamble" => "tekst 3", 
        //     "url" => "https://i.picsum.photos/id/2/5616/3744.jpg?hmac=l1XcSPFigtRLcO2F6Li-t17EIeylkWH94Oowb4vzApk", 
        //     "date" => "14-08-2020"]
        // ];
        return $this->postsRepository->getList();
    }
}
