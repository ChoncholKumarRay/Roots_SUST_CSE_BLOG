<?php

//Get All Post
function getAllPost($pdo)
{
    $query = "SELECT * FROM post ORDER BY created_at DESC;";
    $statement = $pdo->prepare($query);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $posts = $statement->fetchAll();
        return $posts;
    } else {
        return 0;
    }
}

function getCreatorInfo($pdo, $user_id)
{
    $query = "SELECT * FROM users WHERE user_id = $user_id;";
    $statement = $pdo->prepare($query);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $creator = $statement->fetch();
        return $creator;
    } else {
        return 0;
    }
}
