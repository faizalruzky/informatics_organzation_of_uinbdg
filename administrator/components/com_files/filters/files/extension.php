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
 * File Extension Filter Class
 *
 * @author      Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package     Nooku_Components
 * @subpackage  Files
 */

class ComFilesFilterFileExtension extends KFilterAbstract
{
	protected $_walk = false;

	protected function _validate($context)
	{
		$allowed = $context->caller->container->parameters->allowed_extensions;
		$value = $context->caller->extension;

		if (is_array($allowed) && (empty($value) || !in_array(strtolower($value), $allowed))) {
		    $translator = $this->getService('translator')->getTranslator($this->getIdentifier());
			$context->setError($translator->translate('Invalid file extension'));
			return false;
		}
	}

	protected function _sanitize($value)
	{
		return false;
	}
}