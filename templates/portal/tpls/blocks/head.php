<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die; ?>

<!-- META FOR IOS & HANDHELD -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
<meta name="HandheldFriendly" content="true" />
<meta name="apple-mobile-web-app-capable" content="YES" />
<!-- //META FOR IOS & HANDHELD -->

<!-- SYSTEM CSS -->
<link href="<?php echo JURI::base(true) ?>/templates/system/css/system.css" rel="stylesheet" />
<!-- //SYSTEM CSS -->

<?php // Add T3v3 Basic head
$this->addHead(); 

$customcss = T3_TEMPLATE_PATH.'/css/custom.css';
if (file_exists($customcss)){?>

<!-- CUSTOM CSS -->
<link href="<?php echo T3_TEMPLATE_URL ?>/css/custom.css" rel="stylesheet" />
<!-- //CUSTOM CSS -->

<?php } ?>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<link href="<?php echo T3_TEMPLATE_URL ?>/css/ie8.css" rel="stylesheet" />
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="<?php echo T3_URL ?>/js/respond.min.js"></script>
<![endif]-->


<!--[if lt IE 10]>
<link href="<?php echo T3_TEMPLATE_URL ?>/css/ie.css" rel="stylesheet" />
<![endif]-->

<script type="text/javascript" src="<?php echo T3_TEMPLATE_URL ?>/js/template.js"></script>

<?php // Extra Files
echo $this->params->get('addcode');
?>


<!-- Fonts -->
<?php 
$bodyfont = $this->params->get('bodyFont');
$logofont = $this->params->get('logoFont');
$navfont = $this->params->get('navFont');
$headingfont = $this->params->get('headingFont');
$logoclass = $this->params->get('logoclass');
$customfont = $this->params->get('customFont');
$customfont_enable = $this->params->get('customfont_enabled');
$navfontweight = $this->params->get('navfontweight');
$bodyfontweight = $this->params->get('bodyfontweight');
$headingfontweight = $this->params->get('headingfontweight');
$logofontweight = $this->params->get('logofontweight');

if($customfont == "-1") {
	$customfont = $this->params->get('customFont_custom');
}


function cleanFonts($subject) {
	$font = explode(':', str_replace("+", " ", $subject));
	return $font[0];
}

?>
<style type="text/css">
<?php 

	if($bodyfont == "-1") { ?>
			html > body {font-family: <?php echo cleanFonts($this->params->get('bodyFont_custom')); ?>;font-size: <?php echo $this->params->get('baseFontSize') ?>;font-weight: <?php echo $bodyfontweight ?> }
	<?php } else { ?>
			html > body {font-family: <?php echo $bodyfont; ?>;font-size: <?php echo $this->params->get('baseFontSize') ?>;font-weight: <?php echo $bodyfontweight ?>}
	<?php } 

		if($headingfont == "-1") { 
			?>
			h1, h2, h3, h4, h5, h6, blockquote {font-family: <?php echo cleanFonts($this->params->get('headingFont_custom')); ?>;font-weight: <?php echo $headingfontweight ?>}
	<?php } else {  ?>
			h1, h2, h3, h4, h5, h6, blockquote {font-family: <?php echo $headingfont ?>;font-weight: <?php echo $headingfontweight ?> ;
			}
	<?php }
		if($navfont == "-1") { ?>
			#navwrap li {font-family: <?php echo cleanFonts($this->params->get('navFont_custom')); ?>;font-weight: <?php echo $navfontweight ?>}
	<?php } else {?>
			#navwrap li {font-family: <?php echo $navfont ?>;font-weight: <?php echo $navfontweight ?>}
	<?php }
		if($logofont == "-1") { ?>
			.logo <?php echo $logoclass ?>{font-family: <?php echo cleanFonts($this->params->get('logoFont_custom')); ?>;font-weight: <?php echo $logofontweight ?>
			}
	<?php } else { ?>
			.logo <?php echo $logoclass ?>  {font-family: <?php echo $logofont ?>;font-weight: <?php echo $logofontweight ?>}
	<?php } ?>
	
	<?php if( 	
			$bodyfont === "League Gothic" || 
			$headingfont === "League Gothic" || 
			$navfont === "League Gothic" || 
			$logofont === "League Gothic") { ?>
				@font-face {
				  font-family: 'League Gothic Regular';
				  src: url('<?php echo T3_TEMPLATE_URL ?>/font/League_Gothic.eot');
				  src: local('League Gothic Regular'), local('LeagueGothic-Regular'), url('League_Gothic.otf') format('opentype');
				}
	<?php }?>
	
	<?php if($customfont_enable) { ?>
		<?php echo $this->params->get('customfontselector') ?> {font-family:<?php echo $customfont; ?>;<?php echo $this->params->get('customFontCSS') ?>}
	<?php }?>
</style>