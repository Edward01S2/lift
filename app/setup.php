<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700&display=swap', false );
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_localize_script( 'sage/main.js', 'ajax_url', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    if (is_page('home')) {
      $default = get_field('default_state');
      $acf_data = array(
        'default_state' => $default,
      );
      wp_localize_script('sage/main.js', 'acf_data', $acf_data);
    }
    
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    //add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});


if( function_exists('acf_add_options_page') ) {
	
	$parent = acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'position'      => '59.1',
        'redirect' 		=> true
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Options',
        'menu_title' 	=> 'Options',
        'parent_slug' 	=> $parent['menu_slug'],
    ) );

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Scripts',
        'menu_title' 	=> 'Scripts',
        'parent_slug' 	=> $parent['menu_slug'],
    ) );

    acf_add_options_sub_page( array(
        'page_title' 	=> 'Event Archive Options',
        'menu_title' 	=> 'Event Options',
        'parent_slug' 	=> 'edit.php?post_type=event',
    ) );
}

if (function_exists('add_filter')) {
/**
 * Set local json save path
 * @param  string $path unmodified local path for acf-json
 * @return string       our modified local path for acf-json
 */
    add_filter('acf/settings/save_json', function ($path) {
    // Set Sage9 friendly path at /theme-directory/resources/assets/acf-json
        $path = get_stylesheet_directory() . '/assets/acf-json';
        // If the directory doesn't exist, create it.
        if (!is_dir($path)) {
            mkdir($path);
        }
        // Always return
        return $path;
    });
    /**
     * Set local json load path
     * @param  string $path unmodified local path for acf-json
     * @return string       our modified local path for acf-json
     */
    add_filter('acf/settings/load_json', function ($paths) {
    // append path
        $paths[] = get_stylesheet_directory() . '/assets/acf-json';
        // return
        return $paths;
    });
  }

add_filter( 'manage_event_posts_columns' , __NAMESPACE__ . '\\cc_event_post_columns' );
function cc_event_post_columns( $columns ) {
  unset( $columns['date'] );
  $columns['event_date'] = 'Date';
  $columns['start_time'] = 'Start Time';
  $columns['end_time'] = 'End Time';
  $columns['date'] = 'Date Published';
  return $columns;
}

add_action( 'manage_event_posts_custom_column' , __NAMESPACE__ . '\\cc_event_posts_custom_column', 10, 2 );
function cc_event_posts_custom_column( $column, $post_id ) {
  switch ( $column ) {
    case 'event_date' :
      echo get_field( 'event_date', $post_id );
      break;
    case 'start_time':
      echo get_field( 'all_day' ) ? 'All Day' : get_field( 'start_time', $post_id );
      break;
    case 'end_time':
      echo get_field( 'all_day' ) ? 'All Day' : get_field( 'end_time', $post_id );
      break;
  }
}

add_filter( 'manage_edit-event_sortable_columns', function ( $columns ) {
    $columns['event_date'] = 'Date';
    return $columns;
  });

add_action( 'pre_get_posts', function ( $query ) {
if( ! is_admin() || ! $query->is_main_query() ) {
    return;
}

if ( 'event_date' === $query->get( 'orderby') ) {
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'event_date' );
}
});
  

add_action( 'gform_pre_submission_4', 'pre_submission_handler' );
function pre_submission_handler( $form ) {
    $_POST['input_13'] = wp_generate_password();
    $_POST['input_12'] = 'Memberships -> 3C';
}

add_action( 'gform_pre_submission_2', 'pre_submission_handler_2' );
function pre_submission_handler_2( $form ) {
    // $_POST['input_17'] = wp_generate_password();
    $_POST['input_5'] = 'Form -> Join LIFT';
}

add_action( 'gform_pre_submission_1', 'pre_submission_handler_1' );
function pre_submission_handler_1( $form ) {
    // $_POST['input_17'] = wp_generate_password();
    $_POST['input_5'] = 'Form -> LIFT Sub';
}