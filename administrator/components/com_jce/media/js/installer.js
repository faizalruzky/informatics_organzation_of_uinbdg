/* JCE Editor - 2.4.0RC1 | 27 May 2014 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2014 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
(function($){Joomla.submitbutton=submitbutton=function(button){try{Joomla.submitform(button);}catch(e){submitform(button);}};$.jce.Installer={options:{},init:function(options){$.extend(this.options,options||{});$(":file").upload(this.options);var n=$('#tabs-plugins, #tabs-extensions, #tabs-languages, #tabs-related').find('input[type="checkbox"]');$(n).click(function(){$('input[name="boxchecked"]').val($(n).filter(':checked').length);});$('#upload_button').click(function(e){$(this).addClass('loading');$('input[name="task"]').val('install');$('form[name="adminForm"]').submit();e.preventDefault();});$('button.install_uninstall').click(function(e){if($('div#tabs input:checkbox:checked').length){$(this).addClass('ui-state-loading');$('input[name="task"]').val('remove');$('form[name="adminForm"]').submit();}
e.preventDefault();});}};$(document).ready(function(){$.jce.Installer.init();});})(jQuery);