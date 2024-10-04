<x-mail::message>
# Bienvenue sur XYZ

Ad eu cillum id occaecat eu elit eu amet veniam irure commodo.

Non magna commodo adipisicing duis ut est exercitation reprehenderit fugiat ex officia.
Cillum labore ex non eiusmod ut culpa ut voluptate proident ea reprehenderit in eiusmod sit.

Voici vos codes d'inscription :

<x-mail::panel>
@foreach($notifiable->codes as $code)
{{ $code->code }}<br>
@endforeach
</x-mail::panel>

Ad eu cillum id occaecat eu elit eu amet veniam irure commodo.
Non magna commodo adipisicing duis ut est exercitation reprehenderit fugiat ex officia.
Cillum labore ex non eiusmod ut culpa ut voluptate proident ea reprehenderit in eiusmod sit.

<x-mail::button :url="route('home')">
Se rendre sur XYZ
</x-mail::button>

À bientôt sur XYZ.
</x-mail::message>
