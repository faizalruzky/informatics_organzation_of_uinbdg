/**
 * @package		Zen Tools
 * @subpackage	Zen Tools
 * @author		Joomla Bamboo - design@joomlabamboo.com
 * @copyright 	Copyright (c) 2014 Joomla Bamboo. All rights reserved.
 * @license		GNU General Public License version 2 or later
 * @version		1.12.0
 */

// The following is the basic sort and order script
//
//
//
// set the list selector
var usedList = "#sortable";
var unusedList = "#sortable2";


// function that writes the list order to a cookie
function getOrder() {
	// save custom order to cookie
	jQuery("#jform_params_useditems").val(jQuery(usedList).sortable("toArray"));
	jQuery("#jform_params_unuseditems").val(jQuery(unusedList).sortable("toArray"));
}


// function that restores the list order from a cookie
function restoreOrder() {
	var list = jQuery(usedList);
	if (list == null) return

	// fetch the cookie value (saved order)
	var useditems = jQuery("#jform_params_useditems").val();
	var unuseditems = jQuery("#jform_params_unuseditems").val();
		if (!useditems) return;

	// make array from saved order
	var IDs = useditems.split(",");
	var unusedIDs = unuseditems.split(",");


	// fetch current order
	var items = list.sortable("toArray");

	// make array from current order
	var rebuild = new Array();
	for ( var v=0, len=IDs.length; v<len; v++ ){
		rebuild[IDs[v]] = IDs[v];
	}

	for (var i = 0, n = IDs.length; i < n; i++) {

		// item id from saved order
		var itemID = IDs[i];

		if (itemID in rebuild) {

			// select item id from current order
			var item = rebuild[itemID];

			// select the item according to current order
			var child = jQuery("ui-sortable").children("#" + item);

			// select the item according to the saved order
			var savedOrd = jQuery("ui-sortable").children("#" + itemID);

			// remove all the items
			child.remove();

			// add the items in turn according to saved order
			// we need to filter here since the "ui-sortable"
			// class is applied to all ul elements and we
			// only want the very first!  You can modify this
			// to support multiple lists - not tested!
			jQuery("ul.ui-sortable").filter(":first").append(savedOrd);


		}
	}
}


// Hide / Show relevant panels on page load
jQuery(function() {

	// Sets the relevant selectors to associate with various parameters
	text = "a[href=#attrib-text]";
	image = "a[href=#attrib-imageresize]";
	accordionPanel = "a[href=#attrib-accordion]";
	slideshowPanel = "a[href=#attrib-slideshow]";
	gridPanel = "a[href=#attrib-grid]";
	carouselPanel = "a[href=#attrib-carousel]";
	filterPanel = "a[href=#attrib-filter]";
	easyblogPanel = "a[href=#attrib-easyblog]";
	categoryPanel = "a[href=#attrib-jcategories]";
	masonryPanel = "a[href=#attrib-masonry]";
	panelcontent = "a[href=#attrib-content]";
	authorPanel = "a[href=#attrib-author]";
	panelk2 = "a[href=#attrib-K2]";
	titlePanel = "a[href=#attrib-title]";
	more = "a[href=#attrib-readmore]";
	date = "a[href=#attrib-date]";
	columnwidthPanel = "a[href=#options-columnwidth]";
	lightboxpanel = "a[href=#attrib-fancybox]";
	imageSourcePanel = "a[href=#attrib-imageDirectory]";
	pagination= "a[href=#attrib-pagination]";
	twitterPanel = "a[href=#attrib-twitter]";
	imageSource = "#jform_params_contentSource option[value=1]";
	joomlaSource = "#jform_params_contentSource option[value=2]";
	k2Source = "#jform_params_contentSource option[value=3]";
	easyblogSource = "#jform_params_contentSource option[value=4]";
	categorySource = "#jform_params_contentSource option[value=5]";
	linkselect= "#jform_params_link :selected";
	linkselected= "#jform_params_link";
	externallinks = "#jform_params_extlinks";
	externallinkslbl = "#jform_params_extlinks-lbl";
	altlinks= "#jform_params_altlink_chzn";
	altlinkslbl= "#jform_params_altlink-lbl";
	overlayEffect = "#jform_params_overlayGrid";
	overlaygridOption = "#jform_params_overlayGrid option";
	paramslayoutoption = "#jform_params_layout option";
	paramscol1option = "#jform_params_col1Width option";
	paramscol1lbl = "#jform_params_col1Width-lbl";
	paramscol1 = "#jform_params_col1Width";
	paramscol2lbl = "#jform_params_col2Width-lbl";
	paramscol2 = "#jform_params_col2Width";
	paramscol3lbl = "#jform_params_col3Width-lbl";
	paramscol3 = "#jform_params_col3Width";
	paramscol4lbl = "#jform_params_col4Width-lbl";
	paramscol4 = "#jform_params_col4Width";
	paramscol2option = "#jform_params_col2Width option";
	paramscol3option = "#jform_params_col3Width option";
	paramscol4option = "#jform_params_col4Width option";
	paramscatfilter = '#jform_params_categoryFilter option';
	paramsgridsperrow = '#jform_params_imagesPerRow option';
	paramsmasonrywidths = '#jform_params_masonryWidths option';
	paramsmasonrywidthsselected = '#jform_params_masonryWidths selected';
	paramsmasonrycolwidths = '#jform_params_masonryColWidths option';
	paramsslideshowThemeOption = '#jform_params_slideshowTheme option';
	paramsoverlayAnimation = '#jform_params_overlayAnimation1';
	paramslink1 = '#jform_params_link1';
	paramsmodalTitle0 = "#jform_params_modalTitle";
	paramsmodalText0 = "#jform_params_modalText";
	paramsmodalVideo0 = "#jform_params_modalVideo";
	paramslayoutSelected = "#jform_params_layout :selected";
	paramsslideshowPaginationType = "#jform_params_slideshowPaginationType";
	paramsslideshowPaginationTypeSelected = "#jform_params_slideshowPaginationType :selected";
	itemsperpage = "#jform_params_itemsperpage";
	itemsperpagelbl = "#jform_params_itemsperpage-lbl";
	slideshowPaginationPos = '#jform_params_slideshowPaginationPos';
	slideshowPaginationPosLbl = '#jform_params_slideshowPaginationPos-lbl';
	thumbwidth = "#jform_params_thumb_width";
	thumbwidthlbl = "#jform_params_thumb_width-lbl";
	thumbheight = "#jform_params_thumb_height";
	thumbheightlbl = "#jform_params_thumb_height-lbl";
	linktargetlbl= "#jform_params_linktarget-lbl";
	linktarget= "#jform_params_linktarget_chzn";
	k2imagetypelbl = "#jform_params_itemImgSize-lbl";
	k2imagetype = "#jform_params_itemImgSize_chzn";
	k2imageoptions = ".k2imageoptions";
	slideTitleWidth = "#jform_params_slideTitleWidth";
	slideTitleWidthlbl = "#jform_params_slideTitleWidth-lbl";
	slideTitleTheme = "#jform_params_slideshowTitleTheme";
	slideTitleThemelbl = "#jform_params_slideshowTitleTheme-lbl";
	slideTitleBreak = "#jform_params_slideTitleHide";
	slideTitleBreaklbl = "#jform_params_slideTitleHide-lbl";
	filterstartJoomla = "#jform_params_filterstart_joomla";
	filterstartJoomlalbl = "#jform_params_filterstart_joomla-lbl";
	filterstartK2 = "#jform_params_filterstart_k2";
	filterstartK2lbl = "#jform_params_filterstart_k2-lbl";
	


	// Param where we store the information
	current = "#jform_params_useditems";
	params = "#jform_params_layout";

	// Sortable Lists
	usedList = "#sortable";
	unusedList = "#sortable2";

	// Variables for sortable list elements
	var column2 = 0;
	var column3 = 0;
	var column4 = 0;

	col2 = 0;
	col3 = 0;
	col4 = 0;

	jQuery(this).availableTags();
	jQuery(this).initSortables();


	// This sets the layout type correctly if the user exited the module last time without applying the preset
	switch (jQuery(paramslayoutSelected).text()) {

		case '[Preset] Two column grid':
			jQuery('#jform_params_layout option')[0].selected = true;
		break;

		case '[Preset] Filtered grid':
			jQuery('#jform_params_layout option')[0].selected = true;
		break;

		case '[Preset] Overlay Slideshow':
			jQuery('#jform_params_layout option')[4].selected = true;
		break;

		case '[Preset] Flat Slideshow':
			jQuery('#jform_params_layout option')[4].selected = true;
		break;

		case '[Preset] Two column list':
			jQuery('#jform_params_layout option')[3].selected = true;
		break;

		case '[Preset] Three column list':
			jQuery('#jform_params_layout option')[3].selected = true;
		break;

		case '[Preset] Captify content grid':
			jQuery('#jform_params_layout option')[0].selected = true;
		break;

	};


	window.setContentSource = function()
	{
		jQuery(imageSourcePanel).parent().hide();
		jQuery(panelcontent).parent().hide();
		jQuery(panelk2).parent().hide();
		jQuery(filterPanel).parent().hide();
		jQuery(filterstartK2lbl).parent().parent().hide();
		jQuery(filterstartJoomlalbl).parent().parent().hide();
		jQuery(k2imageoptions).parent().parent().hide();
		jQuery(k2imagetype).parent().parent().hide();
		jQuery(k2imagetypelbl).parent().parent().hide();
		jQuery(easyblogPanel).parent().hide();
		jQuery(categoryPanel).parent().hide();

		if (jQuery(imageSource).is(':selected'))
		{
			jQuery(imageSourcePanel).parent().show();
		}
		else
		{
			jQuery(filterPanel).parent().show();

			if (jQuery(joomlaSource).is(':selected'))
			{
				jQuery(panelcontent).parent().show();
				jQuery(filterstartJoomlalbl).parent().parent().show();
			}
			else
			{
				if (jQuery(k2Source).is(':selected'))
				{
					jQuery(panelk2).parent().show();
					jQuery(filterstartK2lbl).parent().parent().show();
					jQuery(k2imagetype).parent().parent().show();
					jQuery(k2imagetypelbl).parent().parent().show();
					jQuery(k2imageoptions).parent().parent().show();
				}
			}

		}
		if(jQuery(easyblogSource).is(':selected')) {
			jQuery(easyblogPanel).parent().show();
			
			if(jQuery('#easyblog-installed').text() === '0') {
				alert('Easyblog needs to be installed in order to use this option.');
			}
		}
		if(jQuery(categorySource).is(':selected')) {
			jQuery(categoryPanel).parent().show();
		}
		
		jQuery(this).setSortables();
	}

	jQuery('#jform_params_contentSource').chosen().change(setContentSource);

	jQuery(paramsslideshowPaginationType).chosen().change(function() {
		var value = jQuery(this).val();

		jQuery(slideshowPaginationPos).parent().parent().hide();
		jQuery(slideshowPaginationPosLbl).parent().parent().hide();
		jQuery(thumbwidth).parent().parent().hide();
		jQuery(thumbwidthlbl).parent().parent().hide();
		jQuery(thumbheight).parent().parent().hide();
		jQuery(thumbheightlbl).parent().parent().hide();

		if (value != 'none') {
			jQuery(slideshowPaginationPos).parent().parent().show();
			jQuery(slideshowPaginationPosLbl).parent().parent().show();

			if (value === 'thumb') {
				jQuery(thumbwidth).parent().parent().show();
				jQuery(thumbwidthlbl).parent().parent().show();
				jQuery(thumbheight).parent().parent().show();
				jQuery(thumbheightlbl).parent().parent().show();
			}
		}
	});


	// Action for the set default item or apply preset button
	jQuery('#default').click(function(e) {

		// Cancel the default action
		e.preventDefault();

		// Figure out which default to set
		switch (jQuery(paramslayoutSelected).text()) {

			// Accordion
			case 'Accordion':
				jQuery(this).setAccordion();// Items used in the default accordion layout
				jQuery(this).accordionPanel();
			break;


			// Grid
			case 'Grid':
				jQuery(this).setGrid();
				jQuery(this).gridPanel();
			break;

			case '[Preset] Two column grid':
				jQuery(this).setGridTwoColumns();
			break;

			case '[Preset] Filtered grid':
				jQuery(this).setGridFiltered();
			break;

			case '[Preset] Captify content grid':
				jQuery(this).setGridCaptify();
			break;


			// Carousel
			case 'Carousel':
				jQuery(this).setCarousel();
			break;

			// Masonry
			case 'Masonry':
				jQuery(this).setMasonry();
			break;


			// Slideshow
			case 'Slideshow':
				jQuery(this).setSlideshow();
			break;

			case '[Preset] Overlay Slideshow':
				jQuery(this).setSlideshowOverlay();
			break;

			case '[Preset] Flat Slideshow':
				jQuery(this).setSlideshowFlat();
			break;


			// List
			case 'List':
				jQuery(this).setList();
			break;

			case '[Preset] Two column list':
				jQuery(this).setListTwoColumn();
			break;

			case '[Preset] Three column list':
				jQuery(this).setListThreeColumn();
			break;

			case '[Preset] Four column list':
				jQuery(this).setListFourColumn();
			break;


			// Single Item
			case 'Single Item Gallery':
				jQuery(this).setSingle();
			break;

			// Pagination
			case 'Pagination':
				jQuery(this).setPagination();
			break;

			// Leading Items
			case 'Leading item then list':
				jQuery(this).setLeading();
			break;
		};

		// The main function that sets the correct values for the lists
		jQuery(this).setSortables();

		// Layout Switch
		jQuery(this).layoutSwitch();
	});



	// Hide all of the elements
	jQuery(this).hideAllPanels();

	// Initialises sortables and checks if values are assigned correctly.
	jQuery(this).setSortables();

	// Layout Switch
	jQuery(this).layoutSwitch();


	// Slideshow Pagination type
	switch (jQuery(paramsslideshowPaginationTypeSelected).text()) {
		case 'Thumbs':
			jQuery(thumbwidth).parent().parent().show();
			jQuery(thumbwidthlbl).parent().parent().show();
			jQuery(thumbheight).parent().parent().show();
			jQuery(thumbheightlbl).parent().parent().show();
			break;
		case 'Titles':
			jQuery(slideTitleWidth).parent().parent().show();
			jQuery(slideTitleWidthlbl).parent().parent().show();
			jQuery(slideTitleTheme).parent().parent().show();
			jQuery(slideTitleThemelbl).parent().parent().show();
			jQuery(slideTitleBreak).parent().parent().show();
			jQuery(slideTitleBreaklbl).parent().parent().show();
			break;
	};

	switch(jQuery(paramsmasonrywidthsselected).text()) {
		case 'Use widths specified in meta keywords':
			jQuery("#jform_params_masonryColumnWidth-lbl,#jform_params_masonryColumnWidth,#jform_params_masonryGutter-lbl,#jform_params_masonryGutter,#jform_params_masonryColWidths-lbl,#jform_params_masonryColWidths").show();
			jQuery("#jform_params_masonryColWidths-lbl,#jform_params_masonryColWidths").parent().parent().hide();
			break;
		case 'Equalise widths of all elements':
			jQuery("#jform_params_masonryColumnWidth-lbl,#jform_params_masonryColumnWidth,#jform_params_masonryGutter-lbl,#jform_params_masonryGutter,#jform_params_masonryColWidths-lbl,#jform_params_masonryColWidths").hide();
			jQuery("#jform_params_masonryColWidths-lbl,#jform_params_masonryColWidths").parent().parent().show();
		break;
	}

	// Toggle for k2 content source
	if (jQuery('#jform_params_k2contentSource option[value=categories]').is(':selected')) {
		jQuery("#jform_params_itemid").parent().parent().hide();
		jQuery("#jform_params_category_id,#jform_params_category_id-lbl,#jform_params_getChildren,#jform_params_getChildren-lbl").parent().parent().show();
		jQuery(this).setSortables();
	}
	else
	{
		jQuery("#jform_params_itemid").parent().parent().show();
		jQuery("#jform_params_category_id,#jform_params_category_id-lbl,#jform_params_getChildren,#jform_params_getChildren-lbl").parent().parent().hide();
		jQuery(this).setSortables();
	}

	// Toggle for Joomla content source
	if (jQuery('#jform_params_joomlaContentSource option[value=categories]').is(':selected')) {
		jQuery("#jform_params_artids").parent().parent().hide();
		jQuery("#jform_params_catid").parent().parent().show();
		jQuery(this).setSortables();
	}
	else
	{
		jQuery("#jform_params_artids").parent().parent().show();
		jQuery("#jform_params_catid").parent().parent().hide();
		jQuery(this).setSortables();
	}
	
	// Extra link toggles
	if (jQuery('#jform_params_display_extralink option[value=1]').is(':selected')) {
		jQuery("#jform_params_add_btnclass-lbl").parent().parent().show();
		jQuery("#jform_params_extralink-lbl").parent().parent().show();
		jQuery("#jform_params_extralinktext-lbl").parent().parent().show();
	}
	else
	{
		jQuery("#jform_params_add_btnclass-lbl").parent().parent().hide();
		jQuery("#jform_params_extralink-lbl").parent().parent().hide();
		jQuery("#jform_params_extralinktext-lbl").parent().parent().hide();
	}
	
	
	
	jQuery('#jform_params_display_extralink').change(function() {
		// Extra link toggles
		if (jQuery('#jform_params_display_extralink option[value=1]').is(':selected')) {
			jQuery("#jform_params_add_btnclass-lbl").parent().parent().show();
			jQuery("#jform_params_extralink-lbl").parent().parent().show();
			jQuery("#jform_params_extralinktext-lbl").parent().parent().show();
		}
		else
		{
			jQuery("#jform_params_add_btnclass-lbl").parent().parent().hide();
			jQuery("#jform_params_extralink-lbl").parent().parent().hide();
			jQuery("#jform_params_extralinktext-lbl").parent().parent().hide();
		}
	});
	
	
		
	
	usedList= "#sortable";
	unusedList= "#sortable2";
	// here, we allow the user to sort the items
	jQuery(usedList).sortable({

			connectWith: ".connectedLists",
			cursor: "move",
			placeholder: "ui-state-highlight",
			scope: "tags",
			opacity: 0.8,
			dropOnEmpty: true,
			items: "li:not(.disabled)",
			revert: 200,

			update: function(event,ui) {

				jQuery("#zenmessage p").html("").show();
				jQuery("#zenmessage p").html("Settings updated").delay(600).fadeOut(300);

					// Layout Switch
					jQuery(this).layoutSwitch();

				getOrder();

				jQuery("li#empty").remove();

				var itemOrder = jQuery("#jform_params_useditems").val();

			}
	});

	jQuery(unusedList).sortable({
			cursor: "move",
			placeholder: "ui-state-highlight",
			scope: "tags",
			opacity: 0.8,
			dropOnEmpty: true,
			items: "li:not(.disabled)",
			revert: 200
	});


	jQuery("#sortable2,#sortable").sortable({
		connectWith: jQuery("#sortable,#sortable2")
	});

	// here, we reload the saved order
	restoreOrder();

	jQuery('#jform_params_link').change(function() {
		jQuery(this).layoutSwitch();
	});

	jQuery('#jform_params_joomlaContentSource').change(function() {
		// Toggle for Joomla content source
		// jform_params_contentSource option[value=1]
		if (jQuery('#jform_params_joomlaContentSource option[value=categories]').is(':selected')) {
			jQuery("#jform_params_artids").parent().parent().hide();
			jQuery("#jform_params_catid").parent().parent().show();
			jQuery(this).setSortables();
		}
		else
		{
			jQuery("#jform_params_artids").parent().parent().show();
			jQuery("#jform_params_catid").parent().parent().hide();
			jQuery(this).setSortables();
		}
	});

	jQuery('#jform_params_k2contentSource').change(function() {
		// Toggle for k2 content source
		if (jQuery('#jform_params_k2contentSource option[value=categories]').is(':selected')) {
			jQuery("#jform_params_itemid").parent().parent().hide();
			jQuery("#jform_params_category_id,#jform_params_category_id-lbl,#jform_params_getChildren,#jform_params_getChildren-lbl").parent().parent().show();
		}
		else
		{
			jQuery("#jform_params_itemid,#jform_params_itemid-lbl").parent().parent().show();
			jQuery("#jform_params_category_id,#jform_params_category_id-lbl,#jform_params_getChildren,#jform_params_getChildren-lbl").parent().parent().hide();
		}
	});

	jQuery(".panel input,.panel select,.panel input[type=radio]").change(function () {

		jQuery("#zenmessage p").html("").show();
		jQuery("#zenmessage p").html("Settings updated").delay(600).fadeOut(300);

		// Layout Switch
		jQuery(this).layoutSwitch();

		switch (jQuery('#jform_params_masonryWidths :selected').text()) {
			case 'Use widths specified in meta keywords':
				jQuery("#jform_params_masonryColumnWidth-lbl,#jform_params_masonryColumnWidth,#jform_params_masonryGutter-lbl,#jform_params_masonryGutter,#jform_params_masonryColWidths-lbl,#jform_params_masonryColWidths").show();
				jQuery("#jform_params_masonryColWidths-lbl,#jform_params_masonryColWidths").hide();
				break;

			case 'Equalise widths of all elements':
				jQuery("#jform_params_masonryColumnWidth-lbl,#jform_params_masonryColumnWidth,#jform_params_masonryGutter-lbl,#jform_params_masonryGutter,#jform_params_masonryColWidths-lbl,#jform_params_masonryColWidths").hide();
				jQuery("#jform_params_masonryColWidths-lbl,#jform_params_masonryColWidths").show();
				break;
		}



		// Slideshow Pagination type
		switch (jQuery(paramsslideshowPaginationTypeSelected).text()) {
			case 'Thumbs':
				jQuery(thumbwidth).parent().parent().show();
				jQuery(thumbwidthlbl).parent().parent().show();
				jQuery(thumbheight).parent().parent().show();
				jQuery(thumbheightlbl).parent().parent().show();
				break;
			case 'Titles':
				jQuery(slideTitleWidth + ',' + slideTitleWidthlbl + ',' + slideTitleTheme + ',' + slideTitleThemelbl  + ',' + slideTitleBreak  + ',' + slideTitleBreaklbl ).parent().parent().parent().show();
			break;
		};

		// This sets the layout type correctly if the user exited the module last time without applying the preset
		switch (jQuery(paramslayoutSelected).text()) {
			case '[Preset] Two column grid':
				jQuery(this).clickDefault();
			break;

			case '[Preset] Filtered grid':
				jQuery(this).clickDefault();
			break;

			case '[Preset] Overlay Slideshow':
				jQuery(this).clickDefault();
			break;

			case '[Preset] Flat Slideshow':
				jQuery(this).clickDefault();
			break;

			case '[Preset] Two column list':
				jQuery(this).clickDefault();
			break;

			case '[Preset] Three column list':
				jQuery(this).clickDefault();
			break;

			case '[Preset] Captify content grid':
				jQuery(this).clickDefault();
			break;
		};
	});

	jQuery('#jform_params_layout').chosen().change(function (event) {
		jQuery(this).layoutSwitch();
	});

	jQuery(document).on('ready', function() {
		window.setTimeout(function() {
			setContentSource();
			jQuery(this).layoutSwitch();
		}, 1000);
	});
	
	
	// Change the available tags when the content source changes
	
});