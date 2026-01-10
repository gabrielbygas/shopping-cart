<?php

use Livewire\Volt\Component;
use App\Services\CartService;

new class extends Component {
    protected $listeners = [
        'cart-updated' => '$refresh', // automatically refreshes the cart
    ];

    public function updateQuantity(CartService $cartService, string $cartId, int $qty)
    {
        try {
            $cartService->updateQuantity($cartId, $qty);
            session()->flash('success', 'Quantity updated');
            $this->dispatch('cart-updated');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function removeFromCart(CartService $cartService, string $cartId)
    {
        try {
            $cartService->removeFromCart($cartId);
            session()->flash('success', 'Product removed from cart');
            $this->dispatch('cart-updated');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function with(CartService $cartService)
    {
        return [
            'items' => $cartService->getCart(),
        ];
    }
};
?>

<div class="p-4 bg-gray-50 rounded-lg">
    <h2 class="text-xl font-bold mb-4">My Cart</h2>

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

    @if ($items->isEmpty())
        <p class="text-gray-600">Your cart is empty.</p>
    @else
        @foreach ($items as $item)
            <div class="flex justify-between items-center mb-3 border-b pb-2">
                <div>
                    <p class="font-semibold">{{ $item->product->name }}</p>
                    <p class="text-sm text-gray-500">{{ number_format($item->product->price, 2) }} $</p>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="number" min="1" value="{{ $item->quantity }}"
                        wire:change="updateQuantity('{{ $item->id }}', $event.target.value)"
                        class="w-16 border rounded px-2 py-1" />

                    <button wire:click="removeFromCart('{{ $item->id }}')"
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Remove
                    </button>
                </div>
            </div>
        @endforeach
    @endif
</div>
