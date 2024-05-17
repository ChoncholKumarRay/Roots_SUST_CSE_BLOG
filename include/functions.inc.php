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


function formatDateTime($datetimeString)
{
    $datetime = new DateTime($datetimeString);
    $formattedDateTime = $datetime->format('F d, Y \a\t g:i A');

    return $formattedDateTime;
}


function isLikedByUserID($pdo, $post_id, $user_id)
{
    $query = "SELECT * FROM post_like WHERE post_id=:post_id AND user_id=:viewer;";
    $statement = $pdo->prepare($query);
    $statement->bindParam(":post_id", $post_id);
    $statement->bindParam(":viewer", $user_id);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        return 1;
    } else {
        return 0;
    }
}

function likeCountByPostID($pdo, $post_id)
{
    $query = "SELECT * FROM post_like WHERE post_id=:post_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(":post_id", $post_id);
    $statement->execute();

    return $statement->rowCount();
}

function commentCountByPostID($pdo, $post_id)
{
    $query = "SELECT * FROM comment WHERE post_id=:post_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(":post_id", $post_id);
    $statement->execute();

    return $statement->rowCount();
}
