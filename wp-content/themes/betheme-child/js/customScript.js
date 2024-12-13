jQuery(document).ready(function(){  
    jQuery(".cart-link.menu-item a").addClass("header_cart HeaderCustomCart popmake-17653");
    jQuery(".cart-link.menu-item a").append("<span class='cartOrderNumbersCount'><span>");
});
jQuery("#upto-30__btn a").click(function(e){
    e.preventDefault();
    jQuery("#upto-30__btn").addClass("active ");
    jQuery("#over-30__btn").removeClass("active");
    jQuery("#upto-30__block").attr("style", "display: block !important;")
    jQuery("#over-30__block").attr("style", "display: none !important;")
    jQuery(".hide-heading").attr("style", "display: none !important;")
    jQuery(".show-heading").attr("style", "display: block !important;")
});
jQuery("#over-30__btn a").click(function(e){
    e.preventDefault();    
    jQuery("#upto-30__btn").removeClass("active ");
    jQuery("#over-30__btn").addClass("active");
    jQuery("#upto-30__block").attr("style", "display: none !important;")
    jQuery("#over-30__block").attr("style", "display: block !important;")
    jQuery(".hide-heading").attr("style", "display: block !important;")
    jQuery(".show-heading").attr("style", "display: none !important;")
});


jQuery(".cart-link.menu-item a").click(function(e){
    e.preventDefault();
    
    OpenCart(this, 0, 0, false)
});

function findParent(element) {
    var parentElement = jQuery(element).parent();
    if (jQuery(parentElement).hasClass("parent"))
        return parentElement;
    else {
        for (var i = 0; i < 25; i++) {
            parentElement = jQuery(parentElement).parent();
            if (jQuery(parentElement).hasClass("parent"))
                return parentElement;
        }
    }
}
function changeBgColor(element){
	var parent=jQuery(element).parent().parent();
	var qtyNum=jQuery(parent).find('.qty-icon.number').text();
	qtyNum=parseFloat(qtyNum);
	
	var amtText=jQuery(".woocommerce-Price-currencySymbol:first").attr('actualPrice');
	amtText=amtText.replace('$', '');
	var amountArr = amtText.split('/');
	var amt=amountArr[0];
	
	
	var amtPerDayOrMonth=amountArr[1];
	var perDayOrMonth="";
	if(amtPerDayOrMonth){
	   perDayOrMonth= "/" + amtPerDayOrMonth;
	   };
	
	
	var finalAmt=0;
	if(jQuery(element).hasClass('minus')){
	qtyNum=qtyNum-1;	
		finalAmt=amt*qtyNum;
	}else{
		qtyNum=qtyNum+1;	
		finalAmt=amt*qtyNum;
		
	}
// 	jQuery(".number").text(qtyNum);
	if(qtyNum>0){
		jQuery(".woocommerce-Price-currencySymbol").text("$"+finalAmt.toFixed(2) + perDayOrMonth  );
	}
	
	if(qtyNum>1){
		jQuery('.qty-icon.minus').css('background-color','#181854');
	}else{
		jQuery('.qty-icon.minus').css('background-color','#c3c8d4');
	}
}
	function SetCheckoutWindow(element){
		jQuery(".number").text("1");
		if(jQuery(".number").text() > 1){
		jQuery('.qty-icon.minus').css('background-color','#181854');
	}else{
		jQuery('.qty-icon.minus').css('background-color','#c3c8d4');
	}
 		// jQuery(".checkout-btn").attr("href","https://talknsave.net/custom-checkout");
        jQuery(".checkout-btn").attr("href","/custom-multiple-checkout");
		 var parent = findParent(element);
		console.log(parent);
		var SchoolPlan=jQuery('.mainHiddenPlanData.hidden');
		var PlanPrice="";
		if(SchoolPlan.length > 0){
			var PlanData=	jQuery(SchoolPlan).find(".hidden_planData").text();
		    var PlanPrice=	jQuery(SchoolPlan).find(".hidden_planPrice").html();
		    var PlanName=	jQuery(SchoolPlan).find(".hidden_planName").html(); 
			var bID=	jQuery(SchoolPlan).find(".hidden_planBundleID").html(); 
		}else{
			var PlanData=	jQuery(parent).find(".HiddenContent").find(".hidden_data").text();
			var PlanPrice=	jQuery(parent).find(".HiddenContent").find(".hidden_price").html();
			var PlanName=	jQuery(parent).find(".HiddenContent").find(".hidden_dataname").html(); 
			var bID=	jQuery(parent).find(".HiddenContent").find(".hidden_b").html(); 
		}
	
		var LinkID=	jQuery(parent).find(".HiddenContent").find(".hidden_linkid").html(); 
        
		jQuery(".item-title").text(PlanName);
		jQuery(".item-desc").text(PlanData);
		jQuery(".qty-icon.number").text("1");
		jQuery(".qty-icon.minus").css("background-color","#c3c8d4");
		var OnlyPrice = PlanPrice.split('/');
		if(OnlyPrice[1]=="day"){
			jQuery(".woocommerce-Price-currencySymbol").text(OnlyPrice[0]+"/"+OnlyPrice[1]);
			jQuery(".woocommerce-Price-currencySymbol").attr('actualPrice',OnlyPrice[0]+"/"+OnlyPrice[1]);
		}else{
			jQuery(".woocommerce-Price-currencySymbol").text(OnlyPrice[0]);
			jQuery(".woocommerce-Price-currencySymbol").attr('actualPrice',OnlyPrice[0]);
		}
		
		var qty= jQuery(".number").text();
		var Existbtnlink=jQuery(".checkout-btn").attr("href");
		console.log(Existbtnlink);
		var path = window.location.pathname;
		try{
			path=path.replaceAll('/','');
		}catch(err){
			path="";
		}
		var CheckoutLink=Existbtnlink+"?b="+bID+"&linkid="+LinkID+"&qty="+qty+"&p="+path;
		jQuery(".checkout-btn").attr("href",CheckoutLink);
		
	}
jQuery('.plus').click(function () {
		
    	jQuery(this).parent().parent().find(".number").text(+jQuery(this).parent().parent().find(".number").text() + 1);
	 var parent = findParent(this);
		var Existbtnlink=jQuery(".checkout-btn").attr("href");
		Existbtnlink=Existbtnlink.split('&qty');
	Existbtnlink=Existbtnlink[0];
		var bID=	jQuery(parent).find(".HiddenContent").find(".hidden_b").html(); 
		var LinkID=	jQuery(parent).find(".HiddenContent").find(".hidden_linkid").html(); 
	var qty= jQuery(".number").text();
	var path = window.location.pathname;
	try{
		path=path.replaceAll('/','');
	}catch(err){
		path="";
	}
	var CheckoutLink=Existbtnlink+"&qty="+qty+"&p="+path;
		jQuery(".checkout-btn").attr("href",CheckoutLink);
});
jQuery('.minus').click(function () {
		if(jQuery(this).parent().parent().find(".number").text() > 1){
    	jQuery(this).parent().parent().find(".number").text(+jQuery(this).parent().parent().find(".number").text() - 1);
		}
	 var parent = findParent(this);
		var Existbtnlink=jQuery(".checkout-btn").attr("href");
	Existbtnlink=Existbtnlink.split('&qty');
	Existbtnlink=Existbtnlink[0];
		var bID=	jQuery(parent).find(".HiddenContent").find(".hidden_b").html(); 
		var LinkID=	jQuery(parent).find(".HiddenContent").find(".hidden_linkid").html(); 
	var qty= jQuery(".number").text();
	
	var path = window.location.pathname;
	try{
		path=path.replaceAll('/','');
	}catch(err){
		path="";
	}
	
		var CheckoutLink=Existbtnlink+"&qty="+qty+"&p="+path;
		jQuery(".checkout-btn").attr("href",CheckoutLink);
});


function CheckoutWindowGopricing(element){
	jQuery(".number").text("1");
	if(jQuery(".number").text() > 1){
		jQuery('.qty-icon.minus').css('background-color','#181854');
	}else{
		jQuery('.qty-icon.minus').css('background-color','#c3c8d4');
	}
		 var parent = findParent(element);
// 	var PlanData=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_data").text();
// 		var PlanName=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_dataname").text();
// 		var bID=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_b").text(); 
// 		var LinkID=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_linkid").text();
// 	var PlanPrice=jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_price").text();

	var PlanData=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".hidden_data").text();
		var PlanName=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".hidden_dataname").text();
		var bID=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".hidden_b").text(); 
		var LinkID=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".hidden_linkid").text();
	var PlanPrice=jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".hidden_price").text();
	
		jQuery(".item-title").text(PlanName);
		jQuery(".item-desc").text(PlanData);
	
	
		var OnlyPrice = PlanPrice.split('/');
		if(OnlyPrice[1]=="day"){
			jQuery(".woocommerce-Price-currencySymbol").text(OnlyPrice[0]+"/"+OnlyPrice[1]);
			jQuery(".woocommerce-Price-currencySymbol").attr('actualPrice',OnlyPrice[0]+"/"+OnlyPrice[1]);
		}else{
			jQuery(".woocommerce-Price-currencySymbol").text(OnlyPrice[0]);
			jQuery(".woocommerce-Price-currencySymbol").attr('actualPrice',OnlyPrice[0]);
		}
		var qty= jQuery(".number").text();
	LinkID=jQuery.trim(LinkID);
	bID=jQuery.trim(bID);
	var path = window.location.pathname;
	try{
		path=path.replaceAll('/','');
	}catch(err){
		path="";
	}
	
	// var CheckoutLink="https://talknsave.net/custom-checkout?b="+bID+"&linkid="+LinkID+"&qty="+qty+"&p="+path;
    var CheckoutLink="/custom-checkout?b="+bID+"&linkid="+LinkID+"&qty="+qty+"&p="+path;
	jQuery(".checkout-btn").attr("href",CheckoutLink);

		
		
	}

if (window.location.href.indexOf("-new") > -1) {
    // alert("found it");
    jQuery('.gw-go-btn').addClass("popmake-17066");
	jQuery('.gw-go-btn').attr("onclick","CheckoutWindowGopricing(this)");
	jQuery(".gw-go-btn-inner").find("span").removeClass("popmake-17066");
	jQuery(".gw-go-btn-inner").find("span").removeAttr("onclick");
}
function urlParam(name,actUrl){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(actUrl);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
function SetHiddenPlanCookie(element){
$.removeCookie("PlanData", {path: '/'});
$.removeCookie("PlanName", {path: '/'});
$.removeCookie("PlanPrice", {path: '/'});
$.removeCookie("PlanBundleID", {path: '/'});
$.removeCookie("bundle_id", {path: '/'});
var parent = findParent(element);
var PlanData=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_data").text();
var PlanName=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_dataname").text();
var bID=jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_b").text(); 
var PlanPrice=jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_price").text();

$.cookie("PlanData", PlanData, {path: '/'});
$.cookie("PlanName", PlanName, {path: '/'});
$.cookie("PlanPrice", PlanPrice, {path: '/'});
$.cookie("PlanBundleID", bID, {path: '/'});
if ($(element).attr("data-bundle") != "" ) {
    $.cookie("bundle_id", $(element).attr("data-bundle"), {path: '/'});
    window.location.href= "https://" + window.location.host + $(element).attr("data-url");
}

return true;
}

//multi checkout js
function CloneParent(element) {
    var parentElement = jQuery(element).parent();
    if (jQuery(parentElement).hasClass("ClonePlan"))
        return parentElement;
    else {
        for (var i = 0; i < 25; i++) {
            parentElement = jQuery(parentElement).parent();
            if (jQuery(parentElement).hasClass("ClonePlan"))
                return parentElement;
        }
    }
}
function changeBgColormulti(element) {
    var parent = jQuery(element).parent().parent().parent();
    var qtyNum = jQuery(parent).find('.qty-icon.number-multi').text();
    qtyNum = parseFloat(qtyNum);

    var amtText = jQuery(parent).find(".PlanAmount:first").attr('actualPrice');
    amtText = amtText.replace('$', '');
    var amountArr = amtText.split('/');
    var amt = amountArr[0];

    var amtPerDayOrMonth = amountArr[1];
    var perDayOrMonth = "";
    if (amtPerDayOrMonth) {
        perDayOrMonth = "/" + amtPerDayOrMonth;
    }

    var finalAmt = 0;
    if (jQuery(element).hasClass('minus-multi')) {

        qtyNum = qtyNum - 1;
        if (qtyNum > 0) {
            finalAmt = amt * qtyNum;

            jQuery(parent).find('.qty-icon.number-multi').text(qtyNum);

            var qty = qtyNum;
            var Parent = CloneParent(element);
            var BundleID = jQuery(Parent).attr("Data-Bundle");
            var LinkID = jQuery(Parent).attr("Data-LinkID");
            var NewCookie = [];
            var CookieData = $.cookie("CartProduct");
            CookieData = $.parseJSON(CookieData);
            for (var j = 0; j < CookieData.length; j++) {
                if (CookieData[j].BundleID == BundleID && CookieData[j].LinkID == LinkID) {
                    var originalPrice = CookieData[j].PlanPrice;
                    var ReplaceOnlyPrice = CookieData[j].PlanPrice.replace("$", "");
                    if (ReplaceOnlyPrice !== '') {
                        var OnlyPrice = ReplaceOnlyPrice.split('/');
						perDayOrMonth= OnlyPrice[1];
                    }
                    CookieData[j].Qty = qty;
                    CookieData[j].PlanPrice = "$" + finalAmt.toFixed(2) + "/" + OnlyPrice[1];
                    NewCookie.push(CookieData[j]);
                } else {
                    NewCookie.push(CookieData[j]);
                }
            }

            $.removeCookie('CartProduct', {path: '/'});
            CartProduct = NewCookie;
            $.cookie("CartProduct", JSON.stringify(NewCookie), {path: '/'});
            GetCookie();
        }


    } else {
        qtyNum = qtyNum + 1;
        finalAmt = amt * qtyNum;

        jQuery(parent).find('.qty-icon.number-multi').text(qtyNum);
        var qty = qtyNum;
        var Parent = CloneParent(element);
        var BundleID = jQuery(Parent).attr("Data-Bundle");
        var LinkID = jQuery(Parent).attr("Data-LinkID");
        var NewCookie = [];
        var CookieData = $.cookie("CartProduct");
        CookieData = $.parseJSON(CookieData);
        for (var j = 0; j < CookieData.length; j++) {
            if (CookieData[j].BundleID == BundleID && CookieData[j].LinkID == LinkID) {
                var originalPrice = CookieData[j].PlanPrice;
                var ReplaceOnlyPrice = CookieData[j].PlanPrice.replace("$", "");
                if (ReplaceOnlyPrice !== '') {
                    var OnlyPrice = ReplaceOnlyPrice.split('/');
					perDayOrMonth= OnlyPrice[1];
                }
                CookieData[j].Qty = qty;
                CookieData[j].PlanPrice = "$" + finalAmt.toFixed(2) + "/" + OnlyPrice[1];
                NewCookie.push(CookieData[j]);
            } else {
                NewCookie.push(CookieData[j]);
            }
        }

        $.removeCookie('CartProduct', {path: '/'});
        CartProduct = NewCookie;
        $.cookie("CartProduct", JSON.stringify(NewCookie), {path: '/'});
        GetCookie();

    }
    if (qtyNum > 0) {
		if(perDayOrMonth!=undefined && perDayOrMonth!="undefined" && perDayOrMonth!="" && perDayOrMonth!=" "){
			perDayOrMonth="/"+perDayOrMonth;
		}
		if(perDayOrMonth==undefined || perDayOrMonth=="undefined"){
			perDayOrMonth="";
		}
        jQuery(parent).find(".PlanAmount").text("$" + finalAmt.toFixed(2) + perDayOrMonth);
    }

    if (qtyNum > 1) {
        jQuery(parent).find('.qty-icon.minus-multi').css('background-color', '#181854');
// 		jQuery(parent).find('.qty-icon.plus').css('background-color', '#181854');
    } else {
        jQuery(parent).find('.qty-icon.minus-multi').css('background-color', '#c3c8d4');
// 		jQuery(parent).find('.qty-icon.plus').css('background-color', '#c3c8d4');
    }
    CalculatePlanPrice();
    GetCookie();
}
var ExistCookie = $.cookie("CartProduct");
if(ExistCookie == "undefined" || ExistCookie == undefined){
		 	$(".woocommerce-Price-currencySymbol").first().parent().parent().parent().parent().addClass('hidden');	
 		$(".woocommerce-Price-currencySymbol").first().parent().parent().parent().parent().parent().append('<div class="emptyCardContainer" style="text-align: center;"><h1>Your shopping cart is empty. </h1></div>');
	}
var CartProduct;
function cookieParse() {
	if(!ExistCookie) return;
	ExistCookie = $.parseJSON(ExistCookie);
	if (ExistCookie == null) {
		CartProduct = [];
	} else {
		CartProduct = ExistCookie;
	}
}
cookieParse();

function SetCheckoutWindowMulti(element) {
    GetCookie();
    
    jQuery(".checkout-btn").attr("href", "https://talknsave.net/custom-multiple-checkout");
//     jQuery(".checkout-btn").attr("href", "/custom-multiple-checkout");
    jQuery(".ClonePlan").remove();
    if (CartProduct && CartProduct.length > 0) {
    } else {
        CartProduct = [];
    }
    var IsFirstPlan = false;
    var parent = findParent(element);
    // get data from hidden element for plan
//     var PlanData = jQuery(parent).find(".HiddenContent").find(".hidden_data").text();
//     var PlanPrice = jQuery(parent).find(".HiddenContent").find(".hidden_price").html();
//     var PlanName = jQuery(parent).find(".HiddenContent").find(".hidden_dataname").html();
//     var bID = jQuery(parent).find(".HiddenContent").find(".hidden_b").html();
//     var LinkID = jQuery(parent).find(".HiddenContent").find(".hidden_linkid").html();
		var PlanData = jQuery(parent).find(".hidden_data").text();
    var PlanPrice = jQuery(parent).find(".hidden_price").html();
    var PlanName = jQuery(parent).find(".hidden_dataname").html();
    var bID = jQuery(parent).find(".hidden_b").html();
    var LinkID = jQuery(parent).find(".hidden_linkid").html();
    var qty = jQuery(parent).find(".number-multi").text();
	var SchoolPlan=jQuery('.mainHiddenPlanData.hidden');
		if(SchoolPlan.length>0){
			 PlanData=	jQuery(SchoolPlan).find(".hidden_planData").text();
		     PlanPrice=	jQuery(SchoolPlan).find(".hidden_planPrice").html();
		     PlanName=	jQuery(SchoolPlan).find(".hidden_planName").html(); 
			 bID=	jQuery(SchoolPlan).find(".hidden_planBundleID").html(); 
		}
    // set cookie for clickable plan
    setTimeout(function () {
        if (CartProduct.length == 0) {
            IsFirstPlan = true;
            CartProduct.push({"BundleID": bID, "LinkID": LinkID, "PlanName": PlanName, "PlanData": PlanData, "PlanPrice": PlanPrice, "Qty": 1});
        } else {
            var Addcart = false;
            for (var i = 0; i < CartProduct.length; i++) {
                if (CartProduct[i].BundleID == bID && CartProduct[i].LinkID == LinkID) {
                    Addcart = true;
                    break;
                }
            }
            if (Addcart == false) {
                IsFirstPlan = true;
                CartProduct.push({"BundleID": bID, "LinkID": LinkID, "PlanName": PlanName, "PlanData": PlanData, "PlanPrice": PlanPrice, "Qty": 1, "path": '/'});
            }
        }
        
        $.cookie("CartProduct", JSON.stringify(CartProduct), {path: '/'});
        OpenCart(element, bID, LinkID, IsFirstPlan);
        CalculatePlanPrice();
        GetCookie();
    }, 300);

}


function OpenCart(element, BID, LinkID, IsFirstOrder) {
  // sep cart data with cookie values
  if (jQuery(element).hasClass("HeaderCustomCart")) {
      jQuery(".ClonePlan").remove();
  }
 
  var CookieData = $.cookie("CartProduct");
  if(CookieData != undefined){
    var NewCookie = [];
    CookieData = $.parseJSON(CookieData);
    for (var j = 0; j < CookieData.length; j++) {
        var cloneddiv = jQuery(".popup-body").find(".top-items").find(".item").first().clone();
        jQuery(cloneddiv).removeClass("hidden");
        jQuery(cloneddiv).addClass("ClonePlan");
        jQuery(cloneddiv).attr("Data-Bundle", CookieData[j].BundleID);
        jQuery(cloneddiv).attr("Data-LinkID", CookieData[j].LinkID);
        jQuery(cloneddiv).find(".item-title").text(CookieData[j].PlanName);
        jQuery(cloneddiv).find(".item-desc").text(CookieData[j].PlanData);
        if (BID !== 0 && LinkID !== 0) {
            if (CookieData[j].BundleID == BID && CookieData[j].LinkID == LinkID) {
                if (IsFirstOrder == false) {
                    var OldQuantity = CookieData[j].Qty;
                    jQuery(cloneddiv).find(".number-multi").text(+CookieData[j].Qty + 1);
                    CookieData[j].Qty = jQuery(cloneddiv).find(".number-multi").text();
                    var OldPrice = CookieData[j].PlanPrice;
                    var ReplaceOnlyPrice = OldPrice.replace("$", "");
                    if (ReplaceOnlyPrice !== '') {
                        var OnlyPrice = ReplaceOnlyPrice.split('/');
                    }
                    var ActualRPice = OnlyPrice[0] / OldQuantity;
                    var NewPrice = ActualRPice * CookieData[j].Qty;
                    CookieData[j].PlanPrice = "$" + NewPrice + "/" + OnlyPrice[1];
                    NewCookie.push(CookieData[j]);
                } else {
                    NewCookie.push(CookieData[j]);
                }
            } else {
                jQuery(cloneddiv).find(".number-multi").text(CookieData[j].Qty);
                NewCookie.push(CookieData[j]);
            }
  
        } else {
            jQuery(cloneddiv).find(".number-multi").text(CookieData[j].Qty);
            NewCookie.push(CookieData[j]);
  
        }
        if (CookieData[j].Qty > 1) {
            jQuery(cloneddiv).find('.qty-icon.minus-multi').css('background-color', '#181854');
  
        } else {
            jQuery(cloneddiv).find('.qty-icon.minus-multi').css('background-color', '#c3c8d4');
  
        }
        var OnlyPrice = CookieData[j].PlanPrice.split('/');
    if(OnlyPrice[1] == undefined || OnlyPrice[1] == "undefined"){
      OnlyPrice[1] = "";
    }
        if (OnlyPrice[1] == "day") {
  
            jQuery(cloneddiv).find(".PlanAmount").text(OnlyPrice[0] + "/" + OnlyPrice[1]);
            if (CookieData[j].Qty > 1) {
                var PriceWithoutSign = OnlyPrice[0].replace('$', '');
                var ActualPrice = PriceWithoutSign / CookieData[j].Qty;
                jQuery(cloneddiv).find(".PlanAmount").attr('actualPrice', ActualPrice + "/" + OnlyPrice[1]);
            } else {
                jQuery(cloneddiv).find(".PlanAmount").attr('actualPrice', OnlyPrice[0] + "/" + OnlyPrice[1]);
            }
  
        } else {
      var finalPrice_ep=OnlyPrice[0] + "/" + OnlyPrice[1];
      if(OnlyPrice[1]==""){
        finalPrice_ep=OnlyPrice[0];
      }
            jQuery(cloneddiv).find(".PlanAmount").text(finalPrice_ep);
            if (CookieData[j].Qty > 1) {
                var PriceWithoutSign = OnlyPrice[0].replace('$', '');
                var ActualPrice = PriceWithoutSign / CookieData[j].Qty;
                jQuery(cloneddiv).find(".PlanAmount").attr('actualPrice', ActualPrice);
            } else {
                jQuery(cloneddiv).find(".PlanAmount").attr('actualPrice', OnlyPrice[0]);
            }
  
        }
        var cloneElement = jQuery(cloneddiv).appendTo('.MultiplePlans');
  
    }
  
    $.removeCookie('CartProduct', {path: '/'});
    CartProduct = NewCookie;
    $.cookie("CartProduct", JSON.stringify(NewCookie), {path: '/'});
    GetCookie();
    if (jQuery(element).hasClass("HeaderCustomCart")) {
        CalculatePlanPrice();
    }
  }
  
}
function RemoveSinglePlan(element) {
    var BundleID = jQuery(element).parent().attr("Data-Bundle");
    var LinkID = jQuery(element).parent().attr("Data-LinkID");
    var CookieData = $.cookie("CartProduct");
    var NewCookie = [];
    CookieData = $.parseJSON(CookieData);
    for (var j = 0; j < CookieData.length; j++) {
        if (CookieData[j].BundleID == BundleID && CookieData[j].LinkID == LinkID) {
        } else {
            NewCookie.push(CookieData[j]);
        }
    }

    $.removeCookie('CartProduct', {path: '/'});
    CartProduct = NewCookie;
    $.cookie("CartProduct", JSON.stringify(NewCookie), {path: '/'});
    jQuery(element).parent().remove();
    CalculatePlanPrice();
    
}
function CalculatePlanPrice() {
    jQuery(".CustomCart").find(".checkout-btn").attr("href", "https://talknsave.net/custom-multiple-checkout");
//     jQuery(".CustomCart").find(".checkout-btn").attr("href", "/custom-multiple-checkout");
    var Planstotal = 0;
    var totalPlanNumber = 0;
    jQuery(".ClonePlan .PlanAmount").each(function () {
        var ReplaceOnlyPrice = jQuery(this).text().replace("$", "");
        if (ReplaceOnlyPrice !== '') {
            var OnlyPrice = ReplaceOnlyPrice.split('/');
            OnlyPrice = parseFloat(OnlyPrice[0]);
            Planstotal += OnlyPrice;
            totalPlanNumber++;
        }
    });
    Planstotal = Planstotal.toFixed(2);
	if(Planstotal<=0){
	jQuery(".woocommerce-Price-currencySymbol").parent().parent().parent().parent().addClass('hidden');	
	    if(totalPlanNumber <= 0) {
	    		jQuery(".woocommerce-Price-currencySymbol").parent().parent().parent().parent().parent().append('<div class="emptyCardContainer" style="text-align: center;"><h1>Your shopping cart is empty. </h1></div>');
	    }else {
            jQuery('.emptyCardContainer').remove();
            jQuery(".woocommerce-Price-currencySymbol").parent().parent().parent().parent().removeClass('hidden');
        }
		
	}else{
		jQuery(".woocommerce-Price-currencySymbol").parent().parent().parent().parent().removeClass('hidden');
		jQuery('.emptyCardContainer').remove();
		
	}
    jQuery(".woocommerce-Price-currencySymbol").text("$" + Planstotal);

    var CookieData = $.cookie("CartProduct");
    CookieData = $.parseJSON(CookieData);
    var BundleIds = '';
    var LinkIds = '';
    var Qtys = '';
    for (var j = 0; j < CookieData.length; j++) {
        BundleIds += CookieData[j].BundleID + ",";
        LinkIds += CookieData[j].LinkID + ",";
        Qtys += CookieData[j].Qty + ",";
    }
    BundleIds = BundleIds.slice(0, -1);
    LinkIds = LinkIds.slice(0, -1);
    Qtys = Qtys.slice(0, -1);
	var path = window.location.pathname;
		try{
			path=path.replaceAll('/','');
		}catch(err){
			path="";
		}
	
    var Existbtnlink = jQuery(".CustomCart").find(".checkout-btn").attr("href");
    var CheckoutLink = Existbtnlink + "?b=" + BundleIds + "&linkid=" + LinkIds + "&qty=" + Qtys+"&p="+path;
    jQuery(".checkout-btn").attr("href", CheckoutLink);
	getOrderNumbersCount();
}
function GetCookie() {
    var ProductString = $.cookie("CartProduct");//retrieving data from cookie
}
function getOrderNumbersCount(){
	var orderNumCount=0;
	var CookieData = $.cookie("CartProduct");
	if(CookieData == undefined){
		//no cookie found
	}else{
		   CookieData = $.parseJSON(CookieData);
	
         for (var j = 0; j < CookieData.length; j++) {
              var currentQty=  CookieData[j].Qty;
			 currentQty=parseFloat(currentQty);
			 orderNumCount+=currentQty;
            }
		$('.cartOrderNumbersCount').empty().text(orderNumCount);
	}
 
}
function ClearAllCookie() {
	$('.item.ClonePlan .RemoveItem').click();
    $.removeCookie('CartProduct', {path: '/'});
// 	jQuery(".woocommerce-Price-currencySymbol").first().parent().parent().parent().parent().addClass('hidden');	
// 		jQuery(".woocommerce-Price-currencySymbol").first().parent().parent().parent().parent().parent().append('<div class="emptyCardContainer" style="text-align: center;"><h1>Your shopping cart is empty. </h1></div>');
    //window.location.reload();
}
function CloseCart(element){
	$(element).parent().parent().parent().find('.pum-close.popmake-close').click();
}


 

 function hideDuplicateEmptyCardContainers() {
    var emptyCardContainers = document.querySelectorAll('.emptyCardContainer');
    for (var i = 1; i < emptyCardContainers.length; i++) {
      emptyCardContainers[i].style.display = 'none';
    }
  }

  // Run the function initially to ensure the correct state on page load
  hideDuplicateEmptyCardContainers();

  // Set an interval to run the function every 2 seconds
  setInterval(hideDuplicateEmptyCardContainers, 2000);
