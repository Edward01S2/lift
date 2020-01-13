<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class PageStories extends Controller
{
  protected $acf = true;

  public function currentLoop() {
    $stories = get_posts([
        'post_type' => 'story',
        'posts_per_page'=>'-1',
    ]);

    return array_map(function ($post) {
      return [
        'name' => get_the_title($post->ID),
        'image' => get_the_post_thumbnail_url($post->ID),
        'link' => get_permalink($post->ID),
        'state' => get_field('state', $post->ID),
      ];
    }, $stories);
  }

  public function getStates() {
    $stories = get_posts([
      'post_type' => 'story',
      'posts_per_page'=>'-1',
    ]);

    $states = array();
    foreach ($stories as $post) {
      $state = get_field( 'state', $post->ID );
      $states[$state['value']] = $state['label'];
    }
    ksort($states);
    return $states;
  }
}
