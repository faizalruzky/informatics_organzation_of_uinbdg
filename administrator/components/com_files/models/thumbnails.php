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
 * Thumbnails Model Class
 *
 * @author      Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package     Nooku_Components
 * @subpackage  Files
 */
class ComFilesModelThumbnails extends ComDefaultModelDefault
{
	public function __construct(KConfig $config)
	{
		parent::__construct($config);

		$this->_state
			->insert('container', 'com://admin/files.filter.container', null)
			->insert('folder', 'com://admin/files.filter.path')
			->insert('filename', 'com://admin/files.filter.path', null, true, array('container'))
			->insert('files', 'com://admin/files.filter.path', null)
			->insert('paths', 'com://admin/files.filter.path', null)
			->insert('source', 'raw', null, true)
			
			->insert('types', 'cmd', '')
			->insert('config'   , 'json', '')
			;

	}

	protected function _initialize(KConfig $config)
	{
		$config->append(array(
			'state' => new ComFilesConfigState()
		));

		parent::_initialize($config);
	}

	public function getItem()
	{
		$item = parent::getItem();

		if ($item) {
			$item->source = $this->_state->source;
		}

		return $item;
	}

	protected function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);

    	if ($this->_state->source instanceof KDatabaseRowInterface || $this->_state->container) {
    		$query->select('c.slug AS container');
    	}
    }

	protected function _buildQueryJoins(KDatabaseQuery $query)
    {
    	parent::_buildQueryJoins($query);

    	if ($this->_state->source instanceof KDatabaseRowInterface || $this->_state->container) {
    		$query->join('LEFT', 'files_containers AS c', 'c.files_container_id = tbl.files_container_id');
    	}
    }

	protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        $state = $this->_state;
		if ($state->source instanceof KDatabaseRowInterface)
		{
			$source = $state->source;

			$query->where('tbl.files_container_id', '=', $source->container->id)
				->where('tbl.filename', '=', $source->name);

			if ($source->folder) {
				$query->where('tbl.folder', '=', $source->folder);
			}
		}
		else
		{
		    if ($state->container) {
		        $query->where('tbl.files_container_id', '=', $state->container->id);
		    }

		    if ($state->folder !== false && $state->folder !== null) {
		    	$query->where('tbl.folder', '=', ltrim($state->folder, '/'));
		    }

		    // Need this for BC
		    if (!empty($state->files)) {
		    	$query->where('tbl.filename', 'IN', $state->files);
		    }
		    
		    if ($state->filename) {
		        $query->where('tbl.filename', 'IN', $state->filename);
		    }

		    if ($state->paths) {
		        $conditions = array();
		        foreach ((array)$state->paths as $path) {
		            $file = basename($path);
		            $folder = dirname($path);
		            if ($folder === '.') {
		                $folder = '';
		            }
		            $conditions[] = sprintf('(tbl.filename = \'%s\' AND tbl.folder = \'%s\')', $file, $folder);
		        }
		        
		        $query->where('1 = 1');
		        $query->where[] = array(
		            'property' => '',
		            'condition' => 'AND ('.implode(' OR ', $conditions).')'
		        );
		    }
		}
		
	}
	
	protected function _buildQueryOrder(KDatabaseQuery $query)
	{
		$sort       = $this->_state->sort;
		$direction  = strtoupper($this->_state->direction);
	
		if($sort) 
		{
			$column = $this->getTable()->mapColumns($sort);
			if(array_key_exists($column, $this->getTable()->getColumns())) {
				$query->order($column, $direction);
			}
		}	
	}
}
