<!-- codes added by me (Sandesh) -->

<?php 
 // print_r($general);

$billdate = explode('T',$general['AutoCollectAfter'])[0];
$billendDate = date('d/m/Y', strtotime($billdate. ' + 1 months'));

?>
        <?php if($general['LT_PPC'] == 'false'){ ?>
           
<?php if($general['ShortTermCollectionRental'] == "true"){ ?>
<li class="row">
                <div class="col-md-8 col-8">Service Plan Dates (<?php echo $general['RentalDays']?> days)</div>
                <div class="col-md-4 col-4 text-right"><?php echo date('d/m/Y',strtotime(explode('T',$general['StartDate'])[0])); ?> - <?php echo date('d/m/Y',strtotime(explode('T',$general['EndDate'])[0])); ?> ( <?php echo $general['RentalDays']?> ).</div>
            </li>

<?php }else{
	?>
<li class="row">
                <div class="col-md-8 col-8">Service Plan Dates (<?php echo $general['RentalDays']?> days)</div>
                <div class="col-md-4 col-4 text-right"><?php echo date('d/m/Y',strtotime(explode('T',$general['PeriodStartDate'])[0])); ?> - <?php echo date('d/m/Y',strtotime(explode('T',$general['PeriodEndDate'])[0])); ?> ( <?php echo $general['RentalDays']?> )</div>
            </li>
			<?php
		   }?>
            <?php if($general['MonthlyFees'] != 0): ?>
            <li class="row">
                <div class="col-md-8 col-12">
                    
                    <?php                     
                        if(is_array($monthlyFees[0] )) {
                            foreach ($monthlyFees as $fee) {                                
                                // Code to be executed for each element in the array
                                if ($fee['Amount'] == $general['MonthlyFees']) {
                                    echo $fee['MonthlyFeeName'];
                                }
                            }
                        }else {
                            if ($monthlyFees['MonthlyFeeCode'] == "66") 
                                echo "Annual Fee";
                            else 
                            echo  $monthlyFees['MonthlyFeeName'];  
                        }
                    ?>
                </div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($general['MonthlyFees'],2,'.',''); ?></div>
            </li>
            
            <?php endif; ?>
            
     <?php }else{ ?>
        <!-- Other Fees Display -->
       
       
        <?php if(isset($general['InsuranceFee'])) :?>
<?php if ((float) $general['MonthlyFees'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-8">Monthly Service Plan (Service Plan For <?php echo date('d/m/Y',strtotime(explode('T',$general['AutoCollectAfter'])[0])); ?> - <?php echo $billendDate; ?>)</div>
                <div class="col-md-4 col-4 text-right">$<?php echo number_format($general['MonthlyServicePlan'],2,'.',''); ?></div>
            </li>
   <?php endif ?>
            <?php if ((float) $general['InsuranceFee'] > 0): ?>
                <li class="row">
                    <div class="col-md-8 col-8">Insurance </div>
                    <div class="col-md-4 col-4 text-right">$<?php echo number_format($general['InsuranceFee'],2,'.',''); ?></div>
                </li>
            <?php endif ?>
        <?php else: ?>
<?php if ((float) $general['MonthlyFees'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-8">Monthly Service Plan (Service Plan For <?php echo date('d/m/Y',strtotime(explode('T',$general['AutoCollectAfter'])[0])); ?> - <?php echo $billendDate; ?>)</div>
                <div class="col-md-4 col-4 text-right">$<?php echo number_format($general['MonthlyFees'],2,'.',''); ?></div>
		    </li>
   <?php endif ?>
        <?php endif;?>
        <?php } ?> 
     

        

        <!-- Stay Local -->
        <?php if(isset($monthlyFees[0])):?>
            <?php for($i=0; $i<count($monthlyFees); $i++):?>
                <?php if(strpos($monthlyFees[$i]['MonthlyFeeName'], 'Stay Local') !== false):?>
                <li class="row">
                    <div class="col-md-8 col-8">Stay Local</div>
                    <div class="col-md-4 text-right col-4">$<?php echo number_format($monthlyFees[$i]['Amount'],2,'.',''); ?></div>
                </li>
                <?php endif;?>
            <?php endfor; ?>
        <?php endif;?>

        <!-- call package -->       
<?php if ($calls_outside_package_amount == 0  || intval($general['MonthlyServicePlan'] != 0) ): ?>
        <?php if((float) $callPkgs['TotalCharge'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-12"><a href="#callpkg-record" style="color: #142454;">Call Package</a></div>
                <?php if((float)$callPkgs['MobileSurchargeFee'] > 0 && (float)$callPkgs['MonthlyFee'] == 0):?>
                    <div class="col-md-4 text-right col-12">$<?php echo number_format($callPkgs['MobileSurchargeFee'],2,'.',''); ?></div>
                <?php else:?> 
                    <div class="col-md-4 text-right col-12">$<?php echo number_format($callPkgs['TotalCharge'],2,'.',''); ?></div>
                <?php endif; ?>
            </li>
        <?php else: ?>
                
            <?php if((float) $general['CallPackage'] > 0): ?>
                <li class="row">
                    <div class="col-md-8 col-12"><a href="#callpkg-record" class="package" style="color: #142454;">Call Package</a></div>
                    <div class="col-md-4 text-right col-12">$<?php echo number_format($general['CallPackage'],2,'.',''); ?></div>
                </li>
            <?php endif; ?>
        <?php endif; ?>  
  <?php endif; ?>  

        <!-- Domestic Calls -->
        <?php if((float) $general['Charge_DomesticCalls'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-12">Domestic Calls</div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($general['Charge_DomesticCalls'],2,'.',''); ?></div>              
            </li>
        <?php endif ?>        

        <!-- Intl Calls -->
        <?php if((float) $general['Charge_IntlCalls'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-12">Intl Calls</div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($general['Charge_IntlCalls'],2,'.',''); ?></div>              
            </li>
        <?php endif ?>       
        
        <!-- Intl SMS -->
        <!-- <?php if((float) $general['ChargeIntlSMS'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-12">Intl SMS</div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($general['ChargeIntlSMS'],2,'.',''); ?></div>              
            </li>
        <?php endif ?>     -->
        
        <!-- Intl SMS -->
        <?php if((float) $general['ChargeDomesticSMS'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-12">Domestic SMS</div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($general['ChargeDomesticSMS'],2,'.',''); ?></div>              
            </li>
        <?php endif ?>    
       

        <?php if($calls_outside_package_amount != 0 ){
            if(round($calls_outside_package_amount, 2) != round($general['CallPackage'], 2) || round($calls_outside_package_amount, 2) - round($callPkgs['TotalCharge'], 2) || intval($general['MonthlyServicePlan'] == 0)){
        ?>   
            <li class="row">
                <div class="col-md-8 col-12"><a href="#calloutpkg-record"  style="color: #142454;">Call Outside Of Package</a></div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format(+$calls_outside_package_amount,2,'.',''); ?></div>
            </li>
        <?php
            }
        }
        ?>

        <!-- SMS package -->
        <?php if($smsPkgs['TotalCharge'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-12">Additional Text Messages</div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($smsPkgs['TotalCharge'],2,'.',''); ?></div>
            </li>
        <?php endif; ?>

        <!-- data package -->
        <?php if($dataPkgs['TotalCharge'] > 0): ?>
            <li class="row">
                <div class="col-md-8 col-12">Data</div>
                <div class="col-md-4 text-right col-12">$<?php echo number_format($dataPkgs['TotalCharge'],2,'.',''); ?></div>
            </li>
        <?php endif; ?>

        <?php 
                $otherfee = $general['OneTimeFees'];
                if($otherfee != 0):
            ?>
            <li class="row" style="display: none;">
                <div class="col-md-8 col-8"><a href="#other_fees" style="color:#142454 !important;">Other Fees</a></div>
                <?php if($otherfee<0):?>
                    <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">-$<?php echo number_format($otherfee*-1,2,'.',''); ?></a></div>
                <?php else:?>
                    <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">$<?php echo number_format($otherfee,2,'.',''); ?></a></div>
                <?php endif;?>
            </li>
        <?php endif; ?>
    

<!-- Onetimefees total -->
<?php if(!isset($oneTimeFees[0])):?>
        <?php if($oneTimeFees['Amount'] !=0):?>
            <li class="row">
                    <div class="col-md-8 col-8"><a href="#other_fees" style="color:#142454 !important;">Other Fees</a></div>
                    <?php if($oneTimeFees['Amount']<0):?>
                        <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">-$<?php echo number_format($oneTimeFees['Amount']*-1,2,'.',''); ?></a></div>
                    <?php else:?>
                        <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">$<?php echo number_format($oneTimeFees['Amount'],2,'.',''); ?></a></div>
                    <?php endif;?>
            </li>
        <?php endif;?>
    <?php else:?> 
        <?php 
            $Vatfee = 0;
            // Iterate through the array
            foreach ($oneTimeFees as $fee) {
                // Check if the 'value' property is true
                if ($fee['OnceFeeName'] != "Accessories" && $fee['Amount'] !=0 && $fee['ChargeVAT'] === "true" && $fee['OnceFeeName'] != "Call Package") {
                    $Vatfee += (float) $fee["Amount"];
                }
            }
            if($Vatfee != 0): ?>
                <li class="row">
                    <div class="col-md-8 col-8"><a href="#other_fees" style="color:#142454 !important;">Other Fees</a></div>
                    <?php if($Vatfee<0):?>
                        <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">-$<?php echo number_format($Vatfee*-1,2,'.',''); ?></a></div>
                    <?php else:?>
                        <div class="col-md-4 text-right col-4"><a href="#other_fees" style="color:#142454 !important;">$<?php echo number_format($Vatfee,2,'.',''); ?></a></div>
                    <?php endif;?>
                </li>
        <?php endif; ?>
    <?php endif;?> 

    <?php if($general['Hanacha']!=0):?>
        <li class="row">
            <div class="col-md-8 col-8">Discount</div>
            <?php if($general['Hanacha']<0):?>
            <div class="col-md-4 text-right col-4">-$<?php echo number_format($general['Hanacha']*-1,2,'.',''); ?></div>
            <?php else:?>
            <div class="col-md-4 text-right col-4">$<?php echo number_format($general['Hanacha'],2,'.',''); ?></div>
            <?php endif;?>
        </li>
    <?php endif;?>
    <?php if($general['VAT']!=0):?>
        <li class="row">
            <div class="col-md-8 col-8">17% TAX</div>
            <?php if($general['VAT']<0):?>
            <div class="col-md-4 text-right col-4">-$<?php echo number_format($general['VAT']*-1,2,'.',''); ?></div>
            <?php else:?>
            <div class="col-md-4 text-right col-4">$<?php echo number_format($general['VAT'],2,'.',''); ?></div>
            <?php endif;?>
        </li>
    <?php endif;?>

       <!-- accessories amount -->
       <?php if(isset($oneTimeFees[0])):?>
            <?php for($i=0; $i<count($oneTimeFees); $i++):?>
                <?php if($oneTimeFees[$i]['OnceFeeName'] == "Accessories"):?>
                <li class="row">
                    <div class="col-md-8 col-8">Accessories</div>
                    <div class="col-md-4 text-right col-4">$<?php echo number_format($oneTimeFees[$i]['Amount'],2,'.',''); ?></div>
                </li>
                <?php endif;?>
                
            <?php endfor; ?>
        <?php endif;?>

    <!-- accessories amount -->
    <?php if(isset($oneTimeFees[0])):?>
            <?php for($i=0; $i<count($oneTimeFees); $i++):?>                
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
 <?php if($general['Discount']!=0):?>
        <li class="row">
            <div class="col-md-8 col-8">Discount</div>
            <?php if($general['Hanacha']<0):?>
            <div class="col-md-4 text-right col-4">-$<?php echo number_format($general['Hanacha']*-1,2,'.',''); ?></div>
            <?php else:?>
            <div class="col-md-4 text-right col-4">$<?php echo number_format($general['Hanacha'],2,'.',''); ?></div>
            <?php endif;?>
        </li>
    <?php endif;?>
   


<?php 
$nonVatfee = 0;
// Iterate through the array
foreach ($oneTimeFees as $fee) {
    // Check if the 'value' property is true
    if ($fee['OnceFeeName'] != "Accessories" && $fee['Amount'] !=0 && $fee['OnceFeeName'] != "Coupon Credit"  && $fee['ChargeVAT'] === "false" && $fee['OnceFeeName'] != "Call Package") {
        $nonVatfee += (float) $fee["Amount"];
    }
}
if($nonVatfee != 0):
?>
<li class="row">
            <div class="col-md-8 col-8"><a href="#notvat_fees" style="color:#142454 !important;">Non-Vattable Other Fees</a></div>
            <?php if($nonVatfee<0):?>
            <div class="col-md-4 text-right col-4"><a href="#notvat_fees" style="color:#142454 !important;">-$<?php echo number_format($nonVatfee*-1,2,'.',''); ?></a></div>
            <?php else:?>
            <div class="col-md-4 text-right col-4"><a href="#notvat_fees" style="color:#142454 !important;">$<?php echo number_format($nonVatfee,2,'.',''); ?></a></div>
            <?php endif;?>
        </li>
<?php endif; ?>




                            
<li class="total row">   
    <div class="col-md-8 col-8">Invoice Total</div>
    <?php if($general['GrandTotal'] < 0):?>
    <div class="col-md-4 col-4 text-right">-$<?php echo number_format($general['GrandTotal'] *-1,2,'.',''); ?></div>
    <?php else:?>
    <div class="col-md-4 col-4 text-right">$<?php echo number_format($general['GrandTotal'],2,'.',''); ?></div>
    <?php endif;?>
</li>

<?php 
        echo '<script>';
        echo 'console.log("Call Package: ", ' . json_encode($callPkgs) . ');';
        echo '</script>';
    ?>