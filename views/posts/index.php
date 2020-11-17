<?php $title = "My blog"; ?>

<?php ob_start(); ?>
<?php if (!empty($_SESSION['success'])) : ?>
    <div class="success"><?= $_SESSION['success'] ?></div>
<?php endif ?>
<?php if (!empty($_SESSION['error'])) : ?>
    <div class="error"><?= $_SESSION['error'] ?></div>
<?php endif ?>

<div class="btns-head">
    <a class="add" href="/create"> <span class="plus"> + </span>Balance tes secrets !</a>
    <button class="darkmode"><span>🌗</span> <span id="hand">👈</span> <span>☀️</span></button>
</div>

<ul>
    <?php foreach ($posts as $post) : ?>
        <li>
            <a class="link" href="/show?id=<?= $post->id ?>"><?= $post->created_at_fr ?> - <?= $post->title ?></a>
            <div class="btns">
                <a class="delete" href="/delete?id=<?= $post->id ?>">Supprime!</a>
                <a class="update" href="/update?id=<?= $post->id ?>">Modifie!</a>
            </div>

        </li>
    <?php endforeach ?>

</ul>

<?php $content = ob_get_clean(); ?>

<?php require __DIR__ . "/../layouts/default.php"; ?>