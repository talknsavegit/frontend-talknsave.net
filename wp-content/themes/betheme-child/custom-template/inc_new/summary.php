<!-- all calculations are done in general.php -->
<?php
// print_r($monthlyFees);
// print_r($general);

if (!empty($monthlyFees)) :   

    if (is_array($monthlyFees[0])) {  ?>
        <?php foreach ($monthlyFees as $fee) :
            if ($fee['Amount'] == 0) continue;
        ?>
            <li class="row">
                <div class="col-md-8 col-12"><?php echo $fee['MonthlyFeeName']; ?></div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($fee['Amount'], 2, '.', ''); ?></div>
            </li>
        <?php endforeach; ?>
        <?php } else {
        if ($monthlyFees['Amount'] > 0) {
        ?>
            <li class="row">
                <div class="col-md-8 col-12"><?php echo $monthlyFees['OnceFeeName']; ?></div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($monthlyFees['Amount'], 2, '.', ''); ?></div>
            </li>
    <?php
        }
    }
    ?>
<?php endif; ?>

<?php if (!empty($oneTimeFees)) :   ?>
    <?php if (is_array($oneTimeFees[0])) {  ?>
        <?php foreach ($oneTimeFees as $fee) :
            if ($fee['Amount'] == 0) continue;
        ?>
            <li class="row">
                <div class="col-md-8 col-12"><?php echo $fee['OnceFeeName']; ?></div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($fee['Amount'], 2, '.', ''); ?></div>
            </li>
        <?php endforeach; ?>
        <?php } else {
        if ($oneTimeFees['Amount'] > 0) {
        ?>
            <li class="row">
                <div class="col-md-8 col-12"><?php echo $oneTimeFees['OnceFeeName']; ?></div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($oneTimeFees['Amount'], 2, '.', ''); ?></div>
            </li>
    <?php }
    }
    ?>
<?php endif; ?>






<?php
// print_r($general);
if (!empty($general['Charge_DomesticCalls']) && $general['Charge_DomesticCalls'] > 0) {
?>
    <li class="row">
        <div class="col-md-8 col-12">Domestic Calls</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($general['Charge_DomesticCalls'], 2, '.', ''); ?></div>
    </li>
<?php
}

if (!empty($general['Charge_IntlCalls']) && $general['Charge_IntlCalls'] > 0) {
?>
    <li class="row">
        <div class="col-md-8 col-12">International Calls</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($general['Charge_IntlCalls'], 2, '.', ''); ?></div>
    </li>
<?php
}
?>

<?php if ($callPkgs['TotalCharge'] > 0) : ?>
    <li class="row">
        <div class="col-md-8 col-12">Call Package</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($callPkgs['TotalCharge'], 2, '.', ''); ?></div>
    </li>
<?php endif; ?>

<?php if ($smsPkgs['TotalCharge'] > 0) : ?>
    <li class="row">
        <div class="col-md-8 col-12">Additional Text Messages</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($smsPkgs['TotalCharge'], 2, '.', ''); ?></div>
    </li>
<?php endif; ?>



<!-- Display Duration to top of bill summary -->
<li class="row">
    <div class="col-md-8 col-6">Service Plan Dates </div>
    <div class="col-md-4 col-6 text-right"><?php echo date('m/d/Y', strtotime(explode("T", $general['StartDate'])[0])) . ' - ' . date('m/d/Y', strtotime(explode("T", $general['EndDate'])[0])) . ' (' . $general['Duration'] . ')'; ?></div>
</li>



<!-- display all tblLinkRentalOnceFees values in list -->
<!-- <?php
        //for($i=0; $i< count($oneTimeFees); $i++)
        // { 
        ?>
    <li class="row" >
    <div class="col-md-8 col-12"><?php //echo $oneTimeFees[$i]['OnceFeeName']; 
                                    ?></div>
    <div class="col-md-4 text-right col-12">$<?php //echo number_format($oneTimeFees[$i]['DebitFor'],2,'.',''); 
                                                ?></div>
</li>
<?php //} 
?> -->





<?php

$total_calls_amount = $calls_amount + $outside_call_amount;
if ($total_calls_amount != 0) { ?>
    <li class="row">
        <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Calls</a></div>
        <?php if ($total_calls_amount < 0) {
            $total_calls_amount = $calls_amount * -1;
        ?>
            <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">-$<?php echo number_format($total_calls_amount, 2, '.', ''); ?></a></div>
        <?php } else { ?>
            <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($total_calls_amount, 2, '.', ''); ?></a></div>
        <?php } ?>
    </li>
<?php } ?>

<!-- displaying monthly service plan if present -->
<?php if ($monthly_service_plan != 0) { ?>
    <li class="row">
        <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Monthly Service Plan</a></div>
        <?php if ($monthly_service_plan < 0) {
        ?>
            <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">-$<?php echo number_format($monthly_service_plan * -1, 2, '.', ''); ?></a></div>
        <?php } else { ?>
            <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($monthly_service_plan, 2, '.', ''); ?></a></div>
        <?php } ?>
    </li>
<?php } ?>

<!-- displaying Student Stay Local Unlimited (virtual #) if present -->
<?php if ($student_stay_local_fee != 0) { ?>
    <li class="row">
        <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Student Stay Local Unlimited (virtual #)</a></div>
        <?php if ($student_stay_local_fee < 0) {
        ?>
            <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">-$<?php echo number_format($student_stay_local_fee * -1, 2, '.', ''); ?></a></div>
        <?php } else { ?>
            <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($student_stay_local_fee, 2, '.', ''); ?></a></div>
        <?php } ?>
    </li>
<?php } ?>

<?php if ($equipment_rental != 0) { ?>
    <li class="row">
        <div class="col-md-8 col-8"><a href="#call_details" style="color:#142454 !important;">Equipment Rental</a></div>
        <?php if ($equipment_rental < 0) {
        ?>
            <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">-$<?php echo number_format($equipment_rental * -1, 2, '.', ''); ?></a></div>
        <?php } else { ?>
            <div class="col-md-4 text-right col-4"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($equipment_rental, 2, '.', ''); ?></a></div>
        <?php } ?>
    </li>
<?php } ?>

<!-- displaying roaming sms amount -->
<?php if ($sms_roaming_amount > 0) : ?>
    <li class="row">
        <div class="col-md-8 col-12">Text Messaging</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($sms_roaming_amount, 2, '.', ''); ?></div>
    </li>
<?php endif; ?>

<?php if ($other_amount != 0) : ?>
    <li class="row">
        <div class="col-md-8 col-8"><a href="#other_fees" style="color:#142454 !important;">Other Fees</a></div>
        <?php
        $otherfee = number_format($other_amount + $equipment_rental, 2, '.', '');
        if ($otherfee < 0) {
            $other = $otherfee * -1; ?>
            <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">-$<?php echo number_format($other, 2, '.', ''); ?></a></div>
        <?php } else { ?>
            <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">$<?php echo number_format($other_amount, 2, '.', ''); ?></a></div>
        <?php } ?>
    </li>
<?php endif; ?>

<?php if ($taxable_amount != 0) : ?>
    <li class="row">
        <div class="col-md-8 col-8">17% TAX</div>
        <?php
        $vat_amount = number_format($taxable_amount, 2, '.', '');
        if ($vat_amount < 0) : ?>
            <div class="col-md-4 text-right col-4">-$<?php echo $vat_amount * -1; ?></div>
        <?php else : ?>
            <div class="col-md-4 text-right col-4">$<?php echo $vat_amount; ?></div>
        <?php endif; ?>
    </li>
<?php endif; ?>

<?php if ($credit_status == true) : ?>
    <li class="row">
        <div class="col-md-8 col-8">Credit</div>
        <div class="col-md-4 text-right col-4">-$<?php echo number_format($credit_amount, 2, '.', '') * -1; ?></div>
    </li>
<?php endif; ?>
<?php if ($ups_return !== 0) : ?>
    <li class="row">
        <div class="col-md-8 col-8">UPS Return</div>
        <div class="col-md-4 text-right col-4">$<?php echo number_format($ups_return, 2, '.', ''); ?></div>
    </li>
<?php endif; ?>

<?php if ($previous_bill_balance !== 0) : ?>
    <li class="row">
        <div class="col-md-8 col-8">Previous Bill Balance</div>
        <div class="col-md-4 text-right col-4">-$<?php echo number_format($previous_bill_balance * -1, 2, '.', ''); ?></div>
    </li>
<?php endif; ?>

<li class="row" style="border-bottom:0px;margin-bottom:-20px;">
    <div class="col-md-8 col-8">Invoice Total</div>
    <?php
    $total = number_format($invoice_total, 2, '.', '');
    if ($total < 0) : ?>
        <div class="col-md-4 col-4 text-right">-$<?php echo $total * -1; ?></div>
    <?php else : ?>
        <div class="col-md-4 col-4 text-right">$<?php echo $total ?></div>
    <?php endif; ?>
</li>
<!-- <li class="total row">
        <? php // if($general['AutoCollectAfter']){ 
        ?>
        <div class="col-md-8 col-12">Monthly Service Plan (Service Plan For <?php //echo date('d/M/Y',strtotime(explode('T',$general['AutoCollectAfter'])[0])); 
                                                                            ?> - <?php echo date('d/M/Y', strtotime('+1 month', strtotime(explode('T', $general['AutoCollectAfter'])[0]))); ?>)</div>
     <? //php }else{ 
        ?>
    <div class="col-md-8 col-12">Monthly Service Plan (Service Plan For <?php //echo date('d/M/Y',strtotime(explode('T',$general['PeriodStartDate'])[0])); 
                                                                        ?> - <?php echo date('d/M/Y', strtotime(explode('T', $general['PeriodEndDate'])[0])); ?>)</div>
    <? php // } 
    ?>
    <div class="col-md-4 col-12 text-right">$<?php //echo number_format($general['GrandTotal'],2,'.',''); 
                                                ?></div>
</li> -->