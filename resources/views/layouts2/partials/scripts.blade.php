    <!-- jQuery Library -->
    <script type="text/javascript" src="{{ asset('https://code.jquery.com/jquery-3.5.1.js') }}"></script>
    <!--materialize js-->
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="{{ asset('js/plugins/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/data-tables/data-tables-script.js') }}"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>

    <!-- jQuery Library -->
    <!--prism-->
    <script type="text/javascript" src="{{ asset('js/prism.js') }}"></script>
    <!-- chartjs -->
    <script type="text/javascript" src="{{ asset('js/chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/chartjs/chart-script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard-ecommerce.js') }}"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/sparkline/sparkline-script.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/formatter/jquery.formatter.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>

    <!--angularjs-->
    <script type="text/javascript" src="{{ asset('js/plugins/angular.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script> 

{{-- jmazuelos --}}



     <script type="text/javascript">
        $(document).ready(function() {
            $(document).bind("contextmenu", function(e) {
                return false;
            }); 
        });

        $(document).ready(function() {
            // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
            $('.modal').modal();
        });

        $('#radio').click(function(e) {
            val = $('#left-sidebar-nav').data('valor');

            if (val == '0') {
                console.log('entroooo');
                $('#sideusuario').hide();
                $('#left-sidebar-nav').data('valor', '1');
                $('#mas_opciones').text('MÁS');
            } else {
                $('#sideusuario').show();
                $('#left-sidebar-nav').data('valor', '0');
                $('#mas_opciones').text('MÁS OPCIONES');
            }


        });

        //registro de ventas del mickotick
        function buscarDireccion() {
       // value = $('#value').text();
       var data = []; 
       //ar data = bandera.push('B',); 
       data.push(['carlos']); 	
       $.ajax({
        url: " {{ url('/tickets/consultarMikrotik') }} ",
        type:"POST",
        beforeSend: function (xhr) {
           var token = $('meta[name="csrf-token"]').attr('content');
           if (token) {
               return xhr.setRequestHeader('X-CSRF-TOKEN', token);
           }
        },
        type:'POST',
        url:" {{ url('/tickets/consultarMikrotik') }} ",
        data:{
          bandera:"bandera"
        },
        success:function(data){  
          if(data.EstadoTicket=="SI"){  
              var elementoMensajeGeneral = document.getElementById('mensajeGeneral'); //se define la variable  
             elementoMensajeGeneral.style.display ='block';    
          }
            
        },
        error:function(){  
          }
      });
    }
    //   buscarDireccion();
     
     /* setInterval(function(){
      buscarDireccion();  
    	}, 1000); 
   */
    $('#CerrarMensajeGeneral').on('click',function( ){ 
        var elementoMensajeGeneral = document.getElementById('mensajeGeneral'); //se define la variable "el" igual a nuestro div
             elementoMensajeGeneral.style.display ='none'; 

    }); 

    </script>



    @section('script')

    @show
