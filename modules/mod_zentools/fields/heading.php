<?php
/**
 * @package		Zen Tools
 * @subpackage	Zen Tools
 * @author		Joomla Bamboo - design@joomlabamboo.com
 * @copyright 	Copyright (c) 2014 Copyright (C), Joomlabamboo. All Rights Reserved.. All rights reserved.
 * @license		Copyright Joomlabamboo 2014
 * @version		1.11.5
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

class JFormFieldHeading extends JFormField
{
	protected $type = 'Heading';

	protected function getInput()
	{
		$panelname = (string) $this->element['panel'];
		$title     = (string) $this->element['title'];
		$desc     = (string) $this->element['description'];
		$class     = (string) $this->element['class'];
		//when our code starts the second td in a tr are open
		//we close the second td in tr

		//we close the current table and divs

		//we open the new table and divs
		//we retrieve the panel id and title attributes and add them to the toggle div
		$panel = '
		<legend>
		<span>'.$title.'</span>
		</legend>
		<p class="muted">'.$desc.'</p>
		';

		//we allow the normal element function to close the td and tr
		return $panel;
	}
	
	public function getLabel()
	{
		// Output
		return '&nbsp;';
	}
	
}
