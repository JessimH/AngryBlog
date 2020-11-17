<?php $title = "My blog"; ?>

<?php ob_start(); ?>
<a class="back" href="/">←</a>
<button class="darkmode"><span>🌗</span> <span id="hand">👈</span> <span>☀️</span></button>

<h2><?= isset($_GET['id']) ? 'Modification' : 'Ajout' ?> d'articles</h2>

<?php if (!empty($_SESSION['error'])) : ?>
    <div class="error"><?= $_SESSION['error'] ?></div>
<?php endif ?>

<form class="form" action="<?= isset($post) || (isset($_SESSION['old']) && isset($_GET['update'])) ? 'update?id=' . $_GET['id'] : '' ?> " method="post">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?= isset($post) && !empty($post) ? $post->title : '' ?>">

    <br><br>

    <?php if (isset($post) && !empty($post)) : ?>
        <p>Dernière modification <?= $post->created_at ?></p>
    <?php endif; ?>

    <label for=" body">Body</label>
    <textarea cols="50" rows="5" name="body" id="body"><?= isset($post) && !empty($post) ? $post->body : '' ?></textarea>

    <br><br>

    <input class="submit" type="submit" value="Enregistrer" />
</form>

<?php $content = ob_get_clean(); ?>

<?php require __DIR__ . "/../layouts/default.php"; ?>