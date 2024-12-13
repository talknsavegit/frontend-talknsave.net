<div class="payments mb-4">
    <div class="row" id="other_fees">
        <div class="col-md-12 col-12">
            <h3>Other Fees Details</h3>
        </div>
    </div>
   
    <!-- if oneTimeFees has only single data -->
    <?php if(!isset($oneTimeFees[0])):?>
        <?php if($oneTimeFees['Amount'] !=0):?>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="content d-flex flex-wrap align-items-center">
                            <div class="col-md-8 col-8 title pl-0"><?php echo $oneTimeFees['OnceFeeName']?></div>
                            <?php if($oneTimeFees['Amount']<0):?>
                            <div class="col-md-4 text-right col-4" style="color:#142454;">-$<?php echo number_format($oneTimeFees['Amount']*-1,2,'.',''); ?></div>
                            <?php else: ?>
                            <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($oneTimeFees['Amount'],2,'.',''); ?></div>
                            <?php endif; ?>
                    </div>
                </div>
            </div> 
        <?php endif;?>
    <?php else:?> 
        <!-- if oneTimeFees has multiple data -->
        <?php for($i=0; $i<count($oneTimeFees); $i++):?>
            <?php if($oneTimeFees[$i]['OnceFeeName'] != "Accessories" && $oneTimeFees[$i]['ChargeVAT'] =="true"  && $oneTimeFees[$i]['Amount'] !=0 && $oneTimeFees[$i]['OnceFeeName'] != "Call Package"):?>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="content d-flex flex-wrap align-items-center">
                                <div class="col-md-8 col-8 title pl-0"><?php echo $oneTimeFees[$i]['OnceFeeName']?></div>
                                <?php if($oneTimeFees[$i]['Amount']<0):?>
                                    <div class="col-md-4 text-right col-4" style="color:#142454;">-$<?php echo number_format($oneTimeFees[$i]['Amount']*-1,2,'.',''); ?></div>
                                <?php else: ?>
                                    <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($oneTimeFees[$i]['Amount'],2,'.',''); ?></div>
                                <?php endif; ?>
                        </div>
                    </div>
                </div> 

            <?php endif;?>
        <?php endfor;?> 
    <?php endif;?> 
</div>
<!-- end of text details -->
<?php 
$nonVatfee = 0;
// Iterate through the array
foreach ($oneTimeFees as $fee) {
    // Check if the 'value' property is true
    if ($fee['OnceFeeName'] != "Accessories" && $fee['Amount'] !=0 && $fee['ChargeVAT'] === "false" && $fee['OnceFeeName'] != "Call Package") {
        $nonVatfee++;
    }
}

if ($nonVatfee > 0): ?>
    <div class="payments mb-4">
        <div class="row" id="notvat_fees">
            <div class="col-md-12 col-12">
                <h3>Non-Vattable Other Fees</h3>
            </div>
        </div>
        <?php
            foreach ($oneTimeFees as $fee) {
                if($fee['OnceFeeName'] != "Accessories" && $fee['Amount'] !=0 && $fee['ChargeVAT'] === "false" && $fee['OnceFeeName'] != "Call Package"):?>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="content d-flex flex-wrap align-items-center">
                                    <div class="col-md-8 col-8 title pl-0"><?php echo $fee['OnceFeeName']?></div>
                                    <?php if($fee['Amount']<0):?>
                                        <div class="col-md-4 text-right col-4" style="color:#142454;">-$<?php echo number_format($fee['Amount']*-1,2,'.',''); ?></div>
                                    <?php else: ?>
                                        <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($fee['Amount'],2,'.',''); ?></div>
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div> 
                <?php endif;
            }
        ?>
    </div>
    
<?php endif; ?>

