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



    // Filter articles by status

public function filterArticles(

    $authorId,
    $status

){

    $sql = "SELECT *

            FROM articles

            WHERE author_id=?
            AND status=?

            ORDER BY created_at ASC";


    $stmt =
    $this->conn->prepare($sql);


    $stmt->bind_param(

        "is",

        $authorId,
        $status

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
        $tags,
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
        tags,
        featured_image_path,
        status

        )

        VALUES(?,?,?,?,?,?,?,?,?,?,?)";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "iiiisssssss",

            $authorId,
            $editorId,
            $categoryId,
            $seriesId,
            $title,
            $slug,
            $body,
            $excerpt,
            $tags,
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



    // Update body only (used by restore revision)

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
        $tags,
        $featuredImagePath,
        $status

    ){

        $sql = "UPDATE articles

                SET title=?,
                body=?,
                excerpt=?,
                tags=?,
                featured_image_path=?,
                status=?

                WHERE id=?";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "ssssssi",

            $title,
            $body,
            $excerpt,
            $tags,
            $featuredImagePath,
            $status,
            $articleId

        );

        return $stmt->execute();

    }


}


    public function unpublishArticle(

    public function unpublishArticle(

    $articleId

){

    $sql = "UPDATE articles

            SET status='unpublished'

            WHERE id=?";


    $stmt =
    $this->conn->prepare($sql);


    $stmt->bind_param(

        "i",

        $articleId

    );

    return $stmt->execute();

}

public function submitArticle(


    $articleId

){

    $sql = "UPDATE articles

            SET status='unpublished'

            SET status='submitted'


            WHERE id=?";


    $stmt =
    $this->conn->prepare($sql);


    $stmt->bind_param(

        "i",

        $articleId

    );

    return $stmt->execute();

}

public function submitArticle(

    $articleId

){

    $sql = "UPDATE articles

            SET status='submitted'

            WHERE id=?";


    $stmt =
    $this->conn->prepare($sql);


    $stmt->bind_param(

        "i",

        $articleId

    );

    return $stmt->execute();

}

}


?>