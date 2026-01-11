<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public $cartCount = 0;

    #[\Livewire\Attributes\On('cart-updated')]
    public function handleCartUpdate()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        if (auth()->check()) {
            $this->cartCount = auth()->user()->cart()->count();
        } else {
            $this->cartCount = 0;
        }
    }

    #[\Livewire\Attributes\On('livewire:updated')]
    public function refresh()
    {
        $this->updateCartCount();
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div style="width: 80%; margin: 0 auto;" class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('products') }}" wire:navigate class="text-2xl font-bold text-gray-900">
                SHOP
            </a>

            <!-- Center Navigation -->
            <div class="hidden md:flex items-center space-x-12">
                <a href="{{ route('products') }}" wire:navigate
                    class="text-sm text-gray-700 hover:text-gray-900 font-medium transition">
                    Products
                </a>
                @auth
                    <a href="{{ route('cart') }}" wire:navigate
                        class="text-sm text-gray-700 hover:text-gray-900 font-medium transition">
                        Cart
                    </a>
                @endauth
            </div>

            <!-- Right Menu -->
            <div class="hidden md:flex items-center space-x-6">
                @auth
                    <!-- Cart Icon -->
                    <a href="{{ route('cart') }}" wire:navigate class="relative">
                        <svg class="w-6 h-6 text-cyan-600 hover:text-cyan-700 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if ($this->cartCount > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                                {{ $this->cartCount }}
                            </span>
                        @endif
                    </a>
                    <span class="text-sm text-gray-700">{{ auth()->user()->name }}</span>
                    <button wire:click="logout"
                        class="text-sm text-gray-700 hover:text-gray-900 font-medium">Logout</button>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900 font-medium">Sign In</a>
                    <a href="{{ route('register') }}"
                        class="text-sm px-4 py-2 bg-gray-900 text-white hover:bg-gray-800 font-medium transition">Sign
                        Up</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</nav>
