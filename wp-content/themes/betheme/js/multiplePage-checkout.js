function simPopup(element){
	let popupData=$(element).data('popup');
            $(".popupTitle").empty();
            $(".popupDesc").empty();
			if($(element).attr('id') == '2510' ){
				            $(".popupTitle").text("Network Capabilities");
            $(".popupDesc").append("<div style='font-size:16px;'>Important: Your phone must be unlocked by your wireless provider back home and have the proper 3G and 4G network capabilities.<br>To learn more about unlocking your phone, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone' class='d-inline-block mt-0' target='_blank' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone/'); return false;'>click here</a>.<br>To learn more about phone compatibility, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible' class='d-inline-block mt-0' target='_blank' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible/'); return false;'>click here</a>.<br><br></div> <div class='d-flex justify-content-center'><img style='max-width:80%' src='https://dev.newedgedesign.com/talknsave/wp-content/uploads/2021/05/multisim.png' alt='multisim' width='100%'></div> <div  onclick='closeNetworkPopup()' style='padding: 5px;' class='popup-footer okbtn'> Next</div>");
				
				$('.popup-footer').text('Cancel');
			}
			else{
				$(".popupDesc").append(popupData);
			}
			

            openPopup('#wrap_popup2');
}
	function closeNetworkPopup(){
		closePopup("#wrap_popup2");
	}
	function setLeavingDate(){
		    	$( "#date_to_leave" ).datepicker("destroy");
			 let begin_date = $('.minDate').text();
		    begin_date=$.trim(begin_date);
			  $('#date_to_leave').datepicker({
                minDate: 0,
                maxDate: new Date(begin_date)
            });
		
		
			}

function removeRequired(element){
	let parent = $(element).parent();
	let value = $(element).val();
	value=$.trim(value);
	if(value){
		$(parent).find('.dateError').text('');
	}
}
function billingCountry (){
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
}
function shippingMethodChange(element){
	console.log("shipping shippingMethodChange in multip");
	     $('.shipping_Ass').addClass('d-none');
            let option = $('#shipping_method option').filter(':selected').text();
            let shippingTitle = $(element).find(':selected').data('title');
			let  optRequireShipAddress= $(element).find(':selected').attr('opt-require-ship-address');
			optRequireShipAddress=$.trim(optRequireShipAddress);
            let shippingDesc = $(element).find(':selected').data('desc');
            let cost = $(element).find(':selected').data('cost');
            let shippingId = $('#shipping_method :selected').val();
            let shipping_Ass_Id = "shipping_Ass_" + shippingId;
            $('#' + shipping_Ass_Id).removeClass('d-none');


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



            } else {
                $("#next8").attr('disabled', true);
            }
}
function stayLocalPopup(element){
	         let option = $(element).filter(':selected').text();
            let country = $('option:selected', element).attr('data-country');
            if (option != 'Select'  &&  option != 'No, Thank you' ) {
                    $(".popupTitle").empty();
                    $(".popupTitle").text("Stay local Number");
                    $(".popupDesc").empty();
                    $(".popupDesc").append("<p style='font-size: 16px; margin-bottom: 20px;'>Land in Israel and still receive calls from your " + country + " number!  </p><p style='font-size: 16px; margin-bottom: 20px;'> You can forward your " + country + " number to the virtual number you will receive with your rental confirmation! Please make sure to do so prior to your departure.</p> <p style='font-size: 16px; margin-bottom: 20px;'> If your phone does not have the 'call forwarding' option, please contact your service provider. Or, just use the number you are provided with. </p>");
                    $("#sLearnMore").click();
                
//                 $("#next6").attr('disabled', false);
            } else {
//                 $("#next6").attr('disabled', true);
            }
}
function shippingAddressChange(){
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

	function clickNext1(){
		$('.school-popup').text('');
		 $('#next1').click();
		closePopup('#wrap_popup1');
		
		setTimeout(function (){
			 $(".popupTitle").removeClass('d-none');
			$('.popupclose').removeClass('d-none');
		},1000);
	}
function zipCodeValidate(e){
		 let regex = new RegExp("^[a-zA-Z0-9\- ]+$");
    let  str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
			else{
				return false;
			}
}

function validateCreditCard(element){
			$(element).parent().find('.cardNumError').text('');
         let  myCardNo = $(element).val();
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
			$(element).parent().find('.cardNumError').text('');
			}
			 else{
				  $(element).parent().find('.cardNumError').text('Enter a valid card Number');
			 }
   }
			 else{
				  $(element).parent().find('.cardNumError').text('Enter a valid card Number');
			 }
}
function validateExpiryDate(element){
		$('.errorExpiry').text('');
            let expiryDate = $(element).val();
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
}
function sortDates(a, b)
{
    return a.getTime() - b.getTime();
}
function findMindate(){
	var dates = [];
	$('.begin_date').each(function (){
	let currentbeginDate = $(this).datepicker("getDate");
		console.log('currentdate', currentbeginDate);
	 dates.push(new Date(currentbeginDate));
	});

var sorted = dates.sort(sortDates);
var minDate = sorted[0];
	
	 var today = new Date();
var dd = String(minDate.getDate()).padStart(2, '0');
var mm = String(minDate.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = minDate.getFullYear();

minDate = mm + '/' + dd + '/' + yyyy;
	$('.minDate').text(minDate);
	console.log('mindate', minDate);
	
}
function validateEmail(element){
	 var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            var testEmail = emailReg.test($(element).val());
            if (testEmail === false) {
               $(element).parent().find('.invalidEmail').text('Invalid email');
            } else {
                $('.invalidEmail').text('');
            }
}
function accPopoup(element){
		let desc = $(element).attr('data-popup');
            let title = $(element).attr('data-title');
            $(".popupTitle").empty();
            $(".popupDesc").empty();
            $(".popupTitle").append(title);
            $(".popupDesc").append(desc);
            openPopup('#wrap_popup2');
		}
 function billing_phone(element){
	  let p = '<?php echo $p ?>';
		 let phoneNum = $(element).val();
		 
		 p=$.trim(p);
		 if(p=='bhlt'){
			 $("[name='whatspapp_num']").val(phoneNum);
			}
	 }
 function ValidateSimNum(element){
	$(element).val(function (index, value) {
                    return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
                });
                let existing_phone = $(element).val();
                let existing_div = $(element);
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
 }

	function AddPhoneSelectBox(element){
			var parent= findParent(element);
			var wantSim = $(element).val();
			var parentDiv=findParentDiv(element);
			if(wantSim=="no"){
				$(parentDiv).find('.rentDefaultClone').removeClass('d-none');
			}else{
				$(parentDiv).find('.rentDefaultClone').addClass('d-none');
			}
		}
function set_date(){
	$('[data-toggle="datepicker"]').datepicker({
            minDate: 0,
            dateFormat: 'mm/dd/yy'
        });
}

    function findParent(element) {
            var parentElement = $(element).parent();
            for (var i = 0; i < 12; i++) {
                if ($(parentElement).hasClass('parent')) {
                    return parentElement;
                } else {
                    parentElement = $(parentElement).parent();
                }
            }
        }
		 function findParentDiv(element) {
            var parentElement = $(element).parent();
            for (var i = 0; i < 12; i++) {
                if ($(parentElement).hasClass('parentDiv')) {
                    return parentElement;
                } else {
                    parentElement = $(parentElement).parent();
                }
            }
        }

        function Date_Validate(element) {
            var parent =  $(element).closest('.parentDiv');
			 var parentDateAndMonth = $(element).closest('.parent');
            let begin_date = $(parent).find('.begin_date').datepicker("getDate");
            let end_date = $(parent).find('.end_date').datepicker("getDate");

            let diifrence = new Date(end_date - begin_date);
            let minDaysOrMonth = $(parentDateAndMonth).attr('min_period');
            let days = diifrence / 1000 / 60 / 60 / 24;
            days = days + 1;
            let month = days / 30;
            let maxDaysOrMonth = $(parentDateAndMonth).attr('max_period');


            minDaysOrMonth = minDaysOrMonth.split('|');
            maxDaysOrMonth = maxDaysOrMonth.split('|');
            minDaysOrMonth[0] = parseInt(minDaysOrMonth[0]);
            maxDaysOrMonth[0] = parseInt(maxDaysOrMonth[0]);

            if (minDaysOrMonth[1] == "d" && maxDaysOrMonth[1] == "d") {
                if (days < minDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The minimum rental period is ' + minDaysOrMonth[0] + ' days.');
                    return false;
                } else if (days > maxDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The maximum rental period is ' + maxDaysOrMonth[0] + ' days.');
                    return false;
                } else {
                    $(parent).find('.error_day').text('');
                }
            } else if (minDaysOrMonth[1] == "d" && maxDaysOrMonth[1] == "m") {
                if (days < minDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The minimum rental period is ' + minDaysOrMonth[0] + ' days.');
                    return false;
                } else if (month > maxDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The maximum rental period for this group is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else {
                    $(parent).find('.error_day').text('');
                }
            } else if (minDaysOrMonth[1] == "m" && maxDaysOrMonth[1] == "m") {
                if (month < minDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The minimum rental period is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else if (month > maxDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The maximum rental period is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else {
                    $("#next1").attr('disabled', false);
                    $(parent).find('.error_day').text('');
                }
            } else if (minDaysOrMonth[1] == "m" && maxDaysOrMonth[1] == "d") {
                if (month < minDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The minimum rental period is ' + minDaysOrMonth[0] + ' month.');
                    return false;
                } else if (days > maxDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The maximum rental period is ' + maxDaysOrMonth[0] + ' days.');
                    return false;
                } else {
                    $("#next1").attr('disabled', false);
                    $('.error_day').text('');
                }
            } else {
                if (days < minDaysOrMonth[0]) {
                    $(parent).find('.error_day').text('The minimum rental period is ' + minDaysOrMonth[0] + ' days.');
                    return false;
                }
            }

        }

function datechbxChange(element){
			var	parent = $(element).closest('.parent');
            if ($(element).prop("checked")) {
                 $(parent).find('.hiddenOrderNum').empty();
				$(parent).find('.cloneDate').remove();
                return;
            } else {
                let clone = $(element).data('orderqty');
				clone=parseInt(clone);

                clone = clone - 1;
                if (clone > 0) {
                     $(parent).find('.hiddenOrderNum').text('for Order #1');
                }
//         let orderNo = parent.find('.equipmentSim:checked').attr('orderno');
                for (i = 0; i < clone; i++) {
                    var dateClone =  $(parent).find('.cloneDateDefault').clone();
                    $(dateClone).attr('class', 'cloneDate  parentDiv');
                    $(dateClone).find('.hiddenOrderNum').text('for Order #' + (i + 2));
					$(dateClone).find('input.hasDatepicker').removeClass('hasDatepicker').removeAttr('id').datepicker({
            minDate: 0,
            dateFormat: 'mm/dd/yy'
        });
					$(dateClone).find('input.hasDatepicker').attr('onchange','Date_Validate(this)');
                     $(parent).find('.cloneDateDefault').parent().append(dateClone);
// 					 $(dateClone).find('.validateDate').siblings('.ui-datepicker-trigger,.ui-datepicker-apply').remove();
// 					 $(dateClone).find('.validateDate').removeClass('hasDatepicker').removeData('datepicker').unbind().datepicker();;
// 					 $(parent).find('input').unbind('click').click(function(){
// 			validateDate(this);
// 		});
                }
            }
	appendCheckBox(element)
}
		
		function AddSimInputBox(){
			var parent= findParent(element);
			let simNoAppend = $(element).closest('.form-group');
			var simInputHtml='<div class="simNoclone mt-2"><div class="title" style="margin-bottom: 18px;"><h2>Enter Your 19 Digit SIM card <span class="simOrderNum"> </span></h2></div><div class="form-group"><div class="form-group"><div class="input-group mb-2"><div class="input-group-prepend" style="height: 57.5px;"><div class="input-group-text">89972</div></div><input type="text" name="existing_phone" style=" width:80%;border-left: 0px;border-radius: 0px;margin-bottom: 0px !important;" maxlength="17" class="existing-phone" placeholder="0000 0000 0000 0000 0"><p class="eSimNum" style="font-size:12px; color:red;  margin: 0px; "> </p><p class="simNoValue" style="font-size:12px; color:red;  margin: 0px; "> </p></div></div></div></div>';
			var equipName = $(element).data('name');
			var parentDiv=findParentDiv(element);
			let orderqty=$(element).closest('.parent').find('.simCheckBox').data('orderqty');
			if (orderqty === undefined){
				orderqty=1;
				}
			let simchbox = $(element).closest('.parent').find('.simCheckBox').prop('checked');
		 if(equipName=="Already have a TalkNSave SIM card?"){
			 if(simchbox == false){
				orderqty=1;
				}
			 for(i=0; i<orderqty; i++){
				 $(simNoAppend).append(simInputHtml);
				
				 $('.existing_phone').on('keypress change', function () {
                ValidateSimNum(this);
            	});
			 }
				 if(orderqty > 1){
				    $(simNoAppend).find('.simOrderNum').each(function (index) {
						$(this).text('for order #' + (index + 1))
					});
				   }
			}else{
				$(parentDiv).find('.simNoclone').remove();	
			}
			
		}