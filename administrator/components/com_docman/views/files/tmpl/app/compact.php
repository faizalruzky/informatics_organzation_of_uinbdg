<?php
/**
 * @version     $Id: compact.php 1674 2012-05-04 16:58:52Z stiandidriksen $
 * @package     Nooku_Components
 * @subpackage  Files
 * @copyright   Copyright (C) 2011 - 2013 Timble CVBA (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */
defined('KOOWA') or die( 'Restricted access' ); 

$can_upload = JFactory::getUser()->authorise('com_docman.upload', 'com_docman');
?>

<?= @helper('com://admin/extman.template.helper.behavior.jquery'); ?>
<?= @template('com://admin/docman.view.files.tmpl.app.initialize');?>

<script src="media://com_files/js/files.compact.js" />

<style>
#files-compact #details {
	height: 388px \0/; /* IE needs this */
}
</style>

<script>
Files.sitebase = '<?= $sitebase; ?>';
Files.token = '<?= $token; ?>';

window.addEvent('domready', function() {

    //Workaround for templates that incorrectly wrap &tmpl=component views breaking the layout
    document.id('files-compact').getParents().setStyles({width: 'auto', padding: 0, margin: 0});

	var config = <?= json_encode($state->config); ?>,
		options = {
            cookie: {
                path: '<?=$this->getView()->baseurl?>'
            },
            pathway: false,
			state: {
				defaults: {
					limit: 0,
					offset: 0
				}
			},
			editor: <?= json_encode($state->editor); ?>,
			tree: {
				theme: 'media://com_files/images/mootree.png'
			},
			types: <?= json_encode($state->types); ?>,
			container: <?= json_encode($state->container ? $state->container->slug : null); ?>,
            onBeforeSetContainer: function(response) {
                response.container.title = <?= json_encode('Root') ?>;
            }
		};
	options = Object.append(options, config);

	Files.app = new Files.Compact.App(options);
	Files.app.grid.removeEvents('clickImage');
	Files.app.grid.addEvent('clickImage', function(e) {
		var target = document.id(e.target),
	    node = target.getParent('.files-node-shadow') || target.getParent('.files-node');
    
    	node.getParent().getChildren().removeClass('active');
    	node.addClass('active');
    	var row = node.retrieve('row');
    	var copy = Object.append({}, row);
    	copy.template = 'details_image';
    
    	Files.app.preview.empty();
    
    	copy.render('compact').inject(Files.app.preview);

    	var url = Files.app.createRoute({option: 'com_docman', view: 'file', format: 'raw', routed: 1, name: copy.path})
    	Files.app.preview.getElement('img').set('src', url);
    });

	$('files-new-folder-create').addEvent('click', function(e){
		e.stop();
		var element = $('files-new-folder-input');
		var value = element.get('value');
		if (value.length > 0) {
			var folder = new Files.Folder({name: value, folder: Files.app.getPath()});
			folder.add(function(response, responseText) {
				element.set('value', '');
				$('files-new-folder-create').removeClass('valid').setProperty('disabled', 'disabled');
				var el = response.item;
				var cls = Files[el.type.capitalize()];
				var row = new cls(el);

				Files.app.tree.selected.insert({
					text: row.name,
					id: row.path,
					data: {
						path: row.path,
						url: '#'+row.path,
						type: 'folder'
					}
				});
				Files.app.tree.selected.toggle(false, true);
			});
		};
	});
	var validate = function(){
		if(this.value.trim()) {
			$('files-new-folder-create').addClass('valid').removeProperty('disabled');
		} else {
			$('files-new-folder-create').removeClass('valid').setProperty('disabled', 'disabled');
		}
	};
	$('files-new-folder-input').addEvent('change', validate);
	if(window.addEventListener) {
		$('files-new-folder-input').addEventListener('input', validate);
	} else {
		$('files-new-folder-input').addEvent('keyup', validate);
	}

	$$('#tabs-pane_insert dt').addEvent('click', function(){
		setTimeout(function(){window.fireEvent('refresh');}, 300);
	});
});
</script>

<?= @template('com://admin/files.view.files.templates_compact');?>

<div id="files-compact">
	<?=	@helper('tabs.startPane', array('id' => 'pane_insert')); ?>
	<?= @helper('tabs.startPanel', array('title' => 'Insert')); ?>
		<div id="insert">
			<div id="files-tree-container" style="float: left">
				<div id="files-tree"></div>

				<div id="files-new-folder-modal" style="display: <?= $can_upload ? 'block' : 'none'; ?>">
					<form class="form">
						<div class="input-append">
							<input class="span2 focus" type="text" id="files-new-folder-input" placeholder="<?= @text('Enter a folder name') ?>" /><button id="files-new-folder-create" class="btn" disabled><?= @text('Create'); ?></button>
				        </div>
					</form>
				</div>
			</div>

			<div id="files-grid" style="float: left"></div>
			<div id="details" style="float: left;">
				<div id="files-preview"></div>
			</div>
			<div class="clear" style="clear: both"></div>
		</div>
	<?= @helper('tabs.endPanel'); ?>
	<? if ($can_upload): ?>
	<?= @helper('tabs.startPanel', array('title' => @text('Upload'))); ?>

		<?= @template('uploader'); ?>

	<?= @helper('tabs.endPanel'); ?>
	<? endif; ?>
	<?= @helper('tabs.endPane'); ?>
</div>

<script>
/* Modal fixes that applies when this view is loaded within an iframe in a modal view */
window.addEvent('domready', function(){
	if(window.parent && window.parent != window && window.parent.SqueezeBox) {
		var modal = window.parent.SqueezeBox;

		document.id('files-compact').getParents().setStyles({padding: 0, margin: 0, overflow: 'hidden'});

        //Height fixes for parent modal
        var fixHeight = function(){
            var newHeight = document.id('files-compact').measure(function(){return this.getSize().y;});
            window.parent.document.id('sbox-content').getElement('iframe').set('height', newHeight);
            modal.fx.win.set({height: newHeight});
        };
        document.getElements('#tabs-pane_insert dt, .upload-buttons li').addEvent('click', fixHeight);
        fixHeight();
        window.addEvent('QueueChanged', fixHeight);
	}
});
</script>