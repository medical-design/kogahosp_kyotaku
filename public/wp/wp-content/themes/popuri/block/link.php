<?php
    $link = get_fields();

    $target = "";
    if($link["type"] == "pdf")
    {
        $target = ' target="_blank"';
    }
    elseif($link["type"] == "ext")
    {
        $target = ' target="_blank"';
    }
?>

<div class="mb-1">
    <a href="<?= $link['link'] ?>" class="<?= $link['type'] ?>" <?=  $target ?>><?= $link['text'] ?></a>
</div>