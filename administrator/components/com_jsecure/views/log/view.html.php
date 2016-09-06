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
 * @version     $Id: view.html.php  $
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class jsecureViewLog extends JViewLegacy {

	protected $categories;
	protected $items;
	protected $pagination;
	protected $state;

	
	function display($tpl=null){

		$this->categories	= $this->get('CategoryOrders');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		$app    = &JFactory::getApplication();
		
		$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure';
		$configFile	= $basepath.'/params.php';
		require_once($configFile);
		$JSecureConfig = new JSecureConfig();
		$search     = JRequest::getVar('search','');

		$model = $this->getModel('jsecurelog');

		//delete log 
		if($JSecureConfig->delete_log != 0)
			$deleteLog = $model->deleteLog($JSecureConfig->delete_log);

		$limit		= $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
		$limitstart	= $app->getUserStateFromRequest('limitstart', 'limitstart', 0, 'int');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );
		
		$data = $model->getData();		
		$total = $model->getTotalList();

		// Create the pagination object
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);
        $this->addToolbar();
		$this->assignref('data',$data);
		$this->assignref('pagination',$pagination);
		$this->assignRef('search',$search);
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('jSecure Authntication'), 'generic.png');
			JToolBarHelper::cancel('cancel');
			JToolBarHelper::help('help');
	}
	function ipinfo($tpl=null){
		$ip = JRequest::getVar('ip','127.0.0.1');
		$ipInfo = get_meta_tags('http://www.geobytes.com/IpLocator.htm?GetLocation&template=php3.txt&IpAddress='.$ip);
		$this->assignref('ipInfo',$ipInfo);
		parent::display($tpl);
	}
}

?>