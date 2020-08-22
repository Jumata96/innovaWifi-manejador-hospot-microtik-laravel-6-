<script type="text/javascript">
      //---JPaiva-30-07-2018----------------ACTUALIZAR-----------------------------
    $('#update').click(function(e){
      e.preventDefault();
      console.log("entro...");

      //var data = $('#myForm').serializeArray();
      //data.push({name: 'tienn2t', value: 'love'});
      var formData = new FormData();
      formData.append('url_imagen', $('#avatarInput')[0].files[0]);

      
      //console.log(data);

      $.ajax({
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                url: "{{ url('/carrusel/actualizar') }}" + '?' + $('#myForm').serialize(),
                method: "POST",               
                data: formData,
                processData: false,
                contentType: false
            }).done(function (data) {
                console.log(data);
                if (data.success)
                    //$avatarImage.attr('src', data.path);
                   window.location="{{ url('/carrusel') }}";
                    
            }).fail(function () {
                alert('La imagen subida no tiene un formato correcto');
            });


    });    

</script>