<div class="row total-due mx-0">
    <div class="col-md-6 col-6">Grand Total</div>
    <?php 
        $total = number_format($kntgeneral['Amount_Total'], 2, '.', '');
            if($total < 0): ?>
                <div class="col-md-6 col-6 text-right">-$<?php echo $total*-1; ?></div>
            <?php else: ?> 
                <div class="col-md-6 col-6 text-right">$<?php echo $total ?></div>
            <?php endif; ?>
    <!-- <div class="col-md-6 col-6 text-right">$<?php //echo number_format($payments[$count]['GrandTotal'],2,'.',''); ?></div> -->
</div>
