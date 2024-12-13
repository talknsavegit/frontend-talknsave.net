<!-- codes commented by me (Sandesh) -->
<!-- <?php //if(!empty($monthlyFees)):   ?>
        <?php   
            //if(is_array($monthlyFees[0])){  ?>   
                    <?php// foreach($monthlyFees as $fee): 
                        //if($fee['Amount'] == 0) continue;
                        ?>
                        <li class="row">
                            <div class="col-md-8 col-12"><?php //echo $fee['MonthlyFeeName']; ?></div>
                            <div class="col-md-4 text-right col-12">$<?php //echo number_format($fee['Amount'],2,'.',''); ?></div>
                        </li>
                    <?php //endforeach; ?>
            <?php //}else{ 
                //if($monthlyFees['Amount'] > 0){
                ?>      
                    <li class="row">
                        <div class="col-md-8 col-12"><?php //echo $monthlyFees['OnceFeeName']; ?></div>
                        <div class="col-md-4 text-right col-12">$<?php //echo number_format($monthlyFees['Amount'],2,'.',''); ?></div>
                    </li>    
            <?php 
            //}
        //}
        ?>
<?php// endif; ?> -->

<!-- codes added by me (Sandesh) -->
<?php 
$billdate = explode('T',$general['StartDate'])[0];
$billendDate = date('d/m/Y', strtotime($billdate. ' + 1 months'));

?>

        <?php if($general['LT_PPC'] == 'false'){ ?>
<li class="row">
        <div class="col-md-8 col-8">Service Plan Dates (<?php echo $general['RentalDays']?> days)</div>
        <div class="col-md-4 col-4 text-right"><?php echo date('d/m/Y',strtotime(explode('T',$general['PeriodStartDate'])[0])); ?> - <?php echo date('d/m/Y',strtotime(explode('T',$general['PeriodEndDate'])[0])); ?> ( <?php echo $general['RentalDays']?> )</div>
	</li>
<li class="row">
        <div class="col-md-8 col-12">Annual Fee</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($general['MonthlyFees'],2,'.',''); ?></div>
    </li>
     <?php }else{ ?>
	<li class="row">
    <div class="col-md-8 col-8">Monthly Service Plan (Service Plan For <?php echo date('d/m/Y',strtotime(explode('T',$general['StartDate'])[0])); ?> - <?php echo $billendDate; ?>)</div>
    <div class="col-md-4 col-4 text-right">$<?php echo number_format($general['MonthlyFees'],2,'.',''); ?></div>
		</li>
    <?php } ?>


<!-- call package -->
<?php if($callPkgs['TotalCharge'] > 0): ?>
    <li class="row">
        <div class="col-md-8 col-12">Calls</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($callPkgs['TotalCharge'],2,'.',''); ?></div>
    </li>
<?php endif; ?>

<!-- call package -->
<?php if($general['DataPackage'] > 0): ?>
    <li class="row">
        <div class="col-md-8 col-12">Data</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($general['DataPackage'],2,'.',''); ?></div>
    </li>
<?php endif; ?>


<!-- Other Fees Display -->
<?php 
        $otherfee = $general['OneTimeFees'];
        if($otherfee != 0):
    ?>
<li class="row">
    <div class="col-md-8 col-8"><a href="#other_fees" style="color:#142454 !important;">Other Fees</a></div>
    <?php if($otherfee<0):?>
    <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">-$<?php echo number_format($otherfee*-1,2,'.',''); ?></a></div>
    <?php else:?>
    <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">$<?php echo number_format($otherfee,2,'.',''); ?></a></div>
    <?php endif;?>
</li>
<?php endif; ?>

<!-- commented by sandesh -->
<?php 
    //if(!empty($general['Charge_DomesticCalls']) && $general['Charge_DomesticCalls'] > 0){
        ?>
        <!-- <li class="row">
            <div class="col-md-8 col-12"><a href="#call_details" style="color:#142454 !important;">Domestic Calls</a></div>
            <div class="col-md-4 text-right col-12"><a href="#call_details" style="color:#142454 !important;">$<?php echo number_format($general['Charge_DomesticCalls'],2,'.',''); ?></a></div>
        </li> -->
        <?php
   // }

   // if(!empty($general['Charge_IntlCalls']) && $general['Charge_IntlCalls'] > 0){
        ?>
        <!-- <li class="row">
            <div class="col-md-8 col-12">International Calls</div>
            <div class="col-md-4 text-right col-12">$<?php echo number_format($general['Charge_IntlCalls'],2,'.',''); ?></div>
        </li> -->
        <?php
    //}
?>



<?php if($smsPkgs['TotalCharge'] > 0): ?>
    <li class="row">
        <div class="col-md-8 col-12">Additional Text Messages</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($smsPkgs['TotalCharge'],2,'.',''); ?></div>
    </li>
<?php endif; ?>

<li class="row">
    <div class="col-md-8 col-8">17% TAX</div>
    <?php if($general['VAT']<0):?>
    <div class="col-md-4 text-right col-4">-$<?php echo number_format($general['VAT']*-1,2,'.',''); ?></div>
    <?php else:?>
    <div class="col-md-4 text-right col-4">$<?php echo number_format($general['VAT'],2,'.',''); ?></div>
    <?php endif;?>
</li>

<!-- accessories amount -->
<?php if(isset($oneTimeFees[0])):?>
    <?php for($i=0; $i<count($oneTimeFees); $i++):?>
        <?php if($oneTimeFees[$i]['OnceFeeName'] == "Accessories"):?>
        <li class="row">
            <div class="col-md-8 col-8">Accessories</div>
            <div class="col-md-4 text-right col-4">$<?php echo number_format($oneTimeFees[$i]['Amount'],2,'.',''); ?></div>
        </li>
        <?php endif;?>
        <?php if($oneTimeFees[$i]['OnceFeeName'] == "Coupon Credit"):?>
        <li class="row">
            <div class="col-md-8 col-8">Coupon Credit</div>
            <?php if($oneTimeFees[$i]['Amount'] > 0):?>
            <div class="col-md-4 text-right col-4">$<?php echo number_format($oneTimeFees[$i]['Amount'],2,'.',''); ?></div>
            <?php else: ?>
            <div class="col-md-4 text-right col-4">-$<?php echo number_format($oneTimeFees[$i]['Amount']*-1,2,'.',''); ?></div>
            <?php endif;?>
        </li>
        <?php endif;?>
    <?php endfor; ?>
<?php endif;?>



<!-- <li class="row">
    <div class="col-md-8 col-12">Other Fees</div>
    <?php 
        //$otherfee= number_format($general['OneTimeCredits'],2,'.','');
        //if($otherfee<0){
            //$other= $otherfee *-1; ?>
            <div class="col-md-4 text-right col-12">-$<?php //echo number_format($other,2,'.',''); ?></div>
       <?php //}else{ ?>
    <div class="col-md-4 text-right col-12">$<?php// echo number_format($general['OneTimeCredits'],2,'.',''); ?></div>
    <?php //} ?>
</li> -->


<!-- commented previous code for other fees -->
<!-- <li class="row">
    <div class="col-md-8 col-12">Other Fees</div>
    <?php 
        //$otherfee= number_format($general['OneTimeCredits'],2,'.','');
        //if($otherfee<0){
            //$other= $otherfee *-1; ?>
            <div class="col-md-4 text-right col-12">-$<?php //echo number_format($other,2,'.',''); ?></div>
       <?php//}else{ ?>
    <div class="col-md-4 text-right col-12">$<?php //echo number_format($general['OneTimeCredits'],2,'.',''); ?></div>
    <?php //} ?>
</li> -->
                            
<li class="total row">
        <!-- <?php //if($general['AutoCollectAfter']){ ?>
        <div class="col-md-8 col-12">Monthly Service Plan (Service Plan For <?php //echo date('d/M/Y',strtotime(explode('T',$general['AutoCollectAfter'])[0])); ?> - <?php //echo date('d/M/Y',strtotime('+1 month',strtotime(explode('T',$general['AutoCollectAfter'])[0]))); ?>)</div>
     <?php //}else{ ?>
    <div class="col-md-8 col-12">Monthly Service Plan (Service Plan For <?php //echo date('d/M/Y',strtotime(explode('T',$general['PeriodStartDate'])[0])); ?> - <?php //echo date('d/M/Y',strtotime(explode('T',$general['PeriodEndDate'])[0])); ?>)</div>
    <?php //} ?> -->
    
    <div class="col-md-8 col-8">Invoice Total</div>
    <?php if($general['GrandTotal'] < 0):?>
    <div class="col-md-4 col-4 text-right">-$<?php echo number_format($general['GrandTotal'] *-1,2,'.',''); ?></div>
    <?php else:?>
    <div class="col-md-4 col-4 text-right">$<?php echo number_format($general['GrandTotal'],2,'.',''); ?></div>
    <?php endif;?>
</li>