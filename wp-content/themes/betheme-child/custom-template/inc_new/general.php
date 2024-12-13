<?php 
// print_r($oneTimeFees);

$other_amount = 0;
$other_amount_index = 0;
$credit_amount = 0;
$credit_status = false;
$credit_on_previous_invoice = 0;
$ups_return = 0;

    for($i=0; $i< count($oneTimeFees); $i++)
    {
        if($oneTimeFees[$i]['OnceFeeName'] == "Cancel Fee")
        {
            $other_amount = $oneTimeFees[$i]['DebitFor'];
            $other_amount_index = $i;
            break;
        }
        else if($oneTimeFees[$i]['OnceFeeName'] == "Sim Replacement Fee")
        {
            $other_amount = $oneTimeFees[$i]['DebitFor'];
            $other_amount_index = $i;
            break;
        }
        else if($oneTimeFees[$i]['DebitFor'] < 0)
        {   
            $other_amount = $oneTimeFees[$i]['DebitFor'];
            $other_amount_index = $i;
            break;
        }
        else{
            $taxable_amount = 0;
            $other_amount = 0;
        }

    }
    for($i=0; $i< count($oneTimeFees); $i++)
    {
     //credit amount 
     if($oneTimeFees[$i]['OnceFeeName'] == 'Credit')
     {
         $credit_amount = $oneTimeFees[$i]['DebitFor'];
         $credit_status = true;
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'UPS Return')
     {
         $ups_return = $oneTimeFees[$i]['DebitFor'];
        
     }
    }

// call package amount, signup amount, accessories amount
$calls_amount = 0;
$calls_amount_index = 0;
$cancle_amount = 0;
for($i=0; $i< count($oneTimeFees); $i++)
{
    if($oneTimeFees[$i]['OnceFeeName'] == "Cancel Fee")
    {
        $cancle_amount = $oneTimeFees[$i]['DebitFor'];
    }

    if($oneTimeFees[$i]['OnceFeeCode'] == 370)
    {
        $calls_amount = $oneTimeFees[$i]['DebitFor'];
        $calls_amount_index = $i;
        break;
    }
    else if($oneTimeFees[$i]['OnceFeeCode'] == 371)
    {
        $calls_amount = $oneTimeFees[$i]['DebitFor'] ;
        $calls_amount_index = $i;
        break;
    }
 

//  if($oneTimeFees[$i]['OnceFeeName'] == 'Stay Local Signup Fee')
//  {
//      $local_signup_fee = $oneTimeFees[$i]['DebitFor'];
//  }

//  if($oneTimeFees[$i]['OnceFeeName'] == 'Accessories')
//  {
//      $accessories_amount = $oneTimeFees[$i]['DebitFor'];
//  }
}

if($cancle_amount !=0)
{
    $calls_amount = 0;
}


//tax calculation
$taxable_amount = ($calls_amount + $other_amount+ $outside_call_amount)*0.17;



//invoice total
$count = 0;
$date = $payments[0]['CreatedOn'];
for($i=1; $i<count($payments); $i++)
{
    if($payments[$i]['CreatedOn'] > $date)
    {
        $count = $i;
    }
}

?>

<div class="row summary-top mx-0">
    <div class="col-md-6 col-12 pl-0">
        <h2>Service Details</h2>
        <p>Rental Code #<?php echo $general['RentalCode']; ?> </p>
    </div>
    <div class="col-md-6 col-12 total-due d-flex">
        <div class="col-md-6 col-6">Total Invoice</div>
        <?php 
	//	print_r($payments);
        $total = number_format($payments[$count]['GrandTotal'],2,'.','');
            if($total < 0): ?>
                <div class="col-md-6 col-6 text-right">-$<?php echo $total*-1; ?></div>
            <?php else: ?> 
                <div class="col-md-6 col-6 text-right">$<?php echo $total ?></div>
            <?php endif; ?>
    </div>
</div>