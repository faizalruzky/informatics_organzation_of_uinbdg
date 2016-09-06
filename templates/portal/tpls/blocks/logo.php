<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$logotext = $this->params->get('logotext');
$logoclass = $this->params->get('logoclass', 'h2');
$tagline = $this->params->get('tagline');
$logotype = $this->params->get('jblogotype', 'text');
$logoalign= $this->params->get('logoalign', 'zenleft');
$logoimage = $logotype == 'image' ? $this->params->get('jblogoimage', '') : '';
$tagline_enable = $this->params->get('tagline_enable');

if ($this->countModules('logoside')) {
	$logowidth="6";
}

else {
	$logowidth="12";
}
?>
<?php if($logotype !=="none") {?>
<!-- LOGO -->
<section id="logowrap">
	<div class="zen-container">
		<div class="row-fluid">
			<div class="span<?php echo $logowidth; ?>">
			  <div class="logo logo-<?php echo $logotype ?> <?php echo $logoalign ?>">
				  <<?php echo $logoclass ?>>
				      <a href="<?php echo JURI::base(true) ?>" title="<?php echo $logotext ?>">
		    		    <span>
		        			<?php if($logotype == "text") { echo $logotext; } else { ?>
		        			<img src="<?php echo $logoimage ?>"/>
		        		<?php } ?>
		        		</span>
		      		</a>
		     	 </<?php echo $logoclass ?>>

		     	<?php if($tagline_enable) {?>
		     		 <div id="tagline"><span><?php echo $tagline ?></span></div>
		     	<?php } ?>
			    <?php if ($this->checkSpotlight('panel', 'panel1, panel2, panel3, panel4')) : ?>
			   	<div id="paneltrigger">
			   		<a href="#panel" role="button" data-toggle="modal">
			   			<span class="icon-plus"></span>
			   		</a>
			   </div>
			   <?php endif;?>
		  	</div>
		 </div>
		  <?php if ($this->countModules('logoside')) { ?>
		 	 <div class="span6">
		  			<jdoc:include type="modules" name="logoside" style="zendefault" />
		 	 </div>
		 <?php } ?>
	 </div>
</div>
</section>
<!-- //LOGO -->
<?php } ?>