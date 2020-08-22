@extends('layouts.app')

@section('htmlheader_title')
	Plantilla Básica
@endsection

@section('sub-cabecera')
	@include('layouts.partials.subCabecera')
@endsection

@section('main-content')
  @include('forms.scripts.salto')
@endsection