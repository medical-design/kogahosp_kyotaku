<?php if (! defined('MWWPFORM_PAGE') || MWWPFORM_PAGE == false): ?><script src="/common/js/lib/jquery-3.5.1.min.js"></script><?php endif ?><script src="/common/js/lib/jquery.easing.1.3.js"></script>
<script src="/common/js/lib/mmenu/mmenu.js"></script>
<script src="/common/js/lib/imagesloaded.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-md5@0.7.3/build/md5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/ScrollTrigger.min.js"></script>
<script src="/common/js/lib/responsive-tables.js"></script>
<script src="/common/js/lib/swiper/8.4.7/swiper-bundle.min.js" defer="defer"></script>
<script src="/common/js/helper.js"></script>
<!--<script src="/common/js/common.js"></script>-->
<script src="/common/js/commonv.js"></script><?php if($_SERVER['HTTP_HOST'] === 'localhost' || (!IS_LOCAL)): ?>
<script type="text/javascript" src="//webfont.fontplus.jp/accessor/script/fontplus.js?C3Lq5Sn4pt8%3D&box=flhOmNPMe9Y%3D&timeout=30" charset="utf-8"></script>
<?php endif; ?>
<?php if( isset( $use_photoswipe ) and $use_photoswipe ): ?>
<script src="/common/js/lib/photoswipe/photoswipe.js"></script>
<script src="/common/js/lib/photoswipe/photoswipe-ui-default.js"></script>
<script src="/common/js/lib/photoswipe/photoswipe-init.js"></script>
<script>
	$(document).ready(function()
	{
		initPhotoSwipeFromDOM(".photoswipe");
	});
</script><?php endif ?>
<!-- <?php // if(isset($use_slick) and $use_slick) { ?><script src="/common/js/lib/slick/slick.js"></script><?php // } ?> -->
<?php if( isset( $use_remodal ) and $use_remodal ) { ?><script type="text/javascript" src="/common/js/lib/remodal/remodal.min.js"></script><?php } ?>
<?php if( isset( $use_magnific_popup ) and $use_magnific_popup ) { ?>
<link rel="stylesheet" href="/common/js/lib/magnific_popup/magnific-popup.css" />
<script src="/common/js/lib/magnific_popup/jquery.magnific-popup.js"></script><?php } ?>
