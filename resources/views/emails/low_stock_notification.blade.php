@component('mail::message')
# Notification : Stock bas

Le produit **{{ $product->name }}** a un stock faible ({{ $product->stock_quantity }} unités restantes).

@component('mail::button', ['url' => url('/products')])
Voir les produits
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
