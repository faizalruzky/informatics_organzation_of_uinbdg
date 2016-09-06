<?php
/**
* @package Author
* @author Joomla Bamboo
* @website www.joomlabamboo.com
* @email design@joomlabamboo.com
* @copyright Copyright (c) 2013 Joomla Bamboo. All rights reserved.
* @license GNU General Public License version 2 or later
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Create a select list of icons so we don't have to repeat it in the xml
class JFormFieldFoundicon extends JFormField
{

	protected $type = 'foundicon';

	protected function getInput()
	{
		// List options

		$icons = array(
			"-1" => "No Icon",
			"foundicon-dribbble" => "Dribbble",
			"foundicon-rss" => "Rss",
			"foundicon-facebook" => "Facebook",
			"foundicon-twitter" => "Twitter",
			"foundicon-pinterest" => "Pinterest",
			"foundicon-github" => "Github",
			"foundicon-path" => "Path",
			"foundicon-linkedin" => "Linked In",
			"foundicon-stumble-upon" => "Stumble Upon",
			"foundicon-behance" => "Behance",
			"foundicon-reddit" => "Reddit",
			"foundicon-google-plus" => "Google Plus",
			"foundicon-youtube" => "Youtube",
			"foundicon-vimeo" => "Vimeo",
			"foundicon-flickr" => "Flickr",
			"foundicon-slideshare" => "Slideshare",
			"foundicon-skype" => "Skype",
			"foundicon-steam" => "Steam",
			"foundicon-instagram" => "Instagram",
			"foundicon-foursquare" => "Four Square",
			"foundicon-delicious" => "Delicious",
			"foundicon-chat" => "Chat",
			"foundicon-torso" => "Torso",
			"foundicon-tumblr" => "Tumblr",
			"foundicon-video-chat" => "Video Chat",
			"foundicon-digg" => "Digg",
			"foundicon-wordpress" => "Wordpress",
			);

		return JHTML::_('select.genericlist',  $icons, ''.$this->formControl.'[params]['.$this->fieldname.'][]',
			'class="inputbox" style="" ', 'id', 'title', $this->value, $this->id
		);
	}

}

?>