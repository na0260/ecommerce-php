<?php
class Cart {
    public $items = [];

    public function addProduct($productId, $quantity) {
        if (isset($this->items[$productId])) {
            $this->items[$productId] += $quantity;
        } else {
            $this->items[$productId] = $quantity;
        }
    }

    public function removeProduct($productId) {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
        }
    }

    public function clearCart() {
        $this->items = [];
    }

    public function getTotal($products) {
        $total = 0;
        foreach ($this->items as $productId => $quantity) {
            foreach ($products as $product) {
                if ($product->id == $productId) {
                    $total += $product->price * $quantity;
                }
            }
        }
        return $total;
    }
}
