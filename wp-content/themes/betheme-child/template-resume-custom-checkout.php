<?php

/**
 * Template Name: resume custom checkout 
 *
 * @package Betheme
 * @author Muffin Group
 * @link https://muffingroup.com
 */
// die();
// return;
get_header();
?>

<link rel="stylesheet" id="mfn-layout-css" href="https://www.talknsave.net/wp-content/themes/betheme-child/css/custom.css?ver=21.10.0" type="text/css" media="all">
<link rel="stylesheet" id="bootstrap-css" href="https://www.talknsave.net/wp-content/themes/betheme/css/bootstrap.min.css?ver=21.9.8" type="text/css" media="all">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src='https://www.talknsave.net/wp-content/themes/betheme-child/js/creditcard.js?ver=21.9.8'></script>
<script src='https://www.talknsave.net/wp-content/themes/betheme-child/js/multiplePage-checkout-Test.js?ver=21.9.12'></script>
<script src='https://www.talknsave.net/wp-content/themes/betheme-child/js/AbandonedCart.js?ver=0.0.1'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" integrity="sha512-aUhL2xOCrpLEuGD5f6tgHbLYEXRpYZ8G5yD+WlFrXrPy2IrWBlu6bih5C9H6qGsgqnU6mgx6KtU8TreHpASprw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script>
    function redirectToOldPage(linkId, bunId) {
        window.location.href = "https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=" + bunId + "&linkid=" + linkId;
    }
</script> -->

<div id="Content">
    <div class="content_wrapper clearfix">

        <!-- .sections_group -->
        <div class="sections_group">

            <div class="entry-content" itemprop="mainContentOfPage">

                <div class="section the_content has_content">
                    <div class="section_wrapper">
                        <div class="the_content_wrapper multipleContainer">
                            <div class="custom-checkout-container">
                                <div class="loading"></div>
                                <div class="checkout-header px-0 row">
                                    <div class="col-6 p-0">
                                        <div class="title"><img src="https://www.talknsave.net/wp-content/uploads/2021/05/screenshot_6.png">Checkout</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="help-link aLinkDeco" style="float: right;"><a href="tel:+1-866-825-5672">Customer Support </a></div>
                                    </div>
                                </div>

                            </div>
                            <section class="mt-5 mobile-mt-4" style='margin-bottom: 182px;'>
                                <div class="container custom-main-container">
                                    <div class="form" id="multistep_form">
                                        <fieldset id="order_review">
                                            <div class="row order-review-error d-none">

                                                <div class="col-8 m-auto ">
                                                    <div class="row">
                                                        <div class="h3 order-review-error-message"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div style="display: flex; flex-direction: column;">
                                                            <a href="https://www.talknsave.net/" class="c-black aLinkDeco" style="margin-top: 20px;"> Back to TalkNSave Home page</a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="row order_review d-none">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous9"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-8 pl-3 pr-3 mobile-padding-33">
                                                    <div class="title" style="margin-bottom:40px">
                                                        <h2 style="margin-left:-15px">Review order
                                                            <button type="submit" onclick="confirmAndPay()" style="margin-top: 31px;" class="btn btn-block place-order ">Click here to submit your order <i class="icon-right-thin"></i></button>
                                                        </h2>
                                                    </div>
                                                    <div class="content">
                                                        <h4 style="margin-left:-15px">Contact information</h4>
                                                        <div class="row">
                                                            <div class="col-md-6 col-4">Name</div>
                                                            <div class="col-md-6 col-8 text-right contact" id="cname">
                                                                ----------</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-4">Email</div>
                                                            <div class="col-md-6 col-8 text-right contact" id="cemail">
                                                                ----------</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-4" style="margin-bottom:40px;">
                                                                Phone</div>
                                                            <div class="col-md-6 col-8 text-right contact" id="cnumber">
                                                                ----------</div>
                                                        </div>
                                                        <div>


                                                            <div class="multipleOrderDefault d-none">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <h4 class="contact planName"></h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row  equipmentDiv">
                                                                    <div class="col-md-6 col-6">Equipment</div>
                                                                    <div class="col-md-6 col-6 text-right cplan"> </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-6">Service Duration</div>
                                                                    <div class="col-md-6 col-6 text-right contact cdate" id=""></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-6">Data </div>
                                                                    <div class="col-md-6 col-6 text-right data " id="">
                                                                    </div>
                                                                </div>
                                                                <div class="d-none simPrice">
                                                                    <?php echo $bundles[0]['BundleRate']; ?>
                                                                </div>
                                                                <div class="d-none phonePrice">
                                                                    0
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-6">Call </div>
                                                                    <div class="col-md-6 col-6 text-right call" id="">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-6">SMS </div>
                                                                    <div class="col-md-6 col-6 text-right sms" id="">
                                                                    </div>
                                                                </div>
                                                                <!--                             <div class="row border-bottom">
                                                                                                <div class="col-md-6">SIM card <small>one SIM fits all</small></div>
                                                                                                <div class="col-md-6 text-right">₪ 9.97</div>
                                                                                            </div> -->
                                                                <div class="stayLocalReview"></div>
                                                                <div class="internationalReivew"> </div>
                                                                <div class="row ">
                                                                    <div class="col-md-6 col-6">Insurance</div>
                                                                    <div class="col-md-6 col-6 text-right insurance" id=""></div>
                                                                </div>

                                                                <div class="row border-bottom planPriceDiv border-bottom" style="padding-bottom: 13px">
                                                                    <div class="col-md-6 col-6">Plan Price </div>
                                                                    <div class="col-md-6 col-6 text-right planPrice font-weight-bold ">
                                                                    </div>
                                                                </div>
                                                                <div class="row border-bottom d-none equipmentPriceDiv " style="padding-bottom: 13px">
                                                                    <div class="col-md-6 col-6"> Equipment Price</div>
                                                                    <div class="col-md-6 col-6 text-right equipmentPrice font-weight-bold " style="font-weight:bold;" id=""> </div>
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
                                                            <div class="col-md-6 col-6 text-right font-weight-bold" class="contact">$<span id="vatTotle"></span></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <h4 style="margin-top: 15px; margin-bottom: 5px;">
                                                                    Shipping & Handling
                                                                </h4>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 col-6" id="shippingName"></div>
                                                            <div class="col-md-6 col-6 text-right font-weight-bold" id="shippingPrice"> </div>
                                                        </div>

                                                        <div class="row discountContainer d-none">
                                                            <div class="col-md-6 col-6 discountTitle">Discount 10%</div>
                                                            <div class="col-md-6 col-6 text-right font-weight-bold">
                                                                <span class="discountAmount">8.50</span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 col-6"><strong>TOTAL</strong></div>
                                                            <div class="col-md-6 col-6 text-right"><strong class="contact">$<span id="cprice"></span><span id="newDiscountedPrice" class="d-none" style="padding-left: 10px;"></span> </strong>
                                                            </div>
                                                        </div>


                                                        <?php if ($data['Covid_SignupFee'] > 0) { ?>
                                                            <div class="row covidSignUp ">
                                                                <h6 class="col-md-12 col-12" style="color:red;"> You will be
                                                                    charged a non-refundable fee of $<span id="covidSignUpFees"></span>.<br />The remaining
                                                                    balance will be charged on the first day of your trip.
                                                                </h6>

                                                            </div>
                                                        <?php } ?>


                                                        <div class="row">
                                                            <button type="submit" onClick="submitMultiStepForm()" style="margin-top: 31px;" class="btn btn-block place-order ">Place your order <i class="icon-right-thin"></i></button>
                                                            <button class="next d-none" id="next10">

                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="order-conformation">

                                            <div class="mt-lg-5 mt-md-5" style="display: flex; justify-content: center;">

                                                <div style="display: inline-block;">
                                                    <h2 style=" color:#000913; font-weight: bold; font-size: 28px;">
                                                        Thank you !</h2>
                                                    <h3 style="font-weight: bold;font-size: 20px;">
                                                        Your order #<span id="Confirmid"></span> is confirmed
                                                    </h3>
                                                    <p class="c-black">
                                                        Check your email <span id="confirmEmail"> </span> for details
                                                    </p>
                                                    <div style="display: flex; flex-direction: column;">
                                                        <a href="https://www.talknsave.net/" class="c-black aLinkDeco" style="margin-top: 20px;"> Back to TalkNSave Home page</a>
                                                    </div>
                                                </div>


                                            </div>
                                        </fieldset>
                                        <fieldset id="order-NotFound">

                                            <div class="mt-lg-5 mt-md-5" style="display: flex; justify-content: center;">

                                                <div style="display: inline-block;">
                                                    <h2 class="NotFound-Message-1" style=" color:#000913; font-weight: bold; font-size: 28px;">
                                                        We appreciate you returning your cart !</h2>
                                                    <h3 class="NotFound-Message-2" style="font-weight: bold;font-size: 20px;">
                                                        But we couldn't find your order!
                                                    </h3>
                                                    <div style="display: flex; flex-direction: column;">
                                                        <a href="https://www.talknsave.net/" class="c-black aLinkDeco" style="margin-top: 20px;"> Back to TalkNSave Home page</a>
                                                    </div>
                                                </div>


                                            </div>
                                        </fieldset>
                                    </div>


                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();
