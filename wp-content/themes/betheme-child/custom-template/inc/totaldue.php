<div class="row total-due mx-0">
    <div class="col-md-6 col-6">Total</div>
    <?php if($general['GrandTotal']<0):?>
    <div class="col-md-6 col-6 text-right">-$<?php echo number_format($general['GrandTotal']*-1,2,'.',''); ?></div>
    <?php else:?>
    <div class="col-md-6 col-6 text-right">$<?php echo number_format($general['GrandTotal'],2,'.',''); ?></div>
    <?php endif;?>
</div>
