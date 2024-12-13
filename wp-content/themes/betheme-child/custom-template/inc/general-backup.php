<div class="row summary-top">
    <div class="col-md-6 col-12">
        <h2>Service Details</h2>
        <p>For Invoice #<?php echo $general['BillID']; ?> </p>
    </div>
    <div class="col-md-6 col-12 total-due d-flex">
        <div class="col-md-6 col-6">Total Due</div>
        <div class="col-md-6 col-6 text-right">$<?php echo number_format($general['Balance'],2,'.',''); ?></div>
    </div>
</div>