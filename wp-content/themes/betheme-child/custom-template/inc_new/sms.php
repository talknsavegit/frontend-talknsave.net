<div class="call-details sms mb-4">
  <div class="row">
        <div class="col-md-12 col-12">
            <h3>Text Messaging Details</h3>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-5 col-12 title pl-0">Text Package<br> (<?php echo $smsPkgs['SMSPackageDisplayName']; ?>)</div>
                <div class="col-md-1 col-12 "></div>
                <!-- <div class="col-md-2 col-3 text-center">Allowance<br> <?php //echo $smsPkgs['CCPSMSBalance']; ?></div> -->
                <div class="col-md-2 col-4 text-center">Allowance<br> <?php echo "10000"; ?></div>
                
                <div class="col-md-2 col-4 text-center">Used<br>
                <?php 
                echo $sms_monthly_counter;
                ?>
                <?php //if(array_key_exists('MonthlyFeeCounter',$smsPkgs))
                //echo $smsPkgs['MonthlyFeeCounter'];
                //else
                //{
                    //echo "0";
                //}
                
                ?>
                    
                </div>

                <!-- <div class="col-md-2 col-4 text-right" style="color:#142454;">Cost <br>$<?php //echo number_format($smsPkgs['SignupFee'],2,'.',''); ?></div> -->
                <div class="col-md-2 col-4 text-right" style="color:#142454;">Cost <br>$<?php echo number_format($sms_fee,2,'.',''); ?></div>
            </div>
        </div>
    </div>
    <?php if($sms_roaming_amount > 0):?>
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-5 col-12 title pl-0">Text Outside of Package <br></div>
                <div class="col-md-1 col-12"></div>
                <div class="col-md-3 col-6 pl-0 text-center"></div>
                <div class="col-md-3 col-6 text-right" style="color:#142454;">$<?php echo number_format($sms_roaming_amount,2,'.',''); ?></div>
                <!-- <div class="col-md-3 col-12 text-right" style="color:#142454;">Cost <br>$<?php //echo number_format($callPkgs['MonthlyFee'],2,'.',''); ?></div> -->
            </div>
    <?php endif;?>
</div> <!-- end of text details -->

