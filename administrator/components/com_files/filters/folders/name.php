<?php
/**
 * @version     $Id$
 * @package     Nooku_Components
 * @subpackage  Files
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Folder Name Filter Class
 *
 * @author      Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package     Nooku_Components
 * @subpackage  Files
 */

class ComFilesFilterFolderName extends KFilterAbstract
{
	protected $_walk = false;

	protected function _validate($context)
	{
		$value = $context->caller->name;
		$translator = $this->getService('translator')->getTranslator($this->getIdentifier());

		if (strpos($value, '/') !== false) {
			$context->setError($translator->translate('Folder names cannot contain slashes'));
			return false;
		}

		if ($this->_sanitize($value) == '') {
			$context->setError($translator->translate('Invalid folder name'));
			return false;
		}
	}

	protected function _sanitize($value)
	{
		$value = str_replace('/', '', $value);
		return $this->getService('com://admin/files.filter.path')->sanitize($value);
	}
}