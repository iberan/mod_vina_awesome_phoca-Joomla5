<?php
/*
# ------------------------------------------------------------------------
# Vina Awesome Slider for Phoca Gallery for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum:    http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();
$doc->addScript('modules/mod_vina_awesome_phoca/assets/js/script.js', 'text/javascript');
$doc->addStyleSheet('modules/mod_vina_awesome_phoca/assets/styles/style.css');
modVinaAwesomeSliderPhocaHelper::loadEffect($transitionEffect);
?>
<style type="text/css">
#vina-awesome-phoca<?php echo $module->id; ?> {
	max-width: <?php echo $moduleScaleWidth; ?>;
}
#vina-awesome-phoca<?php echo $module->id; ?> .ws_bulframe div {
	width: <?php echo $smallImageWidth; ?>px;
}
#vina-awesome-phoca<?php echo $module->id; ?> .ws_bulframe div div {
	height: <?php echo $smallImageHeight; ?>px;
}
#vina-awesome-phoca<?php echo $module->id; ?> .ws_bulframe span {
	left: <?php echo $smallImageWidth/2; ?>px;
}
#vina-awesome-phoca<?php echo $module->id; ?> .ws-title {
	<?php echo $captionPosition; ?>
}
#vina-copyright<?php echo $module->id; ?> {
	font-size: 12px;
	<?php if(!$params->get('copyRightText', 0)) : ?>
	height: 1px;
	overflow: hidden;
	<?php endif; ?>
	clear: both;
}
</style>
<div id="vina-awesome-phoca<?php echo $module->id; ?>" class="vina-awesome-phoca">
	<div class="ws_images">
		<ul>
			<?php foreach($slides as $key => $slide) : ?>
			<?php
				$title 		= htmlspecialchars(addslashes($slide->title));
				$iCaption	= $slide->description;
				$thumbLink	= PhocaGalleryFileThumbnail::getThumbnailName($slide->filename, 'large');
				
				$image = $thumbLink->rel;
				
				if($resizeImage) {
					$image = modVinaAwesomeSliderPhocaHelper::resizeImage($resizeType, $image, '', $moduleWidth, $moduleHeight, $module);
				}
				else {
					$image = (strpos($image, 'http://') === false) ? JURI::base() . $image : $image;
				}				
			?>
			<li>
				<img src="<?php echo $image; ?>" title="<?php echo $title; ?>" id="wows1_<?php echo $key; ?>"/>
				<?php echo $iCaption; ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	
	<?php if($bullets) : ?>
	<div class="ws_bullets">
		<div>
			<?php foreach($slides as $key => $slide) : ?>
			<?php
				$thumbLink	= PhocaGalleryFileThumbnail::getThumbnailName($slide->filename, 'large');
				
				$image = $thumbLink->rel;
				
				if($resizeImage) {
					$image = modVinaAwesomeSliderPhocaHelper::resizeImage($resizeType, $image, 'thumb_', $smallImageWidth, $smallImageHeight, $module);
				}
				else {
					$image = (strpos($image, 'http://') === false) ? JURI::base() . $image : $image;
				}				
			?>
			<a href="#" title="<?php echo $slide->name; ?>">
				<img src="<?php echo $image; ?>" />
				<?php echo $key; ?>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="ws_shadow"></div>
</div>
<script>
jQuery(document).ready(function ($) {
	$("#vina-awesome-phoca<?php echo $module->id; ?>").wowSlider({
		effect: 		"<?php echo $transitionEffect; ?>",
		duration: 		<?php echo $duration; ?>,
		delay:			<?php echo $delay; ?>,
		width:			<?php echo $moduleWidth; ?>,
		height:			<?php echo $moduleHeight; ?>,
		autoPlay:		<?php echo $autoPlay; ?>,
		playPause:		<?php echo $playPause; ?>,
		stopOnHover:	<?php echo $stopOnHover; ?>,
		loop:			<?php echo $loop; ?>,
		bullets:		<?php echo $bullets; ?>,
		caption:		<?php echo $caption; ?>,
		captionEffect:	"<?php echo $captionEffect; ?>",
		controls:		<?php echo $controls; ?>,
	});
});
</script>