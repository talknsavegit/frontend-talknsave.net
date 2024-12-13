<?php 
    $general = $args['tblBills'];
    $monthlyFees = $args['tblBillsMonthlyFees']; // monthly bill
    $oneTimeFees = $args['tblBillsOneTimeFees'];
    $callPkgs = $args['tblBillsCallPackage'];
    $smsPkgs = $args['tblBillsSMSPackage'];
    $dataPkgs = $args['tblBillsExtendedDataPackage'];
    $payments = $args['tblPayments'];
    $calls = $args['calls'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo home_url(); ?>/wp-content/uploads/2016/04/FavIconTnS.png">
    <title>Invoice for #<?php echo $general['BillID']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
                            <h3>Bill Summary</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12 mb-4 mx-0">
                            <div class="content">
                                <ul>
                                    <?php include('inc/summary.php'); ?>
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
                if(count($calls) > 0){
                    $insidepackage = array();
                    $outsidepackage = array();

                    $pkgs = array('Call Package' ,'Text Package','Call_Pkg','SMS_Pkg');
                        foreach($calls as $key => $call){
                            if(in_array(trim($call['service']), $pkgs)):
                                $insidepackage[] = $call;

                            else:
                                $outsidepackage[] = $call;
                            endif;
                        }

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
</script>
</html>

