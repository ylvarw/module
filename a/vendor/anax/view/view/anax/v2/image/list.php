<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$classes = $class ?? null;


?><div <?= classList($classes) ?>>
        <?php foreach ($images as $img) :
            $src = $img["src"] ?? null;
            $url = substr($src, 0, strpos($src, "?"));
            $alt = $img["alt"] ?? null;
            $title = $img["title"] ?? null;
            $alt = $alt ?? $title;
            $title = $title ?? $alt;
            ?>

            <a href="<?= asset($url) ?>"><img src="<?= $src ?>" alt="<?= $alt ?>" title="<?= $title ?>"></a>

        <?php endforeach; ?>
</div>
