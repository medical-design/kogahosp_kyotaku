<meta name="keywords" content="<?php echo META_KEYWORDS ?>" />
<meta name="description" content="<?php echo META_DESCRIPTION; ?>" />
<meta name="author" content="<?php echo SITE_NAME; ?>" />
<meta property="og:title" content="<?php isset($page_label) ? page_title($page_label) : page_title(); ?>" />
<meta property="og:type" content="company" />
<meta property="og:url" content="<?php echo ENV_HTTPS ?>" />
<meta property="og:image" content="<?php echo ENV_HTTPS ?>/common/img/ogp.webp" />
<meta property="og:site_name" content="<?php echo SITE_NAME; ?>" />
<meta property="og:description" content="<?php echo META_DESCRIPTION; ?>" /><?php if( ! is_ipad() ) { // PC, SP ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php } else {	// iPad ?>
<meta name="viewport" content="width=1260" /><?php } ?>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="/common/js/lib/mmenu/mmenu.css" media="all" />
<link rel="stylesheet" href="/common/css/mmenu.css" media="all" />
<link rel="stylesheet" href="/common/css/common.css" media="all" />
<link rel="stylesheet" href="/common/css/table.css" />
<link rel="stylesheet" href="/common/css/sp_style.css" media="screen and (max-width:999px)" />
<link rel="stylesheet" href="/common/css/pc_style.css" media="screen and (min-width:1000px), print" />
<link rel="stylesheet" href="/common/css/print.css" media="print" /><?php if (isReadableDetailCss()) { ?>
<link rel="stylesheet" href="css/<?php echo getDirname() ?>.css" media="all" /><?php } ?>
<?php if(isset($use_photoswipe) and $use_photoswipe) { ?>
<link rel="stylesheet" href="/common/js/lib/photoswipe/photoswipe.css" />
<link rel="stylesheet" href="/common/js/lib/photoswipe/default-skin/default-skin.css" />
<?php } ?>
<link rel="stylesheet" href="/common/js/lib/swiper/8.4.7/swiper-bundle.min.css" />
<?php if(isset($use_remodal) && $use_remodal) { ?>
<link rel="stylesheet" href="/common/js/lib/remodal/remodal.css" media="all" />
<link rel="stylesheet" href="/common/js/lib/remodal/remodal-default-theme.css" media="all" /><?php } ?>
<?php if (getUrlParam(2) === "contact") { ?>
<link rel="stylesheet" href="/common/css/form.css" media="all">
<?php } ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@400;500;700&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.css" /><?php require DIR_SITE_INCLUDE .'analytics_head.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">