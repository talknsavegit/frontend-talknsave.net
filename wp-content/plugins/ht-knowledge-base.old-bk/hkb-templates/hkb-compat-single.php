<?php
/**
* Compat template for displaying heroic knowledgebase single item content
*/
// query_posts( $args );
if(class_exists('HT_Knowledge_Base')){
	HT_Knowledge_Base::ht_kb_theme_compat_reset_post();
}

global $wp_query, $post;
setup_postdata($post);
?>

<!-- #ht-kb -->
<div id="hkb" class="hkb-template-single">

<?php hkb_get_template_part('hkb-searchbox', 'single'); ?>

<?php hkb_get_template_part('hkb-breadcrumbs', 'single'); ?>
	<?php  //while ( have_posts() ) : the_post(); ?>

			<div class="hkb-entry-content">
					
					<?php hkb_get_template_part('hkb-entry-content', 'single'); ?>

					<?php hkb_get_template_part('hkb-single-attachments'); ?>

					<?php //hkb_get_template_part('hkb-single-tags'); ?> 

					<?php do_action('ht_kb_end_article'); ?>
					
					<?php hkb_get_template_part('hkb-single-author'); ?>

					<?php hkb_get_template_part('hkb-single-related'); ?>		

			</div>	

	<?php //endwhile; // end of the loop. ?>

</div><!-- /#ht-kb -->

<?php wp_reset_postdata(); // end of the loop. ?>