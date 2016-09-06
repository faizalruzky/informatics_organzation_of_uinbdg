<?php
/**
 * @package    DOCman
 * @copyright   Copyright (C) 2011 - 2013 Timble CVBA (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

defined('_JEXEC') or die;

if (!class_exists('Koowa'))
{
    if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_extman/extman.php')) {
        $error = JText::_('EXTMAN_ERROR');
    }
    elseif (!JPluginHelper::isEnabled('system', 'koowa')) {
        $error = sprintf(JText::_('EXTMAN_PLUGIN_ERROR'), JRoute::_('index.php?option=com_plugins&view=plugins&filter_folder=system'));
    }

    JFactory::getApplication()->redirect(JURI::base(), $error, 'error');
}

if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_docman/dispatcher.php')) {
    JFactory::getApplication()->redirect(JURI::base(), JText::_('DOCMAN_ERROR'), 'error');
}

try {
    echo KService::get('com://admin/docman_import.dispatcher')->dispatch();
}
catch (Exception $e)
{
    if (JFactory::getDocument()->getType() === 'json')
    {

        if (!headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
        }

        echo json_encode(array(
            'status' => false,
            'error'  => $e->getMessage()
        ));

        exit;
    }
    else throw $e;
}



