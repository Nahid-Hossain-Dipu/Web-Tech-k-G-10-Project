<?php

class ArticleModel{

    private $conn;

    public function __construct($db){

        $this->conn = $db;

    }

    public function createArticle(

        $authorId,
        $categoryId,
        $seriesId,
        $title,
        $slug,
        $body,
        $excerpt,
        $featuredImagePath,
        $status

    ){

        $sql = "INSERT INTO articles(

            author_id,
            category_id,
            series_id,
            title,
            slug,
            body,
            excerpt,
            featured_image_path,
            status

        )

        VALUES(?,?,?,?,?,?,?,?,?)";


        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(

            "iiissssss",

            $authorId,
            $categoryId,
            $seriesId,
            $title,
            $slug,
            $body,
            $excerpt,
            $featuredImagePath,
            $status
        );

        return $stmt->execute();

    }

}
?>