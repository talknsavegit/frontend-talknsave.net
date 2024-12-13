<?php 
    $cartData = WC()->cart; 
    $cart_products = WC()->cart->get_cart();    
?>
<div class="custom-checkout-container">
    <!-- <div class="checkout-header">
        <div class="title">
            Shopping Cart
        </div>
        <div class="help-link">
            <a href="#">
                Customer Support
            </a>
        </div>
    </div> -->
    <div class="checkout-header" >
        <div class="title"> 
        <img src="https://dev.newedgedesign.com/talknsave/wp-content/uploads/2021/05/screenshot_6.png">  Shopping cart 
        </div>
        <div class="help-link">
            <a href="#">
                Customer Support  <i class="icon-help-circled"></i>
            </a>
        </div>
    </div>
    <div class="checkout-mobile-header">
        <div class="back">
        <img src="https://dev.newedgedesign.com/talknsave/wp-content/uploads/2021/05/screenshot_6.png">
        </div>
        <div class="custom-logo">
            Shopping cart
        </div>
        <div class="help-support">
            <a href="#"><i class="icon-call"></i></a>
        </div>
    </div>
    <section>
        <div class="progress" style="margin-left: -30px; margin-right: -30px; ">
            <div class="progress-bar active" style="width:10%" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </section>
    <div class="checkout-content">
        <h3 class="title test_Mak">Your Orders</h3>
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
                                        <i class="icon-cancel"></i>
                                    </a>
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
                }
            ?>  
        </div>
        <a href="<?php echo site_url('custom-checkout');?>" class="checkout-btn"> Checkout <i class="icon-right-thin"></i></a>
    </div>
</div>
