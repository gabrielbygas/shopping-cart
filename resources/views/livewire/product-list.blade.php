<div>
    <!-- Messages flash -->
    @if (session('success'))
        <div class="mb-6 p-3 bg-emerald-50 text-emerald-700 text-sm rounded-lg alert-message">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 p-3 bg-red-50 text-red-700 text-sm rounded-lg alert-message">
            {{ session('error') }}
        </div>
    @endif

    <script>
        document.querySelectorAll('.alert-message').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 10000);
        });
    </script>

    <!-- Product grid: 4 columns on desktop, 2 on mobile -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <!-- Product card -->
            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:transform hover:scale-105 transition-all duration-300">
                <!-- Product image -->
                <div class="bg-gray-50 h-40 flex items-center justify-center overflow-hidden">
                    @if ($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Product details -->
                <div class="p-4">
                    <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">{{ $product->name }}</h3>
                    <p class="text-lg font-semibold text-gray-900 mb-4">${{ number_format($product->price, 2) }}</p>

                    <!-- Add to Cart button -->
                    <button wire:click="addToCart('{{ $product->id }}')"
                        class="w-full py-2 bg-cyan-600 text-white font-medium rounded-lg hover:bg-cyan-700 transition-colors">
                        Add to Cart
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Empty message -->
    @if ($products->isEmpty())
        <div class="text-center py-16">
            <p class="text-gray-500">No products available.</p>
        </div>
    @endif
</div>
