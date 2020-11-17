<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($uri == "/") {
        postIndex();
    } elseif ($uri == "/show" and isset($_GET['id'])) {
        postShow();
    } elseif ($uri == "/create") {
        postCreate();
    } elseif ($uri == "/update" and isset($_GET['id'])) {
        postEdit();
    } elseif ($uri == "/delete" and isset($_GET['id'])) {
        postDestroy();
    } else {
        http_response_code(404);
        echo "<html><body>Page not found</body></html>";
        return;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($uri == "/") {
        postStore();
    } elseif ($uri == "/update" and isset($_GET['id'])) {
        postUpdate2();
    } elseif ($uri == "/create") {
        postCreate2();
    }
} else {
    http_response_code(405);
    echo "<html><body>Method not allowed</body></html>";
    return;
}
