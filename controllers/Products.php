<?php

class ProductsController{

    public function __construct(){
        require_once("./models/productsModel.php");
    }

    public function index(){
        $products = new Products_model();
        $data["products"] = $products->get_products();
        require_once("./views/products.php");
    }
}

?>