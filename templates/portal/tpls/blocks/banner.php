<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die; ?>


<section id="bannerwrap">
	<div class="zen-container">
		<?php if ($this->checkSpotlight('banner', 'banner')) : ?>
  			<?php $this->spotlight ('banner', 'banner')?>
  		<?php endif;?>
  	</div>
</section>