jQuery(document).ready(function ($) {
 
	// internet page only start
	// $("#internet_only .buttons .btn").on('click',function(){
	// 	    $(this).addClass("active");
	// 		$(this).siblings(".btn").removeClass("active");
	// 		return false;
	// });
   // internet page only end---

	//login pop up start
	 var pass = $(".login_PWD");
      pass.type = 'password';
	//login pop up end---
   
	sessionStorage.removeItem("PrevOrderDetails");

	$('.responsive-menu-toggle').on('click',function(){
		$('.menu_wrapper').toggleClass('active');
	})

	$('.mega-menu-tns').click(function(){
		$('.mfn-megamenu-9').toggleclass('active');
	});

	
var userDetails = sessionStorage.getItem("UsersDetails")
	if (userDetails != "" && userDetails != null && userDetails != undefined) {
		$(".loginBillInfo").addClass("d-none")
            var userDetail = JSON.parse(userDetails)
		if ($('.menu_wrapper').find(".UserLoginName").length <= 0) {
                $(".menu_wrapper").append("<div class='row'><div class='col-md-12'><div class='UserLoginName' > <h5 class='h5Style'>Hello, " + userDetail[0][0].ClientFirstName + ' ' + userDetail[0][0].ClientLastName + "</h5></div></div></div><div class='row'><div class='col-md-12'><h6 class='logoutBtn cursorP h6Style' >Logout</h6></div></div>")
                $('.logoutBtn').click(function() {
                    sessionStorage.clear();
                    location.reload();
                })
            }
	}
	var path = window.location.pathname;
	try{
		path=path.replaceAll('/','');
	}catch(err){
		path="";
	}
// 	if(path !="birthright-groupsisrael-free-spirit" && path != "birthright-groupsgoyael"){
// $("#Top_bar .banner_wrapper a").last().attr('href','https://wordpress-944064-3284364.cloudwaysapps.com/hanukkah-2022').find("img").attr('src','https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/uploads/2022/12/hanukkah-side_banner.png');
// 	}


	$("#main_video").click(function(){
		if (this.paused === true)
        {
            this.play();
        }
        else
        {
            this.pause();
        }
	})

	
	

// 	function addToCart(link) {
// 		var linkArr = link.split("=");
// 		var productId = parseInt(linkArr[1]);
// 		// $('#cart-popup').html('');
// 		// load_cart_popup();
// 		$.ajax({
// 			url: `${link}&quantity=1`,
// 			type: "POST",
// 			beforeSend: function () {
// 				$(".loader").addClass("loader-active");
// 				// console.log('show loader');
// 			},
// 			error: function () {
// 				$(".loader").removeClass("loader-active");
// 				// console.log('failed');
// 			},
// 			success: function () {
// 				$(document.body).trigger("wc_fragment_refresh");
// 				$(document.body).trigger("wc_fragments_refreshed");
// 				load_cart_popup();

// 				// const checkoutUrl = `${location.origin}/talknsave/custom-checkout?product-id=${productId}`;
// 				// location.replace(checkoutUrl);
// 			},
// 		});
// 	}
// 	// remove items from cart 
// 	$('#cart-popup').on('click', 'a.delete-item', function () {
// 		var that = $(this)
// 		var productId = $(this).data('product')
// 		if (productId) {
// 			$.ajax({
// 				type: "POST",
// 				url: '/talknsave/wp-admin/admin-ajax.php',
// 				data: { action: 'remove_item_from_cart', 'product_id': productId },
// 				beforeSend: function () {
// 					$(".loader").addClass("loader-active");
// 				},
// 				success: function (res) {
// 					if (res) {
// 						$(".loader").removeClass("loader-active");
// 						that.closest('.item').remove();
// 					}
// 				},
// 				error: function () {
// 					$(".loader").removeClass("loader-active");
// 				},
// 			});
// 		}
// 		return false;
// 	})

// 	function updateProductQuantity(cartItemKey, qty) {
// 		$.ajax({
// 			type: "POST",
// 			url: '/talknsave/wp-admin/admin-ajax.php',
// 			data: {
// 				action: 'update_product_quantity',
// 				carItemKey: cartItemKey,
// 				qty: qty
// 			},
// 			beforeSend: function () {
// 				$(".loader").addClass("loader-active");
// 			},
// 			error: function () {
// 				$(".loader").removeClass("loader-active");
// 			},
// 			success: function (res) {
// 				if (res == 'success') {
// 					load_cart_popup()

// 				}
// 			},
// 		});
// 	}

// 	$('#cart-popup').on('click', 'a.plus', function () {
// 		var that = $(this);
// 		var qty = parseInt(that.closest('.item').find('.qty-icon.number').text());
// 		var cartKey = that.data('cart-key')
// 		qty++;
// 		that.closest('.item').find('.qty-icon.number').html(qty);
// 		updateProductQuantity(cartKey, qty)
// 	})

// 	$('#cart-popup').on('click', 'a.minus', function () {
// 		var that = $(this);
// 		var qty = parseInt(that.closest('.item').find('.qty-icon.number').text());
// 		if (qty > 1) {
// 			var cartKey = that.data('cart-key')
// 			qty--;
// 			that.closest('.item').find('.qty-icon.number').html(qty);
// 			updateProductQuantity(cartKey, qty)
// 		}
// 	})

// 	$('#cart-popup').on('click', 'a.sc-add-to-cart', function () {
// 		const cartLink = $(this).attr("href");
// 		if (cartLink) {
// 			addToCart(cartLink);
// 		}
// 		return false
// 	})

// 	$('#cart-popup').on('click', 'a.close-cart-popup', function () {
// 		var magnificPopup = jQuery.magnificPopup.instance;
// 		magnificPopup.close();
// 		return false
// 	})


// 	function load_cart_popup() {
// 		jQuery.ajax({
// 			type: "POST",
// 			url: "/talknsave/wp-admin/admin-ajax.php",
// 			data: {
// 				action: 'custom_load_cart_popup',
// 				message_id: '123'
// 			},
// 			beforeSend: function () {
// 				$(".loader").addClass("loader-active");
// 			},
// 			error: function () {
// 				$(".loader").removeClass("loader-active");
// 			},
// 			success: function (output) {
// 				if (output) {
// 					$('#cart-popup').html(output);
// 					$(".loader").removeClass("loader-active");
// 					jQuery.magnificPopup.open({
// 						items: {
// 							src: '#cart-popup',
// 							type: 'inline',
// 						}
// 					});
// 				}
// 			}
// 		});
// 	}


// 	function clickToAddToCart(selector) {
// 		$.each($(selector), function () {
// 			$(this).click((e) => {
// 				// console.log('clicked');
// 				e.preventDefault();
// 				const cartLink = $(this).attr("href");
// 				if (cartLink) {
// 					addToCart(cartLink);
// 				}
// 			});
// 		});
// 	}

	// monthly rates

// 	clickToAddToCart(".add-to-cart");
	// EXCLUSIVE STUDENT PLANS body.page-id-11539
// 	clickToAddToCart(".FreePlanBtn-2020");
	// Sim4life body.page-id-519 and smartphone rentals
// 	clickToAddToCart(".add-to-cart-btn");
	// prepaid body.page-id-7740
// 	clickToAddToCart(".button.button_theme.button_js");
	// internet only parent-pageid-513
	// gw-go-btn gw-go-btn-large
// 	clickToAddToCart(".gw-go-btn.gw-go-btn-large");


	// gravity form date range selecter
	try{
	gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
		if ( formId == 2 && fieldId == 2 ) {
			optionsObj.minDate = 0;
			optionsObj.onClose = function (dateText, inst) {
				dateText = new Date(dateText);
				dateMin = new Date(dateText.getFullYear(), dateText.getMonth(),dateText.getDate() + 7);
				jQuery('#input_2_3').datepicker('option', 'minDate', dateMin).datepicker('setDate', dateMin);
			};
		}
		return optionsObj;
	});
	}
	catch(err){
		//do nothing
	}



});




// checkout popup js
  
jQuery(document).ready(function(){
	var path = window.location.pathname;
	try{
		path=path.replaceAll('/','');
	}catch(err){
		path="";
	}
jQuery('.gw-go-col-wrap').each(function(){
	if(!jQuery(this).hasClass('menu-item') && path!="school-programs" && path!="kosher-programs" && path!="60gb-more-2022-sale" && path!="60gb-more-2022" ){
		var isPaymentPage=jQuery(this).find('.hidden_data');
		if(isPaymentPage != undefined && isPaymentPage.length>0){
			var actualLink= jQuery(this).find('.gw-go-footer-wrap').find('a').attr('href');
			
			var bID = urlParam('b',actualLink);
			var linkID= urlParam('linkid',actualLink); 
			if(bID!=undefined && bID != null && bID !=""){			
				jQuery(this).find('.HiddenContent').find('.hidden_b').empty();
				jQuery(this).find('.HiddenContent').find('.hidden_b').text(bID);
			}
			if(linkID!=undefined && linkID != null && linkID !=""){
			
				jQuery(this).find('.HiddenContent').find('.hidden_linkid').empty();
				jQuery(this).find('.HiddenContent').find('.hidden_linkid').text(linkID);
				jQuery(this).find('.gw-go-footer-wrap').find('a').attr('href',' ');
				//for single checkout
				//   jQuery(this).find('.gw-go-footer-wrap').find('a').attr('onclick','SetCheckoutWindow(this)');
				//   jQuery(this).find('.gw-go-footer-wrap').find('a').addClass('popmake-17066');	

				//for multi checkout
				jQuery(this).find('.gw-go-footer-wrap').find('a').attr('onclick','SetCheckoutWindowMulti(this)');
				jQuery(this).find('.gw-go-footer-wrap').find('a').addClass('popmake-17653');
			}

		}
	
	}
	if(path == "mach-hach-baaretz") {
		jQuery(this).find('.gw-go-footer-wrap').find('a').attr('onclick','SetCheckoutWindow(this)');
		jQuery(this).find('.gw-go-footer-wrap').find('a').removeClass('popmake-17653');	
		jQuery(this).find('.gw-go-footer-wrap').find('a').addClass('popmake-17066');	
	}
});
	
	getOrderNumbersCount();
	
	$(".gw-go-footer-wrap a").click(function(){
		console.log("Test");
	});
});

$(document).ready(function(){
    var flag = false;
    var imgs = $(".offer_thumb_ul .offer_thumb_li .thumbnail");
    $(".slider_pagination").bind("DOMSubtreeModified", function(){
        if (flag == false) {
            var thumbs = $(".slider_pagination .slick-dots li a");
            for (var i = 0; i < thumbs.length; i++){
                let img = $(imgs[i]).html();
                $(thumbs[i]).html(img);
            }
        }
        flag = true;
    })

	

});
$(document).ready(function(){
 var currentYear = new Date().getFullYear();
        $('.right').text('© ' + currentYear + ' TalknSave. All Rights Reserved.');
	});



