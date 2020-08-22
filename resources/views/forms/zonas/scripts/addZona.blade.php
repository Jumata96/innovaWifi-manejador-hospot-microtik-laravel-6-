<script type="text/javascript">
	//---JMAZUELOS-24-06-2020----------------GRABAR-----------------------------
 
 $('#add').click(function(e){
	e.preventDefault();
	
	var data = $('#myForm').serializeArray();  
	$.ajax({
		url: "{{ url('/zonas/grabar') }}",
		type:"POST",
		beforeSend: function (xhr) {
			 var token = $('meta[name="csrf-token"]').attr('content');

			 if (token) {
					 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			 }
		},
	  type:'POST',
	  url:"{{ url('/zonas/grabar') }}",
	  data:data,

	  success:function(data){
		  
		  if ( data[0] == "error") {
			( typeof data.nombre != "undefined" )? $('#error2').text(data.nombre) && $('#nombre').focus() : null;
			 ( typeof data.idzona != "undefined" )? $('#error1').text(data.idzona) : null;
			// ( typeof data.nombre != "undefined" )? $('#error2').text(data.nombre) : null; 
						
		  } else {   

			 //alert(data.success);
			 window.location="{{ url('/zonas') }}";

		  }
		  
	  },

	  error:function(){ 
		  alert("error!!!!");
  }
  });  
 });    

</script>