<?php
    require_once DIR_SITE_INCLUDE . 'common.php';
    $rows = get_field("img_column");
    $column_class = get_field("column_num");
?>

    <div class="<?= $column_class ?>">

<?php
    if(!empty($rows) && is_array($rows))
    {
        foreach($rows as $item) 
        {
            $cap = "";
            $img = "";
            if(!empty($item['img'])) {
                $_img = $item['img'];
                $img = $_img['url'];
            } else {
                $img = $item['img_path'];
            }
            if($item["cap"] !== "") {
                $cap = '<span class="center">' . $item["cap"] . '</span>';
            }
?>
            <div>
                <img src="<?= $img ?>" alt="">
                <?= $cap ?>
            </div>
<?php
        }
    }
?>
    </div>
