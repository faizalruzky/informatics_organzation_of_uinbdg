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

// Create a category selector
class JFormFieldK2radio extends JFormFieldRadio
{
	protected $type = 'k2radio';

	protected function getInput()
	{
		// Is K2 required but not installed?
		if (!ZenToolsHelper::checkK2Requirement($this->element['requirement']))
		{
			return '';
		}

		return parent::getInput();
	}

	protected function getOptions()
	{
		$options = parent::getOptions();

		// Check k2
		if (!ZenToolsHelper::isK2Installed())
		{
			$filtered = array();

			// Remove k2 option
			foreach ($options as $option)
			{
				if (substr_count(strtolower($option->value), 'k2') === 0
					&& substr_count(strtolower($option->text), 'k2') === 0)
				{
					$filtered[] = $option;
				}
			}

			$options = $filtered;
		}

		return $options;
	}
}
