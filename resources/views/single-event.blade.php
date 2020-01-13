@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post() @endphp
  <section class="hero">
    @if( App::featImage()) 
      <div class="relative bg-l-blue-100 overflow-hidden">
        <div class="relative event-bg-image">
          <img class="w-full absolute top-0 left-0 opacity-75 object-cover border-b-2 border-l-teal border-dashed md:h-72 xl:h-76" src="{!! App::featImage() !!}" alt="">
        </div>   
    @else 
      <div class="bg-l-blue-100">
    @endif
      <div class="relative container mx-auto z-20">
        <div class="p-4 md:flex md:items-center md:py-8 lg:justify-center">
          <h2 class="text-white text-3xl font-semibold tracking-wide leading-tight md:pr-32 lg:text-4xl lg:pr-8">{!!App::title() !!}</h2>
          <div class="text-center mt-8 md:mt-0">
            <a class="block uppercase bg-l-orange text-white px-4 py-2 shadow shadow-md font-semibold tracking-wide hover:bg-l-blue" href="{!! $register_link !!}">Register</a>
          </div>
        </div>
        <div class="p-4 pt-4">
          <div class="event-content text-l-blue lg:flex">
            <div class="event-about bg-white text-lg p-8 lg:w-1/2">
              @php the_content() @endphp
              <div class="text-center mt-12 mb-8 md:mb-4">
                <a class="uppercase bg-l-orange text-white px-8 py-4 font-semibold tracking-wide shadow shadow-md hover:bg-l-blue" href="{!! $register_link !!}">Register</a>
              </div>
            </div>
            <div class="mt-8 bg-white p-8 text-lg lg:mt-0 lg:w-1/2 lg:border-l-2 lg:border-l-teal lg:border-dashed lg:flex lg:flex-col lg:justify-center">
              @if($event_logo)
              <div class="w-48 mx-auto py-8 lg:w-60 xl:pt-0">
                <img class="w-full h-auto" src="{!! $event_logo->url !!}" alt="">
              </div>
              @endif
              <div class="flex mb-4">
                <svg class="h-6 w-6 text-l-orange fill-current mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/></svg>
                <p>{!! $event_date !!}</p>
              </div>
              @if($start_time)
              <div class="flex mb-4">
                <svg class="h-6 w-6 text-l-orange fill-current mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-7.59V4h2v5.59l3.95 3.95-1.41 1.41L9 10.41z"/></svg>
                <p>{!! $start_time !!} - {!! $end_time !!}</p>
              </div>
              @endif
              <div class="flex mb-r">
                <svg class="h-6 w-6 text-l-orange fill-current mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
                <div>
                  @if($location)
                    <p>{!! $location !!}</p>
                  @endif
                  <p>{!! $address !!}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> {{--  Close background div --}}
  </section>

  <section class="agenda-bg bg-l-blue-100">
    <div class="p-4 container mx-auto lg:flex lg:pb-12">
      @if($speakers)
      <div class="bg-white p-8 text-l-blue text-lg lg:w-3/5">
      @else
      <div class="bg-white p-8 text-l-blue text-lg mb-8">
      @endif
        <h3 class="text-3xl font-semibold uppercase pb-4">Agenda</h3>
        <div class="agenda-container">
          @foreach($agenda as $item)
            <div class="agenda mb-8">
              <p class="text-lg font-semibold">{!! $item->time !!}</p>
              <p class="text-lg font-semibold">{!! $item->title !!}</p>
              @if($item->text)
                <p>{!!$item->text!!}</p>
              @endif
            </div>
          @endforeach
          @if($agenda_cta)
            <p>{!! $agenda_cta !!}</p>
          @endif
          <div class="text-center my-8 mt-16">
            <a class="uppercase bg-l-orange text-white px-8 py-4 font-semibold tracking-wide shadow shadow-md hover:bg-l-blue" href="{!! $register_link !!}">Register</a>
          </div>
        </div>
      </div>
      @if($speakers)
        <div class="bg-l-teal p-8 pb-8 mb-8 lg:mb-0 lg:w-2/5">
          <h3 class="text-3xl font-semibold uppercase pb-4 text-white">Speakers</h3>
          <div class="speaker-container md:flex md:flex-wrap">
            @foreach($speakers as $item)
            <a class="text-white md:w-1/2 lg:w-1/2 group" href="{!! $item->link!!}">
              <div class="speaker text-center pb-8 group-hover:text-l-peach">
                <div class="py-4">
                  <div class="relative rounded-full overflow-hidden w-64 h-64 mx-auto lg:w-32 lg:h-32 xl:w-40 xl:h-40">
                    <img class="w-full h-full object-cover object-center absolute" src="{!! $item->image->url !!}" alt="">
                  </div>
                </div>
                <h4 class="font-semibold text-xl lg:text-base xl:text-lg">{!! $item->name !!}</h4>
                @if($item->title)
                  <p class="italic lg:text-sm xl:text-base">{!!$item->title!!}</p>
                @endif
              </div>
            </a>
            @endforeach
          </div>
        </div>
      @endif
    </div>

    <div class="event-map">
      <div class="container mx-auto">
        <div class="p-4 text-center text-white md:pt-12">
          <h2 class="text-3xl font-semibold uppercase pb-4">Location</h2>
          @if($location)
            <h3 class="text-xl font-semibold">{!! $location !!}</h3>
          @endif
          <h4 class="text-xl font-semibold px-8">{!! $address !!}</h4>
          @if($map_content)
          <div class="p-8 text-white">
            {!! $map_content !!}
          </div>
          @endif
        </div>
        <div>
          <div class="map-container lg:p-8 lg:flex xl:p-0 xl:pt-8">
            @if($map_image)
              <div class="map h-64 lg:w-1/2">
            @else 
              <div class="map h-64">
            @endif
              {!! $map_embed_code !!}
            </div>
            @if($map_image)
              <div class="hidden lg:block lg:w-1/2">
                <img class="w-full h-full object-cover" src="{!! $map_image !!}" alt="">
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  
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
