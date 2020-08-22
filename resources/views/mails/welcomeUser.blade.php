@component('mail::message')
# Bienvenido, {{$newUser->nombre}} 

Gracias por registrarte, es un placer que formes parte de nosotros.

Puedes ingresar a la Web con tu usuario y contraseña
a trav&eacute;s del siguiente enlace.
@component('mail::button', ['url' => 'http://innovatec.me'])
Ir a la Web
@endcomponent

Atte,<br>
{{ config('app.name') }}
@endcomponent
