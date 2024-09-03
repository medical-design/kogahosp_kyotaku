<?php
require_once DIR_SITE_INCLUDE . 'common.php';
$rows = get_field("link_list");
if(!empty($rows) && is_array($rows)) {

?>
<ul class="link_list">

<?php
	foreach ($rows as $item) {

		if(!empty($item)) {
			$class = "";
			$target = "";

			if($item["icon"] == "pdf") {
				$target = ' target="_blank"';
			} elseif($item["icon"] == "ext") {
				$target = ' target="_blank"';
			}

?>
		<li>
			<a href="<?= $item["link"] ?>" class="<?= $item['icon'] ?>" <?= $target ?>><?= $item["text"] ?></a>
		</li>

<?php
		}
	}
?>
</ul>
<?php } ?>



