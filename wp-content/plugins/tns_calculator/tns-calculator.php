<?php
/*Plugin Name: TNS calculator*/
if ( ! defined( 'WPINC' ) ) {
    die( '' );
}
function tns_calc_shortcode_init()
{
    function tns_hiddenCalcBlock($showHeader=true) {
        ?>

        <div id="calcCodeContainer" style="display: none">
			<div class="calcCodeContainerUnique"></div>
            <style>

            </style>
            <div class="section mcb-section full-width">
                <div class="calculator_block calc_glow">
                    <?php if ($showHeader) { ?>
                        <div class="centered">
                            <h2>What are your travel dates?</h2>
                            <h4>Select dates to activate service. Activation date is usually the date you arrive in USA
                                .</h4>
                        </div>
                    <?php } ?>
                    <form action="#" class="calc_form">
                        <div class="flexDisp">
                            <div id="halfWidth1" class="halfWidth"><label>Begin date:</label><input
                                        placeholder="mm/dd/yyyy" type="date" name="startDate"></div>
                            <div id="halfWidth2" class="halfWidth"><label>End date:</label><input
                                        placeholder="mm/dd/yyyy" type="date" name="endDate"></div>
                            <br/>
                        </div>
                        <div class="calc-rate result"></div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    function tns_calcJS($setPrices,$updateLinks,$showTable=true,$minDays=3,$minDayWarning=false,$goPricingJail=true,
                        $afterJQuery=null,$customUpdateScript=null) {
        if ($goPricingJail) { ?>
            <div id="goPricingJail" style="display:none">
                <?php
                echo do_shortcode("[go_pricing id=\"c6comfort__5a169b82a1946\"]");
                echo do_shortcode("[go_pricing id=\"c6comfort__5a169dd2a5e63\"]");
                ?>
            </div>
        <?php } ?>
        <style>
            <?php
            echo file_get_contents(__DIR__.'/jquery.ui.min.css');
            echo "\n";
            echo file_get_contents(__DIR__.'/tns_calc.css');
             ?>
        </style>
        <script>
            //With this function you can put multiline string as a
            // function comment, starting with /*! and ending with */
            //Then you call hereDoc(functionName) to retrieve the string
            //function hereDoc(f) {
            //
            //  return f.toString().
            //      replace(/^[^\/]+\/\*!?/, '').
            //      replace(/\*\/[^\/]+$/, '');
            //}

            function ajqMain($) {

                function calcforminput() {

                    try {
                        <?php
                        $setPrices();
                        ?>
                        isChange = false;
                        //startDate = $(".calculator_block [name='startDate']")[0].valueAsDate;
                        //endDate = $(".calculator_block [name='endDate']")[0].valueAsDate;
                        startDate = $("#halfWidth1 input").datepicker( "getDate" );
                        if (startDate == null) {
                            return;
                        }
                        startDate.setHours(01);
                        startDate.setMinutes(00);
                        startDate.setSeconds(00);
                        endDate = $("#halfWidth2 input").datepicker( "getDate" );
                        if (typeof window.prevStartDate == 'undefined' || window.prevStartDate == null || window.prevStartDate > startDate || window.prevStartDate < startDate) {
                            window.prevStartDate = startDate;
                            isChange = true;
                        }
                        if (typeof window.prevEndDate == 'undefined' || window.prevEndDate == null || window.prevEndDate > endDate || window.prevEndDate < endDate) {
                            window.prevEndDate = endDate;
                            isChange = true;
                        }
                        if (isChange) {
                            result = $(".calculator_block .result");
                            noOfDays = Math.round((endDate - startDate) / (24 * 60 * 60 * 1000)) + 1;
                            today = new Date();
                            today.setHours(00);
                            today.setMinutes(00);
                            today.setSeconds(00);
                            if (startDate < today || (noOfDays < 1 && endDate != null)) {
                                result.text('Invalid dates');
                                result.attr('data-allow-progress','0');
                            } else {
                                if (noOfDays < <?php echo $minDays; ?>) {
                                    noOfDays = <?php echo $minDays; ?>;
                                    <?php if ($minDayWarning) { ?>
                                    if (endDate != null) {
                                        result.text('Minimum order is for 7 days');
                                    }
                                    <?php } ?>
                                } else {
                                    result.text('');
                                }
                                if (endDate == null) {
                                    return;
                                }
                                <?php if ($customUpdateScript==null || $customUpdateScript=='') { ?>
                                result.attr('data-allow-progress','1');
                                cheapPlanPrice = (Math.round(
                                    (noOfDays *
                                    basicPlanPrice) * 100) / 100);
                                standardPlanPrice = (Math.round(
                                    (noOfDays *
                                    extraPlanPrice) * 100) / 100);
                                superPlanPrice = (Math.round(
                                    (noOfDays *
                                    premiumPlanPrice) * 100) / 100);
                                <?php if ($showTable==true) { ?>
                                result[0].innerHTML =
                                    "<table><tr><td>Basic plan: $" + cheapPlanPrice +
                                    "</td><td><a id='basicPlanOrderNow' href=''></a></td></tr><tr><td>Extra plan: $" +
                                    standardPlanPrice +
                                    "</td><td><a id='standardPlanOrderNow' href=''></a></td></tr><tr><td>Premium " +
                                    "plan: $" + superPlanPrice +
                                    "</td><td><a id='premiumPlanOrderNow' " + "href=''></a></td></tr></table>";
                                <?php } ?>
                                if (noOfDays>=17 && noOfDays<31) {
                                    setTimeout(function() {
                                        $=jQuery;
                                        $('body').append('<div id="myModal" class="modal">' +
                                            '<div class="modal-content"><span class="close">&times;</span><div></div>' +
                                            '</div></div>');
                                        var firstStyle = null;    
                                        firstStyle = jQuery("#goPricingJail").children("div").first().prev();
                                        if (firstStyle.prop("tagName")=="STYLE") {
                                        	$('#myModal .modal-content div')
                                            .append(firstStyle.clone());
                                        }   
                                        $('#myModal .modal-content div')
                                            .append(jQuery("#goPricingJail").children("div").first().clone());
                                        if (typeof window.orig17_31_url == 'undefined' ||
                                            window.orig17_31_url == null || window.orig17_31_url == '') {
                                            window.orig17_31_url = $('#myModal #go-pricing-table-9488-column-0 > div ' +
                                                '> ul > li > div > div > a').attr('href');
                                        }
                                        $('#myModal #go-pricing-table-9488-column-0 > div ' +
                                            '> ul > li > div > div > a').attr('href',window.orig17_31_url + "&startDate=" + startDate.getFullYear() + "_" +
                                            (startDate.getMonth() + 1) + "_" + startDate.getDate() + "&noOfDays=" +
                                            Math.round(noOfDays));
                                        $('#myModal #go-pricing-table-9488-column-0 > div.gw-go-col-inner > div' +
                                            '.gw-go-footer-wrap > div.gw-go-footer > div > div > div > div').hide();
                                        var modal = document.getElementById("myModal");
                                        //var span = document.getElementsByClassName("close")[0];
                                        var span = jQuery("#myModal .close")[0];
                                        span.onclick = function () {
                                            modal.style.display = "none";
                                            jQuery('#myModal').remove();
                                        }
                                        window.onclick = function (event) {
                                            if (event.target == modal) {
                                                modal.style.display = "none";
                                                jQuery('#myModal').remove();
                                            }
                                        }
                                        jQuery('#myModal').fadeIn();
                                        modal.style.display = "block";
                                    }, 3000);
                                } else if (noOfDays>=31 && noOfDays<61) {
                                    setTimeout(function() {
                                        $=jQuery;
                                        $('body').append('<div id="myModal" class="modal">' +
                                            '<div class="modal-content"><span class="close">&times;</span><div></div>' +
                                            '</div></div>');
                                        var lastStyle = null;   
                                        lastStyle = jQuery("#goPricingJail").children("div").last().prev(); 
                                        if (lastStyle.prop("tagName")=="STYLE") {
                                        	$('#myModal .modal-content div')
                                            .append(lastStyle.clone());
                                        }                                           
                                        $('#myModal .modal-content div')
                                            .append(jQuery("#goPricingJail").children("div").last().clone());
                                        if (typeof window.orig31_60_url == 'undefined' ||
                                            window.orig31_60_url == null || window.orig31_60_url == '') {
                                            window.orig31_60_url = $('#myModal #go-pricing-table-9489-column-0 > div ' +
                                                '> ul > li > div > div > a').attr('href');
                                        }
                                        $('#myModal #go-pricing-table-9489-column-0 > div ' +
                                            '> ul > li > div > div > a').attr('href',window.orig31_60_url + "&startDate=" + startDate.getFullYear() + "_" +
                                            (startDate.getMonth() + 1) + "_" + startDate.getDate() + "&noOfDays=" +
                                            Math.round(noOfDays));
                                        $('#myModal #go-pricing-table-9489-column-0 > div.gw-go-col-inner > div' +
                                            '.gw-go-footer-wrap > div.gw-go-footer > div > div > div > div').hide();
                                        var modal = document.getElementById("myModal");
                                        //var span = document.getElementsByClassName("close")[0];
                                        var span = jQuery("#myModal .close")[0];
                                        span.onclick = function() {
                                            modal.style.display = "none";
                                            jQuery('#myModal').remove();
                                        }
                                        window.onclick = function(event) {
                                            if (event.target == modal) {
                                                modal.style.display = "none";
                                                jQuery('#myModal').remove();
                                            }
                                        }
                                        jQuery('#myModal').fadeIn();
                                        modal.style.display = "block";
                                    }, 3000);
                                } else if (noOfDays>=61) {
                                    result.text('Maximum order is for 60 days');
                                }
                                <?php } else {
                                echo $customUpdateScript;
                            } ?>
                                <?php
                                $updateLinks();
                                ?>
                            }
                        }
                    } catch (e) {
                        console.log(e);
                    }
                }

                try {
                    //startDate = $(".calculator_block [name='startDate']");
                    //endDate = $(".calculator_block [name='endDate']");
                    //startDate[0].valueAsDate = new Date();
                    //endDate[0].valueAsDate = new Date();
                    setInterval(calcforminput, 500);
                } catch (e) {
                    console.log(e);
                }
            }

            function checkjQuery() {

                if (jQuery != null) {

                    <?php
                    echo file_get_contents(__DIR__.'/jquery.ui.min.js');
                    ?>

					if (document.getElementsByClassName('calcCodeContainerUnique').length <= 1) {
						if (document.getElementsByClassName('CalculatorGoesHere').length>0) {
							jQuery(".CalculatorGoesHere").first().children().first().before(
								document.getElementById("calcCodeContainer").innerHTML);
						} else {
							jQuery("#HeaderCompare").after(document.getElementById("calcCodeContainer").innerHTML);
						}						
					}				
					
                    window.__startDate = startDate = jQuery(".calculator_block [name='startDate']");
                    window.__endDate = endDate = jQuery(".calculator_block [name='endDate']");
                    startDate.attr('type',null).datepicker({ dateFormat: 'mm/dd/yy' , beforeShow: function(input, inst) {
                        setTimeout(function () {
                            var offsets = window.__startDate.offset();
                            var top = offsets.top + window.__startDate.height();
                            inst.dpDiv.css({
                                'top': top
                            });
                        });
                    }});
                    endDate.attr('type',null).datepicker({ dateFormat: 'mm/dd/yy' , beforeShow: function(input, inst) {
                        setTimeout(function () {
                            var offsets = window.__endDate.offset();
                            var top = offsets.top + window.__endDate.height();
                            inst.dpDiv.css({
                                'top': top
                            });
                        });
                    }});
                    window.__showAlert=function(){
                        theLink = jQuery("#go-pricing-table-9340-column-0 > div.gw-go-col-inner > ul > li > div > div > a");
                        if (theLink[0]==null) {
                            setTimeout(window.__showAlert,500);
                        } else {
                            function updateButton(theLinkToA) {
                                theLink = theLinkToA;
                                theLink.on('click', function (evnt) {
                                    evnt.preventDefault();
                                    targetEl = jQuery(evnt.target);
                                    targetEl = targetEl.parent().parent().find('a');
                                    if (targetEl.attr('href')!='' && targetEl.attr('href')!=null) {
                                        window.location.href=targetEl.attr('href');
                                    } else {
                                        if (jQuery('#selectDatesInfo')[0]==null) {
                                            jQuery('body').append('<div ' +
                                                'id=\'selectDatesInfo\'>' +
                                                '<h2>Please select dates</h2></div>');
                                        }
                                        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
                                        jQuery('#selectDatesInfo').fadeIn(1000);
                                        jQuery('#selectDatesInfo').fadeOut(1000);
                                    }
                                });
                            }
                            updateButton(theLink);
                            updateButton(jQuery("#go-pricing-table-9340-column-1 > div.gw-go-col-inner > ul > li > " +
                                "div > div > a"));
                            updateButton(jQuery("#go-pricing-table-9340-column-2 > div.gw-go-col-inner > ul > li > " +
                                "div > div > a"));
                        }
                    };
                    setTimeout(window.__showAlert,500);
                    <?php if ($afterJQuery!=null && $afterJQuery!='') { echo $afterJQuery; } ?>
                    //startDate.val('');
                    //endDate.val('');
                    ajqMain(jQuery);
                } else {
                    setTimeout(checkjQuery, 500);
                }
            }

            checkjQuery();
        </script>
        <?php
    }

    function tns_calculator($atts = [], $content = null)
    {
        $atts = shortcode_atts(
            array(
                'basicPlanPrice' => '2.99',
                'extraPlanPrice' => '4.99',
                'premiumPlanPrice' => '5.99',
                'link1Selector' => '#go-pricing-table-8321-column-0 > div.gw-go-col-inner > div.gw-go-footer-wrap > div.gw-go-footer > div > div.gw-go-footer-row.gw-go-even > div > a',
                'link2Selector' => '#go-pricing-table-8321-column-1 > div.gw-go-col-inner > div.gw-go-footer-wrap > div.gw-go-footer > div > div.gw-go-footer-row.gw-go-even > div > a',
                'link3Selector' => '#go-pricing-table-8321-column-2 > div.gw-go-col-inner > div.gw-go-footer-wrap > div.gw-go-footer > div > div.gw-go-footer-row.gw-go-even > div > a'
            ), $atts );
        $setPrices1 = function() use ($atts) {
            $retVal =
                "<script>
                basicPlanPrice = ".$atts['basicPlanPrice'].";
                extraPlanPrice = ".$atts['extraPlanPrice'].";
                premiumPlanPrice = ".$atts['premiumPlanPrice'].";
                </script>";
            $retVal=str_replace("<script>","",$retVal);
            $retVal=str_replace("</script>","",$retVal);
            echo $retVal;
        };
        $updateLinks1 = function() use ($atts) {
            $retVal =
                "<script>
                theLink = $(\"".$atts['link1Selector']."\");
                if (typeof window.origLink1 == 'undefined' || window.origLink1 == null)
                    window.origLink1 = theLink.attr(\"href\");
                hrefTheLink = window.origLink1 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                theLink.attr(\"href\", hrefTheLink);
                theLink2 = $(\"".$atts['link2Selector']."\");
                if (typeof window.origLink2 == 'undefined' || window.origLink2 == null)
                    window.origLink2 = theLink2.attr(\"href\");
                hrefTheLink2 = window.origLink2 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                theLink2.attr(\"href\", hrefTheLink2);
                theLink3 = $(\"".$atts['link3Selector']."\");
                if (typeof window.origLink3 == 'undefined' || window.origLink3 == null)
                    window.origLink3 = theLink3.attr(\"href\");
                hrefTheLink3 = window.origLink3 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                theLink3.attr(\"href\", hrefTheLink3);
                orderNowBasic = $('#basicPlanOrderNow').attr('href',hrefTheLink).text('Order Now!');
                orderNowStandard = $('#standardPlanOrderNow').attr('href',hrefTheLink2).text('Order Now!');
                orderNowPremium = $('#premiumPlanOrderNow').attr('href',hrefTheLink3).text('Order Now!');
                </script>";
            $retVal=str_replace("<script>","",$retVal);
            $retVal=str_replace("</script>","",$retVal);
            echo $retVal;
        };
        tns_hiddenCalcBlock();
        tns_calcJS($setPrices1,$updateLinks1);
        return $content;
    }

    function tns_calculator2($atts=[],$content=null) {
        $atts = shortcode_atts(
            array(
                'basicPlanPrice' => '2.99',
                'extraPlanPrice' => '4.99',
                'premiumPlanPrice' => '5.99',
                'link1Selector' => '#go-pricing-table-9340-column-0 > div.gw-go-col-inner > ul > li > div > div > a',
                'link2Selector' => '#go-pricing-table-9340-column-1 > div.gw-go-col-inner > ul > li > div > div > a',
                'link3Selector' => '#go-pricing-table-9340-column-2 > div.gw-go-col-inner > ul > li > div > div > a',
                'total1Selector' => 'h3.totalBasic',
                'total2Selector' => 'h3.totalStandard',
                'total3Selector' => 'h3.totalPremium',
                'link1href' => '',
                'link2href' => '',
                'link3href' => ''
            ), $atts );
        $setPrices1 = function() use ($atts) {
            $retVal =
                "<script>
                basicPlanPrice = ".$atts['basicPlanPrice'].";
                extraPlanPrice = ".$atts['extraPlanPrice'].";
                premiumPlanPrice = ".$atts['premiumPlanPrice'].";
                </script>";
            $retVal=str_replace("<script>","",$retVal);
            $retVal=str_replace("</script>","",$retVal);
            echo $retVal;
        };
        $updateLinks1 = function() use ($atts) {
            $link1js = null;
            $link1js2 = null;
            if ($atts['link1href']=='' || $atts['link1href']==null) {
                $link1js = "window.origLink1 = theLink.attr(\"href\");";
                $link1js2 = "https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=370&linkid=15527";
            } else {
                $link1js = "window.origLink1 = '".$atts['link1href']."';";
                $link1js2 = $atts['link1href'];
            }
            $link2js = null;
            $link2js2 = null;
            if ($atts['link2href']=='' || $atts['link2href']==null) {
                $link2js = "window.origLink2 = theLink2.attr(\"href\");";
                $link2js2 = "https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=371&linkid=15527";
            } else {
                $link2js = "window.origLink2 = '".$atts['link2href']."';";
                $link2js2 = $atts['link2href'];
            }
            $link3js = null;
            $link3js2 = null;
            if ($atts['link3href']=='' || $atts['link3href']==null) {
                $link3js = "window.origLink3 = theLink3.attr(\"href\");";
                $link3js2 = "https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=372&linkid=15527";
            } else {
                $link3js = "window.origLink3 = '".$atts['link3href']."';";
                $link3js2 = $atts['link3href'];
            }
            $retVal =
                "<script>
                if ($(\".calculator_block .result\").attr('data-allow-progress')=='0') {
                    theLink = $(\"".$atts['link1Selector']."\");
                    if (typeof window.origLink1 == 'undefined' || window.origLink1 == null) { 
                        ".$link1js."
                    } 
                    if (window.origLink1=='') {
                        window.origLink1 = '".$link1js2."';//https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=370&linkid=15527';
                    }    
                    hrefTheLink = '';//window.origLink1 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                    theLink.attr(\"href\", hrefTheLink);
                    theLink2 = $(\"".$atts['link2Selector']."\");
                    if (typeof window.origLink2 == 'undefined' || window.origLink2 == null) {
                        ".$link2js."
                    }
                    if (window.origLink2=='') {
                        window.origLink2 = '".$link2js2."';
                    }    
                    hrefTheLink2 = '';//window.origLink2 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                    theLink2.attr(\"href\", hrefTheLink2);
                    theLink3 = $(\"".$atts['link3Selector']."\");
                    if (typeof window.origLink3 == 'undefined' || window.origLink3 == null) {
                        ".$link3js."
                    }
                    if (window.origLink3=='') {
                        window.origLink3 = '".$link3js2."';
                    }    
                    hrefTheLink3 = '';//window.origLink3 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                    theLink3.attr(\"href\", hrefTheLink3);
                    orderNowBasic = $('#basicPlanOrderNow').attr('href',hrefTheLink).text('Order Now!');
                    orderNowStandard = $('#standardPlanOrderNow').attr('href',hrefTheLink2).text('Order Now!');
                    orderNowPremium = $('#premiumPlanOrderNow').attr('href',hrefTheLink3).text('Order Now!');
                    textTotal = 'Total: $';
                    basicPlanPrice = $(\"".$atts['total1Selector']."\").text(textTotal+cheapPlanPrice).css('visibility','hidden');
                    standardPlanPrice = $(\"".$atts['total2Selector']."\").text(textTotal+standardPlanPrice).css('visibility','hidden');
                    premiumPlanPrice = $(\"".$atts['total3Selector']."\").text(textTotal+superPlanPrice).css('visibility','hidden');
                    $(\".calculator_block .result\").text('Please choose the dates');
                } else {
                    theLink = $(\"".$atts['link1Selector']."\");
                    if (typeof window.origLink1 == 'undefined' || window.origLink1 == null) {
                        " . $link1js . "
                    }    
                    if (window.origLink1=='') {
                        window.origLink1 = '".$link1js2."';
                    }    
                    hrefTheLink = window.origLink1 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                    theLink.attr(\"href\", hrefTheLink);
                    theLink2 = $(\"".$atts['link2Selector']."\");
                    if (typeof window.origLink2 == 'undefined' || window.origLink2 == null) {
                        " . $link2js . "
                    }    
                    if (window.origLink2=='') {
                        window.origLink2 = '" . $link2js2 . "';
                    }    
                    hrefTheLink2 = window.origLink2 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                    theLink2.attr(\"href\", hrefTheLink2);
                    theLink3 = $(\"".$atts['link3Selector']."\");
                    if (typeof window.origLink3 == 'undefined' || window.origLink3 == null) {
                        " . $link3js . "
                    }    
                    if (window.origLink3=='') {
                        window.origLink3 = '" . $link3js2 . "';
                    }    
                    hrefTheLink3 = window.origLink3 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);    
                    theLink3.attr(\"href\", hrefTheLink3);
                    orderNowBasic = $('#basicPlanOrderNow').attr('href',hrefTheLink).text('Order Now!');
                    orderNowStandard = $('#standardPlanOrderNow').attr('href',hrefTheLink2).text('Order Now!');
                    orderNowPremium = $('#premiumPlanOrderNow').attr('href',hrefTheLink3).text('Order Now!');
                    textTotal = 'Total: $';
                    basicPlanPrice = $(\"".$atts['total1Selector']."\").text(textTotal+cheapPlanPrice).css('visibility','visible');
                    standardPlanPrice = $(\"".$atts['total2Selector']."\").text(textTotal+standardPlanPrice).css('visibility','visible');
                    premiumPlanPrice = $(\"".$atts['total3Selector']."\").text(textTotal+superPlanPrice).css('visibility','visible');
                }
                </script>";
            $retVal=str_replace("<script>","",$retVal);
            $retVal=str_replace("</script>","",$retVal);
            echo $retVal;
        };
        tns_hiddenCalcBlock(false);
        tns_calcJS($setPrices1,$updateLinks1,false,7,true);
        return $content;
    }

    function tns_loc_internet_calc($atts=[],$content=null) {
        $atts = shortcode_atts(
            array(
                'prices64' => '',
                'link1Selector' => '#go-pricing-table-1636-column-0 > div.gw-go-col-inner' .
                    ' > div.gw-go-footer-wrap > div.gw-go-footer > div' .
                    ' > div.gw-go-footer-row.gw-go-even > div > a',
                //'#go-pricing-table-9340-column-0 > div.gw-go-col-inner > ul > li > div > div > a',
                'link2Selector' => '#go-pricing-table-1636-column-1 > div.gw-go-col-inner' .
                    ' > div.gw-go-footer-wrap > div.gw-go-footer > div' .
                    ' > div.gw-go-footer-row.gw-go-even > div > a',
                //'#go-pricing-table-9340-column-1 > div.gw-go-col-inner > ul > li > div > div > a',
                'link3Selector' => '#go-pricing-table-1636-column-2 > div.gw-go-col-inner' .
                    ' > div.gw-go-footer-wrap > div.gw-go-footer > div' .
                    ' > div.gw-go-footer-row.gw-go-even > div > a',
                //'#go-pricing-table-9340-column-2 > div.gw-go-col-inner > ul > li > div > div > a',
                'total1Selector' => '',//'h3.totalBasic',
                'total2Selector' => '',//'h3.totalStandard',
                'total3Selector' => ''//'h3.totalPremium'
            ), $atts, 'tns_loc_internet_calc' );
        if ($atts['prices64']!='') {
            $atts['prices64'] = json_decode(base64_decode($atts['prices64']));
        }
        //var_dump($atts);
        define('DAYS7',0);
        define('DAYS14',1);
        define('DAYS30',2);
        define('DAYS60',3);
        define('DAYS90',4);
        define('SUBLINK',0);
        define('BUNDLE',1);
        define('LINKNO',2);
        define('PRICEPERPERIOD',3);

        /*
        $firstPlanPrice7 = null;
        $secondPlanPrice7 = null;
        $thirdPlanPrice7 = null;
        $firstPlanPrice14 = null;
        $secondPlanPrice14 = null;
        $thirdPlanPrice14 = null;
        $firstPlanPrice30 = null;
        $secondPlanPrice30 = null;
        $thirdPlanPrice30 = null;
        $firstPlanPrice60 = null;
        $secondPlanPrice60 = null;
        $thirdPlanPrice60 = null;
        $firstPlanPrice90 = null;
        $secondPlanPrice90 = null;
        $thirdPlanPrice90 = null;
        */
        /*
        for ($i=0;$i<3;$i++) {
            if ($atts['prices64'][7DAYS][$i][LINKNO]==1) {
                $firstPlanPrice7 = $atts['prices64'][7DAYS][$i][PRICEPERPERIOD];
                $firstPlanLink7 = '&b='.$atts['prices64'][7DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][7DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][7DAYS][$i][LINKNO]==2) {
                $secondPlanPrice7 = $atts['prices64'][7DAYS][$i][PRICEPERPERIOD];
                $secondPlanLink7 = '&b='.$atts['prices64'][7DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][7DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][7DAYS][$i][LINKNO]==3) {
                $thirdPlanPrice7 = $atts['prices64'][7DAYS][$i][PRICEPERPERIOD];
                $thirdPlanLink7 = '&b='.$atts['prices64'][7DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][7DAYS][$i][SUBLINK];
            }
            if ($atts['prices64'][14DAYS][$i][LINKNO]==1) {
                $firstPlanPrice14 = $atts['prices64'][14DAYS][$i][PRICEPERPERIOD];
                $firstPlanLink14 = '&b='.$atts['prices64'][14DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][14DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][14DAYS][$i][LINKNO]==2) {
                $secondPlanPrice14 = $atts['prices64'][14DAYS][$i][PRICEPERPERIOD];
                $secondPlanLink14 = '&b='.$atts['prices64'][14DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][14DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][14DAYS][$i][LINKNO]==3) {
                $thirdPlanPrice14 = $atts['prices64'][14DAYS][$i][PRICEPERPERIOD];
                $thirdPlanLink14 = '&b='.$atts['prices64'][14DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][14DAYS][$i][SUBLINK];
            }
            if ($atts['prices64'][30DAYS][$i][LINKNO]==1) {
                $firstPlanPrice30 = $atts['prices64'][30DAYS][$i][PRICEPERPERIOD];
                $firstPlanLink30 = '&b='.$atts['prices64'][30DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][30DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][30DAYS][$i][LINKNO]==2) {
                $secondPlanPrice30 = $atts['prices64'][30DAYS][$i][PRICEPERPERIOD];
                $secondPlanLink30 = '&b='.$atts['prices64'][30DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][30DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][30DAYS][$i][LINKNO]==3) {
                $thirdPlanPrice30 = $atts['prices64'][30DAYS][$i][PRICEPERPERIOD];
                $thirdPlanLink30 = '&b='.$atts['prices64'][30DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][30DAYS][$i][SUBLINK];
            }
            if ($atts['prices64'][60DAYS][$i][LINKNO]==1) {
                $firstPlanPrice60 = $atts['prices64'][60DAYS][$i][PRICEPERPERIOD];
                $firstPlanLink60 = '&b='.$atts['prices64'][60DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][60DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][60DAYS][$i][LINKNO]==2) {
                $secondPlanPrice60 = $atts['prices64'][60DAYS][$i][PRICEPERPERIOD];
                $secondPlanLink60 = '&b='.$atts['prices64'][60DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][60DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][60DAYS][$i][LINKNO]==3) {
                $thirdPlanPrice60 = $atts['prices64'][60DAYS][$i][PRICEPERPERIOD];
                $thirdPlanLink60 = '&b='.$atts['prices64'][60DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][60DAYS][$i][SUBLINK];
            }
            if ($atts['prices64'][90DAYS][$i][LINKNO]==1) {
                $firstPlanPrice90 = $atts['prices64'][90DAYS][$i][PRICEPERPERIOD];
                $firstPlanLink90 = '&b='.$atts['prices64'][90DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][90DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][90DAYS][$i][LINKNO]==2) {
                $secondPlanPrice90 = $atts['prices64'][90DAYS][$i][PRICEPERPERIOD];
                $secondPlanLink90 = '&b='.$atts['prices64'][90DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][90DAYS][$i][SUBLINK];
            } else if ($atts['prices64'][90DAYS][$i][LINKNO]==3) {
                $thirdPlanPrice90 = $atts['prices64'][90DAYS][$i][PRICEPERPERIOD];
                $thirdPlanLink90 = '&b='.$atts['prices64'][90DAYS][$i][BUNDLE].'&linkid='.$atts['prices64'][90DAYS][$i][SUBLINK];
            }
        }*/
        /*
        $firstPlanPrice7 = $atts['prices64'][7DAYS][2];
        $secondPlanPrice7 = $atts['extraPlanPrice'];
        $thirdPlanPrice7 = $atts['premiumPlanPrice'];
        $firstPlanPrice14 = $atts['premiumPlanPrice'];
        $secondPlanPrice14 = $atts['premiumPlanPrice'];
        $thirdPlanPrice14 = $atts['premiumPlanPrice'];
        $firstPlanPrice30 = ".$atts['premiumPlanPrice'].";
        $secondPlanPrice30 = ".$atts['premiumPlanPrice'].";
        $thirdPlanPrice30 = ".$atts['premiumPlanPrice'].";
        $firstPlanPrice60 = ".$atts['premiumPlanPrice'].";
        $secondPlanPrice60 = ".$atts['premiumPlanPrice'].";
        $thirdPlanPrice60 = ".$atts['premiumPlanPrice'].";
        $firstPlanPrice90 = ".$atts['premiumPlanPrice'].";
        $secondPlanPrice90 = ".$atts['premiumPlanPrice'].";
        $thirdPlanPrice90 = ".$atts['premiumPlanPrice'].";
        */

        //return $content;
        //$retVal = tns_calculator2([],'');
        //$content.=$retVal;
        //$atts = shortcode_atts(
        //    array(
        //        'basicPlanPrice' => '2.99',
        //        'extraPlanPrice' => '4.99',
        //        'premiumPlanPrice' => '5.99',
        //        'link1Selector' => '#go-pricing-table-9340-column-0 > div.gw-go-col-inner > ul > li > div > div > a',
        //        'link2Selector' => '#go-pricing-table-9340-column-1 > div.gw-go-col-inner > ul > li > div > div > a',
        //        'link3Selector' => '#go-pricing-table-9340-column-2 > div.gw-go-col-inner > ul > li > div > div > a',
        //        'total1Selector' => 'h3.totalBasic',
        //        'total2Selector' => 'h3.totalStandard',
        //        'total3Selector' => 'h3.totalPremium'
        //    ), $atts );
        $setPrices1 = function() use ($atts) {

            $firstPlanPrice7 = null;
            $secondPlanPrice7 = null;
            $thirdPlanPrice7 = null;
            $firstPlanPrice14 = null;
            $secondPlanPrice14 = null;
            $thirdPlanPrice14 = null;
            $firstPlanPrice30 = null;
            $secondPlanPrice30 = null;
            $thirdPlanPrice30 = null;
            $firstPlanPrice60 = null;
            $secondPlanPrice60 = null;
            $thirdPlanPrice60 = null;
            $firstPlanPrice90 = null;
            $secondPlanPrice90 = null;
            $thirdPlanPrice90 = null;

            for ($i=0;$i<3;$i++) {
                if ($atts['prices64'][DAYS7][$i][LINKNO]==1) {
                    $firstPlanPrice7 = $atts['prices64'][DAYS7][$i][PRICEPERPERIOD];
                    //$firstPlanLink7 = '&b='.$atts['prices64'][DAYS7][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS7][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS7][$i][LINKNO]==2) {
                    $secondPlanPrice7 = $atts['prices64'][DAYS7][$i][PRICEPERPERIOD];
                    //$secondPlanLink7 = '&b='.$atts['prices64'][DAYS7][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS7][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS7][$i][LINKNO]==3) {
                    $thirdPlanPrice7 = $atts['prices64'][DAYS7][$i][PRICEPERPERIOD];
                    //$thirdPlanLink7 = '&b='.$atts['prices64'][DAYS7][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS7][$i][SUBLINK];
                }
                if ($atts['prices64'][DAYS14][$i][LINKNO]==1) {
                    $firstPlanPrice14 = $atts['prices64'][DAYS14][$i][PRICEPERPERIOD];
                    //$firstPlanLink14 = '&b='.$atts['prices64'][DAYS14][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS14][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS14][$i][LINKNO]==2) {
                    $secondPlanPrice14 = $atts['prices64'][DAYS14][$i][PRICEPERPERIOD];
                    //$secondPlanLink14 = '&b='.$atts['prices64'][DAYS14][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS14][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS14][$i][LINKNO]==3) {
                    $thirdPlanPrice14 = $atts['prices64'][DAYS14][$i][PRICEPERPERIOD];
                    //$thirdPlanLink14 = '&b='.$atts['prices64'][DAYS14][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS14][$i][SUBLINK];
                }
                if ($atts['prices64'][DAYS30][$i][LINKNO]==1) {
                    $firstPlanPrice30 = $atts['prices64'][DAYS30][$i][PRICEPERPERIOD];
                    //$firstPlanLink30 = '&b='.$atts['prices64'][DAYS30][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS30][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS30][$i][LINKNO]==2) {
                    $secondPlanPrice30 = $atts['prices64'][DAYS30][$i][PRICEPERPERIOD];
                    //$secondPlanLink30 = '&b='.$atts['prices64'][DAYS30][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS30][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS30][$i][LINKNO]==3) {
                    $thirdPlanPrice30 = $atts['prices64'][DAYS30][$i][PRICEPERPERIOD];
                    //$thirdPlanLink30 = '&b='.$atts['prices64'][DAYS30][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS30][$i][SUBLINK];
                }
                if ($atts['prices64'][DAYS60][$i][LINKNO]==1) {
                    $firstPlanPrice60 = $atts['prices64'][DAYS60][$i][PRICEPERPERIOD];
                    //$firstPlanLink60 = '&b='.$atts['prices64'][DAYS60][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS60][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS60][$i][LINKNO]==2) {
                    $secondPlanPrice60 = $atts['prices64'][DAYS60][$i][PRICEPERPERIOD];
                    //$secondPlanLink60 = '&b='.$atts['prices64'][DAYS60][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS60][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS60][$i][LINKNO]==3) {
                    $thirdPlanPrice60 = $atts['prices64'][DAYS60][$i][PRICEPERPERIOD];
                    //$thirdPlanLink60 = '&b='.$atts['prices64'][DAYS60][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS60][$i][SUBLINK];
                }
                if ($atts['prices64'][DAYS90][$i][LINKNO]==1) {
                    $firstPlanPrice90 = $atts['prices64'][DAYS90][$i][PRICEPERPERIOD];
                    //$firstPlanLink90 = '&b='.$atts['prices64'][DAYS90][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS90][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS90][$i][LINKNO]==2) {
                    $secondPlanPrice90 = $atts['prices64'][DAYS90][$i][PRICEPERPERIOD];
                    //$secondPlanLink90 = '&b='.$atts['prices64'][DAYS90][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS90][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS90][$i][LINKNO]==3) {
                    $thirdPlanPrice90 = $atts['prices64'][DAYS90][$i][PRICEPERPERIOD];
                    //$thirdPlanLink90 = '&b='.$atts['prices64'][DAYS90][$i][BUNDLE].'&linkid='
                    //    .$atts['prices64'][DAYS90][$i][SUBLINK];
                }
            }
            $retVal =
                "<script>
                firstPlanPrice7 = ".(($firstPlanPrice7=='')?(-1):($firstPlanPrice7)).";
                secondPlanPrice7 = ".(($secondPlanPrice7=='')?(-1):($secondPlanPrice7)).";
                thirdPlanPrice7 = ".(($thirdPlanPrice7=='')?(-1):($thirdPlanPrice7)).";
                firstPlanPrice14 = ".(($firstPlanPrice14=='')?(-1):($firstPlanPrice14)).";
                secondPlanPrice14 = ".(($secondPlanPrice14=='')?(-1):($secondPlanPrice14)).";
                thirdPlanPrice14 = ".(($thirdPlanPrice14=='')?(-1):($thirdPlanPrice14)).";
                firstPlanPrice30 = ".(($firstPlanPrice30=='')?(-1):($firstPlanPrice30)).";
                secondPlanPrice30 = ".(($secondPlanPrice30=='')?(-1):($secondPlanPrice30)).";
                thirdPlanPrice30 = ".(($thirdPlanPrice30=='')?(-1):($thirdPlanPrice30)).";
                firstPlanPrice60 = ".(($firstPlanPrice60=='')?(-1):($firstPlanPrice60)).";
                secondPlanPrice60 = ".(($secondPlanPrice60=='')?(-1):($secondPlanPrice60)).";
                thirdPlanPrice60 = ".(($thirdPlanPrice60=='')?(-1):($thirdPlanPrice60)).";
                firstPlanPrice90 = ".(($firstPlanPrice90=='')?(-1):($firstPlanPrice90)).";
                secondPlanPrice90 = ".(($secondPlanPrice90=='')?(-1):($secondPlanPrice90)).";
                thirdPlanPrice90 = ".(($thirdPlanPrice90=='')?(-1):($thirdPlanPrice90)).";
                </script>";
            $retVal=str_replace("<script>","",$retVal);
            $retVal=str_replace("</script>","",$retVal);
            echo $retVal;
        };
        $updateLinks1 = function() use ($atts) {
            $firstPlanLink7 = null;
            $secondPlanLink7 = null;
            $thirdPlanLink7 = null;
            $firstPlanLink14 = null;
            $secondPlanLink14 = null;
            $thirdPlanLink14 = null;
            $firstPlanLink30 = null;
            $secondPlanLink30 = null;
            $thirdPlanLink30 = null;
            $firstPlanLink60 = null;
            $secondPlanLink60 = null;
            $thirdPlanLink60 = null;
            $firstPlanLink90 = null;
            $secondPlanLink90 = null;
            $thirdPlanLink90 = null;

            for ($i=0;$i<3;$i++) {
                if ($atts['prices64'][DAYS7][$i][LINKNO]==1) {
                    //$firstPlanPrice7 = $atts['prices64'][DAYS7][$i][PRICEPERPERIOD];
                    $firstPlanLink7 = '&b='.$atts['prices64'][DAYS7][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS7][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS7][$i][LINKNO]==2) {
                    //$secondPlanPrice7 = $atts['prices64'][DAYS7][$i][PRICEPERPERIOD];
                    $secondPlanLink7 = '&b='.$atts['prices64'][DAYS7][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS7][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS7][$i][LINKNO]==3) {
                    //$thirdPlanPrice7 = $atts['prices64'][DAYS7][$i][PRICEPERPERIOD];
                    $thirdPlanLink7 = '&b='.$atts['prices64'][DAYS7][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS7][$i][SUBLINK];
                }
                if ($atts['prices64'][DAYS14][$i][LINKNO]==1) {
                    //$firstPlanPrice14 = $atts['prices64'][DAYS14][$i][PRICEPERPERIOD];
                    $firstPlanLink14 = '&b='.$atts['prices64'][DAYS14][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS14][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS14][$i][LINKNO]==2) {
                    //$secondPlanPrice14 = $atts['prices64'][DAYS14][$i][PRICEPERPERIOD];
                    $secondPlanLink14 = '&b='.$atts['prices64'][DAYS14][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS14][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS14][$i][LINKNO]==3) {
                    //$thirdPlanPrice14 = $atts['prices64'][DAYS14][$i][PRICEPERPERIOD];
                    $thirdPlanLink14 = '&b='.$atts['prices64'][DAYS14][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS14][$i][SUBLINK];
                }
                if ($atts['prices64'][DAYS30][$i][LINKNO]==1) {
                    //$firstPlanPrice30 = $atts['prices64'][DAYS30][$i][PRICEPERPERIOD];
                    $firstPlanLink30 = '&b='.$atts['prices64'][DAYS30][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS30][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS30][$i][LINKNO]==2) {
                    //$secondPlanPrice30 = $atts['prices64'][DAYS30][$i][PRICEPERPERIOD];
                    $secondPlanLink30 = '&b='.$atts['prices64'][DAYS30][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS30][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS30][$i][LINKNO]==3) {
                    //$thirdPlanPrice30 = $atts['prices64'][DAYS30][$i][PRICEPERPERIOD];
                    $thirdPlanLink30 = '&b='.$atts['prices64'][DAYS30][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS30][$i][SUBLINK];
                }
                if ($atts['prices64'][DAYS60][$i][LINKNO]==1) {
                    //$firstPlanPrice60 = $atts['prices64'][DAYS60][$i][PRICEPERPERIOD];
                    $firstPlanLink60 = '&b='.$atts['prices64'][DAYS60][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS60][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS60][$i][LINKNO]==2) {
                    //$secondPlanPrice60 = $atts['prices64'][DAYS60][$i][PRICEPERPERIOD];
                    $secondPlanLink60 = '&b='.$atts['prices64'][DAYS60][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS60][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS60][$i][LINKNO]==3) {
                    //$thirdPlanPrice60 = $atts['prices64'][DAYS60][$i][PRICEPERPERIOD];
                    $thirdPlanLink60 = '&b='.$atts['prices64'][DAYS60][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS60][$i][SUBLINK];
                }
                if ($atts['prices64'][DAYS90][$i][LINKNO]==1) {
                    //$firstPlanPrice90 = $atts['prices64'][DAYS90][$i][PRICEPERPERIOD];
                    $firstPlanLink90 = '&b='.$atts['prices64'][DAYS90][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS90][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS90][$i][LINKNO]==2) {
                    //$secondPlanPrice90 = $atts['prices64'][DAYS90][$i][PRICEPERPERIOD];
                    $secondPlanLink90 = '&b='.$atts['prices64'][DAYS90][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS90][$i][SUBLINK];
                } else if ($atts['prices64'][DAYS90][$i][LINKNO]==3) {
                    //$thirdPlanPrice90 = $atts['prices64'][DAYS90][$i][PRICEPERPERIOD];
                    $thirdPlanLink90 = '&b='.$atts['prices64'][DAYS90][$i][BUNDLE].'&linkid='
                        .$atts['prices64'][DAYS90][$i][SUBLINK];
                }
            }
            $retVal =
                "<script>
                urlRoot = 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1';
                window.firstPlanLink7 = urlRoot+'".$firstPlanLink7."';
                window.secondPlanLink7 = urlRoot+'".$secondPlanLink7."';
                window.thirdPlanLink7 = urlRoot+'".$thirdPlanLink7."';
                window.firstPlanLink14 = urlRoot+'".$firstPlanLink14."';
                window.secondPlanLink14 = urlRoot+'".$secondPlanLink14."';
                window.thirdPlanLink14 = urlRoot+'".$thirdPlanLink14."';
                window.firstPlanLink30 = urlRoot+'".$firstPlanLink30."';
                window.secondPlanLink30 = urlRoot+'".$secondPlanLink30."';
                window.thirdPlanLink30 = urlRoot+'".$thirdPlanLink30."';
                window.firstPlanLink60 = urlRoot+'".$firstPlanLink60."';
                window.secondPlanLink60 = urlRoot+'".$secondPlanLink60."';
                window.thirdPlanLink60 = urlRoot+'".$thirdPlanLink60."';
                window.firstPlanLink90 = urlRoot+'".$firstPlanLink90."';
                window.secondPlanLink90 = urlRoot+'".$secondPlanLink90."';
                window.thirdPlanLink90 = urlRoot+'".$thirdPlanLink90."';
                /*firstColumnLink = $('#go-pricing-table-1636-column-0 > div.gw-go-col-inner' +
                            ' > div.gw-go-footer-wrap > div.gw-go-footer > div' +
                            ' > div.gw-go-footer-row.gw-go-even > div > a');
                secondColumnLink = $('#go-pricing-table-1636-column-1 > div.gw-go-col-inner' +
                            ' > div.gw-go-footer-wrap > div.gw-go-footer > div' +
                            ' > div.gw-go-footer-row.gw-go-even > div > a');
                thirdColumnLink = $('#go-pricing-table-1636-column-2 > div.gw-go-col-inner' +
                            ' > div.gw-go-footer-wrap > div.gw-go-footer > div' +
                            ' > div.gw-go-footer-row.gw-go-even > div > a');*/   
                if (noOfDays >= 1 && noOfDays <= 7) {
                    window.origLink1 = window.firstPlanLink7;
                    window.origLink2 = window.secondPlanLink7;
                    window.origLink3 = window.thirdPlanLink7;
                } else if (noOfDays > 7 && noOfDays <= 14) {
                    window.origLink1 = window.firstPlanLink14;
                    window.origLink2 = window.secondPlanLink14;
                    window.origLink3 = window.thirdPlanLink14;
                } else if (noOfDays > 14 && noOfDays <= 30) {
                    window.origLink1 = window.firstPlanLink30;
                    window.origLink2 = window.secondPlanLink30;
                    window.origLink3 = window.thirdPlanLink30;
                } else if (noOfDays > 30 && noOfDays <= 60) {
                    window.origLink1 = window.firstPlanLink60;
                    window.origLink2 = window.secondPlanLink60;
                    window.origLink3 = window.thirdPlanLink60;                
                } else if (noOfDays > 60 && noOfDays <= 90) {
                    window.origLink1 = window.firstPlanLink90;
                    window.origLink2 = window.secondPlanLink90;
                    window.origLink3 = window.thirdPlanLink90;                  
                }
                if ($(\".calculator_block .result\").attr('data-allow-progress')=='0') {
                    theLink = $(\"".$atts['link1Selector']."\");
                    //if (typeof window.origLink1 == 'undefined' || window.origLink1 == null)
                    //    window.origLink1 = theLink.attr(\"href\");
                    //if (window.origLink1=='') {
                    //    window.origLink1 = 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=370&linkid=15527';
                    //}
                    hrefTheLink = '';//window.origLink1 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);
                    theLink.attr(\"href\", hrefTheLink);
                    theLink2 = $(\"".$atts['link2Selector']."\");
                    //if (typeof window.origLink2 == 'undefined' || window.origLink2 == null)
                    //    window.origLink2 = theLink2.attr(\"href\");
                    //if (window.origLink2=='') {
                    //    window.origLink2 = 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=371&linkid=15527';
                    //}
                    hrefTheLink2 = '';//window.origLink2 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);
                    theLink2.attr(\"href\", hrefTheLink2);
                    theLink3 = $(\"".$atts['link3Selector']."\");
                    //if (typeof window.origLink3 == 'undefined' || window.origLink3 == null)
                    //    window.origLink3 = theLink3.attr(\"href\");
                    //if (window.origLink3=='') {
                    //    window.origLink3 = 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=372&linkid=15527';
                    //}
                    hrefTheLink3 = '';//window.origLink3 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);
                    theLink3.attr(\"href\", hrefTheLink3);
                    orderNowBasic = $('#basicPlanOrderNow').attr('href',hrefTheLink);//.text('Order Now!');
                    orderNowStandard = $('#standardPlanOrderNow').attr('href',hrefTheLink2);//.text('Order Now!');
                    orderNowPremium = $('#premiumPlanOrderNow').attr('href',hrefTheLink3);//.text('Order Now!');
                    //textTotal = 'Total: $';
                    //basicPlanPrice = $(\"".$atts['total1Selector']."\").text(textTotal+cheapPlanPrice).css('visibility','hidden');
                    //standardPlanPrice = $(\"".$atts['total2Selector']."\").text(textTotal+standardPlanPrice).css('visibility','hidden');
                    //premiumPlanPrice = $(\"".$atts['total3Selector']."\").text(textTotal+superPlanPrice).css('visibility','hidden');
                    $(\".calculator_block .result\").text('Please choose the dates');
                } else {
                    theLink = $(\"".$atts['link1Selector']."\");
                    //if (typeof window.origLink1 == 'undefined' || window.origLink1 == null)
                    //    window.origLink1 = theLink.attr(\"href\");
                    //if (window.origLink1=='') {
                    //    window.origLink1 = 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=370&linkid=15527';
                    //}
                    hrefTheLink = window.origLink1 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);
                    theLink.attr(\"href\", hrefTheLink);
                    theLink2 = $(\"".$atts['link2Selector']."\");
                    //if (typeof window.origLink2 == 'undefined' || window.origLink2 == null)
                    //    window.origLink2 = theLink2.attr(\"href\");
                    //if (window.origLink2=='') {
                    //    window.origLink2 = 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=371&linkid=15527';
                    //}
                    hrefTheLink2 = window.origLink2 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);
                    theLink2.attr(\"href\", hrefTheLink2);
                    theLink3 = $(\"".$atts['link3Selector']."\");
                    //if (typeof window.origLink3 == 'undefined' || window.origLink3 == null)
                    //    window.origLink3 = theLink3.attr(\"href\");
                    //if (window.origLink3=='') {
                    //    window.origLink3 = 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=372&linkid=15527';
                    //}
                    hrefTheLink3 = window.origLink3 + \"&startDate=\" + startDate.getFullYear() + \"_\" + (startDate.getMonth() + 1) + \"_\" + startDate.getDate() + \"&noOfDays=\" + Math.round(noOfDays);
                    theLink3.attr(\"href\", hrefTheLink3);
                    orderNowBasic = $('#basicPlanOrderNow').attr('href',hrefTheLink);//.text('Order Now!');
                    orderNowStandard = $('#standardPlanOrderNow').attr('href',hrefTheLink2);//.text('Order Now!');
                    orderNowPremium = $('#premiumPlanOrderNow').attr('href',hrefTheLink3);//.text('Order Now!');
                    /*textTotal = 'Total: $';
                    try {
                        basicPlanPrice = $(\"".$atts['total1Selector']."\").text(textTotal+cheapPlanPrice).css('visibility','visible');
                        standardPlanPrice = $(\"".$atts['total2Selector']."\").text(textTotal+standardPlanPrice).css('visibility','visible');
                        premiumPlanPrice = $(\"".$atts['total3Selector']."\").text(textTotal+superPlanPrice).css('visibility','visible');
                    } catch (e) {
                        console.log(e);
                    }*/
                }
                </script>";
            $retVal=str_replace("<script>","",$retVal);
            $retVal=str_replace("</script>","",$retVal);
            echo $retVal;
        };
        tns_hiddenCalcBlock(false);
        $afterJQuery = null;
        $customUpdate=
            "<script>
        firstColumnSpan = $('#go-pricing-table-1636-column-0 > div.gw-go-col-inner > ul > li').last().find('div > span');
        secondColumnSpan = $('#go-pricing-table-1636-column-1 > div.gw-go-col-inner > ul > li').last().find('div > span');
        thirdColumnSpan = $('#go-pricing-table-1636-column-2 > div.gw-go-col-inner > ul > li').last().find('div > span');     
        if (noOfDays <= 7 && noOfDays >= 1) {
            firstColumnSpan.text('$'+firstPlanPrice7);
            secondColumnSpan.text('$'+secondPlanPrice7);
            thirdColumnSpan.text('$'+thirdPlanPrice7);
        } else if (noOfDays > 7 && noOfDays <= 14) {
            firstColumnSpan.text('$'+firstPlanPrice14);
            secondColumnSpan.text('$'+secondPlanPrice14);
            thirdColumnSpan.text('$'+thirdPlanPrice14);
        } else if (noOfDays > 14 && noOfDays <= 30) {
            firstColumnSpan.text('$'+firstPlanPrice30);
            secondColumnSpan.text('$'+secondPlanPrice30);
            thirdColumnSpan.text('$'+thirdPlanPrice30);
        } else if (noOfDays > 30 && noOfDays <= 60) {
            firstColumnSpan.text('$'+firstPlanPrice60);
            secondColumnSpan.text('$'+secondPlanPrice60);
            thirdColumnSpan.text('$'+thirdPlanPrice60);
        } else if (noOfDays > 60 && noOfDays <= 90) {
            firstColumnSpan.text('$'+firstPlanPrice90);
            secondColumnSpan.text('$'+secondPlanPrice90);
            thirdColumnSpan.text('$'+thirdPlanPrice90);
        }
        </script>";
        $customUpdate=str_replace("<script>","",$customUpdate);
        $customUpdate=str_replace("</script>","",$customUpdate);
        tns_calcJS($setPrices1,$updateLinks1,false,1,true,false,$afterJQuery,$customUpdate);
        return $content;
    }
    function tns_loc_shorttrip_calc($atts=[],$content=null) {
        if ($atts!=null && $atts['prices64']!=null && $atts['prices64']!='') {
            $atts['prices64'] = json_decode(base64_decode($atts['prices64']));
        }
        //var_dump($atts);
        define('BASICPLANROW',0);
        define('STANDARDPLANROW',1);
        define('PREMIUMPLANROW',2);
        define('SUBLINKID',0);
        define('BUNDLEID',1);
        define('COUNTER',2);
        define('PRICE',3);
        $atts = shortcode_atts(
            array(
                'basicPlanPrice' => "'".$atts['prices64'][BASICPLANROW][PRICE]."'",
                'extraPlanPrice' => "'".$atts['prices64'][STANDARDPLANROW][PRICE]."'",
                'premiumPlanPrice' => "'".$atts['prices64'][PREMIUMPLANROW][PRICE]."'",
                'link1Selector' => '#go-pricing-table-9340-column-0 > div.gw-go-col-inner > ul > li > div > div > a',
                'link2Selector' => '#go-pricing-table-9340-column-1 > div.gw-go-col-inner > ul > li > div > div > a',
                'link3Selector' => '#go-pricing-table-9340-column-2 > div.gw-go-col-inner > ul > li > div > div > a',
                'total1Selector' => 'h3.totalBasic',
                'total2Selector' => 'h3.totalStandard',
                'total3Selector' => 'h3.totalPremium',
                'link1href' => 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b='.
                    $atts['prices64'][BASICPLANROW][BUNDLEID].'&linkid='.$atts['prices64'][BASICPLANROW][SUBLINKID],
                'link2href' => 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b='.
                    $atts['prices64'][STANDARDPLANROW][BUNDLEID].'&linkid='.$atts['prices64'][STANDARDPLANROW][SUBLINKID],
                'link3href' => 'https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b='.
                    $atts['prices64'][PREMIUMPLANROW][BUNDLEID].'&linkid='.$atts['prices64'][PREMIUMPLANROW][SUBLINKID]
            ), $atts );
        //echo "<br><br><br>";
        //var_dump($atts);
        $content.=tns_calculator2($atts,$content);
        return $content;
    }
    add_shortcode('tns_calc', 'tns_calculator');//jwrp
    add_shortcode('tns_calc2', 'tns_calculator');//chuck and hanah
    add_shortcode('tns_calc_shorttrip', 'tns_calculator2');//short term main site
    add_shortcode('tns_loc_internet_calc','tns_loc_internet_calc');//locations plug-in calc for internet-only
    add_shortcode('tns_loc_shorttrip_calc','tns_loc_shorttrip_calc');//locations plug-in calc for short-term
}

add_action('init', 'tns_calc_shortcode_init');
?>