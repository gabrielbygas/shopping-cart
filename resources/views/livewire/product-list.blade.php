<?php

use Livewire\Volt\Component;
use App\Models\Product;
use App\Services\CartService;

new class extends Component {
    public function addToCart(CartService $cartService, string $productId)
    {
        try {
            $cartService->addToCart($productId, 1);

            $this->dispatch('cart-updated');
            session()->flash('success', 'Product added to cart!');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function with()
    {
        return [
            'products' => Product::query()->where('stock_quantity', '>', 0)->orderBy('name')->get(),
        ];
    }
};
?>

<div class="p-4 bg-gray-50 rounded-lg">
    <h2 class="text-xl font-bold mb-4">Available Products</h2>

    @if (session('success'))
        <div class="mb-3 text-green-700 bg-green-100 border border-green-300 px-3 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-3 text-red-700 bg-red-100 border border-red-300 px-3 py-2 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($products as $product)
            <div class="p-4 border rounded-lg shadow-sm bg-white flex flex-col justify-between">

                <div>
                    <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-600">{{ number_format($product->price, 2) }} $</p>
                    <p class="text-sm text-gray-400">Stock: {{ $product->stock_quantity }}</p>
                </div>

                <button wire:click="addToCart('{{ $product->id }}')"
                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add to cart
                </button>

            </div>
        @endforeach
    </div>
</div>
