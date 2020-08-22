<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 
  @include('layouts2.partials.htmlHead')

  <body style="background-color: #f5f9f9">
   
    @include('layouts2.partials.header')
    
    <div id="main">      
      <!-- START WRAPPER -->
      <div class="wrapper">
        @include('layouts2.partials.sidebar')       
        <section id="content">
            @yield('sub-cabecera')
            @yield('main-content')
        </section>
        <!--
        @include('layouts2.partials.floatButton')
      -->
        </div>
        <!-- END WRAPPER -->
      </div>
      @include('layouts2.partials.footer')
      @include('layouts2.partials.scripts')   
  </body>
</html>