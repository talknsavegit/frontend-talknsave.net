<?php 
$name = array(
    'CCDBT' => 'Credit Card',
    'CASHP' => 'Cash',
    'CHECK' => 'Checks',
    'DPSDD' => 'Deposit Refund',
    'PPCCR' => 'PPCCR',
    'SCHSF' => 'Auto Credit',
    'TNSSF' => 'Auto Credit'
);

?>
<div class="payments mb-4">
    <div class="row">
           <div class="col-md-8 col-12">
                <h3>Payments <span style="font-size:22px;font-weight:500;">( Credit Card #: <?php echo "xxxx-xxxxx-xxxx-".($general['CCNumLFD']); ?> )</span></h3>
            </div>
</div>
<!-- <div class="col-md-3 col-12" style="color:#142454;">Credit Card #: <br> <?php //echo "xxxx-xxxxx-xxxx-".($general['CCNumLFD']); ?></div> -->
<?php if(!isset($payments[0])):?>
    <?php if($payments['PaymentMethodCode'] == "CCDBT"):?>
    <div class="row mt-2">
    <div class="col-md-12 col-12">
        <div class="content d-flex flex-wrap align-items-center">
            <div class="col-md-4 col-12">Date: <br> <?php echo date('d/M/Y',strtotime($payments['EnteredOn'])); ?></div>
            <?php if($payments['Amount']<0):?>
            <div class="col-md-4 col-6 text-center payment_amount">Amount: <br>-$<?php echo number_format($payments['Amount']*-1,2,'.',''); ?></div>
            <?php else:?>
            <div class="col-md-4 col-6 text-center payment_amount">Amount: <br>$<?php echo number_format($payments['Amount'],2,'.',''); ?></div>
            <?php endif;?>
            <div class="col-md-4 col-6 text-right">Type: <br> <?php echo $name[$payments['PaymentMethodCode']]?$name[$payments['PaymentMethodCode']]:'Special Payments'; ?> </div>
        </div>
    </div>
   </div>
   <?php endif; ?>
<?php else: ?>

<!-- displaying table for more than one payments -->
<?php //if(count($payments)>1):?>
    <?php for($i=0; $i<count($payments); $i++):?>
    <?php if($payments[$i]['PaymentMethodCode'] == "CCDBT"):?> 
    <div class="row mt-2">
    <div class="col-md-12 col-12">
        <div class="content d-flex flex-wrap align-items-center">
            <div class="col-md-4 col-12">Date: <br> <?php echo date('d/M/Y',strtotime($payments[$i]['EnteredOn'])); ?></div>
            <?php if($payments[$i]['Amount']<0):?>
            <div class="col-md-4 col-6 text-center payment_amount">Amount: <br>-$<?php echo number_format($payments[$i]['Amount']*-1,2,'.',''); ?></div>
            <?php else:?>
            <div class="col-md-4 col-6 text-center payment_amount">Amount: <br>$<?php echo number_format($payments[$i]['Amount'],2,'.',''); ?></div>
            <?php endif; ?>
            <div class="col-md-4 col-6 text-right">Type: <br> <?php echo $name[$payments[$i]['PaymentMethodCode']]?$name[$payments[$i]['PaymentMethodCode']]:'Special Payments'; ?> </div>
        </div>
    </div>
   </div>
<?php endif; ?>
<?php endfor; ?>
<?php endif; ?>
</div> <!-- end of payments-->
