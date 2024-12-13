<?php

/**
 * @wordpress-plugin
 * Plugin Name:       TNS snippets
 */

function tns_snippets_init()
{

    function tns_url_by_id($atts = [], $content = null)
    {

        $url = "";

        if($_GET['id']=='jwr') {

            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/jwrp/trips/?utm_campaign=JWRP&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite";
        } else if ($_GET['id']=='ath') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/israel-outdoors/?utm_campaign=IsraelOutdoors&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite";
        } else if ($_GET['id']=='ncs') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/israel-free-spirit/?utm_campaign=IsraelFreeSpirit&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite";
        } else if ($_GET['id']=='soi') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/taglit-shorashim/?utm_campaign=Shorashim&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite";
        } else if ($_GET['id']=='urj') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/taglit-shorashim/?utm_campaign=URJ&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite";
        
        } else if ($_GET['id']=='wxt') {
            $url = "http://talknsave.net/world-express-travel/?utm_campaign=WXT&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite";
        
		} else if ($_GET['id']=='aai') {
            $url = "https://talknsave.net/avi-abrams-israel-tours/?utm_campaign=AVIAbrams&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite"; 
		
		} else if ($_GET['id']=='dpl') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/discipleship-travel/?utm_campaign=DPL&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite";
			
		} else if ($_GET['id']=='mrm') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/meor-israel-upgrade/?utm_campaign=Meor&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite"; 
			
		} else if ($_GET['id']=='cie') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/cie/?utm_campaign=CIE&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite"; 
		
		} else if ($_GET['id']=='ezr') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/ezra/?utm_campaign=Ezra&&utm_content=RoamingSales";
			
		} else if ($_GET['id']=='azg') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/amazing-israel/?utm_campaign=AmazingIsrael&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite";  

		} else if ($_GET['id']=='ou') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/israel-free-spirit/?utm_campaign=IsraelFreeSpirit&utm_content=RoamingSales&utm_source=Email&utm_medium=InSite"; 

		} else if ($_GET['id']=='st') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/short-trip-plans/"; 

		} else if ($_GET['id']=='general') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/plans/";
		
		} else if ($_GET['id']=='pre') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/prepaid/";
			
		} else if ($_GET['id']=='oleh') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/olim/";
			
		} else if ($_GET['id']=='mim') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/internet-only/";
			
		} else if ($_GET['id']=='students') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/school-programs/";
		
		} else if ($_GET['id']=='s4l') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/sim4life/";
		
		} else if ($_GET['id']=='st') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/short-trip-plans/";
		
			
        } else {

            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/group-plans/";

        }

        $content.=$url;

        return $content;

    }

    add_shortcode('RoamingurlById', 'tns_url_by_id');
	
	function tns_unlock_url_by_id($atts = [], $content = null)
    {

        $url = "";

        if($_GET['id']=='ccn') {

            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/cohen-camps/?utm_campaign=CohenCamps&utm_content=UnlockPhone";
        } else if ($_GET['id']=='ncs') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/israel-free-spirit/?utm_campaign=IsraelFreeSpirit&utm_content=UnlockPhone";
        
		  } else if ($_GET['id']=='ou') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/israel-free-spirit/?utm_campaign=IsraelFreeSpirit&utm_content=UnlockPhone";

         } else if ($_GET['id']=='ezr') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/ezra/?utm_campaign=Ezra&utm_content=UnlockPhone";
			
		} else if ($_GET['id']=='mrm') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/meor-israel-upgrade/?utm_campaign=Meor&utm_content=UnlockPhone"; 
			
		} else if ($_GET['id']=='cie') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/cie/?utm_campaign=CIE&utm_content=UnlockPhone"; 
		
		} else if ($_GET['id']=='azg') {
            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/birthright-groups/amazing-israel/?utm_campaign=AmazingIsrael&utm_content=UnlockPhone";  


		
		} else {

            $url = "https://wordpress-944064-3284364.cloudwaysapps.com/plans/";

        }

        $content.=$url;

        return $content;

    }

    add_shortcode('UnlockurlById', 'tns_unlock_url_by_id');
	
	function tns_text_by_id($atts = [], $content = null)
    {

        $text = "";

        if ($_GET['id']=='asr') {
			$text = "Ashreinu";
			
		} else if ($_GET['id']=='aty') {
			$text = "Ateret Yerushalayim (AJ)";
			
		} else if ($_GET['id']=='brm') {
			$text = "Baer Miriam";
			
		} else if ($_GET['id']=='zda') {
			$text = "Darchei Bina";
			
		} else if ($_GET['id']=='drc') {
			$text = "Derech Ohr Somayach";
			
		} else if ($_GET['id']=='igf') {
			$text = "Israel Government Fellows";
			
		} else if ($_GET['id']=='kby') {
			$text = "Kerem B'Yavneh (KBY)";
			
		} else if ($_GET['id']=='mma') {
			$text = "Machon Maayan";
			
		} else if ($_GET['id']=='ymy') {
			$text = "Machon Yaakov";
			
		} else if ($_GET['id']=='mll') {
			$text = "Michlalah";
			
		} else if ($_GET['id']=='mmy') {
			$text = "Michlelet Mevaseret Yerushalayim (MMY)";
			
		} else if ($_GET['id']=='amt') {
			$text = "Midreshet AMIT";
			
		} else if ($_GET['id']=='mdm') {
			$text = "Midreshet Moriah";
			
		} else if ($_GET['id']=='mth') {
			$text = "Midreshet Tehillah";
			
		} else if ($_GET['id']=='mtv') {
			$text = "Midreshet Torah V'Avodah";
			
		} else if ($_GET['id']=='mtc') {
			$text = "Midreshet Torat Chessed";
			
		} else if ($_GET['id']=='yna') {
			$text = "Netiv Aryeh";
			
		} else if ($_GET['id']=='nsm') {
			$text = "Nishmat";
			
		} else if ($_GET['id']=='odv') {
			$text = "Ohr David";
			
		} else if ($_GET['id']=='ory') {
			$text = "Ohr Yerushalayim";
			
		} else if ($_GET['id']=='res') {
			$text = "Reishit";
			
		} else if ($_GET['id']=='sha') {
			$text = "Shaalvim";
			
		} else if ($_GET['id']=='sfw') {
			$text = "Sha'alvim for Women";
			
		} else if ($_GET['id']=='smz') {
			$text = "Shaarei Mevaseret Zion";
			
		} else if ($_GET['id']=='bnt') {
		
			$text = "Bnot Torah Institute (Sharfman's)";
			
		} else if ($_GET['id']=='cyj') {
			$text = "The Conservative Yeshiva of Jerusalem";
			
		} else if ($_GET['id']=='tfz') {
			$text = "Tiferes Zion";
			
		} else if ($_GET['id']=='tft') {
			$text = "Tiferet";
			
		} else if ($_GET['id']=='tfj') {
			$text = "Tiferet Yerushalayim (TJ)";
			
		} else if ($_GET['id']=='tmd') {
			$text = "Tomer Devorah";
			
		} else if ($_GET['id']=='tsh') {
			$text = "Torat Shraga";
			
		} else if ($_GET['id']=='hkl') {
			$text = "Yeshivat HaKotel";
			
		} else if ($_GET['id']=='ytv') {
			$text = "Yeshivat Torah V'Avodah";

        } else {

            $text = "Your School Year";

        }

        $content.=$text;

        return $content;

    }

    add_shortcode('textById', 'tns_text_by_id');
	
	function tns_checkout1_by_id($atts = [], $content = null)
    {

        $checkouturl = "";

        if ($_GET['id']=='asr') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=5889";
		} else if ($_GET['id']=='aty') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=1565";
		} else if ($_GET['id']=='brm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=10063";
		} else if ($_GET['id']=='zda') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=5193";
		} else if ($_GET['id']=='drc') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=265";
		} else if ($_GET['id']=='igf') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=4370";
		} else if ($_GET['id']=='kby') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=270";
		} else if ($_GET['id']=='mma') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=927";
		} else if ($_GET['id']=='ymy') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=6485";
		} else if ($_GET['id']=='mll') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=8208";
		} else if ($_GET['id']=='mmy') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=293";
		} else if ($_GET['id']=='amt') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=716";
		} else if ($_GET['id']=='mdm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=286";
		} else if ($_GET['id']=='mth') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=10069";
		} else if ($_GET['id']=='mtv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=10041";
		} else if ($_GET['id']=='mtc') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=12896";
		} else if ($_GET['id']=='yna') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=331";
		} else if ($_GET['id']=='nsm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=308";
		} else if ($_GET['id']=='odv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=311";
		} else if ($_GET['id']=='ory') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=313";
		} else if ($_GET['id']=='res') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=842";
		} else if ($_GET['id']=='sha') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=316";
		} else if ($_GET['id']=='sfw') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=8207";
		} else if ($_GET['id']=='smz') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=321";
		} else if ($_GET['id']=='bnt') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=261";
		} else if ($_GET['id']=='cyj') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=11451";
		} else if ($_GET['id']=='tfz') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=11452";
		} else if ($_GET['id']=='tft') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=324";
		} else if ($_GET['id']=='tfj') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=323";
		} else if ($_GET['id']=='tmd') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=10029";
		} else if ($_GET['id']=='tsh') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=328";
		} else if ($_GET['id']=='hkl') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=11030";
		} else if ($_GET['id']=='ytv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=392&linkid=10040";



        } else {

            $school = " https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/plugins/tns_plans/set_bundle_id.php?bundle_id=392";

        }

        $content.=$school;

        return $content;

    }

    add_shortcode('checkout1ById', 'tns_checkout1_by_id');
	
	function tns_checkout2_by_id($atts = [], $content = null)
    {

        $checkouturl = "";

        if ($_GET['id']=='asr') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=5889";
		} else if ($_GET['id']=='aty') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=1565";
		} else if ($_GET['id']=='brm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=10063";
		} else if ($_GET['id']=='zda') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=5193";
		} else if ($_GET['id']=='drc') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=265";
		} else if ($_GET['id']=='igf') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=4370";
		} else if ($_GET['id']=='kby') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=270";
		} else if ($_GET['id']=='mma') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=927";
		} else if ($_GET['id']=='ymy') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=6485";
		} else if ($_GET['id']=='mll') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=8208";
		} else if ($_GET['id']=='mmy') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=293";
		} else if ($_GET['id']=='amt') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=716";
		} else if ($_GET['id']=='mdm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=286";
		} else if ($_GET['id']=='mth') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=10069";
		} else if ($_GET['id']=='mtv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=10041";
		} else if ($_GET['id']=='mtc') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=12896";
		} else if ($_GET['id']=='yna') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=331";
		} else if ($_GET['id']=='nsm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=308";
		} else if ($_GET['id']=='odv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=311";
		} else if ($_GET['id']=='ory') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=313";
		} else if ($_GET['id']=='res') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=842";
		} else if ($_GET['id']=='sha') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=316";
		} else if ($_GET['id']=='sfw') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=8207";
		} else if ($_GET['id']=='smz') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=321";
		} else if ($_GET['id']=='bnt') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=261";
		} else if ($_GET['id']=='cyj') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=11451";
		} else if ($_GET['id']=='tfz') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=11452";
		} else if ($_GET['id']=='tft') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=324";
		} else if ($_GET['id']=='tfj') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=194&linkid=323";
		} else if ($_GET['id']=='tmd') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=10029";
		} else if ($_GET['id']=='tsh') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=328";
		} else if ($_GET['id']=='hkl') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=11030";
		} else if ($_GET['id']=='ytv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=149&linkid=10040";



        } else {

            $school = " https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/plugins/tns_plans/set_bundle_id.php?bundle_id=149";

        }

        $content.=$school;

        return $content;

    }

    add_shortcode('checkout2ById', 'tns_checkout2_by_id');
	
	function tns_checkout3_by_id($atts = [], $content = null)
    {

        $checkouturl = "";

        if ($_GET['id']=='asr') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=5889";
		} else if ($_GET['id']=='aty') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=1565";
		} else if ($_GET['id']=='brm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=10063";
		} else if ($_GET['id']=='zda') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=5193";
		} else if ($_GET['id']=='drc') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=265";
		} else if ($_GET['id']=='igf') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=4370";
		} else if ($_GET['id']=='kby') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=270";
		} else if ($_GET['id']=='mma') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=927";
		} else if ($_GET['id']=='ymy') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=6485";
		} else if ($_GET['id']=='mll') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=8208";
		} else if ($_GET['id']=='mmy') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=293";
		} else if ($_GET['id']=='amt') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=716";
		} else if ($_GET['id']=='mdm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=286";
		} else if ($_GET['id']=='mth') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=10069";
		} else if ($_GET['id']=='mtv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=10041";
		} else if ($_GET['id']=='mtc') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=12896";
		} else if ($_GET['id']=='yna') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=331";
		} else if ($_GET['id']=='nsm') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=308";
		} else if ($_GET['id']=='odv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=311";
		} else if ($_GET['id']=='ory') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=313";
		} else if ($_GET['id']=='res') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=842";
		} else if ($_GET['id']=='sha') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=316";
		} else if ($_GET['id']=='sfw') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=8207";
		} else if ($_GET['id']=='smz') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=321";
		} else if ($_GET['id']=='bnt') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=261";
		} else if ($_GET['id']=='cyj') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=11451";
		} else if ($_GET['id']=='tfz') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=11452";
		} else if ($_GET['id']=='tft') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=324";
		} else if ($_GET['id']=='tfj') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=323";
		} else if ($_GET['id']=='tmd') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=10029";
		} else if ($_GET['id']=='tsh') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=328";
		} else if ($_GET['id']=='hkl') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=11030";
		} else if ($_GET['id']=='ytv') {
			$checkouturl = "https://talknsave.us/signup_Page1.aspx?headerfooter=0&wordpress=1&b=349&linkid=10040";



        } else {

            $school = " https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/plugins/tns_plans/set_bundle_id.php?bundle_id=349";

        }

        $content.=$school;

        return $content;

    }

    add_shortcode('checkout3ById', 'tns_checkout3_by_id');

    function tns_locations_redirect_shortcode($atts = [], $content = null) {
        if ($_GET['code']!=base64_encode('secret')) {
            echo "<script>window.location.href=\"https://wordpress-944064-3284364.cloudwaysapps.com/\";</script>";
        }
        return $content;
    }
    add_shortcode('tns_locations_redirect_shortcode', 'tns_locations_redirect_shortcode');

    function tns_kb_custom_css($atts = [], $content = null) {
        $content.=
            "<style>
            #advanced_iframe {
                overflow: scroll;
                width: 100%;
                height: 100%;
            }
            </style>";
        return $content;
    }
    add_shortcode('tns_kb_custom_css', 'tns_kb_custom_css');

    function tns_kb_custom_js($atts = [], $content = null) {
        $content.=
            "<script>
            function inViewport($,el) {
                var elH = el.outerHeight(),
                    H   = $(window).height(),
                    r   = el[0].getBoundingClientRect(), t=r.top, b=r.bottom;
                return Math.max(0, t>0? Math.min(elH, H-t) : (b<H?b:H));
            }
            function tnsKbCustomJsCheckJQuery() {
                if (typeof jQuery == 'function') {
                    $ = jQuery;
                    var iframe = $('#advanced_iframe');
                    var heightvp = inViewport($,$('html'));
                    var marginheight = 
                        $('#Content').outerHeight(true) - 
                        $('#Content').innerHeight();
                    //console.log(\"the_content_wrapper innerHeight \"+$('.the_content_wrapper').innerHeight());
                    //console.log(heightvp);
                    var footer = $('#Footer');
                    iframe.height(heightvp-footer.height()-marginheight);
                    $('.section_wrapper').css('max-width','100%');
                    $('.the_content_wrapper').css('margin','0');
                } else {
                    setTimeout(tnsKbCustomJsCheckJQuery,500);
                }
            }
            setTimeout(tnsKbCustomJsCheckJQuery,500);
            </script>";
        return $content;
    }
    add_shortcode('tns_kb_custom_js', 'tns_kb_custom_js');
}

add_action('init', 'tns_snippets_init');

/**
 * Send an email notification to the administrator when a post is published.
 *
 * @param   string  $new_status
 * @param   string  $old_status
 * @param   object  $post
 */
function wpse_19041_notify_yisrael_michael_on_publish( $new_status, $old_status, $post ) {
    if ( $new_status !== 'publish' || $old_status === 'publish' )
        return;
    if ( ! $post_type = get_post_type_object( $post->post_type ) )
        return;

    // Recipient, in this case the administrator email
    //$emailto = get_option( 'admin_email' );
    $headers = array('Content-Type: text/html; charset=UTF-8');
    // Email subject, "New {post_type_label}"
    $subject = 'New ' . $post_type->labels->singular_name;
    $author = get_the_author_meta('display_name',$post->post_author);
    // Email body
    $message = 'View it: <a href="'.get_permalink( $post->ID ).'">' . get_permalink( $post->ID ) . "</a><br/>\nEdit it: <a href=\"".
        get_edit_post_link( $post->ID )."\"
>".get_edit_post_link( $post->ID )."</a><br/>\nAuthor:".$author;
    $emailto = "marketing@talknsave.net";
    wp_mail( $emailto, $subject, $message, $headers );
  
}

add_action( 'transition_post_status', 'wpse_19041_notify_yisrael_michael_on_publish', 10, 3 );
?>