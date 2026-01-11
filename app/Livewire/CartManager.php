<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class CartManager extends Component
{
    public function updateQuantity(CartService $cartService, string $cartId, int $qty)
    {
        try {
            $cartService->updateQuantity($cartId, $qty);
            session()->flash('success', 'Updated');
            $this->dispatch('cart-updated');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function removeFromCart(CartService $cartService, string $cartId)
    {
        try {
            $cartService->removeFromCart($cartId);
            session()->flash('success', 'Removed');
            $this->dispatch('cart-updated');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        $cartService = new CartService();
        $items = $cartService->getCart();
        return view('livewire.cart-manager', ['items' => $items]);
    }
}
