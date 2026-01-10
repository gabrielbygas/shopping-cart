<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Add product to cart or update its quantity.
     * @throws \Exception
     */
    public function addToCart(string $productId, int $quantity = 1): array
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        // Check stock
        if ($product->stock_quantity < $quantity) {
            throw new \Exception("Insufficient stock for this product.");
        }

        // Check if product is already in cart
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;

            if ($product->stock_quantity < $newQuantity) {
                throw new \Exception("Requested quantity exceeds available stock.");
            }

            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return $this->response("Product added to cart successfully.");
    }

    /**
     * Update the quantity of a product in the cart.
     *
     * @throws \Exception
     */
    public function updateQuantity(string $cartId, int $quantity): array
    {
        $cartItem = Cart::findOrFail($cartId);
        $product = $cartItem->product;

        if ($product->stock_quantity < $quantity) {
            throw new \Exception("Insufficient stock for this quantity.");
        }

        $cartItem->update(['quantity' => $quantity]);

        return $this->response("Quantity updated successfully.");
    }

    /**
     * Remove a product from the cart.
     */
    public function removeFromCart(string $cartId): array
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return $this->response("Product removed from cart successfully.");
    }

    /**
     * Retrieve the user's cart.
     */
    public function getCart()
    {
        return Auth::user()
            ->cart()
            ->with('product')
            ->get();
    }

    /**
     * Standard response for all cart operations.
     */
    private function response(string $message): array
    {
        return [
            'success' => true,
            'message' => $message,
            'cart' => $this->getCart(),
        ];
    }
}