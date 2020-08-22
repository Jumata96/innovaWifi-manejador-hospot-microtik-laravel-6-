@component('mail::message')
{{$data->contenido}} 

Atte,<br>
{{$user->nombre }} {{$user->apellidos }}
@endcomponent
