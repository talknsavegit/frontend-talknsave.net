<?php

/**
 * Template Name: custom multiple checkout - Active
 *
 * @package Betheme
 * @author Muffin Group
 * @link https://muffingroup.com
 */
// die();
// return;
get_header();
?>

<link rel="stylesheet" id="mfn-layout-css" href="https://www.talknsave.net/wp-content/themes/betheme-child/css/custom.css?ver=21.9.9" type="text/css" media="all">
<link rel="stylesheet" id="bootstrap-css" href="https://www.talknsave.net/wp-content/themes/betheme/css/bootstrap.min.css?ver=21.9.8" type="text/css" media="all">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src='https://www.talknsave.net/wp-content/themes/betheme-child/js/creditcard.js?ver=21.9.8'></script>
<script src='https://www.talknsave.net/wp-content/themes/betheme-child/js/multiplePage-checkout.js?ver=21.9.12'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" integrity="sha512-aUhL2xOCrpLEuGD5f6tgHbLYEXRpYZ8G5yD+WlFrXrPy2IrWBlu6bih5C9H6qGsgqnU6mgx6KtU8TreHpASprw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function AddInsuranceBox() {
        try {
            $('.equipmentSim').each(function() {
                var checkdItem = $(this).data('name').toLowerCase();
                var isSim = $(this).attr('issim');
                var equipmentIDph = $(this).val();
                if ($(this).is(':checked') && isSim != "true" && (equipmentIDph == "3070" || equipmentIDph == "3160" || equipmentIDph == "3210")) {
                    if ($(this).parent().find('.insurance-addon').length == 0) {
                        $(this).parent().append(`<div class="form-group mb-0 insurance-addon" style="background: #fff;border-radius: 6px;padding-top: 18px;">
                    <div class="form-group row form-check mb-0" style="background: transparent;border: none;">
                                                        <input class="form-check-input insurance-checkbox" type="checkbox" value="">
                                                        <label class="form-check-label d-block check-label terms">Yes, Add Insurance at $2.50 + VAT per month</label></div>
	<div class="form-group" style="padding-left: 32px;font-size: 14px;"><div class="input-group mb-2">Don't miss out add insurance  today and cover your phone for any damage!
<br>* Does not include loss, theft or intentional damage. <br>In case of total loss, you will receive a $35 + VAT credit towards your phone replacement.
                            </div>
                        </div>
	</div>`);
                    }
                } else {
                    $(this).parent().find('.insurance-addon').remove();
                }


            });
        } catch (err) {

        }
    }

    function redirectToOldPage(linkId, bunId) {
        window.location.href = "https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=" + bunId + "&linkid=" + linkId;
    }
</script>

<?php
$bundle_id = $_GET['b'];
$link_id = $_GET['linkid'];
$ord_qty = $_GET['qty'];
if (!isset($ord_qty)) {
    $ord_qty = 1;
}
$bundleIDs = explode(',', $bundle_id);
$linkIDs = explode(',', $link_id);
$orderQuantities = explode(',', $ord_qty);


$planCount = count($bundleIDs);
$postObj = "[";
for ($x = 0; $x < $planCount; $x++) {
    $postObj .= "{";
    $postObj .= "'linkid':" . $linkIDs[$x] . ",";
    $postObj .= "'b':" . $bundleIDs[$x];
    $postObj .= "},";
}
$postObj = rtrim($postObj, ',');
$postObj .= "]";


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://wpapi.talknsave.net/api/products',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $postObj,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

$data = curl_exec($curl);
curl_close($curl);
$data = json_decode($data, true);
$allData = [];
$nulldataCount = [];
$nulldatabId = [];
$shippingData = [];

$CouponCodeSukkot = "";

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    if ($p == 'pessach-2023') {
        $CouponCodeSukkot = "pesach30";
    }
}

for ($i = 0; $i < Count($data); $i++) {
    if (isset($data[$i]['CouponCode']) && $data[$i]['CouponCode'] != "") {
        $CouponCodeSukkot = $data[$i]['CouponCode'];
    }
    if ($i == 0) {
        array_push($shippingData, $data[$i]['shippings']);
    }
    if (count($data[$i]['bundles']) == 0) {
        array_push($nulldataCount, $data[$i]["Counter"]);
        array_push($nulldatabId, $bundleIDs[$i]);
    } else {
        array_push($allData, $data[$i]);
    }
}

//var_dump($shippingData);
$dataCount = Count($allData);
if ($dataCount == 0) {
    header("Location: https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=" . $bundleIDs[0] . "&linkid=" . $linkIDs[0]);
}

$bundles = $allData['bundles'];

$equipments = $bundles[0]['equipments'];

$kntCountries = $bundles[0]['kntCountries'];
$min_period = "";
$max_period = "";
$isAnyEuropePlan = false;
$p = $_GET['p'];
?>

<div id="Content">
    <div class="content_wrapper clearfix">

        <!-- .sections_group -->
        <div class="sections_group">

            <div class="entry-content" itemprop="mainContentOfPage">

                <div class="section the_content has_content">
                    <div class="section_wrapper">
                        <div class="the_content_wrapper multipleContainer">
                            <div class="custom-checkout-container">

                                <div id="wrap_popup1" class="wrap_popup" style="backdrop-filter: blur(9px);">
                                    <div class="popup" style="background: white;">
                                        <div class="title border-bottom">
                                            <p class="popupTitle mr-4">Stay local Number</p>
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
                                            <p class="popupTitle mr-4" id="staylocalTitle"> </p>
                                        </div>
                                        <div class="box">
                                            <p class="popupDesc" id="stayLoacalDesc"> </p>
                                            <center><i class="icon-cancel popupclose " onClick="closePopup('#wrap_popup2')" data-dismiss="modal" aria-label="Close"> </i></center>
                                        </div>
                                    </div>
                                </div>

                                <div id="wrap_popup3" class="wrap_popup" style="backdrop-filter: blur(9px);">
                                    <div class="popup" style="background: white;">
                                        <div class="title border-bottom">
                                            <p class="loginPopupTitle" id="LoginTitle">Login</p>
                                        </div>
                                        <div class="box">
                                            <p class="" id="LoginDesc">
                                            <div class='row mx-0'>
                                                <div class='col-md-12 my-3'>

                                                    <div class='form-group'><label class='inner-label'>Email Address<span style='color: red;'> *</span></label><input type='text' class='form-control w-100 loginEmail' name='email' autocomplete='off' style="border-radius: 0.25rem;">
                                                        <p class='emailError' style='color:red; font-size: 12px;'></p>
                                                    </div>
                                                    <div class='form-group'><label class='inner-label'>Password<span style='color: red;'> *</span></label><input type='password' class='form-control w-100 loginPassword p-2' name='password' autocomplete='off' style="border-radius: 0.25rem;"><i class="bi bi-eye-slash" id="togglePassword"></i>
                                                        <p class='passwordError' style='color:red; font-size: 12px; '></p>
                                                    </div> <button class='loginBtn btn btn-block mt-4' id='LoginBtn'>Login <div class="loaders d-none"></div></button>

                                                    <div style='text-align: center;'> <a class='cursorP' href='https://webselfcare.talknsave.net/forgotpassword' target='_blank' style='text-decoration: underline;'>Forget Password</a></div>
                                                </div>
                                            </div>
                                            </p>
                                            <center><i class="icon-cancel popupclose " onClick="closePopup('#wrap_popup3')" data-dismiss="modal" aria-label="Close"> </i></center>

                                        </div>
                                    </div>
                                </div>

                                <div class="countPhone d-none"> </div>
                                <div class="countAlreadySim d-none"></div>
                                <div class="school-popup d-none"></div>
                                <div class="minDate d-none">
                                </div>
                                <a class="text-right d-none " onclick="openPopup('#wrap_popup1')" id="sLearnMore">Learn
                                </a>

                                <?php
                                $rentalPhone = false;
                                for ($i = 0; $i < $dataCount; $i++) {
                                    $data = $allData[$i];

                                    $equipments = $data['bundles'][0]['equipments'];
                                    $min_period = $data['minimumPeriod'];
                                    $max_period = $data['maximumPeriod'];

                                    foreach ($equipments as $equipment) {
                                        if ($equipment['IsSim'] == 1 || $equipment['IsSmartPhone'] == 0) {
                                            continue;
                                        } else if ($equipment['IsSmartPhone'] == 1) {
                                            $rentalPhone = true;
                                        }
                                ?>
                                        <div id='rentalPhone' class="d-none" value="<?php echo ($rentalPhone) ? 'true' : '' ?>">
                                        </div>

                                <?php }
                                }
                                ?>

                                <div id="accFinalAmount" class="d-none">
                                </div>
                                <div class="loading d-none"></div>
                                <div class="checkout-header px-0 row">
                                    <div class="col-6 p-0">
                                        <div class="title"><img src="https://www.talknsave.net/wp-content/uploads/2021/05/screenshot_6.png">Checkout</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="help-link aLinkDeco" style="float: right;"><a href="tel:+1-866-825-5672">Customer Support </a></div>
                                    </div>
                                </div>

                            </div>
                            <section>
                                <div class="progress">
                                    <div class="progress-bar active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </section>
                            <section class="mt-5 mobile-mt-4" style='margin-bottom: 182px;'>
                                <div class="container custom-main-container">
                                    <div class="form" id="multistep_form">
                                        <fieldset id="service_date">
                                            <div class="row">
                                                <div class="col"><a href="/" class="cart-link"><i class="icon-left-open-big"></i></a></div>
                                                <div class="col-md-8">
                                                    <!-- <?php if (count($nulldataCount) > 0) {
                                                                for ($i = 0; $i < count($nulldataCount); $i++) {
                                                            ?>
                                                    <?php if ($i == 0) { ?>
                                                        <div class="h5 px-3 my-2" style="color: red;">Please note!</div>
                                                        <?php } ?>
                                                    <div class="h6 px-3 my-2" style="color: red;">Bundle(<?php echo $nulldatabId[$i] ?>) is not attached to the Link(<?php echo $nulldataCount[$i] ?>) please <a class="cursorP" style="text-decoration: underline;color: blue !important;"  onclick="redirectToOldPage(<?php echo $nulldataCount[$i] ?>,<?php echo $nulldatabId[$i] ?>)">Click Here</a> to find similar plans.</div>
                                                    <?php }
                                                            } ?> -->
                                                    <?php
                                                    $allData['isBhltPlan'] = 'NO';
                                                    for ($i = 0; $i < $dataCount; $i++) {
                                                        $data = $allData[$i];
                                                        if ($data['ChooseEuropeanPlans'] != null && $data['ChooseEuropeanPlans'] == 1) {
                                                            $isAnyEuropePlan = true;
                                                        }
                                                        $buses = $data['Buses'];
                                                        $busCount = count($buses);
                                                        $linkIDCounter = $data['Counter'];
                                                        $min_period = $data['minimumPeriod'];
                                                        $max_period = $data['maximumPeriod'];

                                                        $BundlePlanName = $data['bundles'][0]['PlanName'];

                                                        $orderPlanName = $data['bundles'][0]['BundleText'];
                                                        $orderPlanData = $data['bundles'][0]['ExtendedDataPackageName'];
                                                        $orderPlanCall = $data['bundles'][0]['CallPackageName'];
                                                        $orderPlanSMS = $data['bundles'][0]['SMSPackageName'];
                                                        $orderPlanInsurance = $data['bundles'][0]['IncludedInsurance'];
                                                        $orderPlanInsuranceStr = "Not Included!";
                                                        if ($orderPlanInsurance) {
                                                            $orderPlanInsuranceStr = "Included!";
                                                        }
                                                        $orderQtyThis = $orderQuantities[$i];
                                                        $pageName = "";
                                                        $allData[$i]['PageName'] = "";
                                                        if (strpos($BundlePlanName, 'Student') !== false) {
                                                            if ($linkIDCounter == 18154) {
                                                                $pageName = 'bhlt';
                                                                $allData[$i]['PageName'] = 'bhlt';
                                                                $allData['isBhltPlan'] = 'YES';
                                                            } else {
                                                                $pageName = 'schools';
                                                                $allData[$i]['PageName'] = 'schools';
                                                            }
                                                        }
                                                    ?>
                                                        <?php if ($i > 0) { ?>
                                                            <div class="customDivider"></div>
                                                        <?php } ?>
                                                        <div class="parent pl-3 pr-3 serviceDateContainer <?php echo $i ?>" min_period='<?php echo $min_period ?>' max_period='<?php echo $max_period ?>' IsEuropePlan='<?php echo $data['ChooseEuropeanPlans'] ?>' pageName="<?php echo $allData[$i]['PageName']; ?>" planName="<?php echo str_replace("<br>", " ", str_replace("<br />", " ", $orderPlanName)) ?>" planName2="<?php echo $data['bundles'][0]['PlanName'] ?>" ContractType='<?php echo $data['contractType'] ?>' ProviderCode='<?php echo $data['ProviderCode'] ?>' CompanyCode='<?php echo $data['CompanyCode'] ?>' AccessoryIdAndQuantity='' txtSignupRep="" LinkTypeCode='<?php echo $data['LinkTypeCode'] ?>' AgentCode='<?php echo $data['AgentCode'] ?>' SubAgentCode='<?php echo $data['SubAgentCode'] ?>' BaseCode='<?php echo $data['SubAgentCode'] ?>' BundleId='<?php echo $data['bundles'][0]['Counter'] ?>' CallPackageCode='<?php echo $data['bundles'][0]['CallPackageCode'] ?>' CallPackageName='<?php echo $data['bundles'][0]['CallPackageName'] ?>' DataPackageCode='<?php echo $data['bundles'][0]['ExtendedDataPackageCode'] ?>' DataPackageName='<?php echo $data['bundles'][0]['ExtendedDataPackageName'] ?>' DataPackgeSize='<?php echo $data['bundles'][0]['PackageSize'] ?>' Deposit='<?php echo $data['DepositAmount'] ?>' EquipmentCode='<?php echo $data['HaveSimEquipmentCode'] ?>' GroupName='<?php echo $data['GroupName'] ?>' Insurance='<?php echo $data['Insurance'] ?>' ParentLinke='<?php echo $data['bundles'][0]['ParentLink'] ?>' PlanCode='<?php echo $data['bundles'][0]['PlanCode'] ?>' PlanName='<?php echo $data['bundles'][0]['PlanName'] ?>' SMSPackageCode='<?php echo $data['bundles'][0]['SMSPackageCode'] ?>' SMSPackageName='<?php echo $data['bundles'][0]['SMSPackageName'] ?>' SubLink='<?php echo $data['SubLink'] ?>' SublinkId='<?php echo $data['Counter'] ?>'>
                                                            <?php for ($j = 1; $j <= $orderQtyThis; $j++) { ?><div class="orderContent d-none <?php echo $j ?>" orderCN="<?php echo $j ?>" data="<?php echo $orderPlanData ?>" call="<?php echo $orderPlanCall ?>" sms="<?php echo $orderPlanSMS ?>" insuarance='<?php echo $orderPlanInsuranceStr ?>' equipment="" bundleRate='<?php echo $data['bundles'][0]['BundleRate'] ?>' bundlePeriod='<?php echo $data['bundles'][0]['BundlePeriod'] ?>'></div><?php } ?>
                                                            <div class="d-none programUrlPath" bId="<?php echo $bundleIDs[$i] ?>" linkId="<?php echo $linkIDs[$i] ?>" qty="<?php echo $orderQuantities[$i] ?>"></div>
                                                            <?php
                                                            $busSelectHide = $data['BusSelectHide'];
                                                            $b = $bundle_id;
                                                            $link_id = $link_id;
                                                            $busRequireInfo = $data['busRequireInfo'];
                                                            $busRequireInfoCount = count($busRequireInfo);

                                                            if (is_null($busSelectHide)) {
                                                                $busSelectHide = false;
                                                            }

                                                            if ($b != null &&  $b = 376) {
                                                                if ($link_id != null  && ($linkid == 15614 || $linkid == 15613)) {
                                                                    $busSelectHide = true;
                                                                }
                                                            }
                                                            if ($busCount > 0  &&  $busSelectHide == false && $busRequireInfoCount > 0) {
                                                                $programOrBus = "bus";
                                                                if ($data['ParentLink'] == "amh") {
                                                                    $programOrBus = "program";
                                                                }

                                                            ?>
                                                                <div class="form-group">
                                                                    <?php
                                                                    if ($data['BusSelectQuestion'] != null && $data['BusSelectQuestion'] != "") { ?>
                                                                        <label class="innner-label"> <?php echo $data['BusSelectQuestion'] ?></label>

                                                                    <?php          } else { ?>
                                                                        <label class="innner-label"> Which <?php echo $programOrBus ?> are you on? </label>
                                                                    <?php       } ?>

                                                                    <select class="form-control bus" qty="<?php echo $ord_qty; ?>" b="<?php echo $bundle_id; ?>">
                                                                        <option value="">
                                                                            select
                                                                        </option>
                                                                        <?php foreach ($buses as $bus) {
                                                                            $selected = '';
                                                                            if ($bus['Counter'] == $linkIDs[$i]) {
                                                                                $selected = 'selected';
                                                                            }
                                                                        ?>

                                                                            <option <?php echo $selected; ?> linkid="<?php echo $bus['Counter'] ?>"> <?php echo $bus['GroupName']; ?> </option>
                                                                        <?php     } ?>
                                                                    </select>
                                                                    <p class="busError" style="color:red; font-size: 12px; margin-top: -2px;"></p>
                                                                </div>
                                                            <?php }  ?>

                                                            <div class="parentDiv cloneDateDefault">
                                                                <div class="title">
                                                                    <h2> Select the service dates for
                                                                        <?php echo str_replace("<br>", " ", $orderPlanName) ?><span class="hiddenOrderNum"> </span>
                                                                    </h2>

                                                                    <?php
                                                                    $min = explode('|', $min_period);
                                                                    $max = explode('|', $max_period);
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
                                                                    } else {
                                                                        if ($min[1] == 'd') {
                                                                            $minDayOrMonth = "days";
                                                                        } else if ($min[1] == 'm') {
                                                                            $minDayOrMonth = "month";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php if ($pageName == 'bhlt' || $pageName == 'schools') { ?>
                                                                        <p style="color: red;">Please note: This is a
                                                                            month-to-month rental agreement. The rental will
                                                                            only be terminated once TalknSave receives official
                                                                            notice from the customer to cancel, followed by a
                                                                            confirmation from TalknSave.</p>
                                                                    <?php } ?>


                                                                    <!-- This service is provided for minimum duration of
                                                                <?php echo $min[0]; ?>
                                                                <?php echo $minDayOrMonth; ?>
                                                                <?php echo ($max_period) ? ("and maximum duration of") : ""; ?>
                                                                <?php echo $max[0]; ?>
                                                                <?php echo $maxDayOrMonth; ?> . -->

                                                                </div>
                                                                <div class="row">
                                                                    <!-- <?php if ($min_period) : ?>
                                                                <div class="form-group col-lg-6 col-md-6 col-12 mb-0">
                                                                    <label class="inner-label">Begin date:</label>
                                                                    <input
                                                                        class="form-control begin_date validateDate required custom-date-input"
                                                                        autocomplete="off" data-toggle="datepicker"
                                                                        placeholder="MM/DD/YYYY" required>
                                                                    <p class="dateError"
                                                                        style="color:red; font-size: 12px; margin-top: -2px;">
                                                                    </p>

                                                                </div>
                                                                <?php endif; ?> -->
                                                                    <div class="title px-3">
                                                                        <h2>Select the service dates</h2>

                                                                        <?php
                                                                        $min = explode('|', $min_period);
                                                                        $max = explode('|', $max_period);

                                                                        $LockProgramStartDate = $data["dateProgramStart"];
                                                                        $LockProgramEndDate = $data["dateLeaveIL"];
                                                                        $IsLockProgramDates = $data["optLockProgramDates"];

                                                                        $startDate = "";
                                                                        $isBeginDateLocked = "";
                                                                        $endDate = "";
                                                                        $isEndDateLocked = "";

                                                                        $currentDate = date("m/d/Y");
                                                                        if ($LockProgramStartDate != null) {
                                                                            $startDate = date("m/d/Y", strtotime($LockProgramStartDate));
                                                                            $strTimeStartDate = strtotime($startDate);
                                                                            $strTimeCurrentDate = strtotime($currentDate);
                                                                            if ($strTimeStartDate < $strTimeCurrentDate) {
                                                                                $startDate = $currentDate;
                                                                            }
                                                                        }
                                                                        if ($startDate != null && $startDate != "" && $IsLockProgramDates) {
                                                                            $isBeginDateLocked = "disabled";
                                                                        }

                                                                        if ($LockProgramEndDate != null) {
                                                                            $endDate = date("m/d/Y", strtotime($LockProgramEndDate));
                                                                            $strTimeendDate = strtotime($startDate);
                                                                            $strTimeCurrentDate = strtotime($currentDate);
                                                                            if ($strTimeendDate < $strTimeCurrentDate) {
                                                                                $endDate = "";
                                                                            }
                                                                        }
                                                                        if ($endDate != null && $endDate != "" && $IsLockProgramDates) {
                                                                            $isEndDateLocked = "disabled";
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
                                                                        } else {
                                                                            if ($min[1] == 'd') {
                                                                                $minDayOrMonth = "days";
                                                                            } else if ($min[1] == 'm') {
                                                                                $minDayOrMonth = "month";
                                                                            }
                                                                        }
                                                                        ?>
                                                                        This service is provided for a minimum duration of <?php echo $min[0]; ?> <?php echo $minDayOrMonth; ?> <?php echo ($max_period) ? ("with a maximum duration of") : ""; ?> <?php echo $max[0]; ?> <?php echo $maxDayOrMonth; ?> .
                                                                        </p>




                                                                    </div>
                                                                    <?php if ($min_period) :
                                                                        $currentDate =  date("m/d/Y");
                                                                        $currentDate = strtotime($currentDate);
                                                                        $strStartDate = $startDate;
                                                                        $strStartDate = strtotime($startDate);
                                                                    ?>
                                                                        <div class="form-group col-lg-6 col-md-6 col-12 mb-0">
                                                                            <label class="inner-label">Begin date:</label>
                                                                            <input class="form-control begin_date validateDate required custom-date-input" autocomplete="off" name="begin_date" data-toggle="datepicker" readonly value="<?php echo ($strStartDate < $currentDate) ? '' : $startDate; ?>" placeholder="MM/DD/YYYY" required <?php echo $isBeginDateLocked; ?>>
                                                                            <p class="dateError" style="color:red; font-size: 12px; margin-top: -2px;"></p>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if ($data['optLeaveILrequest']) : ?>
                                                                        <div class="form-group col-lg-6 col-md-6 col-12 mb-0">
                                                                            <label class="inner-label">End date:</label>
                                                                            <input class="form-control validateDate required end_date" autocomplete="off" name="" data-toggle="datepicker" value="<?php echo $endDate; ?>" placeholder="MM/DD/YYYY" required <?php echo $isBeginDateLocked; ?>>
                                                                            <p class="dateError" style="font-size: 12px; color: red;">
                                                                            </p>
                                                                        </div>



                                                                        <p class="error_day mb-0" style="font-size: 12px; color: red;"></p>

                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <?php if ($orderQuantities[$i] > 1) { ?>
                                                                <div class="form-group  row form-check" style="background: transparent;border: none;">
                                                                    <input class="form-check-input datechbx" data-orderqty="<?php echo $orderQuantities[$i]; ?>" id="" type="checkbox" value="" checked>
                                                                    <label class="form-check-label check-label terms">
                                                                        Save this choice for the rest of the products in the
                                                                        cart
                                                                    </label>
                                                                </div>

                                                            <?php } ?>

                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($dataCount > 0) { ?>
                                                        <button type="button" class="next btn btn-block  " value="Next" id="next1">Next <i class="icon-right-thin"></i></button>
                                                    <?php } ?>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="need_sim">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous1"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-8 pl-0 pr-0">
                                                    <?php
                                                    for ($i = 0; $i < $dataCount; $i++) {
                                                        $data = $allData[$i];

                                                        $equipments = $data['bundles'][0]['equipments'];
                                                        $orderPlanName = $data['bundles'][0]['BundleText'];
                                                    ?>
                                                        <?php if ($i > 0) { ?>
                                                            <div class="customDivider"></div>
                                                        <?php } ?>
                                                        <div class="parent  pl-3 pr-3 equipmentContainer">
                                                            <div class="cloneSimDefault parentDiv simCount">
                                                                <div class="title">
                                                                    <h2 style="margin-bottom:0px; display: inline-block;">
                                                                        Please choose your equipment for
                                                                        <?php echo str_replace("<br>", " ", $orderPlanName) ?>
                                                                        <span class="hiddenOrderNum"></span>
                                                                    </h2>
                                                                    <a href="#" class="learnMore PhoneSimInfo cursorP">
                                                                        Learn more </a>
                                                                </div>
                                                                <?php
                                                                $countSim = 0;
                                                                foreach ($equipments as $equipment) :
                                                                    if ($equipment['IsSim'] == false) {
                                                                        continue;
                                                                    }
                                                                ?>
                                                                    <div class="form-group">
                                                                        <div class="form-check">

                                                                            <input issmartphone="<?php echo ($equipment['IsSmartPhone']) ? 'true' : ''; ?>" issim="<?php echo ($equipment['IsSim']) ? 'true' : ''; ?>" issns="<?php echo ($equipment['IsSns']) ? 'true' : ''; ?>" kosher="<?php echo ($equipment['kosher']) ? 'true' : ''; ?>" data-cost="<?php echo $equipment['ECost'] ?> " class="form-check-input equipmentSim" onclick="AddInsuranceBox();" type="radio" value="<?php echo $equipment['EquipmentId']; ?>" data-code="<?php echo $equipment['EquipmentCode']; ?>" notes="<?php echo ($equipment['Notes']) ? $equipment['Notes'] : ''; ?> " orderNo="<?php echo $i ?>" name="equipment_order_<?php echo $i; ?>" data-name="<?php echo $equipment['name']; ?>" required <?php echo ($countSim == 0) ? checked
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                : ''; ?>>
                                                                            <label class="form-check-label radio-label">
                                                                                <?php echo $equipment['name']; ?>
                                                                                <?php
                                                                                if ($equipment['EquipmentId'] != 9999 && ($equipment['BundlePopUp'] != '')) {
                                                                                    $dataPopup = $equipment['BundlePopUp'];
                                                                                    // $dataPopup = str_replace('"', "'", $dataPopup);
                                                                                    // $dataPopup = preg_replace('/\\\\/', '', $dataPopup);
                                                                                ?>
                                                                                    <i class="icon-info-circled right-align cursorP simPopup" data-popup='<?php echo $dataPopup; ?>' id="<?php echo $equipment['EquipmentId']; ?>">
                                                                                    </i>
                                                                                <?php }

                                                                                if ($equipment['EquipmentId'] == 3290) {
                                                                                ?>
                                                                                    <i class="icon-info-circled right-align cursorP simPopup" data-popup="<?php echo $dataPopup; ?>" id="<?php echo $equipment['EquipmentId']; ?>">
                                                                                    </i>
                                                                                <?php
                                                                                }

                                                                                ?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                    $countSim++;


                                                                endforeach;
                                                                ?>
                                                                <?php
                                                                foreach ($equipments as $equipment) :
                                                                    if ($equipment['IsSim'] == true) {
                                                                        continue;
                                                                    }
                                                                ?>
                                                                    <div class="form-group">
                                                                        <div class="form-check">

                                                                            <input issmartphone="<?php echo ($equipment['IsSmartPhone']) ? 'true' : ''; ?>" issim="<?php echo ($equipment['IsSim']) ? 'true' : ''; ?>" issns="<?php echo ($equipment['IsSns']) ? 'true' : ''; ?>" kosher="<?php echo ($equipment['kosher']) ? 'true' : ''; ?>" data-cost="<?php echo $equipment['ECost'] ?> " class="form-check-input equipmentSim" onclick="AddInsuranceBox();" type="radio" value="<?php echo $equipment['EquipmentId']; ?>" data-code="<?php echo $equipment['EquipmentCode']; ?>" notes="<?php echo ($equipment['Notes']) ? $equipment['Notes'] : ''; ?> " orderNo="<?php echo $i ?>" name="equipment_order_<?php echo $i; ?>" data-name="<?php echo $equipment['name']; ?>" required <?php echo ($countSim == 0) ? checked : ''; ?>>
                                                                            <label class="form-check-label radio-label">
                                                                                <?php echo $equipment['name']; ?>
                                                                                <?php
                                                                                if ($equipment['EquipmentId'] != 9999 && ($equipment['BundlePopUp'] != '')) {
                                                                                    $dataPopup = $equipment['BundlePopUp'];
                                                                                    // $dataPopup = str_replace('"', "'", $dataPopup);
                                                                                ?>

                                                                                    <i class="icon-info-circled right-align cursorP simPopup" data-popup='<?php echo $dataPopup; ?>' id="<?php echo $equipment['EquipmentId']; ?>">
                                                                                    </i>
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

                                                            <?php if ($orderQuantities[$i] > 1) { ?>
                                                                <div class="form-group mt-3 row form-check" style="background: transparent;border: none;">
                                                                    <input class="form-check-input simCheckBox" data-orderqty="<?php echo $orderQuantities[$i]; ?>" id="" type="checkbox" value="" checked>
                                                                    <label class="form-check-label check-label terms">
                                                                        Save this choice for the rest of the products in the
                                                                        cart
                                                                    </label>
                                                                </div>


                                                            <?php } ?>

                                                        </div>
                                                    <?php } ?>
                                                    <button type="button" name="next" class="next btn btn-block" id="next2">Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <?php if ($isAnyEuropePlan) { ?>


                                            <fieldset id="roamingPlan_field">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button" class="previous btn btn-block" id="previous2"><i class="icon-left-open-big"></i></button>
                                                    </div>
                                                    <div class="col-md-6 pl-0 pr-0">
                                                        <div>
                                                            <div class="">


                                                                <?php
                                                                for ($i = 0; $i < $dataCount; $i++) {
                                                                    $data = $allData[$i];
                                                                    $orderPlanName2 = $data['bundles'][0]['BundleText'];
                                                                    if ($data['ChooseEuropeanPlans'] != null && $data['ChooseEuropeanPlans'] == 1) { ?>
                                                                        <div class="title" style='
    margin-bottom: 18px;'>
                                                                            <h2>Choose Your Roaming Plan for
                                                                                <?php echo str_replace("<br>", " ", str_replace("<br />", " ", $orderPlanName2)) ?>
                                                                                <span class="OptionalOrderNum"></span>
                                                                            </h2>
                                                                        </div>
                                                                        <div>
                                                                            <div class=" ">

                                                                                <?php
                                                                                $countSim2 = 0;
                                                                                foreach ($data['EuropePlans'] as $europePlan) : ?>

                                                                                    <div class="form-group">
                                                                                        <div class="form-check" style="border-bottom: 0;border-radius: 0;">

                                                                                            <input name="roamingPlan<?php echo $i ?>" type="radio" <?php echo ($countSim2 == 0)
                                                                                                                                                        ? checked : ''; ?> checkBoxID="
                                                                            <?php echo $europePlan['chckbxID'] ?>" Quantity="
                                                                            <?php echo $europePlan['Quantity'] ?>" Plan_code="
                                                                            <?php echo $europePlan['Plan_code'] ?>" Equipment_code="
                                                                            <?php echo $europePlan['Equipment_code'] ?>" plan_name="
                                                                            <?php echo $europePlan['name'] ?>" plan_img="
                                                                            <?php echo $europePlan['Img'] ?>" plan_price="
                                                                            <?php echo $europePlan['rate'] ?>" class="roaming_plans
                                                                            <?php echo $i ?>" roamingOrderNum="
                                                                            <?php echo $i ?>" />
                                                                                            <label class="form-check-label radio-label">
                                                                                                <?php echo $europePlan['chckBxName'];
                                                                                                $countSim2 = $countSim2 + 1;
                                                                                                $countSim2++; ?>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div style="background-color: white;padding: 0px 9px 9px 45px;border: 1px solid #c7c7c7;margin: 0px 0px 20px 0px;border-top: 0;">
                                                                                            <?php echo $europePlan['CommentText'] ?>
                                                                                        </div>
                                                                                    </div>

                                                                                <?php endforeach;
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                <?php    }
                                                                } ?>




                                                            </div>
                                                        </div>
                                                        <button type="button" class="next btn btn-block" id="3next">Next <i class="icon-right-thin"></i></button>
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                            </fieldset>
                                        <?php } ?>



                                        <fieldset id="optional_add_ons">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous5"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php
                                                    $customDividerCount = 0;
                                                    for ($i = 0; $i < $dataCount; $i++) {
                                                        $data = $allData[$i];
                                                        $bundles = $data['bundles'];
                                                        $kntCountries = $bundles[0]['kntCountries'];
                                                        $orderPlanName = $data['bundles'][0]['BundleText'];
                                                        $ifChoice = false;
                                                    ?>

                                                        <div class="parent pl-3 pr-3 OptionalAddOnContainer">
                                                            <div class="stayLocalCloneDefault parentDiv">

                                                                <?php if (count($kntCountries) != 0 && $kntCountries[0]['DirectDisplayName'] != 'No, Thank you') {
                                                                    $ifChoice = true ?>
                                                                    <?php if ($i > $customDividerCount) { ?>
                                                                        <div class="customDivider"></div>
                                                                    <?php } ?>
                                                                    <div class="title">
                                                                        <h2>Optional add ons for
                                                                            <?php echo str_replace("<br>", " ", $orderPlanName) ?>
                                                                            <span class="OptionalOrderNum"></span>
                                                                        </h2>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="large-inner-label" style="margin-bottom: 10px;"><span> "Stay local"
                                                                                number <span style="color: red;"> * </span>
                                                                            </span>
                                                                            <a class="text-right cursorP staticLearnMore" onclick="openPopup('#wrap_popup2')" id="">Learn
                                                                                more</a>
                                                                        </label>
                                                                        <div class="select">
                                                                            <select class="form-control  optionalAdd stay_local stayLocalSelect stayLocalPopup " id="stay_local_order_<?php echo $i; ?>">
                                                                                <option value="" selected>Select</option>
                                                                                <?php foreach ($kntCountries as $kntCountry) : ?>
                                                                                    <option data-kntcode=<?php echo
                                                                                                            $kntCountry['KNTCode'] ?> data-country="
                                                                            <?php echo $kntCountry['Descr']; ?>" value="
                                                                            <?php echo $kntCountry['DirectDisplayName']; ?>">
                                                                                        <?php echo $kntCountry['DirectDisplayName']; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if (count($bundles[0]['smss']) != 1 && $bundles[0]['smss'][0]['SMSPackageName'] != 'No, Thank you') {
                                                                    $ifChoice = true ?>
                                                                    <div class="form-group">
                                                                        <label class="large-inner-label" style="margin-bottom: 10px;"><span> International
                                                                                text plan <span style="color: red;"> * </span>
                                                                            </span>
                                                                            <a id="" id class="text-right cursorP international">Learn
                                                                                more</a> </label>
                                                                        <div class="select">
                                                                            <select class="form-control optionalAdd internationalSelect internationalPopup" id="smsPackageName_order_<?php echo $i; ?>">
                                                                                <option value="" selected>Select</option>
                                                                                <?php foreach ($bundles[0]['smss'] as $sms) :
                                                                                ?>
                                                                                    <option class="form-control" value="<?php echo $sms['SMSPackageName']; ?>" smsCode="<?php echo $sms['SmsPackageCode']; ?>">
                                                                                        <?php echo $sms['SMSPackageName']; ?>
                                                                                    </option>

                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                            <?php if ($ifChoice) {
                                                                if ($orderQuantities[$i] > 1) { ?>
                                                                    <div class="form-group mt-3 row form-check" style="background: transparent;border: none;margin-left:-6px;">
                                                                        <input class="form-check-input stayLocalCheckBox" id="" data-orderno="<?php echo ($i + 1); ?>" data-orderqty="<?php echo $orderQuantities[$i]; ?>" type="checkbox" value="" checked>
                                                                        <label class="form-check-label check-label terms">
                                                                            Save this choice for the rest of the products in the
                                                                            cart
                                                                        </label>
                                                                    </div>
                                                            <?php }
                                                            } else {
                                                                $customDividerCount++;
                                                            } ?>
                                                        </div>
                                                    <?php } ?>



                                                    <button type="button" class="next btn btn-block" id="next6" disabled>Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="billing_info">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous6"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-8 pl-3 pr-3">
                                                    <div class="title" style="margin-bottom: 39px;">
                                                        <h2>Add your billing information</h2>
                                                        <h4 class="loginBillInfo">Or <a class="cursorP" id="LoginDetails" onclick="openPopup('#wrap_popup3')" style="text-decoration: underline;">Login</a> with your existing Account</h4>
                                                    </div>
                                                    <!--                                                     <p class="billingP" style='color:red; font-size: 12px; margin-top: -2px;'>All fields are required !</p> -->
                                                    <div class="form-group">
                                                        <label class="inner-label">First name (phone user) <span style="color: red;"> *</span></label>
                                                        <input type="text" class="form-control billing" name="billing_fname">
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="inner-label">Last name <span style="color: red;">
                                                                *</span></label>
                                                        <input type="text" class="form-control billing" name="billing_lname">
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="inner-label">Email <span style="color: red;">
                                                                *</span></label>
                                                        <small class="form-text">This email address will receive all
                                                            confirmations and bills.</small>
                                                        <input type="email" name="billing_email" class="form-control validateEmail billing billing_email">
                                                        <small class="invalidEmail" style='color:red; font-size: 12px;'></small>
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="inner-label"> Confirm Email <span style="color: red;"> *</span></label>
                                                        <input type="email" class="form-control confirmBillingEmail validateEmail billing">
                                                        <small class="invalidEmail" style='color:red; font-size: 12px;'></small>
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="inner-label">Phone Number <span style="color: red;"> *</span></label>
                                                        <div class="input-group mb-2">

                                                            <input type="number" class="form-control billing " name="billing_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" style="width: 100%;">
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Address <span style="color: red;">
                                                                *</span></label>
                                                        <input type="text" name="billing_address" class="form-control billing">
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">City <span style="color: red;">
                                                                *</span></label>
                                                        <input type="text" name="billing_city" class="form-control billing">
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Country <span style="color: red;">
                                                                *</span></label>
                                                        <div class="select">
                                                            <select class="form-control billing" id="billing_country">
                                                                <option value="" selected>Select</option>
                                                                <?php foreach ($data['countries'] as $country) :
                                                                ?>
                                                                    <option class="form-control" id="<?php echo $country['CountryID']; ?>" value="<?php echo $country['CountryName']; ?>">
                                                                        <?php echo $country['CountryName']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'>
                                                            </p>
                                                        </div>


                                                    </div>
                                                    <div class="form-group d-none" id='USA_state'>
                                                        <label class="inner-label">State/Province. <span style="color: red;"> *</span></label>
                                                        <div class="select">
                                                            <select class="form-control" id="stateProvinceUSA">
                                                                <option value="" selected>Select</option>
                                                                <?php foreach ($data['UsaStates'] as $state) :
                                                                ?>
                                                                    <option class="form-control" state-code="<?php echo $state['StateCode']; ?>" value="<?php echo $state['StateName']; ?>">
                                                                        <?php echo $state['StateName']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'>
                                                            </p>
                                                        </div>

                                                    </div>

                                                    <div class="form-group d-none" id='Canada_states'>
                                                        <label class="inner-label">State/Province. <span style="color: red;"> *</span></label>
                                                        <div class="select">
                                                            <select class="form-control" id="stateProvinceCanada">
                                                                <option value="" selected>Select</option>
                                                                <?php foreach ($data['CanadaStates'] as $state) :
                                                                ?>
                                                                    <option class="form-control" state-code="<?php echo $state['StateCode']; ?>" value="<?php echo $state['StateName']; ?>">
                                                                        <?php echo $state['StateName']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'>
                                                            </p>
                                                        </div>

                                                    </div>

                                                    <div class="form-group zipCode">
                                                        <label class="inner-label">Zip/Post code <span style="color: red;"> *</span></label>
                                                        <input type="text" maxlength="8" class="zipCodeValidate" name="billing_zip" class="form-control billing" style="width:100%">
                                                        <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <?php if ($allData['isBhltPlan'] == 'YES') { ?>
                                                        <div class="form-group">
                                                            <label class="inner-label">Talmid's Name <span style="color: red;"> *</span> </label>
                                                            <input type="text" name="stu_name" class="form-control billing  ">

                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">Father's Name <span style="color: red;"> *</span> </label>
                                                            <input type="text" name="parent_name" class="form-control billing ">

                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">Name of Yeshiva in the US<span style="color: red;"> *</span> </label>
                                                            <input type="text" name="yeshiva_name" class="form-control  ">

                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">Name of His Rabbi in the US<span style="color: red;"> *</span> </label>
                                                            <input type="text" name="rebbe_name" class="form-control billing  ">

                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">The Yeshiva you will be attending in
                                                                Israel(optional).<span style="color: red;"> </span> </label>
                                                            <!-- 														<small class="form-text">we will contact you on this number to arrange your phone delivery in Israel.</small> 	 -->
                                                            <!--                                                         <input type="text"  style="width: 100%;" name="whatspapp_num" class="form-control " > -->
                                                            <select type="text" style="width: 100%;" name="whatspapp_num" class="form-control ">
                                                                <option value="I am not sure">I am not sure</option>
                                                                <option value="Brisk">Brisk</option>
                                                                <option value="Kollel Tiferes Tzvi (Rabbi M.A. Rosengarten)">
                                                                    Kollel Tiferes Tzvi (Rabbi M.A. Rosengarten)</option>
                                                                <option value="Mir">Mir</option>
                                                                <option value="Ner Moshe (R’ Shalom Schechter)">Ner Moshe
                                                                    (R’ Shalom Schechter)</option>
                                                                <option value="Tiferes Chaim (Pragers)">Tiferes Chaim
                                                                    (Pragers)</option>
                                                                <option value="Yagdil">Yagdil</option>
                                                                <option value="Yeshivas HaGramad (Reb Dovid)">Yeshivas
                                                                    HaGramad (Reb Dovid)</option>
                                                                <option value="Zos L’Yaakov (Rabbi Y.D. Shechter)">Zos
                                                                    L’Yaakov (Rabbi Y.D. Shechter)</option>
                                                            </select>
                                                            <p class="billingR" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        </div>
                                                    <?php } ?>


                                                    <button type="button" class="next btn btn-block" id="next7">Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>


                                        <fieldset id="shipping_option">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous7"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-8 pl-3 pr-3">
                                                    <div class="title" style="    margin-bottom: 36px;">
                                                        <h2>Add shipping details</h2>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="large-inner-label"><span> Shipping method <span style="color: red;"> *</span> </span></label>
                                                        <p style="color: green;font-size: 14px;">Fees include handling
                                                            charges. Ordering more than one device or SIM?
                                                            You will see a 50% discount on shipping and handling for
                                                            each additional item!</p>
                                                        <div class="select">

                                                            <select class="form-control" id="shipping_method">
                                                                <option selected>Select</option>
                                                                <?php
                                                                $oldCountry = '';
                                                                $currentCountry = '';
                                                                $counter = 0;
                                                                foreach ($shippingData[0] as $shipping) :
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
                                                                        <optgroup label="<?php echo $currentCountry; ?>">
                                                                        <?php
                                                                        $oldCountry = $currentCountry;
                                                                    }
                                                                        ?>


                                                                        <option has-mifi="<?php echo $shipping['HasMifi'] ?>" has-netstick="<?php echo $shipping['HasNetstick'] ?>" opt-require-ship-address="<?php echo $shipping['optRequireShipAddress']; ?> " base-code="<?php echo ($shipping['basecode']) ? $shipping['basecode'] : '' ?>" opt-local-pickup="<?php echo $shipping['optLocalPickup'] ?> " shipmethod="<?php echo $shipping['shippingMethodNEW']; ?>" has-phones="<?php echo ($shipping['hasPhones']) ? 1 : 0; ?>" shipping-notes="<?php echo ($shipping['shippingNotes']) ? $shipping['shippingNotes'] : '' ?>" data-cost="<?php echo $shipping['cost']; ?>" data-title="<?php echo $shipping['shippingName']; ?>" data-desc="<?php echo $shippingDesc; ?> " value="<?php echo $shipping['shippingID']; ?>">
                                                                            <?php echo $shipping['shippingName']; ?>
                                                                            &nbsp;&nbsp; <span>
                                                                                <?php
                                                                                if ($shipping['cost'] == 0) {
                                                                                    echo "Free";
                                                                                } else {
                                                                                    $price = $shipping['cost'];
                                                                                    echo '$' . $price;
                                                                                }
                                                                                ?>

                                                                            </span>
                                                                        </option>


                                                                    <?php
                                                                    $counter += 1;
                                                                endforeach;
                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label class="large-inner-label shipping_heading"><span> Shipping
                                                            address <span style="color: red;"> *</span> </span></label>
                                                    <div class="shipping_option">
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input  " type="radio" name="shipping_address" value="yes">
                                                                <label class="form-check-label radio-label">Use my
                                                                    billing address</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input shipping" type="radio" name="shipping_address" value="no">
                                                                <label class="form-check-label radio-label">I'd like to
                                                                    enter a different
                                                                    address</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($data['optRequestProgramName'] == true) { ?>
                                                        <div class="form-group ">
                                                            <label class="inner-label">School/Program Name<span style="color: red;"> *</span></label>
                                                            <input type="text" class="form-control schoolName">
                                                            <p class="schoolError" style="color:red; font-size: 12px; margin-top: -2px;"></p>
                                                        </div>

                                                    <?php } ?>
                                                    <div class="shipping_info" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="inner-label">Shipping name <span style="color: red;"> *</span></label>
                                                            <input type="text" name="shipping_name" class="form-control shipping">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">Phone Number <span style="color: red;"> *</span></label>
                                                            <div class="input-group mb-2">

                                                                <input type="text" class="form-control shipping shipping_phone_number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" name="shipping_phone" style="width: 100%">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">Address <span style="color: red;"> *</span></label>
                                                            <input type="text" class="form-control shipping" id="shipAddress" name="shipping_address">
                                                        </div>
                                                        <div class="form-group d-none" id='USA_stateP'>
                                                            <label class="inner-label">State <span style="color: red;">
                                                                    *</span></label>
                                                            <div class="select">
                                                                <select class="form-control" id="shippingUSA">
                                                                    <option value="" selected>Select</option>
                                                                    <?php foreach ($data['UsaStates'] as $state) :
                                                                    ?>
                                                                        <option class="form-control" state-code="<?php echo $state['StateCode'] ?>" value="<?php echo $state['StateName']; ?>">
                                                                            <?php echo $state['StateName']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>

                                                            </div>

                                                        </div>

                                                        <div class="form-group d-none" id='Canada_statesP'>
                                                            <label class="inner-label">State. <span style="color: red;">
                                                                    *</span></label>
                                                            <div class="select">
                                                                <select class="form-control" id="shippingCanada">
                                                                    <option value="" selected>Select</option>
                                                                    <?php foreach ($data['CanadaStates'] as $state) :
                                                                    ?>
                                                                        <option class="form-control" state-code="<?php echo $state['StateCode'] ?>" value="<?php echo $state['StateName']; ?>">
                                                                            <?php echo $state['StateName']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label class="inner-label">City <span style="color: red;">
                                                                    *</span></label>
                                                            <input type="text" class="form-control shipping" name="shipping_city">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="inner-label">Zip/Post code <span style="color: red;"> *</span></label>
                                                            <input type="text" maxlength="8" class="form-control zipCodeValidate shipping" name="shipping_zip">
                                                        </div>
                                                    </div>
                                                    <div class="leaving_date" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="control-label inner-label">The date you will
                                                                be leaving this
                                                                address <span style="color: red;"> *</span></label>
                                                            <input class="form-control" autocomplete="nope" name="date_to_leave" id="date_to_leave" placeholder="MM/DD/YYYY">
                                                            <p class="shippingError" style="color:red; font-size: 12px; margin-top: -2px;">
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <button type="button" class="next btn btn-block" id="next8" disabled>Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

                                        <fieldset id="shipping_Acc">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous12"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-8 pl-3 pr-3">
                                                    <?php if (!empty($bundles[0]['optionals'])) { ?>
                                                        <div class="optional-heading" id="bonus-optional">
                                                            Bonus! Your order qualifies for the following special deals!
                                                        </div>

                                                        <div class="row" style="color:#000913">
                                                            <?php foreach ($bundles[0]['optionals'] as $optional) : ?>
                                                                <div class="card phonecard">
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

                                                                    $Plan_code_55 = $optional['Plan_code_55'];
                                                                    $Plan_code_100 = $optional['Plan_code_100'];
                                                                    if ($Plan_code_55 > 0 && $Plan_code_100 > 0) {
                                                                        if ($data['ProviderCode'] == 55) {
                                                                            $PlanCode = $Plan_code_55;
                                                                        } else if ($data['ProviderCode'] == 100) {
                                                                            $PlanCode = $Plan_code_100;
                                                                        }
                                                                    }
                                                                    ?>


                                                                    <div class="cardBody" style="padding: 10px 29px;" ClientCode=" <?php echo $ClientCode; ?>" Deposit=" <?php echo $Deposit; ?>" CouponCode=" <?php echo $CouponCode; ?>" EquipmentCode=" <?php echo $EquipmentCode; ?>" Insurance=" <?php echo $Insurance; ?>" OptionalCode=" <?php echo $OptionalCode; ?>" OptionalFeeDesc=" <?php echo $OptionalFeeDesc; ?>" OptionalImg=" <?php echo $OptionalImg; ?>" OptionalName=" <?php echo $OptionalName; ?>" OptionalType=" <?php echo $OptionalType; ?>" OptionText=" <?php echo $OptionText; ?>" PlanCode=" <?php echo $PlanCode; ?>" RequiredInsurance=" <?php echo $RequiredInsurance; ?>" RequiredOperationSystem=" <?php echo $RequiredOperationSystem; ?>">
                                                                        <div class="imgTitle row">
                                                                            <div class="col-md-3">
                                                                                <?php
                                                                                $imgUrl = $optional['image'];
                                                                                $filename = basename($imgUrl);
                                                                                ?>
                                                                                <img class="optional-image" src="<?php echo 'https://talknsave.us/img/' . $filename; ?>" alt="">
                                                                            </div>
                                                                            <?php
                                                                            $bonusDesc = $optional['chckBxDesc'];
                                                                            $bonusDesc = str_replace('"', "'", $bonusDesc);
                                                                            ?>
                                                                            <div data-popup="<?php echo $bonusDesc; ?> " data-title="<?php echo $optional['chckBxName']; ?>" class="optional-title accPopoup col-md-8">
                                                                                <?php echo $optional['chckBxName']; ?>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="cart" style=" display:flex; justify-content: space-between;">
                                                                            <!-- 								 <div class="optional-cart">Add to order </div> -->
                                                                            <div style="display:flex;">
                                                                                <a class="cart-qty-minus plus-minus greybtn" type="button" value="-" style="color: #fff !important;    border-width: 0px;">
                                                                                    -</a>


                                                                                <!--                                                                                 <button  class="cart-qty-plus plus-minus" style="background-color:#112453 !important;color:#ffffff !important;     border-width: 0px;" type="button" value="+">+</button> -->
                                                                                <input type="text" name="qty" class="qty" maxlength="12" value="0" style="   border: none!important ;
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
                                                                            <div class="optional-price" data-price="<?php echo $optional['Rate']; ?>">
                                                                                <?php echo $optional['Rate']; ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            <?php endforeach ?>

                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                    foreach ($shippingData[0] as $shipping) :
                                                        if (empty($shipping['shippingAccessories'])) {
                                                            continue;
                                                        }
                                                    ?>
                                                        <div class="d-none shipping_Ass" style="margin-top: 20px;" id="shipping_Ass_<?php echo $shipping['shippingID']; ?>">
                                                            <div class="optional-heading">
                                                                Accessories - special for travel to Israel
                                                            </div>

                                                            <div class="row" style="color:#000913">
                                                                <?php foreach ($shipping['shippingAccessories'] as $shippingAss) : ?>

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

                                                                    <div class="card phonecard">
                                                                        <div class="cardBody" style="padding: 10px 29px;" ClientCode=" <?php echo $ClientCode; ?>" Deposit=" <?php echo $Deposit; ?>" CouponCode=" <?php echo $CouponCode; ?>" EquipmentCode=" <?php echo $EquipmentCode; ?>" Insurance=" <?php echo $Insurance; ?>" OptionalCode=" <?php echo $OptionalCode; ?>" OptionalFeeDesc=" <?php echo $OptionalFeeDesc; ?>" OptionalImg=" <?php echo $OptionalImg; ?>" OptionalName=" <?php echo $OptionalName; ?>" OptionalType=" <?php echo $OptionalType; ?>" OptionText=" <?php echo $OptionText; ?>" PlanCode=" <?php echo $PlanCode; ?>" RequiredInsurance=" <?php echo $RequiredInsurance; ?>" RequiredOperationSystem=" <?php echo $RequiredOperationSystem; ?>">
                                                                            <div class="imgTitle row">
                                                                                <div class="col-md-3">
                                                                                    <img style="max-height:60px" class="optional-image" src="<?php echo 'https://talknsave.us/' . $shippingAss['image']; ?>" alt="">
                                                                                </div>
                                                                                <?php
                                                                                $shippingPopup = $shippingAss['Description'];
                                                                                $shippingPopup = str_replace('"', "'", $shippingPopup);
                                                                                $shippingPopup = preg_replace('/\\\\/', '', $shippingPopup);
                                                                                ?>
                                                                                <div style="" data-title="<?php echo $shippingAss['name']; ?>" class="optional-title accPopoup col-md-8">
                                                                                    <?php echo $shippingAss['name']; ?>
                                                                                </div>
                                                                            </div>
                                                                            <hr>

                                                                            <div class="cart" style=" display:flex; justify-content: space-between;">
                                                                                <!-- 								 <div class="optional-cart">Add to order </div> -->
                                                                                <div style="display:flex;">

                                                                                    <a class="cart-qty-minus plus-minus greybtn" type="button" value="-" style="color: #fff !important;    border-width: 0px;">
                                                                                        -</a>

                                                                                    <!--                                                                                     <button  class="cart-qty-plus plus-minus" style="background-color:#112453 !important;color:#ffffff !important;     border-width: 0px;" type="button" value="+">+</button> -->
                                                                                    <input type="text" name="qty" class="qty" maxlength="12" value="0" style="   border: none!important ;
                                                                                            padding: 0px !important;
                                                                                            width: 30px;
                                                                                            height: 30px;
                                                                                            text-align: center;
                                                                                            margin-right: 8px !important;
                                                                                            margin-bottom: 0px !important;
                                                                                            font-size: 18px;
                                                                                            color: black;
                                                                                            border-radius: 50%;" />
                                                                                    <a class="cart-qty-plus plus-minus bluebtn" style="color:#ffffff !important; border-width: 0px;" type="button" value="+"> + </a>
                                                                                    <!--                                                                                     <button class="cart-qty-minus plus-minus" type="button" value="-" style="background-color:#112453 !important;color:#ffffff !important;     border-width: 0px;">-</button> -->
                                                                                </div>
                                                                                <div class="optional-price" data-price="<?php echo $shippingAss['PriceText'] ?>">
                                                                                    <?php echo $shippingAss['PriceText'] ?>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                <?php endforeach ?>

                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="row">
                                                    </div>
                                                    <button type="button" class="next btn btn-block" id="next12">Next <i class="icon-right-thin"></i></button>
                                                </div>
                                                <div class="col"> </div>
                                            </div>
                                        </fieldset>


                                        <fieldset id="card_info">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="previous btn btn-block" id="previous8"><i class="icon-left-open-big"></i></button>
                                                </div>
                                                <div class="col-md-8 pl-3 pr-3">
                                                    <div class="title" style="margin-bottom:39px">
                                                        <h2>Add Payment method</h2>
                                                    </div>
                                                    <!--                                                     <p class="billingP" style='color:red; font-size: 12px; margin-top: -2px;'>All fields are required !</p> -->
                                                    <div class="form-group">
                                                        <label class="inner-label"> Credit Card Type <span style="color: red;"> *</span></label>
                                                        <div class='select'>
                                                            <select id="cardType" class="form-control payment" name="cardType">
                                                                <option value="" selected>Select</option>
                                                                <option value="Visa">Visa</option>
                                                                <option value="MasterCard">Mastercard</option>
                                                                <option value="Discover">Discover</option>
                                                            </select>
                                                            <p class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'>
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label" for="credit-card">Card Number <span style="color: red;"> *</span></label>
                                                        <input type="text" class="form-control payment" onkeypress="return isNumber(event)" name="cc_number" id='credit-card' maxlength="19">
                                                        <p class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                        <p class="cardNumError" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="inner-label">Expiry date <span style="color: red;"> *</span></label>
                                                        <input class="form-control payment" name="cc_expiry" onkeypress="return isNumber(event)" id='expiry-date' maxlength="5" placeholder="MM/YY">
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
                                                        <input type="text" class="form-control payment" name="cc_fname">
                                                        <p class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Cardholder Last Name <span style="color: red;"> *</span></label>
                                                        <input type="text" class="form-control payment" name="cc_lname">
                                                        <p class="errorPayment" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Cardholder Email <span style="color: red;"> *</span></label>
                                                        <input type="email" name="cc_email" id="paymentEmail" class="form-control payment validateEmail payment_email">

                                                        <p class="invalidEmail" style='color:red; font-size: 12px; margin-top: -2px;'></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inner-label">Notes(not required)</label>
                                                        <textarea rows="3" class="form-control" cols="50" name="cc_note"></textarea>
                                                    </div>
                                                    <div class="mx-4">
                                                        <div class="form-group mt-3 row">
                                                            <label class="inner-label" style="margin-top: 30px;">Add
                                                                coupon/voucher</label>
                                                            <div class="input-group">
                                                                <input type="text" id="coupanCode" value="<?php echo $CouponCodeSukkot; ?>" <?php echo $CouponCodeSukkot != "" ? "disabled" : "" ?> class="form-control" placeholder="1234567" style="width: 80%;border-top-right-radius: 0;border-bottom-right-radius: 0;">
                                                                <div class="applyCouponBtn" style="background-color: green;color: white;">Apply
                                                                </div>
                                                                <h6> Please put a valid Promo Code above which will be
                                                                    applied to your Order amount. </h6>
                                                                <p class="CouponCodeMessage d-none" style="color:green;font-size: 14px;margin-top: -2px;">
                                                                </p>
                                                                <p class="CouponCodeError d-none" style="color:red;font-size: 14px;margin-top: -2px;">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3 row form-check" style="padding: 10px 0px 1px 15px;     margin-left: -22px; background: transparent;border: none;">
                                                            <input class="form-check-input" type="checkbox" value="" id="tnc">

                                                            <label class="form-check-label check-label terms termsr" style="display: block; ">
                                                                I hereby agree to the <a href="https://www.talknsave.net/terms/" target="_blank" id="termsAndCond">Terms and Conditions </a> of the
                                                                service. I understand rates are only guaranteed when I
                                                                follow the dialing directions packaged with my rental
                                                            </label>
                                                            <p class="errorTnc" style='color:red; font-size: 12px; margin-top: -2px;'>
                                                            </p>
                                                        </div>
                                                        <div class="form-group  row form-check" style=" padding: 10px 0px 1px 15px; margin-left: -22px; background: transparent;border: none;">
                                                            <input class="form-check-input" id="SubscribeNewsletter" type="checkbox" value="">
                                                            <label class="form-check-label check-label terms termsr" style="display: block;">
                                                                I would like to subscribe to the newsletter and receive
                                                                promotions
                                                            </label>
                                                        </div>
                                                        <div class="">
                                                            <button type="submit" onClick="submitMultiStepForm()" style="margin-top: 31px;" class="btn btn-block place-order review-order">Review Your Order
                                                                Before Submitting <i class="icon-right-thin"></i></button>
                                                            <button type="button" class="next btn btn-block d-none" id="next9">Next <i class="icon-right-thin"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col"></div>
                                            </div>
                                        </fieldset>

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

                                            <div style="display: flex; justify-content: center;">

                                                <div style="display: inline-block;">
                                                    <h2 style=" color:#000913; font-weight: bold; font-size: 28px;">
                                                        Thank you !</h2>
                                                    <h3 style="font-weight: bold;font-size: 20px;">
                                                        Your order is confirmed
                                                    </h3>
                                                    <p class="c-black">
                                                        Check your email <span id="confirmEmail"> </span> for details
                                                    </p>
                                                    <div style="display: flex; flex-direction: column;">
                                                        <a href="https://www.talknsave.net/" class="c-black aLinkDeco" style="margin-top: 20px;"> Back to TalkNSave Home page</a>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="test-object">

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

    <div class="form-group agentDiv ml-4" style="
         padding-bottom: 35px;
         width: 105px;
         ">
        <input class="agentName form-control">
    </div>

</div>



<script>
    var orderCount = 2;

    function openPopup(divPopup) {
        $(divPopup).fadeIn(250);
    }

    function closePopup(divPopup) {
        $(divPopup).fadeOut(250);
        $(divPopup).removeClass("esim");
    }


    function appendCheckBox(element) {
        let closestParent = $(element).closest('.parent');
        let checkbox = $(element).parent();
        checkbox.appendTo(closestParent);
    }

    function androidPopup() {
        $(".popupTitle").empty();
        $(".popupTitle").append("<br> <br>");
        $(".popupDesc").empty();
        $(".popupDesc").append("<span style='font-size:16px'>Note: Please see <a href='http://www.talknsave.net/Terms.aspx' target='_blank'>Terms and conditions</a> Smartphone rental section for more details<br><br> Smartphones are available for pickup in the Jerusalem or Lawrenc</span>");
        openPopup('#wrap_popup2');
    }

    function openSchoolNewPopup() {
        let message = '<?php echo $p; ?>';
        message = $.trim(message);
        // 		if(message == 'schools-new'){
        //     $(".popupTitle").empty();
        //             $(".popupDesc").empty();  
        // 			 $(".popupTitle").addClass('d-none');
        // 			$('.popupclose').addClass('d-none');
        //             $(".popupDesc").append("<div id='popupMessage'>This service is long-term, you must contact us two weeks before you leave to close your account.<br> <div class='btn form-group okbtn' onclick='clickNext1()'>OK</div></div>");
        //             openPopup('#wrap_popup1');
        // 		   }
    }
    $(document).ready(function($) {



        var form_count = 1,
            form_count_form, next_form, total_forms;
        total_forms = $("fieldset").length;

        $('[data-toggle="datepicker"]').datepicker({
            minDate: 0,
            dateFormat: 'mm/dd/yy'
        });

        let message = '<?php echo $p ?>';
        // 			 if(message == 'schools-new' ){
        // 		$('.school-popup').text('true');
        // 				}

        $('.zipCodeValidate').on('change keypress', function(e) {
            let validate = zipCodeValidate(e);
            return validate;
        });

        $('#multistep_form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        //Next click start
        $(document).on('click', '.next', function() {

            total_forms = $("fieldset").length;
            let previous = $(this).closest("fieldset").attr('id');
            let nextId = $('#' + this.id);
            let next = nextId.closest('fieldset').next('fieldset').attr('id');




            if (next == 'shipping_Acc') {
                let shippingId = $('#shipping_method :selected').val();
                let shipping_Ass_Id = "shipping_Ass_" + shippingId;
                if (($('#bonus-optional').length) || $('#' + shipping_Ass_Id).length) {
                    next = nextId.closest('fieldset').next('fieldset').attr('id');
                } else {
                    next = nextId.closest('fieldset').next('fieldset').next('fieldset').attr('id');
                }
            }

            if (next == 'shipping_option') {

                // 			for shipping if  AllalreadyHaveSim=0;means  hide shippingoption 
                let AllalreadyHaveSim = 0;
                let skipShippingAcc = true;
                $('.simCount').each(function(index) {
                    let simValue = $(this).find('input:checked').val();
                    if (simValue != '9999') {
                        AllalreadyHaveSim++;
                        skipShippingAcc = true;
                    } else {
                        skipShippingAcc = false;
                    }
                });
                if (AllalreadyHaveSim == 0) {
                    if (($('#bonus-optional').length) && skipShippingAcc) {
                        next = nextId.closest('fieldset').next('fieldset').next('fieldset').attr('id');
                    } else {
                        next = nextId.closest('fieldset').next('fieldset').next('fieldset').next('fieldset').attr('id');
                    }

                }

            }

            if (next == "shipping_option") {
                let simVal = $("#need_sim input[type='radio']:checked").val();
                if (simVal == "3290") {
                    next = nextId.closest('fieldset').next('fieldset').next('fieldset').next('fieldset').attr('id');
                }
            }

            $(window).scrollTop(0);
            $('#' + next).show();
            $('#' + previous).hide();
            setProgressBar(++form_count);
        });
        //Next click Stop
        //Previous click start
        $(document).on('click', '.previous', function() {
            total_forms = $("fieldset").length;
            let current = $(this).closest("fieldset").attr('id');
            let previousId = $('#' + this.id)
            let previous = previousId.closest('fieldset').prev('fieldset').attr('id');

            if (previous == 'shipping_Acc') {
                let shippingId = $('#shipping_method :selected').val();
                let shipping_Ass_Id = "shipping_Ass_" + shippingId;

                if (($('#bonus-optional').length) || $('#' + shipping_Ass_Id).length) {
                    previous = previousId.closest('fieldset').prev('fieldset').attr('id');
                } else {
                    previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').attr('id');
                }
                let skipShippingAcc = true;
                $('.simCount').each(function(index) {
                    let simValue = $(this).find('input:checked').val();
                    if (simValue == '9999') {
                        skipShippingAcc = true;
                    } else {
                        skipShippingAcc = false;
                    }
                });
                if (skipShippingAcc) {
                    previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').prev('fieldset').attr('id');
                }
            }

            if (previous == 'shipping_option') {

                // 			for shipping if  AllalreadyHaveSim=0;means  hide shippingoption 
                let AllalreadyHaveSim = 0;
                $('.simCount').each(function(index) {
                    let simValue = $(this).find('input:checked').val();

                    if (simValue != '9999') {
                        AllalreadyHaveSim++;
                    }
                });

                if (AllalreadyHaveSim == 0) {
                    if ($('#bonus-optional').length) {
                        previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').attr('id');
                    } else {
                        previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').prev('fieldset').attr('id');
                    }

                }

            }

            if (previous == "shipping_option") {
                let simVal = $("#need_sim input[type='radio']:checked").val();

                if (simVal == "3290") {
                    previous = previousId.closest('fieldset').prev('fieldset').prev('fieldset').prev('fieldset').attr('id');

                }
            }



            $('#' + previous).show();
            $('#' + current).hide();
            setProgressBar(--form_count);

        });
        //Previous click stop

        setProgressBar(form_count);

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / total_forms) * curStep;
            percent = percent.toFixed();
            $(".progress-bar").css("width", percent + "%");
        }

        $('.equipmentSim').unbind('click').click(function() {
            AddSimInputBox(this);

        });
        $('.unlock').unbind('click').click(function() {
            AddPhoneSelectBox(this);
        });
        $('.optionalAdd').change(function() {
            optionalAdd();
        });

        $('#credit-card').on('keypress keyup  change', function(e) {
            e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
        });
        $('#credit-card').on('blur', function() {
            validateCreditCard(this)
        });

        $('#expiry-date').on('blur', function() {
            validateExpiryDate(this);
        });

        $('.plus-minus').click(function() {
            plusMinus(this);
        });
        $('.bus').change(function() {
            var parent = findParent(this);
            let busValue = $(this).val();
            let linkId = $(this).find(":selected").attr('linkid');
            $(parent).find('.programUrlPath').attr('linkid', linkId);
            if (busValue != '') {
                if (busValue == linkId) {
                    return
                } else {
                    var linkIds = "";
                    var bIds = "";
                    var quantities = "";
                    var urlCounter = 0;
                    $('.programUrlPath').each(function() {
                        var isComma = "";
                        if (urlCounter > 0) {
                            isComma = ",";
                        }
                        linkIds += isComma + $.trim($(this).attr('linkid'));
                        bIds += isComma + $.trim($(this).attr('bid'));
                        quantities += isComma + $.trim($(this).attr('qty'));
                        urlCounter++;
                    });
                    let url = "?b=" + bIds + "&linkid=" + linkIds + "&qty=" + quantities + "";
                    window.location = url;

                }
            }


        });
        $('.datechbx').change(function() {
            datechbxChange(this);
        })

        $(".staticLearnMore").click(function() {
            $("#staylocalTitle").empty();
            $("#stayLoacalDesc").empty();
            $("#staylocalTitle").append("<?php echo $data['stayLocalLearnMoreTitle']; ?> ");
            $("#stayLoacalDesc").append("<div style='font-size:16px;'>Your TalknSave phone is a local Israeli phone, with an Israeli number. For your family, colleagues, clients and friends back 'home', it can be very expensive to call you in Israel.<br/><br/>That'why we offer our virtual number program, called a <span class ='txtSms'>''Stay Local'' number</span>, to make it easier for you to be reached in Israel. You will be assigned an additional number that rings on your phone in Israel – but is a local call for your friends and family.<br/><br/>Calls you receive via your <span class ='txtSms'>''Stay Local'' number</span>will be charged according to the plan you choose.<br/><br/>Bonus feature! Your <span class ='txtSms'>''Stay Local'' number</span>will show up on the destination phone's caller ID display, so your friends will know you're calling! (USA only)<br/><span class ='txtSms'>''Stay Local'' number </span> charges may be itemized separately from TalknSave. <br><br></div> ");

        });

        $("#togglePassword").click(function() {
            $(".loginPassword").attr("type", $(".loginPassword").attr("type") === "password" ? "text" : "password");
            $(".loginPassword").attr("type") === "text" ? $(this).addClass("bi-eye") : $(this).removeClass("bi-eye")
        });
        var userDetails = sessionStorage.getItem("UsersDetails")

        if (userDetails == "" || userDetails == null || userDetails == undefined) {
            $("#LoginBtn").click(function() {

                if ($(".loginBillInfo").hasClass("d-none")) {
                    ($(".loginBillInfo").removeClass("d-none"))
                }
                $(".loaders").removeClass("d-none")
                var ifTrue = false
                var logEmail = $(".loginEmail").val().trim()
                var logPassword = $(".loginPassword").val().trim()
                if (logEmail == "") {
                    $(".emailError").text("")
                    $(".emailError").text("Required")
                    ifTrue = false
                } else {
                    $(".emailError").text("")
                }
                if (logPassword == "") {
                    $(".passwordError").text("")
                    $(".passwordError").text("Required")
                    ifTrue = false
                } else {
                    $(".passwordError").text("")
                }

                if (logEmail != "" && logPassword != "") {
                    $(".emailError").text("")
                    $(".passwordError").text("")
                    ifTrue = true
                }
                if (ifTrue) {
                    var myHeaders = new Headers();
                    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

                    var urlencoded = new URLSearchParams();
                    urlencoded.append("UserEmail", logEmail);
                    urlencoded.append("Password", logPassword);

                    var requestOptions = {
                        method: "POST",
                        headers: myHeaders,
                        body: urlencoded,
                        redirect: "follow",
                    };

                    fetch("//wpapi.talknsave.net/Auth/CustomCheckoutLogin", requestOptions)
                        .then((response) => response.text())
                        .then((result) => {
                            var response = JSON.parse(result)
                            if (response != "InvalidEmailPwd") {
                                sessionStorage.setItem("UsersDetails", result)
                                $(".passwordError").text("")
                                console.log(response)
                                gotUserDetails(response)
                                $(".loginEmail").val("");
                                $(".loginPassword").val("");
                                $(".loginBillInfo").addClass("d-none")
                                $(".loaders").addClass("d-none")
                                closePopup('#wrap_popup3')
                            } else {
                                $(".loaders").addClass("d-none")
                                $(".passwordError").text("Username or password is incorrect!")
                            }

                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            })
        } else {
            $(".loginBillInfo").addClass("d-none")
            var userDetail = JSON.parse(userDetails)
            gotUserDetails(userDetail)
        }

        function gotUserDetails(response) {
            if ($('.menu_wrapper').find(".UserLoginName").length <= 0) {
                $(".menu_wrapper").append("<div class='row'><div class='col-md-12'><div class='UserLoginName' style='text-align:center; color: #FFAC11'> <h5>Hello, " + response[0][0].ClientFirstName + ' ' + response[0][0].ClientLastName + "</h5></div></div></div><div class='row'><div class='col-md-12'><h6 class='logoutBtn cursorP' style='text-align:center; text-decoration: underline;'>Logout</h6></div></div>")
                $('.logoutBtn').click(function() {
                    sessionStorage.clear();
                    location.reload();
                })
            }

            $('input[name$="billing_fname"]').val(response[0][0].ClientFirstName);
            $('input[name$="cc_fname"]').val(response[0][0].ClientFirstName);
            $('input[name$="billing_lname"]').val(response[0][0].ClientLastName);
            $('input[name$="cc_lname"]').val(response[0][0].ClientLastName);
            $('input[name$="billing_email"]').val(response[0][0].ClientEMail);
            $('input[name$="cc_email"]').val(response[0][0].ClientEMail);
            $('.confirmBillingEmail').val(response[0][0].ClientEMail);
            $('input[name$="billing_phone"]').val(response[0][0].ClientHomePhone1);
            $('input[name$="billing_address"]').val(response[0][0].ClientStreet);
            $('input[name$="billing_city"]').val(response[0][0].ClientCity);
            $('input[name$="billing_zip"]').val(response[0][0].ClientZip);
            $('#billing_country option[value=' + response[0][0].ClientCountry + ']').attr('selected', 'selected').change();
            $('#stateProvinceUSA option[state-code=' + response[0][0].ClientState + ']').attr('selected', 'selected');

            if (response[0][0].ClientEMail == "team.sprigstack@gmail.com") {
                $('#cardType option[value="Visa"]').attr('selected', 'selected');
                $('input[name$="cc_number"]').val("4242 4242 4242 4242");
                $('input[name$="cc_expiry"]').val("02/28");
                $("[name='cc_note']").val("test checkout from engineer new system");
            }

        }

        $("#next6").click(function() {
            $('#billing_country').change();
        })


        $(".international").click(function() {
            $(".popupTitle").empty();
            $(".popupDesc").empty();
            $(".popupTitle").text("International plan");
            $(".popupDesc").append("<div id='popupMessage'>MORE TEXTING OPTIONS for your phone!<br><br>Your plan includes unlimited local(Israel) SMS.<br><br>Now you can prepay international text messages and save even more! <br></div>");
            openPopup('#wrap_popup1');
        });




        $('.simPopup').click(function() {
            simPopup(this);
        });

        $(".android").click(function() {
            androidPopup();
        });



        $('.phoneCheckBox').change(function() {
            var parent = findParent(this);
            if ($(this).prop("checked")) {
                parent = $(this).closest('.parent');
                $(parent).find('.clonePhone').remove();
                $(parent).find('.IsPhoneUnlockedOrderNum').empty();
                return;
            } else {

                let clone = $(this).data('orderqty');
                clone = clone - 1;
                if (clone > 0) {
                    $(parent).find('.IsPhoneUnlockedOrderNum').text(' for Order #1');
                }
                for (i = 0; i < clone; i++) {
                    var phoneClone = $(parent).find('.clonePhoneDefault').clone();
                    $(phoneClone).find('input').attr('name', 'phone_unlocked' + (i + 1));
                    $(phoneClone).find('.IsPhoneUnlockedOrderNum').text(' for Order #' + (i + 2));
                    $(phoneClone).attr('class', 'clonePhone phoneCount parentDiv');
                    //$(phoneClone).find('input').attr('onchange', 'rentPhone()')
                    $(parent).find('.clonePhoneDefault').parent().append(phoneClone);

                    $(parent).find('.clonePhone').find('.PhoneSimInfo').remove();
                    $(parent).find('.unlock').unbind('click').click(function() {
                        AddPhoneSelectBox(this);
                    });
                }
                appendCheckBox(this);
            }
        });

        $('.stayLocalCheckBox').change(function() {
            var parent = findParent(this);
            if ($(this).prop("checked")) {
                parent = $(this).closest('.parent');
                $(parent).find('.clonestayLocal').remove();
                $(parent).find('.OptionalOrderNum').empty();

            } else {
                let orderNo = $(this).data('orderno');

                let clone = $(this).data('orderqty');
                clone = clone - 1;
                if (clone > 0) {
                    $(parent).find('.OptionalOrderNum').text(' for Order #1');
                }
                for (i = 0; i < clone; i++) {
                    var stayLocalClone = $(parent).find('.stayLocalCloneDefault').clone();
                    $(stayLocalClone).find('.stayLocalSelect').attr('id', 'stay_local_order_' + orderNo + '_' + (i + 1));
                    $(stayLocalClone).find('.OptionalOrderNum').text(' for Order #' + (i + 2));
                    $(stayLocalClone).find('.internationalSelect').attr('id', 'smsPackageName_order_' + orderNo + (i + 1));
                    $(stayLocalClone).attr('class', 'clonestayLocal parentDiv');
                    //$(stayLocalClone).find('select').attr('onchange','optionalAdd()');
                    $(stayLocalClone).find('#staticLearnMore').remove();
                    $(stayLocalClone).find('.stayLocalSelect').removeClass('stayLocalPopup');
                    $(stayLocalClone).find('.internationalSelect').removeClass('internationalPopup');
                    $(stayLocalClone).find('#sLearnMore').remove();
                    $(stayLocalClone).find('#international').remove();
                    $(parent).find('.stayLocalCloneDefault').parent().append(stayLocalClone);
                    $(parent).find('.clonestayLocal').find('#international').remove();
                    $('.optionalAdd').change(function() {
                        optionalAdd();
                    });
                }
                appendCheckBox(this);
            }
            optionalAdd();
        });


        $('.validateEmail').blur(function() {
            validateEmail(this);
        });



        $('#previous1').click(function() {
            $('.agentDiv').removeClass('d-none');
        })

        $('#next7').click(function() {

            let begin_date = $('#begin_date').datepicker("getDate");
            let billing_email = $('.billing_email').val();
            let cEmail = $('.confirmBillingEmail').val();
            setLeavingDate();
            $('.billingR').each(function() {
                $(this).text('');
            });
            var validate;

            $('.billing').each(function() {

                if ($(this).val() == "") {
                    console.log($(this).val());
                    var parent = $(this).parent();
                    parent.find('.billingR').text("This field is required");
                    parent.find('input').focus();
                    // 			$("#next7").attr('disabled',true);

                    return validate = false;
                } else if ($(this).attr("name") == "billing_fname" || $(this).attr("name") == "billing_lname") {
                    if ($(this).val().toString().trim().match(/^[0-9]*$/gm) != null) {
                        var parent = $(this).parent();
                        parent.find('.billingR').text("Please enter valid name");
                        parent.find('input').focus();
                        return validate = false;
                    }
                } else if ($(this).closest('.row').find('.invalidEmail').text() != '') {
                    // 			$("#next7").attr('disabled',false);
                    return validate = false;
                } else if (cEmail != '' && billing_email != cEmail) {
                    $('.confirmBillingEmail').parent().find('p').text('Email and Confirm Email must be same.');
                    return validate = false;
                } else {
                    return validate = true;
                }

            })

            if (validate === false) {
                document.body.scrollTop = 400;
                document.documentElement.scrollTop = 400;
            }



            return validate;
        });

        $('#next12').click(function() {
            $('#accFinalAmount').empty();
            $('#accCart').empty();
            var finalAmount = 0;
            $('.phonecard').each(function() {
                let qty = $(this).find('.qty').val();
                if (qty > 0) {
                    let parent = $(this).closest(".phonecard");
                    let image = parent.find('.optional-image').attr('src');
                    let title = parent.find('.optional-title').data('title');
                    let qty = parent.find('.qty').val();
                    let price = parent.find('.optional-price').data('price');
                    price = price.replace('<br>', '');
                    //                     let amount = price.replace(/^\D+/g, '');
                    let amountIndex = price.indexOf('$');
                    let amount = price.slice(amountIndex).trim().split(' ')[0];
                    amount = amount.substr(1);
                    amount = parseFloat(amount);
                    amount = amount.toFixed(2);
                    let singleAmount = parseFloat(amount) * parseInt(qty);
                    singleAmount = singleAmount.toFixed(2);
                    finalAmount = parseFloat(singleAmount) + parseFloat(finalAmount);
                    let acc = "<div class='row border-bottom pb-2'><div class='col-md-9 opsAddOnDD' style='display: flex; align-items: center;'>  <img class='opsAddOn_imgDD' src=" + image + " alt=''  style='max-width: 65px;'> <span class='opsAddOn_titleDD' style='margin-left:11px;     width: 195px;'> " + title + "  &nbsp; &nbsp; &nbsp; </span>   <small class='addOnqty' qty='" + qty + "'> " + qty + "&nbsp; x </small> <span > &nbsp; " + price + " </span>  </div><div class='col-md-3 text-right font-weight-bold calculate withVat '> $" + singleAmount + " </div> </div>	"
                    $('#accCart').append(acc);


                }

            });
            $('#accFinalAmount').text(finalAmount);

        });

        $('#next9').click(function() {
            if (!$('#tnc').is(':checked')) {
                $(".errorTnc").text("Please check this box to proceed!")
                return false;
            }
            $('.errorPayment').each(function() {
                $(this).text('');
            });
            var validatePayment;
            $('.payment').each(function() {
                if ($(this).val() == "") {
                    // 			$("#next9").attr('disabled',true);
                    var parent = $(this).parent();
                    parent.find('.errorPayment').text("This field is required");
                    parent.find('input').focus();
                    return validatePayment = false;
                } else if ($(this).closest('.row').find('.invalidEmail').text() != '' || $('.cardNumError').text() != '' || $('.errorExpiry').text() != '') {
                    return validatePayment = false;
                } else {
                    return validatePayment = true;
                }

            });
            if (validatePayment === false) {
                $("html, body").animate({
                    scrollTop: 150
                }, "slow");

            }

            var billingfName = $('[name=billing_fname]').val();
            var billinglName = $('[name=billing_lname]').val();
            $('#cname').empty().text(billingfName + " " + billinglName);

            var billingEmail = $('[name=billing_email]').val();
            $('#cemail').empty().text(billingEmail);

            var billingPhone = $('[name=billing_phone]').val();
            $('#cnumber').empty().text(billingPhone);
            var conatinerCount = 0;
            $('.OrderDetailsClone').parent().remove();
            $('.serviceDateContainer').each(function() {
                var ctBundleID = $(this).attr('bundleid');
                var ctlinkID = $(this).attr('sublinkid');

                $('.multipleOrderDefault').parent().append('<div class="parent newContainer" bundileID="' + ctBundleID + '" linkID="' + ctlinkID + '"></div>');
                var PlanName = $(this).attr('planname');
                $(this).find('.orderContent').each(function() {
                    var equipmentName = $(this).attr('equipment');
                    var beginDate = $(this).attr('begindate');
                    var endDate = $(this).attr('enddate');
                    var data = $(this).attr('data');
                    var call = $(this).attr('call');
                    var sms = $(this).attr('sms');
                    var staylocal = $(this).attr('staylocal');
                    var inttxtplan = $(this).attr('inttxtplan');
                    var equipmentPrice = $(this).attr('equipmentcost');
                    var insurance = $(this).attr('insuarance');
                    var staylocal = $(this).attr('staylocal');
                    var inttxtplan = $(this).attr('inttxtplan');
                    var bundlerate = $(this).attr('bundlerate');
                    var bundleperiod = $(this).attr('bundleperiod');
                    var equipmentcost = $(this).attr('equipmentcost');
                    equipmentcost = parseFloat(equipmentcost);
                    var stayrateIndex;
                    var stay_localWithDoller;
                    var stayLocalValue;

                    var intrateIndex;
                    var intWithDoller;
                    var intValue;
                    let planPrice;
                    if (bundleperiod == '' || endDate === 'undefined') {
                        planPrice = bundlerate;
                    } else {

                        let date1 = new Date(beginDate.split('/')[2], beginDate.split('/')[1] - 1, beginDate.split('/')[0]);
                        let date2 = new Date(endDate.split('/')[2], endDate.split('/')[1] - 1, endDate.split('/')[0]);
                        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));





                        let month = diffDays / 30;
                        let days = diffDays + 1;

                        if (bundleperiod.includes('/day') && days) {
                            planPrice = parseFloat(days) * parseFloat(bundlerate);
                        } else if (bundleperiod.includes('/month') && month) {
                            planPrice = parseFloat(month) * parseFloat(bundlerate);
                        }
                        if (planPrice == undefined) {
                            planPrice = parseFloat(bundlerate);
                        }
                    }



                    var clonePlanDetails = $('.multipleOrderDefault').clone();

                    $(clonePlanDetails).attr('class', 'OrderDetailsClone');
                    $(clonePlanDetails).removeClass('d-none');
                    $(clonePlanDetails).find('.planName').text(PlanName);
                    $(clonePlanDetails).find('.equipmentDiv .cplan').text(equipmentName);
                    $(clonePlanDetails).find('.cdate').text(beginDate + "-" + endDate);
                    $(clonePlanDetails).find('.data').text(data);
                    $(clonePlanDetails).find('.call').text(call);
                    $(clonePlanDetails).find('.sms').text(sms);
                    $(clonePlanDetails).find('.insurance').text(insurance);
                    $(clonePlanDetails).find('.planPrice').addClass('calculate withVat').text("$" + planPrice);

                    let stay_local_amount = 0;
                    let international_amount = 0;
                    if (equipmentcost > 0) {
                        $(clonePlanDetails).find('.planPriceDiv').removeClass('border-bottom');
                        $(clonePlanDetails).find('.planPriceDiv').removeAttr('style');

                        $(clonePlanDetails).find('.equipmentPriceDiv').removeClass('d-none');
                        $(clonePlanDetails).find('.equipmentPrice').addClass('calculate withVat').text('$' + equipmentcost);
                    }

                    if (staylocal != "No, Thank you" && (typeof staylocal !== "undefined") && staylocal != "") {
                        stayrateIndex = staylocal.indexOf('$');
                        stay_localWithDoller = staylocal.slice(stayrateIndex).trim().split(' ')[0];
                        stay_local_amount = parseFloat(stay_local_amount) + parseFloat(stay_localWithDoller.substr(1));
                        let stayTitlePrice = "<div class='row'> <div class='col-md-6 col-8'> " + staylocal + "  </div><div class='col-md-6 col-4  text-right font-weight-bold calculate withVat ' > " + stay_localWithDoller + " </div></div>";
                        $(clonePlanDetails).find('.stayLocalReview').append(stayTitlePrice);
                    }

                    if (inttxtplan != "No, Thank you" && (typeof inttxtplan !== "undefined") && inttxtplan != "") {
                        intrateIndex = inttxtplan.indexOf('$');
                        intWithDoller = inttxtplan.slice(intrateIndex).trim().split(' ')[0];
                        international_amount = parseFloat(stay_local_amount) + parseFloat(intWithDoller.substr(1));
                        let internationalTitlePrice = "<div class='row'> <div class='col-md-6 col-8'> " + inttxtplan + "  </div><div class='col-md-6  col-4 text-right font-weight-bold  calculate withVat' > " + intWithDoller + " </div></div>";
                        $(clonePlanDetails).find(".internationalReivew").append(internationalTitlePrice);
                    }
                    $('.multipleOrderDefault').parent().find('.parent.newContainer').append(clonePlanDetails);

                });

                var totalForThis = 0;
                $('.multipleOrderDefault').parent().find('.parent.newContainer').find('.calculate').each(function() {
                    var amt1 = $.trim($(this).text());
                    amt1 = amt1.replace("$", "");
                    amt1 = parseFloat(amt1);
                    totalForThis += amt1;
                });

                var isEuropePlan = $(this).attr('iseuropeplan');
                if (isEuropePlan != undefined && isEuropePlan != null && isEuropePlan == "1") {
                    var europePlanImg = $(this).attr('europeplanimg');
                    var europePlanPrice = $(this).attr('europeplanprice');
                    europePlanPrice = europePlanPrice.replace('$', '');
                    var europePlanName = $(this).attr('europePlanName');
                    var europePlanCheckBoxID = $(this).attr('europecheckboxid');
                    $('.multipleOrderDefault').parent().find('.parent.newContainer').append('<div class="row  pb-2 border-bottom europeContainer"><div class="col-md-9 ">  <img class="europePlanImage" src="https://talknsave.us/' + europePlanImg + '" alt="" style="max-width: 65px;">     <span class="europePlanName">' + europePlanName + '</span>  </div><div class="col-md-3 text-right font-weight-bold "> $<span class="europePlanPrice calculate withVat">' + europePlanPrice + '</span> </div> </div> ');
                }

                $('.multipleOrderDefault').parent().find('.parent.newContainer').append("<div class='d-none OrderWiseCost   " + conatinerCount + "'>" + totalForThis.toFixed(2) + "</div>");
                $('.multipleOrderDefault').parent().find('.parent.newContainer').append("<div class='form-group mb-5 row border-bottom'><label class='inner-label'>Add coupon/voucher</label><div class='input-group'><input type='text' id='' class='form-control coupanCodeMulti' placeholder='1234567' style='width: 80%;border-top-right-radius: 0;border-bottom-right-radius: 0;'> <div class='applyCouponBtn'>Apply</div><h6> Please put a valid Promo Code above which will be applied to your Order amount. </h6><p class='CouponCodeError d-none' style='color:red;font-size: 14px;margin-top: -2px;'></p></div></div>");

                $('.multipleOrderDefault').parent().find('.parent.newContainer').removeClass('newContainer');
                conatinerCount++;
            });

            let shippingName = $('#shipping_method option:selected').data('title');
            let shippingPrice = $('#shipping_method option:selected').data('cost');
            var qsqty = $('.orderContent').length;
            let originalShipAmount = shippingPrice;
            if (qsqty > 1) {
                shippingPrice = (shippingPrice * 50) / 100;
            }
            if (shippingPrice) {
                // shippingPrice = shippingPrice * qsqty; 

                let totalOrderCnt = qsqty;
                $('.addOnqty').each(function() {
                    var ctQty = $(this).attr('qty');
                    ctQty = parseFloat(ctQty);
                    totalOrderCnt += ctQty;
                });
                if (qsqty > 1) {
                    totalOrderCnt = totalOrderCnt - 1;
                }
                shippingPrice = shippingPrice * totalOrderCnt;
                if (qsqty > 1) {
                    shippingPrice += originalShipAmount;
                }

            } else {
                shippingPrice = 0;
            }
            shippingPrice = parseFloat(shippingPrice);
            $("#shippingName").text(shippingName);
            if (shippingPrice === 0) {
                $("#shippingPrice").text("Free");
            } else {
                shippingPrice = shippingPrice.toString();
                shippingPrice = "$" + shippingPrice;
                $("#shippingPrice").addClass("calculate withoutVat").text(shippingPrice);
            }

            var totalPrice = 0;
            $('.calculate.withVat').each(function() {
                var amt = $.trim($(this).text());
                amt = amt.replace("$", "");
                amt = parseFloat(amt);
                totalPrice += amt;
            });
            var totalVat = (totalPrice * 17) / 100;
            $('#vatTotle').empty().text(totalVat.toFixed(2));

            $('.calculate.withoutVat').each(function() {
                var amt = $.trim($(this).text());
                amt = amt.replace("$", "");
                amt = parseFloat(amt);
                totalPrice += amt;
            });
            totalPrice += totalVat;
            $('#cprice').empty().text(totalPrice.toFixed(2));
            return validatePayment;
            //	whatever on review page will be goes here 

        });

        $(".cart-qty-plus").click(function() {
            var $currentValue = $(this).parent().find('input');
            $currentValue.val(Number($currentValue.val()) + 1);

        });
        $(".cart-qty-minus").click(function() {
            var $currentValue = $(this).parent().find('input');
            var value = Number($currentValue.val());
            if (value > 0) {
                $currentValue.val(value - 1);
            }

        });
        $('.accPopoup').click(function() {
            accPopoup(this)
        });

        $('#shipping_method').change(function() {
            shippingMethodChange(this);
            var country = $("#shipping_method option").filter(":selected").parent().attr('label');
            if (country == 'Israel') {
                $('.israel-phone-msg').remove();
                $('input[name="shipping_phone"]').val('0');
                $('input[name="shipping_phone"]').parent().parent().find('.inner-label').append('<div style="font-size: 13px;" class="israel-phone-msg">(Must be an Israeli phone number.)</div>');
            } else {
                $('input[name="shipping_phone"]').val('');
                $('.israel-phone-msg').remove();
            }

            $('.shipping_phone_number').keyup(function() {
                var country = $("#shipping_method option").filter(":selected").parent().attr('label');

                if (country == 'Israel' && $('.israel-phone-msg').length > 0) {
                    var firstDigit = $(this).val();
                    if (firstDigit.charAt(0) != '0') {
                        $(this).val('0' + firstDigit);
                    }
                }
            });
        });
        $('#billing_country').change(function() {
            billingCountry()
        });

        $('.validateDate').change(function() {
            removeRequired(this);
        })

        $('#next2').click(function() {
            $('.simNoValue').text('');
            let validateSimCardNum = true;

            $('.existing_phone').each(function() {
                let cuurentVal = $(this).val();
                cuurentVal = $.trim(cuurentVal);
                if (cuurentVal.length != 17 || cuurentVal == '') {
                    if (cuurentVal == '') {
                        $(this).parent().find('.simNoValue').text('This field is required');
                    }
                    validateSimCardNum = false
                }
            });

            $('.eSimNum').each(function() {
                let errorInsim = $(this).text();
                errorInsim = $.trim(errorInsim);
                if (errorInsim != '') {
                    validateSimCardNum = false
                }
            });

            if (validateSimCardNum == false) {
                return validateSimCardNum;
            }



            $('#shipping_method').find('option').each(function() {
                console.log("next2 click", $(this));
                let baseCode = $(this).attr('base-code');
                let currentOption = $(this);
                let optLocalPickup = $(this).attr('opt-local-pickup');

                let shipMethod = $(this).attr('shipMethod');
                let shippingID = $(this).attr('value');
                let hasPhones = '';
                hasPhones = $(this).attr('has-phones');

                currentOption.removeClass('d-none');


                // 				 check optlocalPickup 0 and null 

                $('.simCount').each(function(index) {


                    let eqipmentId = $(this).find('.equipmentSim:checked').val();
                    let isSim = $(this).find('.equipmentSim:checked').attr('issim');
                    let issmartPhone = $(this).find('.equipmentSim:checked').attr('issmartphone');
                    let isKoshar = $(this).find('.equipmentSim:checked').attr('kosher');
                    isKoshar = $.trim(isKoshar);

                    isSim = $.trim(isSim);
                    issmartPhone = $.trim(issmartPhone);

                    isSim = (isSim) ? true : '';
                    issmartPhone = (issmartPhone) ? true : false;
                    if (shippingID != "-1" &&
                        isSim == '' && ((issmartPhone == true && ((baseCode != "100" && baseCode != "1") || optLocalPickup == 0)) || hasPhones == 0)) {

                        if (shipMethod != "UPS_GROUND" && shipMethod != "UPS_OVERNIGHT" && !(eqipmentId == "2730" || eqipmentId == "2750")) {
                            currentOption.addClass('d-none');
                        } else if (shippingID != "-1" && (eqipmentId == "2730" || eqipmentId == "2750")) {
                            if (!(shippingID == "2" || shippingID == "9")) {
                                currentOption.addClass('d-none');
                            }
                        }
                    } else if (shippingID != "-1" && (eqipmentId == "2550" && (shippingID != "1" && shippingID != "3" && shippingID != "7" && shippingID != "9" && shippingID != "12" && shippingID != "23")) || (isKoshar && (shippingID != "2" && shippingID != "12" && shippingID != "9" && shippingID != "23" && shippingID != "69" && shippingID != "24" && shippingID != "383"))) {
                        currentOption.addClass('d-none');
                    } else if (shippingID != "-1" && (eqipmentId == "2730" || eqipmentId == "2750")) {
                        if (!(shippingID == "2" || shippingID == "9")) {
                            currentOption.addClass('d-none');
                        }
                    }
                    let plan = "<?php echo $p ?>";
                    console.log(plan, "plan")
                    if (shippingID == "391" && plan == 'bhlt') {
                        currentOption.removeClass('d-none');
                    }
                });



            });
            $('input[type=radio][name=shipping_address]').change(function() {
                shippingAddressChange();
            });

            $('#shipping_method').find('optgroup').each(function() {
                let count = 0;
                $(this).find('option').each(function() {
                    if (!$(this).hasClass('d-none')) {
                        count++
                    }
                });
                console.log(count, "count")
                if (count > 0) {
                    $(this).removeClass('d-none');
                } else {
                    $(this).addClass('d-none');
                }


            });

            //pop up if sim selected
            $('.equipmentSim').each(function() {
                if ($(this).is(":checked")) {
                    var isSim = $(this).attr('issim');
                    if (isSim == "true") {
                        var popUpIcon = $(this).parent().find('.icon-info-circled.simPopup');
                        if (popUpIcon.length > 0) {
                            $('.popup-footer').removeClass('d-none')
                            $(popUpIcon).click();
                            $('.popup-footer').text('Next');
                        }
                    }
                }
            });

            var cnt = 0;
            $('.equipmentContainer').each(function() {
                var mainEquipCOntainer = $(this);
                var alreadyHaveSimNums = "";
                if ($(this).find('.simCheckBox').prop("checked")) {
                    var checkedEquip = $(this).find('.equipmentSim:checked').attr('data-name');
                    var checkedEquipPrice = $(this).find('.equipmentSim:checked').attr('data-cost');
                    var checkedEquipCode = $(this).find('.equipmentSim:checked').data('code');

                    if (checkedEquipCode == '9999') {
                        checkedEquipCode = '2510';
                        checkedEquipCode = '2510';

                        $(this).closest('.simCount').find('.equipmentSim').each(function() {
                            let isSim = $.trim($(this).attr('isSim'));
                            let code = $.trim($(this).val());
                            if (isSim == "true" && code != "9999") {
                                checkedEquipCode = code;
                            }

                        });
                        var index = 0;
                        $(mainEquipCOntainer).find('.existing_phone').each(function() {
                            let simCardNum = $(this).val();
                            simCardNum = simCardNum.replace(/\s/g, '');
                            alreadyHaveSimNums += (index + 1) + ' ' + 'Special Order:Sim Number#: 89972' + simCardNum + '#' + '    ';
                            index++;
                        });
                    }
                    var checkedEquipNotes = $(this).find('.equipmentSim:checked').attr('notes');
                    var checkedEquipIsSns = $(this).find('.equipmentSim:checked').attr('issns');
                    var checkedEquipIsKosher = $(this).find('.equipmentSim:checked').attr('kosher');
                    var checkedEquipIsSim = $(this).find('.equipmentSim:checked').attr('issim');
                    var Insurance = "false"
                    if ($(this).find('.insurance-addon').find('.insurance-checkbox').is(":checked")) {
                        Insurance = "true"
                    } else {
                        Insurance = "false"
                    }

                    $('.serviceDateContainer.' + cnt).find('.orderContent').each(function() {
                        $(this).attr('equipment', checkedEquip);
                        $(this).attr('equipmentCost', checkedEquipPrice);
                        $(this).attr('equipmentCode', checkedEquipCode);
                        $(this).attr('equipmentNotes', checkedEquipNotes);
                        $(this).attr('equipmentIsSns', checkedEquipIsSns);
                        $(this).attr('equipmentIsKosher', checkedEquipIsKosher);
                        $(this).attr('equipmentIsSim', checkedEquipIsSim);
                        $(this).attr('insurance', Insurance);
                    });
                } else {
                    var cnt2 = 1;
                    var index = 0;
                    $(this).find('.simCount').each(function() {
                        var checkedEquip = $(this).find('.equipmentSim:checked').attr('data-name');
                        var checkedEquipPrice = $(this).find('.equipmentSim:checked').attr('data-cost');
                        var checkedEquipCode = $(this).find('.equipmentSim:checked').data('code');
                        var simCountElement = $(this)
                        if (checkedEquipCode == '9999') {
                            checkedEquipCode = '2510';
                            checkedEquipCode = '2510';


                            $(this).closest('.simCount').find('.equipmentSim').each(function() {
                                let isSim = $.trim($(this).attr('isSim'));
                                let code = $.trim($(this).val());
                                if (isSim == "true" && code != "9999") {
                                    checkedEquipCode = code;
                                }
                                if ($(this).prop("checked")) {
                                    let simCardNum = $(simCountElement).find(".existing_phone").val();
                                    simCardNum = simCardNum.replace(/\s/g, '');
                                    if (!alreadyHaveSimNums.includes(simCardNum)) {
                                        alreadyHaveSimNums += (index + 1) + ' ' + 'Special Order:Sim Number#: 89972' + simCardNum + '#' + '    ';
                                    }
                                }
                            });
                        }
                        index++;
                        var checkedEquipNotes = $(this).find('.equipmentSim:checked').attr('notes');
                        var checkedEquipIsSns = $(this).find('.equipmentSim:checked').attr('issns');
                        var checkedEquipIsKosher = $(this).find('.equipmentSim:checked').attr('kosher');
                        var checkedEquipIsSim = $(this).find('.equipmentSim:checked').attr('issim');
                        var Insurance = "false"
                        if ($(this).find('.insurance-addon').find('.insurance-checkbox').is(":checked")) {
                            Insurance = "true"
                        } else {
                            Insurance = "false"
                        }

                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('equipment', checkedEquip);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('equipmentCost', checkedEquipPrice);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('equipmentCode', checkedEquipCode);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('equipmentNotes', checkedEquipNotes);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('equipmentSns', checkedEquipIsSns);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('equipmentIsKosher', checkedEquipIsKosher);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('equipmentIsSim', checkedEquipIsSim);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('insurance', Insurance);
                        cnt2 = cnt2 + 1;
                    });
                }
                $('.serviceDateContainer.' + cnt).attr('simNumbers', alreadyHaveSimNums);
                cnt = cnt + 1;

            });

        });
        $("[name='billing_phone']").on('change blur', function() {
            billing_phone(this)
        });

        $('#3next').click(function() {
            var cnt = 0;
            $('.roaming_plans:checked').each(function() {
                var europePlanImage = $(this).attr('plan_img');
                var europeCheckBoxID = $(this).attr('checkboxid');
                var europePlanPrice = $(this).attr('plan_price');
                var orderNumEurope = $(this).attr('roamingOrderNum');
                var europePlanName = $(this).attr('plan_name');
                $('.serviceDateContainer.' + orderNumEurope.trim()).attr('europePlanImg', europePlanImage.trim()).attr('europeCheckBoxID', europeCheckBoxID.trim()).attr('europePlanName', europePlanName.trim()).attr('europePlanPrice', europePlanPrice.trim());
                cnt = cnt + 1;
            });
        });

        $('#next6').click(function() {
            var cnt = 0;
            $('.OptionalAddOnContainer').each(function() {
                if ($(this).find('.stayLocalCheckBox').prop("checked")) {
                    var stayLocalSelect = $(this).find('.stayLocalSelect').find(":selected").text();
                    var stayLocalKitd = $(this).find('.stayLocalSelect').find(":selected").attr('data-kntcode');
                    var internationalSelect = $(this).find('.internationalSelect');
                    var intSelectTxt = "";
                    var intSelectSmsCode = "";
                    if (internationalSelect.length > 0) {
                        intSelectTxt = $(internationalSelect).find(":selected").text();
                        intSelectSmsCode = $(internationalSelect).find(":selected").attr('smscode');
                    }

                    $('.serviceDateContainer.' + cnt).find('.orderContent').each(function() {
                        $(this).attr('stayLocal', stayLocalSelect);
                        $(this).attr('stayLocalKitd', stayLocalKitd);
                        $(this).attr('intTxtPlan', intSelectTxt);
                        $(this).attr('intTxtPlanCode', intSelectSmsCode);
                    });
                } else {
                    var cnt2 = 1;
                    $(this).find('.parentDiv').each(function() {
                        var stayLocalSelect = $(this).find('.stayLocalSelect').find(":selected").text();
                        var stayLocalKitd = $(this).find('.stayLocalSelect').find(":selected").attr('data-kntcode');
                        var internationalSelect = $(this).find('.internationalSelect');
                        var intSelectTxt = "";
                        var intSelectSmsCode = "";

                        if (internationalSelect.length > 0) {
                            intSelectTxt = $(internationalSelect).find(":selected").text();
                            intSelectSmsCode = $(internationalSelect).find(":selected").attr('smscode');
                        }
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('stayLocal', stayLocalSelect);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('stayLocalKitd', stayLocalKitd);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('intTxtPlan', intSelectTxt);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('intTxtPlanCode', intSelectSmsCode);

                        cnt2 = cnt2 + 1;
                    });
                }
                cnt = cnt + 1;
            });
        });



        $('.stayLocalPopup').change(function() {
            stayLocalPopup(this);
        });




        $('#expiry-date').on('keypress keyup change', function() {
            let expiryDate = $(this).val();
            if (expiryDate.length == 2) {
                $("#expiry-date").val($("#expiry-date").val() + "/");
            }
        });



        $('.end_date').change(function() {
            Date_Validate(this);
        });
        $('.begin_date').change(function() {
            var parent = findParent(this);
            let maximumPeriod = $(parent).attr('max_period');

            if (!maximumPeriod) {} else {
                Date_Validate(this);
            }
        });





        $('#next1').click(function() {
            let validateDate;
            AddInsuranceBox();
            $('.busError').text('');
            $('.validateDate').each(function() {
                var parent = findParent(this);
                $(parent).find('.dateError').text('');
                let value = $(this).val();
                let errorDate = $(parent).find('.error_day').text();
                errorDate = errorDate.trim();

                if (value == '' || errorDate != '') {
                    if (value == '') {
                        $(parent).find('.dateError').parent().find('.dateError').text("This field is required");
                    } else {
                        $(parent).find('.dateError').parent().find('.dateError').text("");
                    }
                    return validateDate = false;
                } else if ($('.bus').length) {
                    let busvalue = $('.bus').find(':selected').val()
                    if (busvalue == '') {
                        $('.busError').text('Please select which bus are you on.');
                        return validateDate = false;
                    }
                } else {
                    return validateDate = true;
                }
                return validateDate;
            });

            let stayLocalVal = $('.stay_local').length;
            let smspackageVal = $('.smsPackageName').length;
            if (stayLocalVal == 0 && smspackageVal == 0) {
                $('#optional_add_ons').remove();
            }
            $('.agentDiv').addClass('d-none');
            let message = $('.school-popup').text();
            message = $.trim(message);
            if (validateDate == true && message != '') {
                openSchoolNewPopup();
                return validateDate = false;
            }
            findMindate();


            var cnt = 0;
            $('.serviceDateContainer').each(function() {
                if ($(this).find('.datechbx').prop("checked")) {
                    var beginDate = $(this).find('.begin_date').val();
                    var endDateInput = $(this).find('.end_date');
                    var endDateTxt = "";
                    if (endDateInput.length > 0) {
                        endDateTxt = $(endDateInput).val();
                    }
                    $('.serviceDateContainer.' + cnt).find('.orderContent').each(function() {
                        $(this).attr('BeginDate', beginDate);
                        $(this).attr('EndDate', endDateTxt);
                    });
                } else {
                    var cnt2 = 1;
                    $(this).find('.parentDiv').each(function() {
                        var beginDate = $(this).find('.begin_date').val();
                        var endDateInput = $(this).find('.end_date');
                        var endDateTxt = "";
                        if (endDateInput.length > 0) {
                            endDateTxt = $(endDateInput).val();
                        }
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('BeginDate', beginDate);
                        $('.serviceDateContainer.' + cnt).find('.orderContent.' + cnt2).attr('EndDate', endDateTxt);
                        cnt2 = cnt2 + 1;
                    });
                }
                cnt = cnt + 1;
            });


            return validateDate;
        });

        $('#next8').click(function() {
            $('.shippingError').text('');
            let billingCountry = $('#billing_country :selected').val();
            let shippingCountry = $('#shipping_method :selected').parent().attr('label');
            let hasMifi = $('#shipping_method :selected').attr('has-mifi');
            hasMifi = (hasMifi) ? true : false;
            let hasNetStick = $('#shipping_method :selected').attr('has-netstick');
            hasNetStick = (hasNetStick) ? true : false;

            let dateTOLeave = $('#date_to_leave').val();
            dateTOLeave = $.trim(dateTOLeave);
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = today.getFullYear();

            today = mm + '/' + dd + '/' + yyyy;

            let shippingMethodTitle = $('#shipping_method :selected').data('title');
            let date_to_leave = $('#date_to_leave').val();
            date_to_leave = $.trim(date_to_leave);
            date_to_leave = new Date(date_to_leave)
            let currentDate = new Date();
            const diffTime = Math.abs(date_to_leave - currentDate);
            let diffrance = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            $('.phonecard').each(function() {
                let chckboxName = $(this).find('.optional-title').text();
                chckboxName = $.trim(chckboxName);
                let isMifi = chckboxName.includes('Hotspot') || chckboxName.includes('wi-fi');
                let isNetStick = chckboxName.includes('Netstick');

                $(this).css({
                    "pointer-events": "all",
                    "opacity": "1"
                });

                if ((isMifi && !hasMifi) || (isNetStick && !hasNetStick)) {
                    $(this).css({
                        "pointer-events": "none",
                        "opacity": "0.6"
                    });
                    $(this).find('.qty').val(0);
                }

            });
            let shippingAddress = $('input[name=shipping_address]:checked').val();

            if ($('.schoolName').length > 0 && $('.schoolName').val() == '') {
                $('.schoolError').text('This field is required');
                $('.schoolName').focus();
                return false;
            } else if (shippingAddress == 'yes' && billingCountry != shippingCountry) {
                $('.shippingError').text("We're sorry, but the delivery method you chose is not available for the address you entered. Please check that you're providing the correct delivery address.")
                return false;

            } else if (dateTOLeave == today) {
                $('.shippingError').text("Please make sure that the delivery date is a future date");
                return false;
            } else if (shippingMethodTitle.includes('Free Delivery') && diffrance < 10) {
                $('.shippingError').text('Free shipping is not available when travel date is within ten days, please choose an alternative shipping method');
                return false;
            }
        });



        $(".PhoneSimInfo").click(function() {

            $(".popupTitle").empty();
            $(".popupDesc").empty();
            $(".popupTitle").text("TalknSave Phones and SIM Cards");
            $(".popupDesc").append("<div ><h3 style=' font-size: 22px;'>TalknSave Rental Phones</h3>Our phones are recent, feature-rich phones, with simple controls and great durability.<br>Data capabilities on these phones (examples: Sony Cedar, Nokia C2) allow for basic Facebook and email (especially Gmail), and light surfing.<br><h3 style='margin-top: 14px; font-size: 22px;'>TalknSave SIM Cards</h3>Use a TalknSave SIM card in your smartphone from home! Make sure you order the right size for your phone model. You can check your manual or measure the SIM you have:<h3 style='margin-top: 14px; font-size: 22px;'>Regular SIM cards:</h3>For older smartphones, these SIM cards are 2.5 centimeters long.<br><h3 style='margin-top: 14px; font-size: 22px;'>MicroSIM cards:</h3>For many current smartphones and the iPhone 4, MicroSIMs are 1.5 centimeters long.<br><h3 style='margin-top: 14px; font-size: 22px;'>NanoSIM cards: </h3>For some of the newest smartphones and the iPhone 5/6, NanoSIMs are 1.23 centimeters long.<br><h3 style='margin-top: 14px; font-size: 22px;'>Have a SIM card already?</h3> Use a SIM card from a previous rental! Put in your 19 digit SIM card number and we will put a new phone number on your SIM.</div>");
            openPopup('#wrap_popup2');

        });

        $('.simCheckBox').change(function() {
            var parent = findParent(this);

            //     var parent = $(this)
            var isEquipmentSim = false
            if ($(this).prop("checked")) {
                parent = $(this).closest('.parent');
                $(parent).find('.simNoclone').remove();
                $(parent).find('.cloneSim').remove();
                $(parent).find('.hiddenOrderNum').empty();

                $(parent).find('.equipmentSim:checked').each(function() {
                    AddSimInputBox(this);

                });
                return;
            } else {
                $(this).closest('.parent').find('.simNoclone').remove();
                let currentOption = $(this).closest('.parent').find('.equipmentSim:checked').data('name');
                let clone = $(this).data('orderqty');
                clone = parseInt(clone);

                clone = clone - 1;
                if (clone > 0) {
                    $(parent).find('.hiddenOrderNum').text(' for Order #1');
                }
                let orderNo = parent.find('.equipmentSim:checked').attr('orderno');
                for (i = 0; i < clone; i++) {
                    var simClone = $(parent).find('.cloneSimDefault').clone();
                    $(simClone).find('input').attr('name', 'equipment_order_' + orderNo + '_' + (i + 1));
                    $(simClone).attr('class', 'cloneSim simCount parentDiv');
                    $(simClone).find('.hiddenOrderNum').text('for Order #' + (i + 2));
                    //                     $(simClone).find('input').attr('onchange', 'needSim(this)');

                    $(parent).find('.cloneSimDefault').parent().append(simClone);


                    $(parent).find('.cloneSim').find('.icon-info-circled').remove();
                    $(parent).find('.cloneSim').find('.PhoneSimInfo').remove();



                    $(parent).find('.equipmentSim').unbind('click').click(function() {
                        AddSimInputBox(this);

                    });
                }
                $(this).closest('.parent').find('.equipmentSim:checked').each(function() {
                    AddSimInputBox(this);

                });
                appendCheckBox(this);

            }
            //             needSim(this);
        });



        $('#service_date').append('<div id="numberOfOrders" class="d-none">' + 3 + '</div>');

    });

    function submitMultiStepForm() {
        if (!$('#tnc').is(':checked')) {
            $(".errorTnc").text("Please check this box to proceed!")
            return false;
        }


        $("#next9").click();
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
        let callPackageCode = "<?php echo $bundles[0]['CallPackageCode']; ?>";
        let callpackageName = "<?php echo $bundles[0]['CallPackageName']; ?>";

        let shippingCity = $('input[name="shipping_city"]').val();
        let shipping_country = $('#shipping_method :selected').parent().attr('label');
        if (shipping_country) {
            shipping_country = shipping_country.trim();
        }
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





        var ob2 = new Object();
        var multiObjescts = new Array();
        var counter = 1;
        $('.serviceDateContainer').each(function() {
            var ob = new Object();
            var pageNameM = $(this).attr('pagename');
            ob.ContractType = $(this).attr('contracttype');
            ob.ProviderCode = $(this).attr('providercode');
            ob.txtSignupRep = $(this).attr('txtsignuprep');
            ob.LinkTypeCode = $(this).attr('linktypecode');
            ob.AgentCode = $(this).attr('agentcode');
            ob.SubAgentCode = $(this).attr('subagentcode');
            ob.bitCallPackageOverageProtection = false;
            ob.BundleId = $(this).attr('bundleid');

            let isSim = $(this).find('.orderContent.1').attr('equipmentissim');
            let IsSns = $(this).find('.orderContent.1').attr('equipmentissns');
            start_date = $(this).find(".begin_date").val();
            end_date = $(this).find(".end_date").val();
            start_date = start_date + " 12:00:00 AM";
            end_date = end_date + " 12:00:00 AM";

            let strAccessoryIdAndQuantity = '';
            $('.phonecard').each(function() {
                let qty = $(this).find('.qty').val();

                let planCode = $(this).find('.cardBody').attr('plancode');
                let equipmentCode = $(this).find('.cardBody').attr('equipmentcode');
                let optionCode = $(this).find('.cardBody').attr('optionalcode');

                if (qty > 0) {
                    if (!(planCode > -1 && equipmentCode > -1)) {
                        strAccessoryIdAndQuantity += optionCode + "-" + qty + ",";
                    }
                }
            });

            var europePlanSelection = "";
            var euroIDAndQty = "";
            try {
                var euroPlanName = $(this).attr('europeplanname');
                var checkBoxId = $(this).attr('europecheckboxid');
                //	var euroQuantity=$(this).attr('quantity');
                var euroQuantity = "1";


                if (checkBoxId != undefined && checkBoxId != null) {
                    euroIDAndQty = " " + checkBoxId + "-" + euroQuantity;
                    europePlanSelection = " " + euroPlanName + " " + checkBoxId + "-" + euroQuantity;
                }

            } catch (err) {
                console.log('europeError');
                console.log(err);
            }

            if (counter == 1) {
                ob.AccessoryIdAndQuantity = strAccessoryIdAndQuantity + "" + euroIDAndQty;;
            } else {
                ob.AccessoryIdAndQuantity = euroIDAndQty;
            }

            ob.txtSignupRep = $.trim($('.agentName').val());
            ob.ccemail = paymentEmail;
            ob.SessionID = "NC_" + "<?php echo uniqid() ?>";
            let subAgentCode =
                //	ob.SubAgentCode='<?php echo $data['SubAgentCode']; ?>';
                ob.BaseCode = (basecode) ? basecode : 100;
            ob.BaseNotes = shippingNotes;
            ob.bitCallPackageOverageProtection = false;
            ob.CallPackageCode = $(this).attr('callpackagecode');

            ob.CallPackageName = $(this).attr('callpackagename');
            ob.CCCode = null;
            ob.strCCExpDate = CCExpDate; // time and date not included 


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
            ob.ClientState = billingState //"Gujarat";
            ob.ClientStreet = $("[name='billing_address']").val();
            let clientZip = $("[name='billing_zip']").val();
            ob.ClientZip = (clientZip) ? clientZip : '0';

            ob.CompanyCode = $(this).attr('companycode');
            ob.PageName = pageNameM;

            try {
                var couponCodeCC = '<?php echo $data['CouponCode']; ?>';
                var couponCodeInput = $.trim($('#coupanCode').val());
                if (couponCodeCC != null && couponCodeCC != 'null' && couponCodeCC != '' && couponCodeInput === '') {
                    couponCodeCC = couponCodeCC;
                } else {
                    couponCodeCC = couponCodeInput
                }
                ob.CouponCode = couponCodeCC;
            } catch (err) {

            }
            ob.CouponCode = $('#coupanCode').val();
            ob.CreditEquipmentPurchase = null;
            let customerComment = $("[name='cc_note']").val();
            ob.CustomerComment = customerComment;
            ob.DataPackageCode = $(this).attr('datapackagecode');
            ob.DataPackageId = ob.DataPackageCode;
            ob.DataPackageName = $(this).attr('datapackagename');
            ob.DataPackgeSize = $(this).attr('datapackgesize');
            ob.DepartureDate = start_date;
            ob.Deposit = $(this).attr('deposit');

            let maximumPeriod = $(this).attr('max_period');

            let begin_date = $(this).find('.begin_date').datepicker("getDate");
            let end_year = new Date(begin_date).getFullYear();
            let end_month = new Date(begin_date).getMonth();
            let end_day = new Date(begin_date).getDate();
            let endDate = new Date(end_year + 10, end_month, end_day);

            let endDateStr = ((endDate.getMonth() > 8) ? (endDate.getMonth() + 1) : ('0' + (endDate.getMonth() + 1))) + '/' + ((endDate.getDate() > 9) ? endDate.getDate() : ('0' + endDate.getDate())) + '/' + endDate.getFullYear();

            endDateStr = endDateStr + " 12:00:00 AM";
            //ob.EndDate= maximumPeriod !=="" ? endDateStr : end_date ;
            if ((maximumPeriod == "" || maximumPeriod == undefined) && (end_date == "" || end_date == undefined)) {
                ob.EndDate = endDateStr;
            } else {
                ob.EndDate = end_date;
            }


            ob.EquipmentCode = $(this).attr('equipmentcode');
            ob.EquipmentModel = ob.EquipmentCode;
            ob.EquipmentName = $(this).find('.orderContent.1').attr('equipment');
            ob.EquipmentNotes = $(this).find('.orderContent.1').attr('equipmentnotes');
            ob.FirstName = fname;
            ob.GroupMemberID = "";
            let groupName = $('.bus').find(':selected').val()
            ob.GroupName = groupName ? groupName : null;
            ob.Hint = null;
            let insurance = $(this).attr('insurance');
            ob.Insurance = (insurance) ? true : false;
            ob.IsEquipmentSNS = (IsSns) ? true : false;
            ob.IsKosher = (koshar) ? true : false;
            ob.IsRequierdOperationSys = false;
            ob.IsSim = (IsSns) ? true : false;
            ob.IsSmartPhone = ($('#rental').is(':checked')) ? true : false; //false;
            ob.KITD = false;
            ob.KITD_BLOCK_ID = null;
            ob.KITD_PlanCode = -1;
            ob.KNTName = "";
            ob.KNTRequired = -1;
            ob.LanguageCode = 1;
            ob.LastName = lname;
            ob.ParentLink = $(this).attr('parentlinke');
            ob.ParentOnlineOrderCode = null;
            var phoneReq = $(this).find('.orderContent').length;

            ob.PhonesRequired = phoneReq;
            ob.PlanCode = $(this).attr('plancode');
            ob.PlanName = $(this).attr('planname2');
            ob.ProductId = 1;
            ob.PurchaseEquipment = false;
            ob.ReferrerCounter = null;
            ob.ReferrerEmail = "";
            ob.RentalCode = null;
            ob.SetupFeeText = "No";

            // 		AllalreadyHaveSim = 0 means hide shippingoption 
            let AllalreadyHaveSim = 0;
            $('.simCount').each(function(index) {
                let simValue = $(this).find('input:checked').val();

                if (simValue != '9999') {
                    AllalreadyHaveSim++;
                }
            });

            if (AllalreadyHaveSim == 0) {
                ob.ShipCity = "[have Sim]";
                ob.ShipCommercial = false;
                ob.ShipCountry = "Israel";
                ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
                ob.shipemail = ob.clientemail;
                ob.ShipFee = 0;

                ob.ShipMethod = "ALREADY_HAVE_SIM";

                ob.ShipName = "[have Sim]";
                ob.ShipPhone = "0";

                ob.ShippingName = "ALREADY_HAVE_SIM";
                ob.ShipPostalCode = "[have sim]";
                ob.ShipState = "NA";
                ob.ShipStreet = "[have Sim]";
            } else if ($('.shipping_option').hasClass('d-none')) {
                ob.ShipCity = "[pickup]";
                ob.ShipCommercial = false;
                ob.ShipCountry = shipping_country;
                ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
                ob.shipemail = ob.clientemail;
                ob.ShipFee = shippingCost;
                ob.ShipId = shippingId;
                ob.ShipMethod = shipMethod;
                let shippingNameInput = ob.ClientFirstName + ' ' + ob.ClientLastName;
                ob.ShipName = "[pickup]";
                ob.ShipPhone = ob.ClientHomePhone1;

                ob.ShippingName = (shippingName) ? shippingName : "[pickup]";
                ob.ShipPostalCode = "[pickup]";
                ob.ShipState = "NA";
                ob.ShipStreet = "[pickup]";
            } else {
                if ($("input[name='shipping_address']:checked").val() == 'yes') {
                    ob.ShipCity = ob.ClientCity;
                    ob.ShipCommercial = false;
                    ob.ShipCountry = ob.ClientCountry;
                    ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
                    ob.shipemail = ob.clientemail;
                    ob.ShipFee = shippingCost;
                    ob.ShipId = shippingId;
                    ob.ShipMethod = shipMethod;
                    let shippingNameInput = ob.ClientFirstName + ' ' + ob.ClientLastName;
                    ob.ShipName = (shippingNameInput) ? shippingNameInput : shippingName;
                    ob.ShipPhone = ob.ClientHomePhone1;

                    ob.ShippingName = (shippingName) ? shippingName : "[pickup]";
                    ob.ShipPostalCode = ob.ClientZip;
                    ob.ShipState = ob.ClientState;
                    ob.ShipStreet = ob.ClientStreet;
                } else {
                    ob.ShipCity = (shippingCity) ? shippingCity : "[pickup]";
                    ob.ShipCommercial = false;
                    ob.ShipCountry = shipping_country;
                    ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
                    ob.shipemail = paymentEmail;
                    ob.ShipFee = shippingCost;
                    ob.ShipId = shippingId;
                    ob.ShipMethod = shipMethod;
                    let shippingNameInput = $('input[name="shipping_name"]').val();
                    ob.ShipName = (shippingNameInput) ? shippingNameInput : shippingName;
                    ob.ShipPhone = shippingPhone;

                    ob.ShippingName = (shippingName) ? shippingName : "[pickup]";
                    ob.ShipPostalCode = (shippingPostalCode) ? shippingPostalCode : "[pickup]";
                    ob.ShipState = shippingState;
                    ob.ShipStreet = shippingAddress;
                }
            }

            let simVal = $("#need_sim input[type='radio']:checked").val();
            console.log("simVal", simVal);
            if (simVal == "3290") {
                ob.ShipCity = "[eSIM]";
                ob.ShipCommercial = false;
                ob.ShipCountry = "Israel";
                ob.ShipDate = (date_to_leave) ? date_to_leave + " 12:00:00 AM" : start_date;
                ob.shipemail = ob.clientemail;
                ob.ShipFee = 0;

                ob.ShipMethod = "eSIM";

                ob.ShipName = "[eSIM]";
                ob.ShipPhone = "0";

                ob.ShippingName = "ALREADY_HAVE_SIM";
                ob.ShipPostalCode = "[eSIM]";
                ob.ShipState = "NA";
                ob.ShipStreet = "[eSIM]";
            }


            ob.SMSPackageCode = $(this).attr('smspackagecode');
            ob.SMSPackageCounter = ob.SMSPackageCode;
            ob.SMSPackageName = $(this).attr('smspackagename');
            ob.Special = false;
            ob.StartDate = start_date;
            ob.SubLink = $(this).attr('sublink');
            ob.SublinkId = $(this).attr('sublinkid');
            ob.SurfAndSave = false;

            let tags = '';
            $('.phonecard').each(function() {
                let qty = $(this).find('.qty').val();

                let title = $(this).find('.cardBody').attr('OptionalName');
                let insurance = $(this).find('.cardBody').attr('Insurance');
                insurance = $.trim(insurance);
                let planCode = $(this).find('.cardBody').attr('plancode');
                let equipmentCode = $(this).find('.cardBody').attr('equipmentcode');
                let optionCode = $(this).find('.cardBody').attr('optionalcode');

                strAccessoryIdAndQuantity = '';
                if (qty > 0) {
                    let quantity = '';

                    if (qty > 1) {
                        quantity = '(Quantity:' + qty + ')';
                    }
                    if (insurance) {
                        insurance = 'Insuarance:' + true;
                    }
                    if (!(planCode > -1 && equipmentCode > -1)) {
                        strAccessoryIdAndQuantity = optionCode + "-" + qty + ",";
                    }



                    tags += title + ' ' + quantity + insurance + strAccessoryIdAndQuantity;
                }
            });
            let countAlreadySim = 0;
            let simString = '';
            $('.simCount').each(function(index) {
                let simValue = $(this).find('input:checked').val();

                if (simValue == '9999') {
                    countAlreadySim++;
                }
            });
            if (countAlreadySim > 0) {

                // 		   $('.simNoclone').each(function (index) {
                // 			   let simCardNum = $(this).find('input').val();
                // 			 simCardNum = simCardNum.replace(/\s/g, '');
                // 			   simString+= (index+1) +' '+'Special Order:Sim Number#: 89972' +simCardNum + '#' + '    ';
                // 		   });
            }

            let billingArr = pageNameM;
            billingArr = $.trim(billingArr);
            let nameArr = '';
            if (billingArr == 'bhlt') {
                let stu_name = $('input[name="stu_name"]').val();
                let parent_name = $('input[name="parent_name"]').val();
                let yeshiva_name = $('input[name="yeshiva_name"]').val();
                let rebbe_name = $('input[name="rebbe_name"]').val();
                // 					let whatsapp_num =  $("[name='whatspapp_num']").val();
                let whatsapp_num = $("[name='whatspapp_num']").find(":selected").val();
                stu_name = (stu_name) ? stu_name : '';
                parent_name = (parent_name) ? parent_name : '';
                yeshiva_name = (yeshiva_name) ? yeshiva_name : '';
                rebbe_name = (rebbe_name) ? rebbe_name : '';
                whatsapp_num = (whatsapp_num) ? whatsapp_num : '';

                // 				 nameArr = '[' + stu_name +','+ parent_name +',' + yeshiva_name +',' + rebbe_name + ']';
                nameArr = '[' + stu_name + ',' + ' ' + parent_name + ',' + ' ' + yeshiva_name + ',' + ' ' + rebbe_name + ',' + ' ' + whatsapp_num + ']';
            }

            //         ob.Tag = simString + tags + nameArr;
            var alreadyHaveSimNums = $(this).attr('simnumbers');
            if (alreadyHaveSimNums != undefined && alreadyHaveSimNums != "" && alreadyHaveSimNums != " ") {
                simString = alreadyHaveSimNums;
            }
            if (counter == 1) {
                ob.Tag = simString + tags + nameArr + europePlanSelection;
            } else {
                ob.Tag = simString + nameArr + europePlanSelection;
            }


            ob.TermsCode = -1;
            ob.TermsName = null;
            ob.UserName = fname + " " + lname;
            let schoolName = $('.schoolName').val();
            schoolName = (schoolName) ? schoolName : '';
            ob.UserStreet = (schoolName) ? schoolName : "<?php echo $data['AdminComment']; ?>";



            var simArr = [];

            $(this).find('.orderContent').each(function() {

                var SimDetails = new Object();
                SimDetails.KITD_PlanCode = parseFloat($(this).attr('staylocalkitd'));
                SimDetails.SMSPackageName = $(this).attr('inttxtplan');

                if (SimDetails.KITD_PlanCode != -1) {
                    SimDetails.KITD = true;
                } else {
                    SimDetails.KITD = false;
                }

                SimDetails.CallPackageCode = ob.CallPackageCode;
                SimDetails.curST_TOP_Price = 0.0;
                SimDetails.DataPackageCode = ob.DataPackageCode;
                SimDetails.DataPackageId = ob.DataPackageCode;
                SimDetails.DataPackageName = ob.DataPackageName;
                SimDetails.DataPackgeSize = ob.DataPackgeSize;
                SimDetails.decST_TOP_GB = 0.0;
                SimDetails.EquipmentCode = $(this).attr('equipmentcode');
                SimDetails.EquipmentModel = $(this).attr('equipmentcode');
                SimDetails.EquipmentName = $(this).attr('equipment');
                SimDetails.EquipmentNotes = $(this).attr('equipmentnotes');
                SimDetails.Insurance = $(this).attr('insurance') == "true" ? true : false;


                var startDt = $(this).attr('begindate');
                var endDt = $(this).attr('enddate');

                SimDetails.StartDate = startDt + " 12:00:00 AM";
                SimDetails.DepartureDate = startDt + " 12:00:00 AM";

                let begin_date2 = startDt;
                let end_year2 = new Date(begin_date2).getFullYear();
                let end_month2 = new Date(begin_date2).getMonth();
                let end_day2 = new Date(begin_date2).getDate();
                let endDate2 = new Date(end_year2 + 10, end_month2, end_day2);

                let endDateStr2 = ((endDate2.getMonth() > 8) ? (endDate2.getMonth() + 1) : ('0' + (endDate2.getMonth() + 1))) + '/' + ((endDate2.getDate() > 9) ? endDate2.getDate() : ('0' + endDate2.getDate())) + '/' + endDate2.getFullYear();

                endDateStr2 = endDateStr2 + " 12:00:00 AM";
                if ((maximumPeriod == "" || maximumPeriod == undefined) && (endDt == "" || endDt == undefined)) {
                    SimDetails.EndDate = endDateStr2;
                } else {
                    SimDetails.EndDate = endDt;
                }

                //SimDetails.EndDate = endDt + " 12:00:00 AM";
                SimDetails.Img = "https://www.talknsave.us/images/OneSimForall.jpg";
                // SimDetails.Insurance = (insurance) ? true : false;

                var isSns2 = $(this).attr('equipmentissns');
                var isKosher2 = $(this).attr('equipmentiskosher');
                var isSim2 = $(this).attr('equipmentissim');
                SimDetails.IsEquipmentSNS = (isSns2) ? true : false;
                SimDetails.IsKosher = (isKosher2) ? true : false;
                SimDetails.IsRequiredOperationSystem = false;
                SimDetails.IsSIM = (isSim2) ? true : false;

                var smsPkgCodeAndCounter = ob.SMSPackageCode;
                try {
                    var smsPackakeCode = $(this).attr('inttxtplancode');
                    if (smsPackakeCode != undefined && smsPackakeCode != "" && smsPackakeCode != "0") {
                        smsPkgCodeAndCounter = smsPackakeCode;
                    }
                } catch (err) {
                    smsPkgCodeAndCounter = "<?php echo $bundles[0]['SMSPackageCode']; ?>";
                }
                SimDetails.SMSPackageCode = smsPkgCodeAndCounter;
                SimDetails.SMSPackageCounter = smsPkgCodeAndCounter;
                simArr.push(SimDetails);
            });

            ob.SimDetails = simArr;

            ob.optionalOrders = new Object();
            var optionalOrderArray = [];
            if (counter == 1) {
                $('.phonecard').each(function() {
                    let qty = $(this).find('.qty').val();
                    if (qty > 0) {
                        let parent = $(this).closest(".phonecard");
                        let image = parent.find('.optional-image').attr('src');
                        let title = parent.find('.optional-title').data('title');
                        let qty = parent.find('.qty').val();


                        let ClientCode = parent.find('.cardBody').attr('ClientCode');
                        let CouponCode = parent.find('.cardBody').attr('CouponCode');
                        let Deposit = parent.find('.cardBody').attr('Deposit');
                        let EquipmentCode = parent.find('.cardBody').attr('EquipmentCode');
                        let Insurance = parent.find('.cardBody').attr('Insurance');
                        let OptionalCode = parent.find('.cardBody').attr('OptionalCode');

                        let OptionalFeeDesc = parent.find('.cardBody').attr('OptionalFeeDesc');
                        let OptionalImg = parent.find('.cardBody').attr('OptionalImg');
                        let OptionalName = parent.find('.cardBody').attr('OptionalName');
                        let OptionalType = parent.find('.cardBody').attr('OptionalType');
                        let OptionText = parent.find('.cardBody').attr('OptionText');
                        let PlanCode = parent.find('.cardBody').attr('PlanCode');
                        let Quantity = parent.find('.cardBody').attr('Quantity');
                        let RequiredInsurance = parent.find('.cardBody').attr('RequiredInsurance');
                        let RequiredOperationSystem = parent.find('.cardBody').attr('RequiredOperationSystem');
                        RequiredInsurance = RequiredInsurance.trim();
                        RequiredOperationSystem = RequiredOperationSystem.trim();
                        var newObject = new Object();
                        newObject.ClientCode = $.trim(ClientCode);
                        newObject.CouponCode = $.trim(CouponCode);
                        newObject.Deposit = $.trim(Deposit);
                        newObject.Insurance = (Insurance) ? true : false;
                        newObject.OptionalCode = $.trim(OptionalCode);
                        newObject.OptionalFeeDesc = $.trim(OptionalFeeDesc);
                        newObject.OptionalImg = $.trim(OptionalImg);
                        newObject.OptionalName = $.trim(OptionalName);
                        newObject.PlanCode = $.trim(PlanCode);
                        newObject.Quantity = qty;
                        newObject.EquipmentCode = $.trim(EquipmentCode);
                        newObject.RequiredInsurance = (RequiredInsurance) ? true : false;
                        newObject.RequiredOperationSystem = (RequiredOperationSystem) ? true : false;

                        optionalOrderArray.push(newObject);
                    }



                });
            }
            counter++;
            if (optionalOrderArray.length > 0) {
                ob.optionalOrders = optionalOrderArray;
            }

            ob.newsletter = $('#SubscribeNewsletter').is(':checked');
            ob.UserCity = "NA";
            multiObjescts.push(ob);
        });


        ob2 = multiObjescts;
        var data = JSON.stringify(ob2);
        var isOrderChanged = false;
        var isNewOrder = false;
        var PrevOrderDetails = sessionStorage.getItem("PrevOrderDetails");
        if (PrevOrderDetails != null && PrevOrderDetails != "") {
            if (data == PrevOrderDetails) {
                isOrderChanged = false;
                $(".loading").addClass('d-none');
            } else {
                isOrderChanged = true;
            }
        } else {
            isNewOrder = true;

        }
        console.log('OrderChanged ? ' + isOrderChanged);
        sessionStorage.setItem("PrevOrderDetails", data);
        console.log(ob2);
        if (isOrderChanged == true || isNewOrder == true) {
            if (isNewOrder == false) {
                cancelOrder(true);
            }
            $.post('https://talknsave.net/wp-content/themes/betheme-child/PatchMultiSaveApiResult.php', {
                    SaveApiData: data
                },
                function(msg) {
                    // $(".loading").addClass('d-none');
                    console.log(msg)
                    if (msg) {
                        if ((msg != '"Success"')) {
                            $(".loading").addClass('d-none');
                            $(".order-review-error").removeClass('d-none');
                            $(".order-review-error-message").text('There was a problem fetching information of this plan, please contact site administrator.');
                        } else {
                            $(".order-review-error").addClass('d-none');
                            $(".order_review").addClass('d-none');
                            $("#order-conformation").css({display: "block"});
                            $(".progress-bar").css("width", 100 + "%");
                            $(".loading").addClass('d-none');
                            //SummaryCreation(msg);
                        }


                        // let orderId = msg.replace(/['"]+/g, '');
                        // orderId = $.trim(orderId);
                        // $("#Confirmid").text(orderId);

                        // $(".progress-bar").css("width", 100 + "%");

                        // $.removeCookie('CartProduct', {
                        //     path: '/'
                        // });
                        //                         console.log(msg);
                    } else {
                        $(".loading").addClass('d-none');
                        $(".order_review").addClass('d-none');
                        $(".order-review-error").removeClass('d-none');
                        $(".order-review-error-message").text('Something went wrong please contact site Admin or try again after some time');
                        // alert('En error occurred please try again!');
                    }
                });
        }
        // else {
        //     $(".loading").addClass('d-none');
        // }

    }

    function SummaryCreation(msg) {

        // 		try{
        // 			 $('html, body').animate({
        //         scrollTop: $("#order_review .data").last().offset().top
        //     }, 2000);
        // 		}catch(e){
        // 			//do nothing
        // 		}
        $("#next9").click();

        var result = JSON.parse(msg);
        var placedOrders = result.data.placedOrders;
        var allInvoices = [];
        $(result.data.invoiceTables).each(function() {
            var invoices = JSON.parse(this);
            allInvoices.push(invoices);
        });
        console.log(result);
        console.log(allInvoices);
        var userName = $('#cname').parent().clone().html();
        var userEmail = $('#cemail').parent().clone().html();
        var userNumber = $('#cnumber').parent().clone().html();
        var finalSummary = '<div class="content secondSummary"><div class="userDetails"><h4 style="margin-left:-15px">Contact information</h4><div class="row">' + userName + '</div><div class="row">' + userEmail + '</div><div class="row">' + userNumber + '</div></div>';
        var totalOfGrandTotal = 0;

        $(allInvoices).each(function() {
            var dataPackage = ""
            var callPackage = ""
            var extendedDataPackage = ""

            var tblBills = this[0][0];
            var display_names = this[7][0].DisplayNames
            var tblOndeTimefees = this[2];
            var tblMonthlyfees = this[1];
            var vat = tblBills.VAT > 0 ? '$' + tblBills.VAT.toFixed(2) : 'Free';
            var grandTotal = tblBills.GrandTotal;
            totalOfGrandTotal += grandTotal;
            var allOneTimeFees = "";
            $(tblOndeTimefees).each(function() {
                var crRecord = this;
                if (crRecord.OnceFeeName == "Coupon Credit" || crRecord.OnceFeeName == "Coupon Code") {
                    var amount = crRecord.Amount == 0 ? 'Free' : (crRecord.Amount < 0) ? '$' + crRecord.Amount * -1 : '$' + crRecord.Amount;
                    var feeName = crRecord.OnceFeeName == "Coupon Code" ? "Coupon Credit" : crRecord.OnceFeeName
                    allOneTimeFees += '<div class="row " style="padding-bottom: 13px"><div class="col-md-6 col-6">' + feeName + ' </div><div class="col-md-6 col-6 text-right ">' + amount + '</div></div>';
                } else {
                    var amount = crRecord.Amount > 0 ? '$' + crRecord.Amount : 'Free';
                    var feeName = crRecord.OnceFeeName == "Rental Fee" ? "Extension Fee" : (crRecord.Comment.indexOf("Europe Plan") !== -1) ? "Accessory" : crRecord.OnceFeeName
                    allOneTimeFees += '<div class="row " style="padding-bottom: 13px"><div class="col-md-6 col-6">' + feeName + ' </div><div class="col-md-6 col-6 text-right ">' + amount + '</div></div>';
                }
            });

            $(tblMonthlyfees).each(function() {
                var crRecord = this;
                var amount = crRecord.Amount > 0 ? '$' + crRecord.Amount : 'Free';
                var feeName = crRecord.MonthlyFeeName;
                allOneTimeFees += '<div class="row " style="padding-bottom: 13px"><div class="col-md-6 col-6">' + feeName + ' </div><div class="col-md-6 col-6 text-right ">' + amount + '</div></div>';
            });

            if (tblBills.EquipmentModel != "Mobile Hotspot") {
                dataPackage = '<div class="row"><div class="col-md-6 col-6">Data </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.DataPackageName + '</div></div>';
                callPackage = '<div class="row"><div class="col-md-6 col-6">Call </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.CallPackageName + '</div></div>';
                extendedDataPackage = '<div class="row"><div class="col-md-6 col-6">SMS </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.SMSPackageName + '</div></div>';

            }
            // dataPackage = '<div class="row"><div class="col-md-6 col-6">Data </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.DataPackageName + '</div></div>';
            // callPackage = '<div class="row"><div class="col-md-6 col-6">Call </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.CallPackageName + '</div></div>';
            // extendedDataPackage = '<div class="row"><div class="col-md-6 col-6">SMS </div><div class="col-md-6 col-6 text-right data " id="">' + display_names.SMSPackageName + '</div></div>';

            finalSummary += '<div class="listofOrders"><div class="row"><div class="col-md-12 col-12"><h4 class="contact ">' + tblBills.PlanDisplayName + '</h4> </div></div><div class="row  "><div class="col-md-6 col-6">Equipment</div><div class="col-md-6 col-6 text-right cplan">' + tblBills.EquipmentModel + '</div></div>' + dataPackage + '' + callPackage + '' + extendedDataPackage + '' + allOneTimeFees + ' <div class="row " style="padding-bottom: 13px"><div class="col-md-6 col-6">VAT </div><div class="col-md-6 col-6 text-right font-weight-bold ">' + vat + '</div></div><div class="row border-bottom" style="padding-bottom: 13px"><div class="col-md-6 col-6">Total </div><div class="col-md-6 col-6 text-right font-weight-bold ">$' + grandTotal + '</div></div></div>';

        });
        totalOfGrandTotal = totalOfGrandTotal.toFixed(2);
        finalSummary += '<div class="row"><div class="col-md-6 col-6"><strong>TOTAL</strong></div><div class="col-md-6 col-6 text-right"><strong>$<span>' + totalOfGrandTotal + '</span>  </strong></div></div>';
        finalSummary += '<div class="row"><button type="submit" onclick="confirmAndPay()" style="margin-top: 31px;" class="btn btn-block place-order ">Click here to submit your order <i class="icon-right-thin"></i></button><div style="cursor: pointer;text-decoration: underline;" onclick="cancelOrder(false)">Go Back</div><button class="next d-none" id="next10"></button></div></div>';
        // 			$(".multipleOrderDefault").parent().parent().empty().append(finalSummary);
        $(".multipleOrderDefault").parent().parent().addClass('d-none');
        $(".multipleOrderDefault").parent().parent().parent().append(finalSummary);
        $('#order_review .previous').addClass('d-none');
        sessionStorage.setItem("PlacedOrder", JSON.stringify(placedOrders));
        if (msg) {
            let orderId = msg.replace(/['"]+/g, '');
            orderId = $.trim(orderId);
            //$("#Confirmid").text(orderId);
            // $("#next10").click();
            $(".progress-bar").css("width", 90 + "%");

            //                         console.log(msg);
        } else {
            $(".loading").addClass('d-none');
            alert('En error occurred please try again!');
        }
        $(".loading").addClass('d-none');
    }

    function confirmAndPay() {
        var placedTempOrder = sessionStorage.getItem("PlacedOrder");
        //placedTempOrder=JSON.parse(placedTempOrder);
        $(".loading").removeClass('d-none');
        $.post('https://talknsave.net/wp-content/themes/betheme-child/SaveApiResultAndPay.php', {
                SaveApiData: placedTempOrder
            },
            function(msg) {
                console.log(msg);
                if (msg) {
                    let orderId = msg.replace(/['"]+/g, '');
                    orderId = $.trim(orderId);
                    $("#Confirmid").text(orderId);
                    $("#next10").click();
                    sessionStorage.removeItem('PrevOrderDetails');
                    $(".loading").addClass('d-none');
                    $(".progress-bar").css("width", 100 + "%");
                    // new
                    $.removeCookie('CartProduct', {
                        path: '/'
                    });
                } else {
                    $(".loading").addClass('d-none');
                    alert('En error occurred please try again!');
                }
            });
    }

    function cancelOrder(isSystemDelete) {
        if (isSystemDelete == false) {
            $('#previous9').click();
        } else {
            var placedTempOrder = sessionStorage.getItem("PlacedOrder");
            console.log(placedTempOrder);
            //  $(".loading").removeClass('d-none');
            $.post('https://talknsave.net/wp-content/themes/betheme-child/CancelOrder.php', {
                    SaveApiData: placedTempOrder
                },
                function(msg) {
                    if (msg) {
                        $(".multipleOrderDefault").parent().parent().removeClass('d-none');
                        $('.content.secondSummary').remove();
                        // 						$('#previous9').click();
                        // $(".loading").addClass('d-none');
                        $('#order_review .previous').removeClass('d-none');
                    } else {
                        // $(".loading").addClass('d-none');
                        alert('En error occurred please try again!');
                    }
                });
        }
    }

    // $(".applyCouponBtn").click(function() {
    //     ApplyCoupon(this);
    // });

    $(".applyCouponBtn").click(function() {
        $('.CouponCodeMessage').text("").addClass('d-none');
        $('.CouponCodeError').addClass('d-none');
        var couponVal = $.trim($('#coupanCode').val());
        var linkID = "";
        var bundleID = "";
        var counter = 0;
        $('.serviceDateContainer').each(function() {
            if (counter == 0) {
                linkID += $(this).attr('sublinkid');
                bundleID += $(this).attr('bundleid');
            } else {
                linkID += "," + $(this).attr('sublinkid');
                bundleID += "," + $(this).attr('bundleid');
            }
            counter++;
        });

        if (couponVal == "") {
            $('.CouponCodeError').removeClass('d-none').empty().text("Please enter coupon code!");
            $('#newDiscountedPrice').addClass('d-none');
            $('#cprice').css('text-decoration', 'none');
            $('#cprice').css('color', 'black');
            $(".discountContainer").addClass('d-none');
        } else {
            $.ajax({
                url: "https://www.talknsave.net/wp-content/themes/betheme-child/MultiCouponCodeCheck.php?coupon=" + couponVal + "&b=" + bundleID + "&linkid=" + linkID,
                type: "GET",
                success: function(result) {
                    if (result == "invalid") {
                        $('.CouponCodeError').removeClass('d-none').empty().text("Coupon code is invalid or expired.");
                    } else {
                        var results = JSON.parse(result)
                        var isValid = false
                        for (let i = 0; i < results.length; i++) {
                            if (results[i].status == "valid") {
                                isValid = true
                            }
                        }
                        console.log(result);
                        if (!isValid) {
                            $('.CouponCodeError').removeClass('d-none').empty().text("Coupon code is invalid or expired.");
                            $('#coupanCode').val("");
                            $('#newDiscountedPrice').addClass('d-none');
                            $('#cprice').css('text-decoration', 'none');
                            $('#cprice').css('color', 'black');
                            $(".discountContainer").addClass('d-none');
                        } else {
                            $('.CouponCodeError').addClass('d-none');
                            $('.CouponCodeMessage').text("Coupon Applied Successfully!").removeClass('d-none');
                        }
                    }
                },
                error: function(err) {
                    console.log("Error occurred");
                    console.log(err);
                }
            });
        }
    });
</script>

<?php get_footer();
