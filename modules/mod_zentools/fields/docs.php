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

class JFormFieldDocs extends JFormField
{
	protected	$type = 'docs';

	protected function getInput()
	{
		ob_start();
		?>

		<?php	return ob_get_clean();

		return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.'][]',
			'class="inputbox" style="width:90%;" multiple="multiple" size="5"', 'id', 'title', $value, $control_name.$name
		);
	}
}
