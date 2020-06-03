@extends('layouts.app')

@section('content')
  <section id="blog__main-container" class="bg-l-gray">
    @if($get_cat)
      <div class="bg-l-blue text-white text-center py-4 text-2xl md:text-3xl xl:py-6 xl:text-4xl">
        <h2 class="font-semibold tracking-wide">{!! $get_cat->name !!}</h2>
      </div>
    @endif
    <div class="container mx-auto">
      <div class="new-container grid grid-cols-1 gap-4 pb-8 lg:grid-cols-2 lg:px-4 lg:pt-4 xl:px-0">
        @foreach($current_loop as $post)
          @if ($loop->index < 2)
          @if ($post['external'])
            <a class="group news-post bg-white" target="_blank" href="{!! $post['external'] !!}">
          @else
            <a class="group news-post bg-white" href="{!! $post['link'] !!}">
          @endif
            <div class="flex flex-col">
              <div class="h-48 relative md:h-56 lg:h-64 xl:h-72">
                <img class="h-full w-full object-cover object-center absolute" src="{!! $post['image'] !!}" alt="">
              </div>
              <div class="bg-white p-4 text-black xl:p-8">
                <p class="text-sm uppercase text-l-gray-dark">{!! $post['date'] !!}</p>
                <h3 class="text-2xl font-semibold leading-tight">{!! $post['name'] !!}</h3>
                <p class="py-2">{!! $post['content'] !!}</p>
                <p class="text-l-orange uppercase text-sm">Read More ></p>
            </div>
          </div>
          </a>
          @else
          @if ($post['external'])
            <a class="group news-post" target="_blank" href="{!! $post['external'] !!}">
          @else
            <a class="group news-post" href="{!! $post['link'] !!}">
          @endif
            <div class="flex">
              <div class="relative hidden md:block md:w-1/3 lg:w-1/2">
                <img class="h-full w-full object-cover object-center absolute" src="{!! $post['image'] !!}" alt="">
              </div>
              <div class="bg-white w-full p-4 text-black md:w-2/3 md:h-48 md:overflow-auto lg:h-56 lg:w-1/2 xl:h-64 xl:p-8">
                <p class="text-xs uppercase text-l-gray-dark xl:pb-2">{!! $post['date'] !!}</p>
                <h3 class="font-semibold pb-2 leading-tight text-lg xl:text-xl">{!! $post['name'] !!}</h3>
                <p class="hidden md:block md:text-sm md:pb-2 xl:text-base">@php echo wp_trim_words($post['content'], 15, '...') @endphp</p>
                <p class="text-l-orange uppercase text-xs xl:text-sm">Read More ></p>
              </div>
            </div>
            </a> 
          @endif
        @endforeach
      </div>
      <div class="text-center text-white pb-8 xl:pb-0">
        <button class="post-load-btn bg-l-blue px-12 py-3 font-semibold uppercase shadow shadow-md hover:bg-l-orange">Load More</button>
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

  </section>
{{-- @debug
@dump($get_cat) --}}
@endsection
