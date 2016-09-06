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
 * @version     $Id: controller.php  $
 */
	
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
require_once(JPATH_COMPONENT_ADMINISTRATOR .'/models/jsecurelog.php');
$task= JRequest::getVar( 'task', '', '', 'string', JREQUEST_ALLOWRAW );
if ($task == '' || $task == 'auth' || $task == 'cancel') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'basic') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',true);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'ip') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',true);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'masterpwd') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',true);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'logincontrol') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',true);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'pwdprotect') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',true);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'directory') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',true);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'mail') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',true);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'mastermail') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',true);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'keeplog') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',true);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'log') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',true);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'metatags') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',true);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);
}
if ($task == 'help') {
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
	JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
	JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
	JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
	JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
	JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
	JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
	JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
	JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
	JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',true);
}
class jsecureControllerjsecure extends JControllerLegacy
 {
	function display(){
		
		jimport('joomla.filesystem.file');	
		
	  	$view   = $this->getView('auth','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->display();
	}

	function basic(){
		
		jimport('joomla.filesystem.file');	
		
	  	$view   = $this->getView('basic','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->display();
	}


	function directory(){
	  	$view   = $this->getView('directory','html');
	 	$view->display();
	}
	
	function advanced(){
		$view   = $this->getView('advanced','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->display();
	}
   function mail(){
		$view   = $this->getView('mail','html');
	 	$view->display();
	}
function ip(){
		$view   = $this->getView('ip','html');
	 	$view->display();
	}
 function adminid(){
		$view   = $this->getView('adminid','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->display();
	}
function masterpwd(){
		$view   = $this->getView('masterpwd','html');
	 	$view->display();
	}
function mastermail(){
		$view   = $this->getView('mastermail','html');
	 	$view->display();
	}
function keeplog(){
		$view   = $this->getView('keeplog','html');
	 	$view->display();
	}
function logincontrol(){
		$view   = $this->getView('logincontrol','html');
	 	$view->display();
	}
function pwdprotect(){
		$view   = $this->getView('pwdprotect','html');
	 	$view->display();
	}
	function help(){
	 	$view   = $this->getView('help','html');
	 	$view->display();
	}
 function metatags(){
	 	$view   = $this->getView('metatags','html');
	 	$view->display();
	}

	function saveBasic(){

		$view   = $this->getView('basic','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
	
	function saveAdvanced(){
		$view   = $this->getView('advanced','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
	
   function saveMail(){
		$view   = $this->getView('mail','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
   function saveIp(){
		$view   = $this->getView('ip','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
   function saveMasterpwd(){
		$view   = $this->getView('masterpwd','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
  function saveMpmail(){
		$view   = $this->getView('mastermail','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
function saveLog(){
		$view   = $this->getView('keeplog','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
	
function saveLogincontrol(){
		$view   = $this->getView('logincontrol','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
function saveAdminpwdpro(){
	
		$view   = $this->getView('pwdprotect','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
 function saveAdminid(){
		$view   = $this->getView('adminid','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}
 function saveMetatags(){
		$view   = $this->getView('metatags','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->save();
 	
	}

	function isMasterLogged(){
		
		jimport('joomla.filesystem.file');	

		$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure';
		$configFile	 = $basepath.'/params.php';
		
		require_once($configFile);
		
		$JSecureConfig = new JSecureConfig();
		
		if($JSecureConfig->enableMasterPassword == '0')
			return true;
		
		$session = JFactory::getSession();
		
		return $session->get('jsecure_master_logged', false);

	}

	function auth(){
		$view		   = $this->getView('auth','html');
	 	$view->display();
	}

	function login(){
		$view   = $this->getView('auth','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->login();
	}

	function setAdminType(){
		$view   = $this->getView('config','html');
		$view->setAdminType();
	}
		
	function log(){
		$view   = $this->getView('log','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
	 	$view->display();
	}
	
	function ipinfo(){
		$view   = $this->getView('log','html');
		$model 	= $this->getModel( 'jsecurelog' );
		$view->setModel($model);
		$view->setLayout('ipinfo');
	 	$view->ipInfo();
		exit;
	}
	public function purgesessions()
	{   
		$model = $this->getModel( 'jsecurelog' );
		$sess_count = $model->purgeSessions();
		$msg = sprintf(JText::_("PURGE_SESSION_SUCCESS"),$sess_count);
		$this->setRedirect('index.php?option=com_jsecure&task=auth',$msg);
	}
	public function changeId()
	{
		$model = $this->getModel( 'jsecurelog' );
		$state = $model->changeSuperAdminId();
		if($state)
		{
		 $type = 'message';
		 $msg = JText::_("SUPER_ADMIN_ID_CHANGE_SUCCESS");
		 $this->setRedirect('index.php?option=com_jsecure&task=adminid',$msg,$type);
		}
		else
		{
		 $type = 'error';
		 $msg = JText::_("SUPER_ADMIN_ID_CHANGE_ERROR");
		 $this->setRedirect('index.php?option=com_jsecure&task=adminid',$msg,$type); 	
		}
		
	}
	function getVersion(){
  	$params = &JComponentHelper::getParams( 'com_jsecure' );
	$versionPresent = $params->get( 'version' );
	$versionPresent = '3.0';
	echo $versionPresent;
  	exit;
 	}
 }