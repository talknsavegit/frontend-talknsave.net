<div id="js-hkba-feedback-overview-panel" class="hkba-panel hkb-feedbackbar__block" data-nonce="<?php echo wp_create_nonce('feedbackResponses'); ?>">
    <h2 class="hkb-feedbackbar__title"><span class="hkb-feedbackbar_count">0</span> <?php _e( 'Responses' , 'ht-knowledge-base' ); ?></h2>
    <div class="hkb-feedbackbar">
        <div class="hkb-feedbackbar_good" data-hkb-feedbacknum="" style="width: 50%">&nbsp;</div>
        <div class="hkb-feedbackbar_bad" data-hkb-feedbacknum="" style="width: 50%"> &nbsp;</div>
    </div>
</div>



    <div id="js-hkba-feedbackfilter-control" class="hkb-feedbackfilter" data-filter="all" data-comments="comments">
        <div class="hkb-feedbackfilter__btnlabel"><?php _e( 'Show:' , 'ht-knowledge-base' ); ?></div>
        <div class="hkb-feedbackfilter__btngroup">
            <button class="hkb-feedbackfilter__btn hkb-feedbackfilter__magnitude_btn hkb-feedbackfilter__btn_all active"><?php _e( 'All' , 'ht-knowledge-base' ); ?></button>
            <button class="hkb-feedbackfilter__btn hkb-feedbackfilter__magnitude_btn hkb-feedbackfilter__btn_helpful"><?php _e( 'Helpful' , 'ht-knowledge-base' ); ?></button>
            <button class="hkb-feedbackfilter__btn hkb-feedbackfilter__magnitude_btn hkb-feedbackfilter__btn_unhelpful"><?php _e( 'Unhelpful' , 'ht-knowledge-base' ); ?></button>
        </div>        
    </div>


<div id="js-hkba-feedback-cards-panel" class="hkba-feedbackpanel" data-nonce="<?php echo wp_create_nonce('feedbackCards'); ?>">
    <div class="grid-sizer"></div>
    <div class="gutter-sizer"></div>
</div>

<div class="hkba-pagination" id="hkba-feedback-pagination" data-page="1">
    <button id="hkba-feedback-pagination__prev_a" class="hkba-pagination__prev" data-page-target="0"><?php _e( 'Previous' , 'ht-knowledge-base' ); ?></button>
    <button id="hkba-feedback-pagination__next_a" class="hkba-pagination__next" data-page-target="2"><?php _e( 'Next' , 'ht-knowledge-base' ); ?></button>
</div>