<div class="call-details sms mb-4">
  <div class="row">
        <div class="col-md-12 col-12">
            <h3>Text Messaging Details</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">
                <div class="col-md-8 col-12 title pl-0">Text Package<br> (<?php echo $smsPkgs['SMSPackageDisplayName']; ?>)</div>
                <div class="col-md-4 col-12 text-right">$<?php echo number_format($smsPkgs['TotalCharge'],2,'.',''); ?></div>
            </div>
        </div>
    </div>
</div> <!-- end of text details -->

