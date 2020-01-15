@extends('layouts.app')

@section('content')
  <section id="hero">
    <div class="" style="background: center / cover url('{!! App::featImage() !!}')">
      <div class="py-24 md:py-28 lg:py-32 xl:py-48"></div>
    </div>
  </section>

  <div class="contact-boxes">
    <div class="container mx-auto md:-mt-8 lg:-mt-12 lg:px-8">
      <div class="flex flex-col bg-l-orange items-center py-4 md:items-center md:px-4 md:flex-wrap lg:px-8 xl:mx-16 xl:px-12">
        @foreach($boxes as $box)
          <div class="">
            <div class="contact-box text-white text-center py-4 text-lg md:py-2 md:text-base lg:text-lg">
              {!!$box->box!!}
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <section>
    <div class="container mx-auto">
      <div class="text-center py-8 xl:px-20">
        <p class="px-8 pb-8">{!! $form_text !!}</p>
        @php
          gravity_form_enqueue_scripts($form->id, true);
          gravity_form($form->id, false, false, false, '', true, 1);
        @endphp
      </div>
    </div>
  </section>

  <section id="home-form" class="xl:pt-8">
    <div class="bg-l-blue container mx-auto">
      <div class="flex flex-col text-white text-center py-8 md:flex-row md:text-left md:pl-4 md:items-center lg:px-8">
        <div class="pb-8 md:pb-0 md:w-1/3">
          <h3 class="font-semibold text-3xl tracking-wider md:text-lg lg:text-xl xl:text-2xl">{!! $options_page->options['form_1_text'] !!}</h3>
          <p class="tracking-widest text-lg md:text-xs xl:text-base">{!! $options_page->options['form_2_text']  !!}</p>
        </div>
        @php
          gravity_form_enqueue_scripts(1, true);
          gravity_form(1, false, false, false, '', true, 1);
        @endphp
    </div>
    </div>
  </section>

@endsection
