<div class="payments mb-4">
   <?php  if($other_amount !=0):?>
    <div class="row" id="other_fees">
        <div class="col-md-12 col-12">
            <h3>Other Fees Details</h3>
        </div>
    </div>

    <?php 
        for($i=0; $i<count($call_details); $i++):?>
            <?php $onetimefees = $call_details[$i]['tblBillsOneTimeFees'];?>
            <?php if($onetimefees[0]):?>
            <?php for($j=0; $j<count($onetimefees); $j++): ?>
                <?php if($onetimefees[$j]['Amount'] !=0): ?> 
                    <?php if($onetimefees[$j]['OnceFeeName'] != "Credit" 
                            && $onetimefees[$j]['OnceFeeName'] != "Rental Fee" 
                            && $onetimefees[$j]['OnceFeeName'] != "Call Package" 
                            && $onetimefees[$j]['OnceFeeName'] != "Accessories" 
                            && $onetimefees[$j]['OnceFeeName'] != "Coupon Credit" 
                            && $onetimefees[$j]['OnceFeeName'] != "SMS Package" 
                            && $onetimefees[$j]['OnceFeeName'] != "Data Package"
                            && $onetimefees[$j]['OnceFeeName'] != "Shipping (Tax Free!)"
                            && $onetimefees[$j]['OnceFeeName'] != "Shipping & Handling from NY"
                            && $onetimefees[$j]['OnceFeeName'] != "Unlimited Call Package Extension"
                            
                            ): ?>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="content d-flex flex-wrap align-items-center">
                        <?php 
                            $amount = $onetimefees[$j]['Amount'];
                            $otherfee= number_format($amount,2,'.','');
                            if($otherfee<0): ?>
                            <div class="col-md-8 col-8 title pl-0"><?php echo $onetimefees[$j]['OnceFeeName']?></div>
                            <?php $other= $otherfee *-1; ?>
                            <div class="col-md-4 text-right col-4" style="color:#142454;">-$<?php echo number_format($other,2,'.',''); ?></div>
                            <?php else: ?>
                            <div class="col-md-8 col-8 title pl-0"><?php echo $onetimefees[$j]['OnceFeeName']?></div>
                            <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($otherfee,2,'.',''); ?></div>
                    <?php endif;?>
                    
            </div>
        </div>
    </div>  
    <?php endif;?>
            <?php endif; ?>
            <?php endfor; ?>
            <?php else: ?>
                <?php if($onetimefees['Amount'] !=0): ?>
                    <?php if($onetimefees['OnceFeeName'] != "Credit" 
                            && $onetimefees['OnceFeeName'] != "Rental Fee" 
                            && $onetimefees['OnceFeeName'] != "Call Package" 
                            && $onetimefees['OnceFeeName'] != "Accessories" 
                            && $onetimefees['OnceFeeName'] != "Coupon Credit" 
                            && $onetimefees['OnceFeeName'] != "SMS Package" 
                            && $onetimefees['OnceFeeName'] != "Data Package"
                            && $onetimefees['OnceFeeName'] != "Shipping (Tax Free!)"
                            && $onetimefees['OnceFeeName'] != "Shipping & Handling from NY"
                            && $onetimefees['OnceFeeName'] != "Unlimited Call Package Extension"
                            ): ?>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="content d-flex flex-wrap align-items-center">
                        <?php 
                            $amount = $onetimefees['Amount'];
                            $otherfee= number_format($amount,2,'.','');
                            if($otherfee<0): ?>
                            <div class="col-md-8 col-8 title pl-0"><?php echo $onetimefees['OnceFeeName']?></div>
                            <?php $other= $otherfee *-1; ?>
                            <div class="col-md-4 text-right col-4" style="color:#142454;">-$<?php echo number_format($other,2,'.',''); ?></div>
                            <?php else: ?>
                            <div class="col-md-8 col-8 title pl-0"><?php echo $onetimefees['OnceFeeName']?></div>
                            <div class="col-md-4 text-right col-4" style="color:#142454;">$<?php echo number_format($otherfee,2,'.',''); ?></div>
                    <?php endif;?>
                </div>
            </div>
        </div> 
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>

    <?php endfor; ?>
    
    
    <?php endif;?>
</div> 
<!-- end of text details -->
