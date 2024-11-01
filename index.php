<?php
   /*
   Plugin Name: ST Simple Gallery Shortcode
   Plugin URI: http://www.spiritthemes.com/wordpress-plugins/st-simple-gallery-shortcode
   Description: Takes every image attached to your post or page and displays it as a neat masonry grid or carousel gallery, via shortcode
   Version: 1.0.1
   Author: Spirit Themes
   Author URI: http://www.spiritthemes.com
   License: GPL2
   */

/**********************************************************/
/* CREATE THE SHORTCODE FOR THE GRID LAYOUT
/**********************************************************/
function st_gallery_grid($atts, $content = null)
{

    extract(shortcode_atts(array(
        'columns' => 'three',
        'size' => 'medium',
        'orderby' => 'date',
        'order' => 'asc'
    ), $atts));
    
    wp_enqueue_script( 'masonry' );
    wp_enqueue_script( 'grid-js', plugins_url( 'js/grid.js', __FILE__ ), array(), '1.0' );

    $output .= '<div class="gallery grid">';
    
    $args=array( 'orderby'=>$orderby, 'order'=>$order, 'post_type' => 'attachment', 'post_parent' => get_the_ID(), 'post_mime_type' => 'image', 'post_status' => null, 'numberposts' => -1, ); $attachments = get_posts($args); if ($attachments) : foreach ($attachments as $attachment): $src = wp_get_attachment_image_src($attachment->ID, '' . $size . ''); $alt = apply_filters( 'the_title', $attachment->post_title );

    $output .= '<div class="item ' . $columns . '">';
    $output .= '<a href="';
    $output .= $src[0];
    $output .= '">';
    $output .= '<img src="';
    $output .= $src[0];
    $output .= '" />';
    $output .= '</a>';
    $output .= '</div>';
    endforeach;
    endif;
    
    $output .= '</div>';
    
    return $output;
}

add_shortcode('st_gallery_grid', 'st_gallery_grid');

/**********************************************************/
/* CREATE THE SHORTCODE FOR THE CAROUSEL LAYOUT
/**********************************************************/
function st_gallery_carousel($atts, $content = null)
{

    extract(shortcode_atts(array(
        'size' => 'large',
        'orderby' => 'date',
        'order' => 'asc'
    ), $atts));
    
    wp_enqueue_script( 'slick-js', plugins_url( 'js/slick.min.js', __FILE__ ), array(), '1.5.7', true );
    wp_enqueue_script( 'carousel-js', plugins_url( 'js/carousel.js', __FILE__ ), array(), '1.0' );
    wp_enqueue_style( 'slick', plugins_url( 'css/slick.css', __FILE__ ), array(), '1.5.7' );
    wp_enqueue_style( 'font-awesome', plugins_url( 'css/font-awesome.css', __FILE__ ), array(), '4.4.0' );

    $output .= '<div class="gallery carousel">';
    
    $args=array( 'orderby'=>$orderby, 'order'=>$order, 'post_type' => 'attachment', 'post_parent' => get_the_ID(), 'post_mime_type' => 'image', 'post_status' => null, 'numberposts' => -1, ); $attachments = get_posts($args); if ($attachments) : foreach ($attachments as $attachment): $src = wp_get_attachment_image_src($attachment->ID, '' . $size . ''); $alt = apply_filters( 'the_title', $attachment->post_title );

    $output .= '<div class="item">';
    $output .= '<img src="';
    $output .= $src[0];
    $output .= '" />';
    $output .= '</div>';
    endforeach;
    endif;
    
    $output .= '</div>';
    
    return $output;
}

add_shortcode('st_gallery_carousel', 'st_gallery_carousel');

/**********************************************************/
/* ENQUEUE ESSENTIAL SCRIPTS
/**********************************************************/

function st_gallery_scripts() {
	// Load the main stylesheet
	wp_enqueue_style( 'main-style', plugins_url( 'style.css', __FILE__ ), array(), '1.0' );
    // Load Jquery
    wp_enqueue_script( 'jquery' );
    
}

add_action( 'wp_enqueue_scripts', 'st_gallery_scripts' );

?>