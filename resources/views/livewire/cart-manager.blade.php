<div>
    @if (session('success'))
        <div class="mb-6 p-3 bg-emerald-50 text-emerald-700 text-sm rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-6 p-3 bg-red-50 text-red-700 text-sm rounded">{{ session('error') }}</div>
    @endif

    @if ($items->isEmpty())
        <div class="text-center py-20">
            <p class="text-gray-600 mb-4">Your bag is empty</p>
            <a href="{{ route('products') }}" wire:navigate class="inline-block px-6 py-2 bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach ($items as $item)
                    <div class="bg-white p-4 rounded-lg flex gap-4 border border-gray-200">
                        <div class="w-24 h-24 bg-gray-100 rounded flex-shrink-0 overflow-hidden">
                            @if ($item->product->image_url)
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            @endif
                        </div>

                        <div class="flex-grow">
                            <h3 class="font-medium text-gray-900 mb-1">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-3">${{ number_format($item->product->price, 2) }}</p>

                            <div class="flex items-center gap-2">
                                <input type="number" min="1" value="{{ $item->quantity }}"
                                    wire:change="updateQuantity('{{ $item->id }}', $event.target.value)"
                                    class="w-12 px-2 py-1 border border-gray-300 rounded text-sm">
                                <button wire:click="removeFromCart('{{ $item->id }}')" class="text-xs text-gray-600 hover:text-red-600">Remove</button>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="font-semibold text-gray-900">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="bg-white p-6 rounded-lg border border-gray-200 h-fit sticky top-24">
                <h2 class="font-semibold text-gray-900 mb-4">Order Summary</h2>
                <div class="space-y-2 text-sm mb-4 pb-4 border-b border-gray-200">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-900">${{ number_format($items->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="text-gray-900">Free</span>
                    </div>
                </div>

                <div class="flex justify-between mb-6">
                    <span class="font-semibold text-gray-900">Total</span>
                    <span class="font-bold text-lg text-gray-900">${{ number_format($items->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</span>
                </div>

                <button class="w-full py-3 bg-gray-900 text-white font-semibold hover:bg-gray-800 mb-2">
                    Checkout
                </button>
                <a href="{{ route('products') }}" wire:navigate class="block w-full py-3 bg-gray-100 text-gray-900 font-semibold hover:bg-gray-200 text-center rounded">
                    Continue Shopping
                </a>
            </div>
        </div>
    @endif
</div>
