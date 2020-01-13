@extends('layouts.app')

@section('content')
  <section>
    <div class="bg-l-blue">
      <h2 class="text-center text-white font-semibold text-2xl py-6 tracking-wider xl:text-3xl">{!! $options_page->options['event_archive_title'] !!}</h2>
    </div>
  </section>

  <section>
    <div class="event-container container mx-auto lg:mt-4 xl:pt-8">
      @foreach($current_loop as $event)
      <article class="group transform transition-300 hover:scale-101">
        <a href="{!! $event['link'] !!}" class="event">
          <div class="md:flex md:p-4 lg:shadow lg:shadow-md lg:p-0 lg:m-4 lg:mb-4 xl:mb-8 xl:mx-0">
            <div class="relative md:w-1/2">
              <img class="w-full h-full xl:object-cover xl:object-center xl:h-66" src="{!! $event['image'] !!}" alt="">
              <div class="absolute top-0 left-0">
                <div class="flex flex-col justify-center bg-l-orange text-center py-2 px-3 lg:px-4 lg:py-3">
                  <span class="text-white uppercase font-semibold tracking-wider lg:text-xl">@php echo date('M', strtotime( $event['date'] )); @endphp</span>
                  <span class="text-white text-2xl font-bold leading-none lg:text-3xl">@php echo date('d', strtotime( $event['date'] )); @endphp</span>
                </div>
              </div>
            </div>
            <div class="p-4 bg-l-gray text-sm text-black md:w-1/2 lg:text-base lg:tracking-wide lg:p-8 xl:text-lg xl:pr-16">
              <h3 class="font-semibold text-lg text-l-blue group-hover:text-l-orange lg:pb-4 lg:text-2xl">{!! $event['name'] !!}</h3>
              <p class=""><span class="text-l-blue font-semibold text-base">DATE:</span> {!! $event['date'] !!}, {!! $event['start'] !!} - {!! $event['end'] !!}</p>
              <p class="mb-2"><span class="text-l-blue font-semibold text-base">LOCATION:</span> {!! $event['location'] !!}, {!! $event['address'] !!}</p>
              <p class="uppercase font-semibold text-base text-l-orange lg:text-lg">Learn More ></p>
            </div>     
          </div>
        </a>
      </article> 
      @endforeach
    </div>
    <div class="event-btn-container text-center py-8 lg:pb-8">
      <button class="archive-event text-white uppercase bg-l-blue font-semibold px-4 py-2 tracking-wide lg:px-8 lg:py-4 lg:text-lg hover:bg-l-orange">Load Archived Events</button>
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
          gravity_form_enqueue_scripts($options_page->options['form']['id'], true);
          gravity_form($options_page->options['form']['id'], false, false, false, '', true, 1);
        @endphp
    </div>
    </div>
  </section>

  {{-- @debug --}}

{{-- @dump($options_page) --}}

@endsection



