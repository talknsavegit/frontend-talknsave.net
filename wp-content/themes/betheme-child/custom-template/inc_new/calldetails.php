<div class="call-details mb-4">
   <div class="row" id="call_details">
        <div class="col-md-12 col-12">
            <h3>Call Details</h3>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-12 col-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-6 col-12 title pl-0">Call Package<br> (<?php echo $callPkgs['CallPackageDisplayName']; ?>)</div>
                <div class="col-md-3 col-6 pl-0 text-center">Days<br><span class="text-center"> <?php echo $general['Duration']; ?></span></div>
                <div class="col-md-3 col-6 text-right" style="color:#142454;">Cost <br>$<?php echo number_format($calls_amount,2,'.',''); ?><br><?php if($surcharge_amount !=0):?><span style="font-size:12px;">(included $ <?php echo $surcharge_amount;?> Mobile Surcharge )</span><?php endif;?></div>
                <!-- <div class="col-md-3 col-12 text-right" style="color:#142454;">Cost <br>$<?php //echo number_format($callPkgs['MonthlyFee'],2,'.',''); ?></div> -->
            </div>
        </div>
    </div>
    <?php if($outside_call_amount !=0):?>
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-6 col-12 title pl-0">Calls Outside of Package <br></div>
                <div class="col-md-3 col-6 pl-0 text-center"></div>
                <div class="col-md-3 col-6 text-right" style="color:#142454;">$<?php echo number_format($outside_call_amount,2,'.',''); ?></div>
                <!-- <div class="col-md-3 col-12 text-right" style="color:#142454;">Cost <br>$<?php //echo number_format($callPkgs['MonthlyFee'],2,'.',''); ?></div> -->
            </div>
    <?php endif;?>
    
</div> <!-- end of call details -->

