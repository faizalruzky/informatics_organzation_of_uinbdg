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

require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php');
require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'modules.php');


abstract class ModZentoolsEasyBlogHelper
{
    public static function getList(&$params, $id, $handleImages = false)
    {
        $config	= EasyBlogHelper::getConfig();
		$count = (INT)trim($params->get('count', 0));
		$model 	= EasyBlogHelper::getModel( 'Blog' );
		$cid		= '';
		$categories	= $params->get( 'ebcatid', '' );
		$categories	= trim( $categories );
		$type		= !empty( $categories ) ? 'category' : '';
		$showcmmtCount	= $params->get('showcommentcount', 0);
		
				
		
		// Zentools
		$wordCount  = $params->get( 'wordCount','');
        $titlewordCount = $params->get( 'titlewordCount','');
        $strip_tags = $params->get('strip_tags',0);
        $titleSuffix = $params->get('titleSuffix','');
        $tags   = $params->get( 'allowed_tags','');
		$layout   = $params->get( 'layout','');
		
        // Image Size and container, remove px if user entered
        $responsiveimages = $params->get('responsiveimages');
        $resizeImage = $params->get('resizeImage',1);
        $option = $params->get( 'option', 'crop');
        $img_width = str_replace('px', '', $params->get( 'image_width','170'));
        $img_height = str_replace('px', '', $params->get( 'image_height','85'));

        $thumb_width = str_replace('px', '', $params->get( 'thumb_width','20'));
        $thumb_height = str_replace('px', '', $params->get( 'thumb_height','20'));

        // Other Params
        $dayFormat      = $params->get('dayFormat', 'none');
        $dateFormat      = $params->get('dateFormat', 'j');  
        $monthFormat      = $params->get('monthFormat', 'M'); 
        $yearFormat      = $params->get('yearFormat', 'y');
        $dateOrder     = $params->get('dateOrder', 'day-date-month-year');
        $dateSeparator      = ($params->get('dateSeparator', ' ') == ' ' ? $params->get('dateSeparator', ' ') : '<span class="zendatesep">'.$params->get('dateSeparator', ' ').'</span>');  
        $dateString     = $params->get('dateString', 'DATE_FORMAT_LC3');
        $translateDate      = $params->get('translateDate', '0');

        $link   = $params->get( 'link','');
        $textsuffix = $params->get( 'textsuffix','');

        // Lightbox
        $modalVideo = $params->get('modalVideo');
        $modalText = $params->get('modalText');
        $modalTitle = $params->get('modalTitle');
        $modalMore = $params->get('modalMore');
        
        
        // Date
        $dayFormat      = $params->get('dayFormat', 'none');
        $dateFormat      = $params->get('dateFormat', 'j');  
        $monthFormat      = $params->get('monthFormat', 'M'); 
        $yearFormat      = $params->get('yearFormat', 'y');
        $dateOrder     = $params->get('dateOrder', 'day-date-month-year');
        $dateSeparator      = ($params->get('dateSeparator', ' ') == ' ' ? $params->get('dateSeparator', ' ') : '<span class="zendatesep">'.$params->get('dateSeparator', ' ').'</span>');  
        $dateString     = $params->get('dateString', 'DATE_FORMAT_LC3');
        $translateDate      = $params->get('translateDate', '0');
        
		
		
		

		if( !empty( $categories ) )
		{
			$categories = explode( ',' , $categories );
			$cid		= $categories;
		}

		$posts = $model->getBlogsBy($type, $cid, 'popular' , $count , EBLOG_FILTER_PUBLISHED, null, false);
		$result         = array();

		for($i = 0; $i < count($posts); $i++)
		{
			$data 	=& $posts[$i];
			$row 	= EasyBlogHelper::getTable( 'Blog', 'Table' );
			$row->bind( $data );

			// @rule: Before anything get's processed we need to format all the microblog posts first.
			if( !empty( $row->source ) )
			{
				EasyBlogHelper::formatMicroblog( $row );
			}

			
			$row->commentCount 	= EasyBlogHelper::getCommentCount($row->id);
			
			
			// Zentools
						
			// Date
			if (!$translateDate) {
			    $day = ($dayFormat === 'none' ? '' : '<span class="zenday">'.EasyBlogDateHelper::toFormat( EasyBlogHelper::getDate( $row->created ) , $params->get( 'dateformat' , $dayFormat ) ).'</span>');
			    $date = ($dateFormat === 'none' ? '' : '<span class="zendayinmonth">'.EasyBlogDateHelper::toFormat( EasyBlogHelper::getDate( $row->created ) , $params->get( 'dateformat' , $dateFormat ) ).'</span>');
			    $month = ($monthFormat === 'none' ? '' : '<span class="zenmonth">'.EasyBlogDateHelper::toFormat( EasyBlogHelper::getDate( $row->created ) , $params->get( 'dateformat' , $monthFormat ) ).'</span>');
			    $year = ($yearFormat === 'none' ? '' : '<span class="zenyear">'.EasyBlogDateHelper::toFormat( EasyBlogHelper::getDate( $row->created ) , $params->get( 'dateformat' , $yearFormat ) ).'</span>');
			    
			  
			   // $row->date = date($dateFormat,  (strtotime($row->created)));
			    if ($dateOrder === 'day-year-month-day') {
			        $row->date = ($dayFormat === 'none' ? '' : $day.' ').$year.($monthFormat === 'none' ? '' : $dateSeparator).$month.($dateFormat === 'none' ? '' : $dateSeparator).$date;
			    } else {
			        $row->date = ($dayFormat === 'none' ? '' : $day.' ').$date.($monthFormat === 'none' ? '' : $dateSeparator).$month.($yearFormat === 'none' ? '' : $dateSeparator).$year;
			    }
			}
			else {
			    $row->date			=  JHTML::_('date', $row->created, JText::_(''.$dateString.''));
			    
			}
		
			$row->intro			= EasyBlogHelper::getHelper( 'Videos' )->strip( $row->intro);
			
			$row->video =null;
			$row->featured = null;
			$row->metakey = null;
			$row->extrafields = null;
			
			/**
			*
			* Easyblog title
			*
			**/
			$titletext = htmlspecialchars( $row->title );
			$row->modaltitle = htmlspecialchars( $row->title );
			$row->title = $titlewordCount ? ZenToolsHelper::truncate($titletext, $titlewordCount, $titleSuffix) : $titletext;
			
			
			
			/**
            *
            * Easyblog Intro Text
            *
            **/

            if($strip_tags) {
                $introtext = $strip_tags ? ZenToolsHelper::_cleanIntrotext($row->intro,$tags) : $row->intro;
            }
            else {
                $introtext = $row->intro;
            }

            if($wordCount !=="-1") {
                $tempintro = false;
                $row->text = $wordCount ? ZenToolsHelper::truncate($introtext, $wordCount, $textsuffix) : $tempintro;
            }
            else {
                $row->text = $row->introtext;
                $row->text = $row->text.$textsuffix;
            }
			
			
			
			/**
			*
			* Easyblog Images
			*
			**/
			
			$handleImages = 1;
			
			if($layout == "leading") {
				if($key > 0) {
					$handleImages = 0;
				}
				else {
					$handleImages = 1;
				}
			}
			
			if ($handleImages) {
				
				$isImage    = $row->getImage();
				if( isset($row->image)) {
					$media = json_decode($row->image);
					if(isset($media->url)) {
						$row->image = $media->url;
					}
				} else {
					$imghtml= $row->intro;
					$imghtml .= "alt='...' title='...' />";
					$pattern = '/<img[^>]+src[\\s=\'"]';
					$pattern .= '+([^"\'>\\s]+)/is';
					if(preg_match(
					$pattern,
					$imghtml,
					$match))
					$row->image = "$match[1]";
					else $row->image = "";
				}
				
				 $row->modaltext = $row->text;
				
                	$modalImage = $params->get('modalImage',0);
                
                	if($modalImage) {
                	    $row->modaltext = preg_replace('/<img(.*)>/i','',$row->modaltext,1);
                	}
                
                 /**
                *
                * Joomla 1.7 & Joomla 2.5 Resize Images
                *
                **/
                $row->thumb="";
                $row->modalimage="";

                if(!empty($row->image))
                {
                    // Sets the modal image
                    $row->modalimage = $row->image;
                    $row->imageOriginal = $row->image;

                    if ($resizeImage) {
                            $row->image = ZenToolsHelper::handleRemoteImage($row->image);
                            $row->image = ZenToolsHelper::getResizedImage($row->image, $img_width, $img_height, $option);

                            if($responsiveimages) {
                                $row->imageTiny = ZenToolsHelper::getResizedImage($row->image, ($img_width /5), ($img_height / 5), $option);
                                $row->imageXSmall = ZenToolsHelper::getResizedImage($row->image, ($img_width /3), ($img_height / 3), $option);
                                $row->imageSmall = ZenToolsHelper::getResizedImage($row->image, ($img_width /2), ($img_height / 2), $option);
                                $row->imageMedium = ZenToolsHelper::getResizedImage($row->image, ($img_width /1.25), ($img_height / 1.25), $option);
                                $row->imageDefault = ZenToolsHelper::getResizedImage($row->image, ($img_width), ($img_height), $option);
                                $row->imageLarge = ZenToolsHelper::getResizedImage($row->image, ($img_width * 1.25), ($img_height * 1.25), $option);
                                if($row->imageLarge == $row->image) {
                                    $row->imageLarge = '/'.$row->imageDefault;
                                }
                                $row->imageXLarge = ZenToolsHelper::getResizedImage($row->image, ($img_width *1.75), ($img_height * 1.75), $option);

                                if($row->imageXLarge == $row->image) {
                                    $row->imageXLarge = '/'.$row->imageDefault;
                                }
                            }
                    }
                    else {
                        if($responsiveimages) {
                            $row->image = ZenToolsHelper::handleRemoteImage($row->image);

                            list($width, $height) = getimagesize($row->image);
                            $row->imageTiny = ZenToolsHelper::getResizedImage($row->image, ($width /5), ($height / 5), 'exact');
                            $row->imageXSmall = ZenToolsHelper::getResizedImage($row->image, ($width /3), ($height / 3), 'exact');
                            $row->imageSmall = ZenToolsHelper::getResizedImage($row->image, ($width /2), ($height / 2), 'exact');
                            $row->imageMedium = ZenToolsHelper::getResizedImage($row->image, ($width /1.5), ($height / 1.25), 'exact');
                            $row->imageDefault = ZenToolsHelper::getResizedImage($row->image, ($width), ($height), 'exact');
                            $row->imageLarge = ZenToolsHelper::getResizedImage($row->image, ($width * 1.25), ($height * 1.25), $option);
                            if($row->imageLarge == $row->image) {
                                $row->imageLarge = '/'.$row->imageDefault;
                            }

                            $row->imageXLarge = ZenToolsHelper::getResizedImage($row->image, ($width *1.75), ($height * 1.75), $option);

                            if($row->imageXLarge == $row->image) {
                                $row->imageXLarge = '/'.$row->imageDefault;
                            }
                        }
                    }

                    $row->thumb = ZenToolsHelper::getResizedImage($row->image, $thumb_width, $thumb_height,  $option);
                }
            }
            else {
                $row->image = '';
            }
                
				
			
       		
       		  /**
            *
            * Joomla Links
            *
            **/
        	if($link == 0) {
                $row->link = '';
                $row->closelink = '';
            }
            elseif($link == 1) {
                if($modalMore or $modalTitle or $modalText) {
                    $row->link = 'href="#data'.$row->id.'"';
                }
                else {
                    $row->link = 'href="'.$row->modalimage.'" title="'.$row->modaltitle.'"';
                }
                $row->closelink = '</a>';
                $row->lightboxmore = 'href="'.EasyBlogRouter::_( 'index.php?option=com_easyblog&view=entry&id=' . $row->id ).'"';
            }
            else {
                $row->link = 'href="'.EasyBlogRouter::_( 'index.php?option=com_easyblog&view=entry&id=' . $row->id ).'"';
                $row->closelink = '</a>';
            }


            

            /**
            *
            * Joomla 1.7 & Joomla 2.5 Category Name and Link
            *
            **/
            
            
			// Category Link
			$catlink = EasyBlogRouter::_( 'index.php?option=com_easyblog&view=categories&layout=listings&id=' . $row->category_id);
            $row->catlink = '<a href="'.$catlink.'">';
            
            
            // Get Category name
			$db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('title');
            $query->from($db->quoteName('#__easyblog_category'));
            $query->where($db->quoteName('id')." = ".$db->quote($row->category_id));
             
            $db->setQuery($query);
            $result = $db->loadResult();
        	$row->category = $result;
        	
        	
        	/**
        	*
        	* Tags
        	*
        	**/
			$row->tags = null;
			$post_tags	= self::_getPostTagIds( $row->id );

			
			if(!empty($post_tags)) {
				
				$row->tags = $post_tags;
				
			}
			
			/**
			*
			* Comment Count
			*
			**/
			
			$row->comments 	= EasyBlogHelper::getCommentCount($row->id);
			
			if(EasyBlogHelper::getCommentCount($row->id) == 0) {
				$row->comments = '0 Comments';
			}
			elseif(EasyBlogHelper::getCommentCount($row->id) < 2) {
				$row->comments 	= EasyBlogHelper::getCommentCount($row->id).' comment';
			}
			else {
				$row->comments 	= EasyBlogHelper::getCommentCount($row->id).' comments';
			}
			
			
			
			/**
			*
			* Author
			*
			**/
			$author = EasyBlogHelper::getTable( 'Profile', 'Table' );
			
			$author = $author->load( $row->created_by );
			$row->author =	$author->nickname;
			$row->authorLink = 'index.php?option=com_easyblog&view=blogger&layout=listings&id='.$row->created_by;
			$row->avatar =	'images/easyblog_avatar/'.$author->avatar;

			$items[]   = $row;
		}

		return $items;
 
    }
    
    
    static function _getPostTagIds( $postId )
    	{
    		static $tags	= null;
    
    		if( ! isset($tags[$postId]) )
    		{
    			$db = EasyBlogHelper::db();
    
    			$query  = 'select `tag_id` from `#__easyblog_post_tag` where `post_id` = ' . $db->Quote($postId);
    			$db->setQuery($query);
    
    			$result = $db->loadResultArray();
    
    			if( count($result) <= 0 )
    				$tags[$postId] = false;
    			else
    				$tags[$postId] = $result;
    
    		}
    
    		return $tags[$postId];
    	}
    	
    	
    static function _getPostTagTitle( $postId )
    	{
    		static $tags	= null;
    
    		if( ! isset($tags[$postId]) )
    		{
    			$db = EasyBlogHelper::db();
    			$query  = 'select `title` from `#__easyblog_tag` where `id` = ' . $db->Quote($postId);
    			$db->setQuery($query);
    
    			$result = $db->loadResultArray();
    
    			if( count($result) <= 0 )
    				$tags[$postId] = false;
    			else
    				$tags[$postId] = $result;
    
    		}
    
    		return $tags[$postId];
    	}
}
