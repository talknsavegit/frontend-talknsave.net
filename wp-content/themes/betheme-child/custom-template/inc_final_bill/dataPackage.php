<div class="call-details data mb-4">
    <div class="row">
        <div class="col-md-12 col-12">
            <h3>Data Details</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">
                <?php if($data_package == 0):?>
                <div class="col-md-8 col-8 title pl-0">Data Package<br> (<?php echo $dataPkgs['ExtendedDataPackageName']; ?>)</div>
                <div class="col-md-4 col-4 text-right" style="color:#142454;">$<?php echo number_format($dataPkgs['MonthlyFee'],2,'.',''); ?></div>
                <?php else:?>
                <div class="col-md-8 col-8 title pl-0">Data Package<br> (<?php echo $comment; ?>)</div>
                <div class="col-md-4 col-4 text-right" style="color:#142454;">$<?php echo number_format($data_package,2,'.',''); ?></div>
                <?php endif;?>
            </div>
        </div>
    </div>   
</div> <!-- end of text details -->
