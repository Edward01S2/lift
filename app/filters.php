<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

//Add acf data to story post type
// add_filter('rest_prepare_story', function($data, $post, $request) {
//     $_data = $data->data;    
//     $fields = get_fields($post->ID);
//     foreach ($fields as $key => $value){    
//         $_data[$key] = get_field($key, $post->ID); 
//     }
//     $data->data = $_data;
//     return $data;
// });

function story_endpoint() {
    //echo $_POST['state'];
    // echo 'got here';
    if($_POST['state'] === 'all') {
      $posts = get_posts( array(
        'post_type' => 'story',
        'numberposts'=> '-1',
    ) );
    }
    else {
      $num = $_POST['count'];
      $state_url = $_POST['state'];
      $posts = get_posts( array(
          'numberposts'   => $num,
          //Here we can get more than one post type. Useful to a home page.
          'post_type'     => 'story',
          'meta_key'  => 'state',
          'meta_value' => $state_url,
      ) );
    }
    
    if ( empty( $posts ) ) {
        return null;
    }

    
    $val = array();    
    $count = 0;
    foreach ( $posts as $post ) {
      
      //Get informations that is not avaible in get_post() function and store it in variables.\
      $name = get_the_title($post->ID);
      $state = get_field('state', $post->ID);
      $img_large = get_the_post_thumbnail_url( $post->ID, 'large' );           // Large resolution (default 640px x 640px max)
      $link = get_post_permalink($post->ID);

      $val[$count]['img'] = $img_large;
      $val[$count]['link'] = $link;
      $val[$count]['name'] = $name;  
      $val[$count]['state'] = $state;  
      $count ++;
    }
    echo json_encode($val);
    //return $data['state'];
    
  die();
}

add_action('wp_ajax_story_endpoint', __NAMESPACE__ . '\\story_endpoint');
add_action('wp_ajax_nopriv_story_endpoint', __NAMESPACE__ . '\\story_endpoint');

//wp-json/wpc/v1/story-home/?state-abbreviation
// add_action( 'rest_api_init', function () {
//   register_rest_route( 'wpc/v1', '/story/', 
//     array(
//         'methods' => 'GET',
//         'callback' => __NAMESPACE__ . '\\story_endpoint',
//     ) 
//   );
// } );

function event_endpoint () {
  $args = array(
    'post_type' => 'event',
    'posts_per_page'=> '-1',
    'order' => 'DESC',
    'orderby' => 'meta_value_num',
    'meta_key' => 'event_date',
    'suppress_filters' => true,
    'meta_query' => array (
      array (
        'key' => 'event_date',
        'value' => date('Ymd'),
        'type' => 'DATE',
        'compare' => '<'
      )
    )
  );
  remove_all_filters('posts_orderby');
  $posts = new \WP_Query( $args );
  //return $posts;
  // if ( empty( $posts ) ) {
  //     return null;
  // }
  
  $val = array();    
  //return 'Got Here';
  $index = 0;
  if ( $posts->have_posts() ) {
    while ( $posts->have_posts() ) : $posts->the_post(); 
    
    // //   //Get informations that is not avaible in get_post() function and store it in variables.\
    // //   //$state = get_field('state', $post->ID);
      $id = get_the_ID();
      //$val[$id]['id'] = $id;

      $name = get_the_title();
      $image = get_the_post_thumbnail_url();
      $link = get_permalink();
      $date = get_field('event_date');
      $day = date('M', strtotime( $date ));
      $month = date('d', strtotime( $date ));
      $start = get_field('start_time');
      $end = get_field('end_time');
      $location = get_field('location');
      $address = get_field('address');

      $val[$index]['name'] = $name;
      $val[$index]['image'] = $image;
      $val[$index]['link'] = $link; 
      $val[$index]['date'] = $date;
      $val[$index]['day'] = $day; 
      $val[$index]['month'] = $month;  
      $val[$index]['start'] = $start; 
      $val[$index]['end'] = $end; 
      $val[$index]['location'] = $location; 
      $val[$index]['address'] = $address;  
      $index ++;
    endwhile;
  echo json_encode($val);
  // //return $data['state'];
  }
  else {
    return null;
  }

  wp_reset_query();
    
  die();
}

add_action('wp_ajax_event_endpoint', __NAMESPACE__ . '\\event_endpoint');
add_action('wp_ajax_nopriv_event_endpoint', __NAMESPACE__ . '\\event_endpoint');

//wp-json/wpc/v1/event/?2
// add_action( 'rest_api_init', function () {
// register_rest_route( 'wpc/v1', 
//   '/event/(?P<count>\d+)', 
//   array(
//       'methods' => 'GET',
//       'callback' => __NAMESPACE__ . '\\event_endpoint',
//   ) 
// );
// } );

function post_endpoint () {

  if(isset($_POST['offset'])) {
    $offset = $_POST['offset'];
  }
  if(isset($_POST['count'])) {
    $count = $_POST['count'];
  }

  $query_args = array(
      'numberposts'   => $count,
      //Here we can get more than one post type. Useful to a home page.
      'post_type'     => 'post',
      'offset'=> $offset,
  );

  if(isset($_POST['tag'])) {
    $query_args['tag'] = $_POST['tag'];
  } 

  if(isset($_POST['cat'])) {
    $query_args['category_name'] = $_POST['cat'];
  } 

  $query = new \WP_Query($query_args);
  //return($query);
  
  if(isset($_POST['trim'])) {
    $trim = $_POST['trim'];
  }   

  
  $val = array();
  
  $index = 0;
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) : $query->the_post(); 
  // $count = 0;
  // foreach ( $posts as $post ) {
    
  //   //Get informations that is not avaible in get_post() function and store it in variables.\
    $name = get_the_title();
    $img = get_the_post_thumbnail_url();           // Large resolution (default 640px x 640px max)
    $link = get_post_permalink();
    $content = wp_trim_words(get_post_field('post_content'), $trim, '...');
    $date = get_the_date('F d, Y');
    $external = get_field('external_link');

    $val[$index]['img'] = $img;
    $val[$index]['link'] = $link;
    $val[$index]['name'] = $name;  
    $val[$index]['content'] = $content;
    $val[$index]['date'] = $date;  
    $val[$index]['external'] = $external;  
    $index ++;
  // }
  // return $val;
  //return $data['state'];
  endwhile;
  echo json_encode($val);
// //return $data['state'];
  }
  else {
    return null;
  }

  wp_reset_query();
    
  die();
}

add_action('wp_ajax_post_endpoint', __NAMESPACE__ . '\\post_endpoint');
add_action('wp_ajax_nopriv_post_endpoint', __NAMESPACE__ . '\\post_endpoint');

// //wp-json/wpc/v1/story-home/?state-abbreviation
// add_action( 'rest_api_init', function () {
// register_rest_route( 'wpc/v1', '/posts/', 
//   array(
//       'methods' => 'GET',
//       'callback' => __NAMESPACE__ . '\\post_endpoint',
//   ) 
// );
// } );

function search_stories(){
    //$search = sanitize_text_field( $_POST[ 'search_string' ] );
    $search = isset($_POST['search_string']) ? $_POST['search_string'] : 0;
    //$multi = preg_replace('/\s+/', '+', $search);
    //echo $search;
    $args = array(
        'post_type' => 'story',
        'posts_per_page' => -1,
        's' => $search
    );
    
    //echo $search;
    $wp_query = new \WP_Query();
    $wp_query->parse_query($args);
    relevanssi_do_query($wp_query);

    // echo $wp_query;

    if( $wp_query->have_posts() ) {
      while( $wp_query->have_posts() ) : $wp_query->the_post();

      echo \App\template(locate_template('views/partials/content-story-box'));
      /* end loop */
      endwhile;
    } 
    else {
      echo '<div class="story-none text-center text-xl py-4 text-l-blue md:text-2xl md:col-span-3 lg:col-span-4">Sorry. No results found.</div>';
    } 
    wp_reset_query();
    
    die();
    
}

add_action('wp_ajax_search_stories', __NAMESPACE__ . '\\search_stories');
add_action('wp_ajax_nopriv_search_stories', __NAMESPACE__ . '\\search_stories');


function my_theme_doctors_menu_filter( $items, $menu, $args ) {
  $child_items = array(); // here, we will add all items for the single posts
  $menu_order = count($items); // this is required, to make sure it doesn't push out other menu items
  $parent_item_id = 0; // we will use this variable to identify the parent menu item
  $rand_id = 999923;

  //First, we loop through all menu items to find the one we want to be the parent of the sub-menu with all the posts.
  foreach ( $items as $item ) {
    if ( in_array('parent-stories', $item->classes) ){
        $parent_item_id = $item->ID;
    }
  }

  if($parent_item_id > 0){

      foreach ( get_posts( 'post_type=states&numberposts=-1&orderby=title&order=ASC' ) as $post ) {
        $post->menu_item_parent = $parent_item_id;
        $post->post_type = 'nav_menu_item';
        $post->object = 'custom';
        $post->type = 'custom';
        $post->menu_order = ++$menu_order;
        $post->title = $post->post_title;
        $post->url = get_permalink( $post->ID );
        $post->ID = 0;
        $post->db_id = 0;
        $post->object_id = 0;
        $post->classes = array();
        $post->xfn = '';
        $post->target = '';
        $post->attr_title = '';
        $post->description = '';
        array_push($child_items, $post);
      }

  }

  return array_merge( $items, $child_items );
}

add_filter( 'wp_get_nav_menu_items', __NAMESPACE__ . '\\my_theme_doctors_menu_filter', 10, 3 );

function get_story(){

  $id = isset($_POST['post_id']) ? $_POST['post_id'] : 0;

  $args = array(
    'p' => $id,
  );
  
  //echo $search;
  $wp_query = new \WP_Query();
  $wp_query->parse_query($args);
  relevanssi_do_query($wp_query);

  // echo $wp_query;

  if( $wp_query->have_posts() ) {
    while( $wp_query->have_posts() ) : $wp_query->the_post();

    echo \App\template(locate_template('views/partials/content-state'));
    /* end loop */
    endwhile;
  } 
  wp_reset_query();
  
  die();
  
}

add_action('wp_ajax_get_story', __NAMESPACE__ . '\\get_story');
add_action('wp_ajax_nopriv_get_story', __NAMESPACE__ . '\\get_story');