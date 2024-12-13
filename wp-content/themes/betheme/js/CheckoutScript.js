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
	jQuery(".number").text(qtyNum);
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
 		jQuery(".checkout-btn").attr("href","https://talknsave.net/custom-checkout");
		 var parent = findParent(element);
		console.log(parent);
	var PlanData=	jQuery(parent).find(".HiddenContent").find(".hidden_data").text();
		var PlanPrice=	jQuery(parent).find(".HiddenContent").find(".hidden_price").html();
		var PlanName=	jQuery(parent).find(".HiddenContent").find(".hidden_dataname").html(); 
		var bID=	jQuery(parent).find(".HiddenContent").find(".hidden_b").html(); 
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
		var CheckoutLink=Existbtnlink+"?b="+bID+"&linkid="+LinkID+"&qty="+qty;
		jQuery(".checkout-btn").attr("href",CheckoutLink);
		
		
	}
jQuery('.plus').click(function () {
		
    	jQuery(".number").text(+jQuery(".number").text() + 1);
	 var parent = findParent(this);
		var Existbtnlink=jQuery(".checkout-btn").attr("href");
		Existbtnlink=Existbtnlink.split('&qty');
	Existbtnlink=Existbtnlink[0];
		var bID=	jQuery(parent).find(".HiddenContent").find(".hidden_b").html(); 
		var LinkID=	jQuery(parent).find(".HiddenContent").find(".hidden_linkid").html(); 
	var qty= jQuery(".number").text();
	var CheckoutLink=Existbtnlink+"&qty="+qty;
		jQuery(".checkout-btn").attr("href",CheckoutLink);
});
jQuery('.minus').click(function () {
		if(jQuery(".number").text() > 1){
    	jQuery(".number").text(+jQuery(".number").text() - 1);
		}
	 var parent = findParent(this);
		var Existbtnlink=jQuery(".checkout-btn").attr("href");
	Existbtnlink=Existbtnlink.split('&qty');
	Existbtnlink=Existbtnlink[0];
		var bID=	jQuery(parent).find(".HiddenContent").find(".hidden_b").html(); 
		var LinkID=	jQuery(parent).find(".HiddenContent").find(".hidden_linkid").html(); 
	var qty= jQuery(".number").text();
		var CheckoutLink=Existbtnlink+"&qty="+qty;
		jQuery(".checkout-btn").attr("href",CheckoutLink);
});


function CheckoutWindowGopricing(element){
		 var parent = findParent(element);
		console.log(parent);
// 	var path='jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body")';
	var PlanData=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_data").text();
		var PlanName=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_dataname").text();
		var bID=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_b").text(); 
		var LinkID=	jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_linkid").text();
	var PlanPrice=jQuery(parent).find(".gw-go-clean-style6").find(".gw-go-col-inner").find(".gw-go-body").find(".gw-go-even").find(".hidden_price").text();
	
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
	var CheckoutLink="https://talknsave.net/custom-checkout?b="+bID+"&linkid="+LinkID+"&qty="+qty;
	jQuery(".checkout-btn").attr("href",CheckoutLink);

		
		
	}
