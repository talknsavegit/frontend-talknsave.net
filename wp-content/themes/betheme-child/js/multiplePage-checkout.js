function simPopup(element) {
  let popupData = $(element).data("popup");
  $(".popupTitle").empty();
  $(".popupDesc").empty();
  if ($(element).attr("id") == "2510") {
    $(".popupTitle").text("Network Capabilities");
    $(".popupDesc").append(
      "<p style='font-size: 17px;font-weight: bold;margin-left: 0;color: #23346c;'>Your smartphone must be compatible with a physical SIM card. eSIM only phones, such as a US purchased iPhone 14, will not be compatible.</p><div style='font-size:16px;'>Important: Your phone must be unlocked by your wireless provider back home and have the proper 3G and 4G network capabilities.<br>To learn more about unlocking your phone, <a href='/unlock-phone' class='d-inline-block mt-0' target='_blank' onclick='window.open('https://www.talknsave.net/unlock-phone/'); return false;'>click here</a>.<br>To learn more about phone compatibility, <a href='/knowledge-base/can-tell-phone-compatible' class='d-inline-block mt-0' target='_blank' onclick='window.open('https://www.talknsave.net/knowledge-base/can-tell-phone-compatible/'); return false;'>click here</a>.<br><br></div> <div class='d-flex justify-content-center'><img style='max-width:80%' src='/wp-content/uploads/2021/05/multisim.png' alt='multisim' width='100%'></div> <div  onclick='closeNetworkPopup()' style='padding: 5px;' class='popup-footer okbtn'> Next</div>"
    );

    $(".popup-footer").text("Cancel");
  } else {
    $(".popupDesc").append(popupData);
  }
if ($(element).attr("id") == "3290"  || $(element).attr("id") == "3380"  || $(element).attr("id") == "3390") {
            $("#wrap_popup2").addClass("esim");
            $(".popupTitle").text("You chose an E-sim");
            $(".popupDesc").append(
            "<div class='flex align-center esim-content-block' id='esim-content-1'><p>This product is compatible exclusively with E-sim phones. If your phone uses a physical SIM, please select SIM 3 and 1.<p><img src='/wp-content/uploads/2023/03/esim.png'></div><div id='esim-content-2' class='esim-content-block'><p><b>Important: Your phone must be unlocked by your wireless provider back home.</b><p><p style='margin-top: 20px'>To learn more about unlocking your phone, <a target='_blank' href='/unlock-phone' style='color: #000; text-decoration: underline;'>click here</p></div>"
            );
            // $(".popupDesc").append('<button type="button" class="btn btn-block" id="confrim-esim">Next <i class="icon-right-thin"></i></button>')
        }
if ($(element).attr("id") == "3190") {
	$(".popupTitle").text("Smartphone");
            $(".popupDesc").append(
            "<div class='flex align-center esim-content-block' id=''><p>Our smartphones are recent, feature-rich phones, and great durability. You can expect either a Samsung or Xiaomi model, both running on an Android-based operating system.<p></div>"
            );
}
  openPopup("#wrap_popup2");
}
function closeNetworkPopup() {
  closePopup("#wrap_popup2");
}
$("#confrim-esim").click(function(){
            closePopup("#next2");
        });
function setLeavingDate() {
  $("#date_to_leave").datepicker("destroy");
  let begin_date = $(".minDate").text();
  begin_date = $.trim(begin_date);
  $("#date_to_leave").datepicker({
    minDate: 0,
    maxDate: new Date(begin_date),
  });
}

function removeRequired(element) {
  let parent = $(element).parent();
  let value = $(element).val();
  value = $.trim(value);
  if (value) {
    $(parent).find(".dateError").text("");
  }
}
function billingCountry() {
  $(".zipCode").removeClass("d-none");
  $(".zipCode").find("input").addClass("billing");

  let billing_country = $("#billing_country").find(":selected").text();
  billing_country = billing_country.trim();
  $("#Canada_states").addClass("d-none");
  $("#USA_state").addClass("d-none");
  $("USA_state").find("select").removeClass("billing");
  $("#Canada_states").find("select").removeClass("billing");

  if (billing_country === "USA") {
    $("#USA_state").removeClass("d-none");
    $("#USA_state").find("select").addClass("billing");
  } else if (billing_country === "Canada") {
    $("#Canada_states").removeClass("d-none");
    $("#Canada_states").find("select").addClass("billing");
  } else if (billing_country === "Israel") {
    $('input[name="billing_zip"]').val("");
    $(".zipCode").addClass("d-none");
    $(".zipCode").find("input").removeClass("billing");
  }
}
function updateCountryFromShippingMethod() {
        // Assuming you have a select element for shipping methods with id="shipping_method"
        $('#shipping_method').change(function () {
            // Get the selected country from the shipping method option
            var selectedCountry = $(this).find(':selected').parent().attr('label');

            // Update the country input
            $('#shipCountry').val(selectedCountry);
        });
    }
// Toggle the visibility of the country input based on the radio button state
    function toggleCountryInputVisibility() {
        $('#differentAddressRadio').change(function () {
            if ($(this).is(':checked')) {
                $('#countryInputGroup').show();
            } else {
                $('#countryInputGroup').hide();
            }
        });
    }
    // Call the function when the document is ready
    $(document).ready(function () {
        updateCountryFromShippingMethod();
		  toggleCountryInputVisibility();
    });
function shippingMethodChange(element) {
  $(".shipping_Ass").addClass("d-none");
  let option = $("#shipping_method option").filter(":selected").text();
  let shippingTitle = $(element).find(":selected").data("title");
  let optRequireShipAddress = $(element)
    .find(":selected")
    .attr("opt-require-ship-address");
  optRequireShipAddress = $.trim(optRequireShipAddress);
  let shippingDesc = $(element).find(":selected").data("desc");
  let cost = $(element).find(":selected").data("cost");
  let shippingId = $("#shipping_method :selected").val();
  let shipping_Ass_Id = "shipping_Ass_" + shippingId;
  $("#" + shipping_Ass_Id).removeClass("d-none");

  $("#USA_stateP").addClass("d-none");
  $("#Canada_statesP").addClass("d-none");
  $(".leaving_date").hide();
  $("#USA_stateP").find("select").removeClass("shipping");
  $("#Canada_statesP").find("select").removeClass("shipping");
  $("input:radio[name=shipping_address]").prop("checked", false);
  $(".shipping_info").hide();
  $("#next8").attr("disabled", true);
	
//add  free pickup not show shipping address option
  if (optRequireShipAddress == "0") {
    $(".shipping_option").addClass("d-none");

    $(".shipping_heading").hide();
    $(".shipping_info").hide();
    $(".leaving_date").hide();
    $(".popupTitle").empty();
    $(".popupDesc").empty();
    $(".popupTitle").append(shippingTitle);
    $(".popupDesc").append(shippingDesc);
    $("#sLearnMore").click();
    $('input[name="shipping_address"]').prop("checked", false);
    $("#next8").attr("disabled", false);
  } else if (option != "Select") {
    $(".shipping_option").removeClass("d-none");
    $(".shipping_heading").show();
    $(".popupTitle").empty();
    $(".popupDesc").empty();
    $(".popupTitle").append(shippingTitle);
    $(".popupDesc").append(shippingDesc);
    $("#sLearnMore").click();
    //                 $("#next8").attr('disabled', true);

    let label = $("#shipping_method :selected").parent().attr("label");
    label = label.trim();

    if (label === "USA") {
      $("#USA_stateP").removeClass("d-none");
      $("#USA_stateP").find("select").addClass("shipping");
    } else if (label === "Canada") {
      $("#Canada_statesP").removeClass("d-none");
      $("#Canada_statesP").find("select").addClass("shipping");
    }
  } else {
    $("#next8").attr("disabled", true);
  }
}
function stayLocalPopup(element) {
  let option = $(element).filter(":selected").text();
  let country = $("option:selected", element).attr("data-country");
  if (option != "Select" && option != "No, Thank you") {
    $(".popupTitle").empty();
    $(".popupTitle").text("Stay local Number");
    $(".popupDesc").empty();
    $(".popupDesc").append(
      "<p style='font-size: 16px; margin-bottom: 20px;'>Land in Israel and still receive calls from your " +
        country +
        " number!  </p><p style='font-size: 16px; margin-bottom: 20px;'> You can forward your " +
        country +
        " number to the virtual number you will receive with your rental confirmation! Please make sure to do so prior to your departure.</p> <p style='font-size: 16px; margin-bottom: 20px;'> If your phone does not have the 'call forwarding' option, please contact your service provider. Or, just use the number you are provided with. </p>"
    );
    $("#sLearnMore").click();

    //                 $("#next6").attr('disabled', false);
  } else {
    //                 $("#next6").attr('disabled', true);
  }
}
function shippingAddressChange() {
	  var selectedOption = $.trim(
      $("#shipping_method").find(":selected").parent().attr("label")
    );

  if ($("input[name=shipping_address]:checked").val() === "yes") {
	  $(".shipping_info").hide();
	  $("#next8").attr("disabled", false);
	  if (selectedOption == "Israel") {
		  		$(".leaving_date").hide();
   $("#date_to_leave").addClass("d-none");
		  $("#next8").attr("disabled", false);
	  }
	  else{
		   $("#date_to_leave").removeClass("shipping");
    let date_to_leave = $("#date_to_leave").val();
    if (date_to_leave) {
      $("#next8").attr("disabled", false);
    }
    $(".leaving_date").show();
	$("#date_to_leave").removeClass("d-none");
    $("#date_to_leave").change(function () {
      let date_to_leave = $("#date_to_leave").value;
      if (
        date_to_leave != "" &&
        $("input[name=shipping_address]:checked").val() === "yes"
      ) {
        $("#next8").attr("disabled", false);
      }
    });
	  }
   
  } else if ($("input[name=shipping_address]:checked").val() === "no") {
    $("#date_to_leave").addClass("shipping");
    $("#next8").attr("disabled", true);
    $(".shipping_info").show();
    if (selectedOption == "Israel") {
      $(".shipping_info").find(".zipCodeValidate.shipping").addClass("d-none");
      $(".shipping_info")
        .find(".zipCodeValidate.shipping")
        .parent()
        .addClass("d-none");
			$(".leaving_date").hide();
		 $("#next8").removeAttr("disabled");
//    $("#date_to_leave").addClass("d-none");
    } else {
      $(".shipping_info")
        .find(".zipCodeValidate.shipping")
        .removeClass("d-none");
      $(".shipping_info")
        .find(".zipCodeValidate.shipping")
        .parent()
        .removeClass("d-none");
		    $(".leaving_date").show();
    $("#date_to_leave").removeClass("d-none");
    }

    $(".shipping").change(function () {
      $(".shipping:not(.d-none)").each(function () {
                 if ($(this).is(":visible") && $(this).val() === "") {
          $("#next8").attr("disabled", true);
          return false;
        } else {
          $("#next8").attr("disabled", false);
        }
      });
    });
  }
}
function isNumber(evt) {
  evt = evt ? evt : window.event;
  var charCode = evt.which ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}
function optionalAdd() {
  let validateOptional = false;
  $(".optionalAdd").each(function () {
    if ($(this).val() == "") {
      $("#next6").attr("disabled", true);
      validateOptional = false;
    } else {
      $("#next6").attr("disabled", false);
      validateOptional = true;
    }
    return validateOptional;
  });
}
function plusMinus(element) {
  let inputvalue = $(element).parent().find("input").val();
  inputvalue = parseInt(inputvalue);
  $(element)
    .parent()
    .find(".cart-qty-minus")
    .removeClass("bluebtn")
    .removeClass("greybtn");
  if (inputvalue > 0) {
    $(element).parent().find(".cart-qty-minus").addClass("bluebtn");
  } else {
    $(element).parent().find(".cart-qty-minus").addClass("greybtn");
  }
}

function clickNext1() {
  $(".school-popup").text("");
  $("#next1").click();
  closePopup("#wrap_popup1");

  setTimeout(function () {
    $(".popupTitle").removeClass("d-none");
    $(".popupclose").removeClass("d-none");
  }, 1000);
}
function zipCodeValidate(e) {
  let regex = new RegExp("^[a-zA-Z0-9- ]+$");
  let str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  if (regex.test(str)) {
    return true;
  } else {
    return false;
  }
}

function validateCreditCard(element) {
  $(element).parent().find(".cardNumError").text("");
  let myCardNo = $(element).val();
  myCardNo = $.trim(myCardNo);
  myCardNo = myCardNo.replace(/\s/g, "");
  myCardNo = myCardNo.toString();
  let myCardType = $("#cardType :selected").val();
  if (myCardNo.length > 15) {
    let pos = myCardNo.length;

    let aValue = 0;
    let bValue = 0;
    let loopLength = myCardNo.length / 2;
    for (i = 0; i < loopLength; i++) {
      // 				let a = myCardNo.charAt(pos - 1);
      // 				 let b = myCardNo.charAt(pos);
      let a;
      let b;
      let posA = pos - 2;
      let charVal = myCardNo.charCodeAt(posA);
      charVal = (charVal - 48) * 2;

      if (charVal > 9) {
        charVal = charVal - 9;
      }
      aValue += charVal;
      let posB = pos - 1;
      b = myCardNo.charCodeAt(posB);
      b = b - 48;
      bValue += b;
      pos = pos - 2;
    }$('#service_date').append('<div id="numberOfOrders" class="d-none">' + 3 + '</div>');

    let totalAB = aValue + bValue;
    if (totalAB % 10 == 0) {
      $(element).parent().find(".cardNumError").text("");
    } else {
      $(element)
        .parent()
        .find(".cardNumError")
        .text("Enter a valid card Number");
    }
  } else {
    $(element).parent().find(".cardNumError").text("Enter a valid card Number");
  }
}
function validateExpiryDate(element) {
  $(".errorExpiry").text("");
  let expiryDate = $(element).val();
  expiryDate = $.trim(expiryDate);
  let monthYear = expiryDate.split("/");
  let today = new Date();
  let currentYear = new Date().getFullYear().toString().substr(-2);
  let currentMonth = String(today.getMonth() + 1).padStart(2, "0");
  if (
    parseInt(monthYear[0]) > 12 ||
    parseInt(monthYear[1]) < parseInt(currentYear) ||
    (parseInt(monthYear[1]) == parseInt(currentYear) &&
      parseInt(monthYear[0]) < parseInt(currentMonth)) ||
    parseInt(monthYear[0]) == 0 ||
    parseInt(monthYear[1]) == 0
  ) {
    $(this)
      .parent()
      .find(".errorExpiry")
      .text("Please enter valid Expiry date ex. 05/25");
  } else if (expiryDate != "") {
    let expiryMmAndYy = expiryDate.split("/");
    let expiryMonth = expiryMmAndYy[0];
    if (expiryMonth < 10 && expiryMonth.length < 2) {
      expiryMonth = 0 + expiryMonth;
      $(this).val(expiryMonth + "/" + expiryMmAndYy[1]);
    }
  }
}
function sortDates(a, b) {
  return a.getTime() - b.getTime();
}
function findMindate() {
  var dates = [];
  $(".begin_date").each(function () {
    let currentbeginDate = $(this).datepicker("getDate");
    console.log("currentdate", currentbeginDate);
    dates.push(new Date(currentbeginDate));
  });

  var sorted = dates.sort(sortDates);
  var minDate = sorted[0];

  var today = new Date();
  var dd = String(minDate.getDate()).padStart(2, "0");
  var mm = String(minDate.getMonth() + 1).padStart(2, "0"); //January is 0!
  var yyyy = minDate.getFullYear();

  minDate = mm + "/" + dd + "/" + yyyy;
  $(".minDate").text(minDate);
  console.log("mindate", minDate);
}
function validateEmail(element) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

  var testEmail = emailReg.test($(element).val());
  if (testEmail === false) {
    $(element).parent().find(".invalidEmail").text("Invalid email");
  } else {
    $(".invalidEmail").text("");
  }
}
function accPopoup(element) {
  let desc = $(element).attr("data-popup");
  let title = $(element).attr("data-title");
  $(".popupTitle").empty();
  $(".popupDesc").empty();
  $(".popupTitle").append(title);
  $(".popupDesc").append(desc);
  openPopup("#wrap_popup2");
}
function billing_phone(element) {
  let p = "<?php echo $p ?>";
  let phoneNum = $(element).val();

  p = $.trim(p);
  if (p == "bhlt") {
    $("[name='whatspapp_num']").val(phoneNum);
  }
}

function ValidateSimNum(element) {
	
  $(element).val(function (index, value) {
    return value.replace(/\W/gi, "").replace(/(.{4})/g, "$1 ");
  });
	
  let existing_phone = $(element).val();
  let existing_div = $(element);
	 
  if (existing_phone && existing_phone.length >= 15) {
	  var extention_value = 0;
	 
		// Get the element with class 'existing_phone'
			var existingPhoneInput = document.querySelector('.existing_phone1');
	// 		var inputGroupTextValue = this.closest('.input-group').querySelector('.input-group-text').textContent;
			var inputGroupTextValue = $(element).closest('.input-group').find('.input-group-text').text();
			  console.log(inputGroupTextValue);
			   var inputGroup = $(element).closest('.input-group');
			  var inputGroupText = inputGroup.find('.input-group-text'); 
			   var extention_value = inputGroupText.text();
			 
	 /*
			// Get the parent element with class 'input-group'
			  document.addEventListener('DOMContentLoaded', function() {
        // Get the input element by its class
        	var inputElement = document.querySelector('.existing_phone');
			console.log("inside trigers");
				// Trigger click event
				inputElement.click();

				// Trigger keyup event
				inputElement.dispatchEvent(new Event('keyup'));
				inputElement.dispatchEvent(new Event('onBlur'));
				  inputElement.dispatchEvent(new Event('keyup'));
				// Trigger change event
				inputElement.dispatchEvent(new Event('change'));
			});
	  */
    		var smNumber = existing_phone.replace(/\s/g, "");
 
		  	var num = extention_value + smNumber;
	  		var number = num.replace("89972", "");
// 	  		$(element).closest('.existing_phone').val('');
// 			var inputGroup = $(element).closest('.existing_phone').val(number);

// 	  		$(element).parent('.input-group-prepend').find('.existing_phone').val(number);
	  
		    $(element).next('.existing_phone').val(''); 
		    $(element).next('.existing_phone').val(number.replace(/\s/g, ''));

// 	   		$(".existing_phone").val(number);
	  
	  
    $.ajax({
      url:
        "/wp-content/themes/betheme-child/SimValidation.php?SimNumber="+extention_value +
        smNumber,
      type: "GET",
      success: function (result) {
        console.log(result);
        $(existing_div).parent().find(".simNoValue").text("");
        if (result != "") {
			 console.log("result");
          $(".eSimNum").each(function () {
            if ($(this).text() == "Unknown Number") {
              $("#next2").attr("disabled", true);
				
				 console.log("Unknown Number");
            }
          });
			
			// new code to click
			var emptyCount = 0;
			var emptyInputCount = 0; 
			 
			 
// 				$("#need_sim").hide();
// 				$("#optional_add_ons").show();
				  
			// new code to cick end
          $("#next2").removeAttr("disabled");
          $(existing_div).parent().find(".eSimNum").text("");
			 console.log("eSimNum"); 
// 			$("#need_sim").hide();
// 			$("#optional_add_ons").show();
			
        } else {
          $("#next2").attr("disabled", true);
          $(existing_div).parent().find(".eSimNum").text("Unknown Number");
			console.log("wn Number return");
          return;
        }
        var counter = 0;
        $(".existing_phone").each(function () {
			 console.log("wn Number .existing_phone");
          let existing_phone2 = $(this).val();
          existing_phone2 = existing_phone2.replace(/\s/g, "");
          if (existing_phone2 == smNumber) {
            counter += 1;
			    console.log("wn Number .existing_phone2 == smNumbe");
            if (counter > 1) {
              $(existing_div)
                .parent()
                .find(".eSimNum")
                .text("SIM number already entered!");
				 console.log("wn Number .existing_phone2 == smNumbe");
            } else {
              $(existing_div).parent().find(".eSimNum").text("");
				  $(existing_div).parent().find(".eSimNum").text("");
            }
          }
        });
      },
      error: function (err) {
        console.log(err);
      },
    });
  } else {
  }
}

function AddPhoneSelectBox(element) {
  var parent = findParent(element);
  var wantSim = $(element).val();
  var parentDiv = findParentDiv(element);
  if (wantSim == "no") {
    $(parentDiv).find(".rentDefaultClone").removeClass("d-none");
  } else {
    $(parentDiv).find(".rentDefaultClone").addClass("d-none");
  }
}
function set_date() {
  $('[data-toggle="datepicker"]').datepicker({
    minDate: 0,
    dateFormat: "mm/dd/yy",
  });
}

function findParent(element) {
  var parentElement = $(element).parent();
  for (var i = 0; i < 12; i++) {
    if ($(parentElement).hasClass("parent")) {
      return parentElement;
    } else {
      parentElement = $(parentElement).parent();
    }
  }
}
function findParentDiv(element) {
  var parentElement = $(element).parent();
  for (var i = 0; i < 12; i++) {
    if ($(parentElement).hasClass("parentDiv")) {
      return parentElement;
    } else {
      parentElement = $(parentElement).parent();
    }
  }
}

function Date_Validate(element) {

  var parent = $(element).closest(".parentDiv");
  var parentDateAndMonth = $(element).closest(".parent");
  let begin_date = $(parent).find(".begin_date").datepicker("getDate");
  let end_date = $(parent).find(".end_date").datepicker("getDate");
	
  let diifrence = new Date(end_date - begin_date);
  let minDaysOrMonth = $(parentDateAndMonth).attr("min_period");
  let days = diifrence / 1000 / 60 / 60 / 24;
  let timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
		console.log("timezone ",timezone);
		if(timezone != 'Asia/Jerusalem'){
			days = days + 1;	
		}
  let month = days / 30;
	
  let maxDaysOrMonth = $(parentDateAndMonth).attr("max_period");
	
  minDaysOrMonth = minDaysOrMonth.split("|");
  maxDaysOrMonth = maxDaysOrMonth.split("|");
  minDaysOrMonth[0] = parseInt(minDaysOrMonth[0]);
  maxDaysOrMonth[0] = parseInt(maxDaysOrMonth[0]);

  if (minDaysOrMonth[1] == "d" && maxDaysOrMonth[1] == "d") {
    if (days < minDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text("The minimum rental period is " + minDaysOrMonth[0] + " days.");
      return false;
    } else if (days > maxDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text("The maximum rental period is " + maxDaysOrMonth[0] + " days.");
      return false;
    } else {
      $(parent).find(".error_day").text("");
    }
  } else if (minDaysOrMonth[1] == "d" && maxDaysOrMonth[1] == "m") {
    if (days < minDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text("The minimum rental period is " + minDaysOrMonth[0] + " days.");
      return false;
    } else if (month > maxDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text(
          "The maximum rental period for this group is " +
            maxDaysOrMonth[0] +
            " month."
        );
      return false;
    } else {
      $(parent).find(".error_day").text("");
    }
  } else if (minDaysOrMonth[1] == "m" && maxDaysOrMonth[1] == "m") {
    if (month < minDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text("The minimum rental period is " + maxDaysOrMonth[0] + " month.");
      return false;
    } else if (month > maxDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text("The maximum rental period is " + maxDaysOrMonth[0] + " month.");
      return false;
    } else {
      $("#next1").attr("disabled", false);
      $(parent).find(".error_day").text("");
    }
  } else if (minDaysOrMonth[1] == "m" && maxDaysOrMonth[1] == "d") {
    if (month < minDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text("The minimum rental period is " + minDaysOrMonth[0] + " month.");
      return false;
    } else if (days > maxDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text("The maximum rental period is " + maxDaysOrMonth[0] + " days.");
      return false;
    } else {
      $("#next1").attr("disabled", false);
      $(".error_day").text("");
    }
  } else {
    if (days < minDaysOrMonth[0]) {
      $(parent)
        .find(".error_day")
        .text("The minimum rental period is " + minDaysOrMonth[0] + " days.");
      return false;
    }
  }
}

function datechbxChange(element) {
  var parent = $(element).closest(".parent");
  if ($(element).prop("checked")) {
    $(parent).find(".hiddenOrderNum").empty();
    $(parent).find(".cloneDate").remove();
    return;
  } else {
    let clone = $(element).data("orderqty");
    clone = parseInt(clone);

    clone = clone - 1;
    if (clone > 0) {
      $(parent).find(".hiddenOrderNum").text("for Order #1");
    }
    //         let orderNo = parent.find('.equipmentSim:checked').attr('orderno');
    for (i = 0; i < clone; i++) {
      var dateClone = $(parent).find(".cloneDateDefault").clone();
      $(dateClone).attr("class", "cloneDate  parentDiv");
      $(dateClone)
        .find(".hiddenOrderNum")
        .text("for Order #" + (i + 2));
      $(dateClone)
        .find("input.hasDatepicker")
        .removeClass("hasDatepicker")
        .removeAttr("id")
        .datepicker({
          minDate: 0,
          dateFormat: "mm/dd/yy",
        });
      $(dateClone)
        .find("input.hasDatepicker")
        .attr("onchange", "Date_Validate(this)");
      $(parent).find(".cloneDateDefault").parent().append(dateClone);
      // 					 $(dateClone).find('.validateDate').siblings('.ui-datepicker-trigger,.ui-datepicker-apply').remove();
      // 					 $(dateClone).find('.validateDate').removeClass('hasDatepicker').removeData('datepicker').unbind().datepicker();;
      // 					 $(parent).find('input').unbind('click').click(function(){
      // 			validateDate(this);
      // 		});
    }
  }
  appendCheckBox(element);
}

	$(document).ready(function() {
//             $('.blue_phone_link_click').click(function(event) {

				$(document).on('click', '.blue_phone_link_click', function(event) {
					event.preventDefault();

					// Find the closest parent div with class 'simNoclone' relative to the clicked link
					var simNoclone = this.closest('.simNoclone');

					// Find the child element with class 'input-group-text' within the parent 'simNoclone'
					var inputGroupText = simNoclone.querySelector('.input-group-text');

					// Check if the element is found
					if (inputGroupText) {
						// Update the content of the element  
						inputGroupText.textContent = '8997250'; // Replace 'New Value' with the desired text or number
					}
					this.closest('.simNoclone').querySelector('.existing_phone1').value = '';
					$(this).closest('.simNoclone').find('.blue_phone_link').hide();
        
					// Show the parent with class 'blue_phone_link' within the current block
					$(this).closest('.simNoclone').find('.no_blue_phone_link').show();
     

			}); 
// $(document).ready(function() {
//     $('input[name="equipment_order_0"][value="1050"]').on('change', function() {
//         if ($(this).is(':checked')) {
//             $('#shipping_method optgroup[label="USA"]').hide();
//         }else{
// 			$('#shipping_method optground[label="USA"]').show();
// 		}
//     });
// });
$(document).ready(function() {
    $('input[name="equipment_order_0"]').on('change', function() {
        if ($('input[name="equipment_order_0"][value="1050"]').is(':checked')) {
            $('#shipping_method optgroup[label="USA"]').hide();
        } else {
            $('#shipping_method optgroup[label="USA"]').show();
        }
    });
});
				$(document).on('click', '.no_blue_phone_link_click', function(event) {
					event.preventDefault();

					// Find the closest parent div with class 'simNoclone' relative to the clicked link
					var simNoclone = this.closest('.simNoclone');

					// Find the child element with class 'input-group-text' within the parent 'simNoclone'
					var inputGroupText = simNoclone.querySelector('.input-group-text');

					// Check if the element is found
					if (inputGroupText) {
						// Update the content of the element
						inputGroupText.textContent = '8997207'; // Replace 'New Value' with the desired text or number
					}
				 	this.closest('.simNoclone').querySelector('.existing_phone1').value = '';
					$(this).closest('.simNoclone').find('.no_blue_phone_link').hide();
        
        			// Show the parent with class 'blue_phone_link' within the current block
        			$(this).closest('.simNoclone').find('.blue_phone_link').show();
    

			});

        });

function AddSimInputBox(element) {
  $("#next2").removeAttr("disabled");
  var parent = findParent(element);
  let simNoAppend = $(element).closest(".form-group");
  var simInputHtml =
    '<div class="simNoclone mt-2"><div class="title" style="margin-bottom: 18px;"><h2>Enter Your 19 Digit SIM card <span class="simOrderNum"> </span></h2></div><div class="form-group"><div class="form-group"><div class="input-group mb-2"><div class="input-group-prepend" style="height: 57.5px;"><div class="input-group-text" >8997207</div></div><input type="text"  class="existing_phone1" style=" width:85%;border-left: 0px;border-radius: 0px;margin-bottom: 0px !important;" maxlength="17"  placeholder="0000 0000 0000 0000 0" ><input type="hidden" name="existing_phone" class="existing_phone" ><p class="eSimNum" style="font-size:12px; color:red;  margin: 0px; "> </p><p class="simNoValue" style="font-size:12px; color:red;  margin: 0px; "> </p></div></div></div><p id="blue_phone_link" class="blue_phone_link"> If you have a blue Pelephone SIM, <a href="#" class="blue_phone_link_click">Click Here</a></p><p  id="no_blue_phone_link" class="no_blue_phone_link" style="display:none"> If you do not have blue Pelephone SIM, <a href="#" class="button-phone"  >Click Here</a></p></div>';
  var equipName = $(element).data("name");
  var parentDiv = findParentDiv(element);
  let orderqty = $(element)
    .closest(".parent")
    .find(".simCheckBox")
    .data("orderqty");
  if (orderqty === undefined) {
    orderqty = 1;
  }
  let simchbox = $(element)
    .closest(".parent")
    .find(".simCheckBox")
    .prop("checked");
  if (equipName == "Already have a TalkNSave SIM card?") {
    $("#next2").attr("disabled", true);
    if (simchbox == false) {
      orderqty = 1;
      var isAlreadysimNoclone = $(simNoAppend).find(".simNoclone");
      if (
        isAlreadysimNoclone == null ||
        isAlreadysimNoclone == undefined ||
        isAlreadysimNoclone.length <= 0
      ) {
        $(simNoAppend).append(simInputHtml);
       $(".existing_phone1").on("keypress change keyup", function () {
            ValidateSimNum(this);
		   
          });
		  $(".existing_phone").on("keypress change keyup", function () {
            ValidateSimNum1(this);
		   
          });
		  
//         $(".existing_phone , .existing_phone1").keyup(function () {
//           ValidateSimNum(this);
//         });
      }
    } else {
      if ($(parent).find(".simNoclone").length == 0) {
        for (i = 0; i < orderqty; i++) {
          $(simNoAppend).append(simInputHtml);

          $(".existing_phone1").on("keypress change keyup", function () {
            ValidateSimNum(this);
          });
			 $(".existing_phone").on("keypress change keyup", function () {
            ValidateSimNum1(this);
          });
//           $(".existing_phone , .existing_phone1").keyup(function () {
//             ValidateSimNum(this);
//           });
        }
      }
    }

    if (orderqty > 1) {
      $(simNoAppend)
        .find(".simOrderNum")
        .each(function (index) {
          $(this).text("for order #" + (index + 1));
        });
    }
  } else {
    $(parentDiv).find(".simNoclone").remove();
  }
}
 
/*
$(document).ready(function() {
    // Attach a click event handler to the button with id #next2
    $('#next2').on('click', function() {
        // Check if the button is not disabled
        if (!$(this).prop('disabled')) {
            // Check all inputs with class .existing_phone1
            var allInputsNotNull = true;

            $('.existing_phone').each(function() {
                // Check if the value of the current input is null or empty
                if (!$(this).val()) {
                    allInputsNotNull = false;
                    return false; // Break out of the loop if a null value is found
                }
            });

            // Check the value of allInputsNotNull
            if (allInputsNotNull) {
                // Your code when the button is not disabled and all inputs are not null
                $("#need_sim").hide();
				$("#optional_add_ons").show();
                console.log('Button is not disabled, and all inputs are not null.');
            } else {
                console.log('At least one input with class .existing_phone1 is null or empty.');
            }
        } else {
            console.log('Button is disabled.');
        }
    });
});

*/


function ValidateSimNum1(element) {
	console.log("ValidateSimNum1");
  $(element).val(function (index, value) {
    return value.replace(/\W/gi, "").replace(/(.{4})/g, "$1 ");
  });
	
  let existing_phone = $(element).val();
  let existing_div = $(element);
	 
  if (existing_phone && existing_phone.length >= 13) {
 
    		var smNumber = existing_phone.replace(/\s/g, "");
	  
    $.ajax({
      url:
        "/wp-content/themes/betheme-child/SimValidation.php?SimNumber=89972"+smNumber,
      type: "GET",
      success: function (result) {
        console.log(result);
        $(existing_div).parent().find(".simNoValue").text("");
        if (result != "") {
			 console.log("result ValidateSimNum1");
          $(".eSimNum").each(function () {
            if ($(this).text() == "Unknown Number") {
              $("#next2").attr("disabled", true);
				
				 console.log("Unknown Number ValidateSimNum1");
            }
          });
			
			// new code to click
			var emptyCount = 0;
			var emptyInputCount = 0; 
				  
			// new code to cick end
          $("#next2").removeAttr("disabled");
          $(existing_div).parent().find(".eSimNum").text("");
			 console.log("eSimNum ValidateSimNum1"); 
// 			$("#need_sim").hide();
// 			$("#optional_add_ons").show();
			
        } else {
          $("#next2").attr("disabled", true);
          $(existing_div).parent().find(".eSimNum").text("Unknown Number");
			console.log("wn Number return ValidateSimNum1");
          return;
        }
        var counter = 0;
        $(".existing_phone").each(function () {
			 console.log("wn Number .existing_phone");
          let existing_phone2 = $(this).val();
          existing_phone2 = existing_phone2.replace(/\s/g, "");
          if (existing_phone2 == smNumber) {
            counter += 1;
			    console.log("wn Number .existing_phone2 == smNumbe");
            if (counter > 1) {
              $(existing_div)
                .parent()
                .find(".eSimNum")
                .text("SIM number already entered!");
				 console.log("wn Number .existing_phone2 == smNumbe ValidateSimNum1");
            } else {
              $(existing_div).parent().find(".eSimNum").text("");
				  $(existing_div).parent().find(".eSimNum").text("");
            }
          }
        });
      },
      error: function (err) {
        console.log(err);
      },
    });
  }  
}