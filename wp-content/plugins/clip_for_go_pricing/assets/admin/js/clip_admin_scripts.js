/* Admin js */

(function ($, undefined) {
	"use strict";
		
	if (typeof(Storage) === 'undefined') {
		alert(GoPricingClipL10n.warning_nostorage);
		return;	
	}
				
	$(function () {	
		
		var clipColors = ['#90c820', '#ffbb00', '#d271e6', '#fa5541', '#00a4f9', '#545454', '#dcdcdc', 'transparent'],
			maxClipItems = 8;	
		
		/* Get the next color */
		var getClipColor = function($clipboard) {
			
			var $items = $clipboard.find('.gwa-clipboard-items').find('.gwa-clipboard-item'),
				usedColors = [];
				
			for (var x=0; x<$items.length; x++) {
				if ($items.eq(x).data('clipboard').color === undefined) continue;
				usedColors.push($items.eq(x).data('clipboard').color);
			};
			
			if (!usedColors.length) return clipColors[0];
			
			for (var x=0; x<clipColors.length; x++) {
				
				var index = usedColors.indexOf(clipColors[x]);
				if (index == -1) return clipColors[x];
				
			};
			
		};
		
		/* Collect data from fields */
		var getClipData = function($content, colInfo) {

			var data = {},
				returnData = {},
				BodyRowCount = 0,
				FooterRowCount = 0;					

			$.map( $content.find(":input"), function(n, i) {
		
				if ((n.type == 'checkbox' && n.checked === false) || n.name == '') return;
				if (n.type == 'textarea' && $(n).data('cm') !== undefined) $(n).data('cm').doc.cm.save();
				
				if (data[n.name] === undefined) {
						data[n.name] = { 'value' : $(n).val() };
				} else {
					if (data[n.name].value !== undefined) {
						var tmpdata = data[n.name];
						data[n.name] = [];
						data[n.name].push(tmpdata);
					} 
					data[n.name].push({ 'value' : $(n).val() });
				};
				
				if ($(n).closest('.gwa-col-box').not('.gwa-col-box-main').length && data[n.name].info === undefined) {
					data[n.name].info = $(n).closest('.gwa-col-box').find('.gwa-col-box-content').html();
				}
				
				if (n.name.match(/^col-data\[([0-9]+)\]\[body-row\]/g)) BodyRowCount++;
				if (n.name.match(/^col-data\[([0-9]+)\]\[footer-row\]/g)) FooterRowCount++;

			});	
			
			returnData = { 
				'data' : data,
				'body_row_count' : BodyRowCount,
				'footer_row_count' : FooterRowCount,								
			};
					
			return returnData;
			
		};

		/* Fill forms from data */
		var setClipData = function(data, $content, index) {
			
			resetUi($content);

			for (var x in data) {
				
				if (x == '') continue;
				
				if (index !== undefined) {
					var modx = x.replace(/col-data\[([0-9]+)\]/g, 'col-data['+(index)+']');				
				} else {
					var modx = x;
				}

				if ($.type( data[x] ) === "array") {
					var z = data[x];
					for (var i in z) {
						 var $item = $content.find('[name="'+modx+'"]').eq(i);
						 $item.val(z[i].value);
						 if ($item.prop('type') == 'checkbox' ) $item.prop('checked', true)
						 if ($item.prop('type') == 'textarea' && $item.data('cm') !== undefined) $item.data('cm').setValue(z[i].value);
						 if (z[i].info !== undefined && z[i].info != '') $item.closest('.gwa-col-box').find('.gwa-col-box-content').html(z[i].info);
						 setClipUi($item);
						 
					}
				} else {
					var $item = $content.find('[name="'+modx+'"]');
					$item.val(data[x].value);
					if ($item.prop('type') == 'checkbox' ) $item.prop('checked', true) 		
					if ($item.prop('type') == 'textarea' && $item.data('cm') !== undefined) $item.data('cm').setValue(data[x].value);
					if (data[x].info !== undefined && data[x].info != '') $item.closest('.gwa-col-box').find('.gwa-col-box-content').html(data[x].info);				
					setClipUi($item);
				}
				
			}				
			
		}	
		
		/* Resest Ui elems */		
		var resetUi = function($content) {

			$.map( $content.find(":input"), function(n, i) {
		
				var $item = $(n);
				
				switch (n.type) {
					
				case 'select-one' :
									
					n.selectedIndex = 0;
					$item.trigger('change');
					break;

				case 'text' :

					$item.val('');
					if ($item.closest('.gwa-img-upload').length) $item.trigger('change');
					break;

				case 'textarea' :

					var cmEditor = $item.data('cm');
					if (cmEditor !== undefined) cmEditor.setValue('');
					$item.val('');
					break;					
					
				case 'hidden' :
				
					$item.val('');				
					if ($item.closest('.gwa-icon-btn').length) $item.closest('a').removeClass('gwa-current');
					if ($item.closest('.gwa-textarea-align').length) {
						$item.closest('.gwa-textarea-align').find('a').removeClass('gwa-current');
						$item.closest('.gwa-textarea-align').find('a[data-align=""]').addClass('gwa-current');
					}
					if ($item.closest('.gwa-colorpicker').length) {
						$item.closest('.gwa-colorpicker').find('.gwa-input-btn').find('input').val('')
						$item.closest('.gwa-colorpicker').find('.gwa-cp-picker span').css('background', 'transparent');
						$item.closest('.gwa-colorpicker').find('.gwa-cp-label').html('&nbsp;');
					}
					break;
					
				case 'checkbox' :
				
					n.checked = false;
					$item.trigger('change');
					
				}

			});				
			
		};
		
		/* Trigger changes in ui */
		var setClipUi = function($item) {
			
			if ($item.prop('type') === undefined || $item.prop('name') === undefined) return;
			
			switch ($item.prop('type')) {
				
				case 'select-one' :

					if (!$item.find('option[value="'+$item.val()+'"]').length) $item[0].selectedIndex=0;
					$item.trigger('change');
					break;

				case 'text' :

					if ($item.closest('.gwa-img-upload').length) $item.trigger('change');
					break;
					
				case 'hidden' :
				
					if ($item.val() == 1 && $item.closest('.gwa-icon-btn').length) $item.closest('a').addClass('gwa-current');
					if ($item.closest('.gwa-textarea-align').length) {
						$item.closest('.gwa-textarea-align').find('a').removeClass('gwa-current');
						$item.closest('.gwa-textarea-align').find('a[data-align="'+$item.val()+'"]').addClass('gwa-current');							
					}
					if ($item.closest('.gwa-colorpicker').length) {
						$item.closest('.gwa-colorpicker').find('.gwa-input-btn').find('input').val($item.val())
						$item.closest('.gwa-colorpicker').find('.gwa-cp-picker span').css('background', $item.val());
						if ($item.val() != '') $item.closest('.gwa-colorpicker').find('.gwa-cp-label').text($item.val());
					}

					break;
					
				case 'checkbox' :	

					$item.trigger('change');
				
			}
			
			$(window).trigger('resize');
			
		};
				
		/* Add item data to clipboard data */
		var addClipItemData = function($clipboard, rawData) {
			
			var color = getClipColor($clipboard),
				clipboardID = $clipboard.data('clip-id'),
				clipboard = localStorage.getItem('go_pricing_clipboard'),
				clipboard = JSON.parse( clipboard ) || {},
				itemIndex = clipboard[clipboardID] !== undefined ? clipboard[clipboardID].length : 0,				
				data = [];
			
			data[itemIndex] = { 
				'color' : color, 
				'data' : rawData['data'], 
				'body_row_count' : rawData['body_row_count'], 
				'footer_row_count' : rawData['footer_row_count']
			};
			
			if ( clipboard[clipboardID] === undefined ) {
				clipboard[clipboardID] = data;
			} else {
				clipboard[clipboardID] = $.extend( clipboard[clipboardID], data );
			}
						
			localStorage.setItem( 'go_pricing_clipboard', JSON.stringify( clipboard ) );
			
		}
		
		/* Remove item data from clipboard data */
		var removeClipItemData = function($clipboard, index) {
			
			var clipboardID = $clipboard.data('clip-id'),
				clipboard = localStorage.getItem('go_pricing_clipboard'),
				clipboard = JSON.parse( clipboard ) || {};
			
			
			if (index === undefined) {

				delete clipboard[clipboardID];			
				localStorage.setItem( 'go_pricing_clipboard', JSON.stringify( clipboard ) );	
				return;	
			}
			
			if (clipboard[clipboardID] === undefined) return;

			var data = [];
			
			for (var x = 0; x < clipboard[clipboardID].length; x++) {
				if (x == index) continue;
				data.push(clipboard[clipboardID][x]);
			}
			
			clipboard[clipboardID] = data;
			if (clipboard[clipboardID].length==0) delete clipboard[clipboardID];
			
			localStorage.setItem('go_pricing_clipboard', JSON.stringify(clipboard));
			
		}					
		
		var $pickedItem = null;
		
		/* Show items on clipboard (refresh); */	
		var showClipItems = function($clipboard) {
			
			var clipboard = localStorage.getItem('go_pricing_clipboard'),
				clipboard = JSON.parse( clipboard ) || {},
				clipboardID = $clipboard.data('clip-id');
			
			$clipboard.find('.gwa-clipboard-items').remove();
											
			if (clipboard[clipboardID] === undefined) {
				$clipboard.find('.gwa-clipboard-assets').hide();
				$clipboard.find('.gwa-clipboard-message').show();
				return;
			} else {
				$clipboard.find('.gwa-clipboard-assets').show();
				$clipboard.find('.gwa-clipboard-message').hide();				
			}
			
			var clipData = clipboard[clipboardID],
				$items =  $('<div />', { 'class' : 'gwa-clipboard-items' });
			
			for (var x = 0; x < clipData.length; x++) {
					
					var itemClass = clipBlink && x == clipData.length-1 ? 'gwa-clipboard-item gwa-anim-blink': 'gwa-clipboard-item';
					if (clipBlink && x == clipData.length-1) {
						clipBlink = false;
					}					
					var $item = $('<div />',{ 'data-no' : '#'+(x+1), 'html' : '<a href="#" title="'+GoPricingClipL10n.title_close+'" data-action="clipboard-item-delete" data-confirm="' + GoPricingClipL10n.confirm_item_delete + '"></a>', 'class' : itemClass }).appendTo($items);
					$item.data('clipboard', clipData[x]).css('border-color', clipData[x].color);
			}

			$items.prependTo($clipboard.find('.gwa-clipboard'));
			
			var selector = '', $elem = '';
			
			if ($clipboard.closest('#gwa-editor-popup-wrap').length) {
				selector = '.gwa-popup-content';
				$elem = $goPricingAdmin.find( '#gwa-editor-popup-wrap  .gwa-clipboard-item' );			
			} else {
				selector = $clipboard.closest('.gwa-abox-content');
				$elem = $goPricingAdmin.find( '#go-pricing-column-editor .gwa-clipboard-item' );
			}
				
			$elem.draggable({
				appendTo: selector,
				helper: 'clone',
				scroll: false,
				containment: 'parent',
				start: function( event, ui ) {
					var $this = $pickedItem = $(event.target),
						$clipboard = $this.closest('.gwa-clipboard-wrap');
					
					if ($clipboard.closest('#go-pricing-column-editor').length) {
						var $content = null,
							$parent = $clipboard.closest('.gwa-abox-content');
					} else {
						var $content = $clipboard.closest('.gwa-popup-content-wrap').find('.gwa-abox-content'),
							$parent = $clipboard.closest('.gwa-popup-content-wrap');	
					}					
					
					var $overlay = $parent.find('.gwa-clipboard-overlay');
					showClipOverlay($clipboard);
					$this.css('opacity',0.30).removeClass('gwa-anim-blink');
					$(ui.helper).removeClass('gwa-anim-blink');				
					
					},
				stop: function( event, ui ) {
					var $this = $(event.target),
						$clipboard = $this.closest('.gwa-clipboard-wrap');
					
					if ($clipboard.closest('#go-pricing-column-editor').length) {
						var $content = null,
							$parent = $clipboard.closest('.gwa-abox-content');
					} else {
						var $content = $clipboard.closest('.gwa-popup-content-wrap').find('.gwa-abox-content'),
							$parent = $clipboard.closest('.gwa-popup-content-wrap');	
					}					
					
					var $overlay = $parent.find('.gwa-clipboard-overlay');				  
					$this.css('opacity',1);
					hideClipOverlay($clipboard);
					$pickedItem = null;
				}			  
				
			});
			
		};

		/* Hide overlay */		
		var hideClipOverlay = function($clipboard) {
			
			if ($clipboard.closest('#go-pricing-column-editor').length) {
				var $content = null,
					$parent = $clipboard.closest('.gwa-abox-content');
			} else {
				var $content = $clipboard.closest('.gwa-popup-content-wrap').find('.gwa-abox-content'),
					$parent = $clipboard.closest('.gwa-popup-content-wrap');	
			}			
			var $overlay = $parent.find('.gwa-clipboard-overlay');
			$overlay.removeClass('gwa-current').css({'opacity':0 ,'visibility':'hidden' });
			$overlay.droppable( 'destroy' );
			
		};
		
		/* Show overlay */
		var showClipOverlay = function($clipboard) {
			
			if ($clipboard.closest('#go-pricing-column-editor').length) {
				var $content = null,
					$parent = $clipboard.closest('.gwa-abox-content');
			} else {
				var $content = $clipboard.closest('.gwa-popup-content-wrap').find('.gwa-abox-content'),
					$parent = $clipboard.closest('.gwa-popup-content-wrap');	
			}

			var $overlay = $parent.find('.gwa-clipboard-overlay');
				

				
			if (!$overlay.length) $overlay = $('<div />', { 'class' : 'gwa-clipboard-overlay'}).appendTo($parent);

			setTimeout(function(){ $overlay.css({'opacity':1 ,'visibility':'visible'}) }, 2);
			
			setClipOverlaySize($overlay);
			
			$overlay.droppable({
				drop: function( event, ui ) { 
				
					var ajaxCallback = true;
					$pickedItem.addClass('gwa-anim-blink');
					if ($content === null) {
						var clipData = $pickedItem.data('clipboard'),
							BodyRowCount = clipData['body_row_count'],
							FooterRowCount = clipData['footer_row_count'];
						
						$.ajaxPrefilter(function( options ) {
							if (options.data.match(/&_action=table_column/g)) {
								if (BodyRowCount !== undefined && BodyRowCount > 0) options.data =  options.data +'&body_row_count='+BodyRowCount;
								if (FooterRowCount !== undefined && FooterRowCount > 0) options.data =  options.data +'&footer_row_count='+FooterRowCount;
								BodyRowCount = 0;
								FooterRowCount = 0;
							}
						});	
						
						setTimeout(function(){
							$clipboard.closest('#go-pricing-column-editor').find('.go-pricing-col-new-link').trigger('click');
						}, 150);						
					
						
						$(document).ajaxSuccess(function(event,  jqXHR, ajaxOptions,  data) {
							if (ajaxOptions.data.match(/&_action=table_column/g) ) {
								if (ajaxCallback !== true) return;								
								$content = $clipboard.closest('#go-pricing-column-editor').find('.go-pricing-col:not(.go-pricing-col-new):last');
								var index = $clipboard.closest('#go-pricing-column-editor').find('.go-pricing-col:not(.go-pricing-col-new)').index($content);
								setClipData(clipData.data, $content, index);	
								setTimeout(function(){
									$.setSytle();
								}, 5);
								ajaxCallback = false;
							}	
						});		
						
					} else {
						setClipData($pickedItem.data('clipboard').data, $content);	
					}
				},
				over: function( event, ui ) { 
					$overlay.addClass('gwa-current');
				},
				out: function( event, ui ) { 
					$overlay.removeClass('gwa-current');
					
				}
								
			});	

		};
	
		/* Set the size of clip overlay */
		var setClipOverlaySize = function($overlay) {
			
			if ($overlay === undefined) $overlay = $goPricingAdmin.find('.gwa-clipboard-overlay');

			if ($overlay.closest('#go-pricing-column-editor').length) {
			
				var $parent = $overlay.closest('#go-pricing-column-editor');					
				$overlay.height($parent.find('.go-pricing-cols-wrap').height()).css('top', '88px')
				
			} else {
			
				var $parent = $overlay.closest('.gwa-popup-content-wrap');
				$overlay.height($parent.height()-88-20).css('top', '88px')
			};
			
		};
		
		$(window).on('resize', function() { 
			setClipOverlaySize();
		});

		/* Remove clip item */
		$goPricingAdmin.on('click', '[data-action="clipboard-item-delete"]', function(e) {
			
			var $this = $(this),
				$item = $this.closest('.gwa-clipboard-item'),
				$clipboard = $this.closest('.gwa-clipboard-wrap'),
				itemIndex = $clipboard.find('.gwa-clipboard-items').find('.gwa-clipboard-item').index($item);
			
			if (confirm($this.data('confirm'))) { 
				removeClipItemData($clipboard, itemIndex);
				showClipItems($clipboard);
			}
			e.preventDefault();
			
		});
		
		/* Remove all items */		
		$goPricingAdmin.on('click', '[data-action="clipboard-delete"]', function(e) {

			var $this = $(this),
				$clipboard = $this.closest('#gwa-editor-popup-wrap').length ? $this.closest('.gwa-popup-content-wrap').find('.gwa-clipboard-wrap') : $this.closest('#go-pricing-column-editor').find('.gwa-clipboard-wrap');

			if (confirm($this.data('confirm'))) { 
				removeClipItemData($clipboard);
				showClipItems($clipboard);
			};
			
		});	
		
		var clipBlink = false;	
		
		/* Save to clipboard */
		$goPricingAdmin.on('click', '[data-action="clipboard-add"]', function(e) {

			var $this = $(this),
				$clipboard = $this.closest('#gwa-editor-popup-wrap').length ? $this.closest('.gwa-popup-content-wrap').find('.gwa-clipboard-wrap') : $this.closest('#go-pricing-column-editor').find('.gwa-clipboard-wrap'),
				$content = $this.closest('#gwa-editor-popup-wrap').length ? $this.closest('.gwa-popup-content-wrap').find('.gwa-abox-content') : $this.closest('.go-pricing-col').find('.gwa-abox-content');
			
			if (!$content.length || !$clipboard.length) return;
			
			var clipboard = localStorage.getItem('go_pricing_clipboard'),
				clipboard = JSON.parse( clipboard ) || {},
				clipboardID = $clipboard.data('clip-id');			
			
			showClipItems($clipboard);
			
			if (clipboard[clipboardID] !== undefined && clipboard[clipboardID].length==8) {
				alert(GoPricingClipL10n.warning_maxitem);
			} else {			
				var data = getClipData($content);
				addClipItemData($clipboard, data);
				clipBlink = true;
			}
			showClipItems($clipboard);
			
			if (!$clipboard.hasClass('gwa-open')) $clipboard.addClass('gwa-open');			
			
			e.preventDefault();
			
		});

		/* Open / Close clipboard */
		$goPricingAdmin.on('click', '[data-action="clipboard"]', function(e) {

			var $this = $(this),
				$clipboard = $this.closest('#gwa-editor-popup-wrap').length ? $this.closest('.gwa-popup-content-wrap').find('.gwa-clipboard-wrap') : $this.closest('#go-pricing-column-editor').find('.gwa-clipboard-wrap');
			
			if (!$clipboard.hasClass('gwa-open')) {
				$clipboard.addClass('gwa-open');
				showClipItems($clipboard);				
			} else {
				$clipboard.removeClass('gwa-open');
			}
			e.preventDefault();
			
		});
		
		
		/* Close clipboard */		
		$goPricingAdmin.on('click', '.gwa-clipboard-close', function(e) {

			var $this = $(this),
				$clipboard = $this.closest('#gwa-editor-popup-wrap').length ? $this.closest('.gwa-popup-content-wrap').find('.gwa-clipboard-wrap') : $this.closest('#go-pricing-column-editor').find('.gwa-clipboard-wrap');
			
			if ($clipboard.hasClass('gwa-open')) { $clipboard.removeClass('gwa-open'); };
			e.preventDefault();
			
		});
		
		/* Show & hide thumb assets */
		$goPricingAdmin.on('mouseenter mouseleave', '.gwa-clip-assets-nav a, .gwa-col-assets-nav a', function(e) {
			var $this = $(this),
				isSpan = $this.find('span').length ? true : false, 
				$elem = isSpan ? $this.find('span') : $this.find('i'),
				$siblings = isSpan ? $elem.closest('a').siblings().find('span') : $elem.closest('a').siblings().find('i');
				
			if (e.type=='mouseenter') {
				$elem.css('opacity',1);
				$siblings.css('opacity',0.35);
			} else if (e.type=='mouseleave') {
				$siblings.css('opacity',1);
			};
		});		
						
	});
	
})(jQuery);	