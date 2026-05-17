<?php

class RevisionModel{

    private $conn;


    public function __construct($db){

        $this->conn = $db;

    }


    // Save revision

    public function saveRevision(

        $articleId,
        $authorId,
        $bodySnapshot

    ){

        $sql = "INSERT INTO article_revisions(

        article_id,
        author_id,
        body_snapshot

        )

        VALUES(?,?,?)";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "iis",

            $articleId,
            $authorId,
            $bodySnapshot

        );


        return $stmt->execute();

    }



    // Get revision history

    public function getRevisions(

        $articleId

    ){

        $sql = "SELECT *

                FROM article_revisions

                WHERE article_id=?

                ORDER BY saved_at DESC";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "i",

            $articleId

        );


        $stmt->execute();

        return $stmt->get_result();

    }



    // Get one revision

    public function getRevision(

        $revisionId

    ){

        $sql = "SELECT *

                FROM article_revisions

                WHERE id=?";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "i",

            $revisionId

        );


        $stmt->execute();

        return $stmt->get_result();

    }

}

?>