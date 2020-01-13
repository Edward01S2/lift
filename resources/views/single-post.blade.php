@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="single-post__container bg-l-blue-100">
      <div class="container mx-auto p-4 md:p-8 xl:p-0 xl:pt-12">
        <div>
          <div class="relative md:h-68 lg:h-72">
            <img class="w-full h-auto md:h-full md:object-cover md:object-center md:absolute" src="{!! App::featImage() !!}" alt="">
          </div>
          <div class="single-post__content bg-white p-4 text-l-blue md:p-8">
            <p class="italic">{!! $post_data->date!!}</p>
            <h2 class="text-2xl font-semibold leading-tight mb-4 lg:text-3xl">{!! $post_data->title!!}</h2>
            <p class="text-sm mb-4">CATEGORIES:
              <span class="cat-links">{!! $post_data->cat !!}</span>
            </p>
            <div class="single-post__info">
              {!! $post_data->content !!}
            </div>
          </div>
        </div>
        <div class="text-center pt-8 pb-4 md:pb-0">
          <a class="uppercase inline-flex items-center text-white border-2 border-white px-8 py-4 block uppercase font-semibold shadow shadow-md group hover:bg-white hover:text-l-blue" href="/news">
            <svg class="h-4 w-4 fill-current mr-2 transform ease-in duration-150 group-hover:-translate-x-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.828 9l6.071-6.071-1.414-1.414L0 10l.707.707 7.778 7.778 1.414-1.414L3.828 11H20V9H3.828z"/></svg>
            <span>Back to News</span>
          </a>
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
