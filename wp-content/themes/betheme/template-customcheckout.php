<?php
/**
 * Template Name: custom checkout
 *
 * @package Betheme
 * @author Muffin Group
 * @link https://muffingroup.com
 */
// die();
// return;
get_header();
?>

<?php
// global $woocommerce;
// $items = $woocommerce->cart->get_cart();
// foreach ($items as $item => $values) {
//     //$_product =  wc_get_product( $values['data']->get_id() );
//     $_product_id = $values['data']->get_id();
//     continue;
// }
// $bundle_id = get_field('bundle_id', $_product_id);
// $link_id = get_field('link_id', $_product_id);

$bundle_id = $_GET['b'];
$link_id = $_GET['linkid'];
$ord_qty=$_GET['qty'];
$path = "http://wpapi.talknsave.us/api/products?linkid=" . $link_id . "&b=" . $bundle_id;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $path);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');

$data = curl_exec($ch);
curl_close($ch);
$data = json_decode($data, true);
// echo '<pre>';
// print_r($data);
// exit;
$data = $data[0];




// echo '<pre>';
// print_r($data);
// echo '</pre>';

$min_period = $data['minimumPeriod'];
$max_period = $data['maximumPeriod'];
$optLeaveILrequest = $data['optLeaveILrequest'];

$bundles = $data['bundles'];

$bCount=count($bundles);
if($bundles==null || $bCount==0){
	header("Location: https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=".$bundle_id."&linkid=".$link_id);
}

$equipments = $bundles[0]['equipments'];

$kntCountries = $bundles[0]['kntCountries'];
// echo '<pre>';
// print_r($bundles);
// echo '</pre>';

$buses=$data['Buses'];
$busCount=count($buses);	
$Qty = $_GET['qty'];

$p=$_GET['p'];



?>


<link rel="stylesheet" id="mfn-layout-css" href="https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/themes/betheme/css/custom.css?ver=21.9.9" type="text/css" media="all">
<link rel="stylesheet" id="bootstrap-css" href="https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/themes/betheme/css/bootstrap.min.css?ver=21.9.9" type="text/css" media="all">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src='https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/themes/betheme/js/creditcard.js?ver=21.9.8'> </script>
<script>
//  	   $(function () {
//         $("#begin_date").datepicker();
//     });
//     $(function () {
//         $("#end_date").datepicker();
//     });
</script>
<input type="hidden" name="qsqty" id="qsqty" value="<?php echo $Qty; ?>">
<script>
	var orderCount=<?php echo $ord_qty;?> ;
    function openPopup(divPopup) {
        $(divPopup).fadeIn(250);
    }
	


    function closePopup(divPopup) {
        $(divPopup).fadeOut(250);
		$('.popup-footer').addClass('d-none');
		
    }
	function closeNetworkPopup(){
		closePopup("#wrap_popup2");
	}
	function setLeavingDate(){
		    	$( "#date_to_leave" ).datepicker("destroy");
			 let begin_date = $('#begin_date').datepicker("getDate");
			  $('#date_to_leave').datepicker({
                minDate: 0,
                maxDate: new Date(begin_date)
            });
		
		
			}
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
	
	function optionalAdd(){
let validateOptional=false;
$('.optionalAdd').each( function () {
if ($(this).val() == ''){
$("#next6").attr('disabled', true);
validateOptional=false;
}
else {
$("#next6").attr('disabled', false);
validateOptional=true;
}
return validateOptional;
});
}
		function plusMinus(element){
	 let inputvalue = $(element).parent().find('input').val();
		inputvalue=parseInt(inputvalue);
		$(element).parent().find('.cart-qty-minus').removeClass('bluebtn').removeClass('greybtn');
		if(inputvalue >0){
				$(element).parent().find('.cart-qty-minus').addClass('bluebtn');
		}
		else{
				$(element).parent().find('.cart-qty-minus').addClass('greybtn');
		}
	}

	
    function needSim() {
        var checkedVal;
        var nextFormElement = `
        <fieldset id="sim_card_no">
            <div class="row">
                <div class="col">
                    <button type="button" class="previous btn btn-block" id="previous2"><i class="icon-left-open-big"></i></button>
                </div>
                <div class="col-md-6 pl-0 pr-0">
<div>
<div class="simNumCloneDefault d-none">

                    <div class="title" style='
    margin-bottom: 18px;'>
                        <h2>Enter Your 19 Digit SIM card <span class="SimOrderNum" ></span></h2>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend" style='height: 57.5px;'>
                                    <div class="input-group-text">89972</div>
                                </div>
                                <input type="text" name="existing_phone"  style=" width:80%;border-left: 0px;border-radius: 0px;margin-bottom: 0px !important;" maxlength='17' class="form-control mobile-width-80 " placeholder="0000 0000 0000 0000 0" style="border-top-left-radius: 0;border-bottom-left-radius: 0;margin-bottom: 0 !important;">
       <p class="eSimNum" style="font-size:12px; color:red;  margin: 0px; "> </p>
      <p class="simNoValue" style="font-size:12px; color:red;  margin: 0px; "> </p>
                            </div>
                        </div>
                    </div>
</div>
</div>
                    <button type="button" class="next btn btn-block" id="next3" >Next <i class="icon-right-thin"></i></button>
                </div>
                <div class="col"></div>
            </div>
        </fieldset>
        `
        $('#sim_card_no').remove();
        $('.simNoclone').remove();
        let countAlready = 0;
		var simNumCount=[];
        $('.simCount').each(function (index) {
            let simValue = $(this).find('input[type=radio]:checked').val();

            if (simValue == 9999) {
                countAlready++;
				simNumCount.push(index+1);
            }
        });
        if (countAlready > 0) {

            $('#need_sim').after(nextFormElement);
            $('.simNoclone').remove();
            $('.simNumCloneDefault').find('.SimOrderNum').empty();
            if ($('#simCheckBox').prop('checked')) {
                let clone = orderCount;
//                 clone = clone - 1;
//                 if (clone > 1) {
//                     $('.simNumCloneDefault').find('.SimOrderNum').text(' for Order #1');
//                 }
                for (i = 0; i < clone; i++) {
                    var simNoClone = $('.simNumCloneDefault').clone();
                    $(simNoClone).find('input').attr('class', 'existing_phone');
                   if(orderCount > 1){
			 $(simNoClone).find('.SimOrderNum').text(' for Order #'+(i+1));
			}
                    $(simNoClone).attr('class', 'simNoclone');
                    $('.simNumCloneDefault').parent().append(simNoClone);


                }
            } else {
 	    			let clone=countAlready;
// 		  clone=clone-1;
// 	  if(clone>0){
// 		 $('.simNumCloneDefault').find('.SimOrderNum').text(' for order #1');
// 	 }
	  for(i=0; i<clone; i++){
		   var simNoClone = $('.simNumCloneDefault').clone();
		   $(simNoClone).removeClass('d-none');
		   $(simNoClone).find('input').attr('id', 'existing_phone' + (i+1) );
		   $(simNoClone).find('input').attr('class', 'existing_phone');
		   if(orderCount > 1){
			   $(simNoClone).find('.SimOrderNum').text(' for Order #'+ simNumCount[i]);
			  }
		  $(simNoClone).attr('class','simNoclone');
		  $('.simNumCloneDefault').parent().append(simNoClone);
	  }
            }
            $('#next3').click(function () {
                var validateSimNo = false;
                $('.simNoValue').text('');
                $('.existing_phone').each(function () {
						 let unknownNum =$('.eSimNum').text();
							unknownNum=unknownNum.trim();
							let simNoValue=$(this).val();
                    if ($(this).val() == '') {
                        $(this).parent().find('.simNoValue').text('This field is required');
                        return validateSimNo = false;
                    } else if (unknownNum != '' || simNoValue.length != 17) {
                        return validateSimNo = false;
                    } else {
                        return validateSimNo = true;
                    }

                })
                if (validateSimNo === false) {
                    document.body.scrollTop = 400;
                    document.documentElement.scrollTop = 400;
                }
                return validateSimNo;
            })

            $('.existing_phone').on('keypress change', function () {
                $(this).val(function (index, value) {
                    return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
                });
                let existing_phone = $(this).val();
                let existing_div = $(this);
                if (existing_phone.length == 17) {
                    var smNumber = existing_phone.replace(/\s/g, '');
                    $.ajax({
                        url: "https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/themes/betheme/SimValidation.php?SimNumber=89972" + smNumber,
                        type: "GET",
                        success: function (result) {
                            console.log(result);

                            if (result != "") {
                                $(existing_div).parent().find('.eSimNum').text('');

                            } else {
                                $(existing_div).parent().find('.eSimNum').text('Unknown Number');
                            }

                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });

                } else {

                }
            });

        } else {
            $('#sim_card_no').remove();
        }



    }

		function clickNext1(){
		$('.school-popup').text('');
		 $('#next1').click();
		closePopup('#wrap_popup1');
		
		setTimeout(function (){
			 $(".popupTitle").removeClass('d-none');
			$('.popupclose').removeClass('d-none');
		},1000);
	}
	function openSchoolNewPopup(){
		let message = '<?php echo $p; ?>';
		message = $.trim(message);
		if(message == 'schools-new' || message == 'bhlt' || message == 'kibbutz-volunteers' || message == 'mta-australia'){
    $(".popupTitle").empty();
            $(".popupDesc").empty();  
			 $(".popupTitle").addClass('d-none');
			$('.popupclose').addClass('d-none');
            $(".popupDesc").append("<div id='popupMessage'  style='margin-bottom: -13px;'> <p class='ml-0' style='font-weight: 500;'>Please note:</p>This is a month-to-month rental agreement. The rental will only be terminated once TalknSave receives official notice from the customer to cancel, followed by a confirmation from TalknSave.<br> <div class='btn form-group okbtn' style='width:91px ; font-weight: 500 !important; letter-spacing: 1px;'  onclick='clickNext1()'>Confirm</div></div>");
            openPopup('#wrap_popup1');
		   }
	}


    $(document).ready(function ($) {



        var form_count = 1, form_count_form, next_form, total_forms;
        total_forms = $("fieldset").length;
		
$('[data-toggle="datepicker"]').datepicker({
            minDate: 0,
            dateFormat: 'mm/dd/yy'
        });
		
// 	if( (! ($('#stay_local').length) )  || (! $('#smsPackageName').length ) ){
// 				  $('#optional_add_ons').remove();
// 				}

		 let message = '<?php echo $p ?>';
			 if(message == 'schools-new' || message=='bhlt' || message=='kibbutz-volunteers' || message=='mta-australia' ){
		$('.school-popup').text('true');
				}
		
			$('.zipCodeValidate').on('change keypress',function (e){
			 let regex = new RegExp("^[a-zA-Z0-9\- ]+$");
    let  str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
			else{
				return false;
			}
		});
		
        $('#multistep_form').on('keyup keypress', function (e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });


        $(document).on('click', '.next', function () {

            total_forms = $("fieldset").length;
            let previous = $(this).closest("fieldset").attr('id');
            let nextId = $('#' + this.id);
            let next = nextId.closest('fieldset').next('fieldset').attr('id');




            if (next == 'phone_unlocked') {
               let rentalPhone=$('#rentalPhone').attr('value');
                if (rentalPhone) {
                    next = nextId.closest('fieldset').next('fieldset').attr('id');
                } else {
                    next = nextId.closest('fieldset').next('fieldset').next('fieldset').attr('id');
                }
            } else if (next == 'shipping_Acc') {
                let shippingId = $('#shipping_method :selected').val();
                let shipping_Ass_Id = "shipping_Ass_" + shippingId;
                if ( ($('#bonus-optional').length) || $('#' + shipping_Ass_Id).length ) {
                    next = nextId.closest('fieldset').next('fieldset').attr('id');
                } else {
                    next = nextId.closest('fieldset').next('fieldset').next('fieldset').attr('id');
                }
            }
			if(next == 'shipping_option'){
			   
				// 			for shipping if  AllalreadyHaveSim=0;means  hide shippingoption 
			let AllalreadyHaveSim=0;
		$('.simCount').each( function (index) { 
				let simValue = $(this).find('input:checked').val();
				
				if(simValue != '9999'){
				   AllalreadyHaveSim ++;
				  }
			});
			
			if(AllalreadyHaveSim == 0){
				if(($('#bonus-optional').length) ){
				   next = nextId.closest('fieldset').next('fieldset').next('fieldset').attr('id');
				   }
				else {
						  next = nextId.closest('fieldset').next('fieldset').next('fieldset').next('fieldset').attr('id');
						 }
			    
			   }
				
			   }
			

				 
			
			$(window).scrollTop(0);
            $('#' + next).show();
            $('#' + previous).hide();
            setProgressBar(++form_count);
			
			
        });

        $(document).on('click', '.previous', function () {
            total_forms = $("fieldset").length;
            let current = $(this).closest("fieldset").attr('id');
            let previousId = $('#' + this.id)
            let previous = previousId.closest('fieldset').prev('fieldset').attr('id');

            if (previous == 'phone_unlocked') {
     let rentalPhone=$('#rentalPhone').attr('value');
                if (rentalPhone) {
                    previous = previousId.closest('fieldset').prev('fieldset').attr('id');
                } else {
                    previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').attr('id');
                }
            } else if (previous == 'shipping_Acc') {
                let shippingId = $('#shipping_method :selected').val();
                let shipping_Ass_Id = "shipping_Ass_" + shippingId;

                if (($('#bonus-optional').length) || $('#' + shipping_Ass_Id).length) {
                    previous = previousId.closest('fieldset').prev('fieldset').attr('id');
                } else {
                    previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').attr('id');
                }
            }
			
				if(previous == 'shipping_option'){
			   
				// 			for shipping if  AllalreadyHaveSim=0;means  hide shippingoption 
			let AllalreadyHaveSim=0;
		$('.simCount').each( function (index) { 
				let simValue = $(this).find('input:checked').val();
				
				if(simValue != '9999'){
				   AllalreadyHaveSim ++;
				  }
			});
			
			if(AllalreadyHaveSim == 0){
				if($('#bonus-optional').length ){
				   previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').attr('id');
				   }
				else {
						  previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').prev('fieldset').attr('id');
						 }
			    
			   }
				
			   }




            $('#' + previous).show();
            $('#' + current).hide();
            setProgressBar(--form_count);

        });
        setProgressBar(form_count);
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / total_forms) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                    .css("width", percent + "%")
            // .html(percent + "%");
        }
 



        $('#need_sim').find('input[type=radio]').on('change', function () {
            needSim();
        });
        $('.cloneSimDefault ').find('input[type=radio]').on('change', function () {
            needSim();
        });
  $('.bus').change(function () {
	   let busValue= $(this).val();
	   let linkId = $(this).find(":selected").attr('linkid');
	   let b =$.trim($(this).attr('b'));
	   let qty = $(this).attr('qty');
	  let pageName='<?php echo $p ?>';
if(busValue !=''){
   	  if(busValue == linkId ){
		 return 
		 }
	  else {
		  let url ="?b="+b+"&linkid="+linkId+"&qty="+qty+"&p="+pageName;
		 window.location=url;
// 		  location.reload();
	  }
   }
	  
	  
  });
		
        $('#credit-card').on('keypress keyup  change', function (e) {
			 e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
//             $(this).val(function (index, value) {
//                 return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
//             });

        });
		 $('#credit-card').on('blur', function () {
          			
		$(this).parent().find('.cardNumError').text('');
         let  myCardNo = $(this).val();
			 myCardNo = $.trim(myCardNo);
			 myCardNo=myCardNo.replace(/\s/g, "");
			 myCardNo = myCardNo.toString();
  let  myCardType = $('#cardType :selected').val();
if(myCardNo.length > 15 ){
   			  let pos= myCardNo.length 
			 
			   let aValue =0;
				 let bValue=0;
	let loopLength = myCardNo.length /2 ;
			 for(i=0; i<loopLength; i++ ){
// 				let a = myCardNo.charAt(pos - 1);
// 				 let b = myCardNo.charAt(pos);
                let a ;
				 let b;
				let posA = pos -2;
		     let charVal = myCardNo.charCodeAt(posA);
				 charVal = (charVal - 48) * 2;
				 
				
				 if(charVal > 9){
					charVal = charVal-9; 
					}
				  aValue += charVal ;
				 let posB = pos - 1;
				 b = myCardNo.charCodeAt(posB);
				 b = b-48;
				 bValue+=b;
				 pos = pos-2;
			 }
			 let totalAB = aValue + bValue;
			 if(totalAB % 10 == 0){
			$(this).parent().find('.cardNumError').text('');
			}
			 else{
				  $(this).parent().find('.cardNumError').text('Enter a valid card Number');
			 }
   }
			 else{
				  $(this).parent().find('.cardNumError').text('Enter a valid card Number');
			 }
        });

        $('#expiry-date').on('keypress keyup change', function () {
            let expiryDate = $(this).val();
            if (expiryDate.length == 2) {
                $("#expiry-date").val($("#expiry-date").val() + "/");
            }
        });
		$('#expiry-date').on('blur', function () {
			$('.errorExpiry').text('');
            let expiryDate = $(this).val();
			expiryDate=$.trim(expiryDate);
         let monthYear=  expiryDate.split('/');
			let today = new Date();
			let currentYear = new Date().getFullYear().toString().substr(-2);
			let currentMonth = String(today.getMonth() + 1).padStart(2, '0');
			if(parseInt(monthYear[0]) > 12 ||  (parseInt(monthYear[1]) < parseInt(currentYear) ) || ( parseInt(monthYear[1]) == parseInt(currentYear) &&  parseInt(monthYear[0]) < parseInt(currentMonth))  || (parseInt(monthYear[0]) ==0  || parseInt(monthYear[1]) == 0 ) ){
			$(this).parent().find('.errorExpiry').text('Please enter valid Expiry date ex. 05/25');
			 }
		
			
			else if (expiryDate != ''){
				 let expiryMmAndYy = expiryDate.split('/');
			let expiryMonth = expiryMmAndYy[0];
				if(expiryMonth < 10  && expiryMonth.length <2 ){
				   expiryMonth = 0 + expiryMonth;
					$(this).val(expiryMonth+'/'+ expiryMmAndYy[1]);
				   }
				
			}
		
        });

      

        $('.shipping_option').find('input[type=radio]').on('change', function () {
            if ($(this).prop("checked") == true) {
                checkedVal = $(this).val();
                if (checkedVal == 'yes') {
                    $('.shipping_info').hide();
                    $('.leaving_date').show();
                } else if (checkedVal == 'no') {
                    $('.shipping_info').show();
                    $('.leaving_date').show();
                } else {
                    $('.shipping_info').hide();
                    $('.leaving_date').hide();
                }
            }
        });

		 $(".applyCouponBtn").click(function () {
          ApplyCoupon(this);
        });
		
		function ApplyCoupon(element){
			var couponVal=$.trim($('#coupanCode').val());
			var linkID="<?php echo $link_id ?>";
		   var bundleID='<?php echo $bundle_id ?>';
			if(couponVal==""){
				$('.CouponCodeError').removeClass('d-none').empty().text("Please enter coupon code!");
				$('#newDiscountedPrice').addClass('d-none');
				$('#cprice').css('text-decoration','none');
				$('#cprice').css('color','black');
				$(".discountContainer").addClass('d-none');
			}else{
				 $.ajax({
                        url: "https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/themes/betheme/CouponCodeCheck.php?coupon="+couponVal+"&b="+bundleID+"&linkid="+linkID,
                        type: "GET",
                        success: function (result) {
							if(result=='"invalid"'){
								$('.CouponCodeError').removeClass('d-none').empty().text("Coupon code is invalid or expired.");
								$('#coupanCode').val("");
								$('#newDiscountedPrice').addClass('d-none');
								$('#cprice').css('text-decoration','none');
								$('#cprice').css('color','black');
								$(".discountContainer").addClass('d-none');
							}else{
								const data=JSON.parse(result);
								var isFixedCredit=data[0].FixedCredit;
								var fiexedDiscount=data[0].CouponCredit;
								var discountPercent=data[0].SignupFeesDiscountPercent;
								if(isFixedCredit){
									$(".discountContainer .discountTitle").empty();
									$(".discountContainer .discountTitle").text("Discount");
									$(".discountContainer .discountAmount").empty();
									$(".discountContainer .discountAmount").text("$"+fiexedDiscount.toFixed(2));
									var totalAMount=parseFloat($.trim($('#cprice').text()));
									var discountedPrice=totalAMount-fiexedDiscount;
									$('#newDiscountedPrice').empty();
									$('#newDiscountedPrice').text("$"+discountedPrice.toFixed(2));
									$('#newDiscountedPrice').removeClass('d-none');
									$('#cprice').css('text-decoration','line-through');
									$('#cprice').css('color','red');
									$(".discountContainer").removeClass('d-none');
								}else{
									$(".discountContainer .discountTitle").empty();
									$(".discountContainer .discountTitle").text("Discount "+discountPercent+"%");
									$(".discountContainer .discountAmount").empty();
									var totalAMount=parseFloat($.trim($('#cprice').text()));
									var totalDisc=totalAMount*discountPercent;
									totalDisc=totalDisc/100;
									$(".discountContainer .discountAmount").text("$"+totalDisc.toFixed(2));
									$('#newDiscountedPrice').empty();
									var discountedPrice=totalAMount-totalDisc;
									$('#newDiscountedPrice').text("$"+discountedPrice.toFixed(2));
									$('#newDiscountedPrice').removeClass('d-none');
									$('#cprice').css('text-decoration','line-through');
									$('#cprice').css('color','red');
									$(".discountContainer").removeClass('d-none');
								}
								$('.CouponCodeError').addClass('d-none');
							}
                        },
                        error: function (err) {
							console.log("Error occurred");
                            console.log(err);
                        }
                    });
			}
		}
		
        $("#international").click(function () {
            $(".popupTitle").empty();
            $(".popupDesc").empty();
            $(".popupTitle").text("International Text Messages");
            $(".popupDesc").append("<div id='popupMessage'>MORE TEXTING OPTIONS ï¿½ for your phone!<br><br>Your plan includes unlimited local(Israel) SMS.<br><br>Now you can prepay international text messages and save even more! <br></div>");
            openPopup('#wrap_popup1');
        })



        $('#end_date').change(function () {
            Date_Validate();
        });
		 $('#begin_date').change(function () {
			 	 let maximumPeriod="<?php echo $max_period; ?>"
	 
	 if(!maximumPeriod){
// 		 $('#next1').attr('disabled',false);
	 }
           else{
			    Date_Validate();
		   }
        });
		
		function Date_Validate(){
			 let begin_date = $('#begin_date').datepicker("getDate");
            let end_date = $('#end_date').datepicker("getDate");

            let diifrence = new Date(end_date - begin_date);
            let minDaysOrMonth = '<?php echo $min_period; ?>'
            let days = diifrence / 1000 / 60 / 60 / 24;
            days = days + 1;
            let month = days / 30;
            let maxDaysOrMonth = '<?php echo $max_period; ?>'


            minDaysOrMonth = minDaysOrMonth.split('|');
            maxDaysOrMonth = maxDaysOrMonth.split('|');
            minDaysOrMonth[0] = parseInt(minDaysOrMonth[0]);
            maxDaysOrMonth[0] = parseInt(maxDaysOrMonth[0]);

            if (minDaysOrMonth[1] == "d" && maxDaysOrMonth[1] == "d") {
                if (days < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental period is ' + minDaysOrMonth[0] + ' days.');
                    return false;
                } else if (days > maxDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The maximum rental period for this group is ' + maxDaysOrMonth[0] + ' days.');
                    return false;
                } else {
//                     $("#next1").attr('disabled', false);
                    $('#error_day').text('');
                }
            } else if (minDaysOrMonth[1] == "d" && maxDaysOrMonth[1] == "m") {
                if (days < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental period is ' + minDaysOrMonth[0] + ' days.');
                    return false;
                } else if (month > maxDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The maximum rental period is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else {
//                     $("#next1").attr('disabled', false);
                    $('#error_day').text('');
                }
            } else if (minDaysOrMonth[1] == "m" && maxDaysOrMonth[1] == "m") {
                if (month < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental period is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else if (month > maxDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The maximum rental period is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else {
                    $("#next1").attr('disabled', false);
                    $('#error_day').text('');
                }
            } else if (minDaysOrMonth[1] == "m" && maxDaysOrMonth[1] == "d") {
                if (month < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental period is ' + minDaysOrMonth[0] + ' month.');
                    return false;
                } else if (days > maxDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The maximum rental period is ' + maxDaysOrMonth[0] + ' days.');
                    return false;
                } else {
                    $("#next1").attr('disabled', false);
                    $('#error_day').text('');
                }
            } else {
                if (days < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental is ' + minDaysOrMonth[0] + ' days.');
                    return false;
                }
            }

		}
		
        $(".equipmentSim").change(function () {
            $("#next2").attr('disabled', false);


        });
		 $('#next1').click( function () {
			   let validateDate ;
			$('.busError').text('');
			 $('.validateDate').each( function () {
				 $('.dateError').text('');
				 let value = $(this).val();
				 let errorDate=$('#error_day').text()
				 errorDate=errorDate.trim();
				
				 if(value == '' || errorDate != '' ){
					 if(value == ''){
						$('.dateError').parent().find('.dateError').text("This field is required");
				}
					 return validateDate = false;
					}
							else if ($('.bus').length){
														let busvalue = $('.bus').find(':selected').val()
															if(busvalue == ''){
															$('.busError').text('Please select which bus are you on.');
																return validateDate = false;
															}
}															
				 else{
					 return validateDate = true;
				 }
				 return validateDate;
			 });
			 
			 let stayLocalVal =  $('#stay_local').length ;
			 let smspackageVal=$('#smsPackageName').length;
			  	if( stayLocalVal == 0 &&  smspackageVal ==0 ){
				  $('#optional_add_ons').remove();
				}
			 $('.agentDiv').addClass('d-none');
			 
			 	  let message = $('.school-popup').text();
			  message=$.trim(message);
			 if( validateDate == true && message != '' ){
				 openSchoolNewPopup();
				 return validateDate = false;
				}
			 
			 return validateDate;
		 });


        $(".PhoneSimInfo").click(function () {

            $(".popupTitle").empty();
            $(".popupDesc").empty();
            $(".popupTitle").text("TalknSave Phones and SIM Cards");
            $(".popupDesc").append("<div ><h3 style=' font-size: 22px;'>TalknSave Rental Phones</h3>Our phones are recent, feature-rich phones, with simple controls and great durability.<br>Data capabilities on these phones (examples: Sony Cedar, Nokia C2) allow for basic Facebook and email (especially Gmail), and light surfing.<br><h3 style='margin-top: 14px; font-size: 22px;'>TalknSave SIM Cards</h3>Use a TalknSave SIM card in your smartphone from home! Make sure you order the right size for your phone model. You can check your manual or measure the SIM you have:<h3 style='margin-top: 14px; font-size: 22px;'>Regular SIM cards:</h3>For older smartphones, these SIM cards are 2.5 centimeters long.<br><h3 style='margin-top: 14px; font-size: 22px;'>MicroSIM cards:</h3>For many current smartphones and the iPhone 4, MicroSIMs are 1.5 centimeters long.<br><h3 style='margin-top: 14px; font-size: 22px;'>NanoSIM cards: </h3>For some of the newest smartphones and the iPhone 5/6, NanoSIMs are 1.23 centimeters long.<br><h3 style='margin-top: 14px; font-size: 22px;'>Have a SIM card already?</h3> Use a SIM card from a previous rental! Put in your 19 digit SIM card number and we will put a new phone number on your SIM.</div>");
            openPopup('#wrap_popup2');

        });
		$(".phoneUnlocked").click(function () {
			    $(".popupTitle").empty();
            $(".popupDesc").empty();
              $(".popupTitle").text("Unlock Phone & Compatibility");
            $(".popupDesc").append("<div style='font-size:16px;'>To learn more about unlocking your phone, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone' target='_blank' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone/'); return false;'>click here</a>.<br>To learn more about phone compatibility, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible' target='_blank' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible/'); return false;'>click here</a>.");
			openPopup('#wrap_popup2');
		});
		
		
        $('.optionalAdd').change(function () {
           optionalAdd();
        });

        $('#stay_local').change(function () {
            let option = $('#stay_local option').filter(':selected').text();
            let country = $('option:selected', this).attr('data-country');
            if (option != 'Select') {
                if (option != 'No, Thank you') {
                    $(".popupTitle").empty();
                    $(".popupTitle").text("Stay local Number");
                    $(".popupDesc").empty();
                    $(".popupDesc").append("<p style='font-size: 16px; margin-bottom: 20px;'>Land in Israel and still receive calls from your " + country + " number!  </p><p style='font-size: 16px; margin-bottom: 20px;'> You can forward your " + country + " number to the virtual number you will receive with your rental confirmation! Please make sure to do so prior to your departure.</p> <p style='font-size: 16px; margin-bottom: 20px;'> If your phone does not have the 'call forwarding' option, please contact your service provider. Or, just use the number you are provided with. </p>");
                    $("#sLearnMore").click();
                }
//                 $("#next6").attr('disabled', false);
            } else {
//                 $("#next6").attr('disabled', true);
            }
        });
        $("#staticLearnMore").click(function () {
            $("#staylocalTitle").empty();
            $("#stayLoacalDesc").empty();
            $("#staylocalTitle").append("<?php echo $data['stayLocalLearnMoreTitle']; ?> ");
            $("#stayLoacalDesc").append("<div style='font-size:16px;'>Your TalknSave phone is a local Israeli phone, with an Israeli number. For your family, colleagues, clients and friends back 'home', it can be very expensive to call you in Israel.<br/><br/>That'why we offer our virtual number program, called a <span class ='txtSms'>''Stay Local'' number</span>, to make it easier for you to be reached in Israel. You will be assigned an additional number that rings on your phone in Israel – but is a local call for your friends and family.<br/><br/>Calls you receive via your <span class ='txtSms'>''Stay Local'' number</span>will be charged according to the plan you choose.<br/><br/>Bonus feature! Your <span class ='txtSms'>''Stay Local'' number</span>will show up on the destination phone's caller ID display, so your friends will know you're calling! (USA only)<br/><span class ='txtSms'>''Stay Local'' number </span> charges may be itemized separately from TalknSave. <br><br></div> ");

        });
        $('#shipping_method').change(function () {
            $('.shipping_Ass').addClass('d-none');
            let option = $('#shipping_method option').filter(':selected').text();
            let shippingTitle = $(this).find(':selected').data('title');
			let  optRequireShipAddress= $(this).find(':selected').attr('opt-require-ship-address');
			optRequireShipAddress=$.trim(optRequireShipAddress);
            let shippingDesc = $(this).find(':selected').data('desc');
            let cost = $(this).find(':selected').data('cost');
            let shippingId = $('#shipping_method :selected').val();
            let shipping_Ass_Id = "shipping_Ass_" + shippingId;
            $('#' + shipping_Ass_Id).removeClass('d-none');
$('.shipping_phonelabel').text('Phone Number ');

            $('#USA_stateP').addClass('d-none');
            $('#Canada_statesP').addClass('d-none');
            $('.leaving_date').hide();
            $('#USA_stateP').find('select').removeClass('shipping');
            $('#Canada_statesP').find('select').removeClass('shipping');
            $("input:radio[name=shipping_address]").prop("checked", false);
            $('.shipping_info').hide();
            $("#next8").attr('disabled', true);
          
			
            if (optRequireShipAddress == "0") {
                $('.shipping_option').addClass('d-none');
				
                $('.shipping_heading').hide();
                $('.shipping_info').hide();
                $('.leaving_date').hide()
                $(".popupTitle").empty();
                $(".popupDesc").empty();
                $(".popupTitle").append(shippingTitle);
                $(".popupDesc").append(shippingDesc);
                $("#sLearnMore").click();
				$('input[name="shipping_address"]').prop('checked', false);
                $("#next8").attr('disabled', false);
            } else if (option != 'Select') {
                $('.shipping_option').removeClass('d-none');
                $('.shipping_heading').show();
                $(".popupTitle").empty();
                $(".popupDesc").empty();
                $(".popupTitle").append(shippingTitle);
                $(".popupDesc").append(shippingDesc);
                $("#sLearnMore").click();
//                 $("#next8").attr('disabled', true);

                let label = $('#shipping_method :selected').parent().attr('label');
                label = label.trim();

                if (label === 'USA') {
                    $('#USA_stateP').removeClass('d-none');
                    $('#USA_stateP').find('select').addClass('shipping');

                } else if (label === 'Canada') {
                    $('#Canada_statesP').removeClass('d-none');
                    $('#Canada_statesP').find('select').addClass('shipping');
                }
  else if (label == 'Israel'){
		     $('.shipping_phonelabel').text('Israeli Phone Number for Delivery Coordination ');
		   }
            } else {
                $("#next8").attr('disabled', true);
            }
        });

        $('input[type=radio][name=shipping_address]').change(function () {
            if ($('input[name=shipping_address]:checked').val() === "yes") {
                $('#date_to_leave').removeClass('shipping');
                $("#next8").attr('disabled', true);
                let date_to_leave = $('#date_to_leave').val();
                if (date_to_leave) {
                    $("#next8").attr('disabled', false);
                }

                $('.shipping_info').hide();
                $('.leaving_date').show();
                $('#date_to_leave').removeClass('d-none');
                $('#date_to_leave').change(function () {
                    let date_to_leave = $('#date_to_leave').value;
                    if (date_to_leave != '' && $('input[name=shipping_address]:checked').val() === "yes") {
                        $("#next8").attr('disabled', false);
                    }
                })
            } else if ($('input[name=shipping_address]:checked').val() === "no") {
                $('#date_to_leave').addClass('shipping');
                $("#next8").attr('disabled', true);
                $('.shipping_info').show();
                var selectedOption=$.trim($('#shipping_method').find(":selected").parent().attr('label'));
				if(selectedOption=="Israel"){
					$('.shipping_info').find('.zipCodeValidate.shipping').addClass('d-none');
					$('.shipping_info').find('.zipCodeValidate.shipping').parent().addClass('d-none');
				}else{
					$('.shipping_info').find('.zipCodeValidate.shipping').removeClass('d-none');
					$('.shipping_info').find('.zipCodeValidate.shipping').parent().removeClass('d-none');
				}
                $('.leaving_date').hide();
				$('#date_to_leave').addClass('d-none');
                $('.shipping').change(function () {
                    $('.shipping:not(.d-none)').each(function () {
                        if ($(this).val() == "") {
                            $("#next8").attr('disabled', true);
                            return false;
                        } else {
                            $("#next8").attr('disabled', false);
                        }
                    })
                });

            }
        });


        var shippingRadio = "";
        var selected = $("input[type='radio'][name='s_2_1_6_0']:checked");
        if (selected.length > 0) {
            shippingRadio = selected.val();
        }

        $('.billing_email').blur(function () {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            var testEmail = emailReg.test($(this).val());
            if (testEmail === false) {
                $('.invalidEmail').text('Invalid email');
// 			$("#next7").attr('disabled',true);

            } else {
                $('.invalidEmail').text('');
// 			$("#next7").attr('disabled',false);
            }

        });

        $('.payment_email').blur(function () {
            let paymentemail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            let paymentTestEmail = paymentemail.test($(this).val());
            if (paymentTestEmail === false) {
                $('.paymentEmailError').text('Invalid email');
// 			$("#next7").attr('disabled',true);

            } else {
                $('.paymentEmailError').text('');
// 			$("#next7").attr('disabled',false);
            }

        });
		$('#previous1').click(function () {
			$('.agentDiv').removeClass('d-none');
		})

        $('#next7').click(function () {
			
			
            let begin_date = $('#begin_date').datepicker("getDate");
            let billing_email = $('.billing_email').val();
			let cEmail= $('.confirmBillingEmail').val();
			
         setLeavingDate();
            $('.billingR').each(function () {
                $(this).text('');
            });
            var validate;
            $('.billing').each(function () {
                if ($(this).val() == "") {
                    console.log($(this).val());
                    var parent = $(this).parent();
                    parent.find('.billingR').text("This field is required");
                    parent.find('input').focus();
// 			$("#next7").attr('disabled',true);

                    return validate = false;
                } else if ($('.invalidEmail').text() != '') {
// 			$("#next7").attr('disabled',false);
                    return validate = false;
                }
			else if ( cEmail != '' &&  billing_email != cEmail){
				$('.confirmBillingEmail').parent().find('p').text('Email and Confirm Email must be same.');
					return validate = false;
				}
				
				else {
                    return validate = true;
                }

            })

            if (validate === false) {
                document.body.scrollTop = 400;
                document.documentElement.scrollTop = 400;
            }
			

			
            return validate;
        });

        $('#next9').click(function () {
            $('.errorPayment').each(function () {
                $(this).text('');
            });
            var validatePayment;
            $('.payment').each(function () {
                if ($(this).val() == "") {
// 			$("#next9").attr('disabled',true);
                    var parent = $(this).parent();
                    parent.find('.errorPayment').text("This field is required");
                    parent.find('input').focus();
                    return validatePayment = false;
                } else if ($('.paymentEmailError').text() !='' || $('.cardNumError').text() !='' ||  $('.errorExpiry').text() !='' ) {
                    return validatePayment = false; 
                } 
				
				else {
                    return validatePayment = true;
                }

            })
			
			
			
            if (validatePayment === false) {
				$("html, body").animate({ scrollTop: 150 }, "slow");
            
            }



            var shippingId = $("#shipping_method :selected").val();
            let fname = $('input[name$="billing_fname"]').val();
            let lname = $('input[name$="billing_lname"]').val();
            let name = fname + " " + lname;
            let email = $('input[name$="billing_email"]').val();
            let phone = $('input[name$="billing_phone"]').val();
            let begin_date = $('#begin_date').datepicker("getDate");
            let end_date = $('#end_date').datepicker("getDate");


            let diifrence = new Date(end_date - begin_date);
            let days = diifrence / 1000 / 60 / 60 / 24;
			let month = days/30;
            days = days + 1;
			


			var isOnlyStartDay=false;
            let begin_day = begin_date.getDate();
            let begin_month = begin_date.getMonth() + 1;
            let begin_year = begin_date.getFullYear();
            begin_date = begin_day + "/" + begin_month + "/" + begin_year;
			
			let maximumPeriod=<?php echo $optLeaveILrequest ? "true" : "false" ?>;
	let dateString;
			if(maximumPeriod){
			   let end_day = end_date.getDate();
            let end_month = end_date.getMonth() + 1;
            let end_year = end_date.getFullYear();
            end_date = end_day + "/" + end_month + "/" + end_year;
             dateString = begin_date + "-" + end_date;
			   }
			else{
				  dateString = begin_date ;
				isOnlyStartDay=true;
			}



            $("#vatTotle").empty();
            $("#cprice").empty();
            let plan = $('input[name="equipment"]:checked').data('name');
            let insurance = "<?php echo $bundles[0]['IncludedInsurance']; ?>";
            let call = "<?php echo $bundles[0]['CallPackageName']; ?>";
            let sms = "<?php echo $bundles[0]['SMSPackageName']; ?>";
            let data = "<?php echo $bundles[0]['ExtendedDataPackageName']; ?>";

            let shippingDetails = $('#shipping_method').find(":selected").text();
            let shippingName = $('#shipping_method option:selected').data('title');
            let shippingPrice = $('#shipping_method option:selected').data('cost');
            


            $('.stayLocalReview').empty();
            $(".internationalReivew").empty();

            let stay_local_amount = 0;
            let international_amount = 0;

            let accTotal = $('#accFinalAmount').text();
			accTotal=accTotal.trim();
            accTotal = (accTotal) ? accTotal : '0';


           

            $('.OrderDetailsClone').remove();
            let clone = orderCount;



            let bundleRate = "<?php echo $bundles[0]['BundleRate']; ?>";
            let bundleRateFloat = parseFloat(bundleRate);
			let planPriceDurationWise="";
			 let simPrice = 0;
			let simPricePerDayOrMonth;
            let singleSimPrice =<?php echo $bundles[0]['BundleRate']; ?>;
			let bundlePeriod="<?php echo $bundles[0]['BundlePeriod']; ?>";
		
			   if(bundlePeriod.includes('/day')  &&  days ){
				simPricePerDayOrMonth =  parseFloat(days) * parseFloat(singleSimPrice);
				 }
				  else if (bundlePeriod.includes('/month') &&  month){
// 				   simPricePerDayOrMonth = parseFloat(month) * parseFloat(singleSimPrice);
					  simPricePerDayOrMonth = parseFloat(singleSimPrice);
					  planPriceDurationWise="/month";
			   }
				else{
					simPricePerDayOrMonth = singleSimPrice ;
				}
			   
			 let equipmentcost=0;
			
			if (bundlePeriod.includes('/month')){
					  planPriceDurationWise="/month";
			   }
			
            for (i = 0; i < orderCount; i++) {
              
				 let equipment = 'equipment';
						if(i>0){
						   equipment = equipment + i;
						  }
				  let EquipmentName= '';
				let equipmentcost=0;
				
					if($('#simCheckBox').prop('checked') == true){
				   EquipmentName= $('input[name="equipment"]:checked').data('name');
					if(EquipmentName!=undefined ){
						if(EquipmentName.indexOf('$') > 0){
					let equipmentCostIndex = EquipmentName.indexOf('$');
                  equipmentcost = EquipmentName.slice(equipmentCostIndex).trim().split(' ')[0];
                    equipmentcost = equipmentcost.substr(1);
								equipmentcost=parseFloat(equipmentcost);
						if( equipmentcost > 0){
						   equipmentcost = equipmentcost;
						   }
						   else{
						   equipmentcost=$('input[name="equipment"]:checked').data('cost');
						   }
					   }
					else{
						equipmentcost =$('input[name="equipment"]:checked').data('cost');
					}
					
					}
						
					equipmentcost = parseFloat(equipmentcost);
				   }
				else{
				EquipmentName = $('input[name="'+equipment +'"]:checked').data('name');
					
					if(EquipmentName.indexOf('$') > 0){
					let equipmentCostIndex = EquipmentName.indexOf('$');
                  equipmentcost = EquipmentName.slice(equipmentCostIndex).trim().split(' ')[0];
                    equipmentcost = equipmentcost.substr(1);
						equipmentcost=parseFloat(equipmentcost);
						if( equipmentcost > 0){
						   equipmentcost = equipmentcost;
						   }
						   else{
						   equipmentcost=$('input[name="'+ equipment+'"]:checked').data('cost');
						   }
					   }
					else{
						equipmentcost = $('input[name="'+ equipment+'"]:checked').data('cost');
					}
				
					equipmentcost = parseFloat(equipmentcost);
				}
			
				
			
	// new js 
	        let staylocal = 'stay_local';
                let smsPackage = 'smsPackageName';

                var stayrateIndex;
                var internationaIndex;
                var stayLocalValue;
                var internationalValue;
                var stay_localWithDoller;
                var internationalWithDoller;
                if ($('#stayLocalCheckBox').is(":checked")) {
                    stayLocalValue = $('#stay_local :selected').val();
                    internationalValue = $('#smsPackageName :selected').val();
                    if(stayLocalValue){
						stayrateIndex = stayLocalValue.indexOf('$');
					}
                    if (internationalValue) {
                        internationaIndex = internationalValue.indexOf('$');
                    }

                } else {
                    if (i > 0) {
                        staylocal = 'stay_local' + (i);
                        smsPackage = 'smsPackageName' + (i);
                    }


                    stayLocalValue = $('#' + staylocal + ' :selected').val();
                    internationalValue = $('#' + smsPackage + ' :selected').val();
                    if(stayLocalValue){
						stayrateIndex = stayLocalValue.indexOf('$');
					}
                    if (internationalValue) {
                        internationaIndex = internationalValue.indexOf('$');
                    }
                }

                if (stayrateIndex != -1 && (typeof stayLocalValue !== "undefined") ) {
                    stay_localWithDoller = stayLocalValue.slice(stayrateIndex).trim().split(' ')[0];
                    stay_local_amount = parseFloat(stay_local_amount) + parseFloat(stay_localWithDoller.substr(1));

                }

                if (internationaIndex != -1 && (typeof internationalValue !== "undefined")) {
                    internationalWithDoller = internationalValue.slice(internationaIndex).trim().split(' ')[0];
                    international_amount = parseFloat(international_amount) + parseFloat(internationalWithDoller.substr(1));
                }

             			
				
				
				
			     
// 			 simPricePerDayOrMonth = simPricePerDayOrMonth.toFixed(2);
             simPrice = parseFloat(simPricePerDayOrMonth) + parseFloat(simPrice)+parseFloat(equipmentcost);
				

                var clonePlanDetails = $('.multipleOrderDefault').clone();

                $(clonePlanDetails).attr('class', 'OrderDetailsClone');
                $(clonePlanDetails).removeClass('d-none');
				 EquipmentName = EquipmentName.replace("?", '');
				 equipmentcost =parseFloat(equipmentcost);
				$(clonePlanDetails).find('.planPriceDiv').addClass('border-bottom');
				$(clonePlanDetails).find('.planPriceDiv').css('padding-bottom',"13px;");
				$(clonePlanDetails).find('.planPrice').text( '$' + simPricePerDayOrMonth+planPriceDurationWise);
				if( equipmentcost > 0){
					$(clonePlanDetails).find('.planPriceDiv').removeClass('border-bottom');
					$(clonePlanDetails).find('.planPriceDiv').removeAttr('style');
					
				    $(clonePlanDetails).find('.equipmentPriceDiv').removeClass('d-none');
					$(clonePlanDetails).find('.equipmentPrice').text('$'+equipmentcost);
				   }
				let planName= "<?php echo $bundles[0]['BundleText']; ?>";
					planName = planName.replace("<br />",' ');
				planName =planName.replace("<br>" ,' ');
				$(clonePlanDetails).find('.planName').text(planName);
                $(clonePlanDetails).find('.cplan').text(EquipmentName);
			
				
				   if (stayrateIndex != -1  && (typeof stayLocalValue !== "undefined") ) {
                    let stayTitlePrice = "<div class='row'> <div class='col-md-6 col-8'> " + stayLocalValue + "  </div><div class='col-md-6 col-4  text-right font-weight-bold ' > " + stay_localWithDoller + " </div></div>";
                   $(clonePlanDetails).find('.stayLocalReview').append(stayTitlePrice);
                }
                if (internationaIndex != -1 && (typeof internationalValue !== "undefined")) {
                    let internationalTitlePrice = "<div class='row'> <div class='col-md-6 col-8'> " + internationalValue + "  </div><div class='col-md-6  col-4 text-right font-weight-bold ' > " + internationalWithDoller + " </div></div>";
                   $(clonePlanDetails).find(".internationalReivew").append(internationalTitlePrice);
                }
				
				
				
                $('.multipleOrderDefault').parent().append(clonePlanDetails);



            }
           
        

			let setupFeeCost=0;
			setupFeeCost = <?php echo $data['SetupFeeCost']; ?>;
			let SetupFeeText = "<?php echo $data['SetupFeeText']; ?>"
			SetupFeeText = $.trim(SetupFeeText);
		    SetupFeeText = SetupFeeText.replace('@SetupFeeCost',setupFeeCost)
			var qsqty = $("#qsqty").val();
			
			if(setupFeeCost != 0 &&  SetupFeeText){
				setupFeeCost = setupFeeCost;
			   $('.setup').removeClass('d-none');
				if (qsqty > 1) {
                setupFeeCost = setupFeeCost * parseInt(qsqty);
            }
				$('#setupFeeText').text(SetupFeeText);
				$('#setupFeeCost').text( '$' + setupFeeCost);
			   }

//             console.log(qsqty);
            let originalShipAmount=shippingPrice;
			if (qsqty > 1) {
                shippingPrice = (shippingPrice * 50) / 100;
            }
			if(shippingPrice){
				let totalOrderCnt=orderCount;
				$('.addOnqty').each(function(){
					var ctQty=$(this).attr('qty');
					ctQty=parseFloat(ctQty);
					totalOrderCnt+=ctQty;
				});
				if (qsqty > 1) {
                totalOrderCnt = totalOrderCnt-1;
               }
			    shippingPrice = shippingPrice * totalOrderCnt; 
				if (qsqty > 1) {
                shippingPrice+=originalShipAmount;
               }
				
			   }
			else{
				shippingPrice=0;
			}
			
            let totalWithoutVat = parseFloat(simPrice)  + parseFloat(accTotal) + parseFloat(stay_local_amount) + parseFloat(international_amount) + parseFloat(setupFeeCost);
            let vat = (totalWithoutVat * 17) / 100;
            let total = parseFloat(totalWithoutVat) + parseFloat(vat)  + parseFloat(shippingPrice);
            total = total.toFixed(2);
            vat = vat.toFixed(2);

$('#stayLocalReview div').first().css( "margin-top", "15px" );
			$('#internationalReivew div').first().css( "margin-top", "15px" );

//             $(".cplan").text(plan);
           shippingPrice = parseFloat(shippingPrice); 
          
			let covidSignUpFees = <?php echo $data['Covid_SignupFee']; ?>;
			covidSignUpFees = parseFloat(covidSignUpFees); 
			covidSignUpFees = covidSignUpFees *orderCount;
			let extra_fees = parseFloat(shippingPrice) + parseFloat(covidSignUpFees);
            $('#covidSignUpFees').text(extra_fees);
            $("#cprice").text(total);
            $("#cname").text(name);
            $("#cemail").text(email);
            $("#cnumber").text(phone);
			if(isOnlyStartDay){
				$('.serviceDurationTxt').empty().text('Service start date');
			}else{
				$('.serviceDurationTxt').empty().text('Service Duration');
			}
            $(".cdate").text(dateString);
            $("#cprice").text(total);
            $(".data").text(data);
            $("#vatTotle").text(vat);
            $(".sms").text(sms);
            $(".call").text(call);
            $("#shippingName").text(shippingName);
            if (shippingPrice === 0) {
                $("#shippingPrice").text("Free");
            } else {
                shippingPrice = shippingPrice.toString();
                shippingPrice = "$" + shippingPrice;
                $("#shippingPrice").text(shippingPrice);
            }

            if (insurance) {
                $(".insurance").text("included!");
            } else {
                $(".insurance").text("Not included!");
            }

            return validatePayment;
        });

        $('#next12').click(function () {
            $('#accFinalAmount').empty();
            $('#accCart').empty();
            var finalAmount = 0;
            $('.phonecard').each(function () {
                let qty = $(this).find('.qty').val();
                if (qty > 0) {
                    let parent = $(this).closest(".phonecard");
                    let image = parent.find('.optional-image').attr('src');
                    let title = parent.find('.optional-title').data('title');
                    let qty = parent.find('.qty').val();
                    let price = parent.find('.optional-price').data('price');
                    price = price.replace('<br>' ,'');
                   //                     let amount = price.replace(/^\D+/g, '');
            let amountIndex = price.indexOf('$');
		let amount = price.slice(amountIndex).trim().split(' ')[0];
					amount = amount.substr(1);
                    amount = parseFloat(amount);
                    amount = amount.toFixed(2);
                    let singleAmount = parseFloat(amount) * parseInt(qty);
                    singleAmount = singleAmount.toFixed(2);
                    finalAmount = parseFloat(singleAmount) + parseFloat(finalAmount);
                    let acc = "<div class='row border-bottom pb-2'><div class='col-md-9 opsAddOnDD' style='display: flex; align-items: center;'>  <img class='opsAddOn_imgDD' src=" + image + " alt=''  style='max-width: 65px;'> <span class='opsAddOn_titleDD' style='margin-left:11px;     width: 195px;'> " + title + "  &nbsp; &nbsp; &nbsp; </span>   <small class='addOnqty' qty='"+qty+"'> " + qty + "&nbsp; x </small> <span > &nbsp; " + price + " </span>  </div><div class='col-md-3 text-right font-weight-bold '> $" + singleAmount + " </div> </div>	"
                    $('#accCart').append(acc);


                }

            });
            $('#accFinalAmount').text(finalAmount);

        })
        
		function SimPopup(element){
			let popupData=$(element).data('popup');
            $(".popupTitle").empty();
            $(".popupDesc").empty();
			if($(element).attr('id') == '2510' ){
				            $(".popupTitle").text("Network Capabilities");
            $(".popupDesc").append("<div style='font-size:16px;'>Important: Your phone must be unlocked by your wireless provider back home and have the proper 3G and 4G network capabilities.<br>To learn more about unlocking your phone, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone' target='_blank' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone/'); return false;'>click here</a>.<br>To learn more about phone compatibility, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible' target='_blank' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible/'); return false;'>click here</a>.<br><br></div> <div class='d-flex justify-content-center'><img style='max-width:80%' src='https://dev.newedgedesign.com/talknsave/wp-content/uploads/2021/05/multisim.png' alt='multisim' width='100%'></div> <div  onclick='closeNetworkPopup()' style='padding: 5px;' class='popup-footer okbtn'> Next</div>");
				
				$('.popup-footer').text('Cancel');
			}
			else{
				$(".popupDesc").append(popupData);
			}
			

            openPopup('#wrap_popup2');
		}
		
        $('.simPopup').click(function () {
		SimPopup(this);
        });

        $("#termsAndCond").click(function () {
            $(".popupTitle").empty();
            $(".popupDesc").empty();
            $(".popupTitle").text("Terms and Conditions");

            $(".popupDesc").append(" <ol class='Standartol'><li class='StandartLi'><span class='StandartLiSpan'>Commitment to provide service: </span>The Company will provide to the Customer (or user herein named Customer), and the Customer will acquire from the Company, telecommunication services in accordance with the terms set out on the signed contract and in these Terms and Conditions. The Customerâ€™s contract is with the Company alone, which has obtained the right to provide the services contemplated herein from their providers (including but not limited to Hot Mobile,Cellcom, Bezek, Pelephone, etc), and the Customer has no rights whatsoever vis-Ã -vis those service providers. All information from the providers concerning use of the telecommunication services which are the subject herein, including but not limited to, use thereof, details of calls, times and length thereof, or any other information, shall be provided by the providers to the Company only. The Customer waives all rights of privacy with respect to such information. The Company reserves the right to cancel the service to the Customer, and disconnect the service, for any reason. The records, invoices and other records of the Company and/or the providers with regard to the telephone and service which are the subject herein shall be binding on the Customer. The Company may include the name and other details of the Customer in any database or publication of the Company.</li><li class='StandartLi'><span class='StandartLiSpan'>Payment and notification of modification agreement: </span>Provision of services by the Company is subject to fulfillment by the Customer of all of his obligations hereunder, including but not limited to, payment of all charges on his account for calls (including primary and third party usage and connections), data calls and additional services. The Company reserves the right to make changes to the rates without prior notice. The Company reserves the right to modify existing or contracted rates in case of fluctuations in the currencies market, including but not limited to assessing a fee or surcharge to equalize currency values to the current Israeli shekel. The Customer hereby irrevocably authorizes the Company to charge his credit card, as set out on the signed contract, for all charges incurred by the telephone which is the subject hereof. The Customer understands that payment through any other method (such as but not limited to cash, check and so on) may incur an additional processing fee. This agreement shall have full effect notwithstanding that the actual user of the service may be less than 18 years of age. The Customer recognizes the right of the Company to access, evaluate and exchange the Customerâ€™s credit history in order to service the account. In case of a change in the Customerâ€™s personal information (such as, but not limited to, change of billing / home address, userâ€™s program information, etc.), the Customer bears full responsibility for providing the Company with the updated information. The Company will not be obligated to compensate for discounts lost because of delinquency on the part of the Customer to provide such information. Failure to provide the Company with the same may result in disconnection of service. Billing cycles and other Company actions may be interrupted by a force Majour. The Company will not be liable in case of the same.</li><li class='StandartLi'><span class='StandartLiSpan'>Provisions in case of negligent payment:</span>The Company reserves the right to suspend or terminate service to the Customer at any time with or without notice in case of negligent payment by the Customer. The Company will do its best in full faith to contact the Customer according to the contact information set out on the signed contract in such event prior to such termination. The Company reserves the right to assess a service charge or reconnection fee as a result of suspension, or resumption of service after payment has been received in full. Fees currently stand at $25.00 US (as of February 2008). In the case of Customer legal dispute of previously collected payment (e.g. a â€œchargebackâ€), upon resolution of the dispute in favor of the Company, the Company reserves the right to assess a processing fee, currently set at $35.00 USD (as of January 2007). In the case of protracted negligent payments, the Company reserves the right to file Delinquency Report(s) with any or multiple credit agencies and bureaus. In addition all fees and costs related to the collection of monies owed under these terms and conditions are the sole responsibility of the customer. Penalties for overdue bills may be charged, according to the ×”×™×ª×¨ ×¢×¡×§×” of Bank Mizrahi Israel.</li><li class='StandartLi'><span class='StandartLiSpan'>Security deposit information: </span>The Company may collect a monetary security deposit from the Customer, in whole or in part, as set out on the signed contract. The security deposit may be collected as soon as the Customerâ€™s account has been opened, even if the Customer has not begun service. Upon termination of the account, the Company will credit the Customerâ€™s account and any previous outstanding balance with the same on or after the final statement. The Company reserves the right to demand that the Customer increase the deposit in such amounts as the Company deems appropriate (for example, but not limited to, in the case of an exceptionally high volume of usage).</li><li class='StandartLi'><span class='StandartLiSpan'>Network limitations, liability and data provision: </span>The Customer is aware that the Company is providing some services through the Hot Mobile and/or Pelephone networks, and therefore the Customer shall be subject to all of the rules, regulations, terms and conditions applicable to such service under Israeli law or under Hot Mobile and/or Pelephoneâ€™s general agreement for provision of telecommunications services. The Customer is aware that such agreement provides specifically, and without limitation, that neither Hot Mobile nor Pelephone nor any employee or representative thereof shall have any liability for any damage, specific, direct or indirect, caused as a result of the limitation of the cellular service, its suspension, disconnection or termination, in violation of the general agreement, whether consciously or by error, or by error with regard to Hot and/or Bezek, or non-inclusion in any Hot and/or Bezekâ€™s electronic record, or any delay in any of the above. The Customer will be billed for usage on the equipment according to the monthly usage data provided by Hot Mobile and/or Pelephone and/or any outside providers according to the standard billing cycle of the Company. In the case of delay of transmission of said monthly usage data (for example but not limited to a call from two months ago only being provided to the Company for billing now), the usage will be charged against the current cycle calculated at the current rate for usage (including totals of minutes against allotted packages). The Company cannot support retroactive delayed calculations at previous tariffs. The Customer is further aware that the service provided by the Company is subject to the quality and availability of the Hot Mobile and/or Pelephone service in Israel. In particular, the Customer is aware that cellular telephone service may not be available in all parts of Israel or the territories administered by the Israel Defense Forces or the Palestinian Authority, or that conversations may be of poor quality, or may disconnect from time to time and from place to place. The Customer shall have no claims whatsoever against the Company and/or Hot Mobile and/or Pelephone with regard to the above. The Customer understands that the Company is in no way responsible for any damages or harm incurred on the Customerâ€™s self or to others during usage of a phone or any of its accessories. This includes both direct and indirect damage.</li><li class='StandartLi'><span class='StandartLiSpan'>Customer liability: </span>The Customer may not at any time transfer or sublet their contracted service to any other person or institution. Notwithstanding the above, the Customer shall be responsible for all charges incurred by the telephone number or rented equipment of the Customer, whether or not such use was made by the user or was authorized by the Customer. It is explicitly stated that if the equipment is stolen or otherwise taken unlawfully, the Customer shall remain liable for the charges incurred through the Companyâ€™s service until the phone line or PIN is actually disconnected by Hot Mobile and/orPelephone or the relevant provider after due notice. Customer is aware that the sole responsibility to disconnect the line in case of theft or loss is his alone. The Company may also cancel the service to the Customer and disconnect the service without notice and with immediate effect if the Customer is in breach of its obligations to the Company or violates applicable Pelephone rules and regulations or any law, rule, regulation, term or condition of cellular telephone service under Israeli law. Important: Your phone must be unlocked by your wireless provider back home and have the proper 3G and 4G network capabilities.To learn more about unlocking your phone, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone#_ga=2.27020797.1988241322.1582641652-924345596.1557820807' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone#_ga=2.27020797.1988241322.1582641652-924345596.1557820807'); return false;'>click here</a>. To learn more about phone compatibility, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible#_ga=2.27020797.1988241322.1582641652-924345596.1557820807' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible#_ga=2.27020797.1988241322.1582641652-924345596.1557820807'); return false;'>click here</a>.<br><br>If the Customer makes calls or uses services in a way that differs from the printed directions enclosed with their rental equipment including but not limited to forcing calls through a third-party international carrier (e.g. 012, 013, etc) the Company is not required to honor the rates as per the contract.<br><br>If the customer does not report defective equipment during the rental period, and allow for the matter to be resolved or for troubleshooting to be attempted, the customer will be liable for all fees and costs associated with the rental for the duration of the rental period.</li><li class='StandartLi'><span class='StandartLiSpan'>Monetary Obligations: </span>Although any user may be specified on a contract with the Company, it is still the legal obligation of the credit card holder that is listed on the customerâ€™s contract to pay for all fees, including but not limited to, calls, monthly fees, delivery fees, services and VAT (value added tax) incurred by the user. Under no circumstances may the credit card holder refuse payments based on any non-agreement with userâ€™s calling patterns or for any other reason.</li><li class='StandartLi'><span class='StandartLiSpan'>VAT: </span>VAT (value added tax, at the rate set by the Israeli government) shall be calculated for and added to all charges, including but not limited to, call rates & charges, rental fees, insurance fees, service fees and delivery fees.</li><li class='StandartLi'><span class='StandartLiSpan'>Rental insurance: </span>The Customer may opt to have insurance coverage on his rental equipment (many rentals have mandatory insurance). Insurance coverage is per Hot Mobileâ€™s and/or Pelephoneâ€™s standard insurance terms, and covers repair of telephone handsets when repair is possible, and replacement of handset in the case of loss, theft, or irreparability. Replacement will be conditioned on the payment of a deductible by the Customer, paid directly to the Company. Rental insurance covers the telephone handset only. Accessories (such as, but not limited to, chargers, cases, etc.) are not covered by the rental insurance. If a customer chooses to decline rental insurance, they will be responsible to pay for repair and/or replacement of damaged and/or missing rental equipment. See paragraph 14 below.</li><li class='StandartLi'><span class='StandartLiSpan'>Replacing and servicing equipment: </span>When the Customerâ€™s equipment is covered by insurance, then in the case of theft or loss of the telephone in Israel, such telephone shall be replaced with a similar instrument or instrument of similar value, at the discretion of Hot Mobile and/or Pelephone or the Company, in accordance with Hot Mobile and/or Pelephoneâ€™s standard insurance terms. The Customer specifically understands that when his equipment is covered by insurance, replacement of a telephone as a result of theft, loss, or damage is conditioned on the payment of a deductible by the Customer. Neither the Company nor Hot Mobile and/or Pelephone shall have any obligation to the Customer, to the User or to any other person as a result of the unavailability of the use of the telephone while awaiting repair or awaiting replacement. Equipment that needs to be serviced may be done via Hot Mobileâ€™s repair services or directly through the Company. Insurance coverage covers repair up to the stage of complete loss. Definitions of â€œcomplete lossâ€ in regards to the reparability of equipment will be determined by the Company or the equipment manufacturer. Tampering with internal components of cellular equipment (such as but not limited to phones, GPS units, etc.) when a label indicates that such action will void the warranty will also result in a â€œcomplete lossâ€ penalty. Courier service to bring equipment in, to be serviced either by Ho Mobile or the Company, and / or to return equipment to the Customer after such service, will be charged according to a fixed rate schedule depending on the location of the Customer.</li><li class='StandartLi'><span class='StandartLiSpan'>Contract duration: </span>The term of this contract begins on the date specified on the signed contract. The Customer shall pay the charges incurred in connection with the telephone each month for the duration of the contract, whether or not the telephone is actually in use during any portion thereof. If the Customer returns their equipment or in any way terminates the account before the contracted length of time has passed, the Company reserves the right to charge a cancellation fee, penalties and / or the remaining contractual obligation of fees. In order to terminate a long term contract the Company must be informed that the Customer wishes to close the account on, or prior to, the last date of service. Failure of the Customer to close their account with the Company will result in continued monthly charges regardless of whether the telephone is actually in use.</li><li class='StandartLi'><span class='StandartLiSpan'>Order cancellation: </span>Prior to the start date of the rental period cancellation of the order for a Short-term rental (under two months) will incur a cancellation fee currently $15 as of May 2015. After the start date short-term rental cancellation will only be allowed in case when the customerâ€™s equipment is locked, the service was not used, and only 50% of the package fees will be refunded. Furthermore, all shipping and handling fees will stand and the rental equipment must be returned to the Company within 5 days from the date of the cancellation. Cancellation of a long term rental is only allowed prior to the start date and will incur a fee of $15 in addition to any set up fee on the order which will have to be paid. Furthermore, all shipping and handling fees will stand and the rental equipment must be returned to the Company within 5 days from the date of the cancellation.</li><li class='StandartLi'><span class='StandartLiSpan'>Usage specifics: </span>Occasionally the Company may require a minimum level of outgoing call usage per month from the Customer in order to guarantee contracted rates, specials, and the like. In this case, the signed contract will state that a certain offer is dependent on a minimum level of outgoing usage. If the minimum usage requirements are not met, the Company reserves the right to bill additional fees to the Customer for the entire sum duration of the contract or to take other action, as per the original agreement. Example one: a monthly rental rate might be $9.99 but only if the Customer has $10 worth of calls in that period. Example two: a line unused for outgoing calls in a certain time period may be terminated. Unlimited voice or text packages or plans are provided with the understanding that they are primarily for voice services (dialogue) or text services (individual messages) as used by a single Customer and not shared, and that they are not utilized primarily for call forwarding, conference calling or broadcasting to mailing lists. Unlimited= â€œfair usageâ€ = up to 3000 units and/or minutes. In case of abuse, defined as usage exceeding â€œFair Usageâ€ the Company may, at its option, terminate the Customerâ€™s service or charge an abuser fee and/or a per minute charge. The abuser fee currently stands at $15.00 US per month for the first three months of abuse. After 3 months the abuser fee will stand at $50.00 US per month. The overage per minute charge may be as high as 19.9 cents per minute and/or text message. Note that regarding data, transmission speeds may be reduced after approximately 5 gigabytes of usage. Unlimited packages or plans may not be used for data transmissions or broadcasting, or excessive call forwarding. The Company reserves the right to limit special offers such as but not limited to free minute plans to one per user. Customers on plans with different tariffs for different types of calls (for example but not limited to calls to Pelephone numbers, usually with an 050 prefix) will be billed according to the actual service incurred â€“ that is, if a destination number has been ported to a different source than its origin (as in the example of an 052 Cellcom number ported to Orange service), the Customer will be charged according to the current service, not the original service. This is notwithstanding the fact that a Customer may be unaware of the destination numberâ€™s status. Additionally, rates are not guaranteed for access numbers, * numbers, shortcuts, or service calls, such as but not limited to 1-800 type numbers, calling cards, Information, etc. Plans and packages are by default calculated and billed based on full minute increments; exceptions will be noted on the signed contract between all parties.</li><li class='StandartLi'><span class='StandartLiSpan'>Return of rental equipment: </span>The customer must return the rental equipment immediately upon the conclusion of the rental. SIM cards are not considered to be rental equipment and do NOT need to be returned. Exception to the above rule are SIM cards that were inside rented equipment. The Company reserves the right to charge late fees and or continued rental and service charges until the time of return. Short term rentals will be allowed a 7 day grace period for rental return. Rental equipment must be returned according to the following regulations:<br><br><b>Short-term rentals</b> (under two months) must be returned to the office from which they originated, e.g. phones delivered from the Jerusalem office, i.e., within Israel, must be returned to the Jerusalem office, and phones delivered from the New York office, i.e., within the United States, must be returned to the New York office, etc.<br><br><b>Long-term rentals</b> (over two months) must be returned to the <b>Jerusalem, Israel</b> office, regardless of office or country of delivery. Occasionally other rules will apply â€“ they will be specified on the signed contractual agreement. Penalties and shipping fees are applicable if equipment is returned to a different location than required by these regulations. If the equipment is not returned in the specified seven (7) business days, late fees and / or additional rental or service fees will in all cases continue to accrue. The Customer is responsible for any calls made following expiration of the contract until the equipment is returned to the Company and receipt confirmed. The Company shall, at its discretion, deduct from the telephone deposit and / or charge such amounts as it determines to be appropriate to reflect the diminished value of a telephone that is not returned in good condition, where such damage is not covered by the insurance. All rental equipment provided at the initiation of the contract must be returned to the Company. The Customer agrees to be billed for equipment that is not returned to the Company, or that is returned to Company damaged, upon termination of the contract. The following pay schedule is current as of January 2011, is not inclusive of VAT, and is subject to increase:<br><br><ul class='StandartUl'><li class='StandartLi'><span class='StandartLiSpan'>Replacement of insured telephone handset: </span>$79 to $99 USD (high tier models may be higher) </li><li class='StandartLi'><span class='StandartLiSpan'>Replacement of uninsured telephone handset: </span>$199 USD </li><li class='StandartLi'><span class='StandartLiSpan'>Replacement of telephone battery: </span>$20.00 USD </li><li class='StandartLi'><span class='StandartLiSpan'>Replacement of phone charger: </span>$20.00 USD </li><li class='StandartLi'><span class='StandartLiSpan'>Replacement of phone case, face plate, casing, car charger or handsfree device: </span>$19.00 USD </li><li class='StandartLi'><span class='StandartLiSpan'>Replacement of uninsured cellular broadband modem device: </span>$299.00 USD </li><li class='StandartLi'><span class='StandartLiSpan'>Replacement of insured cellular broadband modem device: </span>$99.00 USD </li></ul></li><li class='StandartLi'><span class='StandartLiSpan'>Smartphone Rentals: </span>All smartphone rentals come with Otterbox cases or similar and a charger. In the case that these are not returned a charge of $50 for the Otterbox and $20 for the charger will be charged to the customer. If the phone itself is damaged an insurance deductible of $100 will be charged in all cases where the phone can be repaired. If the phone is lost or stolen or damaged beyond repair the customer will be charged between $200 and $400 for the replacement. The charge will vary depending on the phone model. If the phone is not returned to the the Companyâ€™s office the customer will be charged between $200 and $400 for the replacement. The charge will vary depending on the phone model.<br><br>iPhone rental customers must remove their Apple ID and password from the phone before returning the phone. A $39 removal fee will be charged for customers who do not remove the Apple ID. Until the Apple ID is removed late fees will accumulate. Android rental customers must reset the phone to factory default setting before returning the phone. A $39 removal fee will be charged for customers who do not reset the Android to the factory default setting. Until the Android is reset to the factory default setting late fees will accumulate.</li><li class='StandartLi'><span class='StandartLiSpan'>Kosher phone purchase: </span>Limited manufacturerâ€™s warranty.<br><br>Repair or replace malfunctioning phones free of charge in our office within 6 months from the purchase.<br><br>On condition that the malfunction came from regular use and is covered by the manufacturerâ€™s warranty.<br><br>If the phone is lost or stolen or damaged beyond repair the customer will be charged $75 for a replacement.<br><br>For the phone model MTK-2 the customer will be charged $85 for replacement.</li><li class='StandartLi'><span class='StandartLiSpan'>Short Term Plans: </span>Daily short term plans are divided between monthly and daily plans. On each plan when surpassing the amount of days that the plan is for, (unless stated otherwise) an extension fee of $10 will be charged. The extension fee on the monthly plan (unless stated otherwise) is $10 per day, while the extension fee on the daily plan is the daily cost on the plan. On premium bundles which include the mobile hotspot, the extension rate (unless stated otherwise) will be $15. On group plans the extension fee is on the plan page.</li><li class='StandartLi'><span class='StandartLiSpan'>Termination of contract: </span>Customers who are renting equipment terminate their contracts upon the return of the equipment to a Company representative. In the case that the Customer cannot return the rental equipment (as in a case of theft or loss), the Customerâ€™s contract will be terminated as of the date the Customer declares to the Company their desire to terminate and to have the Company replace the equipment. Customers who are only using SIM cards terminate their contract explicitly in writing, or by telephone. The Customer understands that they will be billed for usage and/or rental fees that accrued before the date of termination, notwithstanding the fact that invoices and charges will be processed after that date, that is, termination of the account does not terminate the obligations of the Customer as set out in Paragraph 2 vis-Ã -vis payment for usage and fees incurred by the Customerâ€™s account prior to termination. A Customerâ€™s account will only be fully closed once all outstanding payments are resolved.</li><li class='StandartLi'><span class='StandartLiSpan'>Miscellaneous </span>You agree that TalknSave may use your personal information to promote different products via various media including but not limited to email and SMS.</li><li class='StandartLi'><span class='StandartLiSpan'>Summary: </span>The signed or electronic contract, together with these Terms and Conditions, constitutes the entire agreement between the parties, and no amendment or modification hereto shall be in force unless it is in writing or via email. The Customer acknowledges that changes made to the contract including termination of the same through the medium of email are legal and binding when confirmed by the Company. Any disputes between the parties shall be adjudicated by the rabbinical courts of Jerusalem under halachic (Jewish) law. Service of process on the Customer may be made at the address of the Customer, as set out on signed contract. Furthermore, these Terms and Conditions are subject to change at any time and without notice.</li></ol>");
            openPopup('#wrap_popup2');
        });

        $('#billing_country').change(function () {
			$('.zipCode').removeClass('d-none');
			$('.zipCode').find('input').addClass('billing');
			
            let billing_country = $("#billing_country").find(":selected").text();
            billing_country = billing_country.trim();
            $('#Canada_states').addClass('d-none');
            $('#USA_state').addClass('d-none');
            $('USA_state').find('select').removeClass('billing');
            $('#Canada_states').find('select').removeClass('billing');

            if (billing_country === "USA") {
                $('#USA_state').removeClass('d-none');
                $('#USA_state').find('select').addClass('billing');
            } else if (billing_country === "Canada") {
                $('#Canada_states').removeClass('d-none');
                $('#Canada_states').find('select').addClass('billing');

            }
			else if (billing_country === "Israel"){
				$('input[name="billing_zip"]').val('');
				$('.zipCode').addClass('d-none');
				$('.zipCode').find('input').removeClass('billing');
			}



        });
        $(".cart-qty-plus").click(function () {
            var $currentValue = $(this).parent().find('input');
            $currentValue.val(Number($currentValue.val()) + 1);

        });
        $(".cart-qty-minus").click(function () {
            var $currentValue = $(this).parent().find('input');
            var value = Number($currentValue.val());
            if (value > 0) {
                $currentValue.val(value - 1);
            }

        });

        $('.accPopoup').click(function () {
            let desc = $(this).attr('data-popup');
            let title = $(this).attr('data-title');
            $(".popupTitle").empty();
            $(".popupDesc").empty();
            $(".popupTitle").append(title);
            $(".popupDesc").append(desc);
            openPopup('#wrap_popup2');
        });
        $('#service_date').append('<div id="numberOfOrders" class="d-none">' + 3 + '</div>');
        $('#simCheckBox').change(function () {

            if ($(this).prop("checked")) {
                $('.cloneSim').remove();
                $('.hiddenOrderNum').empty();
 needSim();
                return;
            } else {
                let clone = orderCount;

                clone = clone - 1;
                if (clone > 0) {
                    $('.hiddenOrderNum').text('for Order #1');
                }

                for (i = 0; i < clone; i++) {
                    var simClone = $('.cloneSimDefault').clone();
                    $(simClone).find('input').attr('name', 'equipment' + (i + 1));
                    $(simClone).attr('class', 'cloneSim simCount');
                    $(simClone).find('.hiddenOrderNum').text('for Order #' + (i + 2));
                    $(simClone).find('input').attr('onchange', 'needSim()');
                    $('.cloneSimDefault').parent().append(simClone);
//                     $('.cloneSim').find('.icon-info-circled').remove();
                      $('.cloneSim').find('.icon-info-circled').addClass('d-none');
                    $('.cloneSim').find('.PhoneSimInfo').remove();
					$(simClone).find('.simPopup').click(function () {
		SimPopup(this);
        });
                }

            }
            needSim();
        });

      
				 $('#next2').click( function () {
		 		$('#shipping_method').find('option').each( function () {
				 let baseCode = $(this).attr('base-code');
					let currentOption = $(this);
				 let optLocalPickup = $(this).attr('opt-local-pickup');
					
				 let shipMethod = $(this).attr('shipMethod');
				 let shippingID = $(this).attr('value');
				 let hasPhones='';
				 hasPhones=$(this).attr('has-phones');
			
       currentOption.removeClass('d-none');
// 				 check optlocalPickup 0 and null 

			$('.simCount').each( function (index) {
				let eqipment = 'equipment';
				if(index >0){
				   eqipment = 'equipment' + index; 
				   }
				let eqipmentId = $("input[name="+eqipment+"]:checked").val();
				let isSim = $("input[name="+eqipment+"]:checked").attr('issim');
				let issmartPhone =$("input[name="+eqipment+"]:checked").attr('issmartphone');
				let isKoshar = $("input[name="+eqipment+"]:checked").attr('kosher');
				isKoshar=$.trim(isKoshar);
				
				isSim=$.trim(isSim);
				issmartPhone=$.trim(issmartPhone);
				
				isSim = (isSim) ? true :'';
				issmartPhone=(issmartPhone) ? true :false;
				if (shippingID != "-1" &&
isSim=='' &&((issmartPhone==true &&((baseCode != "100" && baseCode != "1")|| optLocalPickup == 0))|| hasPhones == 0))
					{
				   
	if( shipMethod != "UPS_GROUND_DS" && shipMethod != "UPS_OVERNIGHT_DS" && !( eqipmentId == "2730" || eqipmentId == "2750")  ){
					currentOption.addClass('d-none');
						}
			else if (  shippingID != "-1" &&  ( eqipmentId    == "2730" || eqipmentId == "2750")  ) {
				if( !( shippingID == "2" || shippingID == "9" ) ){
					currentOption.addClass('d-none');
				}
			}
				} 
				 
else if ( shippingID != "-1" &&  (eqipmentId == "2550"  && (shippingID != "1" && shippingID != "3" && shippingID != "7" && shippingID != "9" && shippingID != "12" && shippingID != "23")) || ( isKoshar && (shippingID != "2" && shippingID != "12" && shippingID != "9" && shippingID != "23" && shippingID != "69" && shippingID != "24" && shippingID != "383") ) ){
											currentOption.addClass('d-none');
											}
	else if (  shippingID != "-1" && ( eqipmentId == "2730" ||  eqipmentId == "2750") ){
												if(!( shippingID == "2" || shippingID == "9" )){
													currentOption.addClass('d-none');
												}
					}
			});
			
				

				}); 
					 
				$('#shipping_method').find('optgroup').each( function () {
					let count =0;
						$(this).find('option').each( function () {
						if(!$(this).hasClass('d-none')){
						  count++
						   }
						});
						if(count>0){
							$(this).removeClass('d-none');
						}
						else{
							$(this).addClass('d-none');
						}
						
					
				});	 

				//pop up if sim selected
				$('.equipmentSim').each(function(){
					 if($(this).is(":checked")){
						 var isSim=$(this).attr('issim');
						 if(isSim=="true"){
							 var popUpIcon=$(this).parent().find('.icon-info-circled.simPopup');
							 if(popUpIcon.length>0){
								 $('.popup-footer').removeClass('d-none')
								  $(popUpIcon).click();
								 $('.popup-footer').text('Next');
							 }
						 }
					 }
				});	
					 
		 });  

         $("[name='billing_phone']").on('change blur', function (){
		 let p = '<?php echo $p ?>';
		 let phoneNum = $(this).val();
		 
		 p=$.trim(p);
// 		 if(p=='bhlt'){
// 			 $("[name='whatspapp_num']").val(phoneNum);
// 			}
	 });
		
	$("[name='billing_fname']").on('keyup', function (){
		 var re = /^[A-Za-z]+$/;
    	 var value=$(this).val();
		var valuesToRelace = [];
		 for (var i = 0; i < value.length; i++) {
       		if(re.test(value.charAt(i))){}
    		else{
			valuesToRelace.push(value.charAt(i));
       		}  
		 }
		valuesToRelace.forEach(function(item) {
    value=value.replace(item, "");
    		
});
		$(this).val(value);
	});
		

        $('#stayLocalCheckBox').change(function () {
            if ($(this).prop("checked")) {
                $('.clonestayLocal').remove();
                $('.OptionalOrderNum').empty();
               
            } else {
                let clone = orderCount;
                clone = clone - 1;
                if (clone > 0) {
                    $('.OptionalOrderNum').text('for Order #1');
                }
                for (i = 0; i < clone; i++) {
                    var stayLocalClone = $('.stayLocalCloneDefault').clone();
                    $(stayLocalClone).find('.stayLocalSelect').attr('id', 'stay_local' + (i + 1));
                    $(stayLocalClone).find('.OptionalOrderNum').text('for Order #' + (i + 2));
                    $(stayLocalClone).find('.internationalSelect').attr('id', 'smsPackageName' + (i + 1));
                    $(stayLocalClone).attr('class', 'clonestayLocal');
					$(stayLocalClone).find('select').attr('onchange','optionalAdd()');
                    $(stayLocalClone).find('#staticLearnMore').remove();
                    $(stayLocalClone).find('#sLearnMore').remove();
                    $(stayLocalClone).find('#international').remove();
                    $('.stayLocalCloneDefault').parent().append(stayLocalClone);
                    $('.clonestayLocal').find('#international').remove();
                }

            }
			optionalAdd();
        });
		
		 $('.plus-minus').click( function () {
			 plusMinus(this);
		 });


        $('#next8').click(function () {
$('.shippingError').text('');
  let billingCountry =  $('#billing_country :selected').val();
	let shippingCountry = $('#shipping_method :selected').parent().attr('label');
	let hasMifi = $('#shipping_method :selected').attr('has-mifi');
			hasMifi = (hasMifi) ? true : false;
	let hasNetStick = $('#shipping_method :selected').attr('has-netstick');
			hasNetStick = (hasNetStick) ? true : false;
		
let dateTOLeave= $('#date_to_leave').val();
			dateTOLeave = $.trim(dateTOLeave);
let today = new Date();
let dd = String(today.getDate()).padStart(2, '0');
let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
let yyyy = today.getFullYear();

today = mm + '/' + dd + '/' + yyyy;
			
		let shippingMethodTitle = $('#shipping_method :selected').data('title');
			
			
		    let date_to_leave = $('#date_to_leave').val();
			date_to_leave=$.trim(date_to_leave);
			date_to_leave=new Date(date_to_leave)
			let currentDate =  new Date();
			const diffTime = Math.abs(date_to_leave - currentDate);
let diffrance = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
			
			
            
			
			
			$('.phonecard').each(function () {
				let chckboxName= $(this).find('.optional-title').text();
				chckboxName = $.trim(chckboxName);
				let isMifi = chckboxName.includes('Hotspot') || chckboxName.includes('wi-fi');
		       let isNetStick = chckboxName.includes('Netstick');
			
				$(this).css({"pointer-events" : "all" , "opacity" : "1" });
				
			if((isMifi && !hasMifi) || (isNetStick && !hasNetStick)){
			   $(this).css({"pointer-events" : "none" , "opacity" : "0.6" });
			   }
				
			});
			
		
			
	let shippingAddress = $('input[name=shipping_address]:checked').val();
			
		if($('.schoolName').length > 0 && $('.schoolName').val() =='' ) {
			   $('.schoolError').text('This field is required');
		  $('.schoolName').focus();
		return false;
			   }
			
			 else if(shippingAddress == 'yes' && billingCountry != shippingCountry){
					$('.shippingError').text("We're sorry, but the delivery method you chose is not available for the address you entered. Please check that you're providing the correct delivery address.")
					return false;
				
			}
			else if (dateTOLeave == today){
					$('.shippingError').text("Please make sure that the delivery date is a future date");
					 return false;
					 }
			
		
			
			
			else if (shippingMethodTitle.includes('Free Delivery')  && diffrance <10 ){
					 $('.shippingError').text('Free shipping is not available when travel date is within ten days, please choose an alternative shipping method');
				return false;
					 }

			
			

        });
    });





    function submitMultiStepForm() {
        if (!$('#tnc').is(':checked')) {
            $(".errorTnc").text("Please check this box to proceed!")
            return false;
        }

        $(".loading").removeClass('d-none');

        var CCExpDate = $('#expiry-date').val();
        var basecode = $('#shipping_method :selected').attr('base-code');
        var shippingNotes = $('#shipping_method :selected').attr('shipping-notes');


        let fname = $('input[name$="billing_fname"]').val();
        let lname = $('input[name$="billing_lname"]').val();


        let start_date = $("#begin_date").val();
        let end_date = $("#end_date").val();
        start_date = start_date + " 12:00:00 AM";
        end_date = end_date + " 12:00:00 AM";
        let plan = $('input[name="equipment"]:checked').data('name');
        let callPackageCode =<?php echo $bundles[0]['CallPackageCode']; ?>;
        let callpackageName = "<?php echo $bundles[0]['CallPackageName']; ?>";

        let shippingCity = $('input[name="shipping_city"]').val();
        let shipping_country = $('#shipping_method :selected').parent().attr('label');
        if( shipping_country){
		   shipping_country = shipping_country.trim();
		   }
        let shippingName = $('#shipping_method :selected').attr('data-title');
        let shipMethod = $('#shipping_method :selected').attr('shipmethod');
        let shippingCost = $('#shipping_method :selected').data('cost');
// 		if(orderCount>1){
// 			if(shippingCost){
// 				shippingCost = (shippingCost * 50) / 100;
// 			}
// 		}
        let shippingId = $('#shipping_method :selected').val();
        let date_to_leave = $('#date_to_leave').val();

        let paymentEmail = $('#paymentEmail').val();
        let shippingPostalCode = $("input[name='shipping_zip']").val();
        let shippingAddress = $("#shipAddress").val();

        shippingAddress = (shippingAddress) ? shippingAddress : "[pickup]";
        let shippingPhone = $("input[name='shipping_phone']").val();

		 let isSim = $('input[name="equipment "]:checked').attr('issim');
	    let IsSns = $('input[name="equipment"]:checked').attr('issns');
         let koshar = $('input[name="equipment"]:checked').attr('kosher');
		
        if (!shippingPhone) {
            shippingPhone = "0";
        }
    

        let billingCountry = $('#billing_country :selected').val();
        let billingState = "NA"
        if (billingCountry === "USA") {
            billingState = $("#stateProvinceUSA :selected").attr('state-code');
        } else if (billingCountry === 'Canada') {
            billingState = $("#stateProvinceCanada :selected").attr('state-code');
        }

        let shippingState = "NA";
        let shippingCountry = $("#shipping_method :selected").parent().attr('label');
        if (shippingCountry === "USA") {
            shippingState = ($('#shippingUSA :selected').attr('state-code')) ? $('#shippingUSA :selected').attr('state-code') : "NA";
        } else if (shippingCountry === "Canada") {
            shippingState = ($('#shippingCanada :selected').attr('state-code')) ? $('#shippingCanada :selected').attr('state-code') : "NA";
        }

        $("#confirmEmail").text(paymentEmail);





        var ob = new Object();
        ob.ContractType = "<?php echo $data['contractType']; ?>";
        ob.ProviderCode =<?php echo $data['ProviderCode']; ?>;
		
		let strAccessoryIdAndQuantity = '';
		  $('.phonecard').each(function () {
            let qty = $(this).find('.qty').val();
			  
			  let planCode = $(this).find('.cardBody').attr('plancode');
			  let equipmentCode = $(this).find('.cardBody').attr('equipmentcode');
			  let optionCode = $(this).find('.cardBody').attr('optionalcode');
			  
            if (qty > 0) {
				if (!(planCode> -1 && equipmentCode > -1)) {
                            strAccessoryIdAndQuantity += optionCode + "-" + qty + ",";
			}
			}
		  });
		
        ob.AccessoryIdAndQuantity = strAccessoryIdAndQuantity;
		ob.txtSignupRep=$.trim($('.agentName').val());
        ob.LinkTypeCode =<?php echo $data['LinkTypeCode']; ?>;
        ob.ccemail = paymentEmail;
        ob.SessionID = "NC_<?php echo uniqid() ?>";
        ob.AgentCode =<?php echo $data['AgentCode']; ?>;
		let subAgentCode =
		
		ob.SubAgentCode='<?php echo $data['SubAgentCode']; ?>';
        ob.BaseCode = (basecode) ? basecode : 100;
        ob.BaseNotes = shippingNotes;
        ob.bitCallPackageOverageProtection = false;
        ob.BundleId =<?php echo $bundles[0]['Counter']; ?>;
        ob.CallPackageCode = callPackageCode;

        ob.CallPackageName = callpackageName;
        ob.CCCode = null;
        ob.strCCExpDate = CCExpDate;  // time and date not included 
		
		
        let ccNum = $('#credit-card').val();
        ccNum = ccNum.replace(/\s/g, '');
        ob.CCNum = ccNum;
        ob.CCTitle = $('#cardType :selected').val();
        ob.ClientCity = $("[name='billing_city']").val();
        ob.ClientCountry = $("#billing_country :selected").val();
        ob.clientemail = $("#cemail").text();
        ob.ClientFirstName = fname;
        ob.ClientHomePhone1 = $("#cnumber").text();
        ob.ClientHomePhone2 = "0";
        ob.ClientIP = ":1";
        ob.ClientLastName = lname;
        ob.ClientMobile = $("[name='billing_phone']").val();
        ob.ClientState = billingState                   //"Gujarat";
        ob.ClientStreet = $("[name='billing_address']").val();
		let clientZip= $("[name='billing_zip']").val();
        ob.ClientZip = (clientZip) ? clientZip : '0';

        ob.CompanyCode =<?php echo $data['CompanyCode']; ?>;
        ob.PageName='<?php echo $p; ?>';
		
		try{
			var couponCodeCC='<?php echo $data['CouponCode']; ?>';
			var couponCodeInput=$.trim($('#coupanCode').val());
			if(couponCodeCC!=null && couponCodeCC!='null' && couponCodeCC!='' && couponCodeInput === '' ){
				couponCodeCC=couponCodeCC;
			}else{
				couponCodeCC=couponCodeInput
			}
			ob.CouponCode = couponCodeCC;
		}catch(err){
			
		}
     //   ob.CouponCode = $('#coupanCode').val();
        ob.CreditEquipmentPurchase = null;
        let customerComment = $("[name='cc_note']").val();
        ob.CustomerComment = customerComment;
        ob.DataPackageCode =<?php echo $bundles[0]['ExtendedDataPackageCode']; ?>;
        ob.DataPackageId =<?php echo $bundles[0]['ExtendedDataPackageCode']; ?>;
        ob.DataPackageName = "<?php echo $bundles[0]['ExtendedDataPackageName']; ?>";
        ob.DataPackgeSize = "<?php echo $bundles[0]['PackageSize']; ?>";
        ob.DepartureDate = start_date;
        ob.Deposit = "<?php echo $data['DepositAmount']; ?>";
		
			 let maximumPeriod=<?php echo $optLeaveILrequest ? "true" : "false" ?>;
		
	  let begin_date = $('#begin_date').datepicker("getDate");
	    let end_year  = new Date(begin_date).getFullYear();
      let end_month = new Date(begin_date).getMonth();
      let end_day   = new Date(begin_date).getDate();
     let endDate  = new Date(end_year + 10, end_month, end_day);
		
	 let endDateStr = ((endDate.getMonth() > 8) ? (endDate.getMonth() + 1) : ('0' + (endDate.getMonth() + 1))) + '/' + ((endDate.getDate() > 9) ? endDate.getDate() : ('0' + endDate.getDate())) + '/' + endDate.getFullYear();
		
		endDateStr = endDateStr + " 12:00:00 AM" ;
  ob.EndDate= (maximumPeriod) ? end_date : endDateStr ;
		
//         ob.EndDate = end_date;
        ob.EquipmentCode =<?php echo $data['HaveSimEquipmentCode']; ?>;
        ob.EquipmentModel = $('input[name="equipment"]:checked').val();
        ob.EquipmentName = $('input[name="equipment"]:checked').data('name');
        ob.EquipmentNotes = $('input[name="equipment"]:checked').attr('notes');
        ob.FirstName = fname;
        ob.GroupMemberID = "";
		let groupName = $('.bus').find(':selected').val()
        ob.GroupName =  groupName ? groupName: null ; 
        ob.Hint = null;
        let insurance = "<?php echo ($bundles[0]['IncludedInsurance']) ? true : ''; ?>";
        ob.Insurance = (insurance) ? true : false;
        ob.IsEquipmentSNS = (IsSns) ? true : false;
        ob.IsKosher = (koshar) ? true : false;
        ob.IsRequierdOperationSys = false;
        ob.IsSim = (IsSns) ? true : false;
        ob.IsSmartPhone = ($('#rental').is(':checked')) ? true : false;                          //false;
        ob.KITD = false;
        ob.KITD_BLOCK_ID = null;
        ob.KITD_PlanCode = -1;
        ob.KNTName = "";
        ob.KNTRequired = -1;
        ob.LanguageCode = 1;
        ob.LastName = lname;
        ob.ParentLink = "<?php echo $data['ParentLink']; ?>";
        ob.ParentOnlineOrderCode = null;
        var phoneReq = $.trim($('#numberOfOrders').text());

//   ob.PhonesRequired= ($('#rental').is(':checked')) ? 1 : 0 ;
        ob.PhonesRequired = orderCount;
        ob.PlanCode =<?php echo $bundles[0]['PlanCode']; ?>;
        ob.PlanName = "<?php echo $bundles[0]['PlanName']; ?>";
        ob.ProductId = 1;
        ob.PurchaseEquipment = false;
        ob.ReferrerCounter = null;
        ob.ReferrerEmail = "";
        ob.RentalCode = null;
        ob.SetupFeeText = "No";
		
// 		AllalreadyHaveSim = 0 means hide shippingoption 
		let AllalreadyHaveSim=0;
		$('.simCount').each( function (index) { 
				let simValue = $(this).find('input:checked').val();
				
				if(simValue != '9999'){
				   AllalreadyHaveSim ++;
				  }
			});
		
		if(AllalreadyHaveSim == 0){
		   	ob.ShipCity ="[have Sim]";
        ob.ShipCommercial = false;
        ob.ShipCountry ="Israel";
        ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
        ob.shipemail =ob.clientemail;
        ob.ShipFee = 0;
        
        ob.ShipMethod = "ALREADY_HAVE_SIM";
		
        ob.ShipName = "[have Sim]";
        ob.ShipPhone = "0";

        ob.ShippingName ="ALREADY_HAVE_SIM";
        ob.ShipPostalCode = "[have sim]";
        ob.ShipState = "NA";
        ob.ShipStreet = "[have Sim]" ;
		   }
		else if($('.shipping_option').hasClass('d-none')){
		ob.ShipCity ="[pickup]";
        ob.ShipCommercial = false;
        ob.ShipCountry =shipping_country;
        ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
        ob.shipemail =ob.clientemail;
        ob.ShipFee = shippingCost;
        ob.ShipId = shippingId;
        ob.ShipMethod = shipMethod;
		let shippingNameInput = ob.ClientFirstName+' '+ob.ClientLastName;
        ob.ShipName = "[pickup]";
        ob.ShipPhone = ob.ClientHomePhone1;

        ob.ShippingName =(shippingName) ? shippingName : "[pickup]";
        ob.ShipPostalCode = "[pickup]";
        ob.ShipState = "NA";
        ob.ShipStreet = "[pickup]" ;
		}
		else{
			if($("input[name='shipping_address']:checked").val() == 'yes'  ) {
		   ob.ShipCity =ob.ClientCity;
        ob.ShipCommercial = false;
        ob.ShipCountry =ob.ClientCountry;
        ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
        ob.shipemail =ob.clientemail;
        ob.ShipFee = shippingCost;
        ob.ShipId = shippingId;
        ob.ShipMethod = shipMethod;
		let shippingNameInput = ob.ClientFirstName+' '+ob.ClientLastName;
        ob.ShipName = (shippingNameInput) ? shippingNameInput :shippingName;
        ob.ShipPhone = ob.ClientHomePhone1;

        ob.ShippingName =(shippingName) ? shippingName : "[pickup]";
        ob.ShipPostalCode = ob.ClientZip;
        ob.ShipState = ob.ClientState;
        ob.ShipStreet = ob.ClientStreet ;
		}
		else {
			ob.ShipCity = (shippingCity) ? shippingCity : "[pickup]";
        ob.ShipCommercial = false;
        ob.ShipCountry = shipping_country;
        ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
        ob.shipemail = paymentEmail;
        ob.ShipFee = shippingCost;
        ob.ShipId = shippingId;
        ob.ShipMethod = shipMethod;
		let shippingNameInput = $('input[name="shipping_name"]').val();
        ob.ShipName = (shippingNameInput) ? shippingNameInput :shippingName;
        ob.ShipPhone = shippingPhone;

        ob.ShippingName =(shippingName) ? shippingName : "[pickup]";
        ob.ShipPostalCode = (shippingPostalCode) ? shippingPostalCode : "[pickup]";
        ob.ShipState = shippingState;
        ob.ShipStreet = shippingAddress;
		}
		}
		
		
		
        
        ob.SMSPackageCode =<?php echo $bundles[0]['SMSPackageCode']; ?>;
        ob.SMSPackageCounter =<?php echo $bundles[0]['SMSPackageCode']; ?>;
        ob.SMSPackageName = "<?php echo $bundles[0]['SMSPackageName']; ?>";
        ob.Special = false;
        ob.StartDate = start_date;
        ob.SubLink = "<?php echo $data['SubLink']; ?>";
        ob.SublinkId =<?php echo $data['Counter']; ?>;
        ob.SurfAndSave = false;
		
		let tags = '';
		$('.phonecard').each(function () {
            let qty = $(this).find('.qty').val();
			
			let title = $(this).find('.cardBody').attr('OptionalName');
			let insurance = $(this).find('.cardBody').attr('Insurance');
			insurance=$.trim(insurance);
			 let planCode = $(this).find('.cardBody').attr('plancode');
			 let equipmentCode = $(this).find('.cardBody').attr('equipmentcode');
			 let optionCode = $(this).find('.cardBody').attr('optionalcode');
			
			strAccessoryIdAndQuantity='';
            if (qty > 0) {
				let quantity = '';
			
				if(qty > 1 ){
				   quantity = '(Quantity:'+qty+')';
				   }
				if(insurance){
				   insurance = 'Insuarance:'+true;
				   }
					if (!(planCode> -1 && equipmentCode > -1)) {
                            strAccessoryIdAndQuantity = optionCode + "-" + qty + ",";
			}
		
			
				
		   tags += title +' '+ quantity + insurance + strAccessoryIdAndQuantity; 
			}
		});
		let countAlreadySim=0;
		let simString='';
			$('.simCount').each( function (index) { 
				let simValue = $(this).find('input:checked').val();
				
				if(simValue == '9999'){
				   countAlreadySim++;
				  }
			});
		if(countAlreadySim > 0){
			
		   $('.simNoclone').each(function (index) {
			   let simCardNum = $(this).find('input').val();
			 simCardNum = simCardNum.replace(/\s/g, '');
			   simString+= (index+1) +' '+'Special Order:Sim Number#: 89972' +simCardNum + '#' + '    ';
		   });
		   }
		
			let billingArr="<?php echo $p; ?>" ;
				billingArr = $.trim(billingArr);
				let nameArr='';
				if(billingArr == 'bhlt'){
					let stu_name = $('input[name="stu_name"]').val();
					let parent_name = $('input[name="parent_name"]').val();
					let yeshiva_name = $('input[name="yeshiva_name"]').val();
					let rebbe_name = $('input[name="rebbe_name"]').val();
					//let whatsapp_num =  $("[name='whatspapp_num']").val();
					let whatsapp_num = $("[name='whatspapp_num']").find(":selected").val();
					if(whatsapp_num=="Select"){
						whatsapp_num="";
					}
					stu_name = (stu_name) ? stu_name : '';
					parent_name = (parent_name) ? parent_name : '';
					yeshiva_name = (yeshiva_name) ? yeshiva_name : '';
					rebbe_name = (rebbe_name) ? rebbe_name : '';
					whatsapp_num = (whatsapp_num) ? whatsapp_num : '';
					
// 				 nameArr = '[' + stu_name +','+ parent_name +',' + yeshiva_name +',' + rebbe_name + ']';
					nameArr = '[' + stu_name +',' + ' ' + parent_name +',' + ' ' + yeshiva_name +',' + ' ' + rebbe_name + ',' + ' ' + whatsapp_num +  ']';
				}
		if(billingArr == 'momentum-staff' || billingArr == 'momentum'){
					let partnerOrg_name = $('input[name="partnerOrg_name"]').val();
					
					nameArr = '[' + partnerOrg_name +  ']';
				}
		
        ob.Tag = simString + tags + nameArr;
		
        ob.TermsCode = -1;
        ob.TermsName = null;
        ob.UserName = fname + " " + lname;
     	let schoolName= $('.schoolName').val();
		schoolName = (schoolName) ? schoolName : '';
        ob.UserStreet= (schoolName) ? schoolName : "<?php echo $data['AdminComment']; ?>";
		
		
		
        var simArr = [];

        for (i = 0; i < orderCount; i++) {

            var SimDetails = new Object();
			let kitd;
			let simKitd;
            if ($('#stayLocalCheckBox').is(':checked')) {
				 kitd=$('#stay_local option:selected').val();
				kitd=$.trim(kitd)
				if(kitd =="No, Thank you"){
				   simKitd=false;
				   }
				else{
					simKitd = true;
				}
                SimDetails.KITD_PlanCode = $('#stay_local option:selected').data('kntcode');
				SimDetails.SMSPackageName = $('#smsPackageName option:selected').val();
				SimDetails.KITD=simKitd;
            } else {
                let stayLocal = 'stay_local';
				let smsPackageName='smsPackageName';
				
				 
                
                if (i > 0) {
                    stayLocal = stayLocal + i;
					smsPackageName = smsPackageName +i;
                }
				kitd=$('#' + stayLocal + ' option:selected').val();
				kitd=$.trim(kitd);
			if(kitd =="No, Thank you"){
				   simKitd=false;
				   }
				else{
					simKitd = true;
				}
                SimDetails.KITD_PlanCode = $('#' + stayLocal + ' option:selected').data('kntcode');
				SimDetails.SMSPackageName = $('#'+ smsPackageName +' option:selected').val();
				SimDetails.KITD=simKitd;
            }

// 	 SimDetails.KITD_PlanCode=-1;
            SimDetails.CallPackageCode =<?php echo $bundles[0]['CallPackageCode']; ?>;
            SimDetails.curST_TOP_Price = 0.0;
            SimDetails.DataPackageCode =<?php echo $bundles[0]['ExtendedDataPackageCode']; ?>;
            SimDetails.DataPackageId =<?php echo $bundles[0]['ExtendedDataPackageCode']; ?>;
            SimDetails.DataPackageName = "<?php echo $bundles[0]['ExtendedDataPackageName']; ?>";
            SimDetails.DataPackgeSize = "<?php echo $bundles[0]['PackageSize']; ?>";
            SimDetails.decST_TOP_GB = 0.0;
   

           if($('#simCheckBox').prop('checked') == true){
			   let EquipmentCode=$('input[name="equipment"]:checked').data('code');
			   let EquipmentID = $('input[name="equipment"]:checked').val();
			   let EquipmentModel=$('input[name="equipment"]:checked').val();
			   let EquipmentName=$('input[name="equipment"]:checked').data('name');
			   
			   if(EquipmentCode == '9999'){
				  EquipmentCode='2510';
				  EquipmentModel='2510';
				   
	$('input[name="equipment"]:checked').closest('.simCount').find('.equipmentSim').each(function () {
					 let isSim =$.trim($(this).attr('isSim'));
					 let  code = $.trim($(this).val());
					 if(isSim == "true" && code !="9999" ){
						 EquipmentCode=code
					 }
					   
				   }); 
				  }
			    SimDetails.EquipmentCode = (EquipmentCode) ? EquipmentCode : EquipmentID ;
                 SimDetails.EquipmentModel = (EquipmentCode) ? EquipmentCode : EquipmentID ;
                 SimDetails.EquipmentName = EquipmentName;
			  }
                   
                       
                     else {
					 let equipment = 'equipment';
						if(i>0){
						   equipment = equipment + i;
						  }
						
			   let EquipmentCode=$('input[name="' + equipment+'"]:checked').data('code');
				let EquipmentID = $('input[name="' + equipment+'"]:checked').val();		 
			   let EquipmentModel=$('input[name="' + equipment+'"]:checked').val();
			   let EquipmentName= $('input[name="'+equipment +'"]:checked').data('name');
			    isSim = $('input[name="'+equipment +'"]:checked').attr('issim');
			    IsSns = $('input[name="'+equipment +'"]:checked').attr('issns');
                koshar = $('input[name="'+equipment +'"]:checked').attr('kosher');
                isSim=$.trim(isSim);
			   if(EquipmentCode == '9999'){
				  EquipmentCode='2510';
				  EquipmentModel='2510';
				   
				      $('input[name="' + equipment+'"]:checked').closest('.simCount').find('.equipmentSim').each(function () {
					 let isSim =$.trim($(this).attr('isSim'));
					let  code = $.trim($(this).val());
					 if(isSim == "true" && code !="9999" ){
						 EquipmentCode=code
					 }
					   
				   });
				   
				  }
						 
                        SimDetails.EquipmentCode = (EquipmentCode) ? EquipmentCode : EquipmentID ;
                        SimDetails.EquipmentModel =(EquipmentCode) ? EquipmentCode : EquipmentID ;
                        SimDetails.EquipmentName =EquipmentName ;
						}
                        SimDetails.EquipmentNotes = shippingNotes;
                        SimDetails.Img = "https://www.talknsave.us/images/OneSimForall.jpg";
                        SimDetails.Insurance = (insurance) ? true : false;
                        SimDetails.IsEquipmentSNS = (IsSns) ? true : false;
                        SimDetails.IsKosher = (koshar) ? true : false;
                        SimDetails.IsRequiredOperationSystem = false;
                        SimDetails.IsSIM = (isSim) ? true : false;
                        SimDetails.SMSPackageCode =<?php echo $bundles[0]['SMSPackageCode']; ?>;
                        SimDetails.SMSPackageCounter =<?php echo $bundles[0]['SMSPackageCode']; ?>;
                       
                    simArr.push(SimDetails);
                }
            
        ob.SimDetails = simArr;
        ob.optionalOrders = new Object();
        var optionalOrderArray = [];
        $('.phonecard').each(function () {
            let qty = $(this).find('.qty').val();
            if (qty > 0) {
                let parent = $(this).closest(".phonecard");
                let image = parent.find('.optional-image').attr('src');
                let title = parent.find('.optional-title').data('title');
                let qty = parent.find('.qty').val();


                let ClientCode =parent.find('.cardBody').attr('ClientCode');
                let CouponCode =parent.find('.cardBody').attr('CouponCode');
                let Deposit =parent.find('.cardBody').attr('Deposit');
                let EquipmentCode =parent.find('.cardBody').attr('EquipmentCode');
                let Insurance =parent.find('.cardBody').attr('Insurance');
                let OptionalCode =parent.find('.cardBody').attr('OptionalCode');
				
                let OptionalFeeDesc =parent.find('.cardBody').attr('OptionalFeeDesc');
                let OptionalImg =parent.find('.cardBody').attr('OptionalImg');
                let OptionalName =parent.find('.cardBody').attr('OptionalName');
                let OptionalType =parent.find('.cardBody').attr('OptionalType');
                let OptionText =parent.find('.cardBody').attr('OptionText');
                let PlanCode =parent.find('.cardBody').attr('PlanCode');
                let Quantity =parent.find('.cardBody').attr('Quantity');
                let RequiredInsurance =parent.find('.cardBody').attr('RequiredInsurance');
                let RequiredOperationSystem =parent.find('.cardBody').attr('RequiredOperationSystem');
                RequiredInsurance =RequiredInsurance.trim();
                RequiredOperationSystem =RequiredOperationSystem.trim();
                var newObject = new Object();
                newObject.ClientCode =$.trim(ClientCode);
                newObject.CouponCode =$.trim(CouponCode);
                newObject.Deposit = $.trim(Deposit);
                newObject.Insurance =(Insurance) ?true :false;
                newObject.OptionalCode =$.trim(OptionalCode);
                newObject.OptionalFeeDesc =$.trim(OptionalFeeDesc);
                newObject.OptionalImg =$.trim(OptionalImg);
                newObject.OptionalName =$.trim(OptionalName);
                newObject.PlanCode =$.trim(PlanCode);
                newObject.Quantity =qty;
				newObject.EquipmentCode=$.trim(EquipmentCode);
                newObject.RequiredInsurance =(RequiredInsurance) ?true :false;
                newObject.RequiredOperationSystem =(RequiredOperationSystem) ?true :false;

                optionalOrderArray.push(newObject);
            }



        });
        if (optionalOrderArray.length > 0) {
            ob.optionalOrders = optionalOrderArray;
        }

ob.newsletter=$('#SubscribeNewsletter').is(':checked');
ob.UserCity="NA";
		
		
        var data = JSON.stringify(ob);
	
//    $('.test-object').text(data);
		console.log(ob);
        $.post('https://talknsave.net/wp-content/themes/betheme/SaveApiResult.php', {SaveApiData: data},
                function (msg)
                {
                    $(".loading").addClass('d-none');
                    if (msg) {
                        let orderId = msg.replace(/['"]+/g, '');
                        orderId=$.trim(orderId);
                        $("#Confirmid").text(orderId);
                        $("#next10").click();
             $(".progress-bar").css("width", 100 + "%");

//                         console.log(msg);
                    } else {
                        $(".loading").addClass('d-none');
                        alert('En error occurred please try again!');
                    }
                });

    }

</script>

<div id="Content" class="contentCheckout">
    <div class="content_wrapper clearfix">

        <!-- .sections_group -->
        <div class="sections_group">

            <div class="entry-content" itemprop="mainContentOfPage">

                <div class="section the_content has_content">
                    <div class="section_wrapper">
                        <div class="the_content_wrapper">
                            <div class="custom-checkout-container">
                                <div id="wrap_popup1" class="wrap_popup" style="backdrop-filter: blur(9px);">
                                    <div class="popup" style="background: white;">
                                        <div class="title border-bottom">
                                            <p class="popupTitle" >Stay local Number</p>
                                        </div>
                                        <div class="box">
                                            <p class="popupDesc"></p>
                                            <center><i class="icon-cancel popupclose" onClick="closePopup('#wrap_popup1')" data-dismiss="modal" aria-label="Close"> </i></center>
                                        </div>
                                    </div>
                                </div>

                                <div id="wrap_popup2" class="wrap_popup" style="backdrop-filter: blur(9px);">
                                    <div class="popup" style="background: white;">
                                        <div class="title border-bottom">
                                            <p class="popupTitle" id="staylocalTitle" > </p>
                                        </div>
                                        <div class="box">
                                            <p class="popupDesc" id ="stayLoacalDesc">  </p>
                                            <center><i class="icon-cancel popupclose " onClick="closePopup('#wrap_popup2')" data-dismiss="modal" aria-label="Close"> </i></center>
											
                                        </div>
											
	
                                    </div>
                                </div>
                                <div class="countPhone d-none" >

                                </div>
								<div class="countAlreadySim d-none"></div>
								<div class="school-popup d-none"></div>
								 <a class="text-right d-none " onclick="openPopup('#wrap_popup1')" id="sLearnMore" > </a>
<?php
$rentalPhone = false;
foreach ($equipments as $equipment):
    if ($equipment['IsSim'] == 1 || $equipment['IsSmartPhone'] ==0 ) {
        continue;
    } else if ( $equipment['IsSmartPhone'] == 1) {
        $rentalPhone = true;
    }
    ?>
                                    <div id='rentalPhone' class="d-none" value="<?php echo ($rentalPhone) ? 'true' : '' ?>" > </div>
                                    
                                <?php endforeach; ?>
								<div id="accFinalAmount" class="d-none">
                                    </div>
                                <div class="loading d-none"></div>
                                <div class="checkout-header">
                                    <div class="title"><img src="https://dev.newedgedesign.com/talknsave/wp-content/uploads/2021/05/screenshot_6.png">Checkout</div>
                                    <div class="help-link"><a href="tel:+1-866-825-5672">Customer Support </a></div>
                                </div>

                            </div>
                            <section>
                                <div class="progress">
                                    <div class="progress-bar active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </section>
                            <section class="mt-5 mobile-mt-4" style='margin-bottom: 182px;'>
                                <div class="container custom-main-container">
                                    <div class="form"  id="multistep_form">
                                        <fieldset id="service_date">
                                            <div class="row">
                                                <div class="col"><a href="javascript:history.go(-1);" class="cart-link"><i class="icon-left-open-big"></i></a></div>
                                                <div class="col-md-6">
													
												<?php 
													$busSelectHide = $data['BusSelectHide'];
													$b = $bundle_id;
													$link_id= $link_id;
													$busRequireInfo=$data['busRequireInfo'];
													$busRequireInfoCount = count($busRequireInfo);
													
													if(is_null($busSelectHide) ){
$busSelectHide=false;
}
										
													if( $b!=null &&  $b=376 ){
													if( $link_id !=null  && ($linkid==15614 || $linkid==15613)   ){
													 $busSelectHide = true;
													}}
													if($busCount > 0  &&  $busSelectHide == false && $busRequireInfoCount > 0 ){ $programOrBus="bus"; if($data['ParentLink']=="amh"){$programOrBus="program";}
												
													?>
	                                                       <div class="form-group">
															   <?php
															   if($data['BusSelectQuestion'] !=null && $data['BusSelectQuestion'] !=""){ ?>
										<label class="innner-label">  <?php echo $data['BusSelectQuestion']?></label>						   
															   
													<?php		  }else { ?>
															   <label class="innner-label"> Which <?php echo $programOrBus?> are you on?  </label>
														<?php	   } ?>
																 
																 <select class="form-control bus"  qty="<?php echo $ord_qty; ?>"  b ="<?php echo $bundle_id;?>"> 
																	 <option value="">
																	 select 
																	 </option>
																	 <?php foreach($buses as $bus){ 
	                                                                $selected='';
																	 if( $bus['Counter'] == $link_id){
																		  $selected='selected';
																	 }
																	 ?>
																	 
															<option <?php echo $selected; ?>  linkid="<?php echo $bus['Counter'] ?>"  > <?php echo $bus['GroupName']; ?>  </option>
													<?php 	} ?>
																 </select>
															   <p class="busError" style="color:red; font-size: 12px; margin-top: -2px;"></p>
															</div>
<?php }  ?>		
													
													
                                                    <div class="title">
                                                        <h2 >Select the service dates</h2>

                                                                <?php
                                                                $min = explode('|', $min_period);
                                                                $max = explode('|', $max_period);
														
														$LockProgramStartDate = $data["dateProgramStart"];
                    									$LockProgramEndDate = $data["dateLeaveIL"];
                    									$IsLockProgramDates = $data["optLockProgramDates"];
														
														$startDate ="";
														$isBeginDateLocked="";
														$endDate="";
														$isEndDateLocked="";
														
														$currentDate=date("m/d/Y");
														if($LockProgramStartDate!=null){
															$startDate = date("m/d/Y", strtotime($LockProgramStartDate));
															$strTimeStartDate = strtotime($startDate);
															$strTimeCurrentDate = strtotime($currentDate);
															if($strTimeStartDate < $strTimeCurrentDate){
																$startDate=$currentDate;
															}
														}
														if($startDate!=null && $startDate!="" && $IsLockProgramDates){
															$isBeginDateLocked="disabled";
														}
														
														if($LockProgramEndDate!=null){
															$endDate = date("m/d/Y", strtotime($LockProgramEndDate));
															$strTimeendDate = strtotime($startDate);
															$strTimeCurrentDate = strtotime($currentDate);
															if($strTimeendDate < $strTimeCurrentDate){
																$endDate="";
															}
														}
														if($endDate!=null && $endDate!="" && $IsLockProgramDates){
															$isEndDateLocked="disabled";
														}
														 
                                                                ?> 
                                                            <?php
                                                            if ($min[1] == 'd' && $max[1] == 'd') {
                                                                $minDayOrMonth = "days";
                                                                $maxDayOrMonth = "days";
                                                            } else if ($min[1] == 'd' && $max[1] == 'm') {
                                                                $minDayOrMonth = "days";
                                                                $maxDayOrMonth = "month";
                                                            } else if ($min[1] == 'm' && $max[1] == 'd') {
                                                                $minDayOrMonth = "month";
                                                                $maxDayOrMonth = "days";
                                                            } else if ($min[1] == 'm' && $max[1] == 'm') {
                                                                $minDayOrMonth = "month";
                                                                $maxDayOrMonth = "month";
                                                            }
															else{
									if($min[1] == 'd'){
										$minDayOrMonth = "days";
									}
									else if ($min[1] == 'm') {
										  $minDayOrMonth = "month";
									}
								}
                                                            ?>
  This service is provided for a  minimum duration of <?php echo $min[0]; ?> <?php echo $minDayOrMonth; ?> <?php echo  ($max_period) ? ("with a maximum duration of") : ""; ?> <?php echo $max[0]; ?> <?php echo $maxDayOrMonth; ?> .
                                                        </p>




                                                    </div>
                                                            <?php if ($min_period):
												$currentDate =  date("m/d/Y");
												$currentDate = strtotime( $currentDate);
												$strStartDate= $startDate;
												$strStartDate = strtotime($startDate);
												?>
                                                        <div class="form-group">
                                                            <label class="inner-label">Begin date:</label>
                                                            <input  class="form-control validateDate required custom-date-input" autocomplete="off"  name="begin_date" data-toggle="datepicker"  readonly value="<?php echo ($strStartDate < $currentDate) ? '' : $startDate; ?>" id="begin_date"
                                                                   placeholder="MM/DD/YYYY" required <?php echo $isBeginDateLocked; ?> >
															<p class="dateError" style="color:red; font-size: 12px; margin-top: -2px;"></p>
															
                                                        </div>
<?php endif; ?>
<?php if ($optLeaveILrequest): ?>
                                                        <div class="form-group">
                                                            <label class="inner-label">End date:</label>
                                                            <input class="form-control validateDate required" autocomplete="off" name="end_date" data-toggle="datepicker" value="<?php echo $endDate; ?>" id="end_date"
                                                                   placeholder="MM/DD/YYYY" required <?php echo $isBeginDateLocked; ?> >
                                                        </div>
											     	<p id="error_day"  style="font-size: 12px; color: red;">
                                                        <p id="error_day" class="dateError" style="font-size: 12px; color: red;">
                                                        </p>
                                                    <?php endif; ?>

                                                    <button type="button" class="next btn btn-block  " value="Next" id="next1"   >Next <i class="icon-right-thin"></i></button>

                                                </div>
                                                <div class="col"></div>
                                            </div>

										
                                        </fieldset>

                                        <fieldset id="need_sim">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous1"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-6 pl-0 pr-0">
                                                    <div >
                                                        <div class="cloneSimDefault simCount" >
                                                            <div class="title">
                                                                <h2 style="margin-bottom:18px; display: inline-block;">Please choose your equipment <span class="hiddenOrderNum"></span></h2>
                                                                <a href="#" class="learnMore PhoneSimInfo cursorP" > Learn more </a>
                                                            </div>

<?php
$countSim = 0;
foreach ($equipments as $equipment):
		if($equipment['IsSim'] == false){
			continue;
		}					
    
        ?>
                                                                    <div class="form-group">
                                                                        <div class="form-check">

                                                                            <input issmartphone="<?php echo ($equipment['IsSmartPhone']) ? 'true' : ''; ?>" issim="<?php echo ($equipment['IsSim']) ? 'true' : ''; ?>"   issns= "<?php echo ($equipment['IsSns']) ? 'true' : ''; ?>" kosher= "<?php echo ($equipment['kosher']) ? 'true' : ''; ?>" data-cost="<?php echo $equipment['ECost'] ?> " class="form-check-input equipmentSim"  type="radio" value="<?php echo $equipment['EquipmentId']; ?>" data-code="<?php echo $equipment['EquipmentCode']; ?>" notes="<?php echo ($equipment['Notes']) ? $equipment['Notes'] : ''; ?> " name="equipment" data-name="<?php echo $equipment['name']; ?>" required  <?php echo ($countSim == 0) ? checked : ''; ?> >
                                                                            <label class="form-check-label radio-label"> <?php echo $equipment['name']; ?>
                                                                    <?php
											if ($equipment['EquipmentId'] != 9999 && ($equipment['BundlePopUp'] != '')  ) {  
																				$dataPopup=$equipment['BundlePopUp'];
	                                                                            $dataPopup= str_replace('"', "'", $dataPopup);
																				?>
																				
         <i class="icon-info-circled right-align cursorP simPopup" data-popup="<?php echo $dataPopup; ?>" id="<?php echo $equipment['EquipmentId']; ?>" > </i>
                                                                    <?php }
                                                                    ?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
        <?php
        $countSim++;
   

endforeach;
?>
															<?php
// $countSim = 0;
foreach ($equipments as $equipment):
		if($equipment['IsSim'] == true){
			continue;
		}					
    
        ?>
                                                                    <div class="form-group">
                                                                        <div class="form-check">

                                                                            <input issmartphone="<?php echo ($equipment['IsSmartPhone']) ? 'true' : ''; ?>" issim="<?php echo ($equipment['IsSim']) ? 'true' : ''; ?>"   issns= "<?php echo ($equipment['IsSns']) ? 'true' : ''; ?>" kosher= "<?php echo ($equipment['kosher']) ? 'true' : ''; ?>" data-cost="<?php echo $equipment['ECost'] ?> " class="form-check-input equipmentSim"  type="radio" value="<?php echo $equipment['EquipmentId']; ?>" notes="<?php echo ($equipment['Notes']) ? $equipment['Notes'] : ''; ?> " name="equipment" data-name="<?php echo $equipment['name']; ?>" required  <?php echo ($countSim == 0) ? checked : ''; ?> >
                                                                            <label class="form-check-label radio-label"> <?php echo $equipment['name']; ?>
                                                                    <?php
											if ($equipment['EquipmentId'] != 9999 && ($equipment['BundlePopUp'] != '')  ) {  
																				$dataPopup=$equipment['BundlePopUp'];
	                                                                            $dataPopup= str_replace('"', "'", $dataPopup);
																				?>
																				
         <i class="icon-info-circled right-align cursorP simPopup" data-popup="<?php echo $dataPopup; ?>" id="<?php echo $equipment['EquipmentId']; ?>" > </i>
                                                                    <?php }
                                                                    ?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
        <?php
        $countSim++;
   

endforeach;
?>
															
                                                        </div>
                                                    </div>
													<?php if($ord_qty>1){ ?>
                                                    <div class="form-group mt-3 row form-check" style="background: transparent;border: none;">
                                                        <input class="form-check-input" id="simCheckBox"  type="checkbox" value="" checked>
                                                        <label class="form-check-label check-label d-block terms" >
                                                            Save this choice for the rest of the products in the cart
                                                        </label>
                                                    </div>
											<?php		} ?>

                                                    <button type="button" name="next" class="next btn btn-block" id="next2" >Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                             


                                        <fieldset id="optional_add_ons">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous5"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-6">

                                                    <div>
                                                        <div class="stayLocalCloneDefault">
                                                            <div class="title">
                                                                <h2>Optional add ons <span class="OptionalOrderNum"></span></h2>
                                                            </div>
															
															
			<?php if( count($kntCountries) != 0  &&  $kntCountries[0]['DirectDisplayName'] != 'No, Thank you'){ ?>												
                                                            <div class="form-group">
                                                                <label class="large-inner-label" style="margin-bottom: 10px;"><span> "Stay local" number <span style="color: red;"> * </span>  </span>
                                                                    <a class="text-right cursorP " 
                                                                       onclick="openPopup('#wrap_popup2')" id="staticLearnMore" >Learn
                                                                        more</a>
                                                                    </label>
                                                                <div class="select">
                                                                    <select class="form-control  optionalAdd stayLocalSelect " id="stay_local" >
                                                                        <option value="" selected>Select</option>
<?php foreach ($kntCountries as $kntCountry): ?>
                                                                            <option data-kntcode=<?php echo $kntCountry['KNTCode'] ?>  data-country="<?php echo $kntCountry['Descr']; ?>" value="<?php echo $kntCountry['DirectDisplayName']; ?>"><?php echo $kntCountry['DirectDisplayName']; ?></option>
<?php endforeach; ?>

                                                                    </select>
                                                                </div>
                                                            </div>
 <?php } ?>
<?php if (count($bundles[0]['smss']) != 1 && $bundles[0]['smss'][0]['SMSPackageName'] != 'No, Thank you') { ?>
                                                                <div class="form-group">
                                                                    <label class="large-inner-label" style="margin-bottom: 10px;"><span> International text plan <span style="color: red;"> * </span>  </span> 
                                                                        <a  id="international"
                                                                            id class="text-right cursorP" >Learn more</a> </label>
                                                                    <div class="select">
                                                                        <select class="form-control optionalAdd internationalSelect" id="smsPackageName"  >
                                                                            <option value="" selected>Select</option>
    <?php foreach ($bundles[0]['smss'] as $sms):
        ?>
                                                                                <option class="form-control" value="<?php echo $sms['SMSPackageName']; ?>"><?php echo $sms['SMSPackageName']; ?></option>

    <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
<?php } ?>	
                                                        </div>
                                                    </div>
													<?php if($ord_qty>1){ ?>
                                                    <div class="form-group mt-3 row form-check" style="background: transparent;border: none;margin-left:-6px;">
                                                        <input class="form-check-input" id="stayLocalCheckBox"  type="checkbox" value="" checked>
                                                        <label class="form-check-label d-block check-label terms">
                                                            Save this choice for the rest of the products in the cart
                                                        </label>
                                                    </div>
													<?php } ?>
                                                    <button type="button" class="next btn btn-block" id="next6" disabled >Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="billing_info">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous6"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="title" style="margin-bottom: 39px;">
                                                        <h2>Add your billing information</h2>
                                                    </div>
<!--                                                     <p class="billingP" style='color:red; font-size: 12px; margin-top: -2px;'>All fields are required !</p> -->
                                                    <div class="form-group">
                                                        <label class="inner-label">First name (phone user) <span style="color: red;"> *</span></label>
                                                        <input type="text" class="form-control billing"  name="billing_fname" >
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="inner-label">Last name <span style="color: red;"> *</span></label>
                                                        <input type="text" class="form-control billing"  name="billing_lname" >
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="inner-label">Email <span style="color: red;"> *</span></label>
                                                        <small class="form-text">This email address will receive all confirmations and bills.</small>
                                                        <input type="email" name="billing_email"  class="form-control validateEmail billing billing_email" >
                                                        <small class="invalidEmail" style='color:red; font-size: 12px;'></small>
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
													
													 <div class="form-group">
                                                        <label class="inner-label"> Confirm Email <span style="color: red;"> *</span></label>
                                                        <input type="email"   class="form-control confirmBillingEmail validateEmail billing">
                                                        <small class="invalidEmail" style='color:red; font-size: 12px;'></small>
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
													
                                                    <div class="form-group">
                                                        <label class="inner-label">Phone Number <span style="color: red;"> *</span></label>
                                                        <div class="input-group mb-2">

                                                            <input type="number" class="form-control billing " name="billing_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                   type = "number"
                                                                   maxlength = "12"  style="width: 100%;">
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Address <span style="color: red;"> *</span></label>
                                                        <input type="text" name="billing_address" class="form-control billing" >
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">City <span style="color: red;"> *</span></label>
                                                        <input type="text" name="billing_city" class="form-control billing" >
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Country <span style="color: red;"> *</span></label>
                                                        <div class="select">
                                                            <select class="form-control billing" id="billing_country" >
                                                                <option  value="" selected>Select</option>
<?php foreach ($data['countries'] as $country):
    ?>
                                                                    <option class="form-control" id="<?php echo $country['CountryID']; ?>" value="<?php echo $country['CountryName']; ?>" > <?php echo $country['CountryName']; ?> </option>
<?php endforeach; ?>
                                                            </select>
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>


                                                    </div>
                                                    <div class="form-group d-none" id='USA_state'>
                                                        <label class="inner-label">State/Province. <span style="color: red;"> *</span></label>
                                                        <div class="select">
                                                            <select class="form-control" id="stateProvinceUSA" >
                                                                <option  value="" selected>Select</option>
<?php foreach ($data['UsaStates'] as $state):
    ?>
                                                                    <option class="form-control" state-code="<?php echo $state['StateCode']; ?>" value="<?php echo $state['StateName']; ?>" > <?php echo $state['StateName']; ?> </option>
<?php endforeach; ?>
                                                            </select>
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>

                                                    </div>

                                                    <div class="form-group d-none" id='Canada_states'>
                                                        <label class="inner-label">State/Province. <span style="color: red;"> *</span></label>
                                                        <div class="select">
                                                            <select  class="form-control" id="stateProvinceCanada"  >
                                                                <option value=""  selected>Select</option>
<?php foreach ($data['CanadaStates'] as $state):
    ?>
                                                                    <option class="form-control" state-code="<?php echo $state['StateCode']; ?>" value="<?php echo $state['StateName']; ?>" > <?php echo $state['StateName']; ?> </option>
<?php endforeach; ?>
                                                            </select>
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>

                                                    </div>

                                                    <div class="form-group zipCode">
                                                        <label class="inner-label">Zip/Post code <span style="color: red;"> *</span></label>
                                                        <input type="text"  maxlength="8" class="zipCodeValidate" name="billing_zip" class="form-control billing"  style="width:100%">
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
	<?php if($p == 'bhlt'){ ?>
	 <div class="form-group">
                                                        <label class="inner-label">Talmid's Name <span style="color: red;"> *</span> </label>
                                                        <input type="text" name="stu_name"   class="form-control billing  " >

                                                        <p class="billingR"  style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
									 <div class="form-group">
                                                        <label class="inner-label">Father's Name <span style="color: red;"> *</span> </label>
                                                        <input type="text" name="parent_name"   class="form-control billing " >

                                                        <p class="billingR"  style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>	
													 <div class="form-group">
                                                        <label class="inner-label">Name of Yeshiva in the US<span style="color: red;"> *</span> </label>
                                                        <input type="text" name="yeshiva_name"   class="form-control  " >

                                                        <p class="billingR"  style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
													 <div class="form-group">
                                                        <label class="inner-label">Name of His Rabbi in the US<span style="color: red;"> *</span> </label>
                                                        <input type="text" name="rebbe_name"   class="form-control billing  " >

                                                        <p class="billingR"  style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
													<div class="form-group">
                                                        <label class="inner-label">The Yeshiva you will be attending in Israel(optional).<span style="color: red;"> </span> </label>
<!-- 														<small class="form-text">we will contact you on this number to arrange your phone delivery in Israel.</small> 	 -->
<!--                                                         <input type="text"  style="width: 100%;" name="whatspapp_num" class="form-control " > -->
														<select type="text" style="width: 100%;" name="whatspapp_num" class="form-control ">
<option value="Select">I am not sure</option><option value="Brisk">Brisk</option><option value="Kollel Tiferes Tzvi (Rabbi M.A. Rosengarten)">Kollel Tiferes Tzvi (Rabbi M.A. Rosengarten)</option><option value="Mir">Mir</option><option value="Ner Moshe (R’ Shalom Schechter)">Ner Moshe (R’ Shalom Schechter)</option><option value="Tiferes Chaim (Pragers)">Tiferes Chaim (Pragers)</option><option value="Yagdil">Yagdil</option><option value="Yeshivas HaGramad (Reb Dovid)">Yeshivas HaGramad (Reb Dovid)</option><option value="Zos L’Yaakov (Rabbi Y.D. Shechter)">Zos L’Yaakov (Rabbi Y.D. Shechter)</option>
</select>
                                                        <p class="billingR"  style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
<?php  } ?>				
			<?php if($p == 'momentum' || $p == 'momentum-staff'){ ?>
	 <div class="form-group">
                                                        <label class="inner-label">Name of Partner organization : <span style="color: red;"> *</span> </label>
                                                        <input type="text" name="partnerOrg_name"   class="form-control billing  " ><p class="billingR"  style='color:red; font-size: 12px; margin-top: -2px;'></p>	
                                                    </div>
								
<?php  } ?>											
													
                                                    <button type="button" class="next btn btn-block" id="next7"  >Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="shipping_option">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous7"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="title" style="    margin-bottom: 36px;">
                                                        <h2>Add shipping details</h2>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="large-inner-label"><span> Shipping method <span style="color: red;"> *</span> </span></label>
														<p style="color: green;font-size: 14px;">Fees include handling charges. Ordering more than one device or SIM?
You will see a 50% discount on shipping and handling for each additional item!</p>
                                                        <div class="select">

                                                            <select class="form-control" id="shipping_method">
                                                                <option selected>Select</option>
<?php
$oldCountry = '';
$currentCountry = '';
$counter = 0;
foreach ($data['shippings'] as $shipping):
 $shippingDesc = $shipping['shippingDesc'];
   $shippingDesc = str_replace('"', "'", $shippingDesc);
    $currentCountry = $shipping['countryName'];

    if ($shipping['shippingID'] == -1)
        continue;
    ?>
                                                                    <?php
                                                                    if ($currentCountry != $oldCountry) {
                                                                        if ($counter > 0) {
                                                                            ?>
                                                                            </optgroup>
                                                                        <?php } ?>
                                                                        <optgroup  label= "<?php echo $currentCountry; ?>" >
                                                                        <?php
                                                                        $oldCountry = $currentCountry;
                                                                       
                                                                    }
                                                                    ?>


                                                                        <option  has-mifi="<?php echo $shipping['HasMifi'] ?>" has-netstick="<?php echo $shipping['HasNetstick'] ?>" opt-require-ship-address="<?php echo $shipping['optRequireShipAddress']; ?> " base-code="<?php echo ($shipping['basecode']) ? $shipping['basecode'] : '' ?>" opt-local-pickup="<?php echo $shipping['optLocalPickup'] ?> "  shipmethod="<?php echo $shipping['shippingMethodNEW']; ?>"  has-phones="<?php echo ($shipping['hasPhones']) ? 1 : 0 ; ?>" shipping-notes="<?php echo ($shipping['shippingNotes']) ? $shipping['shippingNotes'] : '' ?>"data-cost="<?php echo $shipping['cost']; ?>" data-title="<?php echo $shipping['shippingName']; ?>"  data-desc="<?php echo $shippingDesc; ?> "  value="<?php echo $shipping['shippingID']; ?>"> <?php echo $shipping['shippingName']; ?> &nbsp;&nbsp; <span> 
                                                                    <?php
                                                                    if ($shipping['cost'] == 0) {
                                                                        echo "Free";
                                                                    } else {
                                                                        $price = $shipping['cost'];
                                                                        echo '$' . $price;
                                                                    }
                                                                    ?>							 

                                                                    </span>   </option>


                                                                        <?php
                                                                        $counter += 1;
                                                                    endforeach;
                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label class="large-inner-label shipping_heading"><span> Shipping address <span style="color: red;"> *</span> </span></label>
                                                    <div class="shipping_option">
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input  " type="radio" name="shipping_address" 
                                                                       value="yes">
                                                                <label class="form-check-label radio-label">Use my billing address</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input shipping" type="radio" name="shipping_address" value="no" >
                                                                <label class="form-check-label radio-label">I'd like to enter a different
                                                                    address</label>
                                                            </div>
                                                        </div>
                                                    </div>
																										<?php if($data['optRequestProgramName'] == true){ ?>
	<div class="form-group ">
                                                            <label class="inner-label">School/Program Name<span style="color: red;"> *</span></label>
                                                            <input type="text" class="form-control schoolName">
		<p class="schoolError" style="color:red; font-size: 12px; margin-top: -2px;"></p>
                                                        </div>
												
<?php } ?>
                                                    <div class="shipping_info" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="inner-label">Shipping name <span style="color: red;"> *</span></label>
                                                            <input type="text" name="shipping_name" class="form-control shipping" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label"><span class="shipping_phonelabel">Phone Number </span>  <span style="color: red;"> *</span></label>
                                                            <div class="input-group mb-2">

                                                                <input type="text" class="form-control shipping" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                       type = "number"
                                                                       maxlength = "12" name="shipping_phone"  style="width: 100%">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">Address <span style="color: red;"> *</span></label>
                                                            <input type="text" class="form-control shipping" id="shipAddress" name="shipping_address" >
                                                        </div>
                                                        <div class="form-group d-none" id='USA_stateP'>
                                                            <label class="inner-label">State <span style="color: red;"> *</span></label>
                                                            <div class="select">
                                                                <select class="form-control" id="shippingUSA"  >
                                                                    <option  value="" selected>Select</option>
<?php foreach ($data['UsaStates'] as $state):
    ?>
                                                                        <option class="form-control" state-code="<?php echo $state['StateCode'] ?>"  value="<?php echo $state['StateName']; ?>" > <?php echo $state['StateName']; ?> </option>
<?php endforeach; ?>
                                                                </select>

                                                            </div>

                                                        </div>

                                                        <div class="form-group d-none" id='Canada_statesP'>
                                                            <label class="inner-label">State. <span style="color: red;"> *</span></label>
                                                            <div class="select">
                                                                <select  class="form-control" id="shippingCanada" >
                                                                    <option value=""  selected>Select</option>
<?php foreach ($data['CanadaStates'] as $state):
    ?>
                                                                        <option class="form-control" state-code="<?php echo $state['StateCode'] ?>"   value="<?php echo $state['StateName']; ?>" > <?php echo $state['StateName']; ?> </option>
<?php endforeach; ?>
                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">City <span style="color: red;"> *</span></label>
                                                            <input type="text" class="form-control shipping" name="shipping_city" >
                                                        </div>
                                                        <!--                             <div class="form-group">
                                                                                        <label class="inner-label">Country</label>
                                                                                        <input type="text" class="form-control shipping" name="shipping_country" placeholder="UNITED STATES">
                                                                                    </div> -->
                                                        <div class="form-group">
                                                            <label class="inner-label">Zip/Post code <span style="color: red;"> *</span></label>
                                                            <input type="text" maxlength="8" class="form-control zipCodeValidate shipping" name="shipping_zip" >
                                                        </div>
                                                    </div>
                                                    <div class="leaving_date" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="control-label inner-label">The date you will be leaving this
                                                                address <span style="color: red;"> *</span></label>
                                                            <input class="form-control"   autocomplete="nope" name="date_to_leave" id="date_to_leave"   placeholder="MM/DD/YYYY">
															<p class="shippingError" style="color:red; font-size: 12px; margin-top: -2px;"></p>
															
                                                        </div>
                                                    </div>
                                                    <button type="button" class="next btn btn-block" id="next8"  disabled>Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="shipping_Acc">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous12"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-6">
<?php if (!empty($bundles[0]['optionals'])) { ?>			 
                                                        <div class="optional-heading" id="bonus-optional">
                                                            Bonus! Your order qualifies for the following special deals!
                                                        </div>

                                                        <div class="row" style="color:#000913">
    <?php foreach ($bundles[0]['optionals'] as $optional) : ?>
                                                                <div class="card phonecard" >
        <?php
        $ClientCode = $optional['ClientCode'];
        $CouponCode = $optional['CouponCode'];
        $Deposit = $optional['Deposit'];
        $EquipmentCode = $optional['Equipment_code'];
        $Insurance = $optional['Insurance'];
        $OptionalCode = $optional['OptionalCode'];
        $OptionalFeeDesc = $optional['Rate'];
        $OptionalFeeDesc = str_replace('"', "'", $OptionalFeeDesc);
        $OptionalImg = $optional['image'];
        $OptionalName = $optional['chckBxName'];
        $OptionalType = '';
        $OptionText = $optional['chckBxName'];
        $PlanCode = $optional['Plan_code'];
        $RequiredInsurance = $optional['Insurance'];
        $RequiredOperationSystem = $optional['IsRequiredOperationSystem'];

                		$Plan_code_55=$optional['Plan_code_55'];
		$Plan_code_100=$optional['Plan_code_100']; 									 
	if ($Plan_code_55 > 0 &&  $Plan_code_100 > 0){
                    if ($data['ProviderCode'] == 55) {
						  $PlanCode= $Plan_code_55;
					}
                       
                    else if ($data['ProviderCode'] == 100){
						$PlanCode = $Plan_code_100;
					}
                       
	}
								 
        ?>


                                                                    <div class="cardBody" style="padding: 10px 29px;" ClientCode=" <?php echo $ClientCode; ?>" Deposit=" <?php echo $Deposit; ?>"  CouponCode=" <?php echo $CouponCode; ?>"  EquipmentCode=" <?php echo $EquipmentCode; ?>" Insurance=" <?php echo $Insurance; ?>"  OptionalCode=" <?php echo $OptionalCode; ?>" OptionalFeeDesc=" <?php echo $OptionalFeeDesc; ?>" OptionalImg=" <?php echo $OptionalImg; ?>" OptionalName=" <?php echo $OptionalName; ?>" OptionalType=" <?php echo $OptionalType; ?>"  OptionText=" <?php echo $OptionText; ?>" PlanCode=" <?php echo $PlanCode; ?>" RequiredInsurance=" <?php echo $RequiredInsurance; ?>"  RequiredOperationSystem=" <?php echo $RequiredOperationSystem; ?>"   >
                                                                        <div class="imgTitle row" >
																			<div class="col-md-3">
                                                                            <img  class="optional-image" src="<?php echo $optional['image']; ?>" alt="" >
																			</div>
                                                                    <?php
                                                                    $bonusDesc = $optional['chckBxDesc'];
                                                                    $bonusDesc = str_replace('"', "'", $bonusDesc);
                                                                    ?>
                                                                            <div  data-popup="<?php echo $bonusDesc; ?> " data-title ="<?php echo $optional['chckBxName']; ?>" class="optional-title accPopoup col-md-8">  <?php echo $optional['chckBxName']; ?> </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="cart" style=" display:flex; justify-content: space-between;">
                                                                            <!-- 								 <div class="optional-cart">Add to order </div> -->
                                                                            <div style="display:flex;">
																<a class="cart-qty-minus plus-minus greybtn" type="button" value="-" style="color: #fff !important;    border-width: 0px;"> -</a>						
																				
														
<!--                                                                                 <button  class="cart-qty-plus plus-minus" style="background-color:#112453 !important;color:#ffffff !important;     border-width: 0px;" type="button" value="+">+</button> -->
                                                                                <input  type="text" name="qty" class="qty" maxlength="12" value="0" style="   border: none!important ;
     padding: 0px !important;
     width: 30px;
    height: 30px;
	text-align: center;
    margin-right: 8px !important;
    margin-bottom: 0px !important;
    font-size: 18px;
    color: black;
    border-radius: 50%; " />
																				<a class="cart-qty-plus plus-minus bluebtn" style="color:#ffffff !important; border-width: 0px;" type="button" value="+"> + </a>
<!--                                                                                 <button class="cart-qty-minus plus-minus" type="button" value="-" style="background-color:#112453 !important;color:#ffffff !important;     border-width: 0px;">-</button> -->
                                                                            </div>
                                                                            <div class="optional-price"  data-price="<?php echo $optional['Rate']; ?>" > <?php echo $optional['Rate']; ?> </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
    <?php endforeach ?> 

                                                        </div>
<?php } ?>					 
<?php
foreach ($data['shippings'] as $shipping):
    if (empty($shipping['shippingAccessories'])) {
        continue;
    }
    ?>
                                                        <div class="d-none shipping_Ass" style="margin-top: 20px;" id="shipping_Ass_<?php echo $shipping['shippingID']; ?>">
                                                            <div class="optional-heading">
                                                                Accessories - special for travel to Israel
                                                            </div>

                                                            <div class="row" style="coloe:#000913">
                                                        <?php foreach ($shipping['shippingAccessories'] as $shippingAss): ?>

                                                            <?php
                                                            $ClientCode = 0;
                                                            $CouponCode = $shippingAss['CouponCode'];
                                                            $Deposit = $shippingAss['Deposit'];
                                                            $EquipmentCode = $shippingAss['Equipment_code'];
                                                            $Insurance = $shippingAss['Insurance'];
                                                            $OptionalCode = $shippingAss['chckbxID'];
                                                            $OptionalFeeDesc = $shippingAss['rate'];
                                                            $OptionalFeeDesc = str_replace('"', "'", $OptionalFeeDesc);
                                                            $OptionalImg = $shippingAss['image'];
                                                            $OptionalName = $shippingAss['chckBxName'];
                                                            $OptionalType = '';
                                                            $OptionText = $shippingAss['chckBxName'];
                                                            $PlanCode = $shippingAss['Plan_code'];
                                                            $RequiredInsurance = $shippingAss['Insurance'];
                                                            $RequiredOperationSystem = $shippingAss['IsRequiredOperationSystem'];
														    
                                                            ?>

                                                                    <div class="card phonecard" >
                                                                        <div class="cardBody" style="padding: 10px 29px;" ClientCode=" <?php echo $ClientCode; ?>" Deposit=" <?php echo $Deposit; ?>"  CouponCode=" <?php echo $CouponCode; ?>"  EquipmentCode=" <?php echo $EquipmentCode; ?>" Insurance=" <?php echo $Insurance; ?>"  OptionalCode=" <?php echo $OptionalCode; ?>" OptionalFeeDesc=" <?php echo $OptionalFeeDesc; ?>" OptionalImg=" <?php echo $OptionalImg; ?>" OptionalName=" <?php echo $OptionalName; ?>" OptionalType=" <?php echo $OptionalType; ?>"  OptionText=" <?php echo $OptionText; ?>" PlanCode=" <?php echo $PlanCode; ?>" RequiredInsurance=" <?php echo $RequiredInsurance; ?>"  RequiredOperationSystem=" <?php echo $RequiredOperationSystem; ?>"    >
                                                                            <div class="imgTitle row" >
 <div class="col-md-3">
                                                                                <img  style="max-height:60px" class="optional-image" src="<?php echo 'https://wordpress-944064-3284364.cloudwaysapps.com/' . $shippingAss['image']; ?>" alt="" >
	 	</div>
                                                                    <?php
                                                                    $shippingPopup = $shippingAss['Description'];
                                                                    $shippingPopup = str_replace('"', "'", $shippingPopup);
                                                                    ?>
                                                                                <div  style=""  data-popup="<?php echo $shippingPopup ?>" data-title="<?php echo $shippingAss['name']; ?>" class="optional-title accPopoup col-md-8">  <?php echo $shippingAss['name']; ?> </div>
                                                                            </div>
                                                                             <hr>

                                                                            <div class="cart" style=" display:flex; justify-content: space-between;">
                                                                                <!-- 								 <div class="optional-cart">Add to order </div> -->
                                                                                <div style="display:flex;">
																					
																					<a class="cart-qty-minus plus-minus greybtn" type="button" value="-" style="color: #fff !important;    border-width: 0px;"> -</a>
								
<!--                                                                                     <button  class="cart-qty-plus plus-minus" style="background-color:#112453 !important;color:#ffffff !important;     border-width: 0px;" type="button" value="+">+</button> -->
                                                                                    <input  type="text" name="qty" class="qty" maxlength="12" value="0" style="   border: none!important ;
      padding: 0px !important;
     width: 30px;
    height: 30px;
	text-align: center;
    margin-right: 8px !important;
    margin-bottom: 0px !important;
    font-size: 18px;
    color: black;
    border-radius: 50%;"  />
																																		<a class="cart-qty-plus plus-minus bluebtn" style="color:#ffffff !important; border-width: 0px;" type="button" value="+"> + </a>
<!--                                                                                     <button class="cart-qty-minus plus-minus" type="button" value="-" style="background-color:#112453 !important;color:#ffffff !important;     border-width: 0px;">-</button> -->
                                                                                </div>
                                                                                <div class="optional-price" data-price="<?php echo $shippingAss['PriceText'] ?>" > <?php echo $shippingAss['PriceText'] ?> </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
    <?php endforeach ?> 

                                                            </div>
                                                        </div>
<?php endforeach; ?>
                                                    <div class="row">
                                                    </div>
                                                    <button type="button" class="next btn btn-block" id="next12" >Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"> </div>
                                            </div>
                                        </fieldset>


                                        <fieldset id="card_info">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous8"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="title" style="margin-bottom:39px" >
                                                        <h2>Add Payment method</h2>
                                                    </div>
<!--                                                     <p class="billingP" style='color:red; font-size: 12px; margin-top: -2px;'>All fields are required !</p> -->
                                                    <div class="form-group">
                                                        <label class="inner-label"> Credit Card Type <span style="color: red;"> *</span></label>
                                                        <div class='select'>
                                                            <select id="cardType"  class="form-control payment" name="cardType">
                                                                <option value="" selected>Select</option>
                                                                <option value="Visa" >Visa</option>
                                                                <option value="MasterCard" >Mastercard</option>
                                                                <option  value="Discover">Discover</option>
                                                            </select>
                                                            <p  class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label" for="credit-card">Card Number <span style="color: red;"> *</span></label>
                                                        <input type="text" class="form-control payment" onkeypress="return isNumber(event)" name="cc_number" id='credit-card' maxlength="19"  >
                                                        <p   class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'></p>
														<p class="cardNumError" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="inner-label">Expiry date <span style="color: red;"> *</span></label>
                                                        <input class="form-control payment" name="cc_expiry"  onkeypress="return isNumber(event)"  id='expiry-date' maxlength="5" placeholder="MM/YY">
                                                        <p class="errorPayment " style='color:red; font-size: 12px; margin-top: -2px;'></p>
														<p class="errorExpiry" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
<!--                                                     <div class="form-group">
                                                        <label class="inner-label">CVC number <span style="color: red;"> *</span></label>
                                                        <input  max="999"   class="form-control payment cvc"   name="cc_cvc"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                type = "number"
                                                                maxlength = "3"  style="width:100%">
                                                        <p  class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label class="inner-label">Cardholder First Name <span style="color: red;"> *</span></label>
                                                        <input type="text" class="form-control payment" name="cc_fname" >
                                                        <p  class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Cardholder Last Name <span style="color: red;"> *</span></label>
                                                        <input type="text" class="form-control payment" name="cc_lname" >
                                                        <p  class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Cardholder Email <span style="color: red;"> *</span></label>
                                                        <input type="email" name="cc_email"  id="paymentEmail" class="form-control payment payment_email" >

                                                        <p class="paymentEmailError"  style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Notes(not required)</label>
                                                        <textarea rows="3" class="form-control" cols="50" name="cc_note" ></textarea>
                                                    </div>

													
                                                    <button type="button" class="next btn btn-block" id="next9" >Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="order_review">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous9"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-6 mobile-padding-33">
                                                    <div class="title" style="margin-bottom:40px">
                                                        <h2 style="margin-left:-15px">Review order</h2>
                                                    </div>
                                                    <div class="content">
                                                        <h4 style="margin-left:-15px">Contact information</h4>
                                                        <div class="row">
                                                            <div class="col-md-6 col-4">Name</div>
                                                            <div class="col-md-6 col-8 text-right contact" id="cname">John Johnson</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-4">Email</div>
                                                            <div class="col-md-6 col-8 text-right contact" id="cemail">John@gmail.com</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-4" style="margin-bottom:40px;">Phone</div>
                                                            <div class="col-md-6 col-8 text-right contact" id="cnumber"  >+12025550000</div>
                                                        </div>
                                                        <div>
											 	
															
                                                            <div class="multipleOrderDefault d-none">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <h4 class="contact planName"></h4> 
                                                                    </div>
                                                                </div>
                                             <div class="row  equipmentDiv">
                                                                    <div class="col-md-6 col-6" >Equipment</div>
                                                                    <div class="col-md-6 col-6 text-right cplan" >  </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-6 serviceDurationTxt">Service Duration</div>
                                                                    <div class="col-md-6 col-6 text-right contact cdate" id=""></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-6">Data </div>
                                                                    <div class="col-md-6 col-6 text-right data " id="">  </div>
                                                                </div>
                                                                <div class="d-none simPrice">
<?php echo $bundles[0]['BundleRate']; ?>
                                                                </div>
                                                                <div class="d-none phonePrice">
                                                                    0
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-6">Call </div>
                                                                    <div class="col-md-6 col-6 text-right call" id=""></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-6">SMS </div>
                                                                    <div class="col-md-6 col-6 text-right sms" id=""></div>
                                                                </div>
                                                                <!--                             <div class="row border-bottom">
                                                                                                <div class="col-md-6">SIM card <small>one SIM fits all</small></div>
                                                                                                <div class="col-md-6 text-right">₪ 9.97</div>
                                                                                            </div> -->
																 <div class="stayLocalReview"></div>
															<div class="internationalReivew"> </div>	
                                                                <div class="row ">
                                                                    <div class="col-md-6 col-6" >Insurance</div>
                                                                    <div class="col-md-6 col-6 text-right insurance" id=""></div>
                                                                </div>
													<div class="row border-bottom planPriceDiv border-bottom" style="padding-bottom: 13px">
                                                                    <div class="col-md-6 col-6" >Plan Price </div>
                                                                    <div class="col-md-6 col-6 text-right planPrice font-weight-bold " >   </div>
                                                                </div>
																<div class="row border-bottom d-none equipmentPriceDiv " style="padding-bottom: 13px">
                                                                    <div class="col-md-6 col-6" > Equipment Price</div>
                                                  <div class="col-md-6 col-6 text-right equipmentPrice font-weight-bold " style="font-weight:bold;" id="">  </div>
                                                                </div>  
																
                                                            </div>
                                                        </div>	
                                                        <div id="accCart" class="">

                                                        </div>
                                                  
														<div class="row setup d-none">
                                                            <div class="col-md-6 col-6" id="setupFeeText"></div>
                                                            <div class="col-md-6 col-6 text-right font-weight-bold" id="setupFeeCost"> </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-6">VAT 17%</div>
                                                            <div class="col-md-6 col-6 text-right font-weight-bold" class="contact" >$<span id="vatTotle"></span></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12"> <h4 style="margin-top: 15px; margin-bottom: 5px;">
                                                                    Shipping & Handling
                                                                </h4> </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 col-6" id="shippingName"></div>
                                                            <div class="col-md-6 col-6 text-right font-weight-bold" id="shippingPrice"> </div>
                                                        </div>
														<div class="row discountContainer d-none">
                                                            <div class="col-md-6 col-6 discountTitle">Discount 10%</div>
                                                            <div class="col-md-6 col-6 text-right font-weight-bold"><span class="discountAmount">8.50</span></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-6"><strong>TOTAL</strong></div>
                                                            <div class="col-md-6 col-6 text-right"><strong class="contact" >$<span id="cprice" ></span> <span id="newDiscountedPrice" class="d-none" style="padding-left: 10px;"></span> </strong></div>
                                                        </div>
														<?php
														if($data['HideCouponCode']==false){ ?>
															<div class="form-group mt-3 row">
                                                            <label class="inner-label" style="margin-top: 30px;">Add coupon/voucher</label>
                                                            <div class="input-group">
                                                                <input type="text" id="coupanCode" class="form-control" placeholder="1234567" style="width: 80%;border-top-right-radius: 0;border-bottom-right-radius: 0;"> 
																<div class="applyCouponBtn">Apply</div>
                                                             <h6> Please put a valid Promo Code above which will be applied to your Order amount. </h6><p class="CouponCodeError d-none" style="color:red;font-size: 14px;margin-top: -2px;"></p>
                                                            </div>
                                                        </div>
															
													<?php	} ?>
                                                        
                                                        <div class="form-group mt-3 row form-check" style="padding: 10px 0px 1px 15px;     margin-left: -22px; background: transparent;border: none;">
                                                            <input class="form-check-input" type="checkbox" value="" id="tnc">

                                                            <label class="form-check-label check-label terms termsr" style="display: block; ">
                                                                I hereby agree to the <a href="#" id="termsAndCond">Terms and Conditions </a>  of the service. I understand rates are only guaranteed when I follow the dialing directions packaged with my rental	
                                                            </label>
                                                            <p  class="errorTnc" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>
                                                        <div class="form-group  row form-check" style=" padding: 10px 0px 1px 15px; margin-left: -22px; background: transparent;border: none;">
                                                            <input class="form-check-input" id="SubscribeNewsletter" type="checkbox" value="">
                                                            <label class="form-check-label check-label terms termsr"  style="display: block;">
                                                                I would like to subscribe to the newsletter and receive promotions
                                                            </label>
                                                        </div>
														
														<?php if( $data['Covid_SignupFee'] > 0 ){ ?>
	                                                    <div class="row covidSignUp ">
                       <h6 class="col-md-12 col-12" style="color:red;" > You will be charged a non-refundable fee of $<span id="covidSignUpFees"></span>.<br/>The remaining balance will be charged on the first day of your trip.</h6>
                                     
                                                        </div>
<?php } ?>
														
														
                                                        <div class="row">
                                                            <button type="submit" onClick="submitMultiStepForm()"   style="margin-top: 31px;" class="btn btn-block place-order ">Place your order <i class="icon-right-thin"></i></button>
                                                            <button class="next d-none" id="next10">

                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="order-conformation">

                                            <div style="display: flex; justify-content: center;">

                                                <div style="display: inline-block;" >
                                                    <h2 style=" color:#000913; font-weight: bold; font-size: 28px;"> Thank you !</h2>
                                                    <h3 style="font-weight: bold;font-size: 20px;">
                                                        Your order #<span id="Confirmid"></span>  is confirmed
                                                    </h3>
                                                    <p class="c-black">
                                                        Check your email <span id="confirmEmail"> </span> for details
                                                    </p>
                                                    <div style="display: flex; flex-direction: column;">
                                                        <a href="https://wordpress-944064-3284364.cloudwaysapps.com/" class="c-black" style="margin-top: 20px;" > Back to TalkNSave Home page</a>
                                                    </div>
                                                </div>


                                            </div>
      <div class="test-object">
		  
											</div>
                                        </fieldset>
                                    </div>


                                </div>
                            </section>
                        </div></div></div></div></div></div>    
		<div class="form-group agentDiv" style="
     position: absolute;
    bottom: 0px;
    left: 10px;
    width: 105px;
">
<input class="agentName form-control">
</div>

</div>



<?php
get_footer();
