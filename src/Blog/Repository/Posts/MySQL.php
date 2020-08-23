<?php
declare(strict_types = 1);

namespace WIT\FullStackBootcamp\Blog\Repository\Posts;

use WIT\FullStackBootcamp\Blog\Repository\Posts;
use WIT\FullStackBootcamp\Blog\Model;

class MySQL implements Posts
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var \DateTimeZone
     */
    private $timezone;

    /**
     * @param PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->timezone = new \DateTimeZone('Europe/Warsaw');
    }

    public function getList(int $page = 1, int $postsPerPage = 10): array
    {
        return [];
    }

    public function getOne(int $id): ?Model\PostView
    {   $sql = "SELECT id, title,published, author_id from Posts where id = ".$id.";";
        $stmt = $this->pdo->query($sql);
        $data = $stmt -> fetchAll();

        return empty($row) ? null : $this->createModel($row);
    }

    private function createModel(array $row): Model\PostView
    {
        return new Model\PostView(
            (int) $row['id'],
            $row['title'],
            substr($row['content'], 0 ,100),
            $row['content'],
            new \DateTime($row['published'], $this->timezone),
            new Model\AuthorView(
                (int) $row['author_id'],
                $row['author_forename'],
                $row['author_surname'],
                $row['author_email']
            )
        );
    }
}
