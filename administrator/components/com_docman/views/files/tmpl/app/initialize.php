<?php
/**
 * @package     Nooku_Components
 * @subpackage  Files
 * @copyright   Copyright (C) 2011 - 2013 Timble CVBA (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */
defined('KOOWA') or die( 'Restricted access' );

/* DEBUG FILES:
<script src="media://com_files/js/spin.min.js" />

<script src="media://com_files/js/files.utilities.js" />
<script src="media://com_files/js/files.state.js" />
<script src="media://com_files/js/files.template.js" />
<script src="media://com_files/js/files.grid.js" />
<script src="media://com_files/js/files.tree.js" />
<script src="media://com_files/js/files.row.js" />
<script src="media://com_files/js/files.paginator.js" />
<script src="media://com_files/js/files.pathway.js" />

<script src="media://com_files/js/files.app.js" />
*/
?>

<?= @helper('behavior.mootools'); ?>
<?= @helper('behavior.keepalive'); ?>
<?= @helper('behavior.tooltip'); ?>
<?= @helper('behavior.modal'); ?>

<!--
<script src="media://com_files/js/history/history.js" />
<? if (JBrowser::getInstance()->getBrowser() === 'msie'): ?>
<script src="media://com_files/js/history/history.html4.js" />
<? endif; ?>

<script src="media://com_files/js/ejs/ejs.js" />

<script src="media://lib_koowa/js/koowa.js" />
<script src="media://system/js/mootree.js" />

<script src="media://com_files/js/files.min.js" />

<script src="media://com_docman/js/sidebar.js" />
-->