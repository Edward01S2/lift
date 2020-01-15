@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post() @endphp

  <section id="story-hero">
    <div class="relative">
      <div class="single-story__vid-container relative w-full h-full z-20 flex flex-col justify-center items-center opacity-99" style="background-image:url({!! $hero_image->url !!}); background-size: cover;">
        <div class="text-white z-30 text-center py-8 lg:pt-16 xl:pt-32">
          <img class="h-8 w-auto mx-auto mb-4 lg:h-10" src="{{ $options_page->options['logo_alt']['url'] }}" alt="">
          <h2 class="text-4xl font-semibold leading-none px-8 mb-4 md:px-24 lg:text-5xl lg:px-48">{!! App::title() !!}</h2>
          <p class="text-xl font-medium px-12 xl:text-3xl">{!! $company !!}, {!! $location !!}, {!! $state->value !!}</p>
        </div>
        
        <div class="play-container text-center z-30 pb-8 xl:pb-24">
          @if($video)
          <a href="{!! $video !!}" data-lity id="toggle-video" class="cursor-pointer outline-none focus:outline-none bg-l-orange inline-block rounded-full group hover:bg-white">
            <svg class="fill-current text-white h-16 w-16 p-2 pl-3 block cursor-pointer outline-none hover:text-white group-hover:text-l-orange lg:h-20 lg:w-20 xl:h-24 xl:w-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"/></svg>
          </a>
          @endif
        </div>
      </div>
    </div>
  </section>

  <section id="single-story__content">
    <div class="container mx-auto">
      <div class="flex flex-col items-center py-4 md:flex-row md:justify-center md:py-8">
        <a href="/stories" class="flex items-center text-white uppercase font-semibold tracking-wide pb-3 text-sm hover:text-l-orange md:pb-0 md:mr-8">
          <span><svg class="h-4 w-4 fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.828 9l6.071-6.071-1.414-1.414L0 10l.707.707 7.778 7.778 1.414-1.414L3.828 11H20V9H3.828z"/></svg></span>
          <span class="flex items-center">Back to <img class="h-4 w-auto mx-2" src="{{ $options_page->options['logo_alt']['url'] }}">Stories</span>
        </a>
        <a href="#single-story__gallery">
          <span class="flex items-center text-white font-semibold tracking-wide uppercase text-sm hover:text-l-orange"><svg class="h-5 w-5 mr-2 fill-current text-l-orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 6c0-1.1.9-2 2-2h3l2-2h6l2 2h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6zm10 10a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
          Photogallery</span></a>
      </div>
      <div class="text-white px-4 pb-8 pt-4 border-b-2 border-l-teal border-dashed md:px-8 xl:px-0">
        <h2 class="text-2xl text-center font-semibold leading-none mb-2 md:text-3xl lg:px-24 lg:text-5xl">{!! App::title() !!}</h2>
        <p class="text-base text-center font-semibold pb-8 lg:text-lg">{!! $company !!}, {!! $location !!}, {!! $state->value !!}</p>
        <div class="single-story__main-content">
          @php the_content() @endphp
        </div>
      </div>
    </div>

    @if($gallery)
    <div id="single-story__gallery" class="pb-12">
      <div class="container mx-auto">
        <h3 class="text-3xl text-center text-white font-semibold tracking-wide py-8">Photo Gallery</h3>
        <div class="gallery-container grid grid-cols-2 gap-4 px-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 xl:px-0">
        @foreach($gallery as $image)
          <a class="relative overflow-hidden transform hover:scale-101" href="{!! $image->url !!}" style="padding-bottom:100%;">
            <img class="absolute w-full h-full object-cover object-center z-0" src="{!!$image->url !!}" alt="" data-lity>
          </a>
        @endforeach
        </div>
      </div>
    </div>
    @endif

    <div id="home-form" class="xl:py-8">
      <div class="bg-l-blue container mx-auto">
        <div class="flex flex-col text-white text-center py-8 md:flex-row md:text-left md:pl-4 md:items-center lg:px-8">
          <div class="pb-8 md:pb-0 md:w-1/3">
            <h3 class="font-semibold text-3xl tracking-wider md:text-lg lg:text-xl xl:text-2xl">{!! $options_page->options['form_1_text'] !!}</h3>
            <p class="tracking-widest text-lg md:text-xs xl:text-base">{!! $options_page->options['form_2_text']  !!}</p>
          </div>
          @php
            gravity_form_enqueue_scripts($options_page->options['form']['id'], true);
            gravity_form($options_page->options['form']['id'], false, false, false, '', true, 1);
          @endphp
      </div>
      </div>
    </div>

  </section>
  
@endwhile

@endsection
