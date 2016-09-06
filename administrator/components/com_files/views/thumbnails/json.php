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
 * Thumbnails Json View Class
 *
 * @author      Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package     Nooku_Components
 * @subpackage  Files
 */
class ComFilesViewThumbnailsJson extends ComFilesViewJson
{
    protected function _getList()
    {
        $list = $this->getModel()->getList();
        $results = array();
        foreach ($list as $item) 
        {
        	$key = $item->filename;
        	$results[$key] = $item->toArray();
        }
        ksort($results);

    	$output = parent::_getList();
        $output['items'] = $results;
        $output['total'] = count($list);

        return $output;
    }
}