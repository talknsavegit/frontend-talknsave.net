<?php if(!empty($monthlyFees)):   ?>
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
        <div class="col-md-8 col-12">Additional Calls</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($callPkgs['TotalCharge'],2,'.',''); ?></div>
    </li>
<?php endif; ?>

<?php if($smsPkgs['TotalCharge'] > 0): ?>
    <li class="row">
        <div class="col-md-8 col-12">Additional Text Messages</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($smsPkgs['TotalCharge'],2,'.',''); ?></div>
    </li>
<?php endif; ?>

<li class="row">
    <div class="col-md-8 col-12">VAT</div>
    <div class="col-md-4 text-right col-12">$<?php echo number_format($general['VAT'],2,'.',''); ?></div>
</li>

<li class="row">
    <div class="col-md-8 col-12">Other Fees</div>
    <?php 
        $otherfee= number_format($general['OneTimeCredits'],2,'.','');
        if($otherfee<0){
            $other= $otherfee *-1; ?>
            <div class="col-md-4 text-right col-12">-$<?php echo number_format($other,2,'.',''); ?></div>
       <?php }else{ ?>
    <div class="col-md-4 text-right col-12">$<?php echo number_format($general['OneTimeCredits'],2,'.',''); ?></div>
    <?php } ?>
</li>
                            
<li class="total row">
        <?php if($general['AutoCollectAfter']){ ?>
        <div class="col-md-8 col-12">Monthly Service Plan (Service Plan For <?php echo date('d/M/Y',strtotime(explode('T',$general['AutoCollectAfter'])[0])); ?> - <?php echo date('d/M/Y',strtotime('+1 month',strtotime(explode('T',$general['AutoCollectAfter'])[0]))); ?>)</div>
     <?php }else{ ?>
    <div class="col-md-8 col-12">Monthly Service Plan (Service Plan For <?php echo date('d/M/Y',strtotime(explode('T',$general['PeriodStartDate'])[0])); ?> - <?php echo date('d/M/Y',strtotime(explode('T',$general['PeriodEndDate'])[0])); ?>)</div>
    <?php } ?>
    <div class="col-md-4 col-12 text-right">$<?php echo number_format($general['GrandTotal'],2,'.',''); ?></div>
</li>