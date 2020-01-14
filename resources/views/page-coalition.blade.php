@extends('layouts.app')

@section('content')

<section id="hero" class="lg:pt-4">
  <div class="container mx-auto">
    <div class="flex flex-col justify-center md:flex-row">
      <div class="px-4 text-s-dark md:px-0 md:pl-4 md:w-1/2 lg:pl-8 lg:flex lg:flex-col lg:justify-center lg:pb-12">
        <div class="flex flex-col py-10 lg:py-0">
          <h1 class="text-3xl text-left font-semibold leading-tight border-l-4 pl-4 py-1 border-l-orange tracking-wider lg:border-l-6 lg:text-4xl xl:border-l-8">{!! $line_1 !!}</h1>
          <p class="text-lg pt-2 font-semibold lg:pr-12 lg:text-2xl">{!! $line_2!!}</p>
        </div>
      </div>
      <div class="md:w-1/2 lg:pr-4 xl:pr-0">
        <img src="{!! $image->url !!}" alt="">
      </div>
    </div>
  </div>
</section>

<section class="bg-l-gray md:-mt-12">
  <div class="container mx-auto">
    <div class="about-content coalition-content p-8 md:pb-4 md:pt-16 xl:pt-20">
      {!! $coalition_content !!}
    </div>
  </div>
</section>

<section id="home-form" class="xl:py-8">
  <div class="bg-l-blue container mx-auto">
    <div class="flex flex-col text-white text-center py-8 md:text-left md:pl-4 md:pr-0">
      <div class="pb-4 px-4 md:pb-4">
        <h3 class="font-semibold text-2xl tracking-wider lg:text-xl xl:text-2xl">{!! $form_title !!}</h3>
      </div>
      @php
        gravity_form_enqueue_scripts($form->id, true);
        gravity_form($form->id, false, false, false, '', true, 1);
      @endphp
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

@endsection

