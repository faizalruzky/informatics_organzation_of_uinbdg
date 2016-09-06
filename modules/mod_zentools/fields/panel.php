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

require_once JPATH_SITE . '/modules/mod_zentools/includes/zentoolshelper.php';

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Mod_zentools
 * @subpackage	Form
 * @since		1.6
 */

class JFormFieldPanel extends JFormField
{
	protected $type = 'Panel';

	protected function getInput()
	{
		$panelname = (string) $this->element['panel'];
		$title     = (string) $this->element['title'];

		//when our code starts the second td in a tr are open
		//we close the second td in tr
		$panel = '</div>';

		// Is K2 required but not installed?
		if (!ZenToolsHelper::checkK2Requirement($this->element['requirement']))
		{
			return '';
		}

		//we close the current table and divs
		$panel .= '</div>';

		//we open the new table and divs
		//we retrieve the panel id and title attributes and add them to the toggle div
		$panel .= '<div id="'.$panelname.'Panel" class="panel">
		<h3 class="zentools" id="'.$panelname.'">
		<span>'.$title.'</span>
		</h3><div class="zentools">
		';

		//we open and close the first td and open the second td
		$panel .= '';

		//we allow the normal element function to close the td and tr
		return $panel;
	}
}
