<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5.5 Ajax Request example</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <h1>Laravel 5.5 Ajax Request example</h1>     

        <form>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required="">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Email" required="">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-submit">Submit</button>
            </div>
        </form>
    </div>
</body>

<script type="text/javascript">
    
    $(".btn-submit").click(function(e){
        e.preventDefault();

        var name = $("input[name=name]").val();
        var password = $("input[name=password]").val();
        var email = $("input[name=email]").val();

        $.ajax({
            url: "{{ url('ajaxRequestt') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('ajaxRequestt') }}",
           data:{name:name, password:password, email:email},

           success:function(data){
              alert(data.success);
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
	});
</script>

</html>