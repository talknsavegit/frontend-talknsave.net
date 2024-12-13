$(document).ready(function () {
	
		  jQuery('.multiple_plus').click(function () {
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
jQuery('.multiple_minus').click(function () {
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
})


	  
  




var ExistCookie = $.cookie("CartProduct");
console.log("existcookie" + ExistCookie);
var CartProduct;
ExistCookie = $.parseJSON(ExistCookie);
if (ExistCookie == null) {
    CartProduct = [];
} else {
    CartProduct = ExistCookie;
}

function SetPopupData(element) {
    GetCookie();
    jQuery(".checkout-btn").attr("href", "https://talknsave.net/custom-checkout");
    jQuery(".ClonePlan").remove();
    if (CartProduct && CartProduct.length > 0) {
    } else {
        CartProduct = [];
    }
    var IsFirstPlan = false;
    var parent = findParent(element);
    // get data from hidden element for plan
    var PlanData = jQuery(parent).find(".HiddenContent").find(".hidden_data").text();
    var PlanPrice = jQuery(parent).find(".HiddenContent").find(".hidden_price").html();
    var PlanName = jQuery(parent).find(".HiddenContent").find(".hidden_dataname").html();
    var bID = jQuery(parent).find(".HiddenContent").find(".hidden_b").html();
    var LinkID = jQuery(parent).find(".HiddenContent").find(".hidden_linkid").html();
    var qty = jQuery(".multiple_number").text();
    // set cookie for clickable plan
    setTimeout(function () {
        if (CartProduct.length == 0) {
            IsFirstPlan = true;
            CartProduct.push({"BundleID": bID, "LinkID": LinkID, "PlanName": PlanName, "PlanData": PlanData, "PlanPrice": PlanPrice, "Qty": qty});
        } else {
            var Addcart = false;
            for (var i = 0; i < CartProduct.length; i++) {
                console.log(CartProduct[i].BundleID);
                if (CartProduct[i].BundleID == bID) {
                    Addcart = true;
                    break;
                }
            }
            if (Addcart == false) {
                IsFirstPlan = true;
                CartProduct.push({"BundleID": bID, "LinkID": LinkID, "PlanName": PlanName, "PlanData": PlanData, "PlanPrice": PlanPrice, "Qty": qty, "path": '/'});
            }
        }
        $.cookie("CartProduct", JSON.stringify(CartProduct), {path: '/'});
        OpenCart(element, bID, LinkID, IsFirstPlan);
        CalculatePlanPrice();
        GetCookie();
    }, 300);

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
    console.log($.cookie("CartProduct"));
}



function OpenCart(element, BID, LinkID, IsFirstOrder) {
    // sep cart data with cookie values
    if (jQuery(element).hasClass("HeaderCustomCart")) {
        jQuery(".ClonePlan").remove();
    }
    var CookieData = $.cookie("CartProduct");
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
                    jQuery(cloneddiv).find(".multiple_number").text(+CookieData[j].Qty + 1);
                    CookieData[j].Qty = jQuery(cloneddiv).find(".multiple_number").text();
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
                jQuery(cloneddiv).find(".multiple_number").text(CookieData[j].Qty);
                NewCookie.push(CookieData[j]);
            }

        } else {
            jQuery(cloneddiv).find(".multiple_number").text(CookieData[j].Qty);
            NewCookie.push(CookieData[j]);

        }
        if (CookieData[j].Qty > 1) {
            jQuery(cloneddiv).find('.qty-icon.minus').css('background-color', '#181854');

        } else {
            jQuery(cloneddiv).find('.qty-icon.minus').css('background-color', '#c3c8d4');

        }
        var OnlyPrice = CookieData[j].PlanPrice.split('/');
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
            jQuery(cloneddiv).find(".PlanAmount").text(OnlyPrice[0] + "/" + OnlyPrice[1]);
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

function CheckoutWindowGopricingMultiple(element) {
    GetCookie();
    jQuery(".checkout-btn").attr("href", "https://talknsave.net/custom-checkout");
    jQuery(".ClonePlan").remove();
    if (CartProduct && CartProduct.length > 0) {
    } else {
        CartProduct = [];
    }
    var IsFirstPlan = false;
    var parent = findParent(element);
    console.log(parent);
// 	var path='jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body")';
    var PlanData = jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_data").text();
    var PlanName = jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_dataname").text();
    var bID = jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_b").text();
    var LinkID = jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_linkid").text();
    var PlanPrice = jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_price").text();
    var qty = jQuery(".number").text();

    // set cookie for clickable plan
    setTimeout(function () {
        if (CartProduct.length == 0) {
            IsFirstPlan = true;
            CartProduct.push({"BundleID": bID, "LinkID": LinkID, "PlanName": PlanName, "PlanData": PlanData, "PlanPrice": PlanPrice, "Qty": qty});
        } else {
            var Addcart = false;
            for (var i = 0; i < CartProduct.length; i++) {
                console.log(CartProduct[i].BundleID);
                if (CartProduct[i].BundleID == bID) {
                    Addcart = true;
                    break;
                }
            }
            if (Addcart == false) {
                IsFirstPlan = true;
                CartProduct.push({"BundleID": bID, "LinkID": LinkID, "PlanName": PlanName, "PlanData": PlanData, "PlanPrice": PlanPrice, "Qty": qty});
            }
        }
        $.cookie("CartProduct", JSON.stringify(CartProduct), {path: '/'});
        OpenCart(element, bID, LinkID, IsFirstPlan);
        CalculatePlanPrice();
        GetCookie();
    }, 300);

}

function SetPopupDataMultiple(element) {
    GetCookie();
    jQuery(".checkout-btn").attr("href", "https://talknsave.net/custom-checkout");
    jQuery(".ClonePlan").remove();
    if (CartProduct && CartProduct.length > 0) {
    } else {
        CartProduct = [];
    }
	
    var IsFirstPlan = false;
    var parent = findParent(element);
    // get data from hidden element for plan
    var PlanData = jQuery(parent).find(".HiddenContent").find(".hidden_data").text();
    var PlanPrice = jQuery(parent).find(".HiddenContent").find(".hidden_price").html();
    var PlanName = jQuery(parent).find(".HiddenContent").find(".hidden_dataname").html();
    var bID = jQuery(parent).find(".HiddenContent").find(".hidden_b").html();
    var LinkID = jQuery(parent).find(".HiddenContent").find(".hidden_linkid").html();
    var qty = jQuery(".number").text();
	
// 	    jQuery(".item-title").text(PlanName);
// 		jQuery(".item-desc").text(PlanData);
// 		jQuery(".qty-icon.number").text("1");
// 		jQuery(".qty-icon.minus").css("background-color","#c3c8d4");
		var OnlyPrice = PlanPrice.split('/');
		if(OnlyPrice[1]=="day"){
			jQuery(".woocommerce-Price-currencySymbol").text(OnlyPrice[0]+"/"+OnlyPrice[1]);
			jQuery(".woocommerce-Price-currencySymbol").attr('actualPrice',OnlyPrice[0]+"/"+OnlyPrice[1]);
		}else{
			jQuery(".woocommerce-Price-currencySymbol").text(OnlyPrice[0]);
			jQuery(".woocommerce-Price-currencySymbol").attr('actualPrice',OnlyPrice[0]);
		}
		
		var qty= jQuery(".multiple_number").text();
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
	
    // set cookie for clickable plan
    
    setTimeout(function () {
        if (CartProduct.length == 0) {
            IsFirstPlan = true;
            CartProduct.push({"BundleID": bID, "LinkID": LinkID, "PlanName": PlanName, "PlanData": PlanData, "PlanPrice": PlanPrice, "Qty": qty});
        } else {
            var Addcart = false;
            for (var i = 0; i < CartProduct.length; i++) {
                console.log(CartProduct[i].BundleID);
                if (CartProduct[i].BundleID == bID) {
                    Addcart = true;
                    break;
                }
            }
            if (Addcart == false) {
                IsFirstPlan = true;
                CartProduct.push({"BundleID": bID, "LinkID": LinkID, "PlanName": PlanName, "PlanData": PlanData, "PlanPrice": PlanPrice, "Qty": qty, "path": '/'});
            }
        }
        $.cookie("CartProduct", JSON.stringify(CartProduct), {path: '/'});
        OpenCart(element, bID, LinkID, IsFirstPlan);
        CalculatePlanPrice();
        GetCookie();
    }, 300);

}
function changeBgColorMultiple(element) {
    var parent = jQuery(element).parent().parent().parent();
    var qtyNum = jQuery(parent).find('.qty-icon.multiple_number').text();
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
    if (jQuery(element).hasClass('multiple_minus')) {

        qtyNum = qtyNum - 1;
        if (qtyNum > 0) {
            finalAmt = amt * qtyNum;

            jQuery(parent).find('.qty-icon.multiple_number').text(qtyNum);

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

        jQuery(parent).find('.qty-icon.multiple_number').text(qtyNum);
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
        jQuery(parent).find(".PlanAmount").text("$" + finalAmt.toFixed(2) + perDayOrMonth);
    }

    if (qtyNum > 1) {
        jQuery(parent).find('.qty-icon.multiple_minus').css('background-color', '#181854');
// 		jQuery(parent).find('.qty-icon.plus').css('background-color', '#181854');
    } else {
        jQuery(parent).find('.qty-icon.multiple_minus').css('background-color', '#c3c8d4');
// 		jQuery(parent).find('.qty-icon.plus').css('background-color', '#c3c8d4');
    }
    CalculatePlanPrice();
    GetCookie();
}

function GetCookie() {
    var ProductString = $.cookie("CartProduct");//retrieving data from cookie
    console.log("retriving data= " + ProductString);
}

function CalculatePlanPrice() {
    jQuery(".CustomCart").find(".checkout-btn").attr("href", "https://talknsave.net/custom-checkout");
    var Planstotal = 0;
    jQuery(".ClonePlan .PlanAmount").each(function () {
        var ReplaceOnlyPrice = jQuery(this).text().replace("$", "");
        if (ReplaceOnlyPrice !== '') {
            var OnlyPrice = ReplaceOnlyPrice.split('/');
            OnlyPrice = parseFloat(OnlyPrice[0]);
            Planstotal += OnlyPrice;
        }
    });
    Planstotal = Planstotal.toFixed(2);
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
    var Existbtnlink = jQuery(".CustomCart").find(".checkout-btn").attr("href");
    var CheckoutLink = Existbtnlink + "?b=" + BundleIds + "&linkid=" + LinkIds + "&qty=" + Qtys;
    jQuery(".checkout-btn").attr("href", CheckoutLink);
}

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

function ClearAllCookie() {
    $.removeCookie('CartProduct', {path: '/'});
    window.location.reload();
}