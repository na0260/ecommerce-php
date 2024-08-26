<?php
class Product {
    public $id;
    public $name;
    public $price;
    public $description;

    public function __construct($id, $name, $price, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public static function getAllProducts() {
        $productsData = file_get_contents('data/products.json');
        $productsArray = json_decode($productsData, true);
        $products = [];

        foreach ($productsArray as $product) {
            $products[] = new Product($product['id'], $product['name'], $product['price'], $product['description']);
        }

        return $products;
    }
}
