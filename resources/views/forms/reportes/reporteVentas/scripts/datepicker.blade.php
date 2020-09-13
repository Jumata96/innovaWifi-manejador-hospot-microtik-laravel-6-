    <script>
      var arrayFiltrado=[];
        $(function() {
            $(".datepicker").datepicker({
                maxDate: "+0D", 
                closeText: 'Cerrar',
                prevText: '< Ant',
                nextText: 'Sig >',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
                    'Nov', 'Dic'
                ],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                showMonthAfterYear: false,
                dateFormat: "dd/mm/yy"
            }); 
            $("#to").datepicker("setDate", new Date()); 
           /*  $("#from").datepicker("setDate", new Date(2020, 9-1,2)); */
            $("#from").datepicker("setDate", "-1m"); 
        }); 
        $(document).focusout(  function(){ 
          var fechaFrom =$("#from").val();
          var diaF = parseInt(fechaFrom.substr(0,2));
          var mesF = parseInt(fechaFrom.substr(3,2));
          var yearF = parseInt(fechaFrom.substr(6,4));
          
          var fechaTo=$("#to").val();
          var diaT = parseInt(fechaTo.substr(0,2));
          var mesT = parseInt(fechaTo.substr(3,2));
          var yearT = parseInt(fechaTo.substr(6,4));
          var bandera=false;//ok  
          var f2 = new Date(yearT, mesT, diaT);  //fecha fin
          var f1 = new Date(yearF, mesF, diaF);  //fecha inicio
          // console.log(f1,f2); 
          if(diaF==diaT &&mesF==mesT&&yearF==yearT){
            bandera=true; 
          }else{ 
              if(f1 < f2){
                  bandera=true;
              } 
          } 
          if(!bandera){
            console.log('falso');
            $("#to").datepicker("setDate", new Date()); 
                          setTimeout(function() {
															Materialize.toast('<span style="color:#e65100"><b></b>Fecha ingresada es menor que fecha de inicio.</i></span>', 3000);
													}, 000);

          } 
        });
       
    </script>   