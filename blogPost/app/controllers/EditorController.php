<?php

class EditorController
{


    function dashboard()
    {

        $article =
            new Article();

        $data = [

            "submitted" =>

            mysqli_fetch_assoc(

                $article
                    ->getSubmittedCount()

            ),

            "approved" =>

            mysqli_fetch_assoc(

                $article
                    ->getApprovedCount()

            ),

            "scheduled" =>

            mysqli_fetch_assoc(

                $article
                    ->getScheduledCount()

            ),

            "published" =>

            mysqli_fetch_assoc(

                $article
                    ->getPublishedCount()

            )

        ];

        return $data;
    }



    function queue()
    {

        $article =
            new Article();

        return
            $article
            ->getQueueArticles();
    }



    function review($id)
    {

        $article =
            new Article();

        return
            $article
            ->getArticleById(
                $id
            );
    }



    function updateStatus(
        $id,
        $status,
        $feedback
    ) {

        $article =
            new Article();

        return
            $article
            ->updateArticleStatus(

                $id,

                $status,

                $feedback

            );
    }
    function tags($id)
    {

        $article =
            new Article();

        return
            $article
            ->getTags(
                $id
            );
    }
}
