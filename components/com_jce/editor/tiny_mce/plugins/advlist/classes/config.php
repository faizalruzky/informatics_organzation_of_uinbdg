<?php

/**
 * @package   	JCE
 * @copyright 	Copyright (c) 2009-2014 Ryan Demmer. All rights reserved.
 * @license   	GNU/GPL 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * JCE is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class WFAdvlistPluginConfig {
    
    public static function getConfig(&$settings) {
        
        $bullet = self::getBulletList();
        $settings['advlist_bullet_styles'] = empty($bullet) ? false : implode(',', $bullet);
        
        $number = self::getNumberList();
        $settings['advlist_number_styles'] = empty($number) ? false : implode(',', $number);
    }
    
    private static function getNumberList() {
        $wf = WFEditor::getInstance();     
        $number = (array) $wf->getParam('lists.number_styles', array('lower-alpha','lower-greek','lower-roman','upper-alpha','upper-roman'));
        
        if (count($number) === 1 && array_shift($number) === 'default') {
            return false;
        }
        
        return $number;
    }
    
    private static function getBulletList() {
        $wf = WFEditor::getInstance();     
        $bullet = (array) $wf->getParam('lists.bullet_styles', array('circle','disc','square'));
        
        if (count($bullet) === 1 && array_shift($bullet) === 'default') {
            return false;
        }
        
        return $bullet;
    }

}

?>
