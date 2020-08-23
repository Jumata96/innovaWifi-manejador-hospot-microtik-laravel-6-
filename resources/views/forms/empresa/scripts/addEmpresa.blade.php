<script type="text/javascript">
    //---JPaiva-12-08-2018----------------GRABAR-----------------------------
  
  $('#add').click(function(e){
    e.preventDefault();
    
    var data = $('#myForm').serializeArray();
    //data.push({name: 'tienn2t', value: 'love'});
    //var formData = new FormData();
    //formData.append('url_imagen', $('#avatarInput')[0].files[0]);
    var formData = new FormData();
    formData.append('imagenURL', $('#imagenURL')[0].files[0]);
    
      $.ajax({
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
              url: "{{ url('/empresa/grabar') }}" + '?' + $('#myForm').serialize(),
              method: "POST",               
              data: formData,
              processData: false,
              contentType: false
          }).done(function (data) {
              $('#error1').text('');
              $('#error2').text('');
              $('#error4').text('');
              $('#error7').text('');
              $('#error8').text('');
              $('#error9').text('');
              
              if ( data[0] == "error") {
                
                ( typeof data.idempresa != "undefined" )? $('#error1').text(data.idempresa) : null;
                ( typeof data.razon_social != "undefined" )? $('#error2').text(data.razon_social) : null;
                ( typeof data.direccion != "undefined" )? $('#error4').text(data.direccion) : null;
                ( typeof data.iddocumento != "undefined" )? $('#error7').text(data.iddocumento) : null;
                ( typeof data.DNI1 != "undefined" )? $('#error8').text(data.DNI1) : null;
                ( typeof data.representante1 != "undefined" )? $('#error9').text(data.representante1) : null;
              } else {   

                //alert(data.success);
                window.location="{{ url('/empresa') }}";

              }

              //if (data.success)
                //$avatarImage.attr('src', data.path);
                //window.location="{{ url('/empresa') }}";
                  
          }).fail(function () {
              alert('La imagen subida no tiene un formato correcto');
          });
  });    

</script>