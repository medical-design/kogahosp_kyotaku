<?php
require_once DIR_SITE_INCLUDE . 'common.php';
$set = get_fields();
$text_class = "left";
$img_class = "right";

if($set["layout"] == "img-right:テキスト左・画像右") {
    $text_class = "left";
    $img_class = "right";
} else if($set["layout"] == "img-left:画像左・テキスト右") {
    $text_class = "right";
    $img_class = "left";
}

?>
<div class="set mb-2">
    <div class="<?= $text_class ?>">
        <?= $set["text"] ?>
    </div>
    <div class="<?= $img_class ?> fix" style="padding-<?= $text_class ?>:40px; flex-basis:<?= $set["img-width"] ?>px;"><img src="<?= $set["img"]["url"] ?>" alt=""></div>
</div>
