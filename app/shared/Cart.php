<?php

namespace app\shared;

class Cart {

    private array $products = [];

    public function setProduct(int $id) {
        array_push($this->products, $id);
    }

    public function getProduct(){
        return $this->products;
    }
}

?>