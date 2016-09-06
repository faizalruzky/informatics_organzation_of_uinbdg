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

class JElementHeader extends JElement
{
	protected $_name = 'header';

	public function fetchElement($name, $value, &$node, $control_name)
	{
		// Output
		return '
		<div style="font-weight:bold;font-size:14px;color:#fff;padding:4px;margin:0;background:#4D7502;">
			'.JText::_($value).'
		</div>
		';
	}

	public function fetchTooltip($label, $description, &$node, $control_name, $name)
	{
		// Output
		return '&nbsp;';
	}
}
