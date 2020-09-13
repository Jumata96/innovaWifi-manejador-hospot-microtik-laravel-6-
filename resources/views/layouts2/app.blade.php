<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @if(Auth::user()->idtipo === 'ADM')
       
 
  @include('layouts2.partials.htmlHead')

  <body style="background-color: #f5f9f9">
   
          @include('layouts2.partials.header')
          
          <div id="main">      
            <!-- START WRAPPER -->
            <div class="wrapper"> 
                @if(Auth::user()->idtipo === 'ADM')
                  @include('layouts2.partials.sidebar')  
                @elseif(Auth::user()->idtipo === 'VEN' )  
                  @include('layoutsVendedores.partials.sidebar')  
                @endif      
              <section id="content">
                 
                  @yield('sub-cabecera') 
                  @include('layouts2.partials.mensaje')
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
      
    @elseif(Auth::user()->idtipo === 'VEN' )  
       
 
      @include('layoutsVendedores.partials.htmlHead')

      <body style="background-color: #f5f9f9">
   
        @include('layoutsVendedores.partials.header')
        
        <div id="main">      
          <!-- START WRAPPER -->
          <div class="wrapper">
            @include('layoutsVendedores.partials.sidebar')       
            <section id="content">
                @yield('sub-cabecera')
                @yield('main-content')
            </section>
            <!--
            @include('layoutsVendedores.partials.floatButton')
          -->
            </div>
            <!-- END WRAPPER -->
          </div>
          @include('layoutsVendedores.partials.footer')
          @include('layoutsVendedores.partials.scripts')   
      </body>
       
  @endif  


 
</html>