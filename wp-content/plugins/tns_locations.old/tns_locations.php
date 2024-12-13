<?php
/**
 * @wordpress-plugin
 * Plugin Name:       TNS locations
 */
require(__DIR__ . '/phpQuery-master/phpQuery/phpQuery.php');
function tns_dbor_query($queryStr) {
    $context = stream_context_create([
        'ssl' => [
            // set some SSL/TLS specific options
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    $client = new SoapClient('https://dborproxy.talknsave.us/DBOR_Proxy.asmx?WSDL', [
        'stream_context' => $context
    ]);
    $param = array('query' => $queryStr, 'secret' => 'secret');
    return json_decode($client->executeQueryColNames($param)->executeQueryColNamesResult);
}

function tns_locations_init()
{
    function tns_sim4life_shortcode_silent($atts = [], $content = null)
    {
        $locationId = ($_GET['lId'] == null) ? 43 : $_GET['lId'];
        $linkSqlQuery = "SELECT [GenLinkUrl],[Price] FROM [tblLocationsLinks] WHERE [LocInfoId]=".$locationId." AND [LocLinkTypeCode]='SIM4LIFE' order by [Price] asc";
        $titleSqlQuery = "SELECT [BranchRemarks] FROM [tblLocationsInfo] WHERE [Counter]=".$locationId;
        $sim4lifeData = tns_dbor_query($linkSqlQuery);
        $locationName = tns_dbor_query($titleSqlQuery)[0]->BranchRemarks;
        //var_dump($sim4lifeData);
        $price1 = $price2 = 0;
        $sim4lifeUrl1 = $sim4lifeUrl2 = '';
        for ($i=0;$i<count($sim4lifeData);$i++) {
            if ($i==0) {
                $price1 = $sim4lifeData[$i]->Price;
                $sim4lifeUrl1 = $sim4lifeData[$i]->GenLinkUrl;
            } else {
                $price2 = $sim4lifeData[$i]->Price;
                $sim4lifeUrl2 = $sim4lifeData[$i]->GenLinkUrl;
            }
        }
        $content.="<script>
            try {
                function sim4lifeAfterJquery($) {
                    function round2Fixed(value) {
                      value = +value;
                    
                      if (isNaN(value))
                        return NaN;
                    
                      // Shift
                      value = value.toString().split('e');
                      value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + 2) : 2)));
                    
                      // Shift back
                      value = value.toString().split('e');
                      return (+(value[0] + 'e' + (value[1] ? (+value[1] - 2) : -2))).toFixed(2);
                    }                    
                    var price1 = jQuery(\"#go-pricing-table-1673-column-0 > div.gw-go-col-inner > ul > li:nth-child(8) > div > span\");
                    var newprice1text = price1.html().replace('4.00',round2Fixed('".$price1."'));
                    price1.html(newprice1text);
                    var price2 = jQuery(\"#go-pricing-table-1673-column-1 > div.gw-go-col-inner > ul > li:nth-child(8) > div > span\");
                    var newprice2text = price2.html().replace('6.00',round2Fixed('".$price2."'));
                    price2.html(newprice2text);                    
                    $('#go-pricing-table-1673-column-0 > div.gw-go-col-inner > div.gw-go-footer-wrap > '+
                    'div.gw-go-footer > div > div.gw-go-footer-row.gw-go-even > div > a')
                    .attr('href','".$sim4lifeUrl1."');
                    $('#go-pricing-table-1673-column-1 > div > div.gw-go-footer-wrap > div.gw-go-footer > '+
                    'div > div.gw-go-footer-row.gw-go-even > div > a')
                    .attr('href','".$sim4lifeUrl2."');
                    $('#Subheader > div > div > h1').text('".$locationName."'+' SIM4Life Plan');
                }
                function sim4lifeProbeJquery() {
                    if (typeof jQuery == 'undefined') {
                        setTimeout(sim4lifeProbeJquery,500);    
                    } else {
                        sim4lifeAfterJquery(jQuery);
                    }
                }
                sim4lifeProbeJquery();
            } catch (e) {
                console.log(e);
            }
        </script>";
        return $content;
    }
    add_shortcode('sim4lifesilent', 'tns_sim4life_shortcode_silent');
    function tns_internet_shortcode($atts = [], $content = null)
    {
        $locationId = $_GET['lId'];
        if (!is_numeric($locationId)) {
            $locationId = 43;
        }
        $inetPlanDetails = tns_dbor_query('select [BranchRemarks],[LocLinkTypeCode],
          [SublinkId],[BundleId],[Price] from tblLocationsInfo inner join tblLocationsLinks on 
          tblLocationsInfo.Counter=tblLocationsLinks.LocInfoId where tblLocationsInfo.Counter='.$locationId.' 
          and [IsActive]=1 and (LocLinkTypeCode=\'INTERNETONLY7\' OR LocLinkTypeCode=\'INTERNETONLY14\' OR 
          LocLinkTypeCode=\'INTERNETONLY30\' OR LocLinkTypeCode=\'INTERNETONLY60\' OR 
          LocLinkTypeCode=\'INTERNETONLY90\') order by [LocLinkTypeCode],[Price] asc');
        //var_dump($inetPlanDetails);
        $counter7 = $counter14 = $counter30 = $counter60 = $counter90 = 1;
        foreach ($inetPlanDetails as $aRow) {
            if ($aRow->LocLinkTypeCode=='INTERNETONLY7') {
                $aRow->LinkNoOnPage=$counter7;
                $counter7++;
            } else if ($aRow->LocLinkTypeCode=='INTERNETONLY14') {
                $aRow->LinkNoOnPage=$counter14;
                $counter14++;
            } else if ($aRow->LocLinkTypeCode=='INTERNETONLY30') {
                $aRow->LinkNoOnPage=$counter30;
                $counter30++;
            } else if ($aRow->LocLinkTypeCode=='INTERNETONLY60') {
                $aRow->LinkNoOnPage=$counter60;
                $counter60++;
            } else if ($aRow->LocLinkTypeCode=='INTERNETONLY90') {
                $aRow->LinkNoOnPage=$counter90;
                $counter90++;
            }
        }
        $internet7 = array();
        $internet14 = array();
        $internet30 = array();
        $internet60 = array();
        $internet90 = array();
        foreach ($inetPlanDetails as $aRow) {
            if ($aRow->LocLinkTypeCode=='INTERNETONLY7') {
                $internet7[] = [$aRow->SublinkId, $aRow->BundleId,$aRow->LinkNoOnPage,$aRow->Price];
            } else if ($aRow->LocLinkTypeCode=='INTERNETONLY14') {
                $internet14[] = [$aRow->SublinkId, $aRow->BundleId,$aRow->LinkNoOnPage,$aRow->Price];
            } else if ($aRow->LocLinkTypeCode=='INTERNETONLY30') {
                $internet30[] = [$aRow->SublinkId, $aRow->BundleId,$aRow->LinkNoOnPage,$aRow->Price];
            } else if ($aRow->LocLinkTypeCode=='INTERNETONLY60') {
                $internet60[] = [$aRow->SublinkId, $aRow->BundleId,$aRow->LinkNoOnPage,$aRow->Price];
            } else if ($aRow->LocLinkTypeCode=='INTERNETONLY90') {
                $internet90[] = [$aRow->SublinkId, $aRow->BundleId,$aRow->LinkNoOnPage,$aRow->Price];
            }
        }
        ?>
        <script>
            var matches = document.querySelectorAll('#Subheader > div > div > h1');
            for (i=0; i<matches.length; i++) {
                if (matches[i].innerHTML=='__Internet_Only__') {
                    matches[i].innerHTML = '<?php echo $inetPlanDetails[0]->BranchRemarks.' - Internet Only'; ?>';
                    document.title = document.title.replace('__Internet_Only__','<?php echo
                        $inetPlanDetails[0]->BranchRemarks.' - Internet Only'; ?>');
                }
            }
        </script>
        <?php
        $internetPlans = [$internet7,$internet14,$internet30,$internet60,$internet90];
        $content.=do_shortcode("[tns_loc_internet_calc prices64='".base64_encode(json_encode($internetPlans))."']");
        return $content;
    }
    add_shortcode('internetonlyloc', 'tns_internet_shortcode');
    function tns_shorttrip_shortcode($atts = [], $content = null) {
        $locationId = $_GET['lId'];
        if (!is_numeric($locationId)) {
            $locationId = 43;
        }
        $inetPlanDetails = tns_dbor_query('select top 3 [BranchRemarks],[LocLinkTypeCode],
          [SublinkId],[BundleId],[Price] from tblLocationsInfo 
          inner join tblLocationsLinks on tblLocationsLinks.LocInfoId=tblLocationsInfo.Counter 
          where tblLocationsInfo.Counter='.$locationId.' and [isActive]=1 and ([BundleId]=370 or [BundleId]=371 or [BundleId]=372) and LocLinkTypeCode=\'SHORTTRIPPD\' order by [Price] asc');
        $shorttrippd = array();
        $counter = 1;
        foreach ($inetPlanDetails as $aRow) {
            $shorttrippd[] = [$aRow->SublinkId, $aRow->BundleId,$counter++,$aRow->Price];
        }
        //var_dump($shorttrippd);
        ?>
        <script>
            var matches = document.querySelectorAll('#Subheader > div > div > h1');
            for (i=0; i<matches.length; i++) {
                if (matches[i].innerHTML=='__Short_Trip_-_New_Plans__') {
                    matches[i].innerHTML = '<?php echo $inetPlanDetails[0]->BranchRemarks.' - Short Trip'; ?>';
                }
            }
            document.title = document.title.replace('__Short_Trip_-_New_Plans__','<?php echo
                $inetPlanDetails[0]->BranchRemarks.' - Short Trip'; ?>');
        </script>
        <?php
        $content.=do_shortcode("[tns_loc_shorttrip_calc prices64='".base64_encode(json_encode($shorttrippd))."']");
        return $content;
    }
    add_shortcode('tns_shorttrip_location', 'tns_shorttrip_shortcode');
    function tns_locations_shortcode($atts = [], $content = null)
    {
        //var_dump($atts);
        //$content.=date('c').'::'.__FUNCTION__.'::'.__LINE__."\t\n";
        $atts = shortcode_atts(
            array('locationid' => 43,
                'internetonly' => false),
            $atts);
        //$content.=date('c').'::'.__FUNCTION__.'::'.__LINE__."\t\n";
        $atts['locationId']=$atts['locationid'];
        $atts['internetOnly']=$atts['internetonly'];
        //$content.=date('c').'::'.__FUNCTION__.'::'.__LINE__."\t\n";
        //var_dump($atts);
        if ($_GET['subpage']==null) {
            $url = 'https://wordpress-944064-3284364.cloudwaysapps.com/location/?code='.base64_encode('secret');
            $ch = curl_init();
            $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            //curl_setopt($ch, CURLOPT_HEADER, true);
            //curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
            $data = curl_exec($ch);
            //var_dump(curl_getinfo($ch));
            curl_close($ch);
            //var_dump($url);
            //$data = file_get_contents($url);
            //$content.=date('c').'::'.__FUNCTION__.'::'.__LINE__."\t\n";
            //var_dump(htmlentities($data));
            $dom = phpQuery::newDocument($data);

            if ($atts['internetOnly']==false || $atts['internetOnly']=='false') {
//                $internetOnlySelector =
//                    "#Content > div > div > div > div.section.the_content.has_content > ".
//                    "div > div > div > div:nth-child(3) > div > div:nth-child(2)";
//                echo
//                "<script>
//                try {
//                    document.querySelector('" . $internetOnlySelector . "').style.display.value = 'none';
//                } catch(e) {
//                    console.log(e);
//                }
//                function unavailable() {
//                    try {
//                        jQuery('<div style=' +
//                         '\"margin:10px;border-style:solid;position:fixed;top:50%;left:50%;background-color:' +
//                          'ghostwhite;border:1px;border-color:blue;\">' +
//                            '<h1>Unavailable</h1></div>').appendTo('body').fadeIn(0).fadeOut(2000);
//                    } catch(e) {
//                        console.log(e);
//                    }
//                }
//                </script>";
//                //$dom['#PlansHome'][$internetOnlySelector]->remove();
//                $dom['#PlansHome']["[href='__internet-only__']"]->attr('href', 'javascript:unavailable();');
                $dom['#PlansHome']["[href='__internet-only__']"]->parent()->parent()->remove();
                //$content.=date('c').'::'.__FUNCTION__.'::'.__LINE__."\t\n";
            } else {
                $dom['#PlansHome']["[href='__internet-only__']"]->attr('href', '/location/internet_only/?lId='.$atts['locationId']);
                //$content.=date('c').'::'.__FUNCTION__.'::'.__LINE__."\t\n";
            }
            $dom['#PlansHome']["[href='__short-trip-plans__']"]->attr('href',
                        '/location/short-trip-plans/?lId='.$atts['locationId']);
            $dom['#PlansHome']["[href='__programs__']"]->attr('href',
                        '/location/students/?lId='.$atts['locationId']);
            $dom['#PlansHome']["[href='__sim4life__']"]->attr('href',
                        '/location/sim4life/?lId='.$atts['locationId']);

            $content .= $dom['#PlansHome']->html();
            //$content.=date('c').'::'.__FUNCTION__.'::'.__LINE__."\t\n";
        }
        return $content;
    }
    add_shortcode('tns_locations', 'tns_locations_shortcode');

    function tns_students_location_shortcode($atts=[],$content=null)
    {
        $atts = shortcode_atts(
            array(
                'gopricingid' => '6840'
            ), $atts, 'tns_students_location' );
        $locationId = $_GET['lId'];
        if (!is_numeric($locationId)) {
            $locationId = 43;
        }
        $studentPlanDetails = tns_dbor_query('select [BranchRemarks],[Price],[GenLinkUrl] 
          from tblLocationsInfo inner join tblLocationsLinks on tblLocationsLinks.LocInfoId=tblLocationsInfo.Counter 
          where tblLocationsInfo.Counter='.$locationId.' and [isActive]=1 and LocLinkTypeCode=\'STUDENTSOVER3MONTHS\' 
          order by [Price] asc');
        //var_dump($studentPlanDetails);
        $linkUrl1 = $linkUrl2 = $linkUrl3 = $linkUrl4 = '';
        $price1 = $price2 = $price3 = $price4 = 0;
        foreach($studentPlanDetails as $aRow) {
            if ($linkUrl1=='') {
                $linkUrl1 = $aRow->GenLinkUrl;
                $price1 = $aRow->Price;
            } else if ($linkUrl2=='') {
                $linkUrl2 = $aRow->GenLinkUrl;
                $price2 = $aRow->Price;
            } else if ($linkUrl3=='') {
                $linkUrl3 = $aRow->GenLinkUrl;
                $price3 = $aRow->Price;
            } else if ($linkUrl4=='') {
                $linkUrl4 = $aRow->GenLinkUrl;
                $price4 = $aRow->Price;
            }
        }
        $price1 = number_format((float)$price1, 2, '.', '');
        $price2 = number_format((float)$price2, 2, '.', '');
        $price3 = number_format((float)$price3, 2, '.', '');
        $price4 = number_format((float)$price4, 2, '.', '');
        $content.=
            "<script>
            try {
                function $2(selector, context) {
                    return (context || document).querySelectorAll(selector);
                }
                try {
                    var link6840_1 = $2('#go-pricing-table-" . $atts['gopricingid'] . "-column-0 a');
                    link6840_1[link6840_1.length-1].attributes.href.value = '" . $linkUrl1 . "';
                } catch (e) {
                    console.log(e);
                }
                try {
                    var link6840_2 = $2('#go-pricing-table-" . $atts['gopricingid'] . "-column-1 a');
                    link6840_2[link6840_2.length-1].attributes.href.value = '" . $linkUrl2 . "';
                } catch (e) {
                    console.log(e);
                }
                try {
                    var link6840_3 = $2('#go-pricing-table-" . $atts['gopricingid'] . "-column-2 a');
                    link6840_3[link6840_3.length-1].attributes.href.value = '" . $linkUrl3 . "';
                } catch (e) {
                    console.log(e);
                }
                try {
                    var link6840_4 = $2('#go-pricing-table-" . $atts['gopricingid'] . "-column-3 a');
                    link6840_4[link6840_4.length-1].attributes.href.value = '" . $linkUrl4 . "';
                } catch (e) {
                    console.log(e);
                }
                try {
                    var listElems1 = $2('#go-pricing-table-" . $atts['gopricingid'] . "-column-0 > div.gw-go-col-inner > ul > li');
                    var spans1 = listElems1[listElems1.length-2].querySelectorAll('span');
                    spans1[spans1.length-2].innerHTML = '$" . $price1 . "';
                } catch (e) {
                    console.log(e);
                }
                try {
                    var listElems2 = $2('#go-pricing-table-" . $atts['gopricingid'] . "-column-1 > div.gw-go-col-inner > ul > li');
                    var spans2 = listElems2[listElems2.length-2].querySelectorAll('span');
                    spans2[spans2.length-2].innerHTML = '$" . $price2 . "';
                } catch (e) {
                    console.log(e);
                }
                try {
                    var listElems3 = $2('#go-pricing-table-" . $atts['gopricingid'] . "-column-2 > div.gw-go-col-inner > ul > li');
                    var spans3 = listElems3[listElems3.length-2].querySelectorAll('span');
                    spans3[spans3.length-2].innerHTML = '$" . $price3 . "';
                } catch (e) {
                    console.log(e);
                }
                try {
                    var listElems4 = $2('#go-pricing-table-" . $atts['gopricingid'] . "-column-3 > div.gw-go-col-inner > ul > li');
                    var spans4 = listElems4[listElems4.length-2].querySelectorAll('span');
                    spans4[spans4.length-2].innerHTML = '$" . $price4 . "';
                } catch (e) {
                    console.log(e);
                }
                document.title = document.title.replace('Kesher Stam Judaica',
                '".$studentPlanDetails[0]->BranchRemarks." - Student Programs'); 
                $2('#Subheader > div > div > h1')[0].innerHTML = '".$studentPlanDetails[0]->BranchRemarks." - Student Programs';
            } catch(e) {
                console.log(e);
            }
            </script>";
        return $content;
    }
    add_shortcode('tns_students_location','tns_students_location_shortcode');

    /**
     * Filters wp_title to print a neat <title> tag based on what is being viewed.
     *
     * @param string $title Default title text for current view.
     * @param string $sep Optional separator.
     * @return string The filtered title.
     */
    function __wpdocs_theme_name_wp_title($title, $sep)
    {
        if (is_feed()) {
            return $title;
        }

        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo('name', 'display');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if (($paged >= 2 || $page >= 2) && !is_404()) {
            $title .= " $sep " . sprintf(__('Page %s', '_s'), max($paged, $page));
        }
        return $title;
    }

    //add_filter('wp_title', 'wpdocs_theme_name_wp_title', 10, 2);
}

add_action('init', 'tns_locations_init');
?>