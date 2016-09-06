<?php
/**
 * @package     Zen Tools
 * @subpackage  Zen Tools
 * @author      Joomla Bamboo - design@joomlabamboo.com
 * @copyright   Copyright (c) 2012 Joomla Bamboo. All rights reserved.
 * @license     GNU General Public License version 2 or later
 * @version     1.8.0
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if(!class_exists('ContentHelperRoute')) require_once (JPATH_SITE . '/components/com_content/helpers/route.php');

abstract class ModZentoolsCategoryHelper
{
    public static function getList(&$params, $id, $handleImages = false)
    {
        require_once JPATH_SITE . '/components/com_content/models/categories.php';
        
        				$catids = $params->get('parent', 'root');        				
        				$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
        				$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
        				//$categories = ZenJModel::getInstance('Categories', 'ContentModel', array('ignore_request' => true));
        				$catCount = $params->get('count', 5);
        				$levels = (int)($params->get('c_levels', 1) ? $params->get('c_levels', 1) : 9999);
        				$show_child_category_articles = (bool)$params->get('c_show_child_category_articles', 0);
        				//$categories->setState('filter.published', '1');
        				//$categories->setState('filter.access', $access);
        				
        				// Image Size and container, remove px if user entered
        				$responsiveimages = $params->get('responsiveimages');
        				$resizeImage = $params->get('resizeImage',1);
        				$option = $params->get( 'option', 'crop');
        				$img_width = str_replace('px', '', $params->get( 'image_width','170'));
        				$img_height = str_replace('px', '', $params->get( 'image_height','85'));
        
        
        				if ($catids && $show_child_category_articles && $levels > 0)
        				{
        					$additional_catids = array();
        					foreach($catids as $catid)
        					{
        						$categories->setState('filter.parentId', $catid);
        						$recursive = true;
        						$items = $categories->getItems($recursive);
        
        						if ($items)
        						{
        							foreach($items as $category)
        							{
        								$condition = (($category->level - $categories->getParent()->level) <= $levels);
        								if ($condition)
        								{
        									$additional_catids[] = $category->id;
        								}
        
        							}
        						}
        					}
        
        					$catids = array_unique(array_merge($catids, $additional_catids));
        				}
        
        				$items = array();
        				$jcategory = JCategories::getInstance('Content');
        
        				if (is_array($catids))
        				{
        					foreach ($catids as $catid)
        					{
        						$catitem = $jcategory->get($catid);
        
        						if (!($catitem->published))
        						{
        							continue;
        						}
        
        						$catitem->slug = $catitem->id . ':' . $catitem->alias;
        						$catitem->catslug = $catitem->id ? $catitem->id . ':' . $catitem->alias : $catitem->id;
        
        						if ($access || in_array($catitem->access, $authorised))
        						{
        
        								$catitem->link = 'href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($catitem->id, $catitem->id)).'"';
        						}
        						else
        						{
        							// Angie Fixed Routing
        							$app	= JFactory::getApplication();
        							$menu	= $app->getMenu();
        							$menuitems	= $menu->getItems('link', 'index.php?option=com_users&view=login');
        
        							if (isset($menuitems[0]))
        							{
        								$Itemid = $menuitems[0]->id;
        							}
        							else if (JRequest::getInt('Itemid') > 0)
        							{ // use Itemid from requesting page only if there is no existing menu
        								$Itemid = JRequest::getInt('Itemid');
        							}
        
        							$catitem->link = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $Itemid);
        						}
        
        						$catitem->image = "";
        						
        						$catparams = json_decode($catitem->params);
        						$catitem->image = $catparams->image;
        						$catitem->imageOriginal = $catparams->image;
        						
        						if ($resizeImage) {
		                            $catitem->image = ZenToolsHelper::handleRemoteImage($catitem->image);
		                            $catitem->image = ZenToolsHelper::getResizedImage($catitem->image, $img_width, $img_height, $option);
		
		                            if($responsiveimages) {
		                                $catitem->imageTiny = ZenToolsHelper::getResizedImage($catitem->image, ($img_width /5), ($img_height / 5), $option);
		                                $catitem->imageXSmall = ZenToolsHelper::getResizedImage($catitem->image, ($img_width /3), ($img_height / 3), $option);
		                                $catitem->imageSmall = ZenToolsHelper::getResizedImage($catitem->image, ($img_width /2), ($img_height / 2), $option);
		                                $catitem->imageMedium = ZenToolsHelper::getResizedImage($catitem->image, ($img_width /1.25), ($img_height / 1.25), $option);
		                                $catitem->imageDefault = ZenToolsHelper::getResizedImage($catitem->image, ($img_width), ($img_height), $option);
		                                $catitem->imageLarge = ZenToolsHelper::getResizedImage($catitem->image, ($img_width * 1.25), ($img_height * 1.25), $option);
		                                if($catitem->imageLarge == $catitem->image) {
		                                    $catitem->imageLarge = '/'.$catitem->imageDefault;
		                                }
		                                $catitem->imageXLarge = ZenToolsHelper::getResizedImage($catitem->image, ($img_width *1.75), ($img_height * 1.75), $option);
		
		                                if($catitem->imageXLarge == $catitem->image) {
		                                    $catitem->imageXLarge = '/'.$catitem->imageDefault;
		                                }
		                            }
		                    }
		                    else {
		                        if($responsiveimages) {
		                            $catitem->image = ZenToolsHelper::handleRemoteImage($catitem->image);
		
		                            list($width, $height) = getimagesize($catitem->image);
		                            $catitem->imageTiny = ZenToolsHelper::getResizedImage($catitem->image, ($width /5), ($height / 5), 'exact');
		                            $catitem->imageXSmall = ZenToolsHelper::getResizedImage($catitem->image, ($width /3), ($height / 3), 'exact');
		                            $catitem->imageSmall = ZenToolsHelper::getResizedImage($catitem->image, ($width /2), ($height / 2), 'exact');
		                            $catitem->imageMedium = ZenToolsHelper::getResizedImage($catitem->image, ($width /1.5), ($height / 1.25), 'exact');
		                            $catitem->imageDefault = ZenToolsHelper::getResizedImage($catitem->image, ($width), ($height), 'exact');
		                            $catitem->imageLarge = ZenToolsHelper::getResizedImage($catitem->image, ($width * 1.25), ($height * 1.25), $option);
		                            if($catitem->imageLarge == $catitem->image) {
		                                $catitem->imageLarge = '/'.$catitem->imageDefault;
		                            }
		
		                            $catitem->imageXLarge = ZenToolsHelper::getResizedImage($catitem->image, ($width *1.75), ($height * 1.75), $option);
		
		                            if($catitem->imageXLarge == $catitem->image) {
		                                $catitem->imageXLarge = '/'.$catitem->imageDefault;
		                            }
		                        }
		                    }
        						                    
        						                    
        						$catitem->text = $catitem->description;
        						
        						
        						$catitem->featured=null;
        						$catitem->date = false;
        						$catitem->category = false;
        						$catitem->catlink = false;
        						$catitem->featured = 0;
        						$catitem->newlink = 0;
        						$catitem->id = false;
        						$catitem->video =false;
        						$catitem->authorLink=false;
        						$catitem->author=false;
        						$catitem->avatar=false;
       							$catitem->comments=false;
       							$catitem->isfeatured=false;
       							
       							$catitem->more=null;
       							
        						$items[] = $catitem;
        					}
        				}
        
        				return $items;
        
    }
}
