<?php

use Carbon\Carbon;

function getAllPosts()
{
    $db = dbConnect();
    $statement = $db->query('SELECT id, title, DATE_FORMAT(created_at, "%d/%m/%Y") as created_at_fr FROM posts');
    return $statement->fetchAll(PDO::FETCH_OBJ);
}

function getPostById()
{
    $db = dbConnect();
    $statement = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $statement->execute(['id' => $_GET['id']]);
    $post = $statement->fetchObject();
    if ($post) {
        $post->created_at = ucfirst(Carbon::parse($post->created_at, 'Europe/Paris')->locale('fr_FR')->diffForHumans());
    }
    return $post;
}

function deletePost($id)
{
    $db = dbConnect();

    $query = $db->prepare('DELETE FROM posts WHERE id = ?');
    $result = $query->execute(
        [
            $id,
        ]
    );
    return $result;
}

function postUpdate($id, $informations)
{
    $db = dbConnect();
    $query = $db->prepare('UPDATE posts SET title = ?, body = ?, updated_at = ? WHERE id = ?');
    $result = $query->execute(
        [
            $informations['title'],
            $informations['body'],
            Carbon::now('Europe/Paris'),
            $id
        ]
    );

    return $result;
}

function addPost()
{
    $db = dbConnect();

    $query = $db->prepare('INSERT INTO posts (title, body) VALUES (?, ?)');
    $result = $query->execute(
        [
            $_POST['title'],
            $_POST['body'],
        ]
    );

    return $result;
}
