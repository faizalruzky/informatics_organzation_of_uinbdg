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
 */

class JFormFieldSortable extends JFormField
{
	protected $type = 'Sortable';

	protected function getInput()
	{
		// Global Document
		$document 	= JFactory::getDocument();

		// Params
		if (substr(JVERSION, 0, 3) >= '3.0')
		{
			$document->addStyleSheet( ''.JURI::root(true).'/media/mod_zentools/css/admin/admin30.css' );
		}
		else
		{
			$document->addStyleSheet( ''.JURI::root(true).'/media/mod_zentools/css/admin/admin17.css' );
		}

		ob_start();	?>
		<div id="help"></div>
			<div id="zenmessage"><p></p></div>
			<div id="items">
				<ul id="sortable" class="ui-sortable">
					<li class="disabled">Drag items here to use</li>
				</ul>
				<ul id="sortable2" class="ui-sortable">
					<li class="disabled">Available Items</li>
				</ul>
			</div>
			<?php

		return ob_get_clean();
	}
}
