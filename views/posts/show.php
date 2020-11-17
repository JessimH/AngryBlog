<?php $title = "My blog"; ?>

<?php ob_start(); ?>
<a class="back" href="/">←</a>

<h1><?= $post->title ?></h1>
<p><em><?= $post->created_at ?></em></p>

<p><?= $post->body ?></p>
<?php $content = ob_get_clean(); ?>

<?php require __DIR__ . "/../layouts/default.php"; ?>