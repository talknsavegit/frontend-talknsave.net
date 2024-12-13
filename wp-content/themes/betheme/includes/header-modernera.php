<?php
/**
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

$translate['wpml-no'] = mfn_opts_get('translate') ? mfn_opts_get('translate-wpml-no', 'No translations available for this page') : __('No translations available for this page', 'betheme');
$translate['search-placeholder'] = mfn_opts_get('translate') ? mfn_opts_get('translate-search-placeholder', 'Enter your search') : __('Enter your search', 'betheme');



$creative_classes = '';
$creative_options = mfn_opts_get('menu-creative-options');

if (is_array($creative_options)) {
	if (isset($creative_options['scroll'])) {
		$creative_classes .= ' scroll';
	}
	if (isset($creative_options['dropdown'])) {
		$creative_classes .= ' dropdown';
	}
}
?>
<link href='http://fonts.googleapis.com/css?family=Lato:400,500,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
 <style>
            @font-face {
                font-family: "Lato";
                font-weight: bold;
                font-style: normal;
            }
            body {
                font-family: 'Lato';
            }
            .navbar{
                padding-top: 0;
                padding-bottom: 0;
            }
            .navbar-light .navbar-brand {
                color: #2196F3;
            }
            .navbar-light .navbar-nav .nav-link {
                color: black;
            }
            .navbar-light .navbar-brand:focus, .navbar-light .navbar-brand:hover {
                color: #1ebdc2;
            }
            .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
                color: #fff;
            }
            .navbar-light .navbar-nav .nav-link{
                padding-top: 22px;
                padding-bottom: 22px;
                transition: 0.3s;
                padding-left: 24px;
                padding-right: 24px;
                font-size: 14px;
            }
            .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover{
                background: #142454;
                transition: 0.3s;
                opacity: 0.1;
            }
            .dropdown-item:focus, .dropdown-item:hover {
                color: #fff;
                text-decoration: none;
                background-color: #1ebdc2 !important;
            }
            .sm-menu{
                border-radius: 0px;
                border: 0px;
                top: 97%;
                box-shadow: rgb(173 173 173 / 20%) 2px 3px 4px 3px;
            }
            .dropdown-item {
                color: #3c3c3c;
                font-size: 14px;
            }
            .dropdown-item.active, .dropdown-item:active {
                color: #fff;
                text-decoration: none;
                background-color: #2196F3;
            }
            .navbar-toggler{
                outline: none !important;
            }
            .navbar-tog{
                color: #1ebdc2;
            }
            .megamenu-li {
                position: static;
            }

            .megamenu {
                position: absolute;
                width: 100%;
                left: 0;
                right: 0;
            }
            .megamenu h6{
                margin-left: 21px;
            }
            .megamenu i{
                width: 20px;
            }
            /*custom css*/
            .headerLink{
                color: #142454;font-weight: 400;font-size: 16px;
            }
            .dropdownText{
                line-height: 18px;
                font-size: 14px;
            }
            .dropdownTitle{
                font-size: 17px;
                font-weight: 700;
            }
            .planLink{
                font-weight: 700;
                font-size: 14px;
                line-height: 17px;
                color: #142454;
            }
            .accountButton{
                background: #142454;border-radius: 5px;padding: 6px 32px;align-items: center;display: flex;
            }
            .accountButton span{
                font-style: normal;font-weight: 600;font-size: 14px;line-height: 17px;color: #FFFFFF;
            }
            .emailAddInput{
                background: #FFFFFF !important;
                border-radius: 5px 0px 0px 5px !important;
                width: 58%;
                height: 37px;
                font-weight: 400;
                font-size: 14px;
            }
            .subscribeButton{
                background: #FBB434;
                border-radius: 0px 4px 4px 0px;
                padding: 10px 32px;
                color: #000000;
                font-weight: 700;
                font-size: 14px;
                line-height: 17px;
            }
            .yellowText{color: #FBB434;}
            .footerDiv{
                background: black;
                /*position: absolute;*/
                bottom: 0;
                width: 100%;
            }
            .planIcon{
                width:25px;
                height:25px;
            }
            .a{
                border-bottom: 0;
            }
            .border-top{
                border-top:1px solid #dee2e6!important;
            }
            .headerLinkStyle{
                border-bottom: none;
            }
            .bannerTextDiv{padding:98px;color:white;}
            .bannerTextDiv p{line-height: 20px;font-weight: 400;font-size: 16px;}
            .bannerTextDiv button{background: #FBB434;border-radius: 5px;padding: 10px 32px;border:none;font-weight: 700;color:black;font-size: 14px;line-height: 17px;}
            .bannerTextDiv button:hover{background: #FBB434;color:black;}
            .bannerSectionTwo h5{color: #142454;font-size: 20px;font-weight: 700;}
            .bannerSectionTwo p{font-size: 16px;line-height: 19px;text-align: center;font-weight: 400;}
            a:hover{text-decoration: none; color: #142454;}
            .bannerSectionTwo img{height: fit-content;}
            .dropdownDiv .row .col-lg-4{cursor:pointer;}
            .dropdownDiv .row .col-lg-4:hover{background: #4b758c2e;}
            #dropdown01:hover .dropdownDiv{display: block;}
            .accountButton:not(.has-background):hover{background-color: #142454;}
            .footerDiv h5{font-size: 20px;line-height: 24px;}
            .footerDiv span{font-weight: 400;font-size: 16px;line-height: 19px;}
            .subscribeButton:not(.has-background):hover{background: #FBB434;color: #000000;font-weight: 700;font-size: 14px;}
            .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover{opacity: 1;background: #4b758c2e;color: black;}
            .cardRow{margin-left: 0px; margin-right: 0px;}
            .footerSecond p, .footerSecond span{font-size: 14px;}
            .cartCount{cursor:pointer;position: absolute;width: 18px;height: 18px;left: 99.5%;top: 15px;}
            .site-content, .site-footer{display: none;}
            .tnsmvid-icon{
                height: 64px;
                position: absolute;
                width: 64px;
                z-index: 1;
                    opacity: 0.9;
                    background-size: contain;
            }
            .tnsmvid-pause{
                background: url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/10/PlayBtn.png') center center no-repeat;
                    /*top: 5px;*/
                    /*right: 93px;*/
                top: 200px;
                left: 45%;
            }
            .tnsmvid-mute{
                    background: url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/11/MuteBtn_1.png') center center no-repeat;
                    top: 5px;
                    right: 20px;
            }
            .tnsmvid-firstplay{
                    background: url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/10/PlayBtn.png') center center no-repeat;
                    top: calc(50% - 32px);
                    left: calc(50% - 32px);
            }
            .tnsmvid-loading{
                    background: url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/11/loader.gif') center center no-repeat;
                    top: calc(50% - 8px);
                    left: calc(50% - 8px);
                    height: 16px;
                    width: 16px;
                    opacity: 0.3;
            }
            #tnsmvid{object-fit: fill;width: 100%;height: 77vh;z-index: -100;overflow: hidden;position: absolute;}
            .responsiveBorderDiv{display: none;}
            .mobileHeaderSection{display: none;}
            .desktopHeaderSection{display: block;position: sticky;top: 0;z-index: 9999;background-color: white;}
            .titletext{
                width: 122.5px;
                /*height: 72px;*/    
                font-style: normal;
                font-weight: 700;
                font-size: 20px;
                line-height: 24px   
            }
            .detailtext{
                width: 122.5px;
               height: 95px;
               font-style: normal;
               font-weight: 400;
               font-size: 16px;
               line-height: 19px;
               color: #656565;   
            }
            .dropdown-container {
                display: none;
                background-color:#ffffff ;
                padding-left: 8px;
            }
            .dropdown-container .card{height: 340px;border: none;border-radius: 5px;}
            .submenulink{
               padding: 8px 8px 8px 0px !important;    
               font-weight: 700 !important;
               font-size: 16px !important;
               line-height: 17px !important;
               color: #142454 !important;
            }
            
            /*media css*/
            @media only screen and (max-width: 767px){
                .footerFirst .col-lg-4, .footerFirst .col-lg-3{margin-top: 3rem!important;}
                .desktopHeaderSection{display: none;}
                .mobileHeaderSection{display: block;position: sticky;top: 0;z-index: 9999;background-color: white;}
                .bannerTextDiv{padding: 60px 25px;}
                .YourAccountBtn{display: none;}
                .videoSection{display: none;}
                .responsiveBorderDiv{display: block;}
                .easySignUp{border-left: none !important;}
                .sidebar {
                    height: 100%;
                    width: 0;
                    position: fixed;
                    z-index: 1;
                    top: 0;
                    left: 0;
                    background-color: #ffffff;
                    overflow-x: hidden;
                    transition: 0.5s;
                    /*padding-top: 20px;*/
                  }

                  .sidebar a {
                    padding: 8px 8px 32px 32px;
                    text-decoration: none;
                    color: #000000;
                    display: block;
                    transition: 0.3s;
                    font-style: normal;
                   font-weight: 400;
                   font-size: 28px;
                   line-height: 34px;
                   border-bottom: none !important;

                  }
                  .sidebar .closebtn {
                    position: absolute;
                    top: 0;
                    font-size: 45px;
                    margin-left: -20px;
                  }

                  .openbtn {
                    font-size: 30px;
                    cursor: pointer;
                    background-color: white;
                    padding: 10px 15px;
                    border: none;
                    font-weight: bold;
                  }

                  .openbtn:hover {
                    background-color: white;
                  }

                  #main {
                    transition: margin-left .5s;
                    /*padding: 16px;*/
                  }
                  .cartCount{left: 97%;top: 0px;}
                  .accountButton span{font-size: 20px;line-height: 24px;font-weight: 700}
                  .accountButton{padding: 10px 32px;}
                  .accountButton img{width: 35px;height: 35px;}
                  .sidebarSocialIcon img{width: 27px;height: 27px;}
                  .bannerDiv{background-image: linear-gradient(rgb(20 36 84 / 70%), rgb(20 36 84 / 70%)), url(http://joshuak33.sg-host.com/wp-content/uploads/2022/11/heroSectionImage.png) !important;background-size: cover !important;}
                  .bannerTextDiv h1{font-weight: 700;}
                  .footerSecond p, .footerSecond span{font-size: 16px;}
                  .footerSecond .row{display: inline-block;}
                  .footerMarginLeft{margin-left: -15px;}
                  .planIcon{width:30px; height:30px;}
                  .rightSideDiv{display: contents;}
            }
            
            /*On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) /*/
            @media screen and (max-height: 450px) {
                .sidebar {padding-top: 15px;}
                .sidebar a {font-size: 18px;}
            }
        </style>
<!--desktop header section--> 
        <header class="desktopHeaderSection">
            <div class="container pl-0 pr-0">
                <!--margin:auto-->
                <div class="row col-lg-12 ml-0 mr-0 pl-0 pr-0" style="">
                    <div class="col-lg-2 pl-lg-0 pr-lg-0 mb-3 mt-3" style="margin:inherit;z-index:999;">
                        <a class="headerLinkStyle" href="http://joshuak33.sg-host.com/" rel="noopener">
                            <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/11/Tns-Logo.png" />
                        </a>
                    </div>
                    
                    <div class="col-lg-10 justify-content-end row">
                        <div class="row p-2 d-flex align-items-center">
                            <div>
                                <a class="mr-3 headerLinkStyle" href="mailto:info@talknsave.net" rel="noopener">
                                    <img src="https://joshuak33.sg-host.com/wp-content/uploads/2022/10/emailIcon.png" />
                                    <span class="headerLink">info@talknsave.net</span>
                                </a>
                            </div>

                            <div style="border-left: 1px solid #FBB434;">
                                <a class="headerLinkStyle" href="tel:1-866-825-5672" rel="noopener">
                                    <img class="ml-3" src="https://joshuak33.sg-host.com/wp-content/uploads/2022/10/phoneIcon.png" />
                                    <span class="headerLink">1-866-825-5672</span>
                                </a>
                            </div>    

                            <div class="ml-3" style="border-left: 1px solid #FBB434;">
                                <a class="ml-3 mr-3 headerLinkStyle" target="_blank" href="http://www.facebook.com/talknsave" rel="noopener">
                                    <img src="https://joshuak33.sg-host.com/wp-content/uploads/2022/10/facebookIcon.png">
                                </a>
                                <a class="mr-3 headerLinkStyle" target="_blank" href="http://www.twitter.com/talknsave" rel="noopener">
                                    <img src="https://joshuak33.sg-host.com/wp-content/uploads/2022/10/twitterIcon.png">
                                </a>
                                <a class="headerLinkStyle" target="_blank" href="https://www.instagram.com/talknsave" rel="noopener">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/instagramIcon.png">
                                </a>
                            </div>
                        </div>

                        <br><br />
                        <!--min-width: 1060px;-->
                        <div class="col-lg-12 pl-0 pr-0" style="min-width: 1110px;z-index:500;">

                            <nav class="navbar navbar-expand-lg navbar-light sticky-top pl-0 pr-0">
                                <div class="container pl-0 pr-0">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span> 
                                    </button>
                                    <div class="collapse navbar-collapse" id="mobile_nav">
                                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                        </ul>
                                        <ul class="navbar-nav navbar-light border-top">
                                            <li class="nav-item dropdown megamenu-li dmenu">
                                                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plans</a>
                                                <div class="dropdownDiv dropdown-menu megamenu sm-menu border-top pt-0 pb-0" aria-labelledby="dropdown01">
                                                    <div class="row cardRow">
                                                        <div class="col-sm-4 col-lg-4 border-right">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/Group.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Short Trip Monthly Rates</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-lg-4 border-right">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon2.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Short Trip Daily Rates</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-lg-4">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon3.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Students Over 3 Months</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0 mb-0">

                                                    <div class="row cardRow">
                                                        <div class="col-sm-4 col-lg-4 border-right">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon4.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Internet Only</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-lg-4 border-right">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon5.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Sim 4 Life</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-lg-4">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon6.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Kosher Student Plans</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0 mb-0">

                                                    <div class="row cardRow">
                                                        <div class="col-sm-4 col-lg-4 border-right">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon7.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Oleh Plans</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-lg-4 border-right">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon8.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Organized Groups</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-lg-4">
                                                            <div class="row p-3">
                                                                <div class="col-lg-2">
                                                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon9.png" class="planIcon"/>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <h5 class="dropdownTitle">Smartphone Rentals</h5>
                                                                    <p class="dropdownText">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                                                    <a href="#" class="planLink">View Plan <i class="fa fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>
                                            
                                            <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
                                            <li class="nav-item"><a class="nav-link" href="testimonials.php">Testimonials</a></li>
                                            <li class="nav-item"><a class="nav-link" href="faqs.php">FAQ</a></li>
                                            <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                                            <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                                            <li class="nav-item mt-2 ml-2 mr-4 pt-1">
                                                <a style="cursor:pointer;" data-toggle="modal" data-target="#loginModal">
                                                    <button class="accountButton">
                                                        <img class="mr-2" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/userIcon.png" />
                                                        <span>
                                                            Login
                                                        </span>
                                                    </button>
                                                </a>
                                            </li>
                                            <li class="nav-item mt-3 ml-3">
                                                <img style="cursor:pointer;" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/addToCartIcon.png" />
                                                <img class="cartCount" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/cartCount.png" />
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--desktop header section-->
        
        <!--mobile header section-->
        <header class="mobileHeaderSection">
            <div id="mySidebar" class="sidebar">
                <div class="ml-0 row col-12 pl-0" style="border-bottom: 1px solid #00000026;height: 10%;">
                    <div class="col-2 pl-0 pr-0">
                        <a href="javascript:void(0)" class="closebtn mt-2" onclick="closeNav()">×</a>
                    </div>
                <div class="col-4 pl-0 pr-0" style="margin:inherit;">
                    <a class="headerLinkStyle pl-0" href="http://joshuak33.sg-host.com/" rel="noopener">
                        <img style="width:100px;" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/11/Tns-Logo.png" />
                    </a>
                </div>
                <div class="text-right col-6 mt-3 pt-1" style="margin:inherit;">
                    <img style="cursor:pointer;width:28px;" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/addToCartIcon.png">
                    <img style="left: 90%;" class="cartCount" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/cartCount.png">                       
                </div>
                </div>
                
                <a href="#" style="padding-left: 15px;" class="dropdown-btn mt-3">Plans 
                    <i class="fa fa-caret-down"></i>
                </a> <div class="dropdown-container">
                    <div class="row col-12">
                        <div class="col-6  pl-2 p-2">
                            <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                                <div class="card-body">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/Group.png" class="planIcon mt-2 mb-3"/>
                                    <h5 class="titletext">Short Trip Monthly Rates</h5>
                                    <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                    <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6  pr-2 p-2">
                            <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                                <div class="card-body">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon2.png" class="planIcon mt-2 mb-3"/>
                                    <h5 class="titletext">Short Trip Daily Rates</h5>
                                    <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                    <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-6  pl-2 p-2">
                            <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                                <div class="card-body">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon3.png" class="planIcon mt-2 mb-3"/>
                                    <h5 class="titletext">Students Over 3 Months</h5>
                                    <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                    <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6  pr-2 p-2">
                            <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                                <div class="card-body">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon4.png" class="planIcon mt-2 mb-3"/>
                                    <h5 class="titletext">Internet Only</h5>
                                    <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                    <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- comment -->
                    <div class="row col-12">
                        <div class="col-6  pl-2 p-2">
                            <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                                <div class="card-body">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon5.png" class="planIcon mt-2 mb-3"/>
                                    <h5 class="titletext">Sim 4 Life</h5>
                                    <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                    <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6  pr-2 p-2">
                            <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                                <div class="card-body">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon6.png" class="planIcon mt-2 mb-3"/>
                                    <h5 class="titletext">Kosher Student Plans</h5>
                                    <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                    <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-6 pl-2 p-2">
                            <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                                <div class="card-body">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon7.png" class="planIcon mt-2 mb-3"/>
                                    <h5 class="titletext">Oleh Plans</h5>
                                    <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                    <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-2 pr-2">
                            <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                                <div class="card-body">
                                    <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon8.png" class="planIcon mt-2 mb-3"/>
                                    <h5 class="titletext">Organized Groups</h5>
                                    <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                    <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-2 pl-2 mb-3">
                        <div class="card" style="background: rgba(17, 36, 83, 0.05);">
                            <div class="card-body">
                                <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/planIcon9.png" class="planIcon mt-2 mb-3"/>
                                <h5 class="titletext">Smartphone Rentals</h5>
                                <p class="detailtext">Euismod convallis nisi tortor quis sit vel sed augue. Sit malesuada.</p>
                                <a href="#" class="planLink submenulink">View Plan <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="#" style="padding-left: 15px">About Us</a>
                <a href="#" style="padding-left: 15px">Testimonials</a>
                <a href="#" style="padding-left: 15px">FAQ</a>
                <a href="#" style="padding-left: 15px">Contact Us</a> 
                <a href="#" style="padding-left: 15px">Blog</a>
                <a data-toggle="modal" data-target="#loginModal" style="padding-left: 15px">
                    <button class="accountButton">
                        <img class="mr-2" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/userIcon.png" />
                        <span>
                            Login
                        </span>
                    </button>
                </a>
                <div class="row mt-5 pt-5 sidebarSocialIcon">
                    <a class="headerLinkStyle" target="_blank" href="http://www.facebook.com/talknsave" rel="noopener" style="">
                        <img src="https://joshuak33.sg-host.com/wp-content/uploads/2022/10/facebookIcon.png">
                    </a>
                    <a class="headerLinkStyle" target="_blank" href="http://www.twitter.com/talknsave" rel="noopener" style="padding-left: 20px">
                        <img src="https://joshuak33.sg-host.com/wp-content/uploads/2022/10/twitterIcon.png">
                    </a>
                    <a class="headerLinkStyle" target="_blank" href="https://www.instagram.com/talknsave" rel="noopener" style="padding-left: 20px">
                        <img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/instagramIcon.png">
                    </a>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a class="headerLinkStyle d-flex justify-content-center align-items-center pt-0" href="mailto:info@talknsave.net" rel="noopener">
                            <img src="https://joshuak33.sg-host.com/wp-content/uploads/2022/10/emailIcon.png">
                            <span class="headerLink pl-2 pr-2" style="font-size:19px;">info@talknsave.net</span>
                       </a>
                    </div>
                    <div class="col-6" style="border-left: 1px solid #FBB434;height: 40px;">
                        <a class="headerLinkStyle pl-0 pt-0" href="tel:1-866-825-5672" rel="noopener">
                            <img src="https://joshuak33.sg-host.com/wp-content/uploads/2022/10/phoneIcon.png">
                            <span class="headerLink" style="font-size:19px;">1-866-825-5672</span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="main" class="ml-0 row col-12">
                <div class="col-2 pl-0 pr-0">
                    <button class="openbtn" onclick="openNav()"><img src="http://joshuak33.sg-host.com/wp-content/uploads/2022/11/sidebarIcon.png" /></button>
                </div>
                <div class="col-4 mt-2" style="margin:inherit;">
                    <a class="headerLinkStyle" href="http://joshuak33.sg-host.com/" rel="noopener">
                        <img class="w-100" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/11/Tns-Logo.png" />
                    </a>
                </div>
                <div class="col-6 mt-3 pr-0 text-right" style="margin:inherit;">
                    <img style="cursor:pointer;width:28px;" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/addToCartIcon.png">
                    <img class="cartCount" src="http://joshuak33.sg-host.com/wp-content/uploads/2022/10/cartCount.png">                       
                </div>
            </div>
        </header>
        <!--mobile header section-->
 <script>
             var isFirstLoad = "1";
            $(document).ready(function(){
              
                $("#dropdown01").mouseover(function(){
                    $(".dropdownDiv").show();
                });
                $("#dropdown01").mouseout(function(){
                    $(".dropdownDiv").hide();
                });
                $(".dropdownDiv").mouseover(function(){
                    $(".dropdownDiv").show();
                });
                $(".dropdownDiv").mouseout(function(){
                    $(".dropdownDiv").hide();
                });
            });
            
            document.getElementById("tnsmvid").volume = 0.5;
            document.getElementById("tnsmvid").onplaying = function(){ document.getElementById("tnsmvid-loading").style.display = "none"; };
            document.getElementById("tnsmvidMockup").addEventListener("click", function(){
            document.getElementById("tnsmvidMockup").style.display = "none";
            document.getElementById("tnsmvidMainDiv").style.display = "";
            tnsmvidPlay("tnsmvid", "tnsmvid-playpause");
            }, false);

            function tnsmvidEnded(e)
            {
                    //e.srcElement.loop = true;
                    tnsmvidMute(e.srcElement.id, true, "tnsmvid-mutetoggle");
                    e.srcElement.play();
            }
            document.getElementById("tnsmvid").addEventListener("ended", tnsmvidEnded, false);

            var tnsmvidVideoHeightPercent = 0.75;
            function tnsmvidWindowResized(e)
            {
                    elementVideo = document.getElementById("tnsmvid");
                    elementVideo.style.maxHeight = Math.floor(window.innerHeight * tnsmvidVideoHeightPercent) + "px";
            }
            //window.addEventListener("resize", tnsmvidWindowResized, false);
            //document.getElementById("tnsmvid").style.maxHeight = Math.floor(window.innerHeight * tnsmvidVideoHeightPercent) + "px";
            if (!navigator.userAgent.toLowerCase().includes("mobi"))
            {
                    tnsmvidPlay("tnsmvid", "tnsmvid-playpause");
            }
            else
            {
                    tnsmvidLoading = document.getElementById("tnsmvid-loading");
                    tnsmvidLoading.style.backgroundImage = "url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/11/txtLoading.png')";
                    tnsmvidLoading.style.width = "128px";
                    tnsmvidLoading.style.top = "calc(50% - 32px)";
                    tnsmvidLoading.style.left = "calc(50% - 64px)";
                    document.getElementById('tnsmvidMainDiv').style.display = "none";
                    var tnsmvidMockup = document.getElementById("tnsmvidMockup");
                    tnsmvidMockup.style.display = "";
                    //document.getElementById('tnsSpecialSale').style.display = "";
                    document.getElementById('tnsMyAccount').style.display = "";
            }
            function tnsmvidPlay(videoId, playPauseId)
            {
                try {
                    document.getElementById('tnsmvid-loading').style.display = 'none';
                    document.getElementById("tnsmvid-firstplay").style.display = "none";
                    var elementVideo = document.getElementById(videoId);
                    var elementPlayPause = document.getElementById(playPauseId);
                    //elementVideo.play();
                    var promise = elementVideo.play();
                    if (promise !== undefined) {
                        promise.then(_ => {
                            // Autoplay started!
                        }).catch(error => {
                            // Autoplay was prevented.
                           console.log(error);
                           //setTimeout(function(){tnsmvidPlay(videoId, playPauseId);},1000);
                           //elementVideo.muted = true; 
                           //tnsmvidMute(videoId, true, "tnsmvid-mutetoggle");
                           elementVideo.currentTime =1;
//                           elementVideo.play();      
//                           setTimeout(function(){ elementVideo.pause();},700);
                          
                        });
                    }
                     if(isFirstLoad == "1"){
                        elementPlayPause.style.backgroundImage = "url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/10/PlayBtn.png')";	
                        isFirstLoad = "2";
                    }else{
                        elementPlayPause.style.backgroundImage = "url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/10/PauseBtn.png')";	
                    }
//                    elementPlayPause.style.backgroundImage = "url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/10/PauseBtn.png')";	
                    document.getElementById("tnsmvid-playpause").style.display = "block";
                    document.getElementById("tnsmvid-mutetoggle").style.display = "block";
                } catch (e) {
                    console.log(e);
                    setTimeout(function(){tnsmvidPlay(videoId, playPauseId);},1000);
                }
            }

            function tnsmvidPause(videoId, playPauseId)
            {
                    var elementVideo = document.getElementById(videoId);
                    var elementPlayPause = document.getElementById(playPauseId);
                    elementVideo.pause();
                    elementPlayPause.style.backgroundImage = "url('https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/10/PlayBtn.png')";	
            }

            function tnsmvidPlayPause(videoId, playPauseId)
            {
                    var elementVideo = document.getElementById(videoId);
                    if (elementVideo.paused)
                    {
                            tnsmvidPlay(videoId, playPauseId);
                    }
                    else
                    {
                            tnsmvidPause(videoId, playPauseId);
                    }
            };

            function tnsmvidMute(videoId, mute, muteIconId)
            {
                    elementMute = document.getElementById(muteIconId);
                    elementVideo = document.getElementById(videoId);
                    elementVideo.muted = mute;
                    elementMute.style.backgroundImage = "url('" + (mute ? 'https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/11/UnmuteBtn_1.png' : 'https://djmxwcm3rj9tp.cloudfront.net/wp-content/uploads/2016/11/MuteBtn_1.png') + "')";
            }

            function tnsmvidMuteToggle(videoId, muteIconId)
            {
                    tnsmvidMute(videoId, !document.getElementById(videoId).muted, muteIconId);
            }
            
            function openNav() {
                document.getElementById("mySidebar").style.width = "100%";
                document.getElementById("main").style.marginLeft = "250px";
            }

            function closeNav() {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
            }
            function plan() {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
            }
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
              dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                  dropdownContent.style.display = "none";
                } else {
                  dropdownContent.style.display = "block";
                }
                })
            };
        </script>