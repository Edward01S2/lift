<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Home extends Controller
{
  protected $acf = true;

  public function getCat() {
    if(isset($_GET['cat'])) {
      $slug = $_GET['cat'];
      $name = $_GET['title'];

      return (object) array(
        'name' => $name,
        'slug' => $slug,
      ); 
    }

  }

  public function currentLoop() {

    $args = array([
        'posts_per_page'=>'8',
        'post_type' => 'post'
    ]);

    if(isset($_GET['cat'])) {
      $args['category_name'] = $_GET['cat'];
    } 
    
    $query = new \WP_Query($args);

    $val =  array();
    if($query->have_posts()) {
      while($query->have_posts()) : $query->the_post();
        $index = $query->current_post;

        $name = get_the_title();
        $image = get_the_post_thumbnail_url();
        $link =  get_permalink();
        $content = wp_trim_words(get_post_field('post_content'), 35, '...');
        $date = get_the_date();
        $external = get_field('external_link');

        $val[$index]['name'] = $name;
        $val[$index]['image'] = $image;
        $val[$index]['link'] = $link; 
        $val[$index]['content'] = $content;
        $val[$index]['date'] = $date;
        $val[$index]['external'] = $external;
      
      
    endwhile;
      
      return $val;
      $query->reset_postdata();
    }
    else {
      return null;
    }
      
  }

}
