<div class="call-details mb-4 mt-4">
   <div class="row" id="call_details">
        <div class="col-md-12 col-12">
            <h3>Call Details</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-5 col-12 title pl-0">Call Package<br> (<?php echo $callPkgs['CallPackageDisplayName']; ?>)</div>
                <div class="col-md-1 col-12"></div>
                <div class="col-md-3 col-6 pl-0 text-center">Days<br><span class="text-center"> <?php echo $general['Duration']; ?></span></div>
                <div class="col-md-3 col-6 text-right" style="color:#142454;">Cost <br>$<?php echo number_format($calls_amount,2,'.',''); ?></div>
            </div>
        </div>
    </div>
    <?php 
    if($outside_call_amount != 0){
        ?>
       <div class="row mt-2">
        <div class="col-md-12 col-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-8 col-8 title pl-0"><span class="mt-2">Call Outside Of Package</span></div>
                <div class="col-md-4 col-4 text-right">$<?php echo number_format($outside_call_amount,2,'.',''); ?></div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
     <?php 
    if($unlimited_package_extension_fee != 0){
        ?>
       <div class="row mt-2">
        <div class="col-md-12 col-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-8 col-8 title pl-0"><span class="mt-2">Unlimited Call Package Extension</span></div>
                <div class="col-md-4 col-4 text-right">$<?php echo number_format($unlimited_package_extension_fee,2,'.',''); ?></div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div> <!-- end of call details -->

