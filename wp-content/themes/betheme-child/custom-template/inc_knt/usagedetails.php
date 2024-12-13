<div class="sms mb-4">
  <div class="row">
        <div class="col-md-12 col-12">
            <h3>Usage Details</h3>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="content d-flex flex-wrap align-items-center">
                <?php if($kntdata[0]) { 
                    foreach($kntdata as $key => $knt_data){
                        if($key == 0){ ?>
                            <div class="mb-3 col-md-5 col-12 title pl-0"></div>
                            <div class="mb-3 col-md-2 col-4 text-center"><?= ($knt_data['Unlimited'] == 'true')?'': 'Allowance'?></div>
                            <div class="mb-3 col-md-2 col-4 text-center"><?= ($knt_data['Unlimited'] == 'true')?'': 'Used'?></div>
                            <div class="mb-3 col-md-2 col-4 text-right" style="color:#142454;">Cost</div>
                        <?php }?>  

                        <div class="mb-3 col-md-5 col-12 title pl-0">
                            <?= ($knt_data['ProratedPackageSize']) ? "Stay Local Package" : "KNT Payg";?> - Virtual # <?php echo $knt_data['Virtual']; ?>
                            <br>
                            <?php 
                                if($knt_data['ProratedMonthlyFee']){
                                    echo "(Monthly Fee $".number_format($knt_data['ProratedMonthlyFee'],2,'.','').")";
                                }
                            ?>
                        </div>

                        <?php if($knt_data['Unlimited'] == 'true'){?>
                            <div class="mb-3 col-md-4 col-8 text-center">Unlimited</div>
                        <?php } else { ?>
                            <div class="mb-3 col-md-2 col-4 text-center">
                                <?= ($knt_data['ProratedPackageSize']) ? ($knt_data['ProratedPackageSize']/60) : '' ?>
                            </div>
                            
                            <div class="mb-3 col-md-2 col-4 text-center">
                                <?= ($knt_data['Total_AirTime']/60);?>
                            </div>
                        <?php } ?>

                        <div class="mb-3 col-md-2 col-4 text-right" style="color:#142454;">
                            $<?php echo number_format($knt_data['Total'],2,'.',''); ?>
                        </div>
                        <br>
                    <?php }
                } else { ?>
                    <div class="mb-3 col-md-5 col-12 title pl-0"></div>
                    <div class="mb-3 col-md-2 col-4 text-center"><?= ($kntdata['Unlimited'] == 'true')?'': 'Allowance'?></div>
                    <div class="mb-3 col-md-2 col-4 text-center"><?= ($kntdata['Unlimited'] == 'true')?'': 'Used'?></div>
                    <div class="mb-3 col-md-2 col-4 text-right" style="color:#142454;">Cost</div>

                    <div class="mb-3 col-md-5 col-12 title pl-0">
                        <?= ($kntdata['ProratedPackageSize']) ? "Stay Local Package" : "KNT Payg";?> - Virtual # <?php echo $kntdata['Virtual']; ?>
                        <br>
                        <?php 
                            if($kntdata['ProratedMonthlyFee']){
                                echo "(Monthly Fee $".number_format($kntdata['ProratedMonthlyFee'],2,'.','').")";
                            }
                        ?>
                    </div>
                    <?php if($kntdata['Unlimited'] == 'true'){?>
                        <div class="mb-3 col-md-4 col-8 text-center">Unlimited</div>
                    <?php } else { ?>
                        <div class="mb-3 col-md-2 col-4 text-center">
                            <?= ($kntdata['ProratedPackageSize']) ? ($kntdata['ProratedPackageSize']/60) : '' ?>
                        </div>
                        
                        <div class="mb-3 col-md-2 col-4 text-center">
                            <?= ($kntdata['Total_AirTime']/60);?>
                        </div>
                    <?php } ?>

                    <div class="mb-3 col-md-2 col-4 text-right" style="color:#142454;">
                        $<?php echo number_format($kntdata['Total'],2,'.',''); ?>
                    </div>
                    <br>
                <?php }?>
            </div>
        </div>
    </div>
</div> <!-- end of text details -->

