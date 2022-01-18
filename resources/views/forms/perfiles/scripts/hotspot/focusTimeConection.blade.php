<script type="text/javascript">
//  myFunction()

	$("#h_minutos").focusout(function () {  
      let minutos_val = $("#h_minutos").val();
      console.log(minutos_val);
      if(minutos_val<0 || minutos_val>60  ){
          $("#h_error_min").text('numero fuera de rango');
            $("#h_minutos").val('0');

      }  
    });

  	$("#h_horas").focusout(function () { 
        let minutos_val = $("#h_horas").val();
        console.log(minutos_val);
        if(minutos_val<0 || minutos_val>60  ){
            $("#h_error_hor").text('numero fuera de rango');
              $("#h_horas").val('0');

        }  
      });
      

    	$("#h_dias").focusout(function () { 
          let minutos_val = $("#h_dias").val();
          console.log(minutos_val);
          if(minutos_val<0 ){
              $("#h_error_dias").text('numero fuera de rango');
                $("#h_dias").val('0');

          }  
        });

        //imput actualizzar

        	$("#h_minutos_upd").focusout(function () {  
      let minutos_val = $("#h_minutos_upd").val();
      console.log(minutos_val);
      if(minutos_val<0 || minutos_val>60  ){
          $("#h_error_min_upd").text('numero fuera de rango');
            $("#h_minutos_upd").val('0');

      }  
    });

  	$("#h_horas_upd").focusout(function () { 
        let minutos_val = $("#h_horas_upd").val();
        console.log(minutos_val);
        if(minutos_val<0 || minutos_val>60  ){
            $("#h_error_hor_upd").text('numero fuera de rango');
              $("#h_horas_upd").val('0');

        }  
      });

    	$("#h_dias_upd").focusout(function () { 
          let minutos_val = $("#h_dias_upd").val();
          console.log(minutos_val);
          if(minutos_val<0 ){
              $("#h_error_dias_upd").text('numero fuera de rango');
                $("#h_dias_upd").val('0');

          }  
        });


</script>