<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleStates extends Controller
{
  protected $acf = true;

  public function getNews() {
   
    $tag_args = get_posts([
      'posts_per_page'=> 3,
      'post_type' => 'post',
  ]);

    return array_map(function ($post) {
      return [
        'name' => get_the_title($post->ID),
        'image' => get_the_post_thumbnail_url($post->ID),
        'link' => get_permalink($post->ID),
        'content' => wp_trim_words(get_post_field('post_content', $post->ID), 25, '...'),
        'date' => get_the_date('F j, Y', $post->ID)
      ];
    }, $tag_args);  
  }

  public function getState() {

    $state = get_field('state');

    $posts = get_posts( array(
        'numberposts'   => 1,
        //Here we can get more than one post type. Useful to a home page.
        'post_type'     => 'story',
        'meta_key'  => 'state',
        'meta_value' => $state['value'],
    ) );
    
    
    if ( empty( $posts ) ) {
        return null;
    }
    //Format website link
    
    return array_map(function ($post) { 
      $state = get_field('state', $post->ID);
      $args = array(
          'numberposts' => 9,
          'post_type'     => 'story',
          'meta_key'  => 'state',
          'meta_value' => $state['value'],
          'post__not_in' => array( $post->ID )
      );
      $subpost = get_posts($args);
      $stories = array();
      $index = 0;
      foreach($subpost as $sub) {
        
        $stories[$index]['id'] = $sub->ID;
        $stories[$index]['company'] = get_field('company', $sub->ID);
        $stories[$index]['img'] = get_the_post_thumbnail_url($sub->ID);
        $stories[$index]['link'] = get_permalink($sub->ID);
        $index ++;
      }

      return [
        'name' => get_the_title($post->ID),
        'image' => get_the_post_thumbnail_url($post->ID),
        'link' => get_permalink($post->ID),
        'content' => get_post_field('post_content', $post->ID),
        'gallery' => get_field('gallery', $post->ID),
        'company' => get_field('company', $post->ID),
        'location' => get_field('location', $post->ID),
        'website' => get_field('website', $post->ID),
        'state' => get_field('state', $post->ID),
        'stories' => $stories,

      ];
    }, $posts);  
  }
  
}
