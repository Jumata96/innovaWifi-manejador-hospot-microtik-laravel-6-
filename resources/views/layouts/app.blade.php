<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body>

  <!-- Start Page Loading 
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>   -->
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  @include('layouts.partials.mainheader')

  @include('layouts.partials.sidebar')

  @include('layouts.partials.contentheader')

  

  @include('layouts.partials.footer')


@section('scripts')
    @include('layouts.partials.scripts')
@show

</body>
</html>
