<script>
	function Rich_Web_VSlider_TS_Open_Video<?php echo esc_html($Rich_Web_VSlider_ID); ?>(Rich_Web_VSldier_Src)
	{

		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> .Rich_Web_TS_Play_Video_Div<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('display','block');
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> .Rich_Web_TS_Play_Video_Div<?php echo esc_html($Rich_Web_VSlider_ID); ?> .Rich_Web_VSlider_TS_Src_Iframe<?php echo esc_html($Rich_Web_VSlider_ID); ?>').attr('src',Rich_Web_VSldier_Src+'?autoplay=1&rel=0&amp');
		jQuery('.Rich_Web_VSlider_TS_PlayIcon<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('display','none');
	}
	function Rich_Web_VSlider_TS_Play_Video<?php echo esc_html($Rich_Web_VSlider_ID); ?>()
	{
		var Rich_Web_VSldier_Src;
		jQuery('#thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> img').each(function(){
			if(jQuery(this).hasClass('selected')) { Rich_Web_VSldier_Src=jQuery(this).attr('alt'); }
		})
		Rich_Web_VSlider_TS_Open_Video<?php echo esc_html($Rich_Web_VSlider_ID); ?>(Rich_Web_VSldier_Src)
	}
	function Rich_Web_VSlider_TS_Close_Video<?php echo esc_html($Rich_Web_VSlider_ID); ?>()
	{
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> .Rich_Web_TS_Play_Video_Div<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('display','none');
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> .Rich_Web_TS_Play_Video_Div<?php echo esc_html($Rich_Web_VSlider_ID); ?> .Rich_Web_VSlider_TS_Src_Iframe<?php echo esc_html($Rich_Web_VSlider_ID); ?>').attr('src', '');
		jQuery('.Rich_Web_VSlider_TS_PlayIcon<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('display','block');
	}
</script>
<script >
	var $transitionLength<?php echo esc_html($Rich_Web_VSlider_ID); ?> = <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_VS_TS_CS);?>;
	var $timeBetweenTransitions = <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_VS_TS_PT*1000);?>;
	//STORAGE
	var imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?> = 0;
	var currentImageIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> = 0;
	var currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> = 1;
	var $imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?> = [];
	var $thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?> = [];
	var $mainContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?> = jQuery("#gallery-main<?php echo esc_html($Rich_Web_VSlider_ID); ?>");
	var $thumbContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?> = jQuery("#thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?>");
	var $progressBar<?php echo esc_html($Rich_Web_VSlider_ID); ?> = jQuery("#progressbar<?php echo esc_html($Rich_Web_VSlider_ID); ?>");
	var currentElement;
	//CONTROLS
	<?php if($Rich_Web_VSlider_Eff[0]->Rich_Web_VS_TS_AP=='on'){ ?>
		var $go<?php echo esc_html($Rich_Web_VSlider_ID); ?> = true;
	<?php }else{ ?>
		var $go<?php echo esc_html($Rich_Web_VSlider_ID); ?> = false;
	<?php }?>
	// jQuery(document).ready(function(){
		jQuery("#gallery-hidden<?php echo esc_html($Rich_Web_VSlider_ID); ?> img").each(function() { $imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>.push(jQuery(this).attr("id", imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>)); imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>++; });
		generateThumbs<?php echo esc_html($Rich_Web_VSlider_ID); ?>();
		setTimeout(function () { imageScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(0); }, $timeBetweenTransitions);
		jQuery('#left-arrow<?php echo esc_html($Rich_Web_VSlider_ID); ?>').click(function (e) {
			thumbScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>("left"); 
			toggleScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(true); 
		});
		jQuery('#right-arrow<?php echo esc_html($Rich_Web_VSlider_ID); ?>').click(function () { 
			thumbScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>("right"); 
			toggleScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(true); 
		});
		jQuery('#thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> img').on('click',function () { imageFocus<?php echo esc_html($Rich_Web_VSlider_ID); ?>(this); });
		jQuery('#playtoggle<?php echo esc_html($Rich_Web_VSlider_ID); ?>').click(function () { toggleScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(false); });
	// });
	function progress<?php echo esc_html($Rich_Web_VSlider_ID); ?>(imageIndex)
	{
		var partsphp = <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_VS_TS_W);?>;
		var parts = partsphp/imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>-1;
		var pxProgress = parts*(imageIndex+1);
		$progressBar<?php echo esc_html($Rich_Web_VSlider_ID); ?>.css({ width: pxProgress , transition: "all 0.7s ease"});
	}
	function imageFocus<?php echo esc_html($Rich_Web_VSlider_ID); ?>(focus)
	{
		for(var i = 0; i < imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>; i++)
		{
			if($imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i].attr('data-rwimg') == jQuery(focus).attr('data-rwimg'))
			{
				$mainContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?>.fadeOut($transitionLength<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
				$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[currentImageIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>].removeClass("selected");
				setTimeout(function () {
					$mainContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?>.html($imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i]);
					$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i].addClass("selected");
					$mainContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?>.fadeIn($transitionLength<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
				}, $transitionLength<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
				currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> = i+1;
				currentImageIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> = i;
				progress<?php echo esc_html($Rich_Web_VSlider_ID); ?>(currentImageIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
				toggleScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(true);
				return false;
			}
		}
	}
	function toggleScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(bool)
	{
		if($go<?php echo esc_html($Rich_Web_VSlider_ID); ?>)
		{
			$go<?php echo esc_html($Rich_Web_VSlider_ID); ?> = false;
			jQuery('#playtoggle<?php echo esc_html($Rich_Web_VSlider_ID); ?>').children().removeClass('icon-pause').addClass('icon-play');
		}
		else
		{
			$go<?php echo esc_html($Rich_Web_VSlider_ID); ?> = true;
			jQuery('#playtoggle<?php echo esc_html($Rich_Web_VSlider_ID); ?>').children().removeClass('icon-play').addClass('icon-pause');
		}
		if(bool)
		{
			$go<?php echo esc_html($Rich_Web_VSlider_ID); ?> = false;
			jQuery('#playtoggle<?php echo esc_html($Rich_Web_VSlider_ID); ?>').children().removeClass('icon-pause').addClass('icon-play');
		}
	}
	var y=false;
	function autoScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>()
	{
		if(y==true){ return; }
		var imgW=jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> .thumb').outerWidth();
		var mLeft=jQuery('.marginLeft').val();
		AutImgW=parseInt(imgW)+2*parseInt(mLeft);
		var tumCWidth=jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width();
		if(currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> >= 0 || currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> < imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>)
		{
			if(parseInt($thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].css('margin-left'))<=-parseInt((imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>)*AutImgW-parseInt(tumCWidth)))
			{
				$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].css({ marginLeft: "5px" , webkitMarginLeft: "5px" , mozMarginLeft: "5px" , transition: "all 1.0s ease", webkitTransition: "all 1.0s ease", MozTransition: "all 1.0s ease", msTransition: "all 1.0s ease", OTransition: "all 1.0s ease"});
				currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> = 1;
			}
			else
			{
				$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].css({ marginLeft: "-="+AutImgW+"" , webkitMarginLeft: "-="+AutImgW+"" , mozMarginLeft: "-="+AutImgW+"" , transition: "all 1.0s ease", webkitTransition: "all 1.0s ease", MozTransition: "all 1.0s ease", msTransition: "all 1.0s ease", OTransition: "all 1.0s ease"});
				currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>++;
			}
		}
	}
	function thumbScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(direction)
	{
		if(y==true){ return; }
		y=true;
		var imgW=jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> .thumb').outerWidth();
		var mLeft=jQuery('.marginLeft').val();
		AutImgW=parseInt(imgW)+2*parseInt(mLeft);
		var tumCWidth=jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width();
		if(currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> >= 0 || currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> < imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>)
		{
			var marginTemp = currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>;
			var k=0;
			if(direction == "left")
			{
				if(currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>-1 <= 0)
				{
					
					k = ((imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>)*AutImgW-parseInt(tumCWidth));
					$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].css({ marginLeft: -k , transition: "all 1.0s ease", webkitTransition: "all 1.0s ease", MozTransition: "all 1.0s ease", msTransition: "all 1.0s ease", OTransition: "all 1.0s ease"});
					currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> = imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>-1;
				}
				else
				{
					
					$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].css({ marginLeft: "+="+AutImgW+"" , transition: "all 1.0s ease", webkitTransition: "all 1.0s ease", MozTransition: "all 1.0s ease", msTransition: "all 1.0s ease", OTransition: "all 1.0s ease"});
					currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>--;
				}
			}
			else if(direction == "right")
			{
				
				if(parseInt($thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].css('margin-left'))<=-parseInt((imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>)*AutImgW-parseInt(tumCWidth)))
				{
					
					$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].css({ marginLeft: "5px" , transition: "all 1.0s ease", webkitTransition: "all 1.0s ease", MozTransition: "all 1.0s ease", msTransition: "all 1.0s ease", OTransition: "all 1.0s ease"});
					currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> = 1;
				}
				else
				{
					$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[0].css({ marginLeft: "-="+AutImgW+"" , transition: "all 1.0s ease", webkitTransition: "all 1.0s ease", MozTransition: "all 1.0s ease", msTransition: "all 1.0s ease", OTransition: "all 1.0s ease"});
					currentScrollIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>++;
				}
			}
		}
		setTimeout(function(){ y=false; },1000)
	}
	function generateThumbs<?php echo esc_html($Rich_Web_VSlider_ID); ?>()
	{
		progress<?php echo esc_html($Rich_Web_VSlider_ID); ?>(currentImageIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
		for(var i = 0; i < imageCount<?php echo esc_html($Rich_Web_VSlider_ID); ?>; i++)
		{
			var $tempObj<?php echo esc_html($Rich_Web_VSlider_ID); ?> = jQuery('<img id="'+i+'t" class="thumb thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>" data-rwimg="'+$imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i].attr('data-rwimg')+'" src="'+$imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i].attr('data-rwimg')+'" alt="'+$imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i].attr('onclick').split("('")[1].split("')")[0]+'" onclick="Rich_Web_VSlider_TS_Close_Video<?php echo esc_html($Rich_Web_VSlider_ID); ?>()"/>');
			if(i == 0)
				$tempObj<?php echo esc_html($Rich_Web_VSlider_ID); ?>.addClass("selected");
			$thumbContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?>.append($tempObj<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
			$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>.push($tempObj<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
		}
	}
	function imageScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(c)
	{
		if($go<?php echo esc_html($Rich_Web_VSlider_ID); ?>)
		{
			$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[c].removeClass("selected");
			c++
			if(c == $imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>.length)
				c = 0;
			$mainContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?>.fadeOut($transitionLength<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
			setTimeout(function () {
				$mainContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?>.html($imageBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[c]);
				$thumbBank<?php echo esc_html($Rich_Web_VSlider_ID); ?>[c].addClass("selected");
				autoScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>("left");
				$mainContainer<?php echo esc_html($Rich_Web_VSlider_ID); ?>.fadeIn($transitionLength<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
			}, $transitionLength<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
		}
		progress<?php echo esc_html($Rich_Web_VSlider_ID); ?>(c);
		setTimeout(function () {
			imageScroll<?php echo esc_html($Rich_Web_VSlider_ID); ?>(currentImageIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?>);
		}, $timeBetweenTransitions);
		currentImageIndex<?php echo esc_html($Rich_Web_VSlider_ID); ?> = c;
	}
</script>
<script>
	var SlWidth3 = parseInt(jQuery('.SlWidth3<?php echo esc_html($Rich_Web_VSlider_ID); ?>').val());
	var SlHeight3 = parseInt(jQuery('.SlHeight3<?php echo esc_html($Rich_Web_VSlider_ID); ?>').val());
	var carDivWidth = parseInt(jQuery('.carDivWidth<?php echo esc_html($Rich_Web_VSlider_ID); ?>').val());
	var carDivImgHeight = parseInt(jQuery('.carDivImgHeight<?php echo esc_html($Rich_Web_VSlider_ID); ?>').val());
	var BW = jQuery('.BW<?php echo esc_html($Rich_Web_VSlider_ID); ?>').val();
	var carTopLeft = jQuery('.carTopLeft<?php echo esc_html($Rich_Web_VSlider_ID); ?>').val();
	function resp<?php echo esc_html($Rich_Web_VSlider_ID); ?>(){
		jQuery("#RW_Load_Thumb_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").css("max-height",Math.floor((SlHeight3+carDivImgHeight)/SlWidth3*jQuery("#RW_Load_Thumb_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").width()));
		jQuery('#gallery-main<?php echo esc_html($Rich_Web_VSlider_ID); ?>,#gallery-main<?php echo esc_html($Rich_Web_VSlider_ID); ?>_Anim').css('height',Math.floor(SlHeight3/SlWidth3*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()));
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> .Rich_Web_TS_Play_Video_Div<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('height',Math.floor(SlHeight3/SlWidth3*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()));
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> .thumb').css('height',Math.floor(carDivImgHeight*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()+250)));
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('height',Math.floor(carDivImgHeight*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()+250)+24));
		jQuery('.Rich_Web_VSlider_TS_PlayIcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> span').css('width',Math.floor(86*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/1000));
		jQuery('.Rich_Web_VSlider_TS_PlayIcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> span').css('height',Math.floor(61*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/1000));
		jQuery('.Rich_Web_VSlider_TS_PlayIcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> span').css('font-size',Math.floor(32*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/1000));
		jQuery('.Rich_Web_VSlider_TS_PlayIcon<?php echo esc_html($Rich_Web_VSlider_ID); ?> span').css('line-height',Math.floor(64*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/1000)+'px');
		jQuery('.Rich_Web_VSlider_TS_PlayIcon<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('height',Math.floor(50*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/1000));
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> .ui-button').css('width',Math.floor(32*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()+250)));
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> .ui-button').css('height',Math.floor(32*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()+250)));
		if(carTopLeft=='bottom')
		{
			jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #playtoggle<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('top',-Math.floor(40*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()+250)));
		}
		else
		{
			jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #playtoggle<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('top',Math.floor(carDivImgHeight*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()+250)+26));
		}
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #playtoggle<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('right',Math.floor(10*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()+250)));
		jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbnails<?php echo esc_html($Rich_Web_VSlider_ID); ?> #thumbcon<?php echo esc_html($Rich_Web_VSlider_ID); ?>').css('width',Math.floor(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()-15-64*jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()/(jQuery('#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>').width()+250)));
	}
	resp<?php echo esc_html($Rich_Web_VSlider_ID); ?>();
	setTimeout(function(){ resp<?php echo esc_html($Rich_Web_VSlider_ID); ?>(); },200);
	var array_thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>=[];
	jQuery(".gallery_thumb_img<?php echo esc_html($Rich_Web_VSlider_ID); ?>").each(function(){
		if( jQuery(this).attr("data-rwimg") != "" ) {
			array_thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>.push(jQuery(this).attr("data-rwimg"));
		}
	})
	var y_thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>=0;
	for(i=0;i<array_thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>.length;i++){
		jQuery(".gallery_rw_<?php echo esc_html($Rich_Web_VSlider_ID); ?>-"+i).attr('src', array_thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>[i]).on("load",function(){
			y_thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>++;
			if(y_thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?> == array_thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>.length){
				jQuery("#gallery-con<?php echo esc_html($Rich_Web_VSlider_ID); ?>").fadeIn(1000);
				jQuery("#RW_Load_Thumb_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>").remove();
			}
		})
	}
	jQuery(window).resize(function(){ resp<?php echo esc_html($Rich_Web_VSlider_ID); ?>(); });
</script>