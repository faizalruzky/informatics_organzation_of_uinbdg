<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();
$homeLink = $menu->getActive() == $menu->getDefault( $lang->getTag() ) ? 1 : 0;

?>

<!-- FOOTER -->
<footer id="footerwrap" class="wrap zen-footer">
  <section class="zen-copyright">
    <div class="zen-container">
      <div class="row-fluid">
        <div class="span8 copyright">
          <jdoc:include type="modules" name="<?php $this->_p('footer') ?>" style="jbChrome" />
        </div>
       
        </div>
      </div>
    </div>
  </section>
</footer>
<jdoc:include type="modules" name="<?php $this->_p('debug') ?>" style="jbChrome" />
<!-- //FOOTER -->