<div class="row summary-top mx-0">
    <div class="col-md-6 col-12 pl-0">
        <h2>Service Details</h2>
        <p>For Invoice #<?php echo $kntgeneral['BillCode']; ?> </p>
    </div>
    <div class="col-md-6 col-12 total-due d-flex">
        <div class="col-md-6 col-6">Total Invoice</div>
        <?php 
        $total = number_format($kntgeneral['Amount_Total'], 2, '.', '');
            if($total < 0): ?>
                <div class="col-md-6 col-6 text-right">-$<?php echo $total*-1; ?></div>
            <?php else: ?> 
                <div class="col-md-6 col-6 text-right">$<?php echo $total ?></div>
            <?php endif; ?>
    </div>
</div>