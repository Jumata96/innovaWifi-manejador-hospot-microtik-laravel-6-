@extends('layouts2.app')
@section('titulo','Logeo Facebook')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">

    <a class="btn blue" href="{{ route('social.auth', 'facebook') }}">
        Login con Facebook
    </a>

  </div>
</div>

@endsection
