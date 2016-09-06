<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;  ?>



<?php if ($this->countModules('tabs')) : ?>
<!-- Grid1 Row -->
<section id="tabwrap" class="clearfix">
	<div class="zen-container">
		<div class="row-fluid">
			<div class="span8">	
				<jdoc:include type="modules" name="tabs" style="zentabs"/>
			</div>
			<div class="sidebar span4">
				<div id="side-bar-tabs">
					<div class="outerbox">
						<div class="innerbox">
							<jdoc:include type="modules" name="sidebar-tabs" style="zentabs"/>
						</div>
					</div>
				</div>
				<div id="main-side-bar">
					<jdoc:include type="modules" name="sidebar-2" style="zendefault"/>
				</div>
			</div>
  		</div>
  	</div>
</section>
<?php endif; ?>