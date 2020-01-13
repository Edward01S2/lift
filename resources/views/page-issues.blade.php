@extends('layouts.app')

@section('content')

<section class="issues">
  @foreach($issues as $issue)
  <div class="issue flex flex-col justify-center md:flex-row md:py-4">
    <div class="issue-container order-1 px-4 py-8 pt-4 md:p-0 lg:flex lg:items-center">
      <div class="issue-content">
        <div class="issue-w">
          {!! $issue->issue !!}
        </div>
      </div>
    </div>
    <div class="issue-img order-none relative md:flex md:items-center">
      <img class="object-cover object-center h-48 w-full md:h-full lg:h-68 xl:h-72" src="{!! $issue->image->url !!}" alt="">
    </div>
  </div>
  @endforeach
</section>

{{-- @debug --}}

@endsection

