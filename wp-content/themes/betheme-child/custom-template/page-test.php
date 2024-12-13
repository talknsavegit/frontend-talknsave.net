<?php 
    $general = $args['tblBills'];
    $monthlyFees = $args['tblBillsMonthlyFees']; // monthly bill
    $oneTimeFees = $args['tblBillsOneTimeFees'];
    $callPkgs = $args['tblBillsCallPackage'];
    $smsPkgs = $args['tblBillsSMSPackage'];
    $dataPkgs = $args['tblBillsExtendedDataPackage'];
    $payments = $args['tblPayments'];
    $calls = $args['calls'];
	echo var_dump(json_encode($oneTimeFees)); exit;

    // <!-- displaying call records  -->
    if(count($calls) > 0){
        $calls_outside_package_amount = 0;
        $insidepackage = array();
        $outsidepackage = array();

        $pkgs = array('Call Package' ,'Text Package','Call_Pkg','SMS_Pkg' || $general['LT_PPC'] == 'false');
            foreach($calls as $key => $call){
                if(in_array(trim($call['service']), $pkgs)):
                    $insidepackage[] = $call;

                else:
                    $outsidepackage[] = $call;
                    $calls_outside_package_amount = $calls_outside_package_amount + $call['Charge'];
                endif;
            }
    }
    
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo home_url(); ?>/wp-content/uploads/2016/04/FavIconTnS.png">
    <title>Invoice for #<?php echo $general['BillID']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
   
    <style>
        @import url(<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css);
        @import url(<?php echo get_stylesheet_directory_uri(); ?>/css/invoice.css);
        table, tr, td, th, tbody, thead, tfoot, h3, li {
            page-break-inside: avoid !important;
        }
		.goto-top{
			width:60px;
			height:60px;
			display: none; /* Hidden by default */
  			    position: fixed;
				bottom: 20px;
				right: 30px;
				z-index: 99;
				border: none;
				outline: none;
				color: white;
				cursor: pointer;
				padding: 0px;
				border-radius: 33px;
		}
		.goto-top img{
				width: 60px;
				height: 60px;
				left: 5px;
				position: relative
		}
        .payment_amount{
                transform:translateX(-25px);
            }
        @media  screen and(max-width: 767px) {
            .text-right{
                text-align:left !important;
            }
            
        }
        
    </style>
</head>
<body id="body">
    <?php include('inc/header.php'); ?>
    <main>
        <div class="container">
            <?php include('inc/general.php'); ?>
            <div class="row summary mb-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 col-12 mx-0">
                            <h3 class="d-inline-block">Bill Summary Test</h3>
                            <div class="d-inline-block float-right">
                                <?php if(empty($_GET['pdfs'])): ?>
                                <a href="<?php echo home_url('/'); ?>invoice/?billid=<?php echo $_GET['billid'];?>&rc=<?php echo $_GET['rc']?>&code=<?php echo $_GET['code']?>&pdf=1" style="color: #142454; font-style: 18px" download="talk-n-save<?=$_GET['billid']?>.pdf"><img src="<?php echo get_stylesheet_directory_uri(); ?>/custom-template/inc/image/pdf-icon.png" alt="pdf" srcset="<?php echo get_stylesheet_directory_uri(); ?>/custom-template/inc/image/pdf-icon.png" heigth="30" width="30"></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12 mb-4 mx-0">
                            <div class="content">
                                <ul>
                                    <?php include('inc/summaryTest.php'); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php include('inc/totaldue.php'); ?>
                </div>
                
                
                
                
            </div> <!-- end of summary -->
            <?php 
                if(!empty($payments)){  
                    include('inc/payments.php'); 
                }
            ?>
            <?php 
                if(!empty($callPkgs)){
                    include('inc/calldetails.php');
                }
            ?>
            
            <?php 
                if(!empty($smsPkgs)){
                    include('inc/sms.php');
                } 
            ?>

            <?php 
                if(!empty($dataPkgs)){
                    include('inc/dataPackage.php');
                } 
            ?>
            <?php 
                if(!empty($oneTimeFees)){
                    include('inc/otherFeesDetails.php');
                } 
            ?>
            <?php
                if(count($calls) > 0){
                    include('inc/callrecords.php');
                }
            ?>
        </div> <!-- End of container -->
    </main> <!-- end of main -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    
                    <p>
                        <u>Common billing FAQ's .</u><br>
                        Calls to your own number or *151 are voice mail calls <br>
                        Calls with 0 duration are text messages or downloads.
                    </p>
                    <p>Remember, if you ever lose your phone, log in to the <a href="https://webselfcare.talknsave.net" target="_blank">TalknSave WebSelfcare</a> to have it disconnected.<br>
                        <!-- Find our user guide at <a href="https://www.talknsave.us/help" target="_blank">www.talknsave.us/help</a>.  -->
                    </p>
                </div>
            </div>
        </div>
    </footer> <!-- end of footer -->
	<div class="goto-top" id="myBtn" onclick="topFunction()">
		 <img src="https://wordpress-944064-3284364.cloudwaysapps.com/wp-content/uploads/2022/04/arrow-circle-up-solid.svg">  
	</div>
</body>
<script type="text/javascript">
	mybutton = document.getElementById("myBtn");
   var package= document.getElementsByClassName('package')[0];
   package.onclick= function() {
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
	  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		mybutton.style.display = "block";
	  } else {
		mybutton.style.display = "none";
	  }
	}
    };

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
	  document.body.scrollTop = 0; // For Safari
	  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
	} 

    //   ----------click to see view buttons----------
    $('.btn1').click(function(){
        $('#collapseExample1').toggle();
        return false
    });

    $('.btn2').click(function(){
        $('#collapseExample2').toggle();
        return false
    });


</script>
</html>

