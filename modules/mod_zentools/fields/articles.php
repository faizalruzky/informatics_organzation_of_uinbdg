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
defined( '_JEXEC' ) or die( 'Restricted access' );

class JFormFieldArticles extends JFormField
{
	protected $type = 'Articles';

	protected function getInput()
	{
		$db    = JFactory::getDBO();
		$size  = ( $this->element['size'] ? $this->element['size'] : 5 );
		$query = 'SELECT id, title FROM #__content WHERE state=1 ORDER BY title';
		$db->setQuery($query);
		$options = $db->loadObjectList();

		return JHTML::_('select.genericlist', $options, $this->formControl . '[params][' . $this->fieldname . '][]',
			'class="inputbox" style="width:90%;" multiple="multiple" size="15"', 'id', 'title', $this->value, $this->id
		);
	}
}
