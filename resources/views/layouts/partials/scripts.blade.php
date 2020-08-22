<!-- ================================================
    Scripts
    ================================================ -->

     <!-- jQuery Library 
    <script type="text/javascript" src="{{asset('js/plugins/jquery-1.11.2.min.js')}}"></script>    -->
    <!--materialize js-->
    <script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="{{asset('js/plugins/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/data-tables/data-tables-script.js')}}"></script>
    <!--prism-->
    <script type="text/javascript" src="{{asset('js/prism.js')}}"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="{{asset('js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <!-- chartist -->
    <script type="text/javascript" src="{{asset('js/plugins/chartist-js/chartist.min.js')}}"></script>   
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{asset('js/plugins.min.js')}}"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="{{asset('js/custom-script.js')}}"></script>

    <!-- chartjs -->
    <script type="text/javascript" src="{{asset('js/plugins/chartjs/chart.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/chartjs/chart-script.js')}}"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="{{asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/sparkline/sparkline-script.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/plugins/formatter/jquery.formatter.min.js')}}"></script> 
    <script type="text/javascript" src="{{asset('js/jquery.mask.min.js')}}"></script>

    <!--angularjs-->
    <script type="text/javascript" src="{{asset('js/plugins/angular.min.js')}}"></script>

   

    <script type="text/javascript">
        $(document).ready(function(){
           $(document).bind("contextmenu",function(e){
              return false;
           });
        });
    </script>
    
    @section('script')

    @show