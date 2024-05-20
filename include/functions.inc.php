<?php


//-------------Functions for user & others-------------------------
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

//---------------Functions for Post-------------------------
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

function getPostbyID($pdo, $post_id)
{
    $query = "SELECT * FROM post WHERE post_id = :post_id;";
    $statement = $pdo->prepare($query);
    $statement->bindParam(":post_id", $post_id);
    $statement->execute();

    if ($statement->rowCount() == 1) {
        $post = $statement->fetch();
        return $post;
    } else {
        return 0;
    }
}

//--------------------Functions for Like----------------------

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


//----------------------Functions for Comments----------------

function commentCountByPostID($pdo, $post_id)
{
    $query = "SELECT * FROM comment WHERE post_id=:post_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(":post_id", $post_id);
    $statement->execute();

    return $statement->rowCount();
}

function getCommentsByPostID($pdo, $post_id)
{
    $query = "SELECT * FROM comment WHERE post_id=? ORDER BY comment_id desc";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$post_id]);

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}
