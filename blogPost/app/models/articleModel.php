<?php

class ArticleModel{

    private $conn;

    public function __construct($db){

        $this->conn = $db;

    }

    // Get all articles of one author

public function getAllArticles(

    $authorId

){

    $sql = "SELECT *

            FROM articles

            WHERE author_id=?

            ORDER BY created_at ASC";


    $stmt =
    $this->conn->prepare($sql);


    $stmt->bind_param(

        "i",

        $authorId

    );


    $stmt->execute();

    return $stmt->get_result();

}


    // Create Article

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

        $editorId = NULL;

        $sql = "INSERT INTO articles(

        author_id,
        editor_id,
        category_id,
        series_id,
        title,
        slug,
        body,
        excerpt,
        featured_image_path,
        status

        )

        VALUES(?,?,?,?,?,?,?,?,?,?)";


        $stmt = $this->conn->prepare($sql);


        $stmt->bind_param(

            "iiiissssss",

            $authorId,
            $editorId,
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



    // Get Single Article

    public function getArticle(

        $articleId

    ){

        $sql = "SELECT *

                FROM articles

                WHERE id=?";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "i",

            $articleId

        );


        $stmt->execute();

        return $stmt->get_result();

    }



    // Update Article Body

    public function updateArticleBody(

        $articleId,
        $body

    ){

        $sql = "UPDATE articles

                SET body=?

                WHERE id=?";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "si",

            $body,
            $articleId

        );


        return $stmt->execute();

    }

// Update Article

public function updateArticle(

    $articleId,
    $title,
    $body,
    $excerpt,
    $status

){

    $sql = "UPDATE articles

            SET title=?,
                body=?,
                excerpt=?,
                status=?

            WHERE id=?";


    $stmt =
    $this->conn->prepare($sql);


    $stmt->bind_param(

        "ssssi",

        $title,
        $body,
        $excerpt,
        $status,
        $articleId

    );


    return $stmt->execute();

}

}

?>  