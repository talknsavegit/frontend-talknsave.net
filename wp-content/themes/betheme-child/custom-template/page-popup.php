<?php 
    $cartData = WC()->cart; 
    $cart_products = WC()->cart->get_cart();    
?>


<div class="popup-header">
    <h3>Shopping Cart</h3>
</div>
<div class="popup-body">
    <div class="top-items">
        <?php 
            foreach($cart_products as $cart_item_key => $cart_item) {                
                $productId = $cart_item['data']->get_id();
                
                $_product =  wc_get_product( $productId);
                $description = get_post($productId)->post_content; 
                ?>
                    <div class="item">
                        <div class="item-title">
                            <?php echo $_product->get_title(); ?>
                            <div class="option">
                                <a href="#" class="item-option">
                                    <i class="icon-dot-3 rotate"></i>
                                </a>
                                <div class="delete-menu">
                                    <a href="#" class="delete-item" data-product="<?php echo $productId;?>">
                                        <i class="icon-trash-line"></i> Delete
                                    </a>
                                </div>    
                            </div>      
                        </div>
                        <p class="item-desc"><?php echo $description;?></p>
                        <div class="item-footer">
                            <div class="qty">
                                <a class="qty-icon minus" data-cart-key="<?php echo $cart_item_key;?>">-</a>
                                <div class="qty-icon number"><?php echo $cart_item['quantity'];?></div>
                                <a class="qty-icon plus" data-cart-key="<?php echo $cart_item_key;?>">+</a>
                            </div>
                            <div class="amount"><?php echo WC()->cart->get_product_price( $cart_item['data']) ;?></div>
                        </div>
                    </div>
                <?php
                $productids[] = $productId;
            }
        ?>  
    </div>
</div>
<div class="popup-footer">
    <a href="<?php echo site_url('custom-checkout');?>" class="checkout-btn"> Checkout <span class="amount"><?php echo WC()->cart->get_total();?></span></a>
    <!-- <div class="checkout-btn">
        <div class="text">Checkout</div>
        <div class="amount"><?php// echo WC()->cart->get_total();?></div>
    </div> -->
    <p class="continue-shopping">
        <a href="#" class="close-cart-popup">Continue Shopping</a>
    </p>    
    <?php echo do_shortcode('[get_recommended_product product_id="'.end($productids).'"]'); ?>
</div>