<?php
/**
 * @package		Zen Tools
 * @subpackage	Zen Tools
 * @author		Joomla Bamboo - design@joomlabamboo.com
 * @copyright 	Copyright (c) 2014 Copyright (C), Joomlabamboo. All Rights Reserved.. All rights reserved.
 * @license		license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version		1.13.0
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Create a category selector

class JFormFieldToggle extends JFormField
{
	protected	$type = 'close';

	protected function getInput()
	{
		// Output
		return '
		<div id="toggleWrap">
			<div id="toggleAll"><a href="#" class="btn btn-primary"><span>Toggle all options</span></a></div>
		</div>
		';
	}

	public function fetchTooltip($label, $description, &$node, $control_name, $name)
	{
		// Output
		return '&nbsp;';
	}
}
