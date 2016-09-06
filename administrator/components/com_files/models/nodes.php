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
 * Nodes Model Class
 *
 * @author      Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package     Nooku_Components
 * @subpackage  Files
 */

class ComFilesModelNodes extends ComFilesModelDefault
{
    public function getItem()
    {
        if (!isset($this->_item))
        {
            $this->_item = $this->getRow(array(
                'data' => array(
            		'container' => $this->_state->container,
                    'folder' 	=> $this->_state->folder,
                    'name' 		=> $this->_state->name
                )
            ));
        }

        return parent::getItem();
    }

    public function getRow(array $options = array())
    {
        $identifier         = clone $this->getIdentifier();
        $identifier->path   = array('database', 'row');
        $identifier->name   = KInflector::singularize($this->getIdentifier()->name);

        return $this->getService($identifier, $options);
    }

    public function getRowset(array $options = array())
    {
        $identifier         = clone $this->getIdentifier();
        $identifier->path   = array('database', 'rowset');

        return $this->getService($identifier, $options);
    }

    protected function _getPath()
    {
        $state = $this->_state;

        $path = $state->container->path;

        if (!empty($state->folder) && $state->folder != '/') {
            $path .= '/'.ltrim($state->folder, '/');
        }

        return $path;
    }

	public function getList()
	{
		if (!isset($this->_list))
		{
			$state = $this->_state;
			$type = !empty($state->types) ? (array) $state->types : array();

			$list = $this->getService('com://admin/files.database.rowset.nodes');

			// Special case for limit=0. We set it to -1
			// so loop goes on till end since limit is a negative value
			$limit_left = $state->limit ? $state->limit : -1;
			$offset_left = $state->offset;
			$total = 0;

			if (empty($type) || in_array('folder', $type))
			{
				$folders_model = $this->getService('com://admin/files.model.folders')->set($state->getData());
				$folders = $folders_model->getList();

				foreach ($folders as $folder)
				{
					if (!$limit_left) {
						break;
					}
					$list->insert($folder);
					$limit_left--;
				}

				$total += $folders_model->getTotal();
				$offset_left -= $total;
			}

			if ((empty($type) || (in_array('file', $type) || in_array('image', $type))))
			{
				$data = $state->getData();
				$data['offset'] = $offset_left < 0 ? 0 : $offset_left;
				$files_model = $this->getService('com://admin/files.model.files')->set($data);
				$files = $files_model->getList();

				foreach ($files as $file)
				{
					if (!$limit_left) {
						break;
					}
					$list->insert($file);
					$limit_left--;
				}

				$total += $files_model->getTotal();
			}

			$this->_total = $total;

			$this->_list = $list;
		}

		return parent::getList();
	}
}
