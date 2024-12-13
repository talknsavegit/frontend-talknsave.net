<script type="text/javascript">
	<!--
	var y=false;
	var x=false;
	jQuery.fn.timelinr<?php echo esc_html($Rich_Web_VSlider_ID); ?> = function(options<?php echo esc_html($Rich_Web_VSlider_ID); ?>){
		setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = jQuery.extend({
			orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'horizontal',
			containerDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>: '#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w',
			date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>: '#date<?php echo esc_html($Rich_Web_VSlider_ID); ?>s',
			date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'select<?php echo esc_html($Rich_Web_VSlider_ID); ?>ed',
			date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'normal',
			issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>: '#issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s',
			issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'select<?php echo esc_html($Rich_Web_VSlider_ID); ?>ed',
			issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'fast', 
			issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sTransparency<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 0.2,
			issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sTransparencySpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 500,
			prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>: '#pre<?php echo esc_html($Rich_Web_VSlider_ID); ?>v',
			nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>: '#nex<?php echo esc_html($Rich_Web_VSlider_ID); ?>t',
			arrowKeys<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'false',
			startAt<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 1,
			autoPlay<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'false',
			autoPlayDirection<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'forward',
			autoPlayPause<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 2000
		}, options<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
		jQuery(function(){
			if (jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).length > 0 && jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).length > 0) {
				var howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').length;
				var howManyissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').length;
				var currentDate = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).find('a.'+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
				var currentIssue = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).find('li.'+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
				var widthContainer = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.containerDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).width();
				var heightContainer = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.containerDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).height();
				var widthissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).width();
				var heightissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).height();
				var widthIssue = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').width();
				var heightIssue = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').height();
				var widthdate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).width();
				var heightdate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).height();
				var widthDate = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').width();
				var heightDate = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').height();
				if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'horizontal')
				{
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).width(widthIssue*howManyissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s);
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).width(widthDate*howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s).css('marginLeft',widthContainer/2-widthDate/2);
					var defaultPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').indexOf('px')));
				}
				else if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'vertical')
				{
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).height(heightIssue*howManyissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s);
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).height(heightDate*howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s).css('marginTop',heightContainer/2-heightDate/2);
					var defaultPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').indexOf('px')));
				}
				jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' .rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').click(function(event){
					x=false;
					event.preventDefault();
					var whichIssue = jQuery(this).text();
					var currentIndex = jQuery(this).parent().prevAll().length;
					if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'horizontal')
					{
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).animate({'marginLeft':-widthIssue*currentIndex},{queue:false, duration:setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>});
					}
					else if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'vertical')
					{
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).animate({'marginTop':-heightIssue*currentIndex},{queue:false, duration:setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>});
					}

					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').animate({'opacity':setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sTransparency<?php echo esc_html($Rich_Web_VSlider_ID); ?>},{queue:false, duration:setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>}).removeClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>).eq(currentIndex).addClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeTo(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sTransparencySpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>,1);
					if(howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s == 1)
					{
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>+','+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
					}
					else if(howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s == 2)
					{
						if(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>))
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('fast');
						}
						else if(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>))
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('fast');
						}
					}
					else
					{
						if( jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>) )
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('fast');
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
						}
						else if( jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>) )
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('fast');
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
						}
						else
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>+','+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('slow');
						}
					}
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' .rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').removeClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
					jQuery(this).addClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
					if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'horizontal')
					{
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).animate({'marginLeft':defaultPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s-(widthDate*currentIndex)},{queue:false, duration:'setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>'});
					}
					else if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'vertical')
					{
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).animate({'marginTop':defaultPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s-(heightDate*currentIndex)},{queue:false, duration:'setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>'});
					}
				});
				jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").hover(function(){ y=true; }, function(){ setTimeout(function(){ if(x==false){ y=false; } },1000) });
				jQuery(".RW_IMGD<?php echo esc_html($Rich_Web_VSlider_ID); ?>,.rw_vid_tim<?php echo esc_html($Rich_Web_VSlider_ID); ?>_play").click(function() { x=true; y=true; })
				jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).bind('click', function(event){
					event.preventDefault();
					var currentIndex = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).find('li.'+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>).index();
					if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'horizontal')
					{
						var currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').indexOf('px')));
						var currentIssueIndex = currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s/widthIssue;
						var currentPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').indexOf('px')));
						var currentIssueDate = currentPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s-widthDate;
						if(currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s <= -(widthIssue*howManyissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s-(widthIssue)))
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).stop();
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child .rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').click();
						}
						else
						{
							if (!jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).is(':animated'))
							{
								jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').eq(currentIndex+1).find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').trigger('click');
							}
						}
						y=true;
					}
					else if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'vertical')
					{
						var currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').indexOf('px')));
						var currentIssueIndex = currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s/heightIssue;
						var currentPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').indexOf('px')));
						var currentIssueDate = currentPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s-heightDate;
						if(currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s <= -(heightIssue*howManyissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s-(heightIssue)))
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).stop();
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child .rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').click();
						}
						else
						{
							if (!jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).is(':animated'))
							{
								jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').eq(currentIndex+1).find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').trigger('click');
							}
						}
						y=true;
					}
					if(howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s == 1)
					{
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>+','+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
					}
					else if(howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s == 2)
					{
						if(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>))
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('fast');
						}
						else if(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>))
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('fast');
						}
					}
					else
					{
						if( jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>) )
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
						}
						else if( jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>) )
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
						}
						else
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>+','+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('slow');
						}
					}
				});
			jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).click(function(event){
				event.preventDefault();
				var currentIndex = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).find('li.'+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>).index();
				if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'horizontal')
				{
					var currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').indexOf('px')));
					var currentIssueIndex = currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s/widthIssue;
					var currentPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginLeft').indexOf('px')));
					var currentIssueDate = currentPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s+widthDate;
					if(currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s >= 0)
					{
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).stop();
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child .rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').click();
					}
					else
					{
						if (!jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).is(':animated'))
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').eq(currentIndex-1).find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').trigger('click');
						}
					}
					y=true;
				}
				else if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'vertical')
				{
					var currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').indexOf('px')));
					var currentIssueIndex = currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s/heightIssue;
					var currentPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s = parseInt(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').substring(0,jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).css('marginTop').indexOf('px')));
					var currentIssueDate = currentPositiondate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s+heightDate;
					if(currentPositionissue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s >= 0)
					{
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).stop();
						jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child .rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').click();
					}
					else
					{
						if (!jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).is(':animated'))
						{
							jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').eq(currentIndex-1).find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').trigger('click');
						}
					}
					y=true;
				}
			if(howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s == 1)
			{
				jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>+','+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
			}
			else if(howManydate<?php echo esc_html($Rich_Web_VSlider_ID); ?>s == 2)
			{
				if(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>))
				{
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('fast');
				}
				else if(jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>))
				{
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('fast');
				}
			}
			else
			{
				if( jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>) )
				{
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
				}
				else if( jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child').hasClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>) )
				{
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
				}
				else
				{
					jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>+','+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeIn('slow');
				}
			}
		});
		if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.arrowKeys<?php echo esc_html($Rich_Web_VSlider_ID); ?>=='true')
		{
			if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?>=='horizontal')
			{
				jQuery(document).keydown(function(event){
					if (event.keyCode == 39) { jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).click(); }
					if (event.keyCode == 37) { jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).click(); }
				});
			}
			else if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?>=='vertical')
			{
				jQuery(document).keydown(function(event){
					if (event.keyCode == 40) { jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.nextButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).click(); }
					if (event.keyCode == 38) { jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).click(); }
				});
			}
		}
		jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.prevButton<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeOut('fast');
		jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li').addClass(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>).fadeTo(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sTransparencySpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>,1);
		if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.autoPlay<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'true')
		{
			setInterval("autoPlay<?php echo esc_html($Rich_Web_VSlider_ID); ?>()", setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.autoPlayPause<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
		}
	}
	});
					
	var arr<?php echo esc_html($Rich_Web_VSlider_ID); ?> = jQuery(".rw_resp_li<?php echo esc_html($Rich_Web_VSlider_ID); ?>");
	for(var i=0;i<arr<?php echo esc_html($Rich_Web_VSlider_ID); ?>.length;i++){
		arr<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i].setAttribute("class", "rw_resp_li<?php echo esc_html($Rich_Web_VSlider_ID); ?>");
	}
	if(arr<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0]){
		arr<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].setAttribute("class", "rw_resp_li<?php echo esc_html($Rich_Web_VSlider_ID); ?> select<?php echo esc_html($Rich_Web_VSlider_ID); ?>ed")
	};

	var arr2<?php echo esc_html($Rich_Web_VSlider_ID); ?> = jQuery(".rw_tim_li<?php echo esc_html($Rich_Web_VSlider_ID); ?>");
	for(var i=0;i<arr2<?php echo esc_html($Rich_Web_VSlider_ID); ?>.length;i++){
		arr2<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i].setAttribute("class", "rw_tim_li<?php echo esc_html($Rich_Web_VSlider_ID); ?>");
	}
	if(arr2<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0]){
		arr2<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].setAttribute("class", "rw_tim_li<?php echo esc_html($Rich_Web_VSlider_ID); ?> select<?php echo esc_html($Rich_Web_VSlider_ID); ?>ed")
	};
	}
	function autoPlay<?php echo esc_html($Rich_Web_VSlider_ID); ?>()
	{
		if(y==true){ return }
		var currentDate = jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>).find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>.'+setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSelectedClass<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
		if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.autoPlayDirection<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'forward') 
		{
			if(currentDate.parent().is('li:last-child'))
			{
				jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:first-child').find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').trigger('click');
			}
			else
			{
				currentDate.parent().next().find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').trigger('click');
			}
			y=true;
		}
		else if(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.autoPlayDirection<?php echo esc_html($Rich_Web_VSlider_ID); ?> == 'backward')
		{
			if(currentDate.parent().is('li:first-child'))
			{
				jQuery(setting<?php echo esc_html($Rich_Web_VSlider_ID); ?>s.date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sDiv<?php echo esc_html($Rich_Web_VSlider_ID); ?>+' li:last-child').find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').trigger('click');
			}
			else
			{
				currentDate.parent().prev().find('.rw_tim_nav€_item<?php echo esc_html($Rich_Web_VSlider_ID); ?>').trigger('click');
			}
		}
		setTimeout(function(){ y=false; },100)
	}
	//-->
</script>
<script type="text/javascript">
	jQuery(function(){
		var Rich_Web_MS_SSh<?php echo esc_html($Rich_Web_VSlider_ID); ?> = jQuery(".Rich_Web_MS_SSh<?php echo esc_html($Rich_Web_VSlider_ID); ?>").val();
		var Rich_Web_MS_SShChT<?php echo esc_html($Rich_Web_VSlider_ID); ?> = jQuery(".Rich_Web_MS_SShChT<?php echo esc_html($Rich_Web_VSlider_ID); ?>").val();
		if(Rich_Web_MS_SSh<?php echo esc_html($Rich_Web_VSlider_ID); ?> == "on") { Rich_Web_MS_SSh<?php echo esc_html($Rich_Web_VSlider_ID); ?>="true"; }
		else { Rich_Web_MS_SSh<?php echo esc_html($Rich_Web_VSlider_ID); ?>="false"; }
		setTimeout(function(){
			jQuery().timelinr<?php echo esc_html($Rich_Web_VSlider_ID); ?>({
				orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?>: '<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_MS_Type); ?>',
				issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 300,
				date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 100,
				arrowKeys<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'true',
				startAt<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 1,
				autoPlay<?php echo esc_html($Rich_Web_VSlider_ID); ?>: "false",
				autoPlayPause<?php echo esc_html($Rich_Web_VSlider_ID); ?>:Rich_Web_MS_SShChT<?php echo esc_html($Rich_Web_VSlider_ID); ?>,
			})
		},100)
		jQuery().timelinr<?php echo esc_html($Rich_Web_VSlider_ID); ?>({
			orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?>: '<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_MS_Type); ?>',
			issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 300,
			date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 100,
			arrowKeys<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'true',
			startAt<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 1,
			autoPlay<?php echo esc_html($Rich_Web_VSlider_ID); ?>: Rich_Web_MS_SSh<?php echo esc_html($Rich_Web_VSlider_ID); ?>,
			autoPlayPause<?php echo esc_html($Rich_Web_VSlider_ID); ?>:Rich_Web_MS_SShChT<?php echo esc_html($Rich_Web_VSlider_ID); ?>,
		})
		jQuery(window).on("load resize",function(){
			jQuery().timelinr<?php echo esc_html($Rich_Web_VSlider_ID); ?>({
				orientation<?php echo esc_html($Rich_Web_VSlider_ID); ?>: '<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_MS_Type); ?>',
				issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 300,
				date<?php echo esc_html($Rich_Web_VSlider_ID); ?>sSpeed<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 100,
				arrowKeys<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'true',
				startAt<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 1,
				autoPlay<?php echo esc_html($Rich_Web_VSlider_ID); ?>: 'false', 
				autoPlayPause<?php echo esc_html($Rich_Web_VSlider_ID); ?>:Rich_Web_MS_SShChT<?php echo esc_html($Rich_Web_VSlider_ID); ?>,
			})
		})
	});
</script>
<script type="text/javascript">
	jQuery("#RW_Load_Timeline_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").css("max-height",Math.floor(jQuery("#RW_Load_Timeline_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").width()+56.25/100));
	jQuery(window).resize(function(){
		jQuery("#RW_Load_Timeline_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").css("max-height",Math.floor(jQuery("#RW_Load_Timeline_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").width()+56.25/100));
	})
	var array_timelineSl<?php echo esc_html($Rich_Web_VSlider_ID); ?>=[];
	jQuery(".RW_tim_vid_vid<?php echo esc_html($Rich_Web_VSlider_ID); ?>").each(function(){
		if( jQuery(this).attr("src") != "" ) {
			array_timelineSl<?php echo esc_html($Rich_Web_VSlider_ID); ?>.push(jQuery(this).attr("src"));
		}
	})
	var y_timelineSl<?php echo esc_html($Rich_Web_VSlider_ID); ?>=0;
	for(i=0;i<array_timelineSl<?php echo esc_html($Rich_Web_VSlider_ID); ?>.length;i++){
		jQuery("<img class='RW_tim_vid_vid<?php echo esc_html($Rich_Web_VSlider_ID); ?>' />").attr('src', array_timelineSl<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i]).on("load",function(){
			y_timelineSl<?php echo esc_html($Rich_Web_VSlider_ID); ?>++;
			if(y_timelineSl<?php echo esc_html($Rich_Web_VSlider_ID); ?> == array_timelineSl<?php echo esc_html($Rich_Web_VSlider_ID); ?>.length){
				// jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").show();
				// jQuery("#RW_Load_Timeline_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").remove();
			}
		})
	}
	<?php if ($Rich_Web_VSlider_Eff[0]->Rich_Web_MS_Type=='horizontal') { ?>
		jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").show();
		jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").css("height","0");
		jQuery(window).on("load resize",function(){
			jQuery("#RW_Load_Timeline_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").remove();
			if(jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").width() <= 500){
				jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").css("height","auto");
			}else
			{
				jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").css("height",Math.floor(jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").width()*9/16+55+jQuery(".rw_tim_icons_cont_div<?php echo esc_html($Rich_Web_VSlider_ID); ?>").height()));
			}
		})
	<?php } else{ ?>
		jQuery(window).on("load resize",function(){
			jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").show();
			jQuery("#RW_Load_Timeline_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").remove();
			jQuery("#timeline_r<?php echo esc_html($Rich_Web_VSlider_ID); ?>w").css("height",jQuery(".rw_vid_tim<?php echo esc_html($Rich_Web_VSlider_ID); ?>").height()+300);
		})
	<?php } ?>
</script>
<script type="text/javascript">
	jQuery(window).on("load resize",function(){
		var Rich_Web_MS_PlIc_S<?php echo esc_html($Rich_Web_VSlider_ID); ?> = "<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_MS_PlIc_S); ?>";
		
		jQuery("#issue<?php echo esc_html($Rich_Web_VSlider_ID); ?>s").css("margin","0px");
		jQuery(".RW_tim_vid_play<?php echo esc_html($Rich_Web_VSlider_ID); ?>").css("font-size",Math.floor(Rich_Web_MS_PlIc_S<?php echo esc_html($Rich_Web_VSlider_ID); ?>*jQuery(".RW_IMGD<?php echo esc_html($Rich_Web_VSlider_ID); ?>").innerWidth()/500)+"px");
		jQuery(".RW_tim_vid_play<?php echo esc_html($Rich_Web_VSlider_ID); ?>").css("padding",Math.floor(Rich_Web_MS_PlIc_S<?php echo esc_html($Rich_Web_VSlider_ID); ?>/4)+"px "+Math.floor(Rich_Web_MS_PlIc_S<?php echo esc_html($Rich_Web_VSlider_ID); ?>/2*jQuery(".RW_IMGD<?php echo esc_html($Rich_Web_VSlider_ID); ?>").innerWidth()/300)+"px");
	})
</script>