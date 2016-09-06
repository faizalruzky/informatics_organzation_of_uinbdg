<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: overview.php 3576 2012-05-01 14:11:04Z geraintedwards $
 * @package     JEvents
 * @copyright   Copyright (C)  2008-2015 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.tooltip');

$db = JFactory::getDBO();
$user = JFactory::getUser();

// get configuration object
$cfg = JEVConfig::getInstance();
$this->_largeDataSet = $cfg->get('largeDataSet', 0);
$orderdir = JFactory::getApplication()->getUserStateFromRequest("eventsorderdir", "filter_order_Dir", 'asc');
$order = JFactory::getApplication()->getUserStateFromRequest("eventsorder", "filter_order", 'start');
$pathIMG = JURI::root() . 'administrator/images/';
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
	<?php if (!empty($this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
			<?php else : ?>
			<div id="j-main-container">
	<?php endif; ?>

			<table cellpadding="4" cellspacing="0" border="0" >
				<tr>
<?php if (!$this->_largeDataSet)
{ ?>
						<td align="right" width="100%"><?php echo JText::_('JEV_HIDE_OLD_EVENTS'); ?> </td>
						<td align="right"><?php echo $this->plist; ?></td>
					<?php } ?>
					<td align="right"><?php echo $this->clist; ?> </td>
<?php if (!JevJoomlaVersion::isCompatible("3.0"))
{ ?>
						<td align="right"><?php echo $this->icsList; ?> </td>
						<td align="right"><?php echo $this->statelist; ?> </td>
						<td align="right"><?php echo $this->userlist; ?> </td>
<?php } ?>
					<td><?php echo JText::_('JEV_SEARCH'); ?>&nbsp;</td>
					<td>
						<input type="text" name="search" value="<?php echo $this->search; ?>" class="inputbox" onChange="document.adminForm.submit();" />
					</td>
						<?php if (JevJoomlaVersion::isCompatible("3.0"))
						{ ?>
						<td align="right">
							<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
	<?php echo $this->pageNav->getLimitBox(); ?>
						</td>
	<?php }
?>
				</tr>
			</table>

			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist  table table-striped">
				<tr>
					<th width="20" nowrap="nowrap">
						<input type="checkbox" name="toggle" value="" onclick="<?php echo JevJoomlaVersion::isCompatible("3.0") ? "Joomla.checkAll(this)" : "checkAll(" . count($this->rows) . ")"; ?>" />
					</th>
					<th class="title" width="50%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort', 'JEV_ICAL_SUMMARY', 'title', $orderdir, $order, "icalevent.list"); ?>
					<th width="10%" nowrap="nowrap"><?php echo JText::_('REPEATS'); ?></th>
					<th width="10%" nowrap="nowrap"><?php echo JText::_('JEV_EVENT_CREATOR'); ?></th>
					<th width="10%" nowrap="nowrap"><?php echo JText::_('JEV_PUBLISHED'); ?></th>
					<th width="15%" nowrap="nowrap">
<?php echo JHTML::_('grid.sort', 'JEV_TIME_SHEET', 'starttime', $orderdir, $order, "icalevent.list"); ?>
					</th>
					<th width="20%" nowrap="nowrap">
<?php echo JHTML::_('grid.sort', 'JEV_FIELD_CREATIONDATE', 'created', $orderdir, $order, "icalevent.list"); ?>
					</th>
					<th width="20%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort', 'JEV_MODIFIED', 'modified', $orderdir, $order, "icalevent.list"); ?>
					</th>
					<th width="10%" nowrap="nowrap"><?php echo JText::_('JEV_ACCESS'); ?></th>
				</tr>

				<?php
				$k = 0;
				$nullDate = $db->getNullDate();

				for ($i = 0, $n = count($this->rows); $i < $n; $i++)
				{
					$row = &$this->rows[$i];
					?>
					<tr class="row<?php echo $k; ?>">
						<td width="20" style="background-color:<?php echo JEV_CommonFunctions::setColor($row); ?>">
							<?php echo JHtml::_('grid.id', $i, $row->id()); ?>
						</td>
						<td >
							<a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','icalevent.edit')" title="<?php echo JText::_('JEV_CLICK_TO_EDIT'); ?>"><?php echo $row->title(); ?></a>
						</td>
						<td align="center">
							<?php
							if ($row->hasrepetition())
							{
								$img = JHTML::_('image', 'admin/featured.png', '', array('title' => ''), true);
								?>
								<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','icalrepeat.list')" class="btn btn-micro">
								<?php echo $img; ?>
								</a>
								<?php } ?>
						</td>
						<td align="center"><?php echo $row->creatorName(); ?></td>
						<td align="center">
							<?php
							if ($row->state()==1){
								$img = JHTML::_('image', 'admin/tick.png', '', array('title' => ''), true) ;
							}
							else  if ($row->state()==0){
								$img =  JHTML::_('image', 'admin/publish_x.png', '', array('title' => ''), true) ;
							}
							else {
								$img =  JHTML::_('image', 'admin/trash.png', '', array('title' => ''), true) ;
							}
							?>
							<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','<?php echo $row->state() ? 'icalevent.unpublish' : 'icalevent.publish'; ?>')" class="btn btn-micro" >
							<?php echo $img; ?>
							</a>
						</td>
						<td >
							<?php
							if ($this->_largeDataSet)
							{
								echo JText::_('JEV_FROM') . ' : ' . $row->publish_up();
							}
							else
							{
								$times = '<table style="border: 1px solid #666666; width:100%;">';
								$times .= '<tr><td>' . JText::_('JEV_FROM') . ' : ' . ($row->alldayevent() ? substr($row->publish_up(), 0, 10) : substr($row->publish_up(),0,16)) . '</td></tr>';
								$times .= '<tr><td>' . JText::_('JEV_TO') . ' : ' . (($row->noendtime() || $row->alldayevent()) ? substr($row->publish_down(), 0, 10) : substr($row->publish_down(),0,16)) . '</td></tr>';
								$times .="</table>";
								echo $times;
							}
							?>
						</td>
						<td align="center"><?php echo $row->created(); ?></td>
						<td align="center"><?php echo $row->modified; ?></td>
						<td align="center"><?php echo $row->_groupname; ?></td>
					</tr>
	<?php
	$k = 1 - $k;
}
?>
				<tr>
					<th align="center" colspan="10"><?php echo $this->pageNav->getListFooter(); ?></th>
				</tr>
			</table>
			<input type="hidden" name="option" value="<?php echo JEV_COM_COMPONENT; ?>" />
			<input type="hidden" name="task" value="icalevent.list" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="filter_order" value="<?php echo $order; ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $orderdir; ?>" />
		</div>
</form>
<br />
