<?php 

    // call package amount, signup amount, accessories amount, credit amount, credit on previous invoice
    // $calls_amount = 0;
    $local_signup_fee = 0;
    $accessories_amount = 0;
    $cancle_amount = 0;
    $credit_on_previous_invoice = 0;
    $credit_amount = 0;
    $credit_status = false;
    $unlimited_package_extension_fee = 0;
    $sim_replacement_fee = 0;
    $shipping_fee = 0;
    $tax_free_shipping = 0;
    $setup_fee = 0;
    $coupon_credit_fee = 0;
    $fixed_rental_fee = 0;
    for($i=0; $i< count($oneTimeFees); $i++)
    {
    if($oneTimeFees[$i]['OnceFeeName'] == "Cancel Fee")
    {
        $cancle_amount = $oneTimeFees[$i]['DebitFor'];
    }
    if($oneTimeFees[$i]['OnceFeeName'] == "Setup Fee")
    {
        $setup_fee = $oneTimeFees[$i]['DebitFor'];
    }

    if($oneTimeFees[$i]['OnceFeeName'] == 'Stay Local Signup Fee')
     {
         $local_signup_fee = $oneTimeFees[$i]['DebitFor'];
     }

     if($oneTimeFees[$i]['OnceFeeName'] == 'Accessories')
     {
         $accessories_amount = $oneTimeFees[$i]['DebitFor'];
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'Credit' )
     {
         $credit_amount = $oneTimeFees[$i]['DebitFor'];
         $credit_status = true;
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'Credit On Previous Invoice' )
     {
         $credit_on_previous_invoice = $oneTimeFees[$i]['DebitFor'];
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'Unlimited Call Package Extension' )
     {
         $unlimited_package_extension_fee = $unlimited_package_extension_fee + $oneTimeFees[$i]['DebitFor'];
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'Sim Replacement Fee' )
     {
         $sim_replacement_fee = $oneTimeFees[$i]['DebitFor'];
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'Shipping & Handling from NY' )
     {
         $shipping_fee = $oneTimeFees[$i]['DebitFor'];
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'Shipping (Tax Free!)' )
     {
        $tax_free_shipping = $oneTimeFees[$i]['DebitFor'];
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'Coupon Credit' )
     {
         $coupon_credit_fee = $oneTimeFees[$i]['DebitFor'];
     }
     if($oneTimeFees[$i]['OnceFeeName'] == 'Fixed Rental Fee' )
     {
        $fixed_rental_fee = $oneTimeFees[$i]['DebitFor'];
     }

    }

    //other fee calculation
    //$other_amount = $cancle_amount + $local_signup_fee + $sim_replacement_fee + $unlimited_package_extension_fee + $setup_fee +$credit_on_previous_invoice;
    // $other_amount = $cancle_amount + $local_signup_fee + $sim_replacement_fee + $unlimited_package_extension_fee + $setup_fee +$credit_on_previous_invoice;


    //calculating tax amount
    $taxable_amount = $other_amount + $calls_amount + $outside_call_amount ;
    //$tax = number_format($taxable_amount * 0.17,2,'.','');


    //calculating total invoice(total amount is calculated from tblBills using payment_bills array in total-bill page)
    //$total_amount = $payments[0]['GrandTotal'] + $payments[count($payments)-1]['GrandTotal'];
    $total_amount = $calls_amount + $credit_amount + $other_amount + $accessories_amount + $tax +$shipping_fee; 
    $total_amount = number_format($total_amount,2,'.','');

    

?>


<?php 
 //credit amount if present
 if($credit_amount !=0){
    $invoice_total = $total_amount;
}
?>

<div class="row summary-top mx-0">
    <div class="col-md-6 col-12 pl-0">
        <h2>Service Details</h2>
        <p>Rental Code #<?php echo $general['RentalCode']; ?> </p>
    </div>
    <div class="col-md-6 col-12 total-due d-flex">
        <div class="col-md-6 col-6">Invoice Total</div>
        <?php 
        // $total = number_format($payments[$count]['GrandTotal'],2,'.','');
            if($invoice_total < 0): ?>
                <div class="col-md-6 col-6 text-right">-$<?php echo $invoice_total *-1; ?></div>
            <?php else: ?> 
                <div class="col-md-6 col-6 text-right">$<?php echo $invoice_total ?></div>
            <?php endif; ?>
    </div>
</div>