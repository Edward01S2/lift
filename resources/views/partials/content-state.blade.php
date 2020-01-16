@php
$state = get_field('state');
$sub_args = array(
    'numberposts' => 9,
    'post_type'     => 'story',
    'meta_key'  => 'state',
    'meta_value' => $state['value'],
    'post__not_in' => array( get_the_ID())
);
$subpost = get_posts($sub_args);
$stories = array();
$index = 0;
foreach($subpost as $sub) {
  
  $stories[$index]['id'] = $sub->ID;
  $stories[$index]['company'] = get_field('company', $sub->ID);
  $stories[$index]['img'] = get_the_post_thumbnail_url($sub->ID);
  $stories[$index]['link'] = get_permalink($sub->ID);
  $index ++;
}
@endphp

<section id="story-highlight">
  <div class="container mx-auto py-4 md:py-8">
    <h2 class="text-center font-semibold px-4 text-2xl leading-tight pb-4 md:px-40 md:pb-8 xl:text-3xl">Digitally Empowered Small Businesses in {!! get_field('state')['label'] !!}</h2>
    <div class="flex flex-col md:flex-row md:px-4 xl:px-0">
      <div class="md:w-1/2">
        <div class="relative block w-full h-full">
          <div class="h-68 lg:h-72 xl:h-78">
            <div class="story-gradient"></div>
            <img class="w-full h-full object-cover object-center z-20" src="{!! get_the_post_thumbnail_url() !!}" alt="">
            <p class="absolute bottom-0 left-0 text-white z-30 mx-2 mb-2 text-lg font-semibold xl:text-xl">{!! get_field('company') !!}</p>
          </div>
        </div>
      </div>
      
      <div id="sub-stories" class="md:w-1/2 grid grid-cols-2 gap-4 mt-4 mx-4 grid-rows-3 md:mt-0 md:grid-cols-3 md:mx-0 md:pl-4 lg:h-72 xl:h-78">
        @foreach($stories as $state)
          <a class="relative block w-full h-40 md:h-full lg:h-full transform hover:scale-101" href="{!! $state['link'] !!}" data-id="{!! $state['id'] !!}">
            <div class="story-gradient z-40"></div>
            <img class="w-full h-full absolute object-cover object-center z-20" src="{!! $state['img'] !!}" alt="">
            <p class="text-white absolute bottom-0 left-0 z-30 text-sm leading-tight mx-1 mb-1 font-semibold lg:text-sm xl:text-base xl:mx-2 xl:mb-2">{!! $state['company'] !!}</p>
          </a>
        @endforeach
      </div>
      

    </div>
    <div class="hidden md:flex pt-4">
      @if(get_field('gallery'))
      <div class="md:w-1/2 pl-4 md:pl-4 xl:pl-0">
      @else
      <div class="pl-4 md:pl-4 xl:pl-0">
      @endif
        <h3 class="text-2xl leading-tight font-semibold pb-2 xl:text-3xl">{!! get_the_title() !!}</h3>
        <p class="text-sm xl:text-base">{!! get_field('company') !!}, {!! get_field('location') !!}, {!! get_field('state')['value'] !!}</p>
        <a class="text-l-gray-dark underline hover:text-l-orange text-sm xl:text-base" href="{!! get_field('website') !!}">Website</a>
        <div class="single-state__content mt-4">
          {!! the_content() !!}
        </div>
      </div>
      @if(get_field('gallery'))
      <div class="md:w-1/2">
        <div class="grid grid-cols-2 gap-4 px-4">
          @foreach(get_field('gallery') as $img)
            <a class="transform hover:scale-101" href="{!! $img['url'] !!}">
              <div class="relative w-full h-40">
                <img class="w-full h-full absolute object-cover object-center" src="{!! $img['url'] !!}" alt="" data-lity>
              </div>
            </a>
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </div>
</section>