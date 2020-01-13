<footer class="content-info py-8 xl:pt-12">
  <div class="container mx-auto">
    <div class="flex flex-col items-center">
      <a class="brand hover:opacity-50 mb-8 md:hidden" href="{{ home_url('/') }}">
        <img class="h-12 md:h-12" src="{{ $options_page->options['logo']['url'] }}" alt="">  
      </a>
      <div class="social-links flex mb-4 md:mb-2">
        @foreach($options_page->options['networks'] as $social)
          <a href="" class="group relative text-white fill-current flex items-center justify-center px-1 cursor-pointer md:px-2">
            <span class="relative z-10 h-10 w-10 rounded-full group-hover:opacity-75" style="background-color: {!! $social['bg_color'] !!}"></span>
            <i class="absolute z-20 {!! $social['icon'] !!} fa-lg"></i>
          </a>
        @endforeach
      </div>
      <div class="footer-nav">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav-primary']) !!}
        @endif
      </div>
      <div class="copyright text-center px-8 md:flex md:text-sm">
        <span class="md:pr-1">&copy; <?php echo esc_attr( date( 'Y' ) ); ?></span>
        {!! $options_page->options['copy'] !!}
      </div>
    </div>
  </div>
</footer>

{{-- @debug --}}
{{-- @dump($options_page->options['networks']) --}}