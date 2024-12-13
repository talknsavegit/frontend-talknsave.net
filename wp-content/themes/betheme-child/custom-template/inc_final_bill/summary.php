<!-- all amounts values are calculated in general.php file -->

<?php
// print_r($monthlyFees);
// print_r($oneTimeFees);
// print_r($general);

	
	

if(!empty($monthlyFees)):   ?>
        <?php   
            if(is_array($monthlyFees[0])){  ?>   
                    <?php foreach($monthlyFees as $fee): 
                        if($fee['Amount'] == 0) continue;
                        ?>
                        <li class="row">
                            <div class="col-md-8 col-12"><?php echo $fee['MonthlyFeeName']; ?></div>
                            <div class="col-md-4 text-right col-12">$<?php echo number_format($fee['Amount'],2,'.',''); ?></div>
                        </li>
                    <?php endforeach; ?>
            <?php }else{ 
                if($monthlyFees['Amount'] > 0){
                ?>      
                    <li class="row">
                        <div class="col-md-8 col-12"><?php echo $monthlyFees['OnceFeeName']; ?></div>
                        <div class="col-md-4 text-right col-12">$<?php echo number_format($monthlyFees['Amount'],2,'.',''); ?></div>
                    </li>    
            <?php 
            }
        }
        ?>
<?php endif; ?>

<?php if(!empty($oneTimeFees)):   ?>
        <?php if(is_array($oneTimeFees[0])){  ?>   
                    <?php foreach($oneTimeFees as $fee): 
                        if($fee['Amount'] == 0) continue;
                        ?>
                        <li class="row">
                            <div class="col-md-8 col-12"><?php echo $fee['OnceFeeName']; ?></div>
                            <div class="col-md-4 text-right col-12">$<?php echo number_format($fee['Amount'],2,'.',''); ?></div>
                        </li>
                    <?php endforeach; ?>
            <?php }else{  
                    if($oneTimeFees['Amount'] > 0){
                ?>    
                    <li class="row">
                        <div class="col-md-8 col-12"><?php echo $oneTimeFees['OnceFeeName']; ?></div>
                        <div class="col-md-4 text-right col-12">$<?php echo number_format($oneTimeFees['Amount'],2,'.',''); ?></div>
                    </li>
            <?php }
            }
        ?>
<?php endif; ?>


<?php 
    if(!empty($general['Charge_DomesticCalls']) && $general['Charge_DomesticCalls'] > 0){
        ?>
        <li class="row">
            <div class="col-md-8 col-12">Domestic Calls</div>
            <div class="col-md-4 text-right col-12">$<?php echo number_format($general['Charge_DomesticCalls'],2,'.',''); ?></div>
        </li>
        <?php
    }

    if(!empty($general['Charge_IntlCalls']) && $general['Charge_IntlCalls'] > 0){
        ?>
        <li class="row">
            <div class="col-md-8 col-12">International Calls</div>
            <div class="col-md-4 text-right col-12">$<?php echo number_format($general['Charge_IntlCalls'],2,'.',''); ?></div>
        </li>
        <?php
    }
?>

<?php if($callPkgs['TotalCharge'] > 0): ?>
    <li class="row">
        <div class="col-md-8 col-12">Call Package</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($callPkgs['TotalCharge'],2,'.',''); ?></div>
    </li>
<?php endif; ?>

<?php if($smsPkgs['TotalCharge'] > 0): ?>
    <li class="row">
        <div class="col-md-8 col-12">Additional Text Messages</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($smsPkgs['TotalCharge'],2,'.',''); ?></div>
    </li>
<?php endif; ?>

<!-- Display Duration to top of bill summary -->
<li class="row">
        <div class="col-md-8 col-6">Service Plan Dates </div>
        <div class="col-md-4 col-6 text-right"><?php echo date('m/d/Y',strtotime(explode("T",$general['StartDate'])[0])).' - '. date('m/d/Y',strtotime(explode("T",$general['EndDate'])[0])) .' ('.$general['Duration'].')'; ?></div>
</li>


<!-- Displaying Insurance Fee if Present -->
<?php if($insurance_fee !=0):?>
<li class="row" >
    <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Insurance</a></div> 
    <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($insurance_fee,2,'.',''); ?></a></div>
</li>
<?php endif;?>

<!-- Displaying Data Package Fee if Present -->
<?php if($data_package !=0):?>
<li class="row" >
    <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Data</a></div> 
    <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($data_package,2,'.',''); ?></a></div>
</li>
<?php endif;?>

<!-- monthly student plan -->
<?php if($monthly_service_plan !=0):?>
<li class="row" >
    <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Monthly Service Plan</a></div> 
    <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($monthly_service_plan,2,'.',''); ?></a></div>
</li>
<?php endif;?>

<!-- Student Stay Local Unlimited (virtual #) -->
<?php if($stay_student_local_unlimited !=0):?>
<li class="row" >
    <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Student Stay Local Unlimited (virtual #)</a></div> 
    <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($stay_student_local_unlimited,2,'.',''); ?></a></div>
</li>
<?php endif; ?>


<!-- displaying call package amount -->
<?php $calls_amount_total = $calls_amount + $outside_call_amount + $unlimited_package_extension_fee; ?>
<?php if($calls_amount_total !=0):?>
<li class="row" >
    <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Calls</a></div> 
    <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($calls_amount_total,2,'.',''); ?></a></div>
</li>
<?php endif; ?>

<?php if($equipment_rental !=0): ?>
   
    <li class="row" >
    <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Equipment Rental</a></div> 
    <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($equipment_rental,2,'.',''); ?></a></div>
    </li>

<?php endif;?>


<!-- displaying roaming sms amount or international messaging charge -->
<?php if($sms_package > 0): ?>
    <li class="row">
        <div class="col-md-8 col-12">Text Messaging</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($sms_package,2,'.',''); ?></div>
    </li>
<?php endif; ?>

<!-- displaying text messaging if present -->
<?php if($text_outside_package > 0): ?>
    <li class="row">
        <div class="col-md-8 col-12">Text Messaging</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($text_outside_package,2,'.',''); ?></div>
    </li>
<?php endif; ?>

<?php if($other_amount!=0):?>
    <li class="row" >
    <div class="col-md-8 col-8"><a href="#other_fees" style="color:#142454 !important;">Other Fees</a></div>
    <?php 
        $otherfee= number_format($other_amount + $equipment_rental,2,'.','');
        if($otherfee < 0){
            $other= $otherfee * -1; ?>
            <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">-$<?php echo number_format($other,2,'.',''); ?></a></div>
       <?php }else{ ?>
    <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">$<?php echo number_format($other_amount,2,'.',''); ?></a></div>
    <?php } ?>
</li>
<?php endif;?>

<!-- taxable amount -->

<?php if($tax !=0):?>
<li class="row">
    <div class="col-md-8 col-8">17% TAX</div>
    <?php 
    if($tax < 0):?>
    <div class="col-md-4 text-right col-4">-$<?php echo $tax * -1; ?></div>
    <?php else:?>
    <div class="col-md-4 text-right col-4">$<?php echo $tax; ?></div>
    <?php endif;?>
</li> 
<?php endif;?>

 <!-- shipping fee -->
<?php if($shipping_fee != 0): ?>
<li class="row">
    <div class="col-md-8 col-8">Shipping & Handling from NY</div>
    <div class="col-md-4 text-right col-4">$<?php echo number_format($shipping_fee,2,'.',''); ?></div>
    
</li> 
<?php endif;?>

 <!-- shipping fee -->
<?php if($tax_free_shipping != 0): ?>
<li class="row">
    <div class="col-md-8 col-8">Shipping (Tax Free!)</div>
    <div class="col-md-4 text-right col-4">$<?php echo number_format($tax_free_shipping,2,'.',''); ?></div>
    
</li> 
<?php endif;?>

<!-- coupon credit fee -->
<?php if($coupon_credit_fee != 0): ?>
<li class="row">
    <div class="col-md-8 col-8">Coupon Credit</div>
    <?php if($coupon_credit_fee<0):?>
    <div class="col-md-4 text-right col-4">-$<?php echo number_format($coupon_credit_fee*-1,2,'.',''); ?></div>
    <?php else:?>
    <div class="col-md-4 text-right col-4">$<?php echo number_format($coupon_credit_fee,2,'.',''); ?></div>
    <?php endif;?>
</li> 
<?php endif;?>

<!-- accessories amounts -->
<?php if($accessories_amount != 0): ?>
<li class="row">
    <div class="col-md-8 col-8">Accessories</div>
    <div class="col-md-4 text-right col-4">$<?php echo number_format($accessories_amount,2,'.',''); ?></div>
    
</li> 
<?php endif;?>

<!-- credit amount -->
<?php if($credit_status == true):?>
    <li class="row" >
    <div class="col-md-8 col-8">Credit</div>       
    <div class="col-md-4 text-right col-4">-$<?php echo number_format($credit_amount,2,'.','')*-1; ?></div>
</li>
<?php endif; ?>

<?php 
 //credit amount if present
 if($credit_amount !=0){
    $invoice_total = $total_amount;
}

?>
<li class="row" style="border-bottom:0px;margin-bottom:-20px;">
    <div class="col-md-8 col-8">Invoice Total</div>
        <?php 
            if($invoice_total < 0): ?>
                <div class="col-md-4 col-4 text-right">-$<?php echo $invoice_total * -1; ?></div>
            <?php else: ?> 
                <div class="col-md-4 col-4 text-right">$<?php echo $invoice_total ?></div>
            <?php endif; ?>
</li>                   
<!-- <li class="total row">
        <?php// if($general['AutoCollectAfter']){ ?>
        <div class="col-md-8 col-12">Monthly Service Plan (Service Plan For <?php //echo date('d/M/Y',strtotime(explode('T',$general['AutoCollectAfter'])[0])); ?> - <?php echo date('d/M/Y',strtotime('+1 month',strtotime(explode('T',$general['AutoCollectAfter'])[0]))); ?>)</div>
     <?//php }else{ ?>
    <div class="col-md-8 col-12">Monthly Service Plan (Service Plan For <?php //echo date('d/M/Y',strtotime(explode('T',$general['PeriodStartDate'])[0])); ?> - <?php echo date('d/M/Y',strtotime(explode('T',$general['PeriodEndDate'])[0])); ?>)</div>
    <?php// } ?>
    <div class="col-md-4 col-12 text-right">$<?php //echo number_format($general['GrandTotal'],2,'.',''); ?></div>
</li> -->