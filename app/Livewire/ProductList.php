<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    public function addToCart(CartService $cartService, string $productId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please sign in to add products to your cart.');
            $this->redirect(route('login'), navigate: true);
            return;
        }

        try {
            $cartService->addToCart($productId, 1);
            $this->dispatch('cart-updated');
            session()->flash('success', 'Product added to cart!');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        $products = Product::query()->where('stock_quantity', '>', 0)->orderBy('name')->get();
        return view('livewire.product-list', ['products' => $products]);
    }
}
