@extends('layouts.app')

@section('content')


<section id="hero">
  <div class="flex flex-col justify-center md:flex-row">
    <div class="px-4 text-s-dark md:px-0 md:pl-4 md:w-1/2 md:flex md:items-center lg:pl-8 lg:flex lg:items-center">
      <div class="flex flex-col py-10 md:text-left md:ml-auto md:pr-8 md:py-0 md:w-384 lg:pr-16 lg:w-512 lg:py-0 xl:w-640 xl:py-36">
        <h1 class="text-xl text-left font-semibold leading-tight py-2 tracking-wider lg:text-2xl xl:text-3xl">{!! $hero_text !!}</h1>
        <p class="story-subtitle lg:pl-8 lg:pt-4"><span class="pl-4 text-lg xl:text-2xl">{!! $subtitle !!}</span></p>

      </div>
    </div>
    <div class="relative md:w-1/2">
      <div class="content-container relative py-20 w-full h-full z-20 flex flex-col justify-center items-center opacity-99 md:py-24 lg:py-32 xl:py-0" style="background-image:url({!! $video_poster->url !!}); background-size: cover;">
        <div class="play-container text-center z-30">
          <a href="{!! $video_url !!}" data-lity id="toggle-video" class="cursor-pointer outline-none focus:outline-none bg-l-orange inline-block rounded-full group hover:bg-white">
            <svg class="fill-current text-white h-16 w-16 p-2 pl-3 block cursor-pointer outline-none hover:text-white group-hover:text-l-orange lg:h-20 lg:w-20 xl:h-24 xl:w-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="story-seach" class="md:my-8 lg:mx-4">
  <div class="container mx-auto px-4 bg-l-gray">
    <div class="flex flex-col md:items-center md:flex-row md:pb-2 lg:pb-6 lg:pt-4">
      <div class="md:w-1/3 lg:w-1/4">
        <div class="w-full py-4 flex flex-col md:pb-4 lg:py-0 xl:px-4 xl:pr-8">
          <p class="tracking-wide pb-2">STATE</p>
          <div class="select-container relative">
            <select class="w-full state-filter border border-l-peach rounded-none bg-white px-4 py-2 appearance-none text-l-peach tracking-wide cursor-pointer">
              <option value="ALL">All States</option>
              @foreach($get_states as $abbr => $label)
                <option value="{!! $abbr !!}">{!! $label !!}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="md:w-2/3 lg:w-3/4 flex flex-col mb-6 md:mb-0 md:pl-8 xl:pl-0 xl:pr-4">
        <label for="s" class="pb-2">SEARCH</label>
        <div id="search-container" class="relative">
          <form action="/" role="search" method="get" id="searchform">
            <input type="text" id="s" name="s" value="" autocomplete="off" class="px-4 pl-12 py-2 w-full border-l-peach border">
            <button class="absolute left-0 bottom-0 mb-3 ml-3" type="submit" id="searchsubmit">
              <svg class="h-4 w-4 fill-current text-l-orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="stories">
  <div class="container mx-auto p-4 md:pt-0 md:pb-12 xl:px-0">
    <div class="story-box-container grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4 lg:gap-8">
      @foreach($current_loop as $box)
        <a class="story-box col-span-1 relative overflow-hidden transform hover:scale-101" href="{!! $box['link'] !!}">
          <img class="story-box-image absolute w-full h-full object-cover object-center z-0" src="{!! $box['image'] !!}" alt="">
          <div class="story-gradient"></div>
          <div class="absolute bottom-0 m-4 text-white z-20">
            <div class="flex items-center">
              <span><svg class="h-4 w-4 text-l-orange fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
              <p class="text-l-peach font-semibold">{!! $box['state']['label'] !!}</p>
            </div>
            <p class="font-semibold">{!! $box['name'] !!}</p>
          </div>
        </a>
      @endforeach
      
    </div>
  </div>
</section>

<section id="coalition" class="bg-l-gray">
  <div class="container mx-auto py-4 xl:py-12">
    <h2 class="font-semibold text-center text-3xl tracking-wider md:text-2xl xl:text-3xl">Coalition Members</h2>
    <div class="flex flex-wrap items-center justify-center px-4 md:py-4">
      @foreach($options_page->options['members'] as $image)
        <div class="w-1/2 p-2 md:w-1/5">
          <img class="w-full h-auto" src="{!! $image['url']!!}" alt="{!! $image['alt'] !!}" />
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- @debug --}}


@endsection