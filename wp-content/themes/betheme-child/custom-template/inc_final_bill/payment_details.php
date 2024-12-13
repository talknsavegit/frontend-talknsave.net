<div class="payments">
    <div class="row">
           <div class="col-md-12 col-12">
                <h3>Card Details</h3>
            </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12 col-12" >
        <div class="content d-flex flex-wrap align-items-center">
            <div class="col-md-6 col-4 text-left">End Date: <br> <?php echo date('m/d/Y',strtotime(explode("T",$general['EndDate'])[0])); ?></div>
            <div class="col-md-6 col-8 text-right" style="color:#142454;">Credit Card #: <br> <?php echo "xxxx-xxxxx-xxxx-".($general['CCNumLFD']); ?></div>
        </div>
    </div>
   </div>
   <?php if(count($payments_bills) > 0): ?>
   <div class="row" style="margin-bottom:-10px;">
           <div class="col-md-12 col-12">
                <h3>Payments</h3>
            </div>
    </div>
    <?php for($i=0; $i<count($payments_bills); $i++): ?>
    <?php if($payments_bills[$i]['PaymentMethodCode'] == "CCDBT" || $payments_bills[$i]['PaymentMethodCode'] == "MINOR" || $payments_bills[$i]['PaymentMethodCode'] == "TCSPM"):?>
    <div class="row" style="margin-top:10px;">
        <div class="col-md-12 col-12">
        <div class="content d-flex flex-wrap align-items-center">
            <div class="col-md-3 col-12">Date: <br> <?php $payment_date = $payments_bills[$i]['EnteredOn']; echo date('m/d/Y',strtotime($payment_date)); ?></div>
            <div class="col-md-3 col-12"></div>
            <!-- <div class="col-md-3 col-6" style="color:#142454;">Type: <br> <?php //if(array_key_exists('CCNumLFD',$general)):?>Credit Card <?php //else:?>Others <?php //endif;?></div> -->
            <div class="col-md-3 col-6" style="color:#142454;">Type: <br> <?php if($payments_bills[$i]['PaymentMethodCode'] == "CCDBT"):?>Credit Card <?php else:?>Special Payments <?php endif;?></div>
            <?php if($payments_bills[$i]['Amount']<0):?>
            <div class="col-md-3 col-6 text-right" style="color:#142454;">Amount <br> -$<?php echo number_format($payments_bills[$i]['Amount']*-1,2,'.','');?></div>
            <?php else:?>
            <div class="col-md-3 col-6 text-right" style="color:#142454;">Amount <br> $<?php echo number_format($payments_bills[$i]['Amount'],2,'.','');?></div>
            <?php endif;?>
        </div>
    </div>
    <?php //endif;?>
    </div>
    <?php 
endif;
endfor;
endif;?>
</div> <!-- end of payments-->
