<?php

class ArticleModel{

    private $conn;


    public function __construct($db){

        $this->conn = $db;

    }



    // Get all articles

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



    // Filter by status

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



    // Create article

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



    // Get one article

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



    // Restore body from revision

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



    // Update article

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



    // Submit article for editor review

    public function submitArticle(

        $articleId

    ){

        $sql = "UPDATE articles

                SET status='submitted',
                editor_feedback=NULL

                WHERE id=?";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "i",

            $articleId

        );


        return $stmt->execute();

    }



    // Unpublish article

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

    public function searchArticles(

    $authorId,
    $keyword

){

    $keyword = "%" . $keyword . "%";

    $sql = "SELECT *

            FROM articles

            WHERE author_id=?
            AND title LIKE ?

            ORDER BY created_at ASC";


    $stmt =
    $this->conn->prepare($sql);


    $stmt->bind_param(

        "is",

        $authorId,
        $keyword

    );


    $stmt->execute();

    return $stmt->get_result();

}

public function getAnalytics(

    $articleId

){

    $sql = "

    SELECT

    a.view_count,

    (
        SELECT COUNT(*)

        FROM article_likes

        WHERE article_id=?
    )

    AS totalLikes,


    (
        SELECT COUNT(*)

        FROM comments

        WHERE article_id=?
    )

    AS totalComments


    FROM articles a

    WHERE a.id=?

    ";


    $stmt =
    $this->conn->prepare($sql);


    $stmt->bind_param(

        "iii",

        $articleId,
        $articleId,
        $articleId

    );


    $stmt->execute();

    return $stmt->get_result();

}

}

?>