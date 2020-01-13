@extends('layouts.app')

@section('content')

<section id="hero">
  <div class="flex flex-col justify-center md:flex-row">
    <div class="px-4 text-s-dark md:px-0 md:pl-4 md:w-1/2 lg:pl-8">
      <div class="flex flex-col py-10 md:text-left md:items-start md:ml-auto md:w-384 lg:w-512 lg:py-24 xl:w-640 xl:py-40">
        <h1 class="text-2xl text-left font-semibold leading-tight border-l-4 pl-4 py-2 border-l-orange tracking-wider lg:text-4xl xl:text-5xl xl:border-l-8">{!! $line_1 !!}</h1>
        <div class="flex flex-col pt-4 md:flex-row md:items-center lg:pl-3 xl:pl-4">
          <div><a href="{!! $hero_button->url !!}" class="uppercase py-2 px-6 text-black hover:text-l-orange inline-block text-center font-semibold tracking-wide md:text-sm md:px-4 xl:text-base">{!! $hero_button->title !!}</a></div>
          <div class="pt-2 md:pt-0"><a href="{!! $hero_button_2->url !!}" class="uppercase py-2 px-10 bg-l-blue text-white font-semibold hover:bg-l-orange inline-block text-center ml-6 md:text-sm md:px-6 xl:text-base">{!! $hero_button_2->title !!}</a></div>
        </div>
      </div>
    </div>
    <div class="relative md:w-1/2">
      <div class="content-container relative lg:absolute lg:top-0 lg:left-0 w-full h-full z-20 flex flex-col justify-center items-center opacity-99" style="background-image:url({!! $video_poster->url !!}); background-size: cover;">
        <div class="play-container text-center z-30">
          <a href="{!! $video_url !!}" data-lity id="toggle-video" class="cursor-pointer outline-none focus:outline-none bg-l-orange inline-block rounded-full group hover:bg-white">
            <svg class="fill-current text-white h-16 w-16 p-2 pl-3 block cursor-pointer outline-none hover:text-white group-hover:text-l-orange lg:h-20 lg:w-20 xl:h-24 xl:w-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

  <section id="map-container">
    <div class="container mx-auto">
      <div class="flex flex-col justify-center pt-4 md:flex-row md:pt-12 md:pb-4 lg:pt-8 xl:pt-16">
        <div class="order-1 px-4 align-bottom pt-4 md:px-4 md:pl-4 md:w-1/2 md:order-0 md:align-top lg:pl-8">
          <div id="map" style="width: 300px; height: 300px;" class="us-map"></div>
        </div>
        <div class="order-0 md:w-1/2 md:order-1">
          <div class="lg:pr-8">
          {{-- <div id="clicked-state"></div> --}}
            <div class="px-4 md:pl-0">
              <h2 class="text-2xl leading-tight font-semibold md:text-xl lg:text-2xl xl:text-3xl xl:pr-8">{!! $title !!}</h2>
              <div class="py-4">
                <p id="story-subtitle" class="pl-4 py-1 text-lg border-l-4 border-l-orange md:text-sm lg:text-base xl:text-lg"></p>
              </div>
            </div>
            <div id="story-container" class="px-2 pl-0"></div>
            <div class="story-btn p-4 md:p-0">
              <a href="{!! $story_button->url !!}" class="uppercase py-2 px-10 bg-l-blue text-white font-semibold hover:bg-l-orange inline-block text-center tracking-wide md:text-sm md:px-4 lg:text-base lg:px-6 lg:mt-1 xl:text-lg xl:mt-0 xl:px-8">{!! $story_button->title !!}</a>
            </div>
          </div>
        </div>
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

  <section id="home-form" class="xl:py-8">
    <div class="bg-l-blue container mx-auto">
      <div class="flex flex-col text-white text-center py-8 md:flex-row md:text-left md:pl-4 md:items-center lg:px-8">
        <div class="pb-8 md:pb-0 md:w-1/3">
          <h3 class="font-semibold text-3xl tracking-wider md:text-lg lg:text-xl xl:text-2xl">{!! $options_page->options['form_1_text'] !!}</h3>
          <p class="tracking-widest text-lg md:text-xs xl:text-base">{!! $options_page->options['form_2_text']  !!}</p>
        </div>
        @php
          gravity_form_enqueue_scripts($form->id, true);
          gravity_form($form->id, false, false, false, '', true, 1);
        @endphp
    </div>
    </div>
  </section>

  <section id="home-about" class="bg-l-gray">
    <div class="container mx-auto">
      <div class="flex flex-col md:flex-row md:py-8 xl:py-12">
        <div class="order-1 pb-4 md:w-1/2 md:order-0 md:flex md:items-center md:pb-0">
          <div class="about-content px-4 lg:px-8 xl:pl-0">
            {!! $about_text !!}
          </div>
        </div>
        <div class="order-0 py-8 md:w-1/2 md:order-1 md:flex md:flex-col md:justify-center md:py-0">
          <img class="w-full h-auto" src ="{!! $about_image->url !!}" alt="{!! $about_image->alt !!}" />
        </div>
      </div>
    </div>
  </section>

  {{-- @debug
  @dump($story_button) --}}

@endsection

