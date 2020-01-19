<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class PageLiftInAction extends Controller
{
  protected $acf = true;

  public function currentLoop() {
    $args = get_posts([
        'posts_per_page'=>'10',
        'post_type' => 'post',
        'tag' => 'lia'
    ]);

  return array_map(function ($post) {
      return [
          'name' => get_the_title($post->ID),
          'image' => get_the_post_thumbnail_url($post->ID),
          'link' =>  get_permalink($post->ID),
          'content' => wp_trim_words(get_post_field('post_content', $post->ID), 35, '...'),
          'date' => get_the_date('F j, Y', $post->ID),
          'external' => get_field('external_link', $post->ID),
      ];
  }, $args);
    
  }
}
