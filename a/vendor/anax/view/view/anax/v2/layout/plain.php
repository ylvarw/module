<?php

namespace Anax\View;

/**
 * A very small layout only rendering the content in a main
 * element.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$lang = $lang ?? "sv";
$charset = $charset ?? "utf-8";
$title = ($title ?? "No title");



?><!doctype html>
<html lang="<?= $lang ?>">
<head>

    <meta charset="<?= $charset ?>">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (isset($favicon)) : ?>
    <link rel="icon" href="<?= asset($favicon) ?>">
    <?php endif; ?>

    <?php if (isset($stylesheets)) : ?>
        <?php foreach ($stylesheets as $stylesheet) : ?>
            <link rel="stylesheet" type="text/css" media="all" href="<?= asset($stylesheet) ?>">
        <?php endforeach; ?>
    <?php endif; ?>

</head>

<body>

<?php if (regionHasContent("main")) : ?>
<main class="region-main" role="main">
    <?php renderRegion("main") ?>
</main>
<?php endif; ?>



<!-- render javascripts -->
<?php if (isset($javascripts)) : ?>
    <?php foreach ($javascripts as $javascript) : ?>
    <script async src="<?= asset($javascript) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>



<!-- useful for inline javascripts such as google analytics-->
<?php if (regionHasContent("body-end")) : ?>
    <?php renderRegion("body-end") ?>
<?php endif; ?>

</body>
</html>
