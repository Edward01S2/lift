<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SinglePost extends Controller
{
  protected $acf = true;
  
  function postData() {
    $cat = get_the_category();
    $page_data = array();
    foreach ($cat as $x) {
      array_push($page_data, '<a href="/news/?cat=' . $x->slug . '&title=' . $x->name . '">' . $x->name . '</a>');
    }
    $final = implode(', ', $page_data);

    return (object) array(
      'title' => get_the_title(),
      'img' => get_the_post_thumbnail_url(),
      'date' => get_the_date(),
      'cat' => $final,
      'content' => get_post_field('post_content'),
  );
  }
}
