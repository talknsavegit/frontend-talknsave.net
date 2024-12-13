    <li class="row">
        <div class="col-md-8 col-12">Billing Cycle</div>
        <div class="col-md-4 text-right col-12"><?= $kntgeneral['BillingMonth'].'/'.$kntgeneral['BillingYear']?></div>
    </li>

    <li class="row">
        <div class="col-md-8 col-12">Usage</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($kntgeneral['Amount_DirectTotal'], 2, '.', ''); ?></div>
    </li>

    <?php if($kntgeneral["VAT"] != "0.0000" || $kntgeneral["VAT"] != 0){ ?>
    <li class="row">
        <div class="col-md-8 col-12">Total before VAT</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($kntgeneral['TotalBeforeVAT'], 2, '.', ''); ?></div>
    </li>

    <li class="row">
        <div class="col-md-8 col-12">VAT</div>
        <div class="col-md-4 text-right col-12">$<?php echo number_format($kntgeneral['VAT'], 2, '.', ''); ?></div>
    </li>
    <?php } ?>

<?php
?>
<li class="row" style="border-bottom:0px;margin-bottom:-20px;">
    <div class="col-md-8 col-8">Invoice Total</div>
    <?php
    $total = number_format($kntgeneral['Amount_Total'], 2, '.', '');
    if ($total < 0) : ?>
        <div class="col-md-4 col-4 text-right">-$<?php echo $total * -1; ?></div>
    <?php else : ?>
        <div class="col-md-4 col-4 text-right">$<?php echo $total ?></div>
    <?php endif; ?>
</li>