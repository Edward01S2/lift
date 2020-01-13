@php $state = get_field('state') @endphp
<a class="story-box col-span-1 relative overflow-hidden" href="{!! get_post_permalink()!!}">
  <img class="story-box-image absolute w-full h-full object-cover object-center z-0" src="{!! get_the_post_thumbnail_url() !!}" alt="">
  <div class="story-gradient"></div>
  <div class="absolute bottom-0 m-4 text-white z-20">
    <div class="flex items-center">
      <span><svg class="h-4 w-4 text-l-orange fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
      <p class="text-l-peach font-semibold">{!! $state['label']!!}</p>
    </div>
    <p class="font-semibold">{!! get_the_title() !!}</p>
  </div>
</a>