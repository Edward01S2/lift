<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

add_theme_support( 'post-formats', array( 'link' ) );

add_filter('manage_story_posts_columns', function ($columns) {
    $columns = array(
        'cb'    => '&lt;input type="checkbox" />',
        'title'     => 'Title',
        'state'  => 'State',
        'date'        =>    'Date',
    );
    return $columns;
});

add_action('manage_posts_custom_column', function($column) {
    global $post;
    switch ($column) {
        case 'state':
            echo get_field( "state", $post->ID )['label'];
            break;
        default:
            break;
    }
}, 10, 2);

add_filter( 'manage_edit-story_sortable_columns', function ( $columns ) {
  $columns['state'] = 'state';
  return $columns;
});

add_action( 'pre_get_posts', function ( $query ) {
  if( ! is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( 'state' === $query->get( 'orderby') ) {
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'state' );
  }
});