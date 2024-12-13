<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die(_e('You are not allowed to call this page directly.','final-tiles-gallery')); } ?>

<style>
#support-page .main-pic {
    width: 100%;
    margin-bottom:20px;
}
#support-page iframe {
    width: 100%;
    margin-top:20px;
}
h1 .button {
    position: relative;
    top:20px;
}
</style>

<div class="container">        
    <div class="row">
	    <div class="section s12 m12 l12 col" id="support-page">
            <h4 class="center-on-small-only">Try our full featured lightbox:</h4>
            <h1 class="header center-on-small-only">EverlightBox <a target="_blank" class="button" href="https://wordpress.org/plugins/everlightbox/" aria-label="Download EverlightBox" >Download</a></h1>	    
			<a target="_blank" href="https://wordpress.org/plugins/everlightbox/"><img src="<?php echo plugins_url('images', __FILE__) ?>/everlightbox.png" alt="PhotoBlocks preview" class="main-pic"></a>
            <p>EverlightBox is a very fast and safe lightbox for WordPress. It can be used with many WordPress galleries.</p>
            <p><img src="<?php echo plugins_url('images', __FILE__) ?>/everlightbox-reviews.png"></p>            
	    </div>
	</div>
</div>
