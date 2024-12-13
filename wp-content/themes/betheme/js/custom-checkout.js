	var orderCount=$("#qsqty").val();  
  var maximumPeriod =$('.maximumPeriod').val();
    var DataMinDaysOrMonth =$('.DataMinDaysOrMonth').val();
    var staticStaylocalTitle =$('.staticStaylocalTitle').val();
    var dataInsurance =$('.insurance').val();
    var dataSms =$('.datasms').val();
    var dataCall =$('.dataCall').val();
    var dataData =$('.dataData').val();
    var singleSimPrice =$('.singleSimPrice').val();
    var bundlePeriod =$('.bundlePeriod').val();
    var planName =$('.planName').val();
    var setupFeeCost =$('.setupFeeCost').val();
    var covidSignUpFees =$('.covidSignUpFees').val();
    var callPackageCode =$('.callPackageCode').val();
    var contractType =$('.contractType').val();
    var linkTypeCode =$('.linkTypeCode').val();
    var sessionID =$('.sessionID').val();
    var agentCode =$('.agentCode').val();
    var bundleCounter =$('.bundleCounter').val();
    var companyCode =$('.companyCode').val();
    var extendedDataPackageCode =$('.extendedDataPackageCode').val();
    var packageSize =$('.packageSize').val();
    var depositAmount =$('.depositAmount').val();
    var haveSimEquipmentCode =$('.haveSimEquipmentCode').val();
    var parentLink =$('.parentLink').val();
    var dataPlanCode =$('.dataPlanCode').val();
    var bundlePlanName =$('.bundlePlanName').val();
    var smsPackageCode =$('.sMSPackageCode').val();
    var subLink =$('.subLink').val();
    var dataCounter =$('.dataCounter').val();
    var adminComment =$('.adminComment').val();
    var providerCode =$('.providerCode').val();
    providerCode = parseInt(providerCode);
	linkTypeCode=parseInt(linkTypeCode);
  agentCode=parseInt(agentCode);
  bundleCounter = parseInt(bundleCounter);
 callPackageCode = parseInt(callPackageCode);
 companyCode = parseInt(companyCode);
extendedDataPackageCode = parseInt(extendedDataPackageCode);
smsPackageCode=parseInt(smsPackageCode);
dataPlanCode=parseInt(dataPlanCode);
dataCounter=parseInt(dataCounter);


   var SetupFeeText =$('.setupFeeText').val();
	$("#qsqty").val();
    function openPopup(divPopup) {
        $(divPopup).fadeIn(250);
    }

    function closePopup(divPopup) {
        $(divPopup).fadeOut(250);
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
                if (($('#bonus-optional').length) || $('#' + shipping_Ass_Id).length) {
                    next = nextId.closest('fieldset').next('fieldset').attr('id');
                } else {
                    next = nextId.closest('fieldset').next('fieldset').next('fieldset').attr('id');
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
	  
if(busValue !=''){
   	  if(busValue == linkId ){
		 return 
		 }
	  else {
		  let url ="?b="+b+"&linkid="+linkId+"&qty="+qty+"";
		 window.location=url;
// 		  location.reload();
	  }
   }
	  
	  
  });
		
        $('#credit-card').on('keypress  change', function () {
            $(this).val(function (index, value) {
                return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
            });

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

        $('#expiry-date').on('keypress  change', function () {
            let expiryDate = $(this).val();
            if (expiryDate.length == 2) {
                $("#expiry-date").val($("#expiry-date").val() + "/");
            }
        });
		$('#expiry-date').on('blur', function () {
			$('.errorExpiry').text('');
            let expiryDate = $(this).val();
         let monthYear=  expiryDate.split('/');
			let today = new Date();
			let currentYear = new Date().getFullYear().toString().substr(-2);
			let currentMonth = String(today.getMonth() + 1).padStart(2, '0');
			if(parseInt(monthYear[0]) > 12){
			$(this).parent().find('.errorExpiry').text('Please enter valid Expiry date ex. 05/25');
			 }
			else if ( parseInt(monthYear[1]) < parseInt(currentYear)  ) {
			$(this).parent().find('.errorExpiry').text('Please enter valid Expiry date ex. 05/25');
				
			
			}
			 else if (  parseInt(monthYear[1]) == parseInt(currentYear) &&  parseInt(monthYear[0]) < parseInt(currentMonth) ){
					 $(this).parent().find('.errorExpiry').text('Please enter valid Expiry date ex. 05/25');
			 }
			
			else{
				 let expiryMmAndYy = expiryDate.split('/');
			let expiryMonth = expiryMmAndYy[0];
				if(expiryMonth < 10  && expiryMonth.length <2 ){
				   expiryMonth = 0 + expiryMonth;
					$(this).val(expiryMonth+'/'+ expiryMmAndYy[1]);
				   }
				
			}
		
        });

      

        $('.shipping_option').find('input[type=radio]').on('change', function () {
		//	console.log("shipping_option");
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
            let minDaysOrMonth = DataMinDaysOrMonth;
            let days = diifrence / 1000 / 60 / 60 / 24;
            days = days + 1;
            let month = days / 30;
            let maxDaysOrMonth = maximumPeriod;


            minDaysOrMonth = minDaysOrMonth.split('|');
            maxDaysOrMonth = maxDaysOrMonth.split('|');
            minDaysOrMonth[0] = parseInt(minDaysOrMonth[0]);
            maxDaysOrMonth[0] = parseInt(maxDaysOrMonth[0]);

            if (minDaysOrMonth[1] == "d" && maxDaysOrMonth[1] == "d") {
                if (days < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental period for this group is ' + minDaysOrMonth[0] + ' days.');
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
                    $('#error_day').text('The minimum rental period for this group is ' + minDaysOrMonth[0] + ' days.');
                    return false;
                } else if (month > maxDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The maximum rental period for this group is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else {
//                     $("#next1").attr('disabled', false);
                    $('#error_day').text('');
                }
            } else if (minDaysOrMonth[1] == "m" && maxDaysOrMonth[1] == "m") {
                if (month < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental period for this group is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else if (month > maxDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The maximum rental period for this group is ' + maxDaysOrMonth[0] + ' month.');
                    return false;
                } else {
                    $("#next1").attr('disabled', false);
                    $('#error_day').text('');
                }
            } else if (minDaysOrMonth[1] == "m" && maxDaysOrMonth[1] == "d") {
                if (month < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental period for this group is ' + minDaysOrMonth[0] + ' month.');
                    return false;
                } else if (days > maxDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The maximum rental period for this group is ' + maxDaysOrMonth[0] + ' days.');
                    return false;
                } else {
                    $("#next1").attr('disabled', false);
                    $('#error_day').text('');
                }
            } else {
                if (days < minDaysOrMonth[0]) {
//                     $("#next1").attr('disabled', true);
                    $('#error_day').text('The minimum rental period for this group is ' + minDaysOrMonth[0] + ' days.');
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
            $("#staylocalTitle").append(staticStaylocalTitle);
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
                $('.leaving_date').show();
                $('.shipping').change(function () {
                    $('.shipping').each(function () {
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
		//	console.log("next7 click");
            let begin_date = $('#begin_date').datepicker("getDate");
            let billing_email = $('.billing_email').val();
			let cEmail= $('.confirmBillingEmail').val();
			
            $('#date_to_leave').datepicker({
                minDate: 0,
                dateFormat: 'mm/dd/yy',
                maxDate: begin_date
            });
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
                document.body.scrollTop = 500;
                document.documentElement.scrollTop = 500;
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
			



            let begin_day = begin_date.getDate();
            let begin_month = begin_date.getMonth() + 1;
            let begin_year = begin_date.getFullYear();
            begin_date = begin_day + "/" + begin_month + "/" + begin_year;
			
			
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
			}



            $("#vatTotle").empty();
            $("#cprice").empty();
            let plan = $('input[name="equipment"]:checked').data('name');
          

            let shippingDetails = $('#shipping_method').find(":selected").text();
            let shippingName = $('#shipping_method option:selected').data('title');
            let shippingPrice = $('#shipping_method option:selected').data('cost');
            


            $('#stayLocalReview').empty();
            $("#internationalReivew").empty();

            let stay_local_amount = 0;
            let international_amount = 0;


            for (i = 0; i < orderCount; i++) {
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

                if (stayrateIndex != -1  && (typeof stayLocalValue !== "undefined") ) {
                    let stayTitlePrice = "<div class='row'> <div class='col-md-6 col-8'> " + stayLocalValue + "  </div><div class='col-md-6 col-4  text-right font-weight-bold ' > " + stay_localWithDoller + " </div></div>";
                    $('#stayLocalReview').append(stayTitlePrice);
                }
                if (internationaIndex != -1 && (typeof internationalValue !== "undefined")) {
                    let internationalTitlePrice = "<div class='row'> <div class='col-md-6 col-8'> " + internationalValue + "  </div><div class='col-md-6  col-4 text-right font-weight-bold ' > " + internationalWithDoller + " </div></div>";
                    $("#internationalReivew").append(internationalTitlePrice);
                }

            }



            let accTotal = $('#accFinalAmount').text();
			accTotal=accTotal.trim();
            accTotal = (accTotal) ? accTotal : '0';


           

            $('.OrderDetailsClone').remove();
            let clone = orderCount;



            let bundleRate = singleSimPrice;
            let bundleRateFloat = parseFloat(bundleRate);

			 let simPrice = 0;
			let simPricePerDayOrMonth;
          
			
		
			   if(bundlePeriod.includes('/day')  &&  days ){
				simPricePerDayOrMonth =  parseFloat(days) * parseFloat(singleSimPrice);
				 }
				  else if (bundlePeriod.includes('/month') &&  month){
				   simPricePerDayOrMonth = parseFloat(month) * parseFloat(singleSimPrice);
			   }
				else{
					simPricePerDayOrMonth = parseFloat(singleSimPrice) ;
				}
			   
			 let equipmentcost=0;
			
            for (i = 0; i < orderCount; i++) {
              
				 let equipment = 'equipment';
						if(i>0){
						   equipment = equipment + i;
						  }
				  let EquipmentName= '';
				let equipmentcost=0;
				
					if($('#simCheckBox').prop('checked') == true){
				   EquipmentName= $('input[name="equipment"]:checked').data('name');
					
						if(EquipmentName.indexOf('$') > 0){
					let equipmentCostIndex = EquipmentName.indexOf('$');
                  equipmentcost = EquipmentName.slice(equipmentCostIndex).trim().split(' ')[0];
                    equipmentcost = equipmentcost.substr(1);
							equipmentcost=parseFloat(equipmentcost)
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
			 
			     
			
             simPrice = parseFloat(simPricePerDayOrMonth) + parseFloat(simPrice)+parseFloat(equipmentcost);
				

                var clonePlanDetails = $('.multipleOrderDefault').clone();

                $(clonePlanDetails).attr('class', 'OrderDetailsClone');
                $(clonePlanDetails).removeClass('d-none');
				 EquipmentName = EquipmentName.replace("?", '');
				 equipmentcost =parseFloat(equipmentcost);
				$(clonePlanDetails).find('.planPriceDiv').addClass('border-bottom');
				$(clonePlanDetails).find('.planPriceDiv').css('padding-bottom',"13px;");
				$(clonePlanDetails).find('.planPrice').text( '$' + simPricePerDayOrMonth);
				if( equipmentcost > 0){
					$(clonePlanDetails).find('.planPriceDiv').removeClass('border-bottom');
					$(clonePlanDetails).find('.planPriceDiv').removeAttr('style');
					
				    $(clonePlanDetails).find('.equipmentPriceDiv').removeClass('d-none');
					$(clonePlanDetails).find('.equipmentPrice').text('$'+equipmentcost);
				   }
				
					planName = planName.replace("<br />",' ');
				planName =planName.replace("<br>" ,' ');
				$(clonePlanDetails).find('.planName').text(planName);
                $(clonePlanDetails).find('.cplan').text(EquipmentName);
				
                $('.multipleOrderDefault').parent().append(clonePlanDetails);



            }
           
        

			
            SetupFeeText =parseFloat(SetupFeeText);
			
			SetupFeeText = $.trim(SetupFeeText);
		    SetupFeeText = SetupFeeText.replace('@SetupFeeCost',SetupFeeText)
			var qsqty = $("#qsqty").val();
			
			if(setupFeeCost != 0 &&  SetupFeeText){
				
			   $('.setup').removeClass('d-none');
				if (qsqty > 1) {
                setupFeeCost = setupFeeCost * parseInt(qsqty);
            }
				$('#setupFeeText').text(SetupFeeText);
				$('#setupFeeCost').text( '$' + setupFeeCost);
			   }

//             console.log(qsqty);
            if (qsqty > 1) {
                shippingPrice = (shippingPrice * 75) / 100;
            }
			
			 shippingPrice = shippingPrice * orderCount; 
            let totalWithoutVat = parseFloat(simPrice)  + parseFloat(accTotal) + parseFloat(stay_local_amount) + parseFloat(international_amount) + parseFloat(setupFeeCost);
            let vat = (totalWithoutVat * 17) / 100;
            let total = parseFloat(totalWithoutVat) + parseFloat(vat)  + parseFloat(shippingPrice);
            total = total.toFixed(2);
            vat = vat.toFixed(2);

$('#stayLocalReview div').first().css( "margin-top", "15px" );
			$('#internationalReivew div').first().css( "margin-top", "15px" );

//             $(".cplan").text(plan);
           shippingPrice = parseFloat(shippingPrice); 
          
			
            
			covidSignUpFees = parseFloat(covidSignUpFees); 
			covidSignUpFees = covidSignUpFees *orderCount;
			let extra_fees = parseFloat(shippingPrice) + parseFloat(covidSignUpFees);
            $('#covidSignUpFees').text(extra_fees);
            $("#cprice").text(total);
            $("#cname").text(name);
            $("#cemail").text(email);
            $("#cnumber").text(phone);
            $(".cdate").text(dateString);
            $("#cprice").text(total);
            $(".data").text(dataData);
            $("#vatTotle").text(vat);
            $(".sms").text(dataSms);
            $(".call").text(dataCall);
            $("#shippingName").text(shippingName);
            if (shippingPrice === 0) {
                $("#shippingPrice").text("Free");
            } else {
                shippingPrice = shippingPrice.toString();
                shippingPrice = "$" + shippingPrice;
                $("#shippingPrice").text(shippingPrice);
            }

            if (dataInsurance) {
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
                    let acc = "<div class='row border-bottom pb-2'><div class='col-md-9 opsAddOnDD' style='display: flex; align-items: center;'>  <img class='opsAddOn_imgDD' src=" + image + " alt=''  style='max-width: 65px;'> <span class='opsAddOn_titleDD' style='margin-left:11px;     width: 195px;'> " + title + "  &nbsp; &nbsp; &nbsp; </span>   <small> " + qty + "&nbsp; x </small> <span > &nbsp; " + price + " </span>  </div><div class='col-md-3 text-right font-weight-bold '> $" + singleAmount + " </div> </div>	"
                    $('#accCart').append(acc);


                }

            });
            $('#accFinalAmount').text(finalAmount);

        })

        $('.simPopup').click(function () {
		let popupData=$(this).data('popup');
            $(".popupTitle").empty();
            $(".popupDesc").empty();
			if($(this).attr('id') == '2510' ){
				            $(".popupTitle").text("Network Capabilities");
            $(".popupDesc").append("<div style='font-size:16px;'>Important: Your phone must be unlocked by your wireless provider back home and have the proper 3G and 4G network capabilities.<br>To learn more about unlocking your phone, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone' target='_blank' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/unlock-phone/'); return false;'>click here</a>.<br>To learn more about phone compatibility, <a href='https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible' target='_blank' onclick='window.open('https://wordpress-944064-3284364.cloudwaysapps.com/knowledge-base/can-tell-phone-compatible/'); return false;'>click here</a>.<br><br></div><img src='https://dev.newedgedesign.com/talknsave/wp-content/uploads/2021/05/multisim.png' alt='multisim' width='100%'>");
			}
			else{
				$(".popupDesc").append(popupData);
			}
			

            openPopup('#wrap_popup2');
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
        $('#cloneCheckBox').change(function () {

            if ($(this).prop("checked")) {
                $('.cloneSim').remove();
                $('.hiddenOrderNum').empty();
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
                    $('.cloneSim').find('.icon-info-circled').remove();
                    $('.cloneSim').find('.PhoneSimInfo').remove();

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
				 
else if ( shippingID != "-1" &&  (eqipmentId == "2550"  && (shippingID != "1" && shippingID != "3" && shippingID != "7" && shippingID != "9" && shippingID != "12" && shippingID != "23")) || ( isKoshar && (shippingID != "2" && shippingID != "12" && shippingID != "9" && shippingID != "23" && shippingID != "69" && shippingID != "24") ) ){
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
					let simNoCount = 0; 
			$('.simCount').each( function (index) {
			let simvalue =$(this).find('input:checked').val();
				console.log(simvalue);
			});
					 
					 
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
        

        let shippingCity = $('input[name="shipping_city"]').val();
        let shipping_country = $('#shipping_method :selected').parent().attr('label');
        shipping_country = shipping_country.trim();
        let shippingName = $('#shipping_method :selected').attr('data-title');
        let shipMethod = $('#shipping_method :selected').attr('shipmethod');
        let shippingCost = $('#shipping_method :selected').data('cost');

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
        ob.ContractType = contractType;
        ob.ProviderCode =providerCode;
		
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
        ob.LinkTypeCode =linkTypeCode;
        ob.ccemail = paymentEmail;
        ob.SessionID = sessionID;
        ob.AgentCode =agentCode;
        ob.BaseCode = basecode;
        ob.BaseNotes = shippingNotes;
        ob.bitCallPackageOverageProtection = false;
        ob.BundleId =bundleCounter;
        ob.CallPackageCode = callPackageCode;

        ob.CallPackageName = dataCall;
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

        ob.CompanyCode =companyCode;

        ob.CouponCode = '';
        ob.CreditEquipmentPurchase = null;
        let customerComment = $("[name='cc_note']").val();
        ob.CustomerComment = customerComment;
        ob.DataPackageCode =extendedDataPackageCode;
        ob.DataPackageId =extendedDataPackageCode;
        ob.DataPackageName = dataData;
        ob.DataPackgeSize = packageSize;
        ob.DepartureDate = start_date;
        ob.Deposit = depositAmount;
		
			
		
	  let begin_date = $('#begin_date').datepicker("getDate");
	    let end_year  = new Date(begin_date).getFullYear();
      let end_month = new Date(begin_date).getMonth();
      let end_day   = new Date(begin_date).getDate();
     let endDate  = new Date(end_year + 10, end_month, end_day);
		
	 let endDateStr = ((endDate.getMonth() > 8) ? (endDate.getMonth() + 1) : ('0' + (endDate.getMonth() + 1))) + '/' + ((endDate.getDate() > 9) ? endDate.getDate() : ('0' + endDate.getDate())) + '/' + endDate.getFullYear();
		
		endDateStr = endDateStr + " 12:00:00 AM" ;
  ob.EndDate= (maximumPeriod) ? end_date : endDateStr ;
		
//         ob.EndDate = end_date;
        ob.EquipmentCode =haveSimEquipmentCode;
        ob.EquipmentModel = $('input[name="equipment"]:checked').val();
        ob.EquipmentName = $('input[name="equipment"]:checked').data('name');
        ob.EquipmentNotes = $('input[name="equipment"]:checked').attr('notes');
        ob.FirstName = fname;
        ob.GroupMemberID = "";
		let groupName = $('.bus').find(':selected').val()
        ob.GroupName =  groupName ? groupName: null ; 
        ob.Hint = null;
       
        ob.Insurance = (dataInsurance) ? true : false;
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
        ob.ParentLink = parentLink;
        ob.ParentOnlineOrderCode = null;
        var phoneReq = $.trim($('#numberOfOrders').text());

//   ob.PhonesRequired= ($('#rental').is(':checked')) ? 1 : 0 ;
        ob.PhonesRequired = orderCount;
        ob.PlanCode =dataPlanCode;
        ob.PlanName =bundlePlanName;
        ob.ProductId = 1;
        ob.PurchaseEquipment = false;
        ob.ReferrerCounter = null;
        ob.ReferrerEmail = "";
        ob.RentalCode = null;
        ob.SetupFeeText = "No";
		
		if($('.shipping_option').hasClass('d-none')){
			ob.ShipCity ="[pickup]";
        ob.ShipCommercial = false;
        ob.ShipCountry =shipping_country;
        ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
        ob.shipemail =ob.clientemail;
        ob.ShipFee = shippingCost;
        ob.ShipId = shippingId;
        ob.ShipMethod = shipMethod;
		let shippingNameInput = ob.ClientFirstName+' '+ob.ClientLastName;
        ob.ShipName = (shippingNameInput) ? shippingNameInput :shippingName;
        ob.ShipPhone = ob.ClientHomePhone1;

        ob.ShippingName =(shippingName) ? shippingName : "[pickup]";
        ob.ShipPostalCode = "[pickup]";
        ob.ShipState = "NA";
        ob.ShipStreet = "[pickup]" ;
		}
		else{
			if($("input[name='shipping_address']").val() == 'yes'  ) {
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
		
		
		
        
        ob.SMSPackageCode =smsPackageCode;
        ob.SMSPackageCounter =smsPackageCode;
        ob.SMSPackageName = dataSms;
        ob.Special = false;
        ob.StartDate = start_date;
        ob.SubLink = subLink;
        ob.SublinkId =dataCounter;
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
        ob.Tag = tags;
		
        ob.TermsCode = -1;
        ob.TermsName = null;
        ob.UserName = fname + " " + lname;
     	let schoolName= $('.schoolName').val();
		schoolName = (schoolName) ? schoolName : '';
        ob.UserStreet= (schoolName) ? schoolName : adminComment;
		
		
		
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
            SimDetails.CallPackageCode =callPackageCode;
            SimDetails.curST_TOP_Price = 0.0;
            SimDetails.DataPackageCode =extendedDataPackageCode;
            SimDetails.DataPackageId =extendedDataPackageCode;
            SimDetails.DataPackageName = dataData;
            SimDetails.DataPackgeSize = packageSize;
            SimDetails.decST_TOP_GB = 0.0;
   

           if($('#simCheckBox').prop('checked') == true){
			   let EquipmentCode=$('input[name="equipment"]:checked').val();
			   let EquipmentModel=$('input[name="equipment"]:checked').val();
			   let EquipmentName=$('input[name="equipment"]:checked').data('name');
			   
			   if(EquipmentCode == '9999'){
				  EquipmentCode='2510';
				  EquipmentModel='2510';
				  }
			    SimDetails.EquipmentCode = EquipmentCode;
                 SimDetails.EquipmentModel = EquipmentModel;
                 SimDetails.EquipmentName = EquipmentName;
			  }
                   
                       
                     else {
					 let equipment = 'equipment';
						if(i>0){
						   equipment = equipment + i;
						  }
						
			   let EquipmentCode=$('input[name="' + equipment+'"]:checked').val();
			   let EquipmentModel=$('input[name="' + equipment+'"]:checked').val();
			   let EquipmentName= $('input[name="'+equipment +'"]:checked').data('name');
			    isSim = $('input[name="'+equipment +'"]:checked').attr('issim');
			    IsSns = $('input[name="'+equipment +'"]:checked').attr('issns');
                koshar = $('input[name="'+equipment +'"]:checked').attr('kosher');
                isSim=$.trim(isSim);
			   if(EquipmentCode == '9999'){
				  EquipmentCode='2510';
				  EquipmentModel='2510';
				  }
						 
                        SimDetails.EquipmentCode = EquipmentCode ;
                        SimDetails.EquipmentModel =EquipmentModel ;
                        SimDetails.EquipmentName =EquipmentName ;
						}
                        SimDetails.EquipmentNotes = shippingNotes;
                        SimDetails.Img = "https://www.talknsave.us/images/OneSimForall.jpg";
                        SimDetails.Insurance = (dataInsurance) ? true : false;
                        SimDetails.IsEquipmentSNS = (IsSns) ? true : false;
                        SimDetails.IsKosher = (koshar) ? true : false;
                        SimDetails.IsRequiredOperationSystem = false;
                        SimDetails.IsSIM = (isSim) ? true : false;
                        SimDetails.SMSPackageCode =smsPackageCode;
                        SimDetails.SMSPackageCounter =smsPackageCode;
                       
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

