<?php

namespace Anax\View;

/**
 * A div element with an image as background.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$class = $class ?? null;
$height = $height ?? "100%";
$src = $src ?? null;
$href = $href ?? null;

if (!$src) {
    throw new Exception("Template missing required attribute 'src'.");
}

$start = null;
$end = null;
if ($href) {
    $start = "<a href=\"" . asset($href) . "\">";
    $end = "</a>";
}

?><?= $start ?>
    <div <?= classList("background-image", $class) ?> style="background-image:url(<?= asset($src) ?>); height: <?= $height ?>;"></div>
<?= $end ?>
