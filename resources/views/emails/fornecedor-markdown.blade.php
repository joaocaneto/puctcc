@component('mail::message')
# {{ $cabecalho }}

{!! $texto !!}

@component('mail::button', ['url' => config('app.url') ])
Visite nossa página
@endcomponent

At.te,<br>
Equipe Multitools
@endcomponent
