<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$menualign = $this->params->get('menualign', 'zenleft');
if ($this->countModules("search")) {
	$navWidth = "9";
} else {
	$navWidth = "12";
}
?>
<!-- MAIN NAVIGATION -->
<?php if($this->params->get('stickynav')) { ?>
  <nav id="navwrap" class="affix-top" data-spy="affix" data-offset-top="<?php echo $this->params->get('stickynavoffset');?>">
<?php } else { ?>
  <nav id="navwrap">
<?php } ?>
  <div class="zen-container">
  	<div class="row-fluid">
   		<div class="navwrapper navbar <?php echo $menualign ?> span<?php echo $navWidth; ?>">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		        <span class="icon-list-ul"></span>
		      </button>
		
		    <div class="nav-collapse collapse<?php echo $this->getParam('navigation_collapse_showsub', 1) ? ' always-show' : '' ?> <?php echo $menualign; ?>">
		    <?php if ($this->getParam('navigation_type') == 'megamenu') : ?>
		       <?php $this->megamenu($this->getParam('mm_type', 'mainmenu')) ?>
		    <?php else : ?>
		      <jdoc:include type="modules" name="<?php $this->_p('menu') ?>" style="raw" />
		    <?php endif ?>
		    </div>
	    
	    <div id="navsearch" class="span3">
	    	<jdoc:include type="modules" name="search" style="zendefault"/>
	    </div>
	   </div>
    </div>
  </div>
</nav>
<!-- //MAIN NAVIGATION -->