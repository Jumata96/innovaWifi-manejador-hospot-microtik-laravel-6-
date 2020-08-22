@extends('layouts2.app')

@section('titulo','Prueba Vue Js')


@section('main-content')
<br>
<div id="app">
  <div class="row">
  	<div class="col s12">
  		<p>@{{ message }}</p>
  		<input v-model="message">
  	</div>
  </div>
 </div>
@endsection

@section('script')
	<script type="text/javascript">
		new Vue({
		  el: '#app',
		  data: {
		    message: 'Hello Vue.js!'
		  },
		  methods: {
		    reverseMessage: function () {
		      this.message = this.message.split('').reverse().join('')
		    }
		  }
		})
	</script>
@endsection