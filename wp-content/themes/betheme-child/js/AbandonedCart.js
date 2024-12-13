const urlParams = new URL(window.location.href);
const CartId = urlParams.searchParams.get("CartId");
if (CartId == "") window.location.href = "https://www.talknsave.net/";
else {
  console.log(CartId);
  var requestOptions = {
    method: "POST",
    redirect: "follow",
  };

  fetch(
    `https://wpapi.talknsave.net/api/AbandonedEmailCart?Id=${CartId}`,
    requestOptions
  )
    .then((response) => response.text())
    .then((JsonResult) => JSON.parse(JsonResult))
    .then((result) => {
      $(".loading").addClass("d-none");
      console.log(result);
      if (result.Status == "Success") {
        $(".order-review-error").addClass("d-none");
        $(".order_review").removeClass("d-none");
        $("#cname").empty().text(result.data.placedOrders[0].UserName);
        $("#cemail").empty().text(result.data.placedOrders[0].ClientEmail);
        $("#cnumber")
          .empty()
          .text(result.data.placedOrders[0].ClientHomePhone1);
        SummaryCreation(result);
      } else if (result == "Record Not Found!") {
        $("#order-NotFound").css({
          display: "block",
        });
      } else if (
        result.Status == "Error" &&
        result.data.includes("Cancelled!")
      ) {
        $("#order-NotFound").css({
          display: "block",
        });
        $(".NotFound-Message-2").empty().text("But your order is cancelled!");
      } else {
        $(".order-review-error").removeClass("d-none");
        $(".order-review-error-message").text(
          "There was a problem fetching information of this plan, please contact site administrator."
        );
      }
    })
    .catch((error) => {
      $(".loading").addClass("d-none");
      console.log("error", error);
    });
}

function SummaryCreation(msg) {
  // 		try{
  // 			 $('html, body').animate({
  //         scrollTop: $("#order_review .data").last().offset().top
  //     }, 2000);
  // 		}catch(e){
  // 			//do nothing
  // 		}
  // $("#next9").click();

  var result = msg;
  var placedOrders = result.data.placedOrders;
  var allInvoices = [];
  $(result.data.invoiceTables).each(function () {
    var invoices = JSON.parse(this);
    allInvoices.push(invoices);
  });
  var userName = $("#cname").parent().clone().html();
  var userEmail = $("#cemail").parent().clone().html();
  var userNumber = $("#cnumber").parent().clone().html();
  var finalSummary =
    '<div class="content secondSummary"><div class="userDetails"><h4 style="margin-left:-15px">Contact information</h4><div class="row">' +
    userName +
    '</div><div class="row">' +
    userEmail +
    '</div><div class="row">' +
    userNumber +
    "</div></div>";
  var totalOfGrandTotal = 0;

  $(allInvoices).each(function () {
    var dataPackage = "";
    var callPackage = "";
    var extendedDataPackage = "";

    var tblBills = this[0][0];
    var display_names = this[7][0].DisplayNames;
    var tblOndeTimefees = this[2];
    var tblMonthlyfees = this[1];
    var vat = tblBills.VAT > 0 ? "$" + tblBills.VAT.toFixed(2) : "Free";
    var grandTotal = tblBills.GrandTotal;
    totalOfGrandTotal += grandTotal;
    var allOneTimeFees = "";
    $(tblOndeTimefees).each(function () {
      var crRecord = this;
      if (
        crRecord.OnceFeeName == "Coupon Credit" ||
        crRecord.OnceFeeName == "Coupon Code"
      ) {
        var amount =
          crRecord.Amount == 0
            ? "Free"
            : crRecord.Amount < 0
            ? "$" + crRecord.Amount * -1
            : "$" + crRecord.Amount;
        var feeName =
          crRecord.OnceFeeName == "Coupon Code"
            ? "Coupon Credit"
            : crRecord.OnceFeeName;
        allOneTimeFees +=
          '<div class="row " style="padding-bottom: 13px"><div class="col-md-6 col-6">' +
          feeName +
          ' </div><div class="col-md-6 col-6 text-right ">' +
          amount +
          "</div></div>";
      } else {
        var amount = crRecord.Amount > 0 ? "$" + crRecord.Amount : "Free";
        var feeName =
          crRecord.OnceFeeName == "Rental Fee"
            ? "Extension Fee"
            : crRecord.Comment.indexOf("Europe Plan") !== -1
            ? "Accessory"
            : crRecord.OnceFeeName;
        allOneTimeFees +=
          '<div class="row " style="padding-bottom: 13px"><div class="col-md-6 col-6">' +
          feeName +
          ' </div><div class="col-md-6 col-6 text-right ">' +
          amount +
          "</div></div>";
      }
    });

    $(tblMonthlyfees).each(function () {
      var crRecord = this;
      var amount = crRecord.Amount > 0 ? "$" + crRecord.Amount : "Free";
      var feeName = crRecord.MonthlyFeeName;
      allOneTimeFees +=
        '<div class="row " style="padding-bottom: 13px"><div class="col-md-6 col-6">' +
        feeName +
        ' </div><div class="col-md-6 col-6 text-right ">' +
        amount +
        "</div></div>";
    });

    if (tblBills.EquipmentModel != "Mobile Hotspot") {
      dataPackage =
        '<div class="row"><div class="col-md-6 col-6">Data </div><div class="col-md-6 col-6 text-right data " id="">' +
        display_names.DataPackageName +
        "</div></div>";
      callPackage =
        '<div class="row"><div class="col-md-6 col-6">Call </div><div class="col-md-6 col-6 text-right data " id="">' +
        display_names.CallPackageName +
        "</div></div>";
      extendedDataPackage =
        '<div class="row"><div class="col-md-6 col-6">SMS </div><div class="col-md-6 col-6 text-right data " id="">' +
        display_names.SMSPackageName +
        "</div></div>";
    }
    // dataPackage = '<div class="row"><div class="col-md-6 col-6">Data </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.DataPackageName + '</div></div>';
    // callPackage = '<div class="row"><div class="col-md-6 col-6">Call </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.CallPackageName + '</div></div>';
    // extendedDataPackage = '<div class="row"><div class="col-md-6 col-6">SMS </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.SMSPackageName + '</div></div>';

    finalSummary +=
      '<div class="listofOrders"><div class="row"><div class="col-md-12 col-12"><h4 class="contact ">' +
      tblBills.PlanDisplayName +
      '</h4> </div></div><div class="row  "><div class="col-md-6 col-6">Equipment</div><div class="col-md-6 col-6 text-right cplan">' +
      tblBills.EquipmentModel +
      "</div></div>" +
      dataPackage +
      "" +
      callPackage +
      "" +
      extendedDataPackage +
      "" +
      allOneTimeFees +
      ' <div class="row " style="padding-bottom: 13px"><div class="col-md-6 col-6">VAT </div><div class="col-md-6 col-6 text-right font-weight-bold ">' +
      vat +
      '</div></div><div class="row border-bottom" style="padding-bottom: 13px"><div class="col-md-6 col-6">Total </div><div class="col-md-6 col-6 text-right font-weight-bold ">$' +
      grandTotal +
      "</div></div></div>";
  });
  totalOfGrandTotal = totalOfGrandTotal.toFixed(2);
  finalSummary +=
    '<div class="row"><div class="col-md-6 col-6"><strong>TOTAL</strong></div><div class="col-md-6 col-6 text-right"><strong>$<span>' +
    totalOfGrandTotal +
    "</span>  </strong></div></div>";
  finalSummary +=
    '<div class="row"><button type="submit" onclick="confirmAndPay()" style="margin-top: 31px;" class="btn btn-block place-order ">Click here to submit your order <i class="icon-right-thin"></i></button><button class="next d-none" id="next10"></button></div></div>';
  // 			$(".multipleOrderDefault").parent().parent().empty().append(finalSummary);
  $(".multipleOrderDefault").parent().parent().addClass("d-none");
  $(".multipleOrderDefault").parent().parent().parent().append(finalSummary);
  $("#order_review .previous").addClass("d-none");
  sessionStorage.setItem("PlacedOrder", JSON.stringify(placedOrders));
  $(".loading").addClass("d-none");
}

function confirmAndPay() {
  var placedTempOrder = sessionStorage.getItem("PlacedOrder");
  //placedTempOrder=JSON.parse(placedTempOrder);
  $(".loading").removeClass("d-none");
  $.post(
    "https://talknsave.net/wp-content/themes/betheme-child/SaveApiResultAndPay.php",
    {
      SaveApiData: placedTempOrder,
    },
    function (msg) {
      console.log(msg);
      if (msg) {
        $(".order_review").addClass("d-none");
        $("#order-conformation").css({
          display: "block",
        });
        let orderId = msg.replace(/['"]+/g, "");
        orderId = $.trim(orderId);
        $("#Confirmid").text(orderId);
        $("#next10").click();
        sessionStorage.removeItem("PrevOrderDetails");
        $(".loading").addClass("d-none");
        $(".progress-bar").css("width", 100 + "%");
        // new
        $.removeCookie("CartProduct", {
          path: "/",
        });
      } else {
        $(".loading").addClass("d-none");
        alert("En error occurred please try again!");
      }
    }
  );
}
