<?php

class AuthorUserModel{

    private $conn;

    public function __construct($db){

        $this->conn = $db;

    }


    public function getUser(

        $userId

    ){

        $sql = "SELECT *

                FROM users

                WHERE id=?";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "i",

            $userId

        );


        $stmt->execute();

        return $stmt->get_result();

    }



    public function updateProfile(

        $userId,
        $name,
        $bio,
        $profilePic,
        $socialLinks

    ){

        $sql = "UPDATE users

                SET name=?,
                bio=?,
                profile_pic=?,
                social_links=?

                WHERE id=?";


        $stmt =
        $this->conn->prepare($sql);


        $stmt->bind_param(

            "ssssi",

            $name,
            $bio,
            $profilePic,
            $socialLinks,
            $userId

        );


        return $stmt->execute();

    }

}

?>