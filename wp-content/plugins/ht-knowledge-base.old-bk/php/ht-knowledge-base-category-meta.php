<?php 
/**
* Adds additional meta fields to the ht_kb_category taxonomy
*/

//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'HT_Knowledge_Base_Category_Meta' ) ){
	class HT_Knowledge_Base_Category_Meta {

		//Constructor
		function __construct(){
			//add and edit
			add_action( 'ht_kb_category_add_form_fields', array( $this, 'ht_kb_taxonomy_add_new_meta_field' ), 10, 2 );
			add_action( 'ht_kb_category_edit_form_fields', array( $this, 'ht_kb_taxonomy_edit_meta_field' ), 10, 2 );

			//save
			add_action( 'edited_ht_kb_category', array( $this, 'ht_kb_save_meta' ), 10, 2 );  
			add_action( 'create_ht_kb_category', array( $this, 'ht_kb_save_meta' ), 10, 2 );

			//enqueue scripts
			//add_action( 'ht_kb_category_add_form_fields', array($this, 'ht_kb_taxonomy_add_meta_scripts_and_styles') );
			//add_action( 'ht_kb_category_edit_form_fields', array($this, 'ht_kb_taxonomy_add_meta_scripts_and_styles') );
			//@todo - figure more elagant loading of this - on certain pages and media gallery
			add_action( 'admin_enqueue_scripts', array( $this, 'ht_kb_taxonomy_add_meta_scripts_and_styles' ) );

			//unhook yoast seo description editor
			//@todo - currently unresolved https://github.com/Yoast/wordpress-seo/issues/4814

			//term link filter for custom_link
			//apply_filters( 'term_link', $termlink, $term, $taxonomy );
			add_filter( 'term_link', array( $this, 'ht_kb_category_custom_term_link' ), 10, 3 );
			
		}

		/**
		* Add the meta fields to category creation section
		*/
		function ht_kb_taxonomy_add_new_meta_field() {
			// this will add the custom meta field to the add new term page
			$default_preview = plugins_url( 'img/no-image.png', dirname(__FILE__) );
			?>
			<?php if( apply_filters('ht_kb_category_custom_link', true) ): ?>
				<div class="form-field">
				<p>
					<label for="term_meta[custom_link]" class="meta-row"><?php _e( 'Custom Link', 'ht-knowledge-base' )?></label>
					<input type="text" name="term_meta[custom_link]" id="custom-link" value="" placeholder="" />
				</p>
				<p><?php _e('Set a custom link to override the category archive display (default: leave blank for category archive)', 'ht-knowledge-base'); ?></p>
				</div>
			<?php endif; //ht_kb_category_custom_link ?>
			<?php if( current_theme_supports( 'ht_kb_category_icons' ) || current_theme_supports( 'ht-kb-category-icons' ) ): ?>
				<div class="form-field">
				<p>
					<label for="term_meta[meta_image]" class="meta-row"><?php _e( 'Category Image', 'ht-knowledge-base' )?></label>
					<img src="<?php echo $default_preview; ?>" id="meta-image-preview"  />
					<div id="ht-kb-svg-preview">
						<svg></svg>
					</div>
					<br/>
					<input type="hidden" name="term_meta[meta_image]" id="meta-image" value="" placeholder="<?php _e( 'attachment ID', 'ht-knowledge-base' ); ?>" />
					<input type="hidden" name="term_meta[meta_svg]" id="meta-svg" value="" />
					<input type="hidden" name="term_meta[meta_svg_color]" id="meta-svg-color" value="#d12190" />
					<input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'ht-knowledge-base' ); ?>" />
					<input type="button" id="meta-image-remove" class="button" value="<?php _e( 'Remove Image', 'ht-knowledge-base' )?>" />
				</p>
				</div>
			<?php endif; //theme supports icons ?>
			<?php if( current_theme_supports( 'ht_kb_category_colors' ) ): ?>
				<div class="form-field">
				<p>
					<label for="term_meta[meta_color]" class="meta-row"><?php _e( 'Category Color', 'ht-knowledge-base' )?></label>
					<input type="text" name="term_meta[meta_color]" class="meta-color" value="#000000"  />
				</p>
				</div>
			<?php endif; //theme supports category colors ?>
			<div class="form-field term-parent-wrap">
				<label for="term_meta[restrict_access]" class="meta-row"><?php _e( 'Category Access', 'ht-knowledge-base' )?></label>
				<select class="ht-knowledge-base-cateegory-restrict-access__input" name="term_meta[restrict_access]">
					<?php $valid_restrict_access_levels = apply_filters('hkb_restrict_access_levels', array()); ?>
					<?php foreach ($valid_restrict_access_levels as $level_key => $level_label): ?>
						<option value="<?php echo $level_key; ?>">
							<?php echo $level_label; ?>
						</option>
					<?php endforeach; ?> 
				</select>
				<p><?php _e('Set who can view this knowledge base category', 'ht-knowledge-base'); ?></p>
				<p><?php printf( __('Tip - Current General Knowledge Base Access is set to %s', 'ht-knowledge-base'), hkb_get_restrict_access_level_label_from_key( hkb_restrict_access() ) ); ?></p>
			</div>
		<?php
		}
				
		/**
		* Add the meta fields to category editor screen
		* @param (Object) The WordPress term 
		*/
		function ht_kb_taxonomy_edit_meta_field($term) {
		 
			// put the term ID into a variable
			$t_id = $term->term_id;
		 
			// retrieve the existing value(s) for this meta field. This returns an array
			$term_meta = get_option( "taxonomy_$t_id" );

			$default_preview = plugins_url( 'img/no-image.png', dirname(__FILE__) );

			//get the attachment thumb array
			$attachment_thumb = ( isset ( $term_meta['meta_image'] ) ) ? wp_get_attachment_image_src( $term_meta['meta_image'], 'thumbnail' ) : null ;
			
			$thumbnail_url = ( !empty($attachment_thumb) ) ? $attachment_thumb[0] : $default_preview;

			$cat_svg = ( isset ( $term_meta['meta_svg'] ) ) ?  $term_meta['meta_svg']: null ;

			$cat_color = ( isset ( $term_meta['meta_svg_color'] ) ) ?  $term_meta['meta_svg_color']: null ;

			?>
			<?php if( apply_filters('ht_kb_category_custom_link', true) ): ?>
				<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[custom_link]"><?php _e( 'Custom Link', 'ht-knowledge-base' ); ?></label></th>
					<td>
						<p>
							<input name="term_meta[custom_link]" type="text" value="<?php if ( isset ( $term_meta['custom_link'] ) ) echo $term_meta['custom_link']; ?>" class="custom-link" />
						</p>
						<p class="description"><?php _e('Set a custom link to override the category archive display (default: leave blank for category archive)', 'ht-knowledge-base'); ?></p>
					</td>
				</tr>
			<?php endif; //ht_kb_category_custom_link ?>
			<?php if( current_theme_supports( 'ht_kb_category_icons' ) || current_theme_supports( 'ht-kb-category-icons' ) ): ?>
				<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[meta_image]"><?php _e( 'Category Image', 'ht-knowledge-base' ); ?></label></th>
					<td>
						<img src="<?php echo $thumbnail_url ?>" id="meta-image-preview"  />

						<div id="ht-kb-svg-preview">
							<?php echo stripslashes( $cat_svg ) ; ?>
						</div>
						<br/>

						
						<input type="hidden" name="term_meta[meta_svg]" id="meta-svg" value='<?php echo stripslashes( $cat_svg ); ?>' />
						<input type="hidden" name="term_meta[meta_svg_color]" id="meta-svg-color" value="<?php echo $cat_color; ?>" />
						<input type="hidden" name="term_meta[meta_image]" id="meta-image" value="<?php echo esc_attr( $term_meta['meta_image'] ) ? esc_attr( $term_meta['meta_image'] ) : ''; ?>" />
						<input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'ht-knowledge-base' )?>" />
						<input type="button" id="meta-image-remove" class="button" value="<?php _e( 'Remove Image', 'ht-knowledge-base' )?>" />
						<p class="description"><?php _e( 'This will be displayed in various places in the Knowledge Base','ht-knowledge-base' ); ?></p>
					</td>
				</tr>
			<?php endif; //theme supports icons ?>
			<?php if( current_theme_supports( 'ht_kb_category_colors' ) ): ?>
				<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[meta_color]"><?php _e( 'Category Color', 'ht-knowledge-base' ); ?></label></th>
					<td>
						<p>
							<input name="term_meta[meta_color]" type="text" value="<?php if ( isset ( $term_meta['meta_color'] ) ) echo $term_meta['meta_color']; ?>" class="meta-color" />
						</p>
					</td>
				</tr>
			<?php endif; //theme supports colors ?>

			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[restrict_access]"><?php _e( 'Category Access', 'ht-knowledge-base' ); ?></label></th>
				<td>
					<select class="ht-knowledge-base-cateegory-restrict-access__input" name="term_meta[restrict_access]">
						<?php $valid_restrict_access_levels = apply_filters('hkb_restrict_access_levels', array()); ?>
						<?php foreach ($valid_restrict_access_levels as $level_key => $level_label): ?>
							<option value="<?php echo $level_key; ?>" <?php if( isset( $term_meta['restrict_access'] ) ) selected( $term_meta['restrict_access'], $level_key, true); ?> >
								<?php echo $level_label; ?>
							</option>
						<?php endforeach; ?> 
					</select>
					<p class="description"><?php _e( 'This will restrict access to this category','ht-knowledge-base' ); ?></p>
					<p class="description"><?php printf( __('Tip - Current General Knowledge Base Access is set to %s', 'ht-knowledge-base'), hkb_get_restrict_access_level_label_from_key( hkb_restrict_access() ) ); ?></p>
				</td>
			</tr>
		<?php
		}

		/**
		* Enqueue the javascript and styles for category meta functionality
		*/
		function ht_kb_taxonomy_add_meta_scripts_and_styles(){
			//$screen = get_current_screen();

			$default_preview = plugins_url( 'img/no-image.png', dirname(__FILE__) );
			
			wp_enqueue_media();

			$ajax_error_string = __('Error saving orders', 'ht-knowledge-base');
			wp_enqueue_style( 'wp-color-picker' );
			$hkb_admin_category_meta_js_src = (HKB_DEBUG_SCRIPTS) ? 'js/hkb-admin-category-meta-js.js' : 'js/hkb-admin-category-meta-js.min.js';
			wp_enqueue_script( 'ht-kb-category-meta-script', plugins_url( $hkb_admin_category_meta_js_src, dirname(__FILE__) ), array( 'jquery', 'wp-color-picker' ), 1.0, true );	
			wp_localize_script( 'ht-kb-category-meta-script', 'meta_image',
									array(
										'title' => __( 'Choose or Upload an Image', 'ht-knowledge-base' ),
										'button' => __( 'Use this image', 'ht-knowledge-base' ),
										'no_image' => $default_preview,
										'activate_tab_text' => __( 'Knowledge Base Icon', 'ht-knowledge-base' ),
										)
								);	
		}

		/**
		* Update the category meta on save
		* @param (Int) $term_id The term ID
		*/
		function ht_kb_save_meta( $term_id ) {
			if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_$t_id" );
				$cat_keys = array_keys( $_POST['term_meta'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['term_meta'][$key] ) ) {
						$term_meta[$key] = $_POST['term_meta'][$key];
					}
				}
				//save the options array
				update_option( "taxonomy_$t_id", $term_meta );
			}
		}

		/**
		* Filter term_link to return the custom_link for the category if set
		* @param (String) $termlink The term link to be filtered
		* @param (Object) $term The term object
		* @param (String) $taxonomy The taxonomy
		* @return (String) The filtered termlink
		*/
		function ht_kb_category_custom_term_link( $termlink, $term, $taxonomy ){
			//only apply to ht_kb_taxonomy
			if( empty($taxonomy) || 'ht_kb_category' != $taxonomy ){
				return $termlink;
			}

			//only apply when enabled
			if( !apply_filters('ht_kb_category_custom_link', true) ){
				return $termlink;
			}

			//get any category custom link
			$custom_link = hkb_get_category_custom_link( $term );

			if( !empty( $custom_link ) ){
				//if using a custom link, set the termlink to custom_link
				$termlink = $custom_link;
			}

			return $termlink;			
		}  

	} //end class
} //end class exists

//run the module
if( class_exists( 'HT_Knowledge_Base_Category_Meta' ) ){
	$ht_knowledge_base_category_order = new HT_Knowledge_Base_Category_Meta();
}