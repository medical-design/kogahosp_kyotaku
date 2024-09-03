<?php
require_once DIR_SITE_INCLUDE . 'common.php';
$btn = get_fields();
$class = "";
$target = "";

if(isset($btn["target"])) {
	if ($btn["target"]) {
		$target = ' target="_blank"';
	}
}

$text_align = null;
if(isset($btn["layout"]))
{
	switch ($btn["layout"]) {
		case 'left':
			$text_align = ' class=""';
			break;
		case 'center':
			$text_align = ' class="center"';
			break;
		case 'right':
			$text_align = ' class="right_text"';
			break;
		default:
			$text_align = null;
			break;
	}
}

?>
<div <?= $text_align ?>><a href="<?= $btn["link"] ?>" class="btn"<?= $target ?>><?= $btn["text"] ?></a></div>
