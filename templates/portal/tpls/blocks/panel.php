<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$admin = '';
if (strpos($_SERVER['REQUEST_URI'], 't3action=layout')) {
	$admin = 1;
}
?>

<?php if ($this->checkSpotlight('panel', 'panel1, panel2, panel3, panel4')) : ?>
	<?php if (!$admin) : ?>
	<div id="panel" class="modal fade" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<?php endif;?>
		<?php
			$this->spotlight ('panel', 'panel1, panel2, panel3, panel4')
		?>
		<?php if (!$admin) : ?>
	</div>
	<?php endif;?>
<?php endif;?>