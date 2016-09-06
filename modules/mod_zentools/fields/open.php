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

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Mod_zentools
 * @subpackage	Form
 * @since		1.6
 */

class JFormFieldOpen extends JFormField
{
	protected $type = 'Open';

	protected function getInput()
	{
		$panelname		= (string) $this->element['panel'];
		$title			= (string) $this->element['title'];

		//when our code starts the second td in a tr are open
		//we close the second td in tr
		$panel = '<div class="'.$title.'">';

		return $panel;
	}
}
