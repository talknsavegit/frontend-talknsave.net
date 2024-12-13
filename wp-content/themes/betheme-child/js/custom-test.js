$(document).ready(function () {
    $(".openPopup").click(function () {
        let e = $(this).data("id");
        $(e).fadeIn(250);
    }),
        $(".closePopup").click(function () {
            let e = $(this).data("id");
            $(e).fadeOut(250);
        }),
        $(".applyCouponBtn").click(function () {
            $(".CouponCodeMessage").text("").addClass("d-none"), $(".CouponCodeError").addClass("d-none");
            var e = $.trim($("#coupanCode").val()),
                n = "",
                o = "",
                t = 0;
            $(".serviceDateContainer").each(function () {
                0 == t ? ((n += $(this).attr("sublinkid")), (o += $(this).attr("bundleid"))) : ((n += "," + $(this).attr("sublinkid")), (o += "," + $(this).attr("bundleid"))), t++;
            }),
                "" == e
                    ? ($(".CouponCodeError").removeClass("d-none").empty().text("Please enter coupon code!"),
                      $("#newDiscountedPrice").addClass("d-none"),
                      $("#cprice").css("text-decoration", "none"),
                      $("#cprice").css("color", "black"),
                      $(".discountContainer").addClass("d-none"))
                    : $.ajax({
                          url: "https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/themes/betheme-child/MultiCouponCodeCheck.php?coupon=" + e + "&b=" + o + "&linkid=" + n,
                          type: "GET",
                          success: function (e) {
                              if ("invalid" == e) $(".CouponCodeError").removeClass("d-none").empty().text("Coupon code is invalid or expired.");
                              else {
                                  var n = JSON.parse(e),
                                      o = !1;
                                  for (let e = 0; e < n.length; e++) "valid" == n[e].status && (o = !0);
                                  console.log(e),
                                      o
                                          ? ($(".CouponCodeError").addClass("d-none"), $(".CouponCodeMessage").text("Coupon Applied Successfully!").removeClass("d-none"))
                                          : ($(".CouponCodeError").removeClass("d-none").empty().text("Coupon code is invalid or expired."),
                                            $("#coupanCode").val(""),
                                            $("#newDiscountedPrice").addClass("d-none"),
                                            $("#cprice").css("text-decoration", "none"),
                                            $("#cprice").css("color", "black"),
                                            $(".discountContainer").addClass("d-none"));
                              }
                          },
                          error: function (e) {
                              console.log("Error occurred"), console.log(e);
                          },
                      });
        }),
        $("#AddInsuranceBox").click(function () {
            try {
                $(".equipmentSim").each(function () {
                    $(this).data("name").toLowerCase();
                    var e = $(this).attr("issim"),
                        n = $(this).val();
                    !$(this).is(":checked") || "true" == e || ("3070" != n && "3160" != n && "3210" != n)
                        ? $(this).parent().find(".insurance-addon").remove()
                        : 0 == $(this).parent().find(".insurance-addon").length &&
                          $(this)
                              .parent()
                              .append(
                                  '<div class="form-group mb-0 insurance-addon" style="background: #fff;border-radius: 6px;padding-top: 18px;">\n                    <div class="form-group row form-check mb-0" style="background: transparent;border: none;">\n                                                        <input class="form-check-input insurance-checkbox" type="checkbox" value="">\n                                                        <label class="form-check-label d-block check-label terms">Yes, Add Insurance at $2.50 + VAT per month</label></div>\n\t<div class="form-group" style="padding-left: 32px;font-size: 14px;"><div class="input-group mb-2">Don\'t miss out add insurance  today and cover your phone for any damage!\n<br>* Does not include loss, theft or intentional damage. <br>In case of total loss, you will receive a $35 + VAT credit towards your phone replacement.\n                            </div>\n                        </div>\n\t</div>'
                              );
                });
            } catch (e) {}
        });
}),
    $(document).on("click", "#confirmAndPay", function () {
        var e = sessionStorage.getItem("PlacedOrder");
        $(".loading").removeClass("d-none"),
            $.post("https://talknsave.net/wp-content/themes/betheme-child/SaveApiResultAndPay.php", { SaveApiData: e }, function (e) {
                if ((console.log(e), e)) {
                    let n = e.replace(/['"]+/g, "");
                    (n = $.trim(n)),
                        $("#Confirmid").text(n),
                        $("#next10").click(),
                        sessionStorage.removeItem("PrevOrderDetails"),
                        $(".loading").addClass("d-none"),
                        $(".progress-bar").css("width", "100%"),
                        $.removeCookie("CartProduct", { path: "/" });
                } else $(".loading").addClass("d-none"), alert("En error occurred please try again!");
            });
    }),
    $(document).on("click", "#cancelOrder", function () {
        $("#previous9").click();
    }),
    $(document).on("change", ".radioBtnChange", function () {
        try {
            $(".equipmentSim").each(function () {
                $(this).data("name").toLowerCase();
                var e = $(this).attr("issim"),
                    n = $(this).val();
                !$(this).is(":checked") || "true" == e || ("3070" != n && "3160" != n && "3210" != n)
                    ? $(this).parent().find(".insurance-addon").remove()
                    : 0 == $(this).parent().find(".insurance-addon").length &&
                      $(this)
                          .parent()
                          .append(
                              '<div class="form-group mb-0 insurance-addon" style="background: #fff;border-radius: 6px;padding-top: 18px;">\n                    <div class="form-group row form-check mb-0" style="background: transparent;border: none;">\n                                                        <input class="form-check-input insurance-checkbox" type="checkbox" value="">\n                                                        <label class="form-check-label d-block check-label terms">Yes, Add Insurance at $2.50 + VAT per month</label></div>\n\t<div class="form-group" style="padding-left: 32px;font-size: 14px;"><div class="input-group mb-2">Don\'t miss out add insurance  today and cover your phone for any damage!\n<br>* Does not include loss, theft or intentional damage. <br>In case of total loss, you will receive a $35 + VAT credit towards your phone replacement.\n                            </div>\n                        </div>\n\t</div>'
                          );
            });
        } catch (e) {}
    });
