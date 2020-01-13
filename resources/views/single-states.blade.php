@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

  <section id="hero">
    <div class="flex flex-col justify-center md:flex-row">
      <div class="px-4 text-s-dark md:px-0 md:pl-4 md:w-1/2 lg:pl-8 md:flex md:items-center">
        <div class="flex flex-col py-10 md:text-left md:items-start md:ml-auto md:pr-6 md:w-384 lg:pr-16 lg:w-512 lg:py-0 xl:w-640">
          <div class="border-l-4 border-l-orange pl-4 my-2">
            <h1 class="text-xl text-left font-semibold leading-tight pb-2 tracking-wider lg:text-3xl lg:pb-0 xl:text-4xl">{!! App::title() !!}</h1>
            <p class="lg:pt-2 lg:text-xl xl:text-2xl xl:pl-0 xl:pr-12">{!! $hero_text !!}</p>
          </div>
        </div>
      </div>
      <div class="relative md:w-1/2">
        <div class="content-container relative w-full h-full z-20 flex flex-col justify-center items-center opacity-99" style="background-image:url({!! $video_poster->url !!}); background-size: cover;">
          <div class="play-container text-center z-30 py-16 md:py-20 lg:py-24 xl:py-48">
            <a href="{!! $video_url !!}" data-lity id="toggle-video" class="cursor-pointer outline-none focus:outline-none bg-l-orange inline-block rounded-full group hover:bg-white">
              <svg class="fill-current text-white h-16 w-16 p-2 pl-3 block cursor-pointer outline-none hover:text-white group-hover:text-l-orange lg:h-20 lg:w-20 xl:h-24 xl:w-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="state-stats" class="lg:mx-4 xl:mx-0">
    <div class="container mx-auto mt-8 mb-8 lg:mb-12 xl:mb-16">
      @foreach($stats as $stat)
      @if ($loop->index % 2)

      <div class="flex items-center mb-4">
        <div class="flex items-center relative w-3/5">
          <span class="flex-grow text-xs py-3 text-right pr-8 pl-4 relative z-10 bg-l-gray md:text-sm lg:text-lg lg:py-4 xl:text-xl">{!! $stat->left !!}</span>
          <svg class="h-full w-auto fill-current absolute right-0 text-l-gray bg-white box-content z-20 stroke-current stroke-3" viewBox="0 0 31 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 2.807L29.928 55 1 107.193V2.807z" stroke="#f4f4f4"/>
          </svg>
        </div>
        <div class="text-sm w-2/5 flex text-white items-center relative overflow-hidden">
          <svg class="h-full w-auto fill-current absolute left-0 text-white bg-l-blue box-content z-20 stroke-current stroke-3" viewBox="0 0 31 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 2.807L29.928 55 1 107.193V2.807z" stroke="#fff"/>
          </svg>
          <span class="w-full relative bg-l-blue py-2 text-lg text-center lg:text-2xl lg:py-3">{!! $stat->right !!}</span>
          </div>
        </div> 

      @else

      <div class="flex items-center mb-4">
        <div class="flex items-center text-white relative w-2/5">
          <span class="flex-grow text-lg py-3 text-center relative z-10 bg-l-blue lg:text-2xl">{!! $stat->left !!}</span>
          <svg class="h-full w-auto fill-current absolute right-0 text-l-blue bg-white box-content z-20 stroke-current stroke-3" viewBox="0 0 31 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 2.807L29.928 55 1 107.193V2.807z" stroke="#294071"/>
          </svg>
        </div>
        <div class="text-sm w-3/5 flex items-center relative">
          <svg class="h-full w-auto fill-current absolute left-0 text-white bg-l-gray box-content z-20 stroke-current stroke-3" viewBox="0 0 31 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 2.807L29.928 55 1 107.193V2.807z" stroke="#fff"/>
          </svg>
          <span class="relative w-full bg-l-gray pl-8 py-3 text-xs md:text-sm lg:text-lg lg:py-4 xl:text-xl">{!! $stat->right !!}</span>
          </div>
        </div>

      @endif
      @endforeach
    </div>
  </section>

  <section id="state-news" class="bg-l-gray py-8">
    <div class="container mx-auto">
      <h2 class="text-center pb-8 text-2xl font-semibold xl:text-3xl">LIFT News in {!! App::title() !!}</h2>
      <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:mx-4 xl:mx-0">
        @foreach($get_news as $post)
        <a class="group news-post" href="{!! $post['link'] !!}">
          <div class="flex flex-col">
            <div class="h-48 relative md:h-56 lg:h-64 xl:h-72">
              <img class="h-full w-full object-cover object-center absolute" src="{!! $post['image'] !!}" alt="">
            </div>
            <div class="bg-white p-4 text-black lg:h-66 lg:overflow-auto xl:p-8">
              <p class="text-sm uppercase text-l-gray-dark">{!! $post['date'] !!}</p>
              <h3 class="text-2xl font-semibold leading-tight">{!! $post['name'] !!}</h3>
              <p class="py-2">{!! $post['content'] !!}</p>
              <p class="text-l-orange uppercase text-sm group-hover:text-l-blue">Read More ></p>
          </div>
        </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>

  <section id="story-highlight">
    <div class="container mx-auto py-4 md:py-8">
      <h2 class="text-center font-semibold px-4 text-2xl leading-tight pb-4 md:px-40 md:pb-8 xl:text-3xl">Digitally Empowered Small Businesses in {!! $state->label !!}</h2>
      <div class="flex flex-col md:flex-row md:px-4 xl:px-0">
        <div class="md:w-1/2">
          <a class="relative block w-full h-full transform hover:scale-101" href="{!! $get_state[0]['link'] !!}">
            <div class="h-68 lg:h-72 xl:h-78">
              <div class="story-gradient"></div>
              <img class="w-full h-full object-cover object-center z-20" src="{!! $get_state[0]['image'] !!}" alt="">
              <p class="absolute bottom-0 left-0 text-white z-30 mx-2 mb-2 text-lg font-semibold xl:text-xl">{!! $get_state[0]['company'] !!}</p>
            </div>
          </a>
        </div>
        <div class="md:w-1/2 grid grid-cols-2 gap-4 mt-4 mx-4 grid-rows-3 md:mt-0 md:grid-cols-3 md:mx-0 md:pl-4 lg:h-72 xl:h-78">
          @foreach($get_state as $state)
            @if($loop->index > 0)
              <a class="relative block w-full h-40 md:h-full lg:h-full transform hover:scale-101" href="{!! $state['link'] !!}">
                <div class="story-gradient z-40"></div>
                <img class="w-full h-full absolute object-cover object-center z-20" src="{!! $state['image'] !!}" alt="">
                <p class="text-white absolute bottom-0 left-0 z-30 text-sm leading-tight mx-1 mb-1 font-semibold lg:text-sm xl:text-base xl:mx-2 xl:mb-2">{!! $state['company'] !!}</p>
              </a>
            @endif
          @endforeach
        </div>
      </div>
      <div class="hidden md:flex pt-4">
        <div class="md:w-1/2 pl-4 md:pl-4 xl:pl-0">
          <h3 class="text-2xl leading-tight font-semibold pb-2 xl:text-3xl">{!! $get_state[0]['name'] !!}</h3>
          <p class="text-sm xl:text-base">{!! $get_state[0]['company'] !!}, {!! $get_state[0]['location'] !!}, {!! $get_state[0]['state']['value'] !!}</p>
          <a class="text-l-gray-dark underline hover:text-l-orange text-sm xl:text-base" href="{!! $get_state[0]['website'] !!}">Website</a>
          <div class="single-state__content mt-4">
            {!! $get_state[0]['content'] !!}
          </div>
        </div>
        <div class="md:w-1/2">
          <div class="grid grid-cols-2 gap-4 px-4">
            @foreach($get_state[0]['gallery'] as $img)
              <a class="transform hover:scale-101" href="{!! $img['url'] !!}">
                <div class="relative w-full h-40">
                  <img class="w-full h-full absolute object-cover object-center" src="{!! $img['url'] !!}" alt="" data-lity>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

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

  @endwhile
  
@endsection
