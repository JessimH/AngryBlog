<?php
session_start();

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

require __DIR__ . "/../app/router.php";

if (isset($_SESSION['messages'])) {
    unset($_SESSION['messages']);
}
if (isset($_SESSION['old_inputs'])) {
    unset($_SESSION['old_inputs']);
}
