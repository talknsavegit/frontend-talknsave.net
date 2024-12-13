<div class="row total-due mx-0">
    <div class="col-md-6 col-6">Grand Total</div>
    <?php 
            if($invoice_total < 0): ?>
                <div class="col-md-6 col-6 text-right">-$<?php echo $invoice_total*-1; ?></div>
            <?php else: ?> 
                <div class="col-md-6 col-6 text-right">$<?php echo $invoice_total ?></div>
            <?php endif; ?>
    <!-- <div class="col-md-6 col-6 text-right">$<?php //echo number_format($payments[$count]['GrandTotal'],2,'.',''); ?></div> -->
</div>
