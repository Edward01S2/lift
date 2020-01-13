@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="join-page__bg-container relative overflow-hidden">
      <div class="relative event-bg-image">
        <img class="w-full absolute top-0 left-0 opacity-75 object-cover border-b-2 border-l-teal border-dashed md:h-72 xl:h-76" src="{!! App::featImage() !!}" alt="">
      </div>   
    <div class="relative container mx-auto z-20">
      <div class="p-4 md:flex md:items-center md:py-8 lg:justify-center">
        <h2 class="text-white text-3xl font-semibold tracking-wide leading-tight md:pr-32 lg:text-4xl lg:pr-8 xl:text-5xl">{!!App::title() !!}</h2>
      </div>
      <div class="p-4 pt-4 pb-16">
        <div class="event-content text-l-blue lg:flex">
          <div class="event-about bg-white p-8 text-l-blue xl:p-12">
            <div class="join-content-container text-lg md:text-base lg:text-lg">
              {!! $content !!}
            </div>
            <h3 class="text-2xl text-center font-semibold pb-6 xl:pt-4 xl:text-3xl">{!! $form_title !!}</h3>
            @php
              gravity_form_enqueue_scripts($form->id, true);
              gravity_form($form->id, false, false, false, '', true, 1);
            @endphp
            <div class="crm-disclaimer border-2 border-l-orange border-dashed p-4 mt-8 pb-0 text-sm">
              {!! $options_page->options['crm_disclaimer'] !!}
            </div>
            <div class="mt-4 text-sm">
              {!! $options_page->options['disclaimer'] !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> {{--  Close background div --}}
</section>


@endsection
