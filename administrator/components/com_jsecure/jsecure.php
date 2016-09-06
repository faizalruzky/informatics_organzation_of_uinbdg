<?php
/**
 * jSecure Authentication components for Joomla!
 * jSecure Authentication extention prevents access to administration (back end)
 * login page without appropriate access key.
 *
 * @author      $Author: Ajay Lulia $
 * @copyright   Joomla Service Provider - 2012
 * @package     jSecure3.0
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     $Id: jsecure.php  $
 */
// no direct access
defined('_JEXEC') or die('Restricted Access');
// Require the base controller
require_once (JPATH_COMPONENT_ADMINISTRATOR.'/'.'controller.php');

if (!JFactory::getUser()->authorise('core.manage', 'com_jsecure')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::base()."components/com_jsecure/css/jsecure.css");
$task	= JRequest::getCmd('task');

// Create the controller
$controller    = new jsecureControllerjsecure();


// Perform the Request task
if (!jsecureControllerjsecure::isMasterLogged())
{	
	if (JRequest::getCmd('task') == 'login')
		$controller->execute('login');
	else 
		$controller->execute($task);
}
else
	$controller->execute($task);

// Redirect if set by the controller
$controller->redirect();

?>