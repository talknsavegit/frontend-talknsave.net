<div class="row summary-top mx-0">
    <div class="col-md-6 col-12 pl-0">
        <h2>Service Details</h2>
        <p>For Invoice #<?php echo $general['BillID']; ?> </p>
    </div>
    <div class="col-md-6 col-12 total-due d-flex">
        <div class="col-md-6 col-6">Total</div>
        <?php if($general['GrandTotal'] < 0):?>
        <div class="col-md-6 col-6 text-right">-$<?php echo number_format($general['GrandTotal']*-1,2,'.',''); ?></div>
        <?php else: ?>
        <div class="col-md-6 col-6 text-right">$<?php echo number_format($general['GrandTotal'],2,'.',''); ?></div>
        <?php endif;?>
    </div>
</div>