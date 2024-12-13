<?php
/**
* Template helper functions
*/

//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if(!function_exists('hkb_category_thumb_img')){
    /**
    * Print the category thumb img
    * @param (Object) $category The category (not required)
    */
    function hkb_category_thumb_img($category=null){  
        $category_thumb_att_id  =  hkb_get_category_thumb_att_id($category);
        if( !empty( $category_thumb_att_id ) && $category_thumb_att_id!=0 ){
            $category_thumb_obj = wp_get_attachment_image_src( $category_thumb_att_id, 'hkb-thumb');                                
            $category_thumb_src = $category_thumb_obj[0];
            $alt = hkb_get_term_name();

            echo '<img src="' . $category_thumb_src . '" class="hkb-category__icon" alt="' . $alt . '" />';
        }

        $category_thumb_svg  =  hkb_get_category_thumb_svg($category);
        if( !empty( $category_thumb_svg ) && $category_thumb_svg!='' ){           
            //svg
            //does the theme control the size, positioning etc?
            echo stripslashes( $category_thumb_svg );
        }
    }
}


//if(!function_exists('hkb_category_thumb_img')){
//    /**
//    * Print the category thumb img
//    * @param (Object) $category The category (not required)
//    */
//    function hkb_category_thumb_img($category=null){  
//        $category_thumb_att_id  =  hkb_get_category_thumb_att_id($category);
//        if( !empty( $category_thumb_att_id ) && $category_thumb_att_id!=0 ){
//            $category_thumb_obj = wp_get_attachment_image_src( $category_thumb_att_id, 'hkb-thumb');                                
//            $category_thumb_src = $category_thumb_obj[0];
//            $alt = hkb_get_term_name();
//
//            echo '<img src="' . $category_thumb_src . '" class="hkb-category__icon" alt="' . $alt . '" />';
//        }
//    }
//}

if(!function_exists('hkb_category_class')){
    /**
    * Print the category class
    * @param (Object) $category The category (not required)
    */
    function hkb_category_class($category=null){
        $ht_kb_category_class = "hkb-category-hasicon";

        $category_thumb_att_id  =  hkb_get_category_thumb_att_id($category);
        if( !empty( $category_thumb_att_id ) && $category_thumb_att_id!=0 ){
            $ht_kb_category_class = "hkb-category-hasthumb";
        }

        echo $ht_kb_category_class;
    }
}

if(!function_exists('hkb_has_category_custom_icon')){
    /**
    * Print the category custom icon true/false (extended for SVG)
    * @param (Object) $category The category (not required)
    */
    function hkb_has_category_custom_icon($category=null){
        $data_ht_category_custom_icon = false;

        //category thumb attachment
        $category_thumb_att_id  =  hkb_get_category_thumb_att_id($category);
        if( !empty( $category_thumb_att_id ) && $category_thumb_att_id!=0 ){
            $data_ht_category_custom_icon = true;
        }

        //category thumb svg
        $category_thumb_svg = hkb_get_category_thumb_svg($category);
        if( !empty( $category_thumb_svg ) && $category_thumb_svg!='' ){
            $data_ht_category_custom_icon = true;
        }

        return $data_ht_category_custom_icon;
    }
}


//if(!function_exists('hkb_has_category_custom_icon')){
//    /**
//    * Print the category custom icon true/false
//    * @param (Object) $category The category (not required)
//    */
//    function hkb_has_category_custom_icon($category=null){
//        $data_ht_category_custom_icon = false;
//
//        $category_thumb_att_id  =  hkb_get_category_thumb_att_id($category);
//        if( !empty( $category_thumb_att_id ) && $category_thumb_att_id!=0 ){
//            $data_ht_category_custom_icon = true;
//        }
//
//        return $data_ht_category_custom_icon;
//    }
//}

if(!function_exists('hkb_term_name')){
    /**
    * Print the term name
    * @param (Object) $category The category (not required)
    */
    function hkb_term_name($category=null){
            echo hkb_get_term_name($category);      
    }
}

if(!function_exists('hkb_get_term_name')){
    /**
    * Return the term name
    * @param (Object) $category The category (not required)
    * @return (String) Term name or empty string
    */
    function hkb_get_term_name($category=null){
        $term = hkb_get_term($category);
        if($term && isset($term->name)){
            return $term->name;
        } else {
            return '';
        }    
    }
}

if(!function_exists('hkb_get_term_desc')){
    /**
    * Return the term description
    * @param (Object) $category The category (not required)
    */
    function hkb_get_term_desc($category=null){
        $hkb_term_desc = '';
        $term = hkb_get_term($category);
        if($term && isset($term->description)){
            $hkb_term_desc = $term->description;
        }
        return $hkb_term_desc;
    }
}
if(!function_exists('hkb_term_desc')){
    /**
    * Print the term description
    * @param (Object) $category The category (not required)
    */
    function hkb_term_desc($category=null){
        echo hkb_get_term_desc($category);
    }
}

if(!function_exists('hkb_get_term_count')){
    /**
    * Return the term count
    * @param (Object) $category The category (not required)
    */
    function hkb_get_term_count($category=null){
        $term = hkb_get_term($category);
        $count = 0;
        $taxonomy = 'ht_kb_category';
        $args = array('child_of' => $term->term_id);
        $count = $term->count;
        $tax_terms = get_terms($taxonomy,$args);
        foreach ($tax_terms as $tax_term) {
            $count +=$tax_term->count;
        }
        return $count;

    }
}

function wp_get_postcount($id) {
    //@todo - implement or remove this function
}

if(!function_exists('hkb_term_count')){
    /**
    * Print the term count
    * @param (Object) $category The category (not required)
    */
    function hkb_term_count($category=null){
        echo hkb_get_term_count( $category );
    }
}

if(!function_exists('hkb_get_related_articles')){
    /**
    * Get related articles
    * @return (Array) An array of posts 
    */
    function hkb_get_related_articles(){
        global $post, $orig_post;
        $related_articles = array();
        
        //check show related option
        if(!hkb_show_related_articles()){
            return $related_articles;
        }

        $orig_post = $post;
        $categories = get_the_terms($post->ID, 'ht_kb_category');

        if ($categories) {  
            $category_ids = array();
            foreach($categories as $individual_category) 
                $category_ids[] = $individual_category->term_id;

            $args=array(
                'post_type' => 'ht_kb',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ht_kb_category',
                        'field' => 'term_id',
                        'terms' => $category_ids
                    )
                ),
                'post__not_in' => array($post->ID),
                'posts_per_page'=> 6, // Number of related posts that will be shown.
                'ignore_sticky_posts'=>1
            );

            $related_articles = new wp_query( $args );

        }
            
         return $related_articles; 
    }
}

if(!function_exists('hkb_after_releated_post_reset')){
    /**
    * Reset afer related articles
    */
    function hkb_after_releated_post_reset(){
        global $post, $orig_post;
        $post = $orig_post;
        wp_reset_postdata(); 
    }
}

if(!function_exists('hkb_post_format_class')){
    /**
    * Print post format class
    * @param (Int) $post_id The post id
    */
    function hkb_post_format_class($post_id=null){
        $post_id = isset($post_id) ? $post_id : get_the_ID();
        //set post format class  
        if ( get_post_format( $post_id )=='video') { 
          $ht_kb_format_class = 'format-video';
        } else {
          $ht_kb_format_class = 'format-standard';
        } 

        echo $ht_kb_format_class;
    }
}

if(!function_exists('hkb_post_type_class')){
    /**
    * Print post type class
    * @param (Int) $post_id The post id
    */
    function hkb_post_type_class($post_id=null){
        $post_id = isset($post_id) ? $post_id : get_the_ID();
        //post type 
        $post_type = get_post_type( $post_id );
        $ht_kb_type_class = 'hkb-post-type-' . $post_type;

        echo $ht_kb_type_class;
    }
}

if(!function_exists('hkb_term_link')){
    /**
    * Print term link
    * @param (Object) $term The term
    * @deprecated - use get_term_link($tax_term, 'ht_kb_category') instead
    */
    function hkb_term_link($term){
        global $wp_query; 
        $term_link = get_term_link( $term );
        $link = is_wp_error( $term_link ) ? '#' : esc_url( $term_link );
        echo $link;
    }
}

if(!function_exists('hkb_get_category_custom_link')){
    /**
    * Get the category custom link
    * @param (Object) $category The category  (not required)
    * @return (String) The category custom link
    */
    function hkb_get_category_custom_link($category=null){
        $term = hkb_get_term($category);
        $term_meta = get_hkb_term_meta($term);
        $category_custom_link = ''; 

        if(is_array($term_meta)&&array_key_exists('custom_link', $term_meta)&&!empty($term_meta['custom_link']))
            $category_custom_link = $term_meta['custom_link'];

        return $category_custom_link;
    }
}

if(!function_exists('hkb_get_category_thumb_att_id')){
    /**
    * Get the category thumb attachment id
    * @param (Object) $category The category (not required)
    * @return (Int) Thumb attachment id
    */
    function hkb_get_category_thumb_att_id($category=null){
        $term = hkb_get_term($category);
        $term_meta = get_hkb_term_meta($term);
        $category_thumb_att_id = 0;

        if(is_array($term_meta)&&array_key_exists('meta_image', $term_meta)&&!empty($term_meta['meta_image']))
            $category_thumb_att_id = $term_meta['meta_image'];

        return $category_thumb_att_id;

    }
}

if(!function_exists('hkb_get_category_thumb_svg')){
    /**
    * Get the category thumb svg
    * @param (Object) $category The category (not required)
    * @return (String) The inline SVG
    */
    function hkb_get_category_thumb_svg($category=null){
        $term = hkb_get_term($category);
        $term_meta = get_hkb_term_meta($term);
        $category_thumb_svg = '';

        if(is_array($term_meta)&&array_key_exists('meta_svg', $term_meta)&&!empty($term_meta['meta_svg']))
            $category_thumb_svg = $term_meta['meta_svg'];

        return $category_thumb_svg;

    }
}

if(!function_exists('hkb_get_category_color')){
    /**
    * Get the category colour
    * @param (Object) $category The category  (not required)
    * @return (String) The category colour
    */
    function hkb_get_category_color($category=null){
        $term = hkb_get_term($category);
        $term_meta = get_hkb_term_meta($term);
        $category_color = '#222'; 

        if(is_array($term_meta)&&array_key_exists('meta_color', $term_meta)&&!empty($term_meta['meta_color']))
            $category_color = $term_meta['meta_color'];

        return $category_color;
    }
}

if(!function_exists('hkb_get_category_restrict_access_level')){
    /**
    * Get the restrict access level
    * @param (Object) $category The category  (not required)
    * @return (String) The category restrict access level
    */
    function hkb_get_category_restrict_access_level($category=null){
        $term = hkb_get_term($category);
        $term_meta = get_hkb_term_meta($term);
        $restrict_access_level = 'public'; 

        if(is_array($term_meta)&&array_key_exists('restrict_access', $term_meta)&&!empty($term_meta['restrict_access']))
            $restrict_access_level = $term_meta['restrict_access'];

        return $restrict_access_level;
    }
}

if(!function_exists('hkb_get_restrict_access_level_label_from_key')){
    /**
    * Get the restrict access level from an access level
    * @param (String) $key Access level key
    * @return (String) The acceess level label
    */
    function hkb_get_restrict_access_level_label_from_key($key=null){
        $label = '';
        $valid_restrict_access_levels = apply_filters( 'hkb_restrict_access_levels', array() );
        if(array_key_exists($key, $valid_restrict_access_levels)){
            $label = $valid_restrict_access_levels[$key];
        }
        return $label;
    }
}


if(!function_exists('get_hkb_term_meta')){
    /**
    * Get term meta
    * @pluggable
    * @param (Object or int) The terms object or term_id
    * @return (Array) The term meta
    */
    function get_hkb_term_meta($term=0){

            //allow term parameter to be overloaded
            if(!is_int($term)){
                $term = hkb_get_term_id($term);
            }
            
            // retrieve the existing value(s) for this meta field. This returns an array
            $term_meta = get_option( 'taxonomy_'.$term);

            return $term_meta;
    }//end function
}//end function exists
