<?php

class Schools20gb
{
    function main()
    {
        if ( $_GET['b'] == "155" ||  $_GET['b'] == "154" )
        	return "";
        global $tns_db_connection2;

        if (!(isset($tns_db_connection2) && $tns_db_connection2 != null && $tns_db_connection2->ping())) {
            $tns_db_connection2 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
            mysqli_select_db($tns_db_connection2, DB_NAME);
        }

        $retVal = '';
        $mst_db_conn = $tns_db_connection2;

        $displayBanner = false;
        $schoolName = null;
        $schoolLink = null;
        $schoolImg = null;

        //$retVal .= '<style>' . file_get_contents(__DIR__ . '/../assets/style.css') . '</style>';
        //$retVal .= '<script>' . file_get_contents(__DIR__ . '/../assets/schools3.js') . '</script>';
        $retVal .=
            '        <div class="section mcb-section   "
             style="padding-top:60px; padding-bottom:0px; background-color:; background-image:
         url(https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/05/Plans-Pattern-2-1.jpg);
         background-repeat:repeat; background-position:center top; background-attachment:;
         background-size:; -webkit-background-size:">
            <div class="section_wrapper mcb-section-inner">
		';

        $retVal .=
            '                <div class="wrap mcb-wrap one  valign-top clearfix" style="">
                    <div class="mcb-wrap-inner">
                        <div class="column mcb-column one column_portfolio ">
                            <div class="column_filters">
                                <div class="portfolio_wrapper isotope_wrapper ">
                                    <ul class="portfolio_group lm_wrapper isotope col-12 masonry"
                                        style="position: relative; height: auto;">';

        $priorities = ['HIGHEST','HIGHER','NORMAL','LOW'];
        foreach ($priorities as $priority) {
        	foreach (mysqli_query($mst_db_conn, "SELECT * FROM `tns_sublinks_20gb` WHERE `priority`='".$priority."' ORDER BY `name`") as $mst_result) {

              if ($mst_result['hidden'] == '0') {

                    $displayBanner = true;
                    $schoolName = preg_replace('/[[:^print:]]/', '', utf8_encode($mst_result['name']));
                    $prevMD5 = md5($schoolName);
                    $isEnd = false;
                    do {
                        $schoolName = str_replace("\'", "'", $schoolName);
                        $schoolName = str_replace('\"', '"', $schoolName);
                        if (md5($schoolName) == $prevMD5)
                            $isEnd = true;
                        else
                            $prevMD5 = md5($schoolName);
                    } while (!$isEnd);
                    $schoolImg = $mst_result['logo'];
                    if (strlen($schoolImg) == 0) {
                        $schoolImg = "/wp-content/plugins/tns_plans/assets/blank2.png";
                    }
                    $schoolLink = "https://www.talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1";
					if (isset($_GET['b']) && !empty($_GET['b']))
						$schoolLink .= "&b=" . $_GET['b'];
					$schoolLink .= "&linkid=" . $mst_result['sublink_id'];
				  
                    $retVal .= '
                                                <li class="parent portfolio-item isotope-item category-schools  has-thumbnail"
                                                    style="display: inline-block;">

<div class="HiddenContent hidden" style="display: none;">
<span class="hidden_linkid hidden" style="display: none;">' . $mst_result['sublink_id']. '</span></div>

                                                    <div class="portfolio-item-fw-bg" style="">
                                                        <div class="portfolio-item-fill"></div>
                                                        <div class="list_style_header">
                                                            <h3 class="entry-title tns_school20gb_name" itemprop="headline">
                                                                <a class="link tns_school_link"
                                                                   href="' . $schoolLink . '">' . $schoolName . '</a>
                                                            </h3>

                                                            <div class="links_wrapper">
                                                                <a href="#" class="button button_js portfolio_prev_js">
                                                            <span class="button_icon">
                                                                <i class="icon-up-open"></i>
                                                            </span>
                                                                </a>
                                                                <a href="#" class="button button_js portfolio_next_js">
                                                            <span class="button_icon">
                                                                <i class="icon-down-open"></i>
                                                            </span>
                                                                </a>
                                                                <a href="' . $schoolLink . '"
                                                                   class="button button_left button_theme button_js kill_the_icon tns_school_link">
                                                            <span class="button_icon">
                                                                <i class="icon-link"></i>
                                                            </span>
                                                                    <span class="button_label">Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="image_frame scale-with-grid">
                                                            <div class="image_wrapper"><a
                                                                    href="' . $schoolLink . '" class="tns_school_link">
                                                                    <div class="mask"></div>
                                                                    <img width="357" height="183"
                                                                         src="' . $schoolImg . '"
                                                                         class="scale-with-grid wp-post-image"
                                                                         alt="Schools for Israel"
                                                                         srcset="' . $schoolImg . ' 357w, https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/uploads/2016/06/not-affiliated-300x154.jpg 300w, https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/uploads/2016/06/not-affiliated-260x133.jpg 260w, https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/uploads/2016/06/not-affiliated-50x26.jpg 50w, https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/uploads/2016/06/not-affiliated-146x75.jpg 146w"
                                                                         sizes="(max-width: 357px) 100vw, 357px"></a>

                                                                <div class="image_links double"><a
                                                                        href="' . $schoolImg . '"
                                                                        class="zoom" rel="prettyphoto"><i
                                                                            class="icon-search"></i></a><a
                                                                        href="' . $schoolLink . '"
                                                                        class="link tns_school_link"><i class="icon-link"></i></a></div>
                                                            </div>
                                                        </div>
                                                        <div class="desc">
                                                            <div class="title_wrapper">
                                                                <h5 class="entry-title" itemprop="headline">
                                                                    <a class="link tns_school_link"
                                                                       href="' . $schoolLink . '">' . $schoolName . '</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>';
	                }
	            //}
	        }
        }
        $retVal .= '
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
 
        if ($displayBanner) {
        	$retVal = "<div class=\"wrap mcb-wrap one  valign-top clearfix\" style=\"display: none\"><div class=\"mcb-wrap-inner\"><div class=\"column mcb-column one column_image \">".
					  "<div class=\"image_frame image_item no_link scale-with-grid no_border\"><div class=\"image_wrapper\">".
					  "<img class=\"scale-with-grid\" src=\"https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/uploads/2016/05/20GB_Banner.jpg\" alt=\"20GB_Banner\" width=\"1200\" height=\"181\" ></div></div>".
        			  "</div></div></div>".$retVal;
        }
        return $retVal;
    }
}

?>