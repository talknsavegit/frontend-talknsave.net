<div class="mb-4">
    <div class="row" style="margin-bottom:-10px;" id="other_fees">
        <div class="col-md-12 col-12">
            <h3>Other Fees Details</h3>
        </div>
    </div>
    <!-- displaying other fee details fees -->
    <?php if($local_signup_fee !=0):?>
        <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">  
                <div class="col-md-8 col-8 title pl-0">Stay Local Signup Fee</div>
                <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($local_signup_fee,2,'.',''); ?></div>
            </div>
        </div>
    </div> 
    <?php endif;?>

    <?php if($cancle_amount !=0):?>
        <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">  
                <div class="col-md-8 col-8 title pl-0">Cancel Fee</div>
                <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($cancle_amount,2,'.',''); ?></div>
            </div>
        </div>
    </div> 
    <?php endif;?>

    <?php if($unlimited_package_extension_fee !=0):?>
        <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">  
                <div class="col-md-8 col-8 title pl-0">Unlimited Call Package Extension</div>
                <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($unlimited_package_extension_fee,2,'.',''); ?></div>
            </div>
        </div>
    </div> 
    <?php endif;?>

    <?php if($sim_replacement_fee !=0):?>
        <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">  
                <div class="col-md-8 col-8 title pl-0">Sim Replacement Fee</div>
                <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($sim_replacement_fee,2,'.',''); ?></div>
            </div>
        </div>
    </div> 
    <?php endif;?>
    <?php if($setup_fee !=0):?>
        <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">  
                <div class="col-md-8 col-8 title pl-0">Setup Fee</div>
                <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($setup_fee,2,'.',''); ?></div>
            </div>
        </div>
    </div> 
    <?php endif;?>
    <?php if($fixed_rental_fee !=0):?>
        <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">  
                <div class="col-md-8 col-8 title pl-0">Fixed Rental Fee</div>
                <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($fixed_rental_fee,2,'.',''); ?></div>
            </div>
        </div>
    </div> 
    <?php endif;?>
    <?php if($credit_on_previous_invoice !=0 && $sim_replacement_fee == 0 ):?>
        <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">
                <?php 
                $otherfee= number_format($credit_on_previous_invoice,2,'.','');
                    if($otherfee<0){ ?>
                        <div class="col-md-8 col-8 title pl-0">Credit On Previous Invoice</div>
                        <?php $other= $otherfee *-1; ?>
                            <div class="col-md-4 text-right col-4" style="color:#142454;">-$<?php echo number_format($other,2,'.',''); ?></div>
                    <?php }else{ ?>
                            <div class="col-md-8 col-8 title pl-0">Cancel Fee</div>
                            <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($otherfee,2,'.',''); ?></div>
                    <?php } ?>
                    
            </div>
        </div>
    </div> 
    <?php endif;?>
</div> <!-- end of text details -->
