<div class="call-details mb-4">
   <div class="row" id="call_details">
        <div class="col-md-12 col-12">
            <h3>Call Details</h3>
        </div>
    </div>
<?php if($callPkgs['CallPackageDisplayName'] == 'UNLIMITED Anywhere™ Minutes+Data- $2.99/day used'){ ?>
<div class="row">
        <div class="col-md-12 col-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-8 col-12 title pl-0">Call Package<br> (<?php echo $callPkgs['CallPackageDisplayName']; ?>)</div>
                <div class="col-md-4 col-12 text-right">$<?php echo number_format($callPkgs['TotalCharge'],2,'.','');  ?></div>
            </div>
        </div>
    </div>
     <?php }else{ ?>
	<div class="row">
        <div class="col-md-12 col-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-8 col-12 title pl-0">Call Package<br> (<?php echo $callPkgs['CallPackageDisplayName']; ?>)</div>
                <?php if($general['MonthlyFees'] !=0):?>
                    <div class="col-md-4 col-12 text-right">$<?php echo number_format($general['MonthlyFees'],2,'.',''); ?></div>
                <?php else:?> 
                    <div class="col-md-4 col-12 text-right">$<?php echo number_format($callPkgs['MonthlyFee'],2,'.',''); ?></div>
                <?php endif;?> 
            </div>
        </div>
    </div>
    <?php } ?>


    <!-- not necessary for invoice -->
    <!-- <?php //if($calls_outside_package_amount != 0){
        ?>
       <div class="row mt-2">
        <div class="col-md-12 col-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-8 col-12 title pl-0"><span class="mt-2">Call Outside Of Package</span></div>
                <div class="col-md-4 col-12 text-right">$<?php //echo number_format($calls_outside_package_amount,2,'.',''); ?></div>
            </div>
        </div>
    </div>
    <?php
    //}
    ?> -->
    <?php if($calls_outside_package_amount != 0){
        ?>
       <div class="row mt-2">
        <div class="col-md-12 col-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-8 col-12 title pl-0"><span class="mt-2">Call Outside Of Package</span></div>
                <div class="col-md-4 col-12 text-right">$<?php echo number_format(+$calls_outside_package_amount,2,'.',''); ?></div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <!-- i commented this for call records display -->
    <!-- <?php 
    //if(!empty($general['Charge_DomesticCalls']) && $general['Charge_DomesticCalls'] > 0){
        ?>
        <li class="row">
            <div class="col-md-8 col-12">Domestic Calls</div>
            <div class="col-md-4 text-right col-12">$<?php //echo number_format($general['Charge_DomesticCalls'],2,'.',''); ?></div>
        </li>
        <?php
    //}

    //if(!empty($general['Charge_IntlCalls']) && $general['Charge_IntlCalls'] > 0){
        ?>
        <li class="row">
            <div class="col-md-8 col-12">International Calls</div>
            <div class="col-md-4 text-right col-12">$<?php //echo number_format($general['Charge_IntlCalls'],2,'.',''); ?></div>
        </li>
        <?php
    //}
?> -->
</div> <!-- end of call details -->

