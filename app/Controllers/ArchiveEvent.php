<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveEvent extends Controller
{
  protected $acf = true;



  public function currentLoop() {
    $events = get_posts([
        'post_type' => 'event',
        'posts_per_page'=>'-1',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array( array(
          'key' => 'event_date',
          'value' => date( 'c' ),
          'type' => 'DATETIME',
          'compare' => '>=',
        ) ),
    ]);

    return array_map(function ($post) {
      return [
        'name' => get_the_title($post->ID),
        'image' => get_the_post_thumbnail_url($post->ID),
        'link' => get_permalink($post->ID),
        'date' => get_field('event_date', $post->ID),
        'start' => get_field('start_time', $post->ID),
        'end' => get_field('end_time', $post->ID),
        'location' => get_field('location', $post->ID),
        'address' => get_field('address', $post->ID),
      ];
    }, $events);
  }

  // public function trenchLoop() {
  //   $trenches = get_posts([
  //       'post_type' => 'product',
  //       'posts_per_page'=>'-1',
  //       'category_name' => 'trench',
  //       'order' => 'ASC',
  //   ]);

  //   return array_map(function ($post) {
  //     return [
  //       'name' => get_the_title($post->ID),
  //       'image' => get_the_post_thumbnail_url($post->ID),
  //       'link' => get_permalink($post->ID),
  //     ];
  //   }, $trenches);
  // }
}
