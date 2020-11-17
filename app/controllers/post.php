<?php

function postIndex()
{
    $posts = getAllPosts();
    view('posts/index.php', compact('posts'));
}

function postShow()
{
    if (empty($_GET['id'])) {
        http_response_code(400);
        echo "<html><body>Bad request</body></html>";
        return;
    }

    $post = getPostById($_GET['id']);

    if (!$post) {
        http_response_code(404);
        echo "<html><body>Post not found</body></html>";
        return;
    }

    view('posts/show.php', compact('post'));
}


function postStore()
{
    if (empty($_POST['title'])) {
        $_SESSION['error'] = "Le champ titre est obligatoire !";
        $_SESSION['old'] = $_POST;
        header('Location: /create');
        return;
    }
    $_SESSION['success'] = "L'article {$_POST['title']} a bien été créé ✅";
    header('Location: /');
    return;
}

function postDestroy()
{
    if (empty($_GET['id'])) {
        http_response_code(400);
        echo "<html><body>Bad request</body></html>";
        return;
    }

    $post = getPostById($_GET['id']);

    if (!$post) {
        http_response_code(404);
        echo "<html><body>Post not found</body></html>";
        return;
    }

    $result = deletePost($_GET['id']);
    $posts = getAllPosts();

    $_SESSION['success'] = "L'article à bien été supprimé ✅";

    view('posts/index.php', compact('posts'));
}

function postCreate()
{
    view('posts/form.php');
}

function postCreate2()
{
    $posts = getAllPosts();

    if (empty($_POST['title']) || empty($_POST['body'])) {

        if (empty($_POST['title'])) {
            $_SESSION['error'] = 'Le champ title est obligatoire';
        }
        if (empty($_POST['body'])) {
            $_SESSION['error'] = 'Le champ body est obligatoire';
        }

        $_SESSION['old'] = $_POST;
        header('Location: /create');
        exit;
    } else {
        $posts = getAllPosts();
        $result = addPost($_POST);

        if ($result) {
            $_SESSION['success'] = "L'article {$_POST['title']} à bien été enregistré ✅";
        } else {
            $_SESSION['error'] = 'Erreur lors de la mise à jour...';
        }
        header('Location: /');
        exit;
    }
}

function postEdit()
{
    if (empty($_GET['id'])) {
        http_response_code(400);
        echo "<html><body>Bad request</body></html>";
        return;
    }

    $post = getPostById($_GET['id']);

    if (!$post) {
        http_response_code(404);
        echo "<html><body>Post not found</body></html>";
        return;
    }

    view('posts/form.php', compact('post'));
}

function postUpdate2()
{
    postUpdate($_GET['id'], $_POST);

    if (empty($_POST['title']) || empty($_POST['body'])) {

        if (empty($_POST['title'])) {
            $_SESSION['error'] = 'Le champ title est obligatoire';
        }
        if (empty($_POST['body'])) {
            $_SESSION['error'] = 'Le champ body est obligatoire';
        }

        $_SESSION['old'] = $_POST;
        header('Location: update?id=' . $_GET['id']);
        exit;
    } else {
        $result = postUpdate($_GET['id'], $_POST);

        if ($result) {
            $_SESSION['success'] = 'Article mis à jour !';
        } else {
            $_SESSION['error'] = 'Erreur lors de la mise à jour...';
        }
        $_SESSION['success'] = "L'article {$_POST['title']} a bien été modifié ✅";
        header('Location: /');
        return;
    }
}
