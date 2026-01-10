@component('mail::message')
# Notification: Low Stock

The product **{{ $product->name }}** has low stock ({{ $product->stock_quantity }} units remaining).

@component('mail::button', ['url' => url('/products')])
View Products
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
